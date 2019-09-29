var jQuery;

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
        $('.lovage-metabox-date-picker').datepicker();
    }

    var imageUpload = function(){
        // Instantiates the variable that holds the media library frame.
        var meta_image_frame;
     
        // Runs when the image button is clicked.
        $('.lovage-metabox-image .image-upload').click(function(e){
            
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
                imageUploadButton.next().html('<div class="preview-image"><img src="'+media_attachment.url+'" /> <a href="javascript:;" class="delete">&#10005</a></div>');
            });
     
            // Opens the media library frame.
            meta_image_frame.open();
        });

        $('.lovage-metabox-image').each( function(){

             var dataStore = $(this).find('input[type="url"]');
            
             $(this).find('.delete').on('click', function(){
                $(this).parent('.preview-image').remove();
                dataStore.attr('value', '');
             });

        } );
    }

    var multiImageUpload = function(){
        // Instantiates the variable that holds the media library frame.
        var meta_image_frame;
     
        // Runs when the image button is clicked.
        $('.lovage-metabox-multi-image .multi-image-upload').click(function(e){
            
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

                var images = '';
                var savedImages = [];

                media_attachments.forEach(function(item, i){
                    
                    savedImages.push({
                       id: item.id,
                       url: item.url,
                       alt: item.alt
                    });

                    // Sends the attachment URL to our custom image input field.
                    imageUploadButton.prev().val(JSON.stringify(savedImages));
                    
                    images += '<div class="preview-image" id="image-'+item.id+'"><img src="'+item.url+'" /> <a href="javascript:;" class="delete">&#10005</a></div>';
                });

                imageUploadButton.next().html(images);
            });
     
            // Opens the media library frame.
            meta_image_frame.open();
        });

        $('.lovage-metabox-multi-image').each(function(){

            var dataStore = $(this).find('input[type="hidden"]');
            var saved_images_data = dataStore.val();
            var saved_images_array =  saved_images_data && JSON.parse(saved_images_data);

            $('.preview-image').each( function(){
                 var imageId = $(this).attr('id');
                 imageId = imageId.split('-');

                 $(this).children('.delete').on('click', function(){

                    $(this).parent('.preview-image').remove();
                    
                    for( var i = 0; i < saved_images_array.length; i++){ 
                        if(saved_images_array[i].id === parseInt(imageId[1])) {
                            saved_images_array.splice(i, 1);
                            i--;
                        }
                    }
                    
                    dataStore.val(JSON.stringify(saved_images_array));
                 });
            } );
        });
  
    }

    metaTabs();
    datePicker();
    imageUpload();
    multiImageUpload();
});