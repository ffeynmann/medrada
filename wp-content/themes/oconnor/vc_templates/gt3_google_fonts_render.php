<?php

if (!class_exists('GoogleFontsRender')) {
    class GoogleFontsRender {
        // Get param value by providing key
        private function getParamData( $key, $b, $c ) {
            return WPBMap::getParam( $c, $key );
        }

        // Parses shortcode attributes and set defaults based on vc_map function relative to shortcode and fields names
        public function getAttributes( $atts, $b, $c, $x, $no_object = false ) {
            /**
             * Shortcode attributes
             * @var $google_fonts_iconbox_title
             */
            if ($no_object || $b == false) {
                $atts = vc_map_get_attributes( $c, $atts );
            }else{
                $atts = vc_map_get_attributes( $b->getShortcode(), $atts );
            }
            extract( $atts );

            /**
             * Get default values from VC_MAP.
             **/
            $google_fonts_field = array();
            foreach ($x as $value ) {
                $z = $this->getParamData( $value, $b, $c );

                array_push($google_fonts_field, $z);
            }

            $google_fonts_obj = new Vc_Google_Fonts();

            $google_fonts_field_settings = array();
            foreach ($google_fonts_field as $value) {
                $z = isset( $value['settings'], $value['settings']['fields'] ) ? $value['settings']['fields'] : array();
                array_push($google_fonts_field_settings, $z);
            }


            $google_fonts_data = array();
            foreach ($x as $key => $value) {
                $z = strlen( $atts[$value] ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings[$key], $atts[$value] ) : '';
                array_push($google_fonts_data, $z);
            }

            $google_fonts_array = array();
            foreach ($x as $value) {
                array_push($google_fonts_array, $atts[$value]);
            }
            $settings = get_option( 'wpb_js_google_fonts_subsets' );
            if ( is_array( $settings ) && ! empty( $settings ) ) {
                $subsets = '&subset=' . implode( ',', $settings );
            } else {
                $subsets = '';
            }
            foreach ($google_fonts_data as $value) {
                if ( ! empty( $value ) && isset( $value['values']['font_family'] ) ) {
                    wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $value['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $value['values']['font_family'] . $subsets );
                }
            }
            $styles = $this->getStyles($google_fonts_data, $atts, $x);

            return $styles;


        }

        // Parses google_fonts_data to get needed css styles to markup
        private function getStyles( $google_fonts_data, $atts, $x ) {
            $styles_block = array();
            foreach ($google_fonts_data as $key => $value) {
                $z = '';
                if ( ! empty( $value ) && isset( $value['values'], $value['values']['font_family'], $value['values']['font_style'] ) ) {
                    $google_fonts_family = explode( ':', $value['values']['font_family'] );
                    $z .= key_exists( 0, $google_fonts_family ) ? 'font-family:' . $google_fonts_family[0] .';' : '';
                    $google_fonts_styles = explode( ':', $value['values']['font_style'] );

                    $z .= key_exists( 1, $google_fonts_styles ) ? 'font-weight:' . $google_fonts_styles[1] .';': '';
                    $z .= key_exists( 2, $google_fonts_styles ) ? 'font-style:' . $google_fonts_styles[2] .';': '';
                }
                $styles_block['styles_'.$x[$key]] = $z;
            }
            return $styles_block;
        }
    }

}
