
jQuery(document).ready(function($) {


    var metaTabs = function(){
        /* Metabox Tabs */
        $('.lovage-metabox-tabs-container ul li a').on('click', function(e) {
          var currentAttrValue = $(this).data('target');
          // Show/Hide Tabs
          $('.lovage-metabox-tab-content' + currentAttrValue).show().siblings('.lovage-metabox-tab-content').hide();
          // Change/remove current tab to active
          $(this).parent('li').addClass('active').siblings().removeClass('active');
          e.preventDefault();
        });
    }


    var datePicker = function(){

        /* Date Picker Option */
        $('.lovage-date-picker').datepicker();
    }

    var imageUpload = function(){
        // Instantiates the variable that holds the media library frame.
        var meta_image_frame;
     
        // Runs when the image button is clicked.
        $('.image-upload').click(function(e){
            
            var imageUploadButton = $(this);

            // Prevents the default action from occuring.
            e.preventDefault();
     
            // If the frame already exists, re-open it.
            if ( meta_image_frame ) {
                meta_image_frame.open();
                return;
            }
     
            // Sets up the media library frame
            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: image_upload.title,
                button: { text:  image_upload.button },
                library: { type: 'image' }
            });
     
            // Runs when an image is selected.
            meta_image_frame.on('select', function(){
     
                // Grabs the attachment selection and creates a JSON representation of the model.
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
     
                // Sends the attachment URL to our custom image input field.
                imageUploadButton.prev().val(media_attachment.url);
                imageUploadButton.next().html('<img src="'+media_attachment.url+'" />');
            });
     
            // Opens the media library frame.
            meta_image_frame.open();
        });
    }

    var multiImageUpload = function(){
        // Instantiates the variable that holds the media library frame.
        var meta_image_frame;
     
        // Runs when the image button is clicked.
        $('.multi-image-upload').click(function(e){
            
            var imageUploadButton = $(this);

            // Prevents the default action from occuring.
            e.preventDefault();
     
            // If the frame already exists, re-open it.
            if ( meta_image_frame ) {
                meta_image_frame.open();
                return;
            }
     
            // Sets up the media library frame
            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: image_upload.title,
                button: { text:  image_upload.button },
                library: { type: 'image' },
                multiple: true
            });
     
            // Runs when an image is selected.
            meta_image_frame.on('select', function(){
     
                // Grabs the attachment selection and creates a JSON representation of the model.
                var media_attachments = meta_image_frame.state().get('selection').toJSON();

                // Sends the attachment URL to our custom image input field.
                imageUploadButton.prev().val(JSON.stringify(media_attachments));
                var images = '';

                media_attachments.forEach(function(item, i){
                    images += '<img src="'+item.url+'" />';
                });

                imageUploadButton.next().html(images);
            });
     
            // Opens the media library frame.
            meta_image_frame.open();
        });
    }

    metaTabs();
    datePicker();
    imageUpload();
    multiImageUpload();
});