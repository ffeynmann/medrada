<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Countdown", 'oconnor'),
        "base" => "gt3_countdown",
        "class" => "gt3_countdown",
        "category" => esc_html__('GT3 Modules', 'oconnor'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Countdown",'oconnor'),
        "params" => array(
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Countdown Date:", 'oconnor'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Year", 'oconnor'),
                "param_name" => "countdown_year",
                "description" => esc_html__("Enter year EX.: 2017", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-2',
            ),
             array(
                "type" => "textfield",
                "heading" => esc_html__("Month", 'oconnor'),
                "param_name" => "countdown_month",
                "description" => esc_html__("Enter month EX.: 08", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-2',
            ),
              array(
                "type" => "textfield",
                "heading" => esc_html__("Day", 'oconnor'),
                "param_name" => "countdown_day",
                "description" => esc_html__("Enter day EX.: 20", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-2',
            ),
                array(
                "type" => "textfield",
                "heading" => esc_html__("Hours", 'oconnor'),
                "param_name" => "countdown_hours",
                "description" => esc_html__("Enter hours EX.: 13", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-2',
            ),
              array(
                "type" => "textfield",
                "heading" => esc_html__("Minutes", 'oconnor'),
                "param_name" => "countdown_min",
                "description" => esc_html__("Enter min. EX.: 24", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Countdown Show:", 'oconnor'),
                "param_name"    => "backend_divider",
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Show Days?', 'oconnor' ),
                'param_name' => 'show_day',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'edit_field_class' => 'vc_col-sm-3',
                'std' => 'yes'
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Show Hours?', 'oconnor' ),
                'param_name' => 'show_hours',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'edit_field_class' => 'vc_col-sm-3',
                'std' => 'yes'
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Show Minutes?', 'oconnor' ),
                'param_name' => 'show_minutes',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'edit_field_class' => 'vc_col-sm-3',
                'std' => 'yes'
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Show Seconds?', 'oconnor' ),
                'param_name' => 'show_seconds',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'edit_field_class' => 'vc_col-sm-3',
                'std' => 'yes'
            ),
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Countdown Style:", 'oconnor'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => 'gt3_custom_select',
                "class" => "",
                "heading" => esc_html__("Size", 'oconnor'),
                "param_name" => "size",
                'options' => array(
                    esc_html__("Small",'oconnor') => "small",
                    esc_html__("Medium",'oconnor') => "medium",
                    esc_html__("Large",'oconnor') => "large",
                    esc_html__("Extra Large",'oconnor') => "e_large",
                ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'gt3_custom_select',
                'heading' => esc_html__( 'Align', 'oconnor' ),
                'param_name' => 'align',
                'options'         => array(
                    esc_html__( 'left', 'oconnor' ) => 'left',
                    esc_html__( 'center', 'oconnor' ) => 'center',
                    esc_html__( 'right', 'oconnor' ) => 'right',
                ),
                'std' => 'center',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Use Box Shadow?', 'oconnor' ),
                'param_name' => 'box_shadow',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'edit_field_class' => 'vc_col-sm-6',
                'std' => 'yes'
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Activate Vertical style?', 'oconnor' ),
                'param_name' => 'vertical_style',
                'edit_field_class' => 'vc_col-sm-6',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std' => 'yes'
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Countdown Background", 'oconnor'),
                "param_name" => "counter_bg",
                "value" => "#ffffff",
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Counter Value Color", 'oconnor'),
                "param_name" => "color",
                "value" => "#27323d",
                "description" => esc_html__("Select color for this item.", 'oconnor'),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_gt3_countdown extends WPBakeryShortCode {


        }
    }
}