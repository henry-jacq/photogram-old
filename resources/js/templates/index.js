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