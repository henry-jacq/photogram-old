<?php

use App\Core\User;

${basename(__FILE__, '.php')} = function () {
    if ($this->paramsExists(['username', 'email_address', 'password'])) {
        $username = $this->_request['username'];
        $email = $this->_request['email_address'];
        $password = $this->_request['password'];

        $result = User::register($username, $password, $email);
        if($result) {
            $this->response($this->json([
                'message'=>'Successfully Signed Up',
                'result' => $result
            ]), 200);
        } else {
            $this->response($this->json([
                'message'=>'Something went wrong',
                'result' => $result
            ]), 400);
        }

    } else {
        $this->response($this->json([
            'message'=>"bad request"
        ]), 400);
    }
};
