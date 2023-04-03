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

    /**
     * Check if the mail exist in database or not
     */
    public static function mailExists(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM `auth` WHERE `email` = '$email'";

            // Create a connection to database
            $conn = Database::getConnection();

            // Get the user details [1 row] by sending this query to database.
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

    /**
     * The Subject of the message.
     */
    public function addSubject(string $subject)
    {
        $this->mailer->Subject = $subject;
    }

    /**
     * Sets message type to HTML or plain.
     */
    public function isHTML(bool $isHTML)
    {
        $this->mailer->isHTML($isHTML);
    }

    /**
     * An HTML or plain text message body.
     */
    public function addBody(string $body)
    {
        $this->mailer->Body = $body;
    }

    /**
     * The plain-text message body.
     * 
     * This body can be read by mail clients that do not have HTML email capability such as mutt & Eudora. Clients that can read HTML will view the normal Body.
     */
    public function addAltBody(string $altBody)
    {
        $this->mailer->AltBody = $altBody;
    }

    /**
     * Add an attachment from a path on the filesystem.
     */
    public function addAttachment($attachment, $name = NULL)
    {
        $this->mailer->addAttachment($attachment, $name);
    }

    /**
     * Add a "To" address.
     * 
     * true on success, false if address already used or invalid in some way
     */
    public function addRecipient(string $address, $name = NULL)
    {
        $this->mailer->setFrom($this->fromAddress, 'Photogram');
        $this->mailer->addAddress($address, $name);
    }

    /**
     * Create a message and send it.
     * 
     * @return bool — false on error - See the ErrorInfo property for details of the error
     * @throws Exception
     */
    public function sendMail()
    {
        $this->mailer->send();
    }

    /**
     * Add a "CC" address.
     */
    public function addCC(string $address)
    {
        $this->mailer->addCC($address);
    }

    /**
     * Add a "BCC" address.
     */
    public function addBCC(string $address)
    {
        $this->mailer->addBCC($address);
    }

    /**
     * Add a "Reply-To" address.
     */
    public function addReplyTo(string $address)
    {
        $this->mailer->addReplyTo($address);
    }
}
