<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action( 'vc_after_mapping', 'gt3_single_product_tab_shortcode' );
function gt3_single_product_tab_shortcode () {

    $count_posts = wp_count_posts('product');
    $options_array = array(
        array(
            'type'          => 'backend_divider',
            'heading'       => esc_html__( 'Module Option:', 'oconnor' ),
            'param_name'    => 'backend_divider',
        ),
        array(
            'type'          => 'hidden',
            // This will not show on render, but will be used when defining value for autocomplete
            'param_name'    => 'sku',
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Select the order in which items are displayed', 'oconnor'),
            'param_name'    => 'items_aligh',
            'value'         => array(
                esc_html__("Tabs | Image | Description", 'oconnor') => 'style_1',
                esc_html__("Tabs | Description | Image", 'oconnor') => 'style_2',
                esc_html__("Image | Description | Tabs", 'oconnor') => 'style_3',
                esc_html__("Description | Image | Tabs", 'oconnor') => 'style_4',
            ),
            'std'           => 'style_4',
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Button', 'oconnor'),
            'param_name'    => 'prod_button',
            'value'         => array(
                esc_html__("Show product Quantity and default Button", 'oconnor') => 'wc_button',
                esc_html__("Show custom Button", 'oconnor') => 'gt3_button',
            ),
            'std'           => 'gt3_button',
        ),

        // Options product start
        array(
            'type'          => 'backend_divider',
            'heading'       => esc_html__( 'Individual Title Options for each product:', 'oconnor' ),
            'param_name'    => 'backend_divider',
            "group"         => esc_html__( "Product Option", 'oconnor' ),
        ),

        // Title 1
        array(
            "type"              => "textfield",
            "heading"           => esc_html__("Title for First Product", 'oconnor'),
            "param_name"        => "title_1",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-12',
        ),
        array(
            "type"              => "colorpicker",
            "heading"           => esc_html__( 'Select Color for First Title', 'oconnor' ),
            "param_name"        => "title_color_1",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-6',
            "value"             => '#ffffff',
            'save_always'       => true,
        ),
        array(
            "type"              => "colorpicker",
            "heading"           => esc_html__( 'Select Background Color for First Title', 'oconnor' ),
            "param_name"        => "title_bg_color_1",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-6',
            "value"             => '#f76733',
            'save_always'       => true,
        ),

        // Title 2
        array(
            "type"              => "textfield",
            "heading"           => esc_html__("Title for Second Product", 'oconnor'),
            "param_name"        => "title_2",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-12',
        ),
        array(
            "type"              => "colorpicker",
            "heading"           => esc_html__( 'Select Color for Second Title', 'oconnor' ),
            "param_name"        => "title_color_2",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-6',
            "value"             => '#ffffff',
            'save_always'       => true,
        ),
        array(
            "type"              => "colorpicker",
            "heading"           => esc_html__( 'Select Background Color for Second Title', 'oconnor' ),
            "param_name"        => "title_bg_color_2",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-6',
            "value"             => '#f76733',
            'save_always'       => true,
        ),

        // Title 3
        array(
            "type"              => "textfield",
            "heading"           => esc_html__("Title for Third Product", 'oconnor'),
            "param_name"        => "title_3",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-12',
        ),
        array(
            "type"              => "colorpicker",
            "heading"           => esc_html__( 'Select Color for Third Title', 'oconnor' ),
            "param_name"        => "title_color_3",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-6',
            "value"             => '#ffffff',
            'save_always'       => true,
        ),
        array(
            "type"              => "colorpicker",
            "heading"           => esc_html__( 'Select Background Color for Third Title', 'oconnor' ),
            "param_name"        => "title_bg_color_3",
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-6',
            "value"             => '#f76733',
            'save_always'       => true,
        ),

        // Title Style
        array(
            'type'          => 'backend_divider',
            'heading'       => esc_html__( 'Title Options for each product:', 'oconnor' ),
            'param_name'    => 'backend_divider',
            "group"         => esc_html__( "Product Option", 'oconnor' ),
        ),
        array(
            'type'              => 'textfield',
            'heading'           => esc_html__('Font Size', 'oconnor'),
            'param_name'        => 'title_font_size',
            'value'             => '14',
            'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-4',
        ),
        array(
            'type'              => 'dropdown',
            'heading'           => esc_html__('Font Weight', 'oconnor'),
            'description'       => esc_html__( 'Select Font Weight.', 'oconnor' ),
            'param_name'        => 'title_weight',
            'value'             => array(
                esc_html__("100", 'oconnor') => '100',
                esc_html__("200", 'oconnor') => '200',
                esc_html__("300", 'oconnor') => '300',
                esc_html__("400", 'oconnor') => '400',
                esc_html__("500", 'oconnor') => '500',
                esc_html__("600", 'oconnor') => '600',
                esc_html__("700", 'oconnor') => '700',
                esc_html__("800", 'oconnor') => '800',
            ),
            'std'               => '400',
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-4',
        ),
        array(
            'type'              => 'textfield',
            'heading'           => esc_html__('Line Height', 'oconnor'),
            'param_name'        => 'title_line_height',
            'value'             => '140',
            'description'       => esc_html__( 'Enter line height in %.', 'oconnor' ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-4',
        ),
        array(
            'type'              => 'gt3_on_off',
            'heading'           => esc_html__( 'Set Responsive Font Size', 'oconnor' ),
            'param_name'        => 'title_responsive_font',
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-12',
        ),
        array(
            'type'              => 'textfield',
            'heading'           => esc_html__('Font Size for small Desktops', 'oconnor'),
            'param_name'        => 'title_font_size_sm_desktop',
            'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-4',
            'dependency'        => array(
                'element'           => 'title_responsive_font',
                "value"             => "true"
            ),
        ),
        array(
            'type'              => 'textfield',
            'heading'           => esc_html__('Font Size for Tablets', 'oconnor'),
            'param_name'        => 'title_font_size_tablet',
            'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-4',
            'dependency'        => array(
                'element'           => 'title_responsive_font',
                "value"             => "true"
            ),
        ),
        array(
            'type'              => 'textfield',
            'heading'           => esc_html__('Font Size for Mobile', 'oconnor'),
            'param_name'        => 'title_font_size_mobile',
            'description'       => esc_html__( 'Enter font-size in pixels.', 'oconnor' ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-4',
            'dependency'        => array(
                'element'           => 'title_responsive_font',
                "value"             => "true"
            ),
        ),
        array(
            'type'              => 'gt3_on_off',
            'heading'           => esc_html__( 'Use theme default font family?', 'oconnor' ),
            'param_name'        => 'title_use_theme_fonts',
            'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
            'description'       => esc_html__( 'Use font family from the theme.', 'oconnor' ),
            'std'               => 'yes',
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'edit_field_class'  => 'vc_col-sm-12',
        ),
        array(
            'type'              => 'google_fonts',
            'param_name'        => 'title_google_fonts',
            'value'             => '',
            'settings'          => array(
                'fields'            => array(
                    'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                    'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                ),
            ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'dependency'        => array(
                'element'            => 'title_use_theme_fonts',
                'value_not_equal_to' => 'yes',
            ),
        ),

        array(
            'type'              => 'backend_divider',
            'heading'           => esc_html__( 'Options for each tabs:', 'oconnor' ),
            'param_name'        => 'backend_divider',
            "group"             => esc_html__( "Product Option", 'oconnor' ),
        ),
        array(
            'type'              => 'gt3_on_off',
            'heading'           => esc_html__('Show Title', 'oconnor'),
            'param_name'        => 'tab_title',
            'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'std'               => 'yes',
            'edit_field_class'  => 'vc_col-sm-4',
        ),
        array(
            'type'              => 'gt3_on_off',
            'heading'           => esc_html__('Show Sub-Title', 'oconnor'),
            'param_name'        => 'tab_sub_title',
            'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'std'               => 'yes',
            'edit_field_class'  => 'vc_col-sm-4',
        ),
        array(
            'type'              => 'gt3_on_off',
            'heading'           => esc_html__('Show Price', 'oconnor'),
            'param_name'        => 'tab_price',
            'value'             => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
            "group"             => esc_html__( "Product Option", 'oconnor' ),
            'std'               => 'yes',
            'edit_field_class'  => 'vc_col-sm-4',
        ),


        // Custom Button start
        // ----- imported from gt3_button -----
        // Text
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Text", 'oconnor'),
            "param_name"    => "button_title",
            "value"         => esc_html__("Shop Now", 'oconnor'),
            'admin_label'   => true,
            "group"         => esc_html__( "Button", 'oconnor' ),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        // Link
        array(
            'type'          => 'vc_link',
            'heading'       => esc_html__( 'Link', 'oconnor' ),
            'param_name'    => 'link',
            "description"   => esc_html__("Add link to button.", 'oconnor'),
            "group"         => esc_html__( "Button", 'oconnor' ),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        // Size
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Size', 'oconnor' ),
            'param_name'    => 'button_size',
            "value"         => array(
                esc_html__( 'Normal', 'oconnor' )  => 'normal',
                esc_html__( 'Mini', 'oconnor' )    => 'mini',
                esc_html__( 'Small', 'oconnor' )   => 'small',
                esc_html__( 'Large', 'oconnor' )   => 'large'
            ),
            "description"   => esc_html__("Select button display size.", 'oconnor'),
            "group"         => esc_html__( "Button", 'oconnor' ),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        // Alignment
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Alignment', 'oconnor' ),
            'param_name'    => 'button_alignment',
            "value"         => array(
                esc_html__( 'Inline', 'oconnor' )  => 'inline',
                esc_html__( 'Left', 'oconnor' )    => 'left',
                esc_html__( 'Right', 'oconnor' )   => 'right',
                esc_html__( 'Center', 'oconnor' )  => 'center',
                esc_html__( 'Block', 'oconnor' )   => 'block'
            ),
            "description"   => esc_html__("Select button alignment.", 'oconnor'),
            "group"         => esc_html__( "Button", 'oconnor' ),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        // Button Border
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Button Border Radius', 'oconnor' ),
            'param_name'    => 'btn_border_radius',
            "value"         => array(
                esc_html__( 'None', 'oconnor' )    => 'none',
                esc_html__( '1px', 'oconnor' )     => '1px',
                esc_html__( '2px', 'oconnor' )     => '2px',
                esc_html__( '3px', 'oconnor' )     => '3px',
                esc_html__( '4px', 'oconnor' )     => '4px',
                esc_html__( '5px', 'oconnor' )     => '5px',
                esc_html__( '10px', 'oconnor' )    => '10px',
                esc_html__( '15px', 'oconnor' )    => '15px',
                esc_html__( '20px', 'oconnor' )    => '20px',
                esc_html__( '25px', 'oconnor' )    => '25px',
                esc_html__( '30px', 'oconnor' )    => '30px',
                esc_html__( '35px', 'oconnor' )    => '35px'
            ),
            "group"         => esc_html__( "Button", 'oconnor' ),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Button Border Style', 'oconnor' ),
            'param_name'    => 'btn_border_style',
            "value"         => array(
                esc_html__( 'Solid', 'oconnor' )   => 'solid',
                esc_html__( 'Dashed', 'oconnor' )  => 'dashed',
                esc_html__( 'Dotted', 'oconnor' )  => 'dotted',
                esc_html__( 'Double', 'oconnor' )  => 'double',
                esc_html__( 'Inset', 'oconnor' )   => 'inset',
                esc_html__( 'Outset', 'oconnor' )  => 'outset',
                esc_html__( 'None', 'oconnor' )    => 'none'
            ),
            "group"         => esc_html__( "Button", 'oconnor' ),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
                'callback'      => 'gt3ButtonDependency',
            ),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Button Border Width', 'oconnor' ),
            'param_name'    => 'btn_border_width',
            "value"         => array(
                esc_html__( '1px', 'oconnor' )  => '1px',
                esc_html__( '2px', 'oconnor' )  => '2px',
                esc_html__( '3px', 'oconnor' )  => '3px',
                esc_html__( '4px', 'oconnor' )  => '4px',
                esc_html__( '5px', 'oconnor' )  => '5px',
                esc_html__( '6px', 'oconnor' )  => '6px',
                esc_html__( '7px', 'oconnor' )  => '7px',
                esc_html__( '8px', 'oconnor' )  => '8px',
                esc_html__( '9px', 'oconnor' )  => '9px',
                esc_html__( '10px', 'oconnor' ) => '10px'
            ),
            "group"         => esc_html__( "Button", 'oconnor' ),
            'dependency'    => array(
                'element'            => 'btn_border_style',
                'value_not_equal_to' => 'none',
            ),
        ),
        // --- ICON GROUP --- //
        array(
            "type"          => 'gt3_custom_select',
            "class"         => "",
            "heading"       => esc_html__("Icon Type", 'oconnor'),
            "param_name"    => "btn_icon_type",
            'options'         => array(
                esc_html__("None",'oconnor')  => "none",
                esc_html__("Font",'oconnor')  => "font",
                esc_html__("Image",'oconnor') => "image",
            ),
            'group'         => esc_html__( 'Btn Icon', 'oconnor' ),
            "description"   => esc_html__("Use an existing font icon or upload a custom image.", 'oconnor'),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
                'callback'      => 'gt3ButtonDependency',
            ),
        ),
        // Icon
        array(
            'type'          => 'iconpicker',
            'heading'       => esc_html__('Icon', 'oconnor'),
            'param_name'    => 'btn_icon_fontawesome',
            'value'         => '', // default value to backend editor admin_label
            'settings'      => array(
                'emptyIcon'     => false, // default true, display an "EMPTY" icon?
                'iconsPerPage'  => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            "dependency"    => Array("element" => "btn_icon_type","value" => array("font")),
            'description'   => esc_html__( 'Select icon from library.', 'oconnor' ),
            'group'         => esc_html__( 'Btn Icon', 'oconnor' ),
        ),
        // Image
        array(
            'type'          => 'attach_image',
            'heading'       => esc_html__('Image', 'oconnor'),
            'param_name'    => 'btn_image',
            'value'         => '',
            'description'   => esc_html__( 'Select image from media library.', 'oconnor' ),
            "dependency"    => Array("element" => "btn_icon_type","value" => array("image")),
            'group'         => esc_html__( 'Btn Icon', 'oconnor' ),
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Image Width', 'oconnor'),
            'param_name'    => 'btn_img_width',
            'value'         => '',
            'description'   => esc_html__( 'Enter image width in pixels.', 'oconnor' ),
            "dependency"    => Array("element" => "btn_icon_type","value" => array("image")),
            'edit_field_class' => 'vc_col-sm-6',
            'group'         => esc_html__( 'Btn Icon', 'oconnor' ),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Icon Position', 'oconnor'),
            'param_name'    => 'btn_icon_position',
            'value'         => array(
                esc_html__("Left", 'oconnor')  => 'left',
                esc_html__("Right", 'oconnor') => 'right'
            ),
            "dependency"    => Array("element" => "btn_icon_type","value" => array("image", "font")),
            'group'         => esc_html__( 'Btn Icon', 'oconnor' ),
        ),
        // Icon Font Size
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Icon Font Size', 'oconnor'),
            'param_name'    => 'icon_font_size',
            'value'         => '16',
            'description'   => esc_html__( 'Enter icon font-size in pixels.', 'oconnor' ),
            "dependency"    => Array("element" => "btn_icon_type","value" => array("font")),
            "group"         => esc_html__( "Btn Icon", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // --- TYPOGRAPHY GROUP --- //
        // Button Font
        array(
            'type'          => 'gt3_on_off',
            'heading'       => esc_html__( 'Use theme default font family for button?', 'oconnor' ),
            'param_name'    => 'use_theme_fonts_button',
            'value'         => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
            'description'   => esc_html__( 'Use font family from the theme.', 'oconnor' ),
            "group"         => esc_html__( "Btn Typography", 'oconnor' ),
            'std'           => 'yes',
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        array(
            'type'          => 'google_fonts',
            'param_name'    => 'google_fonts_button',
            'value'         => '',
            'settings'      => array(
                'fields'        => array(
                    'font_family_description' => esc_html__( 'Select font family.', 'oconnor' ),
                    'font_style_description'  => esc_html__( 'Select font styling.', 'oconnor' ),
                ),
            ),
            'dependency'    => array(
                'element'            => 'use_theme_fonts_button',
                'value_not_equal_to' => 'yes',
            ),
            "group"         => esc_html__( "Btn Typography", 'oconnor' ),
        ),
        // Button Font Size
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Button Font Size', 'oconnor'),
            'param_name'    => 'btn_font_size',
            'value'         => '16',
            'description'   => esc_html__( 'Enter button font-size in pixels.', 'oconnor' ),
            "group"         => esc_html__( "Btn Typography", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        // --- SPACING GROUP --- //
        array(
            'type'          => 'css_editor',
            'param_name'    => 'css',
            'group'         => esc_html__( 'Btn Theme', 'oconnor' ),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Extra Class", 'oconnor'),
            "param_name"    => "item_el_class",
            "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor'),
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        // --- CUSTOM GROUP --- //
        array(
            'type'          => 'gt3_on_off',
            'heading'       => esc_html__( 'Use theme default button?', 'oconnor' ),
            'param_name'    => 'use_theme_button',
            'value'         => array( esc_html__( 'Yes', 'oconnor' ) => 'yes' ),
            'description'   => esc_html__( 'Use button from the theme.', 'oconnor' ),
            "group"         => esc_html__( "Btn Theme", 'oconnor' ),
            'std'           => 'yes',
            'dependency'    => array(
                'element'       => 'prod_button',
                'value'         => 'gt3_button',
            ),
        ),
        // Button Bg
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Background", 'oconnor'),
            "param_name"    => "btn_bg_color",
            "value"         => "#ffffff",
            "description"   => esc_html__("Select custom background for button.", 'oconnor'),
            'save_always'   => true,
            'dependency'    => array(
                'element'            => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group"         => esc_html__( "Btn Theme", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button text-color
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Text Color", 'oconnor'),
            "param_name"    => "btn_text_color",
            "value"         => "#f76733",
            "description"   => esc_html__("Select custom text color for button.", 'oconnor'),
            'save_always'   => true,
            'dependency'    => array(
                'element'            => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group" => esc_html__( "Btn Theme", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button Hover Bg
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Button Hover Background", 'oconnor'),
            "param_name"    => "btn_bg_color_hover",
            "value"         => "#ffffff",
            "description"   => esc_html__("Select custom background for hover button.", 'oconnor'),
            'dependency'    => array(
                'element'            => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group"         => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always'   => true,
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button Hover text-color
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Button Hover Text Color", 'oconnor'),
            "param_name"    => "btn_text_color_hover",
            "value"         => esc_attr(gt3_option("theme-custom-color")),
            "description"   => esc_html__("Select custom text color for hover button.", 'oconnor'),
            'dependency'    => array(
                'element'            => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group"         => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always'   => true,
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button icon-color
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Icon Color", 'oconnor'),
            "param_name"    => "btn_icon_color",
            "value"         => "#ffffff",
            "description"   => esc_html__("Select icon color for button.", 'oconnor'),
            'dependency'    => array(
                'element'            => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group"         => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always'   => true,
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button Hover icon-color
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Button Hover Icon Color", 'oconnor'),
            "param_name"    => "btn_icon_color_hover",
            "value"         => esc_attr(gt3_option("theme-custom-color")),
            "description"   => esc_html__("Select icon color for hover button.", 'oconnor'),
            'dependency'    => array(
                'element'            => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group"         => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always'   => true,
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button border-color
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Button Border Color", 'oconnor'),
            "param_name"    => "btn_border_color",
            "value"         => esc_attr(gt3_option("theme-custom-color")),
            "description"   => esc_html__("Select custom border color for button.", 'oconnor'),
            'save_always'   => true,
            'dependency'    => array(
                'element'            => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group"         => esc_html__( "Btn Theme", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button Hover border-color
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Button Hover Border Color", 'oconnor'),
            "param_name"    => "btn_border_color_hover",
            "value"         => esc_attr(gt3_option("theme-custom-color")),
            "description"   => esc_html__("Select custom border color for hover button.", 'oconnor'),
            "group"         => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always'   => true,
            'dependency'    => array(
                'element'            => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),

    );

    if ((int)$count_posts->publish > 20) {
        array_unshift($options_array,
            array(
                'type'          => 'backend_divider',
                'heading'       => esc_html__( 'Product Identification:', 'oconnor'),
                'description'   => esc_html__( 'Enter product ID', 'oconnor' ),
                'param_name'    => 'backend_divider',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Product ID', 'oconnor' ),
                'description'   => esc_html__( 'First product', 'oconnor' ),
                'param_name'    => 'id_1',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Product ID', 'oconnor' ),
                'description'   => esc_html__( 'Second product', 'oconnor' ),
                'param_name'    => 'id_2',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Product ID', 'oconnor' ),
                'description'   => esc_html__( 'Third product', 'oconnor' ),
                'param_name'    => 'id_3',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-4',
            )
        );
    }else{
        array_unshift($options_array,
            array(
                'type'          => 'backend_divider',
                'heading'       => esc_html__( 'Product Identification:', 'oconnor' ),
                'description'   => esc_html__( 'Enter product ID or product SKU or product title to see suggestions', 'oconnor' ),
                'param_name'    => 'backend_divider',
            ),
            array(
                'type'          => 'autocomplete',
                'heading'       => esc_html__( 'Identificator - First Product', 'oconnor' ),
                'param_name'    => 'id_1',
                'admin_label'   => true,
                'settings'      => array( 'values' => gt3_generate_autocomplite('product') ),
            ),
            array(
                'type'          => 'autocomplete',
                'heading'       => esc_html__( 'Identificator - Second Product', 'oconnor' ),
                'param_name'    => 'id_2',
                'admin_label'   => true,
                'settings'      => array( 'values' => gt3_generate_autocomplite('product') ),
            ),
            array(
                'type'          => 'autocomplete',
                'heading'       => esc_html__( 'Identificator - Third Product', 'oconnor' ),
                'param_name'    => 'id_3',
                'admin_label'   => true,
                'settings'      => array( 'values' => gt3_generate_autocomplite('product') ),
            )
        );
    }

    if (function_exists('vc_map')) {
    // Add list item
        vc_map(array(
            'name'          => esc_html__( 'GT3 Single Product Tab', 'oconnor' ),
            'base'          => 'gt3_single_product_tab',
            "icon"          => 'gt3_icon',
            "category"      => esc_html__('GT3 Modules', 'oconnor'),
            'description'   => esc_html__( 'Show a single product by ID or SKU', 'oconnor' ),
            'params'        => $options_array,
        ));
        if (class_exists('WPBakeryShortCode')) {
            class WPBakeryShortCode_Gt3_Single_Product_Tab extends WPBakeryShortCode {

            }
        }
    }
}