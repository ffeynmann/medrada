<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo (is_user_logged_in() && is_admin_bar_showing())? 'gt3_wp-admin-bar' : ''; ?>">
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php if(gt3_option('responsive') == "1"){?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php } ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
    <?php
        wp_head();
    ?>
</head>
<?php
$body_class  = '';
$body_class .= gt3_option("add_default_typography_spacing") == '1' ? 'gt3_default_typography_sapcing' : '';
?>
<body <?php body_class($body_class); ?> data-theme-color="<?php echo esc_attr(gt3_option("theme-custom-color")); ?>">
    <?php
        gt3_preloader();
        $id = gt3_get_queried_object_id();
        gt3_get_header_builder($id);
        gt3_get_page_title($id);
    ?>
    <div class="site_wrapper fadeOnLoad">
        <?php
            $page_shortcode = '';
            if (class_exists( 'RWMB_Loader' )) {
                $page_shortcode = rwmb_meta('mb_page_shortcode', array(), $id);
                if (strlen($page_shortcode) > 0) {
                    echo do_shortcode($page_shortcode);
                }
            }
        ?>
        <div class="main_wrapper">