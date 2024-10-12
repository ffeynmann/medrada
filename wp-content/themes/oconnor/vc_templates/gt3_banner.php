<?php
include_once get_template_directory() . '/vc_templates/gt3_google_fonts_render.php';

$defaults = array(
    'title_item'        => '',
    'pre_title_item'    => '',
    'item_text_aligh'   => 'left',
    'vertical_text'     => '',
    'link'              => '',

    'title_item_color'          => '#232325',
    'title_item_line_height'    => '140',
    'title_item_weight'         => '300',
    'title_item_size'           => '56',
    'title_responsive_font'     => '',
    'title_font_size_sm_desktop'=> '',
    'title_font_size_tablet'    => '',
    'title_font_size_mobile'    => '',
    'title_use_theme_fonts'     => '',

    'pre_title_item_color'          => '#e63764',
    'pre_title_item_line_height'    => '140',
    'pre_title_item_size'           => '56',
    'pre_title_item_weight'         => '300',
    'pre_title_responsive_font'     => '',
    'pre_title_font_size_sm_desktop'=> '',
    'pre_title_font_size_tablet'    => '',
    'pre_title_font_size_mobile'    => '',
    'pre_title_use_theme_fonts'     => '',

    'desc_pos'                  => 'left',
    'desc_item_color'           => '#232325',
    'desc_item_line_height'     => '140',
    'desc_item_size'            => '18',
    'desc_item_weight'          => '300',
    'desc_responsive_font'      => '',
    'desc_font_size_sm_desktop' => '',
    'desc_font_size_tablet'     => '',
    'desc_font_size_mobile'     => '',
    'desc_use_theme_fonts'      => '',

    'image'             => '',
    'background_color'  => '',
    'image_option'      => 'no-repeat',
    'image_position'    => 'bottom right',

    'border_style'  => 'none',
    'border_color'  => '#ffffff',
    'border_width'  => 'none',
    'border_radius' => 'none',

    'css_animation' => '',
    'css_banner'    => '',
    'item_el_class' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$css = $banner_style = $banner_image_style = $banner_border_style = $banner_border_overlap_style = $desc_style = $pre_title_style = $title_style = $outer_wrap_style = '';

// Render Google Fonts
$obj = new GoogleFontsRender();
extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('title_google_fonts','pre_title_google_fonts','desc_google_fonts') ) );

$title_font = ! empty( $styles_title_google_fonts ) ? esc_attr( $styles_title_google_fonts ) : '';
$pre_title_font = ! empty( $styles_pre_title_google_fonts ) ? esc_attr( $styles_pre_title_google_fonts ) : '';
$vertical_font = ! empty( $styles_desc_google_fonts ) ? esc_attr( $desc_google_fonts ) : '';

$class_to_filter = vc_shortcode_custom_css_class( $css_banner, ' ' ) . $this->getExtraClass( $item_el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'], $atts );

// Animation
$css_class .= ! empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

// Background Style
$img_id = preg_replace( '/[^\d]/', '', $image );
$featured_image = wp_get_attachment_image_url($img_id, 'single-post-thumbnail');
$banner_image_style .= $image != '' ? ' background-image: url(\''.$featured_image.'\');' : '';
$banner_image_style .= $image_position != '' ? ' background-position: '.esc_attr($image_position).';' : '';
switch ($image_option) {
    case 'cover':
        $banner_image_style .= 'background-size: cover;';
        break;
    case 'contain':
        $banner_image_style .= 'background-size: contain;';
        break;
    case 'no-repeat':
        $banner_image_style .= 'background-repeat: no-repeat;';
        break;
}
$banner_style .= $background_color != '' ? ' background-color: '.esc_attr($background_color).';' : '';

// Border Style
if ( $border_width != '' && $border_width != 'none') {
    $banner_border_style .= 'border-width: '.esc_attr($border_width).';';
    $banner_border_style .= $border_style != '' ? ' border-style: '.esc_attr($border_style).';' : '';
    $banner_border_style .= $border_color != '' ? ' border-color: '.esc_attr($border_color).';' : '';
    if ( $border_radius != 'none' && $border_radius != '' ) {
        $banner_border_style .= ' -webkit-border-radius: '.(int)$border_radius.'px ';
        $banner_border_style .= ' -moz-border-radius: '.(int)$border_radius.'px ';
        $banner_border_style .= ' border-radius: '.(int)$border_radius.'px ';
    }
    if ( $pre_title_item !== '' || $title_item !== '' ) {
        // $border_overlap = (int)$matches[2]/2;
        $banner_border_overlap_style .= 'display: block; height: '.esc_attr($border_width).';';
        $banner_border_overlap_style .= $background_color != '' ? ' background-color: '.esc_attr($background_color).';' : '';
        preg_match('/(padding-left: )+([^(\!) ]+)/i', $css_banner, $matches);
        if ($matches) {
            $padding = preg_split('/(?<=[0-9])(?=[a-z%]+)/i',$matches[2]);
            $border_overlap = round( (int)$padding[0]/2 );
            $padding_units = $padding[1];
        }else{
            $border_overlap = 0;
            $padding_units = 'px';
        }
        $banner_border_overlap_style .= 'left: '.($border_overlap > $border_width ? (int)$border_overlap.$padding_units : (int)$border_width.$padding_units);
    }

    // Outer Wrap Style
    $outer_wrap_style .= $border_width != '' ? ' padding: '.esc_attr($border_width).';' : '';
}



// Link Settings
$banner_link_temp = vc_build_link($link);
$link_url    = $banner_link_temp['url'];
$link_title  = $banner_link_temp['title'];
$link_target = $banner_link_temp['target'];
$banner_url    = $link_url !== '' ? $link_url : '#';
$banner_title  = $link_title !== '' ? ' title="' . $link_title . '"' : '';
$banner_target = $link_target !== '' ? ' target="' . $link_target . '"' : '';

// Style of Vertical Description
$desc_style .= $desc_item_size != '' ? ' font-size: '.(int)$desc_item_size.'px;' : '';
$desc_style .= $desc_item_line_height != '' ? ' line-height: '.(int)$desc_item_line_height.'%;' : '';
$desc_style .= $desc_item_weight != '' ? ' font-weight: '.(int)$desc_item_weight.';' : '';
$desc_style .= $desc_item_color != '' ? ' color: '.esc_attr($desc_item_color).';' : '';
if ($vertical_text !== '') {
    $css_class .= $desc_pos == 'left' ? ' gt3_banner--v_desc_left' : ' gt3_banner--v_desc_right';
}

// Style of Pre-Title
$pre_title_style .= $pre_title_item_size != '' ? ' font-size: '.(int)$pre_title_item_size.'px;' : '';
$pre_title_style .= $pre_title_item_line_height != '' ? ' line-height: '.(int)$pre_title_item_line_height.'%;' : '';
$pre_title_style .= $pre_title_item_weight != '' ? ' font-weight: '.(int)$pre_title_item_weight.';' : '';
$pre_title_style .= $pre_title_item_color != '' ? ' color: '.esc_attr($pre_title_item_color).';' : '';
$pre_title_style .= $item_text_aligh != '' ? ' text-align: '.esc_attr($item_text_aligh).';' : ' text-align: left;';

// Style of Title
$title_style .= $title_item_size != '' ? ' font-size: '.(int)$title_item_size.'px;' : '';
$title_style .= $title_item_line_height != '' ? ' line-height: '.(int)$title_item_line_height.'%;' : '';
$title_style .= $title_item_weight != '' ? ' font-weight: '.(int)$title_item_weight.';' : '';
$title_style .= $title_item_color != '' ? ' color: '.esc_attr($title_item_color).';' : '';
$title_style .= $item_text_aligh != '' ? ' text-align: '.esc_attr($item_text_aligh).';' : ' text-align: left;';



echo '<div class="gt3_module_banner '.esc_attr($css_class).'" style="'.$banner_style.'">';

    // Banner link and Image
    echo '<a class="gt3_banner--link_container" href="'.esc_attr($banner_url).'"'.$banner_title.$banner_target.'>';
        echo '<div class="gt3_banner--image_container" style="'.$banner_image_style.'"></div>';
    echo '</a>';

    echo '<div class="gt3_banner--container">';

        // Vertical Text
        if ($vertical_text !== '') {
            echo '<div class="gt3_banner--v_description" style="'.$desc_style.$vertical_font.'">';
            if ($desc_responsive_font == 'yes') {
                echo !empty($desc_font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$desc_font_size_sm_desktop.'px;line-height: ' . (int)$desc_item_line_height . '%;">' : '';
                echo !empty($desc_font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$desc_font_size_tablet.'px;line-height: ' . (int)$desc_item_line_height . '%;">' : '';
                echo !empty($desc_font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$desc_font_size_mobile.'px;line-height: ' . (int)$desc_item_line_height . '%;">' : '';
            }
            echo esc_attr($vertical_text);
            if ($desc_responsive_font == 'yes') {
                echo !empty($desc_font_size_sm_desktop) ? ' </div>' : '';
                echo !empty($desc_font_size_tablet) ? ' </div>' : '';
                echo !empty($desc_font_size_mobile) ? ' </div>' : '';
            }
            echo '</div>';
        }
        // ! Vertical Text


        echo '<div class="gt3_banner--outer_wrap '.$class_to_filter.'" style="'.$outer_wrap_style.'">';

            // Banner Border
            echo '<div class="gt3_banner--border_container" style="'.$banner_border_style.'"></div>';
            echo '<div class="gt3_banner--border_overlap" style="'.$banner_border_overlap_style.'"></div>';


            echo '<div class="gt3_banner--inner_wrap">';
                // Pre-Title
                if ($pre_title_item !== '') {
                    echo '<div class="gt3_banner--pre_title" style="'.$pre_title_style.$pre_title_font.'">';
                    if ($pre_title_responsive_font == 'yes') {
                        echo !empty($pre_title_font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$pre_title_font_size_sm_desktop.'px;line-height: ' . (int)$pre_title_item_line_height . '%;">' : '';
                        echo !empty($pre_title_font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$pre_title_font_size_tablet.'px;line-height: ' . (int)$pre_title_item_line_height . '%;">' : '';
                        echo !empty($pre_title_font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$pre_title_font_size_mobile.'px;line-height: ' . (int)$pre_title_item_line_height . '%;">' : '';
                    }
                    echo esc_attr($pre_title_item);
                    if ($pre_title_responsive_font == 'yes') {
                        echo !empty($pre_title_font_size_sm_desktop) ? ' </div>' : '';
                        echo !empty($pre_title_font_size_tablet) ? ' </div>' : '';
                        echo !empty($pre_title_font_size_mobile) ? ' </div>' : '';
                    }
                    echo '</div>';
                }
                //! Pre-Title

                // Title
                if ($title_item !== '') {
                    echo '<div class="gt3_banner--title" style="'.$title_style.$title_font.'">';
                    if ($title_responsive_font == 'yes') {
                        echo !empty($title_font_size_sm_desktop) ? ' <div class="gt3_custom_text-font_size_sm_desktop" style="font-size:'.(int)$title_font_size_sm_desktop.'px;line-height: ' . (int)$title_item_line_height . '%;">' : '';
                        echo !empty($title_font_size_tablet) ? ' <div class="gt3_custom_text-font_size_tablet" style="font-size:'.(int)$title_font_size_tablet.'px;line-height: ' . (int)$title_item_line_height . '%;">' : '';
                        echo !empty($title_font_size_mobile) ? ' <div class="gt3_custom_text-font_size_mobile" style="font-size:'.(int)$title_font_size_mobile.'px;line-height: ' . (int)$title_item_line_height . '%;">' : '';
                    }
                    echo esc_attr($title_item);
                    if ($title_responsive_font == 'yes') {
                        echo !empty($title_font_size_sm_desktop) ? ' </div>' : '';
                        echo !empty($title_font_size_tablet) ? ' </div>' : '';
                        echo !empty($title_font_size_mobile) ? ' </div>' : '';
                    }
                    echo '</div>';
                }
                // ! Title
                echo do_shortcode($content);
            echo '</div><!-- gt3_banner--inner_wrap -->';
        echo '</div><!-- gt3_banner--outer_wrap -->';





    echo '</div>';
echo'</div>';
