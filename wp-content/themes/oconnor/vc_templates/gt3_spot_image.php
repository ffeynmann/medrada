<?php
	include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
	$defaults = array(
		'heading' => '',
		'title_prefix' => '',
		'text' => '',
		'icon_type' => 'none',
		'icon_fontawesome' 	=> 'fa fa-adjust',
		'thumbnail' => '',
		'block_align' => 'left',
		'spot_pos' => 'bottom',
		'spot_align' => 'left',
		'spot_type' => 'dashed',
		'point_shadow' => false,
		'point_width' => '20',
		'line_width' => '100',
		'offset' => false,
		'right_offset' => '',
		'left_offset' => '',

		'title_size' => '18',
		'content_size' => '14',
		'prefix_size' => '60',

		'title_color' => gt3_option('header-font'),
		'text_color' => gt3_option('main-font'),
		'prefix_color' => '#efefef',
		'icon_color' => '#ffffff',
		'spot_color' => gt3_option('secondary-font'),
		'line_color' => gt3_option('secondary-font'),
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = $classes = $icon = $main_style = $point_style = $line_style = '';
	$icon_position = $icon_below = $icon_box_horizontal_position = '';

	if ($icon_type == 'font' && !empty($icon_fontawesome)) {
		wp_enqueue_style("font-awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
		$icon = '<i class="gt3_icon_box__icon font_icon '.esc_attr($icon_fontawesome).'" style="color:'.esc_attr($icon_color).'; background:'.esc_attr($spot_color).';"></i>';
	}

	if ($icon_type == 'image' && !empty($thumbnail)) {
		$thumbnail = !empty($thumbnail) ? wp_get_attachment_image( $thumbnail , 'full') : '';
		$icon = '<i class="gt3_icon_box__icon">'.$thumbnail.'</i>';
	}

	// Font Size of Title
	if ($title_size != '') {
		$title_line = $title_size * 1.33;
		$title_css = 'font-size: ' . $title_size . 'px; line-height: ' . $title_line . 'px; ';
	} else {
		$title_css = ' ';
	}

	// Font Size of Content
	if ($content_size != '') {
		$content_line = $content_size * 1.72;
		$content_css = 'font-size: ' . $content_size . 'px; line-height: ' . $content_line . 'px; ';
	} else {
		$content_css = ' ';
	}

	// Font Size of Content
	if ($prefix_size != '') {
		$prefix_css = 'font-size: ' . $prefix_size . 'px;';
	} else {
		$prefix_css = ' ';
	}

	$classes .= ' align-'.$block_align;
	$classes .= ' position_'.$spot_pos;
	$classes .= ' line_align_'.$spot_align;
	$classes .= !empty($title_prefix) ? ' with_prefix' : '';

	$line_type = !empty($spot_type) ? ' line_'.$spot_type : '';
	$p_shadow = $point_shadow == 'yes' ? ' with_shadow' : '';
	$line_style .= !empty($line_width) ? 'width:'.(int)$line_width.'px;' : '';
	$line_style .= !empty($line_color) ? ' color:'.esc_attr($line_color) : '';
	$point_style .= !empty($point_width) ? 'width:'.(int)$point_width.'px; height:'.(int)$point_width.'px;' : '';
	$point_style .= !empty($spot_color) ? ' background:'.esc_attr($spot_color) : '';
	$left_offset = (int)$left_offset;
	$right_offset = (int)$right_offset;
	if ($offset == 'yes' && (!empty($left_offset) || !empty($right_offset))) {
		$main_style .= (!empty($left_offset) ? 'margin-left:'.(int)$left_offset.'px;' : '').(!empty((int)$right_offset) ? 'margin-right:'.(int)$right_offset.'px;' : '');
	}

	echo '<div class="gt3_spot_image'.esc_attr($classes).'" style="'.esc_attr($main_style).'">';
		echo '<div class="spot_info">';
			echo !empty($title_prefix) ? '<span class="spot_header_prefix" style="color:'.esc_attr($prefix_color).';'. esc_attr($prefix_css) .';">'.esc_html($title_prefix).'</span>' : '';
			echo !empty($heading) ? '<h5 class="spot_header" style="color:'.esc_attr($title_color).';'. esc_attr($title_css) .';">'.esc_html($heading).'</h5>' : '';
			echo !empty($text) ? '<p class="spot_text" style="color:'.esc_attr($text_color).';'. esc_attr($content_css) .';">'.esc_html($text).'</p>' : '';
		echo '</div>';
		echo '<div class="spot_icon">';
			echo '' . $icon;
			echo '<div class="spot_line'.esc_attr($line_type).'" style="'.esc_attr($line_style).'">';
				echo '<span class="spot_point'.esc_attr($p_shadow).'" style="'.esc_attr($point_style).'"></span>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

?>
