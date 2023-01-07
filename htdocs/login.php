<?php
include 'libs/autoload.php';

if (Session::isAuthenticated()) {
    header("Location: /");
    die();
}

Session::renderPage();