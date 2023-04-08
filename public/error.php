<?php

include 'libs/autoload.php';
use app\core\Session;

Session::$isError = true;

Session::renderPage();
