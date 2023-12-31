<?php

use App\Core\Session;
use App\Model\Post;

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
                'message' => 'Method Not Allowed'
            ]), 405);
        }
    } else {
        $this->response($this->json([
            'message' => "Bad Request"
        ]), 400);
    }
};