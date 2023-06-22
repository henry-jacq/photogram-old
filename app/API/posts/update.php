<?php

use App\Model\Post;

// https://{{domain}}/api/posts/update

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated()) {
        if ($this->paramsExists(['id', 'text'])) {
            $pid = (int) $this->_request['id'];
            $text = $this->_request['text'];
            $this->response($this->json([
                'message' => Post::updatePost($pid, $text)
            ]), 200);
        } else {
            $this->response($this->json([
                'message' => "Bad Request"
            ]), 400);
        }
    } else {
        $this->response($this->json([
            'message' => "Bad Request"
        ]), 400);
    }
};
