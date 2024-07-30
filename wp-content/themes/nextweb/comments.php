<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<span class="title_comment">
		    <?php printf( _nx( '1 comment', '%1$s comment', get_comments_number(), '', 'shtheme' ),
					number_format_i18n( get_comments_number() ));?>
		</span>
	<?php endif;?>
	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'shtheme' ); ?></p>
	<?php endif; ?>
	<?php if ( have_comments() ) : ?>
		<ol class="commentlist_mw">
			<?php wp_list_comments('type=comment&callback=shtheme_comment'); ?>
		</ol><!-- .commentlist -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; previous', '' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next &rarr;', '' ) ); ?></div>
			</nav>
		<?php endif;?>
	<?php endif; // have_comments() ?>
	
	<span class="title_comment"><?php _e('Your comment','shtheme') ?></span>

	<?php if ( comments_open() ) : ?>
		<div id="formcmmaxweb">
		
		    <div class="cancel-comment-reply">
		    	<small><?php cancel_comment_reply_link(); ?></small>
		    </div>
		
		    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		    <p><a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('Login','shtheme')?></a> <?php _e('to comment.','shtheme')?></p>
		    <?php else : ?>
		
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		
			    <?php if ( is_user_logged_in() ) : ?>
					<p class="nameuser"><?php _e('Comment with the name:','shtheme')?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a></p>    
			    <?php endif; ?>
		     	<div class="form-group">
		        	<textarea class="form-control" name="comment" id="comment" cols="50" rows="4" tabindex="4" placeholder="<?php _e('Your comment','shtheme')?>"></textarea>
		        </div>
			    <?php if( ! is_user_logged_in() ):?>    
					<div class="row">
				     	<div class="col-6">
				     		<div class="form-group">
					      		<input class="form-control" placeholder="<?php _e('Name','shtheme')?>" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author);?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
					      	</div>
				      	</div>
				      	<div class="col-6">
				     		<div class="form-group">
					      		<input class="form-control" placeholder="<?php _e('Email','shtheme')?>" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
					      	</div>
				      	</div>
					</div>
			    <?php endif;?>
		        <div class="form-group">
		        	<input class="btn text-uppercase" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Send','shtheme')?>" />
		        	<?php comment_id_fields(); ?>
		        </div>
		        <?php do_action('comment_form', $post->ID); ?>	
		    </form>	

	        <?php endif; // If registration required and not logged in ?>	       
	    </div>
	<?php endif; // if you delete this the sky will fall on your head ?>
</div><!-- #comments .comments-area -->