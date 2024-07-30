<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
    return;
}


// This is your option name where all the Redux data is stored.
$opt_name = "sh_option";


/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => __( 'Theme Options', 'shtheme' ),
    'page_title'           => __( 'Theme Options', 'shtheme' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,

    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => false,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => 'dashicons-admin-generic',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    'show_options_object'  => false,

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/web3bvietnam',
    'title' => 'Like us on Facebook',
    'icon'  => 'el el-facebook',
);


Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

// -> START Layout Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'General Settings', 'shtheme' ),
    'id'               => 'general',
    'customizer_width' => '400px',
    'icon'             => 'el el-dashboard'
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Appearance', 'shtheme' ),
    'id'               => 'general-layout',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'       => 'site-layout',
            'type'     => 'button_set',
            'title'    => __('Select layout website', 'shtheme'),
            'default'  => true,
            'options'  => array(
                '1'       => __('Full Width Layout', 'shtheme'),
                '2'       => __('Boxed Layout', 'shtheme'),
             ),
            'default' => '1'
        ),
        array(
        	'id'       => 'opt-layout',
		    'type'     => 'image_select',
		    'title'    => __('Main Appearance', 'shtheme'),
		    'options'  => array(
		        '1'       => array(
		            'alt'     => 'Content Full Width',
		            'img'     => ReduxFramework::$_url.'assets/img/1col.png'
		        ),
		        '2'       => array(
                    'alt'     => 'Sidebar - Content',
		            'img'     => ReduxFramework::$_url.'assets/img/2cl.png'
		        ),
		        '3'       => array(
		            'alt'     => 'Content - Sidebar',
		            'img'     => ReduxFramework::$_url.'assets/img/2cr.png'
		        ),
		        '4'       => array(
		            'alt'     => 'Sidebar - Content - Sidebar',
		            'img'     => ReduxFramework::$_url.'assets/img/3cm.png'
		        ),
		        '5'       => array(
		            'alt'     => 'Sidebar - Sidebar - Content',
		            'img'     => ReduxFramework::$_url.'assets/img/3cl.png'
		        ),
		        '6'       => array(
		            'alt'     => 'Content - Sidebar - Sidebar',
		            'img'     => ReduxFramework::$_url.'assets/img/3cr.png'
		        )
		    ),
		    'default' => '2',
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Logo, Favicon', 'shtheme' ),
    'id'               => 'general-logo-favicon',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'       => 'opt_settings_logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( 'Logo Image', 'shtheme' ),
            'compiler' => 'true',
        ),
        array(
            'id'       => 'opt_settings_favicon',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( 'Favicon Image', 'shtheme' ),
            'compiler' => 'true',
        ),
    )
) );

// -> Header
Redux::setSection( $opt_name, array(
    'title'            => __( 'Header', 'shtheme' ),
    'id'               => 'header',
    'icon'             => 'el el-website',
    'fields'           => array(
        array(
            'id'       => 'opt-layout-header',
            'type'     => 'image_select',
            'title'    => __('Header Layout', 'shtheme'),
            'options'  => array(
                '1'      => array(
                    'alt'   => 'Header 1',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/logo-center.png'
                ),
                '2'      => array(
                    'alt'   => 'Header 2',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/logo-left.gif'
                ),
                '3'      => array(
                    'alt'   => 'Header 3',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/logo-left2.png'
                ),
            ),
            'default' => '1'
        ),
        array(
            'id'       => 'display-pagetitlebar',
            'type'     => 'switch',
            'title'    => __('Enable Page Title Bar', 'shtheme'),
            'default'  => false,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
        array(
            'id'       => 'display-topheader-widget',
            'type'     => 'switch',
            'title'    => __('Enable Top Header Widget', 'shtheme'),
            'default'  => false,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
    )
) );

// -> Footer
Redux::setSection( $opt_name, array(
    'title'            => __( 'Footer', 'shtheme' ),
    'id'               => 'footer',
    'icon'             => 'el el-website',
    'fields'           => array(
        array(
            'id'        => 'opt-number-footer',
            'type'      => 'slider',
            'title'     => __('Enter number column footer', 'shtheme'),
            'default'   => 1,
            'min'       => 1,
            'step'      => 1,
            'max'       => 5,
            'display_value' => 'text'
        ),
        array(
            'id'    => 'footer-copyright',
            'type'  => 'text',
            'title' => __('Copyright', 'shtheme'),
        ),
    )
) );

// -> Slider Settings Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Slider', 'shtheme' ),
    'id'               => 'slider-main',
    'icon'             => 'el el-picture'
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Gallery Slide', 'shtheme' ),
    'id'               => 'slider-gallery',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'        => 'home-slide-switch',
            'type'      => 'switch',
            'title'     => __('Enable gallery slider', 'shtheme'),
            'default'   => false,
            'on'        => __('Enable', 'shtheme'),
            'off'       => __('Disable', 'shtheme'),
        ),
        array(
            'id'         => 'home-slide',
            'type'       => 'slides',
            'title'      => __('Photo list', 'shtheme'),
            'required'   => array('home-slide-switch','equals',true),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            	=> __( 'Advanced Options', 'shtheme' ),
    'id'               	=> 'slider-advanced',
    'subsection'       	=> true,
    'fields'           	=> array(
		array(
            'id'       	=> 'slider-autoplay',
            'type'     	=> 'switch',
            'title'    	=> __('Slider autoplay', 'shtheme'),
            'default'  	=> true,
            'on'       	=> __('Enable', 'shtheme'),
            'off'      	=> __('Disable', 'shtheme'),
        ),
        array(
		    'id' 		=> 'slider-interval',
		    'type' 		=> 'slider',
		    'title' 	=> __('Slider interval', 'shtheme'),
		    'default' 	=> 3000,
		    'min' 		=> 1000,
		    'step' 		=> 500,
		    'max' 		=> 10000,
		    'display_value' => 'text',
		    'required'  => array('slider-autoplay','equals',true),
		),
        array(
            'id'       	=> 'slider-pause',
            'type'     	=> 'switch',
            'title'    	=> __('Slider hover pause', 'shtheme'),
            'default'  	=> false,
            'on'       	=> __('Enable', 'shtheme'),
            'off'      	=> __('Disable', 'shtheme'),
            'required'  => array('slider-autoplay','equals',true),
        ),
        array(
		    'id'       	=> 'slider-animation',
		    'type'     	=> 'button_set',
		    'title'    	=> __('Slider animate', 'shtheme'),
		    'options' 	=> array(
		        '1' => 'Slide',
		        '2' => 'Fade',
		     ),
		    'default' => '1'
		),
    )
) );

// -> Homepage Settings Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Home Page', 'shtheme' ),
    'id'               => 'homepage',
    'icon'             => 'el el-home'
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'News', 'shtheme' ),
    'id'               => 'homepage-news',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'       => 'list_cat_post',
            'type'     => 'select',
            'multi'    => true,
            'title'    => __( 'Select categories', 'shtheme' ),
            'data' 	   => 'terms',
			'args' 	   => array(
			    'taxonomies' => array( 'category' ),
			    'hide_empty' => false,
			),
        ),
        array(
		    'id' 		=> 'number_news',
		    'type' 		=> 'slider',
		    'title' 	=> __('Enter number post', 'shtheme'),
		    'default' 	=> 3,
		    'min' 		=> 0,
		    'step' 		=> 1,
		    'max' 		=> 50,
		    'display_value' => 'text'
		),
		array(
            'id'            => 'type_layout',
            'type'          => 'image_select',
            'title'         => __('Blog Layout', 'shtheme'),
            'permissions'   => 'administrator',
            'options'  => array(
                '1'      => array(
                    'alt'   => 'Blog Layout 1',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/bloglayout1.png'
                ),
                '2'      => array(
                    'alt'   => 'Blog Layout 2',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/bloglayout2.png'
                ),
                '3'      => array(
                    'alt'   => 'Blog Layout 3',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/bloglayout3.png'
                ),
                '4'      => array(
                    'alt'   => 'Blog Layout 4',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/bloglayout4.png'
                ),
                '5'      => array(
                    'alt'   => 'Blog Layout 5',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/bloglayout5.png'
                ),
                '6'      => array(
                    'alt'   => 'Blog Layout 6',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/bloglayout6.png'
                ),
                '7'      => array(
                    'alt'   => 'Blog Layout 7',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/bloglayout7.png'
                ),
                '8'      => array(
                    'alt'   => 'Blog Layout 8',
                    'img'   => get_stylesheet_directory_uri().'/lib/images/theme-option/bloglayout8.png'
                ),
            ),
            'default' => '1'
        ),
    )
) );

if ( class_exists( 'WooCommerce' ) ) {
	Redux::setSection( $opt_name, array(
        'title'            => __( 'Product', 'shtheme' ),
        'id'               => 'homepage-product',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'list_cat_product',
                'type'     => 'select',
                'multi'    => true,
                'title'    => __( 'Select categories', 'shtheme' ),
                'data' => 'terms',
				'args' => array(
				    'taxonomies' => array( 'product_cat' ),
				    'hide_empty' => false,
				),
            ),
            array(
			    'id' 		=> 'number_product',
			    'type' 		=> 'slider',
			    'title' 	=> __('Enter number product', 'shtheme'),
			    'default' 	=> 3,
			    'min' 		=> 0,
			    'step' 		=> 1,
			    'max' 		=> 50,
			    'display_value' => 'text'
			),
			array(
			    'id' 		=> 'number_product_row',
			    'type' 		=> 'slider',
			    'title' 	=> __('Enter number product per row', 'shtheme'),
			    'default' 	=> 3,
			    'min' 		=> 1,
			    'step' 		=> 1,
			    'max' 		=> 6,
			    'display_value' => 'text'
			),
        )
    ) );

}

// -> Blog Post
Redux::setSection( $opt_name, array(
    'title'            => __( 'Post', 'shtheme' ),
    'id'               => 'blogpost',
    'icon'             => 'el el-pencil',
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Single post', 'shtheme' ),
    'id'               => 'blogpost-single',
    'subsection'       => true,
    'fields'           => array(
        array(
           'id'         => 'section-singlepost-start',
           'type'       => 'section',
           'title'      => __('Setting General', 'shtheme'),
           'indent'     => true
        ),
        array(
            'id'       => 'display-time-view',
            'type'     => 'switch',
            'title'    => __('Display time and view post', 'shtheme'),
            'default'  => true,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
        array(
            'id'       => 'display-sharepost',
            'type'     => 'switch',
            'title'    => __('Display buttons share social', 'shtheme'),
            'default'  => true,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
        array(
            'id'       => 'display-navipost',
            'type'     => 'switch',
            'title'    => __('Display post navigation', 'shtheme'),
            'default'  => true,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
        array(
           'id'         => 'section-relatedpost',
           'type'       => 'section',
           'title'      => __('Related Post', 'shtheme'),
           'indent'     => true
        ),
        array(
            'id'       => 'display-relatedpost',
            'type'     => 'switch',
            'title'    => __('Display related post', 'shtheme'),
            'default'  => true,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
        array(
            'id'        => 'relatedpost-number-post',
            'type'      => 'slider',
            'title'     => __('Enter number post', 'shtheme'),
            'default'   => 6,
            'min'       => 1,
            'step'      => 1,
            'max'       => 10,
            'display_value' => 'text',
            'required'  => array('display-relatedpost','equals',true),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Category post', 'shtheme' ),
    'id'               => 'blogpost-archive',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'       => 'display-hierarchy',
            'type'     => 'switch',
            'title'    => __('Display hierarchy category', 'shtheme'),
            'default'  => false,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
    )
) );


// -> WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
    Redux::setSection( $opt_name, array(
        'title'            => __( 'WooCommerce', 'shtheme' ),
        'id'               => 'woocommerce',
        'icon'             => 'el el-shopping-cart',
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Main Settings', 'shtheme' ),
        'id'               => 'woocommerce-settings',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'display-shopsidebar',
                'type'     => 'switch',
                'title'    => __('Enable Shop Sidebar', 'shtheme'),
                'default'  => false,
                'on'       => __('Enable', 'shtheme'),
                'off'      => __('Disable', 'shtheme'),
            ),
            array(
                'id'       => 'woo-hover-flip-image',
                'type'     => 'switch',
                'title'    => __('Enable Hover Flip Image Of Product', 'shtheme'),
                'default'  => true,
                'on'       => __('Enable', 'shtheme'),
                'off'      => __('Disable', 'shtheme'),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Category Product', 'shtheme' ),
        'id'               => 'woocommerce-cate',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'        => 'number-products-cate',
                'type'      => 'slider',
                'title'     => __('Enter number product per page', 'shtheme'),
                'default'   => 9,
                'min'       => 1,
                'step'      => 1,
                'max'       => 30,
                'display_value' => 'text',
            ),
            array(
                'id'        => 'number-column-product-cate',
                'type'      => 'slider',
                'title'     => __('Enter number product per row', 'shtheme'),
                'default'   => 3,
                'min'       => 1,
                'step'      => 1,
                'max'       => 6,
                'display_value' => 'text',
            ),
            array(
                'id'       => 'display-hierarchy-woocommerce',
                'type'     => 'switch',
                'title'    => __('Display hierarchy category', 'shtheme'),
                'default'  => false,
                'on'       => __('Enable', 'shtheme'),
                'off'      => __('Disable', 'shtheme'),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'             => __( 'Single Product', 'shtheme' ),
        'id'                => 'woocommerce-singlepage',
        'subsection'        => true,
        'fields'            => array(
            array(
               'id'         => 'section-singlepage-start',
               'type'       => 'section',
               'title'      => __('Setting General', 'shtheme'),
               'indent'     => true
            ),
            array(
                'id'        => 'display-propertypro',
                'type'      => 'switch',
                'title'     => __('Display attributes product', 'shtheme'),
                'default'   => false,
                'on'        => __('Enable', 'shtheme'),
                'off'       => __('Disable', 'shtheme'),
            ),
            array(
                'id'        => 'section-singlepage-end',
                'type'      => 'section',
                'indent'    => false,
            ),

            /*==========================================*/
            array(
               'id'         => 'section-gallery-start',
               'type'       => 'section',
               'title'      => __('Gallery Product', 'shtheme'),
               'indent'     => true
            ),
            array(
                'id'        => 'gallery-single-custom',
                'type'      => 'switch',
                'title'     => __('Enable customizer gallery product', 'shtheme'),
                'default'   => false,
                'on'        => __('Enable', 'shtheme'),
                'off'       => __('Disable', 'shtheme'),
            ),
            array(
                'id'       => 'gallery-single-style',
                'type'     => 'button_set',
                'title'    => __('Choose style of slider gallery product', 'shtheme'),
                'default'  => true,
                'options'  => array(
                    '1'       => __('Horizontal', 'shtheme'),
                    '2'       => __('Vertical', 'shtheme'),
                 ),
                'default' => '1',
                'required'  => array('gallery-single-custom','equals',true),
            ),
            array(
                'id'        => 'gallery-single-number-thumbnails',
                'type'      => 'slider',
                'title'     => __('Enter the number of product images in the view', 'shtheme'),
                'default'   => 4,
                'min'       => 1,
                'step'      => 1,
                'max'       => 6,
                'display_value' => 'text',
                'required'  => array('gallery-single-custom','equals',true),
            ),
            array(
                'id'        => 'gallery-single-zoom',
                'type'      => 'switch',
                'title'     => __('Enable Zoom', 'shtheme'),
                'default'   => false,
                'on'        => __('Enable', 'shtheme'),
                'off'       => __('Disable', 'shtheme'),
                'required'  => array('gallery-single-custom','equals',true),
            ),
            array(
                'id'        => 'gallery-single-lightbox',
                'type'      => 'switch',
                'title'     => __('Enable Lightbox', 'shtheme'),
                'default'   => false,
                'on'        => __('Enable', 'shtheme'),
                'off'       => __('Disable', 'shtheme'),
                'required'  => array('gallery-single-custom','equals',true),
            ),
            array(
                'id'        => 'gallery-single-autoplay',
                'type'      => 'switch',
                'title'     => __('Enable autoplay for gallery', 'shtheme'),
                'default'   => false,
                'on'        => __('Enable', 'shtheme'),
                'off'       => __('Disable', 'shtheme'),
                'required'  => array('gallery-single-custom','equals',true),
            ),
            array(
                'id'        => 'section-gallery-end',
                'type'      => 'section',
                'indent'    => false,
            ),
            /*==========================================*/
            array(
               'id'         => 'section-relatedpro-start',
               'type'       => 'section',
               'title'      => __('Related Product', 'shtheme'),
               'indent'     => true
            ),
            array(
                'id'        => 'display-relatedpro',
                'type'      => 'switch',
                'title'     => __('Display related products', 'shtheme'),
                'default'   => true,
                'on'        => __('Enable', 'shtheme'),
                'off'       => __('Disable', 'shtheme'),
            ),
            array(
                'id'        => 'number-product-related',
                'type'      => 'slider',
                'title'     => __('Enter number related product', 'shtheme'),
                'default'   => 3,
                'min'       => 1,
                'step'      => 1,
                'max'       => 6,
                'display_value' => 'text',
                'required'  => array('display-relatedpro','equals',true),
            ),
            array(
                'id'        => 'number-column-product-related',
                'type'      => 'slider',
                'title'     => __('Enter number product per row', 'shtheme'),
                'default'   => 3,
                'min'       => 1,
                'step'      => 1,
                'max'       => 6,
                'display_value' => 'text',
                'required'  => array('display-relatedpro','equals',true),
            ),
            array(
                'id'        => 'section-relatedpro-end',
                'type'      => 'section',
                'indent'    => false,
            ),
        )
    ) );

}

// -> Social
Redux::setSection( $opt_name, array(
    'title'            => __( 'Social', 'shtheme' ),
    'id'               => 'social',
    'icon'             => 'el el-bookmark',
    'fields'           => array(
        array(
            'id'    =>'social-facebook',
            'type'  => 'text',
            'title' => __('Facebook', 'shtheme'),
        ),
        array(
            'id'    =>'social-twitter',
            'type'  => 'text',
            'title' => __('Twitter', 'shtheme'),
        ),
        array(
            'id'    =>'social-google',
            'type'  => 'text',
            'title' => __('Google +', 'shtheme'),
        ),
        array(
            'id'    =>'social-youtube',
            'type'  => 'text',
            'title' => __('Youtube', 'shtheme'),
        ),
        array(
            'id'    =>'social-linkedin',
            'type'  => 'text',
            'title' => __('Linkedin', 'shtheme'),
        ),
        array(
            'id'    =>'social-pinterest',
            'type'  => 'text',
            'title' => __('Pinterest', 'shtheme'),
        ),
        array(
            'id'    =>'social-instagram',
            'type'  => 'text',
            'title' => __('Instagram', 'shtheme'),
        ),
    )
) );

// -> Information
Redux::setSection( $opt_name, array(
    'title'            => __( 'Information', 'shtheme' ),
    'id'               => 'information',
    'icon'             => 'el el-info-circle',
    'fields'           => array(
        array(
            'id'        =>'information-phone',
            'type'      => 'text',
            'title'     => __('Telephone number', 'shtheme'),
        ),
        array(
            'id'        =>'information-email',
            'type'      => 'text',
            'title'     => __('Email', 'shtheme'),
        ),
        array(
            'id'        =>'information-address',
            'type'      => 'text',
            'title'     => __('Address', 'shtheme'),
        ),
        array(
            'id'        =>'information-map',
            'type'      => 'textarea',
            'title'     => __('Google Maps', 'shtheme'),
        ),
    )
) );

// -> Insert Code Settings Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Insert code', 'shtheme' ),
    'id'               => 'insertcode',
    'icon'             => 'el el-plus-sign',
    'fields'           => array(
        array(
            'id'        =>'opt-textarea-header',
            'type'      => 'textarea',
            'title'     => __('Insert code to header', 'shtheme'),
        ),
        array(
            'id'        =>'opt-textarea-footer',
            'type'      => 'textarea',
            'title'     => __('Insert code to footer', 'shtheme'),
        ),
    )
) );

// -> 3B Developer
Redux::setSection( $opt_name, array(
    'title'            => __( '3B Developer', 'shtheme' ),
    'id'               => 'function',
    'icon'             => 'el el-adjust-alt',
    'permissions'      => 'administrator',
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'User Functions', 'shtheme' ),
    'id'               => 'user-func',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'       => 'btn-restrict-user',
            'type'     => 'switch',
            'title'    => __('Restrict user', 'shtheme'),
            'desc'     => __('Restrict user in admin page', 'shtheme'),
            'default'  => true,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
        array(
            'id'       => 'btn-hidden-info',
            'type'     => 'switch',
            'title'    => __('Hidden information', 'shtheme'),
            'desc'     => __('Hidden information dashboard & login page', 'shtheme'),
            'default'  => false,
            'on'       => __('Enable', 'shtheme'),
            'off'      => __('Disable', 'shtheme'),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Website Functions', 'shtheme' ),
    'id'               => 'website-func',
    'subsection'       => true,
    'fields'           => array(
        array(
           'id'         => 'section-website-func-start',
           'type'       => 'section',
           'title'      => __('Plugin Chat', 'shtheme'),
           'indent'     => true,
        ),
        array(
            'id'        => 'phonering-number',
            'type'      => 'text',
            'title'     => __('Enter telephone number', 'shtheme'),
            'default'   => 10,
            'min'       => 1,
            'step'      => 1,
            'max'       => 30,
            'display_value' => 'text',
        ),
        array(
            'id'        => 'phonering-style',
            'type'      => 'button_set',
            'title'     => __('Phone Ring Style', 'shtheme'),
            'options'   => array(
                '1' => 'Style 1',
                '2' => 'Style 2',
             ),
            'default' => '2'
        ),
        array(
            'id'       => 'phonering-color',
            'type'     => 'color',
            'title'    => __('Phone Ring Color', 'shtheme'),
            'default'  => '#ea2700',
            'validate' => 'color',
        ),
        array(
            'id'        => 'zalo-number',
            'type'      => 'text',
            'title'     => __('Enter zalo number', 'shtheme'),
            'min'       => 1,
            'step'      => 1,
            'max'       => 30,
            'display_value' => 'text',
        ),
        array(
            'id'        => 'section-website-func-end',
            'type'      => 'section',
            'indent'    => false,
        ),
    )
) );

if ( class_exists( 'MetaSliderPlugin' ) ) {
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Metaslider', 'shtheme' ),
        'id'               => 'function-metaslider',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'metaslider',
                'type'     => 'select',
                // 'multi'    => true,
                'title'    => __( 'Select slider', 'shtheme' ),
                'data'     => 'posts',
                'args'     => array(
                    'post_type'     => 'ml-slider',
                    'orderby'       => 'date',
                    'order'         => 'DESC',
                ),
            ),
        )
    ) );
}

if ( class_exists( 'WooCommerce' ) ) {
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Woocommerce', 'shtheme' ),
        'id'               => 'function-woocommerce',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'woocommerce-tooltip',
                'type'     => 'switch',
                'title'    => __('Tooltip', 'shtheme'),
                'default'  => false,
                'on'       => __('Enable', 'shtheme'),
                'off'      => __('Disable', 'shtheme'),
            ),
            array(
                'id'       => 'woocommerce-disable-cart',
                'type'     => 'switch',
                'title'    => __('Cart', 'shtheme'),
                'default'  => false,
                'on'       => __('Enable', 'shtheme'),
                'off'      => __('Disable', 'shtheme'),
            ),
        )
    ) );
}

/*
 * <--- END SECTIONS
 */


/*
 *
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
 *
 */

/*
*
* --> Action hook examples
*
*/

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'remove_demo' );

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
// add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

// Change the arguments after they've been declared, but before the panel is created
// add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

// Change the default value of a field after it's been set, but before it's been useds
// add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

// Dynamically add a section. Can be also used to modify sections/fields
// add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
if ( ! function_exists( 'compiler_action' ) ) {
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }
}

/**
 * Custom function for the callback validation referenced above
 * */
if ( ! function_exists( 'redux_validate_callback_function' ) ) {
    function redux_validate_callback_function( $field, $value, $existing_value ) {
        $error   = false;
        $warning = false;

        //do your validation
        if ( $value == 1 ) {
            $error = true;
            $value = $existing_value;
        } elseif ( $value == 2 ) {
            $warning = true;
            $value   = $existing_value;
        }

        $return['value'] = $value;

        if ( $error == true ) {
            $field['msg']    = 'your custom error message';
            $return['error'] = $field;
        }

        if ( $warning == true ) {
            $field['msg']      = 'your custom warning message';
            $return['warning'] = $field;
        }

        return $return;
    }
}

/**
 * Custom function for the callback referenced above
 */
if ( ! function_exists( 'redux_my_custom_field' ) ) {
    function redux_my_custom_field( $field, $value ) {
        print_r( $field );
        echo '<br/>';
        print_r( $value );
    }
}

/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 * */
if ( ! function_exists( 'dynamic_section' ) ) {
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'shtheme' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'shtheme' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }
}

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if ( ! function_exists( 'change_arguments' ) ) {
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }
}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
if ( ! function_exists( 'change_defaults' ) ) {
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }
}

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}

