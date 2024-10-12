<?php
if (!defined('ABSPATH')) {
    die('-1');
}

$theme_color2 = gt3_option("theme-custom-color2");

if (function_exists('vc_map')) {
    // Add list item
    vc_map(array(
        "name"            => esc_html__("Link Layer", 'oconnor'),
        "base"            => "gt3_link_layer",
        "class"           => "gt3_link_layer",
        "category"        => esc_html__('GT3 Modules', 'oconnor'),
        "icon"            => 'gt3_icon',
        "content_element" => true,
        "as_parent"       => array('except' => ''),
        'js_view'         => 'VcColumnView',
        "description"     => esc_html__("Link Layer", 'oconnor'),
        "params"          => array(
            array(
                "type"        => "vc_link",
                "heading"     => esc_html__('URL (Link)', 'oconnor'),
                "param_name"  => "link",
                'description' => esc_html__('Add link to button', 'oconnor'),
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Layer Height", 'oconnor'),
                "param_name"  => "height",
                'value'       => '180',
                "description" => esc_html__("Enter height for Link Layer in px.", 'oconnor')
            ),
            array(
                'type'       => 'gt3_custom_select',
                'heading'    => esc_html__('Content Position', 'oconnor'),
                'param_name' => 'flex_position',
                'std'        => 'middle',
                'options'    => array(
                    esc_html__("Top", 'oconnor')    => 'top',
                    esc_html__("Middle", 'oconnor') => 'middle',
                    esc_html__("Bottom", 'oconnor') => 'bottom',
                ),
            ),

            vc_map_add_css_animation(true),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Extra Class", 'oconnor'),
                "param_name"  => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            ),
            // --- Style GROUP --- //
            array(
                'type'             => 'css_editor',
                'param_name'       => 'css',
                'group'            => esc_html__('Style', 'oconnor'),
                'edit_field_class' => 'wpb_el_type_vc_link'
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Use custom Link Layer style?', 'oconnor'),
                'param_name' => 'link_custom_style',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                "group"      => esc_html__("Style", 'oconnor'),
                'std'        => 'no',
            ),
            // Link Bg
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Background", 'oconnor'),
                "param_name"       => "link_bg_color",
                "value"            => esc_attr($theme_color2),
                "description"      => esc_html__("Select custom background for Link Layer.", 'oconnor'),
                'save_always'      => true,
                'dependency'       => array(
                    'element' => 'link_custom_style',
                    'value'   => 'yes',
                ),
                "group"            => esc_html__("Style", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Link Hover Bg
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Link Layer Hover Background", 'oconnor'),
                "param_name"       => "link_bg_color_hover",
                "value"            => "",
                "description"      => esc_html__("Select custom background for hover Link Layer.", 'oconnor'),
                'dependency'       => array(
                    'element' => 'link_custom_style',
                    'value'   => 'yes',
                ),
                "group"            => esc_html__("Style", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Link border-color
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Link Layer Border Color", 'oconnor'),
                "param_name"       => "link_border_color",
                "value"            => esc_attr($theme_color2),
                "description"      => esc_html__("Select custom border color for Link Layer.", 'oconnor'),
                'save_always'      => true,
                'dependency'       => array(
                    'element' => 'link_custom_style',
                    'value'   => 'yes',
                ),
                "group"            => esc_html__("Style", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Link Hover border-color
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Link Layer Hover Border Color", 'oconnor'),
                "param_name"       => "link_border_color_hover",
                "value"            => '#e8e8e8',
                "description"      => esc_html__("Select custom border color for hover Link Layer.", 'oconnor'),
                "group"            => esc_html__("Style", 'oconnor'),
                'save_always'      => true,
                'dependency'       => array(
                    'element' => 'link_custom_style',
                    'value'   => 'yes',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),

            // GT3 Animation
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Use GT3 Hover Animation?', 'oconnor'),
                'param_name' => 'custom_animation',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                "group"      => esc_html__("Style", 'oconnor'),
                'std'        => 'no',
                'dependency'       => array(
                    'element' => 'link_custom_style',
                    'value'   => 'yes',
                ),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_link_layer extends WPBakeryShortCodesContainer {

        }
    }
}
