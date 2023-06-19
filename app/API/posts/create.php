<?php

use App\Model\Post;

// https://{{domain}}/api/posts/create

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() and isset($_FILES['file'])) {
        if (!empty($_FILES['file'] and isset($_FILES['file']))) {
            $postImage = $_FILES['file'];
            $postText = $_POST['post_text'] ?? '';
            $this->response($this->json([
                'message'=>Post::createPost($postImage, $postText)
            ]), 200);
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