// var query = $(".card-body > nav > a");

// query.on('click', function() {
//     // Change the active tab
//     query.each(function () {
//         selector.removeClass("active");
//     });
//     selector.addClass("active");
// })

// $.post("/api/posts/count?mode=user", function(o) {
//     console.log(o), $("#totalUserPosts").text(o.count)
// })

function submitForm() {
    // Get the image file from the input element
    const imageFile = document.getElementById('postImage').files[0];

    // Create a new FormData object
    const formData = new FormData();

    // Add the image file to the FormData object
    formData.append('form-image', imageFile);

    // Send the form data via AJAX to PHP
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/api/posts/create');
    xhr.send(formData);
}
