<?php

use App\Core\Session;
use App\Model\UserData;

// Delete user avatar
// https://{{domain}}/api/users/profile/delete

${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated()) {
        try {
            $ud = new UserData(Session::getUser());

            $this->response($this->json([
                'message' => $ud->deleteAvatarImage()
            ]), 200);
        } catch (\Exception $e) {
            $this->response($this->json([
                'message' => $e->getMessage()
            ]), 406);
        }
    } else {
        $this->response($this->json([
            'message' => "Bad request"
        ]), 400);
    }
};