<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $height
 * @var $responsive_es
 * @var $height_size_sm_desktop
 * @var $height_tablet
 * @var $height_mobile
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Gt3_spacing
 */

$defaults = array(
    'height'                 => '',
    'responsive_es'          => '',
    'height_size_sm_desktop' => '',
    'height_tablet'          => '',
    'height_mobile'          => '',

);
$atts     = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$classes = '';
if ($responsive_es == 'yes') {
    $classes .= !empty($height_size_sm_desktop) || $height_size_sm_desktop == '0' ? ' gt3_spacing-height_size_sm_desktop-on' : '';
    $classes .= !empty($height_tablet) || $height_tablet == '0' ? ' gt3_spacing-height_tablet-on' : '';
    $classes .= !empty($height_mobile) || $height_mobile == '0' ? ' gt3_spacing-height_mobile-on' : '';
}

if (!empty($height) || $height == '0') { ?>
    <div class="gt3_spacing <?php echo esc_attr($classes); ?>">
        <div class="gt3_spacing-height gt3_spacing-height_default" style="height: <?php echo (int)$height; ?>px;"></div>
        <?php
        if ($responsive_es == 'yes') {
            echo !empty($height_size_sm_desktop) || $height_size_sm_desktop == '0' ? ' <div class="gt3_spacing-height gt3_spacing-height_size_sm_desktop" style="height:' . (int)$height_size_sm_desktop . 'px;"></div>' : '';
            echo !empty($height_tablet) || $height_tablet == '0' ? ' <div class="gt3_spacing-height gt3_spacing-height_tablet" style="height:' . (int)$height_tablet . 'px;"></div>' : '';
            echo !empty($height_mobile) || $height_mobile == '0' ? ' <div class="gt3_spacing-height gt3_spacing-height_mobile" style="height:' . (int)$height_mobile . 'px;"></div>' : '';
        } ?>
    </div>
    <?php
}
