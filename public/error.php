<?php

include 'libs/autoload.php';
use app\core\Session;
use app\core\View;

Session::$isError = true;

if (Session::isAuthenticated()) {
    View::loadTemplate('_header');
}
View::renderPage();
