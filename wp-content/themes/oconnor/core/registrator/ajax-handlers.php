<?php

// Likes
add_action( 'wp_ajax_add_like_attachment', 'gt3_add_like' );
add_action( 'wp_ajax_nopriv_add_like_attachment', 'gt3_add_like' );
function gt3_add_like() {
    $all_likes = gt3pb_get_option("likes");
    $attach_id = absint($_POST['attach_id']);
    $all_likes[$attach_id] = (isset($all_likes[$attach_id]) ? $all_likes[$attach_id] : 0)+1;
    gt3pb_update_option("likes", $all_likes);
    echo absint($all_likes[$attach_id]);
    die();
}

// wizeedu
add_action( 'wp_ajax_gt3_get_param_value_for_slider', 'gt3_get_param_value_for_slider' );
function gt3_get_param_value_for_slider() {
    $string = stripslashes($_POST['string']);

    echo urlencode($string);
    die();
}

add_action( 'wp_ajax_gt3_get_vc_images_for_slider', 'gt3_get_vc_images_for_slider' );
function gt3_get_vc_images_for_slider() {
    $ids = explode(',', stripslashes($_POST['ids']));

    foreach ($ids as $key => $id) {
        $featured_image = wp_get_attachment_image_src($id, 'full');
        echo "
        <li>
            <div class='img-item vc-slide-item' data-type='image' data-url='".$id."'>
              <div class='vc-img-preview '>
                <img alt='".esc_attr(get_the_title())."' src='" . esc_url(aq_resize($featured_image[0], "150", "150", true, true, true)) . "'>
                <div class='hover-container'>
                  <div class='inter_x_2'></div>
                </div>
              </div>
            </div>
        </li>
        ";
    }
    die();
}

add_action( 'wp_ajax_gt3_get_vc_image_for_video_cover', 'gt3_get_vc_image_for_video_cover' );
function gt3_get_vc_image_for_video_cover() {
    $url = stripslashes($_POST['url']);
    $title   = stripslashes($_POST['title']);

    if (strlen($url)) {
        echo "
            <div class='preview-inner'>
                <img alt='".esc_attr($title)."' src='" . esc_url(aq_resize($url, "150", "150", true, true, true)) . "'>
            </div>
            ";
    }

    die();
}

add_action( 'wp_ajax_gt3_get_vc_video_for_slider', 'gt3_get_vc_video_for_slider' );
function gt3_get_vc_video_for_slider() {
    $url     = stripslashes($_POST['url']);
    $title   = stripslashes($_POST['title']);
    $image   = stripslashes($_POST['image']);
    $caption = stripslashes($_POST['caption']);
    $img_url = get_template_directory_uri() . '/img/gt3_composer_addon/';

    echo "
    <li>
        <div class='video-item vc-slide-item' data-type='video' data-url='".esc_url($url)."' data-title='".esc_attr($title)."' data-caption='".$caption."' data-cover='".$image."'>
          <div class='vc-img-preview '>
            <img alt='".esc_attr($title)."' src='".esc_url($img_url)."video_item.png'>
            <div class='hover-container'>
              <div class='inter_x_2'></div>
              <div class='inter_edit_2'></div>
            </div>
          </div>
        </div>
    </li>
    ";

    die();
}