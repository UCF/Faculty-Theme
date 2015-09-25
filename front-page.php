<?php disallow_direct_load( 'front-page.php' ); ?>

<?php
get_header(); the_post();

$featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$header_content = get_theme_mod_or_default( 'home_header_content' );
$cta_url = get_theme_mod_or_default( 'home_header_cta_url' );
$cta_text = get_theme_mod_or_default( 'home_header_cta_text' );

if ( $cta_url && $cta_text ):
	$cta_markup = '';
	ob_start();
?>
<div id="home-header-cta">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-lg-offset-7 col-md-6 col-md-offset-6 col-sm-7 col-sm-offset-5">
				<a class="ga-event-link btn btn-primary btn-cta" href="<?php echo $cta_url; ?>">
					<?php echo $cta_text; ?>
				</a>
			</div>
		</div>
	</div>
</div>
<?php
	$cta_markup = ob_get_clean();

	$header_content .= $cta_markup;
endif;
?>

<main id="<?php echo $post->post_name; ?>">

	<?php
	if ( $featured_image ) {
		echo display_parallax_image( $featured_image, array( 'id' => 'parallax-home-header' ), $header_content );
	}
	?>

	<article class="page-content">
		<div class="container">
			<?php echo do_shortcode( '[faculty_cluster-open-positions-list]' ); ?>
			<?php the_content(); ?>
		</div>
	</article>

</main>

<?php get_footer(); ?>
