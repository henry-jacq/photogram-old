<form action="/forgot-password" method="post" autocomplete='off'>
	<div class="form-control p-4 bg-black bg-opacity-25">
		<div class="d-flex align-items-center justify-content-center mb-3">
			<i class="bi bi-key-fill fs-1"></i>
		</div>
		<h5 class="fw-normal mb-2 text-center">Forgot Password</h5>
		<p class="text-center mb-4 fw-light">No worries, we'll send you the reset instructions.</p>
		<label class="form-label">Email</label>
		<input type="email" id="user" name="email" class="form-control bg-transparent" required>
		<div class="form-text mb-3">Requires your photogram email address</div>
		<div class="d-grid">
			<button type="submit" class="btn btn-primary mb-3">Reset password</button>
		</div>
		<p class="text-center text-muted">Do you already have an account? <a href="/login"
				class="text-decoration-none">Login now</a>.</p>
	</div>
</form>