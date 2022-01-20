<?

// connection information for the database
$server = "mysql.selfmade.ninja";
$serv_user = "Henry";
$serv_pass = "Syphn0tch#098";
$dbname = "Henry_testdb";
$table = "auth";

function signup($username, $password, $email, $phone){
    
    global $server, $serv_user, $serv_pass, $dbname, $table;

    // To establish connection to the mysql database
    $conn = new mysqli($server, $serv_user, $serv_pass, $dbname);

    // Check if the connection alive or not
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert values into the database
    $sql_cmd = "INSERT INTO `$table` (`username`, `password`, `email`, `phone`, `active`, `blocked`)
    VALUES ('$username', '$password', '$email', '$phone', '0', '1');";
    
    $error = false;
    if($conn->query($sql_cmd) === true) {
        $error = false;
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        $error = $conn->error;
    }

    return $error;
    $conn->close();
}

function login($username, $password){
    global $server, $serv_user, $serv_pass, $dbname, $table;

    // Create connection
    $conn = new mysqli($server, $serv_user, $serv_pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $sql_cmd = "SELECT * FROM `$table` LIMIT 50";
   
    $result = $conn->query($sql_cmd);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["username"];
        echo $row["password"];
    }
    } else {
        echo "0 results";
    }
    $conn->close();

    // Check insertion
    // if ($conn->connect_error) {
    //     die("Data not inserted: " . $conn->connect_error);
    // }
    // $error = false;
    // if($conn->query($sql) === true) {
    //     $error = false;
    // } else {
    //     // echo "Error: " . $sql . "<br>" . $conn->error;
    //     $error = $conn->error;
    // }

    // return $error;
    // $conn->close();

}

function user_avail($username, $password){
    global $server, $serv_user, $serv_pass, $dbname, $table;

    // Create connection
    $conn = new mysqli($server, $serv_user, $serv_pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $sql_cmd = "SELECT * FROM `$table` LIMIT 50";
   
    $result = $conn->query($sql_cmd);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> username: " . $row["username"];
    }
    } else {
        echo "0 results";
    }
    $conn->close();
}