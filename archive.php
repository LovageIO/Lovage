<?php
/**
 * The template for displaying archive pages.
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
		do_action( 'lovage_before_content' );
		do_action( 'lovage_before_main_content' );
		 
		if ( have_posts() ) : ?>

			<header class="lovage_intro">
				<?php
				    the_archive_title( '<h2>', '</h2>' );
					the_archive_description( '<p class="taxonomy-description">', '</p>' );
				?>
				<div class="divider"></div>
			</header><!-- .page-header -->


			<?php while ( have_posts() ) : the_post(); 

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				 endwhile; 

			     lovage_pagenavi( true ); 

		else : 

			 get_template_part( 'template-parts/content', 'none' ); 

        endif; 

		/* Hook: lovage_after_main_content
		 * @Hooked: lovage_after_main_content();
		 */
		do_action( 'lovage_after_main_content' );


        get_sidebar();
	

	    /* Hook: lovage_after_content
	     * @Hooked: lovage_after_content();
	     */
		do_action( 'lovage_after_content' );	 
  
 get_footer();
