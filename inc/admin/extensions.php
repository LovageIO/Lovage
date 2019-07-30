<?php
/**
 * Extensions for TGM usage.
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


/**
 * Gets all recommended and required plugins for use in TGM plugin.
 *
 * @since 5.1.6
 */
function lovage_get_extensions() {

	$lovage_extensions = array(
		'one-click-demo-import'  => array(
			'name'               => 'One Click Demo Import',
			'slug'               => 'one-click-demo-import',
			'required'           => false,
			'author'			 => 'Proteus Themes',
			'description'		 => esc_html__( 'Preview and import Lovage demos.', 'lovage' ),
			'version'            => '2.5.1',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => 'https://github.com/proteusthemes/one-click-demo-import',
			'image_url'          => 'https://ps.w.org/one-click-demo-import/assets/icon-256x256.png'
		)
    );

	array_merge( $lovage_extensions, apply_filters('lovage_add_extension', array()) );
	return $lovage_extensions;
}

/**
 * Require the installation of any required and/or recommended third-party plugins here.
 * See http://tgmpluginactivation.com/ for more details
 */
function lovage_register_extensions() {

	// Get all required and recommended plugins.
	$plugins = lovage_get_extensions();

	// Change this to your theme text domain, used for internationalising strings.
	$theme_text_domain = 'lovage';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'        	=> $theme_text_domain,
		'default_path'  	=> '',
		'parent_slug' 		=> 'themes.php',
		'menu'            	=> 'lovage-extensions',
		'has_notices'     	=> true,
		'is_automatic'    	=> true,
		'message'         	=> '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'lovage_register_extensions' );


/**
 * Returns the user capability for showing the notices.
 *
 * @return string
 */
function lovage_tgm_show_admin_notice_capability() {
	return 'edit_theme_options';
}
add_filter( 'tgmpa_show_admin_notice_capability', 'lovage_tgm_show_admin_notice_capability' );
