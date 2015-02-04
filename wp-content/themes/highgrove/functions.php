<?php
/**
 * Highgrove functions and definitions
 *
 * @package WordPress
 * @subpackage Highgrove
 */

/**
 * Add Redux Framework & extras
 */
require get_template_directory() . '/admin/admin-init.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'highgrove_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function highgrove_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Highgrove, use a find and replace
	 * to change 'highgrove' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'highgrove', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails', array( 'post', 'highgrove_event', 'highgrove_dish' ) );

    // Set up the default post thumbnail size.
    set_post_thumbnail_size( 360, 240, true );

    // Add custom post thumbnail sizes.
    add_image_size( 'highgrove-small', 128, 128 );
    add_image_size( 'highgrove-medium', 640, 9999 );
    add_image_size( 'highgrove-large', 1280, 9999 );
    add_image_size( 'highgrove-event', 360, 320, true );
    add_image_size( 'highgrove-event-tall', 360, 640, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'highgrove' ),
        'side'      => __( 'Side Menu', 'highgrove' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	//add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'link', 'aside' ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'highgrove_custom_background_args', array(
		'default-color' => '',
		'default-image' => '',
	) ) );

    // Enable support for excerpts on pages.
    add_post_type_support( 'page', 'excerpt' );
}
endif; // highgrove_setup
add_action( 'after_setup_theme', 'highgrove_setup' );

/**
 * Add actions
 */
require get_template_directory() . '/inc/actions.php';

/**
 * Add filters
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Custom post types for the theme.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Custom taxonomies for the theme.
 */
require get_template_directory() . '/inc/taxonomies.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Register custom field groups.
 */
require get_template_directory() . '/inc/field-groups.php';

function highgrove_menu_fallback_cb() {
    echo '<p class="navbar-text">Assign a menu to the primary menu location.</p>';
}

class BootstrapWalkerNavMenu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output	.= "\n$indent<ul class=\"sub-menu dropdown-menu depth_$depth\">\n";
    }

}