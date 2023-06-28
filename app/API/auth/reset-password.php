<?php

// Reset user password
// https://{{domain}}/api/auth/reset-password

use App\Core\Mailer;
use App\Core\Session;
use App\Core\Auth;

${basename(__FILE__, '.php')} = function () {
    if (!$this->isAuthenticated() && $this->get_request_method() == 'POST') {
        if ($this->paramsExists(['reset_email'])) {
            $reset_email = $this->_request['reset_email'];
            if (Mailer::mailExists($reset_email)) {
                Session::set('reset_password_email', "$reset_email");
                $link = Mailer::sendPasswordResetMail($reset_email);
                if (isset($link) && !empty($link)) {
                    $this->response($this->json([
                        'message' => 'Mail sent!',
                        'status' => 'Success'
                    ]), 200);
                } else {
                    $this->response($this->json([
                        'message' => 'Mailer error!',
                        'link' => $link,
                        'status' => 'Failed'
                    ]), 503);
                }
            } else {
                // This is to prevent user enumeration attacks
                Session::set('reset_password_email', true);
                $this->response($this->json([
                    'message' => 'Mail sent!',
                    'status' => 'Success'
                ]), 200);
            }
        } else if ($this->paramsExists(['newPassword', 'confirmNewPassword'])) {
            $email = Session::get('reset_email');
            $new = $this->_request['newPassword'];
            $confirmNew = $this->_request['confirmNewPassword'];

            if (!empty($new) && !empty($confirmNew && $new === $confirmNew)) {
                if (Auth::changePassword($email, $new) && Auth::revokeResetCredentials($email)) {
                    Session::delete('reset_email');
                    Session::set('reset_success', true);
                    $this->response($this->json([
                        'message' => 'Password changed!',
                        'status' => 'Success'
                    ]), 200);
                } else {
                    $this->response($this->json([
                        'message' => 'Cannot change the password!',
                        'status' => 'Failed'
                    ]), 500);
                }
            } else {
                $this->response($this->json([
                    'message' => "Password not matches"
                ]), 406);
            }
        } else {
            $this->response($this->json([
                'message' => "Bad Request"
            ]), 400);
        }
    } else {
        $this->response($this->json([
            'message' => "Bad Request"
        ]), 400);
    }
};
