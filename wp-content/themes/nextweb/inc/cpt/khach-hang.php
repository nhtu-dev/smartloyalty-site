<?php

class Khach_Hang extends CPT_Abstract
{
	public function register_post_type($cpt)
	{
		$cpt->set_post_type(array(
			'post_type' 	=> 'khach-hang',
			'name' 			=> _x( 'Khách hàng', 'Post Type General Name', 'shtheme' ),
			'singular_name' => _x( 'Khách hàng', 'Post Type Singular Name', 'shtheme' ),
			'supports'		=> [ 'title', 'editor', 'thumbnail', 'excerpt' , 'revisions' ],
			'menu_icon'		=> 'dashicons-money',
			'rewrite'		=> [ 'slug' => 'khach-hang'],
			'menu_position'	=> 6
		));
		$cpt->set_no_slug_post_type( 'khach-hang' );
		//$cpt->set_no_gutenberg_post_types('khach-hang);
	}
}
new Khach_Hang();