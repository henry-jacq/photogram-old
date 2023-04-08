<?php

// Profile Page
use app\core\Session;

Session::loadTemplate('_header');
Session::loadTemplate('home/breadcrumb');
Session::loadTemplate('home/profile');
Session::loadTemplate('_footer');
