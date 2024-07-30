<?php
add_shortcode('wtb_infobox', 'wtb_shortcode_infobox');
add_action('vc_build_admin_page', 'wtb_load_infobox_shortcode');
add_action('vc_after_init', 'wtb_load_infobox_shortcode');

function wtb_shortcode_infobox($atts, $content = null) {
    ob_start();
    if ($template = wtb_shortcode_template('wtb_infobox'))
        include $template;
    return ob_get_clean();
}

function wtb_load_infobox_shortcode() {
    $custom_class       = wtb_vc_custom_class();

    vc_map( array(
        'name'          => "Web3B " . esc_html__('Infobox', 'shtheme'),
        'base'          => 'wtb_infobox',
        'description'   => esc_html__('Show infobox width heading, image and content', 'shtheme'),
        'category'      => esc_html__('Web3B', 'shtheme'),
        'icon'		    => get_template_directory_uri() . "/inc/vc_shortcode/assets/images/logo.svg",
        'weight'        => - 50,
        'params'        => array(
            // Position the icon box
            array(
                "type" 			=> "dropdown",
                "class" 		=> "",
                "heading" 		=> __("Box Style", "shtheme"),
                "param_name" 	=> "pos",
                'std'           => 1,
                "value" => array(
                    __("Icon at Left with heading","shtheme") => "default",
                    __("Icon at Right with heading","shtheme") => "heading-right",
                    __("Icon at Left","shtheme") => "left",
                    __("Icon at Right","shtheme") => "right",
                    __("Icon at Top","shtheme") => "top",
                ),
                "description" 	=> __("Select icon position. Icon box style will be changed according to the icon position.", "shtheme")
            ),
            array(
                "type" 			=> "attach_image",
                "class" 		=> "",
                "heading" 		=> __("Upload Image Icon:", "shtheme"),
                "param_name" 	=> "icon_img",
                "value" 		=> "",
                "description" 	=> __("Upload the custom image icon.", "shtheme"),
            ),
            array(
                "type" 			=> "wtb_vc_slider_type_field",
                "class" 		=> "",
                "heading" 		=> __("Image Width (px)", "shtheme"),
                "param_name" 	=> "img_width",
                "value" 		=> 48,
                "description" 	=> __("Provide image width (px)", "shtheme"),
            ),
            // Icon Box Heading
            array(
                "type" 			=> "textfield",
                "class" 		=> "",
                "heading" 		=> __("Title", "shtheme"),
                "param_name" 	=> "title",
                "admin_label" 	=> true,
                "value" 		=> "",
                "description" 	=> __("Provide the title for this icon box.", "shtheme"),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                "type" 			=> "dropdown",
                "heading" 		=> __("Tag","shtheme"),
                "param_name" 	=> "heading_tag",
                'std'           => 1,
                "value" => array(
                    __("Default","shtheme") => "h3",
                    __("H1","shtheme") 	=> "h1",
                    __("H2","shtheme") 	=> "h2",
                    __("H4","shtheme") 	=> "h4",
                    __("H5","shtheme") 	=> "h5",
                    __("H6","shtheme") 	=> "h6",
                    __("Div","shtheme") => "div",
                    __("p","shtheme") 	=> "p",
                    __("span","shtheme") => "span",
                ),
                "description" 	=> __("Default is H3", "shtheme"),
                'edit_field_class' => 'vc_col-sm-4',
                // "group" => "Typography"
            ),
            array(
                "type" 			=> "textarea_html",
                "class" 		=> "",
                "heading" 		=> __("Description", "shtheme"),
                "param_name" 	=> "content",
                "value" 		=> "",
                "description" 	=> __("Provide the description for this icon box.", "shtheme"),
            ),
            // Select link option - to box or with read more text
            array(
                "type"          => "dropdown",
                "class"         => "",
                "heading"       => __("Apply link to:", "shtheme"),
                "param_name"    => "read_more",
                "value"         => array(
                    __("No Link","shtheme")             => "none",
                    __("Complete Box","shtheme")        => "box",
                    __("Box Title","shtheme")           => "title",
                    __("Display Read More","shtheme")   => "more",
                ),
                "description"   => __("Select whether to use color for icon or not.", "shtheme")
            ),
            // Add link to existing content or to another resource
            array(
                "type"          => "vc_link",
                "class"         => "",
                "heading"       => __("Add Link", "shtheme"),
                "param_name"    => "link",
                "value"         => "",
                "description"   => __("Add a custom link or select existing page. You can remove existing link as well.", "shtheme"),
                "dependency"    => Array("element" => "read_more", "value" => array("box","title","more")),
            ),
            // Link to traditional read more
            array(
                "type"          => "textfield",
                "class"         => "",
                "heading"       => __("Read More Text", "shtheme"),
                "param_name"    => "read_text",
                "value"         => "Read More",
                "description"   => __("Customize the read more text.", "shtheme"),
                "dependency"    => Array("element" => "read_more","value" => array("more")),
            ),
            $custom_class,
            array(
                'type'          => 'css_editor',
                'heading'       => esc_html__( 'CSS box', 'shtheme' ),
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design Options', 'shtheme' ),
            ),
        )
    ) );
}