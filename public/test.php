<?php

use App\Core\User;

include '../bootstrap.php';

$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASS;
$database = DB_NAME;


echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
exit;


// try {
//     $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $query = "SELECT * FROM `auth` WHERE `email` = ?";

//     $stmt = $db->prepare($query);

//     $stmt->bindValue(1, '');

//     $stmt->execute();

//     echo '<pre>';
//     print_r($stmt->fetchAll()[0]);
//     echo '</pre>';
//     // exit;
    
    
// } catch (\PDOException $e) {
//     throw new \PDOException($e->getMessage());
// }
