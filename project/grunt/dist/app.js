/* Processed by Grunt on 19/1/2023 @13:48:18 */


// init Masonry
var $grid = $('#masonry-area').masonry({
    // itemSelector: '.col',
    // columnWidth: '.col',
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
    console.log(visitorId);
    $("#fingerprint").val(visitorId);
})


// Delete post
$('.btn-delete').on('click', function(){
    post_id = $(this).parent().attr('data-id');
    d = new Dialog("Delete Post ?", "You want to permanently delete this post?");
    d.setButtons([
        {
            'name': "Delete",
            "class": "btn-danger",
            "onClick": function(event){
                console.log(`Assume this post ${post_id} is deleted`);
                // $(`#post-${post_id}`).remove();
                
                $.post('/api/posts/delete',
                {
                    id: post_id
                }, function(data, textSuccess, xhr){
                    console.log(textSuccess);
                    console.log(data);

                    if(textSuccess =="success" ){ //means 200
                        $(`#post-${post_id}`).remove();
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

// Password Toggle Button
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#floatingPassword");

togglePassword.addEventListener("click", function () {
// toggle the type attribute
const type = password.getAttribute("type") === "password" ? "text" : "password";
password.setAttribute("type", type);

// toggle the eye icon
const togglePasswordbtn = document.querySelector("#togglePasswordbtn");

togglePasswordbtn.classList.toggle("fa-eye");
togglePasswordbtn.classList.toggle("fa-eye-slash");
});

// Confirm Password Toggle Button
const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
const Confirmpassword = document.querySelector("#floatingConfirmPassword");

toggleConfirmPassword.addEventListener("click", function () {
// toggle the type attribute
const type = Confirmpassword.getAttribute("type") === "password" ? "text" : "password";
Confirmpassword.setAttribute("type", type);

// toggle the eye icon
const toggleConfirmPasswordbtn = document.querySelector(
    "#toggleConfirmPasswordbtn"
);

toggleConfirmPasswordbtn.classList.toggle("fa-eye");
toggleConfirmPasswordbtn.classList.toggle("fa-eye-slash");
});
//# sourceMappingURL=app.js.map