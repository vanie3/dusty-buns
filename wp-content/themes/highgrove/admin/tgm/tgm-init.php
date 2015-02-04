<?php

/**
 * TGM Init Class
 */
include_once ('class-tgm-plugin-activation.php');

function starter_plugin_register_required_plugins() {

	$plugins = array(
        array(
            'name'                  => 'Advanced Custom Fields',
            'slug'                  => 'advanced-custom-fields',
            'source'                => 'advanced-custom-fields.zip',
            'required'              => true,
            'version'               => '',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
        array(
            'name'                  => 'Contact Form 7',
            'slug'                  => 'contact-form-7',
            'source'                => 'contact-form-7.zip',
            'required'              => true,
            'version'               => '',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
        array(
            'name'                  => 'Slider Revolution',
            'slug'                  => 'revslider',
            'source'                => 'revslider.zip',
            'required'              => true,
            'version'               => '',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
        array(
            'name' 		            => 'Redux Framework',
            'slug' 		            => 'redux-framework',
        ),
	);

	$config = array(
		'domain'       		=> 'highgrove',              	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> get_stylesheet_directory() . '/admin/tgm/plugins/',
		'parent_menu_slug' 	=> 'plugins.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'plugins.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'starter_plugin_register_required_plugins' );