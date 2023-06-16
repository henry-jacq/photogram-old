<?php

use App\Core\Session;
use App\Core\View;

View::loadTemplate('layouts/header');

if (Session::isAuthenticated()) {
    View::loadTemplate('templates/home/photogram');
}
