<?php
/**
 * Color Panel
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

$GLOBALS[ 'lovage_setting_colors' ] =  array(
	'lovage_color_panel' => array(
	   'title'           => esc_html__( 'Color Scheme', 'lovage' ),
	   'description'     => esc_html__( 'Manage the site color style', 'lovage' ),
	   'priority'        => 30,
	   'capability'      => '', 
	   'theme_supports'  => '', 
	   'active_callback' => '', 
	   'type'            => 'panel'
	),

	/* Theme Color Section */
	'lovage_theme_color_section' => array(
	   'title'           => esc_html__( 'Theme Color Scheme', 'lovage' ),
	   'description'     => esc_html__( 'Manage the global color scheme.', 'lovage' ),
	   'priority'        => 10,
	   'capability'      => '', 
	   'theme_supports'  => '', 
	   'active_callback' => '', 
	   'type'            => 'section',
	   'panel'			 => 'lovage_color_panel'
	),

	'theme_link_color' => array(
	    'title'       => esc_html__( 'Link Color', 'lovage' ),
	    'description' => esc_html__( 'The global link color.', 'lovage' ),
	    'section'     => 'lovage_theme_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('theme_link_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity'=> true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'theme_link_hover_color' => array(
	    'title'       => esc_html__( 'Link Hover Color', 'lovage' ),
	    'description'     => esc_html__( 'The global link color when hovering on the link.', 'lovage' ),
	    'section'     => 'lovage_theme_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('theme_link_hover_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'theme_text_color' => array(
	    'title'       => esc_html__( 'Text Color', 'lovage' ),
	    'description'     => esc_html__( 'The global content text color.', 'lovage' ),
	    'section'     => 'lovage_theme_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('theme_text_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'type'        => 'control',
	    'transport'   => 'postMessage',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	/* Header Color Section */
	'lovage_header_color_section' => array(
	   'title'           => esc_html__( 'Header Color Scheme', 'lovage' ),
	   'description'     => esc_html__( 'Manage the site header color style', 'lovage' ),
	   'priority'        => 10,
	   'capability'      => '', 
	   'theme_supports'  => '', 
	   'active_callback' => '',
	   'type'            => 'section',
	   'panel'			 => 'lovage_color_panel'
	),

	'site_header_color' => array(
	    'title'       => esc_html__( 'Site Header Background Color', 'lovage' ),
	    'description' => esc_html__( 'Choose the site header background color for the global site.', 'lovage' ),
	    'section'     => 'lovage_header_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('site_header_color'),
	    'field'       => 'alpha-color', 
	    'type'        => 'control',
	    'show_opacity' => true, 
	    'transport'   => 'postMessage',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'header_border_color' => array(
        'title'       => esc_html__( 'Header Border Color', 'lovage' ),
        'description' => esc_html__( 'The bottom border color of the site header.', 'lovage' ),
        'section'     => 'lovage_header_color_section', 
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'default'	  => lovage_theme_customizer()->get_default('header_border_color'),
        'sanitize_callback'    => '',
    ),

	'site_title_color' => array(
	    'title'       => esc_html__( 'Site Title Color', 'lovage' ),
	    'description' => esc_html__( 'Choose the site title color for the global site.', 'lovage' ),
	    'section'     => 'lovage_header_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('site_title_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'navigation_menu_color' => array(
	    'title'       => esc_html__( 'Site Menu Link Color', 'lovage' ),
	    'description' => esc_html__( 'Choose the site navigation menu link color for the global site.', 'lovage' ),
	    'section'     => 'lovage_header_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('navigation_menu_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'navigation_menu_hover_color' => array(
	    'title'       => esc_html__( 'Site Menu Link Hover Color', 'lovage' ),
	    'description' => esc_html__( 'The color when the mouse hovering on the site menu link.', 'lovage' ),
	    'section'     => 'lovage_header_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('navigation_menu_hover_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	/* Footer Color Section */
	'lovage_footer_color_section' => array(
	   'title'           => esc_html__( 'Footer Color Scheme', 'lovage' ),
	   'description'     => esc_html__( 'Manage the site footer color style', 'lovage' ),
	   'priority'        => 20,
	   'capability'      => '', 
	   'theme_supports'  => '', 
	   'active_callback' => '', 
	   'type'            => 'section',
	   'panel'			 => 'color_panel'
	),

	'footer_color' => array(
	    'title'       => esc_html__( 'Site Footer Background Color', 'lovage' ),
	    'description' => esc_html__( 'Choose the site footer background color for the global site.', 'lovage' ),
	    'section'     => 'lovage_footer_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('footer_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true, 
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'footer_text_color' => array(
	    'title'       => esc_html__( 'Site Footer Text Color', 'lovage' ),
	    'description' => esc_html__( 'Choose the site footer text color for the global site.', 'lovage' ),
	    'section'     => 'lovage_footer_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('footer_text_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'footer_link_color' => array(
	    'title'       => esc_html__( 'Site Footer Link Color', 'lovage' ),
	    'description' => esc_html__( 'Choose the site footer link color for the global site.', 'lovage' ),
	    'section'     => 'lovage_footer_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('footer_link_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'footer_link_hover_color' => array(
	    'title'       => esc_html__( 'Site Footer Link Hover Color', 'lovage' ),
	    'description' => esc_html__( 'The color when the mouse hovering on the link.', 'lovage' ),
	    'section'     => 'lovage_footer_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('footer_link_hover_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	/* Blog Color Section */
	'lovage_blog_color_section' => array(
	   'title'           => esc_html__( 'Blog Color Scheme', 'lovage' ),
	   'description'     => esc_html__( 'Manage the blog color scheme.', 'lovage' ),
	   'priority'        => 10,
	   'capability'      => '', 
	   'theme_supports'  => '', 
	   'active_callback' => '', 
	   'transport'   => 'postMessage',
	   'type'            => 'section',
	   'panel'			 => 'lovage_color_panel'
	),

	'blog_title_color' => array(
	    'title'       => esc_html__( 'Blog Title Color', 'lovage' ),
	    'description'     => esc_html__( 'For both archive page and single post.', 'lovage' ),
	    'section'     => 'lovage_blog_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('blog_title_color'),
	    'field'       => 'alpha-color', 
	    'type'        => 'control',
	    'transport'   => 'postMessage',
	    'show_opacity' => true, 
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'blog_title_hover_color' => array(
	    'title'       => esc_html__( 'Blog Title Hover Color', 'lovage' ),
	    'description'     => esc_html__( 'For both archive page and single post.', 'lovage' ),
	    'section'     => 'lovage_blog_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('blog_title_hover_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	),

	'theme_excerpt_color' => array(
	    'title'       => esc_html__( 'Excerpt Text Color', 'lovage' ),
	    'description'     => esc_html__( 'For blog archive page.', 'lovage' ),
	    'section'     => 'lovage_blog_color_section', 
	    'default'     => lovage_theme_customizer()->get_default('theme_excerpt_color'),
	    'field'       => 'alpha-color', 
	    'show_opacity' => true,
	    'transport'   => 'postMessage',
	    'type'        => 'control',
	    'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
	)
);