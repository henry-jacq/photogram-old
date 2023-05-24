<?php

namespace App\Core;

use Exception;
use App\Traits\SQLGetterSetter;

class User
{
    use SQLGetterSetter;
    private $conn;
    public $username;
    public $id;
    public $table;

    // Escapes special characters in an SQL statement
    protected static function check_sql_errors($value): string
    {
        $conn = Database::getConnection();
        return mysqli_real_escape_string($conn, $value);
    }

    // Register User
    public static function signup($username, $password, $email, $fname, $lname): string
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
        $conn = Database::getConnection();

        // Check for special characters in these values
        $username = strtolower(self::check_sql_errors($username));
        $password = self::check_sql_errors($password);
        $email = self::check_sql_errors($email);
        $fname = self::check_sql_errors($fname);
        $lname = self::check_sql_errors($lname);

        // Insert values into the database
        // Todo: In future, change the sql query table to class variable which is declared in database_class_php file
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `first_name`, `last_name`, `active`, `signup_time`) VALUES ('$username', '$password', '$email', '$fname', '$lname', '0', now());";

        // Sending the query to the database and checking if it is true or false
        //PHP 7.4 -
        // if ($conn->query($sql) === true) {
        //     $error = false;
        // } else {
        //     $error = $conn->error;
        // }

        //PHP 8.1 - all MySQLi errors are throws as Exceptions
        try {
            return $conn->query($sql);
        } catch (Exception $e) {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            return false;
        }
    }

    // Login User
    public static function login($username_or_email, $password): string
    {
        // Query to fetch the user data
        // Check if the $username_or_email field has email
        if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM `auth` WHERE `email` = '$username_or_email'";
        } else {
            $query = "SELECT * FROM `auth` WHERE `username` = '$username_or_email'";
        }

        // Create a connection to database
        $conn = Database::getConnection();

        $username_or_email = strtolower(self::check_sql_errors($username_or_email));

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

    /**
     * It fetch first name of user by email
     */
    public static function getFirstName($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT `first_name` FROM `auth` WHERE `email` = '$email';";

            // Create a connection to database
            $conn = Database::getConnection();

            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['first_name'];
            } else {
                throw new Exception(__CLASS__ . "::getFirstName() -> $email, first_name is unavailable.");
            }
        }
    }

    /**
     * Retrieve Password reset token for given email
     *
     * Get the token saved in database
     */
    public static function retrieveResetToken($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT `token` FROM `auth` WHERE `email` = '$email';";

            // Create a connection to database
            $conn = Database::getConnection();

            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row['token'];
            } else {
                throw new Exception(__CLASS__ . "::retrieveResetToken() -> $email, token is unavailable.");
            }
        }
    }

    /**
     * Generate Password reset token for given email
     *
     * The token is saved in database
     */
    public static function generateResetToken($email)
    {
        $token = bin2hex(random_bytes(8));

        Session::set('reset_password_email', "$email");

        $conn = Database::getConnection();

        $query = "UPDATE `auth` SET `token` = '$token', `updated_time` = now() WHERE `email` = '$email';";

        if ($conn->query($query)) {
            return $token;
        } else {
            throw new Exception("Password reset token cannot be generated!");
        }
    }

    /**
     * This will returns the password reset URL
     */
    public static function createResetPasswordLink($email)
    {
        $domain = DOMAIN_NAME;
        $token = self::generateResetToken($email);
        $link = $domain . "/forgot-password/$token";
        return $link;
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
            $sql = "SELECT `id`, `email` FROM `auth` WHERE `email`= '$user_or_email' OR `id` = '$user_or_email' LIMIT 1";
        } else {
            // Query to fetch data using username
            $sql = "SELECT `id`, `username`  FROM `auth` WHERE `username`= '$user_or_email' OR `id` = '$user_or_email' LIMIT 1";
        }

        $this->conn = Database::getConnection();
        $this->username = $user_or_email;
        $this->id = null;
        $this->table = "auth";
        $result = $this->conn->query($sql);

        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            // Updating this from database
            $this->id = $row['id'];
        // $this->username = $row['username'];
        } else {
            throw new Exception("Username is not available");
        }
    }

    public function setDob($year, $month, $day): string
    {
        // checking data is valid or not
        if (checkdate($month, $day, $year)) {
            return $this->_set_data('dob', "$year.$month.$day");
        } else {
            return false;
        }
    }

    public static function changePassword(string $email, string $password)
    {
        // Sanitizing user input
        $email = self::check_sql_errors($email);
        $password = self::check_sql_errors($password);

        // Amount of cost requires to generate a random hash
        $options = [
            'cost' => 8
        ];
        // Hashing password
        $password = password_hash($password, PASSWORD_DEFAULT, $options);

        $conn = Database::getConnection();

        $query = "UPDATE `auth` SET `password` = '$password' WHERE `email` = '$email';";

        try {
            return $conn->query($query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Check if the user exists
     */
    public static function exists(string $username) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM `auth` WHERE `username` = '$username';";
        $result = $db->query($sql);

        if ($result && $result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
}
