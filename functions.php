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
function display_parallax_image( $image_url, $attrs=array(), $content='' ) {
	if ( !$image_url ) { return ''; }

	$classes = '';
	$attrs_str = '';
	if ( is_array( $attrs ) ) {
		foreach ( $attrs as $key => $val ) {
			if ( $key !== 'class' ) {
				$attrs_str .= "{$key}=\"{$val}\" ";
			}
		}
		if ( isset( $attrs['class'] ) ) {
			$classes = $attrs['class'];
		}
	}

	ob_start();
?>
	<div class="parallax-container <?php echo $classes; ?>" <?php echo $attrs_str; ?>>
		<div class="parallax-container-inner">
			<div class="parallax" style="background-image: url('<?php echo $image_url; ?>')">
				<img src="<?php echo $image_url; ?>">
			</div>
		</div>

		<?php if ( $content ): ?>
		<div class="parallax-content">
			<?php echo do_shortcode( wptexturize( $content ) ); ?>
		</div>
		<?php endif; ?>
	</div>
<?php
	return ob_get_clean();
}


/**
* Adds a first and last class to respective menu items
**/
function add_first_and_last_class_to_menu($items) {
    $items[1]->classes[] = 'first';
    $items[count($items)]->classes[] = 'last';
    return $items;
}
add_filter('wp_nav_menu_objects', 'add_first_and_last_class_to_menu');


/**
 * Displays a generic call-to-action button.
 * $attrs array allows for arbitrary element attributes to be passed to the
 * generated <a> tag.
 **/
function display_cta_btn( $url, $text, $classes='', $id='' ) {
	$classes = 'btn btn-primary btn-cta ' . $classes;
	ob_start();
?>
	<a href="<?php echo $url; ?>" class="<?php echo $classes; ?>" <?php if ( $id ) { ?>id="<?php echo $id; ?>"<?php } ?>>
		<?php echo wptexturize( $text ); ?>
	</a>
<?php
	return ob_get_clean();
}


/**
 * Display's a Faculty Cluster's call-to-action button.
 **/
function display_cluster_cta_btn( $post_id, $classes='', $id='' ) {
	$text = get_post_meta( $post_id, 'faculty_cluster_cta_text', true );
	$url = get_post_meta( $post_id, 'faculty_cluster_cta_url', true );

	if ( !$text ) {
		$text = 'Apply Now for Open Cluster Positions';
	}
	if ( !$url ) {
		$url = '#';
	}

	return display_cta_btn( $url, $text, $classes . ' btn-block', $id );
}


/**
 * Display's the site title's markup based on the current page.
 **/
function display_site_title() {
	$primary_text = get_theme_mod_or_default( 'header_text_primary' );
	$secondary_text = get_theme_mod_or_default( 'header_text_secondary' );
	$elem = ( is_home() || is_front_page() ) ? 'h1' : 'span';

	ob_start();
?>
	<<?php echo $elem; ?> id="site-title" class="clearfix">
		<a href="<?php echo bloginfo( 'url' ); ?>">
			<?php if ( $primary_text ): ?>
			<span class="site-title-primary">
				<?php echo wptexturize( $primary_text ); ?>
			</span>
			<?php endif; ?>

			<?php if ( $secondary_text ): ?>
			<span class="site-title-secondary">
				<?php echo wptexturize( $secondary_text ); ?>
			</span>
			<?php endif; ?>
		</a>
	</<?php echo $elem; ?>>
<?php
	return ob_get_clean();
}

/**
 * Enable shortcodes to be used inside of widgets.
 **/
add_filter( 'widget_text', 'do_shortcode' );


?>
