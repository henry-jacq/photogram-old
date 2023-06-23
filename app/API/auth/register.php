<?php

use App\Core\Auth;

${basename(__FILE__, '.php')} = function () {
    if (!$this->isAuthenticated() && $this->paramsExists(['fullname', 'username', 'email_address', 'password'])) {
        $email = filter_var($this->_request['email_address'], FILTER_SANITIZE_EMAIL);
        $ud = array(
            "fullname" => filter_var($this->_request['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "username" => filter_var($this->_request['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "password" => filter_var($this->_request['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "email_address" => filter_var($email, FILTER_VALIDATE_EMAIL)
        );
        
        $result = Auth::register($ud['username'], $ud['fullname'], $ud['email_address'], $ud['password']);
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
