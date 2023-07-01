<?php

use App\Model\Comment;

// https://{{domain}}/api/posts/comments/delete

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() && $this->get_request_method() == 'POST') {
        if ($this->paramsExists(['comment_id'])) {
            // Do some checking here, like XSS
            $cid = $this->_request['comment_id'];

            $this->response($this->json([
                'message' => Comment::deleteComment($cid)
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
