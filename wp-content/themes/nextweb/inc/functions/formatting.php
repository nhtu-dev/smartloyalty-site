<?php
/**
 * Formatting
 *
 *
 * @package SH_Theme
 * @author  
 * @license 
 * @link    
 */

/**
 * Return a phrase shortened in length to a maximum number of characters.
 *
 * Result will be truncated at the last white space in the original string. In this function the word separator is a
 * single space. Other white space characters (like newlines and tabs) are ignored.
 *
 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
 *
 * @since 1.4.0
 *
 * @param string $text           A string to be shortened.
 * @param int    $max_characters The maximum number of characters to return.
 * @return string Truncated string. Empty string if `$max_characters` is falsy.
 */
function sh_truncate_phrase( $text, $max_characters ) {

	if ( ! $max_characters ) {
		return '';
	}

	$text = trim( $text );

	if ( mb_strlen( $text ) > $max_characters ) {

		// Truncate $text to $max_characters + 1.
		$text = mb_substr( $text, 0, $max_characters + 1 );

		// Truncate to the last space in the truncated string.
		$text_trim = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );

		$text = empty( $text_trim ) ? $text : $text_trim;

	}

	return $text;
}

/**
 * Return content stripped down and limited content.
 *
 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
 *
 * @since 0.1.0
 *
 * @param int    $max_characters The maximum number of characters to return.
 * @param string $more_link_text Optional. Text of the more link. Default is "(more...)".
 * @param bool   $stripteaser    Optional. Strip teaser content before the more text. Default is false.
 * @return string Limited content.
 */
function get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

	$content = get_the_content( '', $stripteaser );

	// Strip tags and shortcodes so the content truncation count is done correctly.
	$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

	// Remove inline styles / scripts.
	$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

	// Truncate $content to $max_char.
	$content = sh_truncate_phrase( $content, $max_characters );

	// More link?
	if ( $more_link_text ) {
		$link   = apply_filters( 'get_the_content_more_link', sprintf( '&#x02026; <a href="%s" class="more-link">%s</a>', get_permalink(), $more_link_text ), $more_link_text );
		$output = sprintf( '<p>%s %s</p>', $content, $link );
	} else {
		$output = sprintf( '<p>%s</p>', $content );
		$link = '';
	}

	return apply_filters( 'get_the_content_limit', $output, $content, $link, $max_characters );

}


/**
 * Echo the limited content.
 *
 * @since 0.1.0
 *
 * @param int    $max_characters The maximum number of characters to return.
 * @param string $more_link_text Optional. Text of the more link. Default is "(more...)".
 * @param bool   $stripteaser    Optional. Strip teaser content before the more text. Default is false.
 */
function the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

	$content = get_the_content_limit( $max_characters, $more_link_text, $stripteaser );
	echo apply_filters( 'the_content_limit', $content );

}

/**
 * Responsive Video Youtube In Content
 *
 * @since 0.1.0
 *
 * @param string $content 
 */
function div_wrapper_video($content) {
   // match any iframes
   /*$pattern = '~<iframe.*</iframe>|<embed.*</embed>~'; // Add it if all iframe*/
   $pattern = '~<iframe.*src=".*(youtube.com|youtu.be).*</iframe>|<embed.*</embed>~'; //only iframe youtube
   preg_match_all($pattern, $content, $matches);
   foreach ($matches[0] as $match) {
     // wrap matched iframe with div
     $wrappedframe = '<div class="embed-responsive embed-responsive-16by9">' . $match . '</div>';
     //replace original iframe with new in content
     $content = str_replace($match, $wrappedframe, $content);
   }
   return $content; 
}
add_filter('the_content', 'div_wrapper_video');


function shtheme_comment($comment, $args, $depth)    {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class();?> id="li-comment-<?=get_comment_ID();?>">    
        <div id="comment-<?=get_comment_ID();?>" class="clearfix">
             <div class="comment-author vcard">
                <?php echo get_avatar($comment, $size='70', ''); ?>  
             </div><!-- end comment autho vcard-->
        
	         <div class="commentBody">
	        	 <div class="comment-meta commentmetadata">
	              <?php printf(('<p class="fn">%s</p>'), get_comment_author_link()); ?>	              
	             </div><!--end .comment-meta-->
	            <?php if($comment->comment_approved == '0') : ?>
	                <em><?php echo 'Your coment is waiting for moderation.';?></em>
	                <?php endif; ?>
				<div class="noidungcomment">
	            	<?php comment_text(); ?>
	            </div>
	            <div class="tools_comment">	                
		            <?php comment_reply_link(array_merge($args,array('respond_id' => 'formcmmaxweb','depth' => $depth, 'max_depth'=> $args['max_depth'])));?>		            
              		<?php edit_comment_link(__('Edit'),' ',''); ?>
              		<?php printf(('<a href="#comment-%d" class="ngaythang">%s</a>'),get_comment_ID(),get_comment_date('d/m/Y'));?>
	            </div>
	            	
	        </div><!--end #commentBody-->
        </div><!--end #comment-author-vcard-->
	</li>
<?php }
//validate comments
function comment_validation_init() {
	if(is_singular() && comments_open() ) { 
		wp_enqueue_script( 'validate-js' );
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#commentform').validate({		 
			onfocusout: function(element) {
				this.element(element);
			},
			rules: {
				author: {
					required: true,
					minlength: 2
				},
				email: {
					required: true,
					email: true
				},
				comment: {
					required: true,
				}
			},
			messages: {
				author: "<?php echo __('The field is required.','shtheme');?>",
				email: "<?php echo __('The field is required.','shtheme');?>",
				comment: "<?php echo __('The field is required.','shtheme');?>"
			},
			errorElement: "div",
			errorPlacement: function(error, element) {
				element.after(error);
			}
		});
	});
	</script>
	<?php
	}
}
add_action('wp_footer', 'comment_validation_init');