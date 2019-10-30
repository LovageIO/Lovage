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

  LovageTheme.transition = function(){
     
     $('#body-container').on('click', '[data-type="page-transition"]', function(event){
       event.preventDefault();
       //detect which page has been selected
       var newPage = $(this).attr('href');
       //if the page is not animating - trigger animation
       changePage(newPage, true);
    });

    function changePage(url, bool) {
       // trigger page animation
       $('body').addClass('page-is-changing');
       $('#page').empty();
       loadNewContent(url, bool);
    }

    function loadNewContent(url, bool) {
       var section = $('<div id="page" class="hfeed site lovage-grid-1140"></div>');
       section.load(url+' #page > *', function(event){
          // load new content and replace <main> content with the new one
          $('#page').html(section);
          //...
          $('body').removeClass('page-is-changing');
          //...

          if(url != window.location){
             //add the new page to the window.history
             window.history.pushState({path: url},'',url);
          }
           $('a').attr('data-type', 'page-transition');
       });
    }

    $(window).on('popstate', function() {
       var newPageArray = location.pathname.split('/'),
       //this is the url of the page to be loaded 
       newPage = newPageArray[newPageArray.length - 1];
       if( !isAnimating ) changePage(newPage);
    });
  }

  LovageTheme.header = function(){

    /**
     * Sticky Header.
     */
    if(typeof lovage_data.sticky_header !== undefined && lovage_data.sticky_header){

        window.onscroll = function(){
          if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            document.getElementById('masthead').classList.add('sticky-header');
            if($(window).width() <= 782){
               $('.admin-bar .sticky-header').css('margin-top', '0');
            }
          }else{
            document.getElementById('masthead').classList.remove('sticky-header');
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
  
  LovageTheme.mobileMenu = function(){
      $('#mobile_menu .menu-item-has-children').addClass('pushy-submenu');
  
      $('.pushy .menu-item-has-children > a').each(function(){
        $(this).after('<span href="javascript:void(0);" class="open-submenu"><i class="lovage-icon lovage-icon-plus"></i></span>');
      });
      
      $('.menu-toggle').on('click',function(){
        $('#close-menu').css('display','block');
      });

      $('#close-menu').on('click',function(){
          $(this).fadeOut();
      });
      
      $('.pushy ul li.pushy-submenu').toggle(function(){
         $(this).children('.open-submenu').find('i').removeClass('lovage-icon-plus').addClass('lovage-icon-minus');
      },function(){
         $(this).children('.open-submenu').find('i').removeClass('lovage-icon-minus').addClass('lovage-icon-plus');
      });

      var pushy = $('.pushy'), //menu css class
        body = $('body'),
        container = $('#container'), //container css class
        push = $('.push'), //css class to add pushy capability
        pushyLeft = 'pushy-left', //css class for left menu position
        pushyOpenLeft = 'pushy-open-left', //css class when menu is open (left position)
        pushyOpenRight = 'pushy-open-right', //css class when menu is open (right position)
        siteOverlay = $('.site-overlay'), //site overlay
        menuBtn = $('.mini-menu, .pushy-link, #close-menu'), //css classes to toggle the menu
        menuBtnFocus = $('.mini-menu'), //css class to focus when menu is closed w/ esc key
        menuLinkFocus = $(pushy.data('focus')), //focus on link when menu is open
        menuSpeed = 200, //jQuery fallback menu speed
        menuWidth = pushy.width() + 'px', //jQuery fallback menu width
        submenuClass = '.pushy-submenu',
        submenuOpenClass = 'pushy-submenu-open',
        submenuClosedClass = 'pushy-submenu-closed',
        submenu = $(submenuClass);

      //close menu w/ esc key
      $(document).keyup(function(e) {
        //check if esc key is pressed
        if (e.keyCode == 27) {

          //check if menu is open
          if( body.hasClass(pushyOpenLeft) || body.hasClass(pushyOpenRight) ){
            if(cssTransforms3d){
              closePushy(); //close pushy
            }else{
              closePushyFallback();
              opened = false; //set menu state
            }
            
            //focus on menu button after menu is closed
            if(menuBtnFocus){
              menuBtnFocus.focus();
            }
            
          }

        }   
      });

      function togglePushy(){
        //add class to body based on menu position
        if( pushy.hasClass(pushyLeft) ){
          body.toggleClass(pushyOpenLeft);
        }else{
          body.toggleClass(pushyOpenRight);
        }

        //focus on link in menu after css transition ends
        if(menuLinkFocus){
          pushy.one('transitionend', function() {
            menuLinkFocus.focus();
          });
        }
        
      }

      function closePushy(){
        if( pushy.hasClass(pushyLeft) ){
          body.removeClass(pushyOpenLeft);
        }else{
          body.removeClass(pushyOpenRight);
        }
      }

      function openPushyFallback(){
        //animate menu position based on CSS class
        if( pushy.hasClass(pushyLeft) ){
          body.addClass(pushyOpenLeft);
          pushy.animate({left: "0px"}, menuSpeed);
          container.animate({left: menuWidth}, menuSpeed);
          //css class to add pushy capability
          push.animate({left: menuWidth}, menuSpeed);
        }else{
          body.addClass(pushyOpenRight);
          pushy.animate({right: '0px'}, menuSpeed);
          container.animate({right: menuWidth}, menuSpeed);
          push.animate({right: menuWidth}, menuSpeed);
        }

        //focus on link in menu
        if(menuLinkFocus){
          menuLinkFocus.focus();
        }
      }

      function closePushyFallback(){
        //animate menu position based on CSS class
        if( pushy.hasClass(pushyLeft) ){
          body.removeClass(pushyOpenLeft);
          pushy.animate({left: "-" + menuWidth}, menuSpeed);
          container.animate({left: "0px"}, menuSpeed);
          //css class to add pushy capability
          push.animate({left: "0px"}, menuSpeed);
        }else{
          body.removeClass(pushyOpenRight);
          pushy.animate({right: "-" + menuWidth}, menuSpeed);
          container.animate({right: "0px"}, menuSpeed);
          push.animate({right: "0px"}, menuSpeed);
        }
      }

      function toggleSubmenu(){
        //hide submenu by default
        $(submenuClass).addClass(submenuClosedClass);

        $(submenuClass).on('click', function(e){
              var selected = $(this);

              if( selected.hasClass(submenuClosedClass) ) {
                  //hide same-level opened submenus
                  selected.siblings(submenuClass).addClass(submenuClosedClass).removeClass(submenuOpenClass);
                        //show submenu
                  selected.removeClass(submenuClosedClass).addClass(submenuOpenClass);
              }else{
                  //hide submenu
                  selected.addClass(submenuClosedClass).removeClass(submenuOpenClass);
          }
          // prevent event to be triggered on parent
          e.stopPropagation();
          });
      }

      //checks if 3d transforms are supported removing the modernizr dependency
      var cssTransforms3d = (function csstransforms3d(){
        var el = document.createElement('p'),
        supported = false,
        transforms = {
            'webkitTransform':'-webkit-transform',
            'OTransform':'-o-transform',
            'msTransform':'-ms-transform',
            'MozTransform':'-moz-transform',
            'transform':'transform'
        };

        if(document.body !== null) {
          // Add it to the body to get the computed style
          document.body.insertBefore(el, null);

          for(var t in transforms){
              if( el.style[t] !== undefined ){
                  el.style[t] = 'translate3d(1px,1px,1px)';
                  supported = window.getComputedStyle(el).getPropertyValue(transforms[t]);
              }
          }

          document.body.removeChild(el);

          return (supported !== undefined && supported.length > 0 && supported !== "none");
        }else{
          return false;
        }
      })();

      if(cssTransforms3d){
        //toggle submenu
        toggleSubmenu();

        //toggle menu
        menuBtn.on('click', function(){
          togglePushy();
        });
        //close menu when clicking site overlay
        siteOverlay.on('click', function(){
          togglePushy();
        });
      }else{
        //add css class to body
        body.addClass('no-csstransforms3d');

        //hide menu by default
        if( pushy.hasClass(pushyLeft) ){
          pushy.css({left: "-" + menuWidth});
        }else{
          pushy.css({right: "-" + menuWidth});
        }

        //fixes IE scrollbar issue
        container.css({"overflow-x": "hidden"});

        //keep track of menu state (open/close)
        var opened = false;

        //toggle submenu
        toggleSubmenu();

        //toggle menu
        menuBtn.on('click', function(){
          if (opened) {
            closePushyFallback();
            opened = false;
          } else {
            openPushyFallback();
            opened = true;
          }
        });

        //close menu when clicking site overlay
        siteOverlay.on('click', function(){
          if (opened) {
            closePushyFallback();
            opened = false;
          } else {
            openPushyFallback();
            opened = true;
          }
        });
      }
  }

  LovageTheme.popup = function(){
      
      function open(obj){
         $('#lovage-popup').animate({right: 0}, {
              duration: 200, 
              easing: 'easeInQuad', 
         });
         $('.lovage-popup-overlay').add(obj).fadeIn();
      }

      function close(obj){
         $('#lovage-popup').animate({right: '-150%'},{
              duration: 200, 
              easing: "easeOutQuad", 
         }); 
         $('.lovage-popup-overlay').add(obj).hide();
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
      }).focus(function(){
         close('#lovage-search');
      });

      $('#lovage-cart-button').focus(function(){ 
          open('#lovage-cart');
      }).blur(function(){ 
          close('#lovage-cart');
      });
      
      /* Click event */
      lovage_popup('#lovage-search-button','#lovage-search','open');
      lovage_popup('#lovage-cart-button','#lovage-cart','open');
      lovage_popup('#lovage-popup-close','.popup_content','close');
      lovage_popup('.lovage-popup-overlay','.popup_content','close');
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
      LovageTheme.transition();
      LovageTheme.header();
      LovageTheme.accessibleDropMenu();
      LovageTheme.mobileMenu();
      LovageTheme.popup();
      LovageTheme.accordion();
   }

   LovageTheme.init();

})(jQuery);

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
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
} )();