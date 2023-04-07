<form action="/login" method="post" autocomplete='off'>
	<div class="form-control p-4 bg-black bg-opacity-25">
		<img src="<?= get_config('base_path') ?>assets/brand/photogram-logo.png"
			alt="logo" class="img-fluid mx-auto d-block mb-2" width="63" height="63">
		<h4 class="fw-light text-center mb-4">Photogram</h4>
		<hr class="mb-4">
		<h5 class="fw-semi-bold mb-4">Sign In</h5>
		<label class="form-label">Username or email</label>
		<input type="text" id="user" name="username_or_email" class="form-control mb-3 bg-transparent" required>
		<label class="form-label">Password</label>
		<div class="input-group mb-3">
			<input type="password" id="pass" name="password" class="form-control bg-transparent" required>
			<span class="input-group-text bg-transparent" id="icon-click">
				<i class="bi-eye-slash" id="icon"></i>
			</span>
		</div>
		<!-- Fingerprint -->
		<input name="visitor_id" type="hidden" class="form-control" id="fingerprint" value="">

		<div class="row mb-3">
			<div class="col text-start">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="rememberMe">
					<label class="form-check-label" for="rememberMe">Remember me</label>
				</div>
			</div>
			<div class="col text-end">
				<a class="text-decoration-none text-primary-emphasis" href="/forgot-password">Forgot password?</a>
			</div>
		</div>

		<button type="submit" class="btn btn-primary mb-3 hvr-grow">Sign In</button>
		<p class="text-center text-muted">Want to join Photogram? <a href="/signup"
				class="text-decoration-none">Register now</a>.</p>
		<!-- <p class="text-center text-muted">All rights reserved &copy;2022-2023</p> -->
	</div>
</form>