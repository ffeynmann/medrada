<?php

$defaults = array(
    'posts_per_line' 	=> '1',
    'autoplay_carousel' => 'yes',
    'slider_speed' 		=> '3000',
    'scroll_items' 		=> 'no',
	'infinity_scroll' 	=> 'yes',
    'animation' 		=> 'slide',
    'use_pagination' 	=> 'dots',
    'pagination_outside'=> 'no',
    'use_prev_next' 	=> 'no',
	'adaptive_height' 	=> 'no',
	'el_class' 			=> '',
	'css' 				=> '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';
wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
$rand_class = mt_rand(1, 10000);
$set_slick_class = 'slick-class-' . $rand_class;
$set_slick_class .= $use_pagination == 'num' ? ' dots_number' : '';
$set_slick_class .= $pagination_outside == 'yes' ? ' gt3_pagination_outside' : '';

switch ($posts_per_line) {
	case '1':
		$responsive_1024 = 1;
		$responsive_600 = 1;
		$responsive_480 = 1;

		$responsive_sltscrl_1024 = 1;
		$responsive_sltscrl_600 = 1;
		$responsive_sltscrl_480 = 1;
		break;
	case '2':
		$responsive_1024 = 2;
		$responsive_600 = 2;
		$responsive_480 = 1;
		break;
	case '3':
		$responsive_1024 = 3;
		$responsive_600 = 2;
		$responsive_480 = 1;
		break;
	case '4':
		$responsive_1024 = 4;
		$responsive_600 = 2;
		$responsive_480 = 1;
		break;
	case '5':
		$responsive_1024 = 4;
		$responsive_600 = 2;
		$responsive_480 = 1;
		break;
	case '6':
		$responsive_1024 = 4;
		$responsive_600 = 2;
		$responsive_480 = 1;
		break;

	default:
		$responsive_1024 = 1;
		$responsive_600 = 1;
		$responsive_480 = 1;
		break;
}

$responsive_sltscrl_1024 = isset($scroll_items) && $scroll_items == 'yes' ? 1 : $responsive_1024;
$responsive_sltscrl_600 = isset($scroll_items) && $scroll_items == 'yes' ? 1 : $responsive_600;
$responsive_sltscrl_480 = isset($scroll_items) && $scroll_items == 'yes' ? 1 : $responsive_480;

$slick_settings = '';
$slick_settings .= isset($posts_per_line) ? '"slidesToShow": '.esc_attr($posts_per_line).',' : '"slidesToShow": 1,';
$slick_settings .= isset($scroll_items) && $scroll_items ? '"slidesToScroll": 1,' : '"slidesToScroll": '.esc_attr($posts_per_line).',';
$slick_settings .= isset($autoplay_carousel) && $autoplay_carousel == 'yes' ? '"autoplay": true,' : '"autoplay": false,';
$slick_settings .= isset($slider_speed) ? '"autoplaySpeed": '.esc_attr($slider_speed).',' : '"autoplaySpeed": 3000,';
$slick_settings .= isset($infinity_scroll) && $infinity_scroll == 'yes' ? '"infinite": true,' : '"infinite": false,';
$slick_settings .= isset($use_prev_next) && $use_prev_next == 'yes' ? '"arrows": true,' : '"arrows": false,';
$slick_settings .= isset($adaptive_height) && $adaptive_height == 'yes' ? '"adaptiveHeight": true,' : '"adaptiveHeight": false,';

$slick_settings .= $use_pagination != 'none' ? '"dots": true,' : '"dots": false,';
$slick_settings .= isset($animation) && $animation == 'slide' ? '"fade": false,' : '"fade": true,';

$slick_settings .= '"responsive": [{"breakpoint": 1024,"settings": {"slidesToShow": '.esc_attr($responsive_1024).',"slidesToScroll": '.esc_attr($responsive_sltscrl_1024).'}},{"breakpoint": 600, "settings": {"slidesToShow": '.esc_attr($responsive_600).', "slidesToScroll": '.esc_attr($responsive_sltscrl_600).'}}, {"breakpoint": 480, "settings": {        "slidesToShow": '.esc_attr($responsive_480).', "slidesToScroll": '.esc_attr($responsive_sltscrl_480).' } } ]';
?>
<div class="vc_row">
    <div class="vc_col-sm-12 gt3_module_carousel">
    	<div class="gt3_carousel_list <?php echo esc_attr($set_slick_class).' '.esc_attr($el_class); ?>" data-slick='{<?php echo esc_attr($slick_settings); ?>}' data-slick-class="<?php echo esc_attr($rand_class); ?>">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
</div>
