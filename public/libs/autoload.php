<?php

// Autoload all class files using composer
require __DIR__ . "/../../vendor/autoload.php";

use App\Core\WebAPI;

$webAPI = new WebAPI();

// Start session
$webAPI->initiateSession();
