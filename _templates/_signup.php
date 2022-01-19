<?php

$signup = false;

if(isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email_address']) and isset($_POST['phone'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone'];
    $error = signup($username, $password, $email, $phone);
    $signup = true;
}

?>

<main>
    <?php
    if ($signup) {
        if (!$error) {
            ?>
    <main class="container">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Sign up Success</h1>
                <p class="lead">Now you can login from<a href="/login-page/login.php">here</a>.</p>
            </div>
        </div>
    </main>
    <?
        } else {?>
    <main class="container">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Sign up Failed</h1>
                <p class="lead">Something went wrong. <?=$error?></p>
            </div>
        </div>
    </main>
    <?}
    } else {?>
    <form method="post" action="signup.php">
        <img class="logo" src="assets/brand/sna-logo-dark.png" alt=""><br><br>
        <div class="border-boxer">
            <h4 class="blockquote">Sign up</h4>
            <div class="form-group mb-1">
                <label class="label-bold mb-2" for="new_user_username">Username</label>
                <input name="username" class="form-control" type="text">
            </div>
            <div class="form-group mb-1">
                <label class="label-bold mb-1" for="new_user_password">Password</label>
                <input name="password" class="form-control" type="password">
            </div>
            <div class="form-group mb-1">
                <label class="label-bold mb-2" for="new_user_email">Email</label>
                <input name="email_address" class="form-control" type="text">
            </div>
            <div class="form-group mb-1">
                <label class="label-bold mb-2" for="new_user_number">Phone Number</label>
                <input name="phone" class="form-control" type="text">
            </div>
            <br>
            <button class="w-100 btn btn btn-primary hvr-float" type="submit">Sign up</button>
        </div>
    </form>
</main>
<?}?>