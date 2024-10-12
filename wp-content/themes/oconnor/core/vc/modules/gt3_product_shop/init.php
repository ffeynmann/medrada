<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

function gt3_generate_autocomplite( $post_type = 'post' ) {
    $posts = get_posts( array(
        'posts_per_page'    => -1,
        'post_type'         => $post_type,
    ));

    $result = array();
    foreach ( $posts as $post ) {
        $id = $post->ID;
        $product_object = wc_get_product((int) $id );
        if ( is_object( $product_object ) ) {
            $product_sku = $product_object->get_sku();
            $product_title = $product_object->get_title();
            $product_id = $id;

            $product_sku_display = '';
            if ( ! empty( $product_sku ) ) {
                $product_sku_display = ' - ' . esc_html__( 'Sku', 'oconnor' ) . ': ' . $product_sku;
            }

            $product_title_display = '';
            if ( ! empty( $product_title ) ) {
                $product_title_display = ' - ' . esc_html__( 'Title', 'oconnor' ) . ': ' . $product_title;
            }

            $product_id_display = esc_html__( 'Id', 'oconnor' ) . ': ' . $product_id;

            $label = $product_id_display . $product_title_display . $product_sku_display;

        }

        $result[] = array(
            'value' => $id,
            'label' => $label,
        );
    }
    return $result;
}


add_action( 'vc_after_mapping', 'gt3_add_product_shortcode' );
function gt3_add_product_shortcode () {

    $count_posts   = wp_count_posts('product');
    $options_array = array(
        array(
            'type'              => 'hidden',
            // This will not show on render, but will be used when defining value for autocomplete
            'param_name'        => 'sku',
        ),

        array(
            'type'              => 'gt3_custom_select',
            'heading'           => esc_html__('Product style', 'oconnor'),
            'param_name'        => 'product_style',
            'edit_field_class'  => 'vc_col-sm-12',
            'options'             => array(
                esc_html__('GT3 Style','oconnor')  => 'gt3_style',
                esc_html__('Default','oconnor')    => 'default',
            ),
            'description'       => esc_html__('Select Product style', 'oconnor'),
        ),

        array(
            "type"              => "gt3_on_off",
            "heading"           => esc_html__( 'Right side image.', 'oconnor' ),
            "param_name"        => "image_right",
            'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
            'std' => 'no',
            'edit_field_class'  => 'vc_col-sm-12 pt-15',
            'save_always'       => true,
            'dependency'        => array(
                'element'   => 'product_style',
                'value'     => 'gt3_style'
            ),
        ),
        array(
            "type"              => "textfield",
            "heading"           => esc_html__("Background Text", 'oconnor'),
            "param_name"        => "bg_text",
            "value"             => '',
            'dependency'        => array(
                'element'   => 'product_style',
                'value'     => 'gt3_style'
            ),
        ),
    );

    if ((int)$count_posts->publish > 20) {
        array_unshift($options_array,
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Product ID', 'oconnor' ),
                'description'   => esc_html__( 'Input product ID', 'oconnor' ),
                'param_name'    => 'id',
                'admin_label'   => true,
            )
        );
    }else{
        array_unshift($options_array,
            array(
                'type'          => 'autocomplete',
                'heading'       => esc_html__( 'Product ID', 'oconnor' ),
                'param_name'    => 'id',
                'description'   => esc_html__( 'Input product ID or product SKU or product title to see suggestions', 'oconnor' ),
                'settings'      => array( 'values' => gt3_generate_autocomplite('product') ),
                'admin_label'   => true,
            )
        );
    }





    if (function_exists('vc_map')) {
    // Add list item
        vc_map(array(
            'name' => esc_html__( 'GT3 Shop Product', 'oconnor' ),
            'base' => 'gt3_product_shop',
            "icon" => 'gt3_icon',
            "category" => esc_html__('GT3 Modules', 'oconnor'),
            'description' => esc_html__( 'Show a single product by ID or SKU', 'oconnor' ),
            'params' => $options_array,
        ));


        if (class_exists('WPBakeryShortCode')) {
            class WPBakeryShortCode_GT3_Product_Shop extends WPBakeryShortCode {

            }
        }
    }
}