<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base'          => 'gt3_video_popup',
        'name'          => esc_html__('Video Popup', 'oconnor'),
        'description'   => esc_html__('Video Popup Widget', 'oconnor'),
        'category'      => esc_html__('GT3 Modules', 'oconnor'),
        'icon'          => 'gt3_icon',
        'params'        => array(
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Title', 'oconnor'),
                'param_name'        => 'video_title',
                'description'       => esc_html__('Enter title.', 'oconnor')
            ),
            array(
                'type'              => 'attach_image',
                'heading'           => esc_html__('Background Image Video', 'oconnor'),
                'param_name'        => 'bg_image',
                'description'       => esc_html__('Select video background image.', 'oconnor'),
                'std'               => ''
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Video Link', 'oconnor'),
                'param_name'        => 'video_link',
                'description'       => esc_html__('Enter video link from youtube or vimeo.', 'oconnor')
            ),
            array(
                'type'              => 'gt3_custom_select',
                'heading'           => esc_html__( 'Icon Align', 'oconnor' ),
                'param_name'        => 'align',
                'options'             => array(
                    esc_html__( 'left', 'oconnor' )   => 'left',
                    esc_html__( 'center', 'oconnor' ) => 'center',
                    esc_html__( 'right', 'oconnor' )  => 'right',
                ),
                'std'               => 'center',
            ),

            /* styling video popup */
            array(
                'type'              => 'colorpicker',
                'heading'           => esc_html__('Title color', 'oconnor'),
                'param_name'        => 'title_color',
                'value'             => esc_attr(gt3_option('theme-custom-color')),
                'description'       => esc_html__('Select custom color for title.', 'oconnor'),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
            ),
            array(
                'type'              => 'colorpicker',
                'heading'           => esc_html__('Button icon color', 'oconnor'),
                'param_name'        => 'btn_color',
                'value'             => '#ffffff',
                'description'       => esc_html__('Select custom color for button.', 'oconnor'),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
            ),
            array(
                'type'              => 'colorpicker',
                'heading'           => esc_html__('Button background color', 'oconnor'),
                'param_name'        => 'btn_background_color',
                'value'             => 'transparent',
                'description'       => esc_html__('Select custom color for button.', 'oconnor'),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
            ),

            // Video Popup Title Fonts
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use theme default font family for Video Popup title?', 'oconnor' ),
                'param_name'        => 'use_theme_fonts_vpopup_title',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'description'       => esc_html__( 'Use font family from the theme.', 'oconnor' ),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'std'               => 'yes',
            ),
            array(
                'type'              => 'google_fonts',
                'param_name'        => 'google_fonts_vpopup_title',
                'value'             => '',
                'settings'          => array(
                    'fields'        => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                        'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                    ),
                ),
                'dependency'        => array(
                    'element'            => 'use_theme_fonts_vpopup_title',
                    'value_not_equal_to' => 'yes',
                ),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
            ),

            // Icon Box content Font Size
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Video Popup Content Font Size', 'oconnor'),
                'param_name'        => 'title_size',
                'value'             => '24',
                'description'       => esc_html__( 'Enter Video Popup Title font-size in pixels.', 'oconnor' ),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
            ),

            // Animation
            array(
                'type'              => 'gt3_on_off',
                'heading'           => esc_html__( 'Use animation for button?', 'oconnor' ),
                'param_name'        => 'button_animation',
                'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'std'               => 'no',
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Count Lines', 'oconnor'),
                'param_name'        => 'count_lines',
                'value'             => 4,
                'description'       => esc_html__( 'Enter the count of lines.', 'oconnor' ),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
                'dependency'        => array(
                    'element'   => 'button_animation',
                    'value'     => 'yes',
                ),
            ),
            array(
                'type'              => 'colorpicker',
                'heading'           => esc_html__('Color lines', 'oconnor'),
                'param_name'        => 'color_lines',
                'value'             => '#ffffff',
                'description'       => esc_html__('Select the color lines.', 'oconnor'),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
                'dependency'        => array(
                    'element'   => 'button_animation',
                    'value'     => 'yes',
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Diameter for the animation', 'oconnor'),
                'param_name'        => 'diameter_lines',
                'value'             => 200,
                'description'       => esc_html__( 'Enter the diameter for the animation in pixels.', 'oconnor' ),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
                'dependency'        => array(
                    'element'   => 'button_animation',
                    'value'     => 'yes',
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Line width', 'oconnor'),
                'param_name'        => 'lines_width',
                'value'             => 3,
                'description'       => esc_html__( 'Enter the line width for the animation in pixels.', 'oconnor' ),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
                'dependency'        => array(
                    'element'   => 'button_animation',
                    'value'     => 'yes',
                ),
            ),
            array(
                'type'              => 'textfield',
                'heading'           => esc_html__('Shadow Line width', 'oconnor'),
                'param_name'        => 'shadow_lines_width',
                'value'             => 0,
                'description'       => esc_html__( 'Enter the shadow width for the animation in pixels.', 'oconnor' ),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
                'dependency'        => array(
                    'element'   => 'button_animation',
                    'value'     => 'yes',
                ),
            ),
            array(
                'type'              => "textfield",
                'heading'           => esc_html__( 'Transition delay between appearances', 'oconnor' ),
                'param_name'        => "lines_delay",
                'value'             => 400,
                'description'       => esc_html__('Enter transition delay between appearances in miliseconds. Element will be animate when it "enters" the browsers viewport', 'oconnor'),
                'group'             => esc_html__( 'Styling', 'oconnor' ),
                'edit_field_class'  => 'vc_col-sm-6',
                'dependency'        => array(
                    'element'   => 'button_animation',
                    'value'     => 'yes',
                ),
            ),
        ),
    ));

    class WPBakeryShortCode_Gt3_Video_Popup extends WPBakeryShortCode { }
}