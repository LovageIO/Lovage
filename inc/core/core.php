<?php
/**
 * Lovage Framework
 * @author Lovage
 * @link https://lovage.io
 * @package lovage/inc/core
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if(!class_exists('Lovage_Core')){
	
	class Lovage_Core{
		/**
		 * Modules
		 *
		 * @since 0.0.1
		 * @var   object
		 */
	    public $chosen_modules = array(
				'lovage-customizer',
				'lovage-widget'
		);

		private $required_modules = array(
				'lovage-customizer',
				'lovage-metabox',
		);

		/**
		 * Setup class.
		 * @since 0.0.1
		 */
		public function __construct() {
			$this->include_modules();
		}	

		/**
		 * Load Modules
		 * @since 0.0.1
		 */
		public function include_modules(){

			$chosen_modules   = $this->chosen_modules;
			$required_modules = $this->required_modules;

			if ( ! is_array( $chosen_modules ) ) {
                return;
            }

            if ( ! is_array( $required_modules ) ) {
                return;
            }

            $load_modules = array_merge($required_modules, $chosen_modules);

            foreach ( $load_modules as $module ) {
              
                $path = LOVEAGE_CORE_DIR.'modules/'. $module .'/class-'.basename( $module ) . '.php';

                if ( file_exists( $path ) ) {
                    require_once $path;
                }
            }
		}

	}
}