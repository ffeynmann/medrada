<?php
$theme_color = esc_attr(gt3_option("theme-custom-color"));
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';

$defaults = array(
    'id_1'              => '',
    'id_2'              => '',
    'id_3'              => '',
    'items_aligh'       => 'style_4',
    'prod_button'       => 'gt3_button',

    // Style title start
    'title_1'           => '',
    'title_color_1'     => '#ffffff',
    'title_bg_color_1'  => '#f76733',
    'title_2'           => '',
    'title_color_2'     => '#ffffff',
    'title_bg_color_2'  => '#f76733',
    'title_3'           => '',
    'title_color_3'     => '#ffffff',
    'title_bg_color_3'  => '#f76733',

    'title_weight'      => '400',
    'title_font_size'   => '14',
    'title_line_height' => '140',
    'title_responsive_font'   => '',
    'title_font_size_sm_desktop' => '',
    'title_font_size_tablet'  => '',
    'title_font_size_mobile'  => '',
    'title_use_theme_fonts'   => '',

    // Tabs constituents
    'tab_title'         => 'yes',
    'tab_sub_title'     => 'yes',
    'tab_price'         => 'yes',

    // GT3 Button
    'button_title'      => 'Shop Now',
    'link'              => '',
    'button_size'       => 'normal',
    'button_alignment'  => 'inline',
    'css_animation'     => '',
    'item_el_class'     => '',
    'btn_bg_color'      => '#ffffff',
    'btn_text_color'    => '#f76733',
    'css'               => '',
    'btn_border_style'  => 'solid',
    'btn_border_width'  => '1px',
    'btn_border_radius' => 'none',
    'btn_border_color'  => '#f76733',
    'btn_font_size'     => '16',
    'btn_icon_type'     => 'none',
    'btn_icon_fontawesome'  => '',
    'btn_image'         => '',
    'btn_img_width'     => '',
    'icon_font_size'    => '16',
    'btn_icon_color'    => '#f76733',
    'btn_icon_position' => 'left',
    'btn_bg_color_hover'    => '#ffffff',
    'btn_text_color_hover'  => $theme_color,
    'btn_border_color_hover'=> $theme_color,
    'btn_icon_color_hover'  => $theme_color,
    'use_theme_button'  => 'yes',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

// Render Google Fonts
$obj = new GoogleFontsRender();
extract( $obj->getAttributes($atts, $this, $this->shortcode, array('title_google_fonts')) );
$title_google_fonts = ! empty( $styles_title_google_fonts ) ? esc_attr( $styles_title_google_fonts ) : '';

remove_action('woocommerce_after_shop_loop_item', 'gt3_open_control_tag', 9);
remove_action('woocommerce_after_shop_loop_item', 'gt3_close_control_tag', 15);

// Title init
$title_style  = $title_style_p_1 = $title_style_p_2 = $title_style_p_3 = '';
$title_style .= $title_font_size   != '' ? 'font-size: '  .(int)$title_font_size.'px;'  : '';
$title_style .= $title_line_height != '' ? 'line-height: '.(int)$title_line_height.'%;' : '';
$title_style .= $title_weight      != '' ? 'font-weight: '.(int)$title_weight.';'       : '';
$title_style .= $title_google_fonts!= '' ? esc_attr($title_google_fonts)                : '';

$title_style_p_1 .= $title_color_1    != '' ? 'color: '.esc_html($title_color_1).';' : '';
$title_style_p_1 .= $title_bg_color_1 != '' ? 'background-color: '.esc_html($title_bg_color_1).';' : '';

$title_style_p_2 .= $title_color_2    != '' ? 'color: '.esc_html($title_color_2).';' : '';
$title_style_p_2 .= $title_bg_color_2 != '' ? 'background-color: '.esc_html($title_bg_color_2).';' : '';

$title_style_p_3 .= $title_color_3    != '' ? 'color: '.esc_html($title_color_3).';' : '';
$title_style_p_3 .= $title_bg_color_3 != '' ? 'background-color: '.esc_html($title_bg_color_3).';' : '';
// Title init end

$meta_query = WC()->query->get_meta_query();
$prod_per_page = 0;
$id_x =  array();
if ( isset( $id_1 ) ) {
    $prod_per_page ++;
    array_push($id_x, $id_1 );
}
if ( isset( $id_2 ) ) {
    $prod_per_page ++;
    array_push($id_x, $id_2 );
}
if ( isset( $id_3 ) ) {
    $prod_per_page ++;
    array_push($id_x, $id_3 );
}

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => $prod_per_page,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'meta_query'     => $meta_query,
    'tax_query'      => WC()->query->get_tax_query(),
    'post__in'       => $id_x,
    'order'          => 'ASC',
);

$products = new WP_Query( $args );

ob_start();
$num_prod_tab = $num_prod = 0;
if ( $products->have_posts() ) : ?>

    <div class="gt3-product_tab-wrapper">
    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php ++$num_prod_tab; ?>
        <?php global $product; ?>
        <div class="gt3-product_tab-product <?php if($num_prod_tab == 1) echo 'active'; ?>" data-product-tab=".<?php echo 'gt3_product--'.get_the_ID(); ?>">
            <div class="gt3-product_tab_image-wrapper">
                <?php echo woocommerce_get_product_thumbnail('thumbnail');?>
            </div>
            <div class="gt3-product_tab_info-wrapper">
                <h4 class="gt3-product-title"><?php echo get_the_title(); ?></h4>
                <?php echo gt3_product_subtitle_frontend();?>
                <p class="price"><?php echo ''. $product->get_price_html();?></p>
            </div>
        </div>
    <?php endwhile; // end of the tab loop. ?>
    </div>

    <div class="gt3-product-wrapper">
        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php
        global $product;
        ++$num_prod;
        $prod_class = $num_prod == 1 ? ' active' : '';
        ?>
        <div class="product <?php echo 'gt3_product--'.get_the_ID().$prod_class; ?>">
            <div class="gt3-product_flex-wrapper">

                <div class="gt3-product_image-wrapper">
                    <?php echo woocommerce_get_product_thumbnail('full');?>
                </div>

                <div class="gt3-product_info-wrapper">
                    <div class="gt3-product_info-content">
                        <?php
                        echo '<div class="gt3-product_info-content_title '.(!empty($title_google_fonts) ? 'gt3_custom_text--custom-font' : '' ).'" style="'.esc_attr($title_style).'">';
                        if ($title_responsive_font == 'yes') {
                            echo !empty($title_font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$title_font_size_sm_desktop.'px;">' : '';
                            echo !empty($title_font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$title_font_size_tablet.'px;">' : '';
                            echo !empty($title_font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$title_font_size_mobile.'px;">' : '';
                        }
                        echo '<span class="gt3-product_info-content_title_span" style="'.esc_attr(${'title_style_p_'.$num_prod}).'">'.esc_html(${'title_'.$num_prod}).'</span>';
                        if ($title_responsive_font == 'yes') {
                            echo !empty($title_font_size_sm_desktop) ? ' </div>' : '';
                            echo !empty($title_font_size_tablet) ? ' </div>' : '';
                            echo !empty($title_font_size_mobile) ? ' </div>' : '';
                        }
                        echo '</div>';
                        ?>

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
        </div>
        <?php endwhile; // end of the loop. ?>
    </div>

<?php endif;

woocommerce_reset_loop();
wp_reset_postdata();

echo '<div class="woocommerce single-product gt3-single-product-tab gt3-single-product-tab--'.esc_html($items_aligh).'">'.ob_get_clean().'</div>';

?>