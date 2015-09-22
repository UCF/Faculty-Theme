<?php disallow_direct_load( 'page.php' ); ?>

<?php get_header(); the_post();

$featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
?>

<main id="<?php echo $post->post_name; ?>">

<?php
if ( $featured_image ) {
	echo display_parallax_image( $featured_image );
}
?>

	<article class="page-content">
		<div class="container">
			<h1 class="page-header"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</article>
	<div class="container-wide open-positions-container">
		<section class="open-positions container">
		<?php
			echo do_shortcode( '[faculty_cluster-open-positions-list]' );
		?>
		</section>
	</div>
</main>

<?php get_footer(); ?>
