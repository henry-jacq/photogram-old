<?php

use app\core\User;
use app\core\Mailer;
use app\core\Session;

require_once 'auth-templates.php';

if (!empty($_POST['newPassword']) and !empty($_POST['confirmNewPassword'])) {
    if ($_POST['newPassword'] === $_POST['confirmNewPassword']) {
        $email = Session::get('reset_password_email');
        $password = $_POST['newPassword'];
        if (User::changePassword($email, $password)) {
            loadChangePasswordForm("success");
            die();
        } else {
            loadChangePasswordForm("fail");
            die();
        }
    }
}

if (isset($_POST['email']) and !empty($_POST['email'])) {
    $email = $_POST['email'];
    $result = Mailer::mailExists($email);

    if ($result) {
        try {
            $first_name = ucfirst(User::getFirstName($email));
            if ($first_name) {
                // Initialize mailer instance
                $mailer = new Mailer();

                $mailer->addRecipient($email);
                $mailer->addSubject("[Photogram] Reset your password!");
                $reset_link = User::createResetPasswordLink($email);
                $html = loadPasswordResetMailBody($first_name, $reset_link);
                $mailer->isHTML(true);
                $mailer->addBody($html);
                $mailer->sendMail();
            }
        } catch (Exception $e) {
            echo "Mailer Error: {$e->getMessage()}";
        }
        loadForgotPasswordForm("success", "mail-sent");
    } else {
        loadForgotPasswordForm("fail", "invalid-email");
    }
} elseif (isset($_GET['reset_password_token']) and !empty($_GET['reset_password_token'])) {
    $saved_token = User::retrieveResetToken(Session::get('reset_password_email'));

    if ($saved_token == $_GET['reset_password_token']) {
        loadChangePasswordForm();
    } else {
        loadForgotPasswordForm("fail", "invalid-token");
    }
} else {
    loadForgotPasswordForm();
}
