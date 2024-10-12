<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Process Bar", 'oconnor'),
        "base" => "gt3_process_bar",
        "class" => "gt3_process_bar",
        "category" => esc_html__('GT3 Modules', 'oconnor'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Process Bar",'oconnor'),
        "params" => array(
            // Icon Section
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Steps Count', 'oconnor' ),
                "param_name"    => "steps",
                'options'         => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ),
                'save_always' => true,
            ),
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 1:", 'oconnor'),
                "param_name"    => "backend_divider",
            ),
            /* step 1 */
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 1 Heading", 'oconnor'),
                "param_name" => "heading1",
                "description" => esc_html__("Enter text for heading line.", 'oconnor')
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 1 Text", 'oconnor'),
                "param_name" => "text1",
                "description" => esc_html__("Enter text.", 'oconnor')
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 1 Link', 'oconnor' ),
                "param_name"    => "url1",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 1 Link Text', 'oconnor' ),
                "param_name"    => "url_text1",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            /* step 2 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 2:", 'oconnor'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 2 Heading", 'oconnor'),
                "param_name" => "heading2",
                "description" => esc_html__("Enter text for heading line.", 'oconnor')
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 2 Text", 'oconnor'),
                "param_name" => "text2",
                "description" => esc_html__("Enter text.", 'oconnor')
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 2 Link', 'oconnor' ),
                "param_name"    => "url2",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 2 Link Text', 'oconnor' ),
                "param_name"    => "url_text2",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            /* step 3 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 3:", 'oconnor'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 3 Heading", 'oconnor'),
                "param_name" => "heading3",
                "description" => esc_html__("Enter text for heading line.", 'oconnor')
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 3 Text", 'oconnor'),
                "param_name" => "text3",
                "description" => esc_html__("Enter text.", 'oconnor')
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 3 Link', 'oconnor' ),
                "param_name"    => "url3",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 3 Link Text', 'oconnor' ),
                "param_name"    => "url_text3",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            /* step 4 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 4:", 'oconnor'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 4 Heading", 'oconnor'),
                "param_name" => "heading4",
                "description" => esc_html__("Enter text for heading line.", 'oconnor'),
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 4 Text", 'oconnor'),
                "param_name" => "text4",
                "description" => esc_html__("Enter text.", 'oconnor'),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 4 Link', 'oconnor' ),
                "param_name"    => "url4",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 4 Link Text', 'oconnor' ),
                "param_name"    => "url_text4",
                'edit_field_class' => 'vc_col-sm-6',

            ),
            /* step 5 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 5:", 'oconnor'),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 5 Heading", 'oconnor'),
                "param_name" => "heading5",
                "description" => esc_html__("Enter text for heading line.", 'oconnor'),
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 5 Text", 'oconnor'),
                "param_name" => "text5",
                "description" => esc_html__("Enter text.", 'oconnor'),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 5 Link', 'oconnor' ),
                "param_name"    => "url5",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 5 Link Text', 'oconnor' ),
                "param_name"    => "url_text5",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Styling
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Icon Size', 'oconnor' ),
                "param_name"    => "icon_size",
                'options'         => array(
                    esc_html__( 'Regular', 'oconnor' )   => 'regular',
                    esc_html__( 'Mini', 'oconnor' )      => 'mini',
                    esc_html__( 'Small', 'oconnor' )     => 'small',
                    esc_html__( 'Large', 'oconnor' )     => 'large',
                    esc_html__( 'Huge', 'oconnor' )      => 'huge'
                ),
                "group"         => esc_html__( "Styling", 'oconnor' ),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Background', 'oconnor' ),
                "param_name"    => "icon_bg",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Color', 'oconnor' ),
                "param_name"    => "icon_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => '#ffffff',
                'save_always' => true,
            ),
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Title Tag', 'oconnor' ),
                "param_name"    => "title_tag",
                'options'         => array(
                    esc_html__( 'H2', 'oconnor' )    => 'h2',
                    esc_html__( 'H3', 'oconnor' )    => 'h3',
                    esc_html__( 'H4', 'oconnor' )    => 'h4',
                    esc_html__( 'H5', 'oconnor' )    => 'h5',
                    esc_html__( 'H6', 'oconnor' )    => 'h6',
                ),
                'save_always' => true,
                "group"         => esc_html__( "Styling", 'oconnor' ),
            ),
            // Icon Box title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'oconnor'),
                'param_name' => 'iconbox_title_size',
                'value' => '18',
                'description' => esc_html__( 'Enter title font-size in pixels.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox Title Fonts
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Use theme default font family for title?', 'oconnor' ),
                'param_name' => 'use_theme_fonts_iconbox_title',
                'value' => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_iconbox_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'oconnor' ),
            ),
            // Icon Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'oconnor'),
                'param_name' => 'iconbox_content_size',
                'value' => '16',
                'description' => esc_html__( 'Enter content font-size in pixels.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox content Fonts
            array(
                'type' => 'gt3_on_off',
                'heading' => esc_html__( 'Use theme default font family for content?', 'oconnor' ),
                'param_name' => 'use_theme_fonts_iconbox_content',
                'value' => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_iconbox_content',
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
        )
    ));
}
