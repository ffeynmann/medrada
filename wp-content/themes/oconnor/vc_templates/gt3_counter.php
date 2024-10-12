<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $icon_type
 * @var $icon_fontawesome
 * @var $image
 * @var $img_width
 * @var $image_proportions
 * @var $icon_position
 * @var $icon_size
 * @var $icon_color
 * @var $counter_title
 * @var $title_color
 * @var $counter_title_size
 * @var $counter_title_line_height
 * @var $counter_description
 * @var $description_color
 * @var $counter_description_size
 * @var $counter_description_line_height
 * @var $align
 * @var $counter_value
 * @var $value_position
 * @var $counter_prefix
 * @var $counter_suffix
 * @var $counter_value_color
 * @var $counter_value_size
 * @var $line_height
 * @var $css_animation
 * @var $item_el_class
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Gt3_Counter
 */

include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$defaults = array(
    'icon_type'                       => 'font',
    'icon_fontawesome'                => 'fa fa-adjust',
    'image'                           => '',
    'img_width'                       => '60',
    'image_proportions'               => 'original',
    'icon_position'                   => 'left',
    'icon_size'                       => 'normal',
    'icon_color'                      => '#27323d',
    'counter_title'                   => '',
    'title_color'                     => '#272b2e',
    'counter_title_size'              => '16',
    'counter_title_line_height'       => '140',
    'counter_description'             => '',
    'description_color'               => '#272b2e',
    'counter_description_size'        => '16',
    'counter_description_line_height' => '140',
    'align'                           => 'center',
    'counter_value'                   => '2001',
    'value_position'                  => 'left',
    'counter_prefix'                  => '',
    'counter_suffix'                  => '',
    'counter_value_color'             => '#27323d',
    'counter_value_size'              => '48',
    'line_height'                     => '90',
    'css_animation'                   => '',
    'item_el_class'                   => '',
    'counter_thousands_separator'     => 'yes',
    'counter_thousands_separator_text' => ',',
    'counter_decimal'                 => '0',

);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

wp_enqueue_script('gt3_waypoint_js', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array(), false, false);

$class_to_filter = $this->getExtraClass($item_el_class);
$css_class       = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

// Render Google Fonts
$obj = new GoogleFontsRender();
extract($obj->getAttributes($atts, $this, $this->shortcode, array('google_fonts_counter_title', 'google_fonts_counter_value', 'google_fonts_counter_description')));

$counter_value_css       = !empty($styles_google_fonts_counter_value) ? esc_attr($styles_google_fonts_counter_value) : '';
$counter_title_css       = !empty($styles_google_fonts_counter_title) ? esc_attr($styles_google_fonts_counter_title) : '';
$counter_description_css = !empty($styles_google_fonts_counter_description) ? esc_attr($styles_google_fonts_counter_description) : '';

if ($icon_type == 'font') {
    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue('fontawesome');
} else {
    $img_id             = preg_replace('/[^\d]/', '', $image);
    $featured_image     = wp_get_attachment_image_src($img_id, 'single-post-thumbnail');
    $featured_image_url = strlen($featured_image[0]) > 0 ? $featured_image[0] : '';
}

// Icon block
$imageblock_content = '';
if ($icon_type == 'image') {
    if (strlen($featured_image_url))
        $img_height = '';
    if ($img_width != '') {
        $img_height         = $image_proportions == 'original' ? '' : esc_attr($img_width) * 2;
        $imageblock_content .= '<div class="icon_container icon_proportions_' . esc_attr($image_proportions) . '"><img src="' . aq_resize($featured_image_url, $img_width * 2, $img_height, true, true, true) . '" alt="' . strlen($counter_title) ? esc_attr($counter_title) : '' . '" style="width:' . esc_attr($img_width) . 'px;" /></div>';
    } else {
        $imageblock_content .= '<div class="icon_container"><img src="' . esc_url($featured_image_url) . '" alt="' . strlen($counter_title) ? esc_attr($counter_title) : '' . '" /></div>';
    }
} else if ($icon_type == 'font') {
    $imageblock_content .= '<div class="icon_container"><span class="gt3_counter_icon counter_icon_size_' . (int)$icon_size . ' ' . esc_attr($icon_fontawesome) . '" style="color:' . esc_attr($icon_color) . '"></span></div>';
}

// Counter Value
$counter_value_css .= $counter_value_color != '' ? ' color: ' . esc_attr($counter_value_color) . '; ' : '';
$counter_value_css .= $counter_value_size != '' ? ' font-size: ' . (int)$counter_value_size . 'px;' : '';
$counter_value_css .= $line_height != '' ? ' line-height: ' . (int)$line_height . '%; ' : '';

// Counter Title
$counter_title_css .= $title_color != '' ? ' color: ' . esc_attr($title_color) . '; ' : '';
$counter_title_css .= $counter_title_size != '' ? ' font-size: ' . (int)$counter_title_size . 'px;' : '';
$counter_title_css .= $counter_title_line_height != '' ? ' line-height: ' . (int)$counter_title_line_height . '%;' : '';

// Counter Description
$counter_description_css .= $counter_description_size != '' ? ' font-size: ' . (int)$counter_description_size . 'px;' : '';
$counter_description_css .= $counter_description_line_height != '' ? ' line-height: ' . (int)$counter_description_line_height . '%;' : '';

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';

// ----- OUTPUT start -----
echo '<div class="gt3_module_counter ' . $animation_class . ' ' . (strlen($icon_position) ? 'icon-position-' . esc_attr($icon_position) . ' ' : '') . 'counter_icon_type_' . esc_attr($icon_type) . ' ' . esc_attr($css_class) . '">';

if ($icon_position !== 'bottom') {
    echo '' . $imageblock_content;
}

echo '<div class="stat_count_wrapper">';
if ($counter_value !== '') {
    echo '<div class="stat_count ' . esc_attr($animation_class) . ' ' . (strlen($value_position) ? 'value-position-' . esc_attr($value_position) . ' ' : '') . '" data-suffix="' . esc_attr($counter_suffix) . '" data-prefix="' . esc_attr($counter_prefix) . '" data-value="' . esc_attr($counter_value) . '" data-thousands_separator="'.esc_attr($counter_thousands_separator).'" data-thousands_separator_text="'.esc_attr($counter_thousands_separator_text).'" data-counter_decimal="'.(int)$counter_decimal.'" style="' . esc_attr($counter_value_css) . '">' . wp_kses_post($counter_prefix) . wp_kses_post($counter_value) . wp_kses_post($counter_suffix) . '</div>';
}
if ($counter_title !== '') {
    echo '<div class="text_count_wrapper ' . esc_attr($animation_class) . (!empty($align) ? ' text-align-' . esc_attr($align) : '') . '">';
    echo '<div class="count_info" style="' . esc_attr($counter_title_css) . '">' . wp_kses_post($counter_title) . '</div>';
}

if ($counter_description !== '') {
    echo '<div class="count_description" style="' . esc_attr($counter_description_css) . '">' . wp_kses_post($counter_description) . '</div>';
}

if ($counter_title !== '') {
    echo '</div>';
}
echo '<div class="stat_temp"></div>';

if ($icon_position == 'bottom') {
    echo '' . $imageblock_content;
}
echo '<div class="clear"></div></div>';
echo '</div>';
// ----- OUTPUT end -----
