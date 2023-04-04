<?php

require_once 'auth-templates.php';

if (isset($_POST['email']) and !empty($_POST['email'])) {
    $email = $_POST['email'];
    $result = Mailer::mailExists($email);
    $fp = true;
} else {
    $fp = false;
}

if ($fp) {
    if ($result) {
        try {
            $html = loadPasswordResetMailBody();

            // Initialize mailer instance
            $mailer = new Mailer();

            $mailer->addRecipient($email);
            $mailer->isHTML(true);
            $mailer->addSubject("Security alert!");
            $mailer->addBody($html);
            $mailer->sendMail();
        } catch (Exception $e) {
            echo "Mailer Error: {$mailer->mailer->ErrorInfo}";
        }
        loadPasswordResetForm("success");
    } else {
        loadPasswordResetForm("fail");
    }
} else {
    loadPasswordResetForm();
}
