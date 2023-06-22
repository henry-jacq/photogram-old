/* Processed by Grunt on 22/6/2023 @18:8:20 */


// Get the current URL path
var currentPath = window.location.pathname;

// Set a cookie
function setCookie(name, value, daysToExpire) {
  var expires = "; expires=";

  if (daysToExpire) {
    var date = new Date();
    date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + value + expires + "; path=/; SameSite=Strict";
}

// Check the existence of a cookie
function cookieExists(cookieName) {
  var cookies = document.cookie.split(';');
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.indexOf(cookieName + '=') === 0) {
      return true;
    }
  }
  return false;
}

// Delete a cookie
function deleteCookie(name) {
  expires = "; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  document.cookie = name + "=" + expires + "; path=/; SameSite=Strict";
}

// Login user
if (currentPath == "/login") {
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
  
  // Fingerprint set as cookie when remember me is checked
  if (cookieExists('fingerprint')) {
    deleteCookie('fingerprint');
  }
  $('#rememberMe').on('click', function () {
    if ($('#rememberMe').is(':checked')) {
      if (!cookieExists('fingerprint')) {
        fetch('https://openfpcdn.io/fingerprintjs/v3').then(response => {
          if (response.ok) {
            const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3').then(FingerprintJS => FingerprintJS.load())
            fpPromise.then(fp => fp.get()).then(result => {
              const visitorId = result.visitorId;
              setCookie('fingerprint', visitorId, 1);
            })
          }
        });
      }
    } else if (cookieExists('fingerprint')) {
      deleteCookie('fingerprint');
    }
  });
  
  // Restrict form submission when hitting enter key on these fields
  $('#user, #pass, #rememberMe').on("keydown", function (event) {
    if (event.key === 'Enter') {
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
            var errorMessage = $('<div>').addClass('alert alert-danger alert-dismissible fade show').html('<i class="bi bi-exclamation-circle me-2"></i><b class="fw-semibold">Invalid credentials!</b> Please try again.<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>');
            $(errorMessage).insertBefore('form');
          }
          $('.btn-login').attr('disabled', false);
          $('.btn-login').html('Login now!');
        }
      }
    });
  });
}

// Register user
if (currentPath == '/register') {
  // Restrict form submission when hitting enter key on these fields
  $('#username, #password, #email').on("keydown", function (event) {
    if (event.key === 'Enter') {
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
                                        <button class="btn btn-prime hvr-icon-forward">Continue to login <i class="fa fa-arrow-right hvr-icon" aria-hidden="true"></i></button>
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

// Forgot-Password
if (currentPath == "/forgot-password") {
  $('.forgot-password-form').on('submit', function (event) {
    event.preventDefault();
    $('.btn-send-link').attr('disabled', true);
    $('.btn-send-link').html('Sending reset link to your email...');
    const formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "/api/auth/reset-password",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        $('.btn-send-link').html('Send link');
        if (response.status === 'Success') {
          if ($('.alert.alert-success.alert-dismissible.fade.show').length === 0) {
            var message = $('<div>').addClass('alert alert-success alert-dismissible fade show').html(`<i class="bi bi-exclamation-circle me-2"></i><b>Mail sent!</b><br>Reset link sent to: ${formData.get('reset_email')}<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>`);
            $(message).insertBefore('form');
          }
        }
      },
      error: function (error) {
        $('.btn-send-link').attr('disabled', false);
        $('.btn-send-link').html('Send link');
        if ($('.alert.alert-danger.alert-dismissible.fade.show').length === 0) {
          var errorMessage = $('<div>').addClass('alert alert-danger alert-dismissible fade show').html(`<i class="bi bi-exclamation-circle me-2"></i><b class="fw-semibold">Mail not sent!</b> Your email, ${formData.get('reset_email')}, does not exist in our database.<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>`);
          $(errorMessage).insertBefore('form');
        }
      }
    });
  });
}

// Check password in both fields are same
var pattern = /^\/forgot-password\/[a-zA-Z0-9]+$/;
if (pattern.test(currentPath)) {
  $(function () {
    var passwordInput = $('#newPassword');
    var confirmPasswordInput = $('#confirmNewPassword');
    var changePasswordBtn = $('.btn-change-password');
    var invalidFeedback = $('.invalid-feedback');

    passwordInput.on('input', validatePasswords);
    confirmPasswordInput.on('input', validatePasswords);

    function validatePasswords() {
      var password = passwordInput.val();
      var confirmPassword = confirmPasswordInput.val();
      var passwordsMatch = password === confirmPassword && password.length > 0 && confirmPassword.length > 0;

      passwordInput.toggleClass('is-invalid', !passwordsMatch);
      confirmPasswordInput.toggleClass('is-invalid', !passwordsMatch);
      changePasswordBtn.prop('disabled', !passwordsMatch);
      invalidFeedback.toggle(!passwordsMatch);
    }
  });

  // Change-Password
  $('.change-password-form').on('submit', function (event) {
    event.preventDefault();
    let changePasswordBtn = $('.btn-change-password');
    changePasswordBtn.attr('disabled', true);
    changePasswordBtn.html('Changing your password...');
    const formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "/api/auth/reset-password",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        changePasswordBtn.attr('disabled', false);
        changePasswordBtn.html('Change password');
        if (response.status == 'Success') {
          if ($('.alert.alert-success.alert-dismissible.fade.show').length === 0) {
            var message = $('<div>').addClass('alert alert-success alert-dismissible fade show').html(`<i class="bi bi-check-circle me-2"></i>Password changed successfully! <a href="/login" class="text-decoration-none">Login now</a>.<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>`);
            $(message).insertBefore('form');
          }
        }
      },
      error: function (error) {
        changePasswordBtn.attr('disabled', false);
        changePasswordBtn.html('Change password');
        if ($('.alert.alert-danger.alert-dismissible.fade.show').length === 0) {
          var errorMessage = $('<div>').addClass('alert alert-danger alert-dismissible fade show').html(`<i class="bi bi-exclamation-circle me-2"></i>Error occured! cannot change your password!<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>`);
          $(errorMessage).insertBefore('form');
        }
      }
    });
  });
}
// Update profile details
if (window.location.pathname === "/edit-profile") {
    $('.btn-save-data').on('click', function (e) {
        e.preventDefault();
        let form = document.querySelector('.user-form-data')
        const formData = new FormData(form);
        let saveBtn = $('.btn-save-data');
        let spinner = `<div class="spinner-border spinner-border-sm me-1" role="status"><span class="visually-hidden">Loading...</span></div>`;

        saveBtn.attr('disabled', true);
        saveBtn.html(spinner + 'Updating...');

        $.ajax({
            url: '/api/users/profile/update',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.message == 'Updated' || response.message == 'Created') {
                    saveBtn.attr('disabled', false);
                    saveBtn.html('Update profile');
                    if ($('.alert.alert-primary.alert-dismissible.fade.show').length === 0) {
                        var successMessage = $('<div>').addClass('alert alert-primary alert-dismissible fade show').html('<i class="bi bi-info-circle me-2"></i>Profile was successfully updated<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>');
                        $(successMessage).insertBefore(form);
                    }
                    document.querySelector('.profile-body').scrollIntoView();
                }
            },
            error: function (error) {
                console.error('Error while updating:', error);
            }
        });
    });

    // Remove avatar
    $('#btnRemoveAvatar').on('click', function () {
        const title = 'After removing the avatar, the default user avatar generated from <a href="https://dicebear.com" class="text-decoration-none">dicebear.com</a> will be set as your default avatar.<br><br><b class="fw-semibold">Are you sure to continue?</b>';
        d = new Dialog('<i class="bi bi-trash me-2"></i>Remove Avatar', title);
        d.setButtons([
            {
                'name': "Cancel",
                "class": "btn-secondary",
                "onClick": function (event) {
                    $(event.data.modal).modal('hide');
                }
            },
            {
                'name': 'Yes, remove',
                'class': 'btn-danger',
                "onClick": function (event) {
                    $.post('/api/users/profile/delete',
                        function (data, textSuccess) {
                            if (data.message == true && textSuccess == "success") {
                                location.reload();
                            } else {
                                console.error(data, textSuccess);
                            }
                        });

                    $(event.data.modal).modal('hide')
                }
            }
        ]);
        d.show();
    });
}

// Init Masonry
var grid = document.querySelector('#masonry-area');
if (grid) {
    // Initialize masonry
    var masonry = new Masonry(grid, {
        percentPosition: true
    });
    // Layout Masonry after each image loads
    imagesLoaded(grid).on('progress', function () {
        masonry.layout();
    });
}

// Disable right-click on Images
$('img').on("contextmenu", function () {
	return false;
});

// Disable Image Dragging
$("img").on("dragstart", function (event) {
    event.preventDefault();
});

// Initialize if the upload button clicked and dropzone element exists
$('#postUploadButton').on('click', function () {
    var id = display_form_dialog();
    $('#' + id).on('shown.bs.modal', function () {
        // Dropzone - To upload the files
        if (document.querySelector('#dzCreatePost')) {
            Dropzone.autoDiscover = false;

            // Initializing Dropzone
            var myDropzone = new Dropzone("#dzCreatePost", {
                url: "/api/posts/create",
                paramName: "file",
                maxFiles: 2,
                maxFilesize: 5,
                parallelUploads: 2,
                uploadMultiple: true,
                acceptedFiles: ".png,.jpeg,.jpg,.gif,.mp4,",
                autoProcessQueue: false
            });

            // Disable buttons if there is no data in the form
            setInterval(() => {
                if (myDropzone.files.length > 0) {
                    $('.btn-reset, .btn-upload').prop('disabled', false);
                } else {
                    $('.btn-reset, .btn-upload').prop('disabled', true);
                }
            }, 500);

            // Upload post
            $('.btn-upload').on('click', function (e) {
                e.preventDefault();
                const spinner = `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Posting`;
                // Spinner is used to indicate an action is currently processing
                $(this).html(spinner);
                myDropzone.processQueue();
                myDropzone.on("queuecomplete", function () {
                    location.reload();
                });
            });

            // Reset the form
            $('.btn-reset').on('click', function () {
                $('[name=post_text]').val('');

                const length = $('[name=post_text]').val().length;
                $('#total_chars').text(`${length}/240`);

                if (myDropzone.files.length > 0) {
                    myDropzone.removeAllFiles();
                }
            });
        }

        // Character limit on post text
        const myInput = $('[name=post_text]');
        const charCount = $('#total_chars');
        const maxLength = 240;

        myInput.on('input', function () {
            const length = myInput.val().length;
            charCount.removeClass('visually-hidden');

            if (length > maxLength) {
                const truncatedValue = myInput.val().slice(0, maxLength);
                myInput.val(truncatedValue);
            }
            charCount.text(`${myInput.val().length}/${maxLength}`);
        });
    });
});
// Skeleton loading effect
$('.carousel, .post-card-image, .btn-like').hide();

$(window).on("load", function () {
    // Remove the skeleton classes once the window finishes loading
    $('.card-text, .btn-group, .skeleton-header > .skeleton-text').removeClass('skeleton skeleton-text');
    if ($('img').removeClass('skeleton-img')) {
        $('.carousel, .post-card-image, .btn-like').show();
    }
    if (typeof masonry !== 'undefined') {
        // Masonry library is available
        masonry.layout();
    }
});

// Change the cursor to pointer
$('.btn-like, .btn-share').on('mouseover', function () {
    $(this).css('cursor', 'pointer');
});

// Change like button status
function likeBtn(mainSelector, status=null) {
    var likeAudio = $('<audio>', {
        id: 'likePop',
        src: '/assets/like-pop.mp3'
    });
    if ($('#likePop').length === 0) {
        $('body').append(likeAudio);
    }
    var likeBtnID = mainSelector.find('i').attr('id');
    var likeBtnSelector = $('#'+likeBtnID);
    var currentLikes = parseInt(mainSelector.find('span').text());  

    if (status == true) {
        if (likeBtnSelector.hasClass('fa-heart-o')) {
            likeBtnSelector.removeClass('fa-heart-o');
            likeBtnSelector.addClass('fa-heart text-danger');
            if (likeAudio[0].play()) {
                mainSelector.find('span').text(currentLikes += 1);
            }
        }
    } else if (status == false) {
        if (likeBtnSelector.hasClass('fa-heart text-danger')) {
            if (currentLikes != 0) {
                likeBtnSelector.removeClass('fa-heart text-danger');
                likeBtnSelector.addClass('fa-heart-o');
                mainSelector.find('span').text(currentLikes -+ 1);
            }
        }
    }
}

// Toggle likes
function likePost(selector, post_id) {
    if (selector !== undefined && post_id !== undefined) {
        $.post('/api/posts/like',
        {
            id: post_id
        }, function(data, textSuccess){
            if(textSuccess =="success"){
                likeBtn(selector, data.message);
            } else {
                console.error("Can't like the post ID: "+post_id);
            }
        });
    }
}

// It will like the post if the image is double clicked
$(".post-card-image, .carousel").on('dblclick', function(){
    let thisBtn = $(this).next().find('.btn-group').find('.btn-like');
    let post_id = $(this).attr('data-id');
    likePost(thisBtn, post_id);
});

// It will like the post when the user clicks on the like button
$('.btn-like').on('click', function() {
    let thisBtn = $(this);
    let post_id = $(this).attr('data-id');
    likePost(thisBtn, post_id);
});

// Toast wrapper
function showToast(title, subtitle, message) {
    let tst = new Toast(title, subtitle, message, {});
    tst.show();
    let tstid = tst.id;
    let tstSubtitle = $('#'+tstid).find('.toast-header').find('small');
    tst.showSec(tstSubtitle);
}

// Delete post
$('.btn-delete').on('click', function(){
    var successAudio = $('<audio>', {
        id: 'successTone',
        src: '/assets/success.mp3'
    });
    if ($('#successTone').length === 0) {
        $('body').append(successAudio);
    }
    post_id = $(this).parent().attr('data-id');
    d = new Dialog("Delete Post ?", "You want to permanently delete this post?");
    d.setButtons([
        {
            'name': "Delete",
            "class": "btn-danger",
            "onClick": function(event){
                $.post('/api/posts/delete',
                {
                    id: post_id
                }, function(data, textSuccess){
                    if(textSuccess =="success" ){
                        sl = document.querySelector(`#post-${post_id}`);
                        masonry.remove(sl);
                        masonry.layout();
                        successAudio[0].play();
                        showToast("Photogram", "Just Now", "Your post was successfully deleted!");
                    } else {
                        showToast("Photogram", "Just Now", "Can't delete your post!");
                    }
                });

                $(event.data.modal).modal('hide')
            }
        },
        {
            'name': "Cancel",
            "class": "btn-secondary",
            "onClick": function(event){
                $(event.data.modal).modal('hide');
            }
        }
    ]);
    d.show();
});

// Copy the post link
$('.btn-copy-link').on('click', function () {
    let carousel = $(this).parents('header').next();
    let activeItem = carousel.find('.active');
    let image = activeItem.find('img').attr('src');
    let textToCopy = window.location.origin + (this.getAttribute('value') != 0 ? $(this).attr('value') : image);

    if (navigator.clipboard) {
        navigator.clipboard.writeText(textToCopy);
        showToast("Photogram", "Just Now", "Copied the post link to the clipboard!");
    } else {
        console.error("Can't copy the post link!");
        showToast("Photogram", "Just Now", "Can't copy the post link to the clipboard!");
    }
});

// Download a single or multiple image post.
$('.btn-download').on('click', function () {
    if (this.hasAttribute('href')) {
        return;
    }

    let carousel = $(this).parents('header').next();
    let activeItem = carousel.find('.active');
    let image = activeItem.find('img').attr('src');
    let url = window.location.origin + (this.getAttribute('value') != 0 ? $(this).attr('value') : image);

    fetch(url)
        .then(res => res.blob())
        .then(file => {
            let tempURL = URL.createObjectURL(file);
            this.setAttribute('href', tempURL);
            this.setAttribute('download', url.replace(/^.*[\\\/]/, ''));
            this.click();
            URL.revokeObjectURL(tempURL);
            this.removeAttribute('href');
        })
        .catch(console.error);
});
// Count only user posts

if (window.location.pathname === "/profile") {
  $.post("/api/posts/count?mode=user", function (o) {
    $("#totalUserPosts").text(o.count);
  });
}


//# sourceMappingURL=app.js.map