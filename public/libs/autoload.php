<?php

// Autoload all class files using composer
require __DIR__ . "/../../vendor/autoload.php";

use app\core\WebAPI;

// NOTE:
// Config location in labs: /home/$USER/photogram_config.json
// Config location in server: /var/www/photogram_config.json

$webAPI = new WebAPI();
$webAPI->initiateSession();

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
