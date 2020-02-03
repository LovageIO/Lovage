<?php
/**
 * Layout Panel
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

 $GLOBALS[ 'lovage_setting_layout' ] =  array(

    'lovage_layout_panel' => array(
       'title'           => esc_html__( 'Layout', 'lovage' ),
       'description'     => esc_html__( 'Manage the site layout', 'lovage' ),
       'priority'        => 60,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'panel'
    ),

    /**
     * Header Layout Section
     */

    'lovage_header_layout_section' => array(
       'title'           => esc_html__( 'Header', 'lovage' ),
       'description'     => esc_html__( 'Manage the site header style', 'lovage' ),
       'priority'        => 10,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel'			 => 'lovage_layout_panel'
    ),
  

   'header_layout' => array(
        'title'       => esc_html__( 'Header Layouts', 'lovage' ),
        'description' => esc_html__( 'Choose the global site header layout.', 'lovage' ),
        'section'     => 'lovage_header_layout_section', 
        'default'     => lovage_theme_customizer()->get_default('header_layout'),
        'field'       => 'radio-image', 
        'transport'   => 'postMessage',
        'type'        => 'control',
        'choices'	  => apply_filters('lovage_header_layouts', array(
        	'standard' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/default-header.jpg',
            		'label' => esc_html__('Standard', 'lovage')
        		   ),
        	'standard-rtl' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/rtl-header.jpg',
            		'label' => esc_html__('Standard RTL', 'lovage')
        		   ),
        	'centered-vertical' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/centered-logo-header.jpg',
            		'label' => esc_html__('Centered Vertical', 'lovage')
        		   )
        )),
        'sanitize_callback'    => 'lovage_radio_sanitization', 
    ),

    'sticky_header' => array(
        'title'       => esc_html__( 'Sticky Header', 'lovage' ),
        'description' => esc_html__( 'Set the site header stick to top.', 'lovage' ),
        'section'     => 'lovage_header_layout_section', 
        'field'       => 'toggle', 
        'type'        => 'control',
        'transport'   => 'refresh',
        'default'     => lovage_theme_customizer()->get_default('sticky_header'),
        'sanitize_callback'    => 'lovage_switch_sanitization',
    ),

    'header_image_height' => array(
        'title'       => esc_html__( 'Header Image Height', 'lovage' ),
        'description' => esc_html__( 'Set the header image height, the unite is %', 'lovage' ),
        'section'     => 'header_image', 
        'field'       => 'range-slider', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'default'	  => lovage_theme_customizer()->get_default('header_image_height'),
        'sanitize_callback' => 'lovage_range_sanitization',
        'input_attrs' => array(
        	'min' => 50, 
			'max' => 800, 
			'step' => 1, 
        ),
    ),

    'header_title' => array(
        'title'       => esc_html__( 'Header Title', 'lovage' ),
        'description' => esc_html__( 'If you leave it empty, just show the site name by default.', 'lovage' ),
        'section'     => 'header_image', 
        'field'       => 'text',
        'type'        => 'control',
        'transport'   => 'postMessage',
        'default'     => lovage_theme_customizer()->get_default('header_title'),
        'sanitize_callback' => 'wp_kses_post',
    ),

    'header_subtitle' => array(
        'title'       => esc_html__( 'Header Subtitle', 'lovage' ),
        'description' => esc_html__( 'If you leave it empty, just show the site tagline by default.', 'lovage' ),
        'section'     => 'header_image', 
        'field'       => 'text',
        'type'        => 'control',
        'transport'   => 'postMessage',
        'default'     => lovage_theme_customizer()->get_default('header_subtitle'),
        'sanitize_callback' => 'wp_kses_post',
    ),

    'header_image_text_color' => array(
        'title'       => esc_html__( 'Header Image Text Color', 'lovage' ),
        'description' => esc_html__( 'Set the color for header text color', 'lovage' ),
        'section'     => 'header_image', 
        'field'       => 'alpha-color',
        'show_opacity'=> true, 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'default'     => lovage_theme_customizer()->get_default('header_image_text_color'),
        'sanitize_callback' => 'lovage_hex_rgba_sanitization',
    ),

    'header_image_border_color' => array(
        'title'       => esc_html__( 'Header Text Border Color', 'lovage' ),
        'description' => esc_html__( 'The border around the subheading in the header area.', 'lovage' ),
        'section'     => 'header_image', 
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'default'     => lovage_theme_customizer()->get_default('header_image_border_color'),
        'sanitize_callback'    => '',
    ),

    'header_image_overlay_color' => array(
        'title'       => esc_html__( 'Header Image Overlay Color', 'lovage' ),
        'description' => esc_html__( 'Set the color and opacity for header image overlay', 'lovage' ),
        'section'     => 'header_image', 
        'field'       => 'alpha-color',
        'show_opacity'=> true, 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'default'     => lovage_theme_customizer()->get_default('header_image_overlay_color'),
        'sanitize_callback' => 'lovage_hex_rgba_sanitization',
    ),

    /**
     * Footer Section
     */

    'lovage_footer_layout_section' => array(
       'title'           => esc_html__( 'Footer', 'lovage' ),
       'description'     => esc_html__( 'Manage the site footer style', 'lovage' ),
       'priority'        => 20,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel'			 => 'lovage_layout_panel'
    ),
  

    'footer_widget_layout' => array(
        'title'       => esc_html__( 'Footer Widget Area Layouts', 'lovage' ),
        'description' => esc_html__( 'Choose the global site footer widget area layout.', 'lovage' ),
        'section'     => 'lovage_footer_layout_section', 
        'default'     => lovage_theme_customizer()->get_default('footer_widget_layout'),
        'field'       => 'radio-image', 
        'type'        => 'control',
        'choices'	  => apply_filters('lovage_footer_widget_area_layouts', array(
        	'2' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/bottom-column-2.jpg',
            		'label' => esc_html__('2 Columns', 'lovage')
        		   ),
        	'3' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/bottom-column-3.jpg',
            		'label' => esc_html__('3 Columns', 'lovage')
        		   ),
        	'4' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/bottom-column-4.jpg',
            		'label' => esc_html__('4 Columns', 'lovage')
        		   ),
        	'1/1/2' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/bottom-column-1-1-2.jpg',
            		'label' => esc_html__('1/1/2 Columns', 'lovage')
        		   ),
        	'1/2/1' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/bottom-column-1-2-1.jpg',
            		'label' => esc_html__('1/2/1 Columns', 'lovage')
        		   ),
        	'1/3' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/bottom-column-1-3.jpg',
            		'label' => esc_html__('1/3 Columns', 'lovage')
        		   ),
        	'2/1/1' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/bottom-column-2-1-1.jpg',
            		'label' => esc_html__('2/1/1 Columns', 'lovage')
        		   ),
        	'3/1' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/bottom-column-3-1.jpg',
            		'label' => esc_html__('3/1 Columns', 'lovage')
        		   )
        )),
        'sanitize_callback'    => 'lovage_radio_sanitization', 
    ),

    'site_copyright' => array(
        'title'       => esc_html__( 'Copyright Text', 'lovage' ),
        'description' => esc_html__( 'The copyright text shows in the bottom footer. The content supports <a> <span> <small> <strong> HTML tag.', 'lovage' ),
        'section'     => 'lovage_footer_layout_section', 
        'default'     => lovage_theme_customizer()->get_default('site_copyright'),
        'field'       => 'text', 
        'transport'   => 'postMessage',
        'type'        => 'control',
        'sanitize_callback'    => 'wp_kses_post', 
    ),

    /** 
     * Blog Archive Section 
     */

    'lovage_blog_archive_layout_section' => array(
       'title'           => esc_html__( 'Blog Archive/Category Page', 'lovage' ),
       'priority'        => 10,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel'			 => 'lovage_layout_panel'
    ),

    /* Archive Layout */
    'blog_archive_layout' => array(
        'title'       => esc_html__( 'Blog Archive/Category Layouts', 'lovage' ),
        'description' => esc_html__( 'Choose a layout for all blog archive/category pages.', 'lovage' ),
        'section'     => 'lovage_blog_archive_layout_section', 
        'default'     => lovage_theme_customizer()->get_default('blog_archive_layout'),
        'field'       => 'radio-image', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'choices'	  => apply_filters('lovage_blog_archive_layouts', array(
        	'one-column' => array(
                    'url' => LOVEAGE_INC_URI.'assets/images/one-column.jpg',
                    'label' => esc_html__('One Column', 'lovage')
                   ),
            'left-sidebar' => array(
                    'url' => LOVEAGE_INC_URI.'assets/images/left-sidebar.jpg',
                    'label' => esc_html__('Left Sidebar', 'lovage')
                   ),
            'right-sidebar' => array(
                    'url' => LOVEAGE_INC_URI.'assets/images/right-sidebar.jpg',
                    'label' => esc_html__('Right Sidebar', 'lovage')
                   )
        )),
        'sanitize_callback'    => 'lovage_radio_sanitization', 
    ),

    /** 
     * Single Post Section 
     */

    'lovage_blog_post_layout_section' => array(
       'title'           => esc_html__( 'Blog Post Page', 'lovage' ),
       'priority'        => 10,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel'			 => 'lovage_layout_panel'
    ),

    /* Single Post Layout */
    'blog_post_layout' => array(
        'title'       => esc_html__( 'Single Post Layouts', 'lovage' ),
        'description' => esc_html__( 'Globally choose a layout for all the single posts.', 'lovage' ),
        'section'     => 'lovage_blog_post_layout_section', 
        'default'     => lovage_theme_customizer()->get_default('blog_post_layout'),
        'field'       => 'radio-image', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'choices'	  => apply_filters('lovage_blog_post_layouts', array(
        	'one-column' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/one-column.jpg',
            		'label' => esc_html__('One Column', 'lovage')
        		   ),
        	'left-sidebar' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/left-sidebar.jpg',
            		'label' => esc_html__('Left Sidebar', 'lovage')
        		   ),
        	'right-sidebar' => array(
            		'url' => LOVEAGE_INC_URI.'assets/images/right-sidebar.jpg',
            		'label' => esc_html__('Right Sidebar', 'lovage')
        		   )
        )),
        'sanitize_callback'    => 'lovage_radio_sanitization', 
    ),

    'blog_post_author_card' => array(
        'title'       => esc_html__( 'Show Author Section', 'lovage' ),
        'section'     => 'lovage_blog_post_layout_section', 
        'default'     => lovage_theme_customizer()->get_default('blog_post_author_card'),
        'field'       => 'toggle',
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_switch_sanitization', 
    ),

    'blog_post_related_post' => array(
        'title'       => esc_html__( 'Related Posts Section', 'lovage' ),
        'section'     => 'lovage_blog_post_layout_section', 
        'default'     => lovage_theme_customizer()->get_default('blog_post_related_post'),
        'field'       => 'toggle',
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_switch_sanitization', 
    ),

    'blog_post_related_post_show_by' => array(
        'title'       => esc_html__( 'Related Posts Show By', 'lovage' ),
        'section'     => 'lovage_blog_post_layout_section', 
        'default'     => lovage_theme_customizer()->get_default('blog_post_related_post_show_by'),
        'field'       => 'select',
        'transport'   => 'refresh',
        'choices'	  => array(
        	'related_cat' => esc_html__('Related Category','lovage'),
        	'related_tag' => esc_html__('Related Tag','lovage')
         ),
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_select_sanitization', 
    ),
 );