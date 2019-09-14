/**
 * Scripts for WP Admin
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
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
	 * Ajax install WordPress plugin  
	 */
	$('#lovage-install-demo-import-plugin:not(.button-disabled)').on('click', function(e){
		e.preventDefault();
        
        var url = $(this).attr('href');
        $(this).addClass('button-disabled');
        $('#lovage-demo-install-loader').show();

		$.ajax({
            type: 'POST',
            url: url,
            success: function(data) {
            	if(data){
            		window.location.href = lovage_admin_data.admin_url + 'themes.php?page=lovage-demos';
                    $(this).removeClass('button-disabled');
                    $('#lovage-demo-install-loader').hide();
            	}
            },
            error: function(xhr, status, error) {
               console.log(status);
            }
        });
	});


	$(window).load(function(){
	//	$('.lovage-metabox-tab-content').append('<div class="lovage-admin-ads" style="border:1px solid #eee; padding: 0 20px 25px;"><h1>Get Early To Know Lovage Pro!</h1><p>If the free version of Lovage theme can\'t meet your needs, please subscribe to us & get early to know Lovage Pro. </p><a href="https://lovage.io/pro?utm_source=wp-admin" target="_blank" class="button button-primary">Learn More</a></div>');
	});

});