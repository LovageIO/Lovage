<?php
/**
 * Lovage Customizer Module
 * @package lovage/inc/core/lovage-customizer
 * @version 1.0
 * Changed From Cherry Customizer 
 * @link https://github.com/CherryFramework/cherry-framework/blob/master/modules/cherry-customizer/cherry-customizer.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!class_exists('Lovage_Customizer')){
	class Lovage_Customizer{
		/**
		 * WP_Customize_Manager instance.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @var object.
		 */
		protected $customize;

		/**
		 * Capability.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @var string
		 */
		protected $capability;

		/**
		 * Setting type.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @var string
		 */
		protected $type;

		/**
		 * Unique prefix.
		 * This is a theme or plugin slug.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @var string
		 */
		protected $prefix;

		/**
		 * options.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @var array
		 */
		protected $options;

	    /**
		 * Constructor Class
		 * @since 1.0
		 */
		public function __construct($args) {
			add_action( 'customize_register', array( $this, 'register' ) );

			if(is_customize_preview()){
 		    	$this->include_custom_controls();
 			}
 			
 		    if(empty( $args['type'] || empty( $args['options'] ))){
 		    	return;
 		    }

 		    $this->type = ! empty( $args['type'] ) && in_array( $args['type'], array( 'theme_mod', 'option' ) ) ? $args['type'] : 'theme_mod';
 		    $this->capability = ! empty( $args['capability'] ) ? $args['capability'] : 'edit_theme_options';
 		    $this->prefix 	  = ! empty( $args['prefix'] ) ? $args['prefix'] : '';
 		    $this->options    = $args['options'];

 		    add_action( 'customize_controls_enqueue_scripts', array($this, 'customize_register_scripts'), 0 );

		}

		public function include_custom_controls(){

			/* Include Customizer Control Typs */
			$control_types = apply_filters('lovage_customizer_control_types',
				array(
					'toggle'	 	    => 'controls/class-customizer-control-toggle.php',
					'radio-image'	    => 'controls/class-customizer-control-radio-image.php',
					'checkbox-sortable' => 'controls/class-customizer-control-sortable-checkbox.php',
					'multi-checkbox'    => 'controls/class-customizer-control-multi-checkbox.php',
					'iconpicker'        => 'controls/class-customizer-control-iconpicker.php',
					'typography'        => 'controls/class-customizer-control-typography.php',
					'title'        		=> 'controls/class-customizer-control-title.php',
					'range-slider'      => 'controls/class-customizer-control-range-slider.php',
					'checkbox-image'    => 'controls/class-customizer-control-image-checkbox.php',
					'alpha-color'       => 'controls/class-customizer-control-alpha-color.php',
					'lovage-pro-installer' => 'controls/class-customizer-control-pro-installer.php'
				)
			);

			foreach($control_types as $key => $val){
				require_once $val;
			}
		}

		/**
		 * Register Scripts
		 * so we can easily load this scripts multiple times when needed (?)
		 */
		function customize_register_scripts(){
			/* CSS */
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'lovage-customize', LOVEAGE_CORE_URI . 'modules/lovage-customizer/assets/customize-controls.css' );
			
			/* JS */
		    wp_enqueue_script( 'wp-color-picker');
			wp_enqueue_script( 'lovage-customize', LOVEAGE_CORE_URI . 'modules/lovage-customizer/assets/customize-controls.js', array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-slider', 'customize-controls' ) );
			wp_localize_script('lovage-customize', 'lovage_customizer_data', array(
				'localFontFile' => LOVEAGE_CORE_URI.'modules/lovage-customizer/cache/google-fonts.json',
			));
		}

		/**
		 * Registeration for a new panel, sections, settings and controls.
		 *
		 * @since 1.0.0
		 * @param object $wp_customize WP_Customize_Manager instance.
		 */
		public function register( $wp_customize ) {
			// Failsafe is safe.
			if ( ! isset( $wp_customize ) ) {
				return;
			}
			$this->customize =  $wp_customize;

			foreach ( (array) $this->options as $id => $option ) {
				if ( empty( $option['type'] ) ) {
					continue;
				}
				if ( 'panel' === $option['type'] ) {
					$this->add_panel( $id, $option );
				}
				if ( 'section' === $option['type'] ) {
					$this->add_section( $id, $option );
				}
				if ( 'control' === $option['type'] ) {
					$this->add_setting( $id, $option );
				}
			}
		}

		public function add_panel($panel_id, $args=array()){

			$this->customize->add_panel(
		        $panel_id,
		        array(
		            'title' 			=> isset($args['title'])?esc_html($args['title']):null,
		            'capability'		=> $this->capability,
		            'theme_supports'	=> isset($args['theme_supports'])?esc_html($args['theme_supports']):null,
		            'description' 		=> isset($args['description'])?esc_html($args['description']):null,
		            'priority' 			=> isset($args['priority'])?esc_html($args['priority']):'20',
		            'active_callback' 	=> isset($args['active_callback'])?esc_html($args['active_callback']):null
		        )
		    );
		}

		public function add_section($section_id, $args=array()){

			$section_id          = $section_id;
			$section_title 		 = isset($args['title']) ? esc_html($args['title']) : '';
			$section_description = isset($args['description']) ? esc_html($args['description']) : '';
			$priority			 = isset($args['priority']) ? esc_html($args['priority']) : '20';
			$active_callback	 = isset($args['active_callback']) ? esc_html($args['active_callback']) : '';
			$panel 			     = isset($args['panel']) ? esc_html($args['panel']) : '';
			$theme_supports      = isset($args['theme_supports'] ) ? $args['theme_supports'] : '';

			$this->customize->add_section(
		        $section_id,
		        array(
		            'title' 			=> $section_title,
		            'description' 		=> $section_description,
		            'capability'        => $this->capability,
		            'priority' 			=> $priority,
		            'theme_supports'    => $theme_supports,
		            'active_callback' 	=> $active_callback,
		            'panel'				=> $panel
		        )
		    );
		}

		public function add_setting($field_id, $args=array()){

			$control_class        = '';
			$field_id 			  = $this->prefix.'_'.$field_id;
			$field_type			  = isset($args['field'] ) ? esc_attr( $args['field'] ) : 'text';

			if($field_type !== 'typography'){
				$default  = isset($args['default']) ? esc_html($args['default']) : '';
			}else{
				if(isset($args['default'])){
					$default = json_encode($args['default']);
				}else{	
					$default = json_encode(array(
				  	 	'font_family' => 'inherit',
				  	 	'font_weight' => 'inherit',
				  	 	'font_size'   => 'inherit',
				  	 	'subsets'     => 'inherit',
				  	 	'line_height' => 'inherit'
				  	 ));
				}
			}

			$sanitize_callback    = isset($args['sanitize_callback']) ? esc_html($args['sanitize_callback']) : 'sanitize_text_field';
			$sanitize_js_callback = isset($args['sanitize_js_callback']) ? esc_html($args['sanitize_js_callback']) : '';
			$transport 			  = isset($args['transport'])? esc_html($args['transport']) : 'refresh';
			$section 			  = isset($args['section']) ? esc_html($args['section']) : '';
			$title                = isset($args['title']) ? esc_html($args['title']) : '';
			$priority			  = isset($args['priority']) ? esc_html($args['priority']) : '10';
			$active_callback      = isset($args['active_callback'])? esc_html($args['active_callback']) : '';
			$description     	  = isset($args['description'])? esc_html($args['description']) : '';

			$this->customize->add_setting( 
			  $field_id , 
			  array(
	              'default' 			 => $default,
	              'sanitize_callback' 	 => $sanitize_callback,
	              'sanitize_js_callback' => $sanitize_js_callback,
	              'capability'			 => $this->capability,
	              'transport'   		 => $transport,
	              'type'				 => $this->type
              ) 
			);

			$control_args = array(
           	  	  'settings' 		=> $field_id,
	              'label' 			=> $title,
	              'description'     => $description,
	              'section' 		=> $section,
	              'priority' 		=> $priority,
	              'active_callback' => $active_callback
            );

			switch($field_type){

				case 'lovage-pro-installer':
				  $control_class = 'Lovage_Customize_Control_Pro_Installer';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'color':
				  $control_class = 'WP_Customize_Color_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'alpha-color':
				  $control_class = 'Lovage_Customize_Control_Alpha_Color';
				  $control_args  = wp_parse_args( array(
				  	'type' => $field_type
				  ), $control_args );
				  break;

				case 'upload':
				  $control_class = 'WP_Customize_Upload_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'image':
				case 'background':
				  $control_class = 'WP_Customize_Image_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'iconpicker':
				  $control_class = 'Lovage_Customize_Iconpicker_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'background_position':
				  $control_class = 'WP_Customize_Background_Position_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'date_time':
				  $control_class = 'WP_Customize_Date_Time_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'range-slider':
				  $control_class = 'Lovage_Customize_Range_Slider_Control';
				  $control_args  = wp_parse_args( array(
				  	'type' => $field_type,
				  	'input_attrs' => isset($args['input_attrs']) ? $args['input_attrs'] : array()
				  ), $control_args );
				  break;

				case 'header':
				  $control_class = 'WP_Customize_Header_Image_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'radio-image':
				  $control_class = 'Lovage_Customize_Radio_Image_Control';
				  $control_args = wp_parse_args(array(
				  	'type' 		  => $field_type,
				  	'choices' 	  => isset( $args['choices'] ) ? $args['choices'] : array()
				  ), $control_args );
				  break;

				case 'checkbox-image':
				  $control_class = 'Lovage_Customize_Image_Checkbox_Control';
				  $control_args = wp_parse_args(array(
				  	'type' 		  => $field_type,
				  	'choices' 	  => isset( $args['choices'] ) ? $args['choices'] : array()
				  ), $control_args );
				  break;

				case 'toggle':
				  $control_class = 'Lovage_Customize_Toggle_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'sidebar_widgets':
				  $control_class = 'WP_Widget_Area_Customize_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'widget_form':
				  $control_class = 'WP_Widget_Form_Customize_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'custom_css':
				  $control_class = 'WP_Customize_Custom_CSS_Setting';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'code_editor':
				  $control_class = 'WP_Customize_Code_Editor_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'typography':
				  $control_class = 'Lovage_Customize_Typography_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'title':
				  $control_class = 'Lovage_Customize_Title_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'media':
				  $control_class = 'WP_Customize_Media_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'site_icon':
				  $control_class = 'WP_Customize_Site_Icon_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'cropped_image':
				  $control_class = 'WP_Customize_Cropped_Image_Control';
				  $control_args  = wp_parse_args( array('type' => $field_type), $control_args );
				  break;

				case 'checkbox-sortable':
				  $control_class = 'Lovage_Customize_Sortable_Checkbox_Control';
				  $control_args  = wp_parse_args( array(
				  	'type' 		  => $field_type,
				  	'choices' 	  => isset( $args['choices'] ) ? $args['choices'] : array()
				  ), $control_args );
				  break;

				case 'multi-checkbox':
				  $control_class = 'Lovage_Customize_Control_Multi_Checkbox';
				  $control_args  = wp_parse_args( array(
				  	'type' 		  => $field_type,
				  	'choices' 	  => isset( $args['choices'] ) ? $args['choices'] : array()
				  ), $control_args );
				  break;

				case 'number':
				case 'range':
				  $control_args  = wp_parse_args(array(
				  	'type' 		  => $field_type,
				  	'input_attrs' => isset($args['input_attrs']) ? $args['input_attrs'] : array()
				  ), $control_args );
				  break;

				case 'radio':
				case 'checkbox':
				case 'select':
				  $control_args = wp_parse_args(array(
				  	'type' 		  => $field_type,
				  	'choices' 	  => isset( $args['choices'] ) ? $args['choices'] : array()
				  ), $control_args );
				  break;

				case 'text':
				case 'date':
				case 'textarea':
				case 'email':
				case 'url':
				case 'password':
				case 'checkbox':
				case 'dropdown-pages':
						$control_class = 'WP_Customize_Control';
						$control_args = wp_parse_args( array(
							'type' => $field_type
						), $control_args );
					break;

				default:
				    $control_args = apply_filters( 'lovage_customizer_control_args_for_{$field_type}', $control_args, $field_id, $this );
				    break;
			}

			/**
			 * Filter arguments for a customize control.
			 *
			 * @since 1.0.0
			 * @param array  $control_args Control's arguments.
			 * @param string $id           Control's ID.
			 * @param object $this         Lovage_Customizer instance.
			 */
			$control_args = apply_filters( 'lovage_customizer_control_args', $control_args, $field_id, $this );

			/**
			 * Filter PHP-class name for a customize control (maybe custom).
			 *
			 * @since 1.0.0
			 * @param array  $control_args Control's PHP-class name.
			 * @param string $field_id     Control's ID.
			 * @param object $this         Lovage_Customizer instance.
			 */
			$control_class = apply_filters( 'lovage_customizer_control_class', $control_class, $field_id, $this );

			if ( class_exists( $control_class ) ) {
				 $this->customize->add_control( new $control_class( $this->customize, $field_id, $control_args ) );
			} else {
				 $this->customize->add_control( $field_id, $control_args );
			}

		}

		/**
		 * Retrieve a option value by ID.
		 *
		 * @since  1.0.0
		 * @param  mixed $id Settings ID.
		 * @return bool|mixed
		 */
		public function get_value( $id, $default = null ) {
			if ( null === $default ) {
				$default = $this->get_default( $id );
			}
			if ( 'theme_mod' === $this->type ) {
				return get_theme_mod( $id, $default );
			}
			if ( 'option' === $this->type ) {
				$options = get_option( $this->prefix . '_options', array() );
				return isset( $options[ $id ] ) ? $options[ $id ] : $default;
			}
			return $default;
		}

		public static function instance($arg){
			return new Lovage_Customizer;
		}

	}
}