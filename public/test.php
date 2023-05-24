<?php

use App\Core\User;

include 'libs/autoload.php';


try {
    User::changePassword('test@mail.com', 'testing');
} catch (Exception $e) {
    echo $e->getMessage();
}
