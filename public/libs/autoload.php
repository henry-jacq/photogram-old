<?php

// Autoload all class files using composer
require __DIR__ . "/../../vendor/autoload.php";

use app\core\WebAPI;

$webAPI = new WebAPI();

// Start session
$webAPI->initiateSession();
