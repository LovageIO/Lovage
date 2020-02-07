<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

get_header(); ?>

	<?php
	  /* Hook: lovage_before_content
	   * @Hooked: lovage_before_content()
	   */
	  do_action( 'lovage_before_content' );
	?>

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'lovage' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'lovage' ); ?></p>
                    <br />
					<form role="search" method="get" id="searchform_default" class="searchform" action="<?php echo esc_url(home_url( '/' ));?>" >
					    <div class="lovage-search">
					    <input type="text" value="" name="s" id="s" />
					    <input type="submit" id="searchsubmit" value="" />
					    </div>
					</form>


				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		<?php
		  /* Hook: lovage_after_content
	       * @Hooked: lovage_after_content();
		   */
		  do_action( 'lovage_after_content' );
		?>

<?php get_footer(); ?>
