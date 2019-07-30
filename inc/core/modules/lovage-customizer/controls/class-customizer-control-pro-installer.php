<?php
/**
 * Lovage Pro installer
 *
 * @author Braad Martin <http://braadmartin.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker
 */

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'Lovage_Customize_Control_Pro_Installer' ) ) {
    /**
     * A simple control that will render the installer <iframe>.
     * We'll apply some CSS in order to move the section to the top
     * as well as style the section & the iframe.
     */
    class Lovage_Customize_Control_Pro_Installer extends WP_Customize_Control {
        /**
         * The control-type.
         *
         * @access public
         * @var string
         */
        public $type = 'lovage-pro-installer';
        /**
         * Renders the control.
         *
         * @access public
         */
        public function render_content() {
            ?>
            <style>
            li#accordion-section-installation { background:#ff890f; color:#fff; }
            li#aaccordion-section-installation .accordion-section-title,li#accordion-section-installation .customize-section-title { display: none; }
            li#accordion-section-installation ul.accordion-section-content { display: block; position: relative; left: 0; margin-top: 0 !important; padding-top: 0; padding-bottom: 0; }
            #customize-controls li#aaccordion-section-installation .description { font-size: 1em; }
            #customize-control-installation { margin-bottom: 0; }
            </style>

            <?php 
	            $plugins   = get_plugins(); 
	            $installed = false;
	            foreach ( $plugins as $plugin ){
	               if ( 'Lovage Pro' === $plugin['Name'] ){
	                    $installed = true; 
	               }
	            }
            ?>

            <?php if ( ! $installed ) : ?>

                <?php
                    $plugin_install_url = admin_url('themes.php?page=lovage-extensions');
                ?>

                <a class="install-now button-primary button" target="_blank" href="https://lovage.io/pro/?utm_source=<?php bloginfo('name');?>-customizer&utm_medium=uprade-to-pro&utm_campaign=unlock-all-options"><?php esc_html_e( 'Learn More','lovage' ); ?></a>

                <br/></br><!-- Added <br/> tags to fix the spacing -->

            <?php else : ?>
                <hr>
                <p><?php esc_html_e( 'The Lovage Pro plugin is installed but not activated. ', 'lovage' ); ?> <a href="<?php echo esc_url($plugin_install_url);?>" class="install-now button-primary button"><?php esc_html_e('Activate it', 'lovage');?></a></p>
            <?php endif;
        }
    }
}