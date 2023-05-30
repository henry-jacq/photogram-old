<?php

declare(strict_types=1);

class Config
{
    /**
     * Get credentials from config
     */
    public static function get_details($key, $default=null)
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
}

// App Details
define('APP_NAME', 'Photogram');
define('APP_FROM_ADDRESS', 'noreply@photogram.com');
define('DOMAIN_NAME', Config::get_details("domain_name"));

// App Root
define('APP_ROOT', dirname(__DIR__));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');

// DB Params
define('DB_HOST', Config::get_details("db_server"));
define('DB_USER', Config::get_details("db_user"));
define('DB_PASS', Config::get_details("db_pass"));
define('DB_NAME', Config::get_details("db_name"));

// Upload Path
define('APP_STORAGE_PATH', Config::get_details("storage_path"));

// Config Location
define('APP_CONFIG_LOCATION', __FILE__);

// SMTP Params
define('SMTP_HOST', Config::get_details("smtp_host"));
define('SMTP_AUTH_USER', Config::get_details("smtp_auth_user"));
define('SMTP_AUTH_PASS', Config::get_details("smtp_auth_pass"));
