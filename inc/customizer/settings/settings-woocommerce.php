<?php
/**
 * WooCommerce Settings
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

$GLOBALS[ 'lovage_setting_woocommerce' ] =  array(

    /* Theme Color Section */
    'lovage_shop_section' => array(
       'title'           => esc_html__( 'Shop Page', 'lovage' ),
       'description'     => esc_html__( 'Manage the settings for the shop page.', 'lovage' ),
       'priority'        => 20,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel'           => 'woocommerce'
    ),

    'shop_sidebar' => array(
        'title'       => esc_html__( 'Show Sidebar', 'lovage' ),
        'section'     => 'lovage_shop_section', 
        'default'     => lovage_theme_customizer()->get_default('shop_sidebar'),
        'field'       => 'toggle', 
        'type'        => 'control',
        'default'     => 1,
        'sanitize_callback'    => 'lovage_switch_sanitization'
    )
);