<form class="needs-validation" action="/forgot-password" method="post" autocomplete='off'>
    <div class="form-control p-4 bg-black bg-opacity-25">
        <div class="d-flex align-items-center justify-content-center mb-3">
            <i class="bi bi-key-fill fs-1"></i>
        </div>
        <h5 class="fw-normal mb-2 text-center">Change Password</h5>
        <!-- <p class="text-center mb-4 fw-light">No worries, we'll send you the reset instructions.</p> -->
        <label class="form-label">New Password</label>
        <input type="password" id="newPassword" name="newPassword" class="form-control bg-transparent"
        required>
        <div class="form-text mb-3">Type your new password for your photogram account</div>
        <label class="form-label">Confirm new Password</label>
        <input type="password" id="confirmNewPassword" name="confirmNewPassword" class="form-control bg-transparent"
            required>
        <div class="form-text mb-3">Type again to confirm new password</div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary mb-3">Change your password</button>
        </div>
        <p class="text-center text-muted">Do you already have an account? <a href="/login"
                class="text-decoration-none">Login now</a>.</p>
    </div>
</form>