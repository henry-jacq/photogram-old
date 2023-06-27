$('.btn-bookmark').on('click', function() {
    var icon = $(this).find('i');
    if (icon.hasClass('fa-regular')) {
        icon.removeClass('fa-regular');
        icon.addClass('fa-solid');
    } else {
        icon.removeClass('fa-solid');
        icon.addClass('fa-regular');
    }
})
