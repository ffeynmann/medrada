<?php
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
wp_enqueue_script('gt3_sticky_thumb', get_template_directory_uri() . '/woocommerce/js/jquery.sticky-kit.min.js', array('jquery'), false, false);

$gt3_module_carousel_class = $gt3_module_content_side_class = $slide_image = $compile = $title_font = $text_font = $gt3_module_wrap_class = '';
$defaults = array(
    'sticky_height' 		=> 'full',
    'image_option' 			=> 'cover',
    'image_position' 		=> 'center center',
    'autoplay_carousel' 	=> 'yes',
    'slider_speed' 			=> '3000',
	'infinity_scroll' 		=> 'yes',
    'use_prev_next' 		=> 'no',
    'use_pagination' 		=> 'no',
    'animation' 			=> 'slide',

    'values' 				=> '',
    'slider_image' 	 		=> '',
    'slider_title' 			=> '',
    'slider_text' 			=> '',
    'slider_title_color'	=> '#ffffff',
    'slider_text_color'		=> '#ffffff',
    'slider_shadow_color' 	=> 'rgba(0,0,0,0.7)',

    'content_align'			=> 'center',
    'slider_dots_color'		=> '#ffffff',
    'img_size'				=> 'large',

    'title_font_size' 				=> '60',
    'title_line_height' 			=> '140',
    'title_responsive_font' 		=> '',
    'title_font_size_sm_desktop' 	=> '',
    'title_font_size_tablet' 		=> '',
    'title_font_size_mobile'		=> '',
    'title_google_fonts'			=> '',

    'text_font_size' 				=> '24',
    'text_line_height' 				=> '140',
    'text_responsive_font' 			=> '',
    'text_font_size_sm_desktop' 	=> '',
    'text_font_size_tablet' 		=> '',
    'text_font_size_mobile'			=> '',
    'text_google_fonts'				=> '',

    'gap'					  		=> 'none',
    'position'					  	=> 'left',
    'carousel_width' 			  	=> '1/2',
    'carousel_width_small' 		  	=> '1/2',
    'carousel_width_small_content'	=> '',
    'carousel_width_tablet' 		=> '5/12',
    'carousel_width_tablet_content' => '',
    'carousel_width_mobile' 		=> '1/1',

	'el_class' 			=> '',
	'css' 				=> '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

// Render Google Fonts
$obj = new GoogleFontsRender();
extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('title_google_fonts','text_google_fonts') ) );

$title_font .= ! empty( $content_align ) ? 'text-align:'.$content_align.';' : '';
$title_font .= ! empty( $title_font_size ) ? 'font-size:'.(int)$title_font_size.'px;' : '';
$title_font .= ! empty( $title_line_height ) ? 'line-height:'.(int)$title_line_height.'%;' : '';
$title_font .= ! empty( $styles_title_google_fonts ) ? esc_attr( $styles_title_google_fonts ) : '';

$text_font .= ! empty( $content_align ) ? 'text-align:'.$content_align.';' : '';
$text_font .= ! empty( $text_font_size ) ? 'font-size:'.(int)$text_font_size.'px;' : '';
$text_font .= ! empty( $text_line_height ) ? 'line-height:'.(int)$text_line_height.'%;' : '';
$text_font .= ! empty( $styles_text_google_fonts ) ? esc_attr( $styles_text_google_fonts ) : '';

wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
$rand_class = mt_rand(1, 10000);
$set_slick_class = 'slick-class-'.$rand_class;
$slick_settings = '';
$slick_settings .= isset($autoplay_carousel) && $autoplay_carousel ? ' data-autoplay=true' : ' data-autoplay=false';
$slick_settings .= isset($slider_speed) ? ' data-autoplayspeed='.$slider_speed : ' data-autoplayspeed=3000';
$slick_settings .= isset($infinity_scroll) && $infinity_scroll ? ' data-infinite=true' : ' data-infinite=false';
$slick_settings .= $use_prev_next !== 'yes' ? ' data-arrows=true' : ' data-arrows=false';
$slick_settings .= isset($animation) && $animation === 'slide' ? ' data-fade=false' : ' data-fade=true';
$slick_settings .= $use_pagination !== 'yes' ? ' data-dots=true' : ' data-dots=false';

$gt3_module_carousel_class = isset($sticky_height) && $sticky_height === 'full' ? ' sticky_height-full' : ' sticky_height-default';

$slide_image = $image_position != '' ? ' background-position: '.esc_attr($image_position).';' : '';
switch ($image_option) {
    case 'cover':
        $slide_image .= ' background-size: cover;';
        break;
    case 'contain':
        $slide_image .= ' background-size: contain;';
        break;
    case 'no-repeat':
        $slide_image .= ' background-repeat: no-repeat;';
        break;
}

/* Width Compile desktop */
if ( !empty($carousel_width) && $carousel_width !== 'none' ) {
	$func_width = gt3_translateColumnWidthToSpan( $carousel_width );
	$gt3_module_carousel_class .= ' vc_col-lg-'.(int)$func_width[0];
	$gt3_module_content_side_class .= ' vc_col-lg-'.(int)$func_width[1];
}else{
	$gt3_module_carousel_class .= ' vc_hidden-lg';
	$gt3_module_content_side_class .= ' vc_col-lg-12';
}

/* Width Compile small desktop */
if ( !empty($carousel_width_small) && $carousel_width_small !== 'none' ) {
	$func_width_small = gt3_translateColumnWidthToSpan( $carousel_width_small );

	$gt3_module_carousel_class .= ' vc_col-md-'.(int)$func_width_small[0];
	if ( !$carousel_width_small_content && (int)$func_width_small[0] !== 12 ) {
		$gt3_module_content_side_class .= ' vc_col-md-'.(int)$func_width_small[1];
	}else{
		$gt3_module_carousel_class .= ' vc_col-md-gt3_sticky_deactivate';
		$gt3_module_content_side_class .= ' vc_col-md-12';
		$carousel_width_tablet_content = true;
	}
}else{
	$gt3_module_carousel_class .= ' vc_hidden-md';
	$gt3_module_content_side_class .= ' vc_col-md-12';
	$gt3_module_wrap_class .=  ' gt3-md-12';
}

/* Width Compile tablet */
if ( !empty($carousel_width_tablet) && $carousel_width_tablet !== 'none' ) {
	$func_width_tablet = gt3_translateColumnWidthToSpan( $carousel_width_tablet );
	$gt3_module_carousel_class .= ' vc_col-sm-'.(int)$func_width_tablet[0];
	if ( !$carousel_width_tablet_content && (int)$func_width_tablet[0] !== 12 ) {
		$gt3_module_content_side_class .= ' vc_col-sm-'.(int)$func_width_tablet[1];
	}else{
		$gt3_module_carousel_class .= ' vc_col-sm-gt3_sticky_deactivate';
		$gt3_module_content_side_class .= ' vc_col-sm-12';
		$gt3_module_wrap_class .=  ' gt3-sm-12';
	}
}else{
	$gt3_module_carousel_class .= ' vc_hidden-sm';
	$gt3_module_content_side_class .= ' vc_col-sm-12';
}

/* Width Compile mobile */
if ( $carousel_width_mobile !== 'none' ) {
	$gt3_module_carousel_class .= ' vc_col-xs-12';
	$gt3_module_content_side_class .= ' vc_col-xs-12';
	$gt3_module_wrap_class .=  ' gt3-xs-12';
}else{
	$gt3_module_carousel_class .= ' vc_hidden-xs';
	$gt3_module_content_side_class .= ' vc_col-xs-12';
}
/* Width Compile end */

$slider_dots_color = !empty( $slider_dots_color ) ? $slider_dots_color : '';

$values = (array) vc_param_group_parse_atts( $values );
$graph_lines_data = array();

foreach ( $values as $data ) {
	$new_line['slider_image'] = isset( $data['slider_image'] ) ? $data['slider_image'] : '';
	$new_line['slider_title'] = isset( $data['slider_title'] ) ? $data['slider_title'] : '';
	$new_line['slider_text'] = isset( $data['slider_text'] ) ? $data['slider_text'] : '';
	$new_line['slider_title_color'] = isset( $data['slider_title_color'] ) ? $data['slider_title_color'] : '';
	$new_line['slider_text_color'] = isset( $data['slider_text_color'] ) ? $data['slider_text_color'] : '';
	$new_line['slider_shadow_color'] = isset( $data['slider_shadow_color'] ) ? $data['slider_shadow_color'] : '';
	$graph_lines_data[] = $new_line;
}

foreach ( $graph_lines_data as $line ) {

	// Image
	$img_id = preg_replace( '/[^\d]/', '', $line['slider_image'] );
	$image_url = wp_get_attachment_image_url($img_id, 'full');

	$img = wpb_getImageBySize( array(
		'attach_id' => $img_id,
		'thumb_size' => $img_size,
		'class' => 'vc_single_image-img',
	) );
	// $image_img = !empty($img_id) ? wp_get_attachment_image( $img_id , $img_size) : '';
	$slide_image .= $line['slider_image'] != '' ? ' background-image: url(\''.esc_url($image_url).'\');' : '';

	// Box-shadow
	if (preg_match_all('#\((([^()]+|(?R))*)\)#', $line['slider_shadow_color'], $matches)) {
    	$rgba = explode(',', implode(' ', $matches[1]));
	} else {
		$rgba = explode(',', $string);
	}
	$shadow_color_0 = 'rgba('.$rgba[0].','.$rgba[1].','.$rgba[2].',0)';
	$slider_shadow_color = 'background: transparent; background: linear-gradient(to top, '.$line['slider_shadow_color'].', '.$shadow_color_0.');';

	// Compile
	$compile .= '<div class="gt3_sticky_slide">';

		$compile .= '<div class="gt3_sticky_image" style="'.$slide_image.'">';

			$compile .= '<div class="gt3_slider_shadow" style="'.$slider_shadow_color.'"></div>';

			$compile .= $img['thumbnail'];

		$compile .= '</div>';

		$compile .= '<div class="gt3_sticky_content"><div style="position:relative;">';

			$compile .= '<div class="gt3_slider_shadow" style="'.$slider_shadow_color.'"></div>';

			// Title
		    $compile .= '<div class="gt3_title gt3_custom_text" style="color:'.esc_attr($line['slider_title_color']).';'.esc_attr($title_font).'">';
		    if ($title_responsive_font == 'yes') {
		        $compile .= !empty($title_font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$title_font_size_sm_desktop.'px;line-height: ' . (int)$title_line_height . '%;">' : '';
		        $compile .= !empty($title_font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$title_font_size_tablet.'px;line-height: ' . (int)$title_line_height . '%;">' : '';
		        $compile .= !empty($title_font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$title_font_size_mobile.'px;line-height: ' . (int)$title_line_height . '%;">' : '';
		    }
		    $compile .= esc_html($line['slider_title']);
		    if ($title_responsive_font == 'yes') {
		        $compile .= !empty($title_font_size_sm_desktop) ? ' </div>' : '';
		        $compile .= !empty($title_font_size_tablet) ? ' </div>' : '';
		        $compile .= !empty($title_font_size_mobile) ? ' </div>' : '';
		    }
		    $compile .= '</div><!-- .gt3_title -->';

			// Text
		    $compile .= '<div class="gt3_text gt3_custom_text" style="color:'.esc_attr($line['slider_text_color']).';'.esc_attr($text_font).'">';
		    if ($text_responsive_font == 'yes') {
		        $compile .= !empty($text_font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$text_font_size_sm_desktop.'px;line-height: ' . (int)$text_line_height . '%;">' : '';
		        $compile .= !empty($text_font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$text_font_size_tablet.'px;line-height: ' . (int)$text_line_height . '%;">' : '';
		        $compile .= !empty($text_font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$text_font_size_mobile.'px;line-height: ' . (int)$text_line_height . '%;">' : '';
		    }
		    $compile .= esc_html($line['slider_text']);
		    if ($text_responsive_font == 'yes') {
		        $compile .= !empty($text_font_size_sm_desktop) ? ' </div>' : '';
		        $compile .= !empty($text_font_size_tablet) ? ' </div>' : '';
		        $compile .= !empty($text_font_size_mobile) ? ' </div>' : '';
		    }

		    $compile .= '</div><!-- .gt3_text -->';
	    $compile .= '</div></div>';

    $compile .= '</div><!-- .gt3_sticky_slide -->';
}

$gap_ = array('sticky_side'=>'0px','content_side'=>'0px');
if ( !empty($gap) && $gap !== '' && $gap !== 'none' ) {
	if ( (int)$gap % 2 ) {
		$gap = (int)$gap / 2;
		$gap_['sticky_side']  = ceil($gap)  . 'px';
		$gap_['content_side'] = floor($gap) . 'px';
	}else{
		$gap_['sticky_side'] = $gap_['content_side'] = $gap / 2 . 'px';
	}
}


if ( $position === 'left' ) {
	echo '<div class="vc_row gt3_module_sticky_side '.esc_attr($gt3_module_wrap_class).'">

			<div class="gt3_module_carousel_substitute '.esc_attr($gt3_module_carousel_class).'"></div>
			<div class="gt3_module_carousel '.esc_attr($gt3_module_carousel_class).'" style="padding-right:'.esc_attr($gap_['sticky_side']).';">
				<div class="gt3_carousel_list gt3_carousel_sticky_side '.esc_attr($set_slick_class).'" '.esc_attr($slick_settings).' data-slick-class="'.esc_attr($rand_class).'" data-dots-color="'.esc_attr($slider_dots_color).'">
					'.$compile.'
				</div>
		   	</div>

		    <div class="'.esc_attr($gt3_module_content_side_class).'" style="padding-left:'.esc_attr($gap_['content_side']).';">
		    	'.do_shortcode($content).'
		    </div>

		</div>';
}else{
	echo '<div class="vc_row gt3_module_sticky_side module_sticky_side_pos_right '.esc_attr($gt3_module_wrap_class).'">

		    <div class="'.esc_attr($gt3_module_content_side_class).'" style="padding-right:'.esc_attr($gap_['content_side']).';">
		    	'.do_shortcode($content).'
		    </div>

			<div class="gt3_module_carousel_substitute '.esc_attr($gt3_module_carousel_class).'"></div>
			<div class="gt3_module_carousel sticky_side_pos_right '.esc_attr($gt3_module_carousel_class).'" style="padding-left:'.esc_attr($gap_['sticky_side']).';">
				<div class="gt3_carousel_list gt3_carousel_sticky_side '.esc_attr($set_slick_class).'" '.esc_attr($slick_settings).' data-slick-class="'.esc_attr($rand_class).'" data-dots-color="'.esc_attr($slider_dots_color).'">
					'.$compile.'
				</div>
		   	</div>

		</div>';
}

