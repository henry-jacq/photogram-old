<?php

namespace App\Core;

use \DateTime;
use \Exception;

class UserSession
{
    public $conn;
    public $token;
    public $data;
    public $uid;

    // This function will return session_token if the username and password is correct.
    public static function authenticate($user, $pass, $fingerprint=null)
    {
        // Return the username
        $username = User::login($user, $pass);

        if ($username) {
            $user = new User($username);
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(random_int(0, 99999) . $ip . $agent . time());

            // NOTE:
            // Fingerprint is optional
            // If the user is using any adblocker, the fingerprint will not be generated
            $fingerprint = is_null($fingerprint) ? $_COOKIE['fingerprint'] : null;

            $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`, `fingerprint`) VALUES ('$user->id', '$token', now(), '$ip', '$agent', '1', '$fingerprint');";

            if ($conn->query($sql)) {
                Session::set('session_token', $token);
                Session::set('fingerprint', $fingerprint);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function authorize($token)
    {
        $session = new UserSession($token);
        $ip = $_SERVER['REMOTE_ADDR'];
        $agent = $_SERVER['HTTP_USER_AGENT'];

        try {
            // Preventive measures for session hijacking
            if (isset($agent, $ip) && $agent === $session->getUserAgent() && $ip === $session->getIP()) {
                // If the session is active and valid
                if ($session->isValid() && $session->isActive()) {
                    // Check if fingerprint is set and matches
                    if (Session::isset('fingerprint') && Session::get('fingerprint') === $session->getFingerprint()) {
                        Session::$user = $session->getUser();
                        return $session;
                    } elseif (!Session::isset('fingerprint')) {
                        Session::$user = $session->getUser();
                        return $session;
                    }
                }
            }
            Session::logout(Session::get('session_token'));
            return null;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function __construct($token)
    {
        $this->conn = Database::getConnection();
        $this->token = $token;
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `token`= '$token' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid']; // Updating this from database
        } else {
            throw new Exception("Invalid user session.");
        }
    }

    public function getUser()
    {
        return new User($this->uid);
    }

    /**
     * If the validity of the session is not within two hours, it is will be expired.
     */
    public function isValid()
    {
        if (isset($this->data['login_time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
            if (7200 > time() - $login_time->getTimestamp()) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("Login time is not available!");
        }
    }

    /**
     * Get the user IP stored in database
     */
    public function getIP()
    {
        if (isset($this->data['ip'])) {
            return $this->data['ip'];
        } else {
            return false;
        }
    }

    /**
     * User agent stored in database
     */
    public function getUserAgent()
    {
        if (isset($this->data['user_agent'])) {
            return $this->data['user_agent'];
        } else {
            return false;
        }
    }

    /**
     * Get the fingerprint stored in database
     */
    public function getFingerprint()
    {
        if (isset($this->data['fingerprint'])) {
            return $this->data['fingerprint'];
        } else {
            return false;
        }
    }

    /**
     * Deactivate the session
     */
    public function deactivate()
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql  = "UPDATE `session` SET `active` = '0' WHERE `id` = '$this->uid';";
        return $this->conn->query($sql) ? true : false;
    }

    /**
     * Checks if the session is active or not
     */
    public function isActive()
    {
        if (isset($this->data['active'])) {
            return $this->data['active'];
        } else {
            return false;
        }
    }

    // It removes the current Session
    public static function removeSession($token)
    {
        $conn = Database::getConnection();
        
        // SQL query to delete the session
        $sql = "DELETE FROM `session` WHERE `token` = '$token';";
        if ($conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
