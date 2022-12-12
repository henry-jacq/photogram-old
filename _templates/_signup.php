<?php

$signup = false;

// This set of code will only run if the user has submitted the form
if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email_address']) and isset($_POST['phone'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone'];
    $result = User::signup($username, $password, $email, $phone);
    $signup = true;
}

// If user submitted the form
if ($signup) {
    // Print success, if the result has no error
    if (!$result) { ?>
<div class="text-bg-none text-light mt-4">
    <h1 class="display-4">Sign up Success</h1>
    <p class="lead">Now you can login from <a class="text-decoration-none" href="/photogram/login.php">here</a>.</p>
</div>
<?php
    // If any error, load the same page with error popup
    } else { ?>

<main>
    <!-- This will popup the alert -->
    <div id="alertbox" class="alert text-tomato alert-dismissible fade show" role="alert">
        <strong>Signup Failed!</strong><br>Username is not available.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Load Sign up form -->
    <?php load_template('_formup'); ?>
</main>

<?php }
    // If the user doesn't submit the form, load the same page
} else { ?>

<!-- Load Sign up form -->
<?php load_template('_formup'); ?>

<?php } ?>