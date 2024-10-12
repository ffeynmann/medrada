<?php
if (!defined('ABSPATH')) {
    die('-1');
}

$theme_color2 = gt3_option("theme-custom-color2");

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        "name"            => esc_html__("Button", 'oconnor'),
        "base"            => "gt3_button",
        "class"           => "gt3_button",
        "category"        => esc_html__('GT3 Modules', 'oconnor'),
        "icon"            => 'gt3_icon',
        "content_element" => true,
        "description"     => esc_html__("Add custom button", 'oconnor'),
        "params"          => array(
            // Text
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Text", 'oconnor'),
                "param_name"  => "button_title",
                "value"       => esc_html__("Text on the button", 'oconnor'),
                'admin_label' => true,
            ),
            // Link
            array(
                'type'        => 'vc_link',
                'heading'     => esc_html__('Link', 'oconnor'),
                'param_name'  => 'link',
                "description" => esc_html__("Add link to button.", 'oconnor')
            ),
            // Size
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Size', 'oconnor'),
                'param_name'  => 'button_size',
                'options'       => array(
                    esc_html__('Normal', 'oconnor') => 'normal',
                    esc_html__('Mini', 'oconnor')   => 'mini',
                    esc_html__('Small', 'oconnor')  => 'small',
                    esc_html__('Large', 'oconnor')  => 'large'
                ),
                "description" => esc_html__("Select button display size.", 'oconnor')
            ),
            // Alignment
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Alignment', 'oconnor'),
                'param_name'  => 'button_alignment',
                'options'       => array(
                    esc_html__('Inline', 'oconnor') => 'inline',
                    esc_html__('Left', 'oconnor')   => 'left',
                    esc_html__('Right', 'oconnor')  => 'right',
                    esc_html__('Center', 'oconnor') => 'center',
                    esc_html__('Block', 'oconnor')  => 'block'
                ),
                "description" => esc_html__("Select button alignment.", 'oconnor')
            ),
            // Button Border
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Button Border Radius', 'oconnor'),
                'param_name' => 'btn_border_radius',
                "value"      => array(
                    esc_html__('None', 'oconnor') => 'none',
                    esc_html__('1px', 'oconnor')  => '1px',
                    esc_html__('2px', 'oconnor')  => '2px',
                    esc_html__('3px', 'oconnor')  => '3px',
                    esc_html__('4px', 'oconnor')  => '4px',
                    esc_html__('5px', 'oconnor')  => '5px',
                    esc_html__('10px', 'oconnor') => '10px',
                    esc_html__('15px', 'oconnor') => '15px',
                    esc_html__('20px', 'oconnor') => '20px',
                    esc_html__('25px', 'oconnor') => '25px',
                    esc_html__('30px', 'oconnor') => '30px',
                    esc_html__('35px', 'oconnor') => '35px'
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Button Border Style', 'oconnor'),
                'param_name' => 'btn_border_style',
                "value"      => array(
                    esc_html__('Solid', 'oconnor')  => 'solid',
                    esc_html__('Dashed', 'oconnor') => 'dashed',
                    esc_html__('Dotted', 'oconnor') => 'dotted',
                    esc_html__('Double', 'oconnor') => 'double',
                    esc_html__('Inset', 'oconnor')  => 'inset',
                    esc_html__('Outset', 'oconnor') => 'outset',
                    esc_html__('None', 'oconnor')   => 'none'
                ),
                'dependency' => array(
                    'callback' => 'gt3ButtonDependency',
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Button Border Width', 'oconnor'),
                'param_name' => 'btn_border_width',
                "value"      => array(
                    esc_html__('1px', 'oconnor')  => '1px',
                    esc_html__('2px', 'oconnor')  => '2px',
                    esc_html__('3px', 'oconnor')  => '3px',
                    esc_html__('4px', 'oconnor')  => '4px',
                    esc_html__('5px', 'oconnor')  => '5px',
                    esc_html__('6px', 'oconnor')  => '6px',
                    esc_html__('7px', 'oconnor')  => '7px',
                    esc_html__('8px', 'oconnor')  => '8px',
                    esc_html__('9px', 'oconnor')  => '9px',
                    esc_html__('10px', 'oconnor') => '10px'
                ),
                'dependency' => array(
                    'element'            => 'btn_border_style',
                    'value_not_equal_to' => 'none',
                ),
            ),
            // --- ICON GROUP --- //
            array(
                "type"        => 'gt3_custom_select',
                "class"       => "",
                "heading"     => esc_html__("Icon Type", 'oconnor'),
                "param_name"  => "btn_icon_type",
                'options'       => array(
                    esc_html__("None", 'oconnor')  => "none",
                    esc_html__("Font", 'oconnor')  => "font",
                    esc_html__("Image", 'oconnor') => "image",
                ),
                'group'       => esc_html__('Icon', 'oconnor'),
                "description" => esc_html__("Use an existing font icon or upload a custom image.", 'oconnor'),
                'dependency'  => array(
                    'callback' => 'gt3ButtonDependency',
                ),
            ),
            // Icon
            array(
                'type'        => 'iconpicker',
                'heading'     => esc_html__('Icon', 'oconnor'),
                'param_name'  => 'btn_icon_fontawesome',
                'value'       => 'fa fa-adjust', // default value to backend editor admin_label
                'settings'    => array(
                    'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                "dependency"  => Array("element" => "btn_icon_type", "value" => array("font")),
                'description' => esc_html__('Select icon from library.', 'oconnor'),
                'group'       => esc_html__('Icon', 'oconnor'),
            ),
            // Image
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__('Image', 'oconnor'),
                'param_name'  => 'btn_image',
                'value'       => '',
                'description' => esc_html__('Select image from media library.', 'oconnor'),
                "dependency"  => Array("element" => "btn_icon_type", "value" => array("image")),
                'group'       => esc_html__('Icon', 'oconnor'),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Image Width', 'oconnor'),
                'param_name'       => 'btn_img_width',
                'value'            => '',
                'description'      => esc_html__('Enter image width in pixels.', 'oconnor'),
                "dependency"       => Array("element" => "btn_icon_type", "value" => array("image")),
                'edit_field_class' => 'vc_col-sm-6',
                'group'            => esc_html__('Icon', 'oconnor'),
            ),
            array(
                'type'       => 'gt3_custom_select',
                'heading'    => esc_html__('Icon Position', 'oconnor'),
                'param_name' => 'btn_icon_position',
                'options'      => array(
                    esc_html__("Left", 'oconnor')  => 'left',
                    esc_html__("Right", 'oconnor') => 'right'
                ),
                "dependency" => Array("element" => "btn_icon_type", "value" => array("image", "font")),
                'group'      => esc_html__('Icon', 'oconnor'),
            ),
            // Icon Font Size
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Icon Font Size', 'oconnor'),
                'param_name'       => 'icon_font_size',
                'value'            => '14',
                'description'      => esc_html__('Enter icon font-size in pixels.', 'oconnor'),
                "dependency"       => Array("element" => "btn_icon_type", "value" => array("font")),
                "group"            => esc_html__("Icon", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- TYPOGRAPHY GROUP --- //
            // Button Font
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family for button?', 'oconnor'),
                'param_name'  => 'use_theme_fonts_button',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                "group"       => esc_html__("Typography", 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'google_fonts_button',
                'value'      => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
                'dependency' => array(
                    'element'            => 'use_theme_fonts_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group"      => esc_html__("Typography", 'oconnor'),
            ),
            // Button Font Size
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Button Font Size', 'oconnor'),
                'param_name'       => 'btn_font_size',
                'value'            => '14',
                'description'      => esc_html__('Enter button font-size in pixels.', 'oconnor'),
                "group"            => esc_html__('Typography', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Letter Spacing
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Button Letter Spacing', 'oconnor'),
                'param_name'       => 'btn_letter_spacing',
                'value'            => array(
                    '0'       => '0',
                    '0.005em' => '0.005',
                    '0.01em'  => '0.01',
                    '0.025em' => '0.025',
                    '0.05em'  => '0.05',
                    '0.075em' => '0.075',
                    '0.1em'   => '0.1',
                    '0.15em'  => '0.15',
                    '0.2em'   => '0.2',
                ),
                'std'              => '0',
                'description'      => esc_html__('Select button letter-spacing in em.', 'oconnor'),
                'group'            => esc_html__('Typography', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- SPACING GROUP --- //
            array(
                'type'       => 'css_editor',
                'param_name' => 'css',
                'group'      => esc_html__('Spacing', 'oconnor'),
            ),
            vc_map_add_css_animation(true),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Extra Class", 'oconnor'),
                "param_name"  => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            ),
            // --- CUSTOM GROUP --- //
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default button?', 'oconnor'),
                'param_name'  => 'use_theme_button',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use button from the theme.', 'oconnor'),
                "group"       => esc_html__("Custom", 'oconnor'),
                'std'         => 'yes',
            ),
            // Button Bg
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Background", 'oconnor'),
                "param_name"       => "btn_bg_color",
                "value"            => esc_attr($theme_color2),
                "description"      => esc_html__("Select custom background for button.", 'oconnor'),
                'save_always'      => true,
                'dependency'       => array(
                    'element'            => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Bg
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Button Hover Background", 'oconnor'),
                "param_name"       => "btn_bg_color_hover",
                "value"            => "#ffffff",
                "description"      => esc_html__("Select custom background for hover button.", 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button text-color
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Text Color", 'oconnor'),
                "param_name"       => "btn_text_color",
                "value"            => "#ffffff",
                "description"      => esc_html__("Select custom text color for button.", 'oconnor'),
                'save_always'      => true,
                'dependency'       => array(
                    'element'            => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover text-color
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Button Hover Text Color", 'oconnor'),
                "param_name"       => "btn_text_color_hover",
                "value"            => esc_attr($theme_color2),
                "description"      => esc_html__("Select custom text color for hover button.", 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button icon-color
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Icon Color", 'oconnor'),
                "param_name"       => "btn_icon_color",
                "value"            => esc_attr($theme_color2),
                "description"      => esc_html__("Select icon color for button.", 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover icon-color
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Button Hover Icon Color", 'oconnor'),
                "param_name"       => "btn_icon_color_hover",
                "value"            => "#ffffff",
                "description"      => esc_html__("Select icon color for hover button.", 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button border-color
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Button Border Color", 'oconnor'),
                "param_name"       => "btn_border_color",
                "value"            => esc_attr($theme_color2),
                "description"      => esc_html__("Select custom border color for button.", 'oconnor'),
                'save_always'      => true,
                'dependency'       => array(
                    'element'            => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover border-color
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Button Hover Border Color", 'oconnor'),
                "param_name"       => "btn_border_color_hover",
                "value"            => '#e8e8e8',
                "description"      => esc_html__("Select custom border color for hover button.", 'oconnor'),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'dependency'       => array(
                    'element'            => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),


        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Button extends WPBakeryShortCode {
        }
    }
}