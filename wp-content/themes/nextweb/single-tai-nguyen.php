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
			<div class="col-sm-12">
				<?php do_action( 'before_loop_main_content' ) ?>
			
			<?php
			while ( have_posts() ) : the_post();?>

				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
<div class="entry-content">
			                  <?php the_content(); ?>
			                </div>
			<?php endwhile; // End of the loop.
			?>
			</div>
		</div>
			

		</main><!-- #main -->

		<?php do_action( 'sh_after_content' );?>
	</div><!-- #primary -->

<?php
get_footer();
