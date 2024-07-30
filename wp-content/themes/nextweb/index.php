<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SH_Theme
 */

global $sh_option;
get_header(); ?>
	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">


			<!-- --------------------- Products --------------------- -->
			<?php
			if ( class_exists( 'WooCommerce' ) ) {
				if( $sh_option['list_cat_product'] ) {
					$list_cat_product = $sh_option['list_cat_product'];
					if( $sh_option['number_product'] ) {
						$number_product = $sh_option['number_product'];
					}
					if( $sh_option['number_product_row'] ) {
						$number_product_row = $sh_option['number_product_row'];
					}
					echo '<div class="product-wrap">';
						foreach ($list_cat_product as $key => $idpost) {
							echo '<h2 class="heading"><a title="'. get_dm_name( $idpost,'product_cat' ) .'" href="'. get_dm_link( $idpost,'product_cat' ) .'">'. get_dm_name( $idpost,'product_cat' ) .'</a></h2>';
							echo do_shortcode('[shproduct posts_per_page="' . $number_product . '" categories="' . $idpost . '" numcol="' . $number_product_row . '"]');
						}
					echo '</div>';
				}
			}
			?>

			<!-- --------------------- News --------------------- -->
			<?php
			if( $sh_option['list_cat_post'] ) {
				$list_cat_post = $sh_option['list_cat_post'];
				if( $sh_option['number_news'] ) {
					$number_news = $sh_option['number_news'];
				}
				if( $sh_option['type_layout'] ) {
					$type_layout = $sh_option['type_layout'];
				}
				echo '<div class="news-wrap">';
					foreach ($list_cat_post as $key => $idpost) {
						echo '<h2 class="heading"><a title="'. get_cat_name( $idpost ) .'" href="'. get_category_link( $idpost ) .'">'. get_cat_name( $idpost ) .'</a></h2>';
						echo do_shortcode('[shblog posts_per_page="' . $number_news . '" categories="' . $idpost . '" number_character="140" style="' . $type_layout . '"]');
					}
				echo '</div>';
			}
			?>

		</main><!-- #main -->


	</div><!-- #primary -->
	
<?php
get_footer();