<?php

include 'libs/autoload.php';

use app\core\Session;

Session::ensureLogin();

Session::renderPage();
