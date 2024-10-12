<?php
	include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
	$defaults = array(
		'thumbnail' => '',
		'image_position' => '',
		'heading' => '',
		'text' => '',
		'url' => '',
		'url_text' => '',
		'new_tab' => '',
		'title_tag' => 'h2',
		'title_color' => '',
		'link_color' => '',
		'link_hover_color' => '',
 		'imagebox_title_size' => '',
		'imagebox_content_size' => '',
		'text_color' => '',
		'divider_color' => '',
		'animation_class' => '',
		"add_divider" => '',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$blank = $new_tab == 'yes' ? ' target="_blank"' : '';

	$icon = '';

	if (!empty($thumbnail)) {
		$thumbnail = !empty($thumbnail) ? wp_get_attachment_image( $thumbnail , 'full') : '';
		$icon = '<i class="gt3_icon_box__icon" >'.$thumbnail.'</i>';
	}

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_imagebox_title', 'google_fonts_imagebox_content') ) );

	if ( ! empty( $styles_google_fonts_imagebox_title ) ) {
		$imagebox_title_font = esc_attr( $styles_google_fonts_imagebox_title );
	} else {
		$imagebox_title_font = '';
	}

	if ( ! empty( $styles_google_fonts_imagebox_content ) ) {
		$imagebox_content_font = esc_attr( $styles_google_fonts_imagebox_content );
	} else {
		$imagebox_content_font = '';
	}

	// Font Size of Title
	if ($imagebox_title_size != '') {
		$imagebox_title_line = $imagebox_title_size * 1.4;
		$imagebox_title_css = 'font-size: ' . $imagebox_title_size . 'px; line-height: ' . $imagebox_title_line . 'px; ';
	} else {
		$imagebox_title_css = ' ';
	}

	// Font Size of Content
	if ($imagebox_content_size != '') {
		$imagebox_content_line = $imagebox_content_size * 1.53;
		$imagebox_content_css = 'font-size: ' . $imagebox_content_size . 'px; line-height: ' . $imagebox_content_line . 'px; ';
	} else {
		$imagebox_content_css = ' ';
	}

	// Animation
	if (! empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	} else {
		$animation_class = '';
	}

	if (!empty($heading)) {
		$heading_cont = '<div class="gt3_icon_box__title"><'.esc_html($title_tag).' style="color:'.esc_attr($title_color).';'. esc_attr($imagebox_title_font) . esc_attr($imagebox_title_css) .'">';
			$heading_cont .= !empty($url) ? '<a href="'.esc_url($url).'"'.$blank.'>' : '';
				$heading_cont .= esc_html($heading);
			$heading_cont .= !empty($url) ? '</a>' : '';
		$heading_cont .= '</'.esc_html($title_tag).'>';
		$heading_cont .= $add_divider == 'yes' ? '<div class="gt3_icon_box-divider" '.(!empty($divider_color) ? 'style="border-bottom-color:'.esc_attr($divider_color).'"' : '' ).' ></div>' : '';
		$heading_cont .= '</div>';

	}else{
		$heading_cont = '';
	}

	if (!empty($text) || !empty($heading_cont) || !empty($url_text)) {
		$content = '<div class="gt3_icon_box-content-wrapper">';
			$content .= $heading_cont;
			$content .= !empty($text) ?'<div class="gt3_icon_box__text" style="color:'.esc_attr($text_color).';'.esc_attr($imagebox_content_font) . esc_attr($imagebox_content_css).'">'.$text.'</div>' : '';
			$content .= !empty($url_text) ?'<div class="gt3_icon_box__link" style="color:'.(!empty($link_hover_color) ? esc_attr($link_hover_color) : esc_attr($title_color)) .';'.esc_attr($imagebox_content_font).'">'.(!empty($url) ? '<a class="learn_more" href="'.esc_url($url).'" style="color:'.esc_attr($link_color) .';'.esc_attr($imagebox_content_css).'"'.$blank.'>'.esc_html($url_text).'<span></span></a>' : '').'</div>' : '';

		$content .= '</div>';
	}else{
		$content .= '';
	}

	$module_class = '';
	$module_class .= ' gt3_icon_box_icon-position_'.$image_position;
	$module_class .= ' '.$animation_class;
	$module_class .= ' gt3-box-image';


	echo '<div class="gt3_image_box gt3_icon_box'.esc_attr($module_class).'">';
		echo  (($icon));
		echo  (($content));
	echo '</div>';
?>
