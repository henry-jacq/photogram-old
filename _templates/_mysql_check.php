<?php
$server = "mariadb.selfmade.ninja";
$username = "Henry";
$password = "";
$dbname = "Henry_logintest";

// Create connection
$conn = new mysqli($server, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// Create database
$sql = "CREATE DATABASE Henry_myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();

// $sql = "SELECT userid, name, email, password FROM login_test"; 

// $result = $conn->query($sql);

// if ($result->num_rows > 0){
//   while($row = $result->fetch_assoc()){
//     echo "Data" . $row["user_id"]. " - Name: " . 
//     $row["name"]. " - Email: " . $row["email"]. " - Password: " . $row["password"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }

// $conn->close();


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
