<?php
/**
 * Lovage Scripts Loader Module
 * @package core/modules/lovage-metabox
 * @version 1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Lovage_Scripts_Loader' ) ) {

	class Lovage_Scripts_Loader{

		/**
		 * Javascript Files 
		 * Example:
		 * array(
				'handler1' => array(
					'file_name'    => 'imagesLoaded',
					'path'         => ''
				),
				'handler2' => array(
					'file_name'    => 'masonry',
					'path'         => ''
				),
		   );
		 */
		private $js = array();

		/**
		 * CSS Files 
		 * Example:
		 * array(
			  'handler1' => array(
			  	 'file_name' => 'lovage-style',
			  	 'path'      => '',
			  ),
			  'handler2' => array(
			  	 'file_name' => 'lovage-icons',
			  	 'path'      => '',
			  ),
			);
		 */
		private $css = array();

		/**
		 * Lovage Upload Directory Path
		 */
		public $lovage_dir = '';

		/**
		 * Lovage Upload Directory uri
		 */
		public $lovage_dir_uri = '';

		/**
		 * Lovage Upload Dirtectory Name
		 */
		public $lovage_dirname = 'lovage';

		/**
		 * Lovage merged CSS File Name
		 */
		public $lovage_merged_css = 'app.css';

		/**
		 * Lovage merged JS File Name
		 */
		public $lovage_merged_js = 'app.js';

		/**
		 * Mark if Lovage folder is generated.
		 */
		private $folder_exist = false;

		/**
		 * Mark if the merged css file is generated.
		 */
		private $css_file_exist = false;

		/**
		 * Mark if the merged js file is generated.
		 */
		private $js_file_exist = false;

		/**
		 * Mark if the mergedd css file is empty.
		 */
		private $css_file_empty = true;

		/**
		 * Mark if the merged js file is empty.
		 */
		private $js_file_empty = true;

		/**
		 * Setup class.
		 * @since 1.0.4
		 */
		public function __construct() {

			$upload_dir = wp_upload_dir();
			
			// Define Lovage Upload Dir Path and URI
			if( is_multisite() ){

				if( get_current_blog_id() == 1 ){
					$this->lovage_dir = trailingslashit( $upload_dir[ 'basedir' ] ). $this->lovage_dirname;
					$this->lovage_dir_uri = trailingslashit( $upload_dir[ 'baseurl' ] ). $this->lovage_dirname;
				}else{
					$this->lovage_dir = trailingslashit( $upload_dir[ 'basedir' ] ) . trailingslashit( $this->lovage_dirname ) . get_current_blog_id();
					$this->lovage_dir_uri = trailingslashit( $upload_dir[ 'baseurl' ] ) . trailingslashit( $this->lovage_dirname ) . get_current_blog_id();
				}

			}else{
				$this->lovage_dir = trailingslashit( $upload_dir[ 'basedir' ] ). $this->lovage_dirname;
				$this->lovage_dir_uri = trailingslashit( $upload_dir[ 'baseurl' ] ). $this->lovage_dirname;
			}

			$this->create_upload_dir();
			$this->init_file();

			add_action( 'wp_enqueue_scripts',  array( $this, 'load_scripts' ), 20 );
		}

		public function add_css( $css ){
			$this->css = $css;
		}

		public function add_js( $js ){
			$this->js = $js;
		}

		/**
		 * Create the site script folder
		 * @since 1.0.4
		 */
		public function create_upload_dir(){

			if ( ! file_exists ( $this->lovage_dir )  ){
				wp_mkdir_p( $this->lovage_dir );
			}

			$this->folder_exist = true;

		}

		/**
		 * Create the init merged extension JS/CSS File
		 * @since 1.0.4
		 */
		public function init_file() {
			
			if ( $this->folder_exist &&  ! file_exists( trailingslashit( $this->lovage_dir ) . $this->lovage_merged_css ) ) {
				 $this->write( get_permalink(), '', trailingslashit( $this->lovage_dir ), $this->lovage_merged_css );
				 $this->css_file_exist = true;
			}

			if ( $this->folder_exist && ! file_exists( trailingslashit( $this->lovage_dir ) . $this->lovage_merged_js ) ) {
				$this->write( get_permalink(), '', trailingslashit( $this->lovage_dir ), $this->lovage_merged_js );
				$this->css_file_exist = true;
			}
		}

		/**
		 * Merge the all JS/CSS Files
		 * @since 1.0.4
		 */
		public function merge_files() {

			/* Read the merged files first before write new thing to the file */
			$css_content = $this->css_file_exist = true ? $this->read( trailingslashit( $this->lovage_dir ), $this->lovage_merged_css ) : '';
			$js_content = $this->css_file_exist = true ? $this->read( trailingslashit( $this->lovage_dir ), $this->lovage_merged_js ) : '';

			/* Load CSS Files */
			if( count( $this->css ) > 0 ){
				foreach( $this->css as $file ){
					if( isset( $file['path'] ) && isset( $file['file_name'] ) ){
					 	$new_css_content = $this->read( $file['path'], $file['file_name'] );

					 	if( ! empty( $new_css_content ) && strpos( $css_content, $new_css_content ) !== false ){
					 		$css_content = $new_css_content . PHP_EOL . PHP_EOL;
					 	}else{
					 		$css_content .= $new_css_content . PHP_EOL . PHP_EOL;
					 	}
					}
				}
			}

			/* Load JS Files */
			if( count( $this->js ) > 0 ){
				foreach( $this->js as $file ){
					if( isset( $file['path'] ) && isset( $file['file_name'] ) ){
					 	$new_js_content = $this->read( $file['path'], $file['file_name'] );

					 	if( ! empty( $new_js_content ) && strpos( $js_content, $new_js_content ) !== false ){
					 		$js_content = $new_js_content . PHP_EOL . PHP_EOL;
					 	}else{
					 		$js_content .= $new_js_content . PHP_EOL . PHP_EOL;
					 	}
					}
				}
			}
			
			if ( $this->folder_exist &&  file_exists( trailingslashit( $this->lovage_dir ) . $this->lovage_merged_css ) ) {
				 $this->write( get_permalink(), $css_content, $this->lovage_dir, $this->lovage_merged_css );
				 $this->css_file_empty = false;
			}

			if ( $this->folder_exist && file_exists( trailingslashit( $this->lovage_dir ) . $this->lovage_merged_js ) ) {
				$this->write( get_permalink(), $js_content, $this->lovage_dir, $this->lovage_merged_js );
				$this->js_file_empty = false;
			}

		}

		/**
		 * Load CSS/JS
		 * @since 1.0.4
		 */
		public function load_scripts(){

			$merged_css = trailingslashit( $this->lovage_dir_uri ) . $this->lovage_merged_css;
			$merged_js = trailingslashit( $this->lovage_dir_uri ) . $this->lovage_merged_js;

			if( ! $this->js_file_empty ){
				/* Load CSS Files */
				wp_enqueue_style( 'lovage-extensions', $merged_css, '' );
			}

			if( ! $this->css_file_empty ){
				/* Load JS Files */
				wp_enqueue_script( 'lovage-extensions', $merged_js, array( 'jquery' ), '', true );	
			}
		}

		/**
         * Write file
         * @return file content 
         * @since 1.0.4
         */
      	public function write( $form_url, $content, $path, $filename){
          
	          $file = $path . '/' . $filename;

	          if ( empty( $wp_filesystem ) ) {
	              require_once ( ABSPATH.'/wp-admin/includes/file.php' );
	          }
	         
	          WP_Filesystem();

	          global $wp_filesystem;
	          
	          $form_url = wp_nonce_url( $form_url, '' );
	         
	          if ( false === ( $creds = request_filesystem_credentials( $form_url, '', false, false, null ) ) ) {
	              return; 
	          }

	          //check if credentials are correct or not.
	          if( ! WP_Filesystem( $creds ) ) {
	              request_filesystem_credentials( $form_url, $method, true, $file );
	              return false;
	          }

	          if ( ! $wp_filesystem->put_contents( $file, $content, FS_CHMOD_FILE ) ){
	             return new WP_Error('writing_error', 'Error when writing file'); 
	          }

	          return $content;
        }

        /**
      	 * Read file
         * @return file content
         * @since 1.0.4
         */
      	public function read( $path, $filename ){
	       
	        global $wp_filesystem;

	        if ( empty( $wp_filesystem ) ) {
	            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
	            WP_Filesystem();
	        }

	        // Define the path to file
	        $file = trailingslashit( $path ) . $filename;
	        $content = '';

	        if ( ! $wp_filesystem->exists( $file ) ) {
	            // File doesn't exist, output error
	            die( 'file not found' );
	        } else {
	            return $wp_filesystem->get_contents( $file );
	        }
        }

	}

}