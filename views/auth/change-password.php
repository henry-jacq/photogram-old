<?php

// Change password url looks like
// https://{domain}/users/password/edit?reset_password_token=JqvMtogdFTxyw1uVGEmR#


// Password update query
// UPDATE `auth` SET `password` = 'password' WHERE `email` = 'test@mail.com';

// Password reset token characters 20

$token = bin2hex(random_bytes(8));


if (empty($_GET['reset_password_token'])) {
    echo "Token is empty";
}
