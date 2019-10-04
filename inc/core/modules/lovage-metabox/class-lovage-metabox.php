<?php
/**
 * Lovage Meta Box Module
 * @package core/modules/lovage-metabox
 * @version 1.0.4
 */

if( ! class_exists( 'Lovage_MetaBox' ) ){
	class Lovage_MetaBox {

		/**
		 * Metabox Arguments
		 * @since 1.0.0
		 * @access protected
		 * @var object.
		 */
		public $metabox = array();

		/*
		$metabox = array(
		   'id'    => 'unique_metabox_id',
		   'title' => 'unique_metabox_title',
		   'description'  => 'unique_metabox_title',
		   'post_type'    => array('post'),
		   'callback'	  => '',
		   'tabs'		  => array(
		      'tab1' => array( 'title' => 'Tab 1'),
		      'tab2' => array( 'title' => 'Tab 2')
		   ),
		   'options'  => array(
			   'id' => array(
					'label'			 => esc_html('option label'),
					'description'    => esc_html('description text'),
					'tab'			 => 'tab1',
					'type'			 => 'text',
					'style'			 => '',
					'default'		 => '',
					'placeholder'	 => '',
					'choices'		 => array(
						'val' => 'label'
					)
			   ),
		   )
		);
		*/

		public function __construct() {
			add_action( 'load-post.php', 				   array( $this, 'init' ) );
			add_action( 'load-post-new.php', 			   array( $this, 'init' ) );
			add_action( 'admin_enqueue_scripts', 		   array( $this, 'enqueue'      ) );
		}

		public function init(){
			add_action( 'add_meta_boxes',                  array( $this, 'add_meta_box' ) );
			add_action( 'save_post',                       array( $this, 'save_meta_value' ) );
		}

		/**
		 * Register New Metabox
		 */
		public function add_meta_box() {

			$post_type 		= isset( $this->metabox['post_type'] ) ? $this->metabox['post_type'] : array( 'post' );
			$metabox_id 	= isset( $this->metabox['id'] ) ? $this->metabox['id'] : '';
			$metabox_title  = isset( $this->metabox['title'] ) ? $this->metabox['title'] : '';
			$metabox_context  = isset( $this->metabox['context'] ) ? $this->metabox['context'] : 'normal';
			$metabox_priority = isset( $this->metabox['priority'] ) ? $this->metabox['priority'] : 'high';
			$compatible_with_gutenberg = isset( $this->metabox['block_compatible'] ) ? $this->metabox['block_compatible'] : true;

			$callback = isset( $this->metabox['callback'] ) ? call_user_func( $this->metabox['callback'] ) : true;
			
			if( ! $callback ){
				return;
			}

			add_meta_box( 
				$metabox_id, 
				$metabox_title, 
				array( $this, 'create_meta_box_content' ), 
				$post_type,
				$metabox_context, 
				$metabox_priority,
				array(
			        '__block_editor_compatible_meta_box' => $compatible_with_gutenberg,
			    )
			);
		}

		/**
		 * Create Metabox HTML
		 */
		public function create_meta_box_content() {
			$tabs 	    = isset( $this->metabox['tabs'] ) ? $this->metabox['tabs'] : '';
			$metabox_id = isset( $this->metabox['id'] ) ? $this->metabox['id'] : '';
			?>
			<div id="lovage-metabox-tabs-<?php echo esc_html( $metabox_id );?>" class="lovage-metabox-tabs">

				<?php wp_nonce_field( basename( __FILE__ ), esc_attr( $this->metabox['id'] ).'_nonce' ); ?>

				<?php if( isset( $this->metabox['description'] ) && '' !== $this->metabox['description'] ):?>
					<p class="lovage-desc"><?php echo wp_kses_post( $this->metabox['description'] );?></p>
			    <?php endif;?>

				<?php if( isset( $tabs ) ):?>
					<div class="lovage-metabox-tabs-container">
						<ul>
							
								<?php 
								$i=1; 
								foreach( $tabs as $key => $val ):
								?>
									<li class="lovage-metabox-tab-item <?php echo $i==1 ? 'active' : ''; ?>" id="lovage-metabox-tab-item-<?php echo esc_html( trim( $key ) );?>"><a href="javascript:void(0);" data-target="#lovage-metabox-tab-content-<?php echo esc_html( $key );?>"><?php echo esc_html( $val['title'] );?></a></li>
								<?php
								$i++;
								endforeach;
								?>

						</ul>
				    </div>
			    <?php endif;?>

				<?php 
				// Tabs
				if( isset( $tabs ) ): 
					$j = 1; 
					foreach( $tabs as $key => $val ):
				?>
						<div id="lovage-metabox-tab-content-<?php echo esc_html( $key );?>" class="lovage-metabox-tab-content" <?php echo $j > 1 ? 'style="display:none;"' : ''; ?>>

							<div class="lovage-meta-form">
								<?php 
								foreach( $this->metabox['options'] as $id => $args ): 
									
									$label       = isset( $args['label'] ) ? $args['label'] : '';
									$description = isset( $args['description'] ) ? $args['description'] : '';
									$tab         = isset( $args['tab'] ) ? $args['tab'] : '';
									$option_callback    = isset( $args['callback'] ) ? call_user_func( $args['callback'] ) : true;

									if( $option_callback && $tab == $key ):
								?>
								<dl>
									<dt scope="row"><label for="<?php echo esc_html( $id );?>"><?php echo esc_html( $label );?></label></dt>
									<dd class="lovage-option"><?php $this->option_type( $id, $args );?><span class="lovage-meta-desc"><?php echo wp_kses_post( $description );?></span></dd>
								</dl>
								<?php 
								    endif;
								endforeach;
								?>
							</div>
						</div>
				<?php 
					    $j++;
			        endforeach; 
			    else:
			    // No Tabs
			    ?>
	    		<div id="lovage-metabox-content-<?php echo esc_attr( $metabox_id );?>" class="lovage-metabox-content">
					<div class="lovage-meta-form">
						<?php 
						foreach( $this->metabox['options'] as $id => $args ): 
							$label       = isset( $args['label'] ) ? $args['label'] : '';
							$description = isset( $args['description'] ) ? $args['description'] : '';
							$type = isset( $args['type'] ) ? $args['type'] : 'text';
							$option_callback    = isset( $args['callback'] ) ? $args['callback'] : true;

							if( $option_callback ):
						?>
						<dl>
							<dt scope="row"><label for="<?php echo esc_html( $id );?>"><?php echo esc_html( $label );?></label></dt>
							<dd class="lovage-option <?php echo esc_attr( $type );?>">
								<?php $this->option_type( $id, $args );?>
								<span class="lovage-meta-desc"><?php echo wp_kses_post( $description );?></span>
							</dd>
						</dl>
						<?php endif; endforeach;?>
					</div>
				</div>
			    <?php endif;?>
			</div>
			<?php
		}

		/**
		 * Option Type
		 * @param $id: option id
		 * @param $args: option arguments
		 */
		public function option_type( $id, $args ){
			global $post;
			$type    	 = isset( $args['type'] ) ? $args['type'] : 'text';
			$class  	 = isset( $args['class'] ) ? $args['class'] : '';
			$default 	 = isset( $args['default'] ) ? $args['default'] : '';
			$placeholder = isset( $args['placeholder'] ) ? esc_html( $args['placeholder'] ) : '';

			$value = '';
			$html  = '';
			$saved_value = get_post_meta( $post->ID, $id, true );

			if( metadata_exists( get_post_type( $post->ID ), $post->ID, $id ) || ! empty( $saved_value ) ){
				$value = $saved_value;
			}else{
				$value = $args['default'];
			}

			switch( $type ){

				case 'number':
				  $html .= '<input type="number" value="' . sanitize_text_field( $value ) . '" class="' . esc_html( $class ) . '" placeholder="' . esc_html( $placeholder ) . '" name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" />';
				  break;

				case 'email':
				  $html .= '<input type="email" value="' . sanitize_email( $value ) . '" class="' . esc_html( $class ). '" placeholder="' . esc_html( $placeholder ) . '" name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" />';
				  break;

				case 'textarea':
				  $html .= '<textarea placeholder="' . sanitize_textarea_field( $value ) . '" class="' . esc_html( $class ). '" name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '">' . sanitize_textarea_field( $value ) . '</textarea>';
				  break;

				case 'select':
			      $choices = '';

				  foreach( $args['choices'] as $val => $label ){
				  	$selected = ( $value == $val ) ? 'selected="selected"' : '';
				  	$callback = isset( $label['callback'] ) ? call_user_func( $label['callback'] ) : true;

				  	if( $callback ){
						$choices .= '<option value="' . esc_html( $val ) . '" '.$selected.'>' . esc_html( $label ) . '</option>';
					}
				  }

				  $html .= '<select class="' . esc_html( $class ). '" name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '">' . $choices . '</select>';
				  break;

				case 'range':

				  $max 	= isset( $args['max'] ) ? $args['max'] : '100';
				  $min 	= isset( $args['min'] ) ? $args['min'] : '1';
				  $val  = $value !== $default ? $value : $default;
				  $html .= '
					<div class="lovage-metabox-range">
				 	 <input type="range" name=" ' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" min="' . esc_attr( $min ) . '" max="' . esc_attr( $max ) . '" value="' . sanitize_text_field( $val ) . '" class="lovage-slider ' . esc_attr( $class ) . '"> 
				 	 <div class="lovage-metabox-range-numbers">
				 	   <span>' . esc_attr( $min ) . '</span>
				 	   <span id="lovage-range-value-'.esc_attr( $id ).'" class="lovage-metabox-range-value"></span>
				 	   <span>' . esc_attr( $max ) . '</span>
				 	 </div>
				 	</div>
				 	<script>
						var lovage_range_' . esc_attr( $id ) . ' = document.getElementById("' . esc_attr( $id ) . '");
						var lovage_range_value_' . esc_attr( $id ) . ' = document.getElementById("lovage-range-value-' . esc_attr( $id ) . '");
						lovage_range_value_' . esc_attr( $id ) . '.innerHTML = lovage_range_' . esc_attr( $id ) . '.value;

						lovage_range_'. esc_attr( $id ) .'.oninput = function() {
						    lovage_range_value_'. esc_attr( $id ) .'.innerHTML = this.value;
						}
					</script>
				 	';
				  break;

				case 'checkbox':
				  $checked = ( $value == 1 ) ? 'checked="checked"' : '';
				  $html .= '
				  <label class="lovage-metabox-checkbox ' . esc_attr( $class ) . '">
				  	<input type="checkbox" class="' . esc_attr( $class ). '" name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" value="1" '.$checked.'>
				  	<span class="checkmark"></span>
				  </label>';
				  break;

				case 'multi-checkbox':
				  $i = 1;

				
				  foreach( $args['choices'] as $val => $label ){

				  	if ( in_array( $val, $value ) ) {
			            $checked = 'checked="checked"';
			        } else {
			            $checked = null;
			        }

			        $callback = isset( $label['callback'] ) ? call_user_func( $label['callback'] ) : true;

			        if( $callback ){
					  	$html .= '<label class="lovage-metabox-checkbox ' . esc_attr( $class ) . '">
					  				<input type="checkbox" class="' . esc_attr( $class ) . '" name="' . esc_attr( $id ) . '[]" id="' . esc_attr( $id ) . '['. $i .']" value="' . esc_attr( $val ) . '" '.$checked.'><span>' . esc_html( $label ) . '</span>
					  				<span class="checkmark"></span>
					  			  </label>';
				  	}
				    $i++;
				  }
				  break;

				case 'radio':
				  foreach( $args['choices'] as $val => $label ){
				  	
				  	$checked = ( $value == $val ) ? 'checked="checked"' : '';
				  	$callback = isset( $label['callback'] ) ? call_user_func( $label['callback'] ) : true;

				  	if( $callback ){
				  		$html .= '<label class="lovage-metabox-radio">
				  					<input type="radio" class="' . esc_attr( $class ) . '" name="' . esc_attr( $id ) . '" value="' . esc_attr( $val ) . '" '.$checked.'><span>' . esc_html( $label ) . '</span>
					  				<span class="checkmark"></span>
					  			  </label>';
				  	}
				  }
				  break;

				case 'radio-image':
				  
				  $i = 1;

				  foreach( $args['choices'] as $val => $label ){

				  	$checked = ( $value == $val ) ? 'checked="checked"' : '';
				  	$callback = isset( $label['callback'] ) ? call_user_func( $label['callback'] ) : true;

					if( $callback ){
					  	$html .= '<label class="lovage-metabox-radio-image ' . esc_attr( $class ) . '">
					  				<input type="radio" name="' . esc_attr( $id ) . '" value="' . esc_attr( $val ) . '" '. $checked.'>
					  				<img src="' . esc_utl( $label['image'] ) . '" />';

					  	    if( isset( $label['title'] ) && '' !== $label['title'] ){
					  		   $html .= '<span class="lovage-metabox-radio-image-title">' . esc_html( $label['title'] ) . '</span>';
					  	    }
					  		$html .= '</label>';
				  	}

					$i++;
				  }
				  break;

				case 'toggle':
				    if ( $value == 1 ) {
			            $checked = 'checked="checked"';
			        } else {
			            $checked = null;
			        }
				  $html .= '<label class="lovage-metabox-switch '.$class.'">
							  <input type="checkbox" name="' . esc_html( $id ) . '" id="' . esc_html( $id ) . '" value="1" '.$checked.'>
							  <span class="slider round"></span>
						    </label>';
				  break;

				case 'date-picker':
				  $html .= '<input type="text" placeholder="' . esc_html( $placeholder ) . '" class="lovage-metabox-date-picker ' . esc_attr( $class ) . '" name="' . esc_html( $id ) . '" id="' . esc_html( $id ) . '" value="' . sanitize_text_field( $value ) . '">';
				  break;

				case 'colorpicker':
				  $html .= '<input type="text" placeholder="' . esc_html( $placeholder ) . '" class="' . esc_attr( $class ) . '" value=" ' . sanitize_text_field( $value ) . '" name="' . esc_html( $id ) . '" id="' . esc_html( $id ) . '" />
				  			<script>jQuery(document).ready(function($){
						    $("#' . esc_html( $id ) . '").wpColorPicker();
						    });</script>
				  	  ';
				  break;

				case 'image':
				  $html .= '<div class="lovage-metabox-image ' . esc_attr( $class ) . '">';
				  $html .= '<input type="url" class="' . esc_attr( $class ) . '" value="' . esc_url( $value ) . '" name="' . esc_html( $id ) . '" id="' . esc_html( $id ) . '" />
				  	       <input type="button" class="image-upload button" value="'.__( 'Choose or Upload an Image', 'lovage' ).'" />';
				  if( isset( $value ) && $value !== '' ){
				  	$html .= '<span class="lovage-image-preview"><div class="preview-image"><img src="' . esc_url( $value ) . '" /> <a href="javascript:;" class="delete">&#10005</a></div></span>';
				  }else{
				  	   $html .= '<span class="lovage-image-preview"></span>';
				  }
				  $html .= '</div>';
				  break;

				case 'multi-image':
				  $html .= '<div class="lovage-metabox-image lovage-metabox-multi-image ' . esc_attr( $class ) . '">';
				  $html .= "<input type='hidden' value='" . esc_html( $value ) . "' name='" . esc_html( $id ) . "' id='" . esc_html( $id ) . "' />";
				  $html .= '<input type="button" class="multi-image-upload button" value="'.__( 'Choose or Upload Images', 'lovage' ).'" />';
				  
				  if( $value !== '' ){
				  	   $preview = '';
				  	   $images = json_decode( $value );

				  	   if( isset( $images ) ){
					  	   foreach( $images as $image ){
					  	   	$preview .= '<div class="preview-image" id="image-' . esc_attr( $image->id ) . '"><img src="'. esc_url( $image->url ) . '" /> <a href="javascript:;" class="delete">&#10005</a></div>';
					  	   }
				  	   }
				  	   $html .= '<span class="lovage-image-preview">' . $preview . '</span>';
				  }else{
				  	   $html .= '<span class="lovage-image-preview"></span>';
				  }
				  $html .= '</div>';
				  break;

				case 'url':
				  $html .= '<input type="url" placeholder="' . esc_html( $placeholder ) . '" class="' . esc_attr( $class ) . '" value="' . esc_url( $value ) . '" placeholder="' . esc_html( $placeholder ) . '" name="' . esc_attr( $id ). '" id="' . esc_attr( $id ) . '" />';
				  break;

				case 'text':
				default:
				  $html .= '<input type="text" laceholder="'.esc_html( $placeholder ).'" class="' . esc_attr( $class ) . '" value="' .sanitize_text_field( $value ) . '" placeholder="' . esc_html( $placeholder ) . '" name="' . esc_attr( $id ). '" id="' . esc_attr( $id ) . '" />';
				  break;
			}

			echo $html;
		}


		/**
		 * Save the meta value.
		 */
		public function save_meta_value( $post_id ){

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

	        // Checks save status
		    $is_autosave = wp_is_post_autosave( $post_id );
		    $is_revision = wp_is_post_revision( $post_id );
		    $is_valid_nonce = ( isset( $_POST[$this->metabox['id'].'_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[$this->metabox['id'].'_nonce'] ) ), basename( __FILE__ ) ) ) ? 'true' : 'false';
		 
		    // Exits script depending on save status
		    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		        return;
		    }

	        foreach( $this->metabox['options'] as $meta_key => $args ){
	        	
	        	$new_meta_value =  isset( $_POST[$meta_key] ) ? sanitize_text_field( wp_unslash( $_POST[$meta_key] ) ) : '';
	        	$meta_value = get_post_meta( $post_id, $meta_key, true );

	        	if ( $new_meta_value ) {
					update_post_meta( $post_id, $meta_key, $new_meta_value );
				}elseif ( empty( $new_meta_value ) && $meta_value ) {
					delete_post_meta( $post_id, $meta_key );
				}
	        }
		}

		/**
		 * Enqueue Style and Scripts
		 */
		public function enqueue() {
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'jquery-ui', LOVEAGE_CORE_URI.'modules/lovage-metabox/jquery-ui.css' );

			wp_enqueue_style( 'lovage-metabox', LOVEAGE_CORE_URI.'modules/lovage-metabox/lovage-metabox.css' );
			wp_enqueue_script( 'lovage-metabox', LOVEAGE_CORE_URI.'modules/lovage-metabox/lovage-metabox.js', array( 'jquery','jquery-ui-datepicker' ), '', true );

			wp_localize_script( 'lovage-metabox', 'image_upload',
	            array(
	                'title' => __( 'Choose or Upload an Image', 'lovage' ),
	                'button' => __( 'Use this image', 'lovage' ),
	            )
	        );
		}
	}
}
