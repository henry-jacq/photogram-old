<?php

use App\Core\Auth;

${basename(__FILE__, '.php')} = function () {
    if (!$this->isAuthenticated() && $this->get_request_method() == 'POST') {
        if ($this->paramsExists(['fullname', 'username', 'email_address', 'password'])) {
            $email = filter_var($this->_request['email_address'], FILTER_SANITIZE_EMAIL);
            $ud = array(
                "fullname" => filter_var($this->_request['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                "username" => filter_var($this->_request['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                "password" => filter_var($this->_request['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                "email_address" => filter_var($email, FILTER_VALIDATE_EMAIL)
            );

            foreach($ud as $key => $value) {
                if ($key != 'password' && strlen($value) >= 32) {
                    $this->response($this->json([
                        'message' => 'Not Acceptable',
                        'result' => false
                    ]), 406);
                    exit;
                }
            }
            
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
                'message' => 'Not Acceptable',
                'result' => false
            ]), 406);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad Request"
        ]), 400);
    }
};
