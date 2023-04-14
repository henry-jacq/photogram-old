<?php

require 'libs/autoload.php';

use app\core\View;
use app\core\Session;

if (isset($_GET['logout'])) {
    Session::logout(Session::get('session_token'));
    header("Location: /");
    die();
} else {
    View::renderPage();
}
