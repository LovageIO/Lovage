<?php
/**
 * Extension Page
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0.4
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
  exit( 'Direct script access denied.' );
}

$lovage_all_extensions = TGM_Plugin_Activation::$instance->plugins;
?>

<div class="section">
  <?php add_thickbox(); ?>
  <div class="page_description">
    <?php echo esc_html__( 'Want more features? We offer some Lovage Extensions can make your website looks more unique. Please note that Lovage Extensions are only made for Lovage theme. You can install, activate and delete it as the standard plugin.', 'lovage' );?>
  </div>
  <div class="lovage-plugin-installer">
      <?php 
        $lovage_extensions = lovage_get_extensions();

        if(!isset($lovage_extensions)){
            echo esc_html__( 'For some reasons, the extensions information is not loaded, please try to refresh the page.', 'lovage' );
        }

        foreach ( $lovage_all_extensions as $lovage_single_extension ) :

          if ( ! array_key_exists( $lovage_single_extension['slug'], $lovage_extensions ) ) {
            continue;
          }

          $lovage_extension_item_class = '';
          $lovage_extension_status = '';
          $lovage_extension_path = isset( $lovage_single_extension['lovage_extension_path'] ) ? $lovage_single_extension['lovage_extension_path'] : '';
          $lovage_extension_action = Lovage_Admin::extension_link( $lovage_single_extension );
  
          // We have a repo plugin.
          if ( ! $lovage_single_extension['version'] ) {
            $lovage_single_extension['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $lovage_single_extension['slug'] );
          }

          if ( is_plugin_active( $lovage_extension_path ) ) {
            $lovage_extension_status = 'active';
            $lovage_extension_item_class = 'active';
          } 
          ?>

          <div class="plugin  <?php echo esc_attr( $lovage_extension_item_class ); ?>">
              <?php if ( isset( $lovage_extension_action['update'] ) && $lovage_extension_action['update'] ) : ?>
               <div class="update-message notice inline notice-warning notice-alt lovage-plugin-update-notice">
                <p><?php echo esc_html__( 'New Version Available: ', 'lovage' ) . esc_html( $lovage_single_extension['version'] ); ?></p>
               </div>
              <?php endif; ?>
              
              <div class="plugin-wrap">
                 <img src="<?php echo esc_url( $lovage_single_extension['image_url'] ); ?>" />
                 <h2><?php echo esc_html( $lovage_single_extension['name'] ); ?></h2>
                 <p> <?php echo esc_html( $lovage_single_extension['description'] ); ?></p>
                 <p class="plugin-author"><?php echo esc_html__( 'By', 'lovage' ); ?>  <?php echo esc_html( $lovage_single_extension['author'] ); ?></p>
              </div>
              
              <ul class="activation-row">
                 <li>
                    <?php 
                       foreach ( $lovage_extension_action as $lovage_action_button ) :
                          echo wp_kses( $lovage_action_button,  array(
                                                                    //links
                                                                    'a'  => array(
                                                                        'href' => array(),
                                                                        'class' => array()
                                                                    )
                                                                 ) 
                              );
                       endforeach; 
                    ?>
                 </li>

                 <?php if ( isset( $lovage_single_extension['premium'] ) && $lovage_single_extension['premium'] ) : ?>
                  <li><a href="<?php echo isset( $lovage_single_extension['buy_url'] ) ? esc_url( $lovage_single_extension['buy_url'] ) : ''; ?>" class="button button-green" target="_blank">
                    <?php echo esc_html__( 'Buy Now', 'lovage' ); ?>
                  </a></li>
                 <?php endif; ?>

                 <?php if( isset($lovage_single_extension['external_url']) ): ?>
                 <li>
                    <a href="<?php echo esc_url( $lovage_single_extension['external_url'] ); ?>" target="_blank">
                       <?php echo esc_html__( 'More Details', 'lovage' ); ?>
                    </a>
                 </li>
                 <?php endif;?>

                  <?php if ( isset( $lovage_single_extension['pro_required'] ) && $lovage_single_extension['pro_required'] ) : ?>
                  <li><a href="<?php echo esc_url( 'https://lovage.io/pro' );?>" class="pro-required" target="_blank">
                    <?php echo esc_html__( 'Lovage Pro Required', 'lovage' ); ?>
                  </a></li>
                  <?php endif; ?>                  
              </ul>

              <?php if( isset( $lovage_single_extension['premium'] ) && $lovage_single_extension['premium'] ) : ?>
                <div class="premium-label">
                  <?php echo esc_html__( 'Premium', 'lovage' ); ?>
                </div>
              <?php endif; ?>
          </div>

        <?php endforeach; ?>
    </div>

 </div>