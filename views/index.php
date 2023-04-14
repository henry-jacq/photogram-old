<?php

use app\core\Session;
use app\core\View;

View::loadTemplate('_header');

if (Session::isAuthenticated()) {
    View::loadTemplate('home/breadcrumb');
    View::loadTemplate('home/calltoaction');
} else {
    View::loadTemplate('home/login');
}

View::loadTemplate('home/photogram');
View::loadTemplate('_footer');
