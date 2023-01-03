<?php

class User
{
    private $conn;

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        } else {
            // This for ease of debugging.
            throw new Exception("User::__call() -> $name, function is unavailable.");
        }
    }


    // Signup
    public static function signup($username, $password, $email, $phone)
    {
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
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `sec_email`)
        VALUES ('$username', '$password', '$email', '$phone', '0');";

        // Sending the query to the database and checking if it is true or false
        if ($conn->query($sql) === true) {
            $error = false;
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            $error = $conn->error;
        }
        return $error;
    }

    // Login
    public static function login($username, $password)
    {

        // $email = "abc123@sdsd.com"; 
        // $regex = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/'; 
        // if (preg_match($regex, $email)) {
        //     echo $email . " is a valid email. We can accept it.";
        // } else { 
        //     echo $email . " is an invalid email. Please try again.";
        // }

        // Query to fetch the user data
        // Check if the $username field has email
        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM `auth` WHERE `email` = '$username'";
        } else {
            $query = "SELECT * FROM `auth` WHERE `username` = '$username'";
        }
        
        // Create a connection to database
        $conn = Database::getConnection();
        // Get the user details [1 row] by sending this query to database.
        $result = $conn->query($query);
        // Checking the query has a row or not
        if ($result->num_rows == 1) {
            // Fetch the user data in associative array form
            $row = $result->fetch_assoc();
            // Checking the row that has the password which is entered by user.
            // Checking the password entered by user is matching with password in database
            if (password_verify($password, $row['password'])) {
                return $row['username'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function __construct($user_or_email)
    {
        /**
         * User object can be constructed with either username or email
         * Check if the $user_or_email has email or not
         * Query returns userID and username
         */
        
        if (filter_var($user_or_email, FILTER_VALIDATE_EMAIL)) {
            // Query to fetch data using email
            $sql = "SELECT `id`, `username` FROM `auth` WHERE `email`= '$user_or_email' OR `id` = '$user_or_email' LIMIT 1";
        } else {
            // Query to fetch data using username
            $sql = "SELECT `id`, `username`  FROM `auth` WHERE `username`= '$user_or_email' OR `id` = '$user_or_email' LIMIT 1";
        }
        
        $this->conn = Database::getConnection();
        $this->id = null;
        $result = $this->conn->query($sql);

        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            // Updating this from database
            $this->id = $row['id']; 
            $this->username = $row['username'];
        } else {
            throw new Exception("Username is not available");
        }
    }

    // It is used to retrieve data from the database
    private function _get_data($var)
    {
        // Create a connection, if it doesn't exist
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        // Query to get data from users table
        $sql = "SELECT `$var` FROM `users` WHERE `id` = $this->id";
        $result = $this->conn->query($sql);
        if ($result and $result->num_rows == 1) {
            return $result->fetch_assoc()["$var"];
        } else {
            return null;
        }
    }

    // It used to set the data in the database
    private function _set_data($var, $data)
    {
        // Create a connection, if it doesn't exist
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        // Query to update the data in users table
        $sql = "UPDATE `users` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function setDob($year, $month, $day)
    {
        // checking data is valid or not
        if (checkdate($month, $day, $year)) {
            return $this->_set_data('dob', "$year.$month.$day");
        } else {
            return false;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }
}
