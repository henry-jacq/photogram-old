<?php
include_once 'libs/load.php';

if(Session::isAuthenticated()){
    header("Location: /");
    die();
}

Session::renderPage();