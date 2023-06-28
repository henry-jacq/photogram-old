<?php

use App\Model\Post;
use App\Model\Like;

// https://{{domain}}/api/posts/like

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() && $this->get_request_method() == 'POST') {
        if ($this->paramsExists(['id'])) {
            $post = new Post($this->_request['id']);
            $like = new Like($post);
            $like->toggleLike();
            $this->response($this->json([
                'message'=>$like->isLiked()
            ]), 200);
        } else {
            $this->response($this->json([
                'message' => "Not Acceptable"
            ]), 406);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad Request"
        ]), 400);
    }
};
