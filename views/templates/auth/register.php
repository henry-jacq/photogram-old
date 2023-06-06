<section class="container">
	<div class="h-100 d-flex align-items-center justify-content-center row min-vh-100 user-select-none">
		<div class="py-3 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
			<form class="user-register-form" method="post" autocomplete='off'>
				<div class="form-control p-4 bg-black bg-opacity-25">
					<img src="<?= URL_ROOT ?>assets/brand/photogram-logo.png"
						alt="logo" class="img-fluid mx-auto d-block mb-2" width="63" height="63">
					<h4 class="fw-light text-center mb-4">Photogram</h4>
					<hr class="mb-4">
					<h5 class="fw-semi-bold mb-4">Register</h5>
					<label for="userName" class="form-label">Username</label>
					<input type="text" id="username" name="username" class="form-control mb-3 bg-transparent" required>
					<label for="email" class="form-label">Email</label>
					<input type="email" id="email" name="email_address" class="form-control mb-3 bg-transparent" required>
					<label for="password" class="form-label">Password</label>
					<input type="password" id="password" name="password" class="form-control mb-3 bg-transparent" required>
					<div class="d-grid">
						<button type="submit" class="btn btn-primary btn-register mb-3">Register now!</button>
					</div>
					<p class="text-center text-muted mb-0">Do you already have an account? <a href="/login" class="text-decoration-none">Login now</a>.</p>
				</div>
			</form>
		</div>
	</div>
</section>
