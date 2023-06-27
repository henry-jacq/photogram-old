<?php

use App\Core\Auth;
use App\Core\View;
use App\Core\Session;

if (isset($_GET['reset_password_token']) and !empty($_GET['reset_password_token'])) {
    $saved_token = Auth::retrieveResetToken(Session::get('reset_email'));

    if ($saved_token == $_GET['reset_password_token']) {
        View::renderTemplate('templates/auth/change-password');
    } else {
        View::loadErrorPage();
    }
} else {
    View::renderTemplate('templates/auth/reset-password');
}
