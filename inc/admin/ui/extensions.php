<?php
/**
 * Extension Page
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

$extensions = TGM_Plugin_Activation::$instance->plugins;
?>

<div class="section">
  <?php add_thickbox(); ?>
  <div class="page_description">
    <?php echo apply_filters('lovage_extensions_page_description', __('Want more features? We offer some Lovage Extensions can make your online store looks more unique. Please note that Lovage Extensions are only effect for Lovage theme, and you can install, activate and delete it as the standard plugin.','lovage'));?>
  </div>
  <div class="cnkt-plugin-installer">
      <?php 
        $lovage_extensions = lovage_get_extensions();

        if(!isset($lovage_extensions)){
            echo esc_html_e('For some reasons, the extensions information is not loaded, please try to refresh the page.','lovage');
        }

        foreach ( $extensions as $extension ) :
          if ( ! array_key_exists( $extension['slug'], $lovage_extensions ) ) {
            continue;
          }

          $class = '';
          $extension_status = '';
          $file_path = $extension['file_path'];
          $extension_action = Lovage_Admin::extension_link( $extension );

          // We have a repo plugin.
          if ( ! $extension['version'] ) {
            $extension['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $extension['slug'] );
          }

          if ( is_plugin_active( $file_path ) ) {
            $extension_status = 'active';
            $class = 'active';
          }
          ?>

          <div class="plugin  <?php echo esc_attr( $class ); ?>">
             <?php if ( isset( $extension_action['update'] ) && $extension_action['update'] ) : ?>
               <div class="update-message notice inline notice-warning notice-alt lovage-plugin-update-notice">
                <p><?php printf( esc_attr__( 'New Version Available: %s', 'lovage' ), esc_attr( $extension['version'] ) ); ?></p>
               </div>
              <?php endif; ?>
              
              <div class="plugin-wrap">
                 <img src="<?php echo $extension['image_url']; ?>" />
                 <h2><?php echo esc_attr( $extension['name'] ); ?></h2>
                 <p> <?php echo esc_attr( $extension['description'] ); ?></p>
                 <p class="plugin-author"><?php _e('By', 'lovage'); ?>  <?php echo esc_attr( $extension['author'] ); ?></p>
              </div>
              
              <ul class="activation-row">
                 <li>
                    <?php 
                     foreach ( $extension_action as $action ) :
                        echo $action;
                     endforeach; 
                    ?>
                 </li>

                 <?php if( isset($extension['external_url']) ): ?>
                 <li>
                    <a href="<?php echo esc_url($extension['external_url']); ?>" target="_blank">
                       <?php _e('More Details', 'lovage'); ?>
                    </a>
                 </li>
                 <?php endif;?>
              </ul>

              <?php if ( isset( $extension['required'] ) && $extension['required'] ) : ?>
                <div class="plugin-required">
                  <?php esc_html_e( 'Required', 'lovage' ); ?>
                </div>
              <?php endif; ?>
          </div>

        <?php endforeach; ?>
    </div>

 </div>