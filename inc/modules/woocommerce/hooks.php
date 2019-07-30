<?php
/**
 * Lovage WooCommerce Hooks
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

/**
 * Wrapper
 * @hooked  lovage_before_content()
 * @hooked  lovage_after_content()
 * @hooked  lovage_before_main_content()
 * @hooked  lovage_after_main_content()
 * @hooked  lovage_shop_sidebar()
 * @hooked  lovage_before_shop
 * @hooked  lovage_after_shop
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',10 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_after_main_content','woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar', 10 );
add_action( 'woocommerce_before_main_content', 'lovage_before_content',10); 
add_action( 'woocommerce_before_shop_loop','lovage_before_shop',10 );
add_action( 'woocommerce_before_shop_loop','lovage_after_shop',40 ); 
add_action( 'woocommerce_before_shop_loop', 'lovage_shop_sidebar',50); 
add_action( 'woocommerce_before_shop_loop', 'lovage_before_shop_content',60);
add_action( 'woocommerce_after_shop_loop', 'lovage_after_shop_content' ,10); 
add_action( 'woocommerce_after_main_content', 'lovage_after_content',30);


/**
 * Call Products
 * @see  lovage_product_categories()
 * @see  lovage_featured_products()
 * @see  lovage_popular_products()
 * @see  lovage_recent_products()
 * @see  lovage_on_sale_products()
 */
add_action( 'lovage_product_categories', 'lovage_product_categories');
add_action( 'lovage_featured_products', 'lovage_featured_products');
add_action( 'lovage_popular_products', 'lovage_popular_products');
add_action( 'lovage_recent_products', 'lovage_recent_products');
add_action( 'lovage_on_sale_products', 'lovage_on_sale_products');


/**
 * Single Product Page
 * @see  lovage_before_summary()
 * @see  lovage_after_summary()
 */
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_rating',10);
add_action( 'woocommerce_before_single_product_summary', 'lovage_before_summary' ,1); 
add_action( 'woocommerce_after_single_product_summary', 'lovage_after_summary',0);

/* Add wrapper to the add to cart area. */
add_action( 'woocommerce_before_add_to_cart_form', 'lovage_add_to_cart_wrapper' );
add_action( 'woocommerce_after_add_to_cart_form', 'lovage_add_to_cart_wrapper_close' );

/* Remove the product tab heading */
add_filter( 'woocommerce_product_description_heading', 'remove_product_tab_heading' );
add_filter('woocommerce_product_additional_information_heading', 'remove_product_tab_heading');
function remove_product_tab_heading() {
    return '';
} 

/**
 * Cart page wrapper
 * @hooked  lovage_before_cart_table()
 * @hooked  lovage_after_cart_table()
 */
add_action( 'woocommerce_before_cart_table','lovage_before_cart_table',10 );
add_action( 'woocommerce_after_cart_table','lovage_after_cart_table',10 );

/**
 * Move the cross sell display below the cart table
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_after_cart','woocommerce_cross_sell_display');

/**
 * Custom cart button	
 * @hooked lovage_add_to_cart()
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); 
add_action( 'woocommerce_before_shop_loop_item_title','lovage_add_to_cart',10);


/**
 * Add Product category menu	
 * @hooked lovage_woocommerce_category_menu()
 */
add_action( 'woocommerce_archive_description','lovage_woocommerce_category_menu',10 );

/**
 * Product Loop
 * @hooked lovage_template_loop_product_thumbnail()
 */
remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10 );
remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
add_action( 'woocommerce_before_shop_loop_item_title','lovage_template_loop_product_thumbnail',10 );
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title' );
add_action( 'woocommerce_shop_loop_item_title','lovage_template_loop_product_title');