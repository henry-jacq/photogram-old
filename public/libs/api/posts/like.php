<?php

use app\models\Post;
use app\models\Like;

// https://{{domain}}/api/posts/like

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated()) {
        if ($this->paramsExists(['id'])) {
            $post = new Post($this->_request['id']);
            $like = new Like($post);
            $like->toggleLike();
            $this->response($this->json([
                'message'=>$like->isLiked()
            ]), 200);
        }
        if ($this->paramsExists(['postID'])) {
            $post_id = $this->_request['postID'];
            $this->response($this->json([
                'message'=>Like::isUserLiked($post_id)
            ]), 200);
        }
    } else {
        $this->response($this->json([
            'message'=>"bad request"
        ]), 400);
    }
};
