<?php

namespace App\Core;

/**
 * Render a view file
 */
class View
{
    /**
     * Loads the 404 error page
     */
    public static function loadErrorPage()
    {
        http_response_code(404);
        self::loadTemplate('layouts/error');
    }
    
    /**
     * Loads the view template
     */
    public static function loadTemplate(string $template_name)
    {
        $template = APP_ROOT . "/views/$template_name.php";
        if (is_file($template)) {
            include_once $template;
        } else {
            self::loadErrorPage();
        }
    }

    /**
     * Loads the master template
     */
    public static function renderPage()
    {
        self::loadTemplate('layouts/master');
    }
}
