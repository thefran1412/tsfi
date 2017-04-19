$( document ).ready(function() {
    $('.subActions').click(function () {
    	toggleAdd();
    })
});

$( ".sectionHeader" ).on( "click", function() {
	var section = $(this).parent().children(".sectionBody");
	section.slideToggle();
	 $(this).children('i').toggleClass("rotate", 'non-rotate');
});

$( window ).scroll(function() {
    if ($(window).scrollTop() > 0) {
        $('.subHeader').addClass('bg');
        $('.headerRoute, .subActions').addClass('pad');
        $('.subActions').addClass('down');
    }
    else{
        $('.subHeader').removeClass('bg');
        $('.headerRoute, .subActions').removeClass('pad');
        $('.subActions').removeClass('down');
    }
});

function toggleAdd() {
	// console.log('clicked');
	$('#add').slideToggle();
}