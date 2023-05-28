// Update profile details
if (window.location.pathname === "/edit-profile") {
    $('.user-form-data').on('submit', function (e) {
        e.preventDefault();
        let thisBtn = $(this);
        const formData = new FormData(this);
        const fieldValue = formData.get('fname');
        $.post("/api/users/update",
        {
            fname: formData.get('fname'),
            lname: formData.get('lname'),
            email: formData.get('email'),
            job: formData.get('job'),
            bio: formData.get('bio'),
            location: formData.get('location'),
            twitter: formData.get('twitter'),
            instagram: formData.get('instagram'),
        }, function (data, textStatus) {
            if (textStatus == 'success') {
                if ($('.alert.alert-primary.alert-dismissible.fade.show').length === 0) {
                    var successMessage = $('<div>').addClass('alert alert-primary alert-dismissible fade show').html('<i class="bi bi-info-circle me-2"></i>Profile was successfully updated<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>');
                    $(successMessage).insertBefore(thisBtn);
                } else {
                    console.error('Something went wrong!');
                }
            } else if (textStatus == 'error') {
                if ($('.alert.alert-danger.alert-dismissible.fade.show').length === 0) {
                    var successMessage = $('<div>').addClass('alert alert-danger alert-dismissible fade show').html('<i class="bi bi-exclamation-circle me-2"></i>Failed to update profile<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>');
                    $(successMessage).insertBefore(thisBtn);
                } else {
                    console.error('Something went wrong!');
                }
            }
        });
    });
}
