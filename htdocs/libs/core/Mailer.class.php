<?php

// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Mailer - PHPMailer wrapper for sending emails
 *
 * @author Henry <henryeditz267@gmail.com>
 */

class Mailer
{
    public $mailer;
    public $senderName = "Photogram";
    public $SMTPHost = "";
    public $SMTPPort = 587;
    public $fromAddress = "noreply@photogram.com";
    public $SMTPAuthUser = "";
    public $SMTPAuthPass = "";

    public function __construct()
    {
        // Initialize PHPMailer with enabled exceptions.
        $this->mailer = new PHPMailer(true);

        // SMTP Server settings
        // Enable verbose debug output
        // $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mailer->isSMTP();
        $this->mailer->Host       = $this->SMTPHost;
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = $this->SMTPAuthUser;
        $this->mailer->Password   = $this->SMTPAuthPass;
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port       = $this->SMTPPort;

        $this->mailer->setFrom($this->fromAddress, $this->senderName);
    }

    public static function mailExists(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM `auth` WHERE `email` = '$email'";

            // Create a connection to database
            $conn = Database::getConnection();
            $result = $conn->query($query);

            if ($result->num_rows) {
                $row = $result->fetch_assoc();
                if ($row['email']) {
                    return true;
                } else {
                    throw new \Exception("Email is not available");
                }
            } else {
                return false;
            }
        }
    }

    public function addSubject(string $subject)
    {
        $this->mailer->Subject = $subject;
    }

    public function isHTML(bool $isHTML)
    {
        $this->mailer->isHTML($isHTML);
    }

    public function addBody(string $body)
    {
        $this->mailer->Body = $body;
    }

    public function addAltBody(string $altBody)
    {
        $this->mailer->AltBody = $altBody;
    }

    public function addAttachment($attachment, $name = NULL)
    {
        $this->mailer->addAttachment($attachment, $name);
    }

    public function addRecipient(string $address, $name = NULL)
    {
        $this->mailer->addAddress($address, $name);
    }

    public function sendMail()
    {
        $this->mailer->send();
    }

    public function addCC(string $address)
    {
        $this->mailer->addCC($address);
    }

    public function addBCC(string $address)
    {
        $this->mailer->addBCC($address);
    }

    public function addReplyTo(string $address)
    {
        $this->mailer->addReplyTo($address);
    }
}
