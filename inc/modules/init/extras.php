<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

if ( ! function_exists( 'lovage_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function lovage_body_classes( $classes ) {
		
		global $post;

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		
		if ( class_exists( 'woocommerce') ){
		     $classes[]='woocommerce';
		}

		$page_layout = !is_search() && !is_404() && is_singular() ? get_post_meta( $post->ID, '_lovage_page_layout', true ) : '';

		if( $page_layout == 'default' || !isset($page_layout) || $page_layout == '' ){
			$page_layout = lovage_theme_customizer()->value('blog_post_layout');
		}else{
			$page_layout = get_post_meta( $post->ID, '_lovage_page_layout', true );
		}

		if( is_singular() && $page_layout == 'right-sidebar' ){
			$classes[] = 'lovage-sidebar-layout lovage-right-sidebar';
		}

		if( is_singular() && $page_layout == 'left-sidebar' ){
			$classes[] = 'lovage-sidebar-layout lovage-left-sidebar';
		}

		if( is_singular() && $page_layout == 'one-column' ){
			$classes[] = 'lovage-one-column';
		}

		if( is_home() ){
			if( ! is_active_sidebar('sidebar') ){
				$classes[] = 'lovage-one-column';
			}else{
				$classes[] = 'lovage-sidebar-layout';
			}
		}

		if( lovage_is_fullwidth() ){
			$classes[] = 'lovage-fullwidth';
		}

		$classes[] = 'lovage';

		return $classes;
	}
}
add_filter( 'body_class', 'lovage_body_classes' );


/**
 * Check if post or page needs a sidebar
 */
if ( ! function_exists( 'lovage_has_sidebar' ) ) {
	function lovage_has_sidebar(){
		
		global $post;

		wp_reset_query();

		$result = false;
		$global_page_layout = lovage_theme_customizer()->value('blog_post_layout');
		$page_layout = get_post_meta( $post->ID, '_lovage_page_layout', true );

		if( get_post_type($post->ID) == 'post' || get_post_type($post->ID) == 'page' && is_singular() ){
			
			if( $page_layout == 'left-sidebar' || $page_layout == 'right-sidebar' ){
			
				$result = true;
			
			}elseif( $page_layout == 'default' || $page_layout == '' ){

				if( $global_page_layout == 'left-sidebar' || $global_page_layout == 'right-sidebar' ){
					$result = true;
				}else{
					$result = false;
				}

			}else{
				$result = false;
			}
		}

		return $result;

	}
}

/**
 * Check if post or page is fullwidth layout
 */
if ( ! function_exists( 'lovage_is_fullwidth' ) ) {
	function lovage_is_fullwidth(){

		if( !is_singular() ){
			return;
		}

		global $post;

		$page_layout = get_post_meta( $post->ID, '_lovage_page_layout', true );

		if( get_post_type($post->ID) == 'page' && is_page() && $page_layout == 'fullwidth' ){
			return true;
		}else{
			return false;
		}
	}
}

/**
 * Add social profile fields to user page
 */
if ( ! function_exists( 'lovage_custom_profile' ) ) {
	function lovage_custom_profile( $contactmethods ) {
	    $contactmethods['facebook'] = 'Facebook';
		$contactmethods['twitter'] = 'Twitter';
		$contactmethods['google-plus'] = 'Google+';
		$contactmethods['flickr'] = 'Flickr+';
		$contactmethods['instagram'] = 'Instagram';
		$contactmethods['tumblr'] = 'Tumblr';
		$contactmethods['github'] = 'Github';
		$contactmethods['youtube'] = 'Youtube';
		$contactmethods['vimeo'] = 'Vimeo';
		$contactmethods['pinterest'] = 'Pinterest';
		$contactmethods['wordpress'] = 'WordPress';
	    return $contactmethods;
	}
}
add_filter('user_contactmethods','lovage_custom_profile',10,1);


/* Remove margin top of admin bar.*/
add_action('get_header', 'lovage_remove_admin_login_header');
function lovage_remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

/**
 * Remove Page Frome Search Result
 */
add_action('init', 'lovage_remove_pages_from_search');
if( ! function_exists('lovage_remove_pages_from_search') ){
	function lovage_remove_pages_from_search() {
	    global $wp_post_types;

	    $wp_post_types['page']->exclude_from_search = true;
	}
}


/**
 * Flush out the transients used in lovage_categorized_blog.
 */
if ( ! function_exists( 'lovage_category_transient_flusher' ) ) :
	function lovage_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'lovage_categories' );
	}
endif;
add_action( 'edit_category', 'lovage_category_transient_flusher' );
add_action( 'save_post',     'lovage_category_transient_flusher' );


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'lovage_categorized_blog' ) ) :
	function lovage_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'lovage_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'lovage_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so lovage_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so lovage_categorized_blog should return false.
			return false;
		}
	}
endif;