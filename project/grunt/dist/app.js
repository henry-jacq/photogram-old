/* Processed by Grunt on 14/1/2023 @7:57:47 */


// init Masonry
var $grid = $('#masonry-area').masonry({
    // itemSelector: '.col',
    // columnWidth: '.col',
    percentPosition: true
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
    $grid.masonry('layout');
});

// Password Toggle Button
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#floatingPassword");

togglePassword.addEventListener("click", function () {
// toggle the type attribute
const type = password.getAttribute("type") === "password" ? "text" : "password";
password.setAttribute("type", type);

// toggle the eye icon
const togglePasswordbtn = document.querySelector("#togglePasswordbtn");

togglePasswordbtn.classList.toggle("fa-eye");
togglePasswordbtn.classList.toggle("fa-eye-slash");
});

// Confirm Password Toggle Button
const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
const Confirmpassword = document.querySelector("#floatingConfirmPassword");

toggleConfirmPassword.addEventListener("click", function () {
// toggle the type attribute
const type = Confirmpassword.getAttribute("type") === "password" ? "text" : "password";
Confirmpassword.setAttribute("type", type);

// toggle the eye icon
const toggleConfirmPasswordbtn = document.querySelector(
    "#toggleConfirmPasswordbtn"
);

toggleConfirmPasswordbtn.classList.toggle("fa-eye");
toggleConfirmPasswordbtn.classList.toggle("fa-eye-slash");
});
//# sourceMappingURL=app.js.map