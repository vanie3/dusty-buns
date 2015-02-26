<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WordPress
 * @subpackage Highgrove
 */
?><?php global $highgrove; ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, user-scalable=0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php if ( ! empty( $highgrove['opt-favicon']['url'] ) ) { echo esc_url( $highgrove['opt-favicon']['url'] ); } else { echo esc_url( get_template_directory_uri() . '/favicon.ico' ); } ?>">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<a class="skip-link sr-only" href="#content"><?php _e( 'Skip to content', 'highgrove' ); ?></a>

	<header id="masthead" class="site-header<?php echo ( is_front_page() && ! is_home() ? ' ghost' : '' ); ?>" role="banner">
        <nav id="site-navigation" class="navbar navbar-<?php echo ( is_front_page() && ! is_home() ? 'inverse' : 'default' ); ?> navbar-fixed-top affix-top" role="navigation"<?php if ( is_front_page() && ! is_home() ) : ?> data-affix-rel="#intro"<?php endif; ?>>
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php if ( ! empty( $highgrove['opt-logo'] ) && $highgrove['opt-logo']['url'] ) { ?>
                            <img src="<?php echo esc_url( $highgrove['opt-logo']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>"><?php } elseif ( ! empty( $highgrove['opt-brand-text'] ) ) { echo $highgrove['opt-brand-text']; } else { bloginfo( 'name' ); } ?>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
<!-- Modified to show certain navigations for certain pages -->
                <?php if (is_front_page()): ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav ' . ( is_rtl() ? 'navbar-right' : 'navbar-left' ) . ' nav-primary', 'fallback_cb' => 'highgrove_menu_fallback_cb', 'walker' => new BootstrapWalkerNavMenu() ) ); ?>
                <?php else: ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'pages', 'container' => false, 'menu_class' => 'nav navbar-nav ' . ( is_rtl() ? 'navbar-right' : 'navbar-left' ) . ' nav-primary', 'fallback_cb' => 'highgrove_menu_fallback_cb', 'walker' => new BootstrapWalkerNavMenu() ) ); ?>

                <?php endif; ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'side', 'container' => false, 'menu_class' => 'nav navbar-nav ' . ( is_rtl() ? 'navbar-left' : 'navbar-right' ) . ' nav-side', 'fallback_cb' => false ) ); ?>
<!--=====================================-->
                </div>
            </div>
        </nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
