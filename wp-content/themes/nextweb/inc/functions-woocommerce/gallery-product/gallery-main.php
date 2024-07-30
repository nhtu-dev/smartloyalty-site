<?php
/**
 * Create Custom Gallery Single Product
 */
function create_custom_gallery_single_product() {
	global $sh_option;
	if( $sh_option['gallery-single-custom'] == '1' ) {
		remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		add_action( 'woocommerce_product_thumbnails', 'gallery_show_product_thumbnails', 20 );
		add_action( 'woocommerce_before_single_product_summary', 'gallery_show_product_image', 10 );
	} else {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
add_action( 'init','create_custom_gallery_single_product' );

// Single Product Image
function gallery_show_product_image() {
	// Woocmmerce 3.0+ Slider Fix 
	require get_template_directory() . '/inc/functions-woocommerce/gallery-product/product-image.php';
}

// Single Product Thumbnails 
function gallery_show_product_thumbnails() {
	// Woocmmerce 3.0+ Slider Fix 
	require get_template_directory() . '/inc/functions-woocommerce/gallery-product/product-thumbnails.php';
}

/**
 * Include JS CSS Files 
 */
function gallery_enqueue_scripts() {
	if ( ! is_admin() ) {	
		if ( is_product() ) {
			wp_enqueue_script( 'slick-js' );
	        wp_enqueue_style( 'slick-style' );
	        wp_enqueue_style( 'slick-theme-style' );
			wp_enqueue_script( 'fancybox-js' );
			wp_enqueue_style( 'fancybox-css' );
			wp_enqueue_script( 'zoom-js', get_template_directory_uri() .'/lib/js/gallery-product/jquery.zoom.min.js',array('jquery'),'1.7.21', true );
			wp_enqueue_style( 'gallery-front-css', get_template_directory_uri() .'/lib/css/gallery-product/gallery-front.css' );
			wp_register_script( 'gallery-front-js', get_template_directory_uri() .'/lib/js/gallery-product/gallery.front.js',array('jquery'),'1.0', true );
			
			global $sh_option;
			$translation_array = array(
				'gallery_style'    		=> $sh_option['gallery-single-style'],
				'gallery_thumbnails'   	=> $sh_option['gallery-single-number-thumbnails'],
				'gallery_zoom'    		=> $sh_option['gallery-single-zoom'],
				'gallery_popup'   		=> $sh_option['gallery-single-lightbox'],
				'gallery_autoplay'		=> $sh_option['gallery-single-autoplay']
			);
			
			wp_localize_script( 'gallery-front-js', 'gallery_single_custom', $translation_array );
			
			// Enqueued script with localized data.
			wp_enqueue_script( 'gallery-front-js' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'gallery_enqueue_scripts' );