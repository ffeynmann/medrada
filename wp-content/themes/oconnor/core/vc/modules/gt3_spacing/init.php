<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}


if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Spacing", 'oconnor'),
        "base" => "gt3_spacing",
        "class" => "gt3_spacing",
        "category" => esc_html__('GT3 Modules', 'oconnor'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Spacing",'oconnor'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Height", 'oconnor'),
                "param_name" => "height",
                "description" => esc_html__("Enter empty space height", 'oconnor'),
                "value" => "32px",
                'save_always' => true,
                'admin_label' => true,
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Set Responsive Empty Space Height', 'oconnor' ),
                'param_name' => 'responsive_es',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Height for small Desktops', 'oconnor'),
                'param_name' => 'height_size_sm_desktop',
                'description' => esc_html__( 'Enter height in pixels.', 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_es',
                    "value" => "yes"
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Height for Tablets', 'oconnor'),
                'param_name' => 'height_tablet',
                'description' => esc_html__( 'Enter height in pixels.', 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_es',
                    "value" => "yes"
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Height for Mobile', 'oconnor'),
                'param_name' => 'height_mobile',
                'description' => esc_html__( 'Enter height in pixels.', 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_es',
                    "value" => "yes"
                ),
            ),

        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_spacing extends WPBakeryShortCode {

        }
    }
}
