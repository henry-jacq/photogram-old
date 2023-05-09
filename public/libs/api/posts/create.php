<?php

use app\models\Post;

// https://{{domain}}/api/posts/create

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() and isset($_FILES['file'])) {
        if (empty($_FILES['file'])) {
            $this->response($this->json([
                'message'=>"Image doesn't exist"
            ]), 400);
        } else {
            $image_tmp = $_FILES['file']['tmp_name'];
            $text = $_POST['post_text'];
            $this->response($this->json([
                'message'=>Post::registerPost($image_tmp, $text)
            ]), 200);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad request"
        ]), 400);
    }
};