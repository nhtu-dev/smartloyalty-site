<?php
/**
 * Display Call Ring
 */
function insert_callring(){
	global $sh_option;
	if( $sh_option['phonering-number'] || $sh_option['zalo-number'] ) {
		wp_enqueue_style( 'phonering-style' );
	}

	echo '<div class="hotline-phone-'. $sh_option['phonering-style'] .'">';
		if( $sh_option['phonering-number'] ) {

			if( $sh_option['phonering-style'] == '1' ) {
				echo '<div class="quick-alo-phone quick-alo-green quick-alo-show d-none d-xl-block" id="quick-alo-phoneIcon">';
					echo '<a href="tel:'. $sh_option['phonering-number'] .'" title="'. __('Call now','shtheme') .'">';
						echo '<div class="quick-alo-ph-circle"></div>';
						echo '<div class="quick-alo-ph-circle-fill"></div>';
						echo '<div class="quick-alo-ph-img-circle"></div>';
						echo '<span class="phone_text">'. __('Call now','shtheme') .': '. $sh_option['phonering-number'] .'</span>';
					echo '</a>';
				echo '</div>';
				echo '<div class="alo-floating d-xl-none"><a href="tel:'. $sh_option['phonering-number'] .'"><i class="fas fa-phone"></i> <strong>'. $sh_option['phonering-number'] .'</strong></a></div>';
			} elseif( $sh_option['phonering-style'] == '2' ) {
				echo '<div class="hotline-phone-ring-wrap">';
					echo '<div class="hotline-phone-ring">';
						echo '<div class="quick-alo-ph-circle"></div>';
						echo '<div class="quick-alo-ph-circle-fill"></div>';
						echo '<div class="quick-alo-ph-img-circle">';
							echo '<a href="tel:'. $sh_option['phonering-number'] .'" class="pps-btn-img">';
								echo '<img src="'. get_stylesheet_directory_uri() .'/lib/images/icon-phone2.png" alt="Số điện thoại" width="50">';
							echo '</a>';
						echo '</div>';
					echo '</div>';
					echo '<div class="hotline-bar d-none d-md-block">';
						echo '<a href="tel:'. $sh_option['phonering-number'] .'">';
							echo '<span class="text-hotline">'. $sh_option['phonering-number'] .'</span>';
						echo '</a>';
					echo '</div>';
				echo '</div>';
			}
		}

		if( $sh_option['zalo-number'] ) {
			echo '<div class="alo-floating alo-floating-zalo"><a title="Chat Zalo" rel="nofollow" target="_blank" href="https://zalo.me/'. $sh_option['zalo-number'] .'"><strong>Chat Zalo</strong></a></div>';
		}
	echo '</div>';
}
add_action('sh_after_footer','insert_callring');

function callring_style() {
	global $sh_option;
	if ( $sh_option['phonering-color'] ) {
	?>
	<style>
		.hotline-phone-1 .quick-alo-phone.quick-alo-green .quick-alo-ph-img-circle,
		.hotline-phone-2 .quick-alo-ph-img-circle, .hotline-bar {
			background-color: <?php echo $sh_option['phonering-color'] ?> !important;
		}
	</style>
	<?php
	$hex = $sh_option['phonering-color'];
		( strlen( $hex ) === 4 ) ? list( $r, $g, $b ) = sscanf( $hex, '#%1x%1x%1x' ) : list( $r, $g, $b ) = sscanf( $hex, '#%2x%2x%2x' );
		$hotlinebar_bg = "rgb( $r, $g, $b, .7 )";
	?>
	<style>
		.hotline-phone-1 .quick-alo-phone.quick-alo-green .quick-alo-ph-circle-fill,
		.hotline-phone-2 .quick-alo-ph-circle-fill {
			background: <?php echo $hotlinebar_bg ?> !important;
		}
		.hotline-phone-1 .quick-alo-phone.quick-alo-green .quick-alo-ph-circle {
			border-color: <?php echo $hotlinebar_bg ?> !important;
		}
	</style>
	<?php
	}
}
add_action( 'wp_footer', 'callring_style' );

/**
 * Display Slider
 */
function create_slide_carousel(){
	global $sh_option;
	if( $sh_option['home-slide-switch'] && is_front_page() ) {
		$slider_autoplay = $slider_pause = $class_fade = '';
		if( $sh_option['slider-autoplay'] ) {
			$slider_autoplay = 'carousel';
		}
		if( $sh_option['slider-interval'] ) {
			$slider_interval = $sh_option['slider-interval'];
		}
		if( $sh_option['slider-pause'] ) {
			$slider_pause = 'hover';
		}
		if( $sh_option['slider-animation'] ) {
			if( $sh_option['slider-animation'] == '1' ) {
				$class_carousel = '';
			} else {
				$class_carousel = 'carousel-fade';
			}
		}
		echo '<div class="wtb-slider">';
			$home_slide = $sh_option['home-slide'];
			echo '<div id="carouselMainSlide" class="carousel slide '. $class_carousel .'" data-ride="'. $slider_autoplay .'" data-interval="'. $slider_interval .'" data-pause="'. $slider_pause .'">';
				echo '<ol class="carousel-indicators">';
					$i = 0;
					foreach ( $home_slide as $key => $value ) {
						$class = ( $i == 0 ) ? ' active' : '';
						echo '<li data-target="#carouselMainSlide" data-slide-to="'. $i .'" class="'. $class .'"></li>';
						$i++;
					}
				echo '</ol>';
				echo '<div class="carousel-inner">';
					$i = 0;
					foreach ( $home_slide as $key => $value ) {
						$class = ( $i == 0 ) ? ' active' : '';
						echo '<div class="carousel-item '. $class .'">';
							if( $value['url'] ) {
								echo '<a href="'. $value['url'] .'">';
									echo '<img class="d-block w-100" src="'. $value['image'] .'" alt="'. $value['title'] .'">';
								echo '</a>';
							} else {
								echo '<img class="d-block w-100" src="'. $value['image'] .'" alt="'. $value['title'] .'">';
							}
							if( $value['title'] || $value['description'] ) {
								echo '<div class="carousel-caption d-none d-md-block">';
									echo '<h3>'. $value['title'] .'</h3>';
									echo '<p>'. $value['description'] .'</p>';
								echo '</div>';
							}
						echo '</div>';
						$i++;
					}
				echo '</div>';
				echo '<a class="carousel-control-prev" href="#carouselMainSlide" role="button" data-slide="prev">';
					echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
					echo '<span class="sr-only">Previous</span>';
				echo '</a>';
				echo '<a class="carousel-control-next" href="#carouselMainSlide" role="button" data-slide="next">';
					echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
					echo '<span class="sr-only">Next</span>';
				echo '</a>';
			echo '</div>';
		echo '</div>';
	}
}
add_action('before_loop_main_content','create_slide_carousel');

/**
 * Display Metaslider
 */
function insert_metaslide(){
	global $sh_option;
	if( ! empty( $sh_option['metaslider'] ) && ( is_home() || is_front_page() ) ) {
		$metaslider = $sh_option['metaslider'];
		echo '<div class="wtb-slider">'.do_shortcode('[metaslider id="'.$metaslider.'"]').'</div>';
	}
}
add_action('before_loop_main_content','insert_metaslide');

/**
 * Display Logo
 */
function display_logo(){
	global $sh_option;
	$url_logo = $sh_option['opt_settings_logo']['url'];
	if(  $url_logo ) {
		echo '<a href="'. esc_url( home_url( '/' ) ) .'"><img src="'. $url_logo .'"></a>';
	}
}

/**
 * Display Footer
 */
function sh_footer_widget_areas() {

	global $sh_option;

	$footer_widgets = $sh_option['opt-number-footer'];
	$footer_widgets_number = intval($footer_widgets);

	switch ($footer_widgets_number) {
	    case '1':
	        $classes = 'footer-widgets-area col-md-12';
	        break;
	    case '2':
	        $classes = 'footer-widgets-area col-md-6';
	        break;
	    case '3':
	        $classes = 'footer-widgets-area col-md-4';
	        break;
	    case '4':
	        $classes = 'footer-widgets-area col-md-3';
	        break;
	    case '5':
	        $classes = 'footer-widgets-area col-lg-15 col-md-4 col-sm-6';
	        break;
	}

 	$counter = 1;
	while ( $counter <= $footer_widgets_number ) {

		echo '<div class="'. $classes .'">';
			dynamic_sidebar( 'footer-' . $counter );
		echo '</div>';
		$counter++;
	}

}
add_action( 'sh_footer', 'sh_footer_widget_areas' );

/**
 * Inser Code To Header Footer
 */
function insert_code_to_header(){
	global $sh_option;
	$html_header = $sh_option['opt-textarea-header'];
	if( $html_header ) {
		echo $html_header;
	}
}
add_action( 'wp_head','insert_code_to_header' );

function insert_code_to_footer(){
	global $sh_option;
	$html_footer = $sh_option['opt-textarea-footer'];
	if( $html_footer ) {
		echo $html_footer;
	}
}
add_action( 'wp_footer','insert_code_to_footer' );
