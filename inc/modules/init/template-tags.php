<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0.5
 */


if ( ! function_exists( 'lovage_header_class' ) ) {
	/**
	 * Header Class
	 */
	function lovage_header_class(){
		 
		  $sticky_header = '';

		  $header_class = 'class="site-header lovage-' . esc_attr( lovage_theme_customizer()->value( 'header_layout' ) ) . '"';
	      echo wp_kses_post( $header_class );
	}
}


if ( ! function_exists( 'lovage_page_header' ) ) {
	/**
	 * Page Header
	 */
	function lovage_page_header(){

		if( is_home() || is_front_page() || is_single() ){
			return;
		}

		if( is_page() && lovage_is_fullwidth() ){
			return;
		}

		if( is_page_template('page-templates/blog-page-template.php') 
			|| is_page_template('page-templates/fullwidth-page-template.php')  
			|| is_page_template('elementor_canvas') 
			|| is_page_template('elementor_header_footer')
		){
			return;
		}

		global $post;

		$text_alignment = 'center';

		$header_image = has_header_image() ? 'style="background-image:url('.esc_url(get_header_image()).'); background-size: cover;"' : '';

		echo '<header id="lovage-header-cover" class="lovage-page-header '. esc_attr( $text_alignment ).'" '.wp_kses_post( $header_image ).'>
		 		<div class="lovage-grid-1140">';
		 		    
		 		    if( is_page() ){
		 		    	echo '<h1 class="entry-title">'.esc_html( get_the_title( $post->ID ) ).'</h1>';
		 		    }

		 		    if( is_tax() || is_category() || is_tag() ){
		 		    	echo '<h1 class="entry-title">'.single_term_title( '', false ).'</h1>';
		 		    }

		 		    if( is_search() && function_exists('is_shop') && !is_shop() ){
		 		    	echo '<h1 class="entry-title">'.esc_html__('Search Results For', 'lovage').' '. isset( $_GET['s'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_GET['s'] ) ) ) : '' . '</h1>';
		 		    }

		 		    if( is_404() ){
		 		    	echo '<h1 class="entry-title">'.esc_html__('404', 'lovage').'</h1>';
		 		    }

					if( function_exists('is_shop') && is_shop() ){
						echo '<h1 class="entry-title">'. esc_html( woocommerce_page_title( false ) ).'</h1>';
					}

					if ( class_exists( 'woocommerce' ) ){
					    woocommerce_breadcrumb();
					}else{
					    lovage_breadcrumbs();
					}
				echo '<div class="lovage-header-image-overlay"></div>'; 
		  echo '</div>
			  </header>';
	}
}


if ( ! function_exists( 'lovage_site_header_image' ) ) {
	
	/**
	 * Site Header Image
	 */
	function lovage_site_header_image(){
		global $post;
		$render = '';

		do_action('lovage_before_output_header_image');

		if(is_home() || is_front_page()){

		  $page_template = get_post_meta($post->ID, '_lovage_page_layout', true);

		  if($page_template == 'fullwidth'){
		  	 return;
		  }

		  if(is_page_template('elementor_header_footer') || is_page_template('elementor_canvas')){
		  	 return;
		  }

		  if(has_header_image()){

		  	 $title = lovage_theme_customizer()->value('header_title') !== '' 
		  	 			? lovage_theme_customizer()->value('header_title')
						: get_bloginfo('name');
			
			 $subtitle = lovage_theme_customizer()->value('header_subtitle') !== '' 
			 			? lovage_theme_customizer()->value('header_subtitle')
						: get_bloginfo('description');

			 $render .= '<div id="lovage-header-cover" style="background-image:url('.esc_url(get_header_image()).');background-size: cover;">';
						  if(null == get_theme_mod('header_text') || get_theme_mod('header_text') == 1){
							 $render .= '<h1>'.wp_kses_post($title).'</h1>
							  <h2><span>'.wp_kses_post($subtitle).'</span></h2>';
						  }
						$render .= '<div class="lovage-header-image-overlay"></div>
				   	   </div>';
	   	  }
	    }
	    echo wp_kses_post( $render );

	    do_action('lovage_after_output_header_image');
	}
}


if ( ! function_exists( 'lovage_before_content' ) ) {
	/**
	 * Before Content
	 */
	function lovage_before_content(){
	    
		if( is_page() && is_page_template( 'page-templates/fullwidth-page-template.php' ) ) {
			 $width = 'fullwidth';
			 return;
		}

		global $post;

		$width = $GLOBALS['lovage_content_width'];
	    
		if( ! is_search() && !is_404() ){

			if( ! is_page_template( 'page-templates/fullwidth-template.php' ) && is_singular( apply_filters( 'lovage_post_type_content_width', array( 'post', 'page', 'attachment' ) ) ) && ! lovage_is_woocommerce_page() ){

			  if( get_post_meta($post->ID, '_lovage_page_layout', true) == 'one-column'){
			       $width = 800;
			  }elseif(get_post_meta($post->ID, '_lovage_page_layout', true) == 'default' || get_post_meta($post->ID, '_lovage_page_layout', true) == null ){

			  	 if(null == lovage_theme_customizer()->value('blog_post_layout') || lovage_theme_customizer()->value('blog_post_layout') == 'one-column'){
			  	    $width = 800;
			  	 }else{
			  	 	$width = 1140;
			  	 }
			  }else{
			  	 $width = 1140;
			  }
			  
			}

		}

		echo '<div id="page" class="hfeed site lovage-grid-' . esc_attr( $width ) . '">
		  		 <div id="content" class="site-content" tabindex="-1">';
	}
}


if ( ! function_exists( 'lovage_after_content' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 */
	function lovage_after_content(){
		echo '</div>
		   </div>';
	}
}


if ( ! function_exists( 'lovage_before_main_content' ) ) {
	/**
	 * Before Main Content
	 */
	function lovage_before_main_content(){
		echo '<main id="primary" class="lovage-grid lovage-col9 site-main">';
	}
}


if ( ! function_exists( 'lovage_after_main_content' ) ) {
	/**
	 * After Main Content
	 */
	function lovage_after_main_content(){
		echo '</main>';
	}
}


if ( ! function_exists( 'lovage_after_conent' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 */
	function lovage_after_conent(){
		echo '</div>
		   </div>';
	}
}


if ( ! function_exists( 'lovage_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function lovage_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = esc_html__( 'Posted on', 'lovage' ) . ' ' .
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . wp_kses_post( $time_string ) . '</a>';

		$byline = esc_html__( 'by', 'lovage' ) . ' ' .
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		echo '<span class="posted-on">' . wp_kses_post( $posted_on ) . '</span><span class="byline">' . wp_kses_post( $byline ) . '</span>'; 

	}
}


if ( ! function_exists( 'lovage_page_custom_logo' ) ) {
	/**
	 * Custom LOGO for each page
	 */
	function lovage_page_custom_logo(){
		global $post;
		$logo='';
		while ( have_posts() ) : the_post(); 
	     $logo = esc_url(get_post_meta( $post->ID, '_lovage_custom_logo', true ));
	    endwhile; // End of the loop. 
	    
	    return $logo;
	}
}


if ( ! function_exists( 'lovage_custom_logo' ) ) {
	/**
	 * Custom LOGO and Text
	 */
	function lovage_custom_logo(){
	        
	        $logo_url = esc_url(wp_get_attachment_url(get_theme_mod( 'custom_logo')));
	        $page_logo_url = lovage_page_custom_logo();
	        $logo_wrapper_class = '';
	        
	        if( $page_logo_url !== '' && isset($page_logo_url) ){
	           $logo_url = $page_logo_url;
	        }
		    if (!empty($logo_url) && $logo_url<>'' ) {
		    	$logo_wrapper_class = 'site-branding-logo';
				$custom_logo = '<img id="site-logo" src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( get_bloginfo('name') ) . '" />';
		    } else { 
			   $custom_logo = esc_html( get_bloginfo('name') );
			}
			
			$render = '<div class="site-branding lovage-grid lovage-col2 '.$logo_wrapper_class.'">';
				if ( is_front_page() && is_home() ){
					$render .= '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">' . wp_kses_post( $custom_logo ) . '</a></h1>';
				}else{
					$render .= '<span class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">' . wp_kses_post( $custom_logo ) . '</a></span>';
				}
			$render .= '</div><!-- .site-branding -->';

			echo wp_kses_post( $render );
	}
}


if ( ! function_exists( 'lovage_primary_navigation' ) ) {
	/**
	 * Primary Navigation
	 */
	function lovage_primary_navigation(){
		global $post;
		$nav_grid_class='';
		$menu_slug = '';
		$render = '';
	    
	    if(lovage_theme_customizer()->value('menu_buttons') == 1){
	    	$nav_grid_class='lovage-grid lovage-col8';
	    }else{
	    	$nav_grid_class='lovage-grid lovage-col10 last';
	    }
	    
	    if(is_singular()){
			$menu_slug = get_post_meta( $post->ID, '_lovage_custom_page_menu', true );
	    }


       $render = '<nav id="site-navigation" role="navigation" aria-label="' . esc_html__( 'Main navigation', 'lovage' ) . '" class="main-navigation ' . esc_attr( $nav_grid_class ) . '">
       		<a id="close-menu">&times;</a>'
		. wp_nav_menu( array( 
			'theme_location' => 'primary', 
			'menu' => esc_html( $menu_slug ),
			'menu_id' => 'primary-menu',
			'echo' => false ) 
		) .
	   '</nav><!-- #site-navigation -->';
	    
	    echo wp_kses_post( $render );
	}
}


if ( ! function_exists( 'lovage_menu_buttons' ) ){
	/**
	 * Top Buttons in Navigation
	 */
	function lovage_menu_buttons(){
		if(lovage_theme_customizer()->value('menu_buttons') == 1){
		  
		  echo'<div id="site-icons" class="lovage-grid lovage-col2 last">';
		 
		  if ( class_exists( 'woocommerce' ) ){
		  	   $status = '';
		  	   $cart_number=WC()->cart->get_cart_contents_count();
		  	   if(WC()->cart->get_cart_contents_count() == 0){
		  	     	$cart_number = '0';
		  	   }
		  	   if(intval($cart_number) > 0){
		  	   	 $status = 'show';
		  	   }

			   echo'<a href="'.esc_url( home_url('/') ).'?page_id='.esc_attr( get_option('woocommerce_myaccount_page_id') ).'"><i class="lovage-icon lovage-icon-user"></i></a>
					<a href="javascript:void(0);" id="lovage-cart-button"><i class="lovage-icon lovage-icon-cart"></i>
					  <span id="cart_tip" class="cart_tip '.esc_attr( $status ).'">'.absint( $cart_number ).'</span>
					</a>';
			   lovage_popup_content( 'cart' );
		  }

		      echo '<a href="javascript:void(0);" id="lovage-search-button"><i class="lovage-icon lovage-icon-search"></i></a>';
		      lovage_popup_content( 'search' );
		      
		      echo '<a href="javascript:void(0);" id="lovage-menu-button" class="mini-menu"><i class="lovage-icon lovage-icon-menu"></i></a>';
	      echo '</div>';
		}
	}
}

if ( ! function_exists( 'lovage_popup_content' ) ) {
	/**
	 * Popup Content
	 */
	function lovage_popup_content( $id ) {
		set_query_var( 'popup_id', $id );
		get_template_part( 'template-parts/content', 'popup' );
	}
}

if ( ! function_exists( 'lovage_popup_menu' ) ) {
	/**
	 * Menu in Popup
	 */
	function lovage_popup_menu(){
		global $post;
		$menu_slug = '';
		if(is_singular()){
			$menu_slug = get_post_meta( $post->ID, '_lovage_custom_page_menu', true );
	    }
	    $render = wp_nav_menu( array( 
	    	'theme_location' => 'primary', 
	    	'menu' => esc_html( $menu_slug ),
	    	'menu_id' => 'popup-menu',
	    	'menu_class' => 'popup-menu',
	    	'echo' => false 
	    ) );

	    echo wp_kses_post( $render );
	}
}


if ( ! function_exists( 'lovage_header_add_to_cart_fragment' ) ) {
	/**
	 * Add cart item count
	 */
	function lovage_header_add_to_cart_fragment( $fragments ) {
	    global $woocommerce; 

	    $status = '';
	    $cart_number=WC()->cart->get_cart_contents_count();
	    if(WC()->cart->get_cart_contents_count() == 0){
	     	$cart_number = '0';
	    }
	    if(intval($cart_number) > 0){
	   	  $status = 'show';
	    }
	    ob_start(); 
		?>
	    <span class="cart_tip <?php echo esc_attr( $status );?>" id="cart_tip"><?php echo absint( $cart_number );?></span>

	    <?php
	    $fragments['#cart_tip'] = ob_get_clean();
	    return $fragments; 
	}
}

add_filter('woocommerce_add_to_cart_fragments', 'lovage_header_add_to_cart_fragment');


if ( ! function_exists( 'lovage_before_navigation' ) ) {
	/**
	 * The Wrapper Before Navigation
	 */
	function lovage_before_navigation(){
		   $render = '<div id="lovage-primary-bar" class="lovage-grid-' . esc_attr( $GLOBALS['lovage_content_width'] ) .'">';
		   echo wp_kses_post( $render );
	}
}


if ( ! function_exists( 'lovage_after_navigation' ) ) {
	/**
	 * The Wrapper After Navigation
	 */
	function lovage_after_navigation(){
		  echo'</div>';
		  do_action('lovage_after_topbar');
	}
}


if ( ! function_exists( 'lovage_copyright' ) ) {
	/**
	 * Copyright Text in Footer	
	 */
	function lovage_copyright(){
	    $copyright = lovage_theme_customizer()->value( 'site_copyright');
		if(!empty($copyright) && $copyright<>''){
		    echo wp_kses_post(lovage_theme_customizer()->value( 'site_copyright'));
		}else{
	        echo esc_html__( 'Proudly powered by', 'lovage' ) . '<a href=" '. esc_url( 'https://wordpress.org/' ) .' " target="_blank"> WordPress</a><span class="sep"> & </span><a href=" ' . esc_url ( 'https://lovage.io ' ) . ' " rel="dofollow" target="_blank"> ' . esc_html__( 'Lovage Theme ', 'lovage' ) . '</a>';
		}
	}
}


if ( ! function_exists( 'lovage_bottom_widget' ) ) {
	/**
	 * Output bottom widget
	 */
	function lovage_bottom_widget_item($column_class,$widget_id) {
	  if(is_active_sidebar( $widget_id )){
		echo'<div class="bottom-widget lovage-grid '.esc_attr( $column_class ).'">';
	?>
	      <?php dynamic_sidebar( $widget_id );?>
	<?php   
	    echo '</div>';
	  }
	}
}


if ( ! function_exists( 'lovage_bottom_widgets' ) ) {
	/**
	 * The Bottom Widgets section
	 */
	function lovage_bottom_widgets(){
		if ( is_active_sidebar( 'bottom-widget-1' ) || is_active_sidebar( 'bottom-widget-2' ) || is_active_sidebar( 'bottom-widget-3' ) || is_active_sidebar( 'bottom-widget-4' ) ){
	        echo '<div id="site-bottom" class="site-bottom">
	  				<div class="lovage-grid-'.esc_attr( $GLOBALS['lovage_content_width'] ) .'">';
	  	    
			    if(lovage_theme_customizer()->value( 'footer_widget_layout' )=='2'){
			        // 2 columns
			        lovage_bottom_widget_item('lovage-col6','bottom-widget-1');
			        lovage_bottom_widget_item('lovage-col6 last','bottom-widget-2');
			    }elseif(lovage_theme_customizer()->value( 'footer_widget_layout' )=='3'){
			        // 3 columns
			        lovage_bottom_widget_item('lovage-col4','bottom-widget-1');
			        lovage_bottom_widget_item('lovage-col4','bottom-widget-2');
			        lovage_bottom_widget_item('lovage-col4 last','bottom-widget-3');
			    }elseif(lovage_theme_customizer()->value( 'footer_widget_layout' )=='4'){
			        // 4 columns
			        lovage_bottom_widget_item('lovage-col3','bottom-widget-1');
			        lovage_bottom_widget_item('lovage-col3','bottom-widget-2');
			        lovage_bottom_widget_item('lovage-col3','bottom-widget-3');
			        lovage_bottom_widget_item('lovage-col3 last','bottom-widget-4');
			    }elseif(lovage_theme_customizer()->value( 'footer_widget_layout' )=='1/1/2'){
			        // 1/1/2 columns
			        lovage_bottom_widget_item('lovage-col3','bottom-widget-1');
			        lovage_bottom_widget_item('lovage-col3','bottom-widget-2');
			        lovage_bottom_widget_item('lovage-col6 last','bottom-widget-3');
			    }elseif(lovage_theme_customizer()->value( 'footer_widget_layout' )=='2/1/1'){
			        // 1/1/2 columns
			        lovage_bottom_widget_item('lovage-col6','bottom-widget-1');
			        lovage_bottom_widget_item('lovage-col3','bottom-widget-2');
			        lovage_bottom_widget_item('lovage-col3 last','bottom-widget-3');
			    }elseif(lovage_theme_customizer()->value( 'footer_widget_layout' )=='1/2/1'){
			        // 1/2/1 columns
			        lovage_bottom_widget_item('lovage-col3','bottom-widget-1');
			        lovage_bottom_widget_item('lovage-col6','bottom-widget-2');
			        lovage_bottom_widget_item('lovage-col3 last','bottom-widget-3');
			    }elseif(lovage_theme_customizer()->value( 'footer_widget_layout' )=='3/1'){
			        // 3/1 columns
			        lovage_bottom_widget_item('lovage-col9','bottom-widget-1');
			        lovage_bottom_widget_item('lovage-col3 last','bottom-widget-2');
			    }elseif(lovage_theme_customizer()->value( 'footer_widget_layout' )=='1/3'){
			        // 1/3 columns
			        lovage_bottom_widget_item('lovage-col3','bottom-widget-1');
			        lovage_bottom_widget_item('lovage-col9 last','bottom-widget-2');
			    }

	  	      echo '</div>
				  </div>';
		}
	}
}


if ( ! function_exists( 'lovage_before_footer' ) ) {
	/**
	 * The Wrapper After Navigation
	 */
	function lovage_before_footer(){
		do_action('lovage_before_footer');
		echo'<footer id="colophon" class="site-footer">
				<div class="site-info lovage-grid-'.esc_attr( $GLOBALS['lovage_content_width'] ) .'">';
	}
}


if ( ! function_exists( 'lovage_after_footer' ) ) {
	/**
	 * The Wrapper After Navigation
	 */
	function lovage_after_footer(){
		echo'</div>
		   </footer>';
		do_action('lovage_after_footer');
	}
}


if ( ! function_exists( 'lovage_author_socials' ) ) {
	function lovage_author_socials(){
		/**
		 * Social icons in Author card
		 */
		$social_profile='';
		$social_array=array('facebook','twitter','google-plus','flickr','instagram','tumblr','github','youtube','vimeo','wordpress');
		for($i=0;$i<count($social_array);$i++){
		  $social_name=$social_array[$i];
		  if(get_the_author_meta($social_array[$i])<>''){
		    if($social_name=='vimeo'){
			    $social_name=$social_array[$i].'-square';
		    }
		    $social_profile.='<a href="'.esc_url( get_the_author_meta($social_array[$i]) ).'" target="_blank"><i class="fa fa-'.esc_attr( $social_name ).'"></i></a>';
		  }
		}
		echo wp_kses_post( $social_profile );
	}
}
add_action('lovage_author_social_profile','lovage_author_socials');


if ( ! function_exists( 'lovage_post_navigation' ) ) {
	function lovage_post_navigation( $args = array() ) {
		/**
		 * Custom Post Navigation
		 */
	    $args = wp_parse_args( $args, array(
	        'prev_text'          => '%title',
	        'next_text'          => '%title',
	        'screen_reader_text' => esc_html__( 'Post navigation','lovage' ),
	    ) );

	    $navigation = '';
	    $previous   = get_previous_post_link( '<div class="nav-previous">%link</div>', $args['prev_text'] );
	    $next       = get_next_post_link( '<div class="nav-next">%link</div>', $args['next_text'] );
	    $class      = 'post-navigation';
	    
	    // Only add markup if there's somewhere to navigate to.
	    if ( $previous || $next ) {
	        $navigation = _navigation_markup( $previous . $next, $class, $args['screen_reader_text'] );
	    }

	    echo wp_kses_post( $navigation );
	}
}


if ( ! function_exists( 'lovage_default_search_form' ) ) {
	/**
	 * Modify the default WordPress search form
	 */
	function lovage_default_search_form( $form ) {
	    $form = '<form role="search" method="get" id="searchform_default" class="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
	    <div class="lovage-search">
	    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
	    <input type="submit" id="searchsubmit" value="" />
	    <input type="hidden" name="post_type" id="post_type_default" value="post" />
	    </div>
	    </form>';

	    return $form;
	}
}
add_filter( 'get_search_form', 'lovage_default_search_form', 100 );