<?php

require_once 'public/libs/autoload.php';

use app\core\Database;

if (php_sapi_name() == "cli") {
    $db = new Database();
    $db->applyMigrations();
} else {
    throw new Exception("Please run the script on CLI");
}