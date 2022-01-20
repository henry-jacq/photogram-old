<?php

$login = false;

if(isset($_POST['username']) and isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error = login($username, $password);
    $login = true;
}

if ($result) {
    load_main_page('index');
} else {
?>
<main>
    <form method="post" action="/login-page/test.php">
        <img class="logo" src="assets/brand/sna-logo-dark.png" alt=""><br><br>
        <div class="border-boxer">
            <h4 class="blockquote">Login</h4>
            <div class="form-group mb-1">
                <label class="mb-2">Username or email</label>
                <input name="username" type="text" class="form-control">
            </div>
            <div class="form-group mb-2">
                <label class="mb-2">Password</label>
                <input name="password" type="password" class="form-control">
            </div>
            <div class="row">
                <label class="col-sm-6">
                    <input type="checkbox" class="form-check-input" value="0">
                    <span>Remember me</span>
                </label>
                <div class="col-sm-6">
                    <a href=""> Forgot password?</a>
                </div>
            </div>
            <br>
            <button class="w-100 btn btn btn-primary hvr-float" type="submit">Log in</button>
    </form>
    </div>

</main>
<?php
}