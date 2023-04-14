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
            View::loadTemplate('_error');
        }
    }

    /**
     * Loads the master template
     */
    public static function renderPage()
    {
        View::loadTemplate('_master');
    }
}
