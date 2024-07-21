<?php
/*
Template Name: Archives - Resource
*/
get_header();
?>

<div id="container">
    <div id="content" role="main">
    <div id="taxonomy-filters">
    <?php
    // Get all taxonomies associated with 'resource' post type
    $taxonomies = get_object_taxonomies('resource', 'objects');

    if (!empty($taxonomies)) {
        foreach ($taxonomies as $taxonomy) {
            ?>
            <div class="taxonomy-filter" id="taxonomy-<?php echo esc_attr($taxonomy->name); ?>-filter">
                <?php
                // Get all terms from the current taxonomy
                $terms = get_terms(array(
                    'taxonomy' => $taxonomy->name,
                    'hide_empty' => true,
                ));

                if (!empty($terms)) {
                    ?>
                    <label><?php echo esc_html($taxonomy->labels->singular_name); ?>:</label><br>
                    <?php foreach ($terms as $term) { ?>
                        <label>
                            <input type="checkbox" class="filter-checkbox" data-taxonomy="<?php echo esc_attr($taxonomy->name); ?>" value="<?php echo esc_attr($term->slug); ?>">
                            <?php echo esc_html($term->name); ?>
                        </label><br>
                    <?php } ?>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
    ?>
</div>



        <div id="search-container">
            <form id="search-form">
                <label for="search-input">Search:</label>
                <input type="text" id="search-input" name="search">
                <button type="button" id="reset-filters">Reset</button>
                <button type="submit" id="search-submit">Search</button>
            </form>
        </div>

        <div id="resource-container">
            <?php
            // Query to display the initial 6 posts without AJAX
            $query = new WP_Query(array(
                'post_type' => 'resource', // Adjust to your custom post type if needed
                'posts_per_page' => 6,    // Display 6 posts per page initially
                'order' => 'ASC',
                'orderby' => 'date',
            ));

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <div class="post">
                        <h2><?php the_title(); ?></h2>
                        <div class="entry-content">
                            <?php t//he_excerpt(); ?>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
            else{
                echo '<div class="no-post-message"> No Posts Found </div>';
            }
            ?>
        </div>
        <div id="load-more">
            <button id="load-more-button">Load More</button>
        </div>
    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
