<?php

namespace app\Core;

use \Exception;

class Auth {

    /**
     * Register user
     */
    public static function register($username, $password, $email): string
    {
        // Amount of cost requires to generate a random hash
        $options = [
            'cost' => 8
        ];
        $password = password_hash($password, PASSWORD_DEFAULT, $options);
        $conn = Database::getConnection();
        $username = strtolower(self::check_sql_errors($username));
        $password = self::check_sql_errors($password);
        $email = self::check_sql_errors($email);

        // TODO: In future, change the sql query table to class variable which is declared in database_class_php file
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `active`, `signup_time`) VALUES ('$username', '$password', '$email', '0', now());";

        try {
            return $conn->query($sql);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Login user
     */
    public static function login($user, $password): string
    {
        if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM `auth` WHERE `email` = '$user'";
        } else {
            $query = "SELECT * FROM `auth` WHERE `username` = '$user'";
        }

        $conn = Database::getConnection();
        $user = strtolower(self::check_sql_errors($user));

        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
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
     * Escapes special characters in a SQL statement
     */
    protected static function check_sql_errors($value): string
    {
        $conn = Database::getConnection();
        return mysqli_real_escape_string($conn, $value);
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

    public static function revokeResetToken(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Revoke token Query
            $query = "UPDATE `auth` SET `token` = NULL, `updated_time` = now() WHERE `email` = '$email';";

            // Create a connection to database
            $conn = Database::getConnection();
            $result = $conn->query($query);

            if ($result && $conn->query($query)) {
                return true;
            } else {
                throw new Exception("Password reset token cannot be revoked!");
            }
        }
    }

    /**
     * Generate Password reset token for given email
     *
     * The token is saved in database
     */
    public static function generateResetToken(string $email)
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
    public static function createResetPasswordLink(string $email)
    {
        $domain = DOMAIN_NAME;
        $token = self::generateResetToken($email);
        $link = $domain . "/forgot-password/$token";
        return $link;
    }
}