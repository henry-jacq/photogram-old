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
            if (isset($agent) and isset($ip)) {
                if ($agent == $session->getUserAgent() and $ip == $session->getIP()) {
                    // If the session is active and valid
                    if ($session->isValid() and $session->isActive()) {
                        // NOTE: Fingerprint (or) visitorID is Optional
                        if (Session::isset('visitor_id') and $session->getVisitorId()) {
                            // If fingerprint exists, check both equal or not
                            if (Session::get('visitor_id') == $session->getVisitorId()) {
                                Session::$user = $session->getUser();
                                return $session;
                            } else {
                                throw new Exception("Fingerprint doesn't match.");
                            }
                        } else {
                            Session::$user = $session->getUser();
                            return $session;
                        }
                    } else {
                        $session::removeSession($token);
                        throw new Exception("Session is invalid.");
                    }
                } else {
                    $session::removeSession($token);
                    throw new Exception("User agent and IP address doesn't match.");
                }
            } else {
                throw new Exception("User agent and IP address is NULL.");
            }
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
            throw new Exception("Session is invalid.");
        }
    }

    public function getUser()
    {
        return new User($this->uid);
    }

    // Check if the validity of the session is within two hour, else it is inactive.
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
            throw new Exception("login time is not available!");
        }
    }

    // User IP stored in database
    public function getIP()
    {
        if (isset($this->data['ip'])) {
            return $this->data['ip'];
        } else {
            return false;
        }
    }

    // User agent stored in database
    public function getUserAgent()
    {
        if (isset($this->data['user_agent'])) {
            return $this->data['user_agent'];
        } else {
            return false;
        }
    }

    // Fingerprint (or) Visitor ID stored in database
    public function getVisitorId()
    {
        if (isset($this->data['visitor_id'])) {
            return $this->data['visitor_id'];
        } else {
            return false;
        }
    }

    // This change the value of active '1' to '0' in database
    public function deactivate()
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql  = "UPDATE `session` SET `active` = '0' WHERE `id` = '$this->uid';";
        return $this->conn->query($sql) ? true : false;
    }

    // Checks if the session is active or not
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
        $session = new UserSession($token);

        if (isset($session->data['id'])) {
            $id = $session->data['id'];
            // If there is no database connection create one.
            if (!$session->conn) {
                Database::getConnection();
            }
            // SQL query to delete the session
            $sql = "DELETE FROM `session` WHERE `id` = '$id';";
            if ($session->conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
