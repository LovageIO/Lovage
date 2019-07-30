<?php
/**
 * Custom functions that act independently of the WooCommerce default templates.
 * Eventually, some of the functionality here could be replaced by core features. 
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

/* Disable WooCommerce default CSS */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_filter( 'woocommerce_output_related_products_args', 'lovage_related_products_args' );
if ( ! function_exists( 'lovage_related_products_args' ) ) :
	/**
	 * Change 2 columns layout for WooCommerce Related Product
	 * --------------------------------------------------------
	 *
	 * Change number of related products on product page
	 * Set your own value for 'posts_per_page'
	 *
	 */ 
	function lovage_related_products_args( $args ) {
		$args['posts_per_page'] = 4; // 4 related products
		$args['columns'] = 4; // arranged in 4 columns
		return $args;
	}
endif;

add_filter( 'woocommerce_breadcrumb_defaults', 'lovage_woocommerce_breadcrumbs' );
if ( ! function_exists( 'lovage_woocommerce_breadcrumbs' ) ) :
	/**
	 * Customize the WooCommerce breadcrumb.
	 * --------------------------------------------------------
	 */ 
	function lovage_woocommerce_breadcrumbs() {
	    return array(
	            'delimiter'   => ' &#47; ',
	            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><i class="fa fa-home"></i>',
	            'wrap_after'  => '</nav>',
	            'before'      => '',
	            'after'       => '',
	            'home'        => _x( 'Home', 'breadcrumb', 'lovage' ),
	        );
	}
endif;

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')):
	// Change number or products per row to 3
	function loop_columns() {
		return 3; // 3 products per row
	}
endif;

add_filter( 'loop_shop_per_page','lovage_products_per_page' );
if (!function_exists('lovage_products_per_page')):
	/**
	 * Products per page
	 * ---------------------------------------------------
	 */
	function lovage_products_per_page() {
		return intval( apply_filters( 'lovage_products_per_page', 12 ) );
	}
endif;

add_filter( 'woocommerce_cross_sells_columns', 'lovage_cross_sell_display_columns' );
if (!function_exists('lovage_cross_sell_display_columns')):
	/**
	 * Change Cross Product to 4 columns
	 */
	function lovage_cross_sell_display_columns() {
		return 4;
	}
endif;

add_filter( 'woocommerce_breadcrumb_defaults', 'lovage_change_breadcrumb_delimiter' );
if (!function_exists('lovage_change_breadcrumb_delimiter')):
	/**
	 * Customize the woocommerce breadcrumb.
	 */
	function lovage_change_breadcrumb_delimiter( $defaults ) {
		// Change the breadcrumb delimeter from '/' to '>'
		$defaults['delimiter'] = '<span class="delimiter">&raquo;</span>';
		$defaults['wrap_before'] = '<div itemscope class="lovage-breadcrumbs">';
		$defaults['wrap_after'] = '</div></div>';
		return $defaults;
	}
endif;