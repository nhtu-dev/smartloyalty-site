<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SH_Theme
 */

get_header(); ?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">
		<div class="row">
			<div class="col-sm-8">
				<?php do_action( 'before_loop_main_content' ) ?>
			
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
				 	comments_template();
				 endif;

			endwhile; // End of the loop.
			?>
			</div>
			<div class="col-sm-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
			

		</main><!-- #main -->

		<?php do_action( 'sh_after_content' );?>
	</div><!-- #primary -->

<?php
get_footer();
