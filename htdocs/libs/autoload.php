<?php

// Autoload all PHP class files
require 'vendor/autoload.php';
include 'core/Database.class.php';
include 'core/Session.class.php';
include 'core/User.class.php';
include 'core/UserSession.class.php';
include 'core/WebAPI.class.php';
include 'app/Post.class.php';

// Error handling
// error_reporting(E_ALL);

// NOTE:
// Config location in labs: /home/$USER/photogram_config.json
// Config location in server: /var/www/photogram_config.json

$wapi = new WebAPI();
$wapi->initiateSession();


// Get credentials from config
function get_config($key, $default=null){
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}