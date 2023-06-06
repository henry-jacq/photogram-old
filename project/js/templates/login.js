if (window.location.pathname == "/login") {
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
  
  // Restrict form submission when hitting enter key on these fields
  $('#user, #pass, #rememberMe').on("keydown", function (event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      return false;
    }
  });

  $('.user-login-form').on('submit', function (event) {
    event.preventDefault();
    $('.btn-login').attr('disabled', true);
    $('.btn-login').html('Verifying credentials...');
    const formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "/api/auth/login",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        $('.btn-login').html('Logging in...');
        if (response.message == 'Authenticated') {
          if (response.redirect != false) {
            location.replace(response.redirect);
          } else {
            location.reload();
          }
        }
      },
      error: function (jqXHR, textStatus) {
        if (textStatus == 'error') {
          if ($('.alert.alert-danger.alert-dismissible.fade.show').length === 0) {
            var successMessage = $('<div>').addClass('alert alert-danger alert-dismissible fade show').html('<i class="bi bi-exclamation-circle me-2"></i><b class="fw-semibold">Invalid credentials!</b> Please try again.<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>');
            $(successMessage).insertBefore('form');
          }
          $('.btn-login').attr('disabled', false);
          $('.btn-login').html('Login now!');
        }
      }
    });
  });
}
