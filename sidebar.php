<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Lovage
 * @author Lovage
 * @version 1.0
 */

$sidebar_id = 'sidebar';

if( is_page() && ! is_page_template( 'page-templates/page-blog-template.php' ) ){
	$sidebar_id = 'sidebar-page';
}

if( class_exists( 'woocommerce' ) ){
	if( is_shop() || is_product_category() || is_product_tag() || is_product() ){
		$sidebar_id = 'sidebar-shop';
	}
}

if ( ! is_active_sidebar( $sidebar_id ) ) {
	return;
}
?>

<div id="secondary" class="lovage-grid lovage-col3 widget-area" role="complementary">
	<?php dynamic_sidebar( $sidebar_id ); ?>
</div>