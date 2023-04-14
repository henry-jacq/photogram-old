<?php

namespace app\exceptions;

use PHPMailer\PHPMailer\Exception;

// Mailer Exception Handler

class MailerException extends Exception
{
    protected $message = "Mail can't be sent!";
}
