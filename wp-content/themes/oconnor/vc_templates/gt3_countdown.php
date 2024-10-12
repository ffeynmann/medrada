<?php
	$defaults = array(
        'icon_type'         => 'font',
        'countdown_year'    => '2017',
        'countdown_month'   => '8',
        'countdown_day'     => '14',
        'countdown_hours'   => '12',
        'countdown_min'     => '00',
        'show_seconds'      => 'yes',
        'show_day'          => 'yes',
        'show_hours'        => 'yes',
        'show_minutes'      => 'yes',
        'size'              => '',
        'box_shadow'        => '',
        'vertical_style'    => '',
        'counter_bg'        => '',
        'color'             => '',
        'align'             => '',
        'css_animation'     => '',
	);

	wp_enqueue_script('gt3_coundown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), false, false);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

    $label_years    = esc_html__('Years', 'oconnor');
    $label_months   = esc_html__('Months', 'oconnor');
    $label_weeks    = esc_html__('Weeks', 'oconnor');
    $label_days     = esc_html__('Days', 'oconnor');
    $label_hours    = esc_html__('Hours', 'oconnor');
    $label_minutes  = esc_html__('Minutes', 'oconnor');
    $label_seconds  = esc_html__('Seconds', 'oconnor');

    $label_year     = esc_html__('Year', 'oconnor');
    $label_month    = esc_html__('Month', 'oconnor');
    $label_week     = esc_html__('Week', 'oconnor');
    $label_day      = esc_html__('Day', 'oconnor');
    $label_hour     = esc_html__('Hour', 'oconnor');
    $label_minute   = esc_html__('Minute', 'oconnor');
    $label_second   = esc_html__('Second', 'oconnor');

    $format = '';
    if ($show_day == 'yes') $format     .= 'd';
    if ($show_hours == 'yes') $format   .= 'H';
    if ($show_minutes == 'yes') $format .= 'M';
    if ($show_seconds == 'yes') $format .= 'S';

    if (!empty($format)) $format = ' data-format="'.esc_attr($format).'"';

    $item_style = '';
    if (!empty($counter_bg)) $item_style .= 'background-color:'.esc_attr($counter_bg).';';
    if (!empty($color)) $item_style .= 'color:'.esc_attr($color).';';

    $item_class = '';
    if ($box_shadow == 'yes') $item_class .= ' gt3-countdown--shadow';
    if (!empty($size)) $item_class .= ' gt3-countdown--size_'.$size;
    if ($vertical_style == 'yes') $item_class .= ' gt3-countdown--vertical_style';

    $item_style = !empty($item_style) ? ' style="'.$item_style.'"' : '';

    // Animation
    $animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

	echo '<div class="countdown_wrapper '.esc_attr($animation_class).(!empty($align) ? ' countdown_wrapper--'.esc_attr($align) : '').'">
                    <div class="gt3-countdown'.esc_attr($item_class).'" '.$item_style.' data-year="'.esc_attr($countdown_year).'" data-month="'.esc_attr($countdown_month).'" data-day="'.esc_attr($countdown_day).'" data-hours="'.esc_attr($countdown_hours).'" data-min="'.esc_attr($countdown_min).'" data-label_years="'.esc_attr($label_years).'" data-label_months="'.esc_attr($label_months).'" data-label_weeks="'.esc_attr($label_weeks).'" data-label_days="'.esc_attr($label_days).'" data-label_hours="'.esc_attr($label_hours).'" data-label_minutes="'.esc_attr($label_minutes).'" data-label_seconds="'.esc_attr($label_seconds).'" data-label_year="'.esc_attr($label_year).'" data-label_month="'.esc_attr($label_month).'" data-label_week="'.esc_attr($label_week).'" data-label_day="'.esc_attr($label_day).'" data-label_hour="'.esc_attr($label_hour).'" data-label_minute="'.esc_attr($label_minute).'" data-label_second="'.esc_attr($label_second).'"'.$format.'></div>
                </div>';

