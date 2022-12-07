<?

// This a fully a PHP based login system
// Refer - Day-20 Photogram login
// Create a new gitlab repo named ['photogram']
// So what to do ?
/**
 * Make login system and check the hashed password is correct or not
 * And try to make the login state persist in session
*/

include 'libs/load.php';

// Username and password exist in database
$username = "tonystark";
// $password = "ironman";
$password = isset($_GET['pass']);

$result = null;

// Destroy the session if key logout is passed in _GET Request
if(isset($_GET['logout'])){
    Session::destroy();
    die("Session destroyed !\n<a href='logintest.php'>Login again</a>");
}

if(Session::get('is_loggedin')){
    $userdata = Session::get('session_user');
    // echo "\n<br>User details: $userdata";
    // print_r($userdata);
    print("Welcome back, $userdata[username]");
} else {
    printf("No session found, trying to login now !\n");
    $result = User::login($username, $password);
    if($result){
        echo "<br>Success, Logged in as $result[username]";
        Session::set('is_loggedin', true);
        print_r(Session::set('session_user', $result));
    } else {
        echo "Login failed<br>";
    }
}

echo <<<EOL
<br><br><a href='logintest.php?logout'>Log out</a>
EOL;