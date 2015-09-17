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


/**
 * Returns a theme mod, the theme mod's default defined in
 * Config::$setting_defaults, or $fallback.
 **/
function get_theme_mod_or_default( $mod, $fallback='' ) {
	return get_theme_mod( $mod, get_setting_default( $mod, $fallback ) );
}


/**
 * Returns markup for displaying a parallax image.
 **/
function display_parallax_image( $image_url, $args=array() ) {
	if ( !$image_url ) { return ''; }

	$data_attrs = '';
	if ( is_array( $args ) ) {
		foreach ( $args as $key => $val ) {
			$data_attrs .= "{$key}=\"{$val}\" ";
		}
	}

	ob_start();
?>
	<div class="parallax-image" data-parallax="scroll" data-image-src="<?php echo $image_url; ?>" <?php echo $data_attrs; ?>></div>
<?php
	return ob_get_clean();
}


/**
 * TODO - fetch btn content, href from post
 * Display's a Faculty Cluster's call-to-action button.
 **/
function display_cluster_cta( $post_id, $classes='', $id='' ) {
	ob_start();
?>
	<a class="btn btn-primary btn-cta btn-block <?php echo $classes; ?>" <?php if ( $id ) { ?>id="<?php echo $id; ?>"<?php } ?> href="#">
		Apply Now for Open Cluster Positions
	</a>
<?php
	return ob_get_clean();
}

?>
