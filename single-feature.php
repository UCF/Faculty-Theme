<?php disallow_direct_load( 'single.php' ); ?>

<?php
get_header(); the_post();

$featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
?>

<main id="<?php echo $post->post_name; ?>">

	<?php
	if ( $featured_image ) {
		echo display_parallax_image( $featured_image );
	}
	?>

	<article>
		<div class="container">
			<?php the_content(); ?>
		</div>
	</article>
</main>

<?php get_footer();?>
