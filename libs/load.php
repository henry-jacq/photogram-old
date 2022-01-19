<?php

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/login-page/_templates/$name.php"; //not consistent.
}

function validate_credentials($username, $password)
{
    if ($username == "henry@selfmade.ninja" and $password == "password") {
        return true;
    } else {
        return false;
    }
}

function signup($username, $password, $email, $phone){
    $server = "mysql.selfmade.ninja";
    $serv_user = "Henry";
    $serv_pass = "";
    $dbname = "Henry_testdb";

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