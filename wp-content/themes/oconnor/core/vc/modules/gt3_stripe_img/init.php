<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_stripe_columns',
        'name' => esc_html__('Stripe Columns', 'oconnor'),
        'description' => esc_html__('Display Stripe Columns', 'oconnor'),
        'category' => esc_html__('GT3 Modules', 'oconnor'),
        'icon' => 'gt3_icon',
        'js_view' => 'VcColumnView',
        "as_parent" => array('only' => 'gt3_stripe_column_item'),
        "content_element" => true,
        'show_settings_on_create' => false,
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Items Height', 'oconnor'),
                'param_name' => 'items_height',
                'value' => '600',
                'description' => esc_html__( 'Enter height in pixels.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
                'save_always' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'oconnor'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            ),
            // Text Font styles
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'oconnor'),
                'param_name' => 'title_size',
                'value' => '24',
                'description' => esc_html__( 'Enter Title font-size in pixels.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Title Color", 'oconnor'),
                "param_name" => "title_color",
                "value" => "",
                "description" => esc_html__("Select title color for this item.", 'oconnor'),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Text Font Size', 'oconnor'),
                'param_name' => 'content_size',
                'value' => '16',
                'description' => esc_html__( 'Content Text font-size in pixels.', 'oconnor' ),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Content Text Color", 'oconnor'),
                "param_name" => "content_color",
                "value" => "",
                "description" => esc_html__("Select Content Text color for this item.", 'oconnor'),
                "group" => esc_html__( "Styling", 'oconnor' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));
    
    // Testimonial item options
    vc_map(array(
        "name" => esc_html__("Stripe Item", 'oconnor'),
        "base" => "gt3_stripe_column_item",
        "class" => "gt3_info_list",
        "category" => esc_html__('GT3 Modules', 'oconnor'),
        'icon' => 'gt3_icon',
        "content_element" => true,
        "as_child" => array('only' => 'gt3_stripe_columns'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", 'oconnor'),
                "param_name" => "title",
                "value" => "",
                "description" => esc_html__("Provide a title for this list item.", 'oconnor'),
                'admin_label' => true,
            ),
            // Image Section
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'oconnor' ),
                'param_name' => 'image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'oconnor' ),
                'admin_label' => true,
            ),
            
            // Link
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'oconnor' ),
                'param_name' => 'link',
                "description" => esc_html__("Add link to button.", 'oconnor')
            ),
            array(
                "type" => "textarea_html",
                "class" => "",
                "heading" => esc_html__("Description", 'oconnor'),
                "param_name" => "content",
                "value" => "",
                "description" => esc_html__("Description about this list item", 'oconnor')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'oconnor'),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            )
        )
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Stripe_Columns extends WPBakeryShortCodesContainer
        {
        }
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Stripe_Column_Item extends WPBakeryShortCode
        {
        }
    }
}