<?php

use App\Core\Session;
use App\Core\View;

View::loadTemplate('layouts/header');

if (Session::isAuthenticated()) {
    View::loadTemplate('templates/home/breadcrumb');
    // View::loadTemplate('templates/home/calltoaction');
} else {
    View::loadTemplate('templates/home/login');
}

View::loadTemplate('templates/home/photogram');
View::loadTemplate('layouts/footer');
