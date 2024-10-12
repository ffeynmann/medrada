<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action('init', 'my_get_woo_catss');

function my_get_woo_catss() {
    $product_categories = array();
    $product_cat = array();
    if(class_exists( 'WooCommerce' )){
        $product_categories = get_terms('product_cat', 'orderby=count&hide_empty=0');
        if ( is_array( $product_categories ) ) {
            foreach ( $product_categories as $cat ) {
                $product_cat[$cat->name.' ('.$cat->slug.')'] = $cat->slug;
            }
        }
    }
    if (function_exists('vc_map')) {
        // Add list item
        vc_map(array(
            "name"              => esc_html__("GT3 Shop List", 'oconnor'),
            "base"              => "gt3_shop_list",
            "class"             => "gt3_shop_list",
            "category"          => esc_html__('GT3 Modules', 'oconnor'),
            "icon"              => 'gt3_icon',
            "content_element"   => true,
            "description"       => esc_html__("GT3 Shop List",'oconnor'),
            "params"            => array(
                array(
                    'type'              => 'gt3-multi-select',
                    'heading'           => esc_html__('Product Category', 'oconnor' ),
                    'param_name'        => 'category',
                    'options'           => $product_cat,
                    'description'       => 'Leave an empty select if you want to display all categories..',
                    'edit_field_class'  => 'vc_col-sm-12 pt-15',
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => esc_html__("Items Per Page", 'oconnor'),
                    "param_name"        => "per_page",
                    "value"             => '8',
                    "description"       => esc_html__("How much items per page to show.", 'oconnor'),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    "heading"           => esc_html__("Columns", 'oconnor'),
                    "param_name"        => "columns",
                    'options'             => array(
                        esc_html__('2', 'oconnor' ) => '2',
                        esc_html__('3', 'oconnor' ) => '3',
                        esc_html__('4', 'oconnor' ) => '4',
                        esc_html__('5', 'oconnor' ) => '5',
                        esc_html__('6', 'oconnor' ) => '6',
                    ),
                    'std'               => '2',
                    'description'       => esc_html__('How much columns grid.', 'oconnor'),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    'type'              => 'gt3_on_off',
                    'heading'           => esc_html__( 'Activate Infinity Scroll', 'oconnor' ),
                    'param_name'        => 'infinity_scroll',
                    'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
                    'std'               => 'no',
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
                    'description'       => esc_html__('Select how to sort retrieved products.', 'oconnor' ),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Order way', 'oconnor' ),
                    'param_name'        => 'order',
                    'options'             => array(
                        esc_html__('Descending', 'oconnor' ) => 'DESC',
                        esc_html__('Ascending', 'oconnor' )  => 'ASC'),
                    'description'       => esc_html__('Designates the ascending or descending orde.', 'oconnor' ),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Grid Gap', 'oconnor'),
                    'param_name'        => 'grid_gap',
                    'admin_label'       => true,
                    'options'             => array(
                        esc_html__("Default", 'oconnor')     => 'gap_default',
                        esc_html__("Without Gap", 'oconnor') => 'gap_no_margin',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => esc_html__('Grid Style', 'oconnor'),
                    'param_name'        => 'grid_style',
                    'admin_label'       => true,
                    'value'             => array(
                        esc_html__("Default GT3", 'oconnor')         => 'grid_default',
                        esc_html__("Default WooCommerce", 'oconnor') => 'grid_default_woo',
                        esc_html__("Packery", 'oconnor')             => 'grid_packery',
                        esc_html__("Masonry", 'oconnor')             => 'grid_masonry',
                        esc_html__("Custom Masonry", 'oconnor')      => 'grid_masonry_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6',
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
                    'std'               => 'hover_default',
                    'edit_field_class'  => 'vc_col-sm-6',
                    'dependency'        => array(
                        'element'           => 'grid_style',
                        'value'             => array("grid_default", "grid_default_woo", "grid_masonry_custom", "grid_masonry"),
                    ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => esc_html__('Hover Style', 'oconnor'),
                    'param_name'        => 'hover_style_2',
                    'admin_label'       => true,
                    'value'             => array(
                        esc_html__("Bottom Title Overlay", 'oconnor') => 'hover_bottom',
                        esc_html__("Center Title Overlay", 'oconnor') => 'hover_center',
                    ),
                    'std'               => 'hover_center',
                    'edit_field_class'  => 'vc_col-sm-6',
                    'dependency'        => array(
                        'element'           => 'grid_style',
                        'value'             => array("grid_packery"),
                    ),
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Show shadow on hover?', 'oconnor' ),
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    "param_name"        => "products_shadow",
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
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'save_always'       => true,
                    'std'               => 'yes',
                    'edit_field_class'  => 'vc_col-sm-12',
                    'dependency'        => array(
                        'element'           => 'grid_style',
                        'value'             => array("grid_default", "grid_default_woo"),
                    ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    "heading"           => esc_html__( 'Select vertical position for these products', 'oconnor' ),
                    "description"       => esc_html__( 'Note: This option is relevant if Catalog Images has different height and Crop is inactive. See "Theme Options > Shop > Products Page".', 'oconnor' ),
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
                        'value_not_equal_to' => 'yes'
                    ),
                ),
                array(
                    "type"              => "backend_divider",
                    "param_name"        => "backend_divider",
                ),

                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Show Recently Viewed Products?', 'oconnor' ),
                    "param_name"        => "shop_list_recently_viewed",
                    'save_always'       => true,
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'yes',
                    'edit_field_class'  => 'vc_col-sm-6',
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Display Recently Viewed Products randomly?', 'oconnor' ),
                    "param_name"        => "viewed_products_orderby",
                    'save_always'       => true,
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'no',
                    'edit_field_class'  => 'vc_col-sm-6',
                    'dependency'        => array(
                        'element'           => 'shop_list_recently_viewed',
                        'value'             => 'yes'
                    ),
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Use Scroll Animation?', 'oconnor' ),
                    "param_name"        => "scroll_anim",
                    'save_always'       => true,
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'no',
                    'edit_field_class'  => 'vc_col-sm-12',
                ),

                // Buttons
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Add to Cart button position', 'oconnor'),
                    'param_name'        => 'cart_btn',
                    'options'             => array(
                        esc_html__("Top and Right", 'oconnor') => 'top',
                        esc_html__("Middle", 'oconnor')        => 'middle',
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
                        esc_html__("Middle", 'oconnor') => 'middle',
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
                    ),
                    'std'               => 'top',
                    'edit_field_class'  => 'vc_col-sm-6',
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
                array(
                    "type"              => "backend_divider",
                    "param_name"        => "backend_divider",
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    "heading"           => esc_html__( 'Dropdown on Frontend - Items Per Page.', 'oconnor' ),
                    'description'       => 'Show the dropdown to change the Number of products displayed per page?',
                    'param_name'        => 'dropdown_products_per_page',
                    'options'             => array(
                        esc_html__("Top", 'oconnor')            => 'top',
                        esc_html__("Bottom", 'oconnor')         => 'bottom',
                        esc_html__("Bottom and Top", 'oconnor') => 'bottom_top',
                        esc_html__("Off", 'oconnor')            => 'off',
                    ),
                    'std'               => 'bottom_top',
                    'edit_field_class'  => 'vc_col-sm-12',
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                    'dependency'        => array(
                        'element'            => 'infinity_scroll',
                        'value_not_equal_to' => 'yes'
                    ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    "heading"           => esc_html__( 'Dropdown on Frontend - Order by.', 'oconnor' ),
                    'description'       => 'Show the dropdown to change the Sorting of products displayed per page?',
                    'param_name'        => 'dropdown_products_orderby',
                    'options'             => array(
                        esc_html__("Top", 'oconnor')            => 'top',
                        esc_html__("Bottom", 'oconnor')         => 'bottom',
                        esc_html__("Bottom and Top", 'oconnor') => 'bottom_top',
                        esc_html__("Off", 'oconnor')            => 'off',
                    ),
                    'std'               => 'bottom_top',
                    'edit_field_class'  => 'vc_col-sm-12',
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
                array(
                    'type'              => 'gt3_custom_select',
                    'heading'           => esc_html__('Pagination.', 'oconnor'),
                    "description"       => esc_html__( 'Show Pagination on the page?', 'oconnor' ),
                    'param_name'        => 'pagination',
                    'options'             => array(
                        esc_html__("Top", 'oconnor')            => 'top',
                        esc_html__("Bottom", 'oconnor')         => 'bottom',
                        esc_html__("Bottom and Top", 'oconnor') => 'bottom_top',
                        esc_html__("Off", 'oconnor')            => 'off',
                    ),
                    'std'               => 'bottom_top',
                    'edit_field_class'  => 'vc_col-sm-12',
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                    'dependency'        => array(
                        'element'            => 'infinity_scroll',
                        'value_not_equal_to' => 'yes'
                    ),
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Classic pagination Top?', 'oconnor' ),
                    "param_name"        => "pagination_top",
                    'save_always'       => true,
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'no',
                    'edit_field_class'  => 'vc_col-sm-3',
                    'dependency'        => array(
                        'element'           => 'pagination',
                        'value'             => array("top", "bottom_top"),
                    ),
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Classic pagination Bottom?', 'oconnor' ),
                    "param_name"        => "pagination_bottom",
                    'save_always'       => true,
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'yes',
                    'edit_field_class'  => 'vc_col-sm-3',
                    'dependency'        => array(
                        'element'           => 'pagination',
                        'value'             => array("bottom", "bottom_top"),
                    ),
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),
                array(
                    "type"              => "gt3_on_off",
                    "heading"           => esc_html__( 'Show Grid/List toggle Buttons?', 'oconnor' ),
                    "description"       => esc_html__( 'This option works if "YITH WooCommerce Grid/List" plugin is installed and active.', 'oconnor' ),
                    "param_name"        => "shop_grid_list",
                    'save_always'       => true,
                    'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                    'std'               => 'no',
                    'edit_field_class'  => 'vc_col-sm-12',
                    'dependency'        => array(
                        'element'           => 'hover_style',
                        'value'             => array("hover_default"),
                    ),
                    "group"             => esc_html__( "Buttons", 'oconnor' ),
                ),


            )
        ));

        if (class_exists('WPBakeryShortCode')) {
            class WPBakeryShortCode_Gt3_shop_list extends WPBakeryShortCode {

            }
        }
    }
}
