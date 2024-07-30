<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SH_Theme
 */

global $sh_option;
do_action( 'sh_after_content_sidebar_wrap' );
?>
		</div>
	</div><!-- #content -->

	<footer id="footer" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
		
		<div class="footer-widgets">
			<div class="container">
				<div class="wrap">
					<div class="row">
						<?php do_action( 'sh_footer' );?>
					</div>
				</div>
			</div>
		</div><!-- .footer-widgets -->
		<div class="site-info">
			<div class="container">
				<div class="wrap">
					<div class="row">
						<div class="col-sm-12">
							<?php if( $sh_option['footer-copyright'] ) : echo $sh_option['footer-copyright'];endif;?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
		<p id="back-top"><a href="#top" target="_blank"><span></span></a></p>
		
	</footer><!-- #colophon -->

	<?php do_action( 'sh_after_footer' );?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
