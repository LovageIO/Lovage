<?php
/**
 * Page Codes
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

function lovage_page_codes(){
	
	global $post;

	$page_css = get_post_meta( $post->ID, '_lovage_page_css', true );
	$page_js  = get_post_meta( $post->ID, '_lovage_page_js', true );

	$compressed_css = str_replace('; ',';',str_replace(' }','}',str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$page_css)))));

	wp_add_inline_style('lovage', $compressed_css);
	wp_add_inline_script('lovage', $page_js);
}
add_action( 'wp_enqueue_scripts', 'lovage_page_codes' );