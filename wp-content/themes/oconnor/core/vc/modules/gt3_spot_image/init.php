<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');
$sec_font = gt3_option('secondary-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name"          => esc_html__("Spot Image", 'oconnor'),
        "base"          => "gt3_spot_image",
        "class"         => "gt3_spot_image",
        "category"      => esc_html__('GT3 Modules', 'oconnor'),
        "icon"          => 'gt3_icon',
        "content_element" => true,
        "description"   => esc_html__("Spot Image",'oconnor'),
        "params"        => array(
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Spot Image Position', 'oconnor' ),
                "param_name"    => "spot_pos",
                'options'         => array(
                    esc_html__( 'Bottom', 'oconnor' )             => 'bottom',
                    esc_html__( 'Inline with Title', 'oconnor')  => 'inline_title'
                ),
                'save_always'   => true,
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Heading", 'oconnor'),
                "param_name"    => "heading",
                "description"   => esc_html__("Enter text for heading line.", 'oconnor'),
                'admin_label'   => true,
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Title Prefix", 'oconnor'),
                "param_name"    => "title_prefix",
                "description"   => esc_html__("Enter prefix for spot image title", 'oconnor'),
                'dependency'    => array(
                    'element'       => 'spot_pos',
                    'value'         => 'bottom',
                ),
            ),
            array(
                "type"          => "textarea",
                "heading"       => esc_html__("Text", 'oconnor'),
                "param_name"    => "text",
                "description"   => esc_html__("Enter text", 'oconnor')
            ),
            // Icon Section
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Icon Type', 'oconnor' ),
                "param_name"    => "icon_type",
                'options'         => array(
                    esc_html__( 'None', 'oconnor' )      => 'none',
                    esc_html__( 'Font', 'oconnor' )      => 'font',
                    esc_html__( 'Image', 'oconnor' )     => 'image',
                ),
                'save_always'   => true,
                'dependency'    => array(
                    'element'       => 'spot_pos',
                    'value'         => 'inline_title',
                ),
            ),
            array(
                'type'          => 'iconpicker',
                'heading'       => esc_html__( 'Icon', 'oconnor' ),
                'param_name'    => 'icon_fontawesome',
                'value'         => 'fa fa-adjust', // default value to backend editor admin_label
                'settings'      => array(
                    'emptyIcon'     => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage'  => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description'   => esc_html__( 'Select icon from library.', 'oconnor' ),
                'dependency'    => array(
                    'element'       => 'icon_type',
                    'value'         => 'font',
                ),
            ),
            array(
                'type'          => 'attach_image',
                'heading'       => esc_html__( 'Image', 'oconnor' ),
                'param_name'    => 'thumbnail',
                'value'         => '',
                'description'   => esc_html__( 'Select image from media library.', 'oconnor' ),
                'dependency'    => array(
                    'element'       => 'icon_type',
                    'value'         => array( 'image' ),
                ),
            ),
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Spot Image block Aligning', 'oconnor' ),
                "param_name"    => "block_align",
                'options'         => array(
                    esc_html__( 'Left', 'oconnor' )              => 'left',
                    esc_html__( 'Right', 'oconnor' )             => 'right',
                    esc_html__( 'Center', 'oconnor' )             => 'center',
                ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Spot Line Aligning', 'oconnor' ),
                "param_name"    => "spot_align",
                'options'         => array(
                    esc_html__( 'Left', 'oconnor' )              => 'left',
                    esc_html__( 'Right', 'oconnor' )             => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                "type"          => 'gt3_custom_select',
                "heading"       => esc_html__( 'Spot Line Type', 'oconnor' ),
                "param_name"    => "spot_type",
                'options'         => array(
                    esc_html__( 'Dashed', 'oconnor' )      => 'dashed',
                    esc_html__( 'Dotted', 'oconnor' )      => 'dotted',
                    esc_html__( 'Solid', 'oconnor' )       => 'solid',
                ),
            ),
            array(
                "type"          => "gt3_on_off",
                "heading"       => esc_html__( 'Add Shadow to Spot Point', 'oconnor' ),
                "param_name"    => "point_shadow",
                'edit_field_class' => 'vc_col-sm-6',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Spot Point Width in pixels", 'oconnor'),
                "param_name"    => "point_width",
                "value"         => "20",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Spot Line Width in pixels", 'oconnor'),
                "param_name"    => "line_width",
                "value"         => "100",
            ),
            array(
                "type"          => "gt3_on_off",
                "heading"       => esc_html__( 'Add Right or Left Offset', 'oconnor' ),
                "param_name"    => "offset",
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'               => 'no',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Spot block Left Offset in pixels", 'oconnor'),
                "param_name"    => "left_offset",
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'       => 'offset',
                    'value'         => "yes",
                ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Spot block Right Offset in pixels", 'oconnor'),
                "param_name"    => "right_offset",
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'       => 'offset',
                    'value'         => "yes",
                ),
            ),
            // Styling
            // Spot Image title Font Size
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Spot Image Title Font Size', 'oconnor'),
                'param_name'    => 'title_size',
                'value'         => '18',
                'description'   => esc_html__( 'Enter Spot Image title font-size in pixels.', 'oconnor' ),
                "group"         => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Title Color', 'oconnor' ),
                "param_name"    => "title_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr($header_font['color']),
                'save_always'   => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Spot Image content Font Size
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Spot Image Content Font Size', 'oconnor'),
                'param_name'    => 'content_size',
                'value'         => '14',
                'description'   => esc_html__( 'Enter Spot Image title font-size in pixels.', 'oconnor' ),
                "group"         => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Content Color', 'oconnor' ),
                "param_name"    => "text_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr($main_font['color']),
                'save_always'   => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Spot Image prefix Font Size
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Spot Image Prefix Font Size', 'oconnor'),
                'param_name'    => 'prefix_size',
                'value'         => '60',
                'description'   => esc_html__( 'Enter Spot Image prefix font-size in pixels.', 'oconnor' ),
                "group"         => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Prefix Color', 'oconnor' ),
                "param_name"    => "prefix_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => '#efefef',
                'save_always'   => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Spot Image colors
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Color', 'oconnor' ),
                "param_name"    => "icon_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => '#ffffff',
                'save_always'   => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Spot Color', 'oconnor' ),
                "param_name"    => "spot_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr($sec_font['color']),
                'save_always'   => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Line Color', 'oconnor' ),
                "param_name"    => "line_color",
                "group"         => esc_html__( "Styling", 'oconnor' ),
                "value"         => esc_attr($sec_font['color']),
                'save_always'   => true,
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_spot_image extends WPBakeryShortCode {

        }
    }
}
