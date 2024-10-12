<?php

if (!class_exists('Gt3_oconnor_core')) {
    return;
}

$theme    = wp_get_theme();
$opt_name = 'oconnor';

$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => $theme->get('Name'),
    'display_version'      => $theme->get('Version'),
    'menu_type'            => 'menu',
    'allow_sub_menu'       => true,
    'menu_title'           => esc_html__('Theme Options', 'oconnor'),
    'page_title'           => esc_html__('Theme Options', 'oconnor'),
    'google_api_key'       => '',
    'google_update_weekly' => false,
    'async_typography'     => true,
    'admin_bar'            => true,
    'admin_bar_icon'       => 'dashicons-admin-generic',
    'admin_bar_priority'   => 50,
    'global_variable'      => '',
    'dev_mode'             => false,
    'update_notice'        => true,
    'customizer'           => false,
    'page_priority'        => null,
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => 'dashicons-admin-generic',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => '',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true,
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    'output_tag'           => true,
    'database'             => '',
    'use_cdn'              => true,
);


Redux::setArgs($opt_name, $args);

// -> START Basic Fields
Redux::setSection($opt_name, array(
    'title'            => esc_html__('General', 'oconnor'),
    'id'               => 'general',
    'customizer_width' => '400px',
    'icon'             => 'el el-home',
    'fields'           => array(
        array(
            'id'      => 'responsive',
            'type'    => 'switch',
            'title'   => esc_html__('Responsive', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'      => 'page_comments',
            'type'    => 'switch',
            'title'   => esc_html__('Page Comments', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'      => 'preloader',
            'type'    => 'switch',
            'title'   => esc_html__('Preloader', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'          => 'preloader_background',
            'type'        => 'color',
            'title'       => esc_html__('Preloader Background', 'oconnor'),
            'subtitle'    => esc_html__('Set Preloader Background', 'oconnor'),
            'default'     => '#ffffff',
            'transparent' => false,
            'required'    => array('preloader', '=', '1'),
        ),
        array(
            'id'          => 'preloader_item_color',
            'type'        => 'color',
            'title'       => esc_html__('Preloader Item Color', 'oconnor'),
            'subtitle'    => esc_html__('Set Plreloader Item Color', 'oconnor'),
            'default'     => '#000000',
            'transparent' => false,
            'required'    => array('preloader', '=', '1'),
        ),
        array(
            'id'       => 'preloader_item_logo',
            'type'     => 'media',
            'title'    => esc_html__('Preloader Logo', 'oconnor'),
            'required' => array('preloader', '=', '1'),
        ),
        array(
            'id'       => 'preloader_full',
            'type'     => 'switch',
            'title'    => esc_html__('Preloader Fullscreen', 'oconnor'),
            'default'  => true,
            'required' => array('preloader', '=', '1'),
        ),
        array(
            'id'      => 'back_to_top',
            'type'    => 'switch',
            'title'   => esc_html__('Back to Top', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'      => 'add_default_typography_spacing',
            'type'    => 'switch',
            'title'   => esc_html__('Add Default Typography Spacings', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'       => 'custom_js',
            'type'     => 'ace_editor',
            'title'    => esc_html__('Custom JS', 'oconnor'),
            'subtitle' => esc_html__('Paste your JS code here.', 'oconnor'),
            'mode'     => 'javascript',
            'theme'    => 'chrome',
            'default'  => ''
        ),
        array(
            'id'       => 'header_custom_js',
            'type'     => 'ace_editor',
            'title'    => esc_html__('Custom JS', 'oconnor'),
            'subtitle' => esc_html__('Code to be added inside HEAD tag', 'oconnor'),
            'mode'     => 'html',
            'theme'    => 'chrome',
            'default'  => ''
        ),
    ),
));


// HEADER
if (function_exists('gt3_header_presets')) {
    $presets         = gt3_header_presets();
    $header_preset_1 = $presets['header_preset_1'];
}

function gt3_getMenuList() {
    $menus     = wp_get_nav_menus();
    $menu_list = array();

    foreach ($menus as $menu => $menu_obj) {
        $menu_list[$menu_obj->slug] = $menu_obj->name;
    }
    return $menu_list;
}

$def_header_option = array(
    'all_item'      => array(
        'title'   => 'All Item',
        'layout'  => 'all',
        'content' => array(
            'search'         => array(
                'title'        => 'Search',
                'has_settings' => false,
            ),
            'login'          => array(
                'title'        => 'Login',
                'has_settings' => false,
            ),
            'cart'           => array(
                'title'        => 'Cart',
                'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title'        => 'Burger Sidebar',
                'has_settings' => true,
            ),
            'text1'          => array(
                'title'        => 'Text/HTML 1',
                'has_settings' => true,
            ),
            'text2'          => array(
                'title'        => 'Text/HTML 2',
                'has_settings' => true,
            ),

            'text3' => array(
                'title'        => 'Text/HTML 3',
                'has_settings' => true,
            ),
            'text4' => array(
                'title'        => 'Text/HTML 4',
                'has_settings' => true,
            ),

            'text5'      => array(
                'title'        => 'Text/HTML 5',
                'has_settings' => true,
            ),
            'text6'      => array(
                'title'        => 'Text/HTML 6',
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left'      => array(
        'title'        => 'Top Left',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'top_center'    => array(
        'title'        => 'Top Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'top_right'     => array(
        'title'        => 'Top Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'middle_left'   => array(
        'title'        => 'Middle Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'content'      => array(
            'logo' => array(
                'title'        => 'Logo',
                'has_settings' => true,
            ),
        ),
    ),
    'middle_center' => array(
        'title'        => 'Middle Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'middle_right'  => array(
        'title'        => 'Middle Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(
            'menu' => array(
                'title'        => 'Menu',
                'has_settings' => true,
            ),
        ),
    ),
    'bottom_left'   => array(
        'title'        => 'Bottom Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'content'      => array(),
    ),
    'bottom_center' => array(
        'title'        => 'Bottom Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'bottom_right'  => array(
        'title'        => 'Bottom Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),

    /// tablet
    'all_item__tablet' => array(
        'title' => 'All Item',
        'layout' => 'all',
        'extra_class' => 'tablet',
        'content' => array(
            'logo' => array(
                'title'        => 'Logo',
                'has_settings' => true,
            ),
            'menu' => array(
                'title'        => 'Menu',
                'has_settings' => true,
            ),
            'search' => array(
                'title' => 'Search',
                'has_settings' => false,
            ),
            'login' => array(
                'title' => 'Login',
                'has_settings' => false,
            ),
            'cart' => array(
                'title' => 'Cart',
                'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title' => 'Burger Sidebar',
                'has_settings' => true,
            ),
            'text1' => array(
                'title' => 'Text/HTML 1',
                'has_settings' => true,
            ),
            'text2' => array(
                'title' => 'Text/HTML 2',
                'has_settings' => true,
            ),

            'text3' => array(
                'title' => 'Text/HTML 3',
                'has_settings' => true,
            ),
            'text4' => array(
                'title' => 'Text/HTML 4',
                'has_settings' => true,
            ),

            'text5' => array(
                'title' => 'Text/HTML 5',
                'has_settings' => true,
            ),
            'text6' => array(
                'title' => 'Text/HTML 6',
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left__tablet'      => array(
        'title'        => 'Top Left',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'top_center__tablet'    => array(
        'title'        => 'Top Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'top_right__tablet'     => array(
        'title'        => 'Top Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_left__tablet'   => array(
        'title'        => 'Middle Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_center__tablet' => array(
        'title'        => 'Middle Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_right__tablet'  => array(
        'title'        => 'Middle Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_left__tablet'   => array(
        'title'        => 'Bottom Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_center__tablet' => array(
        'title'        => 'Bottom Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_right__tablet'  => array(
        'title'        => 'Bottom Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),


    /// mobile
    'all_item__mobile' => array(
        'title' => 'All Item',
        'layout' => 'all',
        'extra_class' => 'mobile',
        'content' => array(
            'logo' => array(
                'title'        => 'Logo',
                'has_settings' => true,
            ),
            'menu' => array(
                'title'        => 'Menu',
                'has_settings' => true,
            ),
            'search' => array(
                'title' => 'Search',
                'has_settings' => false,
            ),
            'login' => array(
                'title' => 'Login',
                'has_settings' => false,
            ),
            'cart' => array(
                'title' => 'Cart',
                'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title' => 'Burger Sidebar',
                'has_settings' => true,
            ),
            'text1' => array(
                'title' => 'Text/HTML 1',
                'has_settings' => true,
            ),
            'text2' => array(
                'title' => 'Text/HTML 2',
                'has_settings' => true,
            ),

            'text3' => array(
                'title' => 'Text/HTML 3',
                'has_settings' => true,
            ),
            'text4' => array(
                'title' => 'Text/HTML 4',
                'has_settings' => true,
            ),

            'text5' => array(
                'title' => 'Text/HTML 5',
                'has_settings' => true,
            ),
            'text6' => array(
                'title' => 'Text/HTML 6',
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left__mobile'      => array(
        'title'        => 'Top Left',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'top_center__mobile'    => array(
        'title'        => 'Top Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'top_right__mobile'     => array(
        'title'        => 'Top Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_left__mobile'   => array(
        'title'        => 'Middle Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_center__mobile' => array(
        'title'        => 'Middle Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_right__mobile'  => array(
        'title'        => 'Middle Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_left__mobile'   => array(
        'title'        => 'Bottom Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_center__mobile' => array(
        'title'        => 'Bottom Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_right__mobile'  => array(
        'title'        => 'Bottom Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
);

$options = array(
    array(
        'id'         => 'gt3_header_builder_id',
        'type'       => 'gt3_header_builder',
        'full_width' => true,
        'presets' => 'default',
        'reload_on_change' => true,
        'options'    => array(
            'all_item'      => array(
                'title'   => 'All Item',
                'layout'  => 'all',
                'content' => array(
                    'search'         => array(
                        'title'        => 'Search',
                        'has_settings' => false,
                    ),
                    'login'          => array(
                        'title'        => 'Login',
                        'has_settings' => false,
                    ),
                    'cart'           => array(
                        'title'        => 'Cart',
                        'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title'        => 'Burger Sidebar',
                        'has_settings' => true,
                    ),
                    'text1'          => array(
                        'title'        => 'Text/HTML 1',
                        'has_settings' => true,
                    ),
                    'text2'          => array(
                        'title'        => 'Text/HTML 2',
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title'        => 'Text/HTML 3',
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title'        => 'Text/HTML 4',
                        'has_settings' => true,
                    ),

                    'text5'      => array(
                        'title'        => 'Text/HTML 5',
                        'has_settings' => true,
                    ),
                    'text6'      => array(
                        'title'        => 'Text/HTML 6',
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title'        => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title'        => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title'        => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title'        => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title'        => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title'        => '|',
                        'has_settings' => true,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),
            'top_left'      => array(
                'title'        => 'Top Left',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'content'      => array(),
            ),
            'top_center'    => array(
                'title'        => 'Top Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'content'      => array(),
            ),
            'top_right'     => array(
                'title'        => 'Top Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'content'      => array(),
            ),
            'middle_left'   => array(
                'title'        => 'Middle Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'content'      => array(
                    'logo' => array(
                        'title'        => 'Logo',
                        'has_settings' => true,
                    ),
                ),
            ),
            'middle_center' => array(
                'title'        => 'Middle Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'content'      => array(),
            ),
            'middle_right'  => array(
                'title'        => 'Middle Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'content'      => array(
                    'menu' => array(
                        'title'        => 'Menu',
                        'has_settings' => true,
                    ),
                ),
            ),
            'bottom_left'   => array(
                'title'        => 'Bottom Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'content'      => array(),
            ),
            'bottom_center' => array(
                'title'        => 'Bottom Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'content'      => array(),
            ),
            'bottom_right'  => array(
                'title'        => 'Bottom Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'content'      => array(),
            ),

            /// tablet
            'all_item__tablet' => array(
                'title' => 'All Item',
                'layout' => 'all',
                'extra_class' => 'tablet',
                'content' => array(
                    'logo' => array(
                        'title'        => 'Logo',
                        'has_settings' => true,
                    ),
                    'menu' => array(
                        'title'        => 'Menu',
                        'has_settings' => true,
                    ),
                    'search' => array(
                        'title' => 'Search',
                        'has_settings' => false,
                    ),
                    'login' => array(
                        'title' => 'Login',
                        'has_settings' => false,
                    ),
                    'cart' => array(
                        'title' => 'Cart',
                        'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => 'Burger Sidebar',
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => 'Text/HTML 1',
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => 'Text/HTML 2',
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title' => 'Text/HTML 3',
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => 'Text/HTML 4',
                        'has_settings' => true,
                    ),

                    'text5' => array(
                        'title' => 'Text/HTML 5',
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => 'Text/HTML 6',
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),


            'top_left__tablet'      => array(
                'title'        => 'Top Left',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'top_center__tablet'    => array(
                'title'        => 'Top Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'top_right__tablet'     => array(
                'title'        => 'Top Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_left__tablet'   => array(
                'title'        => 'Middle Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_center__tablet' => array(
                'title'        => 'Middle Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_right__tablet'  => array(
                'title'        => 'Middle Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_left__tablet'   => array(
                'title'        => 'Bottom Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_center__tablet' => array(
                'title'        => 'Bottom Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_right__tablet'  => array(
                'title'        => 'Bottom Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),

            /// mobile
            'all_item__mobile' => array(
                'title' => 'All Item',
                'layout' => 'all',
                'extra_class' => 'mobile',
                'content' => array(
                    'logo' => array(
                        'title'        => 'Logo',
                        'has_settings' => true,
                    ),
                    'menu' => array(
                        'title'        => 'Menu',
                        'has_settings' => true,
                    ),
                    'search' => array(
                        'title' => 'Search',
                        'has_settings' => false,
                    ),
                    'login' => array(
                        'title' => 'Login',
                        'has_settings' => false,
                    ),
                    'cart' => array(
                        'title' => 'Cart',
                        'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => 'Burger Sidebar',
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => 'Text/HTML 1',
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => 'Text/HTML 2',
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title' => 'Text/HTML 3',
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => 'Text/HTML 4',
                        'has_settings' => true,
                    ),

                    'text5' => array(
                        'title' => 'Text/HTML 5',
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => 'Text/HTML 6',
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),
            'top_left__mobile'      => array(
                'title'        => 'Top Left',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'top_center__mobile'    => array(
                'title'        => 'Top Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'top_right__mobile'     => array(
                'title'        => 'Top Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_left__mobile'   => array(
                'title'        => 'Middle Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_center__mobile' => array(
                'title'        => 'Middle Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_right__mobile'  => array(
                'title'        => 'Middle Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_left__mobile'   => array(
                'title'        => 'Bottom Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_center__mobile' => array(
                'title'        => 'Bottom Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_right__mobile'  => array(
                'title'        => 'Bottom Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
        ),
        'default'    => $def_header_option,
    ),




    // MAIN HEADER SETTINGS
    array(
        'id'           => 'header_templates-start',
        'type'         => 'gt3_section',
        'title'        => esc_html__('Header Templates', 'oconnor'),
        'indent'       => false,
        'section_role' => 'start'
    ),

    //HEADER TEMPLATES
    array(
        'id'         => 'gt3_header_builder_presets',
        'type'       => 'gt3_presets',
        'presets'    => true,
        'full_width' => true,
        'title'      => esc_html__('Gt3 Preset', 'oconnor'),
        'subtitle'   => esc_html__('This allows you to set default header layout.', 'oconnor'),
        'default'    => array(
            '0' => array(
                'title'     => esc_html__('Default', 'oconnor'),
                'preset' => json_encode($def_header_option)
            ),
        ),
        'templates' => array(
            '1' => array(
                'alt'     => 'Header 1',
                'img'     => esc_url(ReduxFramework::$_url) . 'assets/img/header_1.jpg',
                'presets' => $header_preset_1
            ),
        ),
        'options' => array(),
    ),
    array(
        'id'           => 'header_templates-end',
        'type'         => 'gt3_section',
        'indent'       => false,
        'section_role' => 'end'
    ),

    // MAIN HEADER SETTINGS
    array(
        'id'           => 'main_header_settings-start',
        'type'         => 'gt3_section',
        'title'        => esc_html__('Header Main Settings', 'oconnor'),
        'indent'       => false,
        'section_role' => 'start'
    ),
    array(
        'id'       => 'header_full_width',
        'type'     => 'switch',
        'title'    => esc_html__('Full Width Header', 'oconnor'),
        'subtitle' => esc_html__('Set header content in full width layout', 'oconnor'),
        'default'  => false,
    ),
    array(
        'id'      => 'header_sticky',
        'type'    => 'switch',
        'title'   => esc_html__('Sticky Header', 'oconnor'),
        'default' => true,
    ),
    array(
        'id'       => 'header_sticky_mobile',
        'type'     => 'switch',
        'title'    => esc_html__('Sticky Header on Mobile', 'oconnor'),
        'default'  => false,
        'required' => array('header_sticky', '=', '1'),
    ),
    array(
        'id'       => 'header_sticky_appearance_style',
        'type'     => 'select',
        'title'    => esc_html__('Sticky Appearance Style', 'oconnor'),
        'options'  => array(
            'classic'    => esc_html__('Classic', 'oconnor'),
            'scroll_top' => esc_html__('Appearance only on scroll top', 'oconnor'),
        ),
        'required' => array('header_sticky', '=', '1'),
        'default'  => 'classic'
    ),
    array(
        'id'       => 'header_sticky_appearance_from_top',
        'type'     => 'select',
        'title'    => esc_html__('Sticky Header Appearance From Top of Page', 'oconnor'),
        'options'  => array(
            'auto'   => esc_html__('Auto', 'oconnor'),
            'custom' => esc_html__('Custom', 'oconnor'),
        ),
        'required' => array('header_sticky', '=', '1'),
        'default'  => 'auto'
    ),
    array(
        'id'             => 'header_sticky_appearance_number',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => esc_html__('Set the distance from the top of the page', 'oconnor'),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => 300,
        ),
        'required'       => array('header_sticky_appearance_from_top', '=', 'custom'),
    ),
    array(
        'id'       => 'header_sticky_shadow',
        'type'     => 'switch',
        'title'    => esc_html__('Sticky Header Bottom Shadow', 'oconnor'),
        'default'  => true,
        'required' => array('header_sticky', '=', '1'),
    ),
    array(
        'id'           => 'main_header_settings-end',
        'type'         => 'gt3_section',
        'indent'       => false,
        'section_role' => 'end'
    ),


    //LOGO SETTINGS
    array(
        'id'           => 'logo-start',
        'type'         => 'gt3_section',
        'title'        => esc_html__('Logo Settings', 'oconnor'),
        'indent'       => false,
        'section_role' => 'start'
    ),
    array(
        'id'    => 'header_logo',
        'type'  => 'media',
        'title' => esc_html__('Header Logo', 'oconnor'),
    ),
    array(
        'id'      => 'logo_height_custom',
        'type'    => 'switch',
        'title'   => esc_html__('Enable Logo Height', 'oconnor'),
        'default' => false,
    ),
    array(
        'id'             => 'logo_height',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => esc_html__('Set Logo Height', 'oconnor'),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => 50,
        ),
        'required'       => array('logo_height_custom', '=', '1'),
    ),
    array(
        'id'       => 'logo_max_height',
        'type'     => 'switch',
        'title'    => esc_html__('Don\'t limit maximum height', 'oconnor'),
        'default'  => false,
        'required' => array('logo_height_custom', '=', '1'),
    ),
    array(
        'id'             => 'sticky_logo_height',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => esc_html__('Set Sticky Logo Height', 'oconnor'),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => '',
        ),
        'required'       => array(
            array('logo_height_custom', '=', '1'),
            array('logo_max_height', '=', '1'),
        ),
    ),
    array(
        'id'    => 'logo_sticky',
        'type'  => 'media',
        'title' => esc_html__('Sticky Logo', 'oconnor'),
    ),
    array(
        'id'    => 'logo_mobile',
        'type'  => 'media',
        'title' => esc_html__('Mobile Logo', 'oconnor'),
    ),
    array(
        'id'             => 'logo_height_mobile',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => esc_html__('Set Logo Height on Mobile', 'oconnor'),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => 45,
        ),
//        'required'       => array('logo_mobile', '!=', ''),
    ),
    array(
        'id'           => 'logo-end',
        'type'         => 'gt3_section',
        'indent'       => false,
        'section_role' => 'end'
    ),

    // MENU
    array(
        'id'           => 'menu-start',
        'type'         => 'gt3_section',
        'title'        => esc_html__('Menu Settings', 'oconnor'),
        'indent'       => false,
        'section_role' => 'start'
    ),
    array(
        'id'      => 'menu_select',
        'type'    => 'select',
        'title'   => esc_html__('Select Menu', 'oconnor'),
        'options' => gt3_getMenuList(),
        'default' => 'left',
    ),
    array(
        'id'      => 'menu_ative_top_line',
        'type'    => 'switch',
        'title'   => esc_html__('Enable Active Menu Item Marker', 'oconnor'),
        'default' => false,
    ),
    array(
        'id'       => 'sub_menu_background',
        'type'     => 'color_rgba',
        'title'    => esc_html__('Sub Menu Background', 'oconnor'),
        'subtitle' => esc_html__('Set sub menu background color', 'oconnor'),
        'default'  => array(
            'color' => '#ffffff',
            'alpha' => '1',
            'rgba'  => 'rgba(255,255,255,1)'
        ),
        'mode'     => 'background',
    ),
    array(
        'id'          => 'sub_menu_color',
        'type'        => 'color',
        'title'       => esc_html__('Sub Menu Text Color', 'oconnor'),
        'subtitle'    => esc_html__('Set sub menu header text color', 'oconnor'),
        'default'     => '#272b2e',
        'transparent' => false,
    ),
    array(
        'id'           => 'menu-end',
        'type'         => 'gt3_section',
        'indent'       => false,
        'section_role' => 'end'
    ),

    // BURGER SIDEBAR
    array(
        'id'           => 'burger_sidebar-start',
        'type'         => 'gt3_section',
        'title'        => esc_html__('Burger Sidebar Settings', 'oconnor'),
        'indent'       => false,
        'section_role' => 'start'
    ),
    array(
        'id'    => 'burger_sidebar_select',
        'type'  => 'select',
        'title' => esc_html__('Select Sidebar', 'oconnor'),
        'data'  => 'sidebars',
    ),
    array(
        'id'           => 'burger_sidebar-end',
        'type'         => 'gt3_section',
        'indent'       => false,
        'section_role' => 'end'
    ),

);

$responsive_sections = array('','__tablet','__mobile');

$sections = array(
    'top_left'      => esc_html__('Top Left Settings', 'oconnor'),
    'top_center'    => esc_html__('Top Center Settings', 'oconnor'),
    'top_right'     => esc_html__('Top Right Settings', 'oconnor'),
    'middle_left'   => esc_html__('Middle Left Settings', 'oconnor'),
    'middle_center' => esc_html__('Middle Center Settings', 'oconnor'),
    'middle_right'  => esc_html__('Middle Right Settings', 'oconnor'),
    'bottom_left'   => esc_html__('Bottom Left Settings', 'oconnor'),
    'bottom_center' => esc_html__('Bottom Center Settings', 'oconnor'),
    'bottom_right'  => esc_html__('Bottom Right Settings', 'oconnor'),
);
// add align options to each section
$aligns = array();
foreach ($responsive_sections as $responsive_section) {
    foreach ($sections as $section => $section_translate) {
        $default = explode("_", $section);
        array_push($aligns,
            array(
                'id'           => $section.$responsive_section.'-start',
                'type'         => 'gt3_section',
                'title'        => $section_translate,
                'indent'       => false,
                'section_role' => 'start'
            ),
            array(
                'id'      => $section.$responsive_section.'-align',
                'type'    => 'select',
                'title'   => esc_html__('Item Align', 'oconnor'),
                'options' => array(
                    'left'   => esc_html__('Left', 'oconnor'),
                    'center' => esc_html__('Center', 'oconnor'),
                    'right'  => esc_html__('Right', 'oconnor'),
                ),
                'default' => !empty($default[1]) ? $default[1] : 'left',
            ),
            array(
                'id'           => $section.$responsive_section.'-end',
                'type'         => 'gt3_section',
                'indent'       => false,
                'section_role' => 'end'
            )
        );
    }
}


$side_opt = array();
$sides = array(
    'top'      => esc_html__('Top Header Settings', 'oconnor'),
    'middle'   => esc_html__('Middle Header Settings', 'oconnor'),
    'bottom'   => esc_html__('Bottom Header Settings', 'oconnor'),
);
foreach ($responsive_sections as $responsive_section) {
    foreach ($sides as $side => $section_translate) {
        array_push($side_opt,
            //TOP SIDE
            array(
                'id'           => 'side_'.$side.$responsive_section.'-start',
                'type'         => 'gt3_section',
                'title'        => $section_translate,
                'indent'       => false,
                'section_role' => 'start'
            ),
            array(
                'id'       => 'side_'.$side.$responsive_section.'_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Background', 'oconnor'),
                'subtitle' => esc_html__('Set background color', 'oconnor'),
                'default'  => array(
                    'color' => '#2a2e31',
                    'alpha' => '1',
                    'rgba'  => 'rgba(42,46,49,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'          => 'side_'.$side.$responsive_section.'_color',
                'type'        => 'color',
                'title'       => esc_html__('Text Color', 'oconnor'),
                'subtitle'    => esc_html__('Set text color', 'oconnor'),
                'default'     => '#ffffff',
                'transparent' => false,
            ),
            array(
                'id'             => 'side_'.$side.$responsive_section.'_height',
                'type'           => 'dimensions',
                'units'          => false,
                'units_extended' => false,
                'title'          => esc_html__('Height', 'oconnor'),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 100,
                )
            ),
            array(
                'id'      => 'side_'.$side.$responsive_section.'_border',
                'type'    => 'switch',
                'title'   => esc_html__('Set Bottom Border', 'oconnor'),
                'default' => false,
            ),
            array(
                'id'       => 'side_'.$side.$responsive_section.'_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Border Color', 'oconnor'),
                'subtitle' => esc_html__('Set border color', 'oconnor'),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.15',
                    'rgba'  => 'rgba(255,255,255,0.15)'
                ),
                'mode'     => 'background',
                'required' => array('side_'.$side.$responsive_section.'_border', '=', '1'),
            )
        );

        if (empty($responsive_section)) {
            array_push($side_opt,
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Section in Sticky Header?', 'oconnor'),
                    'default'  => false,
                    'required' => array('header_sticky', '=', '1'),
                ),
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_background_sticky',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Sticky Header Background', 'oconnor'),
                    'subtitle' => esc_html__('Set background color', 'oconnor'),
                    'default'  => array(
                        'color' => '#2a2e31',
                        'alpha' => '1',
                        'rgba'  => 'rgba(42, 46, 49,1)'
                    ),
                    'mode'     => 'background',
                    'required' => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'          => 'side_'.$side.$responsive_section.'_color_sticky',
                    'type'        => 'color',
                    'title'       => esc_html__('Sticky Header Text Color', 'oconnor'),
                    'subtitle'    => esc_html__('Set text color', 'oconnor'),
                    'default'     => '#ffffff',
                    'transparent' => false,
                    'required'    => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'             => 'side_'.$side.$responsive_section.'_height_sticky',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('Sticky Header Height', 'oconnor'),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 38,
                    ),
                    'required'       => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'      => 'side_'.$side.$responsive_section.'_mobile',
                    'type'    => 'switch',
                    'title'   => esc_html__('Show Section in Mobile Header?', 'oconnor'),
                    'default' => false,
                )
            );
        }

        array_push($side_opt,
            array(
                'id'           => 'side_'.$side.$responsive_section.'-end',
                'type'         => 'gt3_section',
                'indent'       => false,
                'section_role' => 'end'
            )
        );

    }
}

// text editor
$text_editor_count = 6;
$text_opt = array();
for ($i=1; $i <= $text_editor_count ; $i++) {
    array_push($text_opt,
        array(
            'id'           => 'text'.$i.'-start',
            'type'         => 'gt3_section',
            'title'        => esc_html__('Text / HTML', 'oconnor').' '.$i.' '.esc_html__('Settings', 'oconnor'),
            'indent'       => false,
            'section_role' => 'start'
        ),
        array(
            'id'      => 'text'.$i.'_editor',
            'type'    => 'editor',
            'title'   => esc_html__('Text Editor', 'oconnor'),
            'default' => '',
            'args'    => array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 8,
                'teeny'         => false,
                'quicktags'     => true,
            ),
        ),
        array(
            'id'       => 'text'.$i.'_hide_on_desktop',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide on Desktop', 'oconnor' ),
            'default'  => false,
        ),
        array(
            'id'       => 'text'.$i.'_hide_on_tablet',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide on Tablet', 'oconnor' ),
            'default'  => false,
        ),
        array(
            'id'       => 'text'.$i.'_hide_on_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide on Mobile', 'oconnor' ),
            'default'  => false,
        ),
        array(
            'id'           => 'text'.$i.'-end',
            'type'         => 'gt3_section',
            'indent'       => false,
            'section_role' => 'end'
        )
    );
};


// delimiter
$delimiter_count = 6;
$delimiter_opt = array();
for ($i=1; $i <= $delimiter_count ; $i++) {
    array_push($delimiter_opt,
        // Delimiters
        array(
            'id'           => 'delimiter'.$i.'-start',
            'type'         => 'gt3_section',
            'title'        => esc_html__('Delimiter', 'oconnor').$i.' '.esc_html__('Settings', 'oconnor'),
            'indent'       => false,
            'section_role' => 'start'
        ),
        array(
            'id'      => 'delimiter'.$i.'_height',
            'type'    => 'dimensions',
            'units'   => array('em', 'px', '%'),
            'title'   => esc_html__('Delimiter Height', 'oconnor'),
            'height'  => true,
            'width'   => false,
            'output'  => array('height' => '.gt3_delimiter'.$i.''),
            'default' => array(
                'height' => 1,
                'units'  => 'em',
            )
        ),
        array(
            'id'           => 'delimiter'.$i.'-end',
            'type'         => 'gt3_section',
            'indent'       => false,
            'section_role' => 'end'
        )
    );
};

$options = array_merge($options,$aligns,$text_opt,$delimiter_opt,$side_opt);

Redux::setSection($opt_name, array(
    'id'     => 'gt3_header_builder_section',
    'title'  => esc_html__('GT3 Header Builder', 'oconnor'),
    'desc'   => esc_html__('This is GT3 Header Builder', 'oconnor'),
    'icon'   => 'el el-screen',
    'fields' => $options
));
// END HEADER


Redux::setSection($opt_name, array(
    'title'            => esc_html__('Page Title', 'oconnor'),
    'id'               => 'page_title',
    'icon'             => 'el-icon-screen',
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'      => 'page_title_conditional',
            'type'    => 'switch',
            'title'   => esc_html__('Show Page Title', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'       => 'blog_title_conditional',
            'type'     => 'switch',
            'title'    => esc_html__('Show Blog Post Title', 'oconnor'),
            'default'  => false,
            'required' => array('page_title_conditional', '=', '1'),
        ),
        array(
            'id'       => 'page_title-start',
            'type'     => 'section',
            'title'    => esc_html__('Page Title Settings', 'oconnor'),
            'indent'   => true,
            'required' => array('page_title_conditional', '=', '1'),
        ),
        array(
            'id'      => 'page_title_breadcrumbs_conditional',
            'type'    => 'switch',
            'title'   => esc_html__('Show Breadcrumbs', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'      => 'page_title_vert_align',
            'type'    => 'select',
            'title'   => esc_html__('Vertical Align', 'oconnor'),
            'options' => array(
                'top'    => esc_html__('Top', 'oconnor'),
                'middle' => esc_html__('Middle', 'oconnor'),
                'bottom' => esc_html__('Bottom', 'oconnor')
            ),
            'default' => 'middle'
        ),
        array(
            'id'      => 'page_title_horiz_align',
            'type'    => 'select',
            'title'   => esc_html__('Page Title Text Align?', 'oconnor'),
            'options' => array(
                'left'   => esc_html__('Left', 'oconnor'),
                'center' => esc_html__('Center', 'oconnor'),
                'right'  => esc_html__('Right', 'oconnor')
            ),
            'default' => 'center'
        ),
        array(
            'id'          => 'page_title_font_color',
            'type'        => 'color',
            'title'       => esc_html__('Page Title Font Color', 'oconnor'),
            'default'     => '#000000',
            'transparent' => false
        ),
        array(
            'id'          => 'page_title_bg_color',
            'type'        => 'color',
            'title'       => esc_html__('Page Title Background Color', 'oconnor'),
            'default'     => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'    => 'page_title_bg_image',
            'type'  => 'media',
            'title' => esc_html__('Page Title Background Image', 'oconnor'),
        ),
        array(
            'id'               => 'page_title_bg_image',
            'type'             => 'background',
            'background-color' => false,
            'preview_media'    => true,
            'preview'          => false,
            'title'            => esc_html__('Page Title Background Image', 'oconnor'),
            'default'          => array(
                'background-repeat'     => 'repeat',
                'background-size'       => 'cover',
                'background-attachment' => 'scroll',
                'background-position'   => 'center center',
                'background-color'      => '#1e73be',
            )
        ),
        array(
            'id'             => 'page_title_height',
            'type'           => 'dimensions',
            'units'          => false,
            'units_extended' => false,
            'title'          => esc_html__('Page Title Height', 'oconnor'),
            'height'         => true,
            'width'          => false,
            'default'        => array(
                'height' => 180,
            )
        ),
        array(
            'id'      => 'page_title_top_border',
            'type'    => 'switch',
            'title'   => esc_html__('Page Title Top Border', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'       => 'page_title_top_border_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Page Title Top Border Color', 'oconnor'),
            'default'  => array(
                'color' => '#eff0ed',
                'alpha' => '1',
                'rgba'  => 'rgba(239,240,237,1)'
            ),
            'mode'     => 'background',
            'required' => array(
                array('page_title_top_border', '=', '1'),
            ),
        ),
        array(
            'id'      => 'page_title_bottom_border',
            'type'    => 'switch',
            'title'   => esc_html__('Page Title Bottom Border', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'       => 'page_title_bottom_border_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Page Title Bottom Border Color', 'oconnor'),
            'default'  => array(
                'color' => '#eff0ed',
                'alpha' => '1',
                'rgba'  => 'rgba(239,240,237,1)'
            ),
            'mode'     => 'background',
            'required' => array(
                array('page_title_bottom_border', '=', '1'),
            ),
        ),
        array(
            'id'      => 'page_title_bottom_margin',
            'type'    => 'spacing',
            // An array of CSS selectors to apply this font style to
            'mode'    => 'margin',
            'all'     => false,
            'bottom'  => true,
            'top'     => false,
            'left'    => false,
            'right'   => false,
            'title'   => esc_html__('Page Title Bottom Margin', 'oconnor'),
            'default' => array(
                'margin-bottom' => '30',
            )
        ),
        array(
            'id'       => 'page_title-end',
            'type'     => 'section',
            'indent'   => false,
            'required' => array('page_title_conditional', '=', '1'),
        ),

    )
));

// -> START Footer Options
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Footer', 'oconnor'),
    'id'               => 'footer-option',
    'customizer_width' => '400px',
    'icon'             => 'el-icon-screen',
    'fields'           => array(
        array(
            'id'      => 'footer_full_width',
            'type'    => 'switch',
            'title'   => esc_html__('Full Width Footer', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'          => 'footer_bg_color',
            'type'        => 'color',
            'title'       => esc_html__('Footer Background Color', 'oconnor'),
            'default'     => '#232629',
            'transparent' => false
        ),
        array(
            'id'          => 'footer_text_color',
            'type'        => 'color',
            'title'       => esc_html__('Footer Text color', 'oconnor'),
            'default'     => '#797f85',
            'transparent' => false
        ),
        array(
            'id'          => 'footer_heading_color',
            'type'        => 'color',
            'title'       => esc_html__('Footer Heading color', 'oconnor'),
            'default'     => '#ffffff',
            'transparent' => false
        ),
        array(
            'id'               => 'footer_bg_image',
            'type'             => 'background',
            'background-color' => false,
            'preview_media'    => true,
            'preview'          => false,
            'title'            => esc_html__('Footer Background Image', 'oconnor'),
            'default'          => array(
                'background-repeat'     => 'repeat',
                'background-size'       => 'cover',
                'background-attachment' => 'scroll',
                'background-position'   => 'center center',
                'background-color'      => '#1e73be',
            )
        ),
        array(
            'id'      => 'footer_top_margin',
            'type'    => 'spacing',
            // An array of CSS selectors to apply this font style to
            'mode'    => 'margin',
            'all'     => false,
            'bottom'  => false,
            'top'     => true,
            'left'    => false,
            'right'   => false,
            'title'   => esc_html__('Footer Top Margin', 'oconnor'),
            'default' => array(
                'margin-top' => '40px',
            )
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => esc_html__('Footer Content', 'oconnor'),
    'id'               => 'footer_content',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'      => 'footer_switch',
            'type'    => 'switch',
            'title'   => esc_html__('Show Footer', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'       => 'footer-start',
            'type'     => 'section',
            'title'    => esc_html__('Footer Settings', 'oconnor'),
            'indent'   => true,
            'required' => array('footer_switch', '=', '1'),
        ),
        array(
            'id'      => 'footer_column',
            'type'    => 'select',
            'title'   => esc_html__('Footer Column', 'oconnor'),
            'options' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5'
            ),
            'default' => '4'
        ),
        array(
            'id'       => 'footer_column2',
            'type'     => 'select',
            'title'    => esc_html__('Footer Column Layout', 'oconnor'),
            'options'  => array(
                '6-6' => '50% / 50%',
                '3-9' => '25% / 75%',
                '9-3' => '25% / 75%',
                '4-8' => '33% / 66%',
                '8-3' => '66% / 33%',
            ),
            'default'  => '6-6',
            'required' => array('footer_column', '=', '2'),
        ),
        array(
            'id'       => 'footer_column3',
            'type'     => 'select',
            'title'    => esc_html__('Footer Column Layout', 'oconnor'),
            'options'  => array(
                '4-4-4' => '33% / 33% / 33%',
                '3-3-6' => '25% / 25% / 50%',
                '3-6-3' => '25% / 50% / 25%',
                '6-3-3' => '50% / 25% / 25%',
            ),
            'default'  => '4-4-4',
            'required' => array('footer_column', '=', '3'),
        ),
        array(
            'id'       => 'footer_column5',
            'type'     => 'select',
            'title'    => esc_html__('Footer Column Layout', 'oconnor'),
            'options'  => array(
                '2-3-2-2-3' => '16% / 25% / 16% / 16% / 25%',
                '3-2-2-2-3' => '25% / 16% / 16% / 16% / 25%',
                '3-2-3-2-2' => '25% / 16% / 26% / 16% / 16%',
                '3-2-3-3-2' => '25% / 16% / 16% / 25% / 16%',
            ),
            'default'  => '2-3-2-2-3',
            'required' => array('footer_column', '=', '5'),
        ),
        array(
            'id'      => 'footer_align',
            'type'    => 'select',
            'title'   => esc_html__('Footer Title Text Align', 'oconnor'),
            'options' => array(
                'left'   => esc_html__('Left', 'oconnor'),
                'center' => esc_html__('Center', 'oconnor'),
                'right'  => esc_html__('Right', 'oconnor'),
            ),
            'default' => 'left'
        ),
        array(
            'id'      => 'footer_spacing',
            'type'    => 'spacing',
            'mode'    => 'padding',
            'all'     => false,
            'title'   => esc_html__('Footer Padding (px)', 'oconnor'),
            'default' => array(
                'padding-top'    => '70px',
                'padding-right'  => '0px',
                'padding-bottom' => '40px',
                'padding-left'   => '0px'
            )
        ),
        array(
            'id'       => 'footer-end',
            'type'     => 'section',
            'indent'   => false,
            'required' => array('footer_switch', '=', '1'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => esc_html__('Copyright', 'oconnor'),
    'id'               => 'copyright',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'      => 'copyright_switch',
            'type'    => 'switch',
            'title'   => esc_html__('Show Copyright', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'       => 'copyright_editor',
            'type'     => 'editor',
            'title'    => esc_html__('Copyright Editor', 'oconnor'),
            'default'  => '',
            'args'     => array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 12,
                'teeny'         => false,
                'quicktags'     => true,
            ),
            'required' => array('copyright_switch', '=', '1'),
        ),
        array(
            'id'       => 'copyright_align',
            'type'     => 'select',
            'title'    => esc_html__('Copyright Title Text Align', 'oconnor'),
            'options'  => array(
                'left'   => esc_html__('Left', 'oconnor'),
                'center' => esc_html__('Center', 'oconnor'),
                'right'  => esc_html__('Right', 'oconnor'),
            ),
            'default'  => 'left',
            'required' => array('copyright_switch', '=', '1'),
        ),
        array(
            'id'       => 'copyright_spacing',
            'type'     => 'spacing',
            'mode'     => 'padding',
            'all'      => false,
            'title'    => esc_html__('Copyright Padding (px)', 'oconnor'),
            'default'  => array(
                'padding-top'    => '30px',
                'padding-right'  => '0px',
                'padding-bottom' => '29px',
                'padding-left'   => '0px'
            ),
            'required' => array('copyright_switch', '=', '1'),
        ),
        array(
            'id'          => 'copyright_bg_color',
            'type'        => 'color',
            'title'       => esc_html__('Copyright Background Color', 'oconnor'),
            'default'     => 'transparent',
            'transparent' => true,
            'required'    => array('copyright_switch', '=', '1'),
        ),
        array(
            'id'          => 'copyright_text_color',
            'type'        => 'color',
            'title'       => esc_html__('Copyright Text Color', 'oconnor'),
            'default'     => '#797f85',
            'transparent' => false,
            'required'    => array('copyright_switch', '=', '1'),
        ),
        array(
            'id'       => 'copyright_top_border',
            'type'     => 'switch',
            'title'    => esc_html__('Set Copyright Top Border', 'oconnor'),
            'default'  => true,
            'required' => array('copyright_switch', '=', '1'),
        ),
        array(
            'id'       => 'copyright_top_border_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Copyright Border Color', 'oconnor'),
            'default'  => array(
                'color' => '#33373b',
                'alpha' => '1',
                'rgba'  => 'rgba(51,55,59,1)'
            ),
            'mode'     => 'background',
            'required' => array(
                array('copyright_top_border', '=', '1'),
                array('copyright_switch', '=', '1')
            ),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => esc_html__('Pre footer area', 'oconnor'),
    'id'               => 'pre_footer',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'      => 'pre_footer_switch',
            'type'    => 'switch',
            'title'   => esc_html__('Show Pre Footer Area', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'       => 'pre_footer_editor',
            'type'     => 'editor',
            'title'    => esc_html__('Pre Footer Editor', 'oconnor'),
            'default'  => '',
            'args'     => array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 2,
                'teeny'         => false,
                'quicktags'     => true,
            ),
            'required' => array('pre_footer_switch', '=', '1'),
        ),
        array(
            'id'       => 'pre_footer_align',
            'type'     => 'select',
            'title'    => esc_html__('Pre Footer Title Text Align', 'oconnor'),
            'options'  => array(
                'left'   => esc_html__('Left', 'oconnor'),
                'center' => esc_html__('Center', 'oconnor'),
                'right'  => esc_html__('Right', 'oconnor'),
            ),
            'default'  => 'center',
            'required' => array('pre_footer_switch', '=', '1'),
        ),
        array(
            'id'       => 'pre_footer_spacing',
            'type'     => 'spacing',
            'mode'     => 'padding',
            'all'      => false,
            'title'    => esc_html__('Pre Footer Area Padding (px)', 'oconnor'),
            'default'  => array(
                'padding-top'    => '20px',
                'padding-right'  => '0px',
                'padding-bottom' => '20px',
                'padding-left'   => '0px'
            ),
            'required' => array('pre_footer_switch', '=', '1'),
        ),
        array(
            'id'       => 'pre_footer_bottom_border',
            'type'     => 'switch',
            'title'    => esc_html__('Set Pre Footer Border', 'oconnor'),
            'default'  => true,
            'required' => array('pre_footer_switch', '=', '1'),
        ),
        array(
            'id'       => 'pre_footer_bottom_border_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Pre Footer Border Color', 'oconnor'),
            'default'  => array(
                'color' => '#33373b',
                'alpha' => '1',
                'rgba'  => 'rgba(51,55,59,1)'
            ),
            'mode'     => 'background',
            'required' => array(
                array('pre_footer_bottom_border', '=', '1'),
                array('pre_footer_switch', '=', '1')
            ),
        ),
    )
));

// -> START Blog Options
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Blog', 'oconnor'),
    'id'               => 'blog-option',
    'customizer_width' => '400px',
    'icon'             => 'el-icon-th-list',
    'fields'           => array(
        array(
            'id'      => 'related_posts',
            'type'    => 'switch',
            'title'   => esc_html__('Related Posts', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'      => 'author_box',
            'type'    => 'switch',
            'title'   => esc_html__('Author Box on Single Post', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'      => 'post_comments',
            'type'    => 'switch',
            'title'   => esc_html__('Post Comments', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'      => 'post_pingbacks',
            'type'    => 'switch',
            'title'   => esc_html__('Trackbacks and Pingbacks', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'      => 'blog_post_likes',
            'type'    => 'switch',
            'title'   => esc_html__('Likes on Posts', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'      => 'blog_post_share',
            'type'    => 'switch',
            'title'   => esc_html__('Share on Posts', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'      => 'blog_post_listing_content',
            'type'    => 'switch',
            'title'   => esc_html__('Cut Off Text in Blog Listing', 'oconnor'),
            'default' => false,
        ),
    )
));

// -> START Team Options
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Team', 'oconnor'),
    'id'               => 'team-option',
    'customizer_width' => '400px',
    'icon'             => 'el el-picture',
    'fields'           => array(
        array(
            'id'      => 'team_comments',
            'type'    => 'switch',
            'title'   => esc_html__('Team Comments', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'      => 'team_likes',
            'type'    => 'switch',
            'title'   => esc_html__('Show Likes on Team', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'      => 'team_slug',
            'type'    => 'text',
            'title'   => esc_html__('Team Slug', 'oconnor'),
            'default' => 'team'
        ),
        array(
            'id'       => 'single_team_title',
            'type'     => 'text',
            'title'    => esc_html__('Single Team Title', 'oconnor'),
            'subtitle' => esc_html__('Set it blank to show default Team title', 'oconnor'),
            'default'  => 'Team Member',
        ),
    )
));

// -> START Practice Options
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Practice', 'oconnor'),
    'id'               => 'practice-option',
    'customizer_width' => '400px',
    'icon'             => 'el el-picture',
    'fields'           => array(
        array(
            'id'      => 'practice_comments',
            'type'    => 'switch',
            'title'   => esc_html__('Practice Comments', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'      => 'practice_likes',
            'type'    => 'switch',
            'title'   => esc_html__('Show Likes on Practice', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'      => 'practice_slug',
            'type'    => 'text',
            'title'   => esc_html__('Practice Slug', 'oconnor'),
            'default' => 'practice'
        ),
        array(
            'id'       => 'single_practice_title',
            'type'     => 'text',
            'title'    => esc_html__('Single Practice Title', 'oconnor'),
            'subtitle' => esc_html__('Set it blank to show default Practice title', 'oconnor'),
            'default'  => 'Single Practice',
        ),
    )
));

// -> START Case Options
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Case', 'oconnor'),
    'id'               => 'case-option',
    'customizer_width' => '400px',
    'icon'             => 'el el-picture',
    'fields'           => array(
        array(
            'id'      => 'case_comments',
            'type'    => 'switch',
            'title'   => esc_html__('Case Comments', 'oconnor'),
            'default' => true,
        ),
        array(
            'id'      => 'case_likes',
            'type'    => 'switch',
            'title'   => esc_html__('Show Likes on Case', 'oconnor'),
            'default' => false,
        ),
        array(
            'id'      => 'case_slug',
            'type'    => 'text',
            'title'   => esc_html__('Case Slug', 'oconnor'),
            'default' => 'case',
        ),
        array(
            'id'       => 'single_case_title',
            'type'     => 'text',
            'title'    => esc_html__('Single Case Title', 'oconnor'),
            'subtitle' => esc_html__('Set it blank to show default Case title', 'oconnor'),
            'default'  => 'Case Study',
        ),
    )
));

// -> START Layout Options
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Sidebars', 'oconnor'),
    'id'               => 'layout_options',
    'customizer_width' => '400px',
    'icon'             => 'el el-website',
    'fields'           => array(
        array(
            'id'      => 'page_sidebar_layout',
            'type'    => 'image_select',
            'title'   => esc_html__('Page Sidebar Layout', 'oconnor'),
            'options' => array(
                'none'  => array(
                    'alt' => 'None',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                ),
                'left'  => array(
                    'alt' => 'Left',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'Right',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                )
            ),
            'default' => 'none'
        ),
        array(
            'id'       => 'page_sidebar_def',
            'type'     => 'select',
            'title'    => esc_html__('Page Sidebar', 'oconnor'),
            'data'     => 'sidebars',
            'required' => array('page_sidebar_layout', '!=', 'none'),
        ),
        array(
            'id'      => 'blog_single_sidebar_layout',
            'type'    => 'image_select',
            'title'   => esc_html__('Blog Single Sidebar Layout', 'oconnor'),
            'options' => array(
                'none'  => array(
                    'alt' => 'None',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                ),
                'left'  => array(
                    'alt' => 'Left',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'Right',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                )
            ),
            'default' => 'none'
        ),
        array(
            'id'       => 'blog_single_sidebar_def',
            'type'     => 'select',
            'title'    => esc_html__('Blog Single Sidebar', 'oconnor'),
            'data'     => 'sidebars',
            'required' => array('blog_single_sidebar_layout', '!=', 'none'),
        ),

        array(
            'id'      => 'practice_single_sidebar_layout',
            'type'    => 'image_select',
            'title'   => esc_html__('Practice Single Sidebar Layout', 'oconnor'),
            'options' => array(
                'none'  => array(
                    'alt' => 'None',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                ),
                'left'  => array(
                    'alt' => 'Left',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'Right',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                )
            ),
            'default' => 'none'
        ),
        array(
            'id'       => 'practice_single_sidebar_def',
            'type'     => 'select',
            'title'    => esc_html__('Practice Single Sidebar', 'oconnor'),
            'data'     => 'sidebars',
            'required' => array('practice_single_sidebar_layout', '!=', 'none'),
        ),
        array(
            'id'      => 'team_single_sidebar_layout',
            'type'    => 'image_select',
            'title'   => esc_html__('Team Single Sidebar Layout', 'oconnor'),
            'options' => array(
                'none'  => array(
                    'alt' => 'None',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                ),
                'left'  => array(
                    'alt' => 'Left',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'Right',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                )
            ),
            'default' => 'none'
        ),
        array(
            'id'       => 'team_single_sidebar_def',
            'type'     => 'select',
            'title'    => esc_html__('Team Single Sidebar', 'oconnor'),
            'data'     => 'sidebars',
            'required' => array('team_single_sidebar_layout', '!=', 'none'),
        ),

        array(
            'id'      => 'case_single_sidebar_layout',
            'type'    => 'image_select',
            'title'   => esc_html__('Case Single Sidebar Layout', 'oconnor'),
            'options' => array(
                'none'  => array(
                    'alt' => 'None',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                ),
                'left'  => array(
                    'alt' => 'Left',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'Right',
                    'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                )
            ),
            'default' => 'none'
        ),
        array(
            'id'       => 'case_single_sidebar_def',
            'type'     => 'select',
            'title'    => esc_html__('Case Single Sidebar', 'oconnor'),
            'data'     => 'sidebars',
            'required' => array('case_single_sidebar_layout', '!=', 'none'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'            => esc_html__('Sidebar Generator', 'oconnor'),
    'id'               => 'sidebars_generator_section',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'       => 'sidebars',
            'type'     => 'multi_text',
            'validate' => 'no_html',
            'add_text' => esc_html__('Add Sidebar', 'oconnor'),
            'title'    => esc_html__('Sidebar Generator', 'oconnor'),
            'default'  => array('Main Sidebar', 'Menu Sidebar', 'Practice Sidebar', 'Team Sidebar', 'Case Sidebar', 'Shop Sidebar'),
        ),
    )
));


// -> START Styling Options
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Color Options', 'oconnor'),
    'id'               => 'color_options',
    'customizer_width' => '400px',
    'icon'             => 'el-icon-brush'
));

Redux::setSection($opt_name, array(
    'title'            => esc_html__('Colors', 'oconnor'),
    'id'               => 'color_options_color',
    'subsection'       => true,
    'customizer_width' => '450px',
    'fields'           => array(
        array(
            'id'          => 'theme-custom-color',
            'type'        => 'color',
            'title'       => esc_html__('Theme Color 1', 'oconnor'),
            'transparent' => false,
            'default'     => '#80858b',
            'validate'    => 'color',
        ),
        array(
            'id'          => 'theme-custom-color2',
            'type'        => 'color',
            'title'       => esc_html__('Theme Color 2', 'oconnor'),
            'transparent' => false,
            'default'     => '#c2b697',
            'validate'    => 'color',
        ),
        array(
            'id'          => 'body-background-color',
            'type'        => 'color',
            'title'       => esc_html__('Body Background Color', 'oconnor'),
            'transparent' => false,
            'default'     => '#ffffff',
            'validate'    => 'color',
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'            => esc_html__('Typography', 'oconnor'),
    'id'               => 'typography_options',
    'customizer_width' => '400px',
    'icon'             => 'el-icon-font',
    'fields'           => array(
        array(
            'id'          => 'menu-font',
            'type'        => 'typography',
            'title'       => esc_html__('Menu Font', 'oconnor'),
            'google'      => true,
            'font-style'  => true,
            'color'       => false,
            'line-height' => true,
            'font-size'   => true,
            'font-backup' => false,
            'text-align'  => false,
            'default'     => array(
                'font-family' => 'Lato',
                'google'      => true,
                'font-size'   => '20px',
                'line-height' => '24px',
                'font-weight' => '400',
            ),
        ),

        array(
            'id'             => 'main-font',
            'type'           => 'typography',
            'title'          => esc_html__('Main Font', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => true,
            'line-height'    => true,
            'color'          => true,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'all_styles'     => true,
            'default'        => array(
                'font-size'   => '18px',
                'line-height' => '30px',
                'color'       => '#272b2e',
                'google'      => true,
                'font-family' => 'Lato',
                'font-weight' => '300',
            ),
        ),

        array(
            'id'             => 'secondary-font',
            'type'           => 'typography',
            'title'          => esc_html__('Secondary Font', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => true,
            'line-height'    => true,
            'color'          => true,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'all_styles'     => true,
            'default'        => array(
                'font-size'   => '14px',
                'line-height' => '24px',
                'color'       => '#272b2e',
                'google'      => true,
                'font-family' => 'Montserrat',
                'font-weight' => '600',
            ),
        ),

        array(
            'id'             => 'header-font',
            'type'           => 'typography',
            'title'          => esc_html__('Headers Font', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => false,
            'line-height'    => false,
            'color'          => true,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'default'        => array(
                'color'       => '#272b2e',
                'google'      => true,
                'font-family' => 'Prata',
                'font-weight' => '400',
            ),
        ),
        array(
            'id'             => 'h1-font',
            'type'           => 'typography',
            'title'          => esc_html__('H1', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => true,
            'line-height'    => true,
            'color'          => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'default'        => array(
                'font-size'   => '38px',
                'line-height' => '52px',
                'google'      => true,
            ),
        ),
        array(
            'id'             => 'h2-font',
            'type'           => 'typography',
            'title'          => esc_html__('H2', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => true,
            'line-height'    => true,
            'color'          => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'default'        => array(
                'font-size'   => '32px',
                'line-height' => '44px',
                'google'      => true,
            ),
        ),
        array(
            'id'             => 'h3-font',
            'type'           => 'typography',
            'title'          => esc_html__('H3', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => true,
            'line-height'    => true,
            'color'          => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'default'        => array(
                'font-size'   => '28px',
                'line-height' => '38px',
                'google'      => true,
            ),
        ),
        array(
            'id'             => 'h4-font',
            'type'           => 'typography',
            'title'          => esc_html__('H4', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => true,
            'line-height'    => true,
            'color'          => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'default'        => array(
                'font-size'   => '22px',
                'line-height' => '30px',
                'google'      => true,
            ),
        ),
        array(
            'id'             => 'h5-font',
            'type'           => 'typography',
            'title'          => esc_html__('H5', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => true,
            'line-height'    => true,
            'color'          => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'default'        => array(
                'font-size'   => '18px',
                'line-height' => '24px',
                'google'      => true,
            ),
        ),
        array(
            'id'             => 'h6-font',
            'type'           => 'typography',
            'title'          => esc_html__('H6', 'oconnor'),
            'google'         => true,
            'font-backup'    => false,
            'font-size'      => true,
            'line-height'    => true,
            'color'          => false,
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-align'     => false,
            'text-transform' => false,
            'default'        => array(
                'font-size'   => '16px',
                'line-height' => '22px',
                'google'      => true,
            ),
        ),

        array(
            'type' => 'custom_font',
            'id' => 'custom_font',
            'validate'=>'font_load',
            'title' => esc_html__('Font-face list:', 'oconnor'),
            'subtitle' => esc_html__('Upload .zip archive with font-face files.', 'oconnor').'<br>(<a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">'.esc_html__('Create your font-face package','oconnor').'</a>)',
            'desc' => '<span style="color:#F09191">'.esc_html__('Note','oconnor').':</span> '.esc_html__('You have to download the font-face.zip archive.','oconnor').' <br>'.__('Pay your attention, that the archive has to contain the font-face files itself, and not the subfolders','oconnor').'<br> ('.esc_html__('E.g.: font-face.zip/your-font-face.ttf, font-face.zip/your-font-face.eot, font-face.zip/your-font-face.woff etc','oconnor').' ).<br> '.esc_html__('They\'ll be extracted and assigned automatically.', 'oconnor').' ).<br> '.esc_html__('Please check the instruction how to create', 'oconnor').' '.'.',
            'placeholder' => array (
                'title' => esc_html__('This is a title', 'oconnor'),
                'description' => esc_html__('Description Here', 'oconnor'),
                'url' => esc_html__('Give us a link!', 'oconnor'),
            ),
        ),
    )
));


if (class_exists('WooCommerce')) {
    // -> START Layout Options
    Redux::setSection($opt_name, array(
        'title'            => esc_html__('Shop', 'oconnor'),
        'id'               => 'woocommerce_layout_options',
        'customizer_width' => '400px',
        'icon'             => 'el el-shopping-cart',
        'fields'           => array()
    ));
    Redux::setSection($opt_name, array(
        'title'            => esc_html__('Products Page', 'oconnor'),
        'id'               => 'products_page_settings',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'shop_cat_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__('Show Page Title for Shop Category', 'oconnor'),
                'default'  => true,
                'required' => array('page_title_conditional', '=', '1'),
            ),
            array(
                'id'      => 'products_layout',
                'type'    => 'select',
                'title'   => esc_html__('Products Layout', 'oconnor'),
                'options' => array(
                    'container'  => esc_html__('Container', 'oconnor'),
                    'full_width' => esc_html__('Full Width', 'oconnor'),
                ),
                'default' => 'container'
            ),
            array(
                'id'      => 'products_sidebar_layout',
                'type'    => 'image_select',
                'title'   => esc_html__('Products Page Sidebar Layout', 'oconnor'),
                'options' => array(
                    'none'  => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left'  => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default' => 'right'
            ),
            array(
                'id'       => 'products_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__('Products Page Sidebar', 'oconnor'),
                'data'     => 'sidebars',
                'required' => array('products_sidebar_layout', '!=', 'none'),
            ),
            array(
                'id'    => 'products_sorting_frontend',
                'type'  => 'switch',
                'title' => esc_html__('Show dropdown on the frontend to change Sorting of products displayed per page', 'oconnor'),
            ),
            array(
                'id'      => 'woocommerce_pagination',
                'type'    => 'select',
                'title'   => esc_html__('Pagination', 'oconnor'),
                'desc'    => esc_html__('Select the position of pagination.', 'oconnor'),
                'options' => array(
                    'top'        => esc_html__('Top', 'oconnor'),
                    'bottom'     => esc_html__('Bottom', 'oconnor'),
                    'top_bottom' => esc_html__('Top and Bottom', 'oconnor'),
                    'off'        => esc_html__('Off', 'oconnor'),
                ),
                'default' => 'top_bottom',
            ),
            array(
                'id'    => 'woocommerce_recently_viewed',
                'type'  => 'switch',
                'title' => esc_html__('Show Recently Viewed Products', 'oconnor'),
            ),
            array(
                'id'       => 'viewed_products_orderby',
                'type'     => 'switch',
                'title'    => esc_html__('Display Recently Viewed Products randomly', 'oconnor'),
                'default'  => false,
                'required' => array('woocommerce_recently_viewed', '=', '1'),
            ),
            array(
                'id'     => 'section-label_color-start',
                'type'   => 'section',
                'title'  => esc_html__('"Sale", "Hot" and "New" labels color', 'oconnor'),
                'indent' => true,
            ),
            array(
                'id'       => 'label_color_sale',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Color for "Sale" label', 'oconnor'),
                'subtitle' => esc_html__('Select the Background Color for "Sale" label.', 'oconnor'),
                'default'  => array(
                    'color' => '#e63764',
                    'alpha' => '1',
                    'rgba'  => 'rgba(230,55,100,1)'
                ),
            ),
            array(
                'id'       => 'label_color_hot',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Color for "Hot" label', 'oconnor'),
                'subtitle' => esc_html__('Select the Background Color for "Hot" label.', 'oconnor'),
                'default'  => array(
                    'color' => '#71d080',
                    'alpha' => '1',
                    'rgba'  => 'rgba(113,208,128,1)'
                ),
            ),
            array(
                'id'       => 'label_color_new',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Color for "New" label', 'oconnor'),
                'subtitle' => esc_html__('Select the Background Color for "New" label.', 'oconnor'),
                'default'  => array(
                    'color' => '#6ad1e4',
                    'alpha' => '1',
                    'rgba'  => 'rgba(106,209,228,1)'
                ),
            ),
            array(
                'id'     => 'section-label_color-end',
                'type'   => 'section',
                'indent' => false,
            ),
        )
    ));
    Redux::setSection($opt_name, array(
        'title'            => esc_html__('Single Product Page', 'oconnor'),
        'id'               => 'product_page_settings',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'product_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__('Show Product Page Title', 'oconnor'),
                'default'  => false,
                'required' => array('page_title_conditional', '=', '1'),
            ),
            array(
                'id'      => 'product_container',
                'type'    => 'select',
                'title'   => esc_html__('Product Page Layout', 'oconnor'),
                'options' => array(
                    'container'  => esc_html__('Container', 'oconnor'),
                    'full_width' => esc_html__('Full Width', 'oconnor'),
                ),
                'default' => 'container'
            ),
            array(
                'id'      => 'product_sidebar_layout',
                'type'    => 'image_select',
                'title'   => esc_html__('Single Product Page Sidebar Layout', 'oconnor'),
                'options' => array(
                    'none'  => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left'  => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default' => 'none'
            ),
            array(
                'id'       => 'product_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__('Single Product Page Sidebar', 'oconnor'),
                'data'     => 'sidebars',
                'required' => array('product_sidebar_layout', '!=', 'none'),
            ),
            /*array(
                'id'        => 'product_cat_name_conditional',
                'type'      => 'switch',
                'title'     => esc_html__( 'Show Category name instead classic Product Title ', 'oconnor' ),
                'default'   => true,
                'required'  => array( 'page_title_conditional', '=', '1' ),
            ),*/
            array(
                'id'      => 'shop_size_guide',
                'type'    => 'switch',
                'title'   => esc_html__('Show Size Guide', 'oconnor'),
                'default' => false,
            ),
            array(
                'id'       => 'size_guide',
                'type'     => 'media',
                'title'    => esc_html__('Size guide Popup Image', 'oconnor'),
                'required' => array('shop_size_guide', '=', true),
            ),
            array(
                'id'      => 'next_prev_product',
                'type'    => 'switch',
                'title'   => esc_html__('Show Next and Previous products', 'oconnor'),
                'default' => true,
            ),
        )
    ));
}
