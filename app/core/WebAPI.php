<?php

namespace app\core;

use Exception;

class WebAPI
{
    public $site_config_path;

    public function __construct()
    {
        if (php_sapi_name() == "cli") {
            $this->site_config_path = dirname(dirname(__DIR__)).'/config/config.php';
            echo $this->site_config_path . PHP_EOL;
            require_once $this->site_config_path;
        } elseif (php_sapi_name() == "apache2handler") {
            $this->site_config_path = $_SERVER['DOCUMENT_ROOT'] . '/../config/config.php';
            require_once $this->site_config_path;
        }
    }

    public function initiateSession()
    {
        if (php_sapi_name() != "cli") {
            session_cache_limiter('none');
            Session::start();
            if (Session::isset('session_token')) {
                try {
                    Session::$usersession = UserSession::authorize(Session::get('session_token'));
                } catch (Exception $e) {
                    // TODO: Handle error
                    print  $e->getMessage();
                }
            }
        }
    }
}
