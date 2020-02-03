<?php
/**
 * Lovage Initialize
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Lovage' ) ) {
	class Lovage {
		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Setup class.
		 * @since 1.0
		 */
		public function __construct() {
			$this->constants();
			$this->init_core();
			$this->load_files();

			add_action( 'after_setup_theme',          array( $this, 'setup' ) );
			add_action( 'after_setup_theme',          array( $this, 'load_modules' ) );
			add_action( 'widgets_init',               array( $this, 'widgets_init' ) );
			add_action( 'wp_enqueue_scripts',         array( $this, 'scripts' ) );
			add_action( 'wp_enqueue_scripts',         array( $this, 'child_scripts' ), 30 ); 
			add_action( 'admin_init',         		  array( $this, 'admin_scripts' ), 10 );
		}

		public function constants(){
			define( 'LOVEAGE_API', 		  'https://lovage.io/api/' );
			define( 'LOVEAGE_THEME_URI',  trailingslashit( get_template_directory_uri() ) );
			define( 'LOVEAGE_THEME_DIR',  trailingslashit( get_template_directory() ) );
			define( 'LOVEAGE_INC_URI',    trailingslashit( LOVEAGE_THEME_URI.'inc' ) );
			define( 'LOVEAGE_INC_DIR',    trailingslashit( LOVEAGE_THEME_DIR.'inc' ) );
			define( 'LOVEAGE_CORE_URI',   trailingslashit( LOVEAGE_INC_URI.'core') );
			define( 'LOVEAGE_CORE_DIR',   trailingslashit( LOVEAGE_INC_DIR.'core') );
			define( 'LOVEAGE_MODULE_URI', trailingslashit( LOVEAGE_INC_URI.'modules' ) );
			define( 'LOVEAGE_MODULE_DIR', trailingslashit( LOVEAGE_INC_DIR.'modules' ) );
		}

		public function init_core(){

			load_template( LOVEAGE_CORE_DIR . 'core.php', TRUE );
			
			$lovage = new Lovage_Core( array(
				'lovage-plugin-page-templates',
				'lovage-template-loader',
			) );

		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 * @since 1.0
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function setup() {

			/*
		 	 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on lovage, use a find and replace
			 * to change 'lovage' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( 'lovage', LOVEAGE_THEME_DIR . '/languages' );
			$locale = get_locale(); 
			$locale_file = LOVEAGE_THEME_URI."/languages/$locale.php"; 
			if ( is_readable( $locale_file ) ) load_template( $locale_file, TRUE );

			// Sets the content width in pixels, based on the theme's design and stylesheet.
			if ( ! isset( $content_width ) ) $content_width = 1140;
			$GLOBALS['lovage_content_width'] = apply_filters( 'lovage_content_width', $content_width );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );
			
			/* Declare WooCommerce support*/
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			// Custom LOGO
			add_theme_support( 'custom-logo', array(
				'height'      => 160,
				'width'       => 560,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			) );


			// Set up the WordPress core custom header feature.
			add_theme_support( 'custom-header', apply_filters( 'lovage_custom_header_args', array(
				'default-image'          => LOVEAGE_THEME_URI.'assets/img/header-image.jpg',
				'width'                  => $GLOBALS['lovage_content_width'] ,
				'height'                 => 500,
				'flex-height'            => true,
				'header-text'			 => false
			) ) );

			/* Enable the editor style */
			add_editor_style( 'editor-style.css' );

			/*Change excerpt more string*/
			add_filter( 'excerpt_more', function(){ return '...'; } );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'lovage' ),
				'mobile'  => esc_html__( 'Mobile Menu', 'lovage' )
			) );

			// Gutenberg Support
			add_theme_support( 'align-wide' );
			add_theme_support(
			    'gutenberg',
			    array( 'wide-images' => true )
			);

			/**
			 * Add support for responsive embedded content.
			 */
			add_theme_support( 'responsive-embeds' );
		}

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		function widgets_init() {
			
			$widgets = array(
				array(
				    'name'          => esc_html__( 'Blog Sidebar', 'lovage' ),
					'id'            => 'sidebar',
					'description'   => esc_html__('This sidebar will be displayed on the category and single post page.','lovage' ),
			    ),
			    array(
				    'name'          => esc_html__( 'Page Sidebar', 'lovage' ),
					'id'            => 'sidebar-page',
					'description'   => esc_html__('This sidebar will be displayed on the static page.','lovage' ),
			    ),
			    array(
				    'name'          => esc_html__( 'Bottom Widget 1', 'lovage' ),
					'id'            => 'bottom-widget-1',
					'description'   => esc_html__('This widget area will be displayed on the left of the bottom section.','lovage' ),
			    ),
			    array(
				    'name'          => esc_html__( 'Bottom Widget 2', 'lovage' ),
					'id'            => 'bottom-widget-2',
					'description'   => esc_html__('This widget area will be displayed on the second left of the bottom section.','lovage'),
			    ),
			    array(
				    'name'          => esc_html__( 'Bottom Widget 3', 'lovage' ),
					'id'            => 'bottom-widget-3',
					'description'   => esc_html__('This widget area will be displayed on the middle of the bottom section.','lovage' ),
			    ),
			    array(
				    'name'          => esc_html__( 'Bottom Widget 4', 'lovage' ),
					'id'            => 'bottom-widget-4',
					'description'   => esc_html__('This widget area will be displayed on the right of the bottom section.','lovage' ),
			    ),
			);

			if( class_exists('WooCommerce') ){
				$widgets[] = array(
				    'name'          => esc_html__( 'Shop Sidebar', 'lovage' ),
					'id'            => 'sidebar-shop',
					'description'   => esc_html__('This sidebar will be displayed on the shop page.','lovage' ),
			    );
			}

			$widgets = apply_filters( 'lovage_widgets', $widgets );

			$widget_tags = array(
			  'before_widget' => '<div id="%1$s" class="widget %2$s">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h4 class="widget-title">',
			  'after_title'   => '</h4>',
			);

			$widget_tags = apply_filters( 'lovage_widget_tags', $widget_tags );

			foreach($widgets as $widget){
				$widget = array(
					'name'        => $widget['name'],
					'id'          => $widget['id'],
					'description' => $widget['description'],
				);
				$widget = array_merge($widget, $widget_tags);
				register_sidebar( $widget );
			}
			
		}

		/**
		 * Load CSS/JS
		 */
		public function scripts() {

			/**
			 * Enqueue scripts and styles.
			 */

			$css = array(
				  array(
				  	 'handler' => 'lovage-style',
				  	 'path'    => get_stylesheet_uri(),
				  	 'dependencies' => '',
				  	 'version' => null
				  ),
				  array(
				  	 'handler' => 'lovage-icons',
				  	 'path'    => LOVEAGE_INC_URI.'core/assets/vendors/lovage-icons/lovage-icons.css',
				  	 'dependencies' => '',
				  	 'version' => null
				  ),
				  array(
				  	 'handler' => 'lovage',
				  	 'path'    => LOVEAGE_THEME_URI.'assets/css/lovage.css',
				  	 'dependencies' => array('lovage-style'),
				  	 'version' => null
				  ),
				  array(
				  	 'handler' => 'lovage-woocommerce',
				  	 'path'    => LOVEAGE_THEME_URI.'assets/css/woocommerce.css',
				  	 'dependencies' => array('lovage-style'),
				  	 'version' => null
				  ),
			);

			foreach( $css as $file ){
				wp_enqueue_style( $file['handler'], $file['path'], $file['dependencies'], $file['version'] );
			}

			$js = array(
				array(
					'handler' => 'jquery-ease',
					'path'    => LOVEAGE_THEME_URI.'assets/js/jquery.easing.min.js',
					'dependencies' => array('jquery'),
					'version' => null,
					'in_footer' => false
				),
				array(
					'handler' => 'lovage',
					'path'    => LOVEAGE_THEME_URI.'assets/js/lovage.js',
					'dependencies' => array( 'jquery', 'imagesloaded', 'masonry' ),
					'version' => null,
					'in_footer' => true
				),
			);

			foreach( $js as $file ){
				wp_enqueue_script( $file['handler'], $file['path'], $file['dependencies'], $file['version'], $file['in_footer'] );
			}

			wp_localize_script( 'lovage', 'lovage_data', array(
				'template_url'    => LOVEAGE_THEME_URI,
				'content_width'   => $GLOBALS['lovage_content_width'],
				'woocommerce'     => class_exists('WooCommerce')? true : false,
				'sticky_header'	  =>  lovage_theme_customizer()->value('sticky_header') == 1 ? true : false
			) );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/**
		 * Enqueue child theme stylesheet.
		 * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
		 * Lovage css and the separate WooCommerce css.
		 *
		 * @since  1.0
		 */
		public function child_scripts() {
			if ( is_child_theme() ) {
				wp_enqueue_style( 'lovage-child-style', get_stylesheet_uri(), '' );
			}
		}

		/**
		 * Load Scripts in WP admin	
		 * @since 1.0
		 */
		public function admin_scripts(){
			wp_enqueue_style( "farbtastic" );
			wp_enqueue_script( "farbtastic" );
			wp_enqueue_style( "lovage-admin", LOVEAGE_INC_URI."admin/assets/css/admin.css", false, "1.0", "all" );
			wp_enqueue_script( "lovage-admin", LOVEAGE_INC_URI."admin/assets/js/admin.js", array('jquery'), "1.0", true );
			wp_localize_script( 'lovage-admin', 'lovage_admin_data', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'admin_url'=> admin_url()
			) );
		}


		/* Load Files
		 * Include the main files of framework.
		 * since 1.0
		 */
		function load_files(){

			/**
			 * Admin
			 */
			load_template( LOVEAGE_INC_DIR.'admin/class-tgm-plugin-activation.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'admin/class-plugin-installer.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'admin/extensions.php', TRUE );
			load_template( LOVEAGE_INC_DIR.'admin/class-admin.php', TRUE );

			/**
			 * Customizer additions.
			 */
			load_template( LOVEAGE_INC_DIR.'customizer/customizer.php', TRUE );

		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/** 
		 * Load Theme Modules
		 * @since 1.0
		 */
		public function load_modules(){
            
            $modules = glob( LOVEAGE_MODULE_DIR. '*' );

            if ( ! is_array( $modules ) ) {
                return;
            }
            
            foreach ( $modules as $module ) {
                
                if ( ! is_dir( $module ) ) {
                    continue;   
                }
                
                $path = trailingslashit( $module ) . 'module.'.basename( $module ) . '.php';

                if ( file_exists( $path ) ) {
                    load_template( $path, TRUE );
                }
            }

		}

	}
}

function lovage_user_agent() {
    return 'lovage-user-agent';
}

function Lovage(){
	return Lovage::get_instance();
}

return Lovage();