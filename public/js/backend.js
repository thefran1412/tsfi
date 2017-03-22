$( document ).ready(function() {
    
});

$( ".sectionHeader" ).on( "click", function() {
	var section = $(this).parent().children(".sectionBody");
	section.slideToggle();
	 $(this).children('i').toggleClass("rotate", 'non-rotate');
});