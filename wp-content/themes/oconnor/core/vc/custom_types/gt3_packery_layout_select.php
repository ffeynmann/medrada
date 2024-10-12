<?php

function gt3_packery_layout_select_function($settings, $value) {
	$gt3_return = '';
	$default = isset($settings['default']) ? $settings['default'] : 'on';
	
	$gt3_return .= '
	<div class="gt3_packery_ls d_block_middle">
		<div class="gt3_packery_ls_cont" data-value="'. $value .'">
			<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="gt3_packery_ls_value wpb_vc_param_value" value="'. $value .'">
			<div class="gt3_packery_ls_item gt3_packery_ls_item3 pls_3items" data-value="pls_3items"></div>
			<div class="gt3_packery_ls_item gt3_packery_ls_item4 pls_4items" data-value="pls_4items"></div>
			<div class="gt3_packery_ls_item gt3_packery_ls_item5 pls_5items" data-value="pls_5items"></div>
			<div class="gt3_packery_ls_item gt3_packery_ls_item6 pls_6items" data-value="pls_6items"></div>
		</div>
	</div>
	';
	return $gt3_return;
	
}