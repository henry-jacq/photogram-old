// show/hide password field in login form
$("#icon-click").on("click", function (data) {
  let icon = $("#icon");

  if (icon.hasClass("bi-eye-slash")) {
    $("#pass").attr("type", "text");
    icon.removeClass("bi-eye-slash");
    icon.addClass("bi-eye");
  } else if (icon.hasClass("bi-eye")) {
    $("#pass").attr("type", "password");
    icon.removeClass("bi-eye");
    icon.addClass("bi-eye-slash");
  }
});
