<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $button_title
 * @var $link
 * @var $button_size
 * @var $button_alignment
 * @var $css_animation
 * @var $item_el_class
 * @var $btn_bg_color
 * @var $btn_text_color
 * @var $css
 * @var $btn_border_style
 * @var $btn_border_width
 * @var $btn_border_radius
 * @var $btn_border_color
 * @var $btn_font_size
 * @var $btn_letter_spacing
 * @var $btn_icon_type
 * @var $btn_icon_fontawesome
 * @var $btn_image
 * @var $btn_img_width
 * @var $icon_font_size
 * @var $btn_icon_color
 * @var $btn_icon_position
 * @var $btn_bg_color_hover
 * @var $btn_text_color_hover
 * @var $btn_border_color_hover
 * @var $btn_icon_color_hover
 * @var $use_theme_button
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Gt3_Button
 */

include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';
$theme_color2 = gt3_option("theme-custom-color2");

$defaults = array(
    'button_title'           => 'Text on the button',
    'link'                   => '',
    'button_size'            => 'normal',
    'button_alignment'       => 'inline',
    'css_animation'          => '',
    'item_el_class'          => '',
    'btn_bg_color'           => $theme_color2,
    'btn_text_color'         => '#ffffff',
    'css'                    => '',
    'btn_border_style'       => 'solid',
    'btn_border_width'       => '1px',
    'btn_border_radius'      => 'none',
    'btn_border_color'       => $theme_color2,
    'btn_font_size'          => '',
    'btn_icon_type'          => 'none',
    'btn_icon_fontawesome'   => 'fa fa-adjust',
    'btn_image'              => '',
    'btn_img_width'          => '',
    'icon_font_size'         => '',
    'btn_letter_spacing'     => '0',
    'btn_icon_color'         => '#ffffff',
    'btn_icon_position'      => 'left',
    'btn_bg_color_hover'     => '#ffffff',
    'btn_text_color_hover'   => $theme_color2,
    'btn_border_color_hover' => '#e8e8e8',
    'btn_icon_color_hover'   => '#ffffff',
    'use_theme_button'       => 'yes'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$class_to_filter = vc_shortcode_custom_css_class($css, ' ');
$css_class       = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

// Render Google Fonts
$obj    = new GoogleFontsRender();
$shortc = $this->shortcode;
extract($obj->getAttributes($atts, $this, $shortc, array('google_fonts_button')));

$button_value_font = !empty($styles_google_fonts_button) ? esc_attr($styles_google_fonts_button) : '';

$btn_custom_class = $btn_border_width_style = $btn_border_style_style = $btn_border_radius_style = $btn_icon_color_style = $btn_icon_position_class = '';

// Button border
if ($btn_border_radius != 'none') {
    $btn_border_radius_style = 'border-radius: ' . $btn_border_radius . '; ';
}
if ($btn_border_style != 'none') {
    $btn_border_style_style = 'border-style: ' . $btn_border_style . '; ';
    $btn_border_width_style = 'border-width: ' . $btn_border_width . '; ';
} else {
    $btn_border_width_style = 'border: none; ';
}

// Button font-size
if ($btn_font_size != '') {
    $btn_font_size       = (int)$btn_font_size;
    $btn_font_line       = $btn_font_size + 8;
    $btn_font_size_style = 'font-size: ' . $btn_font_size . 'px; line-height: ' . $btn_font_line . 'px; ';
} else {
    $btn_font_size_style = '';
}
$btn_font_size_style .= !empty($btn_letter_spacing) ? 'letter-spacing: ' . (float)$btn_letter_spacing . 'em; ' : '';

// Button styles
$btn_style = $btn_border_width_style . $btn_border_style_style . $btn_border_radius_style . $btn_font_size_style . $button_value_font;

// Link Settings
$link_temp = vc_build_link($link);
$btn_utt   = !empty($link_temp['url']) ? ' href="' . esc_url($link_temp['url']) . '"' : ' href="#"';
$btn_utt   .= !empty($link_temp['title']) ? ' title="' . esc_attr($link_temp['title']) . '"' : '';
$btn_utt   .= !empty($link_temp['target']) ? ' target="' . trim(esc_attr($link_temp['target'])) . '"' : '';

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';

// Button Icon
if ($btn_icon_type == 'font') {
    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue('fontawesome');
} else {
    $img_id             = preg_replace('/[^\d]/', '', $btn_image);
    $featured_image     = wp_get_attachment_image_src($img_id, 'single-post-thumbnail');
    $featured_image_url = strlen($featured_image[0]) > 0 ? $featured_image[0] : '';
}

// Button Icon Style
if ($use_theme_button !== 'yes') {
    $btn_icon_color_style = $btn_icon_color != '' ? 'color: ' . $btn_icon_color . '; ' : '';
}

if ($icon_font_size != '') {
    $icon_font_size = (int)$icon_font_size;
    $icon_font_line = $icon_font_size + 2;
    $icon_font_css  = 'font-size: ' . (int)$icon_font_size . 'px; line-height: ' . (int)$icon_font_line . 'px; ';
} else {
    $icon_font_css = '';
}
$btn_icon_style = $btn_icon_color_style . $icon_font_css;

// Icon block
$btn_icon_content = '';
if ($btn_icon_type == 'image') {
    if (strlen($featured_image_url))
        if ($btn_img_width != '') {
            $btn_icon_content .= '<div class="btn_icon_container"><img src="' . aq_resize($featured_image_url, $btn_img_width * 2, '', true, true, true) . '" alt="' . strlen($button_title) ? esc_attr($button_title) : '' . '" style="width:' . esc_attr($btn_img_width) . 'px;" /></div>';
        } else {
            $btn_icon_content .= '<div class="btn_icon_container"><img src="' . esc_url($featured_image_url) . '" alt="' . strlen($button_title) ? esc_attr($button_title) : '' . '" /></div>';
        }
} else if ($btn_icon_type == 'font') {
    // Button Icon Default
    $btn_icon_default_attr = '';
    if ($use_theme_button !== 'yes') {
        if ($btn_icon_color != '') {
            $btn_icon_default_attr = 'data-default-icon=' . esc_attr($btn_icon_color) . ' ';
        } else {
            $btn_icon_default_attr = '';
        }
    }

    // Button Icon Hover
    $btn_icon_hover_attr = $btn_icon_color_hover != '' ? 'data-hover-icon=' . esc_attr($btn_icon_color_hover) . ' ' : '';

    // Button Icon Attributes
    $btn_icon_attr    = $btn_icon_default_attr . $btn_icon_hover_attr;
    $btn_icon_content .= '<div class="btn_icon_container"><span class="gt3_btn_icon ' . esc_attr($btn_icon_fontawesome) . '" ' . (strlen($btn_icon_style) ? 'style="' . esc_attr($btn_icon_style) . '"' : '') . ' ' . $btn_icon_attr . '></span></div>';
}

// Button Value
$btn_text  = strlen($button_title) ? '<span class="gt3_btn_text">' . esc_attr($button_title) . '</span>' : '';
$btn_value = $btn_text;
if ($btn_icon_type == 'image' || $btn_icon_type == 'font') {
    $btn_value = $btn_icon_position == 'left' ? $btn_icon_content . $btn_text : $btn_text . $btn_icon_content;

    if ($btn_text != '') {
        $btn_icon_position_class = ' btn_icon_position_' . $btn_icon_position . '';
    }
}

// Button Attributes
$btn_bg_default_attr = $btn_color_default_attr = $btn_border_default_attr = $btn_bg_hover_attr = $btn_color_hover_attr = $btn_border_hover_attr = '';
if ($use_theme_button !== 'yes') {
    // Button Default
    if ($btn_bg_color != '') {
        $btn_bg_default_attr = 'data-default-bg=' . esc_attr($btn_bg_color) . ' ';
        $btn_style           .= 'background-color: ' . esc_attr($btn_bg_color) . '; ';
    } else {
        $btn_bg_default_attr = 'data-default-bg=transparent ';
        $btn_style           .= 'background-color: transparent; ';
    }
    if ($btn_text_color != '') {
        $btn_color_default_attr = 'data-default-color=' . esc_attr($btn_text_color) . ' ';
        $btn_style              .= 'color: ' . esc_attr($btn_text_color) . '; ';
    } else {
        $btn_color_default_attr = '';
    }
    if ($btn_border_color != '') {
        $btn_border_default_attr = 'data-default-border=' . esc_attr($btn_border_color) . ' ';
        $btn_border_color_style  = 'border-color: ' . $btn_border_color . '; ';
    } else {
        $btn_border_default_attr = 'data-default-border=transparent ';
        $btn_border_color_style  = 'border-color: transparent; ';
    }
    // Button Hover
    if ($btn_bg_color_hover != '') {
        $btn_bg_hover_attr = 'data-hover-bg=' . esc_attr($btn_bg_color_hover) . ' ';
    } else {
        $btn_bg_hover_attr = 'data-hover-bg=transparent ';
    }
    if ($btn_text_color_hover != '') {
        $btn_color_hover_attr = 'data-hover-color=' . esc_attr($btn_text_color_hover) . ' ';
    } else {
        $btn_color_hover_attr = '';
    }
    if ($btn_border_color_hover != '') {
        $btn_border_hover_attr = 'data-hover-border=' . esc_attr($btn_border_color_hover) . ' ';
    } else {
        $btn_border_hover_attr = 'data-hover-border=transparent ';
    }

    $btn_custom_class .= ' gt3_btn_customize';
}
$btn_attr = $btn_bg_default_attr . $btn_color_default_attr . $btn_border_default_attr . $btn_bg_hover_attr . $btn_color_hover_attr . $btn_border_hover_attr;


echo '<div class="gt3_module_button' . esc_attr($btn_custom_class) . ' button_alignment_' . esc_attr($button_alignment) . ' ' . esc_attr($animation_class) . ' ' . esc_attr($item_el_class) . '">';

echo '<a class="button_size_' . esc_attr($button_size) . esc_attr($btn_icon_position_class) . ' ' . esc_attr($css_class) . '" ' . wp_kses_post($btn_utt) . ' style="' . esc_attr($btn_style) . '" ' . esc_attr($btn_attr) . '>' . $btn_value . '</a>';

echo '</div>';
