<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$secondary_font = gt3_option('secondary_font');
$header_font    = gt3_option('header-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name"              => esc_html__("Heading Label", 'oconnor'),
        "base"              => "gt3_heading_label",
        "class"             => "gt3_heading_label",
        "category"          => esc_html__('GT3 Modules', 'oconnor'),
        "icon"              => 'gt3_icon',
        "content_element"   => true,
        "description"       => esc_html__("Heading with label",'oconnor'),
        "params"            => array(
            // Icon Section
            array(
                "type"              => "textfield",
                "heading"           => esc_html__("Heading", 'oconnor'),
                "param_name"        => "text",
                'edit_field_class'  => 'vc_col-sm-12',
                "description"       => esc_html__("Enter heading.", 'oconnor')
            ),
            array(
                "type"              => "textfield",
                "heading"           => esc_html__("Heading 2 (second part)", 'oconnor'),
                "param_name"        => "text_2",
                'edit_field_class'  => 'vc_col-sm-12',
                "description"       => esc_html__("Enter the last part of custom heading.", 'oconnor'),
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Alignment Heading','oconnor'),
                'param_name'        => 'heading_align',
                'options'             => array(
                    esc_html__('Left', 'oconnor')   => 'left',
                    esc_html__('Right', 'oconnor')  => 'right',
                    esc_html__('Center', 'oconnor') => 'center',
                ),
                'std'               => 'center',
                'edit_field_class'  => 'vc_col-sm-12',
                'description'       => esc_html__('Select the alignment for the heading', 'oconnor'),
            ),

            // Style heading start
            array(
                "type"          => "backend_divider",
                "heading"       => '',
                "param_name"    => "backend_divider",
            ),
            array(
                "type"              => "colorpicker",
                "heading"           => esc_html__( 'Color for First part', 'oconnor' ),
                "param_name"        => "text_color",
                'edit_field_class'  => 'vc_col-sm-12',
                "value"             => '#e63764',
                'save_always'       => true,
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Line Height', 'oconnor'),
                'param_name'        => 'line_height',
                'value'             => '140',
                'description'       => esc_html__( 'Enter line height in %.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size', 'oconnor'),
                'param_name'        => 'font_size',
                'value'             => '60',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Font Weight', 'oconnor'),
                'description'       => esc_html__( 'Select Font Weight.', 'oconnor' ),
                'param_name'        => 'text_weight',
                'options'             => array(
                    esc_html__("100", 'oconnor') => '100',
                    esc_html__("200", 'oconnor') => '200',
                    esc_html__("300", 'oconnor') => '300',
                    esc_html__("400", 'oconnor') => '400',
                    esc_html__("500", 'oconnor') => '500',
                    esc_html__("600", 'oconnor') => '600',
                    esc_html__("700", 'oconnor') => '700',
                    esc_html__("800", 'oconnor') => '800',
                ),
                'std'               => '300',
                'edit_field_class'  => 'vc_col-sm-4',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Set Responsive Font Size', 'oconnor' ),
                'param_name'        => 'responsive_font',
                'edit_field_class'  => 'vc_col-sm-12',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'        => 'font_size_sm_desktop',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'responsive_font',
                    "value"             => "true"
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'        => 'font_size_tablet',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'responsive_font',
                    "value"             => "true"
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'        => 'font_size_mobile',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'responsive_font',
                    "value"             => "true"
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use theme default font family?', 'oconnor' ),
                'param_name'        => 'use_theme_fonts',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description'       => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                'std'               => 'yes',
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'google_fonts',
                'param_name'        => 'google_fonts_text',
                'value'             => '',
                'settings'          => array(
                    'fields'            => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency'        => array(
                    'element'            => 'use_theme_fonts',
                    'value_not_equal_to' => 'yes',
                ),
            ),

            // Style heading 2
            array(
                "type"          => "backend_divider",
                "heading"       => '',
                "param_name"    => "backend_divider",
            ),
            array(
                "type"              => "colorpicker",
                "heading"           => esc_html__( 'Color for Second part', 'oconnor' ),
                "param_name"        => "text_color_2",
                'edit_field_class'  => 'vc_col-sm-12',
                "value"             => '#212226',
                'save_always'       => true,
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Font Weight', 'oconnor'),
                'description'       => esc_html__( 'Select Font Weight.', 'oconnor' ),
                'param_name'        => 'text_weight_2',
                'options'             => array(
                    esc_html__("100", 'oconnor') => '100',
                    esc_html__("200", 'oconnor') => '200',
                    esc_html__("300", 'oconnor') => '300',
                    esc_html__("400", 'oconnor') => '400',
                    esc_html__("500", 'oconnor') => '500',
                    esc_html__("600", 'oconnor') => '600',
                    esc_html__("700", 'oconnor') => '700',
                    esc_html__("800", 'oconnor') => '800',
                ),
                'std'               => '300',
                'edit_field_class'  => 'vc_col-sm-4',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Line Height', 'oconnor'),
                'param_name'        => 'line_height_2',
                'value'             => '140',
                'description'       => esc_html__( 'Enter line height in %.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size', 'oconnor'),
                'param_name'        => 'font_size_2',
                'value'             => '60',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Set Responsive Font Size', 'oconnor' ),
                'param_name'        => 'responsive_font_2',
                'edit_field_class'  => 'vc_col-sm-12',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'        => 'font_size_sm_desktop_2',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'responsive_font_2',
                    "value"             => "true"
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'        => 'font_size_tablet_2',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'responsive_font_2',
                    "value"             => "true"
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'        => 'font_size_mobile_2',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'responsive_font_2',
                    "value"             => "true"
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use theme default font family?', 'oconnor' ),
                'param_name'        => 'use_theme_fonts_2',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description'       => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                'std'               => 'yes',
                'edit_field_class'  => 'vc_col-sm-12',
            ),

            array(
                'type'              => 'google_fonts',
                'param_name'        => 'google_fonts_text_2',
                'value'             => '',
                'settings'          => array(
                    'fields'            => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency'        => array(
                    'element'            => 'use_theme_fonts_2',
                    'value_not_equal_to' => 'yes',
                ),
            ),

            array(
                "type"              => "backend_divider",
                "heading"           => '',
                "param_name"        => "backend_divider",
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use a shadow for text?', 'oconnor' ),
                'param_name'        => 'use_shadow',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
            ),
            array(
                "type"              => "colorpicker",
                "heading"           => esc_html__( 'Color for Text Shadow', 'oconnor' ),
                "param_name"        => "text_shadow_color",
                'edit_field_class'  => 'vc_col-sm-12',
                "value"             => '#ffffff',
                'save_always'       => true,
                'dependency'        => array(
                    'element'           => 'use_shadow',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__( 'Select width for Text Shadow', 'oconnor' ),
                'param_name'        => 'text_shadow_width',
                'options'             => array(
                    esc_html__("1", 'oconnor') => '1',
                    esc_html__("2", 'oconnor') => '2',
                    esc_html__("3", 'oconnor') => '3',
                    esc_html__("4", 'oconnor') => '4',
                ),
                'std'               => '4',
                'edit_field_class'  => 'vc_col-sm-12',
                'dependency'        => array(
                    'element'           => 'use_shadow',
                    'value'             => 'yes',
                ),
            ),
            vc_map_add_css_animation( true ),

            /* Label options start */
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use a label for this block?', 'oconnor' ),
                'param_name'        => 'use_label',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'group'             => esc_html__('Label', 'oconnor'),
                'std'               => 'yes',
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Label Position', 'oconnor'),
                'param_name'        => 'label_position',
                'options'             => array(
                    esc_html__("Right", 'oconnor') => 'label-right',
                    esc_html__("Left", 'oconnor') => 'label-left',
                ),
                'std'               => 'label-right',
                'group'             => esc_html__('Label', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Title of the Label', 'oconnor'),
                'param_name'        => 'label_title',
                'value'             => '',
                'group'             => esc_html__('Label', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-12',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'colorpicker',
                'param_name'        => 'label_color_1',
                'heading'           => esc_html__('Label content color', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-12',
                'value'             => '#ffffff',
                'group'             => esc_html__('Label', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Select a color for the contents of the label', 'oconnor'),
            ),
            array(
                'type'              => 'dropdown',
                'heading'           => esc_html__('Font Weight for Label Title', 'oconnor'),
                'description'       => esc_html__( 'Select Font Weight.', 'oconnor' ),
                'param_name'        => 'label_weight_1',
                'value'             => array(
                    esc_html__("100", 'oconnor') => '100',
                    esc_html__("200", 'oconnor') => '200',
                    esc_html__("300", 'oconnor') => '300',
                    esc_html__("400", 'oconnor') => '400',
                    esc_html__("500", 'oconnor') => '500',
                    esc_html__("600", 'oconnor') => '600',
                    esc_html__("700", 'oconnor') => '700',
                    esc_html__("800", 'oconnor') => '800',
                ),
                'std'               => '300',
                'group'             => esc_html__('Label', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Label Title', 'oconnor'),
                'param_name'        => 'label_font_size_1',
                'value'             => '18',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'group'             => esc_html__('Label', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Line Height for Label Title', 'oconnor'),
                'param_name'        => 'label_line_height_1',
                'value'             => '140',
                'description'       => esc_html__( 'Enter line height in %.', 'oconnor' ),
                'group'             => esc_html__('Label', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Set Responsive Font Size', 'oconnor' ),
                'param_name'        => 'label_responsive_font_1',
                'edit_field_class'  => 'vc_col-sm-12',
                'group'             => esc_html__('Label', 'oconnor'),
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'        => 'label_font_size_sm_desktop_1',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'label_responsive_font_1',
                    "value"             => "true"
                ),
                'group'             => esc_html__('Label', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'        => 'label_font_size_tablet_1',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'label_responsive_font_1',
                    "value"             => "true"
                ),
                'group'             => esc_html__('Label', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'        => 'label_font_size_mobile_1',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'label_responsive_font_1',
                    "value"             => "true"
                ),
                'group'             => esc_html__('Label', 'oconnor'),
            ),


            array(
                'type'              => 'backend_divider',
                'heading'           => '',
                'param_name'        => 'backend_divider',
                'group'             => esc_html__('Label', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Content of the Label', 'oconnor'),
                'param_name'        => 'label_content',
                'value'             => '',
                'group'             => esc_html__('Label', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-12',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'colorpicker',
                'param_name'        => 'label_color_2',
                'heading'           => esc_html__('Label content color', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-12',
                'value'             => '#ffffff',
                'group'             => esc_html__('Label', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Select a color for the contents of the label', 'oconnor'),
            ),
            array(
                'type'              => 'dropdown',
                'heading'           => esc_html__('Font Weight for Label Content', 'oconnor'),
                'description'       => esc_html__( 'Select Font Weight.', 'oconnor' ),
                'param_name'        => 'label_weight_2',
                'value'             => array(
                    esc_html__("100", 'oconnor') => '100',
                    esc_html__("200", 'oconnor') => '200',
                    esc_html__("300", 'oconnor') => '300',
                    esc_html__("400", 'oconnor') => '400',
                    esc_html__("500", 'oconnor') => '500',
                    esc_html__("600", 'oconnor') => '600',
                    esc_html__("700", 'oconnor') => '700',
                    esc_html__("800", 'oconnor') => '800',
                ),
                'std'               => '300',
                'group'             => esc_html__('Label', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Label Content', 'oconnor'),
                'param_name'        => 'label_font_size_2',
                'value'             => '24',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'group'             => esc_html__('Label', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Line Height for Label Content', 'oconnor'),
                'param_name'        => 'label_line_height_2',
                'value'             => '140',
                'description'       => esc_html__( 'Enter line height in %.', 'oconnor' ),
                'group'             => esc_html__('Label', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use theme default font family for this label?', 'oconnor' ),
                'param_name'        => 'use_theme_fonts_label',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description'       => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                'group'             => esc_html__('Label', 'oconnor'),
                'std'               => 'yes',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Set Responsive Font Size', 'oconnor' ),
                'param_name'        => 'label_responsive_font_2',
                'edit_field_class'  => 'vc_col-sm-12',
                'group'             => esc_html__('Label', 'oconnor'),
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'        => 'label_font_size_sm_desktop_2',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'label_responsive_font_2',
                    "value"             => "true"
                ),
                'group'             => esc_html__('Label', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'        => 'label_font_size_tablet_2',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'label_responsive_font_2',
                    "value"             => "true"
                ),
                'group'             => esc_html__('Label', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'        => 'label_font_size_mobile_2',
                'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-4',
                'dependency'        => array(
                    'element'           => 'label_responsive_font_2',
                    "value"             => "true"
                ),
                'group'             => esc_html__('Label', 'oconnor'),
            ),


            array(
                "type"              => "backend_divider",
                "heading"           => '',
                "param_name"        => "backend_divider",
                'group'             => esc_html__('Label', 'oconnor'),
            ),
            array(
                'type'              => 'google_fonts',
                'param_name'        => 'google_fonts_label',
                'value'             => '',
                'settings'          => array(
                    'fields'            => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency'        => array(
                    'element'            => 'use_theme_fonts_label',
                    'value_not_equal_to' => 'yes',
                ),
                "group"             => esc_html__( "Label", 'oconnor' ),
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Alignment Contents of the label ','oconnor'),
                'param_name'        => 'label_content_align',
                'options'             => array(
                    esc_html__('Left', 'oconnor')   => 'left',
                    esc_html__('Right', 'oconnor')  => 'right',
                    esc_html__('Center', 'oconnor') => 'center',
                ),
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'std'               => 'left',
                'edit_field_class'  => 'vc_col-sm-12',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Select the alignment for the contents of the label', 'oconnor'),
            ),
            array(
                'type'              => 'colorpicker',
                'param_name'        => 'label_background',
                'heading'           => esc_html__('Label background color', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-6',
                'value'             => '#e63764',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Select a color for the background of the label', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Label Width', 'oconnor'),
                'param_name'        => 'label_width',
                'value'             => '125',
                'edit_field_class'  => 'vc_col-sm-12',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Enter label width in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Top and Bottom', 'oconnor'),
                'param_name'        => 'label_padding_1',
                'value'             => '37',
                'edit_field_class'  => 'vc_col-sm-6',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Top and Bottom padding in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Right and Left', 'oconnor'),
                'param_name'        => 'label_padding_2',
                'value'             => '29',
                'edit_field_class'  => 'vc_col-sm-6',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Right and Left padding in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Margin-top', 'oconnor'),
                'param_name'        => 'label_margin_1',
                'value'             => '0',
                'edit_field_class'  => 'vc_col-sm-6',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Add positioning to the label in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Margin-right', 'oconnor'),
                'param_name'        => 'label_margin_2',
                'value'             => '0',
                'edit_field_class'  => 'vc_col-sm-6',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'label_position',
                    'value'             => 'label-right',
                ),
                'description'       => esc_html__('Add positioning to the label in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Margin-left', 'oconnor'),
                'param_name'        => 'label_margin_3',
                'value'             => '0',
                'edit_field_class'  => 'vc_col-sm-6',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'            => 'label_position',
                    'value_not_equal_to' => 'label-right',
                ),
                'description'       => esc_html__('Add positioning to the label in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Would you like to use the round label?', 'oconnor' ),
                'param_name'        => 'label_round',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'edit_field_class'  => 'vc_col-sm-12',
                'group'             => esc_html__( 'Label Styling', 'oconnor' ),
                'std'               => 'yes',
                'dependency'        => array(
                    'element'           => 'use_label',
                    'value'             => 'yes',
                ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Enable the shadow for the label?', 'oconnor' ),
                'param_name'        => 'label_shadow',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
                'edit_field_class'  => 'vc_col-sm-12',
                'group'             => esc_html__( 'Label Styling', 'oconnor' ),
                'dependency'        => array(
                    'element'       => 'use_label',
                    'value'         => 'yes',
                ),
            ),
            array(
                'type'              => 'colorpicker',
                'param_name'        => 'label_shadow_color',
                'heading'           => esc_html__('Label shadow color', 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-12',
                'value'             => 'rgba(48,66,78,0.29)',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'label_shadow',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Select a color for the shadow of the label', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Left/right', 'oconnor'),
                'param_name'        => 'label_shadow_1',
                'value'             => '-25',
                'edit_field_class'  => 'vc_col-sm-3',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'label_shadow',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('How much to perpend the shadow in the horizontal direction in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Top/bottom', 'oconnor'),
                'param_name'        => 'label_shadow_2',
                'value'             => '25',
                'edit_field_class'  => 'vc_col-sm-3',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'label_shadow',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('How much to perpend the shadow in the vertical direction in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Blur Radius', 'oconnor'),
                'param_name'        => 'label_shadow_3',
                'value'             => '51',
                'edit_field_class'  => 'vc_col-sm-3',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'label_shadow',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Enter blur radius in pixels', 'oconnor'),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Spread Radius', 'oconnor'),
                'param_name'        => 'label_shadow_4',
                'value'             => '0',
                'edit_field_class'  => 'vc_col-sm-3',
                'group'             => esc_html__('Label Styling', 'oconnor'),
                'dependency'        => array(
                    'element'           => 'label_shadow',
                    'value'             => 'yes',
                ),
                'description'       => esc_html__('Enter spread radius in pixels', 'oconnor'),
            ),
            /* Label options end */
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_heading_label extends WPBakeryShortCode {

        }
    }
}
