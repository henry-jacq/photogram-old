<?php

use app\core\Session;
use app\models\Post;

// Count posts
// https://{{domain}}/api/posts/count?mode={all|user}

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated()) {
        if ($_GET['mode'] == "all") {
            $this->response($this->json(Post::countAllPosts()[0]), 200);
        } elseif ($_GET['mode'] == "user") {
            $this->response($this->json(Post::countUserPosts(Session::getUser()->getUsername())[0]), 200);
        } else {
            $this->response($this->json([
                'message' => 'Provide proper params to fetch posts'
            ]), 400);
        }
    } else {
        $this->response($this->json([
            'message' => "Bad request"
        ]), 400);
    }
};