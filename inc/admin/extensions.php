<?php
/**
 * Extensions for TGM usage.
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0.4.4
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
		'lovage-demo-import'  => array(
			'name'               => 'Lovage Demo Import',
			'slug'               => 'lovage-demo-import',
			'required'      	 => false,
			'pro_required'       => false,
			'source'			 => 'https://github.com/LovageIO/lovage-demo-import/archive/master.zip',
			'author'			 => 'Lovage',
			'description'		 => esc_html__( 'Preview and import Lovage demos.', 'lovage' ),
			'version'            => '1.0.0',
			'premium'			 => false,
			'buy_url'			 => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'image_url'          => 'https://ps.w.org/one-click-demo-import/assets/icon-256x256.png'
		),
		'lovage-blocks'  => array(
			'name'               => 'Lovage Blocks',
			'slug'               => 'lovage-blocks',
			'required'      	 => false,
			'author'			 => 'Lovage',
			'description'		 => esc_html__( 'Lovage Blocks offers some common blocks for Gutenberg editor.', 'lovage' ),
			'version'            => '0.0.1',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'image_url'          => LOVEAGE_INC_URI . 'admin/assets/img/lovage-block.png'
		),
		'lovage-portfolio'  => array(
			'name'               => 'Lovage Portfolio',
			'slug'               => 'lovage-portfolio',
			'required'      	 => false,
			'author'			 => 'Lovage',
			'description'		 => esc_html__( 'Lovage is a simple portfolio plugin that allows you to show your projects.', 'lovage' ),
			'version'            => '1.0.0',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'image_url'          => LOVEAGE_INC_URI . 'admin/assets/img/lovage-portfolio.png'
		),

    );

	array_merge( $lovage_extensions, apply_filters( 'lovage_add_extension', array() ) );
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
