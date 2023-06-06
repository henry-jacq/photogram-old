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

if (window.location.pathname == '/register') {
  // Restrict form submission when hitting enter key on these fields
  $('#username, #password, #email').on("keydown", function (event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      return false;
    }
  });

  $('.user-register-form').on('submit', function (event) {
    event.preventDefault();
    $('.btn-register').html('Checking credentials...');
    $('.btn-register').attr('disabled', true);
    const formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "/api/auth/register",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.result == true) {
          var successHTML = `
                    <section class="container">
                        <div class="d-flex align-items-center justify-content-center min-vh-100">
                            <div class="py-3 col-sm-10 col-md-10 col-lg-8 col-xl-6">
                                <div class="bg-black bg-opacity-25 rounded-3 p-5 text-center border">
                                    <img src="/assets/brand/photogram-logo.png"
                                        alt="logo" class="img-fluid mx-auto d-block mb-4" width="63" height="63">
                                    <h3 class="display-6">Welcome to Photogram!</h3>
                                    <p class="lead mb-4">Your account has been created.</p>
                                    <a class="text-decoration-none" href="/login">
                                        <button class="btn btn-success hvr-icon-forward">Continue to login <i class="fa fa-arrow-right hvr-icon" aria-hidden="true"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>`;
          $('section.container').html(successHTML);
        }
      },
      error: function (jqXHR, textStatus) {
        if (textStatus == 'error') {
          if ($('.alert.alert-danger.alert-dismissible.fade.show').length === 0) {
            var errorMessage = $('<div>').addClass('alert alert-danger alert-dismissible fade show').html('<i class="bi bi-exclamation-circle me-2"></i><b class="fw-semibold">Failed to register!</b> Invalid credentials.<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>');
            $(errorMessage).insertBefore('form');
          }
          $('.btn-register').attr('disabled', false);
          $('.btn-register').html('Register now!');
        }
      }
    });
  })
}