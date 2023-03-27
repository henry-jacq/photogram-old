#!/usr/bin/php
<?php

/**
 *
 * Author: Henry
 *
 * This script will generate a JSON file for photogram
 */

// It exits if the interface is not CLI
if (php_sapi_name() !== 'cli') {
    exit;
}

// Config name
$config = "photogram_config.json";

// Warn user if the config exists and allowed to override
if (file_exists($config)) {
    echo "Warning: The existing data in config will be overwritten!\n";
    $check = readline("[?] Want to override the existing config? [Y/n] ");
    if ($check == "y" | $check == "Y" | $check == "") {
        echo "[*] Overwriting the existing config...\n";
    } else {
        exit;
    }
} else {
    echo "Welcome to photogram config generator!\n";
}

echo "\n==> Enter the following details to generate the config\n\n";

// Prompts to get the data
$server_address = readline("-> Server address: ");
$db_user = readline("-> Database username: ");
$db_pass = readline("-> Database password: ");
$db_table = readline("-> Table name: ");
$base_path = readline("-> Base path [Default /]: ");
$upload_path = readline("-> Enter upload path: ");

// If base path is empty, it sets to default value
if ($base_path == "") {
    $base_path = "/";
}

$contents = "{
    \"db_server\": \"{$db_user}\",
    \"db_user\": \"{$db_user}\",
    \"db_pass\": \"{$db_pass}\",
    \"db_name\": \"{$db_table}\",
    \"base_path\": \"{$base_path}\",
    \"upload_path\": \"{$upload_path}\"
}
";

file_put_contents("{$config}", "{$contents}");

echo "\n==> Config generated!\n\n";
