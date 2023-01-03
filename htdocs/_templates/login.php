<?php

// Try to login, if the user has submitted the form
if (isset($_POST['username_or_email']) and !empty($_POST['username_or_email']) and isset($_POST['password']) and !empty($_POST['password'])) {
    $user_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];
    $result = UserSession::authenticate($user_or_email, $password);
    $login = true;
} else {
    $login = false;
}

// If user submitted the form
if ($login) {
    // Load the base path, if result has no error
    if ($result) { 

        // Save username or email in session
        Session::set('session_UsernameOrEmail', $_POST['username_or_email']); ?>

        <script>window.location.href = "<?=get_config('base_path')?>"</script>
    <?
    // If any error, load the same page with popup error
    } else { ?>

    <section class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <div class="col-md-4">
                <!-- This will popup the alert -->
                <div id="popup-error" class="alert text-tomato alert-dismissible fade show" role="alert">
                    <strong>Login Failed!</strong><br>Invalid username or password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="box shadow p-5 rounded">
                    <? // Load Login form
                    load_template('_formin'); ?>
                </div>
            </div>
        </div>
    </section>

<? }
// If the user doesn't submit the form, load the same page
} else { ?>
<section class="container">
    <div class="row content d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="box shadow p-5 rounded">
                <? // Load Login form
                load_template('_formin'); ?>
            </div>
        </div>
    </div>
</section>

<? } ?>