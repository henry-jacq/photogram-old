/* Processed by Grunt on 19/4/2023 @11:27:15 */


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
const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3').then(FingerprintJS => FingerprintJS.load())

// Get the visitor identifier when you need it.
fpPromise.then(fp => fp.get()).then(result => {
    // This is the visitor identifier:
    const visitorId = result.visitorId;
    $("#fingerprint").val(visitorId);
})

// Disable right-click on Images
$('img').on("contextmenu", function () {
	return false;
});

// Disable Image Dragging
$("img").mousedown(function(e){
    e.preventDefault()
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
// Count only user posts

if (window.location.pathname === "/profile") {
  $.post("/api/posts/count?mode=user", function (o) {
    $("#totalUserPosts").text(o.count);
  });
}


//# sourceMappingURL=app.js.map