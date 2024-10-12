<?php
	include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
	$defaults = array(
		'title' => '',
		'package_is_active' => 'no',
		'price' => '',
		'header_img' => '',
		'price_prefix' => '',
		'price_suffix' => '',
		'price_description' => '',
	  	'button_link' => '',
		'item_el_class' => '',
		'css' => '',
		'price_header_size' => '',
	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

	// Header Image

	$img_id = preg_replace( '/[^\d]/', '', $header_img );
	$featured_image = wp_get_attachment_image_src($img_id, 'full');
	if (strlen($featured_image[0]) > 0) {
	  $featured_image_url = $featured_image[0];
	} else {
	  $featured_image_url = "";
	}

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_price_header', 'google_fonts_price_content') ) );

	if ( ! empty( $styles_google_fonts_price_header ) ) {
		$price_title_font = esc_attr( $styles_google_fonts_price_header );
	} else {
		$price_title_font = '';
	}
	if ( ! empty( $styles_google_fonts_price_content ) ) {
		$price_content_font = esc_attr( $styles_google_fonts_price_content );
	} else {
		$price_content_font = '';
	}

	// Button Settings
	$button_link_temp = vc_build_link($button_link);
	$url = $button_link_temp['url'];
	$link_title = $button_link_temp['title'];
	$target = $button_link_temp['target'];
	if($url !== '') {
		$url = $url;
	} else {
		$url = '#';
	}		
	if($link_title !== '') {
		$link_for_button = $link_title;
	} else {
		$link_for_button = '';
	}
	if($target !== '') {
		$button_target = 'target="' . esc_attr($target) . '"';
	} else {
		$button_target = '';
	}

	if (!empty($link_for_button) && !empty($url) ) {
		$btn_color_data = isset($btn_color) ? ' data-btn-color="'.esc_attr($btn_color).'"' : '';
		$button_link_html = '<div class="price_button"><div class="gt3_module_button  button_alignment_center"><a class="shortcode_button button_size_normal'. (isset($use_alt_button_style) ? ' alt' : '')  .'" href="'.esc_url($url).'" '.$button_target.' '.$btn_color_data.'><span class="gt3_btn_text">' . $link_for_button . '</span></a></div></div>';
	} else {
		$button_link_html = '';
	}
	
	// Button Settings (End)

	// headings
	$heading_text = $subheading_text = $content_text = $divider_text ='';
	if ($title != '') {
		$heading_text = '<h3>' . $title . '</h3>';
	} else {
		$heading_text = '';
	}

	if ($price_prefix != '') {
		$prefix_text = '<span class="price_item_prefix">'.$price_prefix.'</span>';
	} else {
		$prefix_text = '';
	}

	if ($price_suffix != '') {
		$suffix_text = '<span class="price_item_suffix">'.$price_suffix.'</span>';
	} else {
		$suffix_text = '';
	}

	$header_style = '';
	$header_style .= !empty($price_title_font) ? $price_title_font : '';
	$header_style .= !empty($featured_image_url) ? 'background-image:url('.esc_attr($featured_image_url).');' : '';

	$header_style_print = !empty($header_style) ? 'style="'.$header_style.'" ' : '';
	$content_style = !empty($price_content_font) ? 'style="'.$price_content_font.'"' : '';
	$header_class = (!empty($featured_image_url) ? ' with-image' : '');
	$header_class .= (!empty($price_title_font) ? ' custom-font' : '');

  	echo '<div class="price_item'.($package_is_active == "yes" ? ' most_popular ' : '').esc_attr($css_class).'">
      		<div class="price_item_wrapper">
				<div class="item_cost_wrapper '.esc_attr($header_class).' " '.$header_style_print.'>
					<div class="price_item_title">' . $heading_text . '</div>
					<div class="price_item-cost">' . $prefix_text . $price . $suffix_text . '</div>
				</div>
				<div class="price_item_body" '.$content_style.'>
					<div class="items_text">' .
						$content . '
					</div>'.
					( !empty($price_description) ? '<div class="price_item_description">' . esc_html($price_description) . '</div>' : '' ) .
					$button_link_html . '
				</div>
			</div>
		</div>
  ';
?>
    
