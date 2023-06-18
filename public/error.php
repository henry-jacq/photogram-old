<?php

include '../bootstrap.php';

use App\Core\Session;
use App\Core\View;

Session::$isError = true;

View::renderPage();
