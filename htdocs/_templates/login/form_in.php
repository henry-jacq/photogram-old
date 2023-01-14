<!-- This file contains brand-logo and required form-input-fields -->
<!-- It also has signup link and login button -->

<form method="post" action="login.php">
    <!-- Brand Logo -->
    <img class="brand-logo img-fluid mb-3 mx-auto d-block" src="<?=get_config('base_path')?>assets/brand/photogram-brand-big.png"
        alt="Photogram logo">

    <h4 class="text-light mb-3 fw-semibold">Sign in</h4>
    <div class="form-floating mb-3">
        <input type="text" class="form-control rounded-0 form-input border-secondary text-lowercase text-light" id="floatingInput"
            placeholder="Email or Username" name="username_or_email" required>
        <label class="text-secondary" for="floatingInput">Email or Username</label>
    </div>
    <div class="form-floating mb-4 input-group">
            <input type="password" name="password" class="form-control rounded-0 form-input border-secondary text-light" id="floatingPassword" placeholder="Enter your password" required>
            <span class="input-group-text rounded-0 form-input border-secondary text-light" id="togglePassword"><i id="togglePasswordbtn" class="fa fa-eye-slash"></i></span>
            <label class="text-secondary" for="floatingPassword">Password</label>
    </div>
    <!-- Fingerprint -->
    <input name="visitor_id" type="hidden" class="form-control" id="fingerprint" value="">
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input border-secondary" id="autoSizingCheck2">
        <label class="text-light">Remember me</label>
    </div>
    <div class="d-grid gap-2 mb-4">
        <button type="submit" class="btn btn-dracula w-100 rounded-0 hvr-grow">Sign in</button>
    </div>
    <div class="text-white">
        <label for="">Want to join photogram? <a href="signup.php" class="text-decoration-none">Register now</a>.</label>
    </div>
</form>
