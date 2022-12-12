<pre>
<?
// Starting the session
session_start();

// setcookie("Testcookie", "TestValue", time() + (86400 * 30), "/");

print_r($_SESSION);

$s = ['apple'=> 'juice', 'one'=>'number'];

print_r($s);

if(isset($_SESSION['a'])){
    printf("A is already exists and A = $_SESSION[a]\n");
} else {
    $_SESSION['a'] = time();
    printf("Assigning new value.. Value = $_SESSION[a]\n");
}


?></pre>