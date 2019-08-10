<?php
/**
 * Common Functions Library
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

 /* TABLE OF CONTENTS
 *
 * - lovage_category_root_id($cat)
 * - lovage_cat_slug($cate_name)
 * - lovage_cat_name($cate_ID)
 * - lovage_truncate($full_str,$max_length) 
 * - lovage_pagenavi()
 * - lovage_format($content) 
 * - lovage_breadcrumbs()
 * - lovage_category_tags($cate_slug,$number,$format)
 * - lovage_strip_tags()
 * - lovage_random_string()
 * - lovage_color_hex2rgba()
 * - lovage_is_woocommerce_page()
 /

/*Get sub category ID
 * parameter:
 * $root_cat_id: The parent category id
*/
function lovage_category_root_id($root_cat_id)   {   
	$current_category = get_category($root_cat_id); 
	while($current_category->category_parent)  {   
	 $current_category = get_category($current_category->category_parent);  
	}
	$term_id=$current_category->term_id;
	$term_id = apply_filters('lovage_category_root_id', $term_id);
	return $term_id;
}

/*Get category slug
 * Parameter:
 * $cate_name: Category name
*/
function lovage_cat_slug($cate_name){
	$cat_ID = get_cat_ID($cate_name); 
	$thisCat = get_category($cat_ID);
	$cat_slug = '';
	if(count($thisCat)>1){
	  $cat_slug = $thisCat->slug;
    }
	$cat_slug = apply_filters('lovage_cat_slug', $cat_slug);
	return $cat_slug;
}

/*Get category name
 *Parameter:
 *$cate_ID:Category id
*/
function lovage_cat_name($cate_ID){
	$current_cat = get_category($cate_ID);
	$cate_name = $current_cat->name;
	$cate_name = apply_filters('lovage_cat_name', $cate_name);
	return $cate_name;
}

/*Get category id
 *Parameter:
 *$cate_slug:Category slug
*/
function lovage_cat_id($cate_slug){
    $category=get_term_by('slug',$cate_slug,'category');
    if($category){
	 $cate_id = $category->term_id;
	 $cate_id = apply_filters('lovage_cat_id', $cate_id);
	 return $cate_id;
	}
}

/*Get page id by slug
 *Parameter:
 *$page_slug: Page slug
*/
function lovage_page_id($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

/*Truncate the long string
 *Parameter:
 *$full_start: The string you want to truncate.
 *$max_length: The max length of output. 
*/
function lovage_truncate($full_str,$max_length) {
	if (mb_strlen($full_str,'utf-8') > $max_length ) {
	  $full_str = mb_substr($full_str,0,$max_length,'utf-8').'...';
	}
	$full_str = apply_filters('lovage_truncate', $full_str);
return $full_str;
}

/*Output page navi
 *Parameter:
 *$p: Default page number
*/

function lovage_pagenavi($echo){
   global $wp_query;

	$big = 999999999; // need an unlikely integer
	$return_html='';
	$return_html.='<div class="lovage_pagenavi">';
	$return_html.= paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_text'    => '&larr;',
	    'next_text'    => '&rarr;'
	) );
	$return_html.='</div>';
	
	if( $echo ) {
		echo wp_kses_post( $return_html );
	}else{
		return $return_html;
	}
}


/**
 * Output the Lovage Breadcrumb.
 * Thanks https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 */
if ( ! function_exists( 'lovage_breadcrumbs' ) ) {
function lovage_breadcrumbs() {
	$delimiter = '&raquo;'; 
	$before = '<span class="current">'; 
	$after = '</span>';

	if ( !is_home() && !is_front_page() || is_paged() ) {
		echo '<div itemscope class="lovage-breadcrumbs">';
		
		global $post;
		$homeLink = home_url('/');
		echo ' <a itemprop="breadcrumb" href="' . esc_url($homeLink) . '">' . esc_html__( 'Home' , 'lovage' ) . '</a> ' . wp_kses_post( $delimiter ) . ' ';
		
		if ( is_category() ) { 

			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);

			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . wp_kses_post( $delimiter ) . ' ');
				$cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo wp_kses_post( $cat_code );
			}

			echo wp_kses_post( $before ) . '' . esc_html(single_cat_title('', false)) . '' . wp_kses_post( $after );

		}elseif ( is_search() ) { 
			echo wp_kses_post( $before ) . isset( $_GET['s'] ) ? esc_html( sanitize_text_field( wp_unslash( $_GET['s'] ) ) ) : '' . wp_kses_post( $after );
		} elseif ( is_day() ) { 
			
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . wp_kses_post( $delimiter ) . ' ';
			echo '<a itemprop="breadcrumb"  href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html( get_the_time('F') ) . '</a> ' . wp_kses_post( $delimiter ) . ' ';
			echo wp_kses_post( $before ) . esc_html( get_the_time('d') ) . wp_kses_post( $after );

		} elseif ( is_month() ) { 

			echo '<a itemprop="breadcrumb" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . wp_kses_post( $delimiter ) . ' ';
			echo wp_kses_post( $before ) . esc_html( get_the_time('F') ) . wp_kses_post( $after );

		} elseif ( is_year() ) {

			echo wp_kses_post( $before ) . esc_html( get_the_time('Y') ) . wp_kses_post( $after );

		} elseif ( is_single() && !is_attachment() ) { 

			if ( get_post_type() != 'post' ) { 
				$post_type = get_post_type_object( get_post_type() );
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . esc_url( $homeLink ) . '/' . esc_attr( $slug['slug'] ) . '/">' . esc_attr( $post_type->labels->singular_name ) . '</a> ' . wp_kses_post( $delimiter ) . ' ';
				echo wp_kses_post( $before ) . esc_html( get_the_title() ) . wp_kses_post( $after );
			} else { 
				/*$cat = get_the_category(); 
				$cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . wp_kses_post( $delimiter ) . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );*/
				echo wp_kses_post( $before ) . esc_html(get_the_title()) . wp_kses_post( $after );
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

			$post_type = get_post_type_object(get_post_type());
			echo wp_kses_post( $before ) . esc_html( $post_type->labels->singular_name ) . wp_kses_post( $after );

	    } elseif ( is_404() ) {

			echo wp_kses_post( $before ) . '404'. wp_kses_post( $after );

		} elseif ( is_attachment() ) { 

			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_permalink($parent)) . '">' . esc_html($parent->post_title) . '</a> ' . wp_kses_post( $delimiter ) . ' ';
			echo wp_kses_post( $before ) . esc_html(get_the_title()) . wp_kses_post( $after );

		} elseif ( is_page() && !$post->post_parent ) { 

			echo wp_kses_post( $before ) . esc_html(get_the_title()) . wp_kses_post( $after );

		} elseif ( is_page() && $post->post_parent ) { 

			$parent_id  = $post->post_parent;
			$breadcrumbs = array();

			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
				$parent_id  = $page->post_parent;
			}

			$breadcrumbs = array_reverse($breadcrumbs);

			foreach ( $breadcrumbs as $crumb ) echo esc_html( $crumb ) . ' ' . wp_kses_post( $delimiter ) . ' ';
			echo wp_kses_post( $before ) . esc_html( get_the_title() ) . wp_kses_post( $after );

		} elseif ( is_search() ) { 

			echo wp_kses_post( $before ) ;
			esc_html_e( 'Search Results for:', 'lovage' ) .' '. get_search_query();
			echo  wp_kses_post( $after );

		} elseif ( is_tag() ) {

			echo wp_kses_post( $before ) ;
			esc_html__( 'Tag Archives:', 'lovage' ) .' '. single_tag_title( '', false );
			echo  wp_kses_post( $after );

		} elseif ( is_author() ) {

			global $author;
			$userdata = get_userdata($author);

			echo wp_kses_post( $before ) ;
			esc_html__( 'Author Archives:', 'lovage' ) .' '. $userdata->display_name;
			echo  wp_kses_post( $after );

		} elseif ( is_404() ) { 
			echo wp_kses_post( $before );
			esc_html_e( 'Not Found', 'lovage' );
			echo  wp_kses_post( $after );
		}
		if ( get_query_var('paged') ) {

			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
			  esc_html_e( 'Page', 'lovage' ) . ' ' . get_query_var('paged');

		}
		echo '</div>';
	}
}
}

/* Taxonomy Breadcrumb */
function lovage_taxonomy_breadcrumb() {
	// Get the current term
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	 
	// Create a list of all the term's parents
	$parent = $term->parent;
	while ($parent):
	$parents[] = $parent;
	$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
	$parent = $new_parent->parent;
	endwhile;
	if(!empty($parents)):
	$parents = array_reverse($parents);
	 
	// For each parent, create a breadcrumb item
	foreach ($parents as $parent):
	$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
	$url = esc_url(home_url('/')).'/'.$item->taxonomy.'/'.$item->slug;
	echo '<li><a href="'.esc_url($url).'">'.esc_attr( $item->name ).'</a></li>';
	endforeach;
	endif;
	 
	// Display the current term in the breadcrumb
	echo '<li>'.esc_attr( $term->name ).'</li>';
}

/*Get tags cloud in specified category
 *Parameter:
 *$cate_slug: category slug
 *$number: Number of ouput
 *$format: additional parameter, it will use for pass parameter to next page. 
*/
function lovage_category_tags($cate_slug='',$number=20,$label='') {
 query_posts('posts_per_page='.$number.'&category_name='.$cate_slug);
  if (have_posts()) :
			  $all_tags_arr=array(); 
			  $tagcloud='<div class="lovage_widget">';
			  while (have_posts()) :
				the_post();
				$posttags = get_the_tags();
				if ($posttags) {
				  foreach($posttags as $tag) {
				   if(in_array($tag->name,$all_tags_arr)){
					  continue;
				   }else{
					$all_tags_arr[] = $tag->name;
					if($cate_slug<>''){
		               $cat='&cat='.$cate_slug;
					}else{
					   $cat='';
					}
					if($label<>''){
					   $lab='&label='.$label;
					}else{
					   $lab='';
					}
					$tagcloud.='<a href ="'.esc_url(home_url('/')).'/?tag='.$tag->name.$cat.$lab.'" class="tagclouds-item">'.$tag->name.'</a>';
				   }
				  }
				}
			  endwhile;
			  $tagcloud.='</div>';
   endif;
   wp_reset_query();
   $tagcloud = apply_filters('lovage_category_tags', $tagcloud);
   return $tagcloud;
}

/*Filter string*/
function lovage_strip_tags($tagsArr,$str) {   
	foreach ($tagsArr as $tag) {  
		$p[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";  
	}  
	$return_str = preg_replace($p,"",$str);
	$return_str = apply_filters('lovage_strip_tags', $return_str);
	return $return_str;  
}  

/*Random string*/
function lovage_random_string($length, $max=FALSE){
  if (is_int($max) && $max > $length){
    $length = mt_rand($length, $max);
  }
  $output = '';
  
  for ($i=0; $i<$length; $i++){
    $which = mt_rand(0,2);
    
    if ($which === 0){
      $output .= mt_rand(0,9);
    }
    elseif ($which === 1){
      $output .= chr(mt_rand(65,90));
    }else{
      $output .= chr(mt_rand(97,122));
    }
  }
  $output = apply_filters('lovage_random_string', $output);
  return $output;
  
}

/*Color code convert to rgba*/
function lovage_color_hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
		$output = apply_filters('lovage_color_hex2rgba', $output);
        return $output;
}

/**
 * Get the WordPress Menu
 */
function lovage_get_menus(){
    $menus = get_terms('nav_menu');
    $menu_options = array('0'=>'Default Menu');
	foreach($menus as $menu){
	  $menu_options[$menu->slug] = $menu->name;
	} 
	return $menu_options;
}

/**
 * lovage_is_realy_woocommerce_page - Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and which are also included)
 *
 * @access public
 * @return bool
 * @reference https://faish.al/2014/01/06/check-if-it-is-woocommerce-page/
 */
function lovage_is_woocommerce_page () {
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