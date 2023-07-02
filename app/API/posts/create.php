<?php

use App\Model\Post;

// https://{{domain}}/api/posts/create

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated()&& $this->get_request_method() == 'POST') {
        if (isset($_FILES['file']) && !empty($_FILES['file'])) {
            $postImage = $_FILES['file'];
            $postText = $this->_request['post_text'] ?? '';
            if (Post::createPost($postImage, $postText) == null) {
                $this->response($this->json([
                    'message' => true
                ]), 200);
            } else {
                $this->response($this->json([
                    'message' => 'Cannot create post!'
                ]), 500);
            }
        } else {
            $this->response($this->json([
                'message'=> "Not Acceptable"
            ]), 406);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad Request"
        ]), 400);
    }
};