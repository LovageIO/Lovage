<?php
/**
 * Additional Codes Section 
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

$GLOBALS[ 'lovage_setting_codes' ] = array(

    'lovage_additional_codes_section' => array(
       'title'           => esc_html__( 'Additional Codes', 'lovage' ),
       'description'     => esc_html__( 'You can add additional codes to head or footer such like google analytics, facebook pixel, Meta tags and Javascript.', 'lovage' ),
       'priority'        => 120,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
    ),

    'head_codes' => array(
        'title'       => esc_html__( 'Head Codes', 'lovage' ),
        'description' => esc_html__( 'The codes will be appened within <head></head> tag.', 'lovage' ),
        'section'     => 'lovage_additional_codes_section', 
        'default'     => lovage_theme_customizer()->get_default('head_codes'),
        'field'       => 'code_editor', 
        'type'        => 'control',
        'sanitize_callback'    => 'wp_kses_post',
    ),

    'footer_codes' => array(
        'title'       => esc_html__( 'Footer Codes', 'lovage' ),
        'description' => esc_html__( 'The codes will be appened above </body> tag.', 'lovage' ),
        'section'     => 'lovage_additional_codes_section', 
        'default'     => lovage_theme_customizer()->get_default('footer_codes'),
        'field'       => 'code_editor', 
        'type'        => 'control',
        'sanitize_callback'    => 'wp_kses_post',
    )
);