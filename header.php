<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6 no-js" lang="en-US"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7 no-js" lang="en-US"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8 no-js" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link" tabindex="1" href="#content"><?php esc_html_e( 'Skip to content', 'lovage' ); ?></a>

<?php wp_body_open(); ?>

<div id="body-container">

    <?php do_action( 'lovage_before_header' ); ?>

	<header id="masthead" <?php lovage_header_class(); ?>>

		<?php
			/**
			 * Hook lovage_header
			 * @hooked lovage_before_navigation - 10
			 * @hooked lovage_custom_logo - 20
			 * @hooked lovage_primary_navigation - 30
			 * @hooked lovage_top_buttons - 40
			 * @hooked lovage_after_navigation - 50
			 * @hooked lovage_site_header_image - 60
			 */
			do_action( 'lovage_header' );
		?>
	</header><!-- #masthead -->
	
	<?php do_action( 'lovage_after_header' ); ?>
