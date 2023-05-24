<?php

include_once 'libs/autoload.php';

use App\Core\Session;
use App\Core\View;

if (Session::isAuthenticated()) {
    header("Location: /");
    die();
}

View::renderPage();
