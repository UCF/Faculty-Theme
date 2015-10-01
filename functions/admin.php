<?php

if ( is_login() ) {
	add_action( 'login_head', 'login_scripts', 0 );
}

if ( is_admin() ) {
	add_action( 'admin_menu', 'create_utility_pages' );
}


function shortcode_interface_html() {
	global $shortcode_tags;
	$shortcodes = $shortcode_tags;
	$ignore     = array(
		"wp_caption" => null,
		"caption"    => null,
		"gallery"    => null,
		"embed"      => null,
	);
	$shortcodes = array_diff_key( $shortcodes, $ignore );
	ksort( $shortcodes );
?>
	<input type="hidden" name="shortcode-form" id="shortcode-form" value="<?php echo THEME_URL . '/includes/shortcode-form.php'; ?>">
	<input type="hidden" name="shortcode-text" id="shortcode-text" value="<?php echo THEME_URL . '/includes/shortcode-text.php'; ?>">
	<input type="text" name="shortcode-search" id="shortcode-search" placeholder="Find shortcodes...">
	<button type="button">Search</button>

	<ul id="shortcode-results" class="empty">
	</ul>

	<p>Or select:</p>
	<select name="shortcode-select" id="shortcode-select">
		<option value="">--Choose Shortcode--</option>
		<?php foreach ( $shortcodes as $name=>$callback ):?>
		<option class="shortcode" value="<?php echo $name; ?>"><?php echo $name; ?></option>
		<?php endforeach; ?>
	</select>

	<p>For more information about available shortcodes, please see the <a href="<?php echo get_admin_url(); ?>admin.php?page=theme-help#shortcodes">help documentation for shortcodes</a>.</p>
	<?php
}


function shortcode_interface() {
	add_meta_box( 'shortcodes-metabox', __( 'Shortcodes' ), 'shortcode_interface_html', 'page', 'side', 'core' );
	add_meta_box( 'shortcodes-metabox', __( 'Shortcodes' ), 'shortcode_interface_html', 'post', 'side', 'core' );
	foreach ( Config::$custom_post_types as $type ) {
		$instance = new $type;
		if ( $instance->options( 'use_editor' ) ) {
			add_meta_box( 'shortcodes-metabox', __( 'Shortcodes' ), 'shortcode_interface_html', $instance->options( 'name' ), 'side', 'core' );
		}
	}
}
add_action( 'add_meta_boxes', 'shortcode_interface' );


/**
 * Prints out additional login scripts, called by the login_head action
 *
 * @return void
 * @author Jared Lang
 * */
function login_scripts() {
	ob_start();?>
	<link rel="stylesheet" href="<?php echo THEME_CSS_URL; ?>/admin.css" type="text/css" media="screen" charset="utf-8">
	<?php
	$out = ob_get_clean();
	print $out;
}


/**
 * Registers the theme options page with wordpress' admin.
 *
 * @return void
 * @author Jared Lang
 * */
function create_utility_pages() {
	add_utility_page(
		__( 'Help' ),
		__( 'Help' ),
		'edit_posts',
		'theme-help',
		'theme_help_page',
		'dashicons-editor-help'
	);
}


/**
 * Outputs theme help page
 *
 * @return void
 * @author Jared Lang
 * */
function theme_help_page() {
	include THEME_INCLUDES_DIR . '/theme-help.php';
}


/**
 * Modifies the default stylesheets associated with the TinyMCE editor.
 *
 * @return string
 * @author Jared Lang
 * */
function editor_styles( $css ) {
	$css   = array_map( 'trim', explode( ',', $css ) );
	$css   = implode( ',', $css );
	return $css;
}
add_filter( 'mce_css', 'editor_styles' );


/**
 * Add/remove TinyMCE button sets in 1st row of buttons.
 **/
function editor_format_options( $buttons ) {
	// Remove 'More'
	$found = array_search( 'wp_more', $buttons );
	if ( False !== $found ) {
		unset( $buttons[$found] );
	}

	return $buttons;
}
add_filter( 'mce_buttons', 'editor_format_options' );


/**
 * Add/remove TinyMCE button sets in 2nd row of buttons.
 *
 * @return array
 * @author Jared Lang
 * */
function editor_format_options_2( $buttons ) {
	// Remove 'underline'
	$found = array_search( 'underline', $buttons );
	if ( False !== $found ) {
		unset( $buttons[$found] );
	}

	// Remove 'indent'/'outdent'
	$found = array_search( 'indent', $buttons );
	if ( False !== $found ) {
		unset( $buttons[$found] );
	}
	$found = array_search( 'outdent', $buttons );
	if ( False !== $found ) {
		unset( $buttons[$found] );
	}

	// Add font size dropdown
	array_unshift( $buttons, 'fontsizeselect' );

	// Add 'Formats' dropdown
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
add_filter( 'mce_buttons_2', 'editor_format_options_2' );


/**
 * Force the WYSIWYG editor's kitchen sink to always be open.
 **/
function unhide_kitchensink( $args ) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}
add_filter( 'tiny_mce_before_init', 'unhide_kitchensink' );


/**
 * Add custom formats to the TinyMCE editor.
 **/
function add_formats_to_tinymce( $settings ) {
	// Text, list formatting options
	$style_formats = array(
		array(
			'title' => 'Text Formatting',
			'items' => array(
				array(
					'title' => 'UPPERCASE',
					'inline' => 'span',
					'classes' => 'text-uppercase'
				),
				array(
					'title' => 'lowercase',
					'inline' => 'span',
					'classes' => 'text-lowercase'
				),
				array(
					'title' => 'None (unset)',
					'inline' => 'span',
					'classes' => 'text-transform-none'
				),
			),
		),
	);

	$settings['style_formats'] = json_encode( $style_formats );
	$settings['theme_advanced_buttons2_add_before'] = 'styleselect'; // Add 'Format' button at beginning of 2nd row of btns
	$settings['fontsize_formats'] = '10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 32px 36px 42px 48px 52px 58px 62px';

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'add_formats_to_tinymce' );


/**
 * Remove paragraph tag from excerpts
 * */
remove_filter( 'the_excerpt', 'wpautop' );


/**
 * Enqueue custom stylesheet for TinyMCE
 **/
function add_custom_tinymce_stylesheet() {
	add_editor_style( THEME_CSS_URL . '/tinymce.css' );
}
add_action( 'admin_init', 'add_custom_tinymce_stylesheet' );


/**
 * Enqueue the scripts and css necessary for the WP Media Uploader on
 * all admin pages
 * */
function enqueue_wpmedia_throughout_admin() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'enqueue_wpmedia_throughout_admin' );


/**
 * Add 'iconOrThumb' value to js-based attachment objects (for wp.media)
 * */
function add_icon_or_thumb_to_attachmentjs( $response, $attachment, $meta ) {
	$response['iconOrThumb'] = wp_attachment_is_image( $attachment->ID ) ? $response['sizes']['thumbnail']['url'] : $response['icon'];
	return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'add_icon_or_thumb_to_attachmentjs', 10, 3 );


/**
 * Hide unused admin tools
 **/
function hide_admin_links() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'hide_admin_links' );

?>
