<?php
/**
 * Template Name: Contact Page
 *
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

			<?php do_action( 'before_loop_main_content' ) ?>
			
			<?php
			while ( have_posts() ) : the_post();

				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if( $sh_option['display-pagetitlebar'] == '0' || empty( $sh_option['display-pagetitlebar'] )) : ?>
						<header class="entry-header">
							<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
						</header><!-- .entry-header -->
					<?php endif;?>

					<div class="entry-content">
						<?php if( $sh_option['information-map'] ) : ?>
							<div class="embed-responsive embed-responsive-21by9 mb-5">
								<?php echo $sh_option['information-map'];?>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-sm-6">
								<?php echo do_shortcode( '[contact-form-7 id="156" title="Liên hệ"]' );?>
							</div>
							<div class="col-sm-6">
								<?php
									the_content();
								?>
							</div>
						</div>
					</div><!-- .entry-content -->
					
				</article><!-- #post-## -->
				<?php

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
		
		<?php do_action( 'sh_after_content' );?>

	</div><!-- #primary -->

<?php
get_footer();
