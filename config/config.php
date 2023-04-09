<?php

declare(strict_types=1);

// Get credentials from config
function get_config($key, $default=null)
{
    $site_config_path = __DIR__ . '/photogram.json';
    $site_config = file_get_contents($site_config_path);
    $array = json_decode($site_config, true);

    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

// App Details
define('APP_NAME', 'Photogram');
define('APP_FROM_ADDRESS', 'noreply@photogram.com');
define('DOMAIN_NAME', get_config("domain_name"));

// App Root
define('APP_ROOT', dirname(__DIR__));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');

// DB Params
define('DB_HOST', get_config("db_server"));
define('DB_USER', get_config("db_user"));
define('DB_PASS', get_config("db_pass"));
define('DB_NAME', get_config("db_name"));

// Upload Path
define('APP_UPLOAD_PATH', get_config("upload_path"));

// Config Path
define('CONFIG_PATH', dirname(__FILE__));

// SMTP Params
define('SMTP_HOST', get_config("smtp_host"));
define('SMTP_AUTH_USER', get_config("smtp_auth_user"));
define('SMTP_AUTH_PASS', get_config("smtp_auth_pass"));
