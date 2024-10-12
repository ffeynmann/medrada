<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action('init', 'my_get_woo_cats');

function my_get_woo_cats() {
    $product_categories = array();
    $product_cat = array();
    if(class_exists( 'WooCommerce' )){
        $product_categories = get_terms('product_cat', 'hide_empty=0');
        if ( is_array( $product_categories ) ) {
            foreach ( $product_categories as $cat ) {
                $product_cat[$cat->name.' ('.$cat->slug.')'] = $cat->slug;
            }
        }
    }

    if (function_exists('vc_map')) {
        vc_map(array(
            'base'          => 'gt3_products_tab',
            'name'          => esc_html__('GT3 Products Tab', 'oconnor'),
            "description"   => esc_html__("Products Tab by Category", 'oconnor'),
            'category'      => esc_html__('GT3 Modules', 'oconnor'),
            'icon'          => 'gt3_icon',
            'params'        => array(
                array(
                    'type'              => 'gt3-multi-select',
                    'heading'           => esc_html__('Product Category', 'oconnor' ),
                    'param_name'        => 'category',
                    'options'           => $product_cat,
                    'description'       => esc_html__('Note: Go to "Products > Categories" to sort these Tabs ', 'oconnor')
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => esc_html__("Items Per Page", 'oconnor'),
                    "param_name"        => "per_page",
                    "value"             => '4',
                    "description"       => esc_html__("How much items per page to show.", 'oconnor')
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    "heading"           => esc_html__("Columns", 'oconnor'),
                    "param_name"        => "columns",
                    'options'             => array(
                        esc_html__('1', 'oconnor' ) => '1',
                        esc_html__('2', 'oconnor' ) => '2',
                        esc_html__('3', 'oconnor' ) => '3',
                        esc_html__('4', 'oconnor' ) => '4',
                        esc_html__('5', 'oconnor' ) => '5',
                        esc_html__('6', 'oconnor' ) => '6',
                    ),
                    'std'               => '4',
                    'description'       => esc_html__('How much columns grid.', 'oconnor'),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Activate slider', 'oconnor' ),
                    "param_name"        => "slider",
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'no',
                    "description"       => esc_html__("Note: This option will work if the number of 'Items Per Page' is more than in the 'Columns'", 'oconnor')
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Navigation', 'oconnor' ),
                    'description'       => esc_html__('Select type of navigation for this slider.', 'oconnor' ),
                    'param_name'        => 'slider_navigation',
                    'options'             => array(
                        esc_html__('Dots', 'oconnor' )             => 'dots',
                        esc_html__('Arrows', 'oconnor' )           => 'arrow',
                        esc_html__('Dots and Arrows', 'oconnor' )  => 'both',
                        esc_html__('None', 'oconnor' )             => 'none',
                    ),
                    'dependency'        => array(
                        'element'           => 'slider',
                        'value'             => 'yes',
                    ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => 'Select Arrow Style',
                    'description'       => esc_html__( 'Select style for prev/next buttons.', 'oconnor' ),
                    'param_name'        => 'arrow_style',
                    'options'             => array(
                        esc_html__( 'Default', 'oconnor' ) => 'default',
                        esc_html__( 'Rounded', 'oconnor' ) => 'rounded',
                        esc_html__( 'Round', 'oconnor' )   => 'round',
                    ),
                    'std'               => 'default',
                    'dependency'        => array(
                        'element'           => 'slider_navigation',
                        'value'             => array('arrow','both'),
                    ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => esc_html__('Order by', 'oconnor' ),
                    'param_name'        => 'orderby',
                    'value'             => array(
                        esc_html__('Date', 'oconnor' )          => 'date',
                        esc_html__('ID', 'oconnor' )            => 'ID',
                        esc_html__('Author', 'oconnor' )        => 'author',
                        esc_html__('Modified', 'oconnor' )      => 'modified',
                        esc_html__('Random', 'oconnor' )        => 'rand',
                        esc_html__('Comment count', 'oconnor' ) => 'comment_count',
                        esc_html__('Menu Order', 'oconnor' )    => 'menu_order'
                    ),
                    'description'       => esc_html__('Select how to sort retrieved products.', 'oconnor' )
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Order way', 'oconnor' ),
                    'param_name'        => 'order',
                    'options'             => array(
                        esc_html__('Descending', 'oconnor' ) => 'DESC',
                        esc_html__('Ascending', 'oconnor' )  => 'ASC',
                    ),
                    'description'       => esc_html__('Designates the ascending or descending order.', 'oconnor' )
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => esc_html__('Grid Gap', 'oconnor'),
                    'description'       => esc_html__('Note: Percentage does not work if the slider is active.', 'oconnor'),
                    'param_name'        => 'grid_gap',
                    'value'             => array(
                        esc_html__('Default', 'oconnor')     => 'gap_default',
                        esc_html__('Gap 60px', 'oconnor')    => 'gap_60',
                        esc_html__('Gap 90px', 'oconnor')    => 'gap_90',
                        esc_html__('Gap 120px', 'oconnor')   => 'gap_120',
                        esc_html__('Gap 150px', 'oconnor')   => 'gap_150',
                        esc_html__('Gap 2%', 'oconnor')      => 'gap__2',
                        esc_html__('Gap 3%', 'oconnor')      => 'gap__3',
                        esc_html__('Gap 4%', 'oconnor')      => 'gap__4',
                        esc_html__('Gap 5%', 'oconnor')      => 'gap__5',
                        esc_html__('Gap 6%', 'oconnor')      => 'gap__6',
                        esc_html__('Gap 7%', 'oconnor')      => 'gap__7',
                        esc_html__('Gap 8%', 'oconnor')      => 'gap__8',
                        esc_html__('Gap 10%', 'oconnor')     => 'gap__10',
                        esc_html__('Gap 12%', 'oconnor')     => 'gap__12',
                        esc_html__('Gap 15%', 'oconnor')     => 'gap__15',
                        esc_html__('Without Gap', 'oconnor') => 'gap_no_margin',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6',
                    'dependency'        => array(
                        'element'            => 'columns',
                        'value_not_equal_to' => '1',
                    ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Grid Style', 'oconnor'),
                    'param_name'        => 'grid_style',
                    'admin_label'       => true,
                    'options'             => array(
                        esc_html__("Default GT3", 'oconnor')         => 'grid_default',
                        esc_html__("Default WooCommerce", 'oconnor') => 'grid_default_woo',
                    ),
                    'edit_field_class'  => 'vc_col-sm-12',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => esc_html__('Hover Style', 'oconnor'),
                    'param_name'        => 'hover_style',
                    'admin_label'       => true,
                    'value'             => array(
                        esc_html__("Default", 'oconnor')              => 'hover_default',
                        esc_html__("Bottom Title Overlay", 'oconnor') => 'hover_bottom',
                        esc_html__("Center Title Overlay", 'oconnor') => 'hover_center',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Show shadow on hover?', 'oconnor' ),
                    "param_name"        => "products_shadow",
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'yes',
                    'edit_field_class'  => 'vc_col-sm-12',
                ),
                array(
                    "type"              => "colorpicker",
                    "heading"           => esc_html__("Background Color", 'oconnor'),
                    "param_name"        => "prod_background_1",
                    "value"             => "transparent",
                    "description"       => esc_html__("Select the Background Color for each Products.", 'oconnor'),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    "type"              => "colorpicker",
                    "heading"           => esc_html__("Hover Background Color", 'oconnor'),
                    "param_name"        => "prod_background_2",
                    "value"             => "transparent",
                    "description"       => esc_html__("Select the Background Color for each Products in hover.", 'oconnor'),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),

                array(
                    "type"              => "backend_divider",
                    "param_name"        => "backend_divider",
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Equal height?', 'oconnor' ),
                    "description"       => esc_html__( 'If checked products will be set to equal height.', 'oconnor' ),
                    "param_name"        => "shop_list_equal_height",
                    'save_always'       => true,
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'no',
                    'edit_field_class'  => 'vc_col-sm-12',
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    "heading"           => esc_html__( 'Select vertical position for these products', 'oconnor' ),
                    "param_name"        => "shop_list_v_position",
                    'options'             => array(
                        esc_html__("Top", 'oconnor')    => 'top',
                        esc_html__("Center", 'oconnor') => 'center',
                        esc_html__("Bottom", 'oconnor') => 'bottom',
                    ),
                    'std'               => 'top',
                    'edit_field_class'  => 'vc_col-sm-12',
                    'dependency'        => array(
                        'element'            => 'shop_list_equal_height',
                        'value_not_equal_to' => 'true'
                    ),
                ),

                // Buttons
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Add to Cart button position', 'oconnor'),
                    'param_name'        => 'cart_btn',
                    'options'             => array(
                        esc_html__("Top and Right", 'oconnor') => 'top',
                        esc_html__("Middle", 'oconnor')        => 'middle',
                        esc_html__("Bottom", 'oconnor')        => 'bottom',
                    ),
                    'std'               => 'middle',
                    'edit_field_class'  => 'vc_col-sm-6 pt-15',
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Wishlist button position', 'oconnor'),
                    'param_name'        => 'wishlist_btn',
                    'description'       => esc_html__('This option works if "YITH WooCommerce Wishlist" plugin is installed and active.', 'oconnor' ),
                    'options'             => array(
                        esc_html__("Top and Right", 'oconnor') => 'top',
                        esc_html__("Middle", 'oconnor')        => 'middle',
                        esc_html__("Bottom", 'oconnor')        => 'bottom',
                    ),
                    'std'               => 'top',
                    'edit_field_class'  => 'vc_col-sm-6',
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Quick View button position', 'oconnor'),
                    'param_name'        => 'quick_view_btn',
                    'description'       => esc_html__('This option works if "YITH WooCommerce Quick View" plugin is installed and active.', 'oconnor' ),
                    'options'             => array(
                        esc_html__("Top and Right", 'oconnor') => 'top',
                        esc_html__("Middle", 'oconnor')        => 'middle',
                        esc_html__("Bottom", 'oconnor')        => 'bottom',
                    ),
                    'std'               => 'middle',
                    'edit_field_class'  => 'vc_col-sm-6',
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Compare button position', 'oconnor'),
                    'param_name'        => 'compare_btn',
                    'description'       => esc_html__('This option works if "YITH WooCommerce Compare" plugin is installed and active.', 'oconnor' ),
                    'options'             => array(
                        esc_html__("Top and Right", 'oconnor') => 'top',
                        esc_html__("Middle", 'oconnor')        => 'middle',
                        esc_html__("Bottom", 'oconnor')        => 'bottom',
                    ),
                    'std'               => 'top',
                    'edit_field_class'  => 'vc_col-sm-6',
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
            ),


        ));

        class WPBakeryShortCode_Gt3_products_tab extends WPBakeryShortCode { }

    }
}