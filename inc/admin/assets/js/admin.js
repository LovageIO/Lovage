/**
 * Scripts for WP Admin
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0.5
 */

var jQuery;

jQuery(document).ready(function($){

    /**
     * Hide the empty menu item 
     */
    $('#menu-appearance ul li').each(function(){
        var menuText = $(this).children('a').text();
        if(menuText === ''){
            $(this).hide();
        }
    });

    /**
     * Change Page Template action
     */
    $(window).load(function(){

        function templatesChangeAction(){
             var pageTemplate = $('.editor-page-attributes__template').find('#inspector-select-control-0').val();
             if( pageTemplate === 'elementor_canvas' || pageTemplate === 'elementor_header_footer' || pageTemplate === 'page-templates/fullwidth-page-template.php' ){
                $('body').addClass('not-default-template');
                $('#lovage-metabox-tab-content-general').append('<div id="lovage-no-general-option">No options for this page template.</div>');
             }else{
                $('body').removeClass('not-default-template');
                $('#lovage-no-general-option').remove();
             }
        }

        templatesChangeAction();
        $('.editor-page-attributes__template').find('#inspector-select-control-0').on('change', function(){
            templatesChangeAction();
        });
    });


	$(window).load(function(){
	//	$('.lovage-metabox-tab-content').append('<div class="lovage-admin-ads" style="border:1px solid #eee; padding: 0 20px 25px;"><h1>Get Early To Know Lovage Pro!</h1><p>If the free version of Lovage theme can\'t meet your needs, please subscribe to us & get early to know Lovage Pro. </p><a href="https://lovage.io/pro?utm_source=wp-admin" target="_blank" class="button button-primary">Learn More</a></div>');
	});

});