// Change the cursor to pointer
$('.btn-like, .btn-share').mouseover(function () { 
    $(this).css('cursor','pointer');
});

// Disable user selection for buttons
$('.btn-group').mouseover(function () { 
    $(this).css('user-select', 'none');
});

// Change like button status
function likeBtn(mainSelector) {
    var likeBtnID = mainSelector.find('i').attr('id');
    var likeBtnSelector = $('#'+likeBtnID);
    var currentLikes = parseInt(mainSelector.find('span').text());  

    if (likeBtnSelector.hasClass('fa-heart-o')) {
        likeBtnSelector.removeClass('fa-heart-o');
        likeBtnSelector.addClass('fa-heart text-danger')
        mainSelector.find('span').text(currentLikes += 1);
    } else if (likeBtnSelector.hasClass('fa-heart text-danger')) {
        if (currentLikes != 0) {
            likeBtnSelector.removeClass('fa-heart text-danger');
            likeBtnSelector.addClass('fa-heart-o');
            mainSelector.find('span').text(currentLikes -+ 1);
        }
    }
}

// It will like the post if the image is double clicked
$(".post-card-image").dblclick(function(){
    var selector = $(this).next().find('.btn-group').find('.btn-like');
    likeBtn(selector);
});

// It will like the post on click on like button
$('.btn-like').on('click', function(){  
    likeBtn($(this));
});

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
        new Toast("Photogram", "Just Now", "Copied the post link to the clipboard!").show();
    } else {
        console.error("Can't copy the post link!");
        new Toast("Photogram", "Just Now", "Can't copy the post link to the clipboard!").show();
    }   
});