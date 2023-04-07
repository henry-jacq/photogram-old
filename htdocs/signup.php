<?php

include_once 'libs/autoload.php';

use libs\core\Session;

if(Session::isAuthenticated()){
    header("Location: /");
    die();
}

Session::renderPage();