<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('highgrove_Redux_Framework_config')) {

    class highgrove_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'highgrove'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'highgrove'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'highgrove'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'highgrove'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'highgrove'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'highgrove') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'highgrove'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS

            $this->sections[] = array(
                'title'     => __( 'General Options', 'highgrove' ),
                'desc'      => __( 'General settings of the site.', 'highgrove' ),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
                    array(
                        'id'        => 'opt-logo',
                        'type'      => 'media',
                        'title'     => __( 'Logo', 'highgrove' ),
                        'desc'      => __( 'Select a source for the logo.', 'highgrove' ),
                    ),
                    array(
                        'id'        => 'opt-brand-text',
                        'type'      => 'text',
                        'title'     => __( 'Brand Text', 'highgrove' ),
                        'desc'      => __( 'Enter the brand text that will be visible in the header if no logo is selected.', 'highgrove' ),
                        'default'   => 'hg',
                    ),
                    array(
                        'id'        => 'opt-favicon',
                        'type'      => 'media',
                        'title'     => __( 'Favicon', 'highgrove' ),
                        'desc'      => __( 'Select a source for the favicon.', 'highgrove' ),
                        'width'     => '16px',
                        'height'    => '16px',
                    ),
                    array(
                        'id'        => 'opt-custom-css',
                        'type'      => 'ace_editor',
                        'title'     => __( 'Custom CSS', 'highgrove' ),
                        'desc'      => __( 'Add custom styles for your theme.', 'highgrove' ),
                        'mode'      => 'css',
                        'theme'     => 'chrome',
                    ),
                    array(
                        'id'        => 'opt-custom-js',
                        'type'      => 'ace_editor',
                        'title'     => __( 'Custom JS', 'highgrove' ),
                        'desc'      => __( 'Add custom scripts for your theme.', 'highgrove' ),
                        'theme'     => 'chrome',
                    )
                )
            );

            $this->sections[] = array(
                'title'     => __( 'Blog Layout', 'highgrove' ),
                'desc'      => __( 'Customize the blog layout.', 'highgrove' ),
                'icon'      => 'el-icon-bold',
                'fields'    => array(
                    array(
                        'id'        => 'opt-blog-type',
                        'type'      => 'radio',
                        'title'     => __( 'Layout Type', 'highgrove' ),
                        'desc'      => __( 'Choose one of the blog types.', 'highgrove' ),
                        'options'   => array(
                            'classic'   => 'Classic',
                            'masonry'   => 'Masonry',
                        ),
                        'default'   => 'classic',
                    ),
                    array(
                        'id'        => 'opt-blog-container',
                        'type'      => 'radio',
                        'title'     => __( 'Container Type', 'highgrove' ),
                        'desc'      => __( 'Choose one of the container types.', 'highgrove' ),
                        'options'   => array(
                            'fixed'     => 'Fixed-Width',
                            'full'      => 'Full-Width',
                        ),
                        'default'   => 'fixed',
                    ),
                    array(
                        'id'        => 'opt-blog-cols',
                        'type'      => 'radio',
                        'title'     => __( '# Columns', 'highgrove' ),
                        'desc'      => __( 'Specify the number of columns.', 'highgrove' ),
                        'options'   => array(
                            '2'         => '2',
                            '3'         => '3',
                            '4'         => '4',
                            '6'         => '6',
                        ),
                        'default'   => '3',
                    ),
                    array(
                        'id'        => 'opt-blog-sidebar',
                        'type'      => 'switch',
                        'title'     => __( 'Include Sidebar', 'highgrove' ),
                        'desc'      => __( 'Choose whether or not to include sidebar.', 'highgrove' ),
                        'default'   => true,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),
                )
            );

            $this->sections[] = array(
                'title'     => __( 'Menu Layout', 'highgrove' ),
                'desc'      => __( 'Customize the menu layout.', 'highgrove' ),
                'icon'      => 'el-icon-list',
                'fields'    => array(
                    array(
                        'id'        => 'opt-menu-container',
                        'type'      => 'radio',
                        'title'     => __( 'Container Type', 'highgrove' ),
                        'desc'      => __( 'Choose one of the container types.', 'highgrove' ),
                        'options'   => array(
                            'fixed'     => 'Fixed-Width',
                            'full'      => 'Full-Width',
                        ),
                        'default'   => 'fixed',
                    ),
                    array(
                        'id'        => 'opt-menu-compact',
                        'type'      => 'switch',
                        'title'     => __( 'Compact Layout', 'highgrove' ),
                        'desc'      => __( 'Remove the gutter between items.', 'highgrove' ),
                        'default'   => true,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),
                    array(
                        'id'        => 'opt-menu-cols',
                        'type'      => 'radio',
                        'title'     => __( '# Columns', 'highgrove' ),
                        'desc'      => __( 'Specify the number of columns.', 'highgrove' ),
                        'options'   => array(
                            '2'         => '2',
                            '3'         => '3',
                            '4'         => '4',
                            '6'         => '6',
                        ),
                        'default'   => '4',
                    ),
                    array(
                        'id'        => 'opt-menu-filters',
                        'type'      => 'switch',
                        'title'     => __( 'Show Filters', 'highgrove' ),
                        'desc'      => __( 'Choose whether or not to show filters.', 'highgrove' ),
                        'default'   => true,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),
                    array(
                        'id'        => 'opt-menu-filters-tags',
                        'type'      => 'text',
                        'title'     => __( 'Filterable Tags', 'highgrove' ),
                        'desc'      => __( 'Enter the tags you want menu to be filterable by.', 'highgrove' ),
                        'default'   => 'breakfast,lunch,dinner,dessert',
                    ),
                )
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-user',
                'title'     => __('Social Pages', 'highgrove'),
                'desc'      => __('<p class="description">Enter links to social media pages.</p>', 'highgrove'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-facebook',
                        'type'      => 'text',
                        'title'     => __('Facebook', 'highgrove'),
                        'desc'      => __('Enter URL to Facebook profile.', 'highgrove'),
                        'default'   => 'https://www.facebook.com/pages/Lively-Green/275491875956913',
                    ),
                    array(
                        'id'        => 'opt-twitter',
                        'type'      => 'text',
                        'title'     => __('Twitter', 'highgrove'),
                        'desc'      => __('Enter URL to Twitter.', 'highgrove'),
                        'default'   => 'https://twitter.com/livelygreen',
                    ),
                    array(
                        'id'        => 'opt-google-plus',
                        'type'      => 'text',
                        'title'     => __('Google+', 'highgrove'),
                        'desc'      => __('Enter URL to Google+ profile.', 'highgrove'),
                        'default'   => 'https://plus.google.com/+livelygreen',
                    ),
                    array(
                        'id'        => 'opt-instagram',
                        'type'      => 'text',
                        'title'     => __('Instagram', 'highgrove'),
                        'desc'      => __('Enter URL to Instagram.', 'highgrove'),
                        'default'   => '#',
                    ),
                    array(
                        'id'        => 'opt-youtube',
                        'type'      => 'text',
                        'title'     => __('YouTube', 'highgrove'),
                        'desc'      => __('Enter URL to YouTube channel.', 'highgrove'),
                    ),
                    array(
                        'id'        => 'opt-tumblr',
                        'type'      => 'text',
                        'title'     => __('Tumblr', 'highgrove'),
                        'desc'      => __('Enter URL to Tumblr.', 'highgrove')
                    ),
                    array(
                        'id'        => 'opt-pinterest',
                        'type'      => 'text',
                        'title'     => __('Pinterest', 'highgrove'),
                        'desc'      => __('Enter URL to Pinterest profile.', 'highgrove')
                    ),
                    array(
                        'id'        => 'opt-linkedin',
                        'type'      => 'text',
                        'title'     => __('LinkedIn', 'highgrove'),
                        'desc'      => __('Enter URL to LinkedIn profile.', 'highgrove'),
                    ),
                )
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-map-marker',
                'title'     => __('Contact Information', 'highgrove'),
                'desc'      => __('<p class="description">Enter the contact information.</p>', 'highgrove'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-contact-address',
                        'type'      => 'text',
                        'title'     => __( 'Address', 'highgrove' ),
                        'desc'      => __( 'Enter the full address.', 'highgrove' ),
                        'default'   => 'Belgrade, Serbia',
                    ),
                    array(
                        'id'        => 'opt-contact-phone',
                        'type'      => 'text',
                        'title'     => __( 'Phone Number', 'highgrove' ),
                        'desc'      => __( 'Enter the phone number.', 'highgrove' ),
                        'default'   => '+1 222 33 44',
                    ),
                    array(
                        'id'        => 'opt-contact-mobile',
                        'type'      => 'text',
                        'title'     => __( 'Mobile Number', 'highgrove' ),
                        'desc'      => __( 'Enter the mobile number.', 'highgrove' )
                    ),
                    array(
                        'id'        => 'opt-contact-email',
                        'type'      => 'text',
                        'title'     => __( 'Email Address', 'highgrove' ),
                        'desc'      => __( 'Enter the email address.', 'highgrove'),
                        'default'   => 'support@livelygreen.com',
                    ),
                    array(
                        'id'        => 'opt-contact-skype',
                        'type'      => 'text',
                        'title'     => __( 'Skype ID', 'highgrove' ),
                        'desc'      => __( 'Enter the skype username.', 'highgrove' ),
                        'default'   => 'livelygreen',
                    ),
                )
            );

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'highgrove') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'highgrove') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'highgrove') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'highgrove') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'highgrove'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }

            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'title'     => __('Import / Export', 'highgrove'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'highgrove'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'highgrove'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'highgrove'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'highgrove'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'highgrove'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'highgrove')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'highgrove'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'highgrove')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'highgrove');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'highgrove',
                'page_slug' => '_options',
                'page_title' => 'Theme Options',
                'update_notice' => true,
                'menu_type' => 'menu',
                'menu_title' => 'Highgrove',
                'menu_icon' => 'dashicons-art',
                'admin_bar' => false,
                'allow_sub_menu' => true,
                'page_parent_post_type' => 'your_post_type',
                'page_priority' => '81',
                'dev_mode' => false,
                'customizer' => true,
                'default_mark' => '*',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => true,
                'transient_time' => '3600',
                'network_sites' => true,
              );

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args["display_name"] = $theme->get("Name");
            $this->args["display_version"] = $theme->get("Version");

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new highgrove_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('highgrove_my_custom_field')):
    function highgrove_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('highgrove_validate_callback_function')):
    function highgrove_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
