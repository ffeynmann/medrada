<?php
global $products, $woocommerce_loop, $wp_query;
$defaults = array(
    'category'          => '',
    'per_page'          => '8',
    'columns'           => '2',
    'infinity_scroll'   => false,
    'orderby'           => 'date',
    'order'             => 'DESC',

    'grid_gap'          => 'gap_default',
    'grid_style'        => 'grid_default',
    'hover_style'       => 'hover_default',
    'hover_style_2'     => 'hover_center',
    'products_shadow'   => 'yes',
    'prod_background_1' => 'transparent',
    'prod_background_2' => 'transparent',

    'shop_list_equal_height'    => 'yes',
    'shop_list_v_position'      => 'top',

    'cart_btn'          => 'middle',
    'wishlist_btn'      => 'top',
    'quick_view_btn'    => 'middle',
    'compare_btn'       => 'top',
    'dropdown_products_per_page' => 'bottom_top',
    'dropdown_products_orderby'  => 'bottom_top',
    'pagination'        => 'bottom_top',
    'pagination_top'    => '',
    'pagination_bottom' => 'yes',
    'shop_grid_list'    => '',
    'shop_list_recently_viewed' => '',
    'viewed_products_orderby'   => '',
    'scroll_anim'       => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
global $animation_class, $thumbnail_dim;
extract($atts);
set_query_var('gt3_shop_list_options_'.get_the_ID(), $atts);

if ( $scroll_anim == 'yes' ) {
    wp_enqueue_script('gt3_appear', get_template_directory_uri() . '/js/jquery.appear.min.js', array(), false, false);
    $animation_class = 'gt3-anim-product';
} else {
    $animation_class = '';
}

if ( $infinity_scroll == 'yes' ) {
    wp_enqueue_script('gt3_infinite_scroll', get_template_directory_uri() . '/woocommerce/js/infinite-scroll.pkgd.min.js', array(), '3.0.2', true);
}

// Category render
if (empty($category)) {
    $gt3_tax_query = '';
} else {
    $categories = explode( ',', $category);
    $gt3_tax_query = array(
        array(
            'taxonomy'      => 'product_cat',
            'terms'         => $categories,
            'field'         => 'slug',
            'operator'      => 'IN'
        )
    );
}

$product_visibility_terms  = wc_get_product_visibility_term_ids();
$product_visibility_not_in = $product_visibility_terms['exclude-from-catalog'];
if ( 'yes' === get_option('woocommerce_hide_out_of_stock_items') ) {
    $gt3_tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'name',
        'terms'    => array( 'outofstock', 'exclude-from-catalog' ),
        'operator' => 'NOT IN',
    );
} else {
    $gt3_tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'term_taxonomy_id',
        'terms'    => $product_visibility_not_in,
        'operator' => 'NOT IN',
    );
}

// Select filter sortby
if ( isset( $_GET['orderby'] ) ) {
    $orderby_value = explode( '-', $_GET['orderby'] );
    $orderby       = esc_attr( $orderby_value[0] );
    $order         = ! empty( $orderby_value[1] ) ? $orderby_value[1] : $order;
    if ($_GET['orderby'] == 'price') {
        $order = 'ASC';
    }
}

$ordering_args = WC()->query->get_catalog_ordering_args( $orderby, $order );
$meta_query    = WC()->query->get_meta_query();

// Pagination setup
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

// Select how many products to show
if (isset( $_GET['show_prod'])) $per_page = $_GET['show_prod'];

if (class_exists('WC_List_Grid')) {
    if ('hover_default' == $hover_style && ( 'grid_default' == $grid_style || 'grid_default_woo' == $grid_style ) ) {
        // Add grid-list buttons
        global $WC_List_Grid;
        add_action( 'gt3_shortcode_before_products_list_loop', array( $WC_List_Grid, 'gridlist_toggle_button' ), 30);
    }
}

$args = array(
    'post_type'				=> 'product',
    'post_status' 			=> 'publish',
    'ignore_sticky_posts'	=> 1,
    'orderby' 				=> $ordering_args['orderby'],
    'order' 				=> $ordering_args['order'],
    'meta_key'              => $ordering_args['meta_key'],
    'posts_per_page' 		=> $per_page,
    'paged'                 => $paged,
    'meta_query' 			=> $meta_query,
    'tax_query'             => $gt3_tax_query
);

$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
$columns = absint( $columns );
$woocommerce_loop['columns'] = $columns;

$shop_list_v_position = !empty($shop_list_v_position) ? $shop_list_v_position : 'top';

$products_class = '';
$products_class .= !empty($hover_style) && $grid_style !== 'grid_packery' ? ' '.$hover_style : '';
$products_class .= !empty($hover_style_2) && $grid_style === 'grid_packery'  ? ' '.$hover_style_2 : '';
$products_class .= !empty($grid_gap) ? ' '.$grid_gap : '';
$products_class .= 'grid_masonry' == $grid_style || 'grid_masonry_custom' == $grid_style ? ' shop_grid_masonry' : '';
$products_class .= 'grid_packery' == $grid_style ?  ' shop_grid_masonry shop_grid_packery' : '';
$products_class .= $shop_list_equal_height ? ' shop_list_equal_height' : ' shop_list_position-'.$shop_list_v_position;
$products_class .= $products_shadow ? ' shadow' : '';


ob_start();
if ( $products->have_posts() ) {
    if ( $shop_grid_list == 'yes' ||
         $dropdown_products_per_page == 'top' || $dropdown_products_per_page == 'bottom_top' ||
         $dropdown_products_orderby == 'top' || $dropdown_products_orderby == 'bottom_top' ||
         $pagination == 'top' || $pagination == 'bottom_top' ) {

        echo '<div class="gt3-products-header '.esc_attr($products_class).'">';
            if ( $shop_grid_list == 'yes' ) {
                do_action( 'gt3_shortcode_before_products_list_loop', array( 'products' => $products ) );
            }
            if ( ($dropdown_products_per_page == 'top' || $dropdown_products_per_page == 'bottom_top') && !$infinity_scroll == 'yes' ) {
                gt3_get_template('loop/product-show'); // Product show
            }
            if ( $dropdown_products_orderby == 'top' || $dropdown_products_orderby == 'bottom_top' ) {
                gt3_get_template('loop/orderby'); // Orderby
            }

            if ( ($pagination == 'top' || $pagination == 'bottom_top') && $products->max_num_pages > 1 && !$infinity_scroll == 'yes' ) {
                if ( $pagination_top == 'yes' ) {
                    gt3_get_template('pagination');
                }else{
                    echo '<div class="gt3-pagination_nav">';
                    gt3_get_template('pagination');
                    echo '<span class="gt3_pagination_delimiter"></span>
                          <a class="gt3_show_all" href="?show_prod=9999" title="'.esc_html__('Show all products', 'oconnor').'">'.esc_html__('View All', 'oconnor').'</a>';
                    echo '</div>';
                }
            }
        echo '</div> <!-- gt3-products-header -->';
    }

    echo '<ul class="products '.esc_attr($products_class).'" data-infinite-scroll=\'{ "path": ".next.page-numbers", "append": ".woocommerce > .products > .product", "history": false, "hideNav": ".woocommerce-pagination" }\'>';

    do_action( 'gt3_woocommerce_before_shop_loop' ); // gt3_archive_product_hooks - 150

    switch ($columns) {
        case '2':
            $packery_array = array('gt3_900x450','gt3_450x450','gt3_450x450','gt3_450x450','gt3_900x450','gt3_450x450');
            break;
        case '3':
            $packery_array = array('gt3_450x450','gt3_900x450','gt3_450x450','gt3_900x450','gt3_450x450','gt3_900x900','gt3_450x450','gt3_450x450','gt3_900x450','gt3_450x450','gt3_450x450','gt3_900x450','gt3_900x900','gt3_450x450');
            break;
        case '4':
            $packery_array = array('gt3_450x450','gt3_450x450','gt3_900x900','gt3_450x450','gt3_450x450','gt3_900x900','gt3_450x450','gt3_450x450','gt3_450x450','gt3_450x450');
            break;
        case '5':
            $packery_array = array('gt3_450x450','gt3_450x450','gt3_450x450','gt3_900x900','gt3_900x450','gt3_900x450','gt3_900x450','gt3_450x450','gt3_450x450','gt3_900x900','gt3_450x450','gt3_900x450','gt3_900x450','gt3_450x450');
            break;
        case '6':
            $packery_array = array('gt3_450x450','gt3_450x450','gt3_900x900','gt3_450x450','gt3_450x450','gt3_900x900','gt3_450x450','gt3_450x450','gt3_450x450','gt3_450x450'); // like case 4
            break;
        default:
            $packery_array = array('gt3_900x450','gt3_450x450','gt3_450x450','gt3_450x450','gt3_900x450','gt3_450x450');
            break;
    }
    $packery_count = count($packery_array);

    echo '<li class="product-default-width"></li>';

    while ( $products->have_posts() ) {
        $products->the_post();

        if ('grid_masonry' == $grid_style) {
            $thumbnail_dim = 'post-thumbnail';
        } elseif ('grid_packery' == $grid_style) {
            $number_pos = !isset($number_pos) ? 1 : $number_pos;
            $thumbnail_dim = $packery_array[$number_pos - 1];

            $number_pos = $number_pos == $packery_count ? 1 : ++$number_pos;
        } elseif ('grid_masonry_custom' == $grid_style) {
            $gt3_masonry_image_size = get_post_meta( get_the_ID(), 'mb_img_size_masonry', true );
            switch ($gt3_masonry_image_size) {
                case 'large_h_rect':
                    $thumbnail_dim = 'gt3_912x730';
                    break;
                case 'large_v_rect':
                    $thumbnail_dim = 'gt3_442x730';
                    break;
                default:
                    $thumbnail_dim = 'gt3_442x350';
                    break;
            }
        } elseif ('grid_default' == $grid_style) {
            $thumbnail_dim = 'gt3_catalog_images';
        } elseif ('grid_default_woo' == $grid_style ) {
            $thumbnail_dim = 'shop_catalog';
        } else {
            $thumbnail_dim = 'gt3_912x730';
        }

        do_action( 'woocommerce_shop_loop' );

        gt3_get_template('gt3-content-product'); // Content output

    } // end of the loop. ?>

    <?php if ( ('grid_packery' == $grid_style) ): ?>
        <li class="bubblingG">
            <span id="bubblingG_1">
            </span>
            <span id="bubblingG_2">
            </span>
            <span id="bubblingG_3">
            </span>
        </li>
    <?php endif; ?>

    </ul>

    <?php

    if ( "bottom_top" == $pagination || "bottom" == $pagination ||
         $dropdown_products_per_page == 'bottom' || $dropdown_products_per_page == 'bottom_top' ||
         $dropdown_products_orderby == 'bottom' || $dropdown_products_orderby == 'bottom_top' ) {

        echo '<div class="gt3-products-bottom">';
            if ( ("bottom_top" == $pagination || "bottom" == $pagination ) && $products->max_num_pages > 1 && $infinity_scroll == 'no' ) {
                if ( $pagination_bottom == 'yes' ) {
                    gt3_get_template('pagination');
                }else{
                    echo '<div class="gt3-pagination_nav">';
                    gt3_get_template('pagination');
                    echo '<span class="gt3_pagination_delimiter"></span>
                          <a class="gt3_show_all" href="?show_prod=9999" title="'.esc_html__('Show all products', 'oconnor').'">'.esc_html__('View All', 'oconnor').'</a>';
                    echo '</div>';
                }
            }
            if ( ($dropdown_products_per_page == 'bottom' || $dropdown_products_per_page == 'bottom_top') && $infinity_scroll == 'yes' ) {
                gt3_get_template('loop/product-show'); // Product show
            }
            if ( $dropdown_products_orderby == 'bottom' || $dropdown_products_orderby == 'bottom_top' ) {
                gt3_get_template('loop/orderby'); // Orderby
            }
        echo '</div>';
    }
    if ( $infinity_scroll == 'yes' ) {
        gt3_get_template('pagination');
    }
}
woocommerce_reset_loop();
wp_reset_postdata();

if ( $shop_list_recently_viewed == 'yes' ) {
    gt3_get_template('gt3-recently-viewed');
}

$columns = !empty($columns) ? $columns : 4;

echo '<div class="woocommerce gt3-shop-list columns-'.esc_attr($columns).'">' . ob_get_clean() . '</div>';