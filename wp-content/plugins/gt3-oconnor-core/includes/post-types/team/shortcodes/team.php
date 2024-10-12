<?php


/**
 *
 */
class gt3Team {

    private $shortcodeName;

    public function __construct() {
        $this->shortcodeName = 'gt3_team_list';
    }

    public function shortcode_render() {
        add_action('vc_before_init', array($this, 'shortcodesMap'));
        $this->addShortcode();
    }

    public function shortcodesMap() {
        if (function_exists('vc_map')) {
            if (function_exists('gt3_option')) {
                $main_font = gt3_option('main-font');
            }else{
                $main_font = '#000000';
            }
            
            $main_font = 'rgba(' . gt3_HexToRGB($main_font['color']) . ', .3)';
            vc_map(array(
                "name"            => esc_html__("Team List", 'gt3_oconnor_core'),
                "base"            => $this->shortcodeName,
                "class"           => $this->shortcodeName,
                "category"        => esc_html__('GT3 Modules', 'gt3_oconnor_core'),
                "icon"            => 'gt3_icon',
                "content_element" => true,
                "description"     => esc_html__("Team List", 'gt3_oconnor_core'),
                "params"          => array(
                    array(
                        'type'        => 'loop',
                        'heading'     => esc_html__('Team Items', 'gt3_oconnor_core'),
                        'param_name'  => 'build_query',
                        'settings'    => array(
                            'size'       => array('hidden' => false, 'value' => 4 * 3),
                            'order_by'   => array('value' => 'date'),
                            'post_type'  => array('value' => 'team', 'hidden' => true),
                            'categories' => array('hidden' => true),
                            'tags'       => array('hidden' => true),
                        ),
                        'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'gt3_oconnor_core')
                    ),
                    array(
                        'type'             => 'gt3_custom_select',
                        'heading'          => esc_html__('Content Style', 'gt3_oconnor_core'),
                        'param_name'       => 'team_style',
                        'options'          => array(
                            esc_html__("Below the image", 'gt3_oconnor_core')        => 'content_below',
                            esc_html__("Bottom of an Image", 'gt3_oconnor_core')     => 'content_on_bottom',
                            esc_html__("Right Side of an Image", 'gt3_oconnor_core') => 'content_on_right_side',
                        ),
                        'std'              => 'content_below',
                        'edit_field_class' => 'vc_col-sm-12',
                    ),
                    array(
                        'type'        => 'gt3_custom_select',
                        'heading'     => esc_html__('Items Per Line', 'gt3_oconnor_core'),
                        'param_name'  => 'posts_per_line',
                        'admin_label' => true,
                        'options'     => array(
                            1 => esc_html__("1", 'gt3_oconnor_core'),
                            2 => esc_html__("2", 'gt3_oconnor_core'),
                            3 => esc_html__("3", 'gt3_oconnor_core'),
                            4 => esc_html__("4", 'gt3_oconnor_core'),
                        ),
                        'std'         => 3,
                        'save_always' => true,
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Grid Gap', 'gt3_oconnor_core'),
                        'param_name'  => 'grid_gap',
                        'admin_label' => true,
                        'value'       => array(
                            0  => esc_html__("0px", 'gt3_oconnor_core'),
                            1  => esc_html__("1px", 'gt3_oconnor_core'),
                            2  => esc_html__("2px", 'gt3_oconnor_core'),
                            3  => esc_html__("3px", 'gt3_oconnor_core'),
                            4  => esc_html__("4px", 'gt3_oconnor_core'),
                            5  => esc_html__("5px", 'gt3_oconnor_core'),
                            10 => esc_html__("10px", 'gt3_oconnor_core'),
                            15 => esc_html__("15px", 'gt3_oconnor_core'),
                            20 => esc_html__("20px", 'gt3_oconnor_core'),
                            25 => esc_html__("25px", 'gt3_oconnor_core'),
                            30 => esc_html__("30px", 'gt3_oconnor_core'),
                            35 => esc_html__("35px", 'gt3_oconnor_core'),
                        ),
                        'std'         => 30,
                    ),
                    array(
                        'type'        => 'gt3_on_off',
                        'heading'     => esc_html__('Show Filter', 'gt3_oconnor_core'),
                        'param_name'  => 'show_filter',
                        'value'       => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'std'         => 'no',
                        'save_always' => true,
                    ),
                    array(
                        'type'        => 'gt3_custom_select',
                        'heading'     => esc_html__('Filter Style', 'gt3_oconnor_core'),
                        'param_name'  => 'filter_style',
                        'save_always' => true,
                        'options'     => array(
                            esc_html__('Links', 'gt3_oconnor_core')   => "links",
                            esc_html__('Isotope', 'gt3_oconnor_core') => "isotope",
                        ),
                        'dependency'  => array(
                            'element' => 'show_filter',
                            "value"   => "yes"
                        ),
                    ),
                    array(
                        'type'       => 'gt3_on_off',
                        'heading'    => esc_html__('Show Pagination', 'gt3_oconnor_core'),
                        'param_name' => 'show_pagination',
                        'edit_field_class' => 'vc_col-sm-6',
                        'value'      => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'std'        => 'no',
                        'dependency' => array(
                            'element' => 'view_style',
                            "value"   => "standard"
                        ),
                    ),
                    array(
                        'type'        => 'gt3_custom_select',
                        'heading'     => esc_html__('Pagination Style', 'gt3_oconnor_core'),
                        'param_name'  => 'pagination_style',
                        'edit_field_class' => 'vc_col-sm-6',
                        'save_always' => true,
                        'options'     => array(
                            esc_html__('Pagination', 'gt3_oconnor_core')       => "pagination",
                            esc_html__('Load More Button', 'gt3_oconnor_core') => "load_more",
                        ),
                        'dependency'  => array(
                            'element' => 'show_pagination',
                            "value"   => "yes"
                        ),
                    ),
	                array(
		                'type'       => 'gt3_on_off',
		                'heading'    => esc_html__('Show Socials', 'gt3_oconnor_core'),
		                'param_name' => 'show_socials',
		                'value'      => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
		                'std'        => 'yes',
	                ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Items on load', 'gt3_oconnor_core'),
                        'param_name'  => 'items_load',
                        'value'       => '4',
                        'save_always' => true,
                        'description' => esc_html__('Items load by load more button.', 'gt3_oconnor_core'),
                        'dependency'  => array(
                            'element' => 'pagination_style',
                            "value"   => "load_more"
                        )
                    ),


                    // Team Font
                    array(
                        'type'        => 'gt3_on_off',
                        'heading'     => esc_html__('Use theme default font family for Title?', 'gt3_oconnor_core'),
                        'param_name'  => 'use_theme_fonts_title',
                        'value'       => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'description' => esc_html__('Use font family from the theme.', 'gt3_oconnor_core'),
                        "group"       => esc_html__("Styling", 'gt3_oconnor_core'),
                        'std'         => 'yes',
                    ),
                    array(
                        'type'       => 'google_fonts',
                        'param_name' => 'google_fonts_title',
                        'value'      => '',
                        'settings'   => array(
                            'fields' => array(
                                'font_family_description' => esc_html__('Select font family.', 'gt3_oconnor_core'),
                                'font_style_description'  => esc_html__('Select font styling.', 'gt3_oconnor_core'),
                            ),
                        ),
                        'dependency' => array(
                            'element'            => 'use_theme_fonts_title',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"      => esc_html__("Styling", 'gt3_oconnor_core'),
                    ),
                    array(
                        'type'        => 'gt3_on_off',
                        'heading'     => esc_html__('Use theme default font family for position?', 'gt3_oconnor_core'),
                        'param_name'  => 'use_theme_fonts_position',
                        'value'       => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'description' => esc_html__('Use font family from the theme.', 'gt3_oconnor_core'),
                        "group"       => esc_html__("Styling", 'gt3_oconnor_core'),
                        'std'         => 'yes',
                    ),
                    array(
                        'type'       => 'google_fonts',
                        'param_name' => 'google_fonts_position',
                        'value'      => '',
                        'settings'   => array(
                            'fields' => array(
                                'font_family_description' => esc_html__('Select font family.', 'gt3_oconnor_core'),
                                'font_style_description'  => esc_html__('Select font styling.', 'gt3_oconnor_core'),
                            ),
                        ),
                        'dependency' => array(
                            'element'            => 'use_theme_fonts_position',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"      => esc_html__("Styling", 'gt3_oconnor_core'),
                    ),
                    // Team Headings Font
                    array(
                        'type'        => 'gt3_on_off',
                        'heading'     => esc_html__('Use theme default team style?', 'gt3_oconnor_core'),
                        'param_name'  => 'use_theme_team_style',
                        'value'       => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'description' => esc_html__('Use default team style from the theme.', 'gt3_oconnor_core'),
                        "group"       => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always' => true,
                        'std'         => 'yes',
                    ),
                    // Custom team style
                    array(
                        "type"             => "colorpicker",
                        "class"            => "",
                        "heading"          => esc_html__("Custom Title Color", 'gt3_oconnor_core'),
                        "param_name"       => "custom_title_color",
                        "value"            => '#222328',
                        "description"      => esc_html__("Select custom title color.", 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_team_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    // Heading Font Size
                    array(
                        'type'             => 'textfield',
                        'heading'          => esc_html__('Title Font Size', 'gt3_oconnor_core'),
                        'param_name'       => 'title_font_size',
                        'value'            => '24',
                        'description'      => esc_html__('Enter title font-size in pixels.', 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_team_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        "type"             => "colorpicker",
                        "class"            => "",
                        "heading"          => esc_html__("Custom Position Color", 'gt3_oconnor_core'),
                        "param_name"       => "custom_position_color",
                        "value"            => '#3a405b',
                        "description"      => esc_html__("Select custom position color.", 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_team_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    // Heading Font Size
                    array(
                        'type'             => 'textfield',
                        'heading'          => esc_html__('Position Font Size', 'gt3_oconnor_core'),
                        'param_name'       => 'position_font_size',
                        'value'            => '14',
                        'description'      => esc_html__('Enter Position font-size in pixels.', 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_team_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        "type"             => "colorpicker",
                        "class"            => "",
                        "heading"          => esc_html__("Custom Button Color", 'gt3_oconnor_core'),
                        "param_name"       => "custom_button_color",
                        "value"            => '#3b55e6',
                        "description"      => esc_html__("Select custom button color.", 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_team_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    // Button Font Size
                    array(
                        'type'             => 'textfield',
                        'heading'          => esc_html__('Title Font Size', 'gt3_oconnor_core'),
                        'param_name'       => 'button_font_size',
                        'value'            => '11',
                        'description'      => esc_html__('Enter title font-size in pixels.', 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_team_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),

                    /* Separator */
                    array(
                        'type'             => 'gt3_on_off',
                        'heading'          => esc_html__('Activate Separator', 'gt3_oconnor_core'),
                        'param_name'       => 'separator',
                        'group'            => esc_html__('Styling', 'gt3_oconnor_core'),
                        'std'              => 'no',
                        'edit_field_class' => 'vc_col-sm-3',
                    ),
                    array(
                        'type'             => 'textfield',
                        'heading'          => esc_html__('Margin-top', 'gt3_oconnor_core'),
                        'param_name'       => 'margin_top',
                        'value'            => '12',
                        'description'      => esc_html__('Enter margin-top in pixels.', 'gt3_oconnor_core'),
                        'group'            => esc_html__('Styling', 'gt3_oconnor_core'),
                        'edit_field_class' => 'vc_col-sm-3',
                        'dependency'       => array(
                            'element' => 'separator',
                            'value'   => 'yes'
                        ),
                    ),
                    array(
                        'type'             => 'colorpicker',
                        'heading'          => esc_html__('Separator Color', 'gt3_oconnor_core'),
                        'param_name'       => 'separator_color',
                        'group'            => esc_html__('Styling', 'gt3_oconnor_core'),
                        //                        'value'            => '#bdbdbd',
                        'value'            => esc_attr($main_font),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                        'dependency'       => array(
                            'element' => 'separator',
                            'value'   => 'yes'
                        ),
                    ),
                    /* Separator end */

                    vc_map_add_css_animation(true),
                    array(
                        "type"        => "textfield",
                        "heading"     => esc_html__("Extra Class", 'gt3_oconnor_core'),
                        "param_name"  => "item_el_class",
                        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'gt3_oconnor_core')
                    ),
                )
            ));
        }
    }

    public function addShortcode() {
        add_shortcode($this->shortcodeName, array($this, 'render'));
    }

    public function render($atts, $content = null) {

        $main_font = gt3_option('main-font');
        $main_font = 'rgba(' . gt3_HexToRGB($main_font['color']) . ',3)';
        include_once OCONNOR_PLUGIN_DIR . '/includes/class-gt3_google_fonts_render.php';
        wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
        $args = array(
            'query_args'            => '',
            'build_query'           => '',
            'team_style'            => 'content_below',
            "posts_per_line"        => 3,
            "grid_gap"              => 30,
            "show_filter"           => '',
            'filter_style'          => '',
            'show_pagination'       => '',
            'pagination_style'      => '',
            'show_socials'          => 'yes',
            'items_load'            => 4,
            'use_theme_team_style'  => '',
            'custom_title_color'    => '',
            'title_font_size'       => '',
            'custom_position_color' => '',
            'position_font_size'    => '',
            'custom_button_color'   => '',
            'button_font_size'      => '',
            'separator'             => '',
            'separator_color'       => esc_attr($main_font),
            'margin_top'            => '12',
        );

        $parameters = shortcode_atts($args, $atts);
        extract($parameters);

        // Render Google Fonts
        $obj    = new GoogleFontsRender();
        $shortc = $this->shortcodeName;
        extract($obj->getAttributes($atts, $this, $shortc, array('google_fonts_title', 'google_fonts_position'), true));

        $team_styling_out = array();
        if (!empty($styles_google_fonts_title)) {
            $team_styling_out['styles_google_fonts_title'] = $styles_google_fonts_title;
        }

        if (!empty($styles_google_fonts_position)) {
            $team_styling_out['styles_google_fonts_position'] = $styles_google_fonts_position;
        }

        if ($use_theme_team_style == 'no') {
            if (!empty($custom_title_color)) {
                $team_styling_out['custom_title_color'] = $custom_title_color;
            }
            if (!empty($title_font_size)) {
                $team_styling_out['title_font_size'] = $title_font_size;
            }
            if (!empty($custom_position_color)) {
                $team_styling_out['custom_position_color'] = $custom_position_color;
            }
            if (!empty($position_font_size)) {
                $team_styling_out['position_font_size'] = $position_font_size;
            }
            if (!empty($custom_button_color)) {
                $team_styling_out['custom_button_color'] = $custom_button_color;
            }
            if (!empty($button_font_size)) {
                $team_styling_out['button_font_size'] = $button_font_size;
            }
        }

        // Separator
        if ($separator == 'yes') {
            $team_styling_out['separator']            = true;
            $team_styling_out['separator_margin_top'] = $margin_top;
            $team_styling_out['separator_color']      = $separator_color;
            $posts_container_class                    = ' gt3_separator-active';
        } else {
            $team_styling_out['separator'] = false;
            $posts_container_class         = ' gt3_separator-disable';
        }

        // Gap
        $posts_container = $team_style = $posts_shadow = '';
        if (isset($grid_gap) && !empty($grid_gap)) {
            $grid_gap                           = (int)$grid_gap / 2;
            $posts_container                    = 'margin-left:-' . $grid_gap . 'px; margin-right:-' . $grid_gap . 'px;';
            $posts_shadow                       = 'margin-left:' . $grid_gap . 'px; margin-right:' . $grid_gap . 'px;';
            $team_styling_out['custom_padding'] = $grid_gap;
            $posts_container_class              = ' gt3_team_list-gap_'.$grid_gap;
        }

        // Generate $parameters
        $parameters['team_styling_out'] = $team_styling_out;
        //

        if (empty($query_args)) {
            list($query_args) = vc_build_loop_query($build_query);
        }

        $team_term_id            = get_query_var('team_term_id');
        $query_args['paged']     = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query_args['post_type'] = 'team';

        ob_start();
        if ($show_filter == 'yes') {
            echo '<div class="' . esc_attr($this->shortcodeName) . '__filter' . ($filter_style == "isotope" ? ' isotope-filter' : '') . '">';
            echo $this->getCategoriesOut($query_args, $team_term_id);
            echo '</div>';
        }
        $filter = ob_get_clean();

        $parameters['query_args'] = $query_args;
        if (!empty($team_term_id)) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'team-category',
                    'field'    => 'term_id',
                    'terms'    => $team_term_id,
                ),
            );
        }
        $query_results = new WP_Query($query_args);

        $parameters['post_count'] = $query_results->post_count;

        $item_class = $this->grid_class($parameters);

        $out = '';
        $out .= '<div class="' . esc_attr($this->shortcodeName) . '">';
        $out .= $filter;
        $out .= '<div class="' . esc_attr($this->shortcodeName) . '__posts-container row ' . esc_attr($posts_container_class) . '" ' . $this->get_data_attr($parameters) . ' style="' . esc_attr($posts_container) . '">';
        $out .= '<div class="' . esc_attr($this->shortcodeName) . '__grid-sizer ' . $this->grid_class($parameters) . '"></div>';
        $out .= '<div class="' . esc_attr($this->shortcodeName) . '__grid-gutter"></div>';
        $out .= '<div class="' . esc_attr($this->shortcodeName) . '__grid-shadow" style="' . esc_attr($posts_shadow) . '"></div>';
        if ($query_results->have_posts()):
            $count_id = 1;
            while ($query_results->have_posts()) : $query_results->the_post();
                $out .= gt3_get_team_item($parameters, $item_class, $count_id);
                $count_id++;
                if ($count_id > 8) {
                    $count_id = 1;
                }
            endwhile;
        else:
            $out .= '<p>' . _e('Sorry, no posts matched your criteria.', 'gt3_oconnor_core') . '</p>';
        endif;
        $out .= '</div>';

        wp_reset_postdata();

        if ($show_pagination == 'yes' && $pagination_style == 'pagination') {
            global $wp_query, $paged;

            if (empty($paged)) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }
            $wp_query = $query_results;
            $out      .= gt3_get_theme_pagination();
        }

        if (!empty($query_args['posts_per_page']) && ($query_args['posts_per_page'] >= 0) && $query_args['posts_per_page'] <= $query_results->found_posts && $pagination_style == 'load_more') {
            $out .= $this->loadMoreTeam($parameters);
        }
        $out .= '</div>';
        return $out;
    }

    public function get_data_attr($parameters) {
        $data_attrs      = '';
        $ajax_parameters = array(
            'build_query',
            'team_style',
            'columns_with_spaces',
            'rounded_images',
            'posts_per_line',
            'show_on_full_width',
            'image_proportional',
            'items_load',
            'custom_title_color',
            'title_font_size',
            'custom_category_color',
            'category_font_size',
            'post_count',
        );
        foreach ($parameters as $parameter => $value) {
            if (!empty($value) && in_array($parameter, $ajax_parameters)) {
                $data_attrs .= ' data-' . esc_attr($parameter) . '="' . esc_attr($value) . '"';
            }
        }
        return $data_attrs;
    }

    public function grid_class($parameters) {
        switch ($parameters['posts_per_line']) {
            case 1:
                $item_class = 'gt3_span12';
                break;
            case 2:
                $item_class = 'gt3_span6';
                break;
            case 3:
                $item_class = 'gt3_span4';
                break;
            case 4:
                $item_class = 'gt3_span3';
                break;
            default:
                $item_class = 'gt3_span12';
        }
        return $item_class;
    }

    public static function getImgUrl($parameters, $wp_get_attachment_url, $image_extra_size, $natural_ratio) {
        if (strlen($wp_get_attachment_url)) {
            $ration = 1;

            switch ($parameters['posts_per_line']) {
                case "1":
                    if (function_exists('gt3_get_image_srcset')) {
                        $responsive_dimensions  = array(
                            array('1920', '1920'),
                            array('1200', '1200'),
                            array('992', '992'),
                            array('768', '768')
                        );
                        $gt3_featured_image_url = gt3_get_image_srcset($wp_get_attachment_url, $ration, $responsive_dimensions);
                    } else {
                        $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "1200", null, true, true, true) . '"';
                    }
                    break;
                case "2":
                    if (function_exists('gt3_get_image_srcset')) {
                        $responsive_dimensions  = array(
                            array('1920', '1536'),
                            array('1200', '960'),
                            array('992', '600'),
                            array('768', '768')
                        );
                        $gt3_featured_image_url = gt3_get_image_srcset($wp_get_attachment_url, $ration, $responsive_dimensions);
                    } else {
                        $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "1200", "1200", true, true, true) . '"';
                    }
                    break;
                case "3":
                    if (function_exists('gt3_get_image_srcset')) {
                        $responsive_dimensions  = array(
                            array('1920', '1024'),
                            array('1200', '640'),
                            array('992', '400'),
                            array('768', '768')
                        );
                        $gt3_featured_image_url = gt3_get_image_srcset($wp_get_attachment_url, $ration, $responsive_dimensions);
                    } else {
                        $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "1200", "1200", true, true, true) . '"';
                    }
                    break;
                case "4":
                    if (function_exists('gt3_get_image_srcset')) {
                        $responsive_dimensions  = array(
                            array('1920', '768'),
                            array('1200', '480'),
                            array('992', '300'),
                            array('768', '768')
                        );
                        $gt3_featured_image_url = gt3_get_image_srcset($wp_get_attachment_url, $ration, $responsive_dimensions);
                    } else {
                        $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "1200", "1200", true, true, true) . '"';
                    }
                    break;
                default:
                    $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "1170", $ration, true, true, true) . '"';
            }


            if ($ration == null && !empty($natural_ratio)) {
                $ration = $natural_ratio;
            }

            $mainColor = getSolidColorFromImage($wp_get_attachment_url);

            $featured_image = '<div class="gt3_team_list__image-placeholder" style="padding-bottom:' . (100 * $ration) . '%;margin-bottom:-' . (100 * $ration) . '%;background-color:#' . $mainColor . ';"></div>';
            $featured_image .= '<img ' . $gt3_featured_image_url . ' alt="" />';
        } else {
            $featured_image = '';
        }
        return $featured_image;
    }

    public function getCategoriesOut($parameters, $team_term_id) {
        $gt3_wp_query_in_shortcodes = new WP_Query($parameters);
        $data_category              = isset($parameters['tax_query']) ? $parameters['tax_query'] : array();
        $include                    = array();
        $exclude                    = array();
        if (!is_tax()) {
            if (!empty($data_category) && $data_category[0]['operator'] === 'IN') {
                foreach ($data_category[0]['terms'] as $key => $value) {
                    array_push($include, $value);
                }
            } elseif (!empty($data_category) && $data_category[0]['operator'] === 'NOT IN') {
                foreach ($data_category[0]['terms'] as $key => $value) {
                    array_push($exclude, $value);
                }
            }
        }
        $permalink = get_permalink();
        $cats      = get_terms(array(
            'taxonomy' => 'team-category',
            'include'  => $include,
            'exclude'  => $exclude
        ));
        $out       = '<a href="' . esc_url($permalink) . '" data-filter=".gt3_team_list__item " ' . (empty($team_term_id) ? ' class="active"' : '') . ' >' . esc_html__('All', 'gt3_oconnor_core') . '</a>';
        foreach ($cats as $cat) {
            $permalink = esc_url(add_query_arg("team_term_id", $cat->term_id, $permalink));
            $out       .= '<a href="' . esc_url($permalink) . '" data-filter=".' . $cat->slug . '"' . ($team_term_id == $cat->term_id ? ' class="active"' : '') . '>';
            $out       .= $cat->name;
            $out       .= '</a>';
        }
        wp_reset_postdata();
        return $out;
    }

    public function loadMoreTeam($parameters) {
        extract($parameters);
        $x       = json_encode($parameters);
        $x       = esc_attr($x);
        $compile = '';
        $compile .= '<div class="text-center gt3_module_button button_alignment_center"><a href="' . esc_js("javascript:void(0)") . '" class="gt3_team_load_more shortcode_button button_size_normal">' . esc_html__("Load More", 'gt3_oconnor_core') . '</a></div>';

        $posts_per_page = 2;
        return $compile;
    }
}

function gt3_get_team_item($parameters, $item_class, $count_id) {
    $out           = '';
    $post_cats     = wp_get_post_terms(get_the_id(), 'team-category');
    $post_cats_str = '';
    for ($i = 0; $i < count($post_cats); $i++) {
        $post_cat_term = $post_cats[$i];
        $post_cat_name = $post_cat_term->slug;
        $post_cats_str .= ' ' . $post_cat_name;
    }
    $item_class .= $post_cats_str;

    //member position
    $position_member = class_exists('RWMB_Loader') ? rwmb_meta('position_member') : '';

    //member social
    if (class_exists('RWMB_Loader') && isset($parameters['show_socials']) && $parameters['show_socials'] == 'yes') {
        $member_social = rwmb_meta('icon_selection');
        $social_out    = '';
        if (!empty($member_social) && is_array($member_social)) {
            foreach ($member_social as $social) {
                if (!empty($social['select'])) {
                    $social_out .= '<a href="' . esc_url($social['input']) . '" class="gt3_team_list_social__item ' . $social['select'] . '" target="_blank"' . (!empty($social['color']) ? ' data-hover-color="' . $social['color'] . '"' : '') . '>';
                    $social_out .= '</a>';
                }
            }
        }
        if (!empty($social_out)) {
            $social_out = '<div class="gt3_team_list_social">' . $social_out . '</div>';
        }
    } else {
        $social_out = '';
    }

    if (!empty($parameters['team_style'])) {
        $item_class .= $parameters['team_style'] == 'content_on_bottom' ? ' gt3_team_list__item--content_on_bottom' : '';
    }
    if (!empty($parameters['team_style'])) {
        $item_class .= $parameters['team_style'] == 'content_on_right_side' ? ' gt3_team_list__item--content_on_right_side' : '';
    }
    if (!empty($parameters['image_proportional'])) {
        $item_class .= ' gt3_team_list__item--image_' . $parameters['image_proportional'];
    }
    if (!empty($count_id)) {
        $item_class .= ' gt3_team_list__item--' . $count_id;
    }

    if (!empty($parameters['team_styling_out'])) {
        //title style
        $team_styling_out           = $parameters['team_styling_out'];
        $custom_team_title_style    = '';
        $custom_team_position_style = '';
        $custom_team_button_style   = '';
        $custom_team_title_style    .= !empty($team_styling_out['custom_title_color']) ? 'color:' . $team_styling_out['custom_title_color'] . ';' : '';
        $custom_team_title_style    .= !empty($team_styling_out['title_font_size']) ? 'font-size:' . $team_styling_out['title_font_size'] . 'px;' : '';
        $custom_team_title_style    .= !empty($team_styling_out['styles_google_fonts_title']) ? $team_styling_out['styles_google_fonts_title'] : '';
        // position style
        $custom_team_position_style .= !empty($team_styling_out['custom_position_color']) ? 'color:' . $team_styling_out['custom_position_color'] . ';' : '';
        $custom_team_position_style .= !empty($team_styling_out['position_font_size']) ? 'font-size:' . $team_styling_out['position_font_size'] . 'px;' : '';
        $custom_team_position_style .= !empty($team_styling_out['styles_google_fonts_position']) ? $team_styling_out['styles_google_fonts_position'] : '';

        // button style
        $custom_team_button_style .= !empty($team_styling_out['custom_button_color']) ? 'color:' . $team_styling_out['custom_button_color'] . ';' : '';
        $custom_team_button_style .= !empty($team_styling_out['button_font_size']) ? 'font-size:' . $team_styling_out['button_font_size'] . 'px;' : '';

        // team padding
        $custom_team_style = !empty($team_styling_out['custom_padding']) ? 'padding-left:' . $team_styling_out['custom_padding'] . 'px ;padding-right:' . $team_styling_out['custom_padding'] . 'px;' : '';

        // team separator
        $separator_css = !empty($team_styling_out['separator_margin_top']) ? 'margin-top:' . $team_styling_out['separator_margin_top'] . 'px ;' : '';
        $separator_css .= !empty($team_styling_out['separator_color']) ? 'background-color:' . $team_styling_out['separator_color'] . ';' : '';

    } else {
        $custom_team_title_style    = '';
        $custom_team_position_style = '';
        $custom_team_button_style   = '';
        $custom_team_style          = '';
        $separator_css              = '';
    }
    $custom_team_title_style    = !empty($custom_team_title_style) ? ' style="' . $custom_team_title_style . '"' : '';
    $custom_team_position_style = !empty($custom_team_position_style) ? ' style="' . $custom_team_position_style . '"' : '';
    $custom_team_button_style   = !empty($custom_team_button_style) ? ' style="' . $custom_team_button_style . '"' : '';


    // set post options
    $p_id = get_the_ID();

    $content_post = get_post($p_id);
    // Letter Count


    $image_array = image_downsize(get_post_thumbnail_id($p_id), 'full');
    if (!empty($image_array) && is_array($image_array)) {
        $wp_get_attachment_url = !empty($image_array[0]) ? $image_array[0] : wp_get_attachment_url(get_post_thumbnail_id($p_id));
        if (!empty($image_array[1]) && !empty($image_array[2])) {
            $ratio = $image_array[2] / $image_array[1];
        }
    } else {
        $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id($p_id));
        $ratio                 = null;
    }

    $image_extra_size = 'normal';

    $image_out = gt3Team::getImgUrl($parameters, $wp_get_attachment_url, $image_extra_size, $ratio);

    $content_out = '';
    $content_out .= '<div class="gt3_team_list__content"' . $custom_team_position_style . '>';

    if ($team_styling_out['separator'] == 'yes') {
        $content_out .= '<div class="gt3_team_separator" style="' . esc_attr($separator_css) . '"></div>';
    }

    if (empty($parameters['team_style']) || (!empty($parameters['team_style']) && $parameters['team_style'] == 'content_on_right_side')) {
        $content_out .= $social_out;
    }
    $content_out .= '<a href="' . get_permalink() . '" class="gt3_team_list__title_link">';
    $content_out .= '<h3 class="gt3_team_list__title" ' . (!empty($custom_team_title_style) ? $custom_team_title_style : '') . '>' . get_the_title() . '</h3>';
    $content_out .= '</a>';
    if (!empty($position_member)) {
        $content_out .= '<div class="gt3_team_list__position">' . esc_html($position_member) . '</div>';
    }
    if (empty($parameters['team_style']) || (!empty($parameters['team_style']) && $parameters['team_style'] == 'content_on_right_side')) {
        $content_letter_count = '';
        if (has_excerpt()) {
            $post_excerpt = get_the_excerpt();
        } else {
            $content_letter_count = 85;
            $post_excerpt         = get_the_content();
        }

        $post_excerpt              = preg_replace('~\[[^\]]+\]~', '', $post_excerpt);
        $post_excerpt_without_tags = strip_tags($post_excerpt);

        if ($content_letter_count != '') {
            $post_descr = gt3_smarty_modifier_truncate($post_excerpt_without_tags, $content_letter_count, "...");
        } else {
            $post_descr = $post_excerpt_without_tags;
        }
        $content_out .= '<div class="gt3_team_list__desc">' . esc_html($post_descr) . '</div>';
        $content_out .= '<a href="' . get_permalink() . '" class="gt3_team_list__learn_more">' . (esc_html__('Learn More', 'gt3_oconnor_core')) . '</a>';
    }
    $content_out .= '</div>';


    $out .= '<article class="gt3_team_list__item ' . esc_attr($item_class) . '" style="' . esc_attr($custom_team_style) . '">';
    $out .= '<div class="gt3_team_list__image-holder">';
    $out .= '<a href="' . get_permalink() . '" class="gt3_team_list__image_link">';
    if (!empty($image_out)) {
        $out .= $image_out;
    } else {
        $out .= '<div class="gt3_team_list__image_placeholder"></div>';
    }
    $out .= '</a>';

    if (empty($parameters['team_style']) || (!empty($parameters['team_style']) && $parameters['team_style'] == 'content_below')) {
        $out .= $content_out;
    }
    if (empty($parameters['team_style']) || (!empty($parameters['team_style']) && $parameters['team_style'] != 'content_on_right_side')) {
        $out .= $social_out;
    }
    $out .= '</div>';


    if (empty($parameters['team_style']) || (!empty($parameters['team_style']) && ($parameters['team_style'] == 'content_on_bottom' || $parameters['team_style'] == 'content_on_right_side'))) {
        $out .= $content_out;
    }
    $out .= '</article>';
    return $out;
}

add_action('wp_ajax_gt3_get_team_item_from_ajax', 'gt3_get_team_item_from_ajax');
add_action('wp_ajax_gt3_get_team_item_from_ajax', 'gt3_get_team_item_from_ajax');
function gt3_get_team_item_from_ajax() {
    $build_query    = $_POST['build_query'];
    $team_style     = esc_attr($_POST['team_style']);
    $posts_per_line = esc_attr($_POST['posts_per_line']);
    $items_load     = esc_attr($_POST['items_load']);
    $post_count     = esc_attr($_POST['post_count']);

    list($query_args) = vc_build_loop_query($build_query);

    $query_args['post_type']      = 'team';
    $query_args['post_status']    = 'publish';
    $query_args['offset']         = $post_count;
    $query_args['posts_per_page'] = $items_load;

    $query_results = new WP_Query($query_args);
    $out           = '';
    //    $parameters    = $posts_param_str;
    $parameters = array(
        'team_style'     => $team_style,
        'posts_per_line' => $posts_per_line,
    );
    $item_class = gt3Team::grid_class($parameters);
    $items_left = $query_results->found_posts - ($post_count + $items_load);

    if (!empty($post_count)) {
        $count_id = $post_count - ((int)($post_count / 8)) * 8;
        $count_id++;
    }

    if ($query_results->have_posts()):
        /*$count_id = 1; */
        while ($query_results->have_posts()) : $query_results->the_post();
            $out .= gt3_get_team_item($parameters, $item_class, $count_id);
            if ($count_id == 8) {
                $count_id = 1;
            } else {
                $count_id++;
            }
        endwhile;
    else:
        wp_reset_postdata();
        echo json_encode(array(
            'html'       => '',
            'items_left' => $items_left,
            'count_id'   => $count_id,
            'post_count' => $post_count
        ));
        wp_die();
    endif;
    wp_reset_postdata();
    echo json_encode(array(
        'html'       => $out,
        'items_left' => $items_left,
        'count_id'   => $count_id,
        'post_count' => $post_count
    ));
    wp_die();
}