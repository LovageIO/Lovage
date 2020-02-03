/**
 * Scripts for the theme.
 * 
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */

(function($){
  "use strict";
  var LovageTheme = window.LovageTheme || {};
  window.LovageTheme = LovageTheme;

  LovageTheme.basic = function(){

     /*Apply the post format to the comment content elements*/
     $('.comment-content').addClass('entry-content');

     $('.alignleft').parent('.wp-block-image').addClass('alignleft');
     $('.alignright').parent('.wp-block-image').addClass('alignright');
     $('.wp-block-cover.aligncenter').before('<div class="clear"></div>');
     $('.sticky').append('<div class="featured-post"><i class="star"></i></div>');

     if($('.wcppec-cart-widget-button').length > 0){
       $('.woocommerce .woocommerce-mini-cart__buttons').css('flex-wrap', 'wrap');
     }
  }

  LovageTheme.skipLinkFix = function(){
    var isIe = /(trident|msie)/i.test( navigator.userAgent );

    if ( isIe && document.getElementById && window.addEventListener ) {
      window.addEventListener( 'hashchange', function() {
        var id = location.hash.substring( 1 ),
          element;

        if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
          return;
        }

        element = document.getElementById( id );

        if ( element ) {
          if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
            element.tabIndex = -1;
          }

          element.focus();
        }
      }, false );
    }
  }

  LovageTheme.header = function(){

    /**
     * Sticky Header.
     */
    if(typeof lovage_data.sticky_header !== undefined && lovage_data.sticky_header){

        window.onscroll = function(){
          if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            if(document.getElementById('masthead')) {
              document.getElementById('masthead').classList.add('sticky-header');
            }
            if($(window).width() <= 782){
               $('.admin-bar .sticky-header').css('margin-top', '0');
            }
          }else{
            if(document.getElementById('masthead')) {
              document.getElementById('masthead').classList.remove('sticky-header');
            }
            if($(window).width() <= 782){
               $('.admin-bar .site-header').css('margin-top', '46px');
            }
          }
        }

    }
  }

  LovageTheme.accessibleDropMenu = function(){
      $('.main-navigation ul ul li a').focus( function () {
        $(this).parent('li').addClass('focused');
        $(this).closest('ul.sub-menu').addClass('focused');
      }).blur(function(){
         $(this).parent('li').removeClass('focused');
        $(this).closest('ul.sub-menu').removeClass('focused');
      });
  }

  LovageTheme.popup = function(){
      
      function open(obj){
         $(obj).each(function(){
           $(this).animate({right: 0}, {
              duration: 200, 
              easing: 'easeInQuad', 
           });
         });
      }

      function close(obj){
         $(obj).each(function(){
           $(this).animate({right: '-150%'},{
                duration: 200, 
                easing: "easeOutQuad", 
           });
         });
      }

      function lovage_popup(button,obj,status){
        $(button).on('click', function(){
          if(status === 'open'){
             open(obj);
          }else{
             close(obj);
          }
        });
      }

      /* Keyboard accessible */
      $('#lovage-search-button').focus(function(){ 
         open('#lovage-search');
      });

      $('#search-submit').blur(function(){
         close('#lovage-search');
      });

      $('#lovage-cart-button').focus(function(){ 
          open('#lovage-cart');
      });

      $('#popup-cart a').last().blur(function(){
         close('#lovage-cart');
      });
      
      $('#lovage-menu-button').focus(function(){ 
         $(this).addClass('focus');
         open('#lovage-menu');
      });

      $('#popup-menu a').last().blur(function(){
         close('#lovage-menu');
      });

      /* Click event */
      lovage_popup('#lovage-search-button','#lovage-search','open');
      lovage_popup('#lovage-cart-button','#lovage-cart','open');
      lovage_popup('#lovage-menu-button','#lovage-menu','open');
      lovage_popup('.lovage-popup-close', '.lovage-popup','close');
  }

  LovageTheme.accordion = function(){
      /*Accordion*/
      function close_accordion_section() {
          $('.lovage-accordion .lovage-accordion-section-title').removeClass('active');
          $('.lovage-accordion .lovage-accordion-section-title span').html('+');
          $('.lovage-accordion .lovage-accordion-section-content').slideUp(300).removeClass('open');
      }

      $('.lovage-accordion-section-title').click(function(e) {
          // Grab current anchor value
          var currentAttrValue = $(this).attr('href');

          if($(e.target).is('.active')) {
              close_accordion_section();
          }else {
              close_accordion_section();

              // Add active class to section title
              $(this).addClass('active');
              // Open up the hidden content panel
              $('.lovage-accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
              $(this).children('.lovage-accordion-section-title span').html('&mdash;');
              $('html, body').animate({
                scrollTop: $('body .lovage-product-content').offset().top-100
            }, 500);
          }

          e.preventDefault();
      });
  }

   LovageTheme.init = function(){
      LovageTheme.basic();
      LovageTheme.skipLinkFix();
      LovageTheme.header();
      LovageTheme.accessibleDropMenu();
      LovageTheme.popup();
      LovageTheme.accordion();
   }

   LovageTheme.init();

})(jQuery);