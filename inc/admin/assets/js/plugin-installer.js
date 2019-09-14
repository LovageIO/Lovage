/**
 * Plugin Installer 
 *
 * @package  Lovage
 * @author   Darren Cooney
 * @link     https://github.com/dcooney/wordpress-plugin-installer
 * @link     https://connekthq.com
 * @version  1.0
 */

var lovage_installer = lovage_installer || {};

jQuery(document).ready(function($) {

   "use strict";

   var is_loading = false;



   /*
   *  install_plugin
   *  Install the plugin
   *
   *
   *  @param el       object Button element
   *  @param plugin   string Plugin slug
   *  @since 1.0
   */

   lovage_installer.install_plugin = function(el, plugin){

      // Confirm activation
      var r = confirm(lovage_installer_localize.install_now);

      if (r) {

         is_loading = true;
         el.addClass('installing');

         $.ajax({
            type: 'POST',
            url: lovage_installer_localize.ajax_url,
            data: {
               action: 'lovage_plugin_installer',
               plugin: plugin,
               nonce: lovage_installer_localize.install_nonce,
               dataType: 'json'
            },
            success: function(data) {
               if(data){
                  if(data.status === 'success'){
                     el.attr('class', 'activate button button-primary');
                     el.html(lovage_installer_localize.activate_btn);
                  } else {
                     el.removeClass('installing');
                  }
               } else {
                  el.removeClass('installing');
               }
               is_loading = false;
            },
            error: function(xhr, status, error) {
               console.log(status);
               el.removeClass('installing');
               is_loading = false;
            }
         });

      }
   }



   /*
   *  activate_plugin
   *  Activate the plugin
   *
   *
   *  @param el       object Button element
   *  @param plugin   string Plugin slug
   *  @since 1.0
   */

   lovage_installer.activate_plugin = function(el, plugin){
      
      is_loading = true;
      el.addClass('installing');
      
      $.ajax({
         type: 'POST',
         url: el.attr('href'),
         success: function(data) {
            console.log(data);
            if(data){
                  el.attr('class', 'installed button disabled');
                  el.html(lovage_installer_localize.installed_btn);
                  el.removeClass('installing');
            }
            is_loading = false;
         },
         error: function(xhr, status, error) {
            console.log(error);
            is_loading = false;
         }
      });

   };



   /*
   *  Install/Activate Button Click
   *
   *  @since 1.0
   */

   $(document).on('click', '.lovage-plugin-installer a.installer-button', function(e){

      var el = $(this),
          plugin = el.data('slug');

      e.preventDefault();

      if(!el.hasClass('disabled')){

         if(is_loading) return false;

         // Installation
         if(el.hasClass('install')){
            lovage_installer.install_plugin(el, plugin);
         }

         // Activation
         if(el.hasClass('activate')){
            lovage_installer.activate_plugin(el, plugin);
         }
      }
   });


});