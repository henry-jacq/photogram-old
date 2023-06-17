<?php

use App\Core\Session;
use App\Core\View;

View::renderLayout('header');

if (Session::isAuthenticated()) {
    View::renderTemplate('templates/home/photogram');
}

