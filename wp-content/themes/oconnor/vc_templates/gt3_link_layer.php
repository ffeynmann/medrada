<?php
if (!defined('ABSPATH')) {
    die('-1');
}

$theme_color2 = gt3_option("theme-custom-color2");

/**
 * Shortcode attributes
 * @var $link
 * @var $height
 * @var $flex_position
 * @var $css_animation
 * @var $el_class
 * @var $css
 * @var $link_custom_style
 * @var $link_bg_color
 * @var $link_bg_color_hover
 * @var $link_border_color
 * @var $link_border_color_hover
 * @var $custom_animation
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Gt3_link_layer
 */
$defaults = array(
    'link'                    => '',
    'height'                  => '180',
    'flex_position'           => 'middle',
    'css_animation'           => '',
    'el_class'                => '',
    'css'                     => '',
    'link_custom_style'       => '',
    'link_bg_color'           => esc_attr($theme_color2),
    'link_bg_color_hover'     => '',
    'link_border_color'       => esc_attr($theme_color2),
    'link_border_color_hover' => '#e8e8e8',
    'custom_animation'        => 'no',
);
$atts     = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

// Parse link
$link     = ('||' === $link) ? '' : $link;
$link     = vc_build_link($link);

$a_uttr   = !empty($link['url']) ? ' href="' . esc_url($link['url']) . '"' : ' href="#"';
$a_uttr   .= !empty($link['title']) ? ' title="' . esc_attr($link['title']) . '"' : '';
$a_uttr   .= !empty($link['target']) ? ' target="' . esc_attr($link['target']) . '"' : '';
$a_uttr   .= !empty($link['rel']) ? ' rel="' . esc_attr(trim($link['rel'])) . '"' : '';

$link_style           = $link_custom_class = '';
$link_bg_default_attr = $link_color_default_attr = $link_border_default_attr = $link_bg_hover_attr = $link_color_hover_attr = $link_border_hover_attr = '';
if ($link_custom_style === 'yes') {
    // Link Default
    if ($link_bg_color != '') {
        $link_bg_default_attr = 'data-default-bg=' . esc_attr($link_bg_color) . ' ';
        $link_style           .= 'background-color: ' . esc_attr($link_bg_color) . '; ';
    } else {
        $link_bg_default_attr = 'data-default-bg=transparent ';
        $link_style           .= 'background-color: transparent; ';
    }
    if ($link_border_color != '') {
        $link_border_default_attr = 'data-default-border=' . esc_attr($link_border_color) . ' ';
        $link_style               .= 'border-color: ' . $link_border_color . '; ';
    } else {
        $link_border_default_attr = 'data-default-border=transparent ';
        $link_style               .= 'border-color: transparent; ';
    }
    // Link Hover
    if ($link_bg_color_hover != '') {
        $link_bg_hover_attr = 'data-hover-bg=' . esc_attr($link_bg_color_hover) . ' ';
    } else {
        $link_bg_hover_attr = 'data-hover-bg=transparent ';
    }
    if ($link_border_color_hover != '') {
        $link_border_hover_attr = 'data-hover-border=' . esc_attr($link_border_color_hover) . ' ';
    } else {
        $link_border_hover_attr = 'data-hover-border=transparent ';
    }

    $class_to_filter = 'gt3_hover_customize';
}
$link_attr = $link_bg_default_attr . $link_border_default_attr . $link_bg_hover_attr . $link_border_hover_attr;

// Height
$link_style .= !empty($height) ? 'height:'.esc_attr($height).'px;' : '';

// Flex
if (!empty($flex_position) && !empty($height)){
    switch ($flex_position){
        case 'top':
            $link_style .= '-webkit-justify-content: flex-start; justify-content: flex-start;';
            break;
        case 'bottom':
            $link_style .= '-webkit-justify-content: flex-end; justify-content: flex-end;';
            break;
        default:
            break;
    }
}

// Link Class
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$el_class        = $this->getExtraClass($el_class);
$css_class       = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter . $el_class, $this->settings['base'], $atts);

// Animation
$css_class .= !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';
$css_class .= $custom_animation === 'yes' ? ' custom_animation' : '';

?>

<div class="gt3_link_layer">
    <div class="gt3_link_layer__wrapper <?php echo esc_attr(trim($css_class)); ?>"
         style="<?php echo esc_attr($link_style) ?>" <?php echo wp_kses_post($link_attr); ?> >
        <?php if (!empty($link)) { ?>
            <a class="gt3_link_layer__link" <?php echo wp_kses_post($a_uttr); ?> ></a>
        <?php } ?>
        <?php if (!empty($content)) echo do_shortcode($content); ?>
    </div>
</div>
