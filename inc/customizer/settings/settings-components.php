<?php
/**
 * Components Panel
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

 return array(

    'lovage_components_panel' => array(
       'title'           => esc_html__( 'Components', 'lovage' ),
       'description'     => esc_html__( 'Manage the site components style.', 'lovage' ),
       'priority'        => 60,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'panel'
    ),

    /** 
     * Button Section 
     */

    'lovage_button_section' => array(
       'title'           => esc_html__( 'Button', 'lovage' ),
       'priority'        => 10,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel'			 => 'lovage_components_panel'
    ),

    'button_color' => array(
        'title'       => esc_html__( 'Button: Background Color', 'lovage' ),
        'section'     => 'lovage_button_section', 
        'default'     => $this->defaults['button_color'],
        'field'       => 'alpha-color', 
        'show_opacity' => true,
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'button_border_color' => array(
        'title'       => esc_html__( 'Button: Border Color', 'lovage' ),
        'section'     => 'lovage_button_section', 
        'default'     => $this->defaults['button_border_color'],
        'field'       => 'alpha-color', 
        'show_opacity' => true, 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'button_text_color' => array(
        'title'       => esc_html__( 'Button: Text Color', 'lovage' ),
        'section'     => 'lovage_button_section', 
        'default'     => $this->defaults['button_text_color'],
        'field'       => 'alpha-color', 
        'show_opacity' => true,
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'button_radius' => array(
        'title'       => esc_html__( 'Button Radius', 'lovage' ),
        'description' => esc_html__('The default unit is px', 'lovage'),
        'section'     => 'lovage_button_section', 
        'default'     => $this->defaults['button_radius'],
        'field'       => 'range-slider', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'input_attrs' => array(
        	'min' => 0, 
			'max' => 50, 
			'step' => 1, 
        ),
        'sanitize_callback'    => 'lovage_range_sanitization', 
    ),

    'button_border_width' => array(
        'title'       => esc_html__( 'Button Border Width', 'lovage' ),
        'description' => esc_html__('The default unit is px', 'lovage'),
        'section'     => 'lovage_button_section', 
        'default'     => $this->defaults['button_border_width'],
        'field'       => 'range-slider', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'input_attrs' => array(
        	'min' => 0, 
			'max' => 10, 
			'step' => 1, 
        ),
        'sanitize_callback'    => 'lovage_range_sanitization', 
    ),

    // hover on status
    'button_hover_status' => array(
        'title'       => esc_html__( 'Hover Status', 'lovage' ),
        'description' => esc_html__( 'Manage button style when hovering on it. ', 'lovage' ),
        'section'     => 'lovage_button_section', 
        'field'       => 'title', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => '', 
    ),

    'button_hover_color' => array(
        'title'       => esc_html__( 'Button: Background Color', 'lovage' ),
        'section'     => 'lovage_button_section', 
        'default'     => $this->defaults['button_hover_color'],
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'button_hover_border_color' => array(
        'title'       => esc_html__( 'Button: Border Color', 'lovage' ),
        'section'     => 'lovage_button_section', 
        'default'     => $this->defaults['button_hover_border_color'],
        'field'       => 'alpha-color', 
        'show_opacity' => true,
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'button_hover_text_color' => array(
        'title'       => esc_html__( 'Button: Text Color', 'lovage' ),
        'section'     => 'lovage_button_section', 
        'default'     => $this->defaults['button_hover_text_color'],
        'field'       => 'alpha-color', 
        'show_opacity' => true,
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    /** 
     * Text Input Section 
     */

    'lovage_text_field_section' => array(
       'title'           => esc_html__( 'Text Field', 'lovage' ),
       'description'	 => esc_html__('Manage the input text field style.', 'lovage'),
       'priority'        => 10,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel'			 => 'lovage_components_panel'
    ),

    'text_field_color' => array(
        'title'       => esc_html__( 'Text Field: Background Color', 'lovage' ),
        'section'     => 'lovage_text_field_section', 
        'default'     => $this->defaults['text_field_color'],
        'field'       => 'alpha-color', 
        'show_opacity' => true, 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'text_field_border_color' => array(
        'title'       => esc_html__( 'Text Field: Border Color', 'lovage' ),
        'section'     => 'lovage_text_field_section', 
        'default'     => $this->defaults['text_field_border_color'],
        'field'       => 'alpha-color', 
        'show_opacity' => true,
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'text_field_text_color' => array(
        'title'       => esc_html__( 'Text Field: Text Color', 'lovage' ),
        'section'     => 'lovage_text_field_section', 
        'default'     => $this->defaults['text_field_text_color'],
        'field'       => 'alpha-color', 
        'show_opacity' => true,
        'type'        => 'control',
        'transport'   => 'postMessage',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'text_field_radius' => array(
        'title'       => esc_html__( 'Text Field: Border Radius', 'lovage' ),
        'description' => esc_html__('The default unit is px', 'lovage'),
        'section'     => 'lovage_text_field_section', 
        'default'     => $this->defaults['text_field_radius'],
        'field'       => 'range-slider', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'input_attrs' => array(
        	'min' => 0, 
			'max' => 50, 
			'step' => 1, 
        ),
        'sanitize_callback'    => 'lovage_range_sanitization', 
    ),
    'text_field_border_width' => array(
        'title'       => esc_html__( 'Text Field: Border Width', 'lovage' ),
        'description' => esc_html__('The default unit is px', 'lovage'),
        'section'     => 'lovage_text_field_section', 
        'default'     => $this->defaults['text_field_border_width'],
        'field'       => 'range-slider', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'input_attrs' => array(
        	'min' => 0, 
			'max' => 10, 
			'step' => 1, 
        ),
        'sanitize_callback'    => 'lovage_range_sanitization', 
    ),

     // Focus on status
    'text_field_focus_status' => array(
        'title'       => esc_html__( 'Focus Status', 'lovage' ),
        'description' => esc_html__( 'Manage text field style when focusing on it. ', 'lovage' ),
        'section'     => 'lovage_text_field_section', 
        'field'       => 'title', 
        'type'        => 'control',
        'sanitize_callback'    => '', 
    ),

    'text_field_focus_color' => array(
        'title'       => esc_html__( 'Text Field: Background Color', 'lovage' ),
        'section'     => 'lovage_text_field_section', 
        'default'     => $this->defaults['text_field_focus_color'],
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'text_field_focus_border_color' => array(
        'title'       => esc_html__( 'Text Field: Border Color', 'lovage' ),
        'section'     => 'lovage_text_field_section', 
        'default'     => $this->defaults['text_field_focus_border_color'],
        'field'       => 'alpha-color', 
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'text_field_focus_text_color' => array(
        'title'       => esc_html__( 'Text Field: Text Color', 'lovage' ),
        'section'     => 'lovage_text_field_section', 
        'default'     => $this->defaults['text_field_focus_text_color'],
        'field'       => 'alpha-color', 
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'type'        => 'control',
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),


    /** 
     * Textarea Section 
     */

    'lovage_textarea_section' => array(
       'title'           => esc_html__( 'Textarea', 'lovage' ),
       'description'	 => esc_html__('Manage the textarea style.', 'lovage'),
       'priority'        => 10,
       'capability'      => '', 
       'theme_supports'  => '', 
       'active_callback' => '', 
       'type'            => 'section',
       'panel'			 => 'lovage_components_panel'
    ),

    'textarea_color' => array(
        'title'       => esc_html__( 'Textarea: Background Color', 'lovage' ),
        'section'     => 'lovage_textarea_section', 
        'default'     => $this->defaults['textarea_color'],
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true, 
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'textarea_border_color' => array(
        'title'       => esc_html__( 'Textarea: Border Color', 'lovage' ),
        'section'     => 'lovage_textarea_section', 
        'default'     => $this->defaults['textarea_border_color'],
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'textarea_text_color' => array(
        'title'       => esc_html__( 'Textarea: Text Color', 'lovage' ),
        'section'     => 'lovage_textarea_section', 
        'default'     => $this->defaults['textarea_text_color'],
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'textarea_radius' => array(
        'title'       => esc_html__( 'Textarea: Border Radius', 'lovage' ),
        'description' => esc_html__('The default unit is px', 'lovage'),
        'section'     => 'lovage_textarea_section', 
        'default'     => $this->defaults['textarea_radius'],
        'field'       => 'range-slider', 
        'transport'   => 'postMessage',
        'type'        => 'control',
        'input_attrs' => array(
        	'min' => 0, 
			'max' => 50, 
			'step' => 1, 
        ),
        'sanitize_callback'    => 'lovage_range_sanitization', 
    ),
    'textarea_border_width' => array(
        'title'       => esc_html__( 'Textarea: Border Width', 'lovage' ),
        'description' => esc_html__('The default unit is px', 'lovage'),
        'section'     => 'lovage_textarea_section', 
        'default'     => $this->defaults['textarea_border_width'],
        'field'       => 'range-slider', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'input_attrs' => array(
        	'min' => 0, 
			'max' => 10, 
			'step' => 1, 
        ),
        'sanitize_callback'    => 'lovage_range_sanitization', 
    ),

    // Focus on status
    'textarea_focus_status' => array(
        'title'       => esc_html__( 'Focus Status', 'lovage' ),
        'description' => esc_html__( 'Manage textarea style when focusing on it. ', 'lovage' ),
        'section'     => 'lovage_textarea_section', 
        'field'       => 'title', 
        'type'        => 'control',
        'transport'   => 'postMessage',
    ),

    'textarea_focus_color' => array(
        'title'       => esc_html__( 'Textarea: Background Color', 'lovage' ),
        'section'     => 'lovage_textarea_section', 
        'default'     => $this->defaults['textarea_focus_color'],
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'textarea_focus_border_color' => array(
        'title'       => esc_html__( 'Textarea: Border Color', 'lovage' ),
        'section'     => 'lovage_textarea_section', 
        'default'     => $this->defaults['textarea_focus_border_color'],
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),

    'textarea_focus_text_color' => array(
        'title'       => esc_html__( 'Textarea: Text Color', 'lovage' ),
        'section'     => 'lovage_textarea_section', 
        'default'     => $this->defaults['textarea_focus_text_color'],
        'field'       => 'alpha-color', 
        'type'        => 'control',
        'transport'   => 'postMessage',
        'show_opacity' => true,
        'sanitize_callback'    => 'lovage_hex_rgba_sanitization', 
    ),
 );