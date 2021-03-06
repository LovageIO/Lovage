<?php
/**
 * Theme Dashboard Class
 * Sets up the welcome screen page, hides the menu item
 * and contains the screen content.
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @since 1.0.9.6
 */
class Lovage_Admin {

	/**
	 * Constructor
	 * @since 1.0.0
	 */
	private $admin_menu;

	/**
	 * Constructor
	 * Sets up the welcome screen
	 * @since 1.0.5
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'admin_register_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_style' ) );
		add_action( 'admin_init', array( $this,'plugin_action' ) );
		add_action( 'Lovage_Admin', array( $this, 'admin_ui_header' ), 10 );
		add_action( 'lovage_demos/plugin_page_header', array( $this, 'admin_ui_header' ), 10 ) ;
		add_filter( 'lovage_demos/plugin_page_setup', array( $this, 'demo_import_menu' ) );
		add_filter( 'lovage_demos/plugin_page_title', array( $this,'remove_demo_page_title' ) );
		add_filter( 'lovage_demos/disable_pt_branding', '__return_true' );
		add_action( 'after_setup_theme', array( $this, 'check_update' ) );

	} // end constructor

	/**
	 * Load admin screen css
	 * @return void
	 * @since  1.0.0
	 */
	public function admin_style( $hook_suffix ) {
			wp_enqueue_style( 'lovage-dashboard', LOVEAGE_INC_URI . 'admin/assets/css/dashboard.css', '' ) ;
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_script( 'thickbox' );
	}


	/**
	 * Admin Menu
	 * @return void
	 * @since  1.0.4
	 */
	public function admin_menu(){
		 
		 $plugins_callback = array( $this, 'admin_ui' );
		
		 if ( isset( $_GET['tgmpa-install'] ) || isset( $_GET['tgmpa-update'] ) ) {
			remove_action( 'admin_notices', array( $GLOBALS['tgmpa'], 'notices' ) );
			$plugins_callback = array( $GLOBALS['tgmpa'], 'install_plugins_page' );
		 }
		 
		 $admin_menu = array();
			 
		 $admin_menu['lovage'] = array(
	 		'menu_name'  => esc_html__( 'Lovage', 'lovage' ),
	 		'page_title' => esc_html__( 'Lovage', 'lovage' ),
	 		'tab_title'  => esc_html__( 'Dashboard', 'lovage' ),
	 		'menu_page'  => array( $this, 'admin_ui' ),
	 		'capability' => 'edit_theme_options',
	 		'show_as_tab'=> true
		 );

	 	 $admin_menu['lovage-plugins'] = array(
	 		'menu_name'  => null,
	 		'page_title' => esc_html__( 'Lovage Plugins', 'lovage' ),
	 		'tab_title'  => esc_html__( 'Plugins', 'lovage' ),
	 		'menu_page'  => $plugins_callback,
	 		'capability' => 'edit_theme_options',
	 		'show_as_tab'=> true
	 	 );

		 return apply_filters( 'lovage_admin_menu', $admin_menu );
	}

	/**
	 * Creates the dashboard page
	 * @since 1.0.0
	 */
	public function admin_register_menu() {
		if( current_user_can( 'edit_theme_options' ) ){
			
			$admin_menu = $this->admin_menu();

			foreach( $admin_menu as $key => $value ){
			  add_theme_page( $value['page_title'], $value['menu_name'], $value['capability'], $key, $value['menu_page'] );
			}
		  
	    }
	}

	/**
	 * The Admin screen header
	 * @since 1.0.0
	 */
	public function admin_ui_header() {
		$lovage = wp_get_theme( 'lovage' );
	?>
		<div class="wrap about-wrap lovage-wrap">
			<h1><?php echo '<strong>' . esc_html( $lovage['Name'] ) . '</strong> <sup class="version">' . esc_html( $lovage['Version'] ) . '</sup>'; ?></h1>
			<p class="intro"><?php echo esc_html( $lovage['Description'] );?></p>

		    <h2 class="nav-tab-wrapper">
		    	<?php 
					$admin_menu = $this->admin_menu();
					$active_tab = '';

					if( isset( $_GET[ 'page' ] ) ){
						$active_tab = sanitize_text_field( wp_unslash( $_GET[ 'page' ] ) );
					}

		    		foreach( $admin_menu as $key => $value ){
		    			$active_class = $active_tab == $key ? 'nav-tab-active' : '';
		    			
		    			if( $key == 'lovage-demo-installer' && class_exists( 'Lovage_Demo_Import_Plugin' ) ) {
		    				$key = 'lovage-demos';
		    				$active_class = $active_tab == 'lovage-demos' ? 'nav-tab-active' : '';

		    			}

		    			if( $value[ 'show_as_tab' ] ){
		    				echo '<a href="'.esc_url( admin_url( 'themes.php?page='.$key ) ).'" class="nav-tab ' . esc_attr( $active_class ) . '">' . esc_html( $value[ 'tab_title' ] ) . '</a>';
		    			}
		    		}
		    	?>
			</h2>
		<?php
	}

	/**
	 * Admin screen UI
	 * @since 1.0.0
	 */
	public function admin_ui(){
	   load_template( get_template_directory() . '/inc/admin/ui/index.php', TRUE );
	}

	/**
	 * Demo Importer Menu
	 * @since 1.0.0
	 */
	public function demo_import_menu( $default_settings ) {
		$default_settings['page_title']  = esc_html__( 'Lovage Demos' , 'lovage' );
		$default_settings['menu_title']  = esc_html__( 'Lovage Demos' , 'lovage' );
		$default_settings['capability']  = 'import';
		$default_settings['menu_slug']   = 'lovage-demos';

		return $default_settings;
	}

	/**
	 * Remove Demo Page Title
	 * @since 1.0.0
	 */
	public function remove_demo_page_title() {
		return '';
	}


	/**
	 * Register Option Setting
	 * @since 1.0.0
	 */
	public function register_option_setting() {
	   register_setting( 'lovage_option_group', 'lovage_ui_style' ); 
    }
    
    /**
     * Text Field
     */
	public static function text( $name,$val ) {
	  
	  if( null !== get_option( $name ) && get_option( $name ) !== '' ) {
	  	 $val = get_option( $name );
	  }

	  $return_html = '<input name="' . esc_attr( $name ) . '" type="text" class="ui textfield" value="' . esc_attr( $val ) . '">';      
      
      return $return_html;
	}

	/**
	 * Get the plugin link.
	 *
	 * @access  public
	 * @param array $item The plugin in question.
	 * @return  array
	 */
	public static function extension_link( $item ) {
		$installed_extensions = get_plugins();

		$item['sanitized_plugin'] = $item['name'];

		$actions = array();

		// We have a repo plugin.
		if ( ! $item['version'] ) {
			$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
		}

		$disable_class = '';
		$data_version  = '';

		// We need to display the 'Install' hover link.
		if ( ! isset( $installed_extensions[ $item['file_path'] ] ) ) {
			
			if ( isset( $item['premium'] ) && $item['premium'] ){
				$disable_class = ' disabled';
			}

			if ( ! $disable_class ) {
				$url = wp_nonce_url(
					add_query_arg(
						array(
							'page'          => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
							'plugin'        => rawurlencode( $item['slug'] ),
							'plugin_name'   => rawurlencode( $item['sanitized_plugin'] ),
							'tgmpa-install' => 'install-plugin',
							'return_url'    => 'lovage-extensions',
						),
						TGM_Plugin_Activation::$instance->get_tgmpa_url()
					),
					'tgmpa-install',
					'tgmpa-nonce'
				);
			} else {
				$url = '#';
			}

			$actions = array(
				'install' => '<a href="' . esc_url( $url ) . '" class="button button-primary' . esc_attr( $disable_class ) . '"' . esc_attr( $data_version ) . ' title="' . esc_attr( $item['sanitized_plugin'] ) . '" data-slug="'.esc_attr( $item['slug'] ).'">' . esc_html__( 'Install', 'lovage' ) . '</a>',
			);
		} elseif ( is_plugin_inactive( $item['file_path'] ) ) {
			// We need to display the 'Activate' hover link.
			$url = add_query_arg(
				array(
					'plugin'               => rawurlencode( $item['slug'] ),
					'plugin_name'          => rawurlencode( $item['sanitized_plugin'] ),
					'lovage-activate'       => 'activate-plugin',
					'lovage-activate-nonce' => wp_create_nonce( 'lovage-activate' ),
				),
				admin_url( 'themes.php?page=lovage-extensions' )
			);

			$actions = array(
				'activate' => '<a href="' . esc_url( $url ) . '" class="button button-primary"' . esc_attr( $data_version ) . ' title="' . esc_attr__( 'Activate', 'lovage' ). $item['sanitized_plugin'] . '" data-slug="' . esc_attr( $item['slug'] ) . '">' . esc_attr__( 'Activate' , 'lovage' ) . '</a>',
			);
		} elseif ( version_compare( $installed_extensions[ $item['file_path'] ]['Version'], $item['version'], '<' ) ) {
			$disable_class = '';
			// We need to display the 'Update' hover link.
			$url = wp_nonce_url(
				add_query_arg(
					array(
						'page'          => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
						'plugin'        => rawurlencode( $item['slug'] ),
						'tgmpa-update'  => 'update-plugin',
						'version'       => rawurlencode( $item['version'] ),
						'return_url'    => 'lovage-extensions',
					),
					TGM_Plugin_Activation::$instance->get_tgmpa_url()
				),
				'tgmpa-update',
				'tgmpa-nonce'
			);
			if ( $item['premium'] ){
				$disable_class = ' disabled';
			}
			$actions = array(
				'update' => '<a href="' . esc_url( $url ) . '" class="button button-primary' . esc_attr( $disable_class ) . '" title="' . esc_attr__( 'Update', 'lovage' ) . esc_attr( $item['sanitized_plugin'] ) . '">' . esc_html__( 'Update', 'lovage' ) . '</a>',
			);
		} elseif ( is_plugin_active( $item['file_path'] ) ) {
			$url = add_query_arg(
				array(
					'plugin'                 => rawurlencode( $item['slug'] ),
					'plugin_name'            => rawurlencode( $item['sanitized_plugin'] ),
					'lovage-deactivate'       => 'deactivate-plugin',
					'lovage-deactivate-nonce' => wp_create_nonce( 'lovage-deactivate' ),
				),
				admin_url( 'themes.php?page=lovage-extensions' )
			);
			$actions = array(
				'deactivate' => '<a href="' . esc_url( $url ) . '" class="button button-primary" title="' . esc_attr__( 'Deactivate', 'lovage' ) . $item['sanitized_plugin'] . '">' . esc_html__( 'Deactivate', 'lovage' ) . '</a>',
			);
		} // End if.

		return $actions;
	}

	/**
	 * Actions to run on initial theme activation.
	 */
	public function plugin_action() {

		if ( current_user_can( 'edit_theme_options' ) ) {

			if ( isset( $_GET['lovage-deactivate'] ) && 'deactivate-plugin' === sanitize_text_field( wp_unslash( $_GET['lovage-deactivate'] ) ) ) {
				check_admin_referer( 'lovage-deactivate', 'lovage-deactivate-nonce' );

				$plugins = TGM_Plugin_Activation::$instance->plugins;

				foreach ( $plugins as $plugin ) {
					if ( isset( $_GET['plugin'] ) && $plugin['slug'] == sanitize_text_field( wp_unslash( $_GET['plugin'] ) ) ) {
						deactivate_plugins( $plugin['file_path'] );
					}
				}
			}
			if ( isset( $_GET['lovage-activate'] ) && 'activate-plugin' === sanitize_text_field( wp_unslash( $_GET['lovage-activate'] ) ) ) {
				check_admin_referer( 'lovage-activate', 'lovage-activate-nonce' );

				$plugins = TGM_Plugin_Activation::$instance->plugins;

				foreach ( $plugins as $plugin ) {
					if ( isset( $_GET['plugin'] ) && $plugin['slug'] == sanitize_text_field( wp_unslash( $_GET['plugin'] ) ) ) {
						activate_plugin( $plugin['file_path'] );
						wp_safe_redirect( admin_url( 'admin.php?page=lovage-extensions' ) );
						exit;
					}
				}
			}
		}
	}

	/**
	 * Check the theme update.
	 */
	public function check_update(){
		require_once( get_template_directory() . '/inc/theme-update-checker.php' );
		$lovage_update_checker = new ThemeUpdateChecker(
			'lovage',
			'https://lovage.io/update-server/?action=get_metadata&slug=lovage'
		);
	}

}

return new Lovage_Admin();