<?php
/**
 * Lovage Plugin Page Templates
 *
 * @package Lovage
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if( class_exists('Lovage_Plugin_Page_Templates') ){
	return;
}

/**
 * Main Lovage_Plugin_Page_Templates Class.
 */
class Lovage_Plugin_Page_Templates {

	/**
	 * Page Template Value Prefix
	 * @since 1.0.0
	 */
	public $prefix = 'lovage-';

	/**
	 * Page Template List
	 * @since 1.0.0
	 */
	public $page_templates = array();

	/**
	 * Page Template Folder Path
	 * @since 1.0.0
	 */
	public $page_template_dir = '';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'theme_page_templates', array( $this, 'register_page_templates' ) );
		add_filter( 'template_include',     array( $this, 'load_page_template' ) );
	}

	/**
	 * Add plugin page template to the page attribute drop menu.
	 */
	public function register_page_templates( $page_template ){

		if( ! isset( $this->page_templates ) ){
			return;
		}

	    $page_template = array_merge( $page_template, $this->page_templates );
	    return $page_template;
	}

	/**
	 * Load page template from plugin
	 */
	public function load_page_template( $template ) {

		if( ! isset( $this->page_templates ) ){
			return;
		}

		foreach( $this->page_templates as $key => $value ){
			
			$key_strings = explode( $this->prefix, $key);
			$filename = $key_strings[1] . '.php';

		    if(  get_page_template_slug() === $key ) {
		        if ( $theme_file = locate_template( array( $filename ) ) ) {
		            $template = $theme_file;
		        } else {
		            $template = $this->page_template_dir . $filename;
		        }
		    }
	    }

	    if($template == '') {
	        throw new \Exception('No template found');
	    }

	    return $template;
	}

}