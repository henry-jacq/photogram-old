<?php

use App\Core\User;
use App\Core\View;

// Try to register, if the user has submitted the form
$required_fields = array(
    "username" => filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    "password" => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    "email_address" => filter_input(INPUT_POST, 'email_address', FILTER_SANITIZE_EMAIL)
);

// Sanitizing user input
foreach ($required_fields as $key => $value) {
    if (empty($value)) {
        $signup = false;
        break;
    } else {
        switch($key) {
            case 'username':
                $username = $value;
                break;
            case 'password':
                $password = $value;
                break;
            case 'email_address':
                $email = $value;
                break;
        }
        $signup = true;
    }
}

// If user filled and submitted the form
if ($signup) {
    $result = User::register($username, $password, $email);
    // Sign up success, if result has no error
    if ($result) { ?>
<section class="container">
	<div class="d-flex align-items-center justify-content-center min-vh-100">
		<div class="py-3 col-sm-10 col-md-10 col-lg-8 col-xl-6">
			<div class="bg-black bg-opacity-25 rounded-3 p-5 text-center border">
				<img src="<?= URL_ROOT ?>assets/brand/photogram-logo.png"
					alt="logo" class="img-fluid mx-auto d-block mb-4" width="63" height="63">
				<h3 class="display-6">Welcome to Photogram!</h3>
				<p class="lead mb-4">Your account has been created.</p>
				<a class="text-decoration-none" href="/login">
					<button class="btn btn-success hvr-icon-forward">Continue to login <i class="fa fa-arrow-right hvr-icon" aria-hidden="true"></i></button>
				</a>
			</div>
		</div>
	</div>
</section>

<?php // If any error, load the same page with popup error
    } else { ?>

<section class="container">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100 user-select-none">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<!-- This will popup the alert -->
			<div id="popup-error" class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Signup Failed!</strong><br>Username or email already exists in database.
				<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php // Load Sign up form
                View::loadTemplate('templates/signup/form_up'); ?>
		</div>
	</div>
</section>

<?php }
    }
// If the user doesn't submit the form, load the same page
else { ?>

<section class="container">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100 user-select-none">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<?php // Load Sign up form
                View::loadTemplate('templates/signup/form_up'); ?>
		</div>
	</div>
</section>

<?php } ?>