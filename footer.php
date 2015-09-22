<?php
	$footer_description = get_theme_mod( 'footer_description', '' );
?>
		<?php
			if ( !is_front_page() ) {
				echo do_shortcode( '[faculty_cluster-open-positions-list]' );
			}
		?>
		<footer class="site-footer">
			<div class="footer-stripe">
				<div class="container">
					<div class="row">
						<div class="col-md-5">
							<aside>
								<?php echo $footer_description; ?>
							</aside>
						</div>
						<div class="col-md-6 col-md-offset-1">
							<h3>Colleges</h3>
							<?=wp_nav_menu(array(
								'theme_location' => 'ucf-colleges',
								'container' => 'false'
								));
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php echo wp_nav_menu( array(
							'theme_location' => 'footer-menu',
							'container' => false,
							'menu_class' => 'list-inline text-center footer-menu',
							'depth' => 1,
						) );
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php echo wp_nav_menu( array(
							'theme_location' => 'social-menu',
							'container' => false,
							'menu_class' => 'list-inline text-center social-menu',
							'depth' => 1,
						) );
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="vcard text-center footer-contact" role="contentinfo">
							<address class="adr">
								<span class="street-address">4000 Central Florida Blvd. </span>
								<span class="locality">Orlando</span>,
								<span class="region">Florida</span>,
								<span class="postal-code">32816</span> |
								<span class="tel"><a href="tel:4078232000">407.823.2000</a></span>
							</address>
							<p>
								<a href="<?php echo site_url(); ?>/feedback/">Comments and Feedback</a> | &copy;
								<a href="<?php echo site_url(); ?>" class="fn org url">
									<span class="organization-name">University of Central Florida</span>
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>

		</div><!-- .container -->
	</body>
	<?="\n".footer_()."\n"?>
</html>