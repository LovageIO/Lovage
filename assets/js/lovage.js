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

     $("select").focus(function(){
        $("select").attr("size", 10);
     });

     /* Menu Button */
     $('.site-header #lovage-menu-button').on('click', function(){
        if ( ! $('.site-header').hasClass('lovage-standard-rtl') ) {
          $( '.main-navigation' ).css( 'right', 0 );
        } else {
          $( '.main-navigation' ).css( 'left', 0 );
        }
     });

     $('.site-header #close-menu').on('click', function(){
        if ( ! $('.site-header').hasClass('lovage-standard-rtl') ) {
          $( '.main-navigation' ).css( 'right', '-999em' );
        } else {
          $( '.main-navigation' ).css( 'left', '-999em' );
        }
     });
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
      var masthead, siteNavContain, siteNavigation;

      masthead       = $( '#masthead' );
      siteNavContain = masthead.find( '.main-navigation' );
      siteNavigation = masthead.find( '.main-navigation > div > ul' );

      // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
      (function() {
        if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
          return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
          if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

            $( document.body ).on( 'touchstart.lovage', function( e ) {
              if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                $( '.main-navigation li' ).removeClass( 'focus' );
              }
            });

            siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
              .on( 'touchstart.lovage', function( e ) {
                var el = $( this ).parent( 'li' );

                if ( ! el.hasClass( 'focused' ) ) {
                  e.preventDefault();
                  el.toggleClass( 'focus' );
                  el.siblings( '.focus' ).removeClass( 'focus' );
                }
              });

          } else {
            siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.lovage' );
          }
        }

        if ( 'ontouchstart' in window ) {
          $( window ).on( 'resize.lovage', toggleFocusClassTouchScreen );
          toggleFocusClassTouchScreen();
        }

        siteNavigation.find( 'a' ).on( 'focus.lovage blur.lovage', function() {
          $( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
        });
      })();

      /* Responsive Keyboard Navigation */
      function responsiveMenu() {
        if( $(window).width() <= 960 ) {
           $('#site-navigation').appendTo('#lovage-primary-bar');
        }else{
           $('#site-icons').appendTo('#lovage-primary-bar');
        }
      }

      $(window).load( function() { responsiveMenu() });
      $(window).resize( function() { responsiveMenu() });
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
         $('#site-navigation').css({right: 0});
      });

      $('#site-navigation a').last().blur(function(){
          $('#site-navigation').css({right: '-999em'});
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