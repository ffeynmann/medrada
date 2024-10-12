<?php
$theme_color = esc_attr(gt3_option("theme-custom-color"));

$defaults = array(
    'id'                => '',
    'items_aligh'       => 'style_1',
    'time_is_up'        => 'countdown_remove',
    'prod_button'       => 'gt3_button',

    // GT3 Countdown
    'countdown_year'    => '',
    'countdown_month'   => '',
    'countdown_day'     => '',
    'countdown_hours'   => '',
    'countdown_min'     => '',
    'show_seconds'      => 'yes',
    'show_day'          => 'yes',
    'show_hours'        => 'yes',
    'show_minutes'      => 'yes',
    'size'              => '',
    'box_shadow'        => '',
    'counter_bg'        => '#ffffff',
    'color'             => '#27323d',
    'align'             => 'right',

    // GT3 Button
    'button_title'      => 'Shop Now',
    'link'              => '',
    'button_size'       => 'normal',
    'button_alignment'  => 'inline',
    'css_animation'     => '',
    'item_el_class'     => '',
    'btn_bg_color'      => $theme_color,
    'btn_text_color'    => '#ffffff',
    'css'               => '',
    'btn_border_style'  => 'solid',
    'btn_border_width'  => '1px',
    'btn_border_radius' => 'none',
    'btn_border_color'  => $theme_color,
    'btn_font_size'     => '',
    'btn_icon_type'     => 'none',
    'btn_icon_fontawesome'  => 'fa fa-adjust',
    'btn_image'         => '',
    'btn_img_width'     => '',
    'icon_font_size'    => '',
    'btn_icon_color'    => '#ffffff',
    'btn_icon_position' => 'left',
    'btn_bg_color_hover'    => '#ffffff',
    'btn_text_color_hover'  => $theme_color,
    'btn_border_color_hover'=> $theme_color,
    'btn_icon_color_hover'  => '#ffffff',
    'use_theme_button'  => 'yes',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$meta_query = WC()->query->get_meta_query();

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 1,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'meta_query'     => $meta_query,
    'tax_query'      => WC()->query->get_tax_query(),
);

if ( isset( $id ) ) {
    $args['p'] = $id;
}

remove_action('woocommerce_after_shop_loop_item', 'gt3_open_control_tag', 9);
remove_action('woocommerce_after_shop_loop_item', 'gt3_close_control_tag', 15);

// Init Date
$date_now = date("o,m,j");
$new_date = new DateTime();
$new_date->setDate( (int)$countdown_year, (int)$countdown_month, (int)$countdown_day );
$module_date = $new_date->format('o,m,j');
// Init Date end

$products = new WP_Query( $args );

ob_start();
if ( $products->have_posts() ) : ?>

    <?php
    while ( $products->have_posts() ) : $products->the_post(); ?>

        <div class="product">
            <?php
            global $post, $product;
            $sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
            $sales_price_date = $sales_price_to != '' && !empty($sales_price_to) ? date("o,m,j", $sales_price_to) : '';

            if  ( ($product -> is_on_sale() && $sales_price_date > $date_now )  ||
                  ($time_is_up == 'countdown_nothing' )  ||
                  ($module_date > $date_now && $time_is_up == 'custom_date_hide') ||
                  ($time_is_up == 'custom_date_nothing' ) ) : ?>

                <div class="gt3-product_countdown-wrapper">
                    <?php
                    if( ( $product -> is_on_sale() && $sales_price_date > $date_now ) ||
                        ( $time_is_up == 'countdown_nothing' )  ) {
                        $countdown_year  = date("o", $sales_price_to);
                        $countdown_month = date("m", $sales_price_to);
                        $countdown_day   = date("j", $sales_price_to);
                        $countdown_hours = 0;
                        $countdown_min   = 0;
                    }

                    echo do_shortcode('[gt3_countdown 
                        countdown_year="'.$countdown_year.'" 
                        countdown_month="'.$countdown_month.'" 
                        countdown_day="'.$countdown_day.'" 
                        countdown_hours="'.$countdown_hours.'" 
                        countdown_min="'.$countdown_min.'" 
                        show_seconds="'.$show_seconds.'" 
                        show_day="'.$show_day.'" 
                        show_hours="'.$show_hours.'" 
                        show_minutes="'.$show_minutes.'" 
                        size="'.$size.'" 
                        box_shadow="'.$box_shadow.'" 
                        vertical_style="yes" 
                        counter_bg="'.$counter_bg.'" 
                        color="'.$color.'" 
                        align="'.$align.'"
                    ]');
                    ?>
                </div>

            <?php endif; ?>

            <div class="gt3-product_image-wrapper">
                <?php echo woocommerce_get_product_thumbnail('full');?>
            </div>

            <div class="gt3-product_info-wrapper">
                <div class="gt3-product_info-content">
                    <a href="<?php echo get_the_permalink();?>" class="woocommerce-LoopProduct-link">
                        <h3 class="gt3-product-title"><?php echo get_the_title(); ?></h3>
                    </a>
                    <?php
                    echo gt3_product_subtitle_frontend();
                    echo woocommerce_template_single_rating();
                    echo '<p class="price">'. $product->get_price_html().'</p>';
                    echo woocommerce_template_single_excerpt();
                    ?>
                    <div class="gt3-product_button-wrapper cart">
                        <?php
                        if( $prod_button == 'gt3_button' ){
                            echo do_shortcode('[gt3_button 
                                button_title="'.$button_title.'" 
                                link="'.$link.'" 
                                button_size="'.$button_size.'" 
                                button_alignment="'.$button_alignment.'" 
                                css_animation="'.$css_animation.'" 
                                item_el_class="'.$item_el_class.'"
                                btn_border_style="'.$btn_border_style.'" 
                                btn_border_width="'.$btn_border_width.'" 
                                btn_border_radius="'.$btn_border_radius.'" 
                                btn_icon_type="'.$btn_icon_type.'" 
                                btn_icon_fontawesome="'.$btn_icon_fontawesome.'" 
                                btn_image="'.$btn_image.'" 
                                btn_img_width="'.$btn_img_width.'" 
                                btn_icon_position="'.$btn_icon_position.'" 
                                icon_font_size="'.$icon_font_size.'" 
                                btn_font_size="'.$btn_font_size.'" 
                                use_theme_button="'.$use_theme_button.'" 
                                btn_bg_color="'.$btn_bg_color.'" 
                                btn_text_color="'.$btn_text_color.'" 
                                btn_bg_color_hover="'.$btn_bg_color_hover.'" 
                                btn_text_color_hover="'.$btn_text_color_hover.'" 
                                btn_icon_color="'.$btn_icon_color.'" 
                                btn_icon_color_hover="'.$btn_icon_color_hover.'" 
                                btn_border_color="'.$btn_border_color.'" 
                                btn_border_color_hover="'.$btn_border_color_hover.'" 
                                css="'.$css.'" 
                            ]');
                        } else{
                            woocommerce_template_loop_add_to_cart();
                        } ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile; // end of the loop.?>
<?php endif;
woocommerce_reset_loop();
wp_reset_postdata();

echo '<div class="woocommerce single-product gt3-product-countdown gt3-product-countdown--'.esc_html($items_aligh).'">'.ob_get_clean().'</div>';
?>