<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name'              => esc_html__('GT3 Carousel', 'oconnor'),
        'description'       => esc_html__("Display carousel", 'oconnor'),
        'category'          => esc_html__('GT3 Modules', 'oconnor'),
        'base'              => 'gt3_carousel',
        'class'             => 'gt3_carousel_module',
        'icon'              => 'gt3_icon',
        'show_settings_on_create' => true,
        'is_container'      => true,
        'as_parent'         => array('only' => 'gt3_counter, gt3_button, vc_column_text, gt3_price_block, vc_single_image, vc_tta_tabs, vc_tta_tour, vc_tta_accordion, vc_gallery, vc_message, vc_row, gt3_testimonials'),
        'as_parent'         => array('only' => 'vc_row'),
        'content_element'   => true,
        'js_view'           => 'VcColumnView',
        'params'            => array(
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Items Per Line', 'oconnor'),
                'param_name'        => 'posts_per_line',
                'admin_label'       => true,
                'options'             => array(
                    esc_html__("1", 'oconnor') => '1',
                    esc_html__("2", 'oconnor') => '2',
                    esc_html__("3", 'oconnor') => '3',
                    esc_html__("4", 'oconnor') => '4',
                    esc_html__("5", 'oconnor') => '5',
                    esc_html__("6", 'oconnor') => '6',
                )
            ),
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
                'heading'           => esc_html__( 'One slide per scroll', 'oconnor' ),
                'param_name'        => 'scroll_items',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'              => 'no',
                'dependency'        => array(
                    'element'            => 'posts_per_line',
                    'value_not_equal_to' => array("1"),
                ),
                'edit_field_class'  => 'vc_col-sm-12',
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
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__( 'Animation', 'oconnor' ),
                'param_name'        => 'animation',
                'options'             => array(
                    esc_html__("Slide", 'oconnor') => 'slide',
                    esc_html__("Fade", 'oconnor')  => 'fade',
                ),
                'std'               => 'slide',
                'edit_field_class'  => 'vc_col-sm-12',
                'dependency'        => array(
                    'element'           => 'posts_per_line',
                    'value'             => array("1"),
                ),
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__( 'Carousel control', 'oconnor' ),
                'param_name'        => 'use_pagination',
                'options'             => array(
                    esc_html__("None", 'oconnor')    => 'none',
                    esc_html__("Dots", 'oconnor')    => 'dots',
                    esc_html__("Numeric", 'oconnor') => 'num',
                ),
                'edit_field_class'  => 'vc_col-sm-12',
                'std'               => 'dots',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Set Numeric control buttons outside the module', 'oconnor' ),
                'param_name'        => 'pagination_outside',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'              => 'no',
                'edit_field_class'  => 'vc_col-sm-12',
                'dependency'        => array(
                    'element'           => 'use_pagination',
                    'value'             => 'num',
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Show prev/next buttons', 'oconnor' ),
                'param_name'        => 'use_prev_next',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => 'no',
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Adaptive Height for each slide', 'oconnor' ),
                'param_name'        => 'adaptive_height',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => 'no',
                'dependency'        => array(
                    'element'           => 'posts_per_line',
                    'value'             => array("1"),
                ),
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
[vc_row_inner][vc_column_inner][/vc_column_inner][/vc_row_inner]
[vc_row_inner][vc_column_inner][/vc_column_inner][/vc_row_inner]
        ',
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_carousel extends WPBakeryShortCodesContainer
        {
        }
    }
}