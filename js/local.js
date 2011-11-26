// initialise superfish
jQuery(function(){
	jQuery('ul.sf-menu').superfish();
	jQuery('ul.sub-menu').removeClass('sub-menu').addClass('l_sub_menu'); // move secondary menu to left column
});

// cycle
jQuery(document).ready(function($) {
   jQuery('.slideshow').cycle({
		fx: 'fade',
		timeout: 3000,
          slideResize: 1, 
		pause: 0
	});

});
