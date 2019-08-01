<?php
/**
 * WooCommerce Module
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

if( ! class_exists('WooCommerce') ){
	return;
}

load_template( LOVEAGE_MODULE_DIR.'woocommerce/template-tags.php', TRUE );
load_template( LOVEAGE_MODULE_DIR.'woocommerce/hooks.php', TRUE );
load_template( LOVEAGE_MODULE_DIR.'woocommerce/metabox.php', TRUE );
load_template( LOVEAGE_MODULE_DIR.'woocommerce/extras.php', TRUE );