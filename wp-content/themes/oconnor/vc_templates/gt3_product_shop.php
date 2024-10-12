<?php

$defaults = array(
    'id'            => '',
	'product_style' => 'gt3_style',
    'image_right'   => '',
    'bg_text'       => ''
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
global $thumbnail_dim;
$thumbnail_dim = 'gt3_catalog_images';

$meta_query = WC()->query->get_meta_query();

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 1,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'meta_query'     => $meta_query,
    'tax_query'      => WC()->query->get_tax_query(),
);

if ( isset( $id ) ) {
    $args['p'] = $id;
}

remove_action('woocommerce_after_shop_loop_item', 'gt3_open_control_tag', 9);
remove_action('woocommerce_after_shop_loop_item', 'gt3_close_control_tag', 15);


$products = new WP_Query( $args );

ob_start();
if ( $products->have_posts() ) :
    while ( $products->have_posts() ) : $products->the_post();
        if ( $product_style == 'gt3_style') : ?>
            <div class="product">
                <div class="gt3-product_image-wrapper">
                    <?php echo woocommerce_get_product_thumbnail('full');?>
                    <?php echo woocommerce_show_product_loop_sale_flash(); ?>
                    <?php do_action('gt3_hot_new_label_product');  // gt3_hot_new_product - 10 ?>
                </div>

                <div class="gt3-product_info-wrapper">
                    <div class="gt3-product_info-content">
                        <a href="<?php echo get_the_permalink();?>" class="woocommerce-LoopProduct-link">
                            <h3 class="gt3-product-title"><?php echo get_the_title(); ?></h3>
                        </a>
                        <?php
                        echo woocommerce_template_loop_price();
                        echo woocommerce_template_single_excerpt();
                        ?>
                        <div class="gt3-product_button-wrapper">
                            <?php  do_action( 'woocommerce_after_shop_loop_item' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else:
            do_action( 'gt3_woocommerce_before_shop_loop' ); // gt3_archive_product_hooks - 150
            $products_shadow = gt3_option('products_shadow');

            echo '<ul class="products gt3_products-single_product '.($products_shadow == '1' ? ' shadow' : '').'">';
            gt3_get_template('gt3-content-product'); // Content output
            echo '</ul>';

        endif;
    endwhile; // end of the loop.
endif;
woocommerce_reset_loop();
wp_reset_postdata();

$shop_prod_class = $image_right == 'yes' ? 'gt3-right-image' : '';
$bg_text = isset($bg_text) && !empty($bg_text) ? '<span class="gt3-product_bg-text">'.esc_html($bg_text).'</span>':'';

echo '<div class="woocommerce gt3-shop-product '.$shop_prod_class.'">'.ob_get_clean().$bg_text.'</div>';

?>