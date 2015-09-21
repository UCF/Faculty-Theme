<?php get_header(); the_post();

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
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1 class="page-header"><?php the_title();?></h1>
				</div>
			</div>
			<?php the_content(); ?>
		</div>
	</section>
<?php } else { ?>
<main class="page page-base" id="<?=$post->post_name?>">
	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1><?php the_title();?></h1>
				</div>
			</div>
		</div>
		<?php the_content(); ?>
	</section>
<?php } ?>
</main>

<?php get_footer();?>
