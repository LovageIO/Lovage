<?php
/**
 * Sanitize Functions
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

/**
 * Sanitize Multi-checkbox value
 * @param $input
 * @return string
 */
function lovage_multi_checkbox_sanitization( $values ) {
	$multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;
	return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Sanitize date time value
 * @param $input
 * @return string
 */
function lovage_date_time_sanitization( $value ) {
   $date = new DateTime( $value );
   return $date->format('Y-m-d h:m:s');
}

/**
 * Sanitize select value
 * @param $input
 * @return string
 */
function lovage_select_sanitization( $input, $setting ){
         
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
     
}

/**
 * URL sanitization
 *
 * @param  string	Input to be sanitized (either a string containing a single url or multiple, separated by commas)
 * @return string	Sanitized input
 */
if ( ! function_exists( 'lovage_url_sanitization' ) ) {
	function lovage_url_sanitization( $input ) {
		if ( strpos( $input, ',' ) !== false) {
			$input = explode( ',', $input );
		}
		if ( is_array( $input ) ) {
			foreach ($input as $key => $value) {
				$input[$key] = esc_url_raw( $value );
			}
			$input = implode( ',', $input );
		}
		else {
			$input = esc_url_raw( $input );
		}
		return $input;
	}
}

/**
 * Switch sanitization
 *
 * @param  string		Switch value
 * @return integer	Sanitized value
 */
if ( ! function_exists( 'lovage_switch_sanitization' ) ) {
	function lovage_switch_sanitization( $input ) {
		if ( true === $input ) {
			return 1;
		} else {
			return 0;
		}
	}
}
/**
 * Radio Button and Select sanitization
 *
 * @param  string		Radio Button value
 * @return integer	Sanitized value
 */
if ( ! function_exists( 'lovage_radio_sanitization' ) ) {
	function lovage_radio_sanitization( $input, $setting ) {
		//get the list of possible radio box or select options
     $choices = $setting->manager->get_control( $setting->id )->choices;
		if ( array_key_exists( $input, $choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}
/**
 * Integer sanitization
 *
 * @param  string		Input value to check
 * @return integer	Returned integer value
 */
if ( ! function_exists( 'lovage_sanitize_integer' ) ) {
	function lovage_sanitize_integer( $input ) {
		return (int) $input;
	}
}
/**
 * Text sanitization
 *
 * @param  string	Input to be sanitized (either a string containing a single string or multiple, separated by commas)
 * @return string	Sanitized input
 */
if ( ! function_exists( 'lovage_text_sanitization' ) ) {
	function lovage_text_sanitization( $input ) {
		if ( strpos( $input, ',' ) !== false) {
			$input = explode( ',', $input );
		}
		if( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[$key] = sanitize_text_field( $value );
			}
			$input = implode( ',', $input );
		}
		else {
			$input = sanitize_text_field( $input );
		}
		return $input;
	}
}
/**
 * Array sanitization
 *
 * @param  array	Input to be sanitized
 * @return array	Sanitized input
 */
if ( ! function_exists( 'lovage_array_sanitization' ) ) {
	function lovage_array_sanitization( $input ) {
		if( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[$key] = sanitize_text_field( $value );
			}
		}
		else {
			$input = '';
		}
		return $input;
	}
}
/**
 * Alpha Color (Hex & RGBa) sanitization
 *
 * @param  string	Input to be sanitized
 * @return string	Sanitized input
 */
if ( ! function_exists( 'lovage_hex_rgba_sanitization' ) ) {
	function lovage_hex_rgba_sanitization( $input, $setting ) {
		if ( empty( $input ) || is_array( $input ) ) {
			return $setting->default;
		}
		if ( false === strpos( $input, 'rgba' ) ) {
			// If string doesn't start with 'rgba' then santize as hex color
			$input = sanitize_hex_color( $input );
		} else {
			// Sanitize as RGBa color
			$input = str_replace( ' ', '', $input );
			sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			$input = 'rgba(' . lovage_in_range( $red, 0, 255 ) . ',' . lovage_in_range( $green, 0, 255 ) . ',' . lovage_in_range( $blue, 0, 255 ) . ',' . lovage_in_range( $alpha, 0, 1 ) . ')';
		}
		return $input;
	}
}

/**
 * Google Font sanitization
 *
 * @param  string	JSON string to be sanitized
 * @return string	Sanitized input
 */
if ( ! function_exists( 'lovage_google_font_sanitization' ) ) {
	function lovage_google_font_sanitization( $input ) {
		$val =  json_decode( $input, true );
		if( is_array( $val ) ) {
			foreach ( $val as $key => $value ) {
				$val[$key] = sanitize_text_field( $value );
			}
			$input = json_encode( $val );
		}
		else {
			$input = json_encode( sanitize_text_field( $val ) );
		}
		return $input;
	}
}

/**
 * Slider sanitization
 *
 * @param  string	Slider value to be sanitized
 * @return string	Sanitized input
 */
if ( ! function_exists( 'lovage_range_sanitization' ) ) {
	function lovage_range_sanitization( $input, $setting ) {
		$attrs = $setting->manager->get_control( $setting->id )->input_attrs;
		$min = ( isset( $attrs['min'] ) ? $attrs['min'] : $input );
		$max = ( isset( $attrs['max'] ) ? $attrs['max'] : $input );
		$step = ( isset( $attrs['step'] ) ? $attrs['step'] : 1 );
		$number = floor( $input / $attrs['step'] ) * $attrs['step'];
		return lovage_in_range( $number, $min, $max );
	}
}

/**
 * Only allow values between a certain minimum & maxmium range
 *
 * @param  number	Input to be sanitized
 * @return number	Sanitized input
 */
if ( ! function_exists( 'lovage_in_range' ) ) {
	function lovage_in_range( $input, $min, $max ){
		if ( $input < $min ) {
			$input = $min;
		}
		if ( $input > $max ) {
			$input = $max;
		}
	    return $input;
	}
}