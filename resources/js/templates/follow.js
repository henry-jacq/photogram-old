// Toggle follow button status
function toggleFollow(selector, status) {
    if (status == true) {
        selector.html('<i class="fa-solid fa-user-check fa-sm me-2"></i>Following');
    } else if (status == false) {
        selector.html('<i class="fa-solid fa-user-plus fa-sm me-2"></i>Follow');
    }
}

// Follow user
$('.btn-follow').on('click', function () {
    let selector = $(this);
    let follow_id = $(this).attr('data-id');

    $.post('/api/users/follow',
        {
            follower_id: follow_id
        }, function (data, textSuccess) {
            if (textSuccess == "success") {
                toggleFollow(selector, data.follow);
            } else {
                console.error("Can't follow user: " + follow_id);
            }
        });
});
