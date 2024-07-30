<?php
/**
 * SH Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SH_Theme
 */

if ( ! function_exists( 'shtheme_setup' ) ) :
	function shtheme_setup() {
		
		load_theme_textdomain( 'shtheme', get_template_directory() . '/languages' );

		// Load Theme Options
		require get_template_directory() . '/inc/options.php';

		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			Redux::init('sh_option');
		}

		// Add theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'shtheme' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption',) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shtheme_custom_background_args', array('default-color' => 'ffffff','default-image' => '',) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'shtheme_setup' );

function sh_constants() {
	define( 'PARENT_DIR', get_template_directory() );
	define( 'SH_DIR',  get_template_directory_uri() );
	define( 'SH_FUNCTIONS_DIR', PARENT_DIR . '/inc/functions' );
}
add_action( 'init', 'sh_constants' );

function sh_load_framework() {
	// Load Functions.
	require_once( PARENT_DIR . '/inc/options-function.php' );
	require_once( SH_FUNCTIONS_DIR . '/init.php' );
	require_once( SH_FUNCTIONS_DIR . '/sidebar.php' );
	require_once( SH_FUNCTIONS_DIR . '/formatting.php' );
	require_once( SH_FUNCTIONS_DIR . '/breadcrumbs.php' );
	require_once( SH_FUNCTIONS_DIR . '/dashboard.php' );
	require_once( SH_FUNCTIONS_DIR . '/mobilemenu.php' );
}
add_action( 'init','sh_load_framework' );

/**
 * Register Widget Area
 */
function shtheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'shtheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'shtheme' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shtheme_widgets_init' );

/**
 * Add Widget Top Header
 */
function sh_register_top_header_widget_areas() {

	global $sh_option;
	if( $sh_option['display-topheader-widget'] == '1' ) {
		register_sidebar( array(
			'name'          => __( 'Top Header', 'shtheme' ),
			'id'            => 'top-header',
			'description'   => __( 'Top Header widget area', 'shtheme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}

}
add_action( 'widgets_init','sh_register_top_header_widget_areas', 1 );

/**
 * Add Widget Footer
 */
function sh_register_footer_widget_areas() {

	global $sh_option;
	$footer_widgets = $sh_option['opt-number-footer'];
	$footer_widgets_number = intval($footer_widgets);
	$counter = 1;
	while ( $counter <= $footer_widgets_number ) {

		register_sidebar( array(
			'name'          => sprintf( __( 'Footer %d', 'shtheme' ), $counter ),
			'id'            => sprintf( 'footer-%d', $counter ),
			'description'   => sprintf( __( 'Footer %d widget area', 'shtheme' ), $counter ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		$counter++;
	}

}
add_action( 'widgets_init','sh_register_footer_widget_areas' );

/**
 * Load File
 */
// Load Plugin Activation File.
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

// Load Custom Post Type
// require get_template_directory() . '/inc/cpt/cpt-abstract.php';
// require get_template_directory() . '/inc/cpt/khach-hang.php';
// require get_template_directory() . '/inc/cpt/cpt.php';
	
// Load Custom Taxonomy
// require get_template_directory() . '/inc/taxonomies/custom-taxonomy-abstract.php';
// require get_template_directory() . '/inc/taxonomies/khach-hang-cat.php';
// require get_template_directory() . '/inc/taxonomies/custom-taxonomy.php';

// Load Shortcode
require get_template_directory() . '/inc/shortcode/shortcode-blog.php';
if ( class_exists( 'Vc_Manager' ) ) {
	require get_template_directory() . '/inc/vc_shortcode/wtb-shortcodes.php';
}
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/shortcode/shortcode-product.php';
}

// Load Function Woocomerce
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/function-woo.php';
}

// Load Widget
require get_template_directory() . '/inc/widgets/wg-post-list.php';
require get_template_directory() . '/inc/widgets/wg-support.php';
require get_template_directory() . '/inc/widgets/wg-fblikebox.php';
require get_template_directory() . '/inc/widgets/wg-page.php';
require get_template_directory() . '/inc/widgets/wg-view-post-list.php';
require get_template_directory() . '/inc/widgets/wg-information.php';
require get_template_directory() . '/inc/widgets/wg-social.php';
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/widgets/wg-product-slider.php';
}

function shtheme_lib_scripts(){

	// Bootstrap
	wp_enqueue_script( 'popper-js', SH_DIR . '/lib/js/popper.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'bootstrap-js', SH_DIR . '/lib/js/bootstrap.min.js', array('jquery'), '4.3.1', true );
	wp_enqueue_style( 'bootstrap-style', SH_DIR .'/lib/css/bootstrap.min.css' );

	// Main js
	wp_enqueue_script( 'main-js', SH_DIR . '/lib/js/main.js', array('jquery'), '1.0', true );
	wp_localize_script(	'main-js', 'ajax', array( 'url' => admin_url('admin-ajax.php') ) );

	// Slick Slider
	wp_enqueue_script( 'slick-js', SH_DIR . '/lib/js/slick.min.js', array('jquery'), '1.8.1', true );
	wp_enqueue_style( 'slick-style', SH_DIR .'/lib/css/slick/slick.css' );
	wp_enqueue_style( 'slick-theme-style', SH_DIR .'/lib/css/slick/slick-theme.css' );

	// Font Awesome
	wp_enqueue_style( 'fontawesome-style', SH_DIR .'/lib/css/font-awesome-all.css' );

	// Fancybox
	wp_register_script( 'fancybox-js', SH_DIR .'/lib/js/gallery-product/jquery.fancybox.min.js',array('jquery'),'3.5.7', true);
	wp_register_style( 'fancybox-css', SH_DIR .'/lib/css/gallery-product/fancybox.min.css' );

	wp_register_script( 'validate-js', SH_DIR .'/lib/js/jquery.validate.min.js',array('jquery'),'1.19.0', true);

	// Ring Phone
	wp_register_style( 'phonering-style', SH_DIR .'/lib/css/phone-ring.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'shtheme_lib_scripts' , 1 );

/**
 * Optimize
 */
function remove_head_scripts() { 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1);
   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
   add_action('wp_footer', 'wp_print_head_scripts', 5);
} 
// add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

/**
 * Add Thumb Size
**/
add_image_size( 'sh_thumb300x200', 300, 200, array( 'center', 'center' ) );


add_filter('use_block_editor_for_post', '__return_false');

add_filter('single_template', 'check_for_category_single_template');
function check_for_category_single_template( $t )
{
foreach( (array) get_the_category() as $cat )
{
if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-{$cat->slug}.php";
if($cat->parent)
{
$cat = get_the_category_by_ID( $cat->parent );
if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-{$cat->slug}.php";
}
}
return $t;
}
// Tạo custom post tài nguyên
// function tao_custom_post_type(){
//    /*
//      * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
//    */
//     $label = array(
//         'name' => 'Tài nguyên Ebook', //Tên post type dạng số nhiều
//         'singular_name' => 'Bài viết tài nguyên' //Tên post type dạng số ít
//     );
 
//     /*
//      * Biến $args là những tham số quan trọng trong Post Type
//      */
//     $args = array(
//         'labels' => $label, //Gọi các label trong biến $label ở trên
//         'description' => 'Post type đăng bài viết tài nguyên', //Mô tả của post type
//         'supports' => array(
//             'title',
//             'editor',
//             'excerpt',
//             'author',
//             'thumbnail',
//             'comments',
//             'trackbacks',
//             'revisions',
//             'custom-fields'
//         ), //Các tính năng được hỗ trợ trong post type
//         'taxonomies' => array( 'category', 'post_tag' ), //Các taxonomy được phép sử dụng để phân loại nội dung
//         'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
//         'public' => true, //Kích hoạt post type
//         'show_ui' => true, //Hiển thị khung quản trị như Post/Page
//         'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
//         'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
//         'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
//         'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
//         'menu_icon' => '', //Đường dẫn tới icon sẽ hiển thị
//         'can_export' => true, //Có thể export nội dung bằng Tools -> Export
//         'has_archive' => true, //Cho phép lưu trữ (month, date, year)
//         'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
//         'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
//         'capability_type' => 'post' //
//     );
 
//     register_post_type('tai-nguyen', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên
 
// }
// add_action('init', 'tao_custom_post_type');