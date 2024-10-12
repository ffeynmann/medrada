<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $line_break
 * @var $separator
 * @var $separator_inner
 * @var $margin_top
 * @var $maxwidth
 * @var $separator_color
 * @var $font_size
 * @var $text_color
 * @var $use_theme_fonts
 * @var $line_height
 * @var $responsive_font
 * @var $font_size_sm_desktop
 * @var $font_size_tablet
 * @var $font_size_mobile
 * @var $item_el_class
 * @var $full_width
 * @var $css
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Gt3_custom_text
 */

$main_font = gt3_option('main-font');
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$defaults = array(
    'line_break'           => 'default',
    'separator'            => '',
    'separator_inner'      => '',
    'margin_top'           => '22',
    'maxwidth'             => '70px',
    'separator_color'      => 'rgba(249,249,250,0.3)',
    'font_size'            => esc_attr($main_font['font-size']),
    'text_color'           => esc_attr($main_font['color']),
    'use_theme_fonts'      => '',
    'line_height'          => '165',
    'responsive_font'      => '',
    'font_size_sm_desktop' => '',
    'font_size_tablet'     => '',
    'font_size_mobile'     => '',
    'item_el_class'        => '',
    'full_width'           => 'yes',
    'css'                  => '',
);
$atts     = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$class_to_filter = vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($item_el_class);
$css_class       = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

$compile = '';

// Render Google Fonts
$obj = new GoogleFontsRender();
extract($obj->getAttributes($atts, $this, $this->shortcode, array('google_fonts_text')));
$text_font = !empty($styles_google_fonts_text) ? esc_attr($styles_google_fonts_text) : '';

// Line-break
$css_class .= ' gt3_line-break-' . esc_attr($line_break);

// Style of Text
$text_css = esc_attr($text_font);
if ($font_size != '') {
    $text_css  .= 'font-size: ' . (int)$font_size . 'px;';
    $css_class .= ' gt3_font-size-inherit';
} else {
    $font_size = esc_attr($main_font['font-size']);
}
if ($line_height != '') {
    $text_css  .= 'line-height: ' . (int)$line_height . '%; ';
    $css_class .= ' gt3_line-height-inherit';
} else {
    $line_height = esc_attr($main_font['line-height']);
}
if ($text_color != '') {
    $text_css  .= 'color: ' . esc_attr($text_color) . '; ';
    $css_class .= ' gt3_color-inherit';
}

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';

// Separator
$separator_css = '';
if ($separator == 'yes') {
    //    $separator_css = 'margin-top: '.(int)($font_size * $line_height / 100 / 2.2) . 'px; ';
    $separator_css .= !empty($margin_top) ? 'margin-top: ' . (int)$margin_top . 'px; ' : '';
    $separator_css .= !empty($maxwidth) ? 'max-width: ' . esc_attr($maxwidth) . '; ' : '';
    $separator_css .= $separator_color != '' ? 'background-color: ' . esc_attr($separator_color) . '; ' : '';
    $css_class     .= ' gt3_separator-active';
    $css_class     .= $separator_inner == 'yes' ? ' gt3_separator-inner' : ' gt3_separator-outer';
} else {
    $css_class .= ' gt3_separator-disable';
}

// Full Width
$css_class .= $full_width == 'yes' ? ' gt3_full_width-active' : ' gt3_full_width-disable';

if (!empty($content)) {
    echo '<div data-color="#ffffff" class="gt3_custom_text ' . esc_attr($css_class) . esc_attr($animation_class) . (!empty($text_font) ? ' gt3_custom_text--custom-font' : '') . '" style="' . esc_attr($text_css) . '">';
    if ($responsive_font == 'yes') {
        echo !empty($font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:' . (int)$font_size_sm_desktop . 'px;line-height: ' . (int)$line_height . '%;">' : '';
        echo !empty($font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:' . (int)$font_size_tablet . 'px;line-height: ' . (int)$line_height . '%;">' : '';
        echo !empty($font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:' . (int)$font_size_mobile . 'px;line-height: ' . (int)$line_height . '%;">' : '';
    }
    if ($separator == 'yes') {
        echo '<div class="gt3_custom_text_separator" style="' . esc_attr($separator_css) . '"></div>';
    }
    echo wpb_js_remove_wpautop($content, true);
    //        echo do_shortcode($content);
    if ($responsive_font == 'yes') {
        echo !empty($font_size_sm_desktop) ? ' </div>' : '';
        echo !empty($font_size_tablet) ? ' </div>' : '';
        echo !empty($font_size_mobile) ? ' </div>' : '';
    }
    echo '</div>';
}

