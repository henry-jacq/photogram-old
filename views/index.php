<?php

use App\Core\Session;
use App\Core\View;

View::renderLayout('header');

if (Session::isAuthenticated()) {
    View::renderTemplate('home/breadcrumb');
    // View::renderTemplate('home/calltoaction');
} else {
    View::renderTemplate('home/login');
}

View::renderTemplate('home/photogram');
View::renderLayout('footer');
