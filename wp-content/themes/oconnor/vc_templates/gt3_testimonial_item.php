<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $tstm_author
 * @var $tstm_author_position
 * @var $image
 * @var $img_width
 * @var $img_height
 * @var $round_imgs
 * @var $item_el_class
 *
 * @var $text_color
 * @var $sign_color
 * @var $view_type
 * @var $testimonilas_text_size
 * @var $testimonilas_text_line_height
 * @var $testimonilas_author_size
 * @var $testimonilas_author_line_height
 * @var $img_width
 * @var $img_height
 * @var $round_imgs
 * @var $item_background_color
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Gt3_Testimonial_Item
 */

$defaults = array(
    'tstm_author'          => '',
    'tstm_author_position' => '',
    'image'                => '',
    'img_width'            => '80',
    'img_height'           => '80',
    'round_imgs'           => 'yes',
    'item_el_class'        => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$text_style_html = $sign_styles = $content_style_html = '';
extract($_POST['gt3_testimonials_opts']);

$class_to_filter = $this->getExtraClass($item_el_class);
$css_class       = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

$img_id             = preg_replace('/[^\d]/', '', $image);
$featured_image     = wp_get_attachment_image_src($img_id, 'single-post-thumbnail');
$featured_image_url = strlen($featured_image[0]) > 0 ? $featured_image[0] : '';
$featured_image_src = aq_resize($featured_image_url, $img_width * 2, $img_height * 2, true, true, true);

// text_style_html start
$text_style_html .= $text_color != '' ? ' color: ' . esc_attr($text_color) . ';' : '';
$text_style_html .= $testimonilas_text_size != '' ? ' font-size: ' . esc_attr($testimonilas_text_size) . 'px;' : '';
$text_style_html .= $testimonilas_text_line_height != '' ? ' line-height: ' . esc_attr($testimonilas_text_line_height) . '%;' : '';
$text_style_html .= $view_type == 'type6' && $item_background_color != '' ? ' background-color: ' . esc_attr($item_background_color) . ';' : '';
// text_style_html end

// sign_styles start
$sign_styles .= $sign_color != '' ? ' color: ' . esc_attr($sign_color) . ';' : '';
$sign_styles .= $testimonilas_author_size != '' ? ' font-size: ' . esc_attr($testimonilas_author_size) . 'px;' : '';
$sign_styles .= $testimonilas_author_line_height != '' ? ' line-height: ' . esc_attr($testimonilas_author_line_height) . '%;' : '';
// sign_styles end

$content_style_html .= ($view_type == 'type1' || $view_type == 'type2' || $view_type == 'type3' || $view_type == 'type4') && $item_background_color != '' ? ' background-color: ' . esc_attr($item_background_color) . ';' : '';

$star_rate = '';
if (!empty($select_rate) && $select_rate != "none") {
    $star_rate = '<p class="testimonials-rate-wrap">';
    for ($i = 1; $i <= $select_rate; $i++) {
        $star_rate .= '<i class="fa fa-star"></i>';
    }
    for ($i; $i <= 5; $i++) {
        $star_rate .= '<i class="fa fa-star grey"></i>';
    }
    $star_rate .= '</p>';
}
$round_imgs = $round_imgs ? 'testimonials_round_img' : '';

// Title start
$title = '<div class="testimonials_title"  style="' . esc_attr($sign_styles) . '">' . esc_html($tstm_author);
if (!empty($tstm_author_position)) {
    $title .= '<div class="testimonials_author_position">' . esc_html($tstm_author_position) . '</div>';
}
$title .= '</div>';
// Title end

// Photo start
if (!empty($featured_image_url)) {
    $photo = '<div class="testimonials_photo"><img class="' . esc_attr($round_imgs) . '" src="' . esc_url($featured_image_src) . '" alt="'.esc_html($tstm_author).'" style="width:' . (int)$img_width . 'px; height:' . (int)$img_height . 'px;" /></div>';
} else {
    $photo = '';
}
// Photo end

echo '<div class="testimonials_item">
            <div class="testimonial_item_wrapper">
                <div class="testimonials_content" style="' . esc_attr($content_style_html) . '">';
switch ($view_type) {
    case 'type1':
    case 'type2':
    case 'type3':
    case 'type6':
        echo '<div class="testimonials-text" style="' . esc_attr($text_style_html) . '">' . wp_kses_post($content) . wp_kses_post($star_rate) . '</div>';
        echo wp_kses_post($photo);
        echo wp_kses_post($title);
        break;

    case 'type4':
        echo '<div class="testimonials-text" style="' . esc_attr($text_style_html) . '">' . wp_kses_post($content) . wp_kses_post($star_rate) . '</div>';
        echo wp_kses_post($title);
        echo wp_kses_post($photo);
        break;

    case 'type5':
        echo wp_kses_post($photo);
        echo wp_kses_post($title);
        echo '<div class="testimonials-text" style="' . esc_attr($text_style_html) . '">' . wp_kses_post($content) . wp_kses_post($star_rate) . '</div>';
        break;

    case 'type7':
        echo '<div class="testimonials-text" style="' . esc_attr($text_style_html) . '">' . wp_kses_post($content) . wp_kses_post($star_rate) . '</div>';
        echo wp_kses_post($photo);
        echo wp_kses_post($title);
        break;

    default:
        echo '<div class="testimonials-text" style="' . esc_attr($text_style_html) . '">' . wp_kses_post($content) . wp_kses_post($star_rate) . '</div>';
        echo wp_kses_post($photo);
        echo wp_kses_post($title);
        break;
}

echo '		</div>
            </div>
        </div>';

