<?
// connection information to connect database
$server = "";
$db_user = "";
$db_pass = "";
$dbname = "";
$table = "";

// Signup function
function signup($username, $password, $email, $phone){
    global $server, $db_user, $db_pass, $dbname, $table;

    // To establish connection to the mysql database
    $conn = mysqli_connect($server, $db_user, $db_pass, $dbname);

    // Check if the connection available or not
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert values into the database
    $sql = "INSERT INTO `$table` (`username`, `password`, `email`, `phone`, `active`, `blocked`)
    VALUES ('$username', '$password', '$email', '$phone', '0', '1');";
    
    // Sending the query to the database and checking if it is true or false
    if($conn->query($sql) === true) {
        $error = false;
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        $error = $conn->error;
    }

    return $error;
    $conn->close();
}

// login function
function login($username, $password){
    global $server, $db_user, $db_pass, $dbname, $table;

    // To establish connection to the mysql database
    $conn = mysqli_connect($server, $db_user, $db_pass, $dbname) or die("Connection failed: " . $conn->connect_error);
    
    // If connection fails, display error message
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql query for checking if the user is available or not
    $sql = "SELECT * FROM `$table` WHERE `username` = '".$username."' AND `password` = '".$password."' LIMIT 1";
    
    // Sending query to database if not print the error message
    $result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

    // Check if no of rows in query from database is equal to 1.
    // If query returns 1 row, then the user is found.
    if (mysqli_num_rows($result) == 1){
        return true;
    } else {
        return false;
    }

    $conn->close();
}