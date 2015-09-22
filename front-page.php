<?php disallow_direct_load( 'front-page.php' ); ?>

<?php
get_header(); the_post();

$featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$header_content = get_theme_mod_or_default( 'home_header_content' );
$cta_url = get_theme_mod_or_default( 'home_header_cta_url' );
$cta_text = get_theme_mod_or_default( 'home_header_cta_text' );
?>

<main id="<?php echo $post->post_name; ?>">

	<?php
	if ( $featured_image ):
		echo display_parallax_image( $featured_image, array( 'id' => 'parallax-home-header' ), $header_content );

		// Positioning of the cta button depends on .parallax-container's
		// height, so don't display the cta btn if there is no parallax img
		if ( $cta_url && $cta_text ):
	?>
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-lg-offset-7 col-md-6 col-md-offset-6 col-sm-6 col-sm-offset-6">
					<a class="btn btn-primary btn-block btn-cta" id="home-header-cta" href="<?php echo $cta_url; ?>">
						<?php echo wptexturize( $cta_text ); ?>
					</a>
				</div>
			</div>
		</div>
	<?php
		endif;
	endif;
	?>

	<article class="page-content">
		<div class="container-wide open-positions-container">
			<section class="open-positions container">
			<?php
				echo do_shortcode( '[faculty_cluster-open-positions-list]' );
			?>
			</section>
		</div>
		<div class="container">
			<?php the_content(); ?>
		</div>
	</article>

</main>

<?php get_footer(); ?>
