<?php

// Profile Page
use App\Core\View;

View::renderLayout('header');
View::renderTemplate('home/breadcrumb');
View::renderTemplate('home/edit-profile');