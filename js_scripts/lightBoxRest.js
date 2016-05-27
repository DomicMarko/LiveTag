$(document).ready(function() {
	/*
	 *  Simple image gallery. Uses default settings
	 */

	/*
	 *  Different effects
	 */
		 
	// Remove padding, set opening and closing animations, close if clicked and disable overlay
	$(".fancybox-effects-d").fancybox({
		padding: 0,

		openEffect : 'elastic',
		openSpeed  : 150,

		closeEffect : 'elastic',
		closeSpeed  : 150,

		closeClick : true,

		helpers : {
			overlay : null
		}
	});
});