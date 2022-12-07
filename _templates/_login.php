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
        <!-- This will popup the alert -->
        <div id="alertbox" class="alert alert-warning fade show" role="alert">
            <strong>Warning!</strong><br> Invalid username or password.
            <span type="button" class="close" data-dismiss="alert">
                <ins class="mx-5"></ins><span>&times;</span>
        </div>
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