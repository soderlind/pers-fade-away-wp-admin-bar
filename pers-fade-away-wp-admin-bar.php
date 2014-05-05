<?php
/*
Plugin Name: PerS Fade Away WordPress Admin Bar
Plugin URI: http://soderlind.no/archives/2011/02/25/fade-away-wordpress-admin-bar/
Description: Fade away the WordPress Admin Bar when you scroll down the page.
Version: 1.0.2
Author: PerS
Author URI: http://soderlind.no
*/

/*
Change log:
	1.0.2 - Tested with WordPress 3.9
	1.0.1 - Thanks to @TheFrosty, added is_admin_bar_showing()
    1.0.0 - initial release
*/

if (!class_exists('ps_pers_fade_wp_admin_bar')) {
    class ps_pers_fade_wp_admin_bar {
		var $url = '';
		function __construct(){
			$this->url = plugins_url(basename(__FILE__), __FILE__);
			add_action('wp_enqueue_scripts', array(&$this,'ps_pers_fade_wp_admin_bar_script'));
		}
		function ps_pers_fade_wp_admin_bar_script() {
				if (is_admin_bar_showing()) {
					wp_enqueue_script('ps_pers_fade_wp_admin_bar_script', $this->url.'?ps_pers_fade_wp_admin_bar_javascript', array('jquery'),'1.0.2',true); // embed javascript, see end of this file
				}
			}
	} //End Class
} //End if class exists statement



if (isset($_GET['ps_pers_fade_wp_admin_bar_javascript'])) {
	//embed javascript
	Header("content-type: application/x-javascript");
	echo<<<ENDJS
/**
* @desc PerS Fade Away WP Admin Bar
* @author PerS - http://soderlind.no
*/
// Script from http://tympanus.net/codrops/2009/12/11/fixed-fade-out-menu-a-css-and-jquery-tutorial/
jQuery(document).ready(function(){
		jQuery(window).scroll(function(){
			var scrollTop = jQuery(window).scrollTop();
			if(scrollTop != 0)
				jQuery('#wpadminbar').stop().animate({'opacity':'0.2'},400);
			else
				jQuery('#wpadminbar').stop().animate({'opacity':'1'},400);
		});

		jQuery('#wpadminbar').hover(
			function (e) {
				var scrollTop = jQuery(window).scrollTop();
				if(scrollTop != 0){
					jQuery('#wpadminbar').stop().animate({'opacity':'1'},400);
				}
			},
			function (e) {
				var scrollTop = jQuery(window).scrollTop();
				if(scrollTop != 0){
					jQuery('#wpadminbar').stop().animate({'opacity':'0.2'},400);
				}
			}
		);
});

ENDJS;

} else {
	if (class_exists('ps_pers_fade_wp_admin_bar')) { 
    	$ps_pers_fade_wp_admin_bar_var = new ps_pers_fade_wp_admin_bar();
	}
}
?>