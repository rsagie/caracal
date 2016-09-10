jQuery(document).ready(function($) {

	// Masonry
   	var $container = $('#masonry');
	// initialize
	$container.masonry({
  		columnWidth: '.hentry',
  		itemSelector: '.hentry',
		//gutter: 10
	});

// Masonry & Infinity
var infiniteCount = 1;
    $( document.body ).on( 'post-load', function () {
        var elements = $('.infinite-wrap.infinite-view-' + infiniteCount + ' article');
        $('#masonry').masonry( 'appended', elements );
        infiniteCount++;
    });


});