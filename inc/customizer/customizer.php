<?php
/**
 * Lovage Theme Customizer.
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!class_exists('Lovage_Theme_Customizer')){
	class Lovage_Theme_Customizer{

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Default Value Array
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $defaults = array();

		/**
		 * The prefix of settings
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $prefix = '_lovage';

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function __construct(){

			 $this->defaults = $this->default_value();

			 add_action( 'customize_register',     array($this,'customizer_init') );
			 add_action( 'customize_preview_init', array($this,'customize_preview_js') );
			 add_action( 'init', 				   array($this,'settings') );
			 add_action( 'setup_theme' ,     	   array($this,'save_default_settings'), 99 );
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customizer_init( $wp_customize ) {

			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		public function customize_preview_js() {
			wp_enqueue_script( 'customizer', LOVEAGE_INC_URI.'customizer/js/customizer.js', array( 'jquery', 'customize-preview' ), rand(), true );
		}

		/**
		 * Get Value of Settings.
		 */
		public function value($option){
			$handler = $this->prefix.'_'.$option;
			return get_theme_mod($handler, $this->defaults[$option]);
		}

		/**
		 * Get Value of typography.
		 */
		public function typography($option, $prop){
			$typography = json_decode($this->value($option), TRUE);

		    if( $prop == 'font_family' && $typography['font_family'] == 'System Default' ){
		    	return '-apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif';
		    }else{
		    	return isset( $typography[$prop] ) ? $typography[$prop] : null;
		    }
		}

		/**
		 * Default Value of Settings.
		 */
		public function default_value(){
			$default = array(
				'theme_link_color' 		   		=> '#11c39b',
				'theme_link_hover_color'  		=> '#009376',
				'theme_text_color'				=> '#000',
				'site_header_color'				=> '#ffffff',
				'site_title_color'				=> '#000000',
				
				'navigation_menu_color'			=> '#000000',
				'navigation_menu_hover_color'	=> '#11c39b',
				
				'footer_color'				    => '#ffffff',
				'footer_text_color'				=> '#000000',
				'footer_link_color'				=> '#000000',
				'footer_link_hover_color'		=> '#11c39b',
				
				'blog_title_color'				=> '#000000',
				'blog_title_hover_color'		=> '#11c39b',
				'theme_excerpt_color'			=> '#333333',
				
				'site_title_typography'			=> array(
													"font_family" => "System Default",
													"font_weight" => "600",
													"font_size"   => "24px",
													"subsets"     => "latin",
													"line_height" => "1em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'navigation_menu_typography'	=> array(
													"font_family" => "System Default",
													"font_weight" => "regular",
													"font_size"   => "14px",
													"subsets"     => "latin",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				
				'standard_blog_title_typography'=> array(
													"font_family" => "System Default",
													"font_weight" => "regular",
													"font_size"   => "32px",
													"subsets"     => "latin",
													"line_height" => "1.2em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),

				'site_paragraph_typography'		=> array(
													"font_family" => "System Default",
													"font_weight" => "regular",
													"font_size"   => "16px",
													"subsets"     => "latin",
													"line_height" => "1.6em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'h1_typography'					=> array(
													"font_family" => "System Default",
													"font_weight" => "600",
													"font_size"	  => "40px",
													"subsets"     => "latin",
													"line_height" => "1.2em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'h2_typography'					=> array(
													"font_family" => "System Default",
													"font_weight" => "600",
													"font_size"	  => "36px",
													"subsets"     => "latin",
													"line_height" => "1.2em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'h3_typography'					=> array(
													"font_family" => "System Default",
													"font_weight" => "600",
													"font_size"	  => "32px",
													"subsets"     => "latin",
													"line_height" => "1.2em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'h4_typography'					=> array(
													"font_family" => "System Default",
													"font_weight" => "600",
													"font_size"	  => "28px",
													"subsets"     => "latin",
													"line_height" => "1.3em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'h5_typography'					=> array(
													"font_family" => "System Default",
													"font_weight" => "600",
													"font_size"	  => "24px",
													"subsets"     => "latin",
													"line_height" => "1.3em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'h6_typography'					=> array(
													"font_family" => "System Default",
													"font_weight" => "600",
													"font_size"	  => "20px",
													"subsets"     => "latin",
													"line_height" => "1.5em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				
				'widget_title_typography'=> array(
													"font_family" => "System Default",
													"font_weight" => "regular",
													"font_size"   => "16px",
													"subsets"     => "latin",
													"line_height" => "1.5em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'widget_content_typography'=> array(
													"font_family" => "System Default",
													"font_weight" => "300",
													"font_size"   => "14px",
													"subsets"     => "latin",
													"line_height" => "1.5em",
													"letter_spacing" => "0px",
													"text_transform" => "inherit"
												  ),
				'header_layout'			  		  => 'standard',
				'header_border_color'			  => 'rgba(0,0,0,0.1)',
				'menu_buttons'					  => 1,
				'sticky_header'					  => 1,
				'header_image_height'			  => '300',
				'header_image_overlay_color'	  => 'rgba(0,0,0,0.4)',
				'header_image_text_color'         => '#ffffff',
				'header_image_border_color'       => 'rgba(255,255,255,0.2)',
				'header_title'					  => '',
				'header_subtitle'				  => '',
				
				'footer_widget_layout'			  => 3,
				'site_copyright'			  	  => '',

				'blog_archive_layout'			  => 'right-sidebar',

				'blog_post_layout'			  	  => 'one-column',
				'blog_post_author_card'			  => 1,
				'blog_post_related_post'		  => 1,
				'blog_post_related_post_show_by'  => 'related_tag',

				'button_color'		 			  => '#11c39b',
				'button_border_color'		  	  => '#11c39b',
				'button_text_color'		  	  	  => '#ffffff',
				'button_radius'		  	          => '0',
				'button_border_width'		  	  => '0',
				'button_hover_color'		  	  => '#009376',
				'button_hover_border_color'		  => '#009376',
				'button_hover_text_color'		  => '#ffffff',

				'text_field_color'		  		  => '#ffffff',
				'text_field_border_color'		  => '#ffffff',
				'text_field_text_color'		      => '#333',
				'text_field_radius'		  		  => '0',
				'text_field_border_width'		  => '0',
				'text_field_focus_color'		  => '#f9f9f9',
				'text_field_focus_border_color'	  => '#f9f9f9',
				'text_field_focus_text_color'	  => '#000000',

				'textarea_color'		  		  => '#ffffff',
				'textarea_border_color'		      => '#ffffff',
				'textarea_text_color'		      => '#333',
				'textarea_radius'		  		  => '0',
				'textarea_border_width'		  	  => '0',
				'textarea_focus_color'		      => '#f9f9f9',
				'textarea_focus_border_color'	  => '#f9f9f9',
				'textarea_focus_text_color'	  	  => '#000000',
				
				'head_codes'		  			  => '',
				'footer_codes'		  			  => '',

				'shop_sidebar'					  => 0
			);

			return apply_filters('lovage_customizer_default_settings', $default);
		}

		/**
		 * Get the default settings
		 */
		public function get_default( $key ){
			$defaults = $this->default_value();
			return isset( $defaults[$key] ) ? $defaults[$key] : '';
		}

		/**
		 * Save the default settings
		 */
		public function save_default_settings(){
			foreach($this->default_value() as $mod => $value){
				set_theme_mod( $mod, $value ); 
			}
		}

		/**
		 *  Settings
		 */
		public function settings(){

			load_template( LOVEAGE_INC_DIR.'customizer/customizer-rendering.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'customizer/customizer-sanitize.php', TRUE );

			/* Load Settings */
			load_template( LOVEAGE_INC_DIR.'customizer/settings/settings-colors.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'customizer/settings/settings-components.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'customizer/settings/settings-layout.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'customizer/settings/settings-typography.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'customizer/settings/settings-codes.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'customizer/settings/settings-woocommerce.php', TRUE );

			$options = array_merge(
				$GLOBALS[ 'lovage_setting_colors' ], 
				$GLOBALS[ 'lovage_setting_components' ], 
			    $GLOBALS[ 'lovage_setting_typography' ], 
				$GLOBALS[ 'lovage_setting_layout' ], 
				$GLOBALS[ 'lovage_setting_codes' ], 
				$GLOBALS[ 'lovage_setting_woocommerce' ]
			);

			$settings = array(
		        'prefix'     => $this->prefix,
		        'capability' => 'edit_theme_options', 
		        'type'       => 'theme_mod',
		        'options'    => apply_filters('lovage_customizer_options', $options)
			);

			/* Instantiate a new Lovage_Customizer Object */
			new Lovage_Customizer($settings);
		}


	}
}

function lovage_theme_customizer(){
    return Lovage_Theme_Customizer::get_instance();
}

return lovage_theme_customizer();