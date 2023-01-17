<?php

require_once 'libs/autoload.php';

$api = new API();

try {
    $api->processApi();
} catch (Exception $e) {
    $api->die($e);
}