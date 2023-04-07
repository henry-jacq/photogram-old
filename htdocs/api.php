<?php

require_once 'libs/autoload.php';
use libs\core\API;

$api = new API();

try {
    $api->processApi();
} catch (Exception $e) {
    $api->die($e);
}