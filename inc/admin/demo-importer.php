<?php
/**
 * Demo importer
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

if ( ! function_exists( 'lovage_import_files' ) ){
    function lovage_import_files() {
        return array(
            apply_filters( 'lovage_preset_demos', array(
                'import_file_name'           => 'Default',
                'import_file_url'            => 'https://demo.lovage.io/data/default/content.xml',
                'import_widget_file_url'     => 'https://demo.lovage.io/data/default/widgets.json',
                'import_preview_image_url'   => 'https://demo.lovage.io/data/default/screenshot.png',
                'import_customizer_file_url' => 'https://demo.lovage.io/data/default/customizer.dat',
                'preview_url'                => 'https://demo.lovage.io/',
            ) ),
        );
    }
}
add_filter( 'pt-ocdi/import_files', 'lovage_import_files' );


if ( ! function_exists( 'lovage_after_import' ) ){
    function lovage_after_import( $selected_import ) {
        //Set Menu
        $top_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
        set_theme_mod( 'nav_menu_locations' , 
            array( 
                  'primary' => $top_menu->term_id, 
                  'mobile'  => $top_menu->term_id 
                 ) 
        );

        //Set Front Page
        $homepage = 'Home';
        $page = get_page_by_title( $homepage );
        if ( isset( $page->ID ) ) {
            update_option( 'page_on_front', $page->ID );
            update_option( 'show_on_front', 'page' );
        }
    }
}
add_action( 'pt-ocdi/after_import', 'lovage_after_import' );