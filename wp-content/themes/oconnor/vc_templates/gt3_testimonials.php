<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $view_type
 * @var $use_carousel
 * @var $item_align
 * @var $auto_play_time
 * @var $posts_per_line
 * @var $pagination_position
 * @var $css_animation
 * @var $item_el_class
 * @var $item_background_color
 * @var $shadow_module
 * @var $shadow_items
 * @var $testimonilas_text_size
 * @var $testimonilas_text_line_height
 * @var $text_color
 * @var $text_align
 * @var $testimonilas_author_size
 * @var $testimonilas_author_line_height
 * @var $sign_color
 * @var $author_align
 * @var $author_align
 * @var $img_width
 * @var $img_height
 * @var $round_imgs
 * @var $css
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Gt3_Testimonials
 */
$defaults = array(
    'view_type'                       => 'type1',
    'use_carousel'                    => 'yes',
    'item_align'                      => 'center',
    'auto_play_time'                  => 4000,
    'posts_per_line'                  => '1',
    'pagination_position'             => 'center',
    'css_animation'                   => '',
    'item_el_class'                   => '',
    'item_background_color'           => '',
    'shadow_module'                   => '',
    'shadow_items'                    => '',
    'testimonilas_text_size'          => '24',
    'testimonilas_text_line_height'   => '150',
    'text_color'                      => '',
    'text_align'                      => 'center',
    'testimonilas_author_size'        => '18',
    'testimonilas_author_line_height' => '140',
    'sign_color'                      => '',
    'author_align'                    => 'center',
    'img_width'                       => '80',
    'img_height'                      => '80',
    'round_imgs'                      => 'yes',
    'css'                             => '',
);

wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$_POST['gt3_testimonials_opts'] = array(
    'text_color'                      => $text_color,
    'sign_color'                      => $sign_color,
    'view_type'                       => $view_type,
    'testimonilas_text_size'          => $testimonilas_text_size,
    'testimonilas_text_line_height'   => $testimonilas_text_line_height,
    'testimonilas_author_size'        => $testimonilas_author_size,
    'testimonilas_author_line_height' => $testimonilas_author_line_height,
    'img_width'                       => $img_width,
    'img_height'                      => $img_height,
    'round_imgs'                      => $round_imgs,
    'item_background_color'           => $item_background_color,
);

$class_to_filter = vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($item_el_class);
$css_class       = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$css_class       .= $use_carousel ? " active-carousel" : "";
$fade            = $view_type == "type4" || $view_type == "type5" || $view_type == "type7" ? true : false;
$posts_per_line  = $view_type == 'type4' ? '1' : $posts_per_line;

$css_class .= $text_align != '' ? ' text_align-' . esc_attr($text_align) : '';
$css_class .= $author_align != '' ? ' author_align-' . esc_attr($author_align) : '';
$css_class .= $view_type == 'type4' ? ' testimonials_align_' . esc_attr($item_align) : '';

// Animation
$css_class .= !empty($atts['css_animation']) ? ' ' . esc_attr($this->getCSSAnimation($atts['css_animation'])) : '';

// Shadow, Background, Pagination class
$css_class .= $shadow_module ? ' shadow_module' : '';
$css_class .= $shadow_items ? ' shadow_items' : '';
$css_class .= $pagination_position != '' ? ' pagination_position-' . $pagination_position : '';


$type4_style = $view_type == 'type4' ? 'max-width: ' . (3 * (int)$img_width + 30) . 'px;' : '';
?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_testimonial <?php echo esc_attr($css_class) . ' ' . esc_attr($view_type); ?> "
         data-slides-per-line="<?php echo (int)$posts_per_line; ?>" data-slider-fade="<?php echo esc_attr($fade); ?>"
         data-autoplay-time="<?php echo esc_attr($auto_play_time); ?>"
         data-image-width="<?php echo (int)$img_width; ?>">

        <span class="testimonials-photo-wrapper" style="<?php esc_attr($type4_style); ?>"></span>

        <div class="module_content testimonials_list items<?php echo (int)$posts_per_line; ?> ">
            <?php
            if ($use_carousel == 'yes') {
                echo '<div class="testimonials_rotator">';
            } else {
                echo '<div class="testimonials-grid columns-' . (int)$posts_per_line . '">';
            }

            echo do_shortcode($content);

            if ($use_carousel == 'yes') {
                echo '</div><div class="clear"></div>';
            } else {
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>