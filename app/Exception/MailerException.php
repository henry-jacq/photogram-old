<?php

namespace App\Exception;

use PHPMailer\PHPMailer\Exception;

// Mailer Exception Handler

class MailerException extends Exception
{
    protected $message = "Mail can't be sent!";
}
