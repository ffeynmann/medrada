<?php

// function for adding menu and rev slider to demo content
if ( !function_exists( 'wbc_extended_example' ) ) {
     function wbc_extended_example( $demo_active_import , $demo_directory_path ) {
        reset( $demo_active_import );
        $current_key = key( $demo_active_import );
        /************************************************************************
        * Import slider(s) for the current demo being imported
        *************************************************************************/
        if ( class_exists( 'RevSlider' ) ) {
           //If it's demo3 or demo5
           $wbc_sliders_array = array(
              'main-demo' => 'slider1.zip', //Set slider zip name
           );
           if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
              $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
              if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                 $slider = new RevSlider();
                 $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
              }
           }
        }
        /************************************************************************
        * Setting Menus
        *************************************************************************/
        // If it's demo1 - demo6
        $wbc_menu_array = array(
           'main-demo' => 'Main menu',
           'demo3' => 'Main Homepage',
        );

        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
           $top_menu = get_term_by( 'name', $wbc_menu_array[$demo_active_import[$current_key]['directory']], 'nav_menu' );
           $top_top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
           if ( isset( $top_menu->term_id ) ) {
              set_theme_mod( 'nav_menu_locations', array(
                    'main_menu' => $top_menu->term_id,
                    'top_header_menu' => $top_top_menu->term_id
                 )
              );
           }
        }
        /************************************************************************
        * Set HomePage
        *************************************************************************/
        // array of demos/homepages to check/select from
        $wbc_home_pages = array(
           'main-demo' => 'Homepage',
           'demo2' => 'Main Homepage',
           'demo3' => 'Main Homepage',
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
           $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
           if ( isset( $page->ID ) ) {
              update_option( 'page_on_front', $page->ID );
              update_option( 'show_on_front', 'page' );
           }
        }

        update_option( 'woocommerce_catalog_columns', 3 );
        update_option( 'woocommerce_catalog_rows', 3 );
        update_option( 'woocommerce_single_image_width', 1000 );
        update_option( 'woocommerce_thumbnail_image_width', 600 );
        update_option( 'woocommerce_thumbnail_cropping', 'custom' );
        update_option( 'woocommerce_thumbnail_cropping_custom_width', 3 );
        update_option( 'woocommerce_thumbnail_cropping_custom_height', 4 );
        

     }
     
     // Uncomment the below
     add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );

  }
?>
