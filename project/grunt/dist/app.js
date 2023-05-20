/* Processed by Grunt on 20/5/2023 @17:28:11 */


// init Masonry
var $grid = $('#masonry-area').masonry({
    percentPosition: true
});

// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
    $grid.masonry('layout');
});


// Fingerprint
// Initialize the agent at application startup.
fetch('https://openfpcdn.io/fingerprintjs/v3').then(response => {
    if (response.ok) {
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3').then(FingerprintJS => FingerprintJS.load())

        // Get the visitor identifier when you need it.
        fpPromise.then(fp => fp.get()).then(result => {
            // This is the visitor identifier:
            const visitorId = result.visitorId;
            if ($("#fingerprint")) {
                $("#fingerprint").val(visitorId);
            }
        })
    }
})

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

            // Upload post
            $('.btn-upload').on('click', function (e) {
                e.preventDefault();
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

            // Disable buttons if there is no data in the form
            setInterval(() => {
                if (myDropzone.files.length > 0) {
                    $('.btn-reset, .btn-upload').prop('disabled', false);
                } else {
                    $('.btn-reset, .btn-upload').prop('disabled', true);
                }
            }, 500);
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

// Change the cursor to pointer
$('.btn-like, .btn-share').mouseover(function () { 
    $(this).css('cursor','pointer');
});

// Change like button status
function likeBtn(mainSelector, status=null, isClicked=false) {
    var likeBtnID = mainSelector.find('i').attr('id');
    var likeBtnSelector = $('#'+likeBtnID);
    var currentLikes = parseInt(mainSelector.find('span').text());  

    if (status == true) {
        if (likeBtnSelector.hasClass('fa-heart-o')) {
            likeBtnSelector.removeClass('fa-heart-o');
            likeBtnSelector.addClass('fa-heart text-danger')
            if (isClicked == true) {
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

// Keep the like(heart-filled) if the user already liked it.
$('.btn-like').each(function () {
    let thisBtn = $(this);
    let post_id = $(this).attr('data-id');

    $.post('/api/posts/like',
    {
        postID: post_id
    }, function(data, textSuccess){
        if(textSuccess =="success"){
            likeBtn($(thisBtn), data.message, false);
        } else {
            console.error("Can't like the post ID: "+post_id);
        }
    });
});

// Toggle likes
function likePost(selector, post_id) {
    if (selector !== undefined && post_id !== undefined) {
        $.post('/api/posts/like',
        {
            id: post_id
        }, function(data, textSuccess){
            if(textSuccess =="success"){
                likeBtn(selector, data.message, true);
            } else {
                console.error("Can't like the post ID: "+post_id);
            }
        });
    }
}

// It will like the post if the image is double clicked
$(".post-card-image").dblclick(function(){
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
                        $grid.masonry('remove', $(`#post-${post_id}`)).masonry('layout');
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
$('.btn-copy-link').on('click', function(){
    textToCopy = window.location.origin + $(this).attr('value');
    
    if (navigator.clipboard) {
        navigator.clipboard.writeText(textToCopy);
        showToast("Photogram", "Just Now", "Copied the post link to the clipboard!");
    } else {
        console.error("Can't copy the post link!");
        showToast("Photogram", "Just Now", "Can't copy the post link to the clipboard!");
    }   
});

// Download the post image
$('.btn-download').on('click', function (e) {
    if (!this.hasAttribute('href')) {
        e.preventDefault();
        // Getting the original image URL
        url = window.location.origin + $(this).attr('value');
        // Fetch post image and returning response as blob
        fetch(url).then(res => res.blob()).then(file => {
            let tempURL = URL.createObjectURL(file);
            // Passing tempURL as href value
            this.setAttribute('href', tempURL)
            // Passing filename and extension as download value
            this.setAttribute('download', url.replace(/^.*[\\\/]/, ''))
            // Remove value attribute
            this.removeAttribute('value');
            // Clicking this so the image downloads
            this.click();
            URL.revokeObjectURL(tempURL);
        }).catch((e) => {
            console.error(e);
        });
    }
});
// Count only user posts

if (window.location.pathname === "/profile") {
  $.post("/api/posts/count?mode=user", function (o) {
    $("#totalUserPosts").text(o.count);
  });
}


//# sourceMappingURL=app.js.map