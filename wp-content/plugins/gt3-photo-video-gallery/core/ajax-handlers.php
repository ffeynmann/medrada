<?php
if(!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

add_action('wp_ajax_gt3_save_gt3pg_options', 'gt3_save_gt3pg_options');
function gt3_save_gt3pg_options(){
	if(is_admin()) {
		$response         = array();
		$gt3pg_options    = gt3pg_get_option("photo_gallery", array());
		$serialize_string = stripslashes($_POST['serialize_string']);

		$theme_sidebars = array();

		$is_integer = apply_filters('gt3pg_save_integer_fields', array(
			'columns',
			'margin',
			'borderPadding',
			'borderSize',
			'linkTo_lightbox_autoplay',
			'linkTo_lightbox_autoplay_time',
			'linkTo_lightbox_preview',
		));

		foreach(json_decode($serialize_string, true) as $key => $value) {
			$gt3pg_options[$value['name']] = in_array($value['name'], $is_integer) ? intval($value['value']) : $value['value'];
			$pos                           = strpos($value['name'], 'theme_sidebars');
			if($pos === false) {
			} else {
				$theme_sidebars[] = $value['value'];
			}
		};

		if(gt3pg_update_option("photo_gallery", $gt3pg_options)) {
			$response['save_status'] = "saved";
		} else {
			$response['save_status'] = "nothing_changed";
		}

		echo json_encode($response);
	}

	die();
}

add_action('wp_ajax_gt3_reset_gt3pg_settings', 'gt3_reset_gt3pg_settings');
function gt3_reset_gt3pg_settings(){
	if(is_admin()) {
		gt3pg_delete_option("photo_gallery");

		echo '<div>Done!</div>';
	}

	die();
}

