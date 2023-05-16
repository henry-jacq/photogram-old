<?php

use app\core\Session;
use app\core\View;

View::loadTemplate('templates/header');

if (Session::isAuthenticated()) {
    View::loadTemplate('layouts/home/breadcrumb');
    View::loadTemplate('layouts/home/calltoaction');
} else {
    View::loadTemplate('layouts/home/login');
}

View::loadTemplate('layouts/home/photogram');
View::loadTemplate('templates/footer');
