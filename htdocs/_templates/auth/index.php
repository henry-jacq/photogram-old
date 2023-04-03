<?php

if (isset($_POST['email']) and !empty($_POST['email'])) {
    $email = $_POST['email'];
    $result = Mailer::mail_exists($email);
    $fp = true;
} else {
    $fp = false;
}


if ($fp) {
    if ($result) {
        ?>
<section class="container">
	<div class="h-100 d-flex align-items-center justify-content-center row" style="min-height: 100vh;">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<!-- This will popup the alert -->
			<div id="popup-error" class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Email has been sent!</strong><br>Password recovery link sent to your email
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php // Load Login form
            Session::loadTemplate('auth/password-reset-form'); ?>
		</div>
	</div>
</section>
<?php
    } else {
        ?>
<section class="container">
	<div class="h-100 d-flex align-items-center justify-content-center row" style="min-height: 100vh;">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<!-- This will popup the alert -->
			<div id="popup-error" class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Invalid email!</strong><br>Email doesn't exist in our database.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php // Load Login form
                Session::loadTemplate('auth/password-reset-form'); ?>
		</div>
	</div>
</section>
<?php
    }
} else {
    ?>
<section class="container">
	<div class="h-100 d-flex align-items-center justify-content-center row" style="min-height: 100vh;">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<?php // Load Login form
                Session::loadTemplate('auth/password-reset-form'); ?>
		</div>
	</div>
</section>
<?php
}
?>