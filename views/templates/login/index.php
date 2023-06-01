<?php

use App\Core\Session;
use App\Core\UserSession;
use App\Core\View;

// Try to login, if the user has submitted the form
if (isset($_POST['user']) and !empty($_POST['user']) and isset($_POST['pass']) and !empty($_POST['pass'])) {
    $user_or_email = $_POST['user'];
    $password = $_POST['pass'];
    $result = UserSession::authenticate($user_or_email, $password);
    $login = true;
} else {
    $login = false;
}

// If user submitted the form
if ($login) {
    // Load the base path, if result has no error
    if ($result) {
        $should_redirect = Session::get('_redirect');
        $redirect_to = URL_ROOT;
        if (isset($should_redirect)) {
            $redirect_to = $should_redirect;
            Session::set('_redirect', false);
        }

        // Save username or email in session
        Session::set('session_UsernameOrEmail', $_POST['user']); ?>

        <script>
            window.location.href = "<?= $redirect_to ?>"
        </script>
    <?php
    // If any error, load the same page with popup error
    } else { ?>

    <section class="container">
        <div class="h-100 d-flex align-items-center justify-content-center row user-select-none min-vh-100">
            <div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                <!-- This will popup the alert -->
                <div id="popup-error" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Login Failed!</strong><br>Invalid credentials. Please try again.
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php // Load Login form
                        View::loadTemplate('templates/login/form_in'); ?>
            </div>
        </div>
    </section>

    <?php }
    // If the user doesn't submit the form, load the same page
} else { ?>
    <section class="container">
        <div class="h-100 d-flex align-items-center justify-content-center row user-select-none min-vh-100">
            <div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                <?php // Load Login form
                    View::loadTemplate('templates/login/form_in'); ?>
            </div>
        </div>
    </section>
<?php } ?>