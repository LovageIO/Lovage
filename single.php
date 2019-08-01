<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

get_header(); 
		
	  /* Hook: lovage_before_content, lovage_before_main_content
	   * @Hooked: lovage_before_content()
	   * @Hooked: lovage_before_main_content();
	   */
	  do_action( 'lovage_before_content' );

	  if( lovage_has_sidebar() ){
	     do_action( 'lovage_before_main_content' );
	  }
	  
	    while ( have_posts() ) : the_post();
			 get_template_part( 'template-parts/content', 'single' ); 

			 if( get_post_type() !== 'elementor_library' ) {
				 get_template_part( 'template-parts/single-post/related-posts' ); 
				 get_template_part( 'template-parts/single-posts/author' );
			 	 lovage_post_navigation();
			 }
			 
			 // If comments are open or we have at least one comment, load up the comment template.
			 if ( comments_open() || get_comments_number() ) :
				comments_template();
			 endif;

		endwhile; 

		if( lovage_has_sidebar() ){
			/* Hook: lovage_after_main_content
			 * @Hooked: lovage_after_main_content();
			 */
			do_action( 'lovage_after_main_content' );
			
			get_sidebar(); 

		}

	    /* Hook: lovage_after_content
	     * @Hooked: lovage_after_content();
	     */
		do_action( 'lovage_after_content' );	 

get_footer();