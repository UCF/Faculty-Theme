<?php disallow_direct_load( 'single-cluster.php' ); ?>

<?php
get_header(); the_post();

$header_image = wp_get_attachment_url( get_post_meta( $post->ID, 'cluster_header_image', true ) );

// get_the_title instead of the_title so we can store it in a var
$h1 = '<h1>' . get_the_title() . '</h1>';
$header_content = $h1;
$cta_url = get_post_meta( $post->ID, 'cluster_cta_url', true );
$cta_text = get_post_meta( $post->ID, 'cluster_cta_text', true );

if ( $cta_url && $cta_text ):
	$cta_markup = '';
	ob_start();
?>
<div id="home-header-cta">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-lg-offset-7 col-md-6 col-md-offset-6 col-sm-7 col-sm-offset-5">
				<a class="ga-event-link btn btn-primary btn-cta" href="<?php echo $cta_url; ?>">
					<?php echo $cta_text; ?>
				</a>
			</div>
		</div>
	</div>
</div>
<?php
	$cta_markup = ob_get_clean();

	$header_content .= $cta_markup;
endif;
?>

<main id="<?php echo $post->post_name; ?>">

	<?php
	if ( $header_image ) {
		echo display_parallax_image( $header_image, array( 'class' => 'parallax-featured-header' ), $header_content );
	}
	?>

	<article class="page-content">
		<div class="container">
			<?php if ( !$header_image ): ?>
				<?php echo $h1; ?>

				<div id="home-cta-no-banner" class="row">
					<div class="col-lg-5 col-lg-offset-7 col-md-6 col-md-offset-6 col-sm-7 col-sm-offset-5">
						<a class="ga-event-link btn btn-primary btn-cta" href="<?php echo $cta_url; ?>">
							<?php echo $cta_text; ?>
						</a>
					</div>
				</div>
			<?php endif; ?>
	<?php
	$cluster_leads = Cluster::get_leads( $post );

	if ( $cluster_leads ):
	?>
		</div>
		<div class="container-wide cluster-single-people">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-4">
						<h2 class="cluster-single-people-heading">Cluster Lead<?php if ( count( $cluster_leads ) > 1 ): ?>s<?php endif; ?>:</h2>
					</div>
					<div class="col-lg-10 col-md-9 col-sm-8">
						<ul class="cluster-single-people-list cluster-single-leads">
						<?php
						foreach ( $cluster_leads as $lead ):
							$name = Person::get_name( $lead );
							$title = get_post_meta( $lead->ID, 'person_jobtitle', true );
							$phones = Person::get_phones( $lead );
							$email = get_post_meta( $lead->ID, 'person_email', true );
						?>
							<li>
								<?php echo $name; ?>
								<?php if ( $phones && $email ): ?>
								<ul class="cluster-single-contact-info">
									<?php if ( $title ): ?>
									<li><?php echo $title; ?></li>
									<?php endif; ?>

									<?php
									if ( $phones ):
										foreach ( $phones as $phone ) :
									?>
									<li><a href="tel:<?php echo preg_replace( '/[^0-9]/', '', $phone ); ?>"><?php echo $phone; ?></a></li>
									<?php
										endforeach;
									endif;
									?>

									<?php if ( $email ): ?>
									<li><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
									<?php endif; ?>
								</ul>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
	<?php endif; ?>

			<?php the_content(); ?>
		</div>
	</article>

</main>

<?php get_footer(); ?>
