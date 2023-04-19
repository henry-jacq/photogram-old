// var query = $(".card-body > nav > a");

// query.on('click', function() {
//     // Change the active tab
//     query.each(function () {
//         $(this).removeClass("active");
//     });
//     $(this).addClass("active");
// })

// $.post("/api/posts/count?mode=user", function(o) {
//     console.log(o), $("#totalUserPosts").text(o.count)
// })

var html = `
<form class="my-3" action="/api/posts/upload" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="postImage" class="form-label">Add a photo that you want to share!</label>
        <input class="form-control" accept="image/*" name="post_image" type="file" id="postImage" required>
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" name="post_text" placeholder="Say something..." id="postText" style="height: 100px;"></textarea>
        <label for="postText">Say something...</label>
    </div>
    <button type="submit" formaction="/api/posts/upload" class="btn btn-success">Upload</button>
</form>
`;


function submitForm() {
    // Get the image file from the input element
    const imageFile = document.getElementById('postImage').files[0];

    // Create a new FormData object
    const formData = new FormData();

    // Add the image file to the FormData object
    formData.append('form-image', imageFile);

    // Send the form data via AJAX to PHP
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/api/posts/upload');
    xhr.send(formData);
}



$(document.body).ready(function() {
    // Upload post
    $("#postUploadButton").on("click", function () {
        display_form_dialog('Create Post');
        let myDropzone = new Dropzone(".dropzone-default", { url: "/api/posts/upload"});
        myDropzone.processQueue();
    });    
});

// var myDropzone = new myDropzone(".dropzone", {
//     url: '/api/posts/upload',
//     parallelUploads: 3,
//     uploadMultiple: true,
//     acceptedFiles: '.png,.jpg,.jpeg,.gif',
//     autoProcessQueue: false
// });


myDropzone.processQueue()

