<?php
/**
 * WooCommerce Module
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

if(!class_exists('WooCommerce')){
	return;
}
require LOVEAGE_MODULE_DIR.'woocommerce/template-tags.php';
require LOVEAGE_MODULE_DIR.'woocommerce/hooks.php';
require LOVEAGE_MODULE_DIR.'woocommerce/metabox.php';
require LOVEAGE_MODULE_DIR.'woocommerce/extras.php';