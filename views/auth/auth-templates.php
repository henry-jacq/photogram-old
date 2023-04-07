<?php
use libs\core\Session;

/**
 * This will load the password reset form
 */
function loadForgotPasswordForm(string $value = null)
{
    if ($value === "success") {
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
    } elseif ($value === "fail") {
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
    } elseif ($value === null) {
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
}

/**
 * This contains HTML body for sending mail to reset the password.
 */
function loadPasswordResetMailBody()
{
    $htmlMailBody = "
	<div style='line-height:1.5rem; margin-bottom:10px;'>
		<b>Hi Henry,</b><br>
		We received a request to reset the password for your Photogram account. If you didn't request this, please ignore
		this email.<br>
		If you did request it, please click on this link to reset your password: <a href='#'>Reset password</a><br>
		If you have any questions or concerns, feel free to reach out to us.
	</div>
	Best regards,<br>
	<b>Photogram Team</b>
	";

    return $htmlMailBody;
}


function loadChangePasswordForm()
{?>
<section class="container">
	<div class="h-100 d-flex align-items-center justify-content-center row" style="min-height: 100vh;">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<?php // Load Login form
                    Session::loadTemplate('auth/change-password-form'); ?>
		</div>
	</div>
</section>
<?}


?>