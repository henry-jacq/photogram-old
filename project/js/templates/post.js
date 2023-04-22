// Change the cursor to pointer
$('.btn-like, .btn-share').mouseover(function () { 
    $(this).css('cursor','pointer');
});

// Disable user selection for buttons
$('.btn-group').mouseover(function () { 
    $(this).css('user-select', 'none');
});

// Change like button status
$('.btn-like').on('click', function(){  
    var likeBtnID = $(this).find('i').attr('id');
    var likeBtnSelector = $('#'+likeBtnID);
    var currentLikes = parseInt($(this).find('span').text());  

    if (likeBtnSelector.hasClass('fa-heart-o')) {
        likeBtnSelector.removeClass('fa-heart-o');
        likeBtnSelector.addClass('fa-heart text-danger')
        $(this).find('span').text(currentLikes += 1);
    } else if (likeBtnSelector.hasClass('fa-heart text-danger')) {
        if (currentLikes != 0) {
            likeBtnSelector.removeClass('fa-heart text-danger');
            likeBtnSelector.addClass('fa-heart-o');
            $(this).find('span').text(currentLikes -+ 1);
        }
    }
});

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
                        $(`#post-${post_id}`).remove();
                        // window.location.href = "/";
                        $grid.masonry('layout');
                        new Toast("Photogram", "1 seconds ago", "Your post was successfully deleted!", {}).show();
                    } else {
                        new Toast("Photogram", "1 seconds ago", "cannot delete your post!", {}).show();
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