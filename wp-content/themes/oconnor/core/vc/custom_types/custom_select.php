<?php
function gt3_custom_select_function($settings, $value) {
	$output = '';
	$uniquid = uniqid('gt3_custom_select-radio-param');

	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$class = isset($settings['class']) ? $settings['class'] : '';
	$style = isset($settings['css_rules']) ? 'style="'.esc_attr($settings['css_rules']).'"' : '';

	$options = isset($settings['options']) ? $settings['options'] : '';
	$result = empty($value) ? $settings['value'] : $value;

	if(!empty($options) && is_array($options)) {
		$output .= '<div id="'.esc_attr($uniquid).'" class="gt3_custom_select">';
		$output .= '<ul class="options-list">';
		$i = 1;
		foreach($options as $name => $val) {
			$checked = ($val == $result) || (empty($result) && $i == 1) ? 'checked="checked"' : '';
			$output .= '<li '. ($checked != '' ? 'class="active"' : '') .'>'
				. '<label '.$style.'>'
				. '<input type="radio" '. $checked .' value="'.$val.'" />'
				. strip_tags($name,'<i><span>')
				. '</label>'
				. '</li>';
			$i++;
		}
		$output .= '</ul>';
		$output .= '<input type="hidden" name="' . esc_attr($param_name) . '" class="wpb_vc_param_value ' . esc_attr($param_name . ' ' . $type . ' ' . $class) . '" value="'.$result.'" />';
		$output .= '</div>';
	}

	$output .= '<script type="text/javascript">
			jQuery(document).on("click", ".gt3_custom_select input[type=\'radio\']", function() {
				jQuery(this).parents("li").addClass("active").siblings().removeClass("active");
				jQuery(this).parents(".gt3_custom_select").find("input[type=\'hidden\']").val(jQuery(this).val()).trigger("change");
			});
		</script>';

	return $output;
}