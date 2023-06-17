<?php

// Profile Page
use App\Core\View;

View::renderLayout('header');
View::renderTemplate('templates/home/breadcrumb');
View::renderTemplate('templates/home/profile');
View::renderLayout('footer');
