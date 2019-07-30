<?php
/**
 * Lovage Hooks
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */


/**
 * Wrapper
 * @see  lovage_before_content()
 * @see  lovage_after_content()
 * @see  lovage_before_main_content()
 * @see  lovage_after_main_content()
 */
add_action( 'lovage_before_content', 'lovage_before_content' );
add_action( 'lovage_after_content', 'lovage_after_content');
add_action( 'lovage_before_main_content', 'lovage_before_main_content' );
add_action( 'lovage_after_main_content', 'lovage_after_main_content' );


/**
 * Header
 * @see lovage_before_navigation()
 * @see lovage_custom_logo()
 * @see lovage_primary_navigation()
 * @see lovage_menu_buttons()
 * @see lovage_after_navigation()
 */
add_action( 'lovage_header', 'lovage_before_navigation',10);
add_action( 'lovage_header', 'lovage_custom_logo',20);
add_action( 'lovage_header', 'lovage_primary_navigation',30);
add_action( 'lovage_header', 'lovage_menu_buttons',40);
add_action( 'lovage_header', 'lovage_after_navigation',50);
add_action( 'lovage_after_header', 'lovage_site_header_image',10);
add_action( 'lovage_after_header', 'lovage_page_header', 20);


/**
 * Footer
 * @see lovage_bottom_widgets()	
 * @see lovage_before_footer()	
 * @see lovage_copyright()	
 * @see lovage_after_footer()	
 */
add_action( 'lovage_footer', 'lovage_bottom_widgets',0);
add_action( 'lovage_footer', 'lovage_before_footer',10);
add_action( 'lovage_footer', 'lovage_copyright',20);
add_action( 'lovage_footer', 'lovage_after_footer',30);


/**
 * Home Template
 * @see lovage_product_category_list()
 * @see lovage_featured_products()
 */
add_action('lovage_home','lovage_product_category_list',0);
add_action('lovage_home','lovage_product_data',10);

