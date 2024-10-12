<?php
$layout  = gt3_option('practice_single_sidebar_layout');
$sidebar = gt3_option('practice_single_sidebar_def');
$id = gt3_get_queried_object_id();
if (class_exists('RWMB_Loader') && $id !== 0) {
    $mb_layout = rwmb_meta('mb_page_sidebar_layout');
    if (!empty($mb_layout) && $mb_layout != 'default') {
        $layout  = $mb_layout;
        $sidebar = rwmb_meta('mb_page_sidebar_def', array(), $id);
    }
}
$column = 12;
if ($layout == 'left' || $layout == 'right') {
    $column = 9;
} else {
    $sidebar = '';
}
$row_class = ' sidebar_' . $layout;

$page_title_conditional = ((gt3_option('page_title_conditional') == '1' || gt3_option('page_title_conditional') == true)) ? 'yes' : 'no';
if (class_exists('RWMB_Loader') && $id !== 0) {
    $mb_page_title_conditional = rwmb_meta('mb_page_title_conditional', array(), $id);
    if ($mb_page_title_conditional == 'yes') {
        $page_title_conditional = 'yes';
    } elseif ($mb_page_title_conditional == 'no') {
        $page_title_conditional = 'no';
    }
}

$practice_title = gt3_option('single_practice_title');
$title          = $page_title_conditional !== 'yes' && $practice_title !== '' ? $practice_title : get_the_title();

get_header();
?>

    <div class="container">
        <div class="row<?php echo esc_attr($row_class); ?>">
            <div class="content-container gt3_span<?php echo (int)$column; ?>">
                <section id='main_content'>
                    <?php
                    while (have_posts()):
                        the_post();
                        if (get_post_thumbnail_id(get_the_id())) {
                            $post_img_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
                            $post_img_url = aq_resize($post_img_url, "1170", "", true, true, true);
                            echo '<img src="' . esc_attr($post_img_url) . '" class="gt3-single-practice_thumbnail" alt="">';
                        }

                        if ($page_title_conditional !== 'yes' || $practice_title !== '') {
                            echo '<h2>' . esc_html($title) . '</h2>';
                        }

                    endwhile;
                    the_content(esc_html__('Read more!', 'gt3_oconnor_core'));
                    wp_reset_postdata();


                    if (gt3_option('practice_comments') == "1") { ?>
                        <div class="row">
                            <div class="gt3_span12">
                                <?php comments_template(); ?>
                            </div>
                        </div>
                    <?php } ?>
                </section>

            </div>
            <?php
            if ($layout == 'left' || $layout == 'right') {
                echo '<div class="sidebar-container gt3_span' . (12 - (int)$column) . '">';
                if (is_active_sidebar($sidebar)) {
                    echo "<aside class='sidebar'>";
                    dynamic_sidebar($sidebar);
                    echo "</aside>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>

<?php
get_footer();
