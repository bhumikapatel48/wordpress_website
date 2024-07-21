<?php
/*
Plugin Name: Custom Resource Filter
Description: Custom resource filter plugin with AJAX.
Version: 1.0
Author: Bhumika Patel
*/

// Include resource post type registration
require_once( plugin_dir_path( __FILE__ ) . 'includes/resource_post_type.php' );

// Include resource topic taxonomy registration
require_once( plugin_dir_path( __FILE__ ) . 'includes/resource_topic_taxonomy.php' );

// Include resource type taxonomy registration
require_once( plugin_dir_path( __FILE__ ) . 'includes/resource_type_taxonomy.php' );

// Add Action Links for Activate, Deactivate, Delete
function custom_post_type_plugin_action_links( $actions, $post ) {
    if ( $post->post_type == 'custom_post_type' ) {
        $actions['activate'] = '<a href="' . admin_url( 'admin-post.php?action=activate_post&id=' . $post->ID ) . '">Activate</a>';
        $actions['deactivate'] = '<a href="' . admin_url( 'admin-post.php?action=deactivate_post&id=' . $post->ID ) . '">Deactivate</a>';
        $actions['delete'] = '<a href="' . get_delete_post_link( $post->ID ) . '">Delete</a>';
    }
    return $actions;
}
add_filter( 'post_row_actions', 'custom_post_type_plugin_action_links', 10, 2 );

// Handle Activate/Deactivate Actions
function custom_post_type_plugin_handle_actions() {
    if ( isset( $_GET['action'] ) && isset( $_GET['id'] ) ) {
        $action = $_GET['action'];
        $post_id = $_GET['id'];
        
        if ( $action === 'activate_post' ) {
            // Perform activation logic (update post meta, etc.)
            update_post_meta( $post_id, '_custom_post_status', 'active' );
        } elseif ( $action === 'deactivate_post' ) {
            // Perform deactivation logic (update post meta, etc.)
            update_post_meta( $post_id, '_custom_post_status', 'inactive' );
        }
        
        // Redirect back to the post list page
        wp_redirect( admin_url( 'edit.php?post_type=resource' ) );
        exit;
    }
}
add_action( 'admin_post_activate_post', 'custom_post_type_plugin_handle_actions' );
add_action( 'admin_post_deactivate_post', 'custom_post_type_plugin_handle_actions' );


// Enqueue AJAX JavaScript

