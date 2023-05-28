<?php

use App\Core\Session;
use App\Model\UserData;

// https://{{domain}}/api/users/update

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated()) {
        if (!empty($_POST and isset($_POST))) {
            $ud = new UserData(Session::getUser());
            $fields = ['fname', 'lname', 'email', 'job', 'bio', 'location', 'twitter', 'instagram'];
            $data = [];

            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    $data[$field] = $_POST[$field];
                }
            }

            if (!$ud->exists()) {
                $ud->create($data['fname'], $data['lname'], $data['email'], $data['job'], $data['bio'], $data['location'], $data['twitter'], $data['instagram']);
                $this->response($this->json([
                    'message'=>'Created'
                ]), 200);
            } else {
                $ud->update($data['fname'], $data['lname'], $data['email'], $data['job'], $data['bio'], $data['location'], $data['twitter'], $data['instagram']);
                $this->response($this->json([
                    'message'=>'Updated'
                ]), 200);
            }
        } else {
            $this->response($this->json([
                'message'=>"Can't store user data"
            ]), 400);
        }
    } else {
        $this->response($this->json([
            'message'=>"Bad request"
        ]), 400);
    }
};