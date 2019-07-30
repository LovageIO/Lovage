<?php
/**
 * Customizer Control: typography.
 *
 * @package     lovage
 * @author      Lovage
 * @copyright   Copyright (c) 2019, Lovage
 * @link        https://lovage.io/
 * @since       1.0.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all google fonts
 */
 class Lovage_Customize_Typography_Control extends WP_Customize_Control{
    private $fonts = false;
   
    public function __construct($manager, $id, $args = array(), $options = array()){
        $this->fonts = $this->get_fonts('all');
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Enqueue required scripts and styles.
     */
    public function enqueue() {
        wp_enqueue_script( 'lovage-select2', LOVEAGE_CORE_URI. 'modules/lovage-customizer/assets/vendors/select2/select2.min.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_style( 'lovage-select2', LOVEAGE_CORE_URI . 'modules/lovage-customizer/assets/vendors/select2/select2.min.css' );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content(){
        if(!empty($this->fonts))
        {
            $weight = array();
            $subsets = array();
            $value = json_decode($this->value(), true);
            ?>
                <div class="customize-typography-control-container" data-instance-id="<?php echo $this->instance_number;?>">
                    <?php if ( !empty( $this->label ) ): ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif;?>

                    <?php if ( !empty( $this->description ) ): ?>
                      <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                    <?php endif;?>

                    <label><?php esc_html_e('Font Family', 'lovage');?>
                        <select name="lovage_typo_family_<?php echo $this->instance_number;?>">
                            <option value="System Default"><?php esc_html_e('System Default', 'lovage');?></option>
                            <?php
                                foreach ( $this->fonts as $v )
                                {
                                    printf('<option value="%s" %s>%s</option>', $v->family, selected($value['font_family'], $v->family, false), $v->family);

                                    if($v->family == $value['font_family']){
                                        $weight = $v->variants;
                                        $subsets = $v->subsets;
                                    }
                                }
                            ?>
                        </select>
                    </label>

                    <?php if(isset($value['font_size'])):?>
                    <label><?php esc_html_e('Font Size', 'lovage');?>
                       <input type="text" name="lovage_typo_size_<?php echo $this->instance_number;?>" value="<?php echo $value['font_size'];?>" />
                    </label>
                    <?php endif;?>

                    <?php if(isset($value['font_weight'])):?>
                    <label><?php esc_html_e('Font Weight', 'lovage');?>
                       <select name="lovage_typo_weight_<?php echo $this->instance_number;?>">
                         <?php 
                             foreach($weight as $w){
                                echo '<option value="'.$w.'" '.selected($value['font_weight'], $w, false).'>'.$w.'</option>';
                             }
                         ?>
                       </select>
                    </label>
                    <?php endif;?>

                    <?php if(isset($value['subsets'])):?>
                    <label><?php esc_html_e('Subsets', 'lovage');?>
                       <select name="lovage_typo_subsets_<?php echo $this->instance_number;?>">
                         <?php 
                             foreach($subsets as $set){
                                echo '<option value="'.$set.'" '.selected($value['subsets'], $set, false).'>'.$set.'</option>';
                             }
                             $all_sets = implode('&', $subsets);
                             echo '<option value="'.$all_sets.'" '.selected($value['subsets'], $all_sets, false).'>'.esc_html('Select All', 'lovage').'</option>';
                         ?>
                       </select>
                    </label>
                    <?php endif;?>

                    <?php if(isset($value['line_height'])):?>
                    <label><?php esc_html_e('Line Height', 'lovage');?>
                       <input type="text" name="lovage_typo_line_height_<?php echo $this->instance_number;?>" value="<?php echo $value['line_height'];?>" />
                    </label>
                    <?php endif;?>

                    <?php if(isset($value['letter_spacing'])):?>
                    <label><?php esc_html_e('Letter Spacing', 'lovage');?>
                       <input type="text" name="lovage_typo_letter_spacing_<?php echo $this->instance_number;?>" value="<?php echo $value['letter_spacing'];?>" />
                    </label>
                    <?php endif;?>

                    <?php if(isset($value['text_transform'])):?>
                    <label><?php esc_html_e('Text Transform', 'lovage');?>
                       <select name="lovage_typo_text_transform_<?php echo $this->instance_number;?>">
                         <?php 
                             $text_transform_options = array(
                                'none'       => esc_html__('None', 'lovage'), 
                                'capitalize' => esc_html__('Capitalize', 'lovage'), 
                                'uppercase'  => esc_html__('Uppercase', 'lovage'), 
                                'lowercase'  => esc_html__('Lowercase', 'lovage'), 
                                'inherit'    => esc_html__('Inherit', 'lovage'), 
                             );
                             foreach($text_transform_options as $option){
                                echo '<option value="'.$option.'" '.selected($value['text_transform'], $option, false).'>'.$option.'</option>';
                             }
                         ?>
                       </select>
                    </label>
                    <?php endif;?>

                    <input type="hidden" <?php $this->link(); ?> name="lovage_typo_value_<?php echo $this->instance_number;?>" value="<?php echo $this->value();?>" />

                </div>
            <?php
        }
    }

    /**
     * Get the google fonts from the API or in the cache
     *
     * @param  integer $amount
     * @return String
     */
    public function get_fonts( $amount = 30 )
    {

        global $wp_filesystem;

        if (empty($wp_filesystem)) {
          require_once ABSPATH.'/wp-admin/includes/file.php';
          WP_Filesystem();
        }

        $cacheDir = LOVEAGE_CORE_DIR.'modules/lovage-customizer/cache';
        
        $fontFile = $cacheDir . '/google-fonts.json';
        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;

        if(file_exists($fontFile) && $cachetime < filemtime($fontFile)){
            $content = json_decode($wp_filesystem->get_contents($fontFile));
        }else {
            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCZgQBjMfC97sCbp_9JQ9WVYp4v1qK51qo';
            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );
            $fp = $wp_filesystem->get_contents($fontFile);
            $wp_filesystem->put_contents($fp, $fontContent['body'], FS_CHMOD_FILE);
            $content = json_decode($fontContent['body']);
        }

        if($amount == 'all'){
            return $content->items;
        } else {
            return array_slice($content->items, 0, $amount);
        }
    }
 }