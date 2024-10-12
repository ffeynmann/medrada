<?php
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$defaults = array(
	'select_source' => 'module_images',
	'select_gallery_post' => '',
	'images' => '',
	'packery_layout' => '',
	'layouts_on_start' => '1',
	'layouts_per_load' => '1',
	'overlay_bg' => '',
	'items_padding' => '15px',		
	'button_title' => esc_html__("Load More", 'oconnor'),
	'custom_css' => '',
	'custom_class' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($custom_css, ' '), $this->settings['base'], $atts);
$item_in_row = 3;
$items_per_load = 6;
$items_on_start = 6;
$width = '1000';
$height = '1000';

if ($packery_layout == 'pls_3items') {
	$item_in_row = 3;
	$items_in_layout = 6;
	$items_per_load = $layouts_per_load * $items_in_layout;
	$items_on_start = $layouts_on_start * $items_in_layout;
}
if ($packery_layout == 'pls_4items') {
	$width = '1000';
	$height = '668';
	$item_in_row = 4;
	$items_in_layout = 8;
	$items_per_load = $layouts_per_load * $items_in_layout;
	$items_on_start = $layouts_on_start * $items_in_layout;
}
if ($packery_layout == 'pls_4_12items') {
	$item_in_row = 412;
	$items_in_layout = 12;
	$items_per_load = $layouts_per_load * $items_in_layout;
	$items_on_start = $layouts_on_start * $items_in_layout;
}
if ($packery_layout == 'pls_5items') {
	$item_in_row = 5;
	$items_in_layout = 10;
	$items_per_load = $layouts_per_load * $items_in_layout;
	$items_on_start = $layouts_on_start * $items_in_layout;
}
if ($packery_layout == 'pls_6items') {
	$item_in_row = 6;
	$items_in_layout = 12;
	$items_per_load = $layouts_per_load * $items_in_layout;
	$items_on_start = $layouts_on_start * $items_in_layout;
}

$compile = '';
$images_ids = empty( $images ) ? array() : explode( ',', trim( $images ) );
$uniqid = mt_rand(0, 9999);
	wp_enqueue_script('gt3_swipebox_js', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox.min.js', array(), false, false);
	wp_enqueue_style('gt3_swipebox_style', get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css');
	wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
	wp_enqueue_script('gt3_isotope_sorting_packery', get_template_directory_uri() . '/js/sorting_packery.js', array(), false, true);

if (($select_source == 'module_images' && is_array($images_ids)) || ($select_source == 'gallery_post' && $select_gallery_post !== '')) { 	
	?>
    <div class="packery_gallery_wrapper personal_preloader packery_<?php echo esc_attr($uniqid) .' '. esc_attr($css_class) . ' ' . $custom_class; ?>"
    	data-uniqid="<?php echo esc_attr($uniqid); ?>" 
        data-pad="<?php echo esc_attr($items_padding); ?>" 
        data-perload="<?php echo esc_attr($items_per_load); ?>" 
        data-onstart="<?php echo esc_attr($items_on_start); ?>" 
        data-layout="<?php echo esc_attr($item_in_row); ?>">
        
        <div class="packery_gallery personal_preloader packery_columns<?php echo esc_attr($item_in_row); ?>" 
        	data-pad="<?php echo esc_attr($items_padding); ?>" 
            data-perload="<?php echo esc_attr($items_per_load); ?>" 
            data-overlay="<?php echo esc_attr($overlay_bg); ?>" 
            data-layout="<?php echo esc_attr($item_in_row); ?>">
        	<?php
		$list_array = array();
		$post_array = array();
		$post_num = 0;
			
		$imgCounter = 0;
		if ($select_source == 'module_images' && is_array($images_ids)) {
			foreach ($images_ids as $key => $image) {
				$imgCounter++;
				if ($imgCounter > $items_in_layout) {
					$imgCounter = 1;
				}			
				$photoTitle = get_the_title($image);
				$photoCaption = '';
				$attach_meta = gt3_get_attachment($image);
				$photoCaption = $attach_meta['caption'];
				$PCREpattern = '/\r\n|\r|\n/u';
				$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));
				
				$featured_image = wp_get_attachment_url($image);
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image), $width, $height, true, true, true);
				} else {
					$featured_image_url = GT3_IMGURL.'/packery_holder.png';
				}
				
				$featured_image = wp_get_attachment_image_src($image, 'original');
	
				$post_array['attach_id'] = $image;
				$post_array['slide_type'] = 'image';
				$post_array['title'] = $photoTitle;
				$post_array['thmb'] = $featured_image_url;
				$post_array['url'] = $featured_image[0];
				$post_array['count'] = $imgCounter;
				array_push($list_array, $post_array);
			}//EoForeach
		}
		if ($select_source == 'gallery_post' && $select_gallery_post !== '')	{
			$gallery_post = gt3_get_theme_pagebuilder($select_gallery_post);
			$post_images = $gallery_post['sliders']['fullscreen']['slides'];
			foreach ($post_images as $imageid => $image) {
				$imgCounter++;
				if ($imgCounter > $items_in_layout) {
					$imgCounter = 1;
				}			
				$photoTitle = get_the_title($image['attach_id']);
				$photoCaption = '';
				$attach_meta = gt3_get_attachment($image['attach_id']);
				$photoCaption = $attach_meta['caption'];
				$PCREpattern = '/\r\n|\r|\n/u';
				$photoCaption = preg_replace($PCREpattern, '', nl2br($photoCaption));
				
				$featured_image = wp_get_attachment_url($image['attach_id']);
				if (strlen($featured_image[0]) > 0) {
					$featured_image_url = aq_resize(esc_url($featured_image), $width, $height, true, true, true);
				} else {
					$featured_image_url = GT3_IMGURL.'/packery_holder.png';
				}
				
				$post_array['attach_id'] = $image;
				if ($image['slide_type'] == 'video') {
					$post_array['slide_type'] = 'video';
					$post_array['url'] = $image['src'];
				} else {
					$post_array['slide_type'] = 'image';
					$post_array['url'] = esc_url($featured_image);
				}
				$post_array['slide_type'] = 'image';
				$post_array['title'] = $photoTitle;
				$post_array['thmb'] = $featured_image_url;
				$post_array['count'] = $imgCounter;
				array_push($list_array, $post_array);
			}
		}

		$post_per_page = $items_on_start;
		if ($post_per_page > count($list_array)) {
			$post_per_page = count($list_array);
		}

		$i = 0;
		while ($i < $post_per_page) {
			if ($list_array[$i]['slide_type'] == 'image') {
				$thishref = wp_get_attachment_url($list_array[$i]['attach_id']);
				$thisvideoclass = '';
			} else if ($list_array[$i]['slide_type'] == 'video') {
				$thishref = $list_array[$i]['src'];
				$thisvideoclass = 'video_zoom';
			}
			$photoTitle = '';
			$photoTitle = $list_array[$i]['title'];
			if (isset($photoTitle) && $photoTitle !== '') {
				$photoTitle = str_replace('"', "'", $photoTitle);
			}
			$photoAlt = get_post_meta($list_array[$i]['attach_id'], '_wp_attachment_image_alt', true);
			if (!isset($photoAlt) || $photoAlt = '') {
				$photoAlt = $photoTitle;
			}
			$imgCounter = $list_array[$i]['count'];
			$featured_image = $list_array[$i]['url'];
			$img_thmb = $list_array[$i]['thmb'];
		?>
			<div class="packery-item element anim_el anim_el2 loading packery_block2preload packery-item<?php echo esc_attr($imgCounter); ?>" data-count="<?php echo esc_attr($imgCounter); ?>">
				<div class="packery_item_inner gt3_js_bg_img" data-src="<?php echo esc_url($img_thmb); ?>">
					<?php 
					if ($list_array[$i]['slide_type'] == 'image') {
						 echo '<a class="swipebox" href="'. esc_url($featured_image) .'" title="'. esc_attr($photoTitle) .'"></a>';
					} else if ($list_array[$i]['slide_type'] == 'video') {
						#YOUTUBE
						$is_youtube = substr_count($list_array[$i]['src'], "youtu");
						if ($is_youtube > 0) {
							echo '<a class="swipebox" rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['src']) .'" title="'. esc_attr($photoTitle) .'"></a>';
						}
						#VIMEO
						$is_vimeo = substr_count($list_array[$i]['src'], "vimeo");
						if ($is_vimeo > 0) {
							echo '<a class="swipebox" rel="gallery'. esc_attr($uniqid) .'" href="'. esc_url($list_array[$i]['src']) .'" title="'. esc_attr($photoTitle).'"></a>';
						}
					}
					?>
                    <div class="packery_overlay"></div>
                    <span class="gt3_plus_icon"></span>
                    <div class="img-preloader"></div>
				</div>
			</div><!-- .packery-item -->
		<?php
			unset($list_array[$i]);
			$i++;
		} //EoWhile First Load					
	?>
		</div><!-- .packery_gallery -->
	<?php
		if (isset($list_array) && count($list_array) > 0) {
			gt3_gallery_array2js($list_array, $uniqid);
			$compile .= '<div class="gt3_grid_module_button">';		
			$compile .= '<a class="shortcode_button packery_load_more" href="'. esc_js("javascript:void(0)") .'"><span>' . $button_title . '</span></a>';
			$compile .= '</div>';
			echo (($compile));
		}
	?>
	</div><!-- .packery_gallery_wrapper -->
    <?php
}
?>