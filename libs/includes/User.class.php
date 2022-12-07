<?php

Class User{

    private $conn;

    // Signup Implementation
    public static function signup($username, $password, $email, $phone){
        // Amount of cost requires to generate a random hash
        $options = [
            'cost' => 8
        ];
        // Hashing password
        $password = password_hash($password, PASSWORD_DEFAULT, $options);
        
        // We assumes this as secure way to hashing a password
        // $password = md5(strrev(md5($password))); // Security through obscurity

        // Create a connection to database
        $conn = Database::getconnection();

        // Insert values into the database
        // Todo: In future, change the sql query table to class variable which is declared in database_class_php file
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`)
        VALUES ('$username', '$password', '$email', '$phone');";
        
        // Sending the query to the database and checking if it is true or false
        if($conn->query($sql) === true) {
            $error = false;
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            $error = $conn->error;
        }
        return $error;
    }

    // Login implementation
    public static function login($username, $password){

        // Query to fetch the user data
        $query = "SELECT * FROM `auth` WHERE `username` = '$username'";
        // Create a connection to database
        $conn = Database::getConnection();
        // Get the user details [1 row] by sending this query to database.
        $result = $conn->query($query);
        // Checking the query has a row or not
        if ($result->num_rows == 1){
            // Fetch the user data in associative array form
            $row = $result->fetch_assoc();
            // Checking the row that has the password which is entered by user.
            // Checking the password entered by user is matching with password in database
            if (password_verify($password, $row['password'])){
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // In the starting, it will make a new database connection.
    public function __construct($username)
    {
        $this->conn = Database::getConnection();
        $this->conn->query();
        $this->username = $username;

        $this->id = null;
    }

    public function authenticate(){

    }

    public function setBio(){

    }

    public function getBio(){

    }

    public function setAvatar($link){

    }

    public function getAvatar($link){
        
    }
}