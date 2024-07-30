<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Photo Cat
 */

class Photo_Cat extends Custom_Taxonomy_Abstract
{
	public function register_taxonomy($taxonomy)
	{
		$taxonomy->set_taxonomy([
			'taxonomy' 			=> 'khach-hang_cat',
			'post_type' 		=> 'khach-hang',
			'name' 				=> __('Danh mục', 'shtheme'),
			'singular_name' 	=> __('Danh mục', 'shtheme'),
		]);
	}

}

new Photo_Cat();