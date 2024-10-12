<?php
/**
 * The template for displaying archive pages
 *
 */

get_header();
if ( !post_password_required() ) {

	$layout = gt3_option('page_sidebar_layout');
	$sidebar = gt3_option('page_sidebar_def');
	$column = 12;

	if ( $layout == 'left' || $layout == 'right' ) {
		$column = 9;
	}else{
		$sidebar = '';
	}
	$row_class = ' sidebar_'.$layout;

	$gt3Team = new gt3Team();

	global $wp_query;
    $query_args = array(
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'orderby' => 'date',
	);

	if (!empty($wp_query->tax_query)) {
		$tax_query_array = (array)$wp_query->tax_query;
		$query_args['tax_query'] = $tax_query_array['queries'];
	}

	$atts = array(
		'query_args' => $query_args,
        "posts_per_line" => 3,
        'show_pagination' => 'yes',
        'pagination_style' => 'pagination',
        'items_load' => 4,
	);
?>

	<div class="container">
		<div class="row<?php echo esc_attr($row_class); ?>">
			<div class="content-container gt3_span<?php echo (int)esc_attr($column); ?>">
				<section id='main_content'>
					<?php echo $gt3Team->render($atts,null); ?>
				</section>
			</div>
			<?php
			if ($layout == 'left' || $layout == 'right') {
				?><div class="sidebar-container gt3_span<?php echo (12 - (int)esc_attr($column)); ?>"><?php
				if (is_active_sidebar( $sidebar )) {
					?><aside class='sidebar'><?php
					dynamic_sidebar( $sidebar );
					?></aside><?php
				}
				?></div><?php // end sidebar-container
			}
			?>
		</div>
	</div>

<?php
} else {
	?>
	<div class="wrapper_404 height_100percent pp_block">
		<div class="container_vertical_wrapper">
			<div class="container a-center pp_container">
				<h1><?php echo esc_html__('Password Protected', 'gt3_oconnor_core'); ?></h1>
				<h2><?php echo esc_html__('This content is password protected. Please enter your password below to continue.', 'gt3_oconnor_core'); ?></h2>
				<?php the_content();?>
			</div>
		</div>
	</div>
<?php
}
get_footer();
