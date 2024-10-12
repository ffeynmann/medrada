<?php
$defaults = array(
    'autoplay_carousel' => true,
    'slider_speed' 		=> '3000',
	'infinity_scroll' 	=> true,
    'animation' 		=> 'slide',
    'dots_image_width' 	=> '130',
    'dots_image_height' => '105',
    'use_prev_next' 	=> false,
	'adaptive_height' 	=> false,
	'el_class' 			=> '',
	'css' 				=> '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = $gal_images = $dots_image_data = '';
wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
$rand_class = mt_rand(1, 10000);
$set_slick_class = 'slick-class-'.$rand_class.' thumbnail_dots';

if ( $dots_image_width != '' && $dots_image_height != '' ) {
	$dots_image_size = (int)$dots_image_width .'x'.(int)$dots_image_height;
}else{
	$dots_image_size = 'thumbnail';
	$dots_image_width = 130;
	$dots_image_height = 105;
}

/*$slick_settings = '';
$slick_settings .= '"slidesToShow": 1,';
$slick_settings .= '"slidesToScroll": 1,';
$slick_settings .= isset($autoplay_carousel) && $autoplay_carousel ? '"autoplay": true,' : '"autoplay": false,';
$slick_settings .= isset($slider_speed) ? '"autoplaySpeed": '.$slider_speed.',' : '"autoplaySpeed": 3000,';
$slick_settings .= isset($infinity_scroll) && $infinity_scroll ? '"infinite": true,' : '"infinite": false,';
$slick_settings .= isset($use_prev_next) && !$use_prev_next ? '"arrows": true,' : '"arrows": false,';
$slick_settings .= isset($adaptive_height) && $adaptive_height ? '"adaptiveHeight": true,' : '"adaptiveHeight": false,';
$slick_settings .= '"dots": false,';
$slick_settings .= $animation == 'slide' ? '"fade": false,' : '"fade": true,';*/

$slick_settings = '';
$slick_settings .= isset($autoplay_carousel) && $autoplay_carousel ? ' data-autoplay=true' : ' data-autoplay=false';
$slick_settings .= isset($slider_speed) ? ' data-autoplaySpeed='.$slider_speed : ' data-autoplaySpeed=3000';
$slick_settings .= isset($infinity_scroll) && $infinity_scroll ? ' data-infinite=true' : ' data-infinite=false';
$slick_settings .= isset($use_prev_next) && !$use_prev_next ? ' data-arrows=true' : ' data-arrows=false';
$slick_settings .= isset($adaptive_height) && $adaptive_height ? ' data-adaptiveHeight=true' : ' data-adaptiveHeight=false';
$slick_settings .= isset($animation) && $animation == 'slide' ? ' data-fade=false' : ' data-fade=true';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 gt3_module_carousel">
    	<!-- <div class="gt3_carousel_list <?php echo esc_attr($set_slick_class); ?>" data-slick='{<?php echo esc_attr($slick_settings); ?>}' data-slick-class="<?php echo esc_attr($rand_class); ?>"> -->
		<?php 
    	echo '<div class="gt3_carousel_list '.esc_attr($el_class).' '.esc_attr($set_slick_class).'" '.esc_attr($slick_settings).' data-slick-class="'.esc_attr($rand_class).'">';
            echo do_shortcode($content);
        echo '</div>';

			// get count of Rows
        	preg_match_all('/\[vc_row_inner\]/s', $content, $matches_row);
			$count_row = count($matches_row[0]);

			// get all image IDs from child Modules Carousel Item
			preg_match_all('/image_current="(.*?)"/s', $content, $matches_image);
			$matches_image_ids = $matches_image[1];

			$i = 0;

        	echo '<div class="gt3_carousel_thumbnails" data-slides="'.$count_row.'">';
        	while ($i != $count_row ) {
				$item_thumb_cur = !empty($matches_image_ids[$i]) ? $matches_image_ids[$i] : 'default';
				if ( $item_thumb_cur != 'default' && $item_thumb_cur != '' ) {
					$dots_thumbnail = wpb_getImageBySize( array(
						'attach_id' => $item_thumb_cur,
						'thumb_size' => $dots_image_size,
					) );
				}else {
					$dots_thumbnail["thumbnail"] = '<img width="'.$dots_image_width.'" height="'.$dots_image_height.'" src="'.vc_asset_url( 'vc/no_image.png' ).'" alt title />';
				}
        		echo '<div class="gt3_carousel_thumbnails_item">' . $dots_thumbnail["thumbnail"] . '</div>';
        		$i++;
        	}
        	echo '</div>';

		?>
    </div>
</div>
