<?php
/**
 * SH Theme Sidebar functions
 *
 * @link 
 *
 * @package SH_Theme
 */

function sh_sidebar(){
	global $sh_option;
	$layout = $sh_option['opt-layout'];
	if( $layout != '1' ) {
		get_sidebar();
	}
}
add_action( 'sh_after_content','sh_sidebar' );

function sh_sidebar_alt(){
	global $sh_option;
	$layout = $sh_option['opt-layout'];
	if( $layout == '4' || $layout == '5' || $layout == '6' ) {
		get_sidebar('alt');
	}
}
add_action( 'sh_after_content_sidebar_wrap','sh_sidebar_alt' );