<?php

use app\core\Session;
use app\core\View;

View::loadTemplate('layouts/header');

if (Session::isAuthenticated()) {
    View::loadTemplate('templates/home/breadcrumb');
    View::loadTemplate('templates/home/calltoaction');
} else {
    View::loadTemplate('templates/home/login');
}

View::loadTemplate('templates/home/photogram');
View::loadTemplate('layouts/footer');
