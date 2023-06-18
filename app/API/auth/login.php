<?php

use App\Core\Session;
use App\Core\UserSession;

${basename(__FILE__, '.php')} = function () {
    if (!$this->isAuthenticated() && $this->paramsExists(['user', 'pass'])) {
        $user = $this->_request['user'];
        $password = $this->_request['pass'];
        $fg = isset($_COOKIE['fingerprint']) ? $_COOKIE['fingerprint'] : null;
        $token = UserSession::authenticate($user, $password, $fg);
        if($token) {
            $should_redirect = Session::get('_redirect');
            $redirect_to = URL_ROOT;
            if (isset($should_redirect)) {
                $redirect_to = $should_redirect;
                Session::set('_redirect', false);
            }
            $this->response($this->json([
                'message' => 'Authenticated',
                'token' => $token,
                'redirect' => $redirect_to
            ]), 202);
        } else {
            $this->response($this->json([
                'message' => 'Unauthorized',
                'token' => $token
            ]), 401);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad Request"
        ]), 400);
    }
};
