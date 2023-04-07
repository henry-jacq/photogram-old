<?
use libs\core\Session;
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:image"
		content="<?= get_config('base_path') ?>assets/brand/photogram-icon.png">
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
		href="<?= get_config('base_path') ?>assets/brand/favicon.ico">
	<!-- Custom-compiled bootstrap CSS -->
	<link
		href="<?= get_config('base_path') ?>css/bootstrap.min.css"
		rel="stylesheet">

	<!-- App CSS -->
	<link rel="stylesheet"
		href="<?= get_config('base_path') ?>css/app.min.css">

	<!-- Hover CSS -->
	<link rel="stylesheet"
		href="<?= get_config('base_path') ?>css/hover.css">
	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

	<?php
	// Load the CSS file if the current script matches the following
	if (Session::currentScript() == "login" or Session::currentScript() == "signup" or Session::currentScript() == "forgot-password") {
	    if (file_exists(($_SERVER['DOCUMENT_ROOT'] . get_config('base_path') . "css/entry.css"))) { ?>
	<link rel="stylesheet"
		href="<?= get_config('base_path') . "css/entry.css" ?>">
	<?php }
	    } ?>

</head>