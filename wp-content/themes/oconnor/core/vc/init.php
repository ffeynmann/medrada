<?php

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!class_exists('Vc_Manager')) {
    return;
}

/**
 * @param $fonts_list
 * @return array
 */
function gt3_vc_google_fonts_get_fonts_filter($fonts_list) {
    foreach ($fonts_list as $item) {
        if ($item->font_family === 'Montserrat') {
            $item->font_types = '100 thin:100:normal,200 extra-light:200:normal,300 light:300:normal,400 regular:400:normal,500 medium:500:normal,600 semi-bold:600:normal,700 bold:700:normal,800 extra-bold:800:normal,900 black:900:normal';
            break;
        }
    }

    return $fonts_list;
}

add_filter('vc_google_fonts_get_fonts_filter', 'gt3_vc_google_fonts_get_fonts_filter', 10, 1);

require_once get_template_directory() . '/core/vc/custom_types/gt3_on_off.php';
require_once get_template_directory() . '/core/vc/custom_types/gt3_packery_layout_select.php';
require_once get_template_directory() . '/core/vc/custom_types/gt3_element_pos.php';
require_once get_template_directory() . '/core/vc/custom_types/image_select.php';
require_once get_template_directory() . '/core/vc/custom_types/gt3_multi_select.php';
require_once get_template_directory() . '/core/vc/custom_types/custom_select.php';

require_once get_template_directory() . '/core/vc/fonts/gt3_custom_fonts.php';

add_action('vc_before_init', 'gt3_vcSetAsTheme');
function gt3_vcSetAsTheme() {
    vc_set_as_theme($disable_updater = true);
}

/* List of Active VC Modules */
$gt3_vc_modules = array(
    'gt3_banner',
    'gt3_button',
    'gt3_carousel',
    'gt3_carousel_thumbnails',
    'gt3_countdown',
    'gt3_counter',
    'gt3_custom_text',
    'gt3_featured_posts',
    'gt3_gallery_packery',
    'gt3_heading_label',
    'gt3_hotspot',
    'gt3_icon_box',
    'gt3_image_box',
    'gt3_link_layer',
    'gt3_message_box',
    'gt3_price_block',
    'gt3_process_bar',
    'gt3_spacing',
    'gt3_spot_image',
    'gt3_sticky_side',
    'gt3_stripe_img',
    'gt3_testimonials',
    'gt3_video_popup',
);

if (class_exists('WooCommerce')) {
    array_push($gt3_vc_modules, 'gt3_products_tab', 'gt3_shop_list', 'gt3_product_shop', 'gt3_product_countdown', 'gt3_single_product_tab');
}

if (class_exists('StormTwitter')) {
    array_push($gt3_vc_modules, 'gt3_twitter');
}

foreach ($gt3_vc_modules as $gt3_vc_module) {
    require_once get_template_directory() . '/core/vc/modules/' . $gt3_vc_module . '/init.php';
}

/* List of Active VC Params */
$gt3_vc_params = array(
    'param_hotspot',
);

foreach ($gt3_vc_params as $gt3_vc_param) {
    require_once get_template_directory() . '/core/vc/params/' . $gt3_vc_param . '/init.php';
}


vc_remove_param('vc_tta_tabs', 'style');
vc_remove_param('vc_tta_tabs', 'shape');
vc_remove_param('vc_tta_tabs', 'color');
vc_remove_param('vc_tta_tabs', 'spacing');
vc_remove_param('vc_tta_tabs', 'gap');
vc_remove_param('vc_tta_tabs', 'pagination_style');
vc_remove_param('vc_tta_tabs', 'pagination_color');
vc_remove_param('vc_tta_tabs', 'no_fill_content_area');


vc_remove_param('vc_tta_tour', 'style');
vc_remove_param('vc_tta_tour', 'shape');
vc_remove_param('vc_tta_tour', 'color');
vc_remove_param('vc_tta_tour', 'spacing');
vc_remove_param('vc_tta_tour', 'gap');
vc_remove_param('vc_tta_tour', 'pagination_style');
vc_remove_param('vc_tta_tour', 'pagination_color');
vc_remove_param('vc_tta_tour', 'no_fill_content_area');

vc_remove_param('vc_tta_accordion', 'color');
vc_remove_param('vc_tta_accordion', 'spacing');
vc_remove_param('vc_tta_accordion', 'gap');
//vc_remove_param( 'vc_tta_accordion', 'shape' );
vc_remove_param('vc_tta_accordion', 'no_fill');
vc_add_param('vc_tta_accordion', array(
    'type'       => 'dropdown',
    'heading'    => "Accordion Style",
    'param_name' => 'style',
    'value'      => array(
        esc_html__('Classic', 'oconnor')   => "classic",
        esc_html__('Solid', 'oconnor')     => "accordion_solid",
        esc_html__('In Border', 'oconnor') => "accordion_bordered",
    )
));
vc_add_param('vc_tta_accordion', array(
    'type'       => 'checkbox',
    'heading'    => "Accordion On Dark Background",
    'param_name' => 'shape',
));


vc_remove_param('vc_toggle', 'use_custom_heading');
vc_remove_param('vc_toggle', 'custom_font_container');
vc_remove_param('vc_toggle', 'custom_use_theme_fonts');
vc_remove_param('vc_toggle', 'custom_google_fonts');
vc_remove_param('vc_toggle', 'custom_css_animation');
vc_remove_param('vc_toggle', 'custom_el_class');

vc_add_param('vc_toggle', array(
    'type'       => 'dropdown',
    'heading'    => "Style",
    'param_name' => 'style',
    'value'      => array(
        esc_html__('Classic', 'oconnor')   => "classic",
        esc_html__('Solid', 'oconnor')     => "accordion_solid",
        esc_html__('In Border', 'oconnor') => "accordion_bordered",
    )
));
vc_add_param('vc_toggle', array(
    'type'       => 'dropdown',
    'heading'    => "Icon",
    "param_name" => "color",
    'value'      => array(
        esc_html__('None', 'oconnor')     => "none",
        esc_html__('Chevron', 'oconnor')  => "chevron",
        esc_html__('Plus', 'oconnor')     => "plus",
        esc_html__('Triangle', 'oconnor') => "triangle",
    )
));
vc_add_param('vc_toggle', array(
    'type'       => 'dropdown',
    'heading'    => "Icon Position",
    "param_name" => "size",
    'value'      => array(
        esc_html__('Left', 'oconnor')  => "left",
        esc_html__('Right', 'oconnor') => "right",
    )
));

vc_add_param("vc_separator", array(
    'type'        => 'dropdown',
    'heading'     => esc_html__('Element width', 'oconnor'),
    'param_name'  => 'el_width',
    'value'       => array(
        '100%'  => '',
        '90%'   => '90',
        '80%'   => '80',
        '70%'   => '70',
        '60%'   => '60',
        '50%'   => '50',
        '40%'   => '40',
        '30%'   => '30',
        '20%'   => '20',
        '10%'   => '10',
        '150px' => '150px',
        '125px' => '125px',
        '100px' => '100px',
        '95px'  => '95px',
        '90px'  => '90px',
        '85px'  => '85px',
        '80px'  => '80px',
        '75px'  => '75px',
        '70px'  => '70px',
        '60px'  => '60px',
        '50px'  => '50px',
        '40px'  => '40px',
        '30px'  => '30px',
        '25px'  => '25px',
    ),
    'description' => esc_html__('Select separator width (percentage or px).', 'oconnor'),
));

vc_add_params('vc_row', array(
    array(
        'type'       => 'checkbox',
        'heading'    => 'Box Shadow',
        'param_name' => 'box_shadow',
    ),
    array(
        'type'       => 'checkbox',
        'heading'    => 'Higher z-index',
        'param_name' => 'z_index',
    ),

    array(
        'type'             => 'gt3_on_off',
        'heading'          => esc_html__('Hide border for row', 'oconnor'),
        'param_name'       => 'hide_border',
        'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
        'std'              => 'no',
        'edit_field_class' => 'vc_col-sm-6',
        'group'            => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Top since', 'oconnor'),
        'param_name' => 'hide_border_top',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Right since', 'oconnor'),
        'param_name' => 'hide_border_right',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Bottom since', 'oconnor'),
        'param_name' => 'hide_border_bottom',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Left since', 'oconnor'),
        'param_name' => 'hide_border_left',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
));
vc_add_params('vc_row_inner', array(
    array(
        'type'       => 'checkbox',
        'heading'    => 'Box Shadow',
        'param_name' => 'box_shadow',
    ),
    array(
        'type'       => 'checkbox',
        'heading'    => 'Higher z-index',
        'param_name' => 'z_index',
    ),
    array(
        'type'             => 'gt3_on_off',
        'heading'          => esc_html__('Hide border for row inner', 'oconnor'),
        'param_name'       => 'hide_border',
        'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
        'std'              => 'no',
        'edit_field_class' => 'vc_col-sm-6',
        'group'            => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Top since', 'oconnor'),
        'param_name' => 'hide_border_top',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Right since', 'oconnor'),
        'param_name' => 'hide_border_right',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Bottom since', 'oconnor'),
        'param_name' => 'hide_border_bottom',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Left since', 'oconnor'),
        'param_name' => 'hide_border_left',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
));

vc_add_params('vc_column', array(
    array(
        'type'             => 'gt3_on_off',
        'heading'          => esc_html__('Hide border for column', 'oconnor'),
        'param_name'       => 'hide_border',
        'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
        'std'              => 'no',
        'edit_field_class' => 'vc_col-sm-6',
        'group'            => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Top since', 'oconnor'),
        'param_name' => 'hide_border_top',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Right since', 'oconnor'),
        'param_name' => 'hide_border_right',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Bottom since', 'oconnor'),
        'param_name' => 'hide_border_bottom',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Left since', 'oconnor'),
        'param_name' => 'hide_border_left',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
));

vc_add_params('vc_column_inner', array(
    array(
        'type'             => 'gt3_on_off',
        'heading'          => esc_html__('Hide border for inner column', 'oconnor'),
        'param_name'       => 'hide_border',
        'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
        'std'              => 'no',
        'edit_field_class' => 'vc_col-sm-6',
        'group'            => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Top since', 'oconnor'),
        'param_name' => 'hide_border_top',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Right since', 'oconnor'),
        'param_name' => 'hide_border_right',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Bottom since', 'oconnor'),
        'param_name' => 'hide_border_bottom',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
    array(
        'type'       => 'gt3_custom_select',
        'heading'    => esc_html__('Hide Border Left since', 'oconnor'),
        'param_name' => 'hide_border_left',
        'options'    => array(
            esc_html__('Default', 'oconnor')  => 'default',
            esc_html__('Notebook', 'oconnor') => 'notebook',
            esc_html__('Tablet', 'oconnor')   => 'tablet',
            esc_html__('Mobile', 'oconnor')   => 'mobile',
        ),
        'dependency' => array(
            'element' => 'hide_border',
            'value'   => 'yes',
        ),
        'group'      => esc_html__('Design Options', 'oconnor'),
    ),
));

vc_add_param('vc_images_carousel', array(
    'type'        => 'dropdown',
    'heading'     => 'Select Arrow Style',
    'description' => esc_html__('Select style for prev/next buttons.', 'oconnor'),
    'param_name'  => 'arrow_style',
    'value'       => array(
        esc_html__('Default', 'oconnor') => 'default',
        esc_html__('Rounded', 'oconnor') => 'rounded',
        esc_html__('Round', 'oconnor')   => 'round',
    ),
    'dependency'  => array(
        'element'            => 'hide_prev_next_buttons',
        'value_not_equal_to' => 'yes',
    ),
));
