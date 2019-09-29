<?php
/**
 * Widget Module
 * @package core/modules/lovage-widget
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists('Lovage_Widget') ){
	class Lovage_Widget{

		public $widgets = array(
			array(
			  'id'   		=>   'sidebar',
			  'name' 		=>   'Sidebar',
			  'description' => 	 ''			
			)
		);

		public $widget_tags = array(
			array(
			  'before_widget' => '<div id="%1$s" class="widget %2$s">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h4 class="widget-title">',
			  'after_title'   => '</h4>',
			)
		);

	    /**
		 * Constructor Class
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'widgets_init',               array( $this, 'register' ) );
		}

		/**
		 * Register Widget Class
		 * @since 1.0
		 */
		public function register(){
			
			$widget = array();

			if ( is_array( $this->widgets ) ) {
				foreach($this->widgets as $widget){
					$widget = array(
						'name'        => $widget['name'],
						'id'          => $widget['id'],
						'description' => $widget['description'],
					);
					$widget = array_merge($widget, $this->widget_tags);
					register_sidebar( $widget );
				}
			}
		}

	}
}