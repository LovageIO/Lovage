<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

$featured_image_alignment = get_post_meta(get_the_ID(), '_lovage_featured_alignment', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'thumbnail-float-'.esc_html( $featured_image_alignment ) ); ?>>
    
    <?php if( has_post_thumbnail() && ! get_post_meta( get_the_ID(), '_lovage_hide_single_featured_image', true ) ):?>
	<a href="<?php echo esc_url( get_permalink() );?>" rel="bookmark" class="featured_thumbnail" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) );?>) ;"></a>
	<?php endif;?>

	<header class="entry-header">
		<?php echo wp_kses_post( get_the_category_list() );?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php lovage_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 

		/* Output full content */
	    the_content(); 

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lovage' ),
			'after'  => '</div>',
		) );
	    
	    //Tags
	    $posttags=get_the_tags();
	    if($posttags <>''):
	    ?>
		    <div class="taglist">
		      <?php echo esc_html__('Post Tags','lovage');?>: <?php the_tags('',' '); ?>
		    </div>  
	    <?php endif;?>
    
	</div><!-- .entry-content -->
    
</article><!-- #post-## -->

