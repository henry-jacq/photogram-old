<?php

// Try to register, if the user has submitted the form
if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email_address']) and isset($_POST['phone'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone'];
    $result = User::signup($username, $password, $email, $phone);
    $signup = true;
} else {
    $signup = false;
}

// If user submitted the form
if ($signup) {
    // Sign up success, if result has no error
    if (!$result) { ?>
<div class="text-bg-dark rounded-3 p-5 mt-4 text-center">
    <h1 class="display-4">Welcome to Photogram</h1>
    <p class="lead mb-4">Your account has been created.</p>
    <a class="text-decoration-none" href="login.php">
        <button class="btn btn-success">Continue</button>
    </a>
</div>

<?php
    // If any error, load the same page with popup error
    } else { ?>

<div class="col-md-4 ">
    <!-- This will popup the alert -->
    <div id="popup-error" class="alert text-tomato alert-dismissible fade show" role="alert">
        <strong>Signup Failed!</strong><br>Username is not available.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="box shadow p-5 rounded">
        <!-- Load Sign up form -->
        <?php load_template('_formup'); ?>
    </div>
</div>

<?php }
    // If the user doesn't submit the form, load the same page
} else { ?>

<div class="col-md-4 ">
    <div class="box shadow p-5 rounded">
        <!-- Load Sign up form -->
        <?php load_template('_formup'); ?>
    </div>
</div>

<?php } ?>