<?php
use app\core\View;

/**
 * This will load the password reset form
 */
function loadForgotPasswordForm(string $status = null, string $value = null)
{
    if ($status === "success" and $value === "mail-sent") {
        ?>
<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<!-- This will popup the alert -->
			<div id="popup-error" class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Email has been sent!</strong><br>Password recovery link sent to your email
				<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php // Load Login form with success message
                View::loadTemplate('templates/auth/password-reset-form'); ?>
		</div>
	</div>
</section>
<?php
    } elseif ($status === "fail" and $value === "invalid-email") {
        ?>
<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<!-- This will popup the alert -->
			<div id="popup-error" class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Invalid email!</strong><br>Email doesn't exist in our database.
				<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php // Load Login form with success error
                View::loadTemplate('templates/auth/password-reset-form'); ?>
		</div>
	</div>
</section>

<?php
    } elseif ($status === "fail" and $value === "invalid-token") {?>

<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<!-- This will popup the alert -->
			<div id="popup-error" class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Invalid token!</strong><br>Reset token is invalid.
				<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php // Load Login form with error message
                View::loadTemplate('templates/auth/password-reset-form'); ?>
		</div>
	</div>
</section>

<?php } elseif ($status === null) {
    ?>
<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<?php // Load Login form
                View::loadTemplate('templates/auth/password-reset-form'); ?>
		</div>
	</div>
</section>
<?php
}
}

/**
 * This contains HTML body for sending mail to reset the password.
 */
function loadPasswordResetMailBody($first_name, $reset_link)
{
    $htmlMailBody = "
	<div style='line-height:1.5rem; margin-bottom:10px;'>
		<b>Hi $first_name,</b><br>
		We heard that you have lost your Photogram password. Sorry about that.<br>
		But don't worry, You can click on this link to reset your password: <a href='$reset_link'>Reset password</a><br>
		If you don't use the link within 2 hours, it will expire.<br>
		reset_link visit $reset_link
	</div>
	Thanks,<br>
	<b>Photogram Team</b>
	";

    return $htmlMailBody;
}


function loadChangePasswordForm(string $status = null)
{

    if ($status === "success") {?>
<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<div id="popup-error" class="alert alert-success fade show text-start" role="alert">
				<p class="my-2"><b class="fw-semibold">Password changed successfully!</b> You can <a href="/login"
						class="text-decoration-none">login now</a>.</p>
			</div>
			<?php // Load change password form with success message
                View::loadTemplate('templates/auth/change-password-form'); ?>
		</div>
	</div>
</section>
<?} elseif ($status === "fail") {?>
<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<div id="popup-error" class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Password not matches!</strong><br>Password not matches
				<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php // Load change password form with error
                View::loadTemplate('templates/auth/change-password-form'); ?>
		</div>
	</div>
</section>
<?} elseif ($status === null) {?>
<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<?php // Load change password form
                View::loadTemplate('templates/auth/change-password-form'); ?>
		</div>
	</div>
</section>
<?}
} ?>