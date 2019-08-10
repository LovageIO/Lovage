<?php
/**
 * Lovage Plugin Installer
 *
 * @package  Lovage
 * @author   Darren Cooney
 * @link     https://github.com/dcooney/wordpress-plugin-installer
 * @link     https://connekthq.com
 * @version  1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
if( ! class_exists( ' Lovage_Plugins_Installer ' ) ) {
   class Lovage_Plugins_Installer {


	  public function __construct() {
	  	 add_action( 'wp_ajax_lovage_plugin_installer', array( &$this, 'lovage_plugin_installer' ) ); // Install plugin
         add_action( 'wp_ajax_lovage_plugin_activation', array( &$this, 'lovage_plugin_activation' ) ); // Activate plugin
		 add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );
	  }

      /*
      * init
      * Initialize the display of the plugins.
      *
      *
      * @param $plugin            Array - plugin data
      *
      * @since 1.0
      */
      public static function init( $plugins ){ ?>

         <div class="lovage-plugin-installer lovage-plugin-installer">
         <?php
           load_template( ABSPATH . 'wp-admin/includes/plugin-install.php', TRUE );
   		   foreach( $plugins as $plugin ) :
   		   	
               $button_classes = 'install button';
               $button_text = __( 'Install Now', 'lovage' );

               $api = plugins_api( 'plugin_information',
                  array(
                     'slug' => sanitize_file_name( $plugin['slug'] ),
                     'fields' => array(
                        'short_description' => true,
                        'sections' => false,
                        'requires' => false,
                        'downloaded' => true,
                        'last_updated' => false,
                        'added' => false,
                        'tags' => false,
                        'compatibility' => false,
                        'homepage' => false,
                        'donate_link' => false,
                        'icons' => true,
                        'banners' => true,
                     ),
                  )
                );

				$button_link = wp_nonce_url(
				    add_query_arg(
				        array(
				            'action' => 'install-plugin',
				            'plugin' => $api->slug
				        ),
				        admin_url( 'update.php' )
				    ),
				    'install-plugin'.'_'.$api->slug
				);
 
				if ( ! is_wp_error( $api ) ) { // confirm error free
	              
	               $main_plugin_file = self::get_plugin_file( $plugin['slug'] ); // Get main plugin file
	              
	               //echo $main_plugin_file;
	              
	               if( self::check_file_extension( $main_plugin_file ) ) { // check file extension
	   	          
	   	            if( is_plugin_active( $main_plugin_file ) ){
	      	            // plugin activation, confirmed!
	                  	$button_classes = 'button installer-button disabled';
	                  	$button_text = esc_html__( 'Activated', 'lovage' );
	                  } else {
	                     // It's installed, let's activate it
	                  	$button_classes = 'activate button installer-button button-primary';
	                  	$button_text = esc_html__( 'Activate', 'lovage' );
	                  	
	                  	$button_link = wp_nonce_url(
						    add_query_arg(
						        array(
						            'action' => 'activate',
						            'plugin' => self::get_plugin_file( $plugin['slug'] )
						        ),
						        admin_url('plugins.php' )
						    ),
						    'activate-plugin'.'_'.self::get_plugin_file( $plugin['slug'] )
						);
	                  }
	               }
	               // Send plugin data to template
	               self::render_template( $plugin, $api, $button_link, $button_text, $button_classes );
               }
   			endforeach;
   			?>
         </div>
      <?php
      }
		/*
      * render_template
      * Render display template for each plugin.
      *
      *
      * @param $plugin            Array - Original data passed to init()
      * @param $api               Array - Results from plugins_api
      * @param $button_text       String - text for the button
      * @param $button_classes    String - classnames for the button
      *
      * @since 1.0
      */
      public static function render_template( $plugin, $api, $button_link, $button_text, $button_classes ){
         ?>
         <div class="plugin">
		      <div class="plugin-wrap">
			      <img src="<?php echo esc_html( $api->icons['1x'] ); ?>" alt="">
               <h2><?php echo esc_html( $api->name ); ?></h2>
               <p><?php echo esc_html( $api->short_description ); ?></p>

               <p class="plugin-author"><?php esc_html_e( 'By', 'lovage' ); ?> <?php echo wp_kses_post( $api->author ); ?></p>
			   </div>
			   <ul class="activation-row">
               <li>
                  <a class="<?php echo esc_attr( $button_classes ); ?>"
                  	data-slug="<?php echo esc_html( $api->slug ); ?>"
								data-name="<?php echo esc_html( $api->name ); ?>"
									href="<?php echo esc_url($button_link);?>">
							<?php echo esc_html( $button_text ); ?>
                  </a>
               </li>
               <li>
                  <a href="https://wordpress.org/plugins/<?php echo esc_html( $api->slug ); ?>/" target="_blank">
                     <?php esc_html_e( 'More Details', 'lovage' ); ?>
                  </a>
               </li>
            </ul>
		   </div>
      <?php
      }
		/*
      * lovage_plugin_installer
      * An Ajax method for installing plugin.
      *
      * @return $json
      *
      * @since 1.0
      */
		public function lovage_plugin_installer(){
			if ( ! current_user_can( 'install_plugins' ) )
				wp_die( esc_html__( 'Sorry, you are not allowed to install plugins on this site.', 'lovage' ) );
			
			$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST["nonce"] ) ) : '';
			$plugin = isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST["plugin"] ) ) : '';
			
			// Check our nonce, if they don't match then bounce!
			if (! wp_verify_nonce( $nonce, 'lovage_installer_nonce' ) )
				wp_die( esc_html__( 'Error - unable to verify nonce, please try again.', 'lovage') );
        	
        	 // Include required libs for installation
			load_template( ABSPATH . 'wp-admin/includes/plugin-install.php', TRUE );
			load_template( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php', TRUE );
			load_template( ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php', TRUE );
			load_template( ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php', TRUE );
			
			// Get Plugin Info
			$api = plugins_api( 'plugin_information',
				array(
					'slug' => $plugin,
					'fields' => array(
						'short_description' => false,
						'sections' => false,
						'requires' => false,
						'rating' => false,
						'ratings' => false,
						'downloaded' => false,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
					),
				)
			);

			$skin     = new WP_Ajax_Upgrader_Skin();
			$upgrader = new Plugin_Upgrader( $skin );
			
			$upgrader->install( $api->download_link );
			
			if( $api->name ){
				$status = 'success';
				$msg = esc_html( $api->name ) .' successfully installed.';
			} else {
				$status = 'failed';
				$msg = 'There was an error installing '. esc_html( $api->name ) .'.';
			}
			$json = array(
				'status' => $status,
				'msg' => $msg,
			);
			wp_send_json( $json );
		}
		 /*
	      * lovage_plugin_activation
	      * Activate plugin via Ajax.
	      *
	      * @return $json
	      *
	      * @since 1.0
	      */
		public function lovage_plugin_activation(){
			if ( ! current_user_can('install_plugins') ) {
				wp_die( esc_html__( 'Sorry, you are not allowed to activate plugins on this site.', 'lovage' ) );
				$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST["nonce"] ) ) : '';
				$plugin =isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST["plugin"] ) ) : '';
			}
			
			// Check our nonce, if they don't match then bounce!
			if ( ! wp_verify_nonce( $nonce, 'lovage_installer_nonce' ) )
				die( esc_html__( 'Error - unable to verify nonce, please try again.', 'lovage' ) );
        
        	 // Include required libs for activation
			load_template( ABSPATH . 'wp-admin/includes/plugin-install.php', TRUE );
			load_template( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php', TRUE );
			load_template( ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php', TRUE );
			
			// Get Plugin Info
			$api = plugins_api( 'plugin_information',
				array(
					'slug' => $plugin,
					'fields' => array(
						'short_description' => false,
						'sections' => false,
						'requires' => false,
						'rating' => false,
						'ratings' => false,
						'downloaded' => false,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
					),
				)
			);
			
			if( $api->name ){
				$main_plugin_file = self::get_plugin_file($plugin);
				$status = 'success';
				if( $main_plugin_file ){
					activate_plugin( $main_plugin_file );
					$msg = esc_html( $api->name ) . esc_html__( ' successfully activated.', 'lovage' );
				}
			} else {
				$status = 'failed';
				$msg = esc_html__( 'There was an error activating ', 'lovage' ). esc_html( $api->name ) .'.';
			}
			
			$json = array(
				'status' => $status,
				'msg' => $msg,
			);
			
			wp_send_json( $json );
		}
      /*
      * get_plugin_file
      * A method to get the main plugin file.
      *
      *
      * @param  $plugin_slug    String - The slug of the plugin
      * @return $plugin_file
      *
      * @since 1.0
      */
      public static function get_plugin_file( $plugin_slug ) {
        
         load_template( ABSPATH . 'wp-admin/includes/plugin.php', TRUE );
       
         $plugins = get_plugins();
        
         foreach( $plugins as $plugin_file => $plugin_info ) {
	         // Get the basename of the plugin e.g. [askismet]/askismet.php
	         $slug = dirname( plugin_basename( $plugin_file ) );
	         if($slug){
	            if ( $slug == $plugin_slug ) {
	               return $plugin_file; // If $slug = $plugin_name
	            }
            }
         }
         return null;
      }
	   /*
		* check_file_extension
		* A helper to check file extension
		*
		*
		* @param $filename    String - The filename of the plugin
		* @return boolean
		*
		* @since 1.0
		*/
		public static function check_file_extension( $filename ) {
			if( substr( strrchr( $filename, '.' ), 1 ) === 'php' ){
				// has .php exension
				return true;
			} else {
				// ./wp-content/plugins
				return false;
			}
		}

	  /*
       * enqueue_scripts
       * Enqueue admin scripts and scripts localization
       *
       *
       * @since 1.0
       */
      public function enqueue_scripts(){
            wp_enqueue_script( 'plugin-installer', LOVEAGE_INC_URI. 'admin/assets/js/plugin-installer.js', array( 'jquery' ) );
			wp_localize_script( 'plugin-installer', 'lovage_installer_localize', array(
               'ajax_url' => admin_url( 'admin-ajax.php' ),
               'install_nonce' => wp_create_nonce( 'lovage_plugin_installer_nonce' ),
               'install_now' => esc_html__( 'Are you sure you want to install this plugin?', 'lovage' ),
               'install_btn' => esc_html__( 'Install Now', 'lovage' ),
               'activate_btn' => esc_html__( 'Activate', 'lovage' ),
               'installed_btn' => esc_html__( 'Activated', 'lovage' )
            ) );
      }
   }

   // initialize
   return new Lovage_Plugins_Installer();
}
