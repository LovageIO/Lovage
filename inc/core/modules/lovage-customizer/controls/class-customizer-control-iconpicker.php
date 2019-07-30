<?php

if ( class_exists( 'WP_Customize_Control' ) ) {

	class Lovage_Customize_Iconpicker_Control extends WP_Customize_Control {

		/**
		 * Control Type
		 */
		public $type = 'iconpicker';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<div class="input-group icp-container">
					<input data-placement="bottomRight" class="icp icp-auto" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" type="text">
					<span class="input-group-addon"></span>
				</div>
			</label>
			<?php
		}

		/**
		 * Enqueue required scripts and styles.
		 */
		public function enqueue() {
			wp_enqueue_script( 'lovage-fontawesome-iconpicker', LOVEAGE_CORE_URI. 'modules/lovage-customizer/assets/vendors/icon-picker/fontawesome-iconpicker.min.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'lovage-iconpicker', LOVEAGE_CORE_URI. 'modules/lovage-customizer/assets/vendors/icon-picker/iconpicker-control.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_style( 'lovage-fontawesome-iconpicker', LOVEAGE_CORE_URI . 'modules/lovage-customizer/assets/vendors/icon-picker/fontawesome-iconpicker.min.css' );
			wp_enqueue_style( 'lovage-fontawesome', LOVEAGE_CORE_URI . 'modules/lovage-customizer/assets/vendors/icon-picker/font-awesome.min.css' );
		}

	}

}