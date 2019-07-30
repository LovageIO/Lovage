<?php
/**
 * Typography Panel
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

 return array(
 	/**
     * Typography Panel
     */

    'lovage_typography_panel' => array(
       'title'           => esc_html__( 'Typography', 'lovage' ),
       'description'     => esc_html__( 'Manage the typography design for the global site.', 'lovage' ),
       'priority'        => 40,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'panel'
    ),

    /* Typograhy: Header Section */
    'lovage_header_typography_section' => array(
       'title'           => esc_html__( 'Header', 'lovage' ),
       'description'     => esc_html__( 'Manage the typography design for the site header area.', 'lovage' ),
       'priority'        => 10,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel' 			 => 'lovage_typography_panel'
    ),

    'site_title_typography' => array(
        'title'       => esc_html__( 'Site Title Typography', 'lovage' ),
        'description' => esc_html__( 'The typography settings for the default site title text. If you set the LOGO, the site title will be replaced, so you don\'t need to set this option.', 'lovage' ),
        'section'     => 'lovage_header_typography_section', 
        'default'     => $this->defaults['site_title_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'navigation_menu_typography' => array(
        'title'       => esc_html__( 'Site Navigation Typography', 'lovage' ),
        'description' => esc_html__( 'The typography settings for the default site navigation text.', 'lovage' ),
        'section'     => 'lovage_header_typography_section', 
        'default'     => $this->defaults['navigation_menu_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

     /* Typograhy: Content Section */
    'lovage_content_typography_section' => array(
       'title'           => esc_html__( 'Content', 'lovage' ),
       'description'     => esc_html__( 'Manage the typography for the page content area.', 'lovage' ),
       'priority'        => 20,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel' 			 => 'lovage_typography_panel'
    ),

    'standard_blog_title_typography' => array(
        'title'       => esc_html__( 'Standard Blog Title Typography', 'lovage' ),
        'description' => esc_html__( 'The typography settings for the standard blog title.', 'lovage' ),
        'section'     => 'lovage_content_typography_section', 
        'default'     => $this->defaults['standard_blog_title_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'site_paragraph_typography' => array(
        'title'       => esc_html__( 'Paragraph Typography', 'lovage' ),
        'description' => esc_html__( 'The typography settings for the content paragraph text.', 'lovage' ),
        'section'     => 'lovage_content_typography_section', 
        'default'     => $this->defaults['site_paragraph_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'h1_typography' => array(
        'title'       => esc_html__( 'H1 Typography', 'lovage' ),
        'section'     => 'lovage_content_typography_section', 
        'default'     => $this->defaults['h1_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'h2_typography' => array(
        'title'       => esc_html__( 'H2 Typography', 'lovage' ),
        'section'     => 'lovage_content_typography_section', 
        'default'     => $this->defaults['h2_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'h3_typography' => array(
        'title'       => esc_html__( 'H3 Typography', 'lovage' ),
        'section'     => 'lovage_content_typography_section', 
        'default'     => $this->defaults['h3_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'h4_typography' => array(
        'title'       => esc_html__( 'H4 Typography', 'lovage' ),
        'section'     => 'lovage_content_typography_section', 
        'default'     => $this->defaults['h4_typography'],
        'field'       => 'typography', 
        'transport'   => 'postMessage',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'h5_typography' => array(
        'title'       => esc_html__( 'H5 Typography', 'lovage' ),
        'section'     => 'lovage_content_typography_section', 
        'default'     => $this->defaults['h5_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'h6_typography' => array(
        'title'       => esc_html__( 'H6 Typography', 'lovage' ),
        'section'     => 'lovage_content_typography_section', 
        'default'     => $this->defaults['h6_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    /* Typograhy: Footer Section */
    'lovage_widget_typography_section' => array(
       'title'           => esc_html__( 'Widget', 'lovage' ),
       'description'     => esc_html__( 'Manage the typography for the site widget areas.', 'lovage' ),
       'priority'        => 30,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel' 			 => 'lovage_typography_panel'
    ),

    'widget_title_typography' => array(
        'title'       => esc_html__( 'Widget Title Typography', 'lovage' ),
        'description' => esc_html__( 'The typography settings for the site widgets title.', 'lovage' ),
        'section'     => 'lovage_widget_typography_section', 
        'default'     => $this->defaults['widget_title_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    ),

    'widget_content_typography' => array(
        'title'       => esc_html__( 'Widget Content Typography', 'lovage' ),
        'description' => esc_html__( 'The typography settings for the site widgets content text.', 'lovage' ),
        'section'     => 'lovage_widget_typography_section', 
        'default'     => $this->defaults['widget_content_typography'],
        'field'       => 'typography',
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_google_font_sanitization', 
    )
 );