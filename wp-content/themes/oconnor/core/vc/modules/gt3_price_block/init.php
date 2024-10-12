<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_price_block',
        'name' => esc_html__('Price Block', 'oconnor'),
        "description" => esc_html__("Create price table", 'oconnor'),
        'category' => esc_html__('GT3 Modules', 'oconnor'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Name / Title", 'oconnor'),
                "param_name" => "title",
                "description" => esc_html__("Enter title of price block.", 'oconnor')
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__("Header Background Image", 'oconnor'),
                "param_name" => "header_img",
                "description" => esc_html__("Select header background image.", 'oconnor')
            ),
            array(
                'type' => 'gt3_custom_select',
                'heading' => esc_html__('Active package', 'oconnor'),
                'param_name' => 'package_is_active',
                'admin_label' => true,
                'options' => array(
                    esc_html__("No", 'oconnor') => 'no',
                    esc_html__("Yes", 'oconnor') => 'yes',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Price", 'oconnor'),
                "param_name" => "price",
                "description" => esc_html__("Enter the price for this package. e.g. '157'", 'oconnor')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Price Prefix", 'oconnor'),
                "param_name" => "price_prefix",
                "description" => esc_html__("Enter the price prefix for this package. e.g. '$'", 'oconnor')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Suffix", 'oconnor'),
                "param_name" => "price_suffix",
                "description" => esc_html__("Enter the price suffix for this package. e.g. '/ person'", 'oconnor')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package description", 'oconnor'),
                "param_name" => "price_description",
                "description" => esc_html__("Enter the price block short description", 'oconnor')
            ),
            array(
                "type" => "vc_link",
                "heading" => esc_html__("Link", 'oconnor'),
                "param_name" => "button_link",
            ),
            array(
                "type" => "textarea_html",
                "heading" => esc_html__("Price field", 'oconnor'),
                "param_name" => "content",
            ),

            // General Params
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'oconnor'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'CSS box', 'oconnor' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design Options', 'oconnor' ),
                'edit_field_class' => '',
            ),
            // Price Title Fonts
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Use theme default font family for price table header?', 'oconnor' ),
                'param_name' => 'use_theme_fonts_price_header',
                'value' => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_price_header',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_price_header',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'oconnor' ),
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Use theme default font family for price table content?', 'oconnor' ),
                'param_name' => 'use_theme_fonts_price_content',
                'value' => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_price_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_price_content',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'oconnor' ),
            ),
            // Button COLOR
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Button color", 'oconnor'),
                "param_name" => "btn_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom color for button.", 'oconnor'),
                "group" => esc_html__( "Styling", 'oconnor' ),
            ),
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Use alternative button style?', 'oconnor' ),
                'param_name' => 'use_alt_button_style',
                'description' => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
            ),
        ),


    ));

    class WPBakeryShortCode_Gt3_Price_block extends WPBakeryShortCode { }

}