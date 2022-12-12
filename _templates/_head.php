<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    <meta property="og:image" content="/photogram/assets/brand/photogram-icon.png">
    <meta property="site_name" content="Photogram">
    <meta property="og:title" content="Photogram · Gallery of Memories">
    <meta property="description"
        content="Create an account or log in to Photogram. Share photos &amp; videos with friends, family and other people you know.">
    <title>Sign in/up · Photogram</title>
    <!-- Favicon for photogram -->
    <link rel="shortcut icon" href="/photogram/assets/brand/favicon.ico">
    <!-- Custom compiled bootstrap css -->
    <link href="/photogram/assets/styles/main.min.css" rel="stylesheet">
    <!-- User specified css -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <!-- Custom icons from fontawesome -->
    <!-- <script src="https://kit.fontawesome.com/cd2caad5e8.js" crossorigin="anonymous"></script> -->

    <!-- It allows us to load the css for the respective web pages -->
    <!-- If the required css files exist, it will automatically loaded -->
    <?if (file_exists($_SERVER['DOCUMENT_ROOT'].'/photogram/css/'.basename($_SERVER['PHP_SELF'], ".php").".css")) {?>

        <link rel="stylesheet" href="/photogram/css/<?=basename($_SERVER['PHP_SELF'], ".php");?>.css">
    <? } ?>
</head>