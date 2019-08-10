<?php
/**
 * Post Author Section
 * 
 * @author Lovage
 * @package Lovage
 * @link https://lovage.io
 * @version 1.0
 */
?>

<?php if ( lovage_theme_customizer()->value('blog_post_author_card') ):?>

    <!--Author-->
	<section id="author_vcard">
		
		<h3 class="author-title"><?php esc_html_e('About Author','lovage');?></h3>
		<a class="avatar" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?></a>
		<p><strong><?php the_author_meta('nickname'); ?></strong>	</p>
		
		<?php the_author_meta('description'); ?> 

		<p><span class="social_icons"><?php do_action('lovage_author_social_profile');?></span></p>
	</section>

<?php endif;?>