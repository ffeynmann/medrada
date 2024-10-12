<?php

$defaults = array(
    'posts_per_line' => '1',
    'item_el_class' => '',
    'css' => '',
    'title_size' => '',
    'title_color' => '',
    'content_size' => '',
    'content_color' => '',
    'items_height' => '600'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);


$count_child = substr_count( $content, '[gt3_stripe_column_item' );
$item_width = 100 / $count_child;

$_POST['gt3_stripe_columns_opts'] = array(
    'title_color' => $title_color,
    'content_color' => $content_color,
    'content_size' => $content_size,
    'title_size' => $title_size,
    'item_width' => $item_width,
    'items_height' => $items_height
);

$compile = '';
$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$posts_per_line = $posts_per_line;

$title_color_html = $title_color_html = '';
if ($title_color != '') {
    $title_color_html = ' style="color: '.$title_color.'"';
} 
if ($content_color != '') {
    $content_color_html = ' style="color: '.$content_color.'"';
}


?>
<div class="vc_row">
    <div class="vc_col-sm-12 gt3_stripe_columns <?php echo esc_attr($css_class); ?> ">
    	<div class="module_content stripe_items_list items<?php echo esc_attr($posts_per_line); ?>" data-count-child="<?php echo esc_attr($count_child);?>">
        <?php
            echo do_shortcode($content);
            ?>
        </div>
    </div>
</div>