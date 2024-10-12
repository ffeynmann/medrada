<?php
	include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
	$defaults = array(
		'steps' => '2',
		'heading1' => '',
		'text1' => '',
		'url1' => '',
		'url_text1' => '',
		'heading2' => '',
		'text2' => '',
		'url2' => '',
		'url_text2' => '',
		'heading3' => '',
		'text3' => '',
		'url3' => '',
		'url_text3' => '',
		'heading4' => '',
		'text4' => '',
		'url4' => '',
		'url_text4' => '',
		'heading5' => '',
		'text5' => '',
		'url5' => '',
		'url_text5' => '',
		'icon_size' => '',
		'icon_bg' => '',
		'icon_color' => '',
		'title_tag' => '',
		'title_color' => '',
		'iconbox_title_size' => '18',
		'iconbox_content_size' => '16',
		'text_color' => '',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	if ($steps == '5') {
		$column = '1-5';
	}else{
		$column = 12/(int)$steps;
	}

	$icon_style = '';
	$icon_style .= !empty($icon_bg) ? 'background-color:'.$icon_bg.';' : '';
	$icon_style .= !empty($icon_color) ? 'color:'.$icon_color.';' : '';
	$icon_style = !empty($icon_style) ? ' style="'.esc_attr( $icon_style ).'"' : '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_iconbox_title', 'google_fonts_iconbox_content') ) );

	if ( ! empty( $styles_google_fonts_iconbox_title ) ) {
		$iconbox_title_font = esc_attr( $styles_google_fonts_iconbox_title );
	} else {
		$iconbox_title_font = '';
	}

	if ( ! empty( $styles_google_fonts_iconbox_content ) ) {
		$iconbox_content_font = esc_attr( $styles_google_fonts_iconbox_content );
	} else {
		$iconbox_content_font = '';
	}

	// Font Size of Title
	if ($iconbox_title_size != '') {
		$iconbox_title_line = $iconbox_title_size * 1.4;
		$iconbox_title_css = 'font-size: ' . $iconbox_title_size . 'px; line-height: ' . $iconbox_title_line . 'px; ';
	} else {
		$iconbox_title_css = ' ';
	}

	// Font Size of Content
	if ($iconbox_content_size != '') {
		$iconbox_content_line = $iconbox_content_size * 1.4;
		$iconbox_content_css = 'font-size: ' . $iconbox_content_size . 'px; line-height: ' . $iconbox_content_line . 'px; ';
	} else {
		$iconbox_content_css = ' ';
	}

	echo '<div class="gt3_process_bar_container row">';

		for ($i=1; $i <= (int)$steps; $i++) {
			echo '<div class="gt3_process_bar gt3_process_bar__icon_icon_size_'.esc_attr($icon_size).' span'.esc_attr($column).'">';
				echo '<div class="gt3_process_bar__count-container"><div class="gt3_process_bar__count"'.(!empty($icon_style) ? $icon_style : '').'>'.$i.'</div></div>';
				if (!empty(${'text'.$i}) || !empty(${'heading'.$i}) || !empty(${'url_text'.$i})) {
					echo '<div class="gt3_process_bar-content-wrapper">';
						if (!empty(${'heading'.$i})) {
							echo '<div class="gt3_process_bar__title"><'.esc_html($title_tag).' style="color:'.esc_attr($title_color).';'. esc_attr($iconbox_title_font) . esc_attr($iconbox_title_css) .'">';
								echo !empty(${'url'.$i}) ? '<a href="'.esc_url(${'url'.$i}).'">' : '';
									echo esc_html(${'heading'.$i});
								echo !empty(${'url'.$i}) ? '</a>' : '';
							echo '</'.esc_html($title_tag).'></div>';
						}

						echo !empty(${'text'.$i}) ?'<div class="gt3_process_bar__text" style="color:'.esc_attr($text_color).';'.esc_attr($iconbox_content_font) . esc_attr($iconbox_content_css).'">'.esc_html(${'text'.$i}).'</div>' : '';
						echo !empty(${'url_text'.$i}) ?'<div class="gt3_process_bar__link" style="color:'.esc_attr($title_color).';'.esc_attr($iconbox_content_font) . esc_attr($iconbox_content_css).'">'.(!empty(${'url'.$i}) ? '<a href="'.esc_url(${'url'.$i}).'" style="color:'.esc_attr($icon_bg) .';'.esc_attr($iconbox_content_css).'">'.esc_html(${'url_text'.$i}).'</a>' : '').'</div>' : '';
					echo '</div>';
				}
			echo '</div>';
		}

	echo '</div>';
?>
