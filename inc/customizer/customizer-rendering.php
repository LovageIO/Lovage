<?php
/**
 * Render the customizer settings
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

/**
 * Rendering Customizer CSS
 */
function lovage_customizer_css_render(){

	$css = [];

	if(lovage_theme_customizer()->value('theme_link_color') !== lovage_theme_customizer()->defaults['theme_link_color']){
		$css[] = 'a{
			color: '.lovage_theme_customizer()->value('theme_link_color').';
		}';
	}

	if(lovage_theme_customizer()->value('theme_link_hover_color') !== lovage_theme_customizer()->defaults['theme_link_hover_color']){
		$css[] = 'a:hover, .related-posts .grids .item a:hover, .entry-header .post-categories li a:hover, .post-navigation a:hover, .site-bottom .bottom-widget .widget li a:hover, .site-footer a:hover, .widget li a:hover{
			color: '.lovage_theme_customizer()->value('theme_link_hover_color').';
		}';
	}

	if(lovage_theme_customizer()->value('theme_text_color') !== lovage_theme_customizer()->defaults['theme_text_color']){
		$css[] = 'body, p{
			color: '.lovage_theme_customizer()->value('theme_text_color').';
		}';
	}

	if(lovage_theme_customizer()->value('site_header_color') !== lovage_theme_customizer()->defaults['site_header_color']){
		$css[] = '.site-header, .site-header.sticky-header{
			background: '.lovage_theme_customizer()->value('site_header_color').';
		}';
	}

	if(lovage_theme_customizer()->value('header_border_color') !== lovage_theme_customizer()->defaults['header_border_color']){
		$css[] = '.site-header, .site-header.sticky-header{
			border-color: '.lovage_theme_customizer()->value('header_border_color').';
		}';
	}

	if(lovage_theme_customizer()->value('site_title_color') !== lovage_theme_customizer()->defaults['site_title_color']){
		$css[] = '.site-header .site-branding .site-title, .site-header .site-branding .site-title a, .site-header #site-icons a{
			color: '.lovage_theme_customizer()->value('site_title_color').';
		}';
	}

	if(lovage_theme_customizer()->value('navigation_menu_color') !== lovage_theme_customizer()->defaults['navigation_menu_color']){
		$css[] = '.main-navigation ul li a{
			color: '.lovage_theme_customizer()->value('navigation_menu_color').';
		}';
	}

	if(lovage_theme_customizer()->value('navigation_menu_hover_color') !== lovage_theme_customizer()->defaults['navigation_menu_hover_color']){
		$css[] = '.main-navigation ul li a:hover{
			color: '.lovage_theme_customizer()->value('navigation_menu_hover_color').';
		}';
	}

	if(lovage_theme_customizer()->value('footer_color') !== lovage_theme_customizer()->defaults['footer_color']){
		$css[] = '.site-footer, .site-bottom{
			background-color: '.lovage_theme_customizer()->value('footer_color').';
		}';
	}

	if(lovage_theme_customizer()->value('footer_text_color') !== lovage_theme_customizer()->defaults['footer_text_color']){
		$css[] = '.site-footer, .site-bottom{
			color: '.lovage_theme_customizer()->value('footer_text_color').';
		}';
	}

	if(lovage_theme_customizer()->value('footer_link_color') !== lovage_theme_customizer()->defaults['footer_link_color']){
		$css[] = '.site-footer a, .site-bottom a{
			color: '.lovage_theme_customizer()->value('footer_link_color').';
		}';
	}

	if(lovage_theme_customizer()->value('footer_link_hover_color') !== lovage_theme_customizer()->defaults['footer_link_hover_color']){
		$css[] = '.site-footer a:hover, .site-bottom a:hover{
			color: '.lovage_theme_customizer()->value('footer_link_hover_color').';
		}';
	}

	if(lovage_theme_customizer()->value('blog_title_color') !== lovage_theme_customizer()->defaults['blog_title_color']){
		$css[] = '.post .entry-title, .post .entry-title a{
			color: '.lovage_theme_customizer()->value('blog_title_color').';
		}';
	}

	if(lovage_theme_customizer()->value('blog_title_hover_color') !== lovage_theme_customizer()->defaults['blog_title_hover_color']){
		$css[] = '.post .entry-title a:hover{
			color: '.lovage_theme_customizer()->value('blog_title_hover_color').';
		}';
	}

	if(lovage_theme_customizer()->value('theme_excerpt_color') !== lovage_theme_customizer()->defaults['theme_excerpt_color']){
		$css[] = '.post .entry-excerpt{
			color: '.lovage_theme_customizer()->value('theme_excerpt_color').';
		}';
	}

	if(lovage_theme_customizer()->value('site_title_typography') !== lovage_theme_customizer()->defaults['site_title_typography']){
		$css[] = '.site-header .site-branding .site-title{
			font-family: '.lovage_theme_customizer()->typography("site_title_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("site_title_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("site_title_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("site_title_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("site_title_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("site_title_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('navigation_menu_typography') !== lovage_theme_customizer()->defaults['navigation_menu_typography']){
		$css[] = '.site-header .main-navigation ul li a{
			font-family: '.lovage_theme_customizer()->typography("navigation_menu_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("navigation_menu_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("navigation_menu_typography","font_size").';
			letter-spacing: '.lovage_theme_customizer()->typography("navigation_menu_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("navigation_menu_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('site_paragraph_typography') !== lovage_theme_customizer()->defaults['site_paragraph_typography']){
		$css[] = 'body, p{
			font-family: '.lovage_theme_customizer()->typography("site_paragraph_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("site_paragraph_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("site_paragraph_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("site_paragraph_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("site_paragraph_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("site_paragraph_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('h1_typography') !== lovage_theme_customizer()->defaults['h1_typography']){
		$css[] = 'h1{
			font-family: '.lovage_theme_customizer()->typography("h1_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("h1_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("h1_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("h1_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("h1_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("h1_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('h2_typography') !== lovage_theme_customizer()->defaults['h2_typography']){
		$css[] = 'h2{
			font-family: '.lovage_theme_customizer()->typography("h2_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("h2_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("h2_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("h2_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("h2_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("h2_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('h3_typography') !== lovage_theme_customizer()->defaults['h3_typography']){
		$css[] = 'h3{
			font-family: '.lovage_theme_customizer()->typography("h3_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("h3_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("h3_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("h3_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("h3_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("h3_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('h4_typography') !== lovage_theme_customizer()->defaults['h4_typography']){
		$css[] = 'h4{
			font-family: '.lovage_theme_customizer()->typography("h4_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("h4_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("h4_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("h4_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("h4_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("h4_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('h5_typography') !== lovage_theme_customizer()->defaults['h5_typography']){
		$css[] = 'h5{
			font-family: '.lovage_theme_customizer()->typography("h5_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("h5_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("h5_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("h5_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("h5_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("h5_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('h6_typography') !== lovage_theme_customizer()->defaults['h6_typography']){
		$css[] = 'h6{
			font-family: '.lovage_theme_customizer()->typography("h6_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("h6_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("h6_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("h6_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("h6_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("h6_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('standard_blog_title_typography') !== lovage_theme_customizer()->defaults['standard_blog_title_typography']){
		$css[] = '..single h1.entry-title, h2.entry-title{
			font-family: '.lovage_theme_customizer()->typography("standard_blog_title_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("standard_blog_title_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("standard_blog_title_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("standard_blog_title_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("standard_blog_title_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("standard_blog_title_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('widget_title_typography') !== lovage_theme_customizer()->defaults['widget_title_typography']){
		$css[] = '.widget .widget-title{
			font-family: '.lovage_theme_customizer()->typography("widget_title_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("widget_title_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("widget_title_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("widget_title_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("widget_title_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("widget_title_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('widget_content_typography') !== lovage_theme_customizer()->defaults['widget_content_typography']){
		$css[] = '.widget{
			font-family: '.lovage_theme_customizer()->typography("widget_content_typography","font_family").';
			font-weight: '.lovage_theme_customizer()->typography("widget_content_typography","font_weight").';
			font-size: '.lovage_theme_customizer()->typography("widget_content_typography","font_size").';
			line-height: '.lovage_theme_customizer()->typography("widget_content_typography","line_height").';
			letter-spacing: '.lovage_theme_customizer()->typography("widget_content_typography","letter_spacing").';
			text-transform: '.lovage_theme_customizer()->typography("widget_content_typography","text_transform").';
		}';
	}

	if(lovage_theme_customizer()->value('button_color') !== lovage_theme_customizer()->defaults['button_color']){
		$css[] = 'a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{
			background-color: '.lovage_theme_customizer()->value('button_color').';
		}';
	}

	if(lovage_theme_customizer()->value('button_border_color') !== lovage_theme_customizer()->defaults['button_border_color']){
		$css[] = 'a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{
			border-color: '.lovage_theme_customizer()->value('button_border_color').';
		}';
	}

	if(lovage_theme_customizer()->value('button_text_color') !== lovage_theme_customizer()->defaults['button_text_color']){
		$css[] = 'a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{
			color: '.lovage_theme_customizer()->value('button_text_color').';
		}';
	}

	if(lovage_theme_customizer()->value('button_radius') !== lovage_theme_customizer()->defaults['button_radius']){
		$css[] = 'a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{
			border-radius: '.lovage_theme_customizer()->value('button_radius').'px;
		}';
	}

	if(lovage_theme_customizer()->value('button_border_width') !== lovage_theme_customizer()->defaults['button_border_width']){
		$css[] = 'a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{
			border-width: '.lovage_theme_customizer()->value('button_border_width').'px;
		}';
	}

	if(lovage_theme_customizer()->value('button_hover_color') !== lovage_theme_customizer()->defaults['button_hover_color']){
		$css[] = 'a.lovage-button:hover, .lovage-button:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover{
			background-color: '.lovage_theme_customizer()->value('button_hover_color').';
		}';
	}

	if(lovage_theme_customizer()->value('button_hover_border_color') !== lovage_theme_customizer()->defaults['button_hover_border_color']){
		$css[] = 'a.lovage-button:hover, .lovage-button:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover{
			border-color: '.lovage_theme_customizer()->value('button_hover_border_color').';
		}';
	}

	if(lovage_theme_customizer()->value('button_hover_text_color') !== lovage_theme_customizer()->defaults['button_hover_text_color']){
		$css[] = 'a.lovage-button:hover, .lovage-button:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover{
			color: '.lovage_theme_customizer()->value('button_hover_text_color').';
		}';
	}

	if(lovage_theme_customizer()->value('text_field_color') !== lovage_theme_customizer()->defaults['text_field_color']){
		$css[] = 'input[type="text"],input[type="email"],input[type="password"],input, .lovage-search[type="number"]{
			background-color: '.lovage_theme_customizer()->value('text_field_color').';
		}';
	}

	if(lovage_theme_customizer()->value('text_field_border_color') !== lovage_theme_customizer()->defaults['text_field_border_color']){
		$css[] = 'input[type="text"],input[type="email"],input[type="password"],input[type="number"], .lovage-search{
			border-color: '.lovage_theme_customizer()->value('text_field_border_color').';
		}';
	}

	if(lovage_theme_customizer()->value('text_field_text_color') !== lovage_theme_customizer()->defaults['text_field_text_color']){
		$css[] = 'input[type="text"],input[type="email"],input[type="password"],input[type="number"] .lovage-search{
			color: '.lovage_theme_customizer()->value('text_field_text_color').';
		}';
	}

	if(lovage_theme_customizer()->value('text_field_radius') !== lovage_theme_customizer()->defaults['text_field_radius']){
		$css[] = 'input[type="text"],input[type="email"],input[type="password"],input[type="number"] .lovage-search{
			border-radius: '.lovage_theme_customizer()->value('text_field_radius').'px;
		}';
	}

	if(lovage_theme_customizer()->value('text_field_border_width') !== lovage_theme_customizer()->defaults['text_field_border_width']){
		$css[] = 'input[type="text"],input[type="email"],input[type="password"],input[type="number"] .lovage-search{
			border-width: '.lovage_theme_customizer()->value('text_field_border_width').'px;
		}';
	}

	if(lovage_theme_customizer()->value('text_field_focus_color') !== lovage_theme_customizer()->defaults['text_field_focus_color']){
		$css[] = 'input[type="text"]:focus,input[type="email"]:focus,input[type="password"]:focus,input[type="number"]:focus{
			background-color: '.lovage_theme_customizer()->value('text_field_focus_color').';
		}';
	}

	if(lovage_theme_customizer()->value('text_field_focus_border_color') !== lovage_theme_customizer()->defaults['text_field_focus_border_color']){
		$css[] = 'input[type="text"]:focus,input[type="email"]:focus,input[type="password"]:focus,input[type="number"]:focus{
			border-color: '.lovage_theme_customizer()->value('text_field_focus_color').';
		}';
	}

	if(lovage_theme_customizer()->value('text_field_focus_text_color') !== lovage_theme_customizer()->defaults['text_field_focus_text_color']){
		$css[] = 'input[type="text"]:focus,input[type="email"]:focus,input[type="password"]:focus,input[type="number"]:focus{
			color: '.lovage_theme_customizer()->value('text_field_focus_color').';
		}';
	}

	if(lovage_theme_customizer()->value('textarea_color') !== lovage_theme_customizer()->defaults['textarea_color']){
		$css[] = 'textarea{
			background-color: '.lovage_theme_customizer()->value('textarea_color').';
		}';
	}

	if(lovage_theme_customizer()->value('textarea_border_color') !== lovage_theme_customizer()->defaults['textarea_border_color']){
		$css[] = 'textarea{
			border-color: '.lovage_theme_customizer()->value('textarea_border_color').';
		}';
	}

	if(lovage_theme_customizer()->value('textarea_text_color') !== lovage_theme_customizer()->defaults['textarea_text_color']){
		$css[] = 'textarea{
			color: '.lovage_theme_customizer()->value('textarea_text_color').';
		}';
	}

	if(lovage_theme_customizer()->value('textarea_radius') !== lovage_theme_customizer()->defaults['textarea_radius']){
		$css[] = 'textarea{
			border-radius: '.lovage_theme_customizer()->value('textarea_radius').'px;
		}';
	}

	if(lovage_theme_customizer()->value('textarea_border_width') !== lovage_theme_customizer()->defaults['textarea_border_width']){
		$css[] = 'textarea{
			border-width: '.lovage_theme_customizer()->value('textarea_border_width').'px;
		}';
	}

	if(lovage_theme_customizer()->value('textarea_focus_color') !== lovage_theme_customizer()->defaults['textarea_focus_color']){
		$css[] = 'textarea:focus{
			background-color: '.lovage_theme_customizer()->value('textarea_focus_color').';
		}';
	}

	if(lovage_theme_customizer()->value('textarea_focus_border_color') !== lovage_theme_customizer()->defaults['textarea_focus_border_color']){
		$css[] = 'textarea:focus{
			border-color: '.lovage_theme_customizer()->value('textarea_focus_border_color').';
		}';
	}

	if(lovage_theme_customizer()->value('textarea_focus_text_color') !== lovage_theme_customizer()->defaults['textarea_focus_text_color']){
		$css[] = 'textarea:focus{
			color: '.lovage_theme_customizer()->value('textarea_focus_text_color').';
		}';
	}

	if(has_header_image() && lovage_theme_customizer()->value('header_image_height') !== lovage_theme_customizer()->defaults['header_image_height']){
		$css[] = '#lovage-header-cover,.lovage-page-header{
			 height: '.lovage_theme_customizer()->value('header_image_height').'px;
		}';
    }

    if(has_header_image() && lovage_theme_customizer()->value('header_image_text_color') !== lovage_theme_customizer()->defaults['header_image_text_color']){
		$css[] = '#lovage-header-cover,.lovage-page-header, .lovage-page-header .entry-title, .lovage-page-header a, .lovage-page-header .lovage-breadcrumbs a{
			 color: '.lovage_theme_customizer()->value('header_image_text_color').';
		}';
    }

    if(has_header_image() && lovage_theme_customizer()->value('header_image_border_color') !== lovage_theme_customizer()->defaults['header_image_border_color']){
		$css[] = '#lovage-header-cover h2:before,.lovage-page-header h2:before,#lovage-header-cover h2:after,.lovage-page-header h2:after{
			 border-color: '.lovage_theme_customizer()->value('header_image_border_color').';
		}';
    }

    if(has_header_image() && lovage_theme_customizer()->value('header_image_overlay_color') !== lovage_theme_customizer()->defaults['header_image_overlay_color']){
		$css[] = '.lovage-header-image-overlay{
			 background-color: '.lovage_theme_customizer()->value('header_image_overlay_color').';
		}';
    }

	$css = implode('', apply_filters( 'lovage_customizer_rendered_css', $css) );

	$compressed_css = str_replace('; ',';',str_replace(' }','}',str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$css)))));
	
	wp_add_inline_style('lovage', $compressed_css);
}
add_action('wp_enqueue_scripts','lovage_customizer_css_render', 1000);

/**
 * Rendering Head Codes
 */
function lovage_headcode_render(){
	echo stripslashes(lovage_theme_customizer()->value('head_codes')).PHP_EOL;
}
add_action('wp_head','lovage_headcode_render');

/**
 * Rendering Footer Codes
 */
function lovage_footercode_render(){
	echo stripslashes(lovage_theme_customizer()->value('footer_codes')).PHP_EOL;
}
add_action('wp_footer','lovage_footercode_render');

/**
 * Import Google Fonts
 */
function lovage_customizer_google_fonts(){
	$font_families = array();

	$default_font = '-apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif';

	$font_settings = array(
		'site_title_typography',
		'navigation_menu_typography',
		'site_paragraph_typography',
		'h1_typography',
		'h2_typography',
		'h3_typography',
		'h4_typography',
		'h5_typography',
		'h6_typography',
		'widget_title_typography',
		'widget_content_typography'
	);

	foreach( $font_settings as $font ){
		if( lovage_theme_customizer()->value($font) == $default_font && lovage_theme_customizer()->value($font) !== lovage_theme_customizer()->defaults[$font] ){
		    $font_families[] = lovage_theme_customizer()->typography($font,'font_family').':'.lovage_theme_customizer()->typography($font,'font_weight');
	    }
	}

	$query_args = array(
		            'family' => urlencode( implode( '|', $font_families ) ),
		            'subset' => urlencode( 'latin,latin-ext,vietnamese,cyrillic-ext,cyrillic,greek,greek-ext' ),
		        );
		 
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	if(count($font_families) > 0){
	   wp_enqueue_style( 'lovage-customizer-google-fonts', esc_url_raw( $fonts_url ), array(), null );
	}
}
add_action('wp_enqueue_scripts','lovage_customizer_google_fonts');

