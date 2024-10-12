<?php


if (!class_exists('RWMB_Loader')) {
    return;
}

add_filter('rwmb_meta_boxes', 'gt3_pteam_meta_boxes');
function gt3_pteam_meta_boxes($meta_boxes) {
    $meta_boxes[] = array(
        'title'      => esc_html__('Team Options', 'oconnor'),
        'post_types' => array('team'),
        'context'    => 'advanced',
        'fields'     => array(
            array(
                'name'  => esc_html__('Member Job', 'oconnor'),
                'id'    => 'position_member',
                'type'  => 'text',
                'class' => 'field-inputs'
            ),

            array(
                'name' => esc_html__('Short Description', 'oconnor'),
                'id'   => 'member_short_desc',
                'type' => 'wysiwyg',
                'options' => array(
                    'textarea_rows' => 4,
                ),
            ),
            array(
                'name'    => esc_html__('VCard', 'oconnor'),
                'id'      => 'member_vcard',
                'type'    => 'social',
                'options' => array(
                    'name'    => array(
                        'name'       => esc_html__('Title', 'oconnor'),
                        'type_input' => "text"
                    ),
                    'address' => array(
                        'name'       => esc_html__('Url', 'oconnor'),
                        'type_input' => "text"
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Fields', 'oconnor'),
                'id'         => 'social_url',
                'type'       => 'social',
                'clone'      => true,
                'sort_clone' => true,
                'desc'       => esc_html__('Description', 'oconnor'),
                'options'    => array(
                    'name'        => array(
                        'name'       => esc_html__('Title', 'oconnor'),
                        'type_input' => "text"
                    ),
                    'description' => array(
                        'name'       => esc_html__('Text', 'oconnor'),
                        'type_input' => "text"
                    ),
                    'address'     => array(
                        'name'       => esc_html__('Url', 'oconnor'),
                        'type_input' => "text"
                    ),
                ),
            ),
	        array(
		        'name'       => esc_html__('Fields Color', 'oconnor'),
		        'desc'       => esc_html__('Title Color', 'oconnor'),
		        'class'      => 'no-border',
		        'id'         => "mb_social_title_color",
		        'type'       => 'color',
		        'std'        => '#272b2e',
		        'js_options' => array(
			        'defaultColor' => '#272b2e',
		        ),
	        ),
	        array(
		        'name'       => ' ', // alt + 0160
		        'desc'       => esc_html__('Text Color', 'oconnor'),
		        'class'      => 'no-border',
		        'id'         => "mb_social_text_color",
		        'type'       => 'color',
		        'std'        => '#80858b',
		        'js_options' => array(
			        'defaultColor' => '#80858b',
		        ),
	        ),
            array(
                'name'        => esc_html__('Icons', 'oconnor'),
                'id'          => "icon_selection",
                'type'        => 'select_icon',
                'options'     => function_exists('gt3_get_all_icon') ? gt3_get_all_icon() : '',
                'clone'       => true,
                'sort_clone'  => true,
                'placeholder' => esc_html__('Select an icon', 'oconnor'),
                'multiple'    => false,
                'std'         => 'default',
            ),
        ),
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_blog_meta_boxes');
function gt3_blog_meta_boxes($meta_boxes) {
    $meta_boxes[] = array(
        'title'      => esc_html__('Post Format Layout', 'oconnor'),
        'post_types' => array('post'),
        'context'    => 'advanced',
        'fields'     => array(
            // Standard Post Format
            array(
                'name'       => esc_html__('You can use only featured image for this post-format', 'oconnor'),
                'id'         => "post_format_standard",
                'type'       => 'static-text',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', '0'),
                            array('post-format-selector-0','=','standard')
                        ),
                    ),
                ),
            ),
            // Gallery Post Format
            array(
                'name'             => esc_html__('Gallery images', 'oconnor'),
                'id'               => "post_format_gallery_images",
                'type'             => 'image_advanced',
                'max_file_uploads' => '',
                'attributes'       => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', 'gallery'),
                            array('post-format-selector-0','=','gallery')
                        ),
                    ),
                ),
            ),
            // Video Post Format
            array(
                'name'       => esc_html__('oEmbed', 'oconnor'),
                'id'         => "post_format_video_oEmbed",
                'desc'       => esc_html__('enter URL', 'oconnor'),
                'type'       => 'oembed',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', 'video'),
                            array('post-format-selector-0','=','video')
                        ),
                        array(
                            array('post_format_video_select', '=', 'oEmbed')
                        )
                    ),
                ),
            ),
            // Audio Post Format
            array(
                'name'       => esc_html__('oEmbed', 'oconnor'),
                'id'         => "post_format_audio_oEmbed",
                'desc'       => esc_html__('enter URL', 'oconnor'),
                'type'       => 'oembed',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', 'audio'),
                            array('post-format-selector-0','=','audio')
                        ),
                        array(
                            array('post_format_audio_select', '=', 'oEmbed')
                        )
                    ),
                ),
            ),
            // Quote Post Format
            array(
                'name'       => esc_html__('Quote Author', 'oconnor'),
                'id'         => "post_format_qoute_author",
                'type'       => 'text',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', 'quote'),
                            array('post-format-selector-0','=','quote')
                        ),
                    ),
                ),
            ),
            array(
                'name'             => esc_html__('Author Image', 'oconnor'),
                'id'               => "post_format_qoute_author_image",
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
                'attributes'       => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', 'quote'),
                            array('post-format-selector-0','=','quote')
                        ),
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Quote Content', 'oconnor'),
                'id'         => "post_format_qoute_text",
                'type'       => 'textarea',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', 'quote'),
                            array('post-format-selector-0','=','quote')
                        ),
                    ),
                ),
            ),
            // Link Post Format
            array(
                'name'       => esc_html__('Link URL', 'oconnor'),
                'id'         => "post_format_link",
                'type'       => 'url',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', 'link'),
                            array('post-format-selector-0','=','link')
                        ),
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Link Text', 'oconnor'),
                'id'         => "post_format_link_text",
                'type'       => 'text',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('formatdiv', '=', 'link'),
                            array('post-format-selector-0','=','link')
                        ),
                    ),
                ),
            ),


        )
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_page_layout_meta_boxes');
function gt3_page_layout_meta_boxes($meta_boxes) {

    $meta_boxes[] = array(
        'title'      => esc_html__('Page Layout', 'oconnor'),
        'post_types' => array('page', 'post', 'team', 'practice', 'case', 'product'),
        'context'    => 'advanced',
        'fields'     => array(
            array(
                'name'     => esc_html__('Page Sidebar Layout', 'oconnor'),
                'id'       => "mb_page_sidebar_layout",
                'type'     => 'select',
                'options'  => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'none'    => esc_html__('None', 'oconnor'),
                    'left'    => esc_html__('Left', 'oconnor'),
                    'right'   => esc_html__('Right', 'oconnor'),
                ),
                'multiple' => false,
                'std'      => 'default',
            ),
            array(
                'name'       => esc_html__('Page Sidebar', 'oconnor'),
                'id'         => "mb_page_sidebar_def",
                'type'       => 'select',
                'options'    => gt3_get_all_sidebar(),
                'multiple'   => false,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_sidebar_layout', '!=', 'default'),
                            array('mb_page_sidebar_layout', '!=', 'none'),
                        )
                    ),
                ),
            ),
        )
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_logo_meta_boxes');
function gt3_logo_meta_boxes($meta_boxes) {
    $meta_boxes[] = array(
        'title'      => esc_html__('Logo Options', 'oconnor'),
        'post_types' => array('page'),
        'context'    => 'advanced',
        'fields'     => array(
            array(
                'name'     => esc_html__('Logo', 'oconnor'),
                'id'       => "mb_customize_logo",
                'type'     => 'select',
                'options'  => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                ),
                'multiple' => false,
                'std'      => 'default',
            ),
            array(
                'name'             => esc_html__('Header Logo', 'oconnor'),
                'id'               => "mb_header_logo",
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
                'attributes'       => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_logo', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_logo_height_custom',
                'name'       => esc_html__('Enable Logo Height', 'oconnor'),
                'type'       => 'checkbox',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_logo', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Set Logo Height', 'oconnor'),
                'id'         => "mb_logo_height",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 50,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_logo', '=', 'custom'),
                            array('mb_logo_height_custom', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Don\'t limit maximum height', 'oconnor'),
                'id'         => "mb_logo_max_height",
                'type'       => 'checkbox',
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_logo', '=', 'custom'),
                            array('mb_logo_height_custom', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Set Sticky Logo Height', 'oconnor'),
                'id'         => "mb_sticky_logo_height",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_logo', '=', 'custom'),
                            array('mb_logo_height_custom', '=', true),
                            array('mb_logo_max_height', '=', true),
                        )
                    ),
                ),
            ),
            array(
                'name'             => esc_html__('Sticky Logo', 'oconnor'),
                'id'               => "mb_logo_sticky",
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
                'attributes'       => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_logo', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'             => esc_html__('Mobile Logo', 'oconnor'),
                'id'               => "mb_logo_mobile",
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
                'attributes'       => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_logo', '=', 'custom')
                        )
                    ),
                ),
            ),
        )
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_header_option_meta_boxes');
function gt3_header_option_meta_boxes($meta_boxes) {
    $meta_boxes[] = array(
        'title'      => esc_html__('Header Layout and Color', 'oconnor'),
        'post_types' => array('page', 'post', 'team', 'practice', 'case'),
        'context'    => 'advanced',
        'fields'     => array(
            array(
                'name'     => esc_html__('Header Settings', 'oconnor'),
                'id'       => "mb_customize_header_layout",
                'type'     => 'select',
                'options'  => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                    'none'    => esc_html__('none', 'oconnor'),
                ),
                'multiple' => false,
                'std'      => 'default',
            ),
            // Top header settings
            array(
                'name'       => esc_html__('Top Header Settings', 'oconnor'),
                'id'         => "mb_customize_top_header_layout",
                'type'       => 'select',
                'options'    => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'default',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Top Header Background', 'oconnor'),
                'id'         => "mb_top_header_background",
                'type'       => 'color',
                'std'        => '#f5f5f5',
                'js_options' => array(
                    'defaultColor' => '#f5f5f5',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_top_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Top Header Background Opacity', 'oconnor'),
                'id'         => "mb_top_header_background_opacity",
                'type'       => 'number',
                'std'        => 0,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_top_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Text Color', 'oconnor'),
                'id'         => "mb_top_header_color",
                'type'       => 'color',
                'std'        => '#f8f8f7',
                'js_options' => array(
                    'defaultColor' => '#f8f8f7',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_top_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_top_header_bottom_border',
                'name'       => esc_html__('Set Top Header Bottom Border', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 1,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_top_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Top Header Border color', 'oconnor'),
                'id'         => "mb_header_top_bottom_border_color",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_top_header_layout', '=', 'custom'),
                            array('mb_top_header_bottom_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Top Header Border Opacity', 'oconnor'),
                'id'         => "mb_header_top_bottom_border_color_opacity",
                'type'       => 'number',
                'std'        => 0.1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_top_header_layout', '=', 'custom'),
                            array('mb_top_header_bottom_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Middle Header Settings', 'oconnor'),
                'id'         => "mb_customize_middle_header_layout",
                'type'       => 'select',
                'options'    => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'default',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),

            // Middle header settings
            array(
                'name'       => esc_html__('Middle Header Background', 'oconnor'),
                'id'         => "mb_middle_header_background",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_middle_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Middle Header Background Opacity', 'oconnor'),
                'id'         => "mb_middle_header_background_opacity",
                'type'       => 'number',
                'std'        => 0,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_middle_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Middle Header Text Color', 'oconnor'),
                'id'         => "mb_middle_header_color",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_middle_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_middle_header_bottom_border',
                'name'       => esc_html__('Set Middle Header Bottom Border', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_middle_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Middle Header Border color', 'oconnor'),
                'id'         => "mb_header_middle_bottom_border_color",
                'type'       => 'color',
                'std'        => '#000000',
                'js_options' => array(
                    'defaultColor' => '#000000',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_middle_header_layout', '=', 'custom'),
                            array('mb_middle_header_bottom_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Middle Header Border Opacity', 'oconnor'),
                'id'         => "mb_header_middle_bottom_border_color_opacity",
                'type'       => 'number',
                'std'        => 0.1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_middle_header_layout', '=', 'custom'),
                            array('mb_middle_header_bottom_border', '=', true)
                        )
                    ),
                ),
            ),

            // Bottom header settings
            array(
                'name'       => esc_html__('Bottom Header Settings', 'oconnor'),
                'id'         => "mb_customize_bottom_header_layout",
                'type'       => 'select',
                'options'    => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'default',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Bottom Header Background', 'oconnor'),
                'id'         => "mb_bottom_header_background",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_bottom_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Bottom Header Background Opacity', 'oconnor'),
                'id'         => "mb_bottom_header_background_opacity",
                'type'       => 'number',
                'std'        => 0.44,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_bottom_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Bottom Header Text Color', 'oconnor'),
                'id'         => "mb_bottom_header_color",
                'type'       => 'color',
                'std'        => '#000000',
                'js_options' => array(
                    'defaultColor' => '#000000',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_bottom_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_bottom_header_bottom_border',
                'name'       => esc_html__('Set Bottom Header Bottom Border', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_bottom_header_layout', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Bottom Header Border color', 'oconnor'),
                'id'         => "mb_header_bottom_bottom_border_color",
                'type'       => 'color',
                'std'        => '#000000',
                'js_options' => array(
                    'defaultColor' => '#000000',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_bottom_header_layout', '=', 'custom'),
                            array('mb_bottom_header_bottom_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Bottom Header Border Opacity', 'oconnor'),
                'id'         => "mb_header_bottom_bottom_border_color_opacity",
                'type'       => 'number',
                'std'        => 0.1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_customize_header_layout', '=', 'custom'),
                            array('mb_customize_bottom_header_layout', '=', 'custom'),
                            array('mb_bottom_header_bottom_border', '=', true)
                        )
                    ),
                ),
            ),


            //mobile options
            array(
                'id'         => 'mb_header_on_bg',
                'name'       => esc_html__('Header Above Content', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 0,
            ),


            // Mobile Top header settings
            array(
                'name'       => esc_html__('Top Mobile Header Settings', 'oconnor'),
                'id'         => "mb_customize_top_header_layout_mobile",
                'type'       => 'select',
                'options'    => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'default',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Top Mobile Header Background', 'oconnor'),
                'id'         => "mb_top_header_background_mobile",
                'type'       => 'color',
                'std'        => '#2a2e31',
                'js_options' => array(
                    'defaultColor' => '#2a2e31',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_top_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Top Mobile Header Background Opacity', 'oconnor'),
                'id'         => "mb_top_header_background_opacity_mobile",
                'type'       => 'number',
                'std'        => 1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_top_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Top Mobile Header Text Color', 'oconnor'),
                'id'         => "mb_top_header_color_mobile",
                'type'       => 'color',
                'std'        => '#797f85',
                'js_options' => array(
                    'defaultColor' => '#797f85',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_top_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),


            // Mobile Middle header settings
            array(
                'name'       => esc_html__('Middle Mobile Header Settings', 'oconnor'),
                'id'         => "mb_customize_middle_header_layout_mobile",
                'type'       => 'select',
                'options'    => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'default',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Middle Mobile Header Background', 'oconnor'),
                'id'         => "mb_middle_header_background_mobile",
                'type'       => 'color',
                'std'        => '#2a2e31',
                'js_options' => array(
                    'defaultColor' => '#2a2e31',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_middle_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Middle Mobile Header Background Opacity', 'oconnor'),
                'id'         => "mb_middle_header_background_opacity_mobile",
                'type'       => 'number',
                'std'        => 1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_middle_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Middle Mobile Header Text Color', 'oconnor'),
                'id'         => "mb_middle_header_color_mobile",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_middle_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),


            // Mobile Bottom header settings
            array(
                'name'       => esc_html__('Bottom Mobile Header Settings', 'oconnor'),
                'id'         => "mb_customize_bottom_header_layout_mobile",
                'type'       => 'select',
                'options'    => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'default',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Bottom Mobile Header Background', 'oconnor'),
                'id'         => "mb_bottom_header_background_mobile",
                'type'       => 'color',
                'std'        => '#2a2e31',
                'js_options' => array(
                    'defaultColor' => '#2a2e31',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_bottom_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Bottom Mobile Header Background Opacity', 'oconnor'),
                'id'         => "mb_bottom_header_background_opacity_mobile",
                'type'       => 'number',
                'std'        => 1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_bottom_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Bottom Mobile Header Text Color', 'oconnor'),
                'id'         => "mb_bottom_header_color_mobile",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_header_on_bg', '=', '1'),
                            array('mb_customize_bottom_header_layout_mobile', '=', 'custom')
                        )
                    ),
                ),
            ),

        )

    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_header_meta_boxes');
function gt3_header_meta_boxes($meta_boxes) {
    $preset_opt = gt3_option('gt3_header_builder_presets');
    $presets_array = array();
    if (isset($preset_opt['current_active'])) {
        unset($preset_opt['current_active']);
    }
    if (isset($preset_opt['def_preset'])) {
        unset($preset_opt['def_preset']);
    }
    if (isset($preset_opt['items_count'])) {
        unset($preset_opt['items_count']);
    }
    $presets_array['default'] = esc_html__( 'Default from Theme Options', 'oconnor' );
    if (empty($preset_opt) || !is_array($preset_opt)) {
        return $meta_boxes;
    }
    foreach ($preset_opt as $key => $value) {
        if (!empty($value['title'])) {
            $presets_array[$key] = $value['title'];
        }else{
            $presets_array[$key] = esc_html__( 'No Name', 'oconnor' );
        }
    }

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Header Builder', 'oconnor' ),
        'post_types' => array( 'page', 'post', 'team', 'practice', 'case' ),
        'context' => 'advanced',
        'fields'     => array(
            array(
                'name'     => esc_html__( 'Choose presets', 'oconnor' ),
                'id'          => "mb_header_presets",
                'type'        => 'select',
                'options'     => $presets_array,
                'multiple'    => false,
                'std'         => 'default',
            ),
        )
    );
    return $meta_boxes;
}


add_filter('rwmb_meta_boxes', 'gt3_page_title_meta_boxes');
function gt3_page_title_meta_boxes($meta_boxes) {
    $meta_boxes[] = array(
        'title'      => esc_html__('Page Title Options', 'oconnor'),
        'post_types' => array('page', 'post', 'team', 'practice', 'case', 'product'),
        'context'    => 'advanced',
        'fields'     => array(
            array(
                'name'     => esc_html__('Show Page Title', 'oconnor'),
                'id'       => "mb_page_title_conditional",
                'type'     => 'select',
                'options'  => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'yes'     => esc_html__('yes', 'oconnor'),
                    'no'      => esc_html__('no', 'oconnor'),
                ),
                'multiple' => false,
                'std'      => 'default',
            ),
	        array(
		        'name'       => ' ', // alt + 0160
		        'desc'       => esc_html__('Title Color', 'oconnor'),
		        'class'      => 'no-border',
		        'id'         => "mb_page_title_color",
		        'type'       => 'color',
		        'std'        => '',
		        'js_options' => array(
			        'defaultColor' => '',
		        ),
		        'attributes' => array(
			        'data-dependency' => array(
				        array(
					        array('mb_page_title_conditional', '!=', 'no'),
				        )
			        ),
		        ),
	        ),
            array(
                'name'       => esc_html__('Page Sub Title Text', 'oconnor'),
                'id'         => "mb_page_sub_title",
                'type'       => 'textarea',
                'cols'       => 20,
                'rows'       => 3,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '!=', 'no'),
                        )
                    ),
                ),
            ),
	        array(
		        'name'       => ' ', // alt + 0160
		        'desc'       => esc_html__('Sub Title Text Color', 'oconnor'),
		        'class'      => 'no-border',
		        'id'         => "mb_page_sub_title_color",
		        'type'       => 'color',
		        'std'        => '',
		        'js_options' => array(
			        'defaultColor' => '',
		        ),
		        'attributes' => array(
			        'data-dependency' => array(
				        array(
					        array('mb_page_title_conditional', '!=', 'no'),
				        )
			        ),
		        ),
	        ),
            array(
                'id'         => 'mb_show_breadcrumbs',
                'name'       => esc_html__('Show Breadcrumbs', 'oconnor'),
                'type'       => 'checkbox',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Vertical Alignment', 'oconnor'),
                'id'         => 'mb_page_title_vertical_align',
                'type'       => 'select_advanced',
                'options'    => array(
                    'top'    => esc_html__('top', 'oconnor'),
                    'middle' => esc_html__('middle', 'oconnor'),
                    'bottom' => esc_html__('bottom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'middle',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Horizontal Alignment', 'oconnor'),
                'id'         => 'mb_page_title_horizontal_align',
                'type'       => 'select_advanced',
                'options'    => array(
                    'left'   => esc_html__('left', 'oconnor'),
                    'center' => esc_html__('center', 'oconnor'),
                    'right'  => esc_html__('right', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'left',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Font Color', 'oconnor'),
                'id'         => "mb_page_title_font_color",
                'type'       => 'color',
                'std'        => '#272b2e',
                'js_options' => array(
                    'defaultColor' => '#272b2e',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Color', 'oconnor'),
                'id'         => "mb_page_title_bg_color",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'             => esc_html__('Page Title Background Image', 'oconnor'),
                'id'               => "mb_page_title_bg_image",
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
                'mime_type'        => 'image',
                'attributes'       => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Repeat', 'oconnor'),
                'id'         => 'mb_page_title_bg_repeat',
                'type'       => 'select_advanced',
                'options'    => array(
                    'no-repeat' => esc_html__('no-repeat', 'oconnor'),
                    'repeat'    => esc_html__('repeat', 'oconnor'),
                    'repeat-x'  => esc_html__('repeat-x', 'oconnor'),
                    'repeat-y'  => esc_html__('repeat-y', 'oconnor'),
                    'inherit'   => esc_html__('inherit', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'no-repeat',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Size', 'oconnor'),
                'id'         => 'mb_page_title_bg_size',
                'type'       => 'select_advanced',
                'options'    => array(
                    'inherit' => esc_html__('inherit', 'oconnor'),
                    'cover'   => esc_html__('cover', 'oconnor'),
                    'contain' => esc_html__('contain', 'oconnor')
                ),
                'multiple'   => false,
                'std'        => 'cover',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Attachment', 'oconnor'),
                'id'         => 'mb_page_title_bg_attachment',
                'type'       => 'select_advanced',
                'options'    => array(
                    'fixed'   => esc_html__('fixed', 'oconnor'),
                    'scroll'  => esc_html__('scroll', 'oconnor'),
                    'inherit' => esc_html__('inherit', 'oconnor')
                ),
                'multiple'   => false,
                'std'        => 'scroll',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Position', 'oconnor'),
                'id'         => 'mb_page_title_bg_position',
                'type'       => 'select_advanced',
                'options'    => array(
                    'left top'      => esc_html__('left top', 'oconnor'),
                    'left center'   => esc_html__('left center', 'oconnor'),
                    'left bottom'   => esc_html__('left bottom', 'oconnor'),
                    'center top'    => esc_html__('center top', 'oconnor'),
                    'center center' => esc_html__('center center', 'oconnor'),
                    'center bottom' => esc_html__('center bottom', 'oconnor'),
                    'right top'     => esc_html__('right top', 'oconnor'),
                    'right center'  => esc_html__('right center', 'oconnor'),
                    'right bottom'  => esc_html__('right bottom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'center center',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Height', 'oconnor'),
                'id'         => "mb_page_title_height",
                'type'       => 'number',
                'std'        => 320,
                'min'        => 0,
                'step'       => 1,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_page_title_top_border',
                'name'       => esc_html__('Set Page Title Top Border?', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Page Title Top Border Color', 'oconnor'),
                'id'         => "mb_page_title_top_border_color",
                'type'       => 'color',
                'std'        => '#eff0ed',
                'js_options' => array(
                    'defaultColor' => '#eff0ed',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes'),
                            array('mb_page_title_top_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Page Title Top Border Opacity', 'oconnor'),
                'id'         => "mb_page_title_top_border_color_opacity",
                'type'       => 'number',
                'std'        => 1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes'),
                            array('mb_page_title_top_border', '=', true)
                        )
                    ),
                ),
            ),

            array(
                'id'         => 'mb_page_title_bottom_border',
                'name'       => esc_html__('Set Page Title Bottom Border?', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Page Title Bottom Border Color', 'oconnor'),
                'id'         => "mb_page_title_bottom_border_color",
                'type'       => 'color',
                'std'        => '#eff0ed',
                'js_options' => array(
                    'defaultColor' => '#eff0ed',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes'),
                            array('mb_page_title_bottom_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Page Title Bottom Border Opacity', 'oconnor'),
                'id'         => "mb_page_title_bottom_border_color_opacity",
                'type'       => 'number',
                'std'        => 1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes'),
                            array('mb_page_title_bottom_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Title Bottom Margin', 'oconnor'),
                'desc'       => esc_html__('It\'ll be 90px by default if this textarea is empty and Background image for title is set', 'oconnor'),
                'id'         => "mb_page_title_bottom_margin",
                'type'       => 'number',
                'std'        => '',
                'min'        => 0,
                'step'       => 1,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_page_title_conditional', '=', 'yes')
                        )
                    ),
                ),
            ),
        ),
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_footer_meta_boxes');
function gt3_footer_meta_boxes($meta_boxes) {
    $meta_boxes[] = array(
        'title'      => esc_html__('Footer Options', 'oconnor'),
        'post_types' => array('page'),
        'context'    => 'advanced',
        'fields'     => array(
            array(
                'name'     => esc_html__('Show Footer', 'oconnor'),
                'id'       => "mb_footer_switch",
                'type'     => 'select',
                'options'  => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'yes'     => esc_html__('yes', 'oconnor'),
                    'no'      => esc_html__('no', 'oconnor'),
                ),
                'multiple' => false,
                'std'      => 'default',
            ),
            array(
                'name'       => esc_html__('Footer Column', 'oconnor'),
                'id'         => "mb_footer_column",
                'type'       => 'select',
                'options'    => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ),
                'multiple'   => false,
                'std'        => '4',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Column 1', 'oconnor'),
                'id'         => "mb_footer_sidebar_1",
                'type'       => 'select',
                'options'    => gt3_get_all_sidebar(),
                'multiple'   => false,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Column 2', 'oconnor'),
                'id'         => "mb_footer_sidebar_2",
                'type'       => 'select',
                'options'    => gt3_get_all_sidebar(),
                'multiple'   => false,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_footer_column', '!=', '1')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Column 3', 'oconnor'),
                'id'         => "mb_footer_sidebar_3",
                'type'       => 'select',
                'options'    => gt3_get_all_sidebar(),
                'multiple'   => false,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_footer_column', '!=', '1'),
                            array('mb_footer_column', '!=', '2')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Column 4', 'oconnor'),
                'id'         => "mb_footer_sidebar_4",
                'type'       => 'select',
                'options'    => gt3_get_all_sidebar(),
                'multiple'   => false,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_footer_column', '!=', '1'),
                            array('mb_footer_column', '!=', '2'),
                            array('mb_footer_column', '!=', '3')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Column 5', 'oconnor'),
                'id'         => "mb_footer_sidebar_5",
                'type'       => 'select',
                'options'    => gt3_get_all_sidebar(),
                'multiple'   => false,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_footer_column', '!=', '1'),
                            array('mb_footer_column', '!=', '2'),
                            array('mb_footer_column', '!=', '3'),
                            array('mb_footer_column', '!=', '4')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Column Layout', 'oconnor'),
                'id'         => "mb_footer_column2",
                'type'       => 'select',
                'options'    => array(
                    '6-6' => '50% / 50%',
                    '3-9' => '25% / 75%',
                    '9-3' => '75% / 25%',
                    '4-8' => '33% / 66%',
                    '8-3' => '66% / 33%',
                ),
                'multiple'   => false,
                'std'        => '6-6',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_footer_column', '=', '2')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Column Layout', 'oconnor'),
                'id'         => "mb_footer_column3",
                'type'       => 'select',
                'options'    => array(
                    '4-4-4' => '33% / 33% / 33%',
                    '3-3-6' => '25% / 25% / 50%',
                    '3-6-3' => '25% / 50% / 25%',
                    '6-3-3' => '50% / 25% / 25%',
                ),
                'multiple'   => false,
                'std'        => '4-4-4',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_footer_column', '=', '3')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Column Layout', 'oconnor'),
                'id'         => "mb_footer_column5",
                'type'       => 'select',
                'options'    => array(
                    '2-3-2-2-3' => '16% / 25% / 16% / 16% / 25%',
                    '3-2-2-2-3' => '25% / 16% / 16% / 16% / 25%',
                    '3-2-3-2-2' => '25% / 16% / 26% / 16% / 16%',
                    '3-2-3-3-2' => '25% / 16% / 16% / 25% / 16%',
                ),
                'multiple'   => false,
                'std'        => '2-3-2-2-3',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_footer_column', '=', '5')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Title Text Align', 'oconnor'),
                'id'         => "mb_footer_align",
                'type'       => 'select',
                'options'    => array(
                    'left'   => 'Left',
                    'center' => 'Center',
                    'right'  => 'Right'
                ),
                'multiple'   => false,
                'std'        => 'left',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Padding Top (px)', 'oconnor'),
                'id'         => "mb_padding_top",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 70,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Padding Bottom (px)', 'oconnor'),
                'id'         => "mb_padding_bottom",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 70,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Padding Left (px)', 'oconnor'),
                'id'         => "mb_padding_left",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Padding Right (px)', 'oconnor'),
                'id'         => "mb_padding_right",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_footer_full_width',
                'name'       => esc_html__('Full Width Footer', 'oconnor'),
                'type'       => 'checkbox',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Color', 'oconnor'),
                'id'         => "mb_footer_bg_color",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Text Color', 'oconnor'),
                'id'         => "mb_footer_text_color",
                'type'       => 'color',
                'std'        => '#000000',
                'js_options' => array(
                    'defaultColor' => '#000000',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Footer Heading Color', 'oconnor'),
                'id'         => "mb_footer_heading_color",
                'type'       => 'color',
                'std'        => '#fafafa',
                'js_options' => array(
                    'defaultColor' => '#fafafa',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'             => esc_html__('Footer Background Image', 'oconnor'),
                'id'               => "mb_footer_bg_image",
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
                'mime_type'        => 'image',
                'attributes'       => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Repeat', 'oconnor'),
                'id'         => 'mb_footer_bg_repeat',
                'type'       => 'select_advanced',
                'options'    => array(
                    'no-repeat' => esc_html__('no-repeat', 'oconnor'),
                    'repeat'    => esc_html__('repeat', 'oconnor'),
                    'repeat-x'  => esc_html__('repeat-x', 'oconnor'),
                    'repeat-y'  => esc_html__('repeat-y', 'oconnor'),
                    'inherit'   => esc_html__('inherit', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'repeat',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Size', 'oconnor'),
                'id'         => 'mb_footer_bg_size',
                'type'       => 'select_advanced',
                'options'    => array(
                    'inherit' => esc_html__('inherit', 'oconnor'),
                    'cover'   => esc_html__('cover', 'oconnor'),
                    'contain' => esc_html__('contain', 'oconnor')
                ),
                'multiple'   => false,
                'std'        => 'cover',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Attachment', 'oconnor'),
                'id'         => 'mb_footer_attachment',
                'type'       => 'select_advanced',
                'options'    => array(
                    'fixed'   => esc_html__('fixed', 'oconnor'),
                    'scroll'  => esc_html__('scroll', 'oconnor'),
                    'inherit' => esc_html__('inherit', 'oconnor')
                ),
                'multiple'   => false,
                'std'        => 'scroll',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Background Position', 'oconnor'),
                'id'         => 'mb_footer_bg_position',
                'type'       => 'select_advanced',
                'options'    => array(
                    'left top'      => esc_html__('left top', 'oconnor'),
                    'left center'   => esc_html__('left center', 'oconnor'),
                    'left bottom'   => esc_html__('left bottom', 'oconnor'),
                    'center top'    => esc_html__('center top', 'oconnor'),
                    'center center' => esc_html__('center center', 'oconnor'),
                    'center bottom' => esc_html__('center bottom', 'oconnor'),
                    'right top'     => esc_html__('right top', 'oconnor'),
                    'right center'  => esc_html__('right center', 'oconnor'),
                    'right bottom'  => esc_html__('right bottom', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'center center',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),

            array(
                'id'         => 'mb_copyright_switch',
                'name'       => esc_html__('Show Copyright', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 1,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Editor', 'oconnor'),
                'id'         => "mb_copyright_editor",
                'type'       => 'textarea',
                'cols'       => 20,
                'rows'       => 3,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Title Text Align', 'oconnor'),
                'id'         => 'mb_copyright_align',
                'type'       => 'select',
                'options'    => array(
                    'left'   => esc_html__('left', 'oconnor'),
                    'center' => esc_html__('center', 'oconnor'),
                    'right'  => esc_html__('right', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'left',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Padding Top (px)', 'oconnor'),
                'id'         => "mb_copyright_padding_top",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 20,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Padding Bottom (px)', 'oconnor'),
                'id'         => "mb_copyright_padding_bottom",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 20,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Padding Left (px)', 'oconnor'),
                'id'         => "mb_copyright_padding_left",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Padding Right (px)', 'oconnor'),
                'id'         => "mb_copyright_padding_right",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Background Color', 'oconnor'),
                'id'         => "mb_copyright_bg_color",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Text Color', 'oconnor'),
                'id'         => "mb_copyright_text_color",
                'type'       => 'color',
                'std'        => '#000000',
                'js_options' => array(
                    'defaultColor' => '#000000',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_copyright_top_border',
                'name'       => esc_html__('Set Copyright Top Border?', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 1,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Border Color', 'oconnor'),
                'id'         => "mb_copyright_top_border_color",
                'type'       => 'color',
                'std'        => '#2b4764',
                'js_options' => array(
                    'defaultColor' => '#2b4764',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_copyright_top_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Copyright Border Opacity', 'oconnor'),
                'id'         => "mb_copyright_top_border_color_opacity",
                'type'       => 'number',
                'std'        => 1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_copyright_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_copyright_top_border', '=', true)
                        )
                    ),
                ),
            ),

            //prefooter
            array(
                'id'         => 'mb_pre_footer_switch',
                'name'       => esc_html__('Show Pre Footer Area', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Pre Footer Editor', 'oconnor'),
                'id'         => "mb_pre_footer_editor",
                'type'       => 'textarea',
                'cols'       => 20,
                'rows'       => 3,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Pre Footer Title Text Align', 'oconnor'),
                'id'         => 'mb_pre_footer_align',
                'type'       => 'select',
                'options'    => array(
                    'left'   => esc_html__('left', 'oconnor'),
                    'center' => esc_html__('center', 'oconnor'),
                    'right'  => esc_html__('right', 'oconnor'),
                ),
                'multiple'   => false,
                'std'        => 'left',
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Pre Footer Padding Top (px)', 'oconnor'),
                'id'         => "mb_pre_footer_padding_top",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 20,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Pre Footer Padding Bottom (px)', 'oconnor'),
                'id'         => "mb_pre_footer_padding_bottom",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 20,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Pre Footer Padding Left (px)', 'oconnor'),
                'id'         => "mb_pre_footer_padding_left",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Pre Footer Padding Right (px)', 'oconnor'),
                'id'         => "mb_pre_footer_padding_right",
                'type'       => 'number',
                'min'        => 0,
                'step'       => 1,
                'std'        => 0,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_pre_footer_bottom_border',
                'name'       => esc_html__('Set Pre Footer Bottom Border?', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 1,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Pre Footer Border Color', 'oconnor'),
                'id'         => "mb_pre_footer_bottom_border_color",
                'type'       => 'color',
                'std'        => '#f0f0f0',
                'js_options' => array(
                    'defaultColor' => '#f0f0f0',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_pre_footer_bottom_border', '=', true)
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Pre Footer Border Opacity', 'oconnor'),
                'id'         => "mb_pre_footer_bottom_border_color_opacity",
                'type'       => 'number',
                'std'        => 1,
                'min'        => 0,
                'max'        => 1,
                'step'       => 0.01,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_pre_footer_switch', '=', true),
                            array('mb_footer_switch', '=', 'yes'),
                            array('mb_pre_footer_bottom_border', '=', true)
                        )
                    ),
                ),
            ),
        ),
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_preloader_meta_boxes');
function gt3_preloader_meta_boxes($meta_boxes) {
    $meta_boxes[] = array(
        'title'      => esc_html__('Preloader Options', 'oconnor'),
        'post_types' => array('page'),
        'context'    => 'advanced',
        'fields'     => array(
            array(
                'name'     => esc_html__('Preloader', 'oconnor'),
                'id'       => "mb_preloader",
                'type'     => 'select',
                'options'  => array(
                    'default' => esc_html__('default', 'oconnor'),
                    'custom'  => esc_html__('custom', 'oconnor'),
                    'none'    => esc_html__('none', 'oconnor'),
                ),
                'multiple' => false,
                'std'      => 'default',
            ),
            array(
                'name'       => esc_html__('Preloader Background', 'oconnor'),
                'id'         => "mb_preloader_background",
                'type'       => 'color',
                'std'        => '#ffffff',
                'js_options' => array(
                    'defaultColor' => '#ffffff',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_preloader', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'       => esc_html__('Preloader Item Color', 'oconnor'),
                'id'         => "mb_preloader_item_color",
                'type'       => 'color',
                'std'        => '#000000',
                'js_options' => array(
                    'defaultColor' => '#000000',
                ),
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_preloader', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'name'             => esc_html__('Preloader Logo', 'oconnor'),
                'id'               => "mb_preloader_item_logo",
                'type'             => 'image_advanced',
                'size'             => 'full',
                'max_file_uploads' => 1,
                'max_status'       => true,
                'attributes'       => array(
                    'data-dependency' => array(
                        array(
                            array('mb_preloader', '=', 'custom')
                        )
                    ),
                ),
            ),
            array(
                'id'         => 'mb_preloader_full',
                'name'       => esc_html__('Preloader Fullscreen', 'oconnor'),
                'type'       => 'checkbox',
                'std'        => 1,
                'attributes' => array(
                    'data-dependency' => array(
                        array(
                            array('mb_preloader', '=', 'custom')
                        )
                    ),
                ),
            ),
        )
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_shortcode_meta_boxes');
function gt3_shortcode_meta_boxes($meta_boxes) {
    $meta_boxes[] = array(
        'title'      => esc_html__('Shortcode Above Content', 'oconnor'),
        'post_types' => array('page'),
        'context'    => 'advanced',
        'fields'     => array(
            array(
                'name' => esc_html__('Shortcode', 'oconnor'),
                'id'   => "mb_page_shortcode",
                'type' => 'textarea',
                'cols' => 20,
                'rows' => 3
            ),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_single_product_meta_boxes' );
function gt3_single_product_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      	=> esc_html__( 'Single Product Settings', 'oconnor' ),
        'post_types' 	=> array( 'product' ),
        'context' 		=> 'advanced',
        'fields'     	=> array(
            array(
                'name' 			=> esc_html__( 'Single Product Page Settings', 'oconnor' ),
                'id'          	=> "mb_single_product",
                'type'        	=> 'select',
                'options'     	=> array(
                    'default' => esc_html__( 'default', 'oconnor' ),
                    'custom'  => esc_html__( 'Custom', 'oconnor' ),
                ),
                'multiple'    	=> false,
                'std'  			=> 'default',
            ),

            array(
                'name' 			=> esc_html__( 'Product Page Layout', 'oconnor' ),
                'id'          	=> "mb_product_container",
                'type'        	=> 'select',
                'options'     	=> array(
                    'container' 	=> esc_html__( 'Container', 'oconnor' ),
                    'full_width' 	=> esc_html__( 'Full Width', 'oconnor' ),
                ),
                'multiple'    	=> false,
                'std'  			=> 'container',
                'attributes' 	=>  array(
                    'data-dependency' => array( array(
                        array('mb_single_product','=','custom')
                    )),
                ),
            ),
            array(
                'name' 			=> esc_html__( 'Size Guide for this product', 'oconnor' ),
                'id'          	=> "mb_img_size_guide",
                'type'        	=> 'select',
                'options'     	=> array(
                    'default' => esc_html__( 'default', 'oconnor' ),
                    'custom'  => esc_html__( 'Custom', 'oconnor' ),
                    'none'    => esc_html__( 'None', 'oconnor' ),
                ),
                'multiple'    	=> false,
                'std'  			=> 'default',
            ),
            array(
                'id'   			=> 'mb_size_guide',
                'name' 			=> esc_html__( 'Size guide Popup Image', 'oconnor' ),
                'type' 			=> 'image_advanced',
                'attributes' 	=>  array(
                    'data-dependency' => array( array(
                        array('mb_img_size_guide','=','custom')
                    )),
                ),
            ),
        )
    );
    return $meta_boxes;
}
