<?php
if (!defined('ABSPATH')) {
    die('-1');
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base'                    => 'gt3_banner',
        'name'                    => esc_html__('Banner', 'oconnor'),
        'description'             => esc_html__('Display banner', 'oconnor'),
        'category'                => esc_html__('GT3 Modules', 'oconnor'),
        'icon'                    => 'gt3_icon',
        'js_view'                 => 'VcColumnView',
        "as_parent"               => array('only' => 'gt3_button, gt3_custom_text, gt3_icon_box, gt3_counter, vc_single_image, gt3_heading_label, gt3_spacing'),
        "content_element"         => true,
        'show_settings_on_create' => false,
        'params'                  => array(
            array(
                "type"        => "textfield",
                "class"       => "",
                "heading"     => esc_html__("Title", 'oconnor'),
                "param_name"  => "title_item",
                "value"       => "",
                "description" => esc_html__("Enter a title for this banner.", 'oconnor'),
                'admin_label' => true,
            ),
            array(
                "type"        => "textfield",
                "class"       => "",
                "heading"     => esc_html__("Sub-Title", 'oconnor'),
                "param_name"  => "pre_title_item",
                "value"       => "",
                "description" => esc_html__("Enter a pre-title for this banner.", 'oconnor'),
                'admin_label' => true,
            ),
            array(
                'type'       => 'gt3_custom_select',
                'heading'    => esc_html__('Title and Sub-Title Align', 'oconnor'),
                'param_name' => 'item_text_aligh',
                'options'    => array(
                    esc_html__("Left", 'oconnor')   => 'left',
                    esc_html__("Right", 'oconnor')  => 'right',
                    esc_html__("Center", 'oconnor') => 'center',
                ),
                'std'        => 'left',
            ),
            array(
                "type"        => "textfield",
                "class"       => "",
                "heading"     => esc_html__("Vertical Description", 'oconnor'),
                "param_name"  => "vertical_text",
                "value"       => "",
                "description" => esc_html__("Enter a Vertical Description for this banner.", 'oconnor'),
            ),


            // ----- Link -----
            array(
                'type'        => 'vc_link',
                'heading'     => esc_html__('Link', 'oconnor'),
                'param_name'  => 'link',
                "description" => esc_html__("Add link to banner.", 'oconnor')
            ),


            // ----- Title Styling start -----
            array(
                "type"             => "colorpicker",
                "heading"          => esc_html__("Title Color", 'oconnor'),
                "param_name"       => "title_item_color",
                "value"            => "#232325",
                "description"      => esc_html__("Select the color for title.", 'oconnor'),
                "group"            => esc_html__("Title Styling", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Title Font Weight', 'oconnor'),
                'description'      => esc_html__('Enter the font-weight in pixels.', 'oconnor'),
                'param_name'       => 'title_item_weight',
                "group"            => esc_html__("Title Styling", 'oconnor'),
                'value'            => array(
                    esc_html__("100", 'oconnor') => '100',
                    esc_html__("200", 'oconnor') => '200',
                    esc_html__("300", 'oconnor') => '300',
                    esc_html__("400", 'oconnor') => '400',
                    esc_html__("500", 'oconnor') => '500',
                    esc_html__("600", 'oconnor') => '600',
                    esc_html__("700", 'oconnor') => '700',
                    esc_html__("800", 'oconnor') => '800',
                ),
                'std'              => '300',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Title Font Size', 'oconnor'),
                'param_name'       => 'title_item_size',
                'value'            => '56',
                'description'      => esc_html__('Enter the font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Title Styling", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Title line-height', 'oconnor'),
                'param_name'       => 'title_item_line_height',
                'value'            => '140',
                'description'      => esc_html__('Enter the line-height in percent.', 'oconnor'),
                "group"            => esc_html__("Title Styling", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Set Responsive Font Size', 'oconnor'),
                'param_name' => 'title_responsive_font',
                "group"      => esc_html__("Title Styling", 'oconnor'),
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'       => 'title_font_size_sm_desktop',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Title Styling", 'oconnor'),
                'dependency'       => array(
                    'element' => 'title_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'       => 'title_font_size_tablet',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Title Styling", 'oconnor'),
                'dependency'       => array(
                    'element' => 'title_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'       => 'title_font_size_mobile',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Title Styling", 'oconnor'),
                'dependency'       => array(
                    'element' => 'title_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family?', 'oconnor'),
                'param_name'  => 'title_use_theme_fonts',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                "group"       => esc_html__("Title Styling", 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'title_google_fonts',
                'value'      => '',
                "group"      => esc_html__("Title Styling", 'oconnor'),
                'dependency' => array(
                    'element'            => 'title_use_theme_fonts',
                    'value_not_equal_to' => 'yes',
                ),
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
            ),
            // ----- Title Styling end -----


            // ----- Sub-Title Styling start -----
            array(
                "type"             => "colorpicker",
                "heading"          => esc_html__("Sub-Title Color", 'oconnor'),
                "param_name"       => "pre_title_item_color",
                "value"            => "#e63764",
                "description"      => esc_html__("Select the color for sub-title.", 'oconnor'),
                "group"            => esc_html__("Sub-Title Styling", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Sub-Title Font Weight', 'oconnor'),
                'description'      => esc_html__('Enter the font-weight in pixels.', 'oconnor'),
                'param_name'       => 'pre_title_item_weight',
                "group"            => esc_html__("Sub-Title Styling", 'oconnor'),
                'value'            => array(
                    esc_html__("100", 'oconnor') => '100',
                    esc_html__("200", 'oconnor') => '200',
                    esc_html__("300", 'oconnor') => '300',
                    esc_html__("400", 'oconnor') => '400',
                    esc_html__("500", 'oconnor') => '500',
                    esc_html__("600", 'oconnor') => '600',
                    esc_html__("700", 'oconnor') => '700',
                    esc_html__("800", 'oconnor') => '800',
                ),
                'std'              => '300',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Sub-Title Font Size', 'oconnor'),
                'param_name'       => 'pre_title_item_size',
                'value'            => '56',
                'description'      => esc_html__('Enter the font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Sub-Title Styling", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Sub-Title line-height', 'oconnor'),
                'param_name'       => 'pre_title_item_line_height',
                'value'            => '140',
                'description'      => esc_html__('Enter the line-height in percent.', 'oconnor'),
                "group"            => esc_html__("Sub-Title Styling", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Set Responsive Font Size', 'oconnor'),
                'param_name' => 'pre_title_responsive_font',
                "group"      => esc_html__("Sub-Title Styling", 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'       => 'pre_title_font_size_sm_desktop',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Sub-Title Styling", 'oconnor'),
                'dependency'       => array(
                    'element' => 'pre_title_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'       => 'pre_title_font_size_tablet',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Sub-Title Styling", 'oconnor'),
                'dependency'       => array(
                    'element' => 'pre_title_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'       => 'pre_title_font_size_mobile',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Sub-Title Styling", 'oconnor'),
                'dependency'       => array(
                    'element' => 'pre_title_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family?', 'oconnor'),
                'param_name'  => 'pre_title_use_theme_fonts',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                "group"       => esc_html__("Sub-Title Styling", 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'pre_title_google_fonts',
                'value'      => '',
                "group"      => esc_html__("Sub-Title Styling", 'oconnor'),
                'dependency' => array(
                    'element'            => 'pre_title_use_theme_fonts',
                    'value_not_equal_to' => 'yes',
                ),
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
            ),
            // ----- Pre-Title Styling end -----


            // ----- Description start -----
            array(
                'type'             => 'gt3_custom_select',
                'heading'          => esc_html__('Description Position', 'oconnor'),
                'param_name'       => 'desc_pos',
                "group"            => esc_html__("Vertical Description", 'oconnor'),
                'options'          => array(
                    esc_html__("Left", 'oconnor')  => 'left',
                    esc_html__("Right", 'oconnor') => 'right',
                ),
                'std'              => 'left',
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                "type"             => "colorpicker",
                "heading"          => esc_html__("Description Color", 'oconnor'),
                "param_name"       => "desc_item_color",
                "value"            => "#232325",
                "description"      => esc_html__("Select the color for description.", 'oconnor'),
                "group"            => esc_html__("Vertical Description", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Description Font Size', 'oconnor'),
                'param_name'       => 'desc_item_size',
                'value'            => '18',
                'description'      => esc_html__('Enter the font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Vertical Description", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Description Font Weight', 'oconnor'),
                'description'      => esc_html__('Enter the font-weight in pixels.', 'oconnor'),
                'param_name'       => 'desc_item_weight',
                "group"            => esc_html__("Vertical Description", 'oconnor'),
                'value'            => array(
                    esc_html__("100", 'oconnor') => '100',
                    esc_html__("200", 'oconnor') => '200',
                    esc_html__("300", 'oconnor') => '300',
                    esc_html__("400", 'oconnor') => '400',
                    esc_html__("500", 'oconnor') => '500',
                    esc_html__("600", 'oconnor') => '600',
                    esc_html__("700", 'oconnor') => '700',
                    esc_html__("800", 'oconnor') => '800',
                ),
                'std'              => '300',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Description line-height', 'oconnor'),
                'param_name'       => 'desc_item_line_height',
                'value'            => '140',
                'description'      => esc_html__('Enter the line-height in percent.', 'oconnor'),
                "group"            => esc_html__("Vertical Description", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Set Responsive Font Size', 'oconnor'),
                'param_name' => 'desc_responsive_font',
                "group"      => esc_html__("Vertical Description", 'oconnor'),
                'std'        => 'no',
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'       => 'desc_font_size_sm_desktop',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Vertical Description", 'oconnor'),
                'dependency'       => array(
                    'element' => 'desc_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'       => 'desc_font_size_tablet',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Vertical Description", 'oconnor'),
                'dependency'       => array(
                    'element' => 'desc_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'       => 'desc_font_size_mobile',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Vertical Description", 'oconnor'),
                'dependency'       => array(
                    'element' => 'desc_responsive_font',
                    "value"   => "yes"
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family?', 'oconnor'),
                'param_name'  => 'desc_use_theme_fonts',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                "group"       => esc_html__("Vertical Description", 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'desc_google_fonts',
                'value'      => '',
                "group"      => esc_html__("Vertical Description", 'oconnor'),
                'dependency' => array(
                    'element'            => 'desc_use_theme_fonts',
                    'value_not_equal_to' => 'yes',
                ),
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
            ),

            // ----- Pre-Title Styling end -----


            vc_map_add_css_animation(true),

            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Extra Class", 'oconnor'),
                "param_name"  => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            ),


            // ----- Background-image start -----
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__('Background Image', 'oconnor'),
                'param_name'  => 'image',
                'value'       => '',
                'description' => esc_html__('This image will be overlapped by the border.', 'oconnor'),
                'group'       => esc_html__('Design Options', 'oconnor'),
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => esc_html__("Background Color", 'oconnor'),
                "param_name"  => "background_color",
                "value"       => "",
                "description" => esc_html__("Select the color for the background.", 'oconnor'),
                'group'       => esc_html__('Design Options', 'oconnor'),
            ),
            array(
                'type'             => 'gt3_custom_select',
                'heading'          => esc_html__('Background Option', 'oconnor'),
                'param_name'       => 'image_option',
                'options'          => array(
                    esc_html__("Cover", 'oconnor')     => 'cover',
                    esc_html__("Contain", 'oconnor')   => 'contain',
                    esc_html__("No repeat", 'oconnor') => 'no-repeat',
                ),
                'std'              => 'no-repeat',
                'group'            => esc_html__('Design Options', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Background Position', 'oconnor'),
                'param_name'       => 'image_position',
                'value'            => array(
                    esc_html__("Top Left", 'oconnor')      => 'top left',
                    esc_html__("Top Center", 'oconnor')    => 'top center',
                    esc_html__("Top Right", 'oconnor')     => 'top right',
                    esc_html__("Center Left", 'oconnor')   => 'center left',
                    esc_html__("Center Center", 'oconnor') => 'center center',
                    esc_html__("Center Right", 'oconnor')  => 'center right',
                    esc_html__("Bottom Left", 'oconnor')   => 'bottom left',
                    esc_html__("Bottom Center", 'oconnor') => 'bottom center',
                    esc_html__("Bottom Right", 'oconnor')  => 'bottom right',
                ),
                'std'              => 'bottom right',
                'group'            => esc_html__('Design Options', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // ----- Background-image end -----


            // ----- Border start -----
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Border style', 'oconnor'),
                'param_name'       => 'border_style',
                'value'            => array(
                    esc_html__("Solid", 'oconnor')  => 'solid',
                    esc_html__("Dotted", 'oconnor') => 'dotted',
                    esc_html__("Dashed", 'oconnor') => 'dashed',
                    esc_html__("None", 'oconnor')   => 'none',
                    esc_html__("Double", 'oconnor') => 'double',
                    esc_html__("Groove", 'oconnor') => 'groove',
                    esc_html__("Ridge", 'oconnor')  => 'ridge',
                    esc_html__("Inset", 'oconnor')  => 'inset',
                    esc_html__("Outset", 'oconnor') => 'outset',
                ),
                'std'              => 'none',
                'group'            => esc_html__('Design Options', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"             => "colorpicker",
                "heading"          => esc_html__("Border Color", 'oconnor'),
                "param_name"       => "border_color",
                "value"            => "#ffffff",
                "description"      => esc_html__("Select the color for border.", 'oconnor'),
                'group'            => esc_html__('Design Options', 'oconnor'),
                'dependency'       => array(
                    'element'            => 'border_style',
                    "value_not_equal_to" => "none"
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'gt3_custom_select',
                'heading'          => esc_html__('Border width', 'oconnor'),
                'param_name'       => 'border_width',
                'options'          => array(
                    esc_html__("1px", 'oconnor')  => '1px',
                    esc_html__("2px", 'oconnor')  => '2px',
                    esc_html__("3px", 'oconnor')  => '3px',
                    esc_html__("4px", 'oconnor')  => '4px',
                    esc_html__("5px", 'oconnor')  => '5px',
                    esc_html__("7px", 'oconnor')  => '7px',
                    esc_html__("10px", 'oconnor') => '10px',
                ),
                'std'              => 'none',
                'group'            => esc_html__('Design Options', 'oconnor'),
                'dependency'       => array(
                    'element'            => 'border_style',
                    "value_not_equal_to" => "none"
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Border radius', 'oconnor'),
                'param_name'       => 'border_radius',
                'value'            => array(
                    esc_html__("none", 'oconnor') => 'none',
                    esc_html__("1px", 'oconnor')  => '1px',
                    esc_html__("2px", 'oconnor')  => '2px',
                    esc_html__("3px", 'oconnor')  => '3px',
                    esc_html__("4px", 'oconnor')  => '4px',
                    esc_html__("5px", 'oconnor')  => '5px',
                    esc_html__("10px", 'oconnor') => '10px',
                    esc_html__("15px", 'oconnor') => '15px',
                    esc_html__("20px", 'oconnor') => '20px',
                    esc_html__("25px", 'oconnor') => '25px',
                    esc_html__("30px", 'oconnor') => '30px',
                    esc_html__("35px", 'oconnor') => '35px',
                ),
                'std'              => 'none',
                'group'            => esc_html__('Design Options', 'oconnor'),
                'dependency'       => array(
                    'element'            => 'border_style',
                    "value_not_equal_to" => "none"
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // ----- Border end -----
            array(
                'type'       => 'css_editor',
                'param_name' => 'css_banner',
                'group'      => esc_html__('Design Options', 'oconnor'),
            ),

        )
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Banner extends WPBakeryShortCodesContainer {

        }
    }
}