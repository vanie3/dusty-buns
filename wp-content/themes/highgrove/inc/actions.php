<?php

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function highgrove_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Content Sidebar', 'highgrove' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Content sidebar that appears on the right.', 'highgrove' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Sidebar', 'highgrove' ),
        'id'            => 'sidebar-3',
        'description'   => __( 'Appears in the footer section of the site.', 'highgrove' ),
        'before_widget' => '<div class="item"><aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside></div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4><hr>',
    ) );
}
add_action( 'widgets_init', 'highgrove_widgets_init' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Highgrove 1.0
 */
function highgrove_enqueue_scripts() {

    global $highgrove;

    $protocol = ( is_ssl() ) ? 'https' : 'http';

    // Load Google Fonts
    wp_enqueue_style( 'google-roboto', $protocol . '://fonts.googleapis.com/css?family=Roboto:400,300,700' );
    wp_enqueue_style( 'google-roboto-slab', $protocol . '://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700' );
    wp_enqueue_style( 'google-droid-serif', $protocol . '://fonts.googleapis.com/css?family=Droid+Serif:400italic' );

    // Load Bootstrap stylesheet.
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    //wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
    if ( is_rtl() ) {
        wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/css/bootstrap-rtl.css' );
    }

    // Add Font Awesome icons, used in the main stylesheet.
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.2.0' );

    // Add Animate.css stylesheet.
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css' );

    // Load the main stylesheet.
    wp_enqueue_style( 'highgrove', get_stylesheet_uri() );

    // Load the inline stylesheet.
    if ( ! empty( $highgrove['opt-custom-css'] ) ) {
        wp_add_inline_style( 'highgrove', $highgrove['opt-custom-css'] );
    }

    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), '2.8.3' );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.1', true );
    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '3.1.8', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'imagesloaded' ), '2.1.0', true );
    wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/mousewheel.min.js', array( 'jquery' ), '3.1.12', true );
    wp_enqueue_script( 'sscs', get_template_directory_uri() . '/js/sscs.js', array( 'jquery', 'mousewheel' ), '1.2.1', true );
    wp_enqueue_script( 'appear', get_template_directory_uri() . '/js/appear.js', array( 'jquery' ), '0.3.3', true );

    wp_register_script( 'highgrove-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0.0', true );
    wp_localize_script( 'highgrove-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'highgrove-script' );

    wp_enqueue_script( 'highgrove-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
    wp_enqueue_script( 'highgrove-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'highgrove_enqueue_scripts' );

function highgrove_wp_footer() {

    global $highgrove;

    echo ( ! empty( $highgrove['opt-custom-js'] ) ? '<script type="text/javascript">' . $highgrove['opt-custom-js'] . '</script>' : '' );
}
add_action( 'wp_footer', 'highgrove_wp_footer' );