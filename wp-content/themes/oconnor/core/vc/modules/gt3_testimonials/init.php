<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base'                  => 'gt3_testimonials',
        'name'                  => esc_html__('Testimonials', 'oconnor'),
        'description'           => esc_html__('Display testimonials', 'oconnor'),
        'category'              => esc_html__('GT3 Modules', 'oconnor'),
        'icon'                  => 'gt3_icon',
        'js_view'               => 'VcColumnView',
        "as_parent"             => array('only' => 'gt3_testimonial_item'),
        "content_element"       => true,
        'show_settings_on_create' => false,
        'params'                => array(
            array(
                'type'              => 'gt3_dropdown',
                'class'             => '',
                'heading'           => esc_html__('Style select', 'oconnor'),
                'param_name'        => 'view_type',
                'fields'            => array(
                    'type1' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img1.png',
                        'descr' => esc_html__('Type 1', 'oconnor')),
                    'type2' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img2.png',
                        'descr' => esc_html__('Type 2', 'oconnor')),
                    'type3' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img3.png',
                        'descr' => esc_html__('Type 3', 'oconnor')),
                    'type4' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img4.png',
                        'descr' => esc_html__('Type 4', 'oconnor')),
                    'type5' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img5.png',
                        'descr' => esc_html__('Type 5', 'oconnor')),
                    'type6' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img6.png',
                        'descr' => esc_html__('Type 6', 'oconnor')),
                    'type7' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img7.png',
                        'descr' => esc_html__('Type 7', 'oconnor')),
                ),
                'value'             => 'type1',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use testimonials carousel?', 'oconnor' ),
                'param_name'        => 'use_carousel',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => 'yes',
                'dependency'        => array(
                    'element'            => 'view_type',
                    'value_not_equal_to' => array("type4"),
                ),
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__( 'Align', 'oconnor' ),
                'param_name'        => 'item_align',
                'options'             => array(
                    esc_html__("left", 'oconnor')   => 'left',
                    esc_html__("center", 'oconnor') => 'center',
                    esc_html__("right", 'oconnor')  => 'right',
                ),
                'std'               => 'center',
                'dependency'        => array(
                    'element'           => 'view_type',
                    'value'             => array("type4"),
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__( 'Autoplay time', 'oconnor' ),
                'param_name'        => 'auto_play_time',
                'value'             => '4000',
                'description'       => esc_html__( 'Enter autoplay time in milliseconds.', 'oconnor' ),
                'dependency'        => array(
                    'element'           => 'use_carousel',
                    "value"             => array("yes")
                )
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Items Per Line', 'oconnor'),
                'param_name'        => 'posts_per_line',
                'options'             => array(
                    esc_html__("1", 'oconnor') => '1',
                    esc_html__("2", 'oconnor') => '2',
                    esc_html__("3", 'oconnor') => '3',
                    esc_html__("4", 'oconnor') => '4',
                ),
                'std'               => '1',
                'dependency'        => array(
                    'element'            => 'view_type',
                    'value_not_equal_to' => array("type4","type7"),
                ),
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Pagination Position', 'oconnor'),
                'param_name'        => 'pagination_position',
                'options'             => array(
                    esc_html__("Left", 'oconnor')   => 'left',
                    esc_html__("Center", 'oconnor') => 'center',
                    esc_html__("Right", 'oconnor')  => 'right',
                ),
                'std'               => 'center',
                'dependency'        => array(
                    'element'            => 'view_type',
                    'value_not_equal_to' => array("type7"),
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                "type"              => "textfield",
                "heading"           => esc_html__("Extra Class", 'oconnor'),
                "param_name"        => "item_el_class",
                "description"       => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            ),

            array(
                "type"              => "colorpicker",
                "class"             => "",
                "heading"           => esc_html__("Background Color for Each Item", 'oconnor'),
                "param_name"        => "item_background_color",
                "value"             => "",
                "description"       => esc_html__("Select background color for each item.", 'oconnor'),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-12',
                'dependency'        => array(
                    'element'            => 'view_type',
                    'value_not_equal_to' => array("type4","type7"),
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Shadow for this Module?', 'oconnor' ),
                'param_name'        => 'shadow_module',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
                'edit_field_class'  => 'vc_col-sm-6',
                "group"             => esc_html__( "Styling", 'oconnor' ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Shadow for Each Item?', 'oconnor' ),
                'param_name'        => 'shadow_items',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
                'edit_field_class'  => 'vc_col-sm-6',
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'dependency'        => array(
                    'element'            => 'view_type',
                    'value_not_equal_to' => array("type4","type7"),
                ),
            ),

            array(
                "type"              => "backend_divider",
                "heading"           => "",
                "param_name"        => "backend_divider",
                "group"             => esc_html__( "Styling", 'oconnor' ),
            ),
            // Testimonials Text Font Size
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Testimonials Text Font Size', 'oconnor'),
                'param_name'        => 'testimonilas_text_size',
                'value'             => '24',
                'description'       => esc_html__( 'Enter testimonials text font-size in pixels.', 'oconnor' ),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Testimonials Text Line Height', 'oconnor'),
                'param_name'        => 'testimonilas_text_line_height',
                'value'             => '150',
                'description'       => esc_html__( 'Enter testimonials text line height in %.', 'oconnor' ),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            // Testimonials Text Fonts
            array(
                "type"              => "colorpicker",
                "class"             => "",
                "heading"           => esc_html__("Text Color", 'oconnor'),
                "param_name"        => "text_color",
                "value"             => "",
                "description"       => esc_html__("Select text color for this item.", 'oconnor'),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Text Align', 'oconnor'),
                'param_name'        => 'text_align',
                'options'             => array(
                    esc_html__("Left", 'oconnor')   => 'left',
                    esc_html__("Center", 'oconnor') => 'center',
                    esc_html__("Right", 'oconnor')  => 'right',
                ),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'std'               => 'center',
            ),

            array(
                "type"              => "backend_divider",
                "heading"           => "",
                "param_name"        => "backend_divider",
                "group"             => esc_html__( "Styling", 'oconnor' ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Testimonials Author Font Size', 'oconnor'),
                'param_name'        => 'testimonilas_author_size',
                'value'             => '18',
                'description'       => esc_html__( 'Enter testimonials author font-size in pixels.', 'oconnor' ),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Testimonials Author Line Height', 'oconnor'),
                'param_name'        => 'testimonilas_author_line_height',
                'value'             => '140',
                'description'       => esc_html__( 'Enter testimonials author line height in %.', 'oconnor' ),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                "type"              => "colorpicker",
                "class"             => "",
                "heading"           => esc_html__("Author Color", 'oconnor'),
                "param_name"        => "sign_color",
                "value"             => "",
                "description"       => esc_html__("Select sign color for this item.", 'oconnor'),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Author Align', 'oconnor'),
                'param_name'        => 'author_align',
                'options'             => array(
                    esc_html__("Left", 'oconnor')   => 'left',
                    esc_html__("Center", 'oconnor') => 'center',
                    esc_html__("Right", 'oconnor')  => 'right',
                ),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'std'               => 'center',
            ),

            array(
                "type"              => "backend_divider",
                "heading"           => "",
                "param_name"        => "backend_divider",
                "group"             => esc_html__( "Styling", 'oconnor' ),
            ),
            // Image setting section
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__( 'Image Width', 'oconnor' ),
                'param_name'        => 'img_width',
                'value'             => '80',
                'description'       => esc_html__( 'Enter image width in pixels.', 'oconnor' ),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__( 'Image Height', 'oconnor' ),
                'param_name'        => 'img_height',
                'value'             => '80',
                'description'       => esc_html__( 'Enter image height in pixels.', 'oconnor' ),
                "group"             => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Circular Images?', 'oconnor' ),
                'param_name'        => 'round_imgs',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => 'yes',
                "group"             => esc_html__( "Styling", 'oconnor' ),
            ),

            array(
                'type'          => 'css_editor',
                'param_name'    => 'css',
                'group'         => esc_html__( 'Design Option', 'oconnor' ),
            ),
        )
    ));

    // Testimonial item options
    vc_map(array(
        "name"                  => esc_html__("Testimonial item", 'oconnor'),
        "base"                  => "gt3_testimonial_item",
        "class"                 => "gt3_info_list",
        "category"              => esc_html__('GT3 Modules', 'oconnor'),
        'icon'                  => 'gt3_icon',
        "content_element"       => true,
        "as_child"              => array('only' => 'gt3_testimonials'),
        "params"                => array(
            array(
                "type"              => "textfield",
                "class"             => "",
                "heading"           => esc_html__("Author name", 'oconnor'),
                "param_name"        => "tstm_author",
                "value"             => "",
                "description"       => esc_html__("Provide a title for this list item.", 'oconnor'),
                'admin_label'       => true,
            ),
            array(
                "type"              => "textfield",
                "class"             => "",
                "heading"           => esc_html__("Author Position", 'oconnor'),
                "param_name"        => "tstm_author_position",
                "value"             => "",
                "description"       => esc_html__("Provide an author position for this list item.", 'oconnor'),
                'admin_label'       => true,
            ),
            // Image Section
            array(
                'type'              => 'attach_image',
                'heading'           => esc_html__( 'Image', 'oconnor' ),
                'param_name'        => 'image',
                'value'             => '',
                'description'       => esc_html__( 'Select image from media library.', 'oconnor' ),
                'admin_label'       => true,
            ),
            array(
                "type"              => "textarea_html",
                "class"             => "",
                "heading"           => esc_html__("Description", 'oconnor'),
                "param_name"        => "content",
                "value"             => "",
                "description"       => esc_html__("Description about this list item", 'oconnor')
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Select Rate', 'oconnor'),
                'param_name'        => 'select_rate',
                'options'             => array(
                    esc_html__("none", 'oconnor')  => 'none',
                    esc_html__("1", 'oconnor')     => '1',
                    esc_html__("2", 'oconnor')     => '2',
                    esc_html__("3", 'oconnor')     => '3',
                    esc_html__("4", 'oconnor')     => '4',
                    esc_html__("5", 'oconnor')     => '5',
                ),
            ),
            array(
                "type"              => "textfield",
                "heading"           => esc_html__("Extra Class", 'oconnor'),
                "param_name"        => "item_el_class",
                "description"       => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            )
        )
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Testimonials extends WPBakeryShortCodesContainer
        {
        }
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Testimonial_Item extends WPBakeryShortCode
        {
        }
    }
}