<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */


/**
 * Hook: lovage_footer
 * @Hooked  lovage_bottom_widgets()
 * @Hooked  lovage_before_footer()
 * @Hooked  lovage_copyright()
 * @Hooked  lovage_after_footer()
 */
 do_action( 'lovage_footer' );
?>
</div><!-- #body-container -->

<?php wp_footer(); ?>
</body>
</html>