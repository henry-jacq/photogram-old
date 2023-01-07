<?php

// TODO: Autoload PHP class files
include_once 'includes/User.class.php';
include_once 'includes/Session.class.php';
include_once 'includes/Database.class.php';
include_once 'includes/UserSession.class.php';
include_once 'includes/WebAPI.class.php';
include_once 'app/Post.class.php';

// Error handling
// error_reporting(E_ALL);

// NOTE:
// Config location in labs: /home/$USER/photogram_config.json
// Config location in server: /var/www/photogram_config.json

// Start session when this file is loaded
// Session::start();

$wapi = new WebAPI();
$wapi->initiateSession();


// Get credentials from config
function get_config($key, $default=null)
{
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

// Load php templates
function load_template($template_name)
{
    $__base_path = $_SERVER['DOCUMENT_ROOT'] . get_config('base_path');
    include $__base_path . "_templates/$template_name.php";
}