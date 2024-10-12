<?php
$layout = gt3_option('page_sidebar_layout');
$sidebar = gt3_option('page_sidebar_def');
$id = gt3_get_queried_object_id();
if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
    $mb_layout = rwmb_meta('mb_page_sidebar_layout', array(), $id);
    if (!empty($mb_layout) && $mb_layout != 'default') {
        $layout = $mb_layout;
        $sidebar = rwmb_meta('mb_page_sidebar_def', array(), $id);
    }
}
$column = 12;
if ( $layout == 'left' || $layout == 'right' ) {
    $column = 9;
}else{
    $sidebar = '';
}
$row_class = ' sidebar_'.$layout;


$taxonomy = get_query_var( 'taxonomy' );
$term_slug = get_query_var( $taxonomy );
$cat =  get_term_by( 'slug', $term_slug, $taxonomy );
$cat = (string) $cat->term_id;

$gt3Practice = new gt3Practice();

get_header ();
?>

<div class="container">
    <div class="row<?php echo esc_attr($row_class); ?>">
        <div class="content-container gt3_span<?php echo (int)$column; ?>">
            <section id='main_content'>
                <?php
                    echo ''.$gt3Practice->render(array("build_query"=>"size:all|order_by:date|order:ASC|tax_query:".$cat, "posts_per_line"=> "3", "use_filter"=> "") );
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
