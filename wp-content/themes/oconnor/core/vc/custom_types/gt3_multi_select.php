<?php

function gt3_multi_select($settings, $value) {

    $param_name   = isset($settings['param_name']) ? $settings['param_name'] : '';
    $param_option = isset($settings['options']) ? $settings['options'] : '';
    if (function_exists('vc_generate_dependencies_attributes')) {
        $dependency = vc_generate_dependencies_attributes( $settings );
    }else{
        $dependency = '';
    }
    $output       = '<input type="hidden" name="' . $param_name . '" id="' . $param_name . '" class="gt3-multi-select wpb_vc_param_value ' . $param_name . '" value="' . $value . '"  ' . $dependency . ' />';
    $output       .= '<select multiple id="' . $param_name . '_select2" name="' . $param_name . '_select2" class="multi-select">';
    if ($param_option != '' && is_array($param_option)) {
        foreach ($param_option as $text_val => $val) {
            if (is_numeric($text_val) && (is_string($val) || is_numeric($val))) {
                $text_val = $val;
            }
            $selected = in_array($val, explode(',', $value)) ? 'selected="selected"' : '';
            $output   .= '<option id="' . $val . '" value="' . $val . '" ' . $selected . '>' . htmlspecialchars($text_val) . '</option>';
        }
    }
    $output .= '</select>';
    return $output;
}
