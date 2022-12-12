<!-- This file contains brand-logo and required form-input-fields -->
<!-- It also has signup link and login button -->

<form method="post" action="login.php">
    <!-- Brand Logo -->
    <img class="brand-logo img-fluid mb-3 mx-auto d-block" src="/photogram/assets/brand/photogram-brand-big.png"
        alt="Photogram logo">

    <h4 class="text-light mb-3 fw-semibold">Login</h4>
    <div class="form-floating mb-3">
        <input type="text" class="form-control rounded-0 form-input border-0 text-lowercase" id="floatingInput"
            placeholder="Enter your username" name="username" required>
        <label class="text-black" for="floatingInput">Username</label>
    </div>
    <div class="form-floating mb-4">
        <input type="password" class="form-control rounded-0 form-input border-0" id="floatingPassword"
            placeholder="Enter your password" name="password" required>
        <label class="text-black" for="floatingPassword">Password</label>
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="autoSizingCheck2">
        <label class="text-light">Remember me</label>
    </div>
    <div class="d-grid gap-2 mb-4">
        <button type="submit" class="btn btn-dracula w-100 rounded-0">Login</button>
    </div>
    <div class="text-white">
        <label for="">Want to join photogram? <a href="signup.php" class="text-decoration-none">Register
                now</a>.</label>
    </div>
</form>