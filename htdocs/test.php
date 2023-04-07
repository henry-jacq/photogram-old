<?php

use libs\core\Mailer;

include 'libs/autoload.php';


$html = "
<div style='line-height:1.5rem; margin-bottom:10px;'>
<b>Hi Henry,</b><br>
We received a request to reset the password for your Photogram account. If you didn't request this, please ignore this email.<br>
If you did request it, please click on this link to reset your password: <a href='#'>Reset password</a><br>
If you have any questions or concerns, feel free to reach out to us.
</div>
Best regards,<br>
<b>Photogram Team</b>
";


$mailer = new Mailer();

$mailer->addRecipient('');
$mailer->addSubject('Security alert');
$mailer->isHTML(true);
$mailer->addBody($html);

try {
    $mailer->sendMail();
    echo "Mail sent successfully! /n/n";
} catch (Exception $e) {
    echo $e->getMessage();
}
//try {
//    User::setNewPassword("", "");
//    echo "Password Updated Successfully";
//} catch (Exception $e) {
//    echo $e->getMessage();
//}
