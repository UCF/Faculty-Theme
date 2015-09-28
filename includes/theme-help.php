<?php global $shortcode_tags; ?>
<div id="theme-help" class="i-am-a-fancy-admin">
	<div class="container">
		<h2>Help</h2>

		<div class="sections">
			<ul>
				<li class="section"><a href="#posting">Posting</a></li>
				<li class="section"><a href="#shortcodes">Shortcodes</a></li>
			</ul>
		</div>
		<div class="fields">
			<ul>

				<li class="section" id="posting">
					<h3>Posting</h3>
					<p>Posting is fun, do it.</p>
				</li>

				<li class="section" id="shortcodes">
					<h3>Shortcodes</h3>

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
              <a href="#shortcodes-blockquote">Blockquote</a>
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
              <a href="#shortcodes-faq-list">FAQ List</a>
            </li>
            <li>
              <a href="#shortcodes-featured-link">Featured Link</a>
            </li>
            <li>
              <a href="#shortcodes-well">Well</a>
            </li>
            <li>
              <a href="#shortcodes-post-type-list">(post type)-list</a>
            </li>
          </ul>

          <hr/>
          <br/>

          <h3 id="shortcodes-basics">Shortcode Basics</h3>

          <p>
            When a shortcode is added to post content, it will be displayed in the editor as a code snippet, but when you view the post as a preview or live post,
            you will see the output of what the shortcode is programmed to do, with the <strong>content</strong> and <strong>attributes</strong> you provide.
          </p>
          <p>
            The shortcodes listed below have a <strong>starting tag</strong> ([my-shortcode]) and an <strong>ending tag</strong> ([/my-shortcode]).  Depending on
            the shortcode used, such as the [lead] and [blockquote] shortcodes, <strong>content</strong> between the starting and ending tags is used.  Other
            shortcodes, like the [slideshow] shortcode, do not use any content between the starting and ending tags.
          </p>
          <p>
            Some shortcodes use <strong>attributes</strong> to define extra options for whatever the given shortcode does.  For example, the [callout] and [sidebar]
            shortcodes have a "background" attribute, which lets you set a custom background color for the callout box or sidebar.
          </p>

          <p>
            The custom available shortcodes for this site, as well as their available attributes and examples, are listed below.  For information about adding
            shortcodes to post content, please visit the Adding Content via Shortcodes section of the <a href="#stories">Story documentation</a>.
          </p>

          <hr/>
          <br/>

          <h3 id="shortcodes-blockquote">Blockquote</h3>
          <p>
            Creates a stylized blockquote.  Text in the blockquote is large Georgia italic.
          </p>
          <p>
            If a <strong>source</strong> attribute is provided, the blockquote will be styled with oversized starting and ending quotation marks.
          </p>

          <h4>Content</h4>
          <p>
            This shortcode <strong>requires content</strong> between its starting and ending tags.<br/>
            Only a <strong>single line of text</strong> (no line breaks or new paragraphs) is permitted between the shortcode tags.<br/>
            When used in a story, the Default Template Header Font Color is used for the color of the main quote, unless a Text Color attribute
            is specified.
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
              <td>Source</td>
              <td>source</td>
              <td>Who said the quote. (optional)</td>
              <td>n/a</td>
            </tr>
            <tr>
              <td>Cite</td>
              <td>cite</td>
              <td>Citing of where the quote came from. (optional)</td>
              <td>n/a</td>
            </tr>
            <tr>
              <td>Text Color</td>
              <td>color</td>
              <td>The color of the blockquote text, source and cite. (optional)</td>
              <td>#000 (source/cite: #444)</td>
            </tr>
          </table>

          <h4>Examples</h4>
          <pre><code>[blockquote]Powerful quote of the day.[/blockquote]</code></pre>
          <pre><code>[blockquote source="Jane Doe" cite="Some Cool Book"]Powerful quote of the day.[/blockquote]</code></pre>

          <hr/>
          <br/>

          <h3 id="shortcodes-callout">Callout</h3>
          <p>
            Creates a full-width box that breaks out of the primary content column to help text or other content stand out.
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
              <td>Content Alignment</td>
              <td>content_align</td>
              <td>Content text can be aligned left, right or center.</td>
              <td>center</td>
            </tr>
          </table>

          <h4>Examples</h4>
          <pre><code>[callout background="#e1e1e1"][blockquote]Very very powerful quote![/blockquote][/callout]</code></pre>
          <pre><code>[callout content_align="right"]&lt;p&gt;Lorem ipsum dolor sit amet.&lt;/p&gt;[/callout]</code></pre>

          <hr/>
          <br/>

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
          <pre><code>[sidebar position="right"]Long sidebar contents here...[/sidebar]

Contents that are shorter than the sidebar here.  This text is aligned next to the sidebar.

[clearfix][/clearfix]

The contents under this shortcode will now span the full width of the story's available space,
and fall *under* the sidebar, instead of next to it.
</code></pre>

          <hr/>
          <br/>

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
          <pre><code>[chevron-link]&lt;a href="http://wordpress.org"&gt;some link text here...&lt;/a&gt;[/chevron-link]

[chevron-link]<a href="http://wordpress.org">some link text here...</a>[/chevron-link]</code></pre>

          <hr/>

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

          <hr/>
          <br/>

          <h3 id="shortcodes-cluster-list">Cluster List</h3>
          <p>
           Displays a list of links to each of the Faculty Clusters.
          </p>
          <p>
            Use this shortcode to display a list of links for all Faculty Clusters.
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
          <pre><code>[cluster-list]</code></pre>

          <hr/>
          <br/>

          <h3 id="shortcodes-cluster-open-positions-list">Cluster Open Positions List</h3>
          <p>
           Displays a list of links to each of the Open Positions in horizontal layout.
          </p>
          <p>
            Use this shortcode to display a list of Open Positions (job listings). Open Positions are defined in the Open Positions widget.
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

          <hr/>
          <br/>

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
          <pre><code>[cluster-parallax]</code></pre>

          <hr/>

          <h3 id="shortcodes-cluster-parallax-list">Cluster Parallax List</h3>
          <p>
           Displays all Faculty Clusters with parallax header images and short descriptions.
          </p>
          <p>
            Use this shortcode to display a list of large previews of Faculty Clusters. The previews utilize the full width of the page and lists the Cluster lead(s) and Cluster point(s) of contact. To list a single Faculty Cluster, use <a href="">[cluster-parallax]</a>.
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

          <hr/>
          <br/>

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

          <hr/>
          <br/>

          <h3 id="shortcodes-faq-list">Frequently Asked Questions List</h3>
          <p>
           Displays all Faculty Clusters with parallax header images and short descriptions.
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
          <pre><code>[faq-list]</code></pre>

          <h4>(post type)-list</h4>
          <p>
            For more details, see <a href="#shortcodes-post-type-list">(post type)-list</a>
          </p>

          <hr/>
          <br/>

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
          <pre><code>[featured-link]<a href="http://wordpress.org">some link text here...</a>[/featured-link]</code></pre>

          <hr/>
          <br/>

          <h3 id="shortcodes-well">Well</h3>
          <p>
           Wraps content inside of a rounded-corner, gray div.
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

          <hr/>
          <br/>

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
<pre><code># Output a maximum of 5 Documents tagged 'foo' or 'bar', with a default output.
[document-list tags="foo bar" limit=5]No Documents were found.[/document-list]

# Output all People categorized as 'foo'
[person-list categories="foo"]

# Output all People matching the terms in the custom taxonomy named 'org_groups'
[person-list org_groups="term list example"]

# Outputs all People found categorized as 'staff' and in the org_group 'small'.
[person-list limit=5 join="and" categories="staff" org_groups="small"]</code></pre>

			</ul>
		</div>
	</div>
</div>
