<?php

$signup = false;

// This set of code will only run if the user has to properly submit the form
if(isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email_address']) and isset($_POST['phone'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone'];
    $result = signup($username, $password, $email, $phone);
    $signup = true;
}

?>

<main>
    <?php
    if ($signup) {
        if ($result) {
            ?>
    <main class="container">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Sign up Success</h1>
                <p class="lead">Now you can login from <a href="/login-page/login.php">here</a>.</p>
            </div>
        </div>
    </main>
    <?
        } else {?>
    <main class="container">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Sign up Failed</h1>
                <p class="lead">Something went wrong.</p>
            </div>
        </div>
    </main>
    <?}
    } else {?>
    <form method="post" action="signup.php">
        <img class="logo" src="assets/brand/sna-logo-dark.png" alt=""><br><br>
        <?load_template('_formup');?>
    </form>
</main>
<?}?>