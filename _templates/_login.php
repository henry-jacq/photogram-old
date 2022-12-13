<?php

// Try to login, if the user has submitted the form
if (isset($_POST['username']) and !empty($_POST['username']) and isset($_POST['password']) and !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = User::login($username, $password);
    $login = true;
} else {
    $login = false;
}

// If user submitted the form
if ($login) {
    // Login success, if result has no error
    if ($result) { ?>
<div class="text-bg-dark rounded-3 p-5 mt-4">
    <h1 class="display-4">Login Success</h1>
    <p class="lead">Enjoy :-)</p>
</div>

<?php
    // If any error, load the same page with popup error
    } else { ?>

<div class="col-md-4">
    <!-- This will popup the alert -->
    <div id="popup-error" class="alert text-tomato alert-dismissible fade show" role="alert">
        <strong>Login Failed!</strong><br>Invalid username or password.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="box shadow p-5 rounded">
        <!-- Load Login form -->
        <?php load_template('_formin'); ?>
    </div>
</div>

<?php }
    // If the user doesn't submit the form, load the same page
} else { ?>

<div class="col-md-4">
    <div class="box shadow p-5 rounded">
        <!-- Load Login form -->
        <?php load_template('_formin'); ?>
    </div>
</div>

<?php } ?>