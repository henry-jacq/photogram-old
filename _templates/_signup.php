<?php

$signup = false;

// This set of code will only run if the user has submitted the form
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
        if (!$result) {
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
    <!-- <main class="container">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Sign up Failed</h1>
                <p class="lead">Something went wrong. <?=$result?></p>
            </div>
        </div>
    </main> -->
    <!-- This will popup the alert -->
    <main class="signup-box">
        <form method="post" action="signup.php">
            <img class="logo" src="assets/brand/sna-logo-dark.png" alt=""><br><br>
            <div id="alertbox" class="alert alert-warning fade show" role="alert">
                <strong>Sign up Failed</strong><br> Invalid username or password.
                <span type="button" class="close" data-dismiss="alert">
                    <ins class="mx-5"></ins><span>&times;</span>
            </div>
            <?load_template('_formup');?>
        </form>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous">
        document.addEventListener('DOMContentLoaded', () => {
            $('.alert').alert()
        })
        </script>
    </main>

    <?}
    } else {?>
    <main>
        <form method="post" action="signup.php">
            <img class="logo" src="assets/brand/sna-logo-dark.png" alt=""><br><br>
            <?load_template('_formup');?>
        </form>
    </main>
    <?}?>