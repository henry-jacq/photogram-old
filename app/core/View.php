<?php

namespace app\core;

/**
 * Render a view file
 */
class View
{
    /**
     * Loads the view template
     */
    public static function loadTemplate($template_name)
    {
        $script = $_SERVER['DOCUMENT_ROOT'] . "/../views/$template_name.php";
        if (is_file($script)) {
            include $script;
        } else {
            View::loadTemplate('templates/error');
        }
    }

    /**
     * Loads the master template
     */
    public static function renderPage()
    {
        View::loadTemplate('master');
    }

    /**
     * Loads the 404 error page
     */
    public static function loadErrorPage()
    {
        http_response_code(404);
        self::loadTemplate('templates/error');
    }
}
