<?php
// Register Taxonomy: Resource Type
function create_resource_type_taxonomy() {
    $labels = array(
        'name'                       => 'Resource Types',
        'singular_name'              => 'Resource Type',
        'menu_name'                  => 'Resource Types',
        'all_items'                  => 'All Resource Types',
        'edit_item'                  => 'Edit Resource Type',
        'view_item'                  => 'View Resource Type',
        'update_item'                => 'Update Resource Type',
        'add_new_item'               => 'Add New Resource Type',
        'new_item_name'              => 'New Resource Type Name',
        'parent_item'                => 'Parent Resource Type',
        'parent_item_colon'          => 'Parent Resource Type:',
        'search_items'               => 'Search Resource Types',
        'popular_items'              => 'Popular Resource Types',
        'separate_items_with_commas' => 'Separate resource types with commas',
        'add_or_remove_items'        => 'Add or remove resource types',
        'choose_from_most_used'      => 'Choose from the most used resource types',
        'not_found'                  => 'No resource types found'
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'resource-type' ),
        'show_in_rest'      => true,
    );

    // Add support for default tags taxonomy
    $args['taxonomies'] = array( 'resource_type_tag' );

    register_taxonomy( 'resource_type', 'resource', $args );
}
add_action( 'init', 'create_resource_type_taxonomy' );










?>