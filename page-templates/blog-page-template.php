<?php
/**
 * Template Name: Blog Template
 */

get_header(); 

	   /* Hook: lovage_before_content, lovage_before_main_content
	    * @Hooked: lovage_before_content()
	    * @Hooked: lovage_before_main_content();
	    */
	    do_action('lovage_before_content');

	    if( is_active_sidebar( 'sidebar' ) && lovage_has_sidebar() ){
	    	do_action('lovage_before_main_content');
		}

	    if ( have_posts() ) : 
				  
            $limit = get_option('posts_per_page');
	        
	        if(!is_front_page()){
	          $lovage_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	        }else{		       
	          $lovage_paged = (get_query_var('page')) ? get_query_var('page') : 1;
	        }

	        query_posts( array( 'post_type' => 'post','posts_per_page' => $limit,'paged' => $lovage_paged ) );
			
			while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
			endwhile; 

		   lovage_pagenavi( TRUE ); 

		 else : 

		    get_template_part( 'template-parts/content', 'none' ); 

		endif; 

		if( is_active_sidebar( 'sidebar' ) && lovage_has_sidebar() ){
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