<?php get_header(); the_post();

?>
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
</main>

<?php get_footer();?>
