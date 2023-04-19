<?php
use app\core\Session;

?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:image"
		content="<?= URL_ROOT ?>assets/brand/photogram-icon.png">
	<meta property="site_name" content="Photogram">
	<meta property="og:title" content="Photogram · Gallery of Memories">
	<meta property="description"
		content="Create an account or log in to Photogram. Share photos &amp; videos with friends, family and other people you know.">
	<?php if (Session::isAuthenticated()) { ?>
	<?php if (Session::currentScript() == "index") { ?>
	<title>Home · Photogram</title>
	<?php } elseif (Session::currentScript() == "profile") { ?>
	<title>Profile · Photogram</title>
	<?php } elseif (Session::currentScript() == "settings") { ?>
	<title>Settings · Photogram</title>
	<?php } else { ?>
	<title>Photogram</title>
	<?php }
	} elseif (Session::currentScript() == "forgot-password") {?>
	<title>Forgot password</title>
	<?php } else { ?>
	<title>Sign in/up · Photogram</title>
	<?php } ?>

	<!-- Favicon for photogram -->
	<link rel="shortcut icon"
		href="<?= URL_ROOT ?>assets/brand/favicon.ico">
	<!-- Custom-compiled bootstrap CSS -->
	<link href="<?= URL_ROOT ?>css/bootstrap.min.css"
		rel="stylesheet">

	<!-- App CSS -->
	<link rel="stylesheet" href="<?= URL_ROOT ?>css/app.min.css">

	<!-- Hover CSS -->
	<link rel="stylesheet" href="<?= URL_ROOT ?>css/hover.css">
	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

	<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

	<?php
	// Load the CSS file if the current script matches the following
	if (Session::currentScript() == "login" or Session::currentScript() == "signup" or Session::currentScript() == "forgot-password") {
	    if (file_exists(($_SERVER['DOCUMENT_ROOT'] . URL_ROOT . "css/entry.css"))) { ?>
	<link rel="stylesheet"
		href="<?= URL_ROOT . "css/entry.css" ?>">
	<?php }
	    } ?>

</head>