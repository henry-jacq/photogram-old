<?php

use App\Core\User;
use App\Core\Session;

require_once 'fp-templates.php';

if (isset($_GET['reset_password_token']) and !empty($_GET['reset_password_token'])) {
    $saved_token = User::retrieveResetToken(Session::get('reset_password_email'));

    if ($saved_token == $_GET['reset_password_token']) {
        loadChangePasswordForm();
    } else {
        loadForgotPasswordForm("fail", "token-expired");
    }
} else {
    loadForgotPasswordForm();
}
