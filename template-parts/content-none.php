<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php echo esc_html__( 'Nothing Found', 'lovage' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php echo esc_html__( 'Ready to publish your first post?', 'lovage' ); ?> <a href="<?php esc_url( admin_url( 'post-new.php' ) ); ?>"><?php echo esc_html__( 'Get started here', 'lovage' ); ?></a></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lovage' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lovage' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
