<?php
/**
 * Related Posts
 *
 * @package Lovage
 * @author Lovage
 * @version 1.0
 * @link https://lovage.io
 */

if ( lovage_theme_customizer()->value('blog_post_related_post') ) {
	
	if ( lovage_theme_customizer()->value('blog_post_related_post_show_by') == 'related_cat' ) {
		$lovage_taxs = get_the_category( $post->ID ); // Display related posts by category
	} else {
		$lovage_taxs = wp_get_post_tags( $post->ID ); // Display related posts by tag
	}
	
	
	if ( $lovage_taxs ) {
	
		$lovage_tax_ids = array();
	
		foreach($lovage_taxs as $individual_tax) $lovage_tax_ids[] = $individual_tax->term_id;
	
		$posts_to_show = 3;
	
		if ( lovage_theme_customizer()->value('blog_post_related_post_show_by') == 'related_cat' ) { 
			// Loop argumnetsnts show posts by category
			$args = array(
				'category__in' => $lovage_tax_ids,
				'post__not_in' => array( $post->ID ),
				'posts_per_page' => $posts_to_show,
				'ignore_sticky_posts' => 1
			);
		} else { 
			// Loop argumnetsnts show posts by category
			$args = array(
				'tag__in' => $lovage_tax_ids,
				'post__not_in' => array( $post->ID ),
				'posts_per_page' => $posts_to_show,
				'ignore_sticky_posts' => 1
			);
		}
	
		$lovage_related_posts = new WP_Query( $args );
		if( $lovage_related_posts->have_posts() ){ 
	?>
		
	    <section class="related-posts">
	    
	        <h3 class="section-title"><?php echo esc_html__( 'You may also like', 'lovage' ); ?></h3>
	    
	        <div class="grids">
	            <?php 
					while ( $lovage_related_posts->have_posts() ) : $lovage_related_posts->the_post(); 
					if(has_post_thumbnail()):
				?>
					<div class="item post">
						  <div class="thumbnail">
						      <a title="<?php esc_attr(get_the_title());?>" href="<?php echo esc_url(get_permalink());?>">
								<?php 
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'medium' );
								}
								?></a>
						  </div>
						  <header class="entry-header">
							  <h6 class="entry-title"><a href="<?php echo esc_url(get_permalink());?>"><?php the_title(); ?></a></h6>
						  </header>
					</div>
				
				<?php 
				    endif;
					endwhile; 
					wp_reset_postdata();
				?>
	            
	            <div class="clearfix"></div>
	
	         </div>
	    </section>
	
	<?php 
	   }
	}
 }	