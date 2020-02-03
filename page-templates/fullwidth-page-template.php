<?php
/**
 * Template Name: Fullwidth Template
 *
 * This is the template that displays the pages with fullwidth template.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Lovage
 * @author Lovage
 * @version 1.0.5
 */

get_header();

	  /* Hook: lovage_before_content, lovage_before_main_content
	   * @Hooked: lovage_before_content()
	   */
	  do_action( 'lovage_before_content' );
	 
	  while ( have_posts() ) : the_post(); 

			get_template_part( 'template-parts/content', 'page' );

	  endwhile; // End of the loop. 

	  /* Hook: lovage_after_content
	   * @Hooked: lovage_after_content()
	   */
	  do_action( 'lovage_after_content' );
	 
get_footer();

