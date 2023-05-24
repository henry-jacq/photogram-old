<?php

use App\Model\Post;

// https://{{domain}}/api/posts/delete

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() and $this->paramsExists(['id'])) {
        if (!empty($this->_request['id'])) {
            $p = new Post($this->_request['id']);
            if ($p->hasMultipleImages($this->_request['id'])) {
                $this->response($this->json([
                    'message'=>$p->deleteMultiplePostImages()
                ]), 200);
            } else {
                $this->response($this->json([
                    'message'=>$p->deleteSinglePostImage()
                ]), 200);
            }
        } else {
            $this->response($this->json([
                'message'=>"ID doesn't exist"
            ]), 400);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad request"
        ]), 400);
    }
};
