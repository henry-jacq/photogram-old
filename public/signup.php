<?php

include_once 'libs/autoload.php';

use app\core\Session;

if (Session::isAuthenticated()) {
    header("Location: /");
    die();
}

Session::renderPage();
