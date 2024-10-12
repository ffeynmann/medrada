<?php
function gt3_on_off_function($settings, $value) {
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $options = isset($settings['options']) ? $settings['options'] : '';
    $std = isset($settings['std']) ? $settings['std'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';

    $output = $checked = '';
    $animation_class = 'active';
    $data_val = 'yes';
    if ($value == 'yes') {
        $checked = "checked";
        $animation_class = '';
    }

    if (empty($value)) {
        $value = $std;
    }

    if(is_array($options) && !empty($options)){
        foreach($options as $key => $opts){
            $animation_class = 'active';
            $data_val = $key;
            if($value == $key){
                $checked = "checked";
                $animation_class = '';
            }
        }
    }

    $uniq_id = uniqid('gt3_on_off_checkbox-'.rand());

    $output .= '<div std="'.$std.'" val="'.$value.'" class="gt3_on_off_checkbox_wrap">
		<input type="checkbox" name="'.esc_attr($param_name).'" value="'.esc_attr($value).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" id="'.esc_attr($uniq_id).'" '.$checked.'>
		<label class="gt3_on_off_checkbox '.esc_attr($animation_class).'" for="'.esc_attr($param_name).'" data-value="'.esc_attr($data_val).'">
			<span class="button-animation"></span>
		</label>
	</div>';

    $output .= '<script type="text/javascript">
			jQuery("#'.esc_js($uniq_id).'").next(".gt3_on_off_checkbox").on("click", function(){
				var $self = jQuery(this),
					$checkbox = $self.siblings("#'.esc_js($uniq_id).'");

				$self.toggleClass("active");

				if($self.hasClass("active")) {
					$checkbox.removeAttr("checked").val("no");
				} else {
					$checkbox.attr("checked","checked").val($self.data("value"));
				}

				$checkbox.trigger("change");
			});
		</script>';

    return $output;
}