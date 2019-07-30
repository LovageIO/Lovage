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
 * - lovage_content()
 * - lovage_breadcrumbs()
 * - lovage_ad()
 * - lovage_category_tags($cate_slug,$number,$format)
 * - lovage_is_mobile()
 * - lovage_strip_tags()
 * - lovage_random_string()
 * - lovage_color_hex2rgba()
 * - lovage_comments_popup_link()
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

function lovage_pagenavi(){
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
	
	return $return_html;
}

/*Output format content*/
function lovage_content($echo=true,$format=true){
      $content = get_the_content(esc_html__('Read More &raquo;','lovage'));
	  if($format){
	   global $more;
	   $more = 0;
	   $content = apply_filters('the_content', $content);
	   $content = str_replace(']]>', ']]&gt;', $content);
	  }
	  if($echo){
	    print do_shortcode($content);
	  }else{
	    return do_shortcode($content);
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
		echo ' <a itemprop="breadcrumb" href="' . esc_url($homeLink) . '">' . esc_html__( 'Home' , 'lovage' ) . '</a> ' . $delimiter . ' ';
		
		if ( is_category() ) { 

			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);

			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}

			echo $before . '' . esc_html(single_cat_title('', false)) . '' . $after;

		}elseif ( is_search() ) { 
			echo $before . esc_html($_GET['s']) . $after;
		} elseif ( is_day() ) { 
			
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a itemprop="breadcrumb"  href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) { 

			echo '<a itemprop="breadcrumb" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {

			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) { 

			if ( get_post_type() != 'post' ) { 
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . esc_html(get_the_title()) . $after;
			} else { 
				/*$cat = get_the_category(); 
				$cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );*/
				echo $before . esc_html(get_the_title()) . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

	    } elseif ( is_404() ) {

			echo $before . '404'. $after;

		} elseif ( is_attachment() ) { 

			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_permalink($parent)) . '">' . esc_html($parent->post_title) . '</a> ' . $delimiter . ' ';
			echo $before . esc_html(get_the_title()) . $after;

		} elseif ( is_page() && !$post->post_parent ) { 

			echo $before . esc_html(get_the_title()) . $after;

		} elseif ( is_page() && $post->post_parent ) { 

			$parent_id  = $post->post_parent;
			$breadcrumbs = array();

			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
				$parent_id  = $page->post_parent;
			}

			$breadcrumbs = array_reverse($breadcrumbs);

			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_search() ) { 

			echo $before ;
			printf( esc_html__( 'Search Results for: %s', 'lovage' ),  get_search_query() );
			echo  $after;

		} elseif ( is_tag() ) {

			echo $before ;
			printf( esc_html__( 'Tag Archives: %s', 'lovage' ), single_tag_title( '', false ) );
			echo  $after;

		} elseif ( is_author() ) {

			global $author;
			$userdata = get_userdata($author);

			echo $before ;
			printf( esc_html__( 'Author Archives: %s', 'lovage' ),  $userdata->display_name );
			echo  $after;

		} elseif ( is_404() ) { 
			echo $before;
			esc_html_e( 'Not Found', 'lovage' );
			echo  $after;
		}
		if ( get_query_var('paged') ) {

			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( esc_html__( '( Page %s )', 'lovage' ), get_query_var('paged') );

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
	echo '<li><a href="'.esc_url($url).'">'.$item->name.'</a></li>';
	endforeach;
	endif;
	 
	// Display the current term in the breadcrumb
	echo '<li>'.esc_attr($term->name).'</li>';
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

/*Check user's mobile device*/
function lovage_is_mobile() {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	$is_mobile = apply_filters('lovage_is_mobile', $is_mobile);
	return $is_mobile;
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

function lovage_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = esc_html__( 'No Comments','lovage' );
    if ( false === $one ) $one = esc_html__( '1 Comment' ,'lovage');
    if ( false === $more ) $more = esc_html__( '% Comments' ,'lovage');
    if ( false === $none ) $none = esc_html__( 'Comments Off' ,'lovage');
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = esc_html__('Enter your password to view comments.','lovage');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = esc_url(home_url('/'));
        else
            $home = esc_url(get_option('siteurl'));
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
    $allow_tags = array(
		//formatting
		'strong' => array(),
		'em'     => array(),
		'b'      => array(),
		'i'      => array(),
	
		//links
		'a'     => array(
			'href' => array()
		)
	);
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
	$str .= ' title="' . wp_kses( __( 'Comment on %s','lovage' ), $allow_tags, $title, false );
    $str .= lovage_comments_number_str( $zero, $one, $more );
    $str .= '</a>';
     
	$str = apply_filters('lovage_comments_popup_link', $str);
    return $str;
}

function lovage_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? esc_html__('% Comments','lovage') : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? esc_html__('No Comments','lovage') : $zero;
    else // must be one
        $output = ( false === $one ) ? esc_html__('1 Comment','lovage') : $one;
 
    return apply_filters('comments_number', $output, $number);
}

/*Strip Out the marks*/
function lovage_filter_mark($text){ 
	if(trim($text)=='')return ''; 
	$text=preg_replace("/[[:punct:]\s]/",' ',$text); 
	$text=urlencode($text); 
	$text=preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%E3%80%82|%EF%BC%81|%EF%BC%8C|%EF%BC%9B|%EF%BC%9F|%EF%BC%9A|%E3%80%81|%E2%80%A6%E2%80%A6|%E2%80%9D|%E2%80%9C|%E2%80%98|%E2%80%99|%EF%BD%9E|%EF%BC%8E|%EF%BC%88)+/",' ',$text); 
	$text=urldecode($text); 
	return trim($text); 
} 

/**
 * Check if the current screen is Lovage Home Page Template.
 */
function is_lovage_homepage(){
	return is_page_template('page-templates/page-home.php') ? true : false;
}

function is_standard_page(){
	return is_page() ? true : false;
}

/**
 * Get the Wordpress Menu
 */
function lovage_get_menus(){
    $menus = get_terms('nav_menu');
    $menu_options = array('0'=>'Default Menu');
	foreach($menus as $menu){
	  $menu_options[$menu->slug] = $menu->name;
	} 
	return $menu_options;
}