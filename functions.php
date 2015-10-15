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
function add_first_and_last_class_to_menu( $items ) {
    $items[1]->classes[] = 'first';
    $items[count($items)]->classes[] = 'last';
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'add_first_and_last_class_to_menu' );


/**
 * Displays a generic call-to-action button.
 * $attrs array allows for arbitrary element attributes to be passed to the
 * generated <a> tag.
 **/
function display_cta_btn( $url, $text, $classes='', $id='' ) {
	$classes = 'ga-event-link btn btn-primary btn-cta ' . $classes;
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
	$text = get_post_meta( $post_id, 'cluster_cta_text', true );
	$url = get_post_meta( $post_id, 'cluster_cta_url', true );

	if ( $text && $url ) {
		return display_cta_btn( $url, $text, $classes . ' btn-block', $id );
	}
	else {
		return;
	}
}


/**
 * Display's the site title's markup based on the current page.
 **/
function display_site_title() {
	$elem = 'span';
	$primary_text = $secondary_text = null;
	$title_markup = '';

	// Home page <h1> with primary and secondary title text
	if ( is_home() || is_front_page() ) {
		$elem = 'h1';
		$primary_text = get_theme_mod_or_default( 'home_header_text_primary' );
		$secondary_text = get_theme_mod_or_default( 'home_header_text_secondary' );

		ob_start();
	?>

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

	<?php
		$title_markup = ob_get_clean();
	}

	// Subpage <span> title text
	else {
		$secondary_text = get_bloginfo( 'name' );

		ob_start();
	?>

		<span class="site-title-secondary"><?php echo wptexturize( $secondary_text ); ?></span>

	<?php
		$title_markup = ob_get_clean();
	}

	ob_start();
?>
	<<?php echo $elem; ?> id="site-title" class="clearfix">
		<a href="<?php echo get_bloginfo( 'url' ); ?>">
			<?php echo $title_markup; ?>
		</a>
	</<?php echo $elem; ?>>
<?php
	return ob_get_clean();
}


/**
 * Enable shortcodes to be used inside of widgets.
 **/
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Open Position widget
 **/
class OpenPosition_Widget extends WP_Widget {

	/**
	 * Constructor
	 **/
	public function __construct() {
		parent::__construct(
			'openposition_widget',
			__( 'Open Position' ),
			array( 'description' => __( 'Use to display an open faculty position on the home page, subpages, and wherever the [cluster-open-positions-list] shortcode is used.' ), )
		);
	}

	/**
	 * Display Logic
	 *
	 * @param array $args
	 * @param array $instance
	 **/
	public function widget( $args, $instance ) {
		$position_name = ( $instance['name'] ) ? $instance['name'] : '';
		$position_url  = ( $instance['url'] ) ? $instance['url'] : '';
		$college       = ( $instance['college'] ) ? $instance['college'] : '';

		ob_start();

		?>
		<li class="open-position">
			<a href="<?php echo $position_url; ?>">
				<span class="open-position-name"><?php echo $position_name; ?></span>

				<?php if ( $college ): ?>
				<span class="open-position-college"><?php echo $college; ?></span>
				<?php endif; ?>
			</a>
		</li>
		<?php

		echo ob_get_clean();
	}

	/**
	 * Definition of admin form
	 *
	 * @param array $instance The widget options
	 **/
	public function form( $instance ) {
		$position_name = ( isset( $instance['name'] ) ) ? $instance['name'] : __( 'Position Name' );
		$position_url  = ( isset( $instance['url'] ) ) ? $instance['url'] : __( 'https://www.jobswithucf.com/' );
		$college       = ( isset( $instance['college'] ) ) ? $instance['college'] : __( 'College Name' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php echo __( 'Position Name:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $position_name ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php echo __( 'Position URL:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $position_url ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'college' ); ?>"><?php echo __( 'College Name:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'college' ); ?>" name="<?php echo $this->get_field_name( 'college' ); ?>" type="text" value="<?php echo esc_attr( $college ); ?>">
		</p>
		<?php
	}

	/**
	 * Defines update logic
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 **/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : 'https://www.jobswithucf.com/';
		$instance['college'] = ( ! empty( $new_instance['college'] ) ) ? strip_tags( $new_instance['college'] ) : '';

		return $instance;
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'OpenPosition_Widget' );
} );


?>
