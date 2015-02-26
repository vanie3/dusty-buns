<?php

/*
 * Register custom post types.
 */
function highgrove_post_types() {

    $labels_section = array(
        'name' => __( 'Sections', 'highgrove' ),
        'singular_name' => __( 'Section', 'highgrove' ),
        'all_items' => __( 'All Sections', 'highgrove' ),
        'add_new_item' => __( 'Add New Section', 'highgrove' ),
        'edit_item' => __( 'Edit Section', 'highgrove' ),
        'new_item' => __( 'New Section', 'highgrove' ),
        'view_item' => __( 'View Section', 'highgrove' ),
        'search_items' => __( 'Search Sections', 'highgrove' ),
        'not_found' =>  __( 'No sections found.', 'highgrove' ),
        'not_found_in_trash' => __( 'No sections found in Trash.', 'highgrove' ),
    );

    $args_section = array(
        'labels' => $labels_section,
        'public' => true,
        'exclude_from_search' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-screenoptions',
        'capability_type' => 'page',
        'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'revisions', 'page-attributes' ),
        'rewrite' => array( 'slug' => 'sections' ),
    );

    $labels_event = array(
        'name' => __( 'Events', 'highgrove' ),
        'singular_name' => __( 'Event', 'highgrove' ),
        'all_items' => __( 'All Events', 'highgrove' ),
        'add_new_item' => __( 'Add New Event', 'highgrove' ),
        'edit_item' => __( 'Edit Event', 'highgrove' ),
        'new_item' => __( 'New Event', 'highgrove' ),
        'view_item' => __( 'View Event', 'highgrove' ),
        'search_items' => __( 'Search Events', 'highgrove' ),
        'not_found' =>  __( 'No events found.', 'highgrove' ),
        'not_found_in_trash' => __( 'No events found in Trash.', 'highgrove' ),
    );

    $args_event = array(
        'labels' => $labels_event,
        'public' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions' ),
        'taxonomies' => array( 'post_tag' ),
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'events' ),
    );

    $labels_dish = array(
        'name' => __( 'Dishes', 'highgrove' ),
        'singular_name' => __( 'Dish', 'highgrove' ),
        'all_items' => __( 'All Dishes', 'highgrove' ),
        'add_new_item' => __( 'Add New Dish', 'highgrove' ),
        'edit_item' => __( 'Edit Dish', 'highgrove' ),
        'new_item' => __( 'New Dish', 'highgrove' ),
        'view_item' => __( 'View Dish', 'highgrove' ),
        'search_items' => __( 'Search Dishes', 'highgrove' ),
        'not_found' =>  __( 'No dishes found.', 'highgrove' ),
        'not_found_in_trash' => __( 'No dishes found in Trash.', 'highgrove' ),
    );

    $args_dish = array(
        'labels' => $labels_dish,
        'public' => true,
        'exclude_from_search' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-carrot',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions'),
        'taxonomies' => array( 'highgrove_dish_category', 'post_tag' ),
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'menu' ),
    );



    register_post_type( 'highgrove_section', $args_section );
    register_post_type( 'highgrove_event', $args_event );
    register_post_type( 'highgrove_dish', $args_dish );
    // register_post_type( 'highgrove_career', $args_career );
}
add_action( 'init', 'highgrove_post_types' );