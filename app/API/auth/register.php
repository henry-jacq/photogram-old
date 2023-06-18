<?php

use App\Core\Auth;

${basename(__FILE__, '.php')} = function () {
    if (!$this->isAuthenticated() && $this->paramsExists(['username', 'email_address', 'password'])) {
        $email = filter_var($this->_request['email_address'], FILTER_SANITIZE_EMAIL);
        $userData = array(
            "username" => filter_var($this->_request['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "password" => filter_var($this->_request['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "email_address" => filter_var($email, FILTER_VALIDATE_EMAIL)
        );
        
        $result = Auth::register($userData['username'], $userData['password'], $userData['email_address']);
        if($result) {
            $this->response($this->json([
                'message'=>'Registered',
                'result' => true
            ]), 201);
        } else {
            $this->response($this->json([
                'message'=>'Cannot register your account',
                'result' => false
            ]), 409);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad Request"
        ]), 400);
    }
};
