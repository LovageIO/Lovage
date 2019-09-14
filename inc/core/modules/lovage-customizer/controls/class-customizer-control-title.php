<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Custom section title control
 */
class Lovage_Customize_Title_Control extends WP_Customize_Control{
    public $type = 'title';

    public function render_content(){
    ?>
        <?php if ( !empty( $this->label ) ): ?>
        <h2 class="customize-control-title" style="border-top: 1px solid #ddd; padding-top: 30px;"><?php echo esc_html( $this->label ); ?></h2>
        <?php endif;?>

        <?php if ( !empty( $this->description ) ): ?>
          <span class="description customize-control-description" style="font-weight: normal; margin-bottom: 10px;"><?php echo esc_html( $this->description ); ?></span>
        <?php endif;?>
<?php
    }
 }