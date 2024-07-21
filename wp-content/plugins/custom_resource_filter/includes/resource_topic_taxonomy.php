<?php
// Register Custom Taxonomy - Resource Topic

function create_resource_topic_taxonomy() {
    $labels = array(
        'name'                       => 'Resource Topics',
        'singular_name'              => 'Resource Topic',
        'menu_name'                  => 'Resource Topics',
        'all_items'                  => 'All Resource Topics',
        'edit_item'                  => 'Edit Resource Topic',
        'view_item'                  => 'View Resource Topic',
        'update_item'                => 'Update Resource Topic',
        'add_new_item'               => 'Add New Resource Topic',
        'new_item_name'              => 'New Resource Topic Name',
        'parent_item'                => 'Parent Resource Topic',
        'parent_item_colon'          => 'Parent Resource Topic:',
        'search_items'               => 'Search Resource Topics',
        'popular_items'              => 'Popular Resource Topics',
        'separate_items_with_commas' => 'Separate resource topics with commas',
        'add_or_remove_items'        => 'Add or remove resource topics',
        'choose_from_most_used'      => 'Choose from the most used resource topics',
        'not_found'                  => 'No resource topics found'
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'resource-topic' ),
        'show_in_rest'      => true,
    );

    // Add support for default tags taxonomy
    $args['taxonomies'] = array( 'resource_topic_tag' );

    register_taxonomy( 'resource_topic', 'resource', $args );
}
add_action( 'init', 'create_resource_topic_taxonomy' );
