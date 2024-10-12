<?php
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$defaults = array(
    'video_title' 		=> '',
    'bg_image' 			=> '',
    'align' 			=> 'center',
    'video_link' 		=> '#',
    'title_color' 		=> '',
    'btn_color' 		=> '#ffffff',
    'title_size' 		=> '',
    'button_animation' 	=> 'no',
    'count_lines' 		=> 4,
    'color_lines' 		=> '#ffffff',
    'diameter_lines' 	=> 200,
    'lines_width' 		=> 3,
    'shadow_lines_width'=> 0,
    'lines_delay' 		=> 400,
);

wp_enqueue_script('gt3_swipebox_js', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox.min.js', array(), false, false);
wp_enqueue_style('gt3_swipebox_style', get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css');

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);


// Render Google Fonts
$obj = new GoogleFontsRender();
extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_vpopup_title') ) );

$vpopup_title_font = !empty($styles_google_fonts_vpopup_title) ? esc_attr($styles_google_fonts_vpopup_title) : '';

// Font Size of Title
$title_size = $title_size != '' ? 'font-size: '.$title_size.'px;line-height:'.$title_size * 1.5.'px;' : ' ';


$title_color = !empty($title_color) ? 'color: '.$title_color.';' : '';
$title_style = !empty($title_color) || !empty($title_size) || !empty($vpopup_title_font) ? 'style="'.esc_attr($title_color).$vpopup_title_font.esc_attr($title_size).'"' : '';
$video_title = !empty($video_title) ? '<h2 class="video-popup__title" '.$title_style.' >'.esc_html($video_title).'</h2>' : '';

$anim_divs = $anim_style = $lines = '';
if ($button_animation == 'yes') {

	$duration = (int)$count_lines * $lines_delay;
	$anim_style .= '-webkit-animation-duration: '.(int)$duration.'ms;';
	$anim_style .= '-moz-animation-duration: '.(int)$duration.'ms;';
	$anim_style .= '-o-animation-duration: '.(int)$duration.'ms;';
	$anim_style .= 'animation-duration: '.(int)$duration.'ms;';
	$anim_style .= 'box-shadow: 0 0 '.(int)$shadow_lines_width.'px '.(int)$lines_width.'px '.esc_attr($color_lines).';';

	$anim_wrap_wh = !empty($diameter_lines) ? 'height:'.(int)$diameter_lines.'px;width:'.(int)$diameter_lines.'px;': '';
	$anim_divs  .= '<div class="video-popup-animation" style="'.esc_attr($anim_wrap_wh).'">';

	$x = 0;
	while ( $x < (int)$count_lines ) {
		$delay = $lines_delay * $x;
		$animation_style = '';

		$animation_style .= '-webkit-animation-delay: '.(int)$delay.'ms;';
		$animation_style .= '-moz-animation-delay: '.(int)$delay.'ms;';
		$animation_style .= '-o-animation-delay: '.(int)$delay.'ms;';
		$animation_style .= 'animation-delay: '.(int)$delay.'ms;';

		$anim_divs  .= '<div style="'.esc_attr($anim_style).esc_attr($animation_style).'"></div>';
		$x++;
	}

	$anim_divs  .= '</div>';
}

if ( empty($bg_image) ){
	echo '<div class="video-popup-wrapper'.(!empty($align) ? ' video-popup-wrapper__'.esc_attr($align) : '').'">';
		if (!empty($align) && $align != 'left') {
			echo ''.$video_title;
		}
		echo '<div class="video-popup-inner_wrap">';
			echo '<a class="video-popup__link swipebox-video" href="'.esc_url($video_link).'" style="border-color:'.esc_attr($btn_color).';background-color:'.esc_attr($btn_background_color).'">';
				echo ''.$anim_divs;
				echo '<svg width="13" height="18"><polygon points="1,1 1,16 11,9" fill="'.esc_attr($btn_color).'" stroke="'.esc_attr($btn_color).'" stroke-width="2" /></svg>';
		    echo '</a>';
			if (!empty($align) && $align == 'left') {
				echo ''.$video_title;
			}
		echo '</div>';
	echo '</div>';
} else{
	echo '<div class="video-popup-wrapper">';
		echo '<div class="video-popup__responsive-title">'.$video_title.'</div>';
		echo '<div class="video-popup-inner_wrap">';
			echo '<a href="'.esc_url($video_link).'" class="video-popup__wrapper-link with-img swipebox-video">';
				echo wp_get_attachment_image( $bg_image , 'full');
				echo '<div class="video-popup__content">';
					echo ''.$video_title;
					echo '<span class="video-popup__link"  style="background-color:'.esc_attr($btn_background_color).'; border-color:'.esc_attr($btn_color).';">';
						echo ''.$anim_divs;
						echo '<svg width="13" height="18"><polygon points="1,1 1,16 11,9" fill="'.esc_attr($btn_color).'" stroke="'.esc_attr($btn_color).'" stroke-width="2" /></svg>';
	            	echo '</span>';
				echo '</div>';
			echo '</a>';
		echo '</div>';
	echo '</div>';
}
