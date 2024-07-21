<?php

// Register Custom Post Type
function custom_post_type_plugin_register_resource_post_type() {
    $labels = array(
        'name'               => 'Resources',
        'singular_name'      => 'Resource',
        'menu_name'          => 'Resources',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Resource',
        'edit'               => 'Edit',
        'edit_item'          => 'Edit Resource',
        'new_item'           => 'New Resource',
        'view'               => 'View',
        'view_item'          => 'View Resource',
        'search_items'       => 'Search Resources',
        'not_found'          => 'No resources found',
        'not_found_in_trash' => 'No resources found in trash',
        'parent_item_colon'  => 'Parent Resource:',
        'all_items'          => 'All Resources',
        'archives'           => 'Resource Archives',
        'attributes'         => 'Resource Attributes',
        'insert_into_item'   => 'Insert into resource',
        'uploaded_to_this_item' => 'Uploaded to this resource',
        'featured_image'     => 'Featured Image',
        'set_featured_image' => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image' => 'Use as featured image',
        'filter_items_list'  => 'Filter resources list',
        'items_list_navigation' => 'Resources list navigation',
        'items_list'         => 'Resources list',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'resource' ),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'taxonomies'          => array( 'resource_topic','resource_topic_tag','resource_type','resource_type_tag' ),
        'taxonomies'          => array( ),
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-book-alt', // Customize as needed
        'show_in_rest'        => true,

    );

    register_post_type( 'resource', $args );
}
add_action( 'init', 'custom_post_type_plugin_register_resource_post_type' );

