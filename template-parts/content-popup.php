<?php
/**
 * Popup
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */
?>

<div class="lovage-popup" id="lovage-<?php echo esc_attr( $popup_id ); ?>">
  <a class="lovage-popup-close" href="javascript:void(0);"></a>
  
  <?php if( $popup_id === 'search' ) : ?>
  <!--Search-->
  <div class="popup_content">
    <h3><?php echo esc_html__( 'Search', 'lovage' ); ?></h3>
  	<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) );?>" >
      <div class="lovage-search">
        <input type="text" id="s" placeholder="<?php esc_attr_e( 'Enter Keywords.', 'lovage' );?>" value="<?php get_search_query();?>" name="s" />
        <input type="submit" id="search-submit" value="" />
      </div>
    </form>
  </div>
  <?php endif; ?>
  
  <?php if ( class_exists( 'woocommerce') ):?>
    <?php if( $popup_id === 'cart' ) : ?>
    <!--Cart-->
    <div class="popup_content">
        <h3><?php echo esc_html__( 'Cart', 'lovage' ); ?></h3>
  	    <div class="widget_shopping_cart_content"></div>
    </div>
    <?php endif; ?>
  <?php endif;?>

  <?php if( $popup_id === 'menu' ) : ?>
  <!--Menu-->
  <div class="popup_content">
    <?php lovage_popup_menu(); ?>
  </div>
  <?php endif; ?>

</div>