<?php
/**
 * Dev Tooltip
**/
function code_hover_zoom_class_img() {
	global $sh_option;
    if( ! wp_is_mobile() && $sh_option['woocommerce-tooltip'] == '1' ) {
		wp_enqueue_style( 'hover-zoom-style' );
	    wp_enqueue_script('hover-zoom-js' );
    	?>
	    <div id="mystickytooltip" class="stickytooltip">
	        <div style="padding: 5px;">
	            <div id="stickyzoom" class="atip" style="min-width: 200px;">
	            	<img class="img-zoom" src="" />
	            	<div class="description-zoom"></div>
	            </div>
	        </div>
	    </div>
	    <script type="text/javascript">
	    	jQuery(document).ready(function(){
	    		jQuery('.image-product a.img').hover(function(){
			        var value = jQuery(this).data('img-full');
			        jQuery('.stickytooltip .img-zoom').attr('src', value);
			    });
	    	});
	    </script>
		<?php
    }
}
add_action('wp_footer','code_hover_zoom_class_img', 1);

/**
 * Include JS CSS Files 
 */
function tooltip_enqueue_scripts() {
	if ( ! is_admin() ) {	
		// Dev Tooltip
		wp_register_style( 'hover-zoom-style', get_template_directory_uri() .'/lib/css/stickytooltip.css' );
	    wp_register_script( 'hover-zoom-js', get_template_directory_uri() .'/lib/js/stickytooltip.js' );
	}
}
add_action( 'wp_enqueue_scripts', 'tooltip_enqueue_scripts' );