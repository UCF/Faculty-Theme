<?php
	$footer_description = get_theme_mod( 'footer_description', '' );
?>

			<div id="footer">
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

				<div id="footer-navwrap" role="navigation" class="screen-only">
					<?=wp_nav_menu(array(
						'theme_location' => 'footer-menu',
						'container' => 'false',
						'menu_id' => 'footer-menu',
						'fallback_cb' => false,
						'depth' => 1,
						'walker' => new Bootstrap_Walker_Nav_Menu()
						));
					?>
				</div>

				<?=wp_nav_menu(array(
					'theme_location' => 'social-menu',
					'container' => 'div',
					'container_id' => 'social-menu-wrap',
					'menu_class' => 'menu screen-only',
					'menu_id' => 'social-menu',
					'depth' => 1,
					));
				?>

				<p id="subfooter" role="contentinfo" class="vcard">
					<span class="adr">
						<span class="street-address">4000 Central Florida Blvd. </span>
						<span class="locality">Orlando</span>,
						<span class="region">Florida</span>,
						<span class="postal-code">32816</span> |
						<span class="tel"><a href="tel:4078232000">407.823.2000</a></span>
					</span>
					<br/>
					<a href="<?=site_url()?>/feedback/">Comments and Feedback</a> | &copy;
					<a href="<?=site_url()?>" class="print-noexpand fn org url">
						<span class="organization-name">University of Central Florida</span>
					</a>
				</p>

			</div>
		</div><!-- .container -->
	</body>
	<?="\n".footer_()."\n"?>
</html>