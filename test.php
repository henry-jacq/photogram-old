<!-- <pre> -->
<?php
// include 'libs/load.php';

// if (signup("Henry", "xza-asdz-sda", "henry@selfmade.ninja", "1234567530")){
//     echo "success";
// } else {
//     echo "Fail";
// }

// if(isset($_POST['username']) and isset($_POST['password'])){
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $error = login($username, $password);
//     $login = true;
//     echo "got it";
// }
// echo $_POST['username'];
// echo "<br>";
// echo $_POST['password'];
// echo "<br>";

$username = $_POST['username'];
$password = $_POST['password'];
$server = "mysql.selfmade.ninja";
$serv_user = "Henry";
$serv_pass = "Syphn0tch#098";
$dbname = "Henry_testdb";
$table = "auth";

// Create connection
$conn = mysqli_connect($server, $serv_user, $serv_pass, $dbname) or die("Connection failed: " . $conn->connect_error);
// Check connection
if (!$conn->connect_error) {
    echo "Connected successfully to database<br>";
}

$sql = "SELECT * FROM `$table`";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);

if ($resultcheck > 0){
    while($row = mysqli_fetch_assoc($result)){
        // if($row['username'] == $username){
        //     echo "Username is correct";
        // } else {
        //     echo "Wrong username";
        //     continue;
        // }
        // if ($row['password'] == $password) {
        //     echo "Login success";
        // }
        // else {
        //     echo "Wrong password";
        //     continue;
        // }
        if($row['username'] == $username){
            if($row['password'] == $password){
                echo "Login successful";
            } else {
                echo "Wrong password";
            }
        } else {
            echo "Wrong username";
        }
        }
    $user = $row['username'];
    $pass = $row['password'];
    print_r ($row);
}

$conn->close();

?>
<!-- </pre> -->