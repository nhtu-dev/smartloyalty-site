<?php
add_action('widgets_init', 'register_widget_social');

function register_widget_social() {
    register_widget('Gtid_Social_Widget');
}

class Gtid_Social_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'social',
            __( 'Social', 'shtheme' ),
            array(
                'description'  =>  __( 'Display information social', 'shtheme' )
            )
        );
        
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;

        if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
        global $sh_option;
        ?>
            <ul>
                <?php
                if( $sh_option['social-facebook'] ) {
                    echo '<li class="icon_social icon_facebook"><a title="Facebook" href="'. $sh_option['social-facebook'] .'" rel="nofollow" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
                }
                if( $sh_option['social-twitter'] ) {
                    echo '<li class="icon_social icon_twitter"><a title="Twitter" href="'. $sh_option['social-twitter'] .'" rel="nofollow" target="_blank"><i class="fab fa-twitter"></i></a></li>';
                }
                if( $sh_option['social-google'] ) {
                    echo '<li class="icon_social icon_google"><a title="Google Plus" href="'. $sh_option['social-google'] .'" rel="nofollow" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>';
                }
                if( $sh_option['social-youtube'] ) {
                    echo '<li class="icon_social icon_youtube"><a title="Youtube" href="'. $sh_option['social-youtube'] .'" rel="nofollow" target="_blank"><i class="fab fa-youtube"></i></a></li>';
                }
                if( $sh_option['social-linkedin'] ) {
                    echo '<li class="icon_social icon_linkedin"><a title="Linkedin" href="'. $sh_option['social-linkedin'] .'" rel="nofollow" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>';
                }
                if( $sh_option['social-pinterest'] ) {
                    echo '<li class="icon_social icon_pinterest"><a title="Pinterest" href="'. $sh_option['social-pinterest'] .'" rel="nofollow" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>';
                }
                if( $sh_option['social-instagram'] ) {
                    echo '<li class="icon_social icon_instagram"><a title="Instagram" href="'. $sh_option['social-instagram'] .'" rel="nofollow" target="_blank"><i class="fab fa-instagram"></i></a></li>';
                }
                ?>
            </ul>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args(
            (array)$instance, array(
                // 'title'             => '', 
                // 'numpro'            => '3',  
                // 'cat'               => '',
            )
        );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'shtheme' ); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>
        <?php _e('<p>This widget content is displayed from <strong>Theme Options -> Social</strong></p>');?>
    <?php
    }

}
