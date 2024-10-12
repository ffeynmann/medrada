<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (!function_exists('gt3_generate_autocomplite')) {
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
}

add_action( 'vc_after_mapping', 'gt3_add_product_countdown_shortcode' );
function gt3_add_product_countdown_shortcode () {

    $count_posts = wp_count_posts('product');
    $options_array = array(
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
                esc_html__("Countdown | Image | Description", 'oconnor')   => 'style_1',
                esc_html__("Countdown | Description | Image", 'oconnor')   => 'style_2',

                esc_html__("Image | Countdown | Description", 'oconnor')   => 'style_3',
                esc_html__("Image | Description | Countdown", 'oconnor')   => 'style_4',

                esc_html__("Description | Image | Countdown", 'oconnor')   => 'style_5',
                esc_html__("Description | Countdown | Image", 'oconnor')   => 'style_6',
            ),
            'std'           => 'style_1',
        ),

        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Select an action when the counter stops', 'oconnor'),
            'param_name'    => 'time_is_up',
            'admin_label'   => true,
            'value'         => array(
                esc_html__("Hide Countdown", 'oconnor') => 'countdown_hide',
                esc_html__("Do nothing (will show 00)", 'oconnor') => 'countdown_nothing',
                esc_html__("Use custom Date and then hide Countdown", 'oconnor') => 'custom_date_hide',
                esc_html__("Use custom Date and then will show 00", 'oconnor') => 'custom_date_nothing',
            ),
            'description'   => esc_html__( 'Find the selected woo product to change/add counter time (Products -> All Products -> select the one from the list and click edit -> General -> Enter Sale Price -> Set a Schedule )
                Note: The extra Custom Date will start work after the WC Product Sale Date is expired.', 'oconnor' ),
            'std'           => 'countdown_remove',
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Year", 'oconnor'),
            "param_name"    => "countdown_year",
            "description"   => esc_html__("Enter year EX.: 2017", 'oconnor'),
            'dependency'    => array(
                'element'       => 'time_is_up',
                'value'         => array( "custom_date_remove", "custom_date_hide", "custom_date_nothing")
            ),
            'edit_field_class' => 'vc_col-sm-2',
        ),
         array(
            "type"          => "textfield",
            "heading"       => esc_html__("Month", 'oconnor'),
            "param_name"    => "countdown_month",
            "description"   => esc_html__("Enter month EX.: 08", 'oconnor'),
            'dependency'    => array(
                'element'       => 'time_is_up',
                'value'         => array( "custom_date_remove", "custom_date_hide", "custom_date_nothing")
            ),
            'edit_field_class' => 'vc_col-sm-2',
        ),
          array(
            "type"          => "textfield",
            "heading"       => esc_html__("Day", 'oconnor'),
            "param_name"    => "countdown_day",
            "description"   => esc_html__("Enter day EX.: 20", 'oconnor'),
            'dependency'    => array(
                'element'       => 'time_is_up',
                'value'         => array( "custom_date_remove", "custom_date_hide", "custom_date_nothing")
            ),
            'edit_field_class' => 'vc_col-sm-2',
        ),
            array(
            "type"          => "textfield",
            "heading"       => esc_html__("Hours", 'oconnor'),
            "param_name"    => "countdown_hours",
            "description"   => esc_html__("Enter hours EX.: 13", 'oconnor'),
            'dependency'    => array(
                'element'       => 'time_is_up',
                'value'         => array( "custom_date_remove", "custom_date_hide", "custom_date_nothing")
            ),
            'edit_field_class' => 'vc_col-sm-2',
        ),
          array(
            "type"          => "textfield",
            "heading"       => esc_html__("Minutes", 'oconnor'),
            "param_name"    => "countdown_min",
            "description"   => esc_html__("Enter min. EX.: 24", 'oconnor'),
            'dependency'    => array(
                'element'       => 'time_is_up',
                'value'         => array( "custom_date_remove", "custom_date_hide", "custom_date_nothing")
            ),
            'edit_field_class' => 'vc_col-sm-2',
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

        array(
            "type"          => "backend_divider",
            "heading"       => esc_html__("Countdown Show:", 'oconnor'),
            "param_name"    => "backend_divider",
            "group"         => esc_html__( "Countdown", 'oconnor' ),
        ),
        array(
            'type'          => 'gt3_on_off',
            'heading'       => esc_html__( 'Show Days?', 'oconnor' ),
            'param_name'    => 'show_day',
            'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
            'std'           => 'true',
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-3',
        ),
        array(
            'type'          => 'gt3_on_off',
            'heading'       => esc_html__( 'Show Hours?', 'oconnor' ),
            'param_name'    => 'show_hours',
            'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
            'std'           => 'yes',
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-3',
        ),
        array(
            'type'          => 'gt3_on_off',
            'heading'       => esc_html__( 'Show Minutes?', 'oconnor' ),
            'param_name'    => 'show_minutes',
            'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
            'std'           => 'yes',
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-3',
        ),
        array(
            'type'          => 'gt3_on_off',
            'heading'       => esc_html__( 'Show Seconds?', 'oconnor' ),
            'param_name'    => 'show_seconds',
            'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
            'std'           => 'yes',
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-3',
        ),
        array(
            "type"          => "backend_divider",
            "heading"       => esc_html__("Countdown Style:", 'oconnor'),
            "param_name"    => "backend_divider",
            "group"         => esc_html__( "Countdown", 'oconnor' ),
        ),
        array(
            "type"          => 'gt3_custom_select',
            "class"         => "",
            "heading"       => esc_html__("Size", 'oconnor'),
            "param_name"    => "size",
            'options'         => array(
                esc_html__("Small",'oconnor')      => "small",
                esc_html__("Medium",'oconnor')     => "medium",
                esc_html__("Large",'oconnor')      => "large",
                esc_html__("Extra Large",'oconnor')=> "e_large",
            ),
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-12',
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Align', 'oconnor' ),
            'param_name'    => 'align',
            "value"         => array(
                esc_html__( 'left', 'oconnor' )    => 'left',
                esc_html__( 'center', 'oconnor' )  => 'center',
                esc_html__( 'right', 'oconnor' )   => 'right',
            ),
            'std'           => 'right',
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type'          => 'gt3_on_off',
            'heading'       => esc_html__( 'Use Box Shadow?', 'oconnor' ),
            'param_name'    => 'box_shadow',
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
            'std'               => 'no',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Countdown Background", 'oconnor'),
            "param_name"    => "counter_bg",
            "value"         => "#ffffff",
            'save_always'   => true,
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            "type"          => "colorpicker",
            "class"         => "",
            "heading"       => esc_html__("Counter Value Color", 'oconnor'),
            "param_name"    => "color",
            "value"         => "#27323d",
            "description"   => esc_html__("Select color for this item.", 'oconnor'),
            'save_always'   => true,
            "group"         => esc_html__( "Countdown", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Countdown Option end


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
            'value'         => 'fa fa-adjust', // default value to backend editor admin_label
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
            'value'         => '14',
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
            'value'         => '14',
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
            "value"         => esc_attr(gt3_option("theme-custom-color")),
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
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_html__("Text Color", 'oconnor'),
            "param_name" => "btn_text_color",
            "value" => "#ffffff",
            "description" => esc_html__("Select custom text color for button.", 'oconnor'),
            'save_always' => true,
            'dependency' => array(
                'element' => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group" => esc_html__( "Btn Theme", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button Hover Bg
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_html__("Button Hover Background", 'oconnor'),
            "param_name" => "btn_bg_color_hover",
            "value" => "#ffffff",
            "description" => esc_html__("Select custom background for hover button.", 'oconnor'),
            'dependency' => array(
                'element' => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group" => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always' => true,
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button Hover text-color
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_html__("Button Hover Text Color", 'oconnor'),
            "param_name" => "btn_text_color_hover",
            "value" => esc_attr(gt3_option("theme-custom-color")),
            "description" => esc_html__("Select custom text color for hover button.", 'oconnor'),
            'dependency' => array(
                'element' => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group" => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always' => true,
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button icon-color
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_html__("Icon Color", 'oconnor'),
            "param_name" => "btn_icon_color",
            "value" => "#ffffff",
            "description" => esc_html__("Select icon color for button.", 'oconnor'),
            'dependency' => array(
                'element' => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group" => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always' => true,
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button Hover icon-color
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_html__("Button Hover Icon Color", 'oconnor'),
            "param_name" => "btn_icon_color_hover",
            "value" => "#ffffff",
            "description" => esc_html__("Select icon color for hover button.", 'oconnor'),
            'dependency' => array(
                'element' => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group" => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always' => true,
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button border-color
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_html__("Button Border Color", 'oconnor'),
            "param_name" => "btn_border_color",
            "value" => esc_attr(gt3_option("theme-custom-color")),
            "description" => esc_html__("Select custom border color for button.", 'oconnor'),
            'save_always' => true,
            'dependency' => array(
                'element' => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            "group" => esc_html__( "Btn Theme", 'oconnor' ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        // Button Hover border-color
        array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_html__("Button Hover Border Color", 'oconnor'),
            "param_name" => "btn_border_color_hover",
            "value" => esc_attr(gt3_option("theme-custom-color")),
            "description" => esc_html__("Select custom border color for hover button.", 'oconnor'),
            "group" => esc_html__( "Btn Theme", 'oconnor' ),
            'save_always' => true,
            'dependency' => array(
                'element' => 'use_theme_button',
                'value_not_equal_to' => 'yes',
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
    );

    if ((int)$count_posts->publish > 20) {
        array_unshift($options_array,
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Product ID', 'oconnor' ),
                'param_name'    => 'id',
                'admin_label'   => true,
                'description'   => esc_html__( 'Enter product ID', 'oconnor' ),
            )
        );
    }else{
        array_unshift($options_array,
            array(
                'type'          => 'autocomplete',
                'heading'       => esc_html__( 'Identificator', 'oconnor' ),
                'param_name'    => 'id',
                'admin_label'   => true,
                'description'   => esc_html__( 'Enter product ID or product SKU or product title to see suggestions', 'oconnor' ),
                'settings'      => array( 'values' => gt3_generate_autocomplite('product') ),
            )
        );
    }

    if (function_exists('vc_map')) {
    // Add list item
        vc_map(array(
            'name'          => esc_html__( 'GT3 Product Countdown', 'oconnor' ),
            'base'          => 'gt3_product_countdown',
            "icon"          => 'gt3_icon',
            "category"      => esc_html__('GT3 Modules', 'oconnor'),
            'description'   => esc_html__( 'Show a single product by ID or SKU', 'oconnor' ),
            'params'        => $options_array,
        ));

        if (class_exists('WPBakeryShortCode')) {
            class WPBakeryShortCode_Gt3_Product_Countdown extends WPBakeryShortCode {

            }
        }
    }
}