<?php
/**
 * Dashboard Page
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
  exit( 'Direct script access denied.' );
}

do_action('Lovage_Admin');
?>

<div class="wrap about-wrap lovage-wrap">
    <?php

       $admin_page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET[ 'page' ] ) ) : '';

       switch($admin_page){
            case 'lovage-plugins':
              load_template( LOVEAGE_INC_DIR . 'admin/ui/plugins.php', TRUE );
              break;

            case 'lovage-extensions':
              load_template( LOVEAGE_INC_DIR . 'admin/ui/extensions.php', TRUE );
              break;

            case 'lovage-demo-installer':
              load_template( LOVEAGE_INC_DIR . 'admin/ui/demos.php', TRUE );
              break;

            default:
              load_template( LOVEAGE_INC_DIR . 'admin/ui/dashboard.php', TRUE );
       }
    ?>
</div>

<div class="lovage-admin-footer">Made by <a href="https://mofect.com?utm_source=<?php bloginfo('name');?>-dashboard" target="_blank">Mofect Limited</a></div>