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
<main>
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
    </div>

</main>
<?php
}