<?php
/**
 * Elementor Custom Functions.
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

/**
 * Update global options to avoid theme conflict
 */
function lovage_update_elementor_global_option () {
  update_option('elementor_disable_color_schemes', 'yes');
  update_option('elementor_disable_typography_schemes', 'yes');
}
add_action('after_switch_theme', 'lovage_update_elementor_global_option');