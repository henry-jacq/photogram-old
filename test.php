<?php
/*
echo "<pre>";
$username = $_POST['username'];
$password = $_POST['password'];
$server = "mysql.selfmade.ninja";
$serv_user = "Henry";
$serv_pass = "Syphn0tch#098";
$dbname = "Henry_testdb";
$table = "auth";

$sql = "SELECT * FROM `$table`";
$result = mysqli_query($conn, $sql);
$rows_in_query = mysqli_num_rows($result);
echo $row['username'];
    if (mysqli_num_rows($result) > 0 ){
        // Fetching rows from the database
        while($row = mysqli_fetch_assoc($result)) {
            echo ("$row[username]<br>");
            if ($row[1] == $username and $row[2] == $password) {
                return true;
            } else {
                return false;
            }
            // Checking if any rows is equal to the username from $_POST will marked as true
            if ($username == $row['username'] and $password == $row['password']){
                echo "Found user " . $row['username'] . " with password " . $row['password'] . " on database<br>";
                return true;
            }
            elseif($username != $row['username'] and $password == $row['password']){
                echo "Username is wrong<br>";
                return false;
            }
            elseif($username == $row['username'] and $password != $row['password']){
                echo "Password is wrong<br>";
                return false;
            }
            else{
                echo "Credentials not found !<br>";
                return false;
            }
            
        }
    }
$conn->close();
echo "</pre>";
*/