<?php

use app\core\User;

include 'libs/autoload.php';


try {
    User::changePassword('test@mail.com', 'testing');
} catch (Exception $e) {
    echo $e->getMessage();
}
