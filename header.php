<!DOCTYPE html>
<html lang="en-US">
	<head>
		<?php echo header_(); ?>

		<!--[if lte IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<?php if ( GA_ACCOUNT or CB_UID ): ?>
		<script>

			<?php if ( GA_ACCOUNT ): ?>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', '<?php echo GA_ACCOUNT; ?>', 'auto');
			ga('send', 'pageview');
			<?php endif; ?>

			<?php if ( CB_UID ): ?>
			var CB_UID      = '<?php echo CB_UID; ?>';
			var CB_DOMAIN   = '<?php echo CB_DOMAIN; ?>';
			<?php endif; ?>

		</script>
		<?php endif;?>

		<script>
			var PostTypeSearchDataManager = {
				'searches' : [],
				'register' : function(search) {
					this.searches.push(search);
				}
			};
			var PostTypeSearchData = function(column_count, column_width, data) {
				this.column_count = column_count;
				this.column_width = column_width;
				this.data         = data;
			};
		</script>
	</head>
	<body ontouchstart <?php body_class( body_classes() ); ?>>
		<header id="site-header">
			<nav id="site-nav" class="hidden-xs">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'header-menu',
					'container' => false,
					'menu_class' => 'list-inline',
					'menu_id' => 'header-menu',
					'walker' => new Bootstrap_Walker_Nav_Menu()
				) );
				?>
			</nav>
			<nav id="site-nav-xs" class="visible-xs-block navbar navbar-inverse">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-menu-xs-collapse" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="navbar-brand">Navigation</span>
				</div>
				<div class="collapse navbar-collapse" id="header-menu-xs-collapse">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'header-menu',
						'container' => false,
						'menu_class' => 'nav navbar-nav',
						'menu_id' => 'header-menu-xs',
						'walker' => new Bootstrap_Walker_Nav_Menu()
					) );
					?>
				</div>
			</nav>

			<div class="container">
				<?php echo display_site_title(); ?>
			</div>
			<?php echo do_shortcode( '[faculty_cluster-open-positions-list]' ); ?>
		</header>
