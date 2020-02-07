<?php
/**
 * Custom metabox for shop category and posts.
 * Eventually, some of the functionality here could be replaced by core features. 
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */


/**
 * Custom product category field
 */

// Add term page
function lovage_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field sidebar-settings">
		<label for="term_meta[cat_sidebar]"><?php echo esc_html__( 'Enable Sidebar', 'lovage' ); ?></label>
		<input type="radio" name="term_meta[cat_sidebar]" id="term_meta[cat_sidebar]" value="no" />
		<select name="term_meta[cat_sidebar]" id="term_meta[cat_sidebar]">
		 <option value="no"><?php echo esc_html__('No','lovage');?></option>
		 <option value="yes"><?php echo esc_html__('Yes','lovage');?></option>
		</select>
	</div>
	
	<div class="form-field slider-settings">
		<label for="term_meta[revslider_alias]"><?php echo esc_html__( 'Revolution Slider Alias', 'lovage' ); ?></label>
		<input type="text" name="term_meta[revslider_alias]" id="term_meta[revslider_alias]" value="" />
	</div>
<?php
}
add_action( 'product_cat_add_form_fields', 'lovage_taxonomy_add_new_meta_field', 20, 2 );

// Edit term page
function lovage_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	
	<tr class="form-field sidebar-settings">
	<th scope="row" valign="top"><label for="term_meta[cat_sidebar]"><?php echo esc_html__( 'Enable Sidebar', 'lovage' ); ?></label></th>
		<td>			
		  <select name="term_meta[cat_sidebar]" id="term_meta[cat_sidebar]">
		    <option value="no" <?php if(esc_attr( $term_meta['cat_sidebar'])=='no')echo 'selected="selected"'; ?>><?php echo esc_html__('No','lovage');?></option>
		    <option value="yes" <?php if(esc_attr( $term_meta['cat_sidebar'])=='yes')echo 'selected="selected"'; ?>><?php echo esc_html__('Yes','lovage');?></option>
		  </select>
		</td>
	</tr>
	
	<tr class="form-field slider_settings">
	<th scope="row" valign="top"><label for="term_meta[revslider_alias]"><?php echo esc_html__( 'Revolution Slider Alias', 'lovage' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[revslider_alias]" id="term_meta[revslider_alias]" value="<?php echo esc_html( $term_meta['revslider_alias'] ) ? esc_html( $term_meta['revslider_alias'] ) : ''; ?>">
		</td>
	</tr>
<?php 
}
add_action( 'product_cat_edit_form_fields', 'lovage_taxonomy_edit_meta_field', 20, 2 );

// Save extra taxonomy fields callback function.
function lovage_save_lovage_taxonomy_custom_meta( $term_id ) {
	 if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id");
        $cat_keys = array_keys( sanitize_text_field( wp_unslash( $_POST['term_meta'] ) ) );
            foreach ($cat_keys as $key){
            if (isset($_POST['term_meta'][$key])){
                $term_meta[$key] = sanitize_text_field( wp_unslash( $_POST['term_meta'][$key] ) );
            }
        }
        //save the option array
        update_option( "taxonomy_$t_id", $term_meta );
    }
}  
add_action( 'edited_product_cat', 'lovage_save_lovage_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_product_cat', 'lovage_save_lovage_taxonomy_custom_meta', 10, 2 );

?>