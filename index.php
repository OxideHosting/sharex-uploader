<?php
$RequestedImage = $_GET['i'];
$RequestedImage2 = $_GET['j'];
$RequestedGif = $_GET['g'];
$RequestedVideo = $_GET['v'];
$Hostname = $_SERVER['SERVER_NAME'];
if ($RequestedImage) {
    print ("
        <meta name='description' content='' />
        <meta rel='image_src' content='https://$Hostname/$RequestedImage.png'/>
        <link rel='canonical' href='https://$Hostname/' />
        <meta name='canonicalURL' content='https://$Hostname/' />
        <meta name='twitter:card' content='summary_large_image'>
        <meta name='twitter:site' content='https://$Hostname/' />
        <meta name='twitter:title' content='Open Image' />
        <meta name='twitter:description' content=''>
        <meta name='twitter:image' content='https://$Hostname/$RequestedImage.png'/>
        <meta name='twitter:url' content='https://$Hostname/' />
        <meta prefix='og: https://$Hostname/' property='og:type' content='website' />
        <meta prefix='og: https://$Hostname/' property='og:site_name' content='Content Delivery Network' />
        <meta prefix='og: https://$Hostname/' property='og:image' content='https://$Hostname/$RequestedImage.png'/>
        <meta prefix='og: https://$Hostname/' property='og:image:url' content='https://$Hostname/$RequestedImage.png'/>
        <meta name='theme-color' content='#27b159'>
       <meta name='msapplication-TileColor' content='#27b159'>");
} else if ($RequestedVideo) {
    print ("
        <meta name='description' content='' />
        <meta rel='image_src' content='https://$Hostname/$RequestedVideo.mp4'/>
        <link rel='canonical' href='https://$Hostname/' />
        <meta name='canonicalURL' content='https://$Hostname/' />
        <meta name='twitter:card' content='player'>
        <meta name='twitter:site' content='https://$Hostname/' />
        <meta name='twitter:title' content='Open Video' />
        <meta name='twitter:description' content=''>
        <meta name='twitter:player' content='https://$Hostname/$RequestedVideo.mp4'/>
        <meta name='twitter:url' content='https://$Hostname/' />
        <meta prefix='og: https://$Hostname/' property='og:type' content='website' />
        <meta prefix='og: https://$Hostname/' property='og:site_name' content='Content Delivery Network' />
        <meta prefix='og: https://$Hostname/' property='og:video' content='https://$Hostname/$RequestedVideo.mp4'/>
        <meta prefix='og: https://$Hostname/' property='og:video:url' content='https://$Hostname/$RequestedVideo.mp4'/>
        <meta name='theme-color' content='#27b159'>
       <meta name='msapplication-TileColor' content='#27b159'>");
} else if ($RequestedImage2) {
    print ("
        <meta name='description' content='' />
        <meta rel='image_src' content='https://$Hostname/$RequestedImage2.jpg'/>
        <link rel='canonical' href='https://$Hostname/' />
        <meta name='canonicalURL' content='https://$Hostname/' />
        <meta name='twitter:card' content='summary_large_image'>
        <meta name='twitter:site' content='https://$Hostname/' />
        <meta name='twitter:title' content='Open Image' />
        <meta name='twitter:description' content=''>
        <meta name='twitter:image' content='https://$Hostname/$RequestedImage2.jpg'/>
        <meta name='twitter:url' content='https://$Hostname/' />
        <meta prefix='og: https://$Hostname/' property='og:type' content='website' />
        <meta prefix='og: https://$Hostname/' property='og:site_name' content='Content Delivery Network' />
        <meta prefix='og: https://$Hostname/' property='og:image' content='https://$Hostname/$RequestedImage2.jpg'/>
        <meta prefix='og: https://$Hostname/' property='og:image:url' content='https://$Hostname/$RequestedImage2.jpg'/>
        <meta name='theme-color' content='#27b159'>
       <meta name='msapplication-TileColor' content='#27b159'>");
} else if ($RequestedGif) {
    print ("
        <meta name='description' content='' />
        <meta rel='image_src' content='https://$Hostname/$RequestedGif.gif'/>
        <link rel='canonical' href='https://$Hostname/' />
        <meta name='canonicalURL' content='https://$Hostname/' />
        <meta name='twitter:card' content='summary_large_image'>
        <meta name='twitter:site' content='https://$Hostname/' />
        <meta name='twitter:title' content='Open GIF' />
        <meta name='twitter:description' content=''>
        <meta name='twitter:image' content='https://$Hostname/$RequestedGif.gif'/>
        <meta name='twitter:url' content='https://$Hostname/' />
        <meta prefix='og: https://$Hostname/' property='og:type' content='website' />
        <meta prefix='og: https://$Hostname/' property='og:site_name' content='Content Delivery Network' />
        <meta prefix='og: https://$Hostname/' property='og:image' content='https://$Hostname/$RequestedGif.gif'/>
        <meta prefix='og: https://$Hostname/' property='og:image:url' content='https://$Hostname/$RequestedGif.gif'/>
        <meta name='theme-color' content='#27b159'>
       <meta name='msapplication-TileColor' content='#27b159'>");
}
?>
<head>
    <title>Content Delivery Network</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <?php
                if ($RequestedImage) {
                    print ("<img src='$RequestedImage.png' frameborder='0' style='max-height:95%;max-width:95%;padding-bottom:2%;'></img>");
                } else if ($RequestedVideo) {
                    print ("<video style='max-height:95%;max-width:95%;padding-bottom:2%;' controls><source src='$RequestedVideo.mp4' type='video/mp4'></video>");
                } else if ($RequestedImage2) {
                    print ("<img src='$RequestedImage2.jpg' frameborder='0' style='max-height:95%;max-width:95%;padding-bottom:2%;'></img>");
                } else if ($RequestedGif) {
                    print ("<img src='$RequestedGif.gif' frameborder='0' style='max-height:95%;max-width:95%;padding-bottom:2%;'></img>");
                } else {
                    print ("The content you are looking for might have been removed, had its name changed or is temporarily unavailable.");
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
