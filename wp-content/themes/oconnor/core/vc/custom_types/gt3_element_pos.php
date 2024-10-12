<?php


function gt3_shift_title_function($settings, $value) {
	$gt3_return = '';
	$default = isset($settings['default']) ? $settings['default'] : 'on';
	
	$gt3_return .= '
	<div class="gt3_elpos_block">
		<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="gt3_elpos_value gt3_elpos_value_base wpb_vc_param_value" value="'. $value .'">
		<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '_left" class="gt3_elpos_value gt3_elpos_value_left wpb_vc_param_value" value="'. $value .'">
		<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '_right" class="gt3_elpos_value gt3_elpos_value_right wpb_vc_param_value" value="'. $value .'">
		<div class="gt3_elpos_wrapper gt3_elpos_wrapper_left">
			<span class="gt3_elpos_title vc_description">' . esc_attr( $settings['left_caption'] ) . '</span>
			<div class="gt3_elpos_inner gt3_elpos_inner_left">
				<input class="gt3_elpos_el wpb_vc_param_value left_top" value="left_top" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value gt3_elpos_middle_el center_top" value="center_top" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value right_top" value="right_top" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
				</br>
				<input class="gt3_elpos_el wpb_vc_param_value left_middle" value="left_middle" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value gt3_elpos_middle_el center_middle" value="center_middle" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value right_middle" value="right_middle" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
				</br>
				<input class="gt3_elpos_el wpb_vc_param_value left_bottom" value="left_bottom" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value gt3_elpos_middle_el center_bottom" value="center_bottom" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value right_bottom" value="right_bottom" name="' . esc_attr( $settings['param_name'] ) . '_left_radio" type="radio">
			</div>
		</div>
		<div class="gt3_elpos_wrapper gt3_elpos_wrapper_right">
			<span class="gt3_elpos_title vc_description">' . esc_attr( $settings['right_caption'] ) . '</span>
			<div class="gt3_elpos_inner gt3_elpos_inner_right">
				<input class="gt3_elpos_el wpb_vc_param_value left_top" value="left_top" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value gt3_elpos_middle_el center_top" value="center_top" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value right_top" value="right_top" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
				</br>
				<input class="gt3_elpos_el wpb_vc_param_value left_middle" value="left_middle" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value gt3_elpos_middle_el center_middle" value="center_middle" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value right_middle" value="right_middle" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
				</br>
				<input class="gt3_elpos_el wpb_vc_param_value left_bottom" value="left_bottom" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value gt3_elpos_middle_el center_bottom" value="center_bottom" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
				<input class="gt3_elpos_el wpb_vc_param_value right_bottom" value="right_bottom" name="' . esc_attr( $settings['param_name'] ) . '_right_radio" type="radio">
			</div>
		</div>
	</div>
	';
	return $gt3_return;
	
}