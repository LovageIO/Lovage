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
$allow_tags = array(
    //formatting
    'strong' => array(),
    'em'     => array(),
    'b'      => array(),
    'i'      => array(),

    //links
    'a'     => array(
        'href' => array()
    )
);
do_action('Lovage_Admin');
?>
<div class="wrap about-wrap lovage-wrap">
    <?php
       $tab = isset($_GET['page']) ? $_GET['page'] : '';

       switch($tab){
            case 'lovage-plugins':
              require_once LOVEAGE_INC_DIR.'admin/ui/plugins.php';
              break;

            case 'lovage-extensions':
              require_once LOVEAGE_INC_DIR.'admin/ui/extensions.php';
              break;

            case 'lovage-demo-installer':
              require_once LOVEAGE_INC_DIR.'admin/ui/demos.php';
              break;

            default:
              require_once LOVEAGE_INC_DIR.'admin/ui/dashboard.php';
       }
    ?>
</div>

<div class="lovage-admin-footer">Made by <a href="https://mofect.com?utm_source=<?php bloginfo('name');?>-dashboard" target="_blank">Mofect Limited</a></div>