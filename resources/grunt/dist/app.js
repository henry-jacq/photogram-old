/* Processed by Grunt on 2/7/2023 @18:10:28 */


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

$('.carousel-control-prev, .carousel-control-next').on('click', function () {
    masonry.layout();
});

// Disable right-click on Images
$('img').on("contextmenu", function () {
	return false;
});

// Disable Image Dragging
$("img").on("dragstart", function (event) {
    event.preventDefault();
});

// Scroll to top
if ($('#scroll-top-btn').length != 0) {
    var scrollTopBtn = $('#scroll-top-btn');
    $(window).on('scroll', function () {
        var scrollPos = $(this).scrollTop();

        if (scrollPos > 0) {
            scrollTopBtn.removeClass('d-none').fadeIn('slow');
        } else {
            scrollTopBtn.fadeOut(function () {
                $(this).addClass('d-none');
            });
        }
    });
    scrollTopBtn.on('click', function (e) {
        e.preventDefault();
        $('html').animate({ scrollTop: 0 }, 'fast');
    });
}

// Opens a create post modal
$('#postUploadButton').on('click', function () {
    var title = `<i class="bi bi-plus-circle-dotted me-2"></i>Create Post`;
    var body = `<div class="container"><p class="lead mb-2">Add caption</p><textarea class="form-control shadow-none post-caption mb-1" name="post_text" rows="3" placeholder="Say something..."></textarea><p id="total-caption-chars" class="text-end mb-2">0/240</p><p class="lead mb-2">Add photos</p><form class="dropzone rounded mb-3" id="dzCreatePost"><div class="dz-message py-1"><i class="bi bi-images display-6"></i><p class="small">Drop photos here or click to upload</p></div></form></div>`;

    var d = new Dialog(title, body);
    d.setButtons([
        {
            'name': "Clear",
            "class": "btn-outline-secondary btn-reset-form"
        },
        {
            'name': "Create post",
            "class": "btn-prime btn-create-post"
        }
    ]);

    var modal = d.clone;
    var md_footer = modal.find('.modal-footer');
    d.show("primary", true);
    var createPostBtn = md_footer.find('.btn-create-post');
    var resetFormBtn = md_footer.find('.btn-reset-form');
    $(createPostBtn).attr('disabled', true);
    $(resetFormBtn).attr('disabled', true);

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
            acceptedFiles: ".png,.jpeg,.jpg,.gif",
            autoProcessQueue: false
        });

        // Enable buttons when files are added
        myDropzone.on("addedfile", function () {
            $(createPostBtn).prop('disabled', false);
            $(resetFormBtn).prop('disabled', false);
        });

        // Disable buttons when files are removed
        myDropzone.on("removedfile", function () {
            $(createPostBtn).prop('disabled', true);
            $(resetFormBtn).prop('disabled', true);
            if (myDropzone.files.length > 0) {
                $(createPostBtn).prop('disabled', false);
                $(resetFormBtn).prop('disabled', false)
            }
        });

        // Add post text to dropzone formdata
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("post_text", $('.post-caption').val());
        });

        // Remove rejected files from dropzone
        myDropzone.on("error", function (file) {
            if (file.status === "error") {
                var rejectedFiles = myDropzone.getRejectedFiles();
                for (var i = 0; i < rejectedFiles.length; i++) {
                    myDropzone.removeFile(rejectedFiles[i]);
                }
            }
        });

        // Remove all files before clsoing the modal
        $(modal).on('hide.bs.modal', function () {
            if (myDropzone.files.length > 0) {
                myDropzone.removeAllFiles();
            }
        });

        // Create a new post
        $(createPostBtn).on('click', function (e) {
            e.preventDefault();
            if (myDropzone.files.length > 0) {
                const spinner = `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Creating post`;
                $(this).attr('disabled', true);
                $(resetFormBtn).attr('disabled', true);
                $(this).html(spinner);
                myDropzone.processQueue();
            } else {
                $(this).attr('disabled', true);
            }
        });

        // Reset the form data
        $(resetFormBtn).on('click', function () {
            $('.post-caption').val('');

            const length = $('.post-caption').val().length;
            $('#total-caption-chars').text(`${length}/240`);

            if (myDropzone.files.length > 0) {
                myDropzone.removeAllFiles();
            }
        });

        // After queue complete, verify errors then reload the page
        myDropzone.on("queuecomplete", function () {
            var filesWithErrors = myDropzone.getFilesWithStatus(Dropzone.ERROR);
            if (filesWithErrors.length > 0) {
                for (var i = 0; i < filesWithErrors.length; i++) {
                    myDropzone.removeFile(filesWithErrors[i]);
                }
                $(createPostBtn).html('Create post');
                if (!$('#error-message').length) {
                    $('<p id="error-message" class="text-danger mb-1">Cannot create post!</p>').insertBefore('#dzCreatePost');
                }
            } else {
                location.replace('/');
            }
        });

        // Character limit on post text   
        $('.post-caption').on('input', function () {
            const length = $(this).val().length;

            if (length > 240) {
                const truncatedValue = $(this).val().slice(0, 240);
                $(this).val(truncatedValue);
            }
            $('#total-caption-chars').text(`${$(this).val().length}/${240}`);
        });
    }
});
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
            location.replace(response.redirect);
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
  var usernameInput = $('#username');
  var fullnameInput = $('#fullname');
  var emailInput = $('#email');
  var passwordInput = $('#password');
  var registerBtn = $('.btn-register');
  
  $('#fullname, #username, #password, #email').on("keydown", function (event) {
    if (event.key === 'Enter') {
      event.preventDefault();
      return false;
    }
  });

  $(function () {
    usernameInput.on('input', validateField);
    fullnameInput.on('input', validateField);
    emailInput.on('input', validateField);
    passwordInput.on('input', validateField);

    function validateField() {
      var field = $(this);
      var value = field.val().trim();
      var isValid = false;
      var feedbackElement = field.next('.invalid-feedback');

      if (field.attr('id') === 'username') {
        isValid = /^[a-zA-Z][a-zA-Z_]*$/.test(value);
        feedbackElement.text('It should not contain any special characters except letters and underscore.');
      } else if (field.attr('id') === 'fullname') {
        isValid = /^[A-Za-z]+(\s[A-Za-z]+)*$/.test(value);
        feedbackElement.text('It should not contain numbers or special characters.');
      } else if (field.attr('id') === 'email') {
        isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        feedbackElement.text('Please enter a valid email address.');
      } else if (field.attr('id') === 'password') {
        isValid = value.length >= 8;
        feedbackElement.text('Password should contain at least 8 characters.');
      }

      field.toggleClass('is-invalid', !isValid);
      feedbackElement.toggle(!isValid);

      var allFieldsValid = !usernameInput.hasClass('is-invalid') &&
        !fullnameInput.hasClass('is-invalid') &&
        !emailInput.hasClass('is-invalid') &&
        !passwordInput.hasClass('is-invalid');

      registerBtn.prop('disabled', !allFieldsValid);
    }
  });


  $('.user-register-form').on('submit', function (event) {
    event.preventDefault();
    registerBtn.html('Verifying credentials...');
    registerBtn.attr('disabled', true);
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
          registerBtn.attr('disabled', false);
          registerBtn.html('Register now!');
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
          location.replace('/login');
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
var regex = /^\/forgot-password\/[a-zA-Z0-9]+$/;
if (regex.test(window.location.pathname)) {
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
          location.replace('/login');
        } else {
          if ($('.alert.alert-danger.alert-dismissible.fade.show').length === 0) {
            var message = $('<div>').addClass('alert alert-danger alert-dismissible fade show').html(`<i class="bi bi-exclamation-circle me-2"></i>Unable to change the password!<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>`);
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
// Comment on post
let comment_frame = `<div class="container"><ul id="comment-list" class="list-group list-group-flush my-3"></ul></div>`;

let comment_clone = `<li id="comment" class="list-group-item border-0"><div class="d-flex"><div class="mt-1 me-1"><div class="me-2"><img id="commenter-avatar" class="border rounded-circle" src="" width="46" height="46" loading="lazy"/></div></div><div class="bg-body-tertiary border px-3 py-2 rounded w-100"><div class="d-flex justify-content-between mb-1"><h6 class="fw-semibold mb-0"><a id="commenter-name" class="text-body" href=""></a></h6><small id="commented-time" class="ms-2">Now</small></div><p id="commenter-text" class="mb-2"></p></div></div></li>`;

let comment_send_form = `<div class="me-2"><img id="user-comment-avatar" class="border rounded-circle" src="" width="40" height="40"></div><form class="text-body position-relative w-100"><textarea id="add-comment" class="form-control pe-5" rows="1" maxlength="43" placeholder="Add a comment..."></textarea><button class="btn btn-comment-send focus-ring focus-ring-prime border-0 position-absolute top-50 end-0 translate-middle-y" type="button" disabled><i class="bi bi-send-fill text-prime"></i></button></form>`;

var deleteBtn = `<a class="btn-delete-comment mt-2 small text-danger" role="button">Delete</a>`;

$('.btn-comment').on('click', function () {
    var d = new Dialog('Comments', comment_frame);
    d.show('', true);
    var modal = d.clone;
    var modal_footer = modal.find('.modal-footer');
    modal.find('.modal-body').addClass('p-2');
    modal_footer.addClass('flex-nowrap');
    modal_footer.empty().html(comment_send_form);
    modal_footer.find('#add-comment').css('resize', 'none');
    modal.find('.modal-dialog').addClass('modal-dialog-scrollable');

    const post_id = $(this).attr('data-id');
    const target = modal.find('#comment-list');

    // Display comments on modal
    $.post('/api/posts/comments/users',
    {
        id: post_id
    }, function (data, textSuccess) {
        if (textSuccess == 'success') {
            const sess_user_name = data.owner.username;
            const sess_user_avatar = data.owner.avatar;
            modal_footer.find('#user-comment-avatar').attr('src', sess_user_avatar);
            if (data.message == true && data.comments.users != false) {
                modal.find('.modal-title').text(`Comments (${data.comments.users.length})`);
                for (let count = 0; count < data.comments.users.length; count++) {
                    let ud = data.comments.users[count];
                    let comment_id = ud.comment_id;
                    let comment_body = ud.comment;
                    let timestamp = ud.timestamp;
                    let username = ud.username;
                    let fullname = ud.fullname;
                    let avatar = ud.avatar;
                    target.append(comment_clone);
                    target.find('#commenter-avatar').attr('src', avatar);
                    target.find('#commenter-avatar').attr('id', Math.random() * 1000 + count);
                    target.find('#commenter-name').text(fullname);
                    target.find('#commenter-name').attr('href', '/profile/' + username);
                    target.find('#commenter-name').attr('id', Math.random() * 1000 + count);
                    target.find('#commented-time').empty().text(timestamp);
                    target.find('#commented-time').attr('id', Math.random() * 1000 + count);
                    target.find('#comment').attr('id', Math.random() * 1000 + count);
                    target.find('#commenter-text').empty().text(comment_body);
                    if (sess_user_name == username) {
                        $(deleteBtn).insertAfter(target.find('#commenter-text'));
                        let btnDeleteComment = $(target.find('#commenter-text')).next();
                        btnDeleteComment.attr('data-id', comment_id);
                    }
                    target.find('#commenter-text').attr('id', Math.random() * 1000 + count);
                }
            } else {
                $('<h5 class="comment-not-found text-center my-5"><i class="bi bi-exclamation-triangle me-2"></i>No comments found</h5>').appendTo(target);
            }
        } else {
            console.error("Cannot fetch comments for post ID: " + post_id);
        }
    });

    // Handle form
    $(modal_footer.find('#add-comment')).on('input', function () {
        let commentText = $(this).val();
        if (commentText != '' && commentText.length < 43) {
            $('.btn-comment-send').removeAttr('disabled');
        } else {
            $('.btn-comment-send').attr('disabled', true);
        }
    });

    // Send a new comment
    $('.btn-comment-send').on('click', function () {
        let commentText = $(modal_footer.find('#add-comment')).val();
        var messageAudio = $('<audio>', {
            id: 'messageTone',
            src: '/assets/message-tone.mp3'
        });
        if ($('#messageTone').length === 0) {
            $('body').append(messageAudio);
        }
        $.post('/api/posts/comments/create',
        {
            pid: post_id,
            comment: commentText
        }, function (data) {
            if (data.message == true) {
                if (target.find('.comment-not-found')) {
                    target.find('.comment-not-found').remove();
                }
                target.prepend(comment_clone);
                messageAudio[0].play();
                target.find('#commenter-avatar').attr('src', data.avatar);
                target.find('#commenter-avatar').attr('id', Math.random() * 1000)
                target.find('#commenter-name').text(data.fullname);
                target.find('#commenter-name').attr('href', '/profile/' + data.username);
                target.find('#commenter-name').attr('id', Math.random() * 1000)
                modal_footer.find('#add-comment').val('');
                target.find('#comment').attr('id', Math.random() * 1000)
                target.find('#commenter-text').empty().text(commentText);
                $(deleteBtn).insertAfter(target.find('#commenter-text'));
                let btnDeleteComment = $(target.find('#commenter-text')).next();
                btnDeleteComment.attr('data-id', data.comment_id)
                target.find('#commenter-text').attr('id', Math.random() * 1000);
                $('.btn-comment-send').attr('disabled', true);
            }
        });
    });

    // Delete comment
    $(target).on('click', '.btn-delete-comment', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var successAudio = $('<audio>', {
            id: 'successTone',
            src: '/assets/success.mp3'
        });
        if ($('#successTone').length === 0) {
            $('body').append(successAudio);
        }
        let cid = $(this).attr('data-id');
        let comment_box = $(this).parents('.list-group-item');

        $.post('/api/posts/comments/delete',
        {
            comment_id: cid
        }, function (data) {
            if (data.message == true) {
                successAudio[0].play();
                comment_box.fadeOut(300, function () {
                    comment_box.remove();
                });
            }
        });
    });
});

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

// Toggle follow button status
function toggleFollow(selector) {
    if (selector.find('i').hasClass('bi-person-add')) {
        selector.html('<i class="bi-person-check me-1"></i>Following');
    } else {
        selector.html('<i class="bi-person-add me-1"></i>Follow');
    }
}

// Follow user
$('.btn-follow').on('click', function () {
    let selector = $(this);
    let follow_id = $(this).attr('data-id');
    toggleFollow(selector);

    $.post('/api/users/follow',
    {
        follower_id: follow_id
    }).fail(function () {
        toggleFollow(selector);
        console.error("Can't follow user: " + follow_id);
    });;
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

// Change like button status
function likeBtn(mainSelector) {
    var likeAudio = $('<audio>', {
        id: 'likePop',
        src: '/assets/like-pop.mp3'
    });
    if ($('#likePop').length === 0) {
        $('body').append(likeAudio);
    }
    var likeBtnID = mainSelector.find('a').attr('id');
    var likeIconSelector = $('#'+likeBtnID).find('i');
    var placeholder = mainSelector.parent().next().find('.like-count');
    var currentLikes = parseInt(placeholder.text());
    if (likeIconSelector.hasClass('fa-regular fa-heart')) {
        likeAudio[0].play()
        likeIconSelector.removeClass('fa-regular fa-heart');
        likeIconSelector.addClass('fa-solid fa-heart text-danger');
        placeholder.text(currentLikes += 1);
    }
    else {
        if (likeIconSelector.hasClass('fa-solid fa-heart text-danger') && currentLikes != 0) {
            likeIconSelector.removeClass('fa-solid fa-heart text-danger');
            likeIconSelector.addClass('fa-regular fa-heart');
            placeholder.text(currentLikes -+ 1);
        } else {
            console.error('Cannot dislike the button');
        }
    }
}

// Toggle like button
function likePost(selector, post_id) {
    if (selector !== undefined && post_id !== undefined) {
        // Toggle like or dislike
        likeBtn(selector);
        $.post('/api/posts/likes/like',
        {
            id: post_id
        }).fail(function () {
            likeBtn(selector);
            console.error("Can't like the post ID: "+post_id);
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
    let message = `<p>Are you sure you want to delete this post?</p><p>This action cannot be undone.</p>`;
    let post_id = $(this).parent().attr('data-id');
    d = new Dialog('<i class="bi bi-trash me-2"></i>Delete Post', message);
    d.setButtons([
        {
            'name': "Cancel",
            "class": "btn-secondary",
            "onClick": function (event) {
                $(event.data.modal).modal('hide');
            }
        },
        {
            'name': "Delete post",
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
        }
    ]);
    d.show();
});

// Copy the post link
$('.btn-copy-link').on('click', function () {
    let successAudio = $('<audio>', {
        id: 'successTone',
        src: '/assets/success.mp3'
    });
    if ($('#successTone').length === 0) {
        $('body').append(successAudio);
    }
    let carousel = $(this).parents('header').next();
    let activeItem = carousel.find('.active');
    let image = activeItem.find('img').attr('src');
    let textToCopy = window.location.origin + (this.getAttribute('value') != 0 ? $(this).attr('value') : image);

    if (navigator.clipboard) {
        if (navigator.clipboard.writeText(textToCopy)) {
            successAudio[0].play();
            showToast("Photogram", "Just Now", "Copied the post link to the clipboard!");
        }
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

// Show post image preview in modal
$('.btn-full-preview').on('click', function () {
    var clone_element = $(this).parents('header').next();
    var d = new Dialog('Full Preview', '', 'xlarge');
    var modal = d.clone;
    var target = modal.find('.modal-body');

    $(modal).on({
        // Disable right-click on Images
        contextmenu: function() {
            return false;
        },
        // Disable Image Dragging
        dragstart: function(e) {
            e.preventDefault();
        }
    });
    
    modal.find('.modal-body').addClass('p-0');
    modal.find('.modal-header').addClass('border-0 px-3 py-1');
    modal.find('.modal-title').addClass('fs-5 fw-normal');
    modal.find('.modal-footer').remove();
    d.show('', true);

    if (clone_element.hasClass('carousel')) {
        clone_element.clone().appendTo(target);
        carousel_sel = 'post-image-full-preview';
        target.find('.carousel').attr('id', carousel_sel);
        target.find('.carousel-item > img').removeClass('post-img');
        target.find('.carousel-inner').addClass('rounded');
        target.find('.carousel-control-prev').attr('data-bs-target', '#' + carousel_sel);
        target.find('.carousel-control-next').attr('data-bs-target', '#' + carousel_sel);
    } else if (clone_element.hasClass('post-card-image')) {
        var wrapper = $('<div>').addClass('d-flex align-items-center justify-content-center').html(clone_element.clone());
        wrapper.appendTo(target);
        target.find('.post-card-image').removeClass('post-img');
        target.find('.post-card-image').addClass('img-fluid');
    } else {
        console.error('Cannot preview post image.');
    }
})

// Edit post text
$('.btn-edit-post').on('click', function () {
    var successAudio = $('<audio>', {
        id: 'successTone',
        src: '/assets/success.mp3'
    });
    if ($('#successTone').length === 0) {
        $('body').append(successAudio);
    }
    const pid = $(this).parent().attr('data-id');
    let el = $(this).parents('header').next().next();
    let ptext = el.find('.post-text').text();
    const message = `<div class="container my-3"><p class="form-label">Change post text:</p><textarea class="form-control post-text" name="post_text" rows="5" placeholder="Say something..." spellcheck="false">${el.find('.post-text').html().replace(/<br\s*\/?>/ig, '')}</textarea><p class="total-chars visually-hidden text-end mt-2"></p></div>`;
    let d = new Dialog('<i class="bi bi-pencil me-2"></i>Edit Your Post', message);
    d.setButtons([
        {
            'name': "Cancel",
            "class": "btn-secondary",
            "onClick": function (event) {
                $(event.data.modal).modal('hide')
            }
        },
        {
            'name': "Update post",
            "class": "btn-prime btn-update-post",
            "onClick": function (event) {
                let ptxt = $(d.clone).find('.post-text').val();
                $(d.clone).find('.btn-update-post').prop('disabled', true);

                $.post('/api/posts/update',
                    {
                        id: pid,
                        text: ptxt
                    }, function (data, textSuccess) {
                        if (textSuccess == "success") {
                            successAudio[0].play();
                            el.find('.post-text').css('white-space', 'pre-line');
                            el.find('.post-text').html(ptxt.replace(/<br\s*\/?>/ig, '<br>'));
                            masonry.layout();
                            showToast("Photogram", "Just Now", "Post text changed successfully!");
                        } else {
                            showToast("Photogram", "Just Now", "Can't change the post text!");
                        }
                    });
                $(event.data.modal).modal('hide');
            }
        }
    ]);
    d.show();
    let txtarea = $(d.clone).find('.post-text');
    $(d.clone).find('.btn-update-post').prop('disabled', true);
    $(txtarea).on('input', function () {
        if (txtarea.val() != ptext) {
            $(d.clone).find('.btn-update-post').prop('disabled', false);
        } else {
            $(d.clone).find('.btn-update-post').prop('disabled', true);
        }
        // Character limit on post text
        const maxLength = 240;
        const charCount = $('.total-chars');
        const length = $(this).val().length;
        charCount.removeClass('visually-hidden');

        if (length > maxLength) {
            const truncatedValue = $(this).val().slice(0, maxLength);
            $(this).val(truncatedValue);
        }
        charCount.text(`${$(this).val().length}/${maxLength}`);
    });
});

// Shows list of users who liked post in modal
$('.likedby-users').on('click', function () {
    let html = `<div class="container"><ul id="liked-users-list" class="list-group list-group-flush"></ul></div>`;
    let clone = `<li class="list-group-item"><div class="d-flex align-items-center justify-content-between"><div class="me-2"><div class="d-flex align-items-center"><div class="me-2"><img id="user-avatar" class="border rounded-circle" src="" width="40" height="40" loading="lazy"></div><div class="text-break"><h7 id="fullname" class="text-body"></h7><p id="username" class="mb-0 small fw-light"></p></div></div></div><div><a id="link" href="" class="btn btn-primary btn-sm">Show profile</a></div></div></li>`;
    const d = new Dialog('Likes', html);
    d.show('', true);
    const post_id = $(this).attr('data-id');
    const modal = d.clone;
    const target = modal.find('#liked-users-list')
    modal.find('.modal-body').addClass('p-2');
    modal.find('.modal-dialog').addClass('modal-dialog-scrollable');
    modal.find('.modal-footer').remove();

    $.post('/api/posts/likes/users',
    {
        id: post_id
    }, function (data) {
        if (data.message == true && data.users != null) {
            for (let count = 0; count < data.users.length; count++) {
                let ud = data.users[count];
                let username = ud.username;
                let fullname = ud.fullname;
                let avatar = ud.avatar;
                target.append(clone);
                target.find('#username').text('@' + username);
                target.find('#username').attr('id', 'username' + count);
                target.find('#fullname').text(fullname);
                target.find('#fullname').attr('id', 'fullname' + count);
                target.find('#user-avatar').attr('src', avatar);
                target.find('#user-avatar').attr('id', 'user-avatar' + count);
                target.find('#link').attr('href', '/profile/' + username);
                target.find('#link').attr('id', 'link' + count);
            }
        } else {
            $('<h5 class="text-center my-5"><i class="bi bi-exclamation-triangle me-2"></i>No liked users found</h5>').prependTo(modal.find('.modal-body').empty())
        }
    });
});

//# sourceMappingURL=app.js.map