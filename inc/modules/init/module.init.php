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
require LOVEAGE_MODULE_DIR.'init/lib.php';
	
/**
 * Custom template tags for this theme.
 */
require LOVEAGE_MODULE_DIR.'init/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require LOVEAGE_MODULE_DIR.'init/extras.php';

/**
 * Hooks
 */
require LOVEAGE_MODULE_DIR.'init/hooks.php';

/**
 * Elementor Integration
 */
require LOVEAGE_MODULE_DIR.'init/elementor.php';

/**
 * Metabox
 */
require LOVEAGE_MODULE_DIR.'init/metabox.php';

/**
 * Metabox
 */
require LOVEAGE_MODULE_DIR.'init/page-codes.php';