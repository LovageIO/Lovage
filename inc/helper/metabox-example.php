/**
 * Lovage MetaBox Example
 * If you want to add new metabox and fields, 
 * just copy the following codes to the functions.php of your child theme.
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

add_action('init', 'my_post_metabox');

function my_post_metabox(){
	$post_settings = new Lovage_MetaBox();

	$post_settings->metabox = array(
	   'id'    => 'unique_metabox_id',
	   'title' => 'Lovage Page Settings',
	   'description'  => 'The common settings for the current page/post.',
	   'post_type'    => array('post','page'),
	   'tabs'		  => array(
	      'tab1' => 'Header',
	      'tab2' => 'Footer'
	   ),
	   'options'  => array(
	   	   'color' => array(
				'label'			 => esc_html('Color'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab1',
				'type'			 => 'colorpicker',
				'style'			 => 'long',
				'default'		 => '',
				'placeholder'	 => ''
		   ),
		   'image_upload' => array(
				'label'			 => esc_html('Image Upload'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab1',
				'type'			 => 'multi-image',
				'style'			 => 'medium',
				'default'		 => '',
				'placeholder'	 => ''
		   ),
		   'test_text' => array(
				'label'			 => esc_html('Text'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab1',
				'type'			 => 'text',
				'style'			 => 'long',
				'default'		 => '',
				'placeholder'	 => ''
		   ),
		   'email' => array(
				'label'			 => esc_html('Email'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'email',
				'style'			 => 'long',
				'default'		 => '',
				'placeholder'	 => ''
		   ),
		   'number' => array(
				'label'			 => esc_html('Number'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'number',
				'default'		 => '',
				'placeholder'	 => ''
		   ),
		   'textarea' => array(
				'label'			 => esc_html('Textarea'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'textarea',
				'default'		 => '',
				'placeholder'	 => 'textarea'
		   ),
		   'select' => array(
				'label'			 => esc_html('Select'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'select',
				'default'		 => '2',
				'choices'		 => array(
					'1' => 'Choice1',
					'2' => 'Choice2'
				)
		   ),
		   'checkbox' => array(
				'label'			 => esc_html('Checkbox'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'checkbox',
				'default'		 => '0'
		   ),
		   'mulicheckbox' => array(
				'label'			 => esc_html('Multi-Checkbox'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'multi-checkbox',
				'default'		 => '2',
				'choices'		 => array(
					'1' => 'Choice1',
					'2' => 'Choice2'
				)
		   ),
		   'radio' => array(
				'label'			 => esc_html('Radio'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'radio',
				'default'		 => '2',
				'choices'		 => array(
					'1' => 'Choice1',
					'2' => 'Choice2'
				)
		   ),
		   'toggle' => array(
				'label'			 => esc_html('Toggle'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'toggle',
				'default'		 => '1'
		   ),
		   'range' => array(
				'label'			 => esc_html('Range'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'range',
				'max'			 => '100',
				'min'			 => '1',
				'default'		 => '1'
		   ),
		   'radioimage' => array(
				'label'			 => esc_html('Radio Image'),
				'tab'			 => 'tab2',
				'type'			 => 'radio-image',
				'default'		 => '2',
				'choices'		 => array(
					'1' => array(
						'title' => 'Image Text',
						'image' => 'https://neilpatel-qvjnwj7eutn3.netdna-ssl.com/wp-content/uploads/2018/06/neilsadseo.jpg'
					),
					'2' => array(
						'title' => 'Image Text 2',
						'image' => 'https://neilpatel-qvjnwj7eutn3.netdna-ssl.com/wp-content/uploads/2018/06/neilsadseo.jpg'
					),
					'3' => array(
						'title' => 'Image Text 3',
						'image' => 'https://neilpatel-qvjnwj7eutn3.netdna-ssl.com/wp-content/uploads/2018/06/neilsadseo.jpg'
					),
				)
		   ),
		   'date' => array(
				'label'			 => esc_html('Date Picker'),
				'description'    => esc_html('description text'),
				'tab'			 => 'tab2',
				'type'			 => 'date-picker',
				'default'		 => ''
		   ),
	   )
	);
}