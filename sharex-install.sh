preflight() {
  if [ -r /etc/os-release ]; then
    lsb_dist="$(. /etc/os-release && echo "$ID")"
  else
    exit 1
  fi
  apt -y update
}

required_infos() {
    apt install -y dnsutils certbot sudo curl wget
    FQDN=$HOSTNAME
    SERVER_IP=$(hostname -I | awk '{print $1}')
    SERVER_TIMEZONE=$(curl -s http://ipinfo.io/"$SERVER_IP"/timezone)
    DOMAIN_RECORD=$(dig +short "${FQDN}")
    sudo timedatectl set-timezone "$SERVER_TIMEZONE"
    if [ "${SERVER_IP}" != "${DOMAIN_RECORD}" ]; then
        exit 2
    fi
    systemctl disable --now nginx
    certbot certonly --standalone --register-unsafely-without-email --agree-tos -d "$FQDN" --non-interactive
    (crontab -l ; echo "0 0 * * * certbot renew >> /dev/null 2>&1")| crontab -
}

install() {
  apt -y install software-properties-common curl apt-transport-https ca-certificates gnupg
  if [ "$lsb_dist" =  "ubuntu" ]; then
    LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
  elif [ "$lsb_dist" =  "debian" ]; then
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/sury-php.list
    wget -qO - https://packages.sury.org/php/apt.gpg | sudo apt-key add -
  fi
  apt -y update
  apt -y install php8.0 apache2 libapache2-mod-php unzip
  systemctl enable --now php8.0-fpm apache2
  php -v || exit 3
  sudo a2enmod ssl
  sudo a2enmod rewrite
  mkdir -p /var/www/cdn
  cd /var/www/cdn
  curl -Lo files.zip https://github.com/OxideHosting/sharex-uploader/releases/latest/download/files.zip
  unzip files.zip
  rm files.zip
  chown -R www-data:www-data /var/www/cdn
  chmod -R 755 /var/www/cdn
# shellcheck disable=SC2016
echo '
<VirtualHost *:80>
  ServerName '"${FQDN}"'
  RewriteEngine On
  RewriteCond %{HTTPS} !=on
  RewriteRule ^/?(.*) https://%{SERVER_NAME}/$1 [R,L]
</VirtualHost>
<VirtualHost *:443>
  ServerName '"${FQDN}"'
  DocumentRoot "/var/www/cdn"
  AllowEncodedSlashes On
  <Directory "/var/www/cdn">
    AllowOverride all
  </Directory>
  SSLEngine on
  SSLCertificateFile /etc/letsencrypt/live/'"${FQDN}"'/fullchain.pem
  SSLCertificateKeyFile /etc/letsencrypt/live/'"${FQDN}"'/privkey.pem
</VirtualHost>
' | sudo -E tee /etc/apache2/sites-available/cdn.conf >/dev/null 2>&1
  sudo ln -s /etc/apache2/sites-available/cdn.conf /etc/apache2/sites-enabled/cdn.conf
  systemctl restart apache2
}

preflight
required_infos
install