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
	$clusters = get_posts( array(
		'post_type' => 'faculty_cluster',
		'posts_per_page' => -1
	) );

	ob_start();
	?>

	</div> <!-- Close .container -->
	<div class="container"> <!-- Re-open .container -->
	<div class="row">

	<?php
		if ( $clusters ):
			$cluster_count = 0;
			foreach ( $clusters as $post ):
				$cluster_count++;
				$cluster_leads = wp_get_post_terms( $post->ID, 'cluster_leads', array( 'fields' => 'names' ) );
				$positions_url = get_post_meta( $post->ID, 'faculty_cluster_positions_url', true );
				$short_description = get_post_meta( $post->ID, 'faculty_cluster_short_description', true );
				if ($short_description === "") {
					$short_description = strtok($post->post_content, "\r\n");
				}
		?>
			<div class="col-sm-4 col-md-4 col-lg-4">
				<div class="cluster-short">
					<h3>
						<a href="<?php echo $post->guid; ?>"><?php echo $post->post_title; ?></a>
					</h3>

					<div class="cluster-short-desc">
						<?php echo $short_description ?>
					</div>

					<?php if ( $cluster_leads ): ?>
					<dl class="cluster-short-inline-list">
						<dt>Cluster Lead<?php if (count($cluster_leads) > 1): ?>s<?php endif; ?>:</dt>
						<?php
							$cluster_lead_count = 0;
							foreach ( $cluster_leads as $term ):
								$cluster_lead_count++;
						?>
							<dd>
								<?php echo $term; ?><?php if ($cluster_lead_count !== count($cluster_leads)): ?>, <?php endif; ?></dd>
						<?php
							endforeach;
						?>
					</dl>
					<?php endif; ?>

					<div class="cluster-short-buttons-container">
						<a href="<?php echo $post->guid; ?>" class="btn btn-primary btn-block cluster-short-btn">Learn More</a>
						<a href="<?php echo $positions_url; ?>" class="btn btn-primary btn-block cluster-short-btn">See Positions</a>
					</div>

				</div>
			</div>
	<?php

		if ( $cluster_count % 3 == 0 && $cluster_count != count( $clusters )): ?>
			</div>
			<div class="row">
		<?php endif;

			endforeach;
		endif;
	?>
			</div>

	<?php
	return ob_get_clean();
}
add_shortcode('faculty-clusters-list', 'sc_faculty_clusters_list');


/**
 * Displays a single Faculty Cluster by ID or slug using a parallax
 * header image.
 **/
function sc_cluster_parallax( $attr, $content='' ) {
	$post = null;
	$attr = shortcode_atts( array(
		'id' => null,
		'slug' => null
	), $attr, 'faculty_cluster-parallax' );

	if ( $attr['id'] ) {
		$post = get_post( $attr['id'] );
	}
	else if ( $attr['slug'] ) {
		$post = get_posts( array(
			'post_type' => 'faculty_cluster',
			'posts_per_page' => 1,
			'post_slug' => $attr['slug']
		) );
		$post = $post[0];
	}

	ob_start();

	if ( $post ):
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
					<div class="col-md-8 col-sm-7">
						<h2 class="cluster-pl-title">
							<span>
								<?php echo $post->post_title; ?>
							</span>
						</h2>
						<div class="row">
							<div class="col-md-11 col-sm-11">
								<div class="cluster-pl-desc">
									<?php echo apply_filters( 'the_content', get_post_meta( $post->ID, 'faculty_cluster_short_description', true ) ); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-5">
						<?php echo display_cluster_cta_btn( $post->ID, 'cluster-pl-cta' ); ?>

						<?php if ( $cluster_leads ): ?>

						<h3 class="cluster-pl-sidebar-title">Cluster Lead<?php if ( count( $cluster_leads ) > 1 ): ?>s<?php endif; ?>:</h3>

						<ul class="cluster-pl-sidebar-list">
						<?php foreach ( $cluster_leads as $term ): ?>
							<li><?php echo $term; ?></li>
						<?php endforeach; ?>
						</ul>

						<?php endif; ?>
					</div>
				</div>
	<?php endif;

	return ob_get_clean();
}
add_shortcode( 'faculty_cluster-parallax', 'sc_cluster_parallax' );


/**
 * Displays a list of Faculty Clusters using large parallax images.
 **/
function sc_cluster_parallax_list( $attr, $content='' ) {
	$clusters = get_posts( array(
		'post_type' => 'faculty_cluster',
		'posts_per_page' => -1
	) );

	ob_start();

	if ( $clusters ) {
		foreach ( $clusters as $post ) {
			echo sc_cluster_parallax( array( 'id' => $post->ID ) );
		}
	}
?>

<?php
	return ob_get_clean();
}
add_shortcode( 'faculty_cluster-parallax-list', 'sc_cluster_parallax_list' );

/**
 * Displays a list of Faculty Clusters using large parallax images.
 **/
function sc_cluster_open_positions_list( $attr, $content='' ) {
	$positions = array(
			array(
				'field' => 'Prosthetic Interfaces',
				'college' => 'College of Medicine',
			),
			array(
				'field' => 'Prosthetic Interfaces',
				'college' => 'College of Medicine',
			),
			array(
				'field' => 'Prosthetic Interfaces',
				'college' => 'College of Medicine',
			),
			array(
				'field' => 'Prosthetic Interfaces',
				'college' => 'College of Medicine',
			),
			array(
				'field' => 'Prosthetic Interfaces',
				'college' => 'College of Medicine',
			),
			array(
				'field' => 'Prosthetic Interfaces',
				'college' => 'College of Medicine',
			)
	);

	ob_start();
	?>

	<h2>Open Positions In</h2>
	<ul>
	<?php
		if ( $positions ) {
			foreach ( $positions as $position ) {
				echo '<li class="open-position"><a href="#"><span class="field">' . $position['field'] . '</span> ';
				echo '<span class="college">' . $position['college'] . '</span></a></li>';
			}
		}
	?>
	</ul>
<?php
	return ob_get_clean();
}
add_shortcode( 'faculty_cluster-open-positions-list', 'sc_cluster_open_positions_list' );


/**
 * Create a full-width callout box.
 **/
function sc_callout( $attr, $content ) {
	$bgcolor = isset($attr['background']) ? $attr['background'] : '#f0f0f0';
	$background_image = isset($attr['background-image']) ? $attr['background-image'] : '';
	$min_height = isset($attr['min-height']) ? $attr['min-height'] : '';
	$textcolor = isset($attr['text']) ? $attr['text'] : '#000';
	$content_align = isset($attr['content_align']) ? 'text-' . $attr['content_align'] : '';
	$content = do_shortcode( $content );
	$extra_classes = isset($attr['class']) ? ' ' . $attr['class'] : '';
	$parallax = isset($attr['parallax']) ? $attr['parallax'] : '';

	if ($parallax == 'yes' || $parallax == 'true') {
		$html = '</div>';
		$html .= display_parallax_image( $background_image, array(), $content, true );
		$html .= '<div class="container">';
	} else {
		// Close out our existing .container
		$html = '</div>';
		$html .= '<div class="container-wide callout';
		if ($background_image != '') {
			$html .= ' background-image-callout ';
		}
		$html .= $extra_classes . '" style="background-color: ' . $bgcolor . ';';

		if ($background_image != '') {
			$html .= 'background-image:url(\'' . $background_image . '\');';
		}
		if ($min_height != '') {
			$html .= 'min-height:' . $min_height . ';';
		}
		$html .= '">';
		$html .= '<div class="container">';
		$html .= '<div class="callout-inner" ' . $content_align . '" style="color: ' . $textcolor . '">';
		$html .= $content;
		$html .= '</div></div></div>';
		// Reopen standard .container, .row and .span
		$html .= '<div class="container">';
	}

	return $html;
}
add_shortcode( 'callout', 'sc_callout' );

/**
 * Create a research listing
 **/
function sc_research_listing_side( $attr, $content ) {
	$content = do_shortcode( $content );

	ob_start();
	?>
	<div class="page-side-content">
		<strong>Research Specialty</strong>
		<?php echo($content); ?>
		<ul>
			<li><strong>Research Listing One</strong> Why it's interesting or related to UCF</li>
			<li><strong>Research Listing One</strong> Why it's interesting or related to UCF</li>
			<li><strong>Research Listing One</strong> Why it's interesting or related to UCF</li>
		</ul>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'research-listing-side', 'sc_research_listing_side' );

/**
 * Create a content listing
 **/
function sc_orlando_side_content( $attr, $content ) {
	$content = do_shortcode( $content );

	ob_start();
	?>
	<div class="page-side-content">
		<strong>Orlando Sidebar</strong>
		<?php echo($content); ?>
		<ul>
			<li><strong>Orlando Listing One</strong> Why it's interesting or related to UCF</li>
			<li><strong>Orlando Listing One</strong> Why it's interesting or related to UCF</li>
			<li><strong>Orlando Listing One</strong> Why it's interesting or related to UCF</li>
		</ul>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'orlando-side-content', 'sc_orlando_side_content' );

/**
 * Sidebar container for main pages
 **/
function sc_sidebar_content( $attr, $content ) {
	$content = do_shortcode( $content );

	ob_start();
	?>
	<div class="page-sidebar-content">
	<?php echo($content); ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'sidebar-content', 'sc_sidebar_content' );

/**
 * Wraps content in a Bootstrap .row.
 **/
function sc_row( $attr, $content='' ) {
	$class = isset( $attr['class'] ) ? $attr['class'] : '';
	ob_start();
	?>
	<div class="row <?php echo $class; ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'row', 'sc_row' );


/**
 * Wraps content in a Bootstrap .col-.
 **/
function sc_column( $attr, $content='' ) {
	// size classes
	$size_xs = isset($attr['xs']) ? 'col-xs-' . $attr['xs'] : '';
	$size_sm = isset($attr['sm']) ? 'col-sm-' . $attr['sm'] : '';
	$size_md = isset($attr['md']) ? 'col-md-' . $attr['md'] : '';
	$size_lg = isset($attr['lg']) ? 'col-lg-' . $attr['lg'] : '';

	// offset classes
	$offset_xs = isset($attr['xs_offset']) ? 'col-xs-offset-' . $attr['xs_offset'] : '';
	$offset_sm = isset($attr['sm_offset']) ? 'col-sm-offset-' . $attr['sm_offset'] : '';
	$offset_md = isset($attr['md_offset']) ? 'col-md-offset-' . $attr['md_offset'] : '';
	$offset_lg = isset($attr['lg_offset']) ? 'col-lg-offset-' . $attr['lg_offset'] : '';

	// push classes
	$push_xs = isset($attr['xs_push']) ? 'col-xs-push-' . $attr['xs_push'] : '';
	$push_sm = isset($attr['sm_push']) ? 'col-sm-push-' . $attr['sm_push'] : '';
	$push_md = isset($attr['md_push']) ? 'col-md-push-' . $attr['md_push'] : '';
	$push_lg = isset($attr['lg_push']) ? 'col-lg-push-' . $attr['lg_push'] : '';

	// pull classes
	$pull_xs = isset($attr['xs_pull']) ? 'col-xs-pull-' . $attr['xs_pull'] : '';
	$pull_sm = isset($attr['sm_pull']) ? 'col-sm-pull-' . $attr['sm_pull'] : '';
	$pull_md = isset($attr['md_pull']) ? 'col-md-pull-' . $attr['md_pull'] : '';
	$pull_lg = isset($attr['lg_pull']) ? 'col-lg-pull-' . $attr['lg_pull'] : '';

	$extra_classes = isset($attr['class']) ? $attr['class'] : '';
	$inline_css = isset($attr['style']) ? $attr['style'] : '';

	$additional_classes = 'col';
	$all_classes = array(
		$additional_classes, $size_xs, $size_sm, $size_md,
		$size_lg, $offset_xs, $offset_sm, $offset_md,
		$offset_lg, $push_xs, $push_sm, $push_md, $push_lg,
		$pull_xs, $pull_sm, $pull_md, $pull_lg,
		$extra_classes
	);
	$all_classes_str = '';

	foreach ( $all_classes as $class ) {
		if ( $class != '' ) {
			$all_classes_str .= $class . ' ';
		}
	}
	$all_classes_str = trim( $all_classes_str );
	ob_start();
	?>
	<div class="<?php echo $all_classes_str; ?>" style="<?php echo $inline_css; ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'column', 'sc_column' );


/**
 * Displays a generic call-to-action button.
 **/
function sc_cta_btn( $attr, $content='' ) {
	$attr = shortcode_atts( array(
		'href' => '',
		'class' => '',
		'id' => ''
	), $attr, 'cta-btn' );

	return display_cta_btn( $attr['href'], $content, $attr['class'], $attr['id'] );
}
add_shortcode( 'cta-btn', 'sc_cta_btn' );
