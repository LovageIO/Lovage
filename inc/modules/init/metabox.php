<?php
/**
 * Metabox for the post and page.
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

add_action( 'init', 'lovage_page_metabox' );
add_action( 'init', 'lovage_post_metabox' );

function lovage_is_elementor_template(){
	
	global $post;

	if ( ! $post ) {
      return false;
   }

	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );

	if( $page_template === 'elementor_header_footer' || $page_template === 'elmentor_canvas' ){
		return false;
	}else{
		return true;
	}
}

function lovage_page_metabox(){
	$page_settings = new Lovage_MetaBox();

	$prefix = '_lovage_';

	$page_settings->metabox = array(
	   'id'    		  => 'lovage_page_metabox',
	   'title' 		  => esc_html__( 'Page Settings', 'lovage' ),
	   'description'  => esc_html__( 'The common settings for the current page (supports the post, page)', 'lovage' ),
	   'context'	  => 'normal',
	   'post_type'    => apply_filters( 'lovage_page_metabox_for_post_types', array( 'post','page' ) ),
	   'tabs'		  => apply_filters( 'lovage_page_metabox_tabs', array(
	      'general' => array(
	      				'title'    => esc_html__( 'General', 'lovage' ),
	      			   )
	   ) ),
	   'options'  => apply_filters( 'lovage_page_metabox_options', array(
	   	   
		   $prefix.'page_layout' => array(
				'label'			 => esc_html( 'Page Layout', 'lovage' ),
				'tab'			 => 'general',
				'type'			 => 'radio-image',
				'default'		 => 'default',
				'callback'	  	 => 'lovage_is_elementor_template',
				'description'    => esc_html__( 'You can separately set a layout for this page, if you choose default, it will use the customize blog post layout setting.', 'lovage' ),
				'choices'		 => apply_filters('lovage_page_layout_choices', array(
					
					'default' => array(
						'image' => LOVEAGE_INC_URI.'assets/images/default-layout.jpg',
					),
					'one-column' => array(
						'image' => LOVEAGE_INC_URI.'assets/images/one-column.jpg',
					),
					'right-sidebar' => array(
						'image' => LOVEAGE_INC_URI.'assets/images/right-sidebar.jpg',
					),
					'left-sidebar' => array(
						'image' => LOVEAGE_INC_URI.'assets/images/left-sidebar.jpg',
					)
				) )
		   )
	   ) )
	);
}

function lovage_post_metabox(){
	$post_settings = new Lovage_MetaBox();

	$prefix = '_lovage_';

	$post_settings->metabox = array(
	   'id'    		  => 'lovage_post_metabox',
	   'title' 		  => esc_html__('Post Settings', 'lovage'),
	   'description'  => esc_html__('The common settings for the current blog post.', 'lovage'),
	   'context'	  => 'normal',
	   'post_type'	  => 'post',
	   'tabs'		  => apply_filters( 'lovage_post_metabox_tabs', array(
	      'featured_image' => array(
	      				'title'    => esc_html__( 'Featured Image', 'lovage' )
	      			   ),
	   ) ),
	   'options'  => apply_filters( 'lovage_post_metabox_options', array(
	   	   
		   $prefix.'hide_single_featured_image' => array(
				'label'			 => esc_html( 'Featured Image: Hide in the Single Post', 'lovage' ),
				'tab'			 => 'featured_image',
				'type'			 => 'toggle',
				'default'		 => '0'
		   ),

		   $prefix.'hide_archive_featured_image' => array(
				'label'			 => esc_html( 'Featured Image: Hide in the Archive Page ', 'lovage' ),
				'tab'			 => 'featured_image',
				'type'			 => 'toggle',
				'default'		 => '0'
		   ),

		   $prefix.'featured_alignment' => array(
				'label'			 => esc_html( 'Featured Image: Alignment', 'lovage' ),
				'tab'			 => 'featured_image',
				'type'			 => 'select',
				'default'		 => 'default',
				'choices'		 => array(
					'default' => esc_html__( 'Default', 'lovage' ),
					'left'    => esc_html__( 'Left', 'lovage' ),
					'right'   => esc_html__( 'Right', 'lovage' ),
				)
		   )
	   ) )
	);
}
