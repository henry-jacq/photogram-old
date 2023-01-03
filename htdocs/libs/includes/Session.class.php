<?php

/**
 * PHP session wrapper
*/

class Session
{
    public static $isError = false;

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
        return true;
    }
}
