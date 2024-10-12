<?php
if (!defined('ABSPATH')) {
    die('-1');
}

$header_font = gt3_option('header-font');
$main_font   = gt3_option('main-font');

if (function_exists('vc_map')) {
    // Add list item
    vc_map(array(
        "name"            => esc_html__("Icon Box", 'oconnor'),
        "base"            => "gt3_icon_box",
        "class"           => "gt3_icon_box",
        "category"        => esc_html__('GT3 Modules', 'oconnor'),
        "icon"            => 'gt3_icon',
        "content_element" => true,
        "description"     => esc_html__("Icon Box", 'oconnor'),
        "params"          => array(
            // Icon Section
            array(
                "type"        => "gt3_custom_select",
                "heading"     => esc_html__('Icon Type', 'oconnor'),
                "param_name"  => "icon_type",
                "options"     => array(
                    esc_html__('None', 'oconnor')   => 'none',
                    esc_html__('Font', 'oconnor')   => 'font',
                    esc_html__('Image', 'oconnor')  => 'image',
                    esc_html__('Number', 'oconnor') => 'number',
                ),
                'std'         => 'none',
                'save_always' => true,
            ),
            array(
                "type"       => "textfield",
                "heading"    => esc_html__('Number', 'oconnor'),
                "param_name" => "number",
                'dependency' => array(
                    'element' => 'icon_type',
                    'value'   => 'number',
                ),
            ),
            array(
                'type'        => 'iconpicker',
                'heading'     => esc_html__('Icon', 'oconnor'),
                'param_name'  => 'icon_fontawesome',
                'value'       => 'fa fa-adjust', // default value to backend editor admin_label
                'settings'    => array(
                    'emptyIcon'    => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__('Select icon from library.', 'oconnor'),
                'dependency'  => array(
                    'element' => 'icon_type',
                    'value'   => 'font',
                ),
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__('Image', 'oconnor'),
                'param_name'  => 'thumbnail',
                'value'       => '',
                'description' => esc_html__('Select image from media library.', 'oconnor'),
                'dependency'  => array(
                    'element' => 'icon_type',
                    'value'   => array('image'),
                ),
            ),
            array(
                "type"             => "gt3_custom_select",
                "heading"          => esc_html__('Select the Position of this module', 'oconnor'),
                "param_name"       => "icon_box_horizontal_position",
                "options"          => array(
                    esc_html__('Default', 'oconnor') => 'default',
                    esc_html__('Left', 'oconnor')    => 'left',
                    esc_html__('Right', 'oconnor')   => 'right',
                    esc_html__('Center', 'oconnor')  => 'center'
                ),
                'std'              => 'default',
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                "type"             => "gt3_custom_select",
                "heading"          => esc_html__('Icon Position', 'oconnor'),
                "param_name"       => "icon_position",
                "options"          => array(
                    esc_html__('Top', 'oconnor')               => 'top',
                    esc_html__('Left', 'oconnor')              => 'left',
                    esc_html__('Right', 'oconnor')             => 'right',
                    esc_html__('Inline with Title', 'oconnor') => 'inline_title'
                ),
                'std'              => 'top',
                'dependency'       => array(
                    'element' => 'icon_type',
                    'value'   => array('font', 'image'),
                ),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-12',
            ),
            /*array(
                "type"             => "gt3_on_off",
                "heading"          => esc_html__('Set Icon below the Title', 'oconnor'),
                "param_name"       => "icon_below",
                'dependency'       => array(
                    'element' => 'icon_position',
                    'value'   => array('inline_title'),
                ),
                'edit_field_class' => 'vc_col-sm-12',
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
            ),*/
            array(
                "type"             => "gt3_custom_select",
                "heading"          => esc_html__('Icon Vertical Position', 'oconnor'),
                "param_name"       => "icon_vertical_position",
                "options"          => array(
                    esc_html__('Default', 'oconnor') => 'default',
                    esc_html__('Top', 'oconnor')     => 'top',
                    esc_html__('Middle', 'oconnor')  => 'center',
                    esc_html__('Bottom', 'oconnor')  => 'bottom'
                ),
                'std'              => 'default',
                'dependency'       => array(
                    'element' => 'icon_position',
                    'value'   => array('left', 'right'),
                ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Elements gap", 'oconnor'),
                "param_name"  => "element_gap",
                'dependency'  => array(
                    'element' => 'icon_position',
                    'value'   => array('left', 'right'),
                ),
                "description" => esc_html__("Enter gap between text block and icon in pixels.", 'oconnor'),
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Heading", 'oconnor'),
                "param_name"  => "heading",
                "description" => esc_html__("Enter text for heading line.", 'oconnor'),
                'admin_label' => true,
            ),
            array(
                "type"        => "textarea",
                "heading"     => esc_html__("Text", 'oconnor'),
                "param_name"  => "text",
                "description" => esc_html__("Enter text.", 'oconnor')
            ),
            array(
                "type"       => "textfield",
                "heading"    => esc_html__('Link', 'oconnor'),
                "param_name" => "url",
            ),
            array(
                "type"       => "textfield",
                "heading"    => esc_html__('Link Text', 'oconnor'),
                "param_name" => "url_text",
            ),
            array(
                "type"        => "gt3_on_off",
                "heading"     => esc_html__('Open in New Tab', 'oconnor'),
                "param_name"  => "new_tab",
                'save_always' => true,
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'         => 'no',
            ),
            array(
                "type"        => "gt3_on_off",
                "heading"     => esc_html__('Icon in circle', 'oconnor'),
                "param_name"  => "icon_circle",
                'save_always' => true,
                'dependency'  => array(
                    'element'            => 'icon_type',
                    'value_not_equal_to' => array('number'),
                ),
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'         => 'no',
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => esc_html__('Circle Color', 'oconnor'),
                "param_name"  => "circle_bg",
                "value"       => '#e9e9e9',
                'save_always' => true,
                'dependency'  => array(
                    'element' => 'icon_circle',
                    'value'   => "yes",
                ),
            ),
            array(
                "type"       => "gt3_on_off",
                "heading"    => esc_html__('Add divider after Heading', 'oconnor'),
                "param_name" => "add_divider",
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',

            ),
            array(
                "type"        => "colorpicker",
                "heading"     => esc_html__('Divider Color', 'oconnor'),
                "param_name"  => "divider_color",
                "value"       => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
                'dependency'  => array(
                    'element' => 'add_divider',
                    'value'   => "yes",
                ),
            ),
            vc_map_add_css_animation(true),
            // Styling
            array(
                "type"             => "gt3_custom_select",
                "heading"          => esc_html__('Icon Size', 'oconnor'),
                "param_name"       => "icon_size",
                "options"          => array(
                    esc_html__('Regular', 'oconnor') => 'regular',
                    esc_html__('Mini', 'oconnor')    => 'mini',
                    esc_html__('Small', 'oconnor')   => 'small',
                    esc_html__('Large', 'oconnor')   => 'large',
                    esc_html__('Huge', 'oconnor')    => 'huge',
                    esc_html__('Custom', 'oconnor')  => 'custom'
                ),
                'std'              => 'regular',
                "group"            => esc_html__("Styling", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Custom icon size
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Custom Icon Size(px)', 'oconnor'),
                'param_name'       => 'custom_icon_size',
                'value'            => '18',
                "group"            => esc_html__("Styling", 'oconnor'),
                'dependency'       => array(
                    'element' => 'icon_size',
                    'value'   => 'custom',
                ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => esc_html__('Icon Color', 'oconnor'),
                "param_name"  => "icon_color",
                "group"       => esc_html__("Styling", 'oconnor'),
                "value"       => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
                'dependency'  => array(
                    'element' => 'icon_type',
                    'value'   => array('font', 'number'),
                ),
            ),

            array(
                'type'       => 'backend_divider',
                'heading'    => '',
                'param_name' => 'backend_divider',
                'group'      => esc_html__('Styling', 'oconnor'),
            ),
            array(
                "type"        => "gt3_custom_select",
                "heading"     => esc_html__('Title Tag', 'oconnor'),
                "param_name"  => "title_tag",
                'options'     => array(
                    esc_html__('H2', 'oconnor') => 'h2',
                    esc_html__('H3', 'oconnor') => 'h3',
                    esc_html__('H4', 'oconnor') => 'h4',
                    esc_html__('H5', 'oconnor') => 'h5',
                    esc_html__('H6', 'oconnor') => 'h6',
                ),
                'std'         => 'h2',
                'save_always' => true,
                "group"       => esc_html__("Styling", 'oconnor'),
            ),
            // Icon Box title Font Size
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Icon Box Title Font Size', 'oconnor'),
                'param_name'       => 'iconbox_title_size',
                'value'            => '28',
                'description'      => esc_html__('Enter Icon Box title font-size in pixels.', 'oconnor'),
                "group"            => esc_html__("Styling", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Line Height', 'oconnor'),
                'param_name'       => 'title_line_height',
                'value'            => '165',
                'description'      => esc_html__('Enter line height in %.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Set Responsive Title Font Size', 'oconnor'),
                'param_name' => 'responsive_title_font',
                'group'      => esc_html__('Styling', 'oconnor'),
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'       => 'title_font_size_sm_desktop',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_title_font',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'       => 'title_font_size_tablet',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_title_font',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'       => 'title_font_size_mobile',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_title_font',
                    'value'   => 'yes'
                ),
            ),

            array(
                "type"             => "gt3_custom_select",
                "heading"          => esc_html__('Select the Position of the Title', 'oconnor'),
                "param_name"       => "title_align_position",
                "options"          => array(
                    esc_html__('Left', 'oconnor')    => 'left',
                    esc_html__('Right', 'oconnor')   => 'right',
                    esc_html__('Center', 'oconnor')  => 'center'
                ),
                'std'              => 'left',
                'group'            => esc_html__('Styling', 'oconnor'),
            ),
            // Iconbox Title Fonts
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family for iconbox title?', 'oconnor'),
                'param_name'  => 'use_theme_fonts_iconbox_title',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                "group"       => esc_html__("Styling", 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_title',
                'value'      => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
                'dependency' => array(
                    'element'            => 'use_theme_fonts_iconbox_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group"      => esc_html__("Styling", 'oconnor'),
            ),

            // Icon Box content Font Size
            array(
                'type'       => 'backend_divider',
                'heading'    => '',
                'param_name' => 'backend_divider',
                'group'      => esc_html__('Styling', 'oconnor'),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Icon Box Content Font Size', 'oconnor'),
                'param_name'       => 'iconbox_content_size',
                'value'            => '14',
                'description'      => esc_html__('Enter Icon Box content font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Line Height', 'oconnor'),
                'param_name'       => 'content_line_height',
                'value'            => '165',
                'description'      => esc_html__('Enter line height in %.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Set Responsive Content Font Size', 'oconnor'),
                'param_name' => 'responsive_content_font',
                'group'      => esc_html__('Styling', 'oconnor'),
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'       => 'content_font_size_sm_desktop',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_content_font',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'       => 'content_font_size_tablet',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_content_font',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'       => 'content_font_size_mobile',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_content_font',
                    'value'   => 'yes'
                ),
            ),

            array(
                "type"             => "gt3_custom_select",
                "heading"          => esc_html__('Select the Position of the Content', 'oconnor'),
                "param_name"       => "content_align_position",
                "options"          => array(
                    esc_html__('Left', 'oconnor')    => 'left',
                    esc_html__('Right', 'oconnor')   => 'right',
                    esc_html__('Center', 'oconnor')  => 'center'
                ),
                'std'              => 'left',
                'group'            => esc_html__('Styling', 'oconnor'),
            ),
            // Iconbox content Fonts
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family for iconbox content?', 'oconnor'),
                'param_name'  => 'use_theme_fonts_iconbox_content',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                "group"       => esc_html__("Styling", 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_content',
                'value'      => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
                'dependency' => array(
                    'element'            => 'use_theme_fonts_iconbox_content',
                    'value_not_equal_to' => 'yes',
                ),
                "group"      => esc_html__("Styling", 'oconnor'),
            ),

            array(
                'type'       => 'backend_divider',
                'heading'    => '',
                'param_name' => 'backend_divider',
                'group'      => esc_html__('Styling', 'oconnor'),
            ),
            // Icon Box button alignment
            array(
                'type'             => 'gt3_custom_select',
                'heading'          => esc_html__('Icon Box button alignment', 'oconnor'),
                'param_name'       => 'iconbox_button_align',
                "options"          => array(
                    esc_html__('default', 'oconnor') => 'default',
                    esc_html__('left', 'oconnor')    => 'left',
                    esc_html__('center', 'oconnor')  => 'center',
                    esc_html__('right', 'oconnor')   => 'right',
                ),
                'save_always'      => true,
                'std'              => 'default',
                'description'      => esc_html__('Enter Icon Box button text-align (left, right, center).', 'oconnor'),
                "group"            => esc_html__("Styling", 'oconnor'),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => esc_html__('Title Color', 'oconnor'),
                "param_name"  => "title_color",
                "group"       => esc_html__("Styling", 'oconnor'),
                "value"       => esc_attr($header_font['color']),
                'save_always' => true,
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => esc_html__('Text Color', 'oconnor'),
                "param_name"  => "text_color",
                "group"       => esc_html__("Styling", 'oconnor'),
                "value"       => esc_attr($main_font['color']),
                'save_always' => true,
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => esc_html__('Link Color', 'oconnor'),
                "param_name"  => "link_color",
                "group"       => esc_html__("Styling", 'oconnor'),
                "value"       => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
            ),
            array(
                "type"        => "colorpicker",
                "heading"     => esc_html__('Link Hover Color', 'oconnor'),
                "param_name"  => "link_hover_color",
                "group"       => esc_html__("Styling", 'oconnor'),
                "value"       => esc_attr($header_font['color']),
                'save_always' => true,
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_icon_box extends WPBakeryShortCode {

        }
    }
}
