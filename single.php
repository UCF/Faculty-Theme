<?php disallow_direct_load( 'single.php' ); ?>

<?php get_header(); the_post(); ?>

<main>
	<div class="container">
		<article>
			<h1><?php echo the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	</div>
</main>

<?php get_footer();?>
