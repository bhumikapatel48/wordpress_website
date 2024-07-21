<?php
/*
Template Name: Archives - Resource
*/
get_header();
?>

<div id="container">
    <div id="content" role="main">
        <div class="filter-main">
            
            <div id="taxonomy-filters">
            <h2 class="filter-title">Resource Filter</h2>
            
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
                    <!-- <label for="search-input">Search:</label> -->
                    <input type="text" id="search-input" name="search" placeholder="Search Here">
                    <button type="submit" id="search-submit">Search</button>
                </form>
            </div>

            <div id="reset-filter">
                <button type="button" id="reset-filters">Reset</button>
            </div>
        </div>
        <div class="filter-sub">
            <div id="resource-container">
            </div>
            <div id="load-more">
                <button id="load-more-button">Load More</button>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>