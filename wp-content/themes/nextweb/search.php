<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package SH_Theme
 */

get_header(); ?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<?php
			if ( have_posts() ) : ?>

					<h1 class="page-title"><?php printf( esc_html__( 'Search for keyword: %s', 'shtheme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

				<?php
				// Settings Loop
				$new_post = new sh_blog_shortcode();
				$post_class = array( 'element', 'hentry', 'post-item', 'item-new' );
				$image_size = 'sh_thumb300x200';
				$atts['hide_category'] 		= '0';
				$atts['hide_desc'] 			= '1';
				$atts['hide_meta']			= '1';
				$atts['hide_viewmore']		= '1';
				$atts['number_character']	= '300';
				$post_class[] 				= 'col-md-12';
				$style 						= 'style-1';
				
				/* Start the Loop */
				echo '<div class="sh-blog-shortcode '. $style .'"><div class="row">';
					while ( have_posts() ) : the_post();
						echo $new_post->sh_general_post_html_style_2( $post_class, $atts, $image_size );
					endwhile;
				echo '</div></div>';
				shtheme_pagination();
				wp_reset_postdata();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->

		<?php do_action( 'sh_after_content' );?>
		
	</div><!-- #primary -->

<?php
get_footer();
