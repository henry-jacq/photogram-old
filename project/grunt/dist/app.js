/* Processed by Grunt on 10/1/2023 @16:24:29 */


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

//# sourceMappingURL=app.js.map