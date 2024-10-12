<?php
	$defaults = array(
		'icon_fontawesome' => '',
		'text' => '',
		'closable' => '',
		'background' => '',
		'text_color' => '',
		'animation_class' => ''
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$icon = '';
	if (!empty($icon_fontawesome)) {
		vc_icon_element_fonts_enqueue( 'fontawesome' );
		$icon = '<i class="gt3_message_box__icon '.esc_attr($icon_fontawesome).'"></i>';
	}

	// Animation
	if (! empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	} else {
		$animation_class = '';
	}

	if (!empty($text)) {
		$content .= !empty($text) ?'<div class="gt3_message_box__text">'.esc_html($text).'</div>' : '';
	}else{
		$content .= '';
	}

	echo '<div class="gt3_message_box '.(!empty($icon) ? ' gt3_message_box-with-icon' : '').($closable == 'yes' ? ' gt3_message_box-closable' : '').esc_attr($animation_class).'" style="background:'.esc_attr($background).'; color:'.esc_attr($text_color).';">';
		echo  (($icon));
		echo  (($content));
		echo  'yes' == $closable ? '<i class="gt3_message_box__close fa fa-times" aria-hidden="true"></i>' : '';
	echo '</div>';

?>
