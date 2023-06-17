<?php
use App\Core\View;

/**
 * This will load the password reset form
 */
function loadForgotPasswordForm(string $status = null, string $value = null)
{
    if ($status === "fail" and $value === "token-expired") {?>

<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<!-- This will popup the alert -->
			<div id="popup-error" class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong><i class="bi bi-exclamation-circle me-2"></i>Token Expired!</strong><br>Your password reset token has expired.
				<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php // Load Login form with error message
                View::renderTemplate('auth/password-reset-form'); ?>
		</div>
	</div>
</section>

<?php } else {
    ?>
<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<?php // Load Login form
                View::renderTemplate('auth/password-reset-form'); ?>
		</div>
	</div>
</section>
<?php
}
}

function loadChangePasswordForm()
{ ?>
<section class="container user-select-none">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<?php // Load change password form
                View::renderTemplate('auth/change-password-form'); ?>
		</div>
	</div>
</section>
<? } ?>