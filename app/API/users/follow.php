<?php

use App\Core\Session;
use App\Model\Follow;

// Follow user
// https://{{domain}}/api/users/follow

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() && $this->get_request_method() == 'POST') {
        if ($this->paramsExists(['follower_id'])) {
            $uid = Session::getUser()->getId();
            $f = new Follow($uid, $this->_request['follower_id']);
            $f->toggleFollow();
            $this->response($this->json([
                'following' => $f->isFollowing()
            ]), 200);
        }
    } else {
        $this->response($this->json([
            'message' => "Bad Request"
        ]), 400);
    }
};
