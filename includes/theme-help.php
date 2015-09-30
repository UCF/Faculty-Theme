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
				<li class="section"><a href="#editing">Editing Content and Settings</a></li>
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
						<a href="http://www.lynda.com/WordPress-tutorials/WordPress-Essential-Training/372542-2.html" target="_blank">check out a few tutorials</a>
						before getting started.
					</p>

					<br>

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

				<li class="section" id="editing">
					<h2>Editing Content and Settings</h2>
					<p>
						In this theme, site content can be modified by modifying Pages, modifying other custom post types, or by
						editing options in the WordPress Customizer.
					</p>

					<br>

					<h3>About Content in Pages</h3>
					<p>
						Most site content will be edited via Pages.  The home page and subpages are all Pages in Wordpress.  These
						pages can reference other content types via <a href="#shortcodes">shortcodes</a>, or small snippets that
						do some function or add some predefined content where they're placed in the visual editor.  See the Help
						section on shortcodes for available shortcodes and how to use them.
					</p>
					<p>
						As an example, you might create a new Frequently Asked Questions page whose content uses the [faq-list]
						shortcode to display a list of all the published FAQ posts.
					</p>

					<br>

					<h3>About Customizer Options</h3>
					<p>
						Some parts of the site can only be edited via options in the Customizer, a built-in WordPress tool that
						displays a live preview of your site with editing options.
					</p>
					<p>
						To access the Customizer, when logged in to the WordPress admin, hover over "Appearance" in the left-hand menu
						and click "Customize".  Alternatively, if you are logged in and viewing the site frontend, you can click the
						"Customize" link in the top admin toolbar.
					</p>
					<p>
						Options in the Customizer are separated in labeled groups and should be fairly straightforward.
					</p>

					<br>

					<h3>Editing the Header and Footer</h3>
					<p>
						This theme uses Customizer options and menus to display the site's header (primary navigation and site title)
						and footer (About UCF/Colleges List, primary nav, social nav and contact information).
					</p>

					<h4>Header - Navigation</h4>
					<p>
						The top navigation (from ucf.edu) is a menu, which can be edited from the Customizer (Menus > [menu currently
						set to 'header-menu']).
					</p>
					<p>
						A different menu can be used here by modifying the menu assigned to the Header Menu menu location (Menu >
						Menu Locations > Header Menu).
					</p>

					<h4>Header - Site Title</h4>
					<p>
						The large site title ("Faculty Jobs | We're Hiring.") can be edited in the Customizer (Header > Primary
						Header Text and Secondary Header Text).
					</p>
					<p>
						Keep in mind that the site title is displayed larger on the front page than on other pages.
					</p>

					<h4>Footer - About UCF</h4>
					<p>
						The "About UCF" section in the footer can be modified from the Customizer (Footer > Footer Description).
					</p>

					<h4>Footer - Colleges</h4>
					<p>
						The Colleges section in the footer is a menu, which can be edited from the Customizer (Menus > [menu currently
						set to 'ucf-colleges']).
					</p>
					<p>
						A different menu can be used here by modifying the menu assigned to the UCF Colleges menu location (Menu >
						Menu Locations > UCF Colleges).
					</p>

					<h4>Footer - Navigation</h4>
					<p>
						The bottom navigation in the footer (from ucf.edu) is a menu, which can be edited from the Customizer
						(Menus > [menu currently set to 'footer-menu']).
					</p>
					<p>
						A different menu can be used here by modifying the menu assigned to the Footer Menu menu location (Menu >
						Menu Locations > Footer Menu).
					</p>

					<h4>Footer - Social Icons</h4>
					<p>
						The social icon list (from ucf.edu) is a menu, which can be edited from the Customizer
						(Menus > [menu currently set to 'social-menu']).
					</p>
					<p>
						A different menu can be used here by modifying the menu assigned to the Social Icons Menu menu location
						(Menu > Menu Locations > Social Icons Menu).
					</p>

					<h4>Footer - Contact Information</h4>
					<p>
						The contact information at the bottom of the footer is not editable.
					</p>


					<br>

					<h3>Editing the Home Page</h3>
					<p>
						This theme uses a combination of Page content and Customizer options to display the home page.
					</p>

					<h4>Header Image</h4>
					<p>
						The header image on the home page is the Featured Image of the Page that is set as the Front Page.
						You can change the current Front Page from the Customizer (Home Page > Static Front Page > Front Page;
						make sure "Front Page Displays" is set to "A static page".)
					</p>
					<p>
						Note: the Front Page requires a Featured Image to be set to display a header image.  If a Featured Image
						is not set on the Front Page, the home page header (including the Home Page Header Content and Home Page
						Header CTA button) <strong>will not display.</strong>
					</p>

					<h4>Header Image Contents</h4>
					<p>
						The content and large gold button inside the header image area can be edited from the Customizer
						(Home Page > Home Page Header).
					</p>

					<h4>Everything Else</h4>
					<p>
						All other contents on the home page are pulled from the post content of the page set as the Front Page.
					</p>
					<p>
						Stylized sections on the home page can be created using combinations of callout boxes, rows/columns, and wells.
					</p>
					<p>
						See the <a href="#shortcodes">Shortcodes</a> section of Theme Help for more information about using
						these components.
					</p>

					<br>

					<h3>Editing Sidebars</h3>
					<p>
						Sidebars are reuseable sections that consist of widgets, or customizable drag-and-drop components.  In
						this theme, there are two sidebars:  "Open Position" and "Sidebar".  Despite the naming convention, only
						"Sidebar" is displayed on the frontend as an actual floating sidebar.
					</p>

					<h4>Open Positions</h4>
					<p>
						The Open Positions list will always display immediately below the Front Page header image, and above
						the footer on subpages.  Its contents can be edited from the Widget editor in the Customizer
						(Widgets > Open Positions).
					</p>
					<p>
						The Open Positions widget section is designed to display Open Position widgets.  Technically, other
						widgets can be added, but are not supported.
					</p>
					<p>
						Open Positions can be re-ordered by dragging and dropping Open Position widgets within the editor.
					</p>
					<p>
						The theme is designed to display up to 6 open position widgets.
					</p>
					<p>
						Keep in mind that Open Position lists can be included in other post content arbitrarily using the
						[cluster-open-positions-list] shortcode.
					</p>

					<h4>Sidebar</h4>
					<p>
						The sidebar named "Sidebar" is displayed only on Pages that use the "With Faculty Cluster Sidebar" template.
					</p>
					<p>
						It is intended to display a brief description and list of faculty clusters (using the Text widget),
						but can support some other widgets.
					</p>
				</li>

				<li class="section" id="shortcodes">
					<h2>Shortcodes</h2>
					<p>
						<strong>Shortcodes</strong>, in a nutshell, are <em>shortcuts</em> for displaying or doing various things.  They look like small snippets of code,
						wrapped in square brackets [], but using them requires no knowledge of HTML, CSS, or other code languages.
					</p>

					<p><strong>Navigation:</strong></p>
					<ul class="section-nav">
						<li>
							<a href="#shortcodes-basics">Shortcode Basics</a>
						</li>
						<li>
							<a href="#shortcodes-post-type-list">(post type)-list</a>
						</li>
						<li>
							<a href="#shortcodes-callout">Callout</a>
						</li>
						<li>
							<a href="#shortcodes-clearfix">Clearfix</a>
						</li>
						<li>
							<a href="#shortcodes-chevron-link">Chevron Link</a>
						</li>
						<li>
							<a href="#shortcodes-cluster-grid-list">Cluster Grid List</a>
						</li>
						<li>
							<a href="#shortcodes-cluster-list">Cluster List</a>
						</li>
						<li>
							<a href="#shortcodes-cluster-open-positions-list">Cluster Open Positions List</a>
						</li>
						<li>
							<a href="#shortcodes-cluster-parallax">Cluster Parallax</a>
						</li>
						<li>
							<a href="#shortcodes-cluster-parallax-list">Cluster Parallax List</a>
						</li>
						<li>
							<a href="#shortcodes-column">Column</a>
						</li>
						<li>
							<a href="#shortcodes-cta-button">CTA Button</a>
						</li>
						<li>
							<a href="#shortcodes-featured-link">Featured Link</a>
						</li>
						<li>
							<a href="#shortcodes-row">Row</a>
						</li>
						<li>
							<a href="#shortcodes-well">Well</a>
						</li>
					</ul>

					<br><hr><br>

					<h3 id="shortcodes-basics">Shortcode Basics</h3>

					<p>
						When a shortcode is added to post content, it will be displayed in the editor as a code snippet, but when you view the post as a preview or live post,
						you will see the output of what the shortcode is programmed to do, with the <strong>content</strong> and <strong>attributes</strong> you provide.
					</p>
					<p>
						The shortcodes listed below have a <strong>starting tag</strong> ([my-shortcode]) and an <strong>ending tag</strong> ([/my-shortcode]).  Depending on
						the shortcode used, such as the [callout] and [well] shortcodes, <strong>content</strong> between the starting and ending tags is used.  Other
						shortcodes, like the [clearfix] shortcode, do not use any content between the starting and ending tags.
					</p>
					<p>
						Some shortcodes use <strong>attributes</strong> to define extra options for whatever the given shortcode does.  For example, the [callout]
						shortcode has a "background" attribute, which lets you set a custom background color for the callout box.
					</p>

					<p>
						The custom available shortcodes for this site, as well as their available attributes and examples, are listed below.
					</p>

					<hr>
					<br>

					<h3 id="shortcodes-post-type-list">(post type)-list</h4>
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
<pre><code># Output a list of all FAQs:
[faq-list]

# Output all People matching the terms in the custom taxonomy named 'org_groups'
[person-list org_groups="term list example"]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-callout">Callout</h3>
					<p>
						Creates a full-width box that breaks out of the primary content column to help text or other content stand out.
					</p>
					<p>
						Callouts can contain row and column shortcodes to create complex layouts.  See the first example below.
					</p>
					<p>
						Callout boxes should <strong>not</strong> be called <em>inside of</em> any other shortcodes.  Doing so could cause the layout on the frontend to break.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>requires content</strong> between its starting and ending tags.<br/>
						<strong>Any text, media or other shortcodes</strong> are permitted between the shortcode tags.
					</p>

					<h4>Attributes</h4>
					<table>
						<tr>
							<th scope="col">Name</th>
							<th scrop="col">Attribute</th>
							<th scope="col">Description</th>
							<th scope="col">Default Value</th>
						</tr>
						<tr>
							<td>Background Color</td>
							<td>background</td>
							<td>The color to be used for the background of the callout box.</td>
							<td>#f0f0f0</td>
						</tr>
						<tr>
							<td>Background Image</td>
							<td>background_image</td>
							<td>An optional background image for the callout box.</td>
							<td></td>
						</tr>
						<tr>
							<td>Extra Classes</td>
							<td>class</td>
							<td>Any additional CSS classes to add to the callout box container div.</td>
							<td></td>
						</tr>
						<tr>
							<td>Text Color</td>
							<td>color</td>
							<td>Default text color to use within the callout box.  Can be overridden inline using visual editor tools.</td>
							<td>#000</td>
						</tr>
						<tr>
							<td>Content Alignment</td>
							<td>content_align</td>
							<td>Content text can be aligned left, right or center.</td>
							<td>center</td>
						</tr>
						<tr>
							<td>Minimum Height</td>
							<td>min_height</td>
							<td>A minimum height value for the box.  Keep in mind that this value will be used on all screen sizes--use carefully.</td>
							<td></td>
						</tr>
						<tr>
							<td>Enable Parallax Effect</td>
							<td>parallax</td>
							<td>Setting this value to 'true' will cause the background image to scroll with a parallax effect, if one is set.</td>
							<td>false</td>
						</tr>
					</table>

					<h4 id="shortcodes-callout-classes">Custom Classes for Callouts</h4>
					<p>
						In this theme, several predefined CSS classes have been added to give callout boxes particular styles.  These classes
						can be added to a callout box using the "class" attribute on the shortcode (see "Attributes" table above).
					</p>
					<table>
						<tr>
							<th scrop="col">Class</th>
							<th scope="col">Description</th>
							<th scope="col">Column Classes</th>
						</tr>
						<tr>
							<td>
								n/a
								<br>
								(default)
							</td>
							<td>
								By default, callouts use a light gray background color and black text.  These can be overridden
								using the attributes listed in the "Attributes" table above, or overridden inline using the visual
								editor when editing a page.
							</td>
							<td>
								The classes below can be applied to columns within any callout, regardless of extra classes applied
								to the callout.  Keep in mind that some column classes may not work well with certain callouts.
								<br>
								<table>
									<tr>
										<th scrop="col">Class</th>
										<th scope="col">Description</th>
									</tr>
									<tr>
										<td>bordered</td>
										<td>
											Applies a gold border to the entire column.
										</td>
									</tr>
									<tr>
										<td>bordered-dots</td>
										<td>
											Applies a left-hand dotted border to a column.
										</td>
									</tr>
									<tr>
										<td>smaller</td>
										<td>
											Reduces the font size within the column and applies an alternate font face to the column's
											contents (Helvetica) for readability.
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>faculty-statistics</td>
							<td>
								Will not add any additional styles on its own, but when a column with this class is wrapped around
								a set of rows/columns, will apply borders and equal heights to each column, as well as a hover
								effect over each column.
								<br><br>
								Intended to be used to display stylized numbers and percentages.  Featured numbers should be wrapped
								within a &lt;strong&gt; tag.
							</td>
							<td>
								<table>
									<tr>
										<th scrop="col">Class</th>
										<th scope="col">Description</th>
									</tr>
									<tr>
										<td>highlighted</td>
										<td>
											Will apply a background color and text color change to the affected column.  Intended
											to be used on a single column within the callout.
										</td>
									</tr>
									<tr>
										<td>middle</td>
										<td>
											When creating a row of more than 2 columns, apply this class to a middle column to
											remove left- and right-hand borders (to avoid a double-bordered effect.)
										</td>
									</tr>
									<tr>
										<td>full</td>
										<td>
											Apply this class to a full-width column (.col-[xx]-12) within the callout.  When added
											to a column that sits below other columns, it is pushed up to avoid a double-bordered
											effect.
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>callout-cta</td>
							<td>
								Styles a callout intended to be used as a short call-to-action statement with a button.
								<br><br>
								When applied, an h2 element within the callout is enlarged and given an alternate color.
								Any call-to-action button ([cta-btn]) used within the callout is given white text.
							</td>
							<td>
								n/a
							</td>
						</tr>
						<tr>
							<td>faculty-profile-callout</td>
							<td>
								Intended to be used specifically for callouts that feature a faculty member as the background
								image and include a blockquote within the callout's contents.
								<br><br>
								When this class is applied, blockquote elements and their cite elements are given alternate
								styles.  The height and padding of the callout will also be modified slightly from the default.
							</td>
							<td>
								n/a
							</td>
						</tr>
						<tr>
							<td>sans-serif-alt</td>
							<td>
								Applies an alternate font family (Helvetica) on the callout and its child elements.
							</td>
							<td>
								n/a
							</td>
						</tr>
					</table>


					<h4>Examples</h4>
<pre><code>[callout background="#fff"]
[row]
[column md="8"]
This is a left-hand content column. The row and column shortcodes are
wrapped in a callout with a white background to add extra vertical padding.
[/column]
[column md="4"]
This is some side content.
[/column]
[/row]
[/callout]</code></pre>
<pre><code>[callout content_align="right"]&lt;p&gt;This text is aligned right.&lt;/p&gt;[/callout]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-clearfix">Clearfix</h3>
					<p>
						Inserts a hidden element which clears floats above and below where the shortcode is inserted.
					</p>
					<p>
						Use this shortcode to force a chunk of story contents to fall underneath an aligned photo or
						sidebar (instead of being aligned to the left/right of the photo or sidebar).
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>uses no content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<p>
						This shortcode has no available attributes.
					</p>

					<h4>Examples</h4>
<pre><code>&lt;img src="..." style="float: right;"&gt;

Contents that are shorter than the floated image here.  This text is aligned next to the image.

[clearfix][/clearfix]

The contents under this shortcode will now span the full width of the page's available space,
and fall *under* the image, instead of next to it.
</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-chevron-link">Chevron Link</h3>
					<p>
						Inserts an arrow icon to the left of link text.
					</p>
					<p>
						Use this shortcode to add an arrow icon to the left of a link.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>requires content</strong> between its starting and ending tags.<br/>
						Only a <strong>single line of text</strong> (no line breaks or new paragraphs) is permitted between the shortcode tags.<br/>
					</p>

					<h4>Attributes</h4>
					<p>
						This shortcode has no available attributes.
					</p>

					<h4>Examples</h4>
<pre><code>[chevron-link]&lt;a href="http://wordpress.org"&gt;some link text here...&lt;/a&gt;[/chevron-link]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-cluster-grid-list">Cluster Grid List</h3>
					<p>
						Displays short description for all Faculty Clusters in a 3-column-per-row grid layout.
					</p>
					<p>
						Use this shortcode to display a preview of all Faculty Clusters. If the short description field for the Faculty Cluster is not filled out, the excerpt (the first 55 words of the post) will be used.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>uses no content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<p>
						This shortcode has no available attributes.
					</p>

					<h4>Examples</h4>
					<pre><code>[cluster-grid-list]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-cluster-open-positions-list">Cluster Open Positions List</h3>
					<p>
						Displays a list of links to each of the Open Positions in horizontal layout.
					</p>
					<p>
						Use this shortcode to display a list of Open Positions (job listings). Open Positions are defined in the Open Positions sidebar.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>uses no content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<p>
						This shortcode has no available attributes.
					</p>

					<h4>Examples</h4>
					<pre><code>[cluster-open-positions-list]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-cluster-parallax">Cluster Parallax</h3>
					<p>
						Displays all Faculty Clusters with parallax header images and short descriptions.
					</p>
					<p>
						Use this shortcode to display a large preview of an individual Faculty Cluster. The preview utilizes the full width of the page and lists the Cluster lead(s) and Cluster point(s) of contact. Cluster can be <a href="#shortcodes-cluster-parallax_attributes">specified by ID or by slug</a>
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>uses no content</strong> between its starting and ending tags.
					</p>

					<h4 id="shortcodes-cluster-parallax_attributes">Attributes</h4>
					<table>
						<tr>
							<th scope="col">Name</th>
							<th scrop="col">Attribute</th>
							<th scope="col">Description</th>
							<th scope="col">Default Value</th>
						</tr>
						<tr>
							<td>Faculty Cluster Name</td>
							<td>slug</td>
							<td>The slug of the Faculty Cluster to be displayed.</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>Faculty Cluster ID</td>
							<td>id</td>
							<td>The id of the Faculty Cluster to be displayed.</td>
							<td>n/a</td>
						</tr>
					</table>

					<h4>Examples</h4>
					<pre><code>[cluster-parallax slug="sustainable-coastal-systems"]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-cluster-parallax-list">Cluster Parallax List</h3>
					<p>
						Displays all Faculty Clusters with parallax header images and short descriptions.
					</p>
					<p>
						Use this shortcode to display a list of large previews of Faculty Clusters. The previews utilize the full width of the page and lists the Cluster lead(s) and Cluster point(s) of contact. To list a single Faculty Cluster, use <a href="#shortcodes-cluster-parallax">[cluster-parallax]</a>.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>uses no content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<p>
						This shortcode has no available attributes.
					</p>

					<h4>Examples</h4>
					<pre><code>[cluster-parallax-list]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-column">Column</h3>
					<p>
						Used for wrapping content inside of a column.  Columns are directly generated using the Bootstrap grid.  See examples
						on <a href="http://getbootstrap.com/css/#grid-example-basic" target="_blank">Bootstrap's documentation website</a>
						for more information.
					</p>
					<p>
						Note: this shortcode should <strong>only</strong> be used immediately inside of <a href="#shortcodes-row">[row] shortcodes</a>.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>accepts content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<table>
						<tr>
							<th scope="col">Name</th>
							<th scrop="col">Attribute</th>
							<th scope="col">Description</th>
							<th scope="col">Default Value</th>
						</tr>
						<tr>
							<td>-xs Column Size</td>
							<td>xs</td>
							<td>
								The size of this column when viewed on screens with a width of
								<strong>767px or lower</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>-sm Column Size</td>
							<td>sm</td>
							<td>
								The size of this column when viewed on screens with a width of at least
								<strong>768px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							<td>n/a</td>
						</tr>
						<tr>
							<td>-md Column Size</td>
							<td>md</td>
							<td>
								<strong>This attribute is required for full cross-browser grid support.</strong>
								<br><br>
								The size of this column when viewed on screens with a width of at least
								<strong>992px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>-lg Column Size</td>
							<td>lg</td>
							<td>
								The size of this column when viewed on screens with a width of at least
								<strong>1200px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							</td>
							<td>n/a</td>
						</tr>

						<tr>
							<td>-xs Offset</td>
							<td>xs_offset</td>
							<td>
								Push a column to the right by some number of column sizes.  Applies when viewed
								on screens with a width of
								<strong>767px or lower</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>-sm Offset</td>
							<td>sm_offset</td>
							<td>
								Push a column to the right by some number of column sizes.  Applies when viewed
								on screens with a width of at least
								<strong>768px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>-md Offset</td>
							<td>md_offset</td>
							<td>
								Push a column to the right by some number of column sizes.  Applies when viewed
								on screens with a width of at least
								<strong>992px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>-lg Offset</td>
							<td>lg_offset</td>
							<td>
								Push a column to the right by some number of column sizes.  Applies when viewed
								on screens with a width of at least
								<strong>1200px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.</td>
							<td>n/a</td>
						</tr>

						<tr>
							<td>-xs Push, Pull</td>
							<td>
								xs_push
								<br>
								xs_pull
							</td>
							<td>
								Re-orders a column (when combined with at least 1 other column that uses a Push
								or Pull attribute). Applies when viewed on screens with a width of
								<strong>767px or lower</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>-sm Push, Pull</td>
							<td>
								sm_push
								<br>
								sm_pull
							</td>
							<td>
								Re-orders a column (when combined with at least 1 other column that uses a Push
								or Pull attribute). Applies when viewed on screens with a width of at least
								<strong>768px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>-md Push, Pull</td>
							<td>
								md_push
								<br>
								md_pull
							</td>
							<td>
								Re-orders a column (when combined with at least 1 other column that uses a Push
								or Pull attribute). Applies when viewed on screens with a width of at least
								<strong>992px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>-lg Push, Pull</td>
							<td>
								lg_push
								<br>
								lg_pull
							</td>
							<td>
								Re-orders a column (when combined with at least 1 other column that uses a Push
								or Pull attribute). Applies when viewed on screens with a width of at least
								<strong>1200px</strong>.
								<br>
								Expects a single number value, ranging from 1-12.
							</td>
							<td>n/a</td>
						</tr>

						<tr>
							<td>Extra Classes</td>
							<td>class</td>
							<td>
								Any additional CSS classes to add to the generated column div.
							</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>Inline Styles</td>
							<td>style</td>
							<td>
								Any inline CSS styles to add to the generated column div.
							</td>
							<td>n/a</td>
						</tr>
					</table>

					<h4>Extra Classes</h4>
					<p>
						When a column is used within a callout, some predefined CSS classes may be available to add additional predefined
						styles.
						<a href="#shortcodes-callout-classes">See the section on column classes under the callout section</a> for more information.
					</p>

					<h4>Examples</h4>
					<pre><code>[row][column md="8"]Left-hand content[/column][column md="4"]Right-hand content[/column][/row]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-cta-button">CTA Button</h3>
					<p>
						Creates a link in the form of a button with a customizable call to action label.
					</p>
					<p>
						Use this shortcode to display a custom call to action button, with a custom click-through link and/or a custom label.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>accepts optional content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<table>
						<tr>
							<th scope="col">Name</th>
							<th scrop="col">Attribute</th>
							<th scope="col">Description</th>
							<th scope="col">Default Value</th>
						</tr>
						<tr>
							<td>Link URL</td>
							<td>href</td>
							<td>The URL to be used as the link's href value.</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>CSS Classes</td>
							<td>class</td>
							<td>Additonal class values to be added to the button markup.</td>
							<td>n/a</td>
						</tr>
						<tr>
							<td>ID</td>
							<td>id</td>
							<td>ID value to be added to the button markup.</td>
							<td>n/a</td>
						</tr>
					</table>

					<h4>Examples</h4>
					<pre><code>[cta-btn href="http://jobswithucf.com"]Join Us![/cta-btn]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-featured-link">Featured Link</h3>
					<p>
						Wraps content inside of a div with the 'featured-link' class applied to it
					</p>
					<p>
						Use this shortcode when displaying link with italicised description combinations, typically in right hand columns or sidebars.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>accepts content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<p>
						This shortcode has no available attributes.
					</p>

					<h4>Examples</h4>
					<pre><code>[featured-link]&lt;a href="http://wordpress.org"&gt;some link text here...&lt;/a&gt;[/featured-link]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-row">Row</h3>
					<p>
						Wraps a set of <a href="#shortcodes-column">columns</a>.
					</p>
					<p>
						This shortcode should be used any time a new set of columns is created.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>accepts content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<table>
						<tr>
							<th scope="col">Name</th>
							<th scrop="col">Attribute</th>
							<th scope="col">Description</th>
							<th scope="col">Default Value</th>
						</tr>
						<tr>
							<td>CSS Classes</td>
							<td>class</td>
							<td>Additonal class values to be added to the row div.</td>
							<td>n/a</td>
						</tr>
					</table>

					<h4>Examples</h4>
					<pre><code>[row][column md="8"]Left-hand content[/column][column md="4"]Right-hand content[/column][/row]</code></pre>

					<hr>
					<br>

					<h3 id="shortcodes-well">Well</h3>
					<p>
						Wraps content inside of a padded gray div.
					</p>
					<p>
						Use this shortcode when emphasizing a block of text.
					</p>

					<h4>Content</h4>
					<p>
						This shortcode <strong>accepts content</strong> between its starting and ending tags.
					</p>

					<h4>Attributes</h4>
					<p>
						This shortcode has no available attributes.
					</p>

					<h4>Examples</h4>
					<pre><code>[well]some link text here...[/well]</code></pre>

				</li>

			</ul>
		</div>
	</div>
</div>
