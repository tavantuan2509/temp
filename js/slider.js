/**
 * Flexslider Setup
 *
 * Adds the Flexslider Plugin for the Featured Post Slideshow
 *
 * @package test
 */

jQuery( document ).ready(function($) {

	/* Add flexslider to #post-slider div */
	$( "#post-slider" ).flexslider({
		animation: test_slider_params.animation,
		slideshowSpeed: test_slider_params.speed,
		namespace: "zeeflex-",
		selector: ".zeeslides > li",
		smoothHeight: true,
		pauseOnHover: true,
		controlNav: false,
		controlsContainer: ".post-slider-controls"
	});

});
