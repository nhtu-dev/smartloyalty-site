<?php
/**
 * Dev Disable Cart
**/
function dev_disable_cart(){
	global $sh_option;
	if( $sh_option['woocommerce-disable-cart'] == '0' ) {
		remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10 );
		remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30 );
	}
}
add_action( 'init','dev_disable_cart' );

function remove_menu_pages_disable_cart() {
	global $sh_option;
	if( $sh_option['woocommerce-disable-cart'] == '0' && ! current_user_can('administrator') ) {
    	remove_menu_page( 'woocommerce' );
    }
}
add_action( 'admin_init', 'remove_menu_pages_disable_cart' );