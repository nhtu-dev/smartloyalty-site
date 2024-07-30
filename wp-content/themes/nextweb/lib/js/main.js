jQuery(document).ready(function(){
 
    /* Backtop
     ---------------------------------------------------------------*/
    jQuery("#back-top").hide();
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 100) {
            jQuery('#back-top').fadeIn(100);
        } else {
            jQuery('#back-top').fadeOut(100);
        }
    });
    jQuery('#back-top a').click(function () {
        jQuery('body,html').animate( { scrollTop: 0 }, 800 );
        return false;
    });
jQuery(window).scroll(function(){
        if (jQuery(window).scrollTop() > 150)
        {
        jQuery('.header-main').addClass('header-sticky');
        }
        else
        {
        jQuery('.header-main').removeClass('header-sticky');
        }
        });
    /* Slick Slider
     ---------------------------------------------------------------*/
    if ( jQuery().slick ) {
        var slick = jQuery(".slick-carousel");
        slick.each(function(){
            var item        = jQuery(this).data('item'),
                item_lg     = jQuery(this).data('item_lg'),
                item_md     = jQuery(this).data('item_md'),
                item_sm     = jQuery(this).data('item_sm'),
                item_mb     = jQuery(this).data('item_mb'),
                row         = jQuery(this).data('row'),
                arrows      = jQuery(this).data('arrows'),
                dots        = jQuery(this).data('dots'),
                vertical    = jQuery(this).data('vertical');
            jQuery(this).slick({
                autoplay: true,
                dots: dots,
                arrows: arrows,
                infinite: true,
                autoplaySpeed: 2000,
                vertical: vertical,
                slidesToShow: item,
                slidesToScroll: 1,
                lazyLoad: 'ondemand',
                // verticalSwiping: true,
                rows: row,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: item_lg,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: item_md,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: item_sm,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: item_mb,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        });
    }

    /* Mobile Menu
     ---------------------------------------------------------------*/
    jQuery('#showmenu').click(function(){
        jQuery('#mobilenav').toggleClass('opened');
        jQuery('.panel-overlay').toggleClass('active');
        jQuery('.hamburger',this).toggleClass('is-active');
    });

    jQuery('.panel-overlay').click(function(){
        jQuery('#mobilenav').toggleClass('opened');
        jQuery(this).removeClass('active');
        jQuery('#showmenu .hamburger').removeClass('is-active');
    });

    jQuery('.menu_close').click(function(){
        jQuery('#mobilenav').toggleClass('opened');
        jQuery('.panel-overlay').removeClass('active');
        jQuery('#showmenu .hamburger').removeClass('is-active');
    });

    jQuery("#mobilenav ul.sub-menu").before('<span class="arrow"></span>');

    jQuery("body").on('click','#mobilenav .arrow', function(){
        jQuery(this).parent('li').toggleClass('open');
        jQuery(this).parent('li').find('ul.sub-menu').first().slideToggle( "normal" );
    });

    /* Disable autocomplete
     ---------------------------------------------------------------*/
    jQuery('input').attr('autocomplete', 'off');

});