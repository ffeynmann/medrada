<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $icon_type
 * @var $icon_fontawesome
 * @var $number
 * @var $thumbnail
 * @var $icon_box_horizontal_position
 * @var $icon_position
 * @var $icon_below
 * @var $icon_vertical_position
 * @var $element_gap
 * @var $heading
 * @var $text
 * @var $url
 * @var $url_text
 * @var $new_tab
 * @var $icon_size
 * @var $custom_icon_size
 * @var $icon_color
 * @var $icon_circle
 * @var $circle_bg
 * @var $title_tag
 * @var $title_color
 * @var $iconbox_button_align
 * @var $link_color
 * @var $link_hover_color
 * @var $iconbox_title_size
 * @var $title_line_height
 * @var $responsive_title_font
 * @var $title_font_size_sm_desktop
 * @var $title_font_size_tablet
 * @var $title_font_size_mobile
 * @var $title_align_position
 * @var $iconbox_content_size
 * @var $content_line_height
 * @var $responsive_content_font
 * @var $content_font_size_sm_desktop
 * @var $content_font_size_tablet
 * @var $content_font_size_mobile
 * @var $content_align_position
 * @var $text_color
 * @var $divider_color
 * @var $animation_class
 * @var $add_divider
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Gt3_icon_box
 */
$main_font = gt3_option('main-font');
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$defaults = array(
    'icon_type'                    => 'none',
    'icon_fontawesome'             => 'fa fa-adjust',
    'number'                       => '',
    'thumbnail'                    => '',
    'icon_box_horizontal_position' => 'default',
    'icon_position'                => 'top',
//    'icon_below'                   => '',
    'icon_vertical_position'       => 'default',
    'element_gap'                  => '',
    'heading'                      => '',
    'text'                         => '',
    'url'                          => '',
    'url_text'                     => '',
    'new_tab'                      => '',
    'icon_size'                    => 'regular',
    'custom_icon_size'             => '18',
    'icon_color'                   => '',
    'icon_circle'                  => '',
    'circle_bg'                    => '#e9e9e9',
    'title_tag'                    => 'h2',
    'title_color'                  => '',
    'iconbox_button_align'         => 'default',
    'link_color'                   => '',
    'link_hover_color'             => '',
    'iconbox_title_size'           => '28',
    'title_line_height'            => '165',
    'responsive_title_font'        => 'no',
    'title_font_size_sm_desktop'   => '',
    'title_font_size_tablet'       => '',
    'title_font_size_mobile'       => '',
    'title_align_position'         => 'left',
    'iconbox_content_size'         => '14',
    'content_line_height'          => '165',
    'responsive_content_font'      => 'no',
    'content_font_size_sm_desktop' => '',
    'content_font_size_tablet'     => '',
    'content_font_size_mobile'     => '',
    'content_align_position'       => 'left',
    'text_color'                   => '',
    'divider_color'                => '',
    'animation_class'              => '',
    'add_divider'                  => '',
);
$atts     = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
/** @var $icon_type string */
$blank = $new_tab == 'yes' ? ' target="_blank"' : '';

$icon = '';
if ($icon_type == 'font' && !empty($icon_fontawesome)) {
    wp_enqueue_style("font-awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
    $icon_style_icon = '';
    $icon_style_icon .= $icon_size == 'custom' ? 'font-size:' . esc_attr($custom_icon_size) . 'px;' : '';
    if ($icon_position == 'left') {
        $icon_style_icon .= ' margin-right: ' . (int)$element_gap . 'px;';
    } elseif ($icon_position == 'right') {
        $icon_style_icon .= ' margin-left: ' . (int)$element_gap . 'px;';
    }

    $icon = '<i class="gt3_icon_box__icon ' . esc_attr($icon_fontawesome) . '" style="color:' . esc_attr($icon_color) . ';' . esc_attr($icon_style_icon) . '">' . ($icon_circle == 'yes' ? '<span class="gt3_icon_box__icon-bg" style="background-color:' . esc_attr($circle_bg) . ';border-color:' . esc_attr($circle_bg) . '"></span>' : '') . '</i>';
} else if ($icon_type == 'image' && !empty($thumbnail)) {
    $icon_style = 'style="';
    if ($icon_position == 'left') {
        $icon_style .= ' margin-right: ' . (int)$element_gap . 'px;';
    } elseif ($icon_position == 'right') {
        $icon_style .= ' margin-left: ' . (int)$element_gap . 'px;';
    }
    $icon_style .= $icon_size == 'custom' ? 'width:' . (int)$custom_icon_size . 'px;min-width:' . (int)$custom_icon_size . 'px;' : '';
    $icon_style .= '"';
    $thumbnail  = !empty($thumbnail) ? wp_get_attachment_image($thumbnail, 'full') : '';
    $icon       = '<i class="gt3_icon_box__icon" ' . $icon_style . '>' . ($icon_circle == 'yes' ? '<span class="gt3_icon_box__icon-bg" style="background-color:' . esc_attr($circle_bg) . ';border-color:' . esc_attr($circle_bg) . '"></span>' : '') . $thumbnail . '</i>';
    $icon       = '<i class="gt3_icon_box__icon" ' . $icon_style . '>' . ($icon_circle == 'yes' ? '<span class="gt3_icon_box__icon-bg" style="background-color:' . esc_attr($circle_bg) . ';border-color:' . esc_attr($circle_bg) . '"></span>' : '') . $thumbnail . '</i>';
} else if ($icon_type == 'number') {
    $icon_position = 'left';
    $icon_style    = $icon_size == 'custom' ? 'font-size:' . esc_attr($custom_icon_size) . 'px' : '';
    $icon          = '<i class="gt3_icon_box__icon gt3_icon_box__icon--' . (esc_attr($icon_type)) . '" style="color:' . esc_attr($icon_color) . ';' . esc_attr($icon_style) . '">' . esc_attr($number) . '</i>';
}

// Render Google Fonts
$obj = new GoogleFontsRender();
extract($obj->getAttributes($atts, $this, $this->shortcode, array('google_fonts_iconbox_title', 'google_fonts_iconbox_content')));

$iconbox_title_font   = !empty($styles_google_fonts_iconbox_title) ? esc_attr($styles_google_fonts_iconbox_title) : '';
$iconbox_content_font = !empty($styles_google_fonts_iconbox_content) ? esc_attr($styles_google_fonts_iconbox_content) : '';

// Font Size of Title
$iconbox_title_css = '';
$iconbox_title_css .= $iconbox_title_size != '' ? 'font-size: ' . (int)$iconbox_title_size . 'px;' : esc_attr($main_font['font-size']);
$iconbox_title_css .= $title_line_height != '' ? 'line-height: ' . (int)$title_line_height . '%; ' : esc_attr($main_font['line-height']);
$iconbox_title_css .= $title_align_position != '' ? 'text-align: ' . esc_attr($title_align_position) . ';' : '';


// Font Size of Content
$iconbox_content_css = '';
$iconbox_content_css .= $iconbox_content_size != '' ? 'font-size: ' . (int)$iconbox_content_size . 'px;' : esc_attr($main_font['font-size']);
$iconbox_content_css .= $content_line_height != '' ? 'line-height: ' . (int)$content_line_height . '%;' : esc_attr($main_font['line-height']);
$iconbox_content_css .= $content_align_position != '' ? 'text-align: ' . esc_attr($content_align_position) . ';' : '';

// Icon Box button alignment
$iconbox_button_css = $iconbox_button_align != '' && $iconbox_button_align != 'default' ? 'text-align: ' . esc_html($iconbox_button_align) . '; ' : '';

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';

if (!empty($heading)) {
    $title_style  = 'color:' . $title_color . ';';
    $title_style  .= $iconbox_title_font;
    $title_style  .= $iconbox_title_css;
    $heading_cont = '<div class="gt3_icon_box__title">' . ($icon_position == "inline_title" ? $icon : '') . '<' . esc_html($title_tag) . ' style="' . esc_attr($title_style) . '">';

    if ($responsive_title_font === 'yes') {
        $heading_cont .= !empty($title_font_size_sm_desktop) ? ' <span class="gt3_custom_text-font_size_sm_desktop" style="' . esc_attr($title_style) . 'font-size:' . (int)$title_font_size_sm_desktop . 'px;">' : '';
        $heading_cont .= !empty($title_font_size_tablet) ? ' <span class="gt3_custom_text-font_size_tablet" style="' . esc_attr($title_style) . 'font-size:' . (int)$title_font_size_tablet . 'px;">' : '';
        $heading_cont .= !empty($title_font_size_mobile) ? ' <span class="gt3_custom_text-font_size_mobile" style="' . esc_attr($title_style) . 'font-size:' . (int)$title_font_size_mobile . 'px;">' : '';
    }

    $heading_cont .= !empty($url) ? '<a href="' . esc_url($url) . '"' . $blank . '>' : '';
    $heading_cont .= wp_kses_post($heading);
    $heading_cont .= !empty($url) ? '</a>' : '';

    if ($responsive_title_font === 'yes') {
        $heading_cont .= !empty($title_font_size_sm_desktop) ? '</span>' : '';
        $heading_cont .= !empty($title_font_size_tablet) ? '</span>' : '';
        $heading_cont .= !empty($title_font_size_mobile) ? '</span>' : '';
    }

    $heading_cont .= '</' . esc_html($title_tag) . '></div>';

} else {
    $heading_cont = '';
}

if (!empty($text) || !empty($heading_cont) || !empty($url_text)) {
    $content = '<div class="gt3_icon_box-content-wrapper">';
    $content .= $heading_cont;
    $content .= $add_divider == 'yes' ? '<div class="gt3_icon_box-divider" ' . (!empty($divider_color) ? 'style="border-bottom-color:' . esc_attr($divider_color) . '"' : '') . ' ></div>' : '';


    if (!empty($text)) {
        $content_style  = 'color:' . $text_color . ';';
        $content_style  .= $iconbox_content_font;
        $content_style  .= $iconbox_content_css;

        $content .= '<div class="gt3_icon_box__text" style="' . esc_attr($content_style) .'">';

        if ($responsive_content_font === 'yes') {
            $content .= !empty($content_font_size_sm_desktop) ? ' <span class="gt3_custom_text-font_size_sm_desktop" style="' . esc_attr($content_style) .'font-size:' . (int)$content_font_size_sm_desktop . 'px;">' : '';
            $content .= !empty($content_font_size_tablet) ? ' <span class="gt3_custom_text-font_size_tablet" style="' . esc_attr($content_style) .'font-size:' . (int)$content_font_size_tablet . 'px;">' : '';
            $content .= !empty($content_font_size_mobile) ? ' <span class="gt3_custom_text-font_size_mobile" style="' . esc_attr($content_style) .'font-size:' . (int)$content_font_size_mobile . 'px;">' : '';
        }

        $content .= $text;

        if ($responsive_content_font === 'yes') {
            $content .= !empty($content_font_size_sm_desktop) ? '</span>' : '';
            $content .= !empty($content_font_size_tablet) ? '</span>' : '';
            $content .= !empty($content_font_size_mobile) ? '</span>' : '';
        }

        $content .= '</div>';
    }

    $content .= !empty($url_text) ? '<div class="gt3_icon_box__link" style="color:' . (!empty($link_hover_color) ? esc_attr($link_hover_color) : esc_attr($title_color)) . ';' . esc_attr($iconbox_content_font) . $iconbox_button_css . '">' . (!empty($url) ? '<a class="learn_more" href="' . esc_url($url) . '" style="color:' . esc_attr($link_color) . ';' . esc_attr($iconbox_content_css) . '" ' . $blank . '>' . esc_html($url_text) . '</a>' : '') . '</div>' : '';

    $content .= '</div>';
} else {
    $content = '';
}

$module_class = '';
$module_class .= $animation_class;
$module_class .= ' gt3_icon_box_icon-position_' . $icon_position;
$module_class .= ' gt3_icon_box__icon_icon_size_' . $icon_size;
$module_class .= $icon_circle == 'yes' ? ' icon-bg' : '';
//$module_class .= $icon_below == 'yes' ? ' icon_below' : '';
$module_class .= $icon_type == 'image' && !empty($thumbnail) ? ' gt3-box-image' : '';

if ($icon_box_horizontal_position != 'default' && !empty($icon_box_horizontal_position)) {
    $module_class .= ' gt3_icon_box_flex_horizontal_' . esc_attr($icon_box_horizontal_position);
}

if (($icon_position == 'left' || $icon_position == 'right') &&
    ($icon_vertical_position != 'default' && !empty($icon_vertical_position))) {
    $module_class .= ' gt3_icon_box_flex_' . esc_attr($icon_vertical_position);
}

echo '<div class="gt3_icon_box ' . esc_attr($module_class) . '">';
echo ("inline_title" !== $icon_position) ? wp_kses_post($icon) : '';
echo wp_kses_post($content);
echo '</div>';
