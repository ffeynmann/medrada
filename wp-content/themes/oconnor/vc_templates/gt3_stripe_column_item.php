<?php

	$defaults = array(
		'title' => '',
		'image' => '',
		'link' => '',
		'item_el_class' => '',
		'css' => ''
	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	extract($_POST['gt3_stripe_columns_opts']);

	$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

	$img_id = preg_replace( '/[^\d]/', '', $image );
	$featured_image = wp_get_attachment_image_src($img_id, 'single-post-thumbnail');
	if (strlen($featured_image[0]) > 0) {
	  $featured_image_url = $featured_image[0];
	} else {
	  $featured_image_url = "";
	}

	$title_color_html = $title_size_html = $content_size_html = $content_color_html = $title_style_html = '';
	if ($title_color != '') {
	    $title_color_html = ' color: '.$title_color.';';
	}
	if ($title_size != '') {
	    $title_size_html = ' font-size: '.$title_size.'px;';
	    $title_size_html .= ' line-height: 1.5;';
	}

	if (($title_size_html != '') || ($title_color_html != '') ) {
		$title_style_html = ' style= "'.esc_attr($title_color_html).esc_attr($title_size_html).'"';
	}

	if ($content_color != '') {
	    $content_color_html = ' color: '.$content_color.';';
	}

	$content_size = !empty($content_size) ? ' font-size: '.$content_size.'px;' : '';

	$content_styles = !empty($content_color) || !empty($content_size) ? ' style="' . esc_attr($content_color_html) . esc_attr($content_size) . '"' : '';


	// Link Settings
	$link_temp = vc_build_link($link);
	$url = $link_temp['url'];
	$btn_title = $link_temp['title'];
	$target = $link_temp['target'];
	if($url !== '') {
		$url = $url;
	} else {
		$url = '#';
	}
	if($btn_title !== '') {
		$title_for_button = 'title="' . esc_attr($btn_title) . '"' ;
	} else {
		$title_for_button = '';
	}
	if($target !== '') {
		$button_target = 'target="' . esc_attr($target) . '"' ;
	} else {
		$button_target = '';
	}

	echo '<div class="stripe_item" style="height:'.esc_attr($items_height).'px;width:'.esc_attr($item_width).'%;background-image:url('.esc_attr($featured_image_url).')">
    		<a class="gt3_stripe-link" href="'.esc_attr($url).'" '.$title_for_button.' '.$button_target.'> </a>
            <div class="stripe_item-wrapper">
            	<h3 class="stripe_item-title"' . $title_style_html . '>' . esc_html($title) . '
                </h3>
                <div class="stripe_item-divider"></div>
                <div class="stripe_item-content" ' . $content_styles . '>' . $content . '</div>
            </div>
        </div>';		
?>
    
