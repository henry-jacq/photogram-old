<?php

// Reset user password
// https://{{domain}}/api/auth/reset-password

use App\Core\Mailer;
use App\Core\Session;
use App\Core\Auth;

${basename(__FILE__, '.php')} = function () {
    if (!$this->isAuthenticated() && $this->paramsExists(['reset_email'])) {
        $mail_to = $this->_request['reset_email'];
        if (Mailer::mailExists($mail_to)) {
            $link = Mailer::sendPasswordResetMail($mail_to);
            if (isset($link)) {
                $this->response($this->json([
                    'message'=>'Mail sent!',
                    'link'=>$link,
                    'status'=>'Success'
                ]), 200);
            } else {
                $this->response($this->json([
                    'message'=>'Mailer error!',
                    'link'=>$link,
                    'status'=>'Failed'
                ]), 503);
            }
        } else {
            $this->response($this->json([
                'message'=>'Mail cannot be sent!',
                'status'=>'Failed'
            ]), 404);
        }
    } else if (!$this->isAuthenticated() && $this->paramsExists(['newPassword', 'confirmNewPassword'])) {
        $email = Session::get('reset_password_email');
        $new = $this->_request['newPassword'];
        $confirmNew = $this->_request['confirmNewPassword'];

        if (!empty($new) && !empty($confirmNew && $new === $confirmNew)) {
            if (Auth::changePassword($email, $new) && Auth::revokeResetToken($email)) {
                $this->response($this->json([
                    'message'=>'Password changed!',
                    'status'=>'Success'
                ]), 200);
            } else {
                $this->response($this->json([
                    'message'=>'Cannot change the password!',
                    'status'=>'Failed'
                ]), 500);
            }
        } else {
            $this->response($this->json([
                'message'=>"Password not matches"
            ]), 406);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad Request"
        ]), 400);
    }
};
