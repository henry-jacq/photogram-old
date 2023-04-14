<?php

require 'libs/autoload.php';

use app\core\Session;
use app\core\UserSession;
use app\core\View;

if (isset($_GET['logout'])) {
    if (Session::isset('session_token')) {
        UserSession::removeSession(Session::get('session_token'));
    }

    Session::destroy();
    header("Location: /");
    die();
} else {
    View::renderPage();
}
