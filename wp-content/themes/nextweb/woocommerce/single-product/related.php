<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<?php
	global $sh_option;
	$display_relatedpro = $sh_option['display-relatedpro'];
	$numcol_pro_related = $sh_option['number-column-product-related'];
	if( $display_relatedpro == '1' ) {
		wp_enqueue_script( 'slick-js' );
        wp_enqueue_style( 'slick-style' );
        wp_enqueue_style( 'slick-theme-style' );
        // woocommerce_product_loop_start();
        ?>
        <section class="related">
	        <h2 class="heading-related"><span><?php _e( 'Related Products', 'shtheme' ); ?></span></h2>
        	<ul class="slick-carousel list-products" 
	        	data-item="<?php echo $numcol_pro_related;?>" 
	        	data-item_md="2" 
	        	data-item_sm="2" 
	        	data-item_mb="1" 
	        	data-row="1" 
	        	data-dots="false" 
	        	data-arrows="true" 
	        	data-vertical="false">
				<?php
					foreach ( $related_products as $related_product ) : 
					 	$post_object = get_post( $related_product->get_id() );
						setup_postdata( $GLOBALS['post'] =& $post_object );
						wc_get_template_part( 'content', 'product' );
					endforeach;
				?>
			</ul>
		</section>
        <?php
        // woocommerce_product_loop_end();
	}
    ?>

<?php endif;

wp_reset_postdata();
