<?php

$login = false;

// This set of code will only run if the user has submitted the form
if (isset($_POST['username']) and !empty($_POST['username']) and isset($_POST['password']) and !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = User::login($username, $password);
    $login = true;
}

// If user submitted the form
if ($login) {
    // Print success, if the result has no error
    if ($result) { ?>
<div class="text-bg-none text-light mt-4">
    <h1 class="display-4">Login Success</h1>
    <p class="lead">Enjoy :-)</p>
</div>

<?php } // If any error, load the same page with error popup
    else { ?>

<main>
    <!-- This will popup the alert -->
    <div id="alertbox" class="alert text-tomato alert-dismissible fade show" role="alert">
        <strong>Login Failed!</strong><br>Invalid username or password.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Load Login form -->
    <?php load_template('_formin'); ?>
</main>

<?php } // If the user doesn't submit the form, load the same page
} else { ?>

<!-- Load Login form -->
<?php load_template('_formin'); ?>

<?php } ?>