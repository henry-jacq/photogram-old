<?php

/**
 * PHP session wrapper
*/

class Session
{
    public static $isError = false;
    public static $user = null;
    public static $usersession = null;

    public static function start() {
        session_start();
    }

    public static function unset() {
        session_unset();
    }

    public static function destroy() {
        session_destroy();
    }

    // Set a new variable in session
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function delete($key) {
        unset($_SESSION[$key]);
    }

    public static function isset($key) {
        return isset($_SESSION[$key]);
    }

    public static function get($key, $default=false) {
        if (Session::isset($key)) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    public static function getUser() {
        return Session::$user;
    }

    public static function getUserSession() {
        return Session::$usersession;
    }

    // Takes an email as an input and returns if the session user has the same email
    public static function isOwnerOf($owner) {
        $sess_user = Session::getUser();
        if ($sess_user){
            if ($sess_user->getUsername() == $owner) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function loadTemplate($template_name) {

        $script = $_SERVER['DOCUMENT_ROOT'] . get_config('base_path') . "_templates/$template_name.php";
        if (is_file($script)) {
            include $script;
        } else {
            Session::loadTemplate('_error');
        }
    }

    public static function renderPage() {
        Session::loadTemplate('_master');
    }

    public static function currentScript() {
        return basename($_SERVER['SCRIPT_NAME'], '.php');
    }

    public static function isAuthenticated() {
        if (is_object(Session::getUserSession())) {
            return Session::getUserSession()->isValid();
        } else {
            return false;
        }
    }

    public static function ensureLogin(){
        if(!Session::isAuthenticated()){
            Session::set('_redirect', $_SERVER['REQUEST_URI']);
            header("Location: /login.php");
            die();
        }
    }

}