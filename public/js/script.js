/* javascriptのコードを記載 */

$(function() {
//    var navPos = $('#header').offset().top;
    var navPos;

    $(window).on('scroll load', function() {
        if ($(this).scrollTop() > (navPos)) {
            $('#header').addClass('fixed');
        } else {
            $('#header').removeClass('fixed');
        }
    });

    $('.hamburger').click(function() {
        $(this).toggleClass('active');
 
        if ($(this).hasClass('active')) {
            $('#global-nav nav').addClass('active');
        } else {
            $('#global-nav nav').removeClass('active');
        }
    });

    $('#global-nav a').click(function () {
        $('.hamburger').removeClass('active');
        $('#global-nav nav').removeClass('active');
        return true;
    });
});

const $slider = $("#slider");
$slider
    /* .on("init", () => {
        mouseWheel($slider);
    }) */
.slick({
    dots: true,
    vertical: true,
    infinite: true, 
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
});

const $h_slider = $("#h_slider");
$h_slider
    /* .on("init", () => {
        mouseWheel($slider);
    }) */
.slick({
    dots: true,
    infinite: true, 
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
});

function mouseWheel($slider) {
    $(window).on("wheel", { $slider: $slider }, mouseWheelHandler);
}
function mouseWheelHandler(event) {
    event.preventDefault();
    const $slider = event.data.$slider;
    const delta = event.originalEvent.deltaY;
    if (delta > 0) {
        $slider.slick("slickPrev");
    } else {
        $slider.slick("slickNext");
    }
}

$(document).ready(function () {

	// if user clicked on button, the overlay layer or the dialogbox, close the dialog	
	$('#close, #dialog-overlay').click(function () {		
		$('#dialog-overlay, #dialog-box, #identify-dialog-box').hide();		
		return false;
	});
	
	// if user resize the window, call the same function again
	// to make sure the overlay fills the screen and dialogbox aligned to center	
	$(window).resize(function () {		
		//only do it if the dialog box is not hidden
//		if (!$('#dialog-box').is(':hidden')) popup();		
	});

    $('body').click(function() {
        if ($('#user-popup').hasClass('active') === true)
            $('#user-popup').removeClass('active');

        if ($('#news-popup').hasClass('active') === true)
            $('#news-popup').removeClass('active');

        if ($('#notify-popup').hasClass('active') === true)
            $('#notify-popup').removeClass('active');
    });

    $('#user-popup-menu').click(function() {
        $('#news-popup').removeClass('active');
        $('#notify-popup').removeClass('active');

        if ($('#user-popup').hasClass('active') === true)
            $('#user-popup').removeClass('active');
        else
            $('#user-popup').addClass('active');

        event.stopPropagation();
    });

    $('#news-popup-menu').click(function() {
        $('#user-popup').removeClass('active');
        $('#notify-popup').removeClass('active');

        if ($('#news-popup').hasClass('active') === true)
            $('#news-popup').removeClass('active');
        else
            $('#news-popup').addClass('active');

        event.stopPropagation();
    });

    $('#notify-popup-menu').click(function() {
        $('#user-popup').removeClass('active');
        $('#news-popup').removeClass('active');

        if ($('#notify-popup').hasClass('active') === true)
            $('#notify-popup').removeClass('active');
        else
            $('#notify-popup').addClass('active');

        event.stopPropagation();
    });
});

//Popup dialog
function loginPopup() {
		
	// get the screen height and width  
	var maskHeight = $(document).height();  
	var maskWidth = $(window).width()
	
	// assign values to the overlay and dialog box
	$('#dialog-overlay').css({height:maskHeight, width:maskWidth}).show();
	$('#dialog-box').css({
        top: ($(this).scrollTop() + ($('#dialog-box').height()/6)),
        left:((window.innerWidth/2) - ($('#dialog-box').width()/2))
      }).show();
}

function logoutPopup() {
		
	// get the screen height and width  
	var maskHeight = $(document).height();  
	var maskWidth = $(window).width()
	
	// assign values to the overlay and dialog box
	$('#dialog-overlay').css({height:maskHeight, width:maskWidth}).show();
	$('#dialog-box').css({
        top: ($(this).scrollTop() + ($('#dialog-box').height())),
        left:((window.innerWidth/2) - ($('#dialog-box').width()/2))
      }).show();
}

function identifyPopup() {
		
	// get the screen height and width  
	var maskHeight = $(document).height();  
	var maskWidth = $(window).width()
	
	// assign values to the overlay and dialog box
	$('#dialog-overlay').css({height:maskHeight, width:maskWidth}).show();
	$('#identify-dialog-box').css({
        top: ($(this).scrollTop() + ($('#identify-dialog-box').height()/6)),
        left:((window.innerWidth/2) - ($('#identify-dialog-box').width()/2))
      }).show();
}