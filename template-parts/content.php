<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

$featured_image_alignment = get_post_meta(get_the_ID(), '_lovage_featured_alignment', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('thumbnail-float-'.esc_html($featured_image_alignment)); ?>>
    <?php if( has_post_thumbnail() && !get_post_meta(get_the_ID(), '_lovage_hide_single_featured_image', true) ):?>
	<a href="<?php echo esc_url( get_permalink() );?>" rel="bookmark" class="featured_thumbnail" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url(get_the_ID(), 'full') ); ?>);"></a>
	<?php endif;?>
	
	<div class="entry-body">
		<header class="entry-header">
			<?php echo wp_kses_post( get_the_category_list() ); ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php lovage_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			
			if( !has_post_thumbnail() || get_post_meta(get_the_ID(), '_lovage_hide_single_featured_image', true) ){
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lovage' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			}else{
				the_excerpt();
				echo '<p><a href="'.esc_url(get_permalink()).'">'.esc_html__('Continue reading','lovage').' <span class="meta-nav">&rarr;</span></a></p>';
			}
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lovage' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</div>

</article><!-- #post-## -->
