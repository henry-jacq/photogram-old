<?php

$server = "mysql.selfmade.ninja";
$username = "Henry";
$password = "";
$dbname = "Henry_testdb";

// Create connection
$conn = new mysqli($server, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

$sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`, `blocked`)
VALUES ('fdg', 'dfg', 'ds@sdds.sd', '3234567890', '0', '0');"; 

// Check insertion
if ($conn->connect_error) {
  die("Data not inserted: " . $conn->connect_error);
}
echo "Successfully data inserted<br>";

$result = $conn->query($sql);


$conn->close();


// Create database

// $sql = "CREATE DATABASE $dbname";
// if ($conn->query($sql) === TRUE) {
//   echo "Database created successfully";
// } else {
//   echo "Error creating database: " . $conn->error;
// }
// $conn->close()

// sql to create table
// $sql = "CREATE TABLE MyGuests (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// firstname VARCHAR(30) NOT NULL,
// lastname VARCHAR(30) NOT NULL,
// email VARCHAR(50),
// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// if ($conn->query($sql) === TRUE){
//   echo"Table MyGuests created successfully";
// } else {
//   echo "Error creating table: " . $conn->error;
// }

// $conn->close();
?>
