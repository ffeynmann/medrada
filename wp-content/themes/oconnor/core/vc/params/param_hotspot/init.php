<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function gt3_func_init_hotspot( $settings, $value ) {
	$value = isset($value) && !empty($value) ? $value : '';
	return '<div class="gt3-hotspot-param-wrapper clearfix">
				<div class="gt3-hotspot-image-holder" data-popup-title="'.esc_attr__('Hotspot tooltip content', 'oconnor').'" data-save-text="'.esc_attr__('Save changes', 'oconnor').'" data-close-text="'.esc_attr__('Close','oconnor').'"></div>
				<input type="hidden" id="'.uniqid('gt3_hotspot_manual-').'" name="'.$settings['param_name'].'" class="wpb_vc_param_value gt3_hotspot_manual '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" />
			</div>';
}

function gt3_hotspot_assets() {
	wp_enqueue_script('gt3_hotspot_js', get_template_directory_uri() . '/core/admin/js/jquery.hotspot.js', array(), false, true);
}


