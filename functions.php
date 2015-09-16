<?php
require_once 'functions/base.php';    // Base theme functions
require_once 'functions/feeds.php';   // Where functions related to feed data live
require_once 'custom-taxonomies.php'; // Where per theme taxonomies are defined
require_once 'custom-post-types.php'; // Where per theme post types are defined
require_once 'functions/admin.php';   // Admin/login functions
require_once 'functions/config.php';  // Where per theme settings are registered
require_once 'shortcodes.php';        // Per theme shortcodes

//Add theme-specific functions here.


/**
 * Enqueues page-specific css.
 **/
function enqueue_custom_files() {
	global $post;

	if ( $post ) {
		$custom_css_id = get_post_meta( $post->ID, 'page_stylesheet', True );

		if ( $custom_css_id ) {
			wp_enqueue_style( $post->post_name.'-stylesheet', wp_get_attachment_url( $custom_css_id ) );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_files' );

?>
