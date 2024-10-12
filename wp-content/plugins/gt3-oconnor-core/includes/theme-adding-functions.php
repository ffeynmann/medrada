<?php
// Adding functions for theme
// New tab for Single Product Data Tabs
function gt3_new_product_tab() {
    add_meta_box( 'gt3_new_product_tab', esc_html__( 'Product details', 'oconnor' ), 'gt3_new_product_tab_callback', 'product' );
}
add_action('add_meta_boxes', 'gt3_new_product_tab');

function gt3_new_product_tab_callback() {
    $post_id = get_the_ID();
    if (get_post_type($post_id) != 'product') return;
    $gt3_product_details = get_post_meta($post_id,'gt3_new_product_tab_meta_value_key',true);
    $gt3_product_subtitle = get_post_meta($post_id,'gt3_product_subtitle_meta_value_key',true);

    echo '<div class="rwmb-field rwmb-select-wrapper">';
    wp_nonce_field('gt3_new_product_tab_nonce_'.$post_id,'gt3_new_product_tab_nonce');
        echo '<div class="rwmb-label">
                  <label for="gt3_product_subtitle_field">'.esc_html__("Sub-Title for this product", 'oconnor' ).'</label>
              </div>
              <div class="rwmb-input">
                  <textarea id="gt3_product_subtitle_field" name="gt3_product_subtitle_field" style="width:100%;height:90px;" />'.$gt3_product_subtitle.'</textarea>
              </div>';
        echo '<div class="rwmb-label">
                  <label for="gt3_new_product_tab_field">'.esc_html__("Description for this product", 'oconnor' ).'</label>
              </div>
              <div class="rwmb-input">
                  <textarea id="gt3_new_product_tab_field" name="gt3_new_product_tab_field" style="width:100%;height:90px;" />'.$gt3_product_details.'</textarea>
              </div>';
    echo '</div>';
}

function gt3_new_product_tab_save_postdata( $post_id ) {
    if (!isset($_POST['gt3_new_product_tab_nonce']) || !wp_verify_nonce($_POST['gt3_new_product_tab_nonce'],'gt3_new_product_tab_nonce_'.$post_id)) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if ( 'page' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    } elseif( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
    if ( !isset($_POST['gt3_new_product_tab_field']) && !isset($_POST['gt3_product_subtitle_field']) )
        return;

    $_data = wp_kses_post( $_POST['gt3_new_product_tab_field'] );
    $_data_2 = wp_kses_post( $_POST['gt3_product_subtitle_field'] );
    update_post_meta( $post_id, 'gt3_new_product_tab_meta_value_key', $_data );
    update_post_meta( $post_id, 'gt3_product_subtitle_meta_value_key', $_data_2 );
}
add_action( 'save_post', 'gt3_new_product_tab_save_postdata' );

function gt3_new_product_tab_frontend( $tabs ) {
    $gt3_product_details = get_post_meta(get_the_ID(),'gt3_new_product_tab_meta_value_key',true);
    if ( !empty( $gt3_product_details ) ) {
        $tabs['details'] = array(
            'title'     => esc_html__( 'Details', 'oconnor' ),
            'priority'  => 20,
            'callback'  => 'woo_new_product_tab_content'
        );
    }
    return $tabs;
}
function woo_new_product_tab_content() {
    $gt3_product_details = get_post_meta(get_the_ID(),'gt3_new_product_tab_meta_value_key',true);
    echo '<h2>'.esc_html__( 'Details', 'oconnor' ).'</h2>';
    echo '<p>'.wp_kses_post($gt3_product_details).'</p>';
}
add_filter( 'woocommerce_product_tabs', 'gt3_new_product_tab_frontend' );

// Display Product Title
function gt3_product_subtitle_frontend() {
    $gt3_product_subtitle = get_post_meta(get_the_ID(),'gt3_product_subtitle_meta_value_key',true);
    if ( !empty( $gt3_product_subtitle ) ) {
        echo '<h4 class="gt3-product-subtitle">'.esc_attr($gt3_product_subtitle).'</h4>';
    }
}
add_action('woocommerce_single_product_summary','gt3_product_subtitle_frontend', 6);


function gt3_types_init() {
    if (class_exists('Vc_Manager')) {
        if (function_exists('gt3_shift_title_function')) {
            call_user_func('vc_add_shortcode_param', 'gt3_shift_title_position', 'gt3_shift_title_function', get_template_directory_uri() . '/core/vc/custom_types/js/gt3_shift_title.js');
        }
        if (function_exists('gt3_on_off_function')) {
            call_user_func('vc_add_short'.'code_param', 'gt3_on_off', 'gt3_on_off_function');
        }
        if (function_exists('gt3_packery_layout_select_function')) {
            call_user_func('vc_add' . '_shortcode_param', 'gt3_packery_layout_select', 'gt3_packery_layout_select_function', get_template_directory_uri() . '/core/vc/custom_types/js/gt3_packery_layout.js');
        }
        if (function_exists('gt3_custom_select_function')) {
            call_user_func('vc_add_short'.'code_param', 'gt3_custom_select', 'gt3_custom_select_function');
        }
        if (function_exists('gt3_image_select')) {
            call_user_func('vc_add' . '_shortcode_param', 'gt3_dropdown', 'gt3_image_select', get_template_directory_uri() . '/core/vc/custom_types/js/gt3_image_select.js');
        }
        if (function_exists('gt3_multi_select')) {
            call_user_func('vc_add' . '_shortcode_param', 'gt3-multi-select', 'gt3_multi_select', get_template_directory_uri() . '/core/vc/custom_types/js/gt3_multi_select.js');
        }
        if (function_exists('vc_add_shortcode_param') && function_exists('gt3_func_init_hotspot')) {
            add_action('admin_enqueue_scripts', 'gt3_hotspot_assets');
            vc_add_shortcode_param('gt3_init_hotspot', 'gt3_func_init_hotspot', get_template_directory_uri() . '/core/admin/js/gt3_param.js');
        }
    }
}

add_action('init', 'gt3_types_init');

if (!function_exists('gt3_get_top_offset_for_page_title')) {
    function gt3_get_top_offset_for_page_title($header_on_bg,$tablet_header_on_bg,$mobile_header_on_bg,$responsive_header_height){

        $custom_page_title_style = '';
        if(is_array($responsive_header_height) && !empty($responsive_header_height['desktop_height'])){
            if ((bool)$header_on_bg && $responsive_header_height['desktop_height']) {
                $custom_page_title_style .= ".gt3-page-title_wrapper .gt3-page-title{padding-top: ".(int)$responsive_header_height['desktop_height']."px;}";
            }
            if ((bool)$tablet_header_on_bg) {
                $custom_page_title_style .=  "@media only screen and (max-width: 1200px){.gt3-page-title_wrapper .gt3-page-title{padding-top: ".(int)$responsive_header_height['tablet_height']."px;}}";
            }else{
                $custom_page_title_style .=  "@media only screen and (max-width: 1200px){.gt3-page-title_wrapper .gt3-page-title{padding-top: 20px;padding-bottom: 20px;}}";
            }
            if ((bool)$mobile_header_on_bg && $responsive_header_height['mobile_height']) {
                $custom_page_title_style .=  "@media only screen and (max-width: 767px){.gt3-page-title_wrapper .gt3-page-title{padding-top: ".(int)$responsive_header_height['mobile_height']."px;}}";
            }else{
                $custom_page_title_style .=  "@media only screen and (max-width: 767px){.gt3-page-title_wrapper .gt3-page-title{padding-top: 20px;padding-bottom: 20px;}}";
            }
            echo ' <script type="text/javascript">
                var custom_page_title_style = "' .  $custom_page_title_style  . '";
                if (document.getElementById("custom_page_title_style")) {
                    document.getElementById("custom_page_title_style").innerHTML += custom_page_title_style;
                } else if (custom_page_title_style !== "") {
                    document.body.innerHTML += \'<style id="custom_page_title_style" type="text/css">\'+custom_page_title_style+\'</style>\';
                }</script>';
        }
    }
}


function gt3_sort_place() {
    $id = gt3_get_queried_object_id();
    $mb_logo_position      = rwmb_meta('mb_logo_position', array(), $id);
    $mb_menu_position      = rwmb_meta('mb_menu_position', array(), $id);
    $mb_left_bar_position  = rwmb_meta('mb_left_bar_position', array(), $id);
    $mb_right_bar_position = rwmb_meta('mb_right_bar_position', array(), $id);

    $mb_logo_order      = rwmb_meta('mb_logo_order', array(), $id);
    $mb_menu_order      = rwmb_meta('mb_menu_order', array(), $id);
    $mb_left_bar_order  = rwmb_meta('mb_left_bar_order', array(), $id);
    $mb_right_bar_order = rwmb_meta('mb_right_bar_order', array(), $id);
    $positions          = array(
        'logo'      => $mb_logo_position,
        'menu'      => $mb_menu_position,
        'left_bar'  => $mb_left_bar_position,
        'right_bar' => $mb_right_bar_position
    );
    $sorting_array      = array(
        'Left align side'   => '',
        'Center align side' => '',
        'Right align side'  => ''
    );
    foreach ($positions as $pos => $value) {
        switch ($value) {
            case 'left_align_side':
                $sorting_array['Left align side'][$pos] = ${'mb_' . $pos . '_order'};
                break;
            case 'center_align_side':
                $sorting_array['Center align side'][$pos] = $pos;
                break;
            case 'right_align_side':
                $sorting_array['Right align side'][$pos] = $pos;
                break;
        }
    }
    foreach ($sorting_array as $key => $value) {
        if (is_array($sorting_array[$key])) {
            asort($value);
            $sorting_array[$key] = $value;
        }
        $sorting_array[$key]['placebo'] = 'placebo';
    }
    return $sorting_array;
}



// out search shortcode
if (!function_exists('gt3_search_shortcode')) {
    function gt3_search_shortcode() {
        if (function_exists('gt3_option')) {
            $header_height = gt3_option('header_height');
        }
        $header_height = $header_height['height'];
	    $id = gt3_get_queried_object_id();
        if (class_exists('RWMB_Loader') && $id !== 0) {
            if (rwmb_meta('mb_customize_header_layout', array(), $id) == 'custom') {
                $header_height = rwmb_meta("mb_header_height", array(), $id);
            }
        }

        $search_style = '';
        $search_style .= !empty($header_height) ? 'height:' . $header_height . 'px;' : '';
        $search_style = !empty($search_style) ? ' style="' . $search_style . '"' : '';


        $out = '<div class="header_search"' . $search_style . '>';
        $out .= '<div class="header_search__container">';
        $out .= '<div class="header_search__icon">';
        $out .= '<i></i>';
        $out .= '</div>';
        $out .= '<div class="header_search__inner">';
        $out .= get_search_form(false);
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
        return $out;
    }
    add_shortcode('gt3_search', 'gt3_search_shortcode');
}

if (!function_exists('gt3_menu_shortcode')) {
    function gt3_menu_shortcode() {
        if (function_exists('gt3_option')) {
            $header_height = gt3_option('header_height');
        }
        $header_height = $header_height['height'];
	    $id = gt3_get_queried_object_id();
        if (class_exists('RWMB_Loader') && $id !== 0) {
            if (rwmb_meta('mb_customize_header_layout', array(), $id) == 'custom') {
                $header_height = rwmb_meta("mb_header_height", array(), $id);
            }
        }

        $search_style = '';
        $search_style .= !empty($header_height) ? 'height:' . $header_height . 'px;' : '';
        $search_style = !empty($search_style) ? ' style="' . $search_style . '"' : '';

        ob_start();
        if (has_nav_menu('top_header_menu')) {
            echo "<nav class='top-menu main-menu main_menu_container'>";
            gt3_top_menu();
            echo "</nav>";
            echo '<div class="mobile-navigation-toggle"><div class="toggle-box"><div class="toggle-inner"></div></div></div>';
        }
        $out = ob_get_clean();
        return !empty($out) ? $out : '';
    }

    add_shortcode('gt3_menu', 'gt3_menu_shortcode');
}

if (!function_exists('gt3_top_menu')) {
    function gt3_top_menu() {
        wp_nav_menu(array(
            'theme_location'  => 'top_header_menu',
            'container'       => '',
            'container_class' => '',
            'after'           => '',
            'link_before'     => '<span>',
            'link_after'      => '</span>',
            'walker'          => ''
        ));
    }
}

add_action('wp_head', 'gt3_wp_head_custom_code', 1000);
function gt3_wp_head_custom_code() {
    // this code not only js or css / can insert any type of code

    if (function_exists('gt3_option')) {
        $header_custom_code = gt3_option('header_custom_js');
    }
    echo isset($header_custom_code) ? $header_custom_code : '';
}

add_action('wp_footer', 'gt3_custom_footer_js', 1000);
function gt3_custom_footer_js() {
    if (function_exists('gt3_option')) {
        $custom_js = gt3_option('custom_js');
    }
    echo isset($custom_js) ? '<script type="text/javascript" id="gt3_custom_footer_js">' . $custom_js . '</script>' : '';
}

if (!function_exists('gt3_string_coding')) {
    function gt3_string_coding($code) {
        if (!empty($code)) {
            return base64_encode($code);
        }
        return;
    }
}

function gt3_practice_team_case_query_var( $vars ){
    $vars[] = "practice_term_id";
    $vars[] = "team_term_id";
    $vars[] = "case_term_id";
    return $vars;
}
add_filter( 'query_vars', 'gt3_practice_team_case_query_var' );

add_image_size( 'gt3-admin-post-featured-image', 120, 120, true );
add_filter('manage_practice_posts_columns', 'gt3_add_post_admin_thumbnail_column', 2);
add_filter('manage_team_posts_columns', 'gt3_add_post_admin_thumbnail_column', 2);
add_filter('manage_case_posts_columns', 'gt3_add_post_admin_thumbnail_column', 2);
add_filter('manage_post_posts_columns', 'gt3_add_post_admin_thumbnail_column', 2);

function gt3_add_post_admin_thumbnail_column($gt3_columns){
    $gt3_columns['post_thumb'] = esc_html__('Featured Image','gt3_core');
    return $gt3_columns;
}

add_action('manage_practice_posts_custom_column', 'gt3_show_post_thumbnail_column', 5, 2);
add_action('manage_team_posts_custom_column', 'gt3_show_post_thumbnail_column', 5, 2);
add_action('manage_case_posts_custom_column', 'gt3_show_post_thumbnail_column', 5, 2);
add_action('manage_post_posts_custom_column', 'gt3_show_post_thumbnail_column', 5, 2);

function gt3_show_post_thumbnail_column($gt3_columns, $practice_id){
    switch($gt3_columns){
        case 'post_thumb':
            if( function_exists('the_post_thumbnail') ) {
                echo the_post_thumbnail( 'gt3-admin-post-featured-image' );
            }
            else
                echo 'hmm... your theme doesn\'t support featured image...';
            break;
    }
}

if (!function_exists('getSolidColorFromImage')) {
    function getSolidColorFromImage($filepath) {
        $attach_id = get_post_thumbnail_id(get_the_ID());
        $attach_path = get_attached_file( $attach_id );
        $upload_dir = wp_upload_dir();
        $attach_file = str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $attach_path);

        if (empty($attach_id) || ($attach_file != $filepath) ){
            global $wpdb;
            $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $filepath ));
            if (!empty($attachment[0])) {
                $attach_id = $attachment[0];
            }
        }

        $solid_color = get_post_meta( $attach_id, 'solid_color', true);

        if (empty($attach_id)) {
            return '#D3D3D3';
        }else{
            $filepath = get_attached_file( $attach_id );
        }

        if (!empty($solid_color)) {
            return $solid_color;
        }

        $type = wp_check_filetype($filepath); // [] if you don't have exif you could use getImageSize()
        if (!empty($type) && is_array($type) && !empty($type['ext']) && file_exists($filepath)) {
            $type = $type['ext'];
        }else{
            return '#D3D3D3';
        }
        $allowedTypes = array(
            'gif',  // [] gif
            'jpg',  // [] jpg
            'png',  // [] png
            'bmp'   // [] bmp
        );
        if (!in_array($type, $allowedTypes)) {
            return '#D3D3D3';
        }
        $im = false;
        switch ($type) {
            case 'gif' :
                if (function_exists('imageCreateFromGif')) {
                    $im = imageCreateFromGif($filepath);
                }
                break;
            case 'jpg' :
                if (function_exists('imageCreateFromJpeg')) {
                    $im = imageCreateFromJpeg($filepath);
                }
                break;
            case 'png' :
                if (function_exists('imageCreateFromPng')) {
                    $im = imageCreateFromPng($filepath);
                }
                break;
            case 'bmp' :
                if (function_exists('imageCreateFromBmp')) {
                    $im = imageCreateFromBmp($filepath);
                }
                break;
        }

        if ($im) {
            $thumb=imagecreatetruecolor(1,1);
            imagecopyresampled($thumb,$im,0,0,0,0,1,1,imagesx($im),imagesy($im));
            $mainColor=strtoupper(dechex((int)imagecolorat($thumb,0,0)));
            if (strlen($mainColor) < 6) {
                $mainColor = '0' . $mainColor;
            }
            update_post_meta( $attach_id, 'solid_color', $mainColor );
            return $mainColor;
        }else{
            return '#D3D3D3';
        }
    }
}

if (!function_exists('exif_imagetype')) {
    function exif_imagetype($filename){
        $img = getimagesize( $filename );
        if ( !empty( $img[2] ) )
            return  $img[2];
        return false;
    }
}

add_filter('the_content', 'gt3_fix_shortcodes_autop');
function gt3_fix_shortcodes_autop($content) {
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 * If Redux is running as a plugin, this will remove the demo notice and links
 */
add_action('redux/loaded', 'gt3_remove_demo');
if (!function_exists('gt3_remove_demo')) {
    function gt3_remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_filter('plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2);

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
        }
    }
}

remove_filter('pre_user_description', 'wp_filter_kses');
