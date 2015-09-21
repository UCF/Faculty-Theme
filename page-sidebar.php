<?php
/**
 * Template Name: With Faculty Cluster Sidebar
 */

get_header(); the_post();

$featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

if ($featured_image) { ?>
<main class="page" id="<?=$post->post_name?>">
	<?php /* echo display_parallax_image($featured_image);*/ ?>

	<div class="bar-image-container">
		<div class="bar-image" style="background-image: url('<?php echo $featured_image; ?>');">
			<img src="<?php echo $featured_image; ?>">
		</div>
	</div>

	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9">
				<h1 class="page-header"><?php the_title();?></h1>
					<?php the_content(); ?>
				</div>
				<div class="col-sm-9 col-md-3 col-lg-3">
					<div class="sidebar-container faculty-cluster-sidebar-container">
						<span class="sidebar-header">Faculty Cluster Initiative</span>
						<p>Six faculty clusters have been selected in this program’s inaugural year, including cyber security,
						renewable energy, coastal systems, genomics and bioinformatics, prosthetics, and energy conversion and
						propulsion. Click a link below to learn more:</p>
						<?php echo do_shortcode('[faculty_cluster-list]'); ?>
						<p><a class="underlined" href="#">Learn More &amp; Apply</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } else { ?>
<main class="page page-base" id="<?=$post->post_name?>">
	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9">
				<h1 class="page-header"><?php the_title();?></h1>
					<?php the_content(); ?>
				</div>
				<div class="col-sm-9 col-md-3 col-lg-3">
					<div class="sidebar-container faculty-cluster-sidebar-container">
						<span class="sidebar-header">Faculty Cluster Initiative</span>
						<p>Six faculty clusters have been selected in this program’s inaugural year, including cyber security,
						renewable energy, coastal systems, genomics and bioinformatics, prosthetics, and energy conversion and
						propulsion. Click a link below to learn more:</p>
						<?php echo do_shortcode('[faculty_cluster-list]'); ?>
						<p><a class="underlined" href="#">Learn More &amp; Apply</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>
</main>

<?php get_footer();?>
