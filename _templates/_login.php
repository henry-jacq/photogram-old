<?php

$username = $_POST['email_address'];
$password = $_POST['password'];

$result = validate_credentials($username, $password);

if ($result) {

?>

<main class="container">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Login success</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>
</main>

<?php
} else {
?>

<form method="post" action="">
    <img class="logo" src="assets/brand/sna-logo-dark.png" alt=""><br><br>
    <div class="border-boxer">
        <h3 class="h4 mb-3">Login</h3>
        <div class=" form-floating mb-3">
            <input name="email_address" type="email" class="form-control" id="floatingInput"
                placeholder="Email address">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-2">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div><br>
        <button class="w-100 btn btn btn-primary hvr-float" type="submit">Log in</button>
        <br><br>
        <!-- <p>Don't have an account yet?</p> -->
        <button class="w-100 btn btn btn-secondary hvr-float" type="submit">Sign in</button>
    </div>
</form>

<?php
}