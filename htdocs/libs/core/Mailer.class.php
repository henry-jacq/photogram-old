<?php

require 'Database.class.php';

class Mailer
{
    // Check if the provided mail exist in database or not
    public static function mail_exists($email): string
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM `auth` WHERE `email` = '$email'";

            // Create a connection to database
            $conn = Database::getConnection();

            // Get the user details [1 row] by sending this query to database.
            $result = $conn->query($query);

            if ($result->num_rows) {
                $row = $result->fetch_assoc();
                if ($row['email']) {
                    return true;
                } else {
                    throw new \Exception("Email is not available");
                }
            } else {
                return false;
            }
        }
    }
}
