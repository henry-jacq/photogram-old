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
$('.btn-like, .btn-share').mouseover(function () { 
    $(this).css('cursor','pointer');
});

// Change like button status
function likeBtn(mainSelector, status=null, isClicked=false) {
    var likeAudio = $('<audio>', {
        id: 'likePop',
        src: '/assets/like-pop.mp3'
    });
    $('body').append(likeAudio);
    var likeBtnID = mainSelector.find('i').attr('id');
    var likeBtnSelector = $('#'+likeBtnID);
    var currentLikes = parseInt(mainSelector.find('span').text());  

    if (status == true) {
        if (likeBtnSelector.hasClass('fa-heart-o')) {
            likeBtnSelector.removeClass('fa-heart-o');
            likeBtnSelector.addClass('fa-heart text-danger');
            if (isClicked == true && likeAudio[0].play()) {
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
$(".post-card-image, .carousel").dblclick(function(){
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
                        sl = document.querySelector(`#post-${post_id}`);
                        masonry.remove(sl);
                        masonry.layout();
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