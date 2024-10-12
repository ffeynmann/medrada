<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if (function_exists('vc_map')) {
	vc_map(array(
		'name' 				=> esc_html__( 'GT3 Carousel Thumbnails', 'oconnor' ),
		'description' 		=> esc_html__( 'One slide per page with thumbnails', 'oconnor' ),
		'category' 			=> esc_html__('GT3 Modules', 'oconnor'),
		'base' 				=> 'gt3_carousel_thumbnails',
		'class' 			=> 'gt3_carousel_thumbnails',
		'icon' 				=> 'gt3_icon',
        'show_settings_on_create' => true,
        'is_container'      => true,
        'as_parent'         => array('only' => 'gt3_carousel_thumbnails_item'),
		'content_element'   => true,
        'js_view'           => 'VcColumnView',
		'params'            => array(
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Autoplay carousel', 'oconnor' ),
                'param_name'        => 'autoplay_carousel',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => 'yes',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__( 'Slider speed', 'oconnor' ),
                'param_name'        => 'slider_speed',
                'value'             => '3000',
                'description'       => esc_html__( 'Enter autoplay time in milliseconds.', 'oconnor' ),
                'dependency'        => array(
                    'element'           => 'autoplay_carousel',
                    'value'             => array("yes"),
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Infinity Scroll', 'oconnor' ),
                'param_name'        => 'infinity_scroll',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => 'yes',
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'dropdown',
                'heading'           => esc_html__( 'Animation', 'oconnor' ),
                'param_name'        => 'animation',
                'value'             => array(
                    esc_html__("Slide", 'oconnor') => 'slide',
                    esc_html__("Fade", 'oconnor')  => 'fade',
                ),
                'std'               => 'slide',
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__( 'Thumbnail width', 'oconnor' ),
                'param_name'        => 'dots_image_width',
                'value'             => '130',
                'description'       => esc_html__( 'Enter width in px.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__( 'Thumbnail height', 'oconnor' ),
                'param_name'        => 'dots_image_height',
                'value'             => '105',
                'description'       => esc_html__( 'Enter height in px.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Hide prev/next buttons', 'oconnor' ),
                'param_name'        => 'use_prev_next',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => 'not',
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Adaptive Height', 'oconnor' ),
                'param_name'        => 'adaptive_height',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => 'not',
            ),
            array(
                "type"              => "textfield",
                "heading"           => esc_html__("Extra Class", 'oconnor'),
                "param_name"        => "el_class",
                "description"       => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            ),
            array(
                'type'              => 'css_editor',
                'param_name'        => 'css',
                'group'             => esc_html__( 'Design Option', 'oconnor' ),
            ),
        ),
		'default_content' => '
[gt3_carousel_thumbnails_item][vc_row_inner][vc_column_inner width="1/4"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image img_size="full" alignment="center"][/vc_column_inner][vc_column_inner width="1/4"][/vc_column_inner][/vc_row_inner][/gt3_carousel_thumbnails_item]
[gt3_carousel_thumbnails_item][vc_row_inner][vc_column_inner width="1/4"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image img_size="full" alignment="center"][/vc_column_inner][vc_column_inner width="1/4"][/vc_column_inner][/vc_row_inner][/gt3_carousel_thumbnails_item]
		',
	));

    // Testimonial item options
    vc_map(array(
        'name'                  => esc_html__('GT3 Slide', 'oconnor'),
        'base'                  => 'gt3_carousel_thumbnails_item',
        'class'                 => 'gt3_carousel_thumbnails_item',
        'category'              => esc_html__('GT3 Modules', 'oconnor'),
        'icon'                  => 'gt3_icon',
        'content_element'       => true,
        'show_settings_on_create' => true,
        'as_child'              => array('only' => 'gt3_carousel_thumbnails'),
        'as_parent'             => array('only' => 'vc_row_inner'),
        'js_view'               => 'VcColumnView',
        'params'                => array(
            // Image Section
            array(
                'type'              => 'attach_image',
                'heading'           => esc_html__( 'Image Thumbnail for This Slide', 'oconnor' ),
                'param_name'        => 'image_current',
                'value'             => '',
                'admin_label'       => true,
            ),
        ),
		'default_content' => '
[vc_row_inner][vc_column_inner width="1/4"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image img_size="full" alignment="center"][/vc_column_inner][vc_column_inner width="1/4"][/vc_column_inner][/vc_row_inner]
		',
    ));

	if (class_exists('WPBakeryShortCodesContainer')) {
		class WPBakeryShortCode_Gt3_Carousel_Thumbnails extends WPBakeryShortCodesContainer { }
	} 
    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Carousel_Thumbnails_Item extends WPBakeryShortCodesContainer { }
    }
}