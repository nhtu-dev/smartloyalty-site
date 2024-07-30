<?php
// Add custom Theme Functions here
//  * Code bài viết liên quan theo chuyên mục
function related_cat() {
    $output = '';
    if (is_single()) {
      global $post;
      $categories = get_the_category($post->ID);
      if ($categories) {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
        $args=array(
          'category__in' => $category_ids,
          'post__not_in' => array($post->ID),
          'posts_per_page'=>3,
          'ignore_sticky_posts'=>1
        );
        
        $my_query = new wp_query( $args );
        if( $my_query->have_posts() ):
            $output .= '<div class="related-box">';
                $output .= '<span class="related-head">Bài viết liên quan:</span><div class="row related-post">';
                    while ($my_query->have_posts()):$my_query->the_post();
                    $output .= 
                        '<div class="col large-4">
                            <a href="'.get_the_permalink().'" title="'.get_the_title().'">
                                <div class="feature">
                                    <div class="image" style="background-image:url('. get_the_post_thumbnail_url() .');"></div>
                                </div>                            
                            </a>
                            <div class="related-title"><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div>
                        </div>';
                    endwhile;
                $output .= '</div>';
            $output .= '</div>';
        endif;   //End if.
      wp_reset_query();
    }
    return $output;
  }
}
add_shortcode('related_cat','related_cat');

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_tag() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});

if ( ! function_exists( 'themewpdotvn_mce_text_sizes' ) ) {
    function themewpdotvn_mce_text_sizes( $initArray ){
        $initArray['fontsize_formats'] = "8pt 9pt 10pt 12pt 13pt 14pt 16pt 17pt 18pt 19pt 20pt 21pt 24pt 28pt 32pt 36pt";
        return $initArray;
    }
    add_filter( 'tiny_mce_before_init', 'themewpdotvn_mce_text_sizes', 99 );
}

// Remove Parent Category from Child Category URL
add_filter('term_link', 'devvn_no_category_parents', 1000, 3);
function devvn_no_category_parents($url, $term, $taxonomy) {
    if($taxonomy == 'category'){
        $term_nicename = $term->slug;
        $url = trailingslashit(get_option( 'home' )) . user_trailingslashit( $term_nicename, 'category' );
    }
    return $url;
}
// Rewrite url mới
function devvn_no_category_parents_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'category',
        'post_type' => 'post',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        foreach ($terms as $term){
            $term_slug = $term->slug;
            add_rewrite_rule($term_slug.'/?$', 'index.php?category_name='.$term_slug,'top');
            add_rewrite_rule($term_slug.'/page/([0-9]{1,})/?$', 'index.php?category_name='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($term_slug.'/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_no_category_parents_rewrite_rules');
 
/*Sửa lỗi khi tạo mới category bị 404*/
function devvn_new_category_edit_success() {
    devvn_no_category_parents_rewrite_rules(true);
}
add_action('created_category','devvn_new_category_edit_success');
add_action('edited_category','devvn_new_category_edit_success');
add_action('delete_category','devvn_new_category_edit_success');

/*
 * Chống spam cho contact form 7 bằng định dạng số điện thoại
 * Author: levantoan.com
 * */
add_filter('wpcf7_validate_tel*', 'devvn_custom_validate_sdt', 10, 2);
function devvn_custom_validate_sdt($result, $tag) {
    $name = $tag->name;
    if ($name === 'so-dien-thoai') {
        $sdt = isset($_POST[$name]) ? wp_unslash($_POST[$name]) : '';
        if (!preg_match('/^0([0-9]{9,10})+$/D', $sdt)) {
            $result->invalidate($tag, 'Số điện thoại không hợp lệ.');
        }
    }
    return $result;
}

/*
* Code sửa lỗi link zalo.me/{sđt}
* Author: levantoan.com
*/
add_action('wp_footer', 'devvn_fix_zalome', 999999);
function devvn_fix_zalome(){
    ?>
    <script>
        var zalo_acc = { 
            "0983399866" : "sssssss"
        };
        function devvnCheckLinkAvailability(link, successCallback, errorCallback) {
            var hiddenIframe = document.querySelector("#hiddenIframe");
            if (!hiddenIframe) {
                hiddenIframe = document.createElement("iframe");
                hiddenIframe.id = "hiddenIframe";
                hiddenIframe.style.display = "none";
                document.body.appendChild(hiddenIframe);
            }
            var timeout = setTimeout(function () {
                errorCallback("Link is not supported.");
                window.removeEventListener("blur", handleBlur);
            }, 2500);
            var result = {};
            function handleMouseMove(event) {
                if (!result.x) {
                    result = {
                        x: event.clientX,
                        y: event.clientY,
                    };
                }
            }
            function handleBlur() {
                clearTimeout(timeout);
                window.addEventListener("mousemove", handleMouseMove);
            }
            window.addEventListener("blur", handleBlur);
            window.addEventListener(
                "focus",
                function onFocus() {
                    setTimeout(function () {
                        if (document.hasFocus()) {
                            successCallback(function (pos) {
                                if (!pos.x) {
                                    return true;
                                }
                                var screenWidth =
                                    window.innerWidth ||
                                    document.documentElement.clientWidth ||
                                    document.body.clientWidth;
                                var alertWidth = 300;
                                var alertHeight = 100;
                                var isXInRange =
                                    pos.x - 100 < 0.5 * (screenWidth + alertWidth) &&
                                    pos.x + 100 > 0.5 * (screenWidth + alertWidth);
                                var isYInRange =
                                    pos.y - 40 < alertHeight && pos.y + 40 > alertHeight;
                                return isXInRange && isYInRange
                                    ? "Link can be opened."
                                    : "Link is not supported.";
                            }(result));
                        } else {
                            successCallback("Link can be opened.");
                        }
                        window.removeEventListener("focus", onFocus);
                        window.removeEventListener("blur", handleBlur);
                        window.removeEventListener("mousemove", handleMouseMove);
                    }, 500);
                },
                { once: true }
            );
            hiddenIframe.contentWindow.location.href = link;
        }
        Object.keys(zalo_acc).map(function(sdt, index) {
            let qrcode = zalo_acc[sdt];
            const zaloLinks = document.querySelectorAll('a[href*="zalo.me/'+sdt+'"]');
            zaloLinks.forEach((zalo) => {
                zalo.addEventListener("click", (event) => {
                    event.preventDefault();
                    const userAgent = navigator.userAgent.toLowerCase();
                    const isIOS = /iphone|ipad|ipod/.test(userAgent);
                    const isAndroid = /android/.test(userAgent);
                    let redirectURL = null;
                    if (isIOS) {
                        redirectURL = 'zalo://qr/p/'+qrcode;
                        window.location.href = redirectURL;
                    } else if (isAndroid) {
                        redirectURL = 'zalo://zaloapp.com/qr/p/'+qrcode;
                        window.location.href = redirectURL;
                    } else {
                        redirectURL = 'zalo://conversation?phone='+sdt;
                        zalo.classList.add("zalo_loading");
                        devvnCheckLinkAvailability(
                            redirectURL,
                            function (result) {
                                zalo.classList.remove("zalo_loading");
                            },
                            function (error) {
                                zalo.classList.remove("zalo_loading");
                                redirectURL = 'https://chat.zalo.me/?phone='+sdt;
                                window.location.href = redirectURL;
                            }
                        );
                    }
                });
            });
        });
        //Thêm css vào site để lúc ấn trên pc trong lúc chờ check chuyển hướng sẽ không ấn vào thẻ a đó được nữa
        var styleElement = document.createElement("style");
        var cssCode = ".zalo_loading { pointer-events: none; }";
        styleElement.innerHTML = cssCode;
        document.head.appendChild(styleElement);
    </script>
    <?php
}