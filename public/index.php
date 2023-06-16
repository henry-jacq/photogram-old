<?php

require 'libs/autoload.php';

use App\Core\View;
use App\Core\Session;

if (isset($_GET['logout'])) {
    Session::logout(Session::get('session_token'));
    header("Location: /");
    die();
} else {
    Session::ensureLogin();
    View::renderPage();
}
