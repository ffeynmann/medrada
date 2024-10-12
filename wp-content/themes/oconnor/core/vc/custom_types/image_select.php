<?php

function gt3_image_select($settings, $value) {
    $dependency = '';
    $uid = uniqid();
    $fields = isset($settings['fields']) ? $settings['fields'] : '';
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';

    $output = '<input type="hidden" name="'.esc_attr($param_name).'" class="wpb_vc_param_value trace-img-select '.esc_attr($param_name).' '.esc_attr($type).' '.esc_attr($class).' '.esc_attr($value).'" value="'.esc_attr($value).'" id="trace-'.esc_attr($uid).'"/>';

    $output .='<div id="gt3-icon-'.esc_attr($uid).'" class="gt3-icon-id" >';
    foreach($fields as $field_name => $field_value) {
        $output .= '<label class="'.($field_name == $value ? 'selected' : '').'""><img class="current-field-image" src="' . esc_url($field_value['image']) . '" alt="'.esc_attr(get_the_title()).'"/><input type="radio" name="'.esc_attr($param_name).'" class="wpb_vc_param_value '.esc_attr($param_name).' '.esc_attr($type).' '.esc_attr($class).' d_n" value="'.esc_attr($field_name).'" /><span>' . esc_attr($field_value['descr']) . '</span></label>';
    }
    $output .='</div>';

    return $output;
}
