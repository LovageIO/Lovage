<?php
/**
 * Demo Importer Install Page
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

if( ! file_exists( WP_PLUGIN_DIR.'/lovage-demo-import/lovage-demo-import.php' ) ):
	if( ! class_exists( 'Lovage_Demo_Import_Plugin' ) ) :

		$lovage_demo_import_button_text = esc_html__( 'Install Demo Import Plugin', 'lovage' );

		$lovage_demo_import_action_link = esc_url( wp_nonce_url(
						add_query_arg(
							array(
								'page'          => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => rawurlencode( 'lovage-demo-import' ),
								'plugin_name'   => rawurlencode( 'Lovage Demo Import' ),
								'tgmpa-install' => 'install-plugin',
								'return_url'    => '',
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-install',
						'tgmpa-nonce'
					) );
	endif;
else:
	$lovage_demo_import_plugin = 'lovage-demo-import/lovage-demo-import.php';
	$lovage_demo_import_button_text = esc_html__( 'Activate Demo Import Plugin', 'lovage' );
    $lovage_demo_import_action_link = wp_nonce_url(admin_url( 'plugins.php?action=activate&plugin='.$lovage_demo_import_plugin ), 'activate-plugin_'.$lovage_demo_import_plugin );
endif;
?>

<div id="demos" class="lovage-admin-container">
		<div class="lovage-admin-box">
			<h3><?php esc_html_e( 'The Demo Import Plugin Isn\'t Installed.' , 'lovage' );?></h3>
			<p><?php esc_html_e( 'Please click the following button to install the demo import plugin, then you will be able to preview and import the demos.', 'lovage' );?></p>
			<a href="<?php echo esc_url( $lovage_demo_import_action_link ); ?>" id="lovage-install-demo-import-plugin" class="button button-primary">
				<?php echo esc_attr( $lovage_demo_import_button_text );?>
			</a>
			<div class="lovage-loader" id="lovage-demo-install-loader"></div>
			<div class="clear"></div>
		</div>
</div>