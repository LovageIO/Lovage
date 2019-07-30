/**
 * Lovage Customizer Settings Example
 * This part is included in the inc/customizer folder by default.
 * If you want to add new section, panel and settings in your child theme, just 
 * copy the following codes to the functions.php of your child theme.
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */


add_action('init', 'your_customizer_settings');

function your_customizer_settings(){
	$prefix = '_lovage';

	$settings = array(
	    'prefix'     => $prefix,
	    'capability' => 'edit_theme_options', 
	    'type'       => 'theme_mod',
	    'options'    => array(
	        
	        'section_1' => array(
	           'title'           => esc_html__( 'Section 1', 'lovage' ),
	           'description'     => esc_html__( 'Section Example', 'lovage' ),
	           'priority'        => 20,
	           'capability'      => '', 
	           'theme_supports'  => '', 
	           'active_callback' => '', 
	           'type'            => 'section'
	        ),
	      

	       'radio_image' => array(
	            'title'       => esc_html__( 'Radio Images', 'lovage' ),
	            'description' => esc_html__( 'Radio Images Example', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => 'standard',
	            'field'       => 'radio-image', 
	            'type'        => 'control',
	            'choices'	  => array(
	            	'standard' => array(
	                		'url' => LOVEAGE_INC_URI.'customizer/images/default-header.jpg',
	                		'label' => esc_html__('Standard', 'lovage')
	            		   ),
	            	'standard-rtl' => array(
	                		'url' => LOVEAGE_INC_URI.'customizer/images/rtl-header.jpg',
	                		'label' => esc_html__('Standard (RTL)', 'lovage')
	            		   ),
	            	'centered-logo' => array(
	                		'url' => LOVEAGE_INC_URI.'customizer/images/centered-logo-header.jpg',
	                		'label' => esc_html__('Centered LOGO', 'lovage')
	            		   )
	            ),
	            'sanitize_callback'    => '', 
	        ),

	        'checkbox_image' => array(
	            'title'       => esc_html__( 'Checkbox Image', 'lovage' ),
	            'description' => esc_html__( 'Checkbox Image Example', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => 'standard',
	            'field'       => 'checkbox-image', 
	            'type'        => 'control',
	            'choices'	  => array(
	            	'stylebold' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Bold.png',
						'name' => __( 'Bold' )
					),
					'styleitalic' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Italic.png',
						'name' => __( 'Italic' )
					),
					'styleallcaps' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/AllCaps.png',
						'name' => __( 'All Caps' )
					),
					'styleunderline' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Underline.png',
						'name' => __( 'Underline' )
					)
	            ),
	            'sanitize_callback'    => '', 
	        ),

	        'range' => array(
	            'title'       => esc_html__( 'Range', 'lovage' ),
	            'description' => esc_html__( 'Range Example', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '70',
	            'field'       => 'range-slider', 
	            'type'        => 'control',
	            'input_attrs' => array(
					'min'    => 50,
					'max'    => 100,
					'step'   => 1,
			  	),
	            'sanitize_callback'    => '', 
	        ),

	        'checkbox' => array(
	            'title'       => esc_html__( 'Checkbox', 'lovage' ),
	            'description' => esc_html__( 'Checkbox example.', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '1',
	            'field'       => 'checkbox', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'multi_checkbox' => array(
	            'title'       => esc_html__( 'Multi-Checkbox', 'lovage' ),
	            'description' => esc_html__( 'Multi-Checkbox example.', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => 'value2',
	            'field'       => 'multi-checkbox', 
	            'type'        => 'control',
	            'choices'	  => array(
	            	 'value1' => esc_html__('Value 1', 'lovage'),
	            	 'value2' => esc_html__('Value 2', 'lovage'),
	            ),
	            'sanitize_callback'    => '', 
	        ),

	        'sortable_checkbox' => array(
	            'title'       => esc_html__( 'Sortable Checkbox', 'lovage' ),
	            'description' => esc_html__( 'Sortable checkbox example.', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '1:value2,2:value1',
	            'field'       => 'checkbox-sortable', 
	            'type'        => 'control',
	            'choices'	  => array(
	            	 'value1' => esc_html__('Value 1', 'lovage'),
	            	 'value2' => esc_html__('Value 2', 'lovage'),
	            ),
	            'sanitize_callback'    => '', 
	        ),

	        'radio' => array(
	            'title'       => esc_html__( 'Radio', 'lovage' ),
	            'description' => esc_html__( 'Radio example.', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => 'value2',
	            'field'       => 'radio', 
	            'type'        => 'control',
	            'choices'	  => array(
	            	 'value1' => esc_html__('Value 1', 'lovage'),
	            	 'value2' => esc_html__('Value 2', 'lovage'),
	            ),
	            'sanitize_callback'    => '', 
	        ),

	        'toggle' => array(
	            'title'       => esc_html__( 'Toggle', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '1',
	            'field'       => 'toggle', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'color' => array(
	            'title'       => esc_html__( 'Colorpicker', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '#f00',
	            'field'       => 'color', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'alpha_color' => array(
	            'title'       => esc_html__( 'Alpha Color', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '#f00',
	            'field'       => 'alpha-color', 
	            'type'        => 'control',
	            'show_opacity' => true,
	            'palette' => array(  // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#df312c',
					'#df9a23',
					'#eef000',
					'#7ed934',
					'#1571c1',
					'#8309e7'
				),
	            'sanitize_callback'    => '', 
	        ),

	        'upload' => array(
	            'title'       => esc_html__( 'Upload', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'upload', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'image' => array(
	            'title'       => esc_html__( 'Image', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'image', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'background_image' => array(
	            'title'       => esc_html__( 'background Image', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'background', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'iconpicker' => array(
	            'title'       => esc_html__( 'Icon Picker', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'iconpicker', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'text' => array(
	            'title'       => esc_html__( 'Text', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'text', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'date_time' => array(
	            'title'       => esc_html__( 'Date Time', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'date_time', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	            'input_attrs' => array(
				    'placeholder' => __( 'mm/dd/yyyy' ),
				 ),
	        ),

	        'date' => array(
	            'title'       => esc_html__( 'Date', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'date', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	            'input_attrs' => array(
				    'placeholder' => __( 'mm/dd/yyyy' ),
				 ),
	        ),

	        'textarea' => array(
	            'title'       => esc_html__( 'Text Area', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'textarea', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'email' => array(
	            'title'       => esc_html__( 'Email', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'email', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'url' => array(
	            'title'       => esc_html__( 'URL', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'url', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'password' => array(
	            'title'       => esc_html__( 'Password', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'password', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'dropdown-pages' => array(
	            'title'       => esc_html__( 'Dropdown Pages', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'dropdown-pages', 
	            'type'        => 'control',
	            'sanitize_callback'    => '', 
	        ),

	        'select' => array(
	            'title'       => esc_html__( 'Select', 'lovage' ),
	            'section'     => 'section_1', 
	            'default'     => '',
	            'field'       => 'select', 
	            'type'        => 'control',
	            'choices'	  => array(
	            	 'value1' => esc_html__('Value 1', 'lovage'),
	            	 'value2' => esc_html__('Value 2', 'lovage'),
	            ),
	            'sanitize_callback'    => '', 
	        )
	    )
	);

	/* Instantiate another Lovage_Customizer Object */
	$my_customizer = new Lovage_Customizer($settings);
}
