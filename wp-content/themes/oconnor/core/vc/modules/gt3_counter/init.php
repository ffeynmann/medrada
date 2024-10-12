<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    // Add list item
    vc_map(array(
        "name"              => esc_html__("Counter", 'oconnor'),
        "base"              => "gt3_counter",
        "class"             => "gt3_counter",
        "category"          => esc_html__('GT3 Modules', 'oconnor'),
        "icon"              => 'gt3_icon',
        "content_element"   => true,
        "description"       => esc_html__("Adds your milestones, achievements, etc.",'oconnor'),
        "params"            => array(
            // Icon Type
            array(
                "type"              => 'gt3_custom_select',
                "class"             => "",
                "heading"           => esc_html__("Icon Type", 'oconnor'),
                "param_name"        => "icon_type",
                'options'             => array(
                    esc_html__("Font",'oconnor')   => "font",
                    esc_html__("Image",'oconnor')  => "image",
                    esc_html__("None",'oconnor')   => "none",
                ),
                "description"       => esc_html__("Use an existing font icon or upload a custom image.", 'oconnor')
            ),
            // Icon
            array(
                'type'              => 'iconpicker',
                'heading'           => esc_html__('Icon', 'oconnor'),
                'param_name'        => 'icon_fontawesome',
                'value'             => 'fa fa-adjust', // default value to backend editor admin_label
                'settings'          => array(
                    'emptyIcon'         => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage'      => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                "dependency"        => Array("element" => "icon_type","value" => array("font")),
                'description'       => esc_html__( 'Select icon from library.', 'oconnor' ),
            ),
            // Image
            array(
                'type'              => 'attach_image',
                'heading'           => esc_html__('Image', 'oconnor'),
                'param_name'        => 'image',
                'value'             => '',
                'description'       => esc_html__( 'Select image from media library.', 'oconnor' ),
                "dependency"        => Array("element" => "icon_type","value" => array("image")),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Image Width', 'oconnor'),
                'param_name'        => 'img_width',
                'value'             => '60',
                'description'       => esc_html__( 'Enter image width in pixels.', 'oconnor' ),
                "dependency"        => Array("element" => "icon_type","value" => array("image")),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Image Proportions', 'oconnor'),
                'param_name'        => 'image_proportions',
                'options'             => array(
                    esc_html__("Original", 'oconnor')  => 'original',
                    esc_html__("Square", 'oconnor')    => 'square',
                    esc_html__("Circle", 'oconnor')    => 'circle',
                ),
                "dependency"        => Array("element" => "img_width", "not_empty" => true),
            ),
            // General Params
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Icon Position', 'oconnor'),
                'param_name'        => 'icon_position',
                'options'             => array(
                    esc_html__("Left", 'oconnor')   => 'left',
                    esc_html__("Top", 'oconnor')    => 'top',
                    esc_html__("Right", 'oconnor')  => 'right',
                    esc_html__("Bottom", 'oconnor') => 'bottom',
                ),
                "dependency"        => Array("element" => "icon_type","value" => array("image", "font")),
                'edit_field_class'  => 'vc_col-sm-4',
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__( 'Icon Size', 'oconnor' ),
                'param_name'        => 'icon_size',
                'options'             => array(
                    esc_html__( 'Mini', 'oconnor' )    => 'mini',
                    esc_html__( 'Small', 'oconnor' )   => 'small',
                    esc_html__( 'Normal', 'oconnor' )  => 'normal',
                    esc_html__( 'Large', 'oconnor' )   => 'large',
                    esc_html__( 'Extra Large', 'oconnor' ) => 'extralarge'
                ),
                "dependency"        => Array("element" => "icon_type","value" => array("font")),
                'save_always'       => true,
                'edit_field_class'  => 'vc_col-sm-4',
            ),
            array(
                "type"              => "colorpicker",
                "class"             => "",
                "heading"           => esc_html__("Icon Color", 'oconnor'),
                "param_name"        => "icon_color",
                "value"             => "#27323d",
                "description"       => esc_html__("Select color for this item.", 'oconnor'),
                "dependency"        => Array("element" => "icon_type","value" => array("font")),
                'save_always'       => true,
                'edit_field_class'  => 'vc_col-sm-4',
            ),

            array(
                "type"              => "backend_divider",
                "heading"           => '',
                "param_name"        => "backend_divider",
            ),
            // Counter Title start
             array(
                "type"              => "textfield",
                "class"             => "",
                "heading"           => esc_html__("Counter Title ", 'oconnor'),
                "param_name"        => "counter_title",
                "admin_label"       => true,
                "value"             => "",
                "description"       => esc_html__("Enter title for stats counter block", 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                "type"              => "colorpicker",
                "class"             => "",
                "heading"           => esc_html__("Title Color", 'oconnor'),
                "param_name"        => "title_color",
                "value"             => "#272b2e",
                "description"       => esc_html__("Select color for this item.", 'oconnor'),
                'save_always'       => true,
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Counter Title Font Size', 'oconnor'),
                'param_name'        => 'counter_title_size',
                'value'             => '16',
                'description'       => esc_html__( 'Enter counter title font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Counter Title Line Height', 'oconnor'),
                'param_name'        => 'counter_title_line_height',
                'value'             => '140',
                'description'       => esc_html__( 'Enter counter description line height in %.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use theme default font family for counter title?', 'oconnor' ),
                'param_name'        => 'use_theme_fonts_counter_title',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description'       => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                'std'               => 'yes',
            ),
            array(
                'type'              => 'google_fonts',
                'param_name'        => 'google_fonts_counter_title',
                'value'             => '',
                'settings'          => array(
                    'fields'            => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency'        => array(
                    'element'            => 'use_theme_fonts_counter_title',
                    'value_not_equal_to' => 'yes',
                ),
            ),
            // Counter Title end

            array(
                "type"              => "backend_divider",
                "heading"           => '',
                "param_name"        => "backend_divider",
            ),
            // Counter Description start
            array(
                "type"              => "textfield",
                "class"             => "",
                "heading"           => esc_html__("Counter Description", 'oconnor'),
                "param_name"        => "counter_description",
                "admin_label"       => false,
                "value"             => "",
                "description"       => esc_html__("Enter description for stats counter block", 'oconnor'),
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                "type"              => "colorpicker",
                "class"             => "",
                "heading"           => esc_html__("Description Color", 'oconnor'),
                "param_name"        => "description_color",
                "value"             => "#272b2e",
                "description"       => esc_html__("Select color for this item.", 'oconnor'),
                'save_always'       => true,
                'edit_field_class'  => 'vc_col-sm-12',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Counter Description Font Size', 'oconnor'),
                'param_name'        => 'counter_description_size',
                'value'             => '14',
                'description'       => esc_html__( 'Enter counter title font-size in pixels.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Counter Description Line Height', 'oconnor'),
                'param_name'        => 'counter_description_line_height',
                'value'             => '165',
                'description'       => esc_html__( 'Enter counter description line height in %.', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use theme default font family for counter description?', 'oconnor' ),
                'param_name'        => 'use_theme_fonts_counter_description',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description'       => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                'std'               => 'yes',
            ),
            array(
                'type'              => 'google_fonts',
                'param_name'        => 'google_fonts_counter_description',
                'value'             => '',
                'settings'          => array(
                    'fields'            => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency'        => array(
                    'element'            => 'use_theme_fonts_counter_description',
                    'value_not_equal_to' => 'yes',
                ),
            ),
            // Counter Description end

            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__( 'Text align For Title and Description', 'oconnor' ),
                'param_name'        => 'align',
                'options'             => array(
                    esc_html__( 'left', 'oconnor' )    => 'left',
                    esc_html__( 'center', 'oconnor' )  => 'center',
                    esc_html__( 'right', 'oconnor' )   => 'right',
                ),
                'std'               => 'center',
                'edit_field_class'  => 'vc_col-sm-12',
            ),

            array(
                "type"              => "backend_divider",
                "heading"           => '',
                "param_name"        => "backend_divider",
            ),
            vc_map_add_css_animation( true ),
            array(
                "type"              => "textfield",
                "heading"           => esc_html__("Extra Class", 'oconnor'),
                "param_name"        => "item_el_class",
                "description"       => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor'),
            ),

            // Counter Value start
            array(
                "type"              => "textfield",
                "class"             => "",
                "heading"           => esc_html__("Counter Value", 'oconnor'),
                "param_name"        => "counter_value",
                "value"             => "2001",
                "description"       => esc_html__("Enter number for counter without any special character. You may enter a decimal number. Eg 12.76", 'oconnor'),
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
            ),
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Thousands Separator', 'oconnor' ),
                'param_name'        => 'counter_thousands_separator',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'std'               => '',
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Thousands Separator Text', 'oconnor'),
                'param_name'        => 'counter_thousands_separator_text',
                'value'             => ',',
                'edit_field_class'  => 'vc_col-sm-6',
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
                'dependency'        => array(
                    'element'            => 'counter_thousands_separator',
                    'value' => 'yes',
                ),
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Decimal', 'oconnor'),
                'param_name'        => 'counter_decimal',
                'options'             => array(
                    esc_html__("0", 'oconnor')  => '0',
                    esc_html__("1", 'oconnor')  => '1',
                    esc_html__("2", 'oconnor')  => '2',
                    esc_html__("3", 'oconnor')  => '3',
                    esc_html__("4", 'oconnor')  => '4',
                ),
                'std'               => '0',
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
            ),
            // Value position
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__('Value position', 'oconnor'),
                'param_name'        => 'value_position',
                'options'             => array(
                    esc_html__("Top Left", 'oconnor')  => 'top-left',
                    esc_html__("Top Center", 'oconnor')=> 'top',
                    esc_html__("Top Right", 'oconnor') => 'top-right',
                    esc_html__("Left", 'oconnor')      => 'left',
                    esc_html__("Right", 'oconnor')     => 'right',
                ),
                'std'               => 'left',
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
            ),
            array(
                "type"              => "textfield",
                "class"             => "",
                "heading"           => esc_html__("Counter Value Prefix", 'oconnor'),
                "param_name"        => "counter_prefix",
                "value"             => "",
                'edit_field_class'  => 'vc_col-sm-6',
                "description"       => esc_html__("Enter prefix for counter value", 'oconnor'),
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
            ),
            array(
                "type"              => "textfield",
                "class"             => "",
                "heading"           => esc_html__("Counter Value Suffix", 'oconnor'),
                "param_name"        => "counter_suffix",
                "value"             => "",
                'edit_field_class'  => 'vc_col-sm-6',
                "description"       => esc_html__("Enter suffix for counter value", 'oconnor'),
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
            ),

            array(
                "type"              => "backend_divider",
                "heading"           => '',
                "param_name"        => "backend_divider",
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
            ),
            // Counter Value Font Size
            array(
                "type"              => "colorpicker",
                "class"             => "",
                "heading"           => esc_html__("Counter Value Color", 'oconnor'),
                "param_name"        => "counter_value_color",
                "value"             => "#27323d",
                "description"       => esc_html__("Select color for this item.", 'oconnor'),
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
                'save_always'       => true,
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Counter Value Font Size', 'oconnor'),
                'param_name'        => 'counter_value_size',
                'value'             => '48',
                'description'       => esc_html__( 'Enter counter value font-size in pixels.', 'oconnor' ),
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Line Height', 'oconnor'),
                'param_name'        => 'line_height',
                'value'             => '90',
                'description'       => esc_html__( 'Enter line height in %.', 'oconnor' ),
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),
            // Counter Value Fonts
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use theme default font family for counter value?', 'oconnor' ),
                'param_name'        => 'use_theme_fonts_counter_value',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description'       => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
                'std'               => 'yes',
            ),
            array(
                'type'              => 'google_fonts',
                'param_name'        => 'google_fonts_counter_value',
                'value'             => '',
                'settings'          => array(
                    'fields'            => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency'        => array(
                    'element'            => 'use_theme_fonts_counter_value',
                    'value_not_equal_to' => 'yes',
                ),
                "group"             => esc_html__( "Counter Value", 'oconnor' ),
            ),
            // Counter Value end

        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Counter extends WPBakeryShortCode {
        }
    }
}