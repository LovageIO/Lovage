/**
 * Theme Customizer enhancements for a better user experience.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

( function( $ ) {

	var prefix = '_lovage_';

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a, #lovage-header-cover h1' ).html( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description, #lovage-header-cover h2 span' ).html( to );
		} );
	} );

	wp.customize( prefix+'header_title', function( value ) {
		value.bind( function( to ) {
			$( '#lovage-header-cover h1' ).html( to );
			console.log(to);
		} );
	} );

	wp.customize( prefix+'header_subtitle', function( value ) {
		value.bind( function( to ) {
			console.log(to);
			$( '#lovage-header-cover h2 span' ).html( to );
		} );
	} );

	wp.customize( prefix+'site_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .site-info' ).text( to );
		} );
	} );

	wp.customize( prefix+'theme_link_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'theme_link_hover_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a:hover{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'theme_text_color', function( value ){
		value.bind( function( to ){
			$('body, p').css( 'color', to );
		} );
	} );

	wp.customize( prefix+'site_header_color', function( value ){
		value.bind( function( to ){
			$('.site-header').css( 'background-color', to );
		} );
	} );

	wp.customize( prefix+'header_image_height', function( value ){
		value.bind( function( to ){
			$('#lovage-header-cover,.lovage-page-header').css( 'height', parseInt(to) + 'px' );
		} );
	} );

	wp.customize( prefix+'header_image_overlay_color', function( value ){
		value.bind( function( to ){
			$('.lovage-header-image-overlay').css( 'background-color', to );
		} );
	} );

	wp.customize( prefix+'header_image_border_color', function( value ){
		value.bind( function( to ){
			$('#lovage-header-cover:before,.lovage-page-header:before,#lovage-header-cover:after,.lovage-page-header:after').css( 'border-color', to );
		} );
	} );

	wp.customize( prefix+'header_image_text_color', function( value ){
		value.bind( function( to ){
			$('#lovage-header-cover, .lovage-page-header .entry-title, .lovage-page-header a, .lovage-breadcrumbs a, .lovage-breadcrumbs i').css( 'color', to );
		} );
	} );

	wp.customize( prefix+'site_title_color', function( value ){
		value.bind( function( to ){
			$('.site-header .site-branding .site-title, .site-header .site-branding .site-title a').css( 'color', to );
		} );
	} );

	wp.customize( prefix+'navigation_menu_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>.site-header .main-navigation, .site-header .main-navigation ul li a, .site-header #site-icons a{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'navigation_menu_hover_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>.site-header .main-navigation ul li a:hover{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'footer_color', function( value ){
		value.bind( function( to ){
			$('.site-bottom, .site-footer').css( 'background-color', to );
		} );
	} );

	wp.customize( prefix+'footer_text_color', function( value ){
		value.bind( function( to ){
			$('.site-bottom, .site-footer').css( 'color', to );
		} );
	} );

	wp.customize( prefix+'footer_link_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>.site-bottom a, .site-footer a{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'footer_link_hover_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>.site-footer a:hover, .site-bottom a:hover{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'blog_title_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>.post .entry-title, .post .entry-title a{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'blog_title_hover_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>.post .entry-title a:hover{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'theme_excerpt_color', function( value ){
		value.bind( function( to ){
			$('.post .entry-excerpt').css( 'color', to );
		} );
	} );

	wp.customize( prefix+'header_border', function( value ){
		value.bind( function( to ){
			$('.site-header').css( 'border-color', to );
		} );
	} );

	wp.customize( prefix+'button_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{background-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'button_border_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{border-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'button_text_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'button_radius', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{border-radius: '+to+'px}</style>');
		} );
	} );

	wp.customize( prefix+'button_border_width', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a.lovage-button, .lovage-button, input[type="submit"], input[type="reset"], button{border-width: '+to+'px}</style>');
		} );
	} );

	wp.customize( prefix+'button_hover_border_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a.lovage-button:hover, .lovage-button:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover{border-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'button_hover_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a.lovage-button:hover, .lovage-button:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover{background-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'button_hover_text_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>a.lovage-button:hover, .lovage-button:hover, input[type="submit"]:hover, input[type="reset"]:hover, button:hover{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'text_field_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>input[type="text"],input[type="email"],input[type="password"],input[type="number"]{background-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'text_field_border_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>input[type="text"],input[type="email"],input[type="password"],input[type="number"]{border-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'text_field_text_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>input[type="text"],input[type="email"],input[type="password"],input[type="number"]{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'text_field_radius', function( value ){
		value.bind( function( to ){
			$('head').append( '<style>input[type="text"],input[type="email"],input[type="password"],input[type="number"],.lovage-search{border-radius: '+to+'px;}</style>' );
		} );
	} );

	wp.customize( prefix+'text_field_border_width', function( value ){
		value.bind( function( to ){
			$('head').append( '<style>input[type="text"],input[type="email"],input[type="password"],input[type="number"],.lovage-search{border-width: '+to+'px;}</style>' );
		} );
	} );

	wp.customize( prefix+'text_field_focus_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>input[type="text"]:focus,input[type="email"]:focus,input[type="password"]:focus,input[type="number"]:focus{background-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'text_field_focus_text_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>input[type="text"]:focus,input[type="email"]:focus,input[type="password"]:focus,input[type="number"]:focus{color:'+to+'}</style>');
		} );
	} );


	wp.customize( prefix+'text_field_focus_border_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>input[type="text"]:focus,input[type="email"]:focus,input[type="password"]:focus,input[type="number"]:focus{border-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'textarea_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>textarea{background-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'textarea_border_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>textarea{border-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'textarea_text_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>textarea{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'textarea_radius', function( value ){
		value.bind( function( to ){
					console.log(to);
			$('head').append('<style>textarea{border-radius:'+to+'px;}');
		} );
	} );

	wp.customize( prefix+'textarea_border_width', function( value ){
		value.bind( function( to ){
			$('head').append('<style>textarea{border-width:'+to+'px;}');
		} );
	} );

	wp.customize( prefix+'textarea_focus_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>textarea:focus{background-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'textarea_focus_text_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>textarea:focus{color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'textarea_focus_border_color', function( value ){
		value.bind( function( to ){
			$('head').append('<style>textarea:focus{border-color:'+to+'}</style>');
		} );
	} );

	wp.customize( prefix+'home_container_mode', function( value ){
		value.bind( function( to ){
			if(to === 'boxed'){
				$('body.home').addClass('lovage-boxed-container');
				$('#body-container').css('width', '90%');
				$('#masthead.sticky-header').css({
	              width: '90%',
	              left:  '50%',
	              marginLeft: '-45%',
	            });
		    }else{
		    	$('body.home').removeClass('lovage-boxed-container');
		    	$('#body-container').removeAttr('style');
		    	$('#masthead.sticky-header').removeAttr('style');
		    }
		} );
	} );

	wp.customize( prefix+'blog_archive_container_mode', function( value ){
		value.bind( function( to ){
			if(to === 'boxed'){
				$('body.home').addClass('lovage-boxed-container');
				$('#body-container').css('width', '90%');
				$('#masthead.sticky-header').css({
	              width: '90%',
	              left:  '50%',
	              marginLeft: '-45%',
	            });
		    }else{
		    	$('body.home').removeClass('lovage-boxed-container');
		    	$('#body-container').removeAttr('style');
		    	$('#masthead.sticky-header').removeAttr('style');
		    }
		} );
	} );

	wp.customize( prefix+'post_container_mode', function( value ){
		value.bind( function( to ){
			if(to === 'boxed'){
				$('body.home').addClass('lovage-boxed-container');
				$('#body-container').css('width', '90%');
				$('#masthead.sticky-header').css({
	              width: '90%',
	              left:  '50%',
	              marginLeft: '-45%',
	            });
		    }else{
		    	$('body.home').removeClass('lovage-boxed-container');
		    	$('#body-container').removeAttr('style');
		    	$('#masthead.sticky-header').removeAttr('style');
		    }
		} );
	} );

	wp.customize( prefix+'search_container_mode', function( value ){
		value.bind( function( to ){
			if(to === 'boxed'){
				$('body.home').addClass('lovage-boxed-container');
				$('#body-container').css('width', '90%');
				$('#masthead.sticky-header').css({
	              width: '90%',
	              left:  '50%',
	              marginLeft: '-45%',
	            });
		    }else{
		    	$('body.home').removeClass('lovage-boxed-container');
		    	$('#body-container').removeAttr('style');
		    	$('#masthead.sticky-header').removeAttr('style');
		    }
		} );
	} );

	wp.customize( prefix+'author_container_mode', function( value ){
		value.bind( function( to ){
			if(to === 'boxed'){
				$('body.home').addClass('lovage-boxed-container');
				$('#body-container').css('width', '90%');
				$('#masthead.sticky-header').css({
	              width: '90%',
	              left:  '50%',
	              marginLeft: '-45%',
	            });
		    }else{
		    	$('body.home').removeClass('lovage-boxed-container');
		    	$('#body-container').removeAttr('style');
		    	$('#masthead.sticky-header').removeAttr('style');
		    }
		} );
	} );

	wp.customize( prefix+'404_container_mode', function( value ){
		value.bind( function( to ){
			if(to === 'boxed'){
				$('body.home').addClass('lovage-boxed-container');
				$('#body-container').css('width', '90%');
				$('#masthead.sticky-header').css({
	              width: '90%',
	              left:  '50%',
	              marginLeft: '-45%',
	            });
		    }else{
		    	$('body.home').removeClass('lovage-boxed-container');
		    	$('#body-container').removeAttr('style');
		    	$('#masthead.sticky-header').removeAttr('style');
		    }
		} );
	} );

	wp.customize( prefix+'header_layout', function( value ){
		value.bind( function( to ){
			$("#masthead").removeClass (function (index, className) {
			    return (className.match (/(^|\s)lovage-\S+/g) || []).join(' ');
			});
			$('.site-header').addClass('lovage-'+to);
		} );
	} );

	wp.customize( prefix+'header_border_color', function( value ){
		value.bind( function( to ){
			$('.site-header').css( 'border-color', to );
		} );
	} );

	wp.customize( prefix+'menu_button', function( value ){
		value.bind( function( to ){
			if(to){
			  $('.site-header .site-icons').show();
			  $('.main-navigation').removeClass('lovage-col7');
			  $('.main-navigation').addClass('lovage-col10');
			  $('.main-navigation').addClass('last');
		    }else{
		      $('.site-header .site-icons').hide();
		      $('.main-navigation').removeClass('lovage-col10');
		      $('.main-navigation').removeClass('last');
		      $('.main-navigation').addClass('lovage-grid lovage-col7');
		    }
		} );
	} );
	
} )( jQuery );
