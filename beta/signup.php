<?php
include_once 'libs/autoload.php';

if(Session::isAuthenticated()){
    header("Location: /");
    die();
}

Session::renderPage();