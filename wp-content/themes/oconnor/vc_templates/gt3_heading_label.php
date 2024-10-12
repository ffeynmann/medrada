<?php
	include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
	$defaults = array(
		'text' 						=> '',
		'text_2' 					=> '',
		'heading_align' 			=> 'center',

		'text_color' 				=> '#e63764',
		'text_weight' 				=> '300',
		'line_height' 				=> '140',
		'font_size' 				=> '60',
		'responsive_font' 			=> '',
		'font_size_sm_desktop' 		=> '',
		'font_size_tablet' 			=> '',
		'font_size_mobile' 			=> '',
		'use_theme_fonts' 			=> '',

		'text_color_2' 				=> '#212226',
		'text_weight_2' 			=> '300',
		'line_height_2' 			=> '140',
		'font_size_2' 				=> '60',
		'responsive_font_2' 		=> '',
		'font_size_sm_desktop_2' 	=> '',
		'font_size_tablet_2'		=> '',
		'font_size_mobile_2'		=> '',
		'use_theme_fonts_2' 		=> '',

		'use_shadow' 				=> '',
		'text_shadow_color' 		=> '#ffffff',
		'text_shadow_width' 		=> '4',

		'use_label' 				=> 'yes',
		'label_position' 			=> 'label-right',
		'label_title' 				=> '',
		'label_color_1' 			=> '#ffffff',
		'label_weight_1' 			=> '300',
		'label_font_size_1' 		=> '18',
		'label_line_height_1'		=> '140',
		'label_responsive_font_1' 	=> '',
		'label_font_size_sm_desktop_1' => '',
		'label_font_size_tablet_1' 	=> '',
		'label_font_size_mobile_1' 	=> '',

		'label_content' 				=> '',
		'label_color_2' 				=> '#ffffff',
		'label_weight_2' 				=> '300',
		'label_font_size_2' 			=> '24',
		'label_line_height_2' 			=> '140',
		'label_responsive_font_2' 		=> '',
		'label_font_size_sm_desktop_2' 	=> '',
		'label_font_size_tablet_2' 		=> '',
		'label_font_size_mobile_2' 		=> '',

		'use_theme_fonts_label' 	=> '',
		'label_content_align'   	=> 'left',
		'label_content_color'   	=> '#ffffff',
		'label_background' 			=> '#e63764',
		'label_width' 				=> '125',
		'label_padding_1' 			=> '37',
		'label_padding_2' 			=> '29',
		'label_margin_1' 			=> '0',
		'label_margin_2' 			=> '0',
		'label_margin_3' 			=> '0',
		'label_round' 				=> 'yes',
		'label_shadow' 				=> '',
		'label_shadow_color'		=> 'rgba(48,66,78,0.29)',
		'label_shadow_1' 			=> '-25',
		'label_shadow_2' 			=> '25',
		'label_shadow_3' 			=> '51',
		'label_shadow_4' 			=> '0',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = $text_shadow_styles = $styles_label = $label_class = $styles_label_1 = $styles_label_2 = '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes($atts, $this, $this->shortcode, array('google_fonts_text', 'google_fonts_text_2','google_fonts_label')) );
	$text_font   = ! empty( $styles_google_fonts_text ) ? esc_attr( $styles_google_fonts_text ) : '';
	$text_font_2 = ! empty( $styles_google_fonts_text_2 ) ? esc_attr( $styles_google_fonts_text_2 ) : $text_font;
	$label_font  = ! empty( $styles_google_fonts_label ) ? esc_attr( $styles_google_fonts_label ) : '';

	// Font Size of Title
	$text_css  = $font_size   != '' ? 'font-size: '  .(int)$font_size.'px; ' : ' ';
	$text_css .= $line_height != '' ? 'line-height: '.(int)$line_height.'%; ' : ' ';
	$text_css .= $text_weight != '' ? 'font-weight: '.(int)$text_weight.'; ' : ' ';
	$text_css_2  = $font_size_2   != '' ? 'font-size: '  .(int)$font_size_2.'px; ' : ' ';
	$text_css_2 .= $line_height_2 != '' ? 'line-height: '.(int)$line_height_2.'%; ' : ' ';
	$text_css_2 .= $text_weight_2 != '' ? 'font-weight: '.(int)$text_weight_2.'; ' : ' ';

	// Animation
	$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

	// Aligh
	$heading_align = !empty($heading_align) ? ' gt3_custom_text--aligh_'.$heading_align : '';

	/* Shadow Text options start */
	if ( $use_shadow == 'yes') {
		$sh_color  = $text_shadow_color != '' ? esc_attr($text_shadow_color) : '#ffffff';
		switch ($text_shadow_width) {
			case '1':
				$text_shadow_styles = 'text-shadow: -0 -1px 6px '.$sh_color.', 0 -1px 6px '.$sh_color.', -0 1px 6px '.$sh_color.', 0 1px 6px '.$sh_color.', -1px -0 6px '.$sh_color.', 1px -0 6px '.$sh_color.', -1px 0 6px '.$sh_color.', 1px 0 6px '.$sh_color.', -1px -1px 6px '.$sh_color.', 1px -1px 6px '.$sh_color.', -1px  1px 6px '.$sh_color.', 1px 1px 6px '.$sh_color.', -1px -1px 6px '.$sh_color.', 1px -1px 6px '.$sh_color.', -1px  1px 6px '.$sh_color.', 1px  1px 6px '.$sh_color.';';
				break;

			case '2':
				$text_shadow_styles = 'text-shadow: -0 -2px 6px '.$sh_color.', 0 -2px 6px '.$sh_color.', -0 2px 6px '.$sh_color.', 0 2px 6px '.$sh_color.', -2px -0 6px '.$sh_color.', 2px -0 6px '.$sh_color.', -2px 0 6px '.$sh_color.', 2px 0 6px '.$sh_color.', -1px -2px 6px '.$sh_color.', 1px -2px 6px '.$sh_color.', -1px 2px 6px '.$sh_color.', 1px 2px 6px '.$sh_color.', -2px -1px 6px '.$sh_color.', 2px -1px 6px '.$sh_color.', -2px 1px 6px '.$sh_color.', 2px 1px 6px '.$sh_color.', -2px -2px 6px '.$sh_color.', 2px -2px 6px '.$sh_color.', -2px 2px 6px '.$sh_color.', 2px 2px 6px '.$sh_color.', -2px -2px 6px '.$sh_color.', 2px -2px 6px '.$sh_color.', -2px 2px 6px '.$sh_color.', 2px 2px 6px '.$sh_color.';';
				break;

			case '3':
				$text_shadow_styles = 'text-shadow: -0 -3px 6px '.$sh_color.',0 -3px 6px '.$sh_color.',-0 3px 6px '.$sh_color.',0 3px 6px '.$sh_color.',-3px -0 6px '.$sh_color.',3px -0 6px '.$sh_color.',-3px 0 6px '.$sh_color.',3px 0 6px '.$sh_color.',-1px -3px 6px '.$sh_color.',1px -3px 6px '.$sh_color.',-1px 3px 6px '.$sh_color.',1px 3px 6px '.$sh_color.',-3px -1px 6px '.$sh_color.',3px -1px 6px '.$sh_color.',-3px 1px 6px '.$sh_color.',3px 1px 6px '.$sh_color.',-2px -3px 6px '.$sh_color.',2px -3px 6px '.$sh_color.',-2px 3px 6px '.$sh_color.',2px 3px 6px '.$sh_color.', -3px -2px 6px '.$sh_color.', 3px -2px 6px '.$sh_color.', -3px 2px 6px '.$sh_color.', 3px 2px 6px '.$sh_color.', -3px -3px 6px '.$sh_color.', 3px -3px 6px '.$sh_color.', -3px 3px 6px '.$sh_color.', 3px 3px 6px '.$sh_color.', -3px -3px 6px '.$sh_color.', 3px -3px 6px '.$sh_color.', -3px 3px 6px '.$sh_color.', 3px 3px 6px '.$sh_color.';';
				break;

			case '4':
				$text_shadow_styles = 'text-shadow: -0 -4px 6px '.$sh_color.', 0 -4px 6px '.$sh_color.', -0 4px 6px '.$sh_color.',0 4px 6px '.$sh_color.',-4px -0 6px '.$sh_color.',4px -0 6px '.$sh_color.',-4px 0 6px '.$sh_color.',4px 0 6px '.$sh_color.',-1px -4px 6px '.$sh_color.',1px -4px 6px '.$sh_color.',-1px 4px 6px '.$sh_color.',1px 4px 6px '.$sh_color.',-4px -1px 6px '.$sh_color.',4px -1px 6px '.$sh_color.',-4px 1px 6px '.$sh_color.',4px 1px 6px '.$sh_color.',-2px -4px 6px '.$sh_color.',2px -4px 6px '.$sh_color.',-2px 4px 6px '.$sh_color.',2px 4px 6px '.$sh_color.',-4px -2px 6px '.$sh_color.',4px -2px 6px '.$sh_color.',-4px 2px 6px '.$sh_color.',4px 2px 6px '.$sh_color.',-3px -4px 6px '.$sh_color.',3px -4px 6px '.$sh_color.',-3px 4px 6px '.$sh_color.',3px 4px 6px '.$sh_color.',-4px -3px 6px '.$sh_color.',4px -3px 6px '.$sh_color.',-4px 3px 6px '.$sh_color.',4px 3px 6px '.$sh_color.',-4px -4px 6px '.$sh_color.',4px -4px 6px '.$sh_color.',-4px 4px 6px '.$sh_color.',4px 4px 6px '.$sh_color.',-4px -4px 6px '.$sh_color.',4px -4px 6px '.$sh_color.',-4px 4px 6px '.$sh_color.',4px 4px 6px '.$sh_color.';';
				break;

			default:
				$text_shadow_styles = 'text-shadow: -0 -4px 6px '.$sh_color.', 0 -4px 6px '.$sh_color.', -0 4px 6px '.$sh_color.',0 4px 6px '.$sh_color.',-4px -0 6px '.$sh_color.',4px -0 6px '.$sh_color.',-4px 0 6px '.$sh_color.',4px 0 6px '.$sh_color.',-1px -4px 6px '.$sh_color.',1px -4px 6px '.$sh_color.',-1px 4px 6px '.$sh_color.',1px 4px 6px '.$sh_color.',-4px -1px 6px '.$sh_color.',4px -1px 6px '.$sh_color.',-4px 1px 6px '.$sh_color.',4px 1px 6px '.$sh_color.',-2px -4px 6px '.$sh_color.',2px -4px 6px '.$sh_color.',-2px 4px 6px '.$sh_color.',2px 4px 6px '.$sh_color.',-4px -2px 6px '.$sh_color.',4px -2px 6px '.$sh_color.',-4px 2px 6px '.$sh_color.',4px 2px 6px '.$sh_color.',-3px -4px 6px '.$sh_color.',3px -4px 6px '.$sh_color.',-3px 4px 6px '.$sh_color.',3px 4px 6px '.$sh_color.',-4px -3px 6px '.$sh_color.',4px -3px 6px '.$sh_color.',-4px 3px 6px '.$sh_color.',4px 3px 6px '.$sh_color.',-4px -4px 6px '.$sh_color.',4px -4px 6px '.$sh_color.',-4px 4px 6px '.$sh_color.',4px 4px 6px '.$sh_color.',-4px -4px 6px '.$sh_color.',4px -4px 6px '.$sh_color.',-4px 4px 6px '.$sh_color.',4px 4px 6px '.$sh_color.';';
				break;
		}
	}
	/* Shadow Text options end */

	/* Label options start */
	if ( $use_label == 'yes') {
		$label_class .= ' gt3_label_active';
		$label_class .= !empty($label_position) ? ' '.$label_position : '';

		$styles_label .= !empty($label_content_align) ? ' text-align:'.esc_attr( $label_content_align ).';' : '';
		$styles_label .= !empty($label_background) ? ' background-color:'.esc_attr( $label_background ).';' : '';
		$styles_label .= !empty($label_width) ? 'width: '.(int)$label_width.'px;' : '';
		$styles_label .= !empty($label_font) ? esc_attr($label_font) : '';

		$styles_label .= ' padding:';
		$styles_label .= !empty($label_padding_1) ? (int)$label_padding_1.'px ' : ' 0px';
		$styles_label .= !empty($label_padding_2) ? (int)$label_padding_2.'px;' : ' 0px;';

		if ( $label_round == 'yes' ) {
			$styles_label .= 'border-radius: 50%;';
			$styles_label .= !empty($label_width) ? 'height: '.(int)$label_width.'px;' : '';
		}

		if ( $label_shadow == 'yes' ) {
			$styles_label .= ' box-shadow: ';
			$styles_label .= !empty($label_shadow_1) ? (int)$label_shadow_1.'px ' : '0px ';
			$styles_label .= !empty($label_shadow_2) ? (int)$label_shadow_2.'px ' : '0px ';
			$styles_label .= !empty($label_shadow_3) ? (int)$label_shadow_3.'px ' : '0px ';
			$styles_label .= !empty($label_shadow_4) ? (int)$label_shadow_4.'px ' : '0px ';
			$styles_label .= !empty($label_shadow_color) ? esc_attr( $label_shadow_color ).';' : 'currentColor; ';
		}

		$styles_label .= !empty($label_margin_1) ? 'margin-top: '.(int)$label_margin_1.'px; ' : '';
		$styles_label .= !empty($label_margin_2) ? 'margin-right: '.(int)$label_margin_2.'px; ' : '';
		$styles_label .= !empty($label_margin_3) ? 'margin-left: '.(int)$label_margin_3.'px; ' : '';

		// Label 1
		$styles_label_1 .= !empty($label_font_size_1) ? 'font-size:'.(int)$label_font_size_1.'px; ' : '';
		$styles_label_1 .= !empty($label_line_height_1) ? 'line-height:'.(int)$label_line_height_1.'%; ' : '';
		$styles_label_1 .= !empty($label_weight_1) ? 'font-weight:'.(int)$label_weight_1.'; ' : '';
		$styles_label_1 .= !empty($label_color_1) ? 'color:'.esc_attr($label_color_1).'; ' : '';

		// Label 2
		$styles_label_2 .= !empty($label_font_size_2) ? 'font-size:'.(int)$label_font_size_2.'px; ' : '';
		$styles_label_2 .= !empty($label_line_height_2) ? 'line-height:'.(int)$label_line_height_2.'%; ' : '';
		$styles_label_2 .= !empty($label_weight_2) ? 'font-weight:'.(int)$label_weight_2.'; ' : '';
		$styles_label_2 .= !empty($label_color_2) ? 'color:'.esc_attr($label_color_2).'; ' : '';
	}

/* Label options end */

	echo '<div data-color="#ffffff" class="gt3_custom_text gt3_heading_label '.esc_attr($animation_class).esc_attr($heading_align).(!empty($text_font) ? ' gt3_custom_text--custom-font ' : '' ).esc_attr($label_class).'">';

	echo '<div class="gt3_heading_label--wrap">';
	if ( !empty($text) ) {
		echo '<div class="gt3_heading_label--main '.(!empty($text_font) ? 'gt3_custom_text--custom-font' : '' ).'" style="color:'.esc_attr($text_color).';'.esc_attr($text_font) . esc_attr($text_css).esc_attr($text_shadow_styles).'">';

			if ($responsive_font == 'yes') {
				echo !empty($font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$font_size_sm_desktop.'px;line-height: ' . (int)$line_height . '%;">' : '';
				echo !empty($font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$font_size_tablet.'px;line-height: ' . (int)$line_height . '%;">' : '';
				echo !empty($font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$font_size_mobile.'px;line-height: ' . (int)$line_height . '%;">' : '';
			}
			echo esc_attr($text);
			if ($responsive_font == 'yes') {
				echo !empty($font_size_sm_desktop) ? ' </div>' : '';
				echo !empty($font_size_tablet) ? ' </div>' : '';
				echo !empty($font_size_mobile) ? ' </div>' : '';
			}
		echo '</div>';
	}

	if ( !empty($text_2) ) {
		echo '<div class="'.(!empty($text_font_2) ? 'gt3_custom_text--custom-font' : '' ).'" style="color:'.esc_attr($text_color_2).';'.esc_attr($text_font_2) . esc_attr($text_css_2).esc_attr($text_shadow_styles).'">';

		if ($responsive_font_2 == 'yes') {
			echo !empty($font_size_sm_desktop_2) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$font_size_sm_desktop_2.'px;line-height: ' . (int)$line_height_2 . '%;">' : '';
			echo !empty($font_size_tablet_2) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$font_size_tablet_2.'px;line-height: ' . (int)$line_height_2 . '%;">' : '';
			echo !empty($font_size_mobile_2) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$font_size_mobile_2.'px;line-height: ' . (int)$line_height_2 . '%;">' : '';
		}
		echo esc_attr($text_2);
		if ($responsive_font_2 == 'yes') {
			echo !empty($font_size_sm_desktop_2) ? ' </div>' : '';
			echo !empty($font_size_tablet_2) ? ' </div>' : '';
			echo !empty($font_size_mobile_2) ? ' </div>' : '';
		}
		echo '</div>';
	}
	/* Label output */
	if ( $use_label == 'yes') {
		echo '<div class="gt3_label_adds '.(!empty($label_font) ? 'gt3_custom_text--custom-font' : '' ).'" style="'.esc_attr($styles_label).'">';

			echo '<div class="gt3_label_title" style="'.esc_attr($styles_label_1).esc_attr($text_shadow_styles).'">';
				if ($label_responsive_font_1 == 'yes') {
					echo !empty($label_font_size_sm_desktop_1) ? '<div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$label_font_size_sm_desktop_1.'px;line-height:'.(int)$label_line_height_1.'%;">' : '';
					echo !empty($label_font_size_tablet_1) ? '<div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$label_font_size_tablet_1.'px;line-height:'.(int)$label_line_height_1.'%;">' : '';
					echo !empty($label_font_size_mobile_1) ? '<div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$label_font_size_mobile_1.'px;line-height:'.(int)$label_line_height_1.'%;">' : '';
				}
				echo esc_attr($label_title);
				if ($label_responsive_font_1 == 'yes') {
					echo !empty($label_font_size_sm_desktop_1) ? '</div>' : '';
					echo !empty($label_font_size_tablet_1) ? '</div>' : '';
					echo !empty($label_font_size_mobile_1) ? '</div>' : '';
				}

			echo '</div>';

			echo '<div class="gt3_label_content" style="'.esc_attr($styles_label_2).esc_attr($text_shadow_styles).'">';
				if ($label_responsive_font_2 == 'yes') {
					echo !empty($label_font_size_sm_desktop_2) ? '<div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$label_font_size_sm_desktop_2.'px;line-height:'.(int)$label_line_height_2.'%;">' : '';
					echo !empty($label_font_size_tablet_2) ? '<div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$label_font_size_tablet_2.'px;line-height:'.(int)$label_line_height_2.'%;">' : '';
					echo !empty($label_font_size_mobile_2) ? '<div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$label_font_size_mobile_2.'px;line-height:'.(int)$label_line_height_2.'%;">' : '';
				}
				echo esc_attr($label_content);
				if ($label_responsive_font_2 == 'yes') {
					echo !empty($label_font_size_sm_desktop_2) ? '</div>' : '';
					echo !empty($label_font_size_tablet_2) ? '</div>' : '';
					echo !empty($label_font_size_mobile_2) ? '</div>' : '';
				}
			echo '</div>';

		echo '</div>';
	}
	echo '</div> <!-- gt3_heading_label--wrap -->';
	/* ! Label output */

	echo '</div>';

?>
