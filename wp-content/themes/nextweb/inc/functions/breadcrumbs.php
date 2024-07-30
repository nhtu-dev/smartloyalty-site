<?php
/**
 * Breadcrumbs
 * @package SH_Theme
 * @author  Quang Hoa
 * @license 
 * @link    
 */

function sh_create_breadcrumb(){
    global $sh_option;
    if( $sh_option['display-pagetitlebar'] == '1' && ! is_front_page() ) {
        echo '<div class="d-flex align-items-center page-title-bar">';
            echo '<div class="container">';
                echo '<div class="title-bar-wrap">';
                    if( is_page( ) || is_single( ) ) {
                        echo '<h1 class="title">'. get_the_title( ) .'</h1>';
                    } elseif( is_archive() ) {
                        ?><h1 class="title"><?php single_term_title(); ?></h1><?php
                    } elseif( is_search() ) {
                        echo '<h1 class="title">'.__('Search for keyword', 'shtheme').': '. get_search_query() .'</h1>';
                    } elseif( is_404() ) {
                        echo '<h1 class="title">'.__('404 Not Found', 'shtheme').'</h1>';
                    }
                    if ( class_exists( 'WooCommerce' ) ) {
                        if( is_shop() ) {
                            echo '<h1 class="title">'.__('Products', 'shtheme').'</h1>';
                        }
                    }
                    if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb('<div class="breadcrumb">','</div>');
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    } elseif ( ! is_front_page() ) {
        echo '<div class="wtb-breadcrumb">';
            echo '<div class="container">';
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<div class="breadcrumb">','</div>');
                }
            echo '</div>';
        echo '</div>';
    }
}
add_action( 'before_content','sh_create_breadcrumb' );