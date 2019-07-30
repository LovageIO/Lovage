<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

get_header(); 

	   /* Hook: lovage_before_content, lovage_before_main_content
	    * @Hooked: lovage_before_content()
	    * @Hooked: lovage_before_main_content();
	    */
	    do_action('lovage_before_content');

	    if( is_active_sidebar( 'sidebar' ) ){
	    	do_action('lovage_before_main_content');
		}

	    if ( have_posts() ) : 

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
			endwhile; 

			echo lovage_pagenavi(); 

		 else : 

		    get_template_part( 'template-parts/content', 'none' ); 

		endif; 

		if( is_active_sidebar( 'sidebar' ) ){
			/* Hook: lovage_after_main_content
			 * @Hooked: lovage_after_main_content();
			 */
			do_action('lovage_after_main_content');
			get_sidebar(); 
	    }
	
	    /* Hook: lovage_after_content
	     * @Hooked: lovage_after_content();
	     */
		 do_action('lovage_after_content');	 

get_footer();
