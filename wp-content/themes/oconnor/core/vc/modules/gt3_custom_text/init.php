<?php
if (!defined('ABSPATH')) {
    die('-1');
}

$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
    // Add list item
    vc_map(array(
        'name'            => esc_html__('Custom Text', 'oconnor'),
        'base'            => 'gt3_custom_text',
        'class'           => 'gt3_custom_text',
        'category'        => esc_html__('GT3 Modules', 'oconnor'),
        'icon'            => 'gt3_icon',
        'content_element' => true,
        'description'     => esc_html__('Custom Text', 'oconnor'),
        'params'          => array(
            // Icon Section
            array(
                'type'       => 'textarea_html',
                'holder'     => 'div',
                'heading'    => esc_html__('Content', 'oconnor'),
                'param_name' => 'content',
            ),
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Line-break setting "<br />"', 'oconnor'),
                'param_name'  => 'line_break',
                'options'     => array(
                    esc_html__('Default', 'oconnor')             => 'default',
                    esc_html__('Hide since notebook', 'oconnor') => 'notebook',
                    esc_html__('Hide since tablet', 'oconnor')   => 'tablet',
                    esc_html__('Hide since mobile', 'oconnor')   => 'mobile',
                ),
                'std'         => 'default',
                'description' => esc_html__('Notice: instead of the "<br />" will be showed empty break.', 'oconnor')
            ),
            vc_map_add_css_animation(true),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Extra Class', 'oconnor'),
                'param_name'  => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'oconnor')
            ),
            // Styling

            /* Separator */
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Activate Separator', 'oconnor'),
                'param_name'       => 'separator',
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-3',
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
            ),
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Inner style', 'oconnor'),
                'param_name'       => 'separator_inner',
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-3 pt-0',
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
                'dependency'       => array(
                    'element' => 'separator',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'colorpicker',
                'heading'          => esc_html__('Separator Color', 'oconnor'),
                'param_name'       => 'separator_color',
                'group'            => esc_html__('Styling', 'oconnor'),
                'value'            => 'rgba(249,249,250,0.3)',
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-6 pt-0',
                'dependency'       => array(
                    'element' => 'separator',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Margin-top', 'oconnor'),
                'param_name'       => 'margin_top',
                'value'            => '22',
                'description'      => esc_html__('Enter margin-top in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'separator',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Max-width', 'oconnor'),
                'param_name'       => 'maxwidth',
                'value'            => '70px',
                'description'      => esc_html__('Enter max-width with units (default: 70px).', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'separator',
                    'value'   => 'yes'
                ),
            ),
            /* Separator end */

            array(
                'type'        => 'colorpicker',
                'heading'     => esc_html__('Text Color', 'oconnor'),
                'param_name'  => 'text_color',
                'group'       => esc_html__('Styling', 'oconnor'),
                'value'       => esc_attr($main_font['color']),
                'save_always' => true,
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size', 'oconnor'),
                'param_name'       => 'font_size',
                'value'            => (int)$main_font['font-size'],
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Line Height', 'oconnor'),
                'param_name'       => 'line_height',
                'value'            => '165',
                'description'      => esc_html__('Enter line height in %.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Set Responsive Font Size', 'oconnor'),
                'param_name' => 'responsive_font',
                'group'      => esc_html__('Styling', 'oconnor'),
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for small Desktops', 'oconnor'),
                'param_name'       => 'font_size_sm_desktop',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_font',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Tablets', 'oconnor'),
                'param_name'       => 'font_size_tablet',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_font',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Font Size for Mobile', 'oconnor'),
                'param_name'       => 'font_size_mobile',
                'description'      => esc_html__('Enter font-size in pixels.', 'oconnor'),
                'group'            => esc_html__('Styling', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element' => 'responsive_font',
                    'value'   => 'yes'
                ),
            ),
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family?', 'oconnor'),
                'param_name'  => 'use_theme_fonts',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                'group'       => esc_html__('Styling', 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'google_fonts_text',
                'value'      => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
                'dependency' => array(
                    'element'            => 'use_theme_fonts',
                    'value_not_equal_to' => 'yes',
                ),
                'group'      => esc_html__('Styling', 'oconnor'),
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Set Full Width', 'oconnor'),
                'param_name' => 'full_width',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'group'      => esc_html__('Design Option', 'oconnor'),
                'std'        => 'yes',
            ),
            array(
                'type'       => 'css_editor',
                'param_name' => 'css',
                'group'      => esc_html__('Design Option', 'oconnor'),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_custom_text extends WPBakeryShortCode {

        }
    }
}
