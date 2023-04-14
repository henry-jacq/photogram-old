<?php

include 'libs/autoload.php';

use app\core\Session;
use app\core\View;

if (Session::isAuthenticated()) {
    header("Location: /");
    die();
}

View::renderPage();
