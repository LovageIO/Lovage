<?php
/**
 * plugins Page
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
  exit( 'Direct script access denied.' );
}
?>

<div class="section">

	  <div class="page_description">
	  	<?php echo apply_filters('lovage_plugins_page_description',esc_html__('We handpicked some useful and high quality 3rd-party plugins which can help you make things easy. Please note, some of these plugins are premium plugins or has Pro version. ','lovage'));?>
	  </div>

      <?php
	     $lovage_plugins = array(
			  array(
			    'slug' => 'elementor'
			  ),
			  array(
			    'slug' => 'woocommerce'
			  ),
			  array(
			    'slug' => 'contact-form-7'
			  ),
			  array(
			  	'slug' => 'wp-gdpr-compliance'
			  ),
			  array(
			  	'slug' => 'cookie-notice'
			  )
		 );

		 array_merge($lovage_plugins, apply_filters('lovage_add_plugins', array()));

		 if(class_exists('Lovage_Plugin_Installer')){
		    Lovage_Plugin_Installer::init($lovage_plugins);
		 }
      ?>
      <div style="clear:both"></div>
</div>