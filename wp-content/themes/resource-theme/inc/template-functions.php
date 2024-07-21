<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Resource_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function resource_theme_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'resource_theme_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function resource_theme_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'resource_theme_pingback_header');


function theme_enqueue_scripts()
{
	// Enqueue main script file
	wp_enqueue_script('resource-theme-action', get_template_directory_uri() . '/js/action.js', array('jquery'), _S_VERSION, true);

	// Localize the script with new data
	wp_localize_script(
		'resource-theme-action',
		'resource_theme_action_object',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('load_more_posts_nonce'), // Add nonce for security
		)
	);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


add_action('wp_ajax_load_filtered_posts', 'load_posts_ajax_handler');
add_action('wp_ajax_nopriv_load_filtered_posts', 'load_posts_ajax_handler'); // for users not logged in

function load_posts_ajax_handler()
{
	check_ajax_referer('load_more_posts_nonce', 'nonce');

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$filters = isset($_POST['filters']) ? $_POST['filters'] : array();
	$search_query = isset($_POST['s']) ? sanitize_text_field($_POST['s']) : ''; // Sanitize search query
	$tax_query = array('relation' => 'AND'); // Initialize tax_query

	// Build tax_query based on selected filters
	foreach ($filters as $taxonomy => $terms) {
		if ($taxonomy !== 's') {
			$tax_query[] = array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $terms,
			);
		}
	}

	$args = array(
		'post_type' => 'resource', // Adjust to your custom post type if needed
		'posts_per_page' => 6,
		'paged' => $page,
		'tax_query' => $tax_query,
		's' => $search_query, // Include search query
		'orderby' => 'date',
		'order' => 'ASC',
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		ob_start();
		while ($query->have_posts()) {
			$query->the_post();
?>
			<div class="post">
				<?php if (has_post_thumbnail()) {?>
					<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')); ?>" alt="<?php the_title_attribute(); ?>">
						</a>
					</div>
				<?php } 
				else{?>
				<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<img src="http://localhost:88/wordpress_assignment/wp-content/uploads/2024/07/default_image.png" alt="resource default image">
						</a>
					</div>

				<?php }?>
				
				<h2><?php the_title(); ?></h2>
				<div class="entry-content">
                                <?php
                                global $post;

                                // Display the excerpt of the content
                                $content = apply_filters('the_content', $post->post_content);
                                $excerpt = wp_trim_words($content, 40, '...'); // Limit to 40 words, adjust as needed
								if($excerpt){
                                // Output the excerpt
                                echo '<div class="excerpt">' . $excerpt . '</div>';

                                // Output the "Read More" button
                                echo '<a class="read-more-button" href="#">Read More</a>';
                                }
								else{
									echo '<div class="excert">'.get_the_content().'</div>';
								}?>
                </div>
			</div>
<?php
		}
		wp_reset_postdata();
		$response = ob_get_clean();
		echo json_encode(array(
			'posts' => $response,
			'current_page' => $page,
			'max_page' => $query->max_num_pages,
		));
	} else {
		echo json_encode(array(
			'posts' => '<div class="no-post-message"> No Posts Found </div>',
			'current_page' => $page,
			'max_page' => $query->max_num_pages,
		));
	}

	wp_die();
}

