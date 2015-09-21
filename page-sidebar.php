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
				<div class="col-sm-9 col-md-3 col-lg-3">
					<aside class="sidebar-container faculty-cluster-sidebar-container">
						<span class="sidebar-header">Faculty Cluster Initiative</span>
						<p>Six faculty clusters have been selected in this program’s inaugural year, including cyber security,
						renewable energy, coastal systems, genomics and bioinformatics, prosthetics, and energy conversion and
						propulsion. Click a link below to learn more:</p>
						<?php echo do_shortcode( '[faculty_cluster-list]' ); ?>
						<p><a class="underlined" href="#">Learn More &amp; Apply</a></p>
					</aside>
				</div>
			</div>
		</div>
	</article>

</main>

<?php get_footer(); ?>
