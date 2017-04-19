$( document ).ready(function() {
    $('#afegir').click(function () {
    	toggleAdd();
    })
    $('.close').click(function () {
        $('.alert-danger').remove();
    })
});

$( ".sectionHeader" ).on( "click", function() {
	var section = $(this).parent().children(".sectionBody");

    if ($(this).parent().is('#aprovats')) {
        localStorage.aprovats = state('aprovats');
     }
     else if($(this).parent().is('#pendents')){
        localStorage.pendents = state('pendents');
     }
     else if($(this).parent().is('#eliminats')){
        localStorage.eliminats = state('eliminats');
     }
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

function state(id) {
    var e = $('#'+id).children( ".sectionBody" );
    if (e.is(":visible")) {
        console.log('not visible');
        return false;

    }
    else{
        console.log('visible');
        return true;
    }

}

function close(id) {
    console.log('exec');
    //sectionBody hidden
    var s = $('#'+id).children(".sectionBody");
    s.slideToggle();
    // add class rotate
    $('#'+id).children('.sectionHeader').children('i').toggleClass("rotate", 'non-rotate');

}