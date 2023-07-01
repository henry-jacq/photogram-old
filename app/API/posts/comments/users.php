<?php

use App\Core\User;
use App\Core\Session;
use App\Model\Comment;

// https://{{domain}}/api/posts/comments/users

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() && $this->get_request_method() == 'POST') {
        if ($this->paramsExists(['id'])) {
            $post_id = (int) $this->_request['id'];
            $comments = Comment::fetchComments($post_id);
            $sess_user = [
                "username" => Session::getUser()->getUsername(),
                "avatar" => User::getAvatarById(Session::getUser()->getId())
            ];

            if ($comments) {
                foreach ($comments as &$comment) {
                    $uid = $comment['user_id'];
                    $comment['username'] = User::getUsernameById($uid);
                    $comment['fullname'] = User::getFullnameByUsername(User::getUsernameById($uid));
                    $comment['avatar'] = User::getAvatarById($uid);
                    unset($comment['user_id']);
                    if (Session::getUser()->getUsername() != $comment['username']) {
                        unset($comment['comment_id']);
                    }
                }

                $message = empty($comments) || is_null($comments) ? false : true;

                $this->response($this->json([
                    'message' => $message,
                    "owner" => $sess_user,
                    'comments' => array("users" => $comments)
                ]), 200);
            } else {
                $this->response($this->json([
                    'message' => true,
                    "owner" => $sess_user,
                    'comments' => array("users" => false)
                ]), 200);
            }
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
