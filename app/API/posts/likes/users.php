<?php

use App\Core\User;
use App\Model\Like;

// https://{{domain}}/api/posts/likes/users

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() && $this->get_request_method() == 'POST') {
        if ($this->paramsExists(['id'])) {
            $post_id = $this->_request['id'];
            $liked_users = Like::getLikedPostUsers($post_id);

            foreach($liked_users as $user_id) {
                $username_list[] = User::getUsernameById($user_id);
                $user_avatar[] = User::getAvatarById($user_id);
            }

            foreach ($username_list as $username) {
                $fullname_list[] = User::getFullnameByUsername($username);
            }

            foreach ($username_list as $index => $username) {
                $fullname = $fullname_list[$index];
                $avatar = $user_avatar[$index];

                $users[$index] = [
                    "username" => $username,
                    "fullname" => $fullname,
                    "avatar" => $avatar
                ];
            }

            $message = empty($users) || is_null($users) ? false : true;

            $this->response($this->json([
                'message' => $message,
                'users' => $users
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
