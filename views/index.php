<?php

use App\Core\Session;
use App\Core\View;

View::renderLayout('header');

if (Session::isAuthenticated()) {
    View::renderTemplate('templates/home/breadcrumb');
    // View::renderTemplate('home/calltoaction');
} else {
    View::renderTemplate('templates/home/login');
}

View::renderTemplate('templates/home/photogram');
View::renderLayout('footer');
