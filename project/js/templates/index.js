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

if (window.location.pathname === "/") {
    Dropzone.autoDiscover = false;
    
    // Initializing Dropzone
    var myDropzone = new Dropzone(".dropzone", {
        url: "/api/posts/create",
        paramName: "file",
        maxFilesize: 5,
        maxFiles: 1,
        acceptedFiles:".png,.jpeg,.webp,.jpg,.gif,.mp4,",
        autoProcessQueue: false
    });
      
    // Upload post
    $('#upload_btn').on('click', function(e){
        e.preventDefault();
        myDropzone.processQueue();
        myDropzone.on("queuecomplete", function(e) {
            location.reload();
        });
    });
    
    // Disable if no files are uploaded
    setInterval(() => {
        if (myDropzone.files.length !== 0) {
            $('#upload_btn').attr('disabled', false);
        } else {
            $('#upload_btn').attr('disabled', true);
        }
    }, 500);
    
    // Reset the form
    $('#reset_btn').on('click', function(){     
        $('[name=post_text]').val('');
        if (myDropzone.files.length != 0) {
            myDropzone.removeAllFiles();
        }
    });
}

// Character limit on post text
$(document).ready(function() {
  const myInput = $('[name=post_text]');
  const charCount = $('#total_chars');
  const maxLength = 240;

  myInput.on('input', function() {
    const length = myInput.val().length;

    charCount.removeClass('visually-hidden');

    if (length > maxLength) {
      const truncatedValue = myInput.val().slice(0, maxLength);
      myInput.val(truncatedValue);
    }
    
    charCount.text(`${myInput.val().length}/${maxLength}`);
  });
});
