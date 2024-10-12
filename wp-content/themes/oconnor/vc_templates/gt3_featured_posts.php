<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $build_query
 * @var $item_el_class
 * @var $css
 * @var $css_animation
 * @var $module_title
 * @var $external_link_text
 * @var $external_link
 * @var $meta_author
 * @var $meta_date
 * @var $meta_comments
 * @var $meta_categories
 * @var $items_per_line
 * @var $items_per_line_type2
 * @var $view_type
 * @var $image_proportions
 * @var $content_alignment
 * @var $use_theme_blog_style
 * @var $content_letter_count
 * @var $spacing_beetween_items
 * @var $block_border_radius
 * @var $media_overlay
 * @var $media_overlay_color
 * @var $autoplay_carousel
 * @var $auto_play_time
 * @var $infinite_scroll
 * @var $items_per_column
 * @var $adaptive_height
 * @var $boxed_text_content
 * @var $use_carousel
 * @var $pf_post_icon
 * @var $post_read_more_link
 * @var $pagination
 * @var $sticky_post_first
 * @var $show_on_full_width
 * @var $scroll_items
 * @var $use_pagination_carousel
 * @var $use_prev_next_carousel
 * @var $custom_theme_color
 * @var $custom_headings_color
 * @var $custom_content_color
 * @var $heading_font_size
 * @var $content_font_size
 * @var $post_meta_uppercase
 * @var $first_post_image
 *
 * Shortcode class
 * @var $$this WPBakeryShortCode_Gt3_Featured_Posts
 */

include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';

$header_font = gt3_option('header-font');
$main_font   = gt3_option('main-font');

$defaults = array(
    'build_query'             => '',
    'item_el_class'           => '',
    'css'                     => '',
    'css_animation'           => '',
    'module_title'            => '',
    'external_link_text'      => '',
    'external_link'           => '',
    'meta_author'             => '',
    'meta_date'               => 'yes',
    'meta_comments'           => '',
    'meta_categories'         => '',
    'items_per_line'          => '1',
    'items_per_line_type2'    => '1',
    'view_type'               => 'type5',
    'image_proportions'       => 'square',
    'content_alignment'       => 'left',
    'use_theme_blog_style'    => 'yes',
    'content_letter_count'    => '160',
    'spacing_beetween_items'  => '30',
    'block_border_radius'     => '0',
    'media_overlay'           => false,
    'media_overlay_color'     => 'rgba(0,0,0,0.3)',
    'autoplay_carousel'       => 'yes',
    'auto_play_time'          => '3000',
    'infinite_scroll'         => 'yes',
    'items_per_column'        => '1',
    'adaptive_height'         => 'yes',
    'boxed_text_content'      => '',
    'use_carousel'            => '',
    'pf_post_icon'            => '',
    'post_read_more_link'     => 'yes',
    'pagination'              => 'no',
    'sticky_post_first'       => 'no',
    'show_on_full_width'      => 'no',
    'scroll_items'            => 'yes',
    'use_pagination_carousel' => 'yes',
    'use_prev_next_carousel'  => '',
    'custom_theme_color'      => esc_attr(gt3_option("theme-custom-color")),
    'custom_headings_color'   => esc_attr($header_font['color']),
    'custom_content_color'    => esc_attr($main_font['color']),
    'heading_font_size'       => '',
    'content_font_size'       => '',
    'post_meta_uppercase'     => 'no',
    'first_post_image'        => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
$parameters = $atts;
extract($atts);

$class_to_filter = vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($item_el_class);
$css_class       = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

// Render Google Fonts
$obj    = new GoogleFontsRender();
$shortc = $this->shortcode;
extract($obj->getAttributes($atts, $this, $shortc, array('google_fonts_blog', 'google_fonts_blog_headings')));

$blog_value_font = !empty($styles_google_fonts_blog) ? esc_attr($styles_google_fonts_blog) : '';

$blog_value_font_headings = !empty($styles_google_fonts_blog_headings) ? esc_attr($styles_google_fonts_blog_headings) : '';

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';

if ($view_type == 'type2') {
    $items_per_line = $items_per_line_type2;
}

$carousel_parent = $boxed_view = '';

if (($view_type == 'type4' || $view_type == 'type3') && $boxed_text_content == 'yes') {
    $boxed_view = 'boxed_view';
}

if ($use_carousel == 'yes') {
    $carousel_parent = 'gt3_module_carousel';

    $auto_play_time = (int)$auto_play_time;

    wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
    switch ($items_per_line) {
        case '1':
            $responsive_1024 = 1;
            $responsive_760  = 1;

            $responsive_sltscrl_1024 = 1;
            $responsive_sltscrl_760  = 1;
            break;
        case '2':
            $responsive_1024 = 2;
            $responsive_760  = 1;
            break;
        case '3':
            $responsive_1024 = 3;
            $responsive_760  = 1;
            break;
        case '4':
            $responsive_1024 = 4;
            $responsive_760  = 1;
            break;

        default:
            $responsive_1024 = 1;
            $responsive_760  = 1;
            break;
    }

    $responsive_sltscrl_1024 = $responsive_1024;
    $responsive_sltscrl_760  = $responsive_760;
    if ($scroll_items == 'yes') {
        $responsive_sltscrl_1024 = $responsive_sltscrl_760 = '1';
    }
    $slick_settings = '';
    $slick_settings .= isset($items_per_line) ? '"slidesToShow": ' . esc_attr($items_per_line) . ',' : '"slidesToShow": 1,';
    $slick_settings .= $scroll_items == 'yes' ? '"slidesToScroll": 1,' : '"slidesToScroll": ' . esc_attr($items_per_line) . ',';
    $slick_settings .= $autoplay_carousel == 'yes' ? '"autoplay": true,' : '"autoplay": false,';
    $slick_settings .= isset($auto_play_time) ? '"autoplaySpeed": ' . esc_attr($auto_play_time) . ',' : '"autoplaySpeed": 3000,';


    $slick_settings .= $infinite_scroll == 'yes' ? '"infinite": true,' : '"infinite": false,';
    $slick_settings .= $use_prev_next_carousel == 'yes' ? '"arrows": false,' : '"arrows": true,';
    $slick_settings .= $use_pagination_carousel == 'yes' ? '"dots": false,' : '"dots": true,';
    $slick_settings .= $adaptive_height == 'yes' ? '"adaptiveHeight": true,' : '"adaptiveHeight": false,';

    $slick_settings .= '"responsive": [{"breakpoint": 1024,"settings": {"slidesToShow": ' . esc_attr($responsive_1024) . ',"slidesToScroll": ' . esc_attr($responsive_sltscrl_1024) . '}},{"breakpoint": 760, "settings": {"slidesToShow": ' . esc_attr($responsive_760) . ', "slidesToScroll": ' . esc_attr($responsive_sltscrl_760) . '}} ]';
}

// Masonry
$blog_masonry = $blog_masonry_item = '';
if ($items_per_line !== '1' && $view_type === 'type4' && $use_carousel !== 'yes') {
    wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
    $blog_masonry      = ' isotope_blog_items';
    $blog_masonry_item = ' element';
}

// Blog styles
$blog_style          = $blog_value_font;
$blog_title_headings = $blog_value_font_headings;

// Button font-size
if ($heading_font_size != '') {
    $heading_font_size       = (int)$heading_font_size;
    $heading_font_line       = $heading_font_size + 4;
    $heading_font_size_style = 'font-size: ' . $heading_font_size . 'px; line-height: ' . $heading_font_line . 'px; ';
} else {
    $heading_font_size_style = '';
}

$blog_style_headings = $blog_value_font_headings . $heading_font_size_style;

// Content font-size
if ($content_font_size != '') {
    $content_font_size       = (int)$content_font_size;
    $content_font_line       = $content_font_size + 14;
    $content_font_size_style = 'font-size: ' . $content_font_size . 'px; line-height: ' . $content_font_line . 'px; ';
} else {
    $content_font_size_style = '';
}

$rand_class = mt_rand(0, 9999);

// Post Meta Uppercase
$uppercase_class = $post_meta_uppercase == 'yes' ? 'upper_text' : '';
?>

    <div class="vc_row">
        <div class="vc_col-sm-12 gt3_module_featured_posts blog_alignment_<?php echo esc_attr($content_alignment) . ' ' . esc_attr($animation_class) . ' ' . esc_attr($css_class) . ' blog_' . esc_attr($view_type) . ' items' . esc_attr($items_per_line) . ' ' . esc_attr($carousel_parent) . ' class_' . esc_attr($rand_class); ?>" <?php echo(strlen($blog_style) ? 'style="' . esc_attr($blog_style) . '"' : ''); ?>>
            <?php
            $external_btn = '';
            // External Link Settings
            $ext_link_temp  = vc_build_link($external_link);
            $ext_url        = $ext_link_temp['url'];
            $ext_link_title = $ext_link_temp['title'];
            $ext_target     = $ext_link_temp['target'];
            if (!empty($ext_url)) {
                $ext_url = home_url('?post_type=post');
            }
            $title_for_ext = !empty($ext_link_title) ? 'title="' . $ext_link_title . '"' : '';
            $target_ext    = !empty($ext_target) ? 'target="' . $ext_target . '"' : '';

            if ($external_link_text !== '') {
                $external_btn = '<div class="external_link"><a href="' . esc_attr($ext_url) . '" ' . $title_for_ext . ' ' . $target_ext . ' class="learn_more">' . $external_link_text . '<span></span></a></div>';
            }

            $moduletitle = $module_title_block = $carousel_arrows = '';
            if (strlen($module_title) > 0) {
                $moduletitle = '<h2 ' . (strlen($blog_title_headings) ? 'style="' . esc_attr($blog_title_headings) . '"' : '') . '>' . esc_attr($module_title) . '</h2>';
            }
            if ($use_carousel == 'yes' && $use_prev_next_carousel !== 'yes') {
                $carousel_arrows = '<div class="carousel_arrows"><a href="#" class="left_slick_arrow"><span></span></a><a href="#" class="right_slick_arrow"><span></span></a></div>';
            }

            $module_title_block = $moduletitle . $external_btn . $carousel_arrows;

            echo(strlen($module_title_block) ? '<div class="gt3_module_title">' . $module_title_block . '</div>' : '');

            list($query_args, $build_query) = vc_build_loop_query($build_query);

            global $paged;
            if (empty($paged)) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }

            $query_args['paged'] = $paged;

            global $gt3_wp_query_in_shortcodes;
            if ($sticky_post_first != 'yes') $query_args['ignore_sticky_posts'] = 1;
            $gt3_wp_query_in_shortcodes = new WP_Query($query_args);

            // Default Image Size
            switch ($items_per_line) {
                case '1':
                    $width  = '1170';
                    $height = '725';
                    break;
                case '2':
                    $width  = '800';
                    $height = '495';
                    break;
                case '3':
                    $width  = '600';
                    $height = '370';
                    break;
                case '4':
                    $width  = '400';
                    $height = '250';
                    break;
            }

            if ($view_type == 'type2') {
                $width  = '150';
                $height = '150';
            } else {
                if ($image_proportions == '4_3') {
                    $height = $width * 3 / 4;
                } else if ($image_proportions == 'horizontal') {
                    $height = $width / 1.85;
                } else if ($image_proportions == 'vertical') {
                    $height = $width * 4 / 3;
                } else if ($image_proportions == 'square') {
                    $height = $width;
                } else if ($image_proportions == 'original') {
                    $width  = '1920';
                    $height = '';
                };
            }

            if ($show_on_full_width === 'yes'){
                $width  = '1920';
                $height = '';
            }

            if ($gt3_wp_query_in_shortcodes->have_posts()) {
                if ($view_type !== 'type1' && $items_per_line !== '1') { ?>
                    <div class="spacing_beetween_items_<?php echo esc_attr($spacing_beetween_items), esc_attr($blog_masonry); ?>">
                <?php }
            if ($use_carousel == 'yes') { ?>
                <div class="gt3_carousel_list" data-slick="{<?php echo esc_attr($slick_settings); ?>}">
            <?php }
                $j              = 1;
                $n              = 1;
                $all_post_count = $gt3_wp_query_in_shortcodes->post_count;

                while ($gt3_wp_query_in_shortcodes->have_posts()) {
                    $gt3_wp_query_in_shortcodes->the_post();

                    $comments_num  = get_comments_number(get_the_ID());
                    $comments_text = $comments_num == 1 ? esc_html__('comment', 'oconnor') : esc_html__('comments', 'oconnor');

                    $post_date = $post_author = $post_category_compile = $post_comments = $has_post_thumb = '';

                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');

                    // Letter Count
                    $content_letter_count = (int)$content_letter_count;

                    $post_excerpt              = has_excerpt() ? get_the_excerpt() : get_the_content();
                    $post_excerpt              = preg_replace('~\[[^\]]+\]~', '', $post_excerpt);
                    $post_excerpt_without_tags = strip_tags($post_excerpt);

                    if ($content_letter_count != '') {
                        $post_descr = gt3_smarty_modifier_truncate($post_excerpt_without_tags, $content_letter_count, "...");
                    } else {
                        $post_descr = $post_excerpt_without_tags;
                    }
                    if ($content_letter_count == '0' || (strlen($featured_image[0]) > 0 && $view_type == 'type3')) {
                        $post_descr = '';
                    }

                    // Categories
                    if ($meta_categories == 'yes') {
                        if (get_the_category()) $categories = get_the_category();
                        if (!empty($categories)) {
                            $post_categ            = '';
                            $post_category_compile = '<span class="post_category">';
                            foreach ($categories as $category) {
                                $post_categ = $post_categ . '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . ', ';
                            }
                            $post_category_compile .= ' ' . trim($post_categ, ', ') . '</span>';
                        } else {
                            $post_category_compile = '';
                        }
                    }

                    // Post Share
                    $show_share = gt3_option('blog_post_share');
                    $post_share = '';

                    if ($show_share == "1") {
                        /* post share block */
                        $post_share .= '<div class="post_share">
                        <a href="#"><span>' . esc_html__("Share", 'oconnor') . '</span></a>
                        <div class="share_wrap">
                            <ul>
                                <li><a target="_blank" href="' . esc_url('https://www.facebook.com/share.php?u=' . get_permalink()) . '"><span class="fa fa-facebook"></span></a></li>
                                <li><a target="_blank" href="' . esc_url('https://plus.google.com/share?url=' . urlencode(get_permalink())) . '" class="share_gplus"><span class="fa fa-google-plus"></span></a></li>' .

                            (strlen($featured_image[0]) > 0 ? '<li><a target="_blank" href="' . esc_url('https://pinterest.com/pin/create/button/?url=' . get_permalink() . '&media=' . $featured_image[0]) . '"><span class="fa fa-pinterest"></span></a></li>' : '') .

                            '<li><a target="_blank" href="' . esc_url('https://twitter.com/intent/tweet?text=' . get_the_title() . '&amp;url=' . get_permalink()) . '"><span class="fa fa-twitter"></span></a></li>
                            </ul>
                        </div>
                    </div> <!-- .post_share -->';
                        /* post share block */
                    }

                    $post = get_post();

                    if ($meta_date == 'yes') {
                        $post_date = '<span class="post_date">' . esc_html(get_the_time(get_option('date_format'))) . '</span>';
                    }

                    if ($meta_author == 'yes') {
                        $post_author = '<span class="post_author"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '"><span class="avatar">' . get_avatar(get_the_author_meta('ID'), '44') . '</span><span>' . esc_html__("by", 'oconnor') . ' ' . esc_html(get_the_author_meta('display_name')) . '</span></a></span>';
                    }

                    if ($meta_comments == 'yes') {
                        $post_comments = '<span class="post_comments"><a href="' . esc_url(get_comments_link()) . '">' . esc_html(get_comments_number(get_the_ID())) . ' ' . $comments_text . '</a></span>';
                    }

                    // Post meta
                    if ($view_type == 'type3') {
                        $post_meta = $post_date . $post_comments;
                    } else {
                        $post_meta = $post_category_compile . $post_date . $post_comments . $post_share;
                    }

                    $pf = get_post_format();
                    if (empty($pf)) $pf = "standard";

                    $pf_media = gt3_get_pf_type_output($pf, $width, $height, $featured_image);
                    $pf       = $pf_media['pf'];

                    $post_title      = get_the_title();
                    $post_link_title = '';

                    if (strlen($post_title) > 0) {
                        if ($pf == 'link' && $pf_post_icon === 'yes') {
                            $post_link_title = '<h2 class="blogpost_title"><i class="fa fa-link"></i><a href="' . esc_url(get_permalink()) . '">' . esc_html($post_title) . '</a></h2>';
                        } else if ($pf == 'quote' && $pf_post_icon === 'yes') {
                            $post_link_title = $pf_media['content'];
                        } else {
                            $pf_icon = '';
                            if (is_sticky()) {
                                $pf_icon = '<i class="fa fa-thumb-tack"></i>';
                            }
                            $post_link_title = '<h2 class="blogpost_title">' . $pf_icon . '<a href="' . esc_url(get_permalink()) . '">' . esc_html($post_title) . '</a></h2>';
                        }
                    }

                    if ($j == 1 && $items_per_column !== '1') {
                        echo '<div class="per_column_wrap">';
                    }

                    if (strlen($featured_image[0]) > 0) {
                        $has_post_thumb = ' has_post_thumb';
                    } else {
                        $has_post_thumb = ' without_post_thumb';
                    }

                    if (strlen($featured_image[0]) > 0 && ($view_type == 'type1' && $n == 1)) {
                        $has_post_thumb .= ' first_post_with_thumb';
                        $width          = '1170';
                        $height         = '630';
                    }

                    $gt3_background_image = '';
                    if (strlen($featured_image[0]) > 0 && $view_type === 'type5') {
                        $gt3_background_image = 'style="background-image:url(' . esc_url(aq_resize($featured_image[0], $width, $height, true, true, true)) . ');border-radius:' . esc_attr($block_border_radius) . '"';
                    }

                    echo '<div class="blog_post_preview format-', esc_attr($pf), esc_attr($has_post_thumb), esc_attr($blog_masonry_item), '">'; ?>
                    <div class="item_wrapper">
                        <div class="blog_content">
                            <?php
                            if ($view_type !== 'type1' && $view_type !== 'type5' && ($pf == 'video' || $pf == 'audio')) {
                                echo '', $pf_media['content'];
                            } else if (strlen($featured_image[0]) > 0 && ($view_type !== 'type1' || ($view_type == 'type1' && $n == 1 && $first_post_image == 'yes')) && $view_type !== 'type5') {
                                $post_media_class = $media_overlay == 'yes' ? 'blog_post_hover' : '';
                                $post_media_style = 'border-radius:' . esc_attr($block_border_radius) . ';';
                                $post_media_style .= !empty($media_overlay_color) ? 'background:' . esc_attr($media_overlay_color) . ';' : ''; ?>
                                <div class="blog_post_media">
                                    <div class="<?php echo esc_attr($post_media_class); ?>"
                                         style="<?php echo esc_attr($post_media_style); ?>"></div>
                                    <?php
                                    echo gt3_getImgUrl($atts, $featured_image[0], '', '', $post_title, get_permalink() );

                                    if ($view_type == 'type3') {
                                        echo wp_kses_post($post_category_compile);
                                    } ?>
                                </div>

                                <?php
                            } elseif ($view_type === 'type5') { ?>
                                <div class="blog_post_media" <?php echo '' . $gt3_background_image ?>>
                                    <?php if ($media_overlay == 'yes') { ?>
                                        <div class="blog_post_hover"
                                             style="border-radius:<?php echo esc_attr($block_border_radius) . (!empty($media_overlay_color) ? 'background:' . esc_attr($media_overlay_color) : ''); ?>"></div>
                                    <?php } ?>
                                </div>

                                <?php
                            } else if ($pf == 'gallery' && !strlen($featured_image[0]) > 0) {
                                echo '', $pf_media['content'];
                            }
                            ?>
                            <div class="featured_post_info <?php echo esc_attr($boxed_view); ?>"
                                 style="border-radius:<?php echo esc_attr($block_border_radius); ?>">

                                <?php echo '' . $post_author;

                                if ($items_per_line === 1) { ?>
                                    <div class="clear post_clear"></div>
                                    <div></div>

                                <?php }

                                echo wp_kses_post($post_link_title);

                                if (strlen($post_descr)) { ?>
                                    <p <?php echo(strlen($content_font_size_style) ? 'style="' . esc_attr($content_font_size_style) . '"' : '') ?>>
                                        <?php echo wp_kses_post($post_descr); ?>
                                    </p>
                                <?php }

                                if ($post_read_more_link == 'yes') { ?>
                                    <a href="<?php echo esc_url(get_permalink()); ?>"
                                       class="blog_post_button learn_more button_arrow right_arrow"><?php esc_html_e('Read More', 'oconnor'); ?>
                                        <span></span></a>
                                <?php }

                                if ($view_type === 'type5') { ?>
                                <div class="blogpost_fixed_title">
                                    <?php echo wp_kses_post($post_link_title); ?>
                                    <?php }

                                    if (strlen($post_meta)) { ?>
                                        <div class="listing_meta <?php echo esc_attr($uppercase_class); ?>"><?php echo wp_kses_post($post_meta); ?></div>
                                    <?php }

                                    if ($view_type === 'type5') { ?>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    echo '</div><!-- .blog_post_preview -->';

                    if (($j == $items_per_column || $n == $all_post_count) && $items_per_column !== '1') {
                        echo '</div>';
                    }

                    $j++;
                    if ($j > $items_per_column) {
                        $j = 1;
                    }
                    $n++;
                }

                // end while
                wp_reset_postdata();

            if ($use_carousel == 'yes') { ?>
                </div>
            <?php }

                if ($view_type !== 'type1' && $items_per_line !== '1') { ?>
                    </div>
                <?php } ?>
                <?php
                if ($pagination == 'yes') {
                    echo gt3_get_theme_pagination("3", "show_in_shortcodes");
                }
                ?>
            <?php } ?>

        </div> <!-- .gt3_module_featured_posts -->
    </div>

<?php
// Custom Colors
$custom_blog_css = '';

if ($use_theme_blog_style !== 'yes') {
    // Custom Theme Color
    $custom_blog_css .= '.gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .listing_meta, .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .listing_meta a, .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' h4 a:hover, .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .blogpost_title i {color: ' . esc_attr($custom_theme_color) . '; } .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .gt3_module_title .carousel_arrows a:hover span {background: ' . esc_attr($custom_theme_color) . '; } .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .gt3_module_title .carousel_arrows a:hover span:before {border-color: ' . esc_attr($custom_theme_color) . '; }';

    // Custom Headings Color
    $custom_blog_css .= '.gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' h2, .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' h4, .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' h4 span, .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' h4 a {color: ' . esc_attr($custom_headings_color) . '; } .blog_type1.class_' . esc_attr($rand_class) . ' .blog_post_preview:before, .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .gt3_module_title .carousel_arrows a span {background: ' . esc_attr($custom_headings_color) . '; }  .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .gt3_module_title .carousel_arrows a span:before {border-color: ' . esc_attr($custom_headings_color) . '; }';

    // Custom Content Color
    $custom_blog_css .= '.gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .blog_content p, .gt3_module_featured_posts.class_' . esc_attr($rand_class) . ' .listing_meta a:hover {color: ' . esc_attr($custom_content_color) . '; }';

}
gt3_blog_custom_styles_js($custom_blog_css);
