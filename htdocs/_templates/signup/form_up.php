<form action="/signup" method="post" autocomplete='off'>
    <div class="form-control p-4 bg-black bg-opacity-25">
        <img src="<?= get_config('base_path') ?>assets/brand/photogram-logo.png" alt="logo" class="img-fluid mx-auto d-block mb-2" width="63" height="63">
        <h4 class="fw-light text-center mb-4">Photogram</h4>
        <hr class="mb-4">
        <h5 class="fw-semi-bold mb-4">Register</h5>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" name="first_name" class="form-control bg-transparent" id="firstName" required>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" name="last_name" class="form-control bg-transparent" id="lastName" required>
            </div>
        </div>

        <label for="userName" class="form-label">Username</label>
        <input type="text" id="userName" name="username" class="form-control mb-3 bg-transparent" required>
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email_address" class="form-control mb-3 bg-transparent" required>
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control mb-3 bg-transparent" required>
        <!-- Fingerprint -->
        <input name="visitor_id" type="hidden" class="form-control" id="fingerprint" value="">

        <button type="submit" class="btn btn-primary mb-3 hvr-grow">Register</button>
        <p class="text-center text-muted mb-0">Do you already have an account? <a href="/login" class="text-decoration-none">Login now</a>.</p>
        <!-- <p class="text-center text-muted">All rights reserved &copy;2022-2023</p> -->
    </div>
</form>