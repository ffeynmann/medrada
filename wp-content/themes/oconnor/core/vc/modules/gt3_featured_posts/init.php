<?php
if (!defined('ABSPATH')) {
    die('-1');
}

$header_font = gt3_option('header-font');
$main_font   = gt3_option('main-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'base'        => 'gt3_featured_posts',
        'name'        => esc_html__('Featured Blog Posts', 'oconnor'),
        "description" => esc_html__("Display the featured blog posts", 'oconnor'),
        'category'    => esc_html__('GT3 Modules', 'oconnor'),
        'icon'        => 'gt3_icon',
        'params'      => array(
            array(
                'type'        => 'loop',
                'heading'     => esc_html__('Blog Items', 'oconnor'),
                'param_name'  => 'build_query',
                'settings'    => array(
                    'size'       => array('hidden' => false, 'value' => 4 * 3),
                    'order_by'   => array('value' => 'date'),
                    'post_type'  => array('value' => 'post', 'hidden' => true),
                    'categories' => array('hidden' => false),
                    'tags'       => array('hidden' => false)
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'oconnor')
            ),
            // Module Title
            array(
                "type"        => "textfield",
                'heading'     => esc_html__('Module title', 'oconnor'),
                "param_name"  => "module_title",
                "value"       => "",
                "description" => esc_html__("Enter text used as module title (Note: located above content element).", 'oconnor')
            ),
            // Link Text
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Module Link Text", 'oconnor'),
                "param_name"  => "external_link_text",
                "value"       => "",
                "description" => esc_html__("Text on the module link.", 'oconnor'),
            ),
            // Link Setts
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__('Module Link', 'oconnor'),
                'param_name' => 'external_link',
                "dependency" => Array("element" => "external_link_text", "not_empty" => true),
            ),
            // View Type
            array(
                'type'       => 'gt3_dropdown',
                'class'      => '',
                'heading'    => esc_html__('Style select', 'oconnor'),
                'param_name' => 'view_type',
                'fields'     => array(
                    'type1' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type1.jpg',
                        'descr' => esc_html__('Type 1', 'oconnor')
                    ),
                    'type2' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type2.jpg',
                        'descr' => esc_html__('Type 2', 'oconnor')
                    ),
                    'type3' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type3.jpg',
                        'descr' => esc_html__('Type 3', 'oconnor')
                    ),
                    'type4' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type4.jpg',
                        'descr' => esc_html__('Type 4', 'oconnor')
                    ),
                    'type5' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type5.jpg',
                        'descr' => esc_html__('Type 5', 'oconnor')
                    ),
                ),
                'value'      => 'type5',
            ),
            // Post meta
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Allow uppercase post-meta text?', 'oconnor'),
                'param_name'  => 'post_meta_uppercase',
                'description' => esc_html__('If checked, allow uppercase post-meta text.', 'oconnor'),
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'         => 'no',
            ),
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Show post-meta author?', 'oconnor'),
                'param_name'       => 'meta_author',
                'description'      => esc_html__('If checked, post-meta will have author.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Show post-meta comments?', 'oconnor'),
                'param_name'       => 'meta_comments',
                'description'      => esc_html__('If checked, post-meta will have comments.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Show post-meta categories?', 'oconnor'),
                'param_name'       => 'meta_categories',
                'description'      => esc_html__('If checked, post-meta will have categories.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'edit_field_class' => 'vc_col-sm-4',
                'std'              => 'no',
            ),
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Show post-meta date?', 'oconnor'),
                'param_name'       => 'meta_date',
                'description'      => esc_html__('If checked, post-meta will have date.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'yes',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Post Format Label
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Show post-format label?', 'oconnor'),
                'param_name'       => 'pf_post_icon',
                'description'      => esc_html__('If checked, post-format label will be visible.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"       => Array("element" => "view_type", "value" => array("type4", "type5"))
            ),
            // Post Read More Link
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Show post read more link?', 'oconnor'),
                'param_name'       => 'post_read_more_link',
                'description'      => esc_html__('If checked, post read more link will be visible.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'edit_field_class' => 'vc_col-sm-4',
                'std'              => 'yes',
                "dependency"       => Array("element" => "view_type", "value" => array("type4", "type5"))
            ),
            // Pagination
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Show Pagination?', 'oconnor'),
                'param_name'       => 'pagination',
                'description'      => esc_html__('If checked, pagination will be visible.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Sticky Post First
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Show Sticky Post First?', 'oconnor'),
                'param_name'       => 'sticky_post_first',
                'description'      => esc_html__('If checked, sticky post will be first.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Full Width
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Full Width image style?', 'oconnor'),
                'param_name'       => 'show_on_full_width',
                'description'      => esc_html__('If checked, featured image will be biggest.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Boxed
            array(
                'type'             => 'gt3_on_off',
                'heading'          => esc_html__('Allow boxed text content?', 'oconnor'),
                'param_name'       => 'boxed_text_content',
                'description'      => esc_html__('If checked, allow boxed text content.', 'oconnor'),
                'value'            => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'              => 'no',
                "dependency"       => Array("element" => "view_type", "value" => array("type3", "type4")),
            ),
            // Image Proportions
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Image Proportions', 'oconnor'),
                'param_name'  => 'image_proportions',
                "value"       => array(
                    esc_html__('4/3', 'oconnor')        => '4_3',
                    esc_html__('Horizontal', 'oconnor') => 'horizontal',
                    esc_html__('Vertical', 'oconnor')   => 'vertical',
                    esc_html__('Square', 'oconnor')     => 'square',
                    esc_html__('Original', 'oconnor')   => 'original'
                ),
                'std'         => 'square',
                "description" => esc_html__("Select image proportions.", 'oconnor'),
                "dependency"  => Array("element" => "view_type", "value" => array("type3", "type4")),
            ),
            // Items per line
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Items Per Line', 'oconnor'),
                'param_name'  => 'items_per_line',
                'options'     => array(
                    esc_html__('1', 'oconnor') => '1',
                    esc_html__('2', 'oconnor') => '2',
                    esc_html__('3', 'oconnor') => '3',
                    esc_html__('4', 'oconnor') => '4'
                ),
                "description" => esc_html__("Select post items per line.", 'oconnor'),
                "dependency"  => array(
                    "element" => "view_type",
                    "value"   => array("type3", "type4", "type5")
                ),
            ),
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Items Per Line', 'oconnor'),
                'param_name'  => 'items_per_line_type2',
                'options'     => array(
                    esc_html__('1', 'oconnor') => '1',
                    esc_html__('2', 'oconnor') => '2'
                ),
                "description" => esc_html__("Select post items per line.", 'oconnor'),
                "dependency"  => Array("element" => "view_type", "value" => array("type2")),
            ),
            // Spacing beetween items
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Spacing beetween items', 'oconnor'),
                'param_name'  => 'spacing_beetween_items',
                'options'     => array(
                    esc_html__('30px', 'oconnor') => '30',
                    esc_html__('25px', 'oconnor') => '25',
                    esc_html__('20px', 'oconnor') => '20',
                    esc_html__('15px', 'oconnor') => '15',
                    esc_html__('10px', 'oconnor') => '10',
                    esc_html__('5px', 'oconnor')  => '5'
                ),
                "description" => esc_html__("Select spacing beetween items.", 'oconnor'),
                "dependency"  => array(
                    "element" => "view_type",
                    "value"   => array("type2", "type3", "type4", "type5")
                ),
            ),
            // Border radius beetween items
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Items Border Radius', 'oconnor'),
                'param_name'  => 'block_border_radius',
                'options'     => array(
                    esc_html__('0px', 'oconnor')  => '0px',
                    esc_html__('5px', 'oconnor')  => '5px',
                    esc_html__('10px', 'oconnor') => '10px',
                    esc_html__('15px', 'oconnor') => '15px',
                    esc_html__('20px', 'oconnor') => '20px',
                    esc_html__('25px', 'oconnor') => '25px',
                    esc_html__('30px', 'oconnor') => '30px',
                ),
                "description" => esc_html__("Select block border radius", 'oconnor'),
                "dependency"  => Array("element" => "view_type", "value" => array("type5")),
            ),
            // Media overlay
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Add Overlay on Media block', 'oconnor'),
                'param_name' => 'media_overlay',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',
                "dependency" => Array("element" => "view_type", "value" => array("type5")),
            ),
            array(
                "type"        => "colorpicker",
                "class"       => "",
                "heading"     => esc_html__("Overlay Color", 'oconnor'),
                "param_name"  => "media_overlay_color",
                "value"       => 'rgba(0,0,0,0.3)',
                "description" => esc_html__("Select custom overlay color.", 'oconnor'),
                'dependency'  => array(
                    'element' => 'media_overlay',
                    'value'   => 'yes',
                ),
            ),
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Make first post with image', 'oconnor'),
                'param_name'  => 'first_post_image',
                'description' => esc_html__('If checked, make first post with image.', 'oconnor'),
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                "dependency"  => array("element" => "view_type", "value" => array("type1")),
                'save_always' => true,
                'std'         => 'yes'
            ),
            // Content alignment
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Content alignment', 'oconnor'),
                'param_name'  => 'content_alignment',
                'options'     => array(
                    esc_html__('Left', 'oconnor')    => 'left',
                    esc_html__('Center', 'oconnor')  => 'center',
                    esc_html__('Right', 'oconnor')   => 'right',
                    esc_html__('Justify', 'oconnor') => 'justify'
                ),
                "description" => esc_html__("Select content alignment.", 'oconnor'),
                "dependency"  => Array("element" => "view_type", "value" => array("type3", "type4", "type5")),
            ),
            // Content Letter Count
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Content Letter Count', 'oconnor'),
                'param_name'       => 'content_letter_count',
                'value'            => '160',
                'description'      => esc_html__('Enter content letter count.', 'oconnor'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- CAROUSEL GROUP --- //
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Use blog-posts carousel?', 'oconnor'),
                'param_name' => 'use_carousel',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',
                "group"      => esc_html__("Carousel", 'oconnor')
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Autoplay carousel', 'oconnor'),
                'param_name' => 'autoplay_carousel',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value"   => array("yes")
                ),
                "group"      => esc_html__("Carousel", 'oconnor'),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Autoplay time.', 'oconnor'),
                'param_name'  => 'auto_play_time',
                'value'       => '3000',
                'description' => esc_html__('Enter autoplay time in milliseconds.', 'oconnor'),
                'dependency'  => array(
                    'element' => 'autoplay_carousel',
                    'value'   => array("yes"),
                ),
                "group"       => esc_html__("Carousel", 'oconnor'),
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Single slide to scroll', 'oconnor'),
                'param_name' => 'scroll_items',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                "group"      => esc_html__("Carousel", 'oconnor'),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value"   => array("yes")
                ),
                'std'        => 'yes',
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Infinite Scroll', 'oconnor'),
                'param_name' => 'infinite_scroll',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value"   => array("yes")
                ),
                "group"      => esc_html__("Carousel", 'oconnor'),
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Hide Pagination control', 'oconnor'),
                'param_name' => 'use_pagination_carousel',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value"   => array("yes")
                ),
                "group"      => esc_html__("Carousel", 'oconnor'),
                'std'        => 'yes',
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Hide prev/next buttons', 'oconnor'),
                'param_name' => 'use_prev_next_carousel',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'no',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value"   => array("yes")
                ),
                "group"      => esc_html__("Carousel", 'oconnor'),
            ),
            array(
                'type'       => 'gt3_on_off',
                'heading'    => esc_html__('Adaptive Height', 'oconnor'),
                'param_name' => 'adaptive_height',
                'value'      => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'std'        => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value"   => array("yes")
                ),
                "group"      => esc_html__("Carousel", 'oconnor'),
            ),
            array(
                'type'        => 'gt3_custom_select',
                'heading'     => esc_html__('Items Per Column', 'oconnor'),
                'param_name'  => 'items_per_column',
                'options'     => array(
                    esc_html__('1', 'oconnor') => '1',
                    esc_html__('2', 'oconnor') => '2',
                    esc_html__('3', 'oconnor') => '3',
                    esc_html__('4', 'oconnor') => '4'
                ),
                "description" => esc_html__("Select post items per column.", 'oconnor'),
                'dependency'  => array(
                    'element' => 'use_carousel',
                    "value"   => array("yes")
                ),
                "group"       => esc_html__("Carousel", 'oconnor'),
            ),
            // --- CUSTOM GROUP --- //
            // Blog Font
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family for blog?', 'oconnor'),
                'param_name'  => 'use_theme_fonts_blog',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                "group"       => esc_html__("Custom", 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value'      => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
                'dependency' => array(
                    'element'            => 'use_theme_fonts_blog',
                    'value_not_equal_to' => 'yes',
                ),
                "group"      => esc_html__("Custom", 'oconnor'),
            ),
            // Blog Headings Font
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default font family for blog headings?', 'oconnor'),
                'param_name'  => 'use_theme_fonts_blog_headings',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use font family from the theme.', 'oconnor'),
                "group"       => esc_html__("Custom", 'oconnor'),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'google_fonts',
                'param_name' => 'google_fonts_blog_headings',
                'value'      => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => esc_html__('Select font family.', 'oconnor'),
                        'font_style_description'  => esc_html__('Select font styling.', 'oconnor'),
                    ),
                ),
                'dependency' => array(
                    'element'            => 'use_theme_fonts_blog_headings',
                    'value_not_equal_to' => 'yes',
                ),
                "group"      => esc_html__("Custom", 'oconnor'),
            ),
            array(
                'type'        => 'gt3_on_off',
                'heading'     => esc_html__('Use theme default blog style?', 'oconnor'),
                'param_name'  => 'use_theme_blog_style',
                'value'       => array(esc_html__('Yes', 'oconnor') => 'yes'),
                'description' => esc_html__('Use default blog style from the theme.', 'oconnor'),
                "group"       => esc_html__("Custom", 'oconnor'),
                'std'         => 'yes',
            ),
            // Custom blog style
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Custom Theme Color", 'oconnor'),
                "param_name"       => "custom_theme_color",
                "value"            => esc_attr(gt3_option("theme-custom-color")),
                "description"      => esc_html__("Select custom theme color.", 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Custom Headings Color", 'oconnor'),
                "param_name"       => "custom_headings_color",
                "value"            => esc_attr($header_font['color']),
                "description"      => esc_html__("Select custom headings color.", 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                "type"             => "colorpicker",
                "class"            => "",
                "heading"          => esc_html__("Custom Content Color", 'oconnor'),
                "param_name"       => "custom_content_color",
                "value"            => esc_attr($main_font['color']),
                "description"      => esc_html__("Select custom content color.", 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Heading Font Size
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Heading Font Size', 'oconnor'),
                'param_name'       => 'heading_font_size',
                'value'            => '18',
                'description'      => esc_html__('Enter heading font-size in pixels.', 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Heading Font Size
            array(
                'type'             => 'textfield',
                'heading'          => esc_html__('Content Font Size', 'oconnor'),
                'param_name'       => 'content_font_size',
                'value'            => '16',
                'description'      => esc_html__('Enter content font-size in pixels.', 'oconnor'),
                'dependency'       => array(
                    'element'            => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group"            => esc_html__("Custom", 'oconnor'),
                'save_always'      => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation(true),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Extra Class", 'oconnor'),
                "param_name"  => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'oconnor')
            ),
        ),

    ));

    class WPBakeryShortCode_Gt3_Featured_Posts extends WPBakeryShortCode {
    }
}