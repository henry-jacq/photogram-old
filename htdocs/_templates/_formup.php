<!-- This file contains brand-logo and required form-input-fields -->
<!-- It also has login link and sign up button -->

<form method="post" action="signup.php">
    <!-- Brand Logo -->
    <img class="brand-logo img-fluid mb-3 mx-auto d-block" src="<?=get_config('base_path')?>assets/brand/photogram-brand-big.png"
        alt="Photogram logo">

    <h4 class="text-light mb-3 fw-semibold">Register</h4>
    <div class="form-floating mb-2">
        <input type="text" class="form-control rounded-0 form-input border-0 text-lowercase" id="floatingInput"
            placeholder="Username" name="username" required>
        <label class="text-black" for="floatingInput">Username</label>
    </div>
    <div class="form-floating mb-2">
        <input type="password" class="form-control rounded-0 form-input border-0" id="floatingPassword"
            placeholder="Password" name="password" required>
        <label class="text-black" for="floatingPassword">Password</label>
    </div>
    <div class="form-floating mb-2">
        <input type="email" class="form-control rounded-0 form-input border-0" id="floatingInput" placeholder="Email"
            name="email_address" required>
        <label class="text-black" for="floatingEmail">Email</label>
    </div>
    <div class="form-floating mb-4">
        <input type="text" class="form-control rounded-0 form-input border-0" id="floatingInput"
            placeholder="Phone Number" name="phone" required>
        <label class="text-black" for="floatingInput">Phone Number</label>
    </div>
    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-dracula w-100 rounded-0 hvr-grow">Register now</button>
    </div>
    <div class="text-white">
        <label>Do you already have an account? <a href="login.php" class="text-decoration-none">Login now</a>.</label>
    </div>

    <!-- Additional sign up options -->
    <!-- <div class="sign-up-accounts">
        <p class="text-center">Register with:</p>
        <div class="social-accounts d-flex justify-content-center">
            <a href=""><i class='fab fa-google' style='font-size:24px'></i></a>
            <a href=""><i class='fab fa-twitter' style='font-size:24px'></i></a>
            <a href=""><i class='fab fa-github' style='font-size:24px'></i></a>
            <a href=""><i class='fab fa-facebook' style='font-size:24px'></i></a>
        </div>
    </div> -->
</form>