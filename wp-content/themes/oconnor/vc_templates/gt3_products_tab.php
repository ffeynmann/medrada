<?php

$defaults = array(
    'category'          => '',
    'per_page'          => '4',
    'columns'           => '4',
    'slider'            => false,
    'slider_navigation' => 'dots',
    'arrow_style'       => 'default',
    'orderby'           => 'id',
    'order'             => 'DESC',

    'grid_gap'          => 'gap_default',
    'grid_style'        => 'grid_default',
    'hover_style'       => 'hover_default',
    'products_shadow'   => 'yes',
    'prod_background_1' => 'transparent',
    'prod_background_2' => 'transparent',

    'shop_list_equal_height'    => false,
    'shop_list_v_position'      => 'top',

    'cart_btn'          => 'middle',
    'wishlist_btn'      => 'top',
    'quick_view_btn'    => 'middle',
    'compare_btn'       => 'top',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
set_query_var('gt3_product_tab_options_'.get_the_ID(), $atts);
global $animation_class, $thumbnail_dim;

$products_class = '';
$products_class .= !empty($hover_style) && $grid_style !== 'grid_packery' ? ' '.$hover_style : '';
$products_class .= $shop_list_equal_height ? ' shop_list_equal_height' : ' shop_list_position-'.$shop_list_v_position;
$products_class .= $products_shadow ? ' shadow' : '';
$products_class .= $slider_navigation != '' ? ' slider_navigation-'.esc_attr($slider_navigation) : '';
$products_class .= $arrow_style != '' ? ' gt3_arrow_style-'.esc_attr($arrow_style) : '';

$columns = absint( $columns );
if ( !empty($columns) && $columns == '1' ) {
    $products_class .= ' gap_default';
}elseif( !empty($grid_gap) ){
    $products_class .= ' '.$grid_gap;
}else{
    $products_class .= ' gap_default';
}

$list_cat = $categories = '';
$list_item_by_cat = '';
$is_active = 0;

if ( $category != '' ) {
    $categories = explode( ',', $category);
    foreach ($categories as $cat_slug) {
        $cat_obj = get_term_by('slug', $cat_slug, 'product_cat');
        $cat_name = $cat_obj->name;

        if($is_active==0){
            $active_class='active';
            $is_active = 1;
        }else{
            $active_class = '';
        }

        $list_cat .= '<a href="javascript:;" class="product-filter '.esc_attr($cat_slug).' '.esc_attr($active_class).'" data-filter=".'.esc_attr($cat_slug).'">'.esc_attr($cat_name).'</a>';

        $ordering_args = WC()->query->get_catalog_ordering_args( $orderby, $order );
        $meta_query    = WC()->query->get_meta_query();

        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'orderby'               => $ordering_args['orderby'],
            'order'                 => $ordering_args['order'],
            'posts_per_page'        => $per_page,
            'meta_query'            => $meta_query,
            'tax_query'             => array(
                array(
                    'taxonomy'      => 'product_cat',
                    'terms'         => $cat_slug,
                    'field'         => 'slug',
                    'operator'      => 'IN'
                ),
                array(
                    'taxonomy'      => 'product_visibility',
                    'field'         => 'name',
                    'terms'         => array( 'exclude-from-catalog'),
                    'operator'      => 'NOT IN',
                ),
            )
        );

        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
        global $woocommerce_loop;

        $woocommerce_loop['columns'] = $columns;
        $is_slider = $slider ? 'gt3_flexslider_active' : 'gt3_flexslider_disable';
        ob_start();

        if ( $products->have_posts() ){

            do_action( 'gt3_woocommerce_before_shop_loop' ); // gt3_archive_product_hooks - 150

            echo '<ul class="products '.esc_attr($products_class).'">';

            do_action( 'woocommerce_shortcode_before_product_cat_loop' );

            while ( $products->have_posts() ) : $products->the_post();

                if ('grid_default' == $grid_style) {
                    $thumbnail_dim = 'gt3_catalog_images';
                } elseif ('grid_default_woo' == $grid_style ) {
                    $thumbnail_dim = 'shop_catalog';
                } else {
                    $thumbnail_dim = 'gt3_912x730';
                }

                gt3_get_template('gt3-content-product');  // Content output

            endwhile; // end of the loop.

            echo '</ul>';

            do_action( 'woocommerce_shortcode_after_product_cat_loop' );
        }
        woocommerce_reset_loop();
        wp_reset_postdata();

        $list_item_by_cat .= '<div class="gt3-tab-group '.esc_attr($cat_slug).' '.esc_attr($active_class).' '.esc_attr($is_slider).'">' . ob_get_clean() . '</div>';
    }
}

$data_attr = '';
if ( $slider ) {
    $data_attr .= ' data-columns='.(int)$columns;

    switch ( $slider_navigation ) {
        case 'dots':
            $data_attr .= ' data-dots=true';
            $data_attr .= ' data-arrow=false';
            break;
        case 'arrow':
            $data_attr .= ' data-dots=false';
            $data_attr .= ' data-arrow=true';
            break;
        case 'both':
            $data_attr .= ' data-dots=true';
            $data_attr .= ' data-arrow=true';
            break;
        default:
            $data_attr .= ' data-dots=false';
            $data_attr .= ' data-arrow=false';
            break;
    }
}

echo '<div class="gt3-woocommers-tab">';

    if ( count($categories) > 1 ) {
    echo '<div class="gt3-woo-filter">';
        echo (($list_cat));
    echo '</div>';
    }

    echo '<div class="woocommerce columns-'.(int)$columns.'" '.esc_attr($data_attr).'>';
        echo (($list_item_by_cat));
    echo '</div>';
echo '</div>'
?>