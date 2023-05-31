// Update profile details
if (window.location.pathname === "/edit-profile") {
    $('.user-form-data').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        let thisBtn = $(this);
        let saveBtn = $('.btn-save-data');
        let spinner = `<div class="spinner-border spinner-border-sm me-1" role="status"><span class="visually-hidden">Loading...</span></div>`;

        saveBtn.attr('disabled', true);
        saveBtn.html(spinner + 'Updating...');

        $.ajax({
            url: '/api/users/profile/update',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.message == 'Updated' || response.message == 'Created') {
                    saveBtn.attr('disabled', false);
                    saveBtn.html('Update profile');
                    if ($('.alert.alert-primary.alert-dismissible.fade.show').length === 0) {
                        var successMessage = $('<div>').addClass('alert alert-primary alert-dismissible fade show').html('<i class="bi bi-info-circle me-2"></i>Profile was successfully updated<button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>');
                        $(successMessage).insertBefore(thisBtn);
                    }
                }
            },
            error: function (error) {
                console.error('Error while updating:', error);
            }
        });
    });
}
