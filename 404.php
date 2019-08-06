<?php @header( 'HTTP/1.1 404 Not found', true, 404 ); ?>
<?php disallow_direct_load( '404.php' ); ?>

<?php get_header(); ?>

<main class="page page-404">
	<article>
		<div class="container">
			<h1>Page Not Found</h1>
			<?php
			$page = get_page_by_title( '404' );
			$content = null;
			if ( $page ) {
				$content = $page->post_content;
				$content = apply_filters( 'the_content', $content );
			}
			?>
			<?php if ( $content ): ?>
				<?php echo $content; ?>
			<?php else: ?>
				<p>The page you requested doesn't exist.  Sorry about that.</p>
			<?php endif; ?>
		</div>
	</article>
</main>

<?php get_footer();?>
