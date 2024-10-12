<?php


/**
 *
 */
class gt3Practice {

    private $shortcodeName;

    public function __construct() {
        $this->shortcodeName = 'gt3_practice_list';
    }

    public function shortcode_render() {
        add_action('vc_before_init', array($this, 'shortcodesMap'));
        $this->addShortcode();
    }

    public function shortcodesMap() {
        if (function_exists('vc_map')) {
            vc_map(array(
                "name"            => esc_html__("Practice List", 'gt3_oconnor_core'),
                "base"            => $this->shortcodeName,
                "class"           => $this->shortcodeName,
                "category"        => esc_html__('GT3 Modules', 'gt3_oconnor_core'),
                "icon"            => 'gt3_icon',
                "content_element" => true,
                "description"     => esc_html__("Project List", 'gt3_oconnor_core'),
                "params"          => array(
                    array(
                        'type'        => 'loop',
                        'heading'     => esc_html__('Project Items', 'gt3_oconnor_core'),
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
                        'type'       => 'gt3_custom_select',
                        'heading'    => esc_html__('Style', 'gt3_oconnor_core'),
                        'param_name' => 'practice_style',
                        'options'    => array(
                            esc_html__("Content on Image", 'gt3_oconnor_core')        => 'content_on_image',
                            esc_html__("Content below the image", 'gt3_oconnor_core') => 'content_below',
                        ),
                        'value'      => 'content_below',
                        'dependency' => array(
                            'element'            => 'practice_layout',
                            'value_not_equal_to' => 'multisize',
                        ),
                    ),
                    array(
                        'type'       => 'gt3_custom_select',
                        'heading'    => esc_html__('Layout', 'gt3_oconnor_core'),
                        'param_name' => 'practice_layout',
                        'options'    => array(
                            esc_html__("Grid", 'gt3_oconnor_core')              => 'grid',
                            esc_html__("Masonry", 'gt3_oconnor_core')           => 'masonry',
                            esc_html__("Packery multisize", 'gt3_oconnor_core') => 'multisize',
                        ),
                        'value'      => 'grid',
                    ),
                    array(
                        'type'       => 'gt3_custom_select',
                        'heading'    => esc_html__('Content Align', 'gt3_oconnor_core'),
                        'param_name' => 'practice_content_align',
                        'options'    => array(
                            esc_html__("Left", 'gt3_oconnor_core')   => 'left',
                            esc_html__("Center", 'gt3_oconnor_core') => 'center',
                            esc_html__("Right", 'gt3_oconnor_core')  => 'right',
                        ),
                        'value'      => 'left',
                    ),
                    array(
                        'type'             => 'gt3_on_off',
                        'heading'          => esc_html__('Columns with Spaces', 'gt3_oconnor_core'),
                        'param_name'       => 'columns_with_spaces',
                        'value'            => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'std'              => 'yes',
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type'             => 'gt3_on_off',
                        'heading'          => esc_html__('Rounded images', 'gt3_oconnor_core'),
                        'param_name'       => 'rounded_images',
                        'value'            => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'std'              => 'yes',
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type'             => 'gt3_custom_select',
                        'heading'          => esc_html__('Items Per Line', 'gt3_oconnor_core'),
                        'param_name'       => 'posts_per_line',
                        'admin_label'      => true,
                        'options'          => array(
                            esc_html__("1", 'gt3_oconnor_core') => '1',
                            esc_html__("2", 'gt3_oconnor_core') => '2',
                            esc_html__("3", 'gt3_oconnor_core') => '3',
                            esc_html__("4", 'gt3_oconnor_core') => '4',
                        ),
                        'value'            => '3',
                        'edit_field_class' => 'vc_col-sm-6',
                        'dependency'       => array(
                            'element'            => 'practice_layout',
                            'value_not_equal_to' => 'multisize',
                        ),
                    ),
                    array(
                        'type'             => 'gt3_on_off',
                        'heading'          => esc_html__('Portfolio in Full width Section', 'gt3_oconnor_core'),
                        'param_name'       => 'show_on_full_width',
                        'value'            => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'std'              => 'no',
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type'        => 'gt3_custom_select',
                        'heading'     => esc_html__('Image Proportional', 'gt3_oconnor_core'),
                        'param_name'  => 'image_proportional',
                        'admin_label' => true,
                        'options'     => array(
                            esc_html__("Native", 'gt3_oconnor_core')    => 'native',
                            esc_html__("Square", 'gt3_oconnor_core')    => 'square',
                            esc_html__("Landscape", 'gt3_oconnor_core') => 'landscape',
                            esc_html__("Portred", 'gt3_oconnor_core')   => 'portred',
                        ),
                        'value'       => 'native',
                        'dependency'  => array(
                            'element'            => 'practice_layout',
                            'value_not_equal_to' => 'multisize',
                        ),
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
                        'type'             => 'gt3_custom_select',
                        'heading'          => esc_html__('Filter Style', 'gt3_oconnor_core'),
                        'param_name'       => 'filter_style',
                        'save_always'      => true,
                        'options'          => array(
                            esc_html__('Links', 'gt3_oconnor_core')   => "links",
                            esc_html__('Isotope', 'gt3_oconnor_core') => "isotope",
                        ),
                        'value'            => 'links',
                        'dependency'       => array(
                            'element' => 'show_filter',
                            "value"   => "yes"
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type'             => 'gt3_custom_select',
                        'heading'          => esc_html__('Filter Align', 'gt3_oconnor_core'),
                        'param_name'       => 'filter_align',
                        'save_always'      => true,
                        'options'          => array(
                            esc_html__('Left', 'gt3_oconnor_core')   => "left",
                            esc_html__('Center', 'gt3_oconnor_core') => "center",
                            esc_html__('Right', 'gt3_oconnor_core')  => "right",
                        ),
                        'value'            => 'left',
                        'dependency'       => array(
                            'element' => 'show_filter',
                            "value"   => "yes"
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type'       => 'gt3_on_off',
                        'heading'    => esc_html__('Show Pagination', 'gt3_oconnor_core'),
                        'param_name' => 'show_pagination',
                        'value'      => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'std'        => 'no',
                    ),
                    array(
                        'type'             => 'gt3_custom_select',
                        'heading'          => esc_html__('Pagination Style', 'gt3_oconnor_core'),
                        'param_name'       => 'pagination_style',
                        'save_always'      => true,
                        'options'          => array(
                            esc_html__('Pagination', 'gt3_oconnor_core')       => "pagination",
                            esc_html__('Load More Button', 'gt3_oconnor_core') => "load_more",
                        ),
                        'value'            => 'pagination',
                        'dependency'       => array(
                            'element' => 'show_pagination',
                            "value"   => "yes"
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type'             => 'textfield',
                        'heading'          => esc_html__('Items on load', 'gt3_oconnor_core'),
                        'param_name'       => 'items_load',
                        'value'            => '4',
                        'save_always'      => true,
                        'description'      => esc_html__('Items load by load more button.', 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element' => 'pagination_style',
                            "value"   => "load_more"
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    // Content Letter Count
                    array(
                        'type'             => 'textfield',
                        'heading'          => esc_html__('Content Letter Count', 'gt3_oconnor_core'),
                        'param_name'       => 'content_letter_count',
                        'value'            => '100',
                        'description'      => esc_html__('Enter content letter count.', 'gt3_oconnor_core'),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),

                    array(
                        'type'       => 'gt3_on_off',
                        'heading'    => esc_html__('Show Read More Link?', 'gt3_oconnor_core'),
                        'param_name' => 'show_read_more',
                        'value'      => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'std'        => 'yes',
                    ),

                    // Portfolio Font
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
                        'heading'     => esc_html__('Use theme default font family for categories?', 'gt3_oconnor_core'),
                        'param_name'  => 'use_theme_fonts_categories',
                        'value'       => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'description' => esc_html__('Use font family from the theme.', 'gt3_oconnor_core'),
                        "group"       => esc_html__("Styling", 'gt3_oconnor_core'),
                        'std'         => 'yes',
                    ),
                    array(
                        'type'       => 'google_fonts',
                        'param_name' => 'google_fonts_categories',
                        'value'      => '',
                        'settings'   => array(
                            'fields' => array(
                                'font_family_description' => esc_html__('Select font family.', 'gt3_oconnor_core'),
                                'font_style_description'  => esc_html__('Select font styling.', 'gt3_oconnor_core'),
                            ),
                        ),
                        'dependency' => array(
                            'element'            => 'use_theme_fonts_categories',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"      => esc_html__("Styling", 'gt3_oconnor_core'),
                    ),
                    // Portfolio Headings Font
                    array(
                        'type'        => 'gt3_on_off',
                        'heading'     => esc_html__('Use theme default practice style?', 'gt3_oconnor_core'),
                        'param_name'  => 'use_theme_practice_style',
                        'value'       => array(esc_html__('Yes', 'gt3_oconnor_core') => 'yes'),
                        'description' => esc_html__('Use default practice style from the theme.', 'gt3_oconnor_core'),
                        "group"       => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always' => true,
                        'std'         => 'yes',
                    ),
                    // Custom practice style
                    array(
                        "type"             => "colorpicker",
                        "class"            => "",
                        "heading"          => esc_html__("Custom Title Color", 'gt3_oconnor_core'),
                        "param_name"       => "custom_title_color",
                        "value"            => '#222328',
                        "description"      => esc_html__("Select custom title color.", 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_practice_style',
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
                            'element'            => 'use_theme_practice_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        "type"             => "colorpicker",
                        "class"            => "",
                        "heading"          => esc_html__("Custom Category Color", 'gt3_oconnor_core'),
                        "param_name"       => "custom_category_color",
                        "value"            => '#3a405b',
                        "description"      => esc_html__("Select custom category color.", 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_practice_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    // Heading Font Size
                    array(
                        'type'             => 'textfield',
                        'heading'          => esc_html__('Category Font Size', 'gt3_oconnor_core'),
                        'param_name'       => 'category_font_size',
                        'value'            => '14',
                        'description'      => esc_html__('Enter Category font-size in pixels.', 'gt3_oconnor_core'),
                        'dependency'       => array(
                            'element'            => 'use_theme_practice_style',
                            'value_not_equal_to' => 'yes',
                        ),
                        "group"            => esc_html__("Styling", 'gt3_oconnor_core'),
                        'save_always'      => true,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
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

        /**
         * Shortcode attributes
         * @var $query_args
         * @var $build_query
         * @var $practice_style
         * @var $practice_layout
         * @var $practice_content_align
         * @var $columns_with_spaces
         * @var $rounded_images
         * @var $posts_per_line
         * @var $show_on_full_width
         * @var $image_proportional
         * @var $show_filter
         * @var $filter_align
         * @var $filter_style
         * @var $show_pagination
         * @var $pagination_style
         * @var $items_load
         * @var $content_letter_count
         * @var $show_read_more
         * @var $use_theme_practice_style
         * @var $custom_title_color
         * @var $title_font_size
         * @var $custom_category_color
         * @var $category_font_size
         */
        include_once OCONNOR_PLUGIN_DIR . '/includes/class-gt3_google_fonts_render.php';
        wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
        
        $args = array(
            'query_args'               => '',
            'build_query'              => '',
            'practice_style'           => 'content_below',
            'practice_layout'          => 'grid',
            'practice_content_align'   => 'left',
            'columns_with_spaces'      => '',
            'rounded_images'           => 'yes',
            "posts_per_line"           => 3,
            'show_on_full_width'       => '',
            'image_proportional'       => 'native',
            "show_filter"              => "",
            "filter_align"             => "left",
            'filter_style'             => '',
            'show_pagination'          => '',
            'pagination_style'         => '',
            'items_load'               => 4,
            'content_letter_count'     => 100,
            'show_read_more'           => 'yes',
            'use_theme_practice_style' => '',
            'custom_title_color'       => '',
            'title_font_size'          => '',
            'custom_category_color'    => '',
            'category_font_size'       => ''
        );

        $parameters = shortcode_atts($args, $atts);
        extract($parameters);

        if ($parameters['practice_layout'] == 'multisize') {
            $parameters['posts_per_line']     = 4;
            $parameters['image_proportional'] = 'square';
            $parameters['practice_style']     = 'content_on_image';
        }

        // Render Google Fonts
        $obj    = new GoogleFontsRender();
        $shortc = $this->shortcodeName;
        extract($obj->getAttributes($atts, $this, $shortc, array('google_fonts_title', 'google_fonts_categories'), true));

        $practice_styling_out = array();
        if (!empty($styles_google_fonts_title)) {
            $practice_styling_out['styles_google_fonts_title'] = $styles_google_fonts_title;
        }

        if (!empty($styles_google_fonts_categories)) {
            $practice_styling_out['styles_google_fonts_categories'] = $styles_google_fonts_categories;
        }

        if ($use_theme_practice_style == 'no') {
            if (!empty($custom_title_color)) {
                $practice_styling_out['custom_title_color'] = $custom_title_color;
            }
            if (!empty($title_font_size)) {
                $practice_styling_out['title_font_size'] = $title_font_size;
            }
            if (!empty($custom_category_color)) {
                $practice_styling_out['custom_category_color'] = $custom_category_color;
            }
            if (!empty($category_font_size)) {
                $practice_styling_out['category_font_size'] = $category_font_size;
            }
        }
        $parameters['practice_styling_out'] = $practice_styling_out;
        if (empty($query_args)) {
            list($query_args) = vc_build_loop_query($build_query);
        }
        if (empty($query_args['posts_per_page'])) {
            $query_args['posts_per_page'] = '12';
        }

        $practice_term_id        = get_query_var('practice_term_id');
        $query_args['paged']     = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query_args['post_type'] = 'practice';

        ob_start();
        if ($show_filter == 'yes') {
            echo '<div class="' . esc_attr($this->shortcodeName) . '__filter' .
                ($filter_style == "isotope" ? ' isotope-filter' : '') .
                (!empty($filter_align) ? ' ' . esc_attr($this->shortcodeName) . '__filter--' . esc_attr($filter_align) : '') . '">';
            echo $this->getCategoriesOut($query_args, $practice_term_id);
            echo '</div>';
        }
        $filter = ob_get_clean();

        $parameters['query_args'] = $query_args;
        if (!empty($practice_term_id)) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'practice-category',
                    'field'    => 'term_id',
                    'terms'    => $practice_term_id,
                ),
            );
        }
        $query_results = new WP_Query($query_args);

        $parameters['post_count']           = $query_results->post_count;
        $parameters['content_letter_count'] = $content_letter_count;
        $parameters['show_read_more']       = $show_read_more;

        $item_class = $this->grid_class($parameters);

        $out = '';
        $out .= '<div class="' . esc_attr($this->shortcodeName) .
            (!empty($practice_content_align) ? ' ' . esc_attr($this->shortcodeName) . '__content_align--' . esc_attr($practice_content_align) : '') . '">';
        $out .= $filter;
        $out .= '<div class="' . esc_attr($this->shortcodeName) . '__posts-container row ' .
            ($practice_layout == "multisize" ? 'isotope_packery' : '') .
            ($columns_with_spaces != 'yes' ? ' no_spaces' : '') .
            ($rounded_images != 'yes' ? ' no_image_rounds' : '') . '"' . $this->get_data_attr($parameters) . '>';
        $out .= '<div class="' . esc_attr($this->shortcodeName) . '__grid-sizer ' . gt3Practice::grid_class($parameters) . '"></div>';
        $out .= '<div class="' . esc_attr($this->shortcodeName) . '__grid-gutter"></div>';
        if ($query_results->have_posts()):
            $count_id = 1;
            while ($query_results->have_posts()) : $query_results->the_post();
                $out .= gt3_get_practice_item($parameters, $item_class, $count_id);
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

        if (($query_args['posts_per_page'] >= 0) && $query_args['posts_per_page'] < $query_results->found_posts && $pagination_style == 'load_more') {
            $out .= $this->loadMorePractice($parameters);
        }
        $out .= '</div>';
        return $out;
    }

    public function get_data_attr($parameters) {
        $data_attrs      = '';
        $ajax_parameters = array(
            'build_query',
            'practice_style',
            'practice_layout',
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
            'show_read_more',
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
            if (!empty($parameters['image_proportional']) && $parameters['image_proportional'] != 'native') {
                switch ($parameters['image_proportional']) {
                    case 'square':
                        $ration = 1;
                        break;
                    case 'landscape':
                        $ration = 0.778;
                        break;
                    case 'portred':
                        $ration = 1.25;
                        break;
                    default:
                        $ration = null;
                        break;
                }
            } else {
                $ration = null;
            }

            switch ($parameters['posts_per_line']) {
                case "1":
                    if (function_exists('gt3_get_image_srcset')) {
                        if ($parameters['columns_with_spaces'] != 'yes') {
                            $responsive_dimensions = array(
                                array('1200', '1200'),
                                array('992', '992'),
                                array('768', '768')
                            );
                        } else {
                            $responsive_dimensions = array(
                                array('1200', '1170'),
                                array('992', '950'),
                                array('768', '768')
                            );
                        }
                        if ($parameters['show_on_full_width'] == 'yes') {
                            array_unshift($responsive_dimensions, array('1900', '1900'), array('1600', '1600'));
                        }
                        $gt3_featured_image_url = gt3_get_image_srcset($wp_get_attachment_url, $ration, $responsive_dimensions);
                    } else {
                        $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "1170", null, true, true, true) . '"';
                    }

                    break;
                case "2":
                    if (function_exists('gt3_get_image_srcset')) {
                        if ($parameters['columns_with_spaces'] != 'yes') {
                            $responsive_dimensions = array(
                                array('1200', '585'),
                                array('992', '475'),
                                array('768', '768')
                            );
                            if ($parameters['show_on_full_width'] == 'yes') {
                                array_unshift($responsive_dimensions, array('2000', '1200'), array('1900', '950'), array('1600', '800'));
                            }
                        } else {
                            $responsive_dimensions = array(
                                array('1200', '570'),
                                array('992', '460'),
                                array('768', '768')
                            );
                            if ($parameters['show_on_full_width'] == 'yes') {
                                array_unshift($responsive_dimensions, array('2000', '1200'), array('1930', '950'), array('1630', '800'));
                            }
                        }
                        $gt3_featured_image_url = gt3_get_image_srcset($wp_get_attachment_url, $ration, $responsive_dimensions);
                    } else {
                        $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "570", "570", true, true, true) . '"';
                    }
                    break;
                case "3":
                    if (function_exists('gt3_get_image_srcset')) {
                        if ($parameters['columns_with_spaces'] != 'yes') {
                            $responsive_dimensions = array(
                                array('1200', '390'),
                                array('992', '317'),
                                array('768', '768')
                            );
                            if ($parameters['show_on_full_width'] == 'yes') {
                                array_unshift($responsive_dimensions, array('2000', '1200'), array('1890', '630'), array('1590', '530'));
                            }
                        } else {
                            $responsive_dimensions = array(
                                array('1200', '370'),
                                array('992', '297'),
                                array('768', '768')
                            );
                            if ($parameters['show_on_full_width'] == 'yes') {
                                array_unshift($responsive_dimensions, array('2000', '1200'), array('1920', '630'), array('1620', '530'));
                            }
                        }
                        $gt3_featured_image_url = gt3_get_image_srcset($wp_get_attachment_url, $ration, $responsive_dimensions);
                    } else {
                        $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "370", "370", true, true, true) . '"';
                    }
                    break;
                case "4":
                    if (function_exists('gt3_get_image_srcset')) {
                        if ($parameters['columns_with_spaces'] != 'yes') {
                            $responsive_dimensions = array(
                                array('1200', '293'),
                                array('992', '238'),
                                array('768', '768')
                            );
                            if ($parameters['show_on_full_width'] == 'yes') {
                                array_unshift($responsive_dimensions, array('2000', '1200'), array('1900', '475'), array('1600', '400'));
                            }
                        } else {
                            $responsive_dimensions = array(
                                array('1200', '270'),
                                array('992', '215'),
                                array('768', '768')
                            );
                            if ($parameters['show_on_full_width'] == 'yes') {
                                array_unshift($responsive_dimensions, array('2000', '1200'), array('1920', '475'), array('1630', '400'));
                            }
                        }
                        if (!empty($image_extra_size)) {
                            switch ($image_extra_size) {
                                case 'large_width_height':
                                    if ($parameters['columns_with_spaces'] != 'yes') {
                                        $responsive_dimensions = array(
                                            array('1200', '585'),
                                            array('992', '475'),
                                            array('768', '768')
                                        );
                                        if ($parameters['show_on_full_width'] == 'yes') {
                                            array_unshift($responsive_dimensions, array('1600', '800'), array('1900', '950'));
                                        }
                                    } else {
                                        $responsive_dimensions = array(
                                            array('1200', '570'),
                                            array('992', '460'),
                                            array('768', '768')
                                        );
                                        if ($parameters['show_on_full_width'] == 'yes') {
                                            array_unshift($responsive_dimensions, array('1630', '800'), array('1920', '950'));
                                        }
                                    }
                                    $ration = 1;
                                    break;

                                case 'large_height':
                                    if ($parameters['columns_with_spaces'] != 'yes') {
                                        $responsive_dimensions = array(
                                            array('1200', '293'),
                                            array('992', '238'),
                                            array('768', '768')
                                        );

                                        $ration = 2.114;
                                        if ($parameters['show_on_full_width'] == 'yes') {
                                            $ration = 2;
                                            array_unshift($responsive_dimensions, array('1600', '400'), array('1900', '475'));
                                        }
                                    } else {
                                        $responsive_dimensions = array(
                                            array('1200', '270'),
                                            array('992', '215'),
                                            array('768', '768')
                                        );

                                        $ration                = 2.114;
                                        if ($parameters['show_on_full_width'] == 'yes') {
                                            $ration = 2.075;
                                            array_unshift($responsive_dimensions, array('1630', '400'), array('1920', '475'));
                                        }
                                    }
                                    break;

                                case 'large_width':
                                    if ($parameters['columns_with_spaces'] != 'yes') {
                                        $responsive_dimensions = array(
                                            array('1200', '585'),
                                            array('992', '475'),
                                            array('768', '768')
                                        );
                                        if ($parameters['show_on_full_width'] == 'yes') {
                                            array_unshift($responsive_dimensions, array('1600', '800'), array('1900', '950'));
                                        }
                                    } else {
                                        $responsive_dimensions = array(
                                            array('1200', '570'),
                                            array('992', '460'),
                                            array('768', '768')
                                        );
                                        if ($parameters['show_on_full_width'] == 'yes') {
                                            array_unshift($responsive_dimensions, array('1630', '800'), array('1920', '950'));
                                        }
                                    }
                                    $ration = 0.5;
                                    break;

                                default:
                                    break;
                            }
                        }
                        $gt3_featured_image_url = gt3_get_image_srcset($wp_get_attachment_url, $ration, $responsive_dimensions);
                    } else {
                        $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "270", "270", true, true, true) . '"';
                    }
                    break;
                default:
                    $gt3_featured_image_url = 'src="' . aq_resize($wp_get_attachment_url, "1170", $ration, true, true, true) . '"';
            }


            if ($ration == null && !empty($natural_ratio)) {
                $ration = $natural_ratio;
            }

            $mainColor = getSolidColorFromImage($wp_get_attachment_url);

            $featured_image = '<div class="gt3_practice_list__image-placeholder" style="padding-bottom:' . (100 * $ration) . '%;margin-bottom:-' . (100 * $ration) . '%;background-color:#' . $mainColor . ';"></div>';
            $featured_image .= '<img ' . $gt3_featured_image_url . ' alt="" />';
        } else {
            $featured_image = '';
        }
        return $featured_image;
    }

    public function getCategoriesOut($parameters, $practice_term_id) {
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
            'taxonomy' => 'practice-category',
            'include'  => $include,
            'exclude'  => $exclude
        ));
        $out       = '<a href="' . esc_url($permalink) . '" data-filter=".gt3_practice_list__item " ' . (empty($practice_term_id) ? ' class="active"' : '') . '>' . esc_html__('All', 'gt3_connor_core') . '</a>';
        foreach ($cats as $cat) {
            $permalink = esc_url(add_query_arg("practice_term_id", $cat->term_id, $permalink));
            $out       .= '<a href="' . esc_url($permalink) . '" data-filter=".' . $cat->slug . '"' . ($practice_term_id == $cat->term_id ? ' class="active"' : '') . '>';
            $out       .= $cat->name;
            $out       .= '</a>';
        }
        wp_reset_postdata();
        return $out;
    }

    public function loadMorePractice() {
        $compile = '';
        $compile .= '<div class="text-center gt3_module_button button_alignment_center"><a href="' . esc_js("javascript:void(0)") . '" class="gt3_practice_load_more shortcode_button button_size_normal">' . esc_html__("Load More", 'gt3_oconnor_core') . '</a></div>';
        return $compile;
    }
}

add_action('wp_ajax_gt3_get_practice_item_from_ajax', 'gt3_get_practice_item_from_ajax');
add_action('wp_ajax_nopriv_gt3_get_practice_item_from_ajax', 'gt3_get_practice_item_from_ajax');
function gt3_get_practice_item_from_ajax() {
    $build_query         = $_POST['build_query'];
    $practice_style      = esc_attr($_POST['practice_style']);
    $practice_layout     = esc_attr($_POST['practice_layout']);
    $columns_with_spaces = esc_attr($_POST['columns_with_spaces']);
    $rounded_images      = esc_attr($_POST['rounded_images']);
    $posts_per_line      = esc_attr($_POST['posts_per_line']);
    $image_proportional  = esc_attr($_POST['image_proportional']);
    $items_load          = esc_attr($_POST['items_load']);
    $post_count          = esc_attr($_POST['post_count']);

    list($query_args) = vc_build_loop_query($build_query);

    $query_args['post_type']      = 'practice';
    $query_args['post_status']    = 'publish';
    $query_args['offset']         = $post_count;
    $query_args['posts_per_page'] = $items_load;

    $query_results = new WP_Query($query_args);
    $out           = '';
    $parameters    = array(
        'practice_style'      => $practice_style,
        'practice_layout'     => $practice_layout,
        'columns_with_spaces' => $columns_with_spaces,
        'rounded_images'      => $rounded_images,
        'posts_per_line'      => $posts_per_line,
        'image_proportional'  => $image_proportional,
    );
    $item_class    = gt3Practice::grid_class($parameters);
    $items_left    = $query_results->found_posts - ($post_count + $items_load);

    if (!empty($post_count)) {
        $count_id = $post_count - ((int)($post_count / 8)) * 8;
        $count_id++;
    }

    if ($query_results->have_posts()):
        /*$count_id = 1; */
        while ($query_results->have_posts()) : $query_results->the_post();
            $out .= gt3_get_practice_item($parameters, $item_class, $count_id);
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

function gt3_get_practice_item($parameters, $item_class, $count_id) {
    // set post options
    $p_id = get_the_ID();

    $out           = '';
    $post_cats     = wp_get_post_terms($p_id, 'practice-category');
    $post_cats_out = '';
    $post_cats_str = '';
    for ($i = 0; $i < count($post_cats); $i++) {
        $post_cat_term = $post_cats[$i];
        $post_cat_name = $post_cat_term->slug;
        if (!empty($post_cats_out)) {
            $post_cats_out .= '<span class="gt3_practice_list__categories_delimiter">, </span>';
        }
        $post_cats_out .= '<a href="' . esc_url(get_term_link($post_cat_term->term_id, 'practice-category')) . '">' . $post_cat_term->name . '</a>';
        $post_cats_str .= ' ' . $post_cat_name;
    }
    $item_class .= $post_cats_str;

    if (!empty($parameters['practice_style'])) {
        $item_class .= $parameters['practice_style'] == 'content_on_image' ? ' content_on_image' : '';
    }
    if (!empty($parameters['image_proportional'])) {
        $item_class .= ' gt3_practice_list__item--image_' . $parameters['image_proportional'];
    }
    if (!empty($count_id)) {
        $item_class .= ' gt3_practice_list__item--' . $count_id;
    }

    if (!empty($parameters['practice_styling_out'])) {
        //title style
        $practice_styling_out             = $parameters['practice_styling_out'];
        $custom_practice_title_style      = '';
        $custom_practice_categories_style = '';
        $custom_practice_title_style      .= !empty($practice_styling_out['custom_title_color']) ? 'color:' . $practice_styling_out['custom_title_color'] . ';' : '';
        $custom_practice_title_style      .= !empty($practice_styling_out['title_font_size']) ? 'font-size:' . $practice_styling_out['title_font_size'] . 'px;' : '';
        $custom_practice_title_style      .= !empty($practice_styling_out['styles_google_fonts_title']) ? $practice_styling_out['styles_google_fonts_title'] : '';
        // category style
        $custom_practice_categories_style .= !empty($practice_styling_out['custom_category_color']) ? 'color:' . $practice_styling_out['custom_category_color'] . ';' : '';
        $custom_practice_categories_style .= !empty($practice_styling_out['category_font_size']) ? 'font-size:' . $practice_styling_out['category_font_size'] . 'px;' : '';
        $custom_practice_categories_style .= !empty($practice_styling_out['styles_google_fonts_categories']) ? $practice_styling_out['styles_google_fonts_categories'] : '';

    } else {
        $custom_practice_title_style = '';
    }
    $custom_practice_title_style      = !empty($custom_practice_title_style) ? ' style="' . $custom_practice_title_style . '"' : '';
    $custom_practice_categories_style = !empty($custom_practice_categories_style) ? ' style="' . $custom_practice_categories_style . '"' : '';

    // Letter Count
    $content_letter_count = !empty($parameters['content_letter_count']) ? (int)$parameters['content_letter_count'] : '';

    $practice_excerpt              = has_excerpt() ? get_the_excerpt() : get_the_content();
    $practice_excerpt              = preg_replace('~\[[^\]]+\]~', '', $practice_excerpt);
    $practice_excerpt_without_tags = strip_tags($practice_excerpt);

    if ($content_letter_count != '') {
        $practice_descr = gt3_smarty_modifier_truncate($practice_excerpt_without_tags, $content_letter_count, "...");
    } else {
        $practice_descr = $practice_excerpt_without_tags;
    }
    if ($content_letter_count == '0') {
        $practice_descr = '';
    }

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

    if (!empty($parameters['practice_layout']) && $parameters['practice_layout'] == 'multisize') {
        $image_extra_size = gt3_get_practice_item_image_size($count_id);
        $item_class       .= ' gt3_practice_list__item--' . $image_extra_size;
    } else {
        $image_extra_size = 'normal';
    }

    $image_out = gt3Practice::getImgUrl($parameters, $wp_get_attachment_url, $image_extra_size, $ratio);


    /** likes */
    if (gt3_option('practice_likes')) {
        $all_likes = gt3pb_get_option("likes");
        wp_enqueue_script('jquery.cookie');
        if (isset($all_likes[$p_id]) && $all_likes[$p_id] == 1) {
            $likes_text_label = esc_html__('Like', 'gt3_oconnor_core');
        } else {
            $likes_text_label = esc_html__('Likes', 'gt3_oconnor_core');
        }
        ob_start();
        ?>
    <div class="gt3_list__post_likes likes_block post_likes_add<?php echo isset($_COOKIE['like_post' . $p_id]) ? ' already_liked' : ''; ?>"
         data-postid="<?php echo esc_attr($p_id); ?>" data-modify="like_post"
         title="<?php echo (isset($all_likes[$p_id]) ? $all_likes[$p_id] : 0) . ' ' . $likes_text_label; ?>">
            <span class="gt3_post_likes__icon fa fa-heart-o"></span>
        </div><?php
        $post_likes = ob_get_clean();
    } else {
        $post_likes = '';
    }


    $out .= '<article class="gt3_practice_list__item ' . esc_attr($item_class) . '">';
    $out .= '<div class="gt3_practice_list__image-holder">';
    $out .= '<a href="' . get_permalink() . '" class="gt3_practice_list__image_link">';
    if (!empty($image_out)) {
        $out .= $image_out;
    } else {
        $out .= '<div class="gt3_practice_list__image_placeholder"></div>';
    }
    $out .= '</a>';
    if (!empty($parameters['practice_style']) && $parameters['practice_style'] == 'content_on_image') {
        $out .= '<div class="gt3_practice_list__content">';
        $out .= '<a href="' . get_permalink() . '" class="gt3_practice_list__title_link">';
        $out .= '<h4 class="gt3_practice_list__title" ' . (!empty($custom_practice_title_style) ? $custom_practice_title_style : '') . ' >' . get_the_title() . '</h4>';
        $out .= '</a>';
        $out .= !empty($post_cats_out) ? '<div class="gt3_practice_list__categories" ' . (!empty($custom_practice_categories_style) ? $custom_practice_categories_style : '') . ' >' . $post_cats_out . '</div>' : '';
        $out .= (strlen($practice_descr) ? '<p class="gt3_practice_list__description">' . $practice_descr . '</p>' : '') . '';

        if (!empty($parameters['show_read_more']) && $parameters['show_read_more'] == 'yes') {
            $out .= '<a href="' . esc_url(get_permalink()) . '" class="practice_post_button">' . esc_html__('ПОДРОБНЕЕ', 'gt3_oconnor_core') . '<i class="theme_icon-arrows-right"></i></a>';
        }
        $out .= '</div>';
    }
    $out .= $post_likes;
    $out .= '</div>';
    if (empty($parameters['practice_style']) || (!empty($parameters['practice_style']) && $parameters['practice_style'] != 'content_on_image')) {
        $out .= '<div class="gt3_practice_list__content">';
        $out .= '<a href="' . get_permalink() . '" class="gt3_practice_list__title_link">';
        $out .= '<h4 class="gt3_practice_list__title">' . get_the_title() . '</h4>';
        $out .= '</a>';
        $out .= (strlen($practice_descr) ? '<p class="gt3_practice_list__description">' . $practice_descr . '</p>' : '') . '';
        if (!empty($parameters['show_read_more']) && $parameters['show_read_more'] == 'yes') {
            $out .= '<a href="' . esc_url(get_permalink()) . '" class="practice_post_button">' . esc_html__('ДОКЛАДНІШЕ', 'gt3_oconnor_core') . '<i class="theme_icon-arrows-right"></i></a>';
        }
//        $out .= !empty($post_cats_out) ? '<div class="gt3_practice_list__categories">' . $post_cats_out . '</div>' : '';
        $out .= '</div>';
    }
    $out .= '</article>';
    return $out;
}

function gt3_get_practice_item_image_size($count_id) {
    switch ($count_id) {
        case 1:
            return 'large_width_height';
            break;
        case 2:
            return 'normal';
            break;
        case 3:
            return 'large_height';
            break;
        case 4:
            return 'normal';
            break;
        case 5:
            return 'large_height';
            break;
        case 6:
            return 'normal';
            break;
        case 7:
            return 'large_width_height';
            break;
        case 8:
            return 'normal';
            break;
        default:
            return 'normal';
            break;
    }

}