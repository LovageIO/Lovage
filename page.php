<?php
/**
 * Default Page
 *
 * This is the template that displays the pages with fullwidth template.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

get_header();

	  /* Hook: lovage_before_content, lovage_before_main_content
	   * @Hooked: lovage_before_content()
	   */
	  do_action( 'lovage_before_content' );

	  if( lovage_has_sidebar() ){
	     do_action( 'lovage_before_main_content' );
	  }
	 
	  while ( have_posts() ) : the_post(); 

			get_template_part( 'template-parts/content', 'page' );


			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
	  endwhile; // End of the loop. 

	  if( lovage_has_sidebar() ){
			/* Hook: lovage_after_main_content
			 * @Hooked: lovage_after_main_content();
			 */
			do_action( 'lovage_after_main_content' );
			
			get_sidebar(); 

	  }

	  /* Hook: lovage_after_content
	   * @Hooked: lovage_after_content()
	   */
	  do_action( 'lovage_after_content' );
	 
get_footer();
