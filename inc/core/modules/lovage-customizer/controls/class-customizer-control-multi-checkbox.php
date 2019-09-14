<?php
/**
 * Multi check boxes custom control.
 * @since 0.1.0
 * @author David Chandra Purnama <david@genbu.me>
 * @copyright Copyright (c) 2015, Genbu Media
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class Lovage_Customize_Control_Multi_Checkbox extends WP_Customize_Control {
	/**
	 * Control Type
	 */
	public $type = 'multi-checkbox';
	/**
	 * Enqueue Scripts
	 */
	public function enqueue() {
		
	}
	/**
	 * Render Settings
	 */
	public function render_content() {
		/* if no choices, bail. */
		if ( empty( $this->choices ) ){
			return;
		} ?>

		<?php if ( !empty( $this->label ) ){ ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php } // add label if needed. ?>

		<?php if ( !empty( $this->description ) ){ ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php } // add desc if needed. ?>

		<?php
		/* Data */
		$values = explode( ',', $this->value() );
		$choices = $this->choices;
		/* If values exist, use it. */
		$options = array();
		/* get individual post type */
		foreach( $choices as $key => $label ){
			$options[$key] = in_array( $key, $values ) ? '1' : '0';
		}
		?>

		<ul class="lovage-multicheck-list">

			<?php foreach ( $choices as $key => $label ){ ?>

				<li>
					<label>
						<input name="<?php echo esc_attr( $key ); ?>" class="lovage-multicheck-item" type="checkbox" value="<?php echo esc_attr( $options[$key] ); ?>" <?php checked( $options[$key] ); ?> /> 
						<?php echo esc_html( $label ); ?>
					</label>
				</li>

			<?php } // end choices. ?>

			<li class="lovage-hideme">
				<input type="hidden" class="lovage-multicheck" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
			</li>

		</ul><!-- .fx-share-multicheck-list -->

	<?php
	}
}