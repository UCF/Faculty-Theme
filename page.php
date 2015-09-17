<?php disallow_direct_load( 'page.php' ); ?>

<?php get_header(); the_post(); ?>

<main>
	<article>
		<div class="container">
			<h1><?php echo the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</article>
</main>

<?php get_footer();?>
