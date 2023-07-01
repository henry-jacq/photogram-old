<?php

use App\Core\User;
use App\Core\Session;
use App\Model\Comment;

// https://{{domain}}/api/posts/comments/create

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() && $this->get_request_method() == 'POST') {
        $user_id = Session::getUser()->getID();
        if ($this->paramsExists(['pid','comment'])) {
            // Do some checking here, like XSS
            $pid = (int) $this->_request['pid'];
            $comment = $this->_request['comment'];
            $username = Session::getUser()->getUsername();
            $fullname = Session::getUser()->getFullname();
            $user_avatar = User::getAvatarById($user_id);

            if (strlen($comment) < 42) { 
                $this->response($this->json([
                    'message' => true,
                    'username' => $username,
                    'fullname' => $fullname,
                    'avatar' => $user_avatar,
                    'comment_id' => Comment::postComment($pid, $comment)
                ]), 200);
            } else {
                $this->response($this->json([
                    'message' => "Not Acceptable"
                ]), 406);
            }
        } else if ($this->paramsExists(['user_profile'])) {
            $this->response($this->json([
                'avatar' => User::getAvatarById($user_id)
            ]), 200);
        } else {
            $this->response($this->json([
                'message' => "Not Acceptable"
            ]), 406);
        }
    } else {
        $this->response($this->json([
            'message' => "Bad Request"
        ]), 400);
    }
};
