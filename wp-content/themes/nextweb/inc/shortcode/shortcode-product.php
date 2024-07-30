<?php
/**
 * Shortcode Product
 *
 * @link 
 *
 * @package SH_Theme
 */

class sh_product_shortcode {

	public static $args;

	public function __construct() {

		add_shortcode( 'shproduct', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $atts, $content = '') {
		$html = '';

		extract( shortcode_atts( array(
			'categories'		=> '',
			'posts_per_page'	=> '5',
			'numcol'			=> '3',
		), $atts ) );

		$args = array(
			'post_type' => 'product',
			'tax_query' => array(
				array(
					'taxonomy' 	=> 'product_cat',
					'field'     => 'id',
					'terms' 	=> $categories
				)
			),
			'posts_per_page'	=> $posts_per_page,
		);

		$the_query = new WP_Query( $args );

		// The Loop

		if ( $the_query->have_posts() ) {

			// $post_class_homepage = get_column_product($numcol);

			$html .= '<div class="sh-product-shortcode column-'. $numcol .'"><ul class="row list-products">';

			ob_start();
			while ( $the_query->have_posts() ) {

				$the_query->the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 *
				 * @hooked WC_Structured_Data::generate_product_data() - 10
				 */
				do_action( 'woocommerce_shop_loop' );

				wc_get_template_part( 'content', 'product' );

			}

			wp_reset_postdata();
			$html .= ob_get_contents();
			ob_end_clean();
			$html .= '</ul></div>';

		}

		return $html;
		
	}

}
new sh_product_shortcode();