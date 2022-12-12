<?php

include_once 'includes/User.class.php';
include_once 'includes/Database.class.php';
include_once 'includes/Session.class.php';

// Error handling
// error_reporting(E_ALL);

// Start session when this file is loaded
Session::start();

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/photogram/_templates/$name.php";
}
