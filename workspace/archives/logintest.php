<?php

include 'autoload/load.php';

// Username and password already exist in database
$username = "tonystark";
$password = "ironman";
// $password = isset($_GET['pass']);

$result = null;

// Destroy the session if key logout is passed in _GET Request
if (isset($_GET['logout'])) {
    if (Session::isset('session_token')) {

        if (UserSession::removeSession(Session::get('session_token'))){
            echo "<br>Removing previous session from database.<br>";
        } else {
            echo "<br>Cannot remove previous session from database.<br>";
        }
    }

    Session::destroy();
    die("Session destroyed !\n<a href='logintest.php'>Login again</a>");
}

// check session token is available or not
if (Session::isset('session_token')) {
 
    if (UserSession::authorize(Session::get('session_token'))) {
        $userobj = new User($username);

        echo "<br>Login success, welcome back " . $userobj->getUsername() . "<br>";

        echo $userobj->getFirstname() . "'s Bio: " . $userobj->getBio();

        $older_bio = $userobj->getBio();
        $new_bio = "I am using arch BTW";

        if ($older_bio !== $new_bio) {
            echo "<br>Setting new bio for " . $userobj->getFirstname();
            // print("<br>Older Bio: " . $userobj->getBio());
            $userobj->setBio("$new_bio");
            print("<br>New Bio: " . $userobj->getBio());
            echo "<br>Reload to take effect.<br>";
        }

    } else {
        Session::destroy();
        echo "<br>Invalid session, <a href='logintest.php'>Login Again</a><br>";
    }
} else {
    printf("No session found, trying to logging now !\n");

    // It will generate a token and store in session_token and database 
    $token = UserSession::authenticate($username, $password);

    if ($token) {
        // $session_token = Session::get('session_token');
        // echo "<br>Your Generated token: $token<br>";
        
        echo "Login Success, welcome $username";

        // $usersesobj = new UserSession($result->token);
        // echo "<br>This is the user ID: $usersesobj->id<br>";
        // echo "<br>Success, Logged in as ".$usersesobj->getUsername();
        // Session::set('is_loggedin', true);
        // Session::set('session_username', $result);
    } else {
        echo "Token is not available or invalid.<br>";
        echo "Login failed!";
    }
}

echo <<<EOL
<br><br><a href='logintest.php?logout'>Log out</a>
EOL;
