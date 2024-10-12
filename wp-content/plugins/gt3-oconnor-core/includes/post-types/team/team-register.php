<?php

/**
 *
 */
class gt3TeamRegister {

    private $cpt;
    private $taxonomy;
    private $slug;

    function __construct() {
        $this->cpt      = 'team';
        $this->taxonomy = 'team-category';
        $this->slug     = $this->cpt;
        $slug_option    = function_exists('gt3_option') ? gt3_option('team_slug') : '';
        $this->slug     = empty($slug_option) ? 'team' : sanitize_title($slug_option);
    }

    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    private function registerPostType() {

        register_post_type('team',
            array(
                'labels'          => array(
                    'name'          => esc_html__('Team', 'gt3_oconnor_core'),
                    'singular_name' => esc_html__('Team Member', 'gt3_oconnor_core'),
                    'add_item'      => esc_html__('New Team Member', 'gt3_oconnor_core'),
                    'add_new_item'  => esc_html__('Add New Team Member', 'gt3_oconnor_core'),
                    'edit_item'     => esc_html__('Edit Team Member', 'gt3_oconnor_core')
                ),
                'public'          => true,
                'has_archive'     => true,
                'capability_type' => 'post',
                'rewrite'         => array('slug' => $this->slug),
                'menu_position'   => 5,
                'show_ui'         => true,
                'supports'        => array('title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'comments'),
                'menu_icon'       => 'dashicons-groups',
            )
        );

    }

    private function registerTax() {
        $labels = array(
            'name'              => esc_html__('Team Categories', 'gt3_oconnor_core'),
            'singular_name'     => esc_html__('Team Category', 'gt3_oconnor_core'),
            'search_items'      => esc_html__('Search Team Categories', 'gt3_oconnor_core'),
            'all_items'         => esc_html__('All Team Categories', 'gt3_oconnor_core'),
            'parent_item'       => esc_html__('Parent Team Category', 'gt3_oconnor_core'),
            'parent_item_colon' => esc_html__('Parent Team Category:', 'gt3_oconnor_core'),
            'edit_item'         => esc_html__('Edit Team Category', 'gt3_oconnor_core'),
            'update_item'       => esc_html__('Update Team Category', 'gt3_oconnor_core'),
            'add_new_item'      => esc_html__('Add New Team Category', 'gt3_oconnor_core'),
            'new_item_name'     => esc_html__('New Team Category Name', 'gt3_oconnor_core'),
            'menu_name'         => esc_html__('Team Categories', 'gt3_oconnor_core'),
        );

        register_taxonomy($this->taxonomy, array($this->cpt), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => $this->slug . esc_html__('-category', 'gt3_oconnor_core')),
        ));
    }

    public function registerSingleTemplate($single) {
        global $post;
        if ($post->post_type == $this->cpt) {
            if (!file_exists(get_template_directory() . '/single-' . $this->cpt . '.php')) {
                return plugin_dir_path(dirname(__FILE__)) . 'team/templates/single-' . $this->cpt . '.php';
            }
        }
        return $single;
    }

    public function registerArchiveTemplate($archive) {
        global $post;
        if ($post->post_type == $this->cpt && is_archive()) {
            if (!file_exists(get_template_directory() . '/archive-' . $this->cpt . '.php')) {
                return plugin_dir_path(dirname(__FILE__)) . 'team/templates/archive-' . $this->cpt . '.php';
            }
        }

        return $archive;
    }

}

function render_gt3_team_item($posts_per_line, $single_member = false, $grid_gap = '', $link_post = '') {
    $compile = "";
    $id = gt3_get_queried_object_id();
    $positions_str = get_post_meta(get_the_ID(), "position_member");
    $url_array     = get_post_meta(get_the_id(), "social_url", true);
    $icon_array    = get_post_meta(get_the_id(), "icon_selection", true);
    $short_desc    = get_post_meta(get_the_id(), "member_short_desc", true);
    $vcard_array   = get_post_meta(get_the_ID(), "member_vcard");
    $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    $post_cats             = wp_get_post_terms(get_the_id(), 'team-category');
    $style_gap             = isset($grid_gap) && !empty($grid_gap) ? ' style="padding-right:' . $grid_gap . ';padding-bottom:' . $grid_gap . '"' : '';

    $post_cats_str = '';
    for ($i = 0; $i < count($post_cats); $i++) {
        $post_cat_term = $post_cats[$i];
        $post_cat_name = $post_cat_term->slug;
        $post_cats_str .= ' ' . $post_cat_name;
    }

	$color_title = get_post_meta( get_the_ID(), "mb_social_title_color" );
	$color_title = is_array($color_title) && key_exists(0, $color_title) ? 'style="color:'.$color_title[0].';"' : '';
	$color_text = get_post_meta( get_the_ID(), "mb_social_text_color" );
	$color_text = is_array($color_text) && key_exists(0, $color_text) ? 'style="color:'.$color_text[0].';"' : '';

	$url_str = "";
    if (isset($url_array) && !empty($url_array)) {
        for ($i = 0; $i < count($url_array); $i++) {
            $url             = $url_array[$i];
            $url_name        = $url['name'];
            $url_address     = $url['address'];
            $url_description = !empty($url['description']) ? $url['description'] : '';

            if ($single_member && !empty($url_address) && !empty($url_description)) {
                $url_str .= '<div class="team_field">' . (!empty($url_name) ? '<h5 '.$color_title.'>' . $url_name . ': </h5>' : '') . '<a href="' . esc_url($url_address) . '" class="team-link" '.$color_text.'>' . $url_description . '</a></div>';
            } elseif ($single_member && !empty($url_address) && empty($url_description)) {
                $url_str .= '<div class="team_field">' . (!empty($url_name) ? '<h5 '.$color_title.'>' . $url_name . ': </h5>' : '') . '<a href="' . esc_url($url_address) . '" class="team-link"><i class="fa fa-link" '.$color_text.'></i></a></div>';
            } elseif ($single_member && empty($url_address) && !empty($url_description)) {
                $url_str .= '<div class="team_field">' . (!empty($url_name) ? '<h5 '.$color_title.'>' . $url_name . ': </h5>' : '') . '<div class="team_info-detail" '.$color_text.'>' . $url_description . '</div></div>';
            }
        }
    }

    $icon_str = "";
    if (isset($icon_array) && !empty($icon_array)) {
        $icon_str .= '<div class="team-icons">';
        for ($i = 0; $i < count($icon_array); $i++) {
            $icon         = $icon_array[$i];
            $icon_name    = !empty($icon['select']) ? $icon['select'] : '';
            $icon_address = !empty($icon['input']) ? $icon['input'] : '#';
            $icon_str     .= !empty($icon['select']) ? '<a href="' . $icon_address . '" class="member-icon ' . $icon_name . '"></a>' : '';
        }
        $icon_str .= '</div>';
    }


    if (strlen($wp_get_attachment_url)) {
        switch ($posts_per_line) {
            case "1":
                $gt3_featured_image_url = $wp_get_attachment_url;
                break;
            case "2":
                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "1140", "1120", true, true, true);
                break;
            case "3":
                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "740", "720", true, true, true);
                break;
            case "4":
                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "540", "520", true, true, true);
                break;
            default:
                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "1340", "1112", true, true, true);
        }
        $featured_image = '<img  src="' . $gt3_featured_image_url . '" alt="' . get_the_title() . '" />';
    } else {
        $featured_image = '';
    }


    $vcard_str = "";
    if (isset($vcard_array) && !empty($vcard_array)) {
        for ($i = 0; $i < count($vcard_array); $i++) {
            $vcard         = $vcard_array[$i];
            $vcard_name    = !empty($vcard['name']) ? $vcard['name'] : '';
            $vcard_address = !empty($vcard['address']) ? $vcard['address'] : '#';
            $vcard_str     .= !empty($vcard['name']) ? '<a href="' . $vcard_address . '" target="_blank" class="member-vcard">' . $vcard_name . '<i class="theme_icon-arrows-right"></i></a>' : '';
        }
    }

    if (!$single_member) {
        $compile .= '
            <li class="item-team-member' . $post_cats_str . '" ' . $style_gap . '>
                <div class="item_wrapper">
                    <div class="item">
                        <div class="team_img featured_img">' . ($link_post == 'true' ? '<a href="' . get_permalink(get_the_ID()) . '">' . $featured_image . '</a>' : $featured_image) . '
                        </div>
                        <div class="team_cover">' . ($link_post == 'true' ? '<a class="team_cover__link" href="' . get_permalink(get_the_ID()) . '"></a>' : '') . '</div>
                        <div class="team-infobox">
                            <div class="team_info">';
                                $compile .= !empty($short_desc) ? '<div class="member-short-desc">' . $short_desc . '</div>' : '';
                                $compile .= '                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team_title">
                    <h3 class="team_title__text">' . ($link_post == 'true' ? '<a href="' . get_permalink(get_the_ID()) . '">' . get_the_title() . '</a>' : get_the_title()) . '</h3>'
            . (!empty($positions_str[0]) ? '<div class="team-positions">' . $positions_str[0] . '</div>' : '') .
            (!empty($icon_str) ? '<div class="team_icons_wrapper"><div class="member-icons">' . $icon_str . '</div></div>' : '') . '
                </div>
            </li>
            ';
    } else {

        $page_title_conditional = ((gt3_option('page_title_conditional') == '1' || gt3_option('page_title_conditional') == true)) ? 'yes' : 'no';

        if (class_exists('RWMB_Loader') && $id !== 0) {
            $mb_page_title_conditional = rwmb_meta('mb_page_title_conditional', array(), $id);
            if ($mb_page_title_conditional == 'yes') {
                $page_title_conditional = 'yes';
            } elseif ($mb_page_title_conditional == 'no') {
                $page_title_conditional = 'no';
            }
        }

        $team_title = gt3_option('single_team_title');
        $title = $page_title_conditional !== 'yes' && $team_title !== '' ? $team_title : get_the_title();

        $compile .= '
            <div class="row single-member-page">
                <div class="gt3_span4">
                    <div class="team_img featured_img">
                        ' . $featured_image . '
                        ' . $vcard_str . '
                    </div>
                </div>
                <div class="gt3_span8">
                    <div class="team-infobox">
                        ' . ($page_title_conditional !== 'yes' || $team_title !== '' ? '<div class="team_title"><h3>' . esc_html($title) . '</h3></div>' : '') . '
                        
                        <div class="team_info">';
                            $compile .= !empty($url_str) ? $url_str : '';
                            $compile .= !empty($icon_str) ? '<div class="member-icons">' . $icon_str . '</div>' : '';
                            $compile .= !empty($short_desc) ? '<div class="member-short-desc">' . $short_desc . '</div>' : '';
                            $compile .= '
                        </div>
                    </div>
                </div>
            </div>
            ';
    }

    return $compile;
}

function render_gt3_team($atts, $build_query) {
    /**
     * $atts attributes
     * @var $posts_per_line
     * @var $grid_gap
     * @var $link_post
     */
    extract($atts);
    list($query_args) = vc_build_loop_query($build_query);
    $gt3_posts = new WP_Query($query_args);
    gt3_get_all_icon();
    $grid_gap = isset($grid_gap) && !empty($grid_gap) ? $grid_gap : '0';
    $compile  = '';
    if ($gt3_posts->have_posts()) {

        while ($gt3_posts->have_posts()):
            $gt3_posts->the_post();
            $compile .= render_gt3_team_item($posts_per_line, false, $grid_gap, $link_post);
        endwhile;
        wp_reset_postdata();
    }
    echo $compile;
}
