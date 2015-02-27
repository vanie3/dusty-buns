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

    $labels_board = array(
        'name' => __( 'Board Items', 'highgrove' ),
        'singular_name' => __( 'Board Item', 'highgrove' ),
        'all_items' => __( 'All Board Items', 'highgrove' ),
        'add_new_item' => __( 'Add New Board Item', 'highgrove' ),
        'edit_item' => __( 'Edit Board Item', 'highgrove' ),
        'new_item' => __( 'New Board Item', 'highgrove' ),
        'view_item' => __( 'View Board Item', 'highgrove' ),
        'search_items' => __( 'Search Board Items', 'highgrove' ),
        'not_found' =>  __( 'No board items found.', 'highgrove' ),
        'not_found_in_trash' => __( 'No board items found in Trash.', 'highgrove' ),
    );

    $args_board = array(
        'labels' => $labels_board,
        'public' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions' ),
        'taxonomies' => array( 'post_tag' ),
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'board-items' ),
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
    register_post_type( 'highgrove_event', $args_board );
    register_post_type( 'highgrove_dish', $args_dish );
    // register_post_type( 'highgrove_career', $args_career );
}
add_action( 'init', 'highgrove_post_types' );