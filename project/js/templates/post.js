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

// It will like the post if the image is double clicked
// $(".post-card-image").dblclick(function(){
//     var selector = $(this).next().find('.btn-group').find('.btn-like');
//     likeBtn(selector);
// });

// It will like the post when the user clicks on the like button
$('.btn-like').on('click', function() {
    let thisBtn = $(this);
    let post_id = $(this).attr('data-id');
    
    $.post('/api/posts/like',
    {
        id: post_id
    }, function(data, textSuccess){
        if(textSuccess =="success"){
            likeBtn($(thisBtn), data.message, true);
        } else {
            console.error("Can't like the post ID: "+post_id);
        }
    });
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