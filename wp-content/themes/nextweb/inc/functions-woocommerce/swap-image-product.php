<?php
/**
 * Add class if product has gallery
 */
function add_class_product_has_gallery( $classes ) {
	global $product, $sh_option;
	if( $sh_option['woo-hover-flip-image'] == '1' && ! is_admin() ) {
		$post_type = get_post_type( get_the_ID() );

		if ( $post_type == 'product' ) {
			$attachment_ids 	= $product->get_gallery_image_ids( $product );
			$attachment_ids     = array_values( $attachment_ids );
			if ( $attachment_ids ) {
				$classes[] = 'product-has-gallery';
			}
		}
	}

	return $classes;
}
add_filter( 'post_class', 'add_class_product_has_gallery' );

/**
 * Get first image of gallery product in content-product.php
 */
function woocommerce_swap_image_product(){
	global $product, $sh_option, $woocommerce;
	if( $sh_option['woo-hover-flip-image'] == '1' && ! is_admin() ) {
		$version = '3.0';
		if( version_compare( $woocommerce->version, $version, ">=" ) ) {
			$attachment_ids = $product->get_gallery_image_ids();
		} else {
			$attachment_ids = $product->get_gallery_attachment_ids();
		}

		$attachment_ids     = array_values( $attachment_ids );

		if( ! empty( $attachment_ids['0'] )  ) {
			$secondary_image_id = $attachment_ids['0'];
			$secondary_image_alt 	= get_post_meta( $secondary_image_id, '_wp_attachment_image_alt', true );
			$secondary_image_title 	= get_the_title($secondary_image_id);

			echo wp_get_attachment_image(
				$secondary_image_id,
				'shop_catalog',
				'',
				array(
					'class' => 'secondary-image attachment-shop-catalog wp-post-image wp-post-image--secondary',
					'alt' 	=> $secondary_image_alt,
					'title' => $secondary_image_title,
				)
			);
		}
	}
}
add_action( 'woocommerce_shop_loop_item_image','woocommerce_swap_image_product' );