<?php
if( !file_exists( WP_PLUGIN_DIR.'/one-click-demo-import/one-click-demo-import.php' ) ):
	if( ! class_exists('OCDI_Plugin') ) :

		$button_text = esc_html__('Install Demo Import Plugin', 'lovage');

		$action_link = esc_url( wp_nonce_url(
						add_query_arg(
							array(
								'page'          => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => rawurlencode( 'one-click-demo-import' ),
								'plugin_name'   => rawurlencode( 'One Click Demo Import' ),
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
	$plugin = 'one-click-demo-import/one-click-demo-import.php';
	$button_text = esc_html__('Activate Demo Import Plugin', 'lovage');
    $action_link = wp_nonce_url(admin_url('plugins.php?action=activate&plugin='.$plugin), 'activate-plugin_'.$plugin);
endif;
?>

<div id="demos" class="lovage-admin-container">
		<div class="lovage-admin-box">
			<h3><?php esc_html_e('The Demo Import Plugin Isn\'t Installed.' , 'lovage');?></h3>
			<p><?php esc_html_e('Please click the following button to install the demo import plugin, then you will be able to preview and import the demos.', 'lovage');?></p>
			<a href="<?php echo esc_url( $action_link ); ?>" id="lovage-install-demo-import-plugin" class="button button-primary">
				<?php echo esc_attr($button_text);?>
			</a>
			<div class="lovage-loader" id="lovage-demo-install-loader"></div>
			<div class="clear"></div>
		</div>
</div>