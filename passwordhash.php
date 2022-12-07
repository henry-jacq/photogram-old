<?php

/**
 * In this case, we want to increase the default cost for BCRYPT to 12.
 * Note that we also switched to BCRYPT, which will always be 60 characters.
 */

function create_password_hash($password, $cost){
    $options = [
        'cost' => $cost
    ];
    echo "Cost: $cost\nPassword: $password\n";
    $hash = password_hash($password, PASSWORD_DEFAULT, $options);
    echo "Hashed password: $hash\n";
    return $hash;
}

function verify_password_hash($password, $hash_password){
    if (password_verify("$password", $hash_password)) {
        echo "Password is valid!\n";
    } else {
        echo "Invalid password.\n";
    }
}

$user_password = "supersecretpassword";
$costvalue = 8;

$generated_hash = create_password_hash($user_password, $costvalue);

verify_password_hash($user_password, $generated_hash);
