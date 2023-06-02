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

// Fingerprint set as cookie when remember me is checked
if (window.location.pathname == '/login') {
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
}

// Disable right-click on Images
$('img').on("contextmenu", function () {
	return false;
});

// Disable Image Dragging
$("img").mousedown(function(e){
    e.preventDefault()
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
        $(document).ready(function () {
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
});