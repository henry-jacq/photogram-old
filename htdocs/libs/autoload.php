<?php

// Autoload all PHP class files
spl_autoload_register(function ($class) {
    $path_core = "core/";
    $path_app = "app/";
    $extension = ".class.php";
    $full_path_core = $path_core . $class . $extension;
    $full_path_app = $path_app . $class . $extension;

    include_once $full_path_core;
    include_once $full_path_app;
});

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