$(function () {
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        masonry.layout();
    });

    if ($(window).width() >= 768) {
        $("#wrapper").addClass("toggled");
        masonry.layout();
    }

    $(window).resize(function (e) {
        if ($(window).width() <= 768) {
            $("#wrapper").removeClass("toggled");
            masonry.layout();
        } else {
            $("#wrapper").addClass("toggled");
            masonry.layout();
        }
    });
});