<?php
$layout = gt3_option('case_single_sidebar_layout');
$sidebar = gt3_option('case_single_sidebar_def');
if (class_exists( 'RWMB_Loader' )) {
    $mb_layout = rwmb_meta('mb_page_sidebar_layout');
    if (!empty($mb_layout) && $mb_layout != 'default') {
        $layout = $mb_layout;
        $sidebar = rwmb_meta('mb_page_sidebar_def');
    }
}
$column = 12;
if ( $layout == 'left' || $layout == 'right' ) {
    $column = 9;
}else{
    $sidebar = '';
}
$row_class = ' sidebar_'.$layout;

get_header ();
?>

<div class="container gt3_case_single">
    <div class="row<?php echo $row_class; ?>">
        <div class="content-container gt3_span<?php echo (int)$column; ?>">
            <section id='main_content'>
                <?php
                    while (have_posts()) the_post();
                    the_content(esc_html__('Read more!', 'gt3_oconnor_core'));
                    wp_reset_postdata();
                ?>
            </section>

        </div>
        <?php
        if ($layout == 'left' || $layout == 'right') {
            echo '<div class="sidebar-container gt3_span'.(12 - (int)$column).'">';
                if (is_active_sidebar( $sidebar )) {
                    echo "<aside class='sidebar'>";
                    dynamic_sidebar( $sidebar );
                    echo "</aside>";
                }
            echo "</div>";
        }
        ?>
    </div>

</div>

<?php
get_footer();
