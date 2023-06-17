<?php

include 'libs/autoload.php';

use App\Core\Session;
use App\Core\View;

Session::$isError = true;

View::renderPage();
