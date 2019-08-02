<?php
/**
 * Custom WooCommerce template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 * Inspired by Storefront theme. 
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

/**
 * Display the product category list
 * Hooked into the `lovage_home` action in the homepage template
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'lovage_product_category_list' ) ) {
	function lovage_product_category_list(){
		global $post;
		$lovage_product_category_list = lovage_theme_customizer()->value('home_product_category_links');
		if($lovage_product_category_list == 0){
			return;
		}
		$args = apply_filters('lovage_product_category_list_args', array(
					'hide_empty'   => true,
					'hierarchical' => true,
					//'taxonomy' => 'post_tag',
			    ));
		$terms = get_terms( 'product_cat',$args);
		if ( $terms ) {
		    echo '<div class="lovage-product-cats-list">';
		    	do_action('lovage_before_product_list');

		        foreach ( $terms as $term ) {                        
		                echo '<a href="' . esc_url( get_term_link( $term ) ) . '" class="' . esc_attr( $term->slug ) . '">';
		                echo esc_attr( $term->name );
		                echo '</a>';
		        }
		        echo '<a href="'.esc_url(home_url('/')).'?page_id='. esc_attr( get_option('woocommerce_shop_page_id') ).'" class="all_products">'.esc_html__('All Products','lovage').' &raquo;</a>';

		        do_action('lovage_after_product_list');
		    echo '</div>';
		}
	}
}


if ( ! function_exists( 'lovage_product_data' ) ) {
	/**
	 * Display Products
	 */
	function lovage_product_data(){
		global $post;

		$lovage_product_data    = lovage_theme_customizer()->value('home_product_data' );
		$lovage_product_number  = lovage_theme_customizer()->value('home_product_number' );
		$lovage_product_columns = lovage_theme_customizer()->value('home_grid_columns' );

	    $args = array(
   			'limit' 			=> $lovage_product_number,
			'columns' 			=> esc_html($lovage_product_columns),
			'orderby'			=> 'date',
			'order'				=> 'desc',
			'title'				=> '',
		);
		switch ($lovage_product_data) {
			 case 'new':
			   lovage_recent_products( $args );
			   break;
			 case 'featured':
			   lovage_featured_products( $args );
			   break;
			 case 'sale':
			   lovage_on_sale_products( $args );
			   break;
			 case 'popular':
			   lovage_popular_products( $args );
			   break;
		}
		$wc_query = new WP_Query(array('post_type'=>'product')); 
        if ($wc_query->have_posts()) {
		echo  '<a href="'.esc_url(home_url('/')).'?page_id='. esc_attr( get_option('woocommerce_shop_page_id') ).'" class="button_outline aligncenter">'.esc_html__('Load More','lovage').'</a>';
		}
	}
}


if ( ! function_exists( 'lovage_recent_products' ) ) {
	/**
	 * Display Recent Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function lovage_recent_products( $args ) {

		if ( class_exists( 'woocommerce' ) ){

			echo '<section class="lovage-product-section lovage-recent-products">';

				do_action( 'lovage_homepage_before_recent_products' );

				if($args['title']<>''){
				   echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '<div class="divider"><span></span></div></h2>';
			    }

				echo do_shortcode( '[recent_products per_page='.intval( $args['limit'] ).' columns='.intval( $args['columns'] ).']');
				do_action( 'lovage_homepage_after_recent_products' );

			echo '</section>';
		}
	}
}

if ( ! function_exists( 'lovage_featured_products' ) ) {
	/**
	 * Display Featured Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function lovage_featured_products( $args ) {

		if ( class_exists( 'woocommerce' ) ){


			echo '<section class="lovage-product-section lovage-featured-products">';

				do_action( 'lovage_homepage_before_featured_products' );

				if($args['title']<>''){
				   echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '<div class="divider"><span></span></div></h2>';
			    }
				echo do_shortcode( '[featured_products per_page='.intval( $args['limit'] ).' columns='.intval( $args['columns'] ).' orderby='.esc_attr( $args['orderby'] ).' order='.esc_attr( $args['order'] ).']');
				
				do_action( 'lovage_homepage_after_featured_products' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'lovage_popular_products' ) ) {
	/**
	 * Display Popular Products
	 * @since  1.0.0
	 * @return void
	 */
	function lovage_popular_products( $args ) {

		if ( class_exists( 'woocommerce' ) ){

			echo '<section class="lovage-product-section lovage-popular-products">';

				do_action('lovage_homepage_before_popular_products');

				if($args['title']<>''){
				   echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '<div class="divider"><span></span></div></h2>';
			    }

				echo do_shortcode( '[top_rated_products per_page='.intval( $args['limit'] ).' columns='.intval( $args['columns'] ).']');
				do_action('lovage_homepage_after_popular_products');

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'lovage_on_sale_products' ) ) {
	/**
	 * Display On Sale Products
	 * @since  1.0.0
	 * @return void
	 */
	function lovage_on_sale_products( $args ) {

		if ( class_exists( 'woocommerce' ) ){

			echo '<section class="lovage-product-section lovage-on-sale-products">';

				do_action( 'lovage_homepage_before_on_sale_products' );

				if($args['title']<>''){
				   echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '<div class="divider"><span></span></div></h2>';
			    }

				echo do_shortcode( '[sale_products per_page='.intval( $args['limit'] ).' columns='.intval( $args['columns'] ).']');

				do_action( 'lovage_homepage_after_on_sale_products' );

			echo '</section>';

		}
	}
}


if ( ! function_exists( 'lovage_before_shop_content' ) ) :
/**
 * Before Main Content
 */
function lovage_before_shop_content(){
       if ( is_product_category() ){
	      global $wp_query;
	      $cat = $wp_query->get_queried_object();
	      $cat_id = $cat->term_id;
          $cat_data = get_option("taxonomy_$cat_id");
          $cat_sidebar = $cat_data['cat_sidebar'];

          if($cat_sidebar){
	       echo '<main id="lovage-shop-primary" class="lovage-grid lovage-col9 last site-main">';
	      }
	    }
	    
	    if(is_shop()){
	      if(lovage_theme_customizer()->value( 'shop_sidebar') == 1){
	       echo '<main id="lovage-shop-primary" class="lovage-grid lovage-col9 last site-main">';
	      }
	    }
}
endif;

if ( ! function_exists( 'lovage_after_shop_content' ) ) :
/**
 * After Main Content
 */
function lovage_after_shop_content(){
	if ( is_product_category() ){
      global $wp_query;
      $cat = $wp_query->get_queried_object();
      $cat_id = $cat->term_id;
      $cat_data = get_option("taxonomy_$cat_id");
      $cat_sidebar=$cat_data['cat_sidebar'];
      if($cat_sidebar=='yes'){
       	echo '</main>';
      }
    }

    if(is_shop()){
      if(lovage_theme_customizer()->value( 'shop_sidebar') == 1){
       	echo '</main>';
      }
    }
}
endif;

/**
 * Shop Sidebar
 * --------------------------------------------------
 */
if ( ! function_exists( 'lovage_shop_sidebar' ) ) {
	function lovage_shop_sidebar(){
	    
	    if ( is_product_category() ){
	      global $wp_query;
	      $cat = $wp_query->get_queried_object();
	      $cat_id = $cat->term_id;
          $cat_data = get_option("taxonomy_$cat_id");
          $cat_sidebar=$cat_data['cat_sidebar'];

          if($cat_sidebar){
	        get_sidebar();
	      }
	    }

	    if(is_shop()){
	      if(lovage_theme_customizer()->value( 'shop_sidebar') == 1){
	        get_sidebar();
	      }
	    }
	}
}

/**
 * Add Wrapper for the category result info
 * --------------------------------------------------
 */
if ( ! function_exists( 'lovage_before_shop' ) ) {
	function lovage_before_shop(){
		
	  $show=TRUE;

	  if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ){
	     $show=FALSE;
	  }
	  if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ){
	     $show = FALSE;
	  }
	  
	  if($show==TRUE){
		echo '<div class="category_result">';
	  }
	}
}
if ( ! function_exists( 'lovage_after_shop' ) ) {
	function lovage_after_shop(){
	  $show=TRUE;
	  if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ){
	     $show=FALSE;
	  }
	  if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ){
	     $show = FALSE;
	  }
	  
	  if($show==TRUE){
		echo '</div>';
	  }
	}
}

if(!function_exists('lovage_before_summary')){
    function lovage_before_summary(){
    	echo '<div class="lovage_product_top">';
    }
}

if(!function_exists('lovage_after_summary')){
    function lovage_after_summary(){
    	echo '</div>';
    }
}

if(!function_exists('lovage_add_to_cart_wrapper')){
	function lovage_add_to_cart_wrapper(){
		echo '<div class="lovage_add_to_cart_wrapper">';
	}
}
if(!function_exists('lovage_add_to_cart_wrapper_close')){
	function lovage_add_to_cart_wrapper_close(){
		echo '</div>';
	}
}

/**
 * Customize Cart Page Wrapper
 * --------------------------------------------------
 */
if (!function_exists('lovage_before_cart_table')):
function lovage_before_cart_table(){
	echo '<div class="lovage-cart-list">';
}
endif;

if (!function_exists('lovage_after_cart_table')):
function lovage_after_cart_table(){
	echo '</div>';
}
endif;

if (!function_exists('lovage_add_to_cart')):
/**
 * Custom add to cart button	
 */
function lovage_add_to_cart(){
	global $product;
	$product_type = $product->get_type();
	$add_to_cart='';
	$cart_class='lovage-add-to-cart-button';
	
	switch ( $product_type ) {
		case 'external':
			$add_to_cart='<i class="fa fa-external-link"></i>';
		break;
		case 'grouped':
			$add_to_cart='<i class="lovage-icon lovage-icon-plus"></i>';
		break;
		case 'simple':
			$add_to_cart='<i class="lovage-icon lovage-icon-bag"></i>';
			$cart_class .= ' button product_type_simple add_to_cart_button ajax_add_to_cart';
		break;
		case 'variable':
			$add_to_cart='<i class="fa fa-cog"></i>';
		break;
		default:
			$add_to_cart='<i class="lovage-icon lovage-icon-plus"></i>';
	}
	
    echo wp_kses_post( apply_filters( 'lovage_woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->get_id()),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : $cart_class ),
		$add_to_cart
	),
    $product ) );
}
endif;

if (!function_exists('lovage_template_loop_product_thumbnail')):
/**
 * Get the product thumbnail for the loop.	
 */
function lovage_template_loop_product_thumbnail(){
	  global $post, $product, $woocommerce;
	  $hover_image='';
	  $onsale='';
	  
	  $attachment_ids = $product->get_gallery_image_ids();
	  if(count($attachment_ids)>0){
		  $attachment_id=$attachment_ids[0];
		  $hover_image = '<span class="product_hover_image" style="background:url('.esc_url(wp_get_attachment_url( $attachment_id)).');background-size:cover;"></span>';
	  }
	  if ( $product->is_on_sale() ){
	      $onsale = apply_filters( 'lovage_woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'lovage' ) . '</span>', $post, $product );
      }
	 
	  echo '<a href="'.esc_url( get_permalink() ).'" class="product_thumbnail">'. wp_kses_post( $onsale ) . wp_kses_post( $hover_image ) . wp_kses_post( woocommerce_get_product_thumbnail() ).'</a>';
}
endif;

if (!function_exists('lovage_template_loop_product_title')):
/**
 * Show the product title in the product loop. 
 */
function lovage_template_loop_product_title() {
    echo '<h3><a href="'.esc_url(get_permalink()).'">' . esc_attr(get_the_title()) . '</a></h3>';
}
endif;

if (!function_exists('lovage_woocommerce_category_slider')):
/**
 * Show the revolution slider in product category page. 
 */
function lovage_woocommerce_category_slider() {

    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $cat_id = $cat->term_id;
        $cat_data = get_option("taxonomy_$cat_id");
        $cat_slider=$cat_data['revslider_alias'];
	    if ($cat_slider<>'' ) {
	        echo '<div class="term-banner">';
		    putRevSlider(esc_attr($cat_slider));
		    echo '</div>';
		}
	}
}
endif;

if (!function_exists('lovage_woocommerce_category_menu')):
/**
 * Show the product category menu. 
 */
function lovage_woocommerce_category_menu() {

    // Find the category + category parent, if applicable
    $term 			= get_queried_object();
    $parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;
    $categories 	= get_terms('product_cat', array('hide_empty' => 1, 'parent' => $parent_id));

    $show_category_menu = TRUE;

    if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_category_menu = FALSE;
     if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_category_menu = FALSE;
    
    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_category_menu = FALSE;
    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_category_menu = FALSE;

	if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories') ) $show_category_menu = FALSE;
    if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $show_category_menu = FALSE;
    
    if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_category_menu = FALSE;

    if ($show_category_menu == TRUE){
      if ($categories){
        
         echo '<ul class="lovage_product_category_menu">';
         $cat_counter = 0; 
         foreach($categories as $category) :
                   
            echo'<li class="category_item">
                <a href="'.esc_url(get_term_link( $category->slug, 'product_cat' )).'" class="category_item_link">
                    <span class="category_name">'.esc_attr($category->name).'</span>
                </a>
            </li>';
               
          endforeach;
               
          echo '</ul><!--//product_categories-->';
        
       }
    }
}
endif;

/**
 * lovage_is_realy_woocommerce_page - Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and which are also included)
 *
 * @access public
 * @return bool
 * @reference https://faish.al/2014/01/06/check-if-it-is-woocommerce-page/
 */
function lovage_is_realy_woocommerce_page () {
    if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
        return true;
    }
    $woocommerce_keys = array ( "woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" ) ;

    foreach ( $woocommerce_keys as $wc_page_id ) {
        if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
            return true ;
        }
    }
    return false;
}