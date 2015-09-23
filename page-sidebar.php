<?php
/**
 * Template Name: With Faculty Cluster Sidebar
 */

get_header(); the_post();

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
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9">
					<h1 class="page-header"><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div>
				<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="sidebar-container faculty-cluster-sidebar-container">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container-wide open-positions-container">
			<section class="open-positions container">
			<?php
				echo do_shortcode( '[faculty_cluster-open-positions-list]' );
			?>
			</section>
		</div>
	</article>

</main>

<?php get_footer(); ?>
