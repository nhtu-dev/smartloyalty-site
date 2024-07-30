<?php
$css_class = '';

extract(shortcode_atts(array(
    'pos'                   => 'default',
    'icon_img'              => '',
    'img_width'             => '48',
    'title'                 => '',
    'heading_tag'           => 'h3',
    'link'                  => '',
    'read_more'             => 'none',
    'read_text'             => 'Read More',
    'el_class'              => '',
    'css'                   => '',
), $atts));

$output = $html = $target = $prefix = $suffix = '';

if($pos != ''){
    $ex_class .= $pos.'-icon';
    $ic_class = 'wtb-icon-'.$pos;
}

$box_icon = '<div class="align-icon">';
    $box_icon .= '<div class="wtb-icon-img" style="font-size:'. $img_width .'px">';
    $post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $icon_img, 'thumb_size' => 'full' ) );
    $thumbnail = $post_thumbnail['thumbnail'];
    $box_icon .= apply_filters( 'vc_images_carousel_thumbnail', $thumbnail );
    $box_icon .= '</div>';
$box_icon .= '</div>';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'wtb_infobox', $atts );
$el_class = esc_html( wtb_shortcode_extract_class( $el_class ) );

$prefix .= '<div class="wtb_infobox_container wpb_content_element '.esc_attr($css_class).' '.esc_attr($el_class).'">';
$suffix .= '</div> <!-- wtb_infobox_container -->'; 

$html .= '<div class="wtb_infobox-shortcode '. $el_class .'">';

    $html .= '<div class="wtb-icon-box '. esc_attr($ex_class) .'">';
        
        if($pos == "heading-right" || $pos == "right") {
            if( $pos == 'right' ){
                $html .= '<div class="wtb-ibd-block">';
            }
            if($title !== ''){
                $html .= '<div class="wtb-icon-header" >';
                $link_prefix = $link_sufix = '';
                if($link !== 'none'){
                    if($read_more == 'title')
                    {
                        $href           = vc_build_link($link);

                        $url            = ( isset( $href['url'] ) && $href['url'] !== '' ) ? $href['url']  : '';
                        $target         = ( isset( $href['target'] ) && $href['target'] !== '' ) ? esc_attr( trim( $href['target'] ) ) : '';
                        $link_title     = ( isset( $href['title'] ) && $href['title'] !== '' ) ? esc_attr($href['title']) : '';
                        $rel            = ( isset( $href['rel'] ) && $href['rel'] !== '' ) ? esc_attr($href['rel']) : '';
                        $link_prefix = '<a class="wtb-icon-box-link" '. wtb_link_init($url, $target, $link_title, $rel ).'>';
                        $link_sufix = '</a>';
                    }
                }
                $html .= $link_prefix.'<'. $heading_tag .' class="wtb-icon-title">'.$title.'</'. $heading_tag .'>'.$link_sufix;
                $html .= '</div> <!-- header -->';
            }
            if($pos !== "right"){
                if($icon_img !== '')
                    $html .= '<div class="'.esc_attr($ic_class).'" >'.$box_icon.'</div>';
            }
            if($content !== ''){
                $html .= '<div class="wtb-icon-description">';
                    $html .= do_shortcode($content);
                    if($link !== 'none'){
                        if($read_more == 'more') {
                            $href           = vc_build_link($link);

                            $url            = ( isset( $href['url'] ) && $href['url'] !== '' ) ? $href['url']  : '';
                            $target         = ( isset( $href['target'] ) && $href['target'] !== '' ) ? esc_attr( trim( $href['target'] ) ) : '';
                            $link_title     = ( isset( $href['title'] ) && $href['title'] !== '' ) ? esc_attr($href['title']) : '';
                            $rel            = ( isset( $href['rel'] ) && $href['rel'] !== '' ) ? esc_attr($href['rel']) : '';

                            $more_link = '<a class="wtb-icon-read x" '. wtb_link_init($url, $target, $link_title, $rel ).'>';
                            $more_link .= $read_text;
                            $more_link .= '&nbsp;&raquo;';
                            $more_link .= '</a>';
                            $html .= $more_link;
                        }
                    }
                $html .= '</div> <!-- description -->';
            }
            if($pos == "right"){
                $html .= '</div> <!-- wtb-ibd-block -->';
                if($icon !== 'none' || $icon_img !== '')
                    $html .= '<div class="'.esc_attr($ic_class).'">'.$box_icon.'</div>';
            }
        } else {
            if($icon !== 'none' || $icon_img != '')
                $html .= '<div class="'.esc_attr($ic_class).'">'.$box_icon.'</div>';
            if($pos == "left")
                $html .= '<div class="wtb-ibd-block">';
            if($title !== ''){
                $html .= '<div class="wtb-icon-header" >';
                $link_prefix = $link_sufix = '';
                if($link !== 'none'){
                    if($read_more == 'title')
                    {
                        $href = vc_build_link($link);

                        $url            = ( isset( $href['url'] ) && $href['url'] !== '' ) ? $href['url']  : '';
                        $target         = ( isset( $href['target'] ) && $href['target'] !== '' ) ? esc_attr( trim( $href['target'] ) ) : '';
                        $link_title     = ( isset( $href['title'] ) && $href['title'] !== '' ) ? esc_attr($href['title']) : '';
                        $rel            = ( isset( $href['rel'] ) && $href['rel'] !== '' ) ? esc_attr($href['rel']) : '';

                        $link_prefix = '<a class="wtb-icon-box-link" '. wtb_link_init($url, $target, $link_title, $rel ).'>';
                        $link_sufix = '</a>';
                    }
                }
                $html .= $link_prefix.'<'. $heading_tag .' class="wtb-icon-title">'.$title.'</'. $heading_tag .'>'.$link_sufix;
                $html .= '</div> <!-- header -->';
            }
            if($content !== ''){
                $html .= '<div class="wtb-icon-description">';
                    $html .= do_shortcode($content);
                    if($link !== 'none'){
                        if($read_more == 'more') {
                            $href           = vc_build_link($link);

                            $url            = ( isset( $href['url'] ) && $href['url'] !== '' ) ? $href['url']  : '';
                            $target         = ( isset( $href['target'] ) && $href['target'] !== '' ) ? esc_attr( trim( $href['target'] ) ) : '';
                            $link_title     = ( isset( $href['title'] ) && $href['title'] !== '' ) ? esc_attr($href['title']) : '';
                            $rel            = ( isset( $href['rel'] ) && $href['rel'] !== '' ) ? esc_attr($href['rel']) : '';

                            $more_link = '<a class="wtb-icon-read x" '. wtb_link_init($url, $target, $link_title, $rel ).'>';
                            $more_link .= $read_text;
                            $more_link .= '&nbsp;&raquo;';
                            $more_link .= '</a>';
                            $html .= $more_link;
                        }
                    }
                $html .= '</div> <!-- description -->';
            }
            if($pos == "left")
                $html .= '</div> <!-- wtb-ibd-block -->';
        }

    $html .= '</div>';

$html .= '</div> <!-- wtb-icon-box -->';

if($link !== 'none'){
    if($read_more == 'box') {
        $href = vc_build_link($link);

        $url            = ( isset( $href['url'] ) && $href['url'] !== '' ) ? $href['url']  : '';
        $target         = ( isset( $href['target'] ) && $href['target'] !== '' ) ? esc_attr( trim( $href['target'] ) ) : '';
        $link_title     = ( isset( $href['title'] ) && $href['title'] !== '' ) ? esc_attr($href['title']) : '';
        $rel            = ( isset( $href['rel'] ) && $href['rel'] !== '' ) ? esc_attr($href['rel']) : '';

        $output = $prefix.'<a class="wtb-icon-box-link" '. wtb_link_init($url, $target, $link_title, $rel ).'>'.$html.'</a>'.$suffix;
    } else {
        $output = $prefix.$html.$suffix;
    }
} else {
    $output = $prefix.$html.$suffix;
}
echo $output;
