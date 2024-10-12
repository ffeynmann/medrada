<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Image Box", 'oconnor'),
        "base" => "gt3_image_box",
        "class" => "gt3_image_box",
        "category" => esc_html__('GT3 Modules', 'oconnor'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Image Box",'oconnor'),
        "params" => array(
            // Image selection
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'oconnor' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'oconnor' ),
            ),
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Image Position', 'oconnor' ),
                "param_name"    => "image_position",
                'options'         => array(
                    esc_html__( 'Top', 'oconnor' )               => 'top',
                    esc_html__( 'Left', 'oconnor' )              => 'left',
                    esc_html__( 'Right', 'oconnor' )             => 'right'
                ),
                'save_always' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Heading", 'oconnor'),
                "param_name" => "heading",
                "description" => esc_html__("Enter text for heading line.", 'oconnor'),
                'admin_label' => true,
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Text", 'oconnor'),
                "param_name" => "text",
                "description" => esc_html__("Enter text.", 'oconnor')
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Link', 'oconnor' ),
                "param_name"    => "url",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Link Text', 'oconnor' ),
                "param_name"    => "url_text",
            ),
            array(
                "type"          => "gt3_on_off",
                "heading"       => esc_html__( 'Open in New Tab', 'oconnor' ),
                "param_name"    => "new_tab",
                'save_always' => true,
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std' => 'no',
            ),
            array(
                "type"          => "gt3_on_off",
                "heading"       => esc_html__( 'Add divider after Heading', 'oconnor' ),
                "param_name"    => "add_divider",
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std' => 'no',
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Divider Color', 'oconnor' ),
                "param_name"    => "divider_color",
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'add_divider',
                    'value' => "yes",
                ),
            ),
            vc_map_add_css_animation( true ),
            // Styling
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Title Tag', 'oconnor' ),
                "param_name"    => "title_tag",
                'options'       => array(
                    esc_html__( 'H2', 'oconnor' )    => 'h2',
                    esc_html__( 'H3', 'oconnor' )    => 'h3',
                    esc_html__( 'H4', 'oconnor' )    => 'h4',
                    esc_html__( 'H5', 'oconnor' )    => 'h5',
                    esc_html__( 'H6', 'oconnor' )    => 'h6',
                ),
                'std'           => 'h2',
                'save_always'   => true,
                "group"         => esc_html__( "Styling", 'oconnor' ),
            ),
            // Image Box title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Box Title Font Size', 'oconnor'),
                'param_name' => 'imagebox_title_size',
                'value' => '28',
                'description' => esc_html__( 'Enter Image Box title font-size in pixels.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Imagebox Title Fonts
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Use theme default font family for imagebox title?', 'oconnor' ),
                'param_name' => 'use_theme_fonts_imagebox_title',
                'value' => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_imagebox_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_imagebox_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'oconnor' ),
            ),
            // Image Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Box Content Font Size', 'oconnor'),
                'param_name' => 'imagebox_content_size',
                'value' => '16',
                'description' => esc_html__( 'Enter Image Box content font-size in pixels.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Imagebox content Fonts
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Use theme default font family for imagebox content?', 'oconnor' ),
                'param_name' => 'use_theme_fonts_imagebox_content',
                'value' => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_imagebox_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_imagebox_content',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'oconnor' ),
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Title Color', 'oconnor' ),
                "param_name"    => "title_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr($header_font['color']),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Text Color', 'oconnor' ),
                "param_name"    => "text_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr($main_font['color']),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Link Color', 'oconnor' ),
                "param_name"    => "link_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Link Hover Color', 'oconnor' ),
                "param_name"    => "link_hover_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr($header_font['color']),
                'save_always' => true,
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_image_box extends WPBakeryShortCode {

        }
    }
}
