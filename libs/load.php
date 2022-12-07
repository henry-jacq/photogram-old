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
    include $_SERVER['DOCUMENT_ROOT']."/login-page/_templates/$name.php";
}

function load_main_page($name)
{
    if ($username == "henry@selfmade.ninja" and $password == "password") {
        return true;
    } else {
        return false;
    }
}

function signup($username, $password, $email, $phone){
    $server = "mysql.selfmade.ninja";
    $serv_user = "";
    $serv_pass = "";
    $dbname = "";

    // Create connection
    $conn = new mysqli($server, $serv_user, $serv_pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully<br>";

    $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`, `blocked`)
    VALUES ('$username', '$password', '$email', '$phone', '0', '1');"; 

    // Check insertion
    if ($conn->connect_error) {
        die("Data not inserted: " . $conn->connect_error);
    }
    // echo "Successfully data inserted<br>";
    
    $error = false;
    if($conn->query($sql) === true) {
        $error = false;
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        $error = $conn->error;
    }

    return $error;
    $conn->close();
}