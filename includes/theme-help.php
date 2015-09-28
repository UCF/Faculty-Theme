<?php global $shortcode_tags; ?>
<div id="theme-help" class="i-am-a-fancy-admin">
	<div class="container">
		<h1>Help</h1>

		<div class="sections">
			<ul>
				<li class="section"><a href="#intro">Intro</a></li>
				<li class="section"><a href="#people">People</a></li>
				<li class="section"><a href="#faqs">FAQs</a></li>
				<li class="section"><a href="#clusters">Faculty Clusters</a></li>
				<li class="section"><a href="#shortcodes">Shortcodes</a></li>
			</ul>
		</div>
		<div class="fields">
			<ul>

				<li class="section" id="intro">
					<h2>Intro</h2>
					<p>
						The goal of the help section is to familiarize yourself with the Faculty website and the
						different types of content that can be created.
					</p>
					<br>

					<h3>Before getting started:</h3>
					<p>
						Keep in mind that this help section assumes a basic working knowledge of the WordPress admin interface.
						If you are unfamiliar with WordPress, please
						<a href="http://code.tutsplus.com/series/wp101-basix-training--wp-20968" target="_blank">check out a few tutorials</a>
						before getting started.
					</p>

					<h3>Content Types</h3>
					<p>In addition to WordPress's built in Post and Page post types, the following custom post types are available:</p>
					<dl>
						<dt><a href="#people">People</a></dt>
						<dd>Describes individual people</dd>
						<dd>Can be associated with Faculty Clusters (as a cluster's Lead or Contact person)</dd>
						<dt><a href="#faqs">FAQs</a></dt>
						<dd>A simple Question + Answer post type</dd>
						<dd>Generally should only be displayed via shortcode on Pages</dd>
						<dt><a href="#clusters">Faculty Clusters</a></dt>
						<dd>Describes an individual cluster</dd>
					</dl>
					<p>Custom post types differ from Posts and Pages by allowing us to define custom values relevant to those post types.</p>
				</li>

				<li class="section" id="people">
					<h2>People</h2>
					<p>
						The Person post type is used to describe individual people.  When adding any data to the site directly related to
						a person, a new Person post should be created to avoid adding and needing to maintain duplicate content,
					</p>
					<p>
						See the chart below for information about how a Person's post contents and custom fields are used.
					</p>
					<table>
						<tr>
							<th scope="col">Field Name</th>
							<th scope="col">Notes</th>
							<th scope="col">Examples</th>
						</tr>
						<tr>
							<td>Post Title</td>
							<td>
								The actual title of the Person post.  The title is combined with the Title Prefix and Suffix when the
								Person's name is displayed on the site frontend, so prefixes and suffixes should not be included in
								this field.
							</td>
							<td>John Doe</td>
						</tr>
						<tr>
							<td>Post Content</td>
							<td>Displayed when viewing a full Person on the frontend.  Is not displayed when displaying lists of people.</th>
							<td></td>
						</tr>
						<tr>
							<td>Title Prefix</td>
							<td>
								A prefix to the Person's name.  Added to the beginning of the Person's post title when the Person's
								name is displayed on the site frontend.
							</td>
							<td>Dr., Mr., etc</td>
						</tr>
						<tr>
							<td>Title Suffix</td>
							<td>
								A suffix to the Person's name.  Appended to the end of the Person's post title when the Person's name
								is displayed on the site frontend.
							</td>
							<td>, Ph.D.</td>
						</tr>
						<tr>
							<td>Job Title</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>
								One or more phone numbers for contacting the Person.  Phone numbers are listed next to a Person's name
								when displayed on the frontend as clickable links for visitors with the ability to make calls from their
								browser.
							</td>
							<td>(555) 555-5555,(555) 555-5555</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>
								An email address for contacting the Person.  Is listed next to a Person's name when displayed on the
								frontend as a clickable link, which opens the visitor's email client and starts a new message.
							</td>
							<td>john.doe@ucf.edu</td>
						</tr>
						<tr>
							<td>Order By Name</td>
							<td>
								This value is used when displaying lists of People on the site frontend to determine sort order.
								<br>
								<strong>This value is required</strong>; People will not be available as Cluster Lead or Cluster
								Contact options for the	Faculty Cluster post type if this value is blank!
							</td>
							<td>Doe</td>
						</tr>
					</table>

				</li>

				<li class="section" id="faqs">
					<h2>FAQs</h2>
					<p>
						The FAQ post type is used to define any question and answer combination.  It exists as a post type to
						allow content editors to use FAQs in multiple pages without needing to add/maintain duplicate content.
					</p>
					<p>
						See the chart below for information about how an FAQ's post contents are used.
					</p>
					<table>
						<tr>
							<th scope="col">Field Name</th>
							<th scope="col">Notes</th>
							<th scope="col">Examples</th>
						</tr>
						<tr>
							<td>Post Title</td>
							<td>The FAQ's question.</td>
							<td>Where are the bathrooms?</td>
						</tr>
						<tr>
							<td>Post Content</td>
							<td>
								The FAQ's answer.
								<br>
								<strong>FAQ post content should not contain callout or grid-related
								shortcodes.</strong>
							</th>
							<td>The bathrooms are located down the hall.</td>
						</tr>
					</table>
				</li>

				<li class="section" id="clusters">
					<h2>Faculty Clusters</h2>
					<p>
						The Cluster post type is used to describe individual faculty clusters.
					</p>
					<p>
						See the chart below for information about how a Cluster's post contents and custom fields are used.
					</p>
					<table>
						<tr>
							<th scope="col">Field Name</th>
							<th scope="col">Notes</th>
							<th scope="col">Examples</th>
						</tr>
						<tr>
							<td>Post Title</td>
							<td>The name of the cluster.</td>
							<td>Sustainable Energy Systems</td>
						</tr>
						<tr>
							<td>Post Content</td>
							<td>
								Displayed when viewing a full Cluster on the frontend.
								<br>
								If post content is available but the Short Description field is empty, an abbreviated version
								of the post content value will be used where the Short Description is displayed.
							</th>
							<td></td>
						</tr>
						<tr>
							<td>Stylesheet</td>
							<td>
								A CSS file for per-cluster style modifications.  Only loaded when viewing a full Cluster on the
								frontend.
							</td>
							<td></td>
						</tr>
						<tr>
							<td>Header Image</td>
							<td>
								Displayed when this Cluster is called via the [cluster-parallax] or [cluster-parallax-list] shortcodes.
								<br><br>
								Make sure to test these images after uploading them--the focal point of the image should be arranged so
								that important features (such as faces) should not be cropped out by the parallax effect.
							</td>
							<td></td>
						</tr>
						<tr>
							<td>Short Description</td>
							<td>
								Displayed when called by shortcodes that display small Cluster snippets, such as [cluster-parallax] and
								[cluster-grid-list].
								<br>
								If this value is not set, an abbreviated version of the post content is used instead.
								<br><br>
								<strong>Short Descriptions should not contain callout or grid-related shortcodes.</strong>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>Cluster Leads</td>
							<td>
								One or more People that serve as the lead(s) of the Cluster.
								<br>
								When these People are selected, their names will be displayed where Clusters are listed on the site
								frontend.
							</td>
							<td></td>
						</tr>
						<tr>
							<td>Cluster Contacts</td>
							<td>
								One or more People that serve as the contacts(s) of the Cluster.
								<br>
								When these People are selected, their names and contact information will be displayed where the
								[cluster-parallax] and [cluster-parallax-list] shortcodes are called.
							</td>
							<td></td>
						</tr>
						<tr>
							<td>List of Positions URL</td>
							<td>
								Shortcodes that display Clusters will display a button that links to this URL.
							</td>
							<td>https://www.jobswithucf.com/</td>
						</tr>
						<tr>
							<td>CTA Text</td>
							<td>
								Text/HTML content displayed inside the large gold button displayed next to a Cluster's name where
								the [cluster-parallax] and [cluster-parallax-list] shortcodes are called.
								<br><br>
								To split the button's contents with a vertical divider, use the .btn-cta-left and .btn-cta-right
								classes on &lt;span&gt; tags wrapped around the button's text.
							</td>
							<td><code>&lt;span class="btn-cta-left"&gt;Apply Now&lt;/span&gt;
&lt;span class="sr-only"&gt; for &lt;/span&gt;
&lt;span class="btn-cta-right"&gt;Open Cluster Positions&lt;/span&gt;</code></td>
						</tr>
						<tr>
							<td>CTA URL</td>
							<td>
								The URL used when linking to the Cluster's call-to-action button (the large gold button displayed
								next to the Cluster's name where the [cluster-parallax] and [cluster-parallax-list] shortcodes
								are called.)
							</td>
							<td></td>
						</tr>
					</table>
				</li>

				<li class="section" id="shortcodes">
					<h2>Shortcodes</h2>

					<?php if (isset($shortcode_tags['slideshow'])) { ?>

					<h4>slideshow</h4>
					<p>Create a javascript slideshow of each top level element in the shortcode.  All attributes are optional, but may default to less than ideal values.  Available attributes:</p>
					<table>
						<tr>
							<th scope="col">Name</th>
							<th scope="col">Description</th>
							<th scope="col">Default Value</th>
						</tr>
						<tr>
							<td>height</td>
							<td>CSS height of the outputted slideshow</td>
							<td>100px</td>
						</tr>
						<tr>
							<td>width</td>
							<td>CSS width of the outputted slideshow</th>
							<td>100%</td>
						</tr>
						<tr>
							<td>transition</td>
							<td>Length of transition in milliseconds</td>
							<td>1000</td>
						</tr>
						<tr>
							<td>cycle</td>
							<td>Length of each cycle in milliseconds</td>
							<td>5000</td>
						</tr>
						<tr>
							<td>animation</td>
							<td>The animation type, one of: 'slide' or 'fade'</td>
							<td>slide</td>
						</tr>
					</table>
					<p>Example:
<pre><code>[slideshow height="500px" transition="500" cycle="2000"]
&lt;img src="http://some.image.com" .../&gt;
&lt;div class="robots"&gt;Robots are coming!&lt;/div&gt;
&lt;p&gt;I'm a slide!&lt;/p&gt;
[/slideshow]</code></pre>

					<?php } ?>



					<h4>(post type)-list</h4>
					<p>Outputs a list of a given post type filtered by arbitrary taxonomies, for
					example a tag or category.  A default output can be added for when no objects
					matching the criteria are found.  Available attributes:</p>

					<table>
					<tr>
						<th scope="col">Post Type</th>
						<th scope="col">Shortcode Call</th>
						<th scope="col">Available Taxonomy Filters</th>
						<th scope="col">Additional Filters</th>
					</tr>

						<?php
							$custom_post_types = installed_custom_post_types();

							foreach ($custom_post_types as $custom_post_type) {
								if (isset($shortcode_tags[$custom_post_type->name.'-list'])) {
						?>
					<tr>
						<td><?=$custom_post_type->singular_name?></td>
						<td><?=$custom_post_type->name?>-list</td>

						<td>
							<ul>
							<?php foreach ($custom_post_type->taxonomies as $tax) {
								switch ($tax) {
									case 'post_tag':
										$tax = 'tags';
										break;
									case 'category':
										$tax = 'categories';
										break;
								}

							?>
								<li style="list-style: disc; margin-left: 15px;"><?=$tax?></li>
							</ul>
							<?php } ?>
						</td>
						<td>
							<ul>
							<?php
								// if more than 1 taxonomy is assigned to the post type, show 'join'
								// as being an available filter:
								if (count($custom_post_type->taxonomies) > 1) {
								?>
									<li style="list-style: disc; margin-left: 15px;">join ('and', 'or')</li>
								<?php
								}
								?>
									<li style="list-style: disc; margin-left: 15px;">limit (number)</li>
							</ul>
						</td>
					</tr>
						<?php }
						}	?>


				</table>

					<p>Examples:</p>
<pre><code># Output a maximum of 5 Documents tagged 'foo' or 'bar', with a default output.
[document-list tags="foo bar" limit=5]No Documents were found.[/document-list]

# Output all People categorized as 'foo'
[person-list categories="foo"]

# Output all People matching the terms in the custom taxonomy named 'org_groups'
[person-list org_groups="term list example"]

# Outputs all People found categorized as 'staff' and in the org_group 'small'.
[person-list limit=5 join="and" categories="staff" org_groups="small"]</code></pre>


				<?php
				if (isset($shortcode_tags['person-picture-list'])) { ?>

				<h4>person-picture-list</h4>
				<p>Outputs a list of People with thumbnails, person names, and job titles.  If a person's description is available, a link to the person's profile will be outputted.  If a thumbnail for the person does not exist, a default 'No Photo Available' thumbnail will display.  An optional <strong>row_size</strong> parameter is available to customize the number of rows that will display, in addition to the other filter parameters available to the <strong>person-list</strong> shortcode.</p>

				<p>Example:</p>
<pre><code># Output all People (default to 5 columns.)
[person-picture-list]

# Output all People in 4 columns.
[person-picture-list row_size=4]

# Output People in org_group 'staff' in 6 columns.
[person-picture-list org_groups="staff" row_size=6]
</code></pre>

				<?php } ?>


				<?php if (isset($shortcode_tags['post-type-search'])) { ?>
				<h4>post-type-search</h4>
				<p>Returns a list of posts of a given post type that are searchable through a generated search field.  Posts are searchable by post title and any associated tags.  Available attributes:</p>

					<table>
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Default Value</th>
							<th>Available Values</th>
						</tr>
						<tr>
							<td>post_type_name</td>
							<td>The post type to retrieve posts for</td>
							<td>post</td>
							<td>
								<ul>
								<?php
									foreach ($custom_post_types as $custom_post_type) {
										print '<li style="list-style: disc; margin-left: 15px;">'.$custom_post_type->name.'</li>';
									}
								?>
								</ul>
							</td>
						</tr>
						<tr>
							<td>taxonomy</td>
							<td>A taxonomy by which posts can be organized</td>
							<td>category</td>
							<td>Depends on the post type chosen and its available taxonomies</td>
						</tr>
						<tr>
							<td>show_empty_sections</td>
							<td>Determines whether or not empty taxonomy terms will be displayed within the results.</td>
							<td>false</td>
							<td>true, false</td>
						</tr>
						<tr>
							<td>non_alpha_section_name</td>
							<td>Changes the name of the section in which non-alphabetical post results are stored in the alphabetical sort (posts that start with 0-9, etc.)</td>
							<td>Other</td>
							<td></td>
						</tr>
						<tr>
							<td>column_width</td>
							<td>Determines the width of the columns of results.  Intended for use with Bootstrap scaffolding (<a href="http://twitter.github.com/bootstrap/scaffolding.html">see here</a>), but will accept any CSS class name.</td>
							<td>span4</td>
							<td></td>
						</tr>
						<tr>
							<td>column_count</td>
							<td>The number of columns that will be created with the set column_width.</td>
							<td>3</td>
							<td></td>
						</tr>
						<tr>
							<td>order_by</td>
							<td>How to order results by term.  Note that this does not affect alphabetical results.  See <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">WP Query Orderby params</a> in the Wordpress Codex for more information.</td>
							<td>post_title</td>
							<td>
								<ul>
									<li style="list-style: disc; margin-left: 15px;">none</li>
									<li style="list-style: disc; margin-left: 15px;">ID</li>
									<li style="list-style: disc; margin-left: 15px;">author</li>
									<li style="list-style: disc; margin-left: 15px;">title</li>
									<li style="list-style: disc; margin-left: 15px;">name</li>
									<li style="list-style: disc; margin-left: 15px;">date</li>
									<li style="list-style: disc; margin-left: 15px;">modified</li>
									<li style="list-style: disc; margin-left: 15px;">parent</li>
									<li style="list-style: disc; margin-left: 15px;">rand</li>
									<li style="list-style: disc; margin-left: 15px;">menu_order</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>order</td>
							<td>Determine if posts are ordered from ascending to descending, or vice-versa.</td>
							<td>ASC</td>
							<td>ASC (ascending), DESC (descending)</td>
						</tr>
							<td>show_sorting</td>
							<td>Whether or not to display the toggle buttons that sort posts by taxonomy and alphabetically.</td>
							<td>true</td>
							<td>true, false</td>
						<tr>
						</tr>
						<tr>
							<td>default_sorting</td>
							<td>How posts will be sorted by default.  Choose between by taxonomy term or alphabetically.</td>
							<td>term</td>
							<td>
								<ul>
									<li style="list-style: disc; margin-left: 15px;">term</li>
									<li style="list-style: disc; margin-left: 15px;">alpha</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>default_search_text</td>
							<td>Sets the post search field placeholder text.  Note that placeholders are not supported by older browsers (IE 8 and below.)</td>
							<td>Find a (post type name)</td>
							<td></td>
						</tr>
					</table>

					<p>Examples:</p>
<pre style="white-space: pre-line;"><code># Generate a Post search, organized by category, with empty sections visible.  Generates one column of results with CSS class .span3.
[post-type-search column_width="span3" column_count="1" show_empty_sections=true default_search_text="Find Something"]

# Generate a Person search, organized by Organizational Groups (that have People assigned to them.)
[post-type-search post_type_name="person" taxonomy="org_groups"]
</code></pre>
				<?php } ?>

				</li>

			</ul>
		</div>
	</div>
</div>
