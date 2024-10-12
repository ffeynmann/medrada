<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 *
 * @var $hide_border
 * @var $hide_border_top
 * @var $hide_border_right
 * @var $hide_border_bottom
 * @var $hide_border_left
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $el_id = $css = $offset = $hide_border = $hide_border_top = $hide_border_right = $hide_border_bottom = $hide_border_left = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

// Hide border
if ($hide_border == 'yes'){
    $css_classes[] = !empty($hide_border_top) ? 'gt3_hide_border_top-'.esc_attr($hide_border_top) : '';
    $css_classes[] = !empty($hide_border_right) ? 'gt3_hide_border_right-'.esc_attr($hide_border_right) : '';
    $css_classes[] = !empty($hide_border_bottom) ? 'gt3_hide_border_bottom-'.esc_attr($hide_border_bottom) : '';
    $css_classes[] = !empty($hide_border_left) ? 'gt3_hide_border_left-'.esc_attr($hide_border_left) : '';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
} ?>
    <div <?php echo implode(' ', $wrapper_attributes); ?>>
        <div class="vc_column-inner <?php echo esc_attr(trim(vc_shortcode_custom_css_class($css))); ?>">
            <div class="wpb_wrapper">
                <?php echo wpb_js_remove_wpautop($content); ?>
            </div>
        </div>
    </div>
<?php
