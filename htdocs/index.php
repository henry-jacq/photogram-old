<?php

require 'libs/autoload.php';

use libs\core\Session;
use libs\core\UserSession;

if (isset($_GET['logout'])) {
    if (Session::isset('session_token')) {
        UserSession::removeSession(Session::get('session_token'));
    }

    Session::destroy();
    header("Location: /");
    die();
} else {
    Session::renderPage();
}
