<?php
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$compile = '';

$defaults = array(
	'attach_image' 				=> '',
	'init_hotspot' 				=> '',
	'hotspot_action' 			=> 'hover',
	'animation_class' 			=> '',
	'transition_delay' 			=> 400,
	'css_animation' 			=> 'none',
	'item_el_class' 			=> '',

	'marker_style' 				=> 'circle',
	'tooltip_padding_1' 		=> 0,
	'tooltip_padding_2' 		=> 0,
	'tooltip_padding_3' 		=> 0,
	'tooltip_padding_4' 		=> 0,
	'tooltip_hotspotline_type'  => 'none',
	'tooltip_hotspotline_width' => '150',
	'tooltip_hotspotline_color' => '#d71f01',

	'marker_circle_color_1' 	=> 'rgba(215,31,1,0.37)',
	'marker_circle_color_2' 	=> '#d71f01',
	'marker_outer_width' 		=> 28,
	'marker_inner_width' 		=> 20,
	'marker_pulse' 				=> '',
	'marker_pulse_style' 		=> 'default',
	'marker_pulse_duration' 	=> 2000,

	'marker_font_size' 			=> '',
	'marker_line_height' 		=> 140,
	'responsive_font' 			=> '',
	'font_size_sm_desktop' 		=> '',
	'font_size_tablet' 			=> '',
	'font_size_mobile' 			=> '',
	'use_theme_fonts_marker' 	=> '',
	'google_fonts_marker_text' 	=> '',
	'marker_text_color_1' 		=> '#232325',
	'marker_text_bgcolor_2' 	=> '#ffffff',

	'marker_image' 				=> '',
	'marker_image_width' 		=> 40,
	'marker_image_height' 		=> 40,

	'tooltip_position' 			=> 'tooltip-bottom',
	'tooltip_animation' 		=> 'tooltip_animation-slide',
	'tooltip_animation_time' 	=> 200,
	'tooltip_animation_func' 	=> 'ease-in',
	'tooltip_content_align' 	=> 'left',
	'tooltip_background' 		=> '#ffffff',
	'tooltip_width' 			=> 300,
	'tooltip_shadow' 			=> 'yes',
	'tooltip_shadow_color' 		=> '#eeeeee',
	'tooltip_shadow_1' 			=> '0',
	'tooltip_shadow_2' 			=> '0',
	'tooltip_shadow_3' 			=> '7',
	'tooltip_shadow_4' 			=> '0',

	'use_google_fonts_tooltip_title' => 'yes',
	'google_fonts_tooltip_title' 	 => '',
	'tooltip_text_color_1' 		=> '#232325',
	'use_google_fonts_tooltip' 	=> 'yes',
	'google_fonts_tooltip' 		=> '',
	'tooltip_text_color_2' 		=> '#909aa3',
	'tooltip_text_behind_color' => '#e8e8e9',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

if( isset($attach_image) && !empty($attach_image) ) {

	$styles_tooltip_container = $data_atts = $el_class = $styles_marker = $marker_circle_1 = $marker_circle_2 = $markers = $marker = $count_markers = $marker_wrapper = $attr_tooltip = $styles_tooltip = $shadow_custom = $marker_pulse_wrap = $marker_pulse_class = '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_marker_text','google_fonts_tooltip_title','google_fonts_tooltip') ) );
	$styles_marker_text = !empty( $styles_google_fonts_marker_text ) ? esc_attr( $styles_google_fonts_marker_text ) : '';
	$styles_tooltip_title = !empty( $styles_google_fonts_tooltip_title ) ? esc_attr( $styles_google_fonts_tooltip_title ) : '';
	$styles_tooltip_text = !empty( $styles_google_fonts_tooltip ) ? esc_attr( $styles_google_fonts_tooltip ) : '';

	// Hotspot Data Init
	$data_atts .= !empty($init_hotspot) ? ' data-hotspot-init="' . esc_attr( urldecode( $init_hotspot ) ).'"' : '';

	// Hotspot Action
	$el_class .= !empty($hotspot_action) ? ' hotspot_action-' . esc_attr( $hotspot_action ) : '';
	$data_atts .= !empty($hotspot_action) ? ' data-hotspot_action=' . esc_attr($hotspot_action) : '';

	// Animation
	if ( !empty( $css_animation ) ) {
		if ( $css_animation == 'none' ) {
			$animation_class = 'gt3_animation_none';
		}else{
			$animation_class = $this->getCSSAnimation( $css_animation );
		}
	}else{
		$animation_class = '';
	}

	// Element Class
	$el_class .= !empty($item_el_class) ? ' ' . esc_attr( $item_el_class ) : '';

	// Marker
	$styles_tooltip .= 'padding: ';
	$styles_tooltip .= !empty($tooltip_padding_1) ? (int)$tooltip_padding_1.'px ' : '0 ';
	$styles_tooltip .= !empty($tooltip_padding_2) ? (int)$tooltip_padding_2.'px ' : '0 ';
	$styles_tooltip .= !empty($tooltip_padding_3) ? (int)$tooltip_padding_3.'px ' : '0 ';
	$styles_tooltip .= !empty($tooltip_padding_4) ? (int)$tooltip_padding_4.'px;' : '0; ';

	// Marker Text Style
	$styles_marker_text .= !empty($marker_text_color_1) ? ' color:'.esc_attr( $marker_text_color_1 ).';' : '';
	$styles_marker_text .= !empty($marker_text_bgcolor_2) ? ' background-color:'.esc_attr( $marker_text_bgcolor_2 ).';' : '';
	$styles_marker_text .= !empty($marker_line_height) ? ' line-height:'.(int)$marker_line_height.'%;' : '';

	// Marker Circle Style
	$marker_circle_1 .= !empty($marker_circle_color_1) ? 'background-color: ' . $marker_circle_color_1 . ';' : '';
	$marker_circle_2 .= !empty($marker_circle_color_2) ? 'background-color: ' . $marker_circle_color_2 . ';' : '';
	$marker_circle_2 .= !empty($marker_inner_width) ? 'width: '.(int)$marker_inner_width.'px; height: '.(int)$marker_inner_width.'px;' : '';

	$marker_pulse_wrap .= !empty($marker_outer_width) ? 'width: '.(int)$marker_outer_width.'px; height: '.(int)$marker_outer_width.'px;' : '';

	// Marker Circle Pulse Style
	if ( $marker_pulse ) {
		$marker_pulse_class .= 'gt3_marker_pulse-' . ( !empty($marker_pulse_style) ? esc_attr( $marker_pulse_style ) : '' );
		if (!empty($marker_pulse_duration)) {
			$marker_circle_1 .= '-webkit-animation-duration: '.(int)$marker_pulse_duration.'ms;';
			$marker_circle_1 .= '-moz-animation-duration: '.(int)$marker_pulse_duration.'ms;';
			$marker_circle_1 .= '-o-animation-duration: '.(int)$marker_pulse_duration.'ms;';
			$marker_circle_1 .= 'animation-duration: '.(int)$marker_pulse_duration.'ms;';
		}
	}

	// Tooltip Style
	$tooltip_position = !empty($tooltip_position) ? esc_attr( $tooltip_position ) : '';
	$attr_tooltip .= $tooltip_position;
	$attr_tooltip .= !empty($tooltip_content_align) && $tooltip_content_align == 'text-gt3_custom' ? ' text-gt3_custom' : '';
	$styles_tooltip .= !empty($tooltip_content_align) && $tooltip_content_align !== 'text-gt3_custom' ? ' text-align:'.esc_attr( $tooltip_content_align ).';' : '';
	$styles_tooltip_container .= !empty($tooltip_width) ? ' width: '.(int)$tooltip_width.'px;' : '';
	$styles_tooltip_container .= !empty($tooltip_background) && $tooltip_background !== '' ? ' background-color:'.esc_attr( $tooltip_background ).';' : '';

	$attr_tooltip .= !empty($tooltip_animation) ? ' '.esc_attr( $tooltip_animation ) : '';
	if (!empty($tooltip_animation_time)) {
		$styles_tooltip .= ' -webkit-transition-duration: '.(int)$tooltip_animation_time.'ms;';
		$styles_tooltip .= ' -moz-transition-duration: '.(int)$tooltip_animation_time.'ms;';
		$styles_tooltip .= ' -o-transition-duration: '.(int)$tooltip_animation_time.'ms;';
		$styles_tooltip .= ' transition-duration: '.(int)$tooltip_animation_time.'ms;';
	}
	if (!empty($tooltip_animation_func)) {
		$styles_tooltip .= ' -webkit-transition-timing-function: '.esc_attr($tooltip_animation_func).';';
		$styles_tooltip .= ' -moz-transition-timing-function: '.esc_attr($tooltip_animation_func).';';
		$styles_tooltip .= ' -o-transition-timing-function: '.esc_attr($tooltip_animation_func).';';
		$styles_tooltip .= ' transition-timing-function: '.esc_attr($tooltip_animation_func).';';
	}

	if ($tooltip_shadow == 'yes') {
		$styles_tooltip .= ' box-shadow: ';
		$styles_tooltip .= !empty($tooltip_shadow_1) ? (int)$tooltip_shadow_1.'px ' : '0 ';
		$styles_tooltip .= !empty($tooltip_shadow_2) ? (int)$tooltip_shadow_2.'px ' : '0 ';
		$styles_tooltip .= !empty($tooltip_shadow_3) ? (int)$tooltip_shadow_3.'px ' : '0 ';
		$styles_tooltip .= !empty($tooltip_shadow_4) ? (int)$tooltip_shadow_4.'px ' : '0 ';
		$styles_tooltip .= !empty($tooltip_shadow_color) ? esc_attr( $tooltip_shadow_color ).';' : 'currentColor; ';
	}
	$styles_tooltip_title .= !empty($tooltip_text_color_1) ? ' color:'.esc_attr( $tooltip_text_color_1 ).';' : '';
	$styles_tooltip_text .= !empty($tooltip_text_color_2) ? ' color:'.esc_attr( $tooltip_text_color_2 ).';' : '';

	// Marker Init
	$markers = json_decode(urldecode($init_hotspot),true);
	$count_markers = count($markers);
	if ( $count_markers > 0 ) {
		$styles_marker_text .= !empty($marker_font_size) ? ' font-size:'.(int)$marker_font_size.'px;' : '';

		$gt3_marker_text_bool  = $marker_style == 'text'/* && !empty($marker_text)*/;
		$gt3_marker_image_bool = $marker_style == 'image' && isset($marker_image) && !empty($marker_image);

		if ( $gt3_marker_text_bool == 'yes' ) {
			$marker .= '<div class="hotspot_module hotspot_style-text">';
		}elseif( $gt3_marker_image_bool == 'yes' ) {
			$marker .= '<div class="hotspot_module hotspot_style-image">';
		}else{
			$marker .= '<div class="hotspot_module hotspot_style-circle"> ';
		}

		$x = 0;
		while ( $x < $count_markers ) {
			$marker_wrapper_start = $marker_wrapper_end = $attr_tooltip_both = $styles_tooltip_each = $hotspotline = '';
			$this_marker = $markers[$x];
			$x++;
			$delay = $transition_delay * $x;
			$marker_pos  = 'left: '.esc_attr(round($this_marker["x"],2)).'%; ';
			$marker_pos .= 'top: '.esc_attr(round($this_marker["y"],2)).'%; ';
			$animation_style = '';
			if ( !empty($atts['css_animation']) ) {
				$animation_style .= '-webkit-transition-delay: '.(int)$delay.'ms;';
				$animation_style .= '-moz-transition-delay: '.(int)$delay.'ms;';
				$animation_style .= '-o-transition-delay: '.(int)$delay.'ms;';
				$animation_style .= 'transition-delay: '.(int)$delay.'ms;';
				$animation_style .= '-webkit-animation-delay: '.(int)$delay.'ms;';
				$animation_style .= '-moz-animation-delay: '.(int)$delay.'ms;';
				$animation_style .= '-o-animation-delay: '.(int)$delay.'ms;';
				$animation_style .= 'animation-delay: '.(int)$delay.'ms;';
			}
			$styles_tooltip_each = $this_marker["x"] < 50 ? ' text-align:left' : ' text-align:right';

			if ($tooltip_position == 'tooltip-both-top') {
				$attr_tooltip_both = $this_marker["x"] < 50 ? ' tooltip-top-left' : ' tooltip-top-right';
			}
			if ($tooltip_position == 'tooltip-both-middle') {
				$attr_tooltip_both = $this_marker["x"] < 50 ? ' tooltip-left' : ' tooltip-right';
			}
			if ($tooltip_position == 'tooltip-both-bottom') {
				$attr_tooltip_both = $this_marker["x"] < 50 ? ' tooltip-bottom-left' : ' tooltip-bottom-right';
			}

			if (!empty($tooltip_hotspotline_type) && $tooltip_hotspotline_type !== 'none') {
				$hotspotline_style =  'border-bottom-style: '.esc_attr($tooltip_hotspotline_type).';';
				$hotspotline_style .= !empty($tooltip_hotspotline_width) ? ' width: '.(int)$tooltip_hotspotline_width.'px;' : '';
				$hotspotline_style .= !empty($tooltip_hotspotline_color) ? ' color: '.esc_attr($tooltip_hotspotline_color).';' : '';
				$hotspotline = '<div class="gt3_hotspotline '.esc_attr($tooltip_position).esc_attr($attr_tooltip_both).'" style="'.$hotspotline_style.'"></div>';
			}

			$marker_wrapper_start = '<div class="gt3_marker_wrapper" style="'.esc_attr($marker_pos).'">';
			if ( $hotspot_action !== 'only_marker' && !empty($this_marker["Title"]) && !empty($this_marker["Message"]) ) {
				$marker_wrapper_start  .= '<div class="gt3_tooltip '.esc_attr($attr_tooltip).esc_attr($attr_tooltip_both).'" style="'.esc_attr($styles_tooltip).'">';
				$marker_wrapper_start  .= '<div class="gt3_tooltip_container" style="'.esc_attr($styles_tooltip_container).'">';
				$marker_wrapper_start  .= '<a href="#" class="gt3-close" title="'.esc_html__('Close', 'oconnor').'"></a>';
				$marker_wrapper_start  .= !empty($this_marker["Marker"]) ? '<i class="gt3_tooltip_text_behind" style="color:'.esc_attr($tooltip_text_behind_color).'">'.esc_attr($this_marker["Marker"]).'</i>' : '';
				$marker_wrapper_start  .= !empty($this_marker["Title"]) ? '<h3 class="gt3_tooltip_title" style="'.esc_attr($styles_tooltip_title).'">'.esc_attr($this_marker["Title"]).'</h3>' : '';
				$marker_wrapper_start  .= !empty($this_marker["Message"]) ? '<div class="gt3_tooltip_message" style="'.esc_attr($styles_tooltip_text).'">'.wp_kses_post($this_marker["Message"]).'</div>' : '';
				$marker_wrapper_start  .= '</div><!-- gt3_tooltip_container -->';
				$marker_wrapper_start  .= '</div><!-- gt3_tooltip -->';
			}
			$marker_wrapper_start .= '<div class="gt3_marker" style="'.esc_attr($styles_marker).esc_attr($marker_pos).'">';
			$marker_wrapper_start .= '<div class="gt3_marker_animation_wrap '.esc_attr($animation_class).'" style="'.esc_attr($animation_style).'">';
			$marker_wrapper_start .= $hotspotline;
			$marker_wrapper_end   .= '</div><!-- gt3_marker_animation_wrap -->';
			$marker_wrapper_end   .= '</div><!-- gt3_marker -->';
			$marker_wrapper_end   .= '</div><!-- gt3_marker_wrapper -->';

			// Marker Style
			if ( $gt3_marker_text_bool == 'yes' ) {
				$marker .= $marker_wrapper_start;
				$marker .= '<div class="gt3_marker_font_size" style="'.esc_attr($styles_marker_text).'">';
				if ($responsive_font == 'yes') {
					$marker .= !empty($font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$font_size_sm_desktop.'px;">' : '';
					$marker .= !empty($font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$font_size_tablet.'px;">' : '';
					$marker .= !empty($font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$font_size_mobile.'px;">' : '';
				}

				$marker_text_loop  = isset($this_marker["Marker"]) && !empty($this_marker["Marker"]) ? esc_attr($this_marker["Marker"]) : '<span class="gt3_hotspot_blank_circle"></span>';
				$marker .= $marker_text_loop;

				if ($responsive_font == 'yes') {
					$marker .= !empty($font_size_sm_desktop) ? ' </div>' : '';
					$marker .= !empty($font_size_tablet) ? ' </div>' : '';
					$marker .= !empty($font_size_mobile) ? ' </div>' : '';
				}
				$marker .= '</div><!-- gt3_marker_font_size -->';
				$marker .= $marker_wrapper_end;
			} elseif( $gt3_marker_image_bool == 'yes' ) {
				if ( !empty($marker_image_width) && !empty($marker_image_height) && $marker_image_width !== '0' && $marker_image_height !== '0' ){
					$marker .= $marker_wrapper_start . '<div class="gt3_custom_image_marker">' . wp_get_attachment_image( $marker_image, array((int)$marker_image_width,(int)$marker_image_height) ) . '</div>' . $marker_wrapper_end;
				} else {
					$marker .= $marker_wrapper_start . '<div class="gt3_custom_image_marker">' . wp_get_attachment_image( $marker_image, 'full' ) . '</div>' . $marker_wrapper_end;
				}
			} else {
				$marker .= $marker_wrapper_start;
				$marker .= '<div class="hotspot_style-circle_wrap '.esc_attr($marker_pulse_class).'" style="'.esc_attr($marker_pulse_wrap).'">';
				$marker .= '<div class="hotspot_style-circle_outer" style="'.esc_attr($marker_circle_1).'"></div>';
				$marker .= '<div class="hotspot_style-circle_inner" style="'.esc_attr($marker_circle_2).'"></div>';
				$marker .= $responsive_font == 'yes' ? '<div class="hotspot_style-circle_animate"></div>' : '';

				$marker .= '</div> <!-- hotspot_style-circle_wrap -->';
				$marker .= $marker_wrapper_end;
			}
		}
		$marker .= '</div> <!-- hotspot_module-->';
	}

	// Hotspot Init
	echo '<div class="gt3-hotspot-shortcode-wrapper">';
		echo '<div class="gt3-hotspot-shortcode" '.$data_atts.'>';
			echo '<div class="gt3-hotspot-image-cover '.esc_attr($el_class).'">';
				echo wp_get_attachment_image( $attach_image, 'full' );
				echo (($marker));
			echo '</div>';
		echo '</div>';
	echo '</div>';
}
