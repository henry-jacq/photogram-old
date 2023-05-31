<?php

use App\Core\Session;
use App\Model\UserData;

// https://{{domain}}/api/users/update

${basename(__FILE__, '.php')} = function () {
    if (isset($_POST)) {
        $ud = new UserData(Session::getUser());
        $post_fields = ['fname', 'lname', 'email', 'job', 'bio', 'location', 'twitter', 'instagram'];
        $data = [];

        foreach ($post_fields as $field) {
            if (isset($_POST[$field])) {
                $data[$field] = $_POST[$field];
            }
        }

        if (!$ud->exists()) {
            $ud->create($data['fname'], $data['lname'], $data['email'], $data['job'], $data['bio'], $data['location'], $data['twitter'], $data['instagram']);
            if (isset($_FILES) && $_FILES['user_image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $ud->setNewAvatar($_FILES['user_image']['tmp_name']);
            }
            $message = 'Created';
        } else {
            $ud->update($data['fname'], $data['lname'], $data['email'], $data['job'], $data['bio'], $data['location'], $data['twitter'], $data['instagram']);
            if (isset($_FILES) && $_FILES['user_image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $ud->setNewAvatar($_FILES['user_image']['tmp_name']);
            }
            $message = 'Updated';
        }
        $this->response($this->json([
            'message'=>$message
        ]), 200);
    } else {
        $this->response($this->json([
            'message'=>"Can't store user data"
        ]), 400);
    }
};