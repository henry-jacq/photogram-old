<?php

include 'libs/autoload.php';

use App\Core\Session;
use App\Core\View;

Session::$isError = true;

if (Session::isAuthenticated()) {
    View::loadTemplate('_header');
}
View::renderPage();
