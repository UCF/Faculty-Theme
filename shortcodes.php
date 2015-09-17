<?php

function sc_search_form() {
	ob_start();
?>
	<div class="search">
		<?php get_search_form(); ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'search_form', 'sc_search_form' );


/**
 * Post search
 *
 * @return string
 * @author Chris Conover
 * */
function sc_post_type_search( $params=array(), $content='' ) {
	$defaults = array(
		'post_type_name'          => 'post',
		'taxonomy'                => 'category',
		'meta_key'                => '',
		'meta_value'              => '',
		'show_empty_sections'     => false,
		'non_alpha_section_name'  => 'Other',
		'column_width'            => 'col-md-4',
		'column_count'            => '3',
		'order_by'                => 'title',
		'order'                   => 'ASC',
		'show_sorting'            => true,
		'default_sorting'         => 'term',
		'show_sorting'            => true,
		'show_uncategorized'      => false,
		'uncategorized_term_name' => 'Uncategorized'
	);

	$params = ( $params === '' ) ? $defaults : array_merge( $defaults, $params );

	$params['show_empty_sections'] = filter_var( $params['show_empty_sections'], FILTER_VALIDATE_BOOLEAN );
	$params['column_count']        = is_numeric( $params['column_count'] ) ? (int)$params['column_count'] : $defaults['column_count'];
	$params['show_sorting']        = filter_var( $params['show_sorting'], FILTER_VALIDATE_BOOLEAN );

	if ( !in_array( $params['default_sorting'], array( 'term', 'alpha' ) ) ) {
		$params['default_sorting'] = $default['default_sorting'];
	}

	// Resolve the post type class
	if ( is_null( $post_type_class = get_custom_post_type( $params['post_type_name'] ) ) ) {
		return '<p>Invalid post type.</p>';
	}
	$post_type = new $post_type_class;

	// Set default search text if the user didn't
	if ( !isset( $params['default_search_text'] ) ) {
		$params['default_search_text'] = 'Find a '.$post_type->singular_name;
	}

	// Set default search label if the user didn't
	if ( !isset( $params['default_search_label'] ) ) {
		$params['default_search_label'] = 'Find a '.$post_type->singular_name;
	}

	// Register the search data with the JS PostTypeSearchDataManager.
	// Format is array(post->ID=>terms) where terms include the post title
	// as well as all associated tag names
	$search_data = array();
	foreach ( get_posts( array( 'numberposts' => -1, 'post_type' => $params['post_type_name'] ) ) as $post ) {
		$search_data[$post->ID] = array( $post->post_title );
		foreach ( wp_get_object_terms( $post->ID, 'post_tag' ) as $term ) {
			$search_data[$post->ID][] = $term->name;
		}
	}
?>
	<script type="text/javascript">
		if(typeof PostTypeSearchDataManager != 'undefined') {
			PostTypeSearchDataManager.register(new PostTypeSearchData(
				<?php echo json_encode( $params['column_count'] ); ?>,
				<?php echo json_encode( $params['column_width'] ); ?>,
				<?php echo json_encode( $search_data ); ?>
			));
		}
	</script>
	<?php

	// Set up a post query
	$args = array(
		'numberposts' => -1,
		'post_type'   => $params['post_type_name'],
		'tax_query'   => array(
			array(
				'taxonomy' => $params['taxonomy'],
				'field'    => 'id',
				'terms'    => '',
			)
		),
		'orderby'     => $params['order_by'],
		'order'       => $params['order'],
	);

	// Handle meta key and value query
	if ($params['meta_key'] && $params['meta_value']) {
		$args['meta_key'] = $params['meta_key'];
		$args['meta_value'] = $params['meta_value'];
	}

	// Split up this post type's posts by term
	$by_term = array();
	foreach ( get_terms( $params['taxonomy'] ) as $term ) { // get_terms defaults to an orderby=name, order=asc value
		$args['tax_query'][0]['terms'] = $term->term_id;
		$posts = get_posts( $args );

		if ( count( $posts ) == 0 && $params['show_empty_sections'] ) {
			$by_term[$term->name] = array();
		} else {
			$by_term[$term->name] = $posts;
		}
	}

	// Add uncategorized items to posts by term if parameter is set.
	if ( $params['show_uncategorized'] ) {
		$terms = get_terms( $params['taxonomy'], array( 'fields' => 'ids', 'hide_empty' => false ) );
		$args['tax_query'][0]['terms'] = $terms;
		$args['tax_query'][0]['operator'] = 'NOT IN';
		$uncat_posts = get_posts( $args );
		if ( count( $uncat_posts == 0 ) && $params['show_empty_sections'] ) {
			$by_term[$params['uncategorized_term_name']] = array();
		} else {
			$by_term[$params['uncategorized_term_name']] = $uncat_posts;
		}
	}

	// Split up this post type's posts by the first alpha character
	$args['orderby'] = 'title';
	$args['order'] = 'ASC';
	$args['tax_query'] = '';
	$by_alpha_posts = get_posts( $args );
	foreach( $by_alpha_posts as $post ) {
		if ( preg_match( '/([a-zA-Z])/', $post->post_title, $matches ) == 1 ) {
			$by_alpha[strtoupper($matches[1])][] = $post;
		} else {
			$by_alpha[$params['non_alpha_section_name']][] = $post;
		}
	}
	ksort( $by_alpha );
	if( $params['show_empty_sections'] ) {
		foreach( range( 'a', 'z' ) as $letter ) {
			if ( !isset( $by_alpha[strtoupper( $letter )] ) ) {
				$by_alpha[strtoupper( $letter )] = array();
			}
		}
	}

	$sections = array(
		'post-type-search-term'  => $by_term,
		'post-type-search-alpha' => $by_alpha,
	);

	ob_start();
?>
	<div class="post-type-search">
		<div class="post-type-search-header">
			<form class="post-type-search-form" action="." method="get">
				<label><?php echo $params['default_search_label']; ?></label>
				<input type="text" placeholder="<?php echo $params['default_search_text']; ?>">
			</form>
		</div>
		<div class="post-type-search-results"></div>
		<?php if ( $params['show_sorting'] ) { ?>
		<div class="btn-group post-type-search-sorting">
			<button class="btn<?php if ( $params['default_sorting'] == 'term' ) echo ' active'; ?>"><span class="glyphicon glyphicon-list-alt"></i></button>
			<button class="btn<?php if ( $params['default_sorting'] == 'alpha' ) echo ' active'; ?>"><span class="glyphicon glyphicon-font"></i></button>
		</div>
		<?php } ?>
	<?php

	foreach ( $sections as $id => $section ):
		$hide = false;
		switch ( $id ) {
			case 'post-type-search-alpha':
				if ( $params['default_sorting'] == 'term' ) {
					$hide = True;
				}
				break;
			case 'post-type-search-term':
				if ( $params['default_sorting'] == 'alpha' ) {
					$hide = True;
				}
				break;
		}
?>
		<div class="<?php echo $id; ?>"<?php if ( $hide ) { echo ' style="display:none;"'; } ?>>
			<div class="row">
			<?php
			$count = 0;
			foreach ( $section as $section_title => $section_posts ):
				if ( count( $section_posts ) > 0 || $params['show_empty_sections'] ):
			?>

				<?php if ( $section_title == $params['uncategorized_term_name'] ): ?>
					</div>
						<div class="row">
							<div class="<?php echo $params['column_width']; ?>">
								<h3><?php echo esc_html( $section_title ); ?></h3>
							</div>
						</div>

						<div class="row">
						<?php
						// $split_size must be at least 1
						$split_size = max( floor( count( $section_posts ) / $params['column_count'] ), 1 );
						$split_posts = array_chunk( $section_posts, $split_size );
						foreach ( $split_posts as $index => $column_posts ):
						?>
							<div class="<?php echo $params['column_width']; ?>">
								<ul>
								<?php foreach( $column_posts as $key => $post ): ?>
									<li data-post-id="<?php echo $post->ID; ?>">
										<?php echo $post_type->toHTML( $post ); ?><span class="search-post-pgsection"><?php echo $section_title; ?></span>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
						<?php endforeach; ?>

				<?php else: ?>

					<?php if ( $count % $params['column_count'] == 0 && $count !== 0 ): ?>
						</div><div class="row">
					<?php endif; ?>

					<div class="<?php echo $params['column_width']; ?>">
						<h3><?php echo esc_html( $section_title ); ?></h3>
						<ul>
						<?php foreach( $section_posts as $post ):  ?>
							<li data-post-id="<?php echo $post->ID; ?>">
								<?php echo $post_type->toHTML( $post ); ?><span class="search-post-pgsection"><?php echo $section_title; ?></span>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>

			<?php
					endif;

				$count++;
				endif;

			endforeach;
			?>
			</div><!-- .row -->
		</div><!-- term/alpha section -->

	<?php endforeach; ?>

	</div><!-- .post-type-search -->

<?php
	return ob_get_clean();
}
add_shortcode( 'post-type-search', 'sc_post_type_search' );

function sc_faculty_clusters_list($attr, $content=null) {
	$query = new WP_Query( array( 'post_type' => 'faculty_cluster' ) );
	ob_start();
	?>
	<div class="row">
		<?php
		while ( $query->have_posts() ): $query->the_post();
			$cluster_leads = get_the_terms($post->ID, 'cluster_leads');
			?>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 faculty-cluster">
					<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					<?php
					// Get short description meta field. If one is not specified, truncate the content
					// to the first new line.
					$short_description = get_post_meta( get_the_ID(), 'faculty_cluster_short_description', true );
					if ($short_description !== "") {
						echo $short_description;
					} else {
						$the_content = get_the_content();
						echo strtok($the_content, "\r\n");
					}
					?>
					<?php if (count($cluster_leads) > 0): ?>
						<p><i>Cluster Lead<?php if (count($cluster_leads) > 1): ?>s<?php endif; ?>:</i></p>
						<ul>
							<?php foreach ( $cluster_leads as $cluster_lead ): ?>
								<li><?php echo $cluster_lead->name ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php
		endwhile;
		?>
	</div>
	<?php

	return ob_get_clean();
}
add_shortcode('faculty-clusters-list', 'sc_faculty_clusters_list');

/**
 * Displays a list of Faculty Clusters using large parallax images.
 **/
function sc_cluster_parallax_list( $params, $content='' ) {
	$clusters = get_posts( array(
		'post_type' => 'faculty_cluster',
		'posts_per_page' => -1
	) );

	ob_start();

	if ( $clusters ):
		foreach ( $clusters as $post ):
			$img_id = get_post_meta( $post->ID, 'faculty_cluster_header_image', true );
			$img = wp_get_attachment_url( $img_id );
			$cluster_leads = wp_get_post_terms( $post->ID, 'cluster_leads', array( 'fields' => 'names' ) );
	?>
			</div> <!-- Close .container -->
	<?php
			echo display_parallax_image( $img );
	?>
			<div class="container"> <!-- Re-open .container -->
				<div class="row">
					<div class="col-md-8 col-sm-8">
						<h2 class="cluster-pl-title">
							<span>
								<?php echo $post->post_title; ?>
							</span>
						</h2>
						<div class="cluster-pl-desc">
							<?php echo apply_filters( 'the_content', $post->post_content ); // TODO: replace with alternate meta field for extended description ?>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<?php echo display_cluster_cta( $post->ID, 'cluster-pl-cta' ); ?>

						<?php if ( $cluster_leads ): ?>

						<h3 class="cluster-pl-sidebar-title">Cluster Leads:</h3>

						<ul class="cluster-pl-sidebar-list">
						<?php foreach ( $cluster_leads as $term ): ?>
							<li><?php echo $term; ?></li>
						<?php endforeach; ?>
						</ul>

						<?php endif; ?>
					</div>
				</div>
	<?php
		endforeach;
	endif;
?>

<?php
	return ob_get_clean();
}
add_shortcode( 'faculty-cluster-parallax-list', 'sc_cluster_parallax_list' ); // TODO: better name for this shortcode?

?>
