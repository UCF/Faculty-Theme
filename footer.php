			<footer id="site-footer">

				<?php wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'container' => false,
					'menu_id' => 'footer-menu',
					'depth' => 1,
					'walker' => new Bootstrap_Walker_Nav_Menu()
				) );
				?>

			</footer>
		</main>
	</body>
	<?php echo footer_(); ?>
</html>
