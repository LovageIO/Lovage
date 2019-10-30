<?php
/**
 * Theme Init Module
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

/**
 * Function liburary.
 */
load_template( LOVEAGE_MODULE_DIR.'init/lib.php', TRUE );
	
/**
 * Custom template tags for this theme.
 */
load_template( LOVEAGE_MODULE_DIR.'init/template-tags.php', TRUE );

/**
 * Custom functions that act independently of the theme templates.
 */
load_template( LOVEAGE_MODULE_DIR.'init/extras.php', TRUE );

/**
 * Hooks
 */
load_template( LOVEAGE_MODULE_DIR.'init/hooks.php', TRUE );

/**
 * Elementor Integration
 */
load_template( LOVEAGE_MODULE_DIR.'init/elementor.php', TRUE );

/**
 * Metabox
 */
load_template( LOVEAGE_MODULE_DIR.'init/metabox.php', TRUE );