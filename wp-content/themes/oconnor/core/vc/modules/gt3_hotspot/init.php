<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
	vc_map(array(
		'name' 				=> esc_html__('Hotspot','oconnor'),
		'base' 				=> 'gt3_hotspot',
		'class' 			=> 'gt3_hotspot',
		'category' 			=> esc_html__('GT3 Modules', 'oconnor'),
		'icon' 				=> 'gt3_icon',
		'content_element' 	=> true,
		'description' 		=> esc_html__('GT3 Hotspot','oconnor'),
		'params' 			=> array(
			array(
				'type' 				=> 'attach_image',
				'heading' 			=> esc_html__('Image','oconnor'),
				'description' 		=> esc_html__('Select the image from the media library','oconnor'),
				'param_name' 		=> 'attach_image',
				'edit_field_class' 	=> 'vc_col-sm-12 pt-15',
				'admin_label'       => true,
			),

			/* INIT Hotspot */
			array(
				'type' 				=> 'gt3_init_hotspot',
				'heading' 			=> '',
				'param_name' 		=> 'init_hotspot',
				'description' 		=> esc_html__('Please click on the picture in the place where you need to set the marker', 'oconnor'),
				'edit_field_class'	=> 'vc_col-sm-12',
			),
            array(
                'type'          	=> 'backend_divider',
                'heading'       	=> '',
                'param_name'    	=> 'backend_divider',
            ),
			/* INIT Hotspot end */

			array(
				'type' 				=> 'gt3_custom_select',
				'heading' 			=> esc_html__('Action', 'oconnor'),
				'param_name' 		=> 'hotspot_action',
				'edit_field_class' 	=> 'vc_col-sm-6',
				'options' 			=> array(
					esc_html__('Hover','oconnor') 		 => 'hover',
					esc_html__('Click','oconnor') 		 => 'click',
					esc_html__('Visible','oconnor') 	 => 'visible',
					esc_html__('Only Marker','oconnor') => 'only_marker'
				),
				'description' 		=> esc_html__('Select hover/click action', 'oconnor'),
			),

			array(
				'type'				=> "textfield",
				'heading' 			=> esc_html__( 'Transition delay between appearances', 'oconnor' ),
				'param_name' 		=> "transition_delay",
				'value' 			=> 400,
				'description' 		=> esc_html__('Enter transition delay between appearances in miliseconds. Element will be animate when it "enters" the browsers viewport (Note: works only in modern browsers)', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-12',
			),
            vc_map_add_css_animation( true ),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Extra Class', 'oconnor'),
				'param_name' 		=> 'item_el_class',
				'description' 		=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'oconnor')
			),

			/* Group Marker */
			array(
				'type' 				=> 'gt3_custom_select',
				'heading' 			=> esc_html__('Marker style','oconnor'),
				'param_name' 		=> 'marker_style',
				'edit_field_class' 	=> 'vc_col-sm-12',
				'options' 			=> array(
					esc_html__('Circle', 'oconnor') => 'circle',
					esc_html__('Text', 'oconnor') 	 => 'text',
					esc_html__('Image', 'oconnor')  => 'image'
				),
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'description' 		=> esc_html__('Marker style. Select circle style or  select "text" and enter text below or upload image from the media library', 'oconnor'),
			),
            array(
                'type'          	=> 'backend_divider',
                'heading'       	=> esc_html__('Set Gap between marker and Tooltip', 'oconnor'),
                'param_name'    	=> 'backend_divider',
				'group' 			=> esc_html__('Marker', 'oconnor'),
            ),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Top Gap', 'oconnor'),
				'param_name' 		=> 'tooltip_padding_1',
				'value' 			=> 0,
				'edit_field_class' 	=> 'vc_col-sm-3',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Enter Gap in pixels', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Right Gap', 'oconnor'),
				'param_name' 		=> 'tooltip_padding_2',
				'value' 			=> 0,
				'edit_field_class' 	=> 'vc_col-sm-3',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Enter Gap in pixels', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Bottom Gap', 'oconnor'),
				'param_name' 		=> 'tooltip_padding_3',
				'value' 			=> 0,
				'edit_field_class' 	=> 'vc_col-sm-3',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Enter Gap in pixels', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Left Gap', 'oconnor'),
				'param_name' 		=> 'tooltip_padding_4',
				'value' 			=> 0,
				'edit_field_class' 	=> 'vc_col-sm-3',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Enter Gap in pixels', 'oconnor'),
			),
            array(
                "type"          	=> "backend_divider",
                "heading"       	=> esc_html__("Set Gap between marker and Tooltip", 'oconnor'),
                "param_name"    	=> "backend_divider",
            ),

            array(
                'type'          	=> 'gt3_custom_select',
                'heading'       	=> esc_html__( 'Hotspot Line Type', 'oconnor' ),
                'param_name'    	=> 'tooltip_hotspotline_type',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-12',
                'options'         	=> array(
                    esc_html__( 'None', 'oconnor' )   => 'none',
                    esc_html__( 'Solid', 'oconnor' )  => 'solid',
                    esc_html__( 'Dashed', 'oconnor' ) => 'dashed',
                    esc_html__( 'Dotted', 'oconnor' ) => 'dotted',
                ),
            ),
            array(
                'type'          	=> 'textfield',
                'heading'       	=> esc_html__( 'Hotspot Line Width in pixels', 'oconnor' ),
                'param_name'    	=> 'tooltip_hotspotline_width',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-12',
                'value'         	=> '150',
				'dependency' 		=> array(
					'element' 			 => 'tooltip_hotspotline_type',
					'value_not_equal_to' => 'none',
				),
            ),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'tooltip_hotspotline_color',
				'heading' 			=> esc_html__('Hotspot Line Color', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-12',
				'value' 			=> '#d71f01',
				'dependency' 		=> array(
					'element' 			 => 'tooltip_hotspotline_type',
					'value_not_equal_to' => 'none',
				),
				'group' 			=> esc_html__('Marker', 'oconnor'),
			),

			/* Default Circle Style */
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'marker_circle_color_1',
				'heading' 			=> esc_html__('Marker background (Outer)', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'value' 			=> 'rgba(215,31,1,0.37)',
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'circle',
				),
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'description' 		=> esc_html__('Change the outer background color of the marker', 'oconnor'),
			),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'marker_circle_color_2',
				'heading' 			=> esc_html__('Marker background (Inner)', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'value' 			=> '#d71f01',
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'circle',
				),
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'description' 		=> esc_html__('Change the inner background color of the marker', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Marker Outer width (px)', 'oconnor'),
				'param_name' 		=> 'marker_outer_width',
				'value' 			=> 28,
				'edit_field_class' 	=> 'vc_col-sm-6',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'circle',
				),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Marker Inner width (px)', 'oconnor'),
				'param_name' 		=> 'marker_inner_width',
				'value' 			=> 20,
				'edit_field_class' 	=> 'vc_col-sm-6',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'circle',
				),
			),
			array(
				'type' 				=> 'gt3_on_off',
				'heading' 			=> esc_html__( 'Marker Pulse', 'oconnor' ),
				'param_name' 		=> 'marker_pulse',
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
				'edit_field_class' 	=> 'vc_col-sm-12',
				'dependency' 		=> array(
					'element'  	=> 'marker_style',
					'value' 	=> 'circle',
				),
                'std'              => 'no',
			),
			array(
				'type' 				=> 'gt3_custom_select',
				'heading' 			=> esc_html__('Marker Pulse style','oconnor'),
				'param_name' 		=> 'marker_pulse_style',
				'edit_field_class' 	=> 'vc_col-sm-6',
				'options' 			=> array(
					esc_html__('Default', 'oconnor') 			 => 'default',
					esc_html__('Toward the Outside', 'oconnor') => 'outside',
					esc_html__('Flashing', 'oconnor') 			 => 'flashing'
				),
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'marker_pulse',
					'value' 	=> 'yes'
				),
				'description' 		=> esc_html__('Change the pulse style', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Marker Pulse Animation Duration (ms)', 'oconnor'),
				'param_name' 		=> 'marker_pulse_duration',
				'value' 			=> 2000,
				'edit_field_class' 	=> 'vc_col-sm-6',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'marker_pulse',
					'value' 	=> 'yes'
				),
			),
			/* Default Marker Style end */

			/* Text Marker Style */
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Font Size', 'oconnor'),
				'param_name' 		=> 'marker_font_size',
				'value' 			=> (int)$main_font['font-size'],
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'text',
				),
				'description' 		=> esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
				'edit_field_class' 	=> 'vc_col-sm-6',
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Line-height', 'oconnor'),
				'param_name' 		=> 'marker_line_height',
				'value' 			=> 140,
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'text',
				),
				'description' 		=> esc_html__( 'Enter line-height in %.', 'oconnor' ),
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
				'edit_field_class' 	=> 'vc_col-sm-6',
			),
			array(
				'type' 				=> 'gt3_on_off',
				'heading' 			=> esc_html__( 'Set Responsive Font Size', 'oconnor' ),
				'param_name' 		=> 'responsive_font',
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
				'edit_field_class' 	=> 'vc_col-sm-12',
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'text',
				),
                'std'              => 'no',
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Small Desktops', 'oconnor'),
				'param_name' 		=> 'font_size_sm_desktop',
				'description' 		=> esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
				'edit_field_class' 	=> 'vc_col-sm-4',
				'dependency' 		=> array(
					'element' 	=> 'responsive_font',
					'value' 	=> 'yes'
				),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Tablets', 'oconnor'),
				'param_name' 		=> 'font_size_tablet',
				'description' 		=> esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
				'edit_field_class' 	=> 'vc_col-sm-4',
				'dependency' 		=> array(
					'element' 	=> 'responsive_font',
					'value' 	=> 'yes'
				),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Mobile', 'oconnor'),
				'param_name' 		=> 'font_size_mobile',
				'description' 		=> esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
				'edit_field_class' 	=> 'vc_col-sm-4',
				'dependency' 		=> array(
					'element' 	=> 'responsive_font',
					'value' 	=> 'yes'
				),
			),
			array(
				'type' 				=> 'gt3_on_off',
				'heading' 			=> esc_html__( 'Use theme default font family?', 'oconnor' ),
				'param_name' 		=> 'use_theme_fonts_marker',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
				'std' 				=> 'yes',
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'text',
				),
				'description' 		=> esc_html__( 'Use font family from the theme to this marker text.', 'oconnor' ),
			),
			array(
				'type' 				=> 'google_fonts',
				'param_name' 		=> 'google_fonts_marker_text',
				'value' 			=> '',
				'settings' 			=> array(
					'fields' 	=> array(
						'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
					),
				),
				'dependency' 		=> array(
					'element' 			 => 'use_theme_fonts_marker',
					'value_not_equal_to' => 'yes',
				),
				'group' 			=> esc_html__( 'Marker', 'oconnor' ),
			),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'marker_text_color_1',
				'heading' 			=> esc_html__('Text marker color', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'value' 			=> '#232325',
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'text',
				),
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'description' 		=> esc_html__('Change the color of the text marker', 'oconnor'),
			),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'marker_text_bgcolor_2',
				'heading' 			=> esc_html__('Marker background', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'value' 			=> '#ffffff',
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'text',
				),
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'description' 		=> esc_html__('Change the background color of the text marker', 'oconnor'),
			),
			/* Text Marker Style end */

			/* Image Marker Style */
			array(
				'type' 				=> 'attach_image',
				'heading' 			=> esc_html__('Image marker','oconnor'),
				'param_name' 		=> 'marker_image',
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'image',
				),
				'edit_field_class' 	=> 'vc_col-sm-4',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'description' 		=> esc_html__('Choose the image from the media library', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Image width', 'oconnor'),
				'param_name' 		=> 'marker_image_width',
				'value' 			=> '40',
				'edit_field_class' 	=> 'vc_col-sm-4',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'image',
				),
				'description' 		=> esc_html__('Enter image width in pixels', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Image height', 'oconnor'),
				'param_name' 		=> 'marker_image_height',
				'value' 			=> '40',
				'edit_field_class' 	=> 'vc_col-sm-4',
				'group' 			=> esc_html__('Marker', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'marker_style',
					'value' 	=> 'image',
				),
				'description' 		=> esc_html__('Enter image height in pixels', 'oconnor'),
			),
			/* Image Marker Style end */

			/* Tooltip options */
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__('Tooltip position','oconnor'),
				'param_name' 		=> 'tooltip_position',
				'value' 			=> array(
					esc_html__('Top', 'oconnor') 			=> 'tooltip-top',
					esc_html__('Bottom', 'oconnor') 		=> 'tooltip-bottom',
					esc_html__('Left', 'oconnor') 			=> 'tooltip-left',
					esc_html__('Right', 'oconnor') 		=> 'tooltip-right',
					esc_html__('Top Left', 'oconnor') 		=> 'tooltip-top-left',
					esc_html__('Top Right', 'oconnor') 	=> 'tooltip-top-right',
					esc_html__('Bottom Left', 'oconnor') 	=> 'tooltip-bottom-left',
					esc_html__('Bottom Right', 'oconnor')	=> 'tooltip-bottom-right',
					esc_html__('Top on both sides', 'oconnor')		=> 'tooltip-both-top',
					esc_html__('Middle on both sides', 'oconnor')	=> 'tooltip-both-middle',
					esc_html__('Bottom on both sides', 'oconnor')	=> 'tooltip-both-bottom',
				),
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'std' 				=>'tooltip-bottom',
				'edit_field_class' 	=> 'vc_col-sm-12',
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Select the location of the tooltip relative to the marker', 'oconnor'),
			),
			array(
				'type' 				=> 'gt3_custom_select',
				'heading' 			=> esc_html__('Tooltip animation','oconnor'),
				'param_name' 		=> 'tooltip_animation',
				'options' 			=> array(
					esc_html__('Slide', 'oconnor') => 'tooltip_animation-slide',
					esc_html__('Fade', 'oconnor') 	=> 'tooltip_animation-fade',
				),
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Select the location of the tooltip relative to the marker', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Tooltip animation time', 'oconnor'),
				'param_name' 		=> 'tooltip_animation_time',
				'value' 			=> 200,
				'edit_field_class' 	=> 'vc_col-sm-6',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Enter animation time in ms', 'oconnor'),
			),
            array(
				'type' 				=> 'gt3_custom_select',
				'heading' 			=> esc_html__( 'Tooltip animation function', 'oconnor' ),
				'param_name' 		=> 'tooltip_animation_func',
				'admin_label' 		=> false,
				'options' 			=> array(
					esc_html__( 'Ease', 'oconnor' ) 		=> 'ease',
					esc_html__( 'Ease-In', 'oconnor' ) 	=> 'ease-in',
					esc_html__( 'Ease-Out', 'oconnor' ) 	=> 'ease-out',
					esc_html__( 'Ease-In-Out', 'oconnor' )	=> 'ease-in-out',
					esc_html__( 'Linear', 'oconnor' )		=> 'linear',
				),
				'std' 				=> 'easy-in',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
			),
			array(
				'type' 				=> 'gt3_custom_select',
				'heading' 			=> esc_html__('Alignment Text in the tooltip ','oconnor'),
				'param_name' 		=> 'tooltip_content_align',
				'options' 			=> array(
					esc_html__('Left', 'oconnor') 	 => 'left',
					esc_html__('Right', 'oconnor')  => 'right',
					esc_html__('Center', 'oconnor') => 'center',
					esc_html__('GT3 Custom', 'oconnor') => 'text-gt3_custom',
				),
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-12',
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Select tooltip text alignment', 'oconnor'),
			),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'tooltip_background',
				'heading' 			=> esc_html__('Tooltip background color', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'value' 			=> '#ffffff',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Choose the background color for the tooltip\'s', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Tooltip Width', 'oconnor'),
				'param_name' 		=> 'tooltip_width',
				'value' 			=> 300,
				'edit_field_class' 	=> 'vc_col-sm-6',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Enter tooltip width in pixels', 'oconnor'),
			),
			array(
				'type' 				=> 'gt3_on_off',
				'heading' 			=> esc_html__( 'Enable the shadow for the tooltip window?', 'oconnor' ),
				'param_name' 		=> 'tooltip_shadow',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
				'group' 			=> esc_html__( 'Tooltip', 'oconnor' ),
				'std' 				=>'yes',
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
			),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'tooltip_shadow_color',
				'heading' 			=> esc_html__('Tooltip shadow color', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-12',
				'value' 			=> '#eeeeee',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'tooltip_shadow',
					'value' 	=> 'yes',
				),
				'description' 		=> esc_html__('Choose the color for the tooltip\'s shadow', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Left/right', 'oconnor'),
				'param_name' 		=> 'tooltip_shadow_1',
				'value' 			=> '0',
				'edit_field_class' 	=> 'vc_col-sm-3',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'tooltip_shadow',
					'value' 	=> 'yes',
				),
				'description' 		=> esc_html__('Enter how much to perpend the shadow in the horizontal direction in pixels', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Top/bottom', 'oconnor'),
				'param_name' 		=> 'tooltip_shadow_2',
				'value' 			=> '0',
				'edit_field_class' 	=> 'vc_col-sm-3',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'tooltip_shadow',
					'value' 	=> 'yes',
				),
				'description' 		=> esc_html__('Enter how much to perpend the shadow in the vertical direction in pixels', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Blur Radius', 'oconnor'),
				'param_name' 		=> 'tooltip_shadow_3',
				'value' 			=> '7',
				'edit_field_class' 	=> 'vc_col-sm-3',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'tooltip_shadow',
					'value' 	=> 'yes',
				),
				'description' 		=> esc_html__('Enter blur radius in pixels', 'oconnor'),
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> esc_html__('Spread Radius', 'oconnor'),
				'param_name' 		=> 'tooltip_shadow_4',
				'value' 			=> '0',
				'edit_field_class' 	=> 'vc_col-sm-3',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 	=> 'tooltip_shadow',
					'value' 	=> 'yes',
				),
				'description' 		=> esc_html__('Enter spread radius in pixels', 'oconnor'),
			),

			/* Tooltip options - typography */
			array(
				'type' 				=> 'gt3_on_off',
				'heading' 			=> esc_html__( 'Use theme default font family for title?', 'oconnor' ),
				'param_name' 		=> 'use_google_fonts_tooltip_title',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
				'group' 			=> esc_html__( 'Tooltip', 'oconnor' ),
				'std' 				=>'yes',
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__( 'Use font family from the theme.', 'oconnor' ),
			),
			array(
				'type' 				=> 'google_fonts',
				'param_name' 		=> 'google_fonts_tooltip_title',
				'value' 			=> '',
				'settings' 			=> array(
					'fields' 	=> array(
						'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
					),
				),
				'dependency' 		=> array(
					'element' 			 => 'use_google_fonts_tooltip_title',
					'value_not_equal_to' => 'yes',
				),
				'group' 			=> esc_html__( 'Tooltip', 'oconnor' ),
			),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'tooltip_text_color_1',
				'heading' 			=> esc_html__('Title color', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'value' 			=> '#232325',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Change the color of the title', 'oconnor'),
			),

			array(
				'type' 				=> 'gt3_on_off',
				'heading' 			=> esc_html__( 'Use theme default font family for text?', 'oconnor' ),
				'param_name' 		=> 'use_google_fonts_tooltip',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
				'group' 			=> esc_html__( 'Tooltip', 'oconnor' ),
				'std' 				=>'yes',
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__( 'Use font family from the theme.', 'oconnor' ),
			),
			array(
				'type' 				=> 'google_fonts',
				'param_name' 		=> 'google_fonts_tooltip',
				'value' 			=> '',
				'settings' 			=> array(
					'fields' 	=> array(
						'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
						'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
					),
				),
				'dependency' 		=> array(
					'element' 			 => 'use_google_fonts_tooltip',
					'value_not_equal_to' => 'yes',
				),
				'group' 			=> esc_html__( 'Tooltip', 'oconnor' ),
			),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'tooltip_text_color_2',
				'heading' 			=> esc_html__('Text color', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'value' 			=> '#909aa3',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Change the color of the message', 'oconnor'),
			),
			array(
				'type' 				=> 'colorpicker',
				'param_name' 		=> 'tooltip_text_behind_color',
				'heading' 			=> esc_html__('Text Behind color', 'oconnor'),
				'edit_field_class' 	=> 'vc_col-sm-6',
				'value' 			=> '#e8e8e9',
				'group' 			=> esc_html__('Tooltip', 'oconnor'),
				'dependency' 		=> array(
					'element' 			 => 'hotspot_action',
					'value_not_equal_to' => 'only_marker',
				),
				'description' 		=> esc_html__('Change the color of the Text Behind', 'oconnor'),
			),
		)
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_Gt3_hotspot extends WPBakeryShortCode {

		}
	}
}