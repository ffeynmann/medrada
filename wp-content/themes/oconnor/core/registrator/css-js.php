<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register() {
        $wp_upload_dir = wp_upload_dir();

        wp_register_script('gt3-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);
        $translation_array = array(
            'ajaxurl' => esc_url(admin_url('admin-ajax.php'))
        );
        wp_localize_script('gt3-theme', 'gt3_oconnor', $translation_array);


        #CSS
        wp_enqueue_style('default-style', get_bloginfo('stylesheet_url'));
        wp_enqueue_style("theme-icon", get_template_directory_uri() . '/fonts/theme-font/theme_icon.css');
        wp_enqueue_style("font-awesome", get_template_directory_uri() . '/css/font-awesome.min.css');


        wp_enqueue_style('select2', get_template_directory_uri() . '/css/select2.min.css', array(), '4.0.5');
        wp_enqueue_style("gt3-theme", get_template_directory_uri() . '/css/theme.css');

        wp_enqueue_style("gt3-composer", get_template_directory_uri() . '/css/base_composer.css');
        wp_enqueue_style("gt3-responsive", get_template_directory_uri() . '/css/responsive.css');

        #JS
        wp_register_script('jquery-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.9.0', true);
        wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
        wp_enqueue_script('imagesloaded');
        wp_enqueue_script('gt3-theme');
        wp_enqueue_script('gt3-waypoint', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), false, false);
        wp_enqueue_script('event-swipe', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);
        wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.js', array(), '1.3', true);
        wp_enqueue_script('select2', get_template_directory_uri() . '/js/select2.full.min.js', array(), '4.0.5', false);
    }
}
add_action('wp_enqueue_scripts', 'css_js_register');

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register() {
    $protocol = is_ssl() ? 'https' : 'http';

    #CSS (MAIN)
    wp_enqueue_style("font-awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('admin', get_template_directory_uri() . '/core/admin/css/admin.css');
    wp_enqueue_style('tiny-mce-admin', get_template_directory_uri() . '/css/tiny_mce.css');
    wp_enqueue_style("admin-font", "$protocol://fonts.googleapis.com/css?family=Roboto:400,700,300");
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('admin-colorbox', get_template_directory_uri() . '/core/admin/css/colorbox.css');
    wp_enqueue_style('selectBox-css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
    wp_enqueue_style("gt3-vc-backend-style", get_template_directory_uri() . '/core/admin/css/gt3-vc-backend.css');

    #JS (MAIN)
    wp_enqueue_script('admin', get_template_directory_uri() . '/core/admin/js/admin.js', array('jquery'), false, true);
    wp_enqueue_media();
    wp_enqueue_script('admin-colorbox', get_template_directory_uri() . '/core/admin/js/jquery.colorbox-min.js', array(), false, true);
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('selectBox', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');

    if (class_exists('RWMB_Loader')) {
        wp_enqueue_script('metaboxes', get_template_directory_uri() . '/core/admin/js/metaboxes.js');
    }
}

function gt3_custom_styles() {

    // THEME COLOR
    $theme_color  = esc_attr(gt3_option("theme-custom-color"));
    $theme_color2 = esc_attr(gt3_option("theme-custom-color2"));
    // END THEME COLOR

    // BODY BACKGROUND
    $bg_body = esc_attr(gt3_option('body-background-color'));
    // END BODY BACKGROUND

    // BODY TYPOGRAPHY
    $main_font = gt3_option('main-font');
    if (!empty($main_font)) {
        $content_font_family = esc_attr($main_font['font-family']);
        $content_line_height = esc_attr($main_font['line-height']);
        $content_font_size   = esc_attr($main_font['font-size']);
        $content_font_weight = esc_attr($main_font['font-weight']);
        $content_color       = esc_attr($main_font['color']);
    } else {
        $content_font_family = '';
        $content_line_height = '';
        $content_font_size   = '';
        $content_font_weight = '';
        $content_color       = '';
    }

    $secondary_font = gt3_option('secondary-font');
    if (!empty($secondary_font)) {
        $content_font_family2 = esc_attr($secondary_font['font-family']);
        $content_line_height2 = esc_attr($secondary_font['line-height']);
        $content_font_size2   = esc_attr($secondary_font['font-size']);
        $content_font_weight2 = esc_attr($secondary_font['font-weight']);
        $content_color2       = esc_attr($secondary_font['color']);
    } else {
        $content_font_family2 = '';
        $content_line_height2 = '';
        $content_font_size2   = '';
        $content_font_weight2 = '';
        $content_color2       = '';
    }

    // END BODY TYPOGRAPHY

    // HEADER TYPOGRAPHY
    $header_font = gt3_option('header-font');
    if (!empty($header_font)) {
        $header_font_family = esc_attr($header_font['font-family']);
        $header_font_weight = esc_attr($header_font['font-weight']);
        $header_font_color  = esc_attr($header_font['color']);
    } else {
        $header_font_family = '';
        $header_font_weight = '';
        $header_font_color  = '';
    }

    $h1_font = gt3_option('h1-font');
    if (!empty($h1_font)) {
        $H1_font_family      = !empty($h1_font['font-family']) ? esc_attr($h1_font['font-family']) : '';
        $H1_font_weight      = !empty($h1_font['font-weight']) ? esc_attr($h1_font['font-weight']) : '';
        $H1_font_line_height = !empty($h1_font['line-height']) ? esc_attr($h1_font['line-height']) : '';
        $H1_font_size        = !empty($h1_font['font-size']) ? esc_attr($h1_font['font-size']) : '';
    } else {
        $H1_font_family      = '';
        $H1_font_weight      = '';
        $H1_font_line_height = '';
        $H1_font_size        = '';
    }

    $h2_font = gt3_option('h2-font');
    if (!empty($h2_font)) {
        $H2_font_family      = !empty($h2_font['font-family']) ? esc_attr($h2_font['font-family']) : '';
        $H2_font_weight      = !empty($h2_font['font-weight']) ? esc_attr($h2_font['font-weight']) : '';
        $H2_font_line_height = !empty($h2_font['line-height']) ? esc_attr($h2_font['line-height']) : '';
        $H2_font_size        = !empty($h2_font['font-size']) ? esc_attr($h2_font['font-size']) : '';
    } else {
        $H2_font_family      = '';
        $H2_font_weight      = '';
        $H2_font_line_height = '';
        $H2_font_size        = '';
    }

    $h3_font = gt3_option('h3-font');
    if (!empty($h3_font)) {
        $H3_font_family      = !empty($h3_font['font-family']) ? esc_attr($h3_font['font-family']) : '';
        $H3_font_weight      = !empty($h3_font['font-weight']) ? esc_attr($h3_font['font-weight']) : '';
        $H3_font_line_height = !empty($h3_font['line-height']) ? esc_attr($h3_font['line-height']) : '';
        $H3_font_size        = !empty($h3_font['font-size']) ? esc_attr($h3_font['font-size']) : '';
    } else {
        $H3_font_family      = '';
        $H3_font_weight      = '';
        $H3_font_line_height = '';
        $H3_font_size        = '';
    }

    $h4_font = gt3_option('h4-font');
    if (!empty($h4_font)) {
        $H4_font_family      = !empty($h4_font['font-family']) ? esc_attr($h4_font['font-family']) : '';
        $H4_font_weight      = !empty($h4_font['font-weight']) ? esc_attr($h4_font['font-weight']) : '';
        $H4_font_line_height = !empty($h4_font['line-height']) ? esc_attr($h4_font['line-height']) : '';
        $H4_font_size        = !empty($h4_font['font-size']) ? esc_attr($h4_font['font-size']) : '';
    } else {
        $H4_font_family      = '';
        $H4_font_weight      = '';
        $H4_font_line_height = '';
        $H4_font_size        = '';
    }

    $h5_font = gt3_option('h5-font');
    if (!empty($h5_font)) {
        $H5_font_family      = !empty($h5_font['font-family']) ? esc_attr($h5_font['font-family']) : '';
        $H5_font_weight      = !empty($h5_font['font-weight']) ? esc_attr($h5_font['font-weight']) : '';
        $H5_font_line_height = !empty($h5_font['line-height']) ? esc_attr($h5_font['line-height']) : '';
        $H5_font_size        = !empty($h5_font['font-size']) ? esc_attr($h5_font['font-size']) : '';
    } else {
        $H5_font_family      = '';
        $H5_font_weight      = '';
        $H5_font_line_height = '';
        $H5_font_size        = '';
    }

    $h6_font = gt3_option('h6-font');
    if (!empty($h6_font)) {
        $H6_font_family      = !empty($h6_font['font-family']) ? esc_attr($h6_font['font-family']) : '';
        $H6_font_weight      = !empty($h6_font['font-weight']) ? esc_attr($h6_font['font-weight']) : '';
        $H6_font_line_height = !empty($h6_font['line-height']) ? esc_attr($h6_font['line-height']) : '';
        $H6_font_size        = !empty($h6_font['font-size']) ? esc_attr($h6_font['font-size']) : '';
    } else {
        $H6_font_family      = '';
        $H6_font_weight      = '';
        $H6_font_line_height = '';
        $H6_font_size        = '';
    }

    $menu_font = gt3_option('menu-font');
    if (!empty($menu_font)) {
        $menu_font_family      = !empty($menu_font['font-family']) ? esc_attr($menu_font['font-family']) : '';
        $menu_font_weight      = !empty($menu_font['font-weight']) ? esc_attr($menu_font['font-weight']) : '';
        $menu_font_line_height = !empty($menu_font['line-height']) ? esc_attr($menu_font['line-height']) : '';
        $menu_font_size        = !empty($menu_font['font-size']) ? esc_attr($menu_font['font-size']) : '';
    } else {
        $menu_font_family      = '';
        $menu_font_weight      = '';
        $menu_font_line_height = '';
        $menu_font_size        = '';
    }

    $sub_menu_bg    = gt3_option('sub_menu_background');
    $sub_menu_color = gt3_option('sub_menu_color');


    /* GT3 Header Builder */
    $sections = array('top','middle','bottom','top__tablet','middle__tablet','bottom__tablet','top__mobile','middle__mobile','bottom__mobile');
    $desktop_sides = array('top', 'middle', 'bottom');

    foreach ($sections as $section) {
        ${'side_' . $section . '_background'} = gt3_option('side_'.$section.'_background');
        ${'side_' . $section . '_background'} = ${'side_' . $section . '_background'}['rgba'];
        ${'side_' . $section . '_color'}  = gt3_option('side_'.$section.'_color');
        ${'side_' . $section . '_height'} = gt3_option('side_'.$section.'_height');
        ${'side_' . $section . '_height'} = ${'side_' . $section . '_height'}['height'];

        ${'side_' . $section . '_border'} = (bool)gt3_option('side_' . $section . '_border');
        ${'side_' . $section . '_border_color'} = gt3_option('side_' . $section . '_border_color');

    }

    $header_sticky              = gt3_option("header_sticky");
    $side_top_sticky            = gt3_option('side_top_sticky');
    $side_top_background_sticky = gt3_option('side_top_background_sticky');
    $side_top_color_sticky      = gt3_option('side_top_color_sticky');
    $side_top_height_sticky     = gt3_option('side_top_height_sticky');

    $side_middle_sticky            = gt3_option('side_middle_sticky');
    $side_middle_background_sticky = gt3_option('side_middle_background_sticky');
    $side_middle_color_sticky      = gt3_option('side_middle_color_sticky');
    $side_middle_height_sticky     = gt3_option('side_middle_height_sticky');

    $side_bottom_sticky            = gt3_option('side_bottom_sticky');
    $side_bottom_background_sticky = gt3_option('side_bottom_background_sticky');
    $side_bottom_color_sticky      = gt3_option('side_bottom_color_sticky');
    $side_bottom_height_sticky     = gt3_option('side_bottom_height_sticky');

	$id = gt3_get_queried_object_id();
    if (class_exists('RWMB_Loader') && $id !== 0) {
        $mb_header_presets = rwmb_meta('mb_header_presets', array(), $id);
	    $presets = gt3_option('gt3_header_builder_presets');
	    if ($mb_header_presets != 'default' && isset($mb_header_presets) && !empty($presets[$mb_header_presets]) && !empty($presets[$mb_header_presets]['preset']) ) {
		    $preset = $presets[$mb_header_presets]['preset'];
		    $preset = json_decode($preset,true);

            $sub_menu_bg    = gt3_option_presets($preset, 'sub_menu_background');
            $sub_menu_color = gt3_option_presets($preset, 'sub_menu_color');

            foreach ($sections as $section) {
                ${'side_' . $section . '_background'} = gt3_option_presets($preset,'side_'.$section.'_background');
                ${'side_' . $section . '_background'} = ${'side_' . $section . '_background'}['rgba'];
                ${'side_' . $section . '_color'}  = gt3_option_presets($preset,'side_'.$section.'_color');
                ${'side_' . $section . '_height'} = gt3_option_presets($preset,'side_'.$section.'_height');
                ${'side_' . $section . '_height'} = ${'side_' . $section . '_height'}['height'];

                ${'side_' . $section . '_border'} = (bool)gt3_option_presets($preset,'side_' . $section . '_border');
                ${'side_' . $section . '_border_color'} = gt3_option_presets($preset,'side_' . $section . '_border_color');
            }

            $header_sticky              = gt3_option_presets($preset, "header_sticky");
            $side_top_sticky            = gt3_option_presets($preset, 'side_top_sticky');
            $side_top_background_sticky = gt3_option_presets($preset, 'side_top_background_sticky');
            $side_top_color_sticky      = gt3_option_presets($preset, 'side_top_color_sticky');
            $side_top_height_sticky     = gt3_option_presets($preset, 'side_top_height_sticky');

            $side_middle_sticky            = gt3_option_presets($preset, 'side_middle_sticky');
            $side_middle_background_sticky = gt3_option_presets($preset, 'side_middle_background_sticky');
            $side_middle_color_sticky      = gt3_option_presets($preset, 'side_middle_color_sticky');
            $side_middle_height_sticky     = gt3_option_presets($preset, 'side_middle_height_sticky');

            $side_bottom_sticky            = gt3_option_presets($preset, 'side_bottom_sticky');
            $side_bottom_background_sticky = gt3_option_presets($preset, 'side_bottom_background_sticky');
            $side_bottom_color_sticky      = gt3_option_presets($preset, 'side_bottom_color_sticky');
            $side_bottom_height_sticky     = gt3_option_presets($preset, 'side_bottom_height_sticky');
        }

        $mb_customize_header_layout = rwmb_meta('mb_customize_header_layout', array(), $id);
        if ($mb_customize_header_layout == 'custom') {
            $mb_customize_top_header_layout    = rwmb_meta('mb_customize_top_header_layout', array(), $id);
            $mb_customize_middle_header_layout = rwmb_meta('mb_customize_middle_header_layout', array(), $id);
            $mb_customize_bottom_header_layout = rwmb_meta('mb_customize_bottom_header_layout', array(), $id);

            if ($mb_customize_top_header_layout == 'custom') {
                //top
                $mb_top_header_background                  = rwmb_meta('mb_top_header_background', array(), $id);
                $mb_top_header_background_opacity          = rwmb_meta('mb_top_header_background_opacity', array(), $id);
                $side_top_color                            = rwmb_meta('mb_top_header_color', array(), $id);
                $side_top_border                           = rwmb_meta('mb_top_header_bottom_border', array(), $id);
                $mb_header_top_bottom_border_color         = rwmb_meta('mb_header_top_bottom_border_color', array(), $id);
                $mb_header_top_bottom_border_color_opacity = rwmb_meta('mb_header_top_bottom_border_color_opacity', array(), $id);

                if (!empty($mb_header_top_bottom_border_color)) {
                    $side_top_border_color['rgba'] = 'rgba(' . (gt3_HexToRGB($mb_header_top_bottom_border_color)) . ',' . $mb_header_top_bottom_border_color_opacity . ')';
                } else {
                    $side_top_border_color['rgba'] = '';
                }
                if (!empty($mb_top_header_background)) {
                    $side_top_background = 'rgba(' . (gt3_HexToRGB($mb_top_header_background)) . ',' . $mb_top_header_background_opacity . ')';
                } else {
                    $side_top_background = '';
                }
            }

            if ($mb_customize_middle_header_layout == 'custom') {
                //middle
                $mb_middle_header_background                  = rwmb_meta('mb_middle_header_background', array(), $id);
                $mb_middle_header_background_opacity          = rwmb_meta('mb_middle_header_background_opacity', array(), $id);
                $side_middle_color                            = rwmb_meta('mb_middle_header_color', array(), $id);
                $side_middle_border                           = rwmb_meta('mb_middle_header_bottom_border', array(), $id);
                $mb_header_middle_bottom_border_color         = rwmb_meta('mb_header_middle_bottom_border_color', array(), $id);
                $mb_header_middle_bottom_border_color_opacity = rwmb_meta('mb_header_middle_bottom_border_color_opacity', array(), $id);

                if (!empty($mb_header_middle_bottom_border_color)) {
                    $side_middle_border_color['rgba'] = 'rgba(' . (gt3_HexToRGB($mb_header_middle_bottom_border_color)) . ',' . $mb_header_middle_bottom_border_color_opacity . ')';
                } else {
                    $side_middle_border_color['rgba'] = '';
                }
                if (!empty($mb_middle_header_background)) {
                    $side_middle_background = 'rgba(' . (gt3_HexToRGB($mb_middle_header_background)) . ',' . $mb_middle_header_background_opacity . ')';
                } else {
                    $side_middle_background = '';
                }
            }

            if ($mb_customize_bottom_header_layout == 'custom') {
                //bottom
                $mb_bottom_header_background                  = rwmb_meta('mb_bottom_header_background', array(), $id);
                $mb_bottom_header_background_opacity          = rwmb_meta('mb_bottom_header_background_opacity', array(), $id);
                $side_bottom_color                            = rwmb_meta('mb_bottom_header_color', array(), $id);
                $side_bottom_border                           = rwmb_meta('mb_bottom_header_bottom_border', array(), $id);
                $mb_header_bottom_bottom_border_color         = rwmb_meta('mb_header_bottom_bottom_border_color', array(), $id);
                $mb_header_bottom_bottom_border_color_opacity = rwmb_meta('mb_header_bottom_bottom_border_color_opacity', array(), $id);

                if (!empty($mb_header_bottom_bottom_border_color)) {
                    $side_bottom_border_color['rgba'] = 'rgba(' . (gt3_HexToRGB($mb_header_bottom_bottom_border_color)) . ',' . $mb_header_bottom_bottom_border_color_opacity . ')';
                } else {
                    $side_bottom_border_color['rgba'] = '';
                }
                if (!empty($mb_bottom_header_background)) {
                    $side_bottom_background = 'rgba(' . (gt3_HexToRGB($mb_bottom_header_background)) . ',' . $mb_bottom_header_background_opacity . ')';
                } else {
                    $side_bottom_background = '';
                }
            }
        }
    }

    /* End GT3 Header Builder */


    // END HEADER TYPOGRAPHY


    $custom_css = '
    /* Custom CSS */
    *{
	}
	
	body,
	body.wpb-js-composer .vc_row .vc_tta.vc_general .vc_tta-panel-title>a span,
	body.wpb-js-composer .vc_row .vc_toggle_title>h4,
	.team_title__text,
	.team_title__text > a,
	.woocommerce ul.products li.product h3,
	.woocommerce form .qty,
	.woocommerce form .variations select,
	body .widget .yit-wcan-select-open,
	body .widget-hotspot {
		font-family:' . $content_font_family . ';
	}
	body {
		' . (!empty($bg_body) ? 'background:' . $bg_body . ';' : '') . '
		font-size:' . $content_font_size . ';
		line-height:' . $content_line_height . ';
		font-weight:' . $content_font_weight . ';
		color: ' . $content_color . ';
	}
	
    .likes_block,
    ul.pagerblock,
    .gt3_pagination_comments .page-numbers,
    .listing_meta,
    .blog_content .post_author,
    .comment_meta,
    .prev_next_links a span,
    input[type=\'submit\'],
    button,
    .gt3_module_button a,
    .vc_progress_bar,
    .member-vcard,
    .gt3_case_list__cat,
    .gt3_case_list__filter,
    .gt3_team_list__filter,
    .gt3_practice_list__filter,
    .practice_post_button,
    .gt3_module_counter .count_info{
		' . (!empty($content_font_family2) ? 'font-family:' . $content_font_family2 . ';' : '') . '
		' . (!empty($content_font_weight2) ? 'font-weight:' . $content_font_weight2 . ';' : '') . '
    }
    .prev_next_links a span,
    input[type=\'submit\'],
    button,
    .gt3_module_button a,
    .gt3_pagination_comments .page-numbers,
    .vc_progress_bar,
    .gt3_case_list__item--content_above .gt3_case_list__cat,
    .gt3_case_list__filter,
    .gt3_team_list__filter,
    .gt3_practice_list__filter,
    .practice_post_button,
    .gt3_module_counter .count_info{
		' . (!empty($content_font_size2) ? 'font-size:' . $content_font_size2 . ';' : '') . '
    }

	/* Custom Fonts */
	.module_team .team_info,
	h1, h1 span, h1 a,
	h2, h2 span, h2 a,
	h3, h3 span, h3 a,
	h4, h4 span, h4 a,
	h5, h5 span, h5 a,
	h6, h6 span, h6 a,
	.widget.widget_archive > ul > li, 
	.widget.widget_categories > ul > li, 
	.widget.widget_pages > ul > li, 
	.widget.widget_meta > ul > li, 
	.widget.widget_recent_comments > ul > li, 
	.widget.widget_recent_entries > ul > li, 
	.widget.widget_rss > ul > li, 
	.widget.widget_nav_menu > div > ul > li,
	.calendar_wrap tbody,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab,
	.price_item-cost,
	.widget.widget_posts .recent_posts .post_title a{
		color: ' . $header_font_color . ';
	}
	.gt3_dropcaps,
	.dropcap,
	body table.booked-calendar thead th .monthName,
	.gt3_icon_box__icon--number,
	h1, h1 span, h1 a,
	h2, h2 span, h2 a,
	h3, h3 span, h3 a,
	h4, h4 span, h4 a,
	h5, h5 span, h5 a,
	h6, h6 span, h6 a,
	.strip_template .strip-item a span,
	.column1 .item_title a,
	.index_number,
	.price_item_btn a,
	.shortcode_tab_item_title,
	.gt3_twitter .twitt_title,
	.gt3_module_counter .stat_count{
		font-family: ' . $header_font_family . ';
		font-weight: ' . $header_font_weight . '
	}
	h1, h1 a, h1 span {
		' . (!empty($H1_font_family) ? 'font-family:' . $H1_font_family . ';' : '') . '
		' . (!empty($H1_font_weight) ? 'font-weight:' . $H1_font_weight . ';' : '') . '
		' . (!empty($H1_font_size) ? 'font-size:' . $H1_font_size . ';' : '') . '
		' . (!empty($H1_font_line_height) ? 'line-height:' . $H1_font_line_height . ';' : '') . '
	}
	h2, h2 a, h2 span,
	body table.booked-calendar th .monthName {
		' . (!empty($H2_font_family) ? 'font-family:' . $H2_font_family . ';' : '') . '
		' . (!empty($H2_font_weight) ? 'font-weight:' . $H2_font_weight . ';' : '') . '
		' . (!empty($H2_font_size) ? 'font-size:' . $H2_font_size . ';' : '') . '
		' . (!empty($H2_font_line_height) ? 'line-height:' . $H2_font_line_height . ';' : '') . '
	}
	h3, h3 a, h3 span,
	#customer_login h2,
	.gt3_header_builder__login-modal_container h2,
	.sidepanel .title{
		' . (!empty($H3_font_family) ? 'font-family:' . $H3_font_family . ';' : '') . '
		' . (!empty($H3_font_weight) ? 'font-weight:' . $H3_font_weight . ';' : '') . '
		' . (!empty($H3_font_size) ? 'font-size:' . $H3_font_size . ';' : '') . '
		' . (!empty($H3_font_line_height) ? 'line-height:' . $H3_font_line_height . ';' : '') . '
	}
	h4, h4 a, h4 span{
		' . (!empty($H4_font_family) ? 'font-family:' . $H4_font_family . ';' : '') . '
		' . (!empty($H4_font_weight) ? 'font-weight:' . $H4_font_weight . ';' : '') . '
		' . (!empty($H4_font_size) ? 'font-size:' . $H4_font_size . ';' : '') . '
		' . (!empty($H4_font_line_height) ? 'line-height:' . $H4_font_line_height . ';' : '') . '
	}
	h5, h5 a, h5 span {
		' . (!empty($H5_font_family) ? 'font-family:' . $H5_font_family . ';' : '') . '
		' . (!empty($H5_font_weight) ? 'font-weight:' . $H5_font_weight . ';' : '') . '
		' . (!empty($H5_font_size) ? 'font-size:' . $H5_font_size . ';' : '') . '
		' . (!empty($H5_font_line_height) ? 'line-height:' . $H5_font_line_height . ';' : '') . '
	}
	h6, h6 a, h6 span {
		' . (!empty($H6_font_family) ? 'font-family:' . $H6_font_family . ';' : '') . '
		' . (!empty($H6_font_weight) ? 'font-weight:' . $H6_font_weight . ';' : '') . '
		' . (!empty($H6_font_size) ? 'font-size:' . $H6_font_size . ';' : '') . '
		' . (!empty($H6_font_line_height) ? 'line-height:' . $H6_font_line_height . ';' : '') . '
	}

	.diagram_item .chart,
	.item_title a ,
	.contentarea ul,
	#customer_login form .form-row label,
	.gt3_header_builder__login-modal_container form .form-row label,
	body .vc_pie_chart .vc_pie_chart_value{
		color:' . $header_font_color . ';
	}
    body.wpb-js-composer .vc_row .vc_progress_bar:not(.vc_progress-bar-color-custom) .vc_single_bar .vc_label:not([style*="color"]) .vc_label_units{
    	color: ' . $header_font_color . ' !important;
    }
    blockquote,
    .comment_info{
		font-family: ' . $header_font_family . ';
    }

	/* Theme color */
	a:hover,
	#back_to_top:hover,
	.top_footer a:hover,
	.main_menu_container:not(.menu_line_disable) .menu > .menu-item.current_page_item > a,
	.main_menu_container:not(.menu_line_disable) .menu > .menu-item.current-menu-parent > a,
	.widget.widget_archive ul li:hover:before,
	.widget.widget_categories ul li:hover:before,
	.widget.widget_pages ul li:hover:before,
	.widget.widget_meta ul li:hover:before,
	.widget.widget_recent_comments ul li:hover:before,
	.widget.widget_recent_entries ul li:hover:before,
	.widget.widget_rss ul li:hover:before,
	.widget.widget_archive ul li > a:hover,
	.widget.widget_categories ul li > a:hover,
	.widget.widget_pages ul li > a:hover,
	.widget.widget_meta ul li > a:hover,
	.widget.widget_recent_comments ul li > a:hover,
	.widget.widget_recent_entries ul li > a:hover,
	.widget.widget_rss ul li > a:hover,
	.widget.widget_nav_menu ul li > a:hover,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab.vc_active>a,
	.load_more_works:hover,
	.copyright a:hover,
	.module_testimonial.type2 .testimonials-text:before,
	input[type="submit"]:hover,
	button:hover,
	.price_item .items_text ul li:before,
	.price_item.most_popular .item_cost_wrapper h3,
	.gt3_practice_list__title a:hover,
	.mc_form_inside #mc_signup_submit:hover,
	.pre_footer input[type="submit"]:hover,
	.gt3_top_sidebar_products .widget_price_filter .price_slider_amount .price_label,
	.gt3_module_featured_posts .learn_more:hover,
	.gt3_secondary_font,
	.practice_post_button,
	.single-member-page .member-vcard,
	.single-member-page .member-short-desc a,
	.blog_type5 .has_post_thumb .blog_content .blogpost_title a:hover{
		color: ' . $theme_color2 . ';
	}

	.price_item .item_cost_wrapper .bg-color,
	.gt3_practice_list__link:before,
	.load_more_works,
	.content-container .vc_progress_bar .vc_single_bar .vc_bar,
	input[type="submit"],
	button,
	.mc_form_inside #mc_signup_submit,
	.pre_footer input[type="submit"],
	.gt3_pagination_comments .page-numbers.current,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range{
		background-color: ' . $theme_color2 . ';
	}
	.widget .calendar_wrap table td#today:before{
		background: ' . $theme_color2 . ';
	}
	
    input[type=\'date\'],
    input[type=\'email\'],
    input[type=\'number\'],
    input[type=\'password\'],
    input[type=\'search\'],
    input[type=\'tel\'],
    input[type=\'text\'],
    input[type=\'url\'],
    select,
    textarea,
    .gt3-contact-widget input[type=\'date\'],
    .gt3-contact-widget input[type=\'email\'],
    .gt3-contact-widget input[type=\'number\'],
    .gt3-contact-widget input[type=\'password\'],
    .gt3-contact-widget input[type=\'search\'],
    .gt3-contact-widget input[type=\'tel\'],
    .gt3-contact-widget input[type=\'text\'],
    .gt3-contact-widget input[type=\'url\'],
    .gt3-contact-widget select,
    .gt3-contact-widget textarea,
	.listing_meta,
	.blog_type5 .has_post_thumb .blog_content:hover .listing_meta,
	.prev_next_links,
	.gt3_pagination_comments .page-numbers,
	.comment-reply-link,
	.comment_meta,
	/*.blog_content .post_author a,*/
	.blog_content:hover .post_author a,
	.without_post_thumb .blog_content .post_author a,
	.likes_block,
    .gt3_team_list__position,
	.mc_merge_var label{
		color: ' . $theme_color . ';
	}
	.woocommerce .wishlist_table td.product-add-to-cart a,
	.gt3_module_button a,
	.gt3_module_carousel .slick-slider ul.slick-dots li.slick-active button{
		border-color: ' . $theme_color2 . ';
		background: ' . $theme_color2 . ';
	}
	.woocommerce .wishlist_table td.product-add-to-cart a:hover,
	.woocommerce .widget_shopping_cart .buttons a:hover, 
	.woocommerce.widget_shopping_cart .buttons a:hover,
	.gt3_header_builder_cart_component .button:hover,
	.gt3_submit_wrapper:hover > i,
	.single-member-page .member-vcard:hover,
	.single-member-page .member-short-desc a:hover{
		color:' . $theme_color . ';
	}
	.load_more_works,
	input[type="submit"],
	button{
		border-color: ' . $theme_color2 . ';
	}

	.isotope-filter a:hover,
	.isotope-filter a.active {
		color: ' . $theme_color2 . ';
	}

	.widget_nav_menu .menu .menu-item:before,
	.gt3_icon_box__link a:before,
	.stripe_item-divider,
	.module_team .view_all_link:before {
		background-color: ' . $theme_color . ';
	}
	.single-member-page .team-link:hover,
	.module_team .view_all_link {
		color: ' . $theme_color . ';
	}

	.module_team .view_all_link:after {
		border-color: ' . $theme_color . ';
	}

	/* menu fonts */
	.main-menu>ul,
	.main-menu>div>ul {
		font-family:' . esc_attr($menu_font_family) . ';
		font-weight:' . esc_attr($menu_font_weight) . ';
		line-height:' . esc_attr($menu_font_line_height) . ';
		font-size:' . esc_attr($menu_font_size) . ';
	}

	/* sub menu styles */
	.main-menu ul li ul.sub-menu,
	.gt3_currency_switcher ul,
	.gt3_header_builder .header_search__inner .search_form,
	.mobile_menu_container,
	.gt3_header_builder_cart_component__cart-container{
		background-color: ' . (!empty($sub_menu_bg['rgba']) ? esc_attr($sub_menu_bg['rgba']) : "transparent") . ' ;
		color: ' . esc_attr($sub_menu_color) . ' ;
	}
	.gt3_header_builder .header_search__inner .search_text::-webkit-input-placeholder{
		color: ' . esc_attr($sub_menu_color) . ' !important;
	}
	.gt3_header_builder .header_search__inner .search_text:-moz-placeholder {
		color: ' . esc_attr($sub_menu_color) . ' !important;
	}
	.gt3_header_builder .header_search__inner .search_text::-moz-placeholder {
		color: ' . esc_attr($sub_menu_color) . ' !important;
	}
	.gt3_header_builder .header_search__inner .search_text:-ms-input-placeholder {
		color: ' . esc_attr($sub_menu_color) . ' !important;
	}
	.gt3_header_builder .header_search .header_search__inner:before,
	.main-menu > ul > li > ul:before,
	.gt3_megamenu_triangle:before,
	.gt3_currency_switcher ul:before,
	.gt3_header_builder_cart_component__cart:before{
		border-bottom-color: ' . (!empty($sub_menu_bg['rgba']) ? esc_attr($sub_menu_bg['rgba']) : "transparent") . ' ;
	}
	.gt3_header_builder .header_search .header_search__inner:before,
	.main-menu > ul > li > ul:before,
	.gt3_megamenu_triangle:before,
	.gt3_currency_switcher ul:before,
	.gt3_header_builder_cart_component__cart:before{
	    -webkit-box-shadow: 0px 1px 0px 0px ' . (!empty($sub_menu_bg['rgba']) ? esc_attr($sub_menu_bg['rgba']) : "transparent") . ';
	    -moz-box-shadow: 0px 1px 0px 0px ' . (!empty($sub_menu_bg['rgba']) ? esc_attr($sub_menu_bg['rgba']) : "transparent") . ';
	    box-shadow: 0px 1px 0px 0px ' . (!empty($sub_menu_bg['rgba']) ? esc_attr($sub_menu_bg['rgba']) : "transparent") . ';
	}

	/* blog */
	.gt3-page-title:not(.gt3-page-title_with_bg) .gt3_breadcrumb,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab>a,
	.prev_next_links a b,
	ul.pagerblock li span,
    .single-member-page .team-link:hover{
		color: ' . $content_color . ';
	}
	.format-video .gt3_video__play_button{
		background-color: rgba(' . gt3_HexToRGB($content_color) . ',.35);
	}
	
	hr{
        border-bottom: 1px solid rgba(' . gt3_HexToRGB($content_color) . ', 0.3);
	}
	
    .gt3_link_layer .custom_animation:before{
        -webkit-box-shadow: inset 0 0 0 0 ' . $theme_color2 . ';
        -moz-box-shadow: inset 0 0 0 0 ' . $theme_color2 . ';
        box-shadow: inset 0 0 0 0 ' . $theme_color2 . ';
    }
    .gt3_link_layer .custom_animation:hover:before{
        -webkit-box-shadow: inset 0 -5px 0 0 ' . $theme_color2 . ';
        -moz-box-shadow: inset 0 -5px 0 0 ' . $theme_color2 . ';
        box-shadow: inset 0 -5px 0 0 ' . $theme_color2 . ';
    }
	.blogpost_title a:hover,
	.gt3_module_featured_posts .listing_meta a:hover,
	.recent_posts .listing_meta a,
	.widget.widget_posts .recent_posts li > .recent_posts_content .post_title a:hover {
		color: ' . $theme_color . ';
	}
	.learn_more:hover,
	.woocommerce .widget_shopping_cart .total, 
	.woocommerce.widget_shopping_cart .total,
	.module_team .view_all_link:hover {color: ' . $header_font_color . ';
	}
	.module_team .view_all_link:hover:before {
		background-color: ' . $header_font_color . ';
	}
	.module_team .view_all_link:hover:after {
		border-color: ' . $header_font_color . ';
	}

	.gt3_module_title .carousel_arrows a:hover span,
	.stripe_item:after,
	.packery-item .packery_overlay {background: ' . $theme_color . ';
	}
	.gt3_module_title .carousel_arrows a:hover span:before {border-color: ' . $theme_color . ';
	}
	.learn_more:hover span,
	.gt3_module_title .carousel_arrows a span {background: ' . $header_font_color . ';
	}
	.post_media_info,
	.gt3_practice_list__filter,
	.isotope-filter {
		color: ' . $header_font_color . ';
	}

	.post_media_info:before{
		background: ' . $header_font_color . ';
	}

	.gt3_module_title .external_link .learn_more {
		line-height:' . $content_line_height . ';
	}

	.post_info {
		border-color: rgba(' . (gt3_HexToRGB($theme_color)) . ', .3);
	}

	.post_share > a:before,
	.share_wrap a span {
		font-size:' . $content_font_size . ';
	}

	ol.commentlist:after,
	.top_footer .calendar_wrap caption {
		' . (!empty($bg_body) ? 'background:' . $bg_body . ';' : '') . '
	}

	.blog_post_media__link_text a:hover,
	h3#reply-title a,
	.comment_author_says a:hover,
	.dropcap,
	.gt3_custom_text a{
		color: ' . $theme_color . ';
	}
	.single .post_tags > span,
	h3#reply-title a:hover,
	.comment_author_says,
	.comment_author_says a {
		color: ' . $header_font_color . ';
	}
	blockquote:before,
	.blog_post_media--link i,
	.blog_post_media--quote i,
	.blogpost_title i,
	.post_share:hover > a:before,
	.post_share:hover > a,
	.listing_meta .listing_meta_author a:hover ~ a,
	.likes_block:not(.already_liked):hover,
	.comment-reply-link:hover,
	#customer_login .woocommerce-LostPassword a,
	.gt3_header_builder__login-modal_container .woocommerce-LostPassword a,
	.main-menu>ul>li>a:after,
	.main-menu ul li ul li.menu-item-has-children:after, 
	.main-menu > ul > li.menu-item-has-children > a:after,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-classic .vc_tta-controls-icon,
	.gt3_twitter a,
	.gt3-page-title:not(.gt3-page-title_with_bg) .page_sub_title,
	.blog_content .post_author a:hover{
		color: ' . $theme_color2 . ';
	}

	.blog_post_media--quote,
	blockquote,
	.blog_post_media--link,
	body.wpb-js-composer .vc_row .vc_toggle_classic .vc_toggle_icon,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-style-accordion_alternative .vc_tta-controls-icon.vc_tta-controls-icon-plus::before,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-style-accordion_alternative .vc_tta-controls-icon.vc_tta-controls-icon-plus::after,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_solid .vc_tta-controls-icon:before,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_solid .vc_tta-controls-icon:after,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:before,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:after,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_alternative .vc_toggle_icon:before,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_alternative .vc_toggle_icon:after,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_solid .vc_toggle_icon:before,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_solid .vc_toggle_icon:after,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_bordered .vc_toggle_icon:before,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_bordered .vc_toggle_icon:after,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:before,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:after{
		border-color: ' . $theme_color2 . ';
	}
	.main_menu_container .menu_item_line,
	.module_testimonial .slick-dots li button,
	body.wpb-js-composer .vc_tta.vc_tta-tabs .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title>a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs .vc_tta-tab.vc_active:before,	
	body.wpb-js-composer .vc_row .vc_toggle_accordion_bordered.vc_toggle_active .vc_toggle_title:before,
	body.wpb-js-composer .vc_row .vc_toggle_accordion_solid.vc_toggle_active .vc_toggle_title,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-style-accordion_solid .vc_active .vc_tta-panel-title>a,
	body.wpb-js-composer .vc_row .vc_tta.vc_tta-style-accordion_bordered .vc_tta-panel.vc_active .vc_tta-panel-title>a:before,
	ul.pagerblock li a.current,
	ul.pagerblock li span,
	.woo_mini-count > span:not(:empty),
	.icon-box_number,
	.widget_search .search_form:before,
	.widget_product_search .woocommerce-product-search:before{
		background-color: ' . $theme_color2 . ';
	}
	
	.tagcloud a{
		color: rgba(' . (gt3_HexToRGB($content_color)) . ', .5);
	}
	.tagcloud a:hover{
		color: rgba(' . (gt3_HexToRGB($content_color)) . ', 1);
	}

	::-moz-selection{
	    background: ' . $theme_color . ';
	}
	::selection{
	    background: ' . $theme_color . ';
	}
    ';

    //sticky header logo
    $header_sticky_height = gt3_option('header_sticky_height');
    $custom_css           .= '
    .gt3_practice_list__overlay:before{
    	background-color: ' . $theme_color . ';
    }

	input::-webkit-input-placeholder,
	textarea::-webkit-input-placeholder {
		color: ' . $header_font_color . ';
	}
	input:-moz-placeholder,
	textarea:-moz-placeholder { /* Firefox 18- */
		color: ' . $header_font_color . ';
	}
	input::-moz-placeholder,
	textarea::-moz-placeholder {  /* Firefox 19+ */
		color: ' . $header_font_color . ';
	}
	input:-ms-input-placeholder,
	textarea:-ms-input-placeholder {
		color: ' . $header_font_color . ';
	}

    ';


    // footer styles
    $footer_text_color    = gt3_option_compare('footer_text_color', 'mb_footer_switch', 'yes');
    $footer_heading_color = gt3_option_compare('footer_heading_color', 'mb_footer_switch', 'yes');
    $custom_css           .= '
    .top_footer .widget-title,
	.top_footer strong,
	.top_footer .widget.widget_archive ul li > a:hover,
	.top_footer .widget.widget_categories ul li > a:hover,
	.top_footer .widget.widget_pages ul li > a:hover,
	.top_footer .widget.widget_meta ul li > a:hover,
	.top_footer .widget.widget_recent_comments ul li > a:hover,
	.top_footer .widget.widget_recent_entries ul li > a:hover,
	.top_footer .widget.widget_rss ul li > a:hover,
	.top_footer .widget.widget_nav_menu ul li > a:hover,
	.main_footer .widget .calendar_wrap thead,
	.main_footer .widget .calendar_wrap table td#today{
    	color: ' . esc_attr($footer_heading_color) . ' ;
    }
    .top_footer{
    	color: ' . esc_attr($footer_text_color) . ';
    }';

    $copyright_text_color = gt3_option_compare('copyright_text_color', 'mb_footer_switch', 'yes');
    $custom_css           .= '.main_footer .copyright{
    	color: ' . esc_attr($copyright_text_color) . ';
    }';

    $header_on_bg = '';

	$id = gt3_get_queried_object_id();
    if (class_exists('RWMB_Loader') && $id !== 0) {
        if (rwmb_meta('mb_header_on_bg') == '1' && rwmb_meta('mb_customize_header_layout', array(), $id) == 'custom') {
            $header_on_bg = rwmb_meta('mb_header_on_bg', array(), $id);

            if ($header_on_bg == '1') {
                $side_top_background_mobile = $side_middle_background_mobile = $side_bottom_background_mobile = $side_top_color_mobile = $side_middle_color_mobile = $side_bottom_color_mobile = '';

                $mb_customize_top_header_layout_mobile    = rwmb_meta('mb_customize_top_header_layout_mobile', array(), $id);
                $mb_customize_middle_header_layout_mobile = rwmb_meta('mb_customize_middle_header_layout_mobile', array(), $id);
                $mb_customize_bottom_header_layout_mobile = rwmb_meta('mb_customize_bottom_header_layout_mobile', array(), $id);

                if ($mb_customize_top_header_layout_mobile == 'custom') {
                    //top
                    $mb_top_header_background_mobile         = rwmb_meta('mb_top_header_background_mobile', array(), $id);
                    $mb_top_header_background_opacity_mobile = rwmb_meta('mb_top_header_background_opacity_mobile', array(), $id);
                    $side_top_color_mobile                   = rwmb_meta('mb_top_header_color_mobile', array(), $id);

                    if (!empty($mb_top_header_background_mobile)) {
                        $side_top_background_mobile = 'rgba(' . (gt3_HexToRGB($mb_top_header_background_mobile)) . ',' . $mb_top_header_background_opacity_mobile . ')';
                    } else {
                        $side_top_background_mobile = '';
                    }
                }

                if ($mb_customize_middle_header_layout_mobile == 'custom') {
                    //middle
                    $mb_middle_header_background_mobile         = rwmb_meta('mb_middle_header_background_mobile', array(), $id);
                    $mb_middle_header_background_opacity_mobile = rwmb_meta('mb_middle_header_background_opacity_mobile', array(), $id);
                    $side_middle_color_mobile                   = rwmb_meta('mb_middle_header_color_mobile', array(), $id);

                    if (!empty($mb_middle_header_background_mobile)) {
                        $side_middle_background_mobile = 'rgba(' . (gt3_HexToRGB($mb_middle_header_background_mobile)) . ',' . $mb_middle_header_background_opacity_mobile . ')';
                    } else {
                        $side_middle_background_mobile = '';
                    }
                }

                if ($mb_customize_bottom_header_layout_mobile == 'custom') {
                    //bottom
                    $mb_bottom_header_background_mobile         = rwmb_meta('mb_bottom_header_background_mobile');
                    $mb_bottom_header_background_opacity_mobile = rwmb_meta('mb_bottom_header_background_opacity_mobile');
                    $side_bottom_color_mobile                   = rwmb_meta('mb_bottom_header_color_mobile', array(), $id);

                    if (!empty($mb_bottom_header_background_mobile)) {
                        $side_bottom_background_mobile = 'rgba(' . (gt3_HexToRGB($mb_bottom_header_background_mobile)) . ',' . $mb_bottom_header_background_opacity_mobile . ')';
                    } else {
                        $side_bottom_background_mobile = '';
                    }
                }
            }
        }
    }

    if ($header_on_bg == '1') {
        foreach ($desktop_sides as $desktop_side) {
            $custom_css .= '@media only screen and (max-width: 767px){
                .gt3_header_builder__section--'.esc_attr($desktop_side).'{'
                . (!empty(${'side_' . $desktop_side . '_background_mobile'}) ? 'background-color: ' . esc_attr(${'side_' . $desktop_side . '_background_mobile'}) . ' !important;' : '')
                . (!empty(${'side_' . $desktop_side . '_color_mobile'}) ? 'color: ' . esc_attr(${'side_' . $desktop_side . '_color_mobile'}) . ' !important;' : '') . '
                }
            }';
        }
    }

    foreach ($sections as $section) {
        $custom_css .= '
        .gt3_header_builder__section--'.$section.'{
            background-color:' . esc_attr(${'side_' . $section . '_background'}) . ';
            color:' . esc_attr(${'side_' . $section . '_color'}) . ';
           /* height:' . (int)${'side_' . $section . '_height'} . 'px;*/
        }
        .gt3_header_builder__section--'.$section.' .gt3_header_builder__section-container{
            height:' . (int)${'side_' . $section . '_height'} . 'px;
        }
        .gt3_header_builder__section--'.$section.' ul.menu{
            line-height:' . (int)${'side_' . $section . '_height'} . 'px;
        }
        ';

        if (${'side_' . $section . '_border'}) {
            if (!empty(${'side_' . $section . '_border_color'}['rgba'])) {
                $custom_css .= '
                .gt3_header_builder__section--' . $section . '{
                    border-bottom: 1px solid ' . esc_attr(${'side_' . $section . '_border_color'}['rgba']) . ';
                }';
            }
        }
    }


    $custom_css .= '
    .tp-bullets.custom .tp-bullet:after,
    .tp-bullets.custom .tp-bullet:hover:after,
	.tp-bullets.custom .tp-bullet.selected:after {
		background: ' . $theme_color2 . ';
	}
    ';


    /* List Wine */
    $custom_css .= '
	.main_wrapper ul li:before,
	.main_footer ul li:before,
	.main_wrapper ol > li:before{
		color: ' . $content_color . ';
	}
	ul li{
		list-style: disc url(\'data:image/svg+xml; utf8, <svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="10" width="10" fill="rgb(' . gt3_HexToRGB($theme_color2). ')"><circle cx="5" cy="5" r="2.5" /></svg>\');
	}
	.main_wrapper ul.gt3_list_wine li:before{
    	content: url(\'data:image/svg+xml; utf8, <svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="40" fill="rgb(' . gt3_HexToRGB($content_color). ')"><circle cx="10" cy="10" r="6" /><circle cx="30" cy="10" r="6" /><circle cx="20" cy="25" r="6" /></svg>\');
    }';



    if ((bool)$header_sticky) {
        foreach ($desktop_sides as $sticky_side) {
            if ((bool)${'side_' . $sticky_side . '_sticky'}) {
                ${'side_' . $sticky_side . '_background_sticky'} = ${'side_' . $sticky_side . '_background_sticky'}['rgba'];
                ${'side_' . $sticky_side . '_height_sticky'} = ${'side_' . $sticky_side . '_height_sticky'}['height'];
                $custom_css .= '
                .sticky_header .gt3_header_builder__section--' . $sticky_side . '{
                    background-color:' . esc_attr(${'side_' . $sticky_side . '_background_sticky'}) . ';
                    color:' . esc_attr(${'side_' . $sticky_side . '_color_sticky'}) . ';
                }
                .sticky_header .gt3_header_builder__section--' . $sticky_side . ' .gt3_header_builder__section-container{
                    height:' . (int)${'side_' . $sticky_side . '_height_sticky'} . 'px;
                }
                .sticky_header .gt3_header_builder__section--' . $sticky_side . ' ul.menu{
                    line-height:' . (int)${'side_' . $sticky_side . '_height_sticky'} . 'px;
                }';
            }
        }
    }

    /* Booked Appointments */
    $custom_css .= '
	body table.booked-calendar thead th {
		/*background: ' . $theme_color . ' !important;*/
	}
	body table.booked-calendar tr.days,
	body table.booked-calendar tr.days th,
	body .booked-modal p.booked-title-bar{
		background: ' . $theme_color2 . ' !important;
	}
	#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td.ui-datepicker-today a,
	#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td.ui-datepicker-today a:hover,
	body #booked-profile-page input[type=submit].button-primary,
	body table.booked-calendar input[type=submit].button-primary,
	body .booked-list-view button.button,
	body .booked-list-view input[type=submit].button-primary,
	body .booked-modal input[type=submit].button-primary,
	body #booked-profile-page .booked-profile-appt-list .appt-block.approved .status-block,
	body #booked-profile-page .appt-block .google-cal-button > a,
	body .booked-modal p.booked-title-bar,
	body table.booked-calendar td:hover .date span,
	body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active,
	body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover,
	.booked-ms-modal .booked-book-appt {
		background:' . $theme_color2 . ';
	}
	body #booked-profile-page input[type=submit].button-primary,
	body table.booked-calendar input[type=submit].button-primary,
	body .booked-list-view button.button,
	 body .booked-list-view input[type=submit].button-primary,
	body .booked-modal input[type=submit].button-primary,
	body #booked-profile-page .appt-block .google-cal-button > a,
	body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,
	body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active{
		border-color:' . $theme_color2 . ';
	}
	body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover {
	
	}
	body .booked-modal .bm-window p i.fa,body .booked-modal .bm-window a,
	body .booked-appt-list .booked-public-appointment-title,
	body .booked-modal .bm-window p.appointment-title,
	.booked-ms-modal.visible:hover .booked-book-appt,
	body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-title {
		color:' . $theme_color . ';
	}
	.booked-appt-list .timeslot.has-title .booked-public-appointment-title {
		color:inherit;
	}
	body table.booked-calendar td.today .date span {
		border:1px solid ' . $theme_color2 . ';
	}
	body table.booked-calendar td.today:hover .date span {
		background:' . $theme_color . ' !important;
	}
	body .booked-form .field label.field-label,
	body .booked-modal .bm-window p.appointment-info {
		color:' . $header_font_color . ';
	}
	body #booked-profile-page input[type="submit"],
	body #booked-profile-page button,
	body .booked-list-view input[type="submit"],
	body .booked-list-view button,
	body table.booked-calendar input[type="submit"],
	body table.booked-calendar button,
	body .booked-modal input[type="submit"],
	body .booked-modal button {
		font-family:' . $content_font_family . ';
	}
	body .booked-modal button.cancel {
		/*border-color:' . $theme_color . ' !important;*/
	}

	.gt3_services_box_content {
		background: ' . $theme_color . ';
		font-family:' . $content_font_family . ';
	}
	.gt3_services_img_bg {
		background-color: ' . $theme_color . ';
	}
	body table.booked-calendar tr.days,
	body table.booked-calendar tr.week{
		' . (!empty($content_font_family2) ? 'font-family:' . $content_font_family2 . ';' : '') . '
		' . (!empty($content_font_weight2) ? 'font-weight:' . $content_font_weight2 . ';' : '') . '
	}
	body .tooltipster-light .tooltipster-content,
	body #booked-profile-page input[type=submit].button-primary,
	body table.booked-calendar input[type=submit].button-primary,
	body .booked-list-view button.button,
	 body .booked-list-view input[type=submit].button-primary,
	body .booked-modal input[type=submit].button-primary,
	body #booked-profile-page .appt-block .google-cal-button > a,
	body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,
	body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active{
		' . (!empty($content_font_family2) ? 'font-family:' . $content_font_family2 . ';' : '') . '
    }
	body table.booked-calendar td.today.prev-date .date span,
	body table.booked-calendar td.today:hover .date,
	body table.booked-calendar td.today .date,
	body table.booked-calendar td.today .date span,
	body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time{
		color:' . $content_color . ' !important;
	}
	body .booked-form .booked-appointments .appointment-info i,
	body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time i.booked-icon,
    body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button:hover,
    body .booked-modal input[type="submit"].button-primary:hover,
    body .booked-modal button.cancel:hover,
    .woocommerce div.product > .woocommerce-tabs ul.tabs li.active a{
		color:' . $theme_color2 . ';
	}
	';
    /* Booked Appointments end */

    // WooCommerce
    $custom_css .= '
	.woocommerce table.shop_table .product-quantity .qty.allotted,
	.woocommerce div.product form.cart .qty.allotted,
    .widget_product_search .woocommerce-product-search .search-field,
    .gt3-page-title__content .gt3_breadcrumb .woocommerce-breadcrumb span:last-child:not(:first-child),
    .main_wrapper .image_size_popup_button,
    .clear_recently_products{
        color: '.$header_font_color.';
    }
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .gt3_woocommerce_open_control_tag a.button,    
    .woocommerce #reviews #respond input#submit, 
    .woocommerce #reviews a.button, 
    .woocommerce #reviews button.button, 
    .woocommerce #reviews input.button,
    .woocommerce .woocommerce-message a.button, 
    .woocommerce .woocommerce-error a.button, 
    .woocommerce .woocommerce-info a.button,
    .woocommerce .cart .button, 
    .woocommerce .cart input.button,
    .woocommerce #respond input#submit, .woocommerce a.button, 
    .woocommerce button.button, 
    .woocommerce input.button{
        background-color: '.$theme_color2.';
	}
	
	.woocommerce nav.woocommerce-pagination ul li a,
	.woocommerce nav.woocommerce-pagination ul li span,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button{
		font-family: ' . $content_font_family2 . ';
	}
	.quantity-spinner.quantity-up:hover,
	.quantity-spinner.quantity-down:hover,
	.woocommerce .gt3-products-header .gridlist-toggle:hover,
    .main_wrapper .image_size_popup_button:hover,
    .main_wrapper .gt3_product_list_nav li .product_list_nav_text .nav_title,
    .clear_recently_products:hover,
    .single-product.woocommerce div.product .product_meta .sku,    
    .single-product.woocommerce div.product .product_meta a{
		color: '.$theme_color.';
	}

	.woocommerce #respond input#submit,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce #reviews #respond input#submit,
	.woocommerce #reviews a.button,
	.woocommerce #reviews button.button,
	.woocommerce #reviews input.button{
		color: '.$theme_color.';
		border-color: '.$theme_color2.';
	}
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit.alt:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce input.button.alt:hover,
	.woocommerce #reviews #respond input#submit:hover,
	.woocommerce #reviews a.button:hover,
	.woocommerce #reviews button.button:hover,
	.woocommerce #reviews input.button:hover,
	.woocommerce #respond input#submit.disabled:hover,
	.woocommerce #respond input#submit:disabled:hover,
	.woocommerce #respond input#submit:disabled[disabled]:hover,
	.woocommerce a.button.disabled:hover,
	.woocommerce a.button:disabled:hover,
	.woocommerce a.button:disabled[disabled]:hover,
	.woocommerce button.button.disabled:hover,
	.woocommerce button.button:disabled:hover,
	.woocommerce button.button:disabled[disabled]:hover,
	.woocommerce input.button.disabled:hover,
	.woocommerce input.button:disabled:hover,
	.woocommerce input.button:disabled[disabled]:hover{
		border-color: '.$theme_color.';
		background-color: '.$theme_color.';
	}
	.woocommerce div.product form.cart div.quantity:hover,
	.woocommerce div.product form.cart div.quantity:focus,
	.woocommerce div.product form.cart div.quantity:focus-within{
		border-bottom-color: '.$theme_color2.';
	}
	.woocommerce div.product p.price,
	.woocommerce div.product span.price,
	.woocommerce ul.products li.product .price,
	.woocommerce ul.product_list_widget li .price,
    .woocommerce #respond input#submit.alt:hover, 
    .woocommerce a.button.alt:hover, 
    .woocommerce button.button.alt:hover, 
    .woocommerce input.button.alt:hover,
    .woocommerce #reviews #respond input#submit:hover,
    .woocommerce #reviews a.button:hover,
    .woocommerce #reviews button.button:hover,
    .woocommerce #reviews input.button:hover,
    .woocommerce-cart table.cart td.actions > .button:hover{
		color: '.$theme_color2.';
	}

	.woocommerce #respond input#submit.alt.disabled,
	.woocommerce #respond input#submit.alt:disabled,
	.woocommerce #respond input#submit.alt:disabled[disabled],
	.woocommerce a.button.alt.disabled,
	.woocommerce a.button.alt:disabled,
	.woocommerce a.button.alt:disabled[disabled],
	.woocommerce button.button.alt.disabled,
	.woocommerce button.button.alt:disabled,
	.woocommerce button.button.alt:disabled[disabled],
	.woocommerce input.button.alt.disabled,
	.woocommerce input.button.alt:disabled,
	.woocommerce input.button.alt:disabled[disabled]{
		color: '.$theme_color.';
		border-color: '.$theme_color2.';
	}
	.woocommerce #respond input#submit.alt.disabled:hover,
	.woocommerce #respond input#submit.alt:disabled:hover,
	.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
	.woocommerce a.button.alt.disabled:hover,
	.woocommerce a.button.alt:disabled:hover,
	.woocommerce a.button.alt:disabled[disabled]:hover,
	.woocommerce button.button.alt.disabled:hover,
	.woocommerce button.button.alt:disabled:hover,
	.woocommerce button.button.alt:disabled[disabled]:hover,
	.woocommerce input.button.alt.disabled:hover,
	.woocommerce input.button.alt:disabled:hover,
	.woocommerce input.button.alt:disabled[disabled]:hover{
		background-color: '.$theme_color.';
		border-color: '.$theme_color.';
	}

	.image_size_popup .close,
	#yith-quick-view-content .product_meta,
	.single-product.woocommerce div.product .product_meta,
	.woocommerce div.product form.cart .variations td,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	.woocommerce .widget_shopping_cart .total,
	.woocommerce.widget_shopping_cart .total,
	.woocommerce table.shop_table thead th,
	.woocommerce table.woocommerce-checkout-review-order-table tfoot td .woocommerce-Price-amount{
		color: '.$header_font_color.';
	}
	#yith-quick-view-content .product_meta a,
	#yith-quick-view-content .product_meta .sku,
    .select2-container--default .select2-selection--single .select2-selection__rendered{
		color: '.$content_color.';
	}
	#yith-quick-view-content .product_meta a:hover,
	.single-product.woocommerce div.product .product_meta a:hover,
    .woocommerce #respond input#submit:hover,
    .woocommerce a.button:hover,
    .woocommerce button.button:hover,
    .woocommerce input.button:hover,
    .woocommerce #respond input#submit.alt.disabled:hover,
    .woocommerce #respond input#submit.alt:disabled:hover,
    .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
    .woocommerce a.button.alt.disabled:hover,
    .woocommerce a.button.alt:disabled:hover,
    .woocommerce a.button.alt:disabled[disabled]:hover,
    .woocommerce button.button.alt.disabled:hover,
    .woocommerce button.button.alt:disabled:hover,
    .woocommerce button.button.alt:disabled[disabled]:hover,
    .woocommerce input.button.alt.disabled:hover,
    .woocommerce input.button.alt:disabled:hover,
    .woocommerce input.button.alt:disabled[disabled]:hover{
		color: '.$theme_color2.';
	}

	.woocommerce .star-rating::before,
	.woocommerce #reviews p.stars span a,
	.woocommerce p.stars span a:hover~a::before,
	.woocommerce p.stars.selected span a.active~a::before{
		color: '.$content_color.';
	}
	
	.woocommerce-Reviews #respond form#commentform > p{
		color: '.$theme_color.';
	}
	.woocommerce.single-product #respond #commentform input[type="date"]:focus,
	.woocommerce.single-product #respond #commentform input[type="email"]:focus,
	.woocommerce.single-product #respond #commentform input[type="number"]:focus,
	.woocommerce.single-product #respond #commentform input[type="password"]:focus,
	.woocommerce.single-product #respond #commentform input[type="search"]:focus,
	.woocommerce.single-product #respond #commentform input[type="tel"]:focus,
	.woocommerce.single-product #respond #commentform input[type="text"]:focus,
	.woocommerce.single-product #respond #commentform input[type="url"]:focus,
	.woocommerce.single-product #respond #commentform select:focus,
	.woocommerce.single-product #respond #commentform textarea:focus{
		border-bottom-color: '.$theme_color2.';
	}
	.woocommerce nav.woocommerce-pagination ul li span.current,
    .woocommerce #respond input#submit.alt, 
    .woocommerce a.button.alt, 
    .woocommerce button.button.alt, 
    .woocommerce input.button.alt{
		background-color: '.$theme_color2.';
	}
	.woocommerce nav.woocommerce-pagination ul li a:focus,
	.woocommerce nav.woocommerce-pagination ul li a:hover{
		color: '.$theme_color2.';
	}
	.woocommerce .woocommerce-ordering select,
	.woocommerce .gridlist-toggle,
	.woocommerce .gt3-products-header .gt3-gridlist-toggle{
		background-color: '.$bg_body.';
	}
	';


	$label_color_sale = gt3_option('label_color_sale');
	$label_color_hot  = gt3_option('label_color_hot');
	$label_color_new  = gt3_option('label_color_new');
	if (is_array($label_color_sale) && isset($label_color_sale['rgba'])) {
		$custom_css .= '
		.woocommerce ul.products li.product .onsale,
		#yith-quick-view-content .onsale,
		.woocommerce span.onsale{
			background-color: '.esc_attr($label_color_sale['rgba']).';
		}';
	}
	if (is_array($label_color_hot) && isset($label_color_hot['rgba'])) {
		$custom_css .= '
		.woocommerce ul.products li.product .onsale.hot-product,
		#yith-quick-view-content .onsale.hot-product,
		.woocommerce span.onsale.hot-product{
			background-color: '.esc_attr($label_color_hot['rgba']).';
		}';
	}
	if (is_array($label_color_new) && isset($label_color_new['rgba'])) {
		$custom_css .= '
		.woocommerce ul.products li.product .onsale.new-product,
		#yith-quick-view-content .onsale.new-product,
		.woocommerce span.onsale.new-product{
			background-color: '.esc_attr($label_color_new['rgba']).';
		}';
	}
    // WooCommerce end


    $custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '	', '	'), '', $custom_css);
    if (wp_style_is('gt3-responsive')) {
        wp_add_inline_style('gt3-responsive', $custom_css);
    } else {
        wp_add_inline_style('gt3-theme', $custom_css);
    }
}

add_action('wp_enqueue_scripts', 'gt3_custom_styles');
