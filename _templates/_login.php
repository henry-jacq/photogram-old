<?php

$login = false;

// This set of code will only run if the user has submitted the form
if(isset($_POST['username']) and !empty($_POST['username']) and isset($_POST['password']) and !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = User::login($username, $password);
    $login = true;
}

if ($login) {
    if ($result) { ?>
<main class="container">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Login Success</h1>
            <p class="lead">Enjoy :-)</p>
        </div>
    </div>
</main>
<?php
} else {
?>

<main class="login-box">
    <!-- login form -->
    <form method="post" action="">
        <img class="logo" src="assets/brand/sna-logo-dark.png" alt=""><br><br>
        <div class="border-boxer">
            <div class="form-group mb-3">
                <label class="mb-2">Username or email</label>
                <input type="email" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="mb-2">Password</label>
                <input type="password" class="form-control">
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
            <button class="w-100 btn btn btn-primary hvr-float" type="submit">Login</button>
    </form>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
document.addEventListener('DOMContentLoaded', () => {
    $('.alert').alert()
})
</script>
<?
}
} else {?>

<main class="login-box">
    <!-- login form -->
    <form method="post" action="">
        <img class="logo" src="assets/brand/sna-logo-dark.png" alt=""><br><br>
        <?load_template('_formin');?>
    </form>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
document.addEventListener('DOMContentLoaded', () => {
    $('.alert').alert()
})
</script>

<?php
}?>