<?php
add_action('widgets_init', 'register_widget_slider_products');

function register_widget_slider_products() {
    register_widget('Gtid_Products_Vertical_Widget');
}

class Gtid_Products_Vertical_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'slider_products',
            __( 'Products Slider', 'shtheme' ),
            array(
                'description'  => __( 'Display slide list product', 'shtheme' )
            )
        );
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;

        if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
        ?>
        <div class="slider-products">
            <ul class="slick-carousel list-products" 
                data-item="<?php echo $instance['numpro'];?>" 
                data-item_lg="3" 
                data-item_md="2" 
                data-item_sm="2" 
                data-item_mb="1" 
                data-row="1" 
                data-dots="true" 
                data-arrows="false" 
                data-vertical="<?php echo $instance['type_slider'];?>">
                <?php
                $args   = array(
                    'post_type'         => 'product',
                    'tax_query'         => array(
                        array(
                            'taxonomy'  => 'product_cat',
                            'field'     => 'id',
                            'terms'     => $instance['cat'],
                        )
                    ),
                    'posts_per_page'    => 10,
                );
                $the_query = new WP_Query($args);
                while($the_query->have_posts()):
                $the_query->the_post();
                ?>
                    <div id="post-<?php the_ID(); ?>" class="item-product-slide">
                        <a class="<?php echo $instance['image_alignment'];?>" href="<?php the_permalink();?>" title="<?php the_title();?>">
                            <div class="text-center">
                                <?php if( has_post_thumbnail() ) : echo '<img data-lazy="'. get_the_post_thumbnail_url( get_the_ID(), $instance['image_size'] ) .'"/>';endif;?>
                            </div>
                        </a>
                        <h3>
                            <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                                <?php the_title();?>
                            </a>
                        </h3>
                        <?php get_price_product();?>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata(); ?>
            </ul>
        </div>
 
        <?php
        wp_enqueue_script( 'slick-js' );
        wp_enqueue_style( 'slick-style' );
        wp_enqueue_style( 'slick-theme-style' );
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args(
        	(array)$instance, array(
        		'title' 			=> '',
                'type_slider'       => '1', 
        		'numpro' 			=> '3',  
        		'cat' 				=> '',
                'image_alignment'   => 'alignleft',
                'image_size'        => 'thumbnail',
    		)
    	);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php  echo $this->get_field_name('title'); ?>" value="<?php  echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('type_slider'); ?>"><?php _e('Select type slider', 'shtheme'); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'type_slider' ); ?>" name="<?php echo $this->get_field_name( 'type_slider' ); ?>">
                <option value="true" <?php selected( 'true', $instance['type_slider'] ); ?>><?php _e('Vertical Slider','shtheme');?></option>
                <option value="false" <?php selected( 'false', $instance['type_slider'] ); ?>><?php _e('Horizontal Slider','shtheme');?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('numpro'); ?>"><?php _e('Enter the product number in the view', 'shtheme'); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'numpro' ); ?>" name="<?php echo $this->get_field_name( 'numpro' ); ?>">
                <option value="1" <?php selected( '1', $instance['numpro'] ); ?>>1</option>
                <option value="2" <?php selected( '2', $instance['numpro'] ); ?>>2</option>
                <option value="3" <?php selected( '3', $instance['numpro'] ); ?>>3</option>
                <option value="4" <?php selected( '4', $instance['numpro'] ); ?>>4</option>
                <option value="5" <?php selected( '5', $instance['numpro'] ); ?>>5</option>
                <option value="6" <?php selected( '6', $instance['numpro'] ); ?>>6</option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this-> get_field_id('cat'); ?>"><?php _e('Category','shtheme'); ?>:</label>
            <?php
            wp_dropdown_categories(array('name'=> $this->get_field_name('cat'),'selected'=>$instance['cat'],'orderby'=>'Name','hierarchical'=>1,'show_option_all'=>__('Select category','shtheme'),'hide_empty'=>'0', 'taxonomy' => 'product_cat'));
            ?>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_alignment' ); ?>"><?php _e( 'Image Alignment', 'shtheme' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'image_alignment' ); ?>" name="<?php echo $this->get_field_name( 'image_alignment' ); ?>">
                <option value="alignnone">- <?php _e( 'None', 'shtheme' ); ?> -</option>
                <option value="alignleft" <?php selected( 'alignleft', $instance['image_alignment'] ); ?>><?php _e( 'Left', 'shtheme' ); ?></option>
                <option value="alignright" <?php selected( 'alignright', $instance['image_alignment'] ); ?>><?php _e( 'Right', 'shtheme' ); ?></option>
                <option value="aligncenter" <?php selected( 'aligncenter', $instance['image_alignment'] ); ?>><?php _e( 'Center', 'shtheme' ); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php _e( 'Image Size', 'shtheme' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'image_size' ); ?>" class="" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
                <option value="thumbnail">thumbnail (<?php echo get_option( 'thumbnail_size_w' ); ?>x<?php echo get_option( 'thumbnail_size_h' ); ?>)</option>
                <?php
                $sizes = wp_get_additional_image_sizes();
                foreach( (array) $sizes as $name => $size )
                    echo '<option value="'.esc_attr( $name ).'" '.selected( $name, $instance['image_size'], FALSE ).'>'.esc_html( $name ).' ( '.$size['width'].'x'.$size['height'].' )</option>';
                ?>
            </select>
        </p>
    <?php
    }

}
