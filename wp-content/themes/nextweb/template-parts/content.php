<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SH_Theme
 */

global $sh_option;
$slug_category = 'category';
postview_set( get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
	<?php if( $sh_option['display-pagetitlebar'] == '0' || empty( $sh_option['display-pagetitlebar'] )) : ?>
		<header class="entry-header">
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>
		</header><!-- .entry-header -->
	<?php endif;?>

	<?php if( $sh_option['display-time-view'] == '1' ) : ?>
		<div class="entry-meta">
			<span class="entry-time"><i class="far fa-calendar-alt"></i> <?php the_time('g:i a d/m/Y') ?></span>
			<span class="entry-view"><i class="fas fa-eye"></i> <?php echo postview_get( get_the_ID() );?></span>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'shtheme' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			echo get_the_tag_list('<p><i class="fas fa-tags"></i> '. __('Tags','shtheme') .': ',', ','</p>');
		?>
	</div><!-- .entry-content -->

	<?php if( $sh_option['display-sharepost'] == '1' ) : $GLOBALS['lib_fb'] = 1; ?>
		<div class="socials-share">
			<div id="fb-root"></div>
			<script async defer crossorigin="anonymous" src="https://connect.facebook.net/<?php _e('en_US','shtheme');?>/sdk.js#xfbml=1&version=v3.3"></script>

			<div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>

			<script>window.twttr = (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0],
			t = window.twttr || {};
			if (d.getElementById(id)) return t;
			js = d.createElement(s);
			js.id = id;
			js.src = "https://platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js, fjs);
			t._e = [];
			t.ready = function(f) {
			t._e.push(f);
			};
			return t;
			}(document, "script", "twitter-wjs"));</script>
			<a class="twitter-share-button" href="<?php the_permalink();?>">Tweet</a>
		</div>
	<?php endif;?>

	<?php
	
	if( $sh_option['display-navipost'] == '1' && ( ! empty( get_next_post() ) || ! empty( get_previous_post() ) ) ) :
	?>
		<div class="post-next-prev">
			<div class="row">
				<?php if( get_next_post() ) : $next_id = get_next_post()->ID; ?>
					<div class="col-sm-6">
						<div class="post-next-prev-content text-left">
							<a href="<?php echo get_the_permalink( $next_id ); ?>"><span><?php _e( 'Next Post', 'shtheme' );?></span></a>
						</div>
					</div>
				<?php endif;?>
				<?php if( get_previous_post() ) : $previous_id = get_previous_post()->ID; ?>
					<div class="col-sm-6">
						<div class="post-next-prev-content text-right">
							<a href="<?php echo get_the_permalink( $previous_id ); ?>"><span><?php _e( 'Previous Post', 'shtheme' );?></span></a>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	<?php endif;?>

	<?php 
	if( $sh_option['display-relatedpost'] == '1' ) {

		// Get id category
		global $post;
		$category = wp_get_object_terms( 
			$post->ID,
			$slug_category,	//change taxonomy
			array(
				'orderby' 	=> 'term_group', 
				'order' 	=> 'DESC'
			)
		);
		if( function_exists('yoast_get_primary_term_id') && count( $category ) > 1 && yoast_get_primary_term_id( $slug_category,$post->ID ) ) {
			$cat_id = yoast_get_primary_term_id( $slug_category,$post->ID );
		} else {
			$cat_id = end( $category )->term_id;
		}

		// Loop
		$the_query = new WP_Query( array(
			'post_type' 		=> $post->post_type,
            'tax_query' 		=> array(
                array(
                    'taxonomy' 	=> $slug_category, //change taxonomy
                    'field' 	=> 'id',
                    'terms' 	=> $cat_id,
                )
            ),
            'posts_per_page' 	=> $sh_option['relatedpost-number-post'],
            'post__not_in' 		=> array( $post->ID ),
        ));
        if( $the_query->have_posts() ) :
        	echo '<div class="related-posts">';
        		echo '<h4 class="related-title"><span>'. __( 'Related posts', 'shtheme' ) .'</span></h4>';
        		echo '<ul>';
			        while( $the_query->have_posts() ) : $the_query->the_post();
			        	echo '<li>';
			        		echo '<a href="' . get_the_permalink() .'" title="' . get_the_title() . '">' . get_the_title() . '</a>';
			        	echo '</li>';
			        endwhile;
			    echo '</ul>';
			echo '</div>';
        endif;
        wp_reset_postdata();
	}
	?>

</article><!-- #post-## -->
