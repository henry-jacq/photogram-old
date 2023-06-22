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
    let ptext = el.find('.card-text').text();
    const message = `<div class="container my-3"><p class="form-label">Change post text:</p><textarea class="form-control post-text" name="post_text" rows="5" placeholder="Say something...">${ptext}</textarea><p class="total-chars visually-hidden text-end mt-2"></p></div>`;
    let d = new Dialog('<i class="bi bi-pencil me-2"></i>Edit Your Post', message);
    d.setButtons([
        {
            'name': "Close",
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
                            el.find('.card-text').text(ptxt);
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
