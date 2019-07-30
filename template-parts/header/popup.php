<?php
/**
 * Popup
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */
?>

<?php if ( class_exists( 'woocommerce') ):?>
<div id="lovage-popup">
  <a id="lovage-popup-close" href="javascript:void(0);"><i class="lovage-icon lovage-icon-close"></i></a>
  
  <!--Search-->
  <div id="lovage-search" class="popup_content">
    <h3><?php esc_attr_e('Search Products','lovage');?></h3>
  	<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url( '/' ));?>" >
      <div class="lovage-search">
      <input type="text" id="s" placeholder="<?php esc_attr_e('Enter Keywords.','lovage');?>" value="<?php get_search_query();?>" name="s" />
      <input type="submit" id="searchsubmit" value="" />
      </div>
    </form>
  </div>
  
  <!--Cart-->
  <div id="lovage-cart" class="popup_content">
    <h3><?php esc_attr_e('Cart','lovage');?></h3>
	 <div class="widget_shopping_cart_content"></div>
  </div>

  <!--Menu-->
  <div id="lovage-menu" class="popup_content">
    <?php lovage_popup_menu();?>
  </div>

</div>
<div class="lovage-popup-overlay"></div>
<?php endif;?>