<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

get_header();

	   /* Hook: lovage_before_content
	    * @Hooked: lovage_before_content()
	    */
	   do_action( 'lovage_before_content' );
	  
	   if ( have_posts() ) : ?>

			<?php 

			while ( have_posts() ) : the_post(); 

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				
			 endwhile;  

			 lovage_pagenavi( TRUE ); 

		else :

			 get_template_part( 'template-parts/content', 'none' ); 
		
		endif;
	
	    /* Hook: lovage_after_content
	     * @Hooked: lovage_after_content();
	     */
		do_action( 'lovage_after_content' );	 
	
get_footer(); 