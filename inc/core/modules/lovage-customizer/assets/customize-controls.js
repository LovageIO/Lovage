function LovageUrlExists(url){
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

jQuery( document ).ready( function($) {

    /*  1. Sortable Multi-CheckBoxes  */

    /* Make it sortable. */
    $( 'ul.lovage-multicheck-sortable-list' ).sortable({
        handle: '.lovage-multicheck-sortable-handle',
        axis: 'y',
        update: function( e, ui ){
            $('input.lovage-multicheck-sortable-item').trigger( 'change' );
        }
    });

    /* On changing the value. */
    $( "input.lovage-multicheck-sortable-item" ).on( 'change', function() {

        /* Get the value, and convert to string. */
        this_checkboxes_values = $( this ).parents( 'ul.lovage-multicheck-sortable-list' ).find( 'input.lovage-multicheck-sortable-item' ).map( function() {
            var active = '0';
            if( $(this).prop("checked") ){
                var active = '1';
            }
            return this.name + ':' + active;
        }).get().join( ',' );

        /* Add the value to hidden input. */
        $( this ).parents( 'ul.lovage-multicheck-sortable-list' ).find( 'input.lovage-multicheck-sortable' ).val( this_checkboxes_values ).trigger( 'change' );

    });

    /*  2. Multi-CheckBoxes  */

    /* On changing the value. */
    $( "input.lovage-multicheck-item" ).on( 'change', function() {

        /* Get the value (only the "checked" item), and convert to comma separated string. */
        this_checkboxes_values = $( this ).parents( 'ul.lovage-multicheck-list' ).find( 'input.lovage-multicheck-item:checked' ).map( function() {
            return this.name;
        }).get().join( ',' );

        /* Add the value to hidden input. */
        $( this ).parents( 'ul.lovage-multicheck-list' ).find( 'input.lovage-multicheck' ).val( this_checkboxes_values ).trigger( 'change' );

    });

    /*  3. Typography  */

    $('.customize-typography-control-container').each(function(){
        
        var instance_id = $(this).attr('data-instance-id');

        $(this).find('select[name="lovage_typo_family_'+instance_id+'"]').on('change', function(){
          
            var selectedFamily = $(this).val();
            var newWeight = '';
            var newSubsets = '';
            var localFile = lovage_customizer_data.localFontFile;
            var finalUrl = '';
            if(LovageUrlExists(localFile) == '404'){
               finalUrl = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCZgQBjMfC97sCbp_9JQ9WVYp4v1qK51qo';
            }else{
               finalUrl = localFile;
            }
            $.ajax({
              url: finalUrl,
            }).done(function(data) {
              var allFonts = data.items;
              
              $.grep(allFonts, function(e){  
                if(e.family == selectedFamily){

                     for(var i = 0; i < e.variants.length; i++){
                        newWeight += '<option value="'+e.variants[i]+'">'+e.variants[i]+'</option>';
                     }

                     for(var i = 0; i < e.subsets.length; i++){
                        newSubsets += '<option value="'+e.subsets[i]+'">'+e.subsets[i]+'</option>';
                     }
                     var allSets = e.subsets.join('&');
                     newSubsets += '<option value="'+allSets+'">Select All</option>'       
                } 
              });
              $('select[name="lovage_typo_weight_'+instance_id+'"]').html(newWeight);
              $('select[name="lovage_typo_subsets_'+instance_id+'"]').html(newSubsets);
            });
        });

        $(this).find('select').add('input[type="text"]').on('change', function(){
          var value = {
            font_family: $('select[name="lovage_typo_family_'+instance_id).val(),
            font_size: $('input[name="lovage_typo_size_'+instance_id+'"]').val(),
            font_weight: $('select[name="lovage_typo_weight_'+instance_id+'"]').val(),
            subsets: $('select[name="lovage_typo_subsets_'+instance_id+'"]').val(),
            line_height: $('input[name="lovage_typo_line_height_'+instance_id+'"]').val(),
            letter_spacing: $('input[name="lovage_typo_letter_spacing_'+instance_id+'"]').val(),
            text_transform: $('select[name="lovage_typo_text_transform_'+instance_id+'"]').val()
          }; 
          $('input[name="lovage_typo_value_'+instance_id+'"]').val(JSON.stringify(value)).trigger( 'change' );
        });
    });


    /**
     * 3. Range Slider Control
     *
     * @author Anthony Hortin <http://maddisondesigns.com>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     * @link https://github.com/maddisondesigns
     */

    // Set our slider defaults and initialise the slider
    $('.slider-custom-control').each(function(){
      var sliderValue = $(this).find('.customize-control-slider-value').val();
      var newSlider = $(this).find('.slider');
      var sliderMinValue = parseFloat(newSlider.attr('slider-min-value'));
      var sliderMaxValue = parseFloat(newSlider.attr('slider-max-value'));
      var sliderStepValue = parseFloat(newSlider.attr('slider-step-value'));

      newSlider.slider({
        value: sliderValue,
        min: sliderMinValue,
        max: sliderMaxValue,
        step: sliderStepValue,
        change: function(e,ui){
          // Important! When slider stops moving make sure to trigger change event so Customizer knows it has to save the field
          $(this).parent().find('.customize-control-slider-value').trigger('change');
          }
      });
    });

    // Change the value of the input field as the slider is moved
    $('.slider').on('slide', function(event, ui) {
      $(this).parent().find('.customize-control-slider-value').val(ui.value);
    });

    // Reset slider and input field back to the default value
    $('.slider-reset').on('click', function() {
      var resetValue = $(this).attr('slider-reset-value');
      $(this).parent().find('.customize-control-slider-value').val(resetValue);
      $(this).parent().find('.slider').slider('value', resetValue);
    });

    // Update slider if the input field loses focus as it's most likely changed
    $('.customize-control-slider-value').blur(function() {
      var resetValue = $(this).val();
      var slider = $(this).parent().find('.slider');
      var sliderMinValue = parseInt(slider.attr('slider-min-value'));
      var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

      // Make sure our manual input value doesn't exceed the minimum & maxmium values
      if(resetValue < sliderMinValue) {
        resetValue = sliderMinValue;
        $(this).val(resetValue);
      }
      if(resetValue > sliderMaxValue) {
        resetValue = sliderMaxValue;
        $(this).val(resetValue);
      }
      $(this).parent().find('.slider').slider('value', resetValue);
    });

    /**
     * 4. Alpha Color Picker Custom Control
     *
     * @author Braad Martin <http://braadmartin.com>
     * @license http://www.gnu.org/licenses/gpl-3.0.html
     * @link https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker
     */

    // Loop over each control and transform it into our color picker.
    $( '.alpha-color-control' ).each( function() {

      // Scope the vars.
      var $control, startingColor, paletteInput, showOpacity, defaultColor, palette,
        colorPickerOptions, $container, $alphaSlider, alphaVal, sliderOptions;

      // Store the control instance.
      $control = $( this );

      // Get a clean starting value for the option.
      startingColor = $control.val().replace( /\s+/g, '' );

      // Get some data off the control.
      paletteInput = $control.attr( 'data-palette' );
      showOpacity  = $control.attr( 'data-show-opacity' );
      defaultColor = $control.attr( 'data-default-color' );

      // Process the palette.
      if ( paletteInput.indexOf( '|' ) !== -1 ) {
        palette = paletteInput.split( '|' );
      } else if ( 'false' == paletteInput ) {
        palette = false;
      } else {
        palette = true;
      }

      // Set up the options that we'll pass to wpColorPicker().
      colorPickerOptions = {
        change: function( event, ui ) {
          var key, value, alpha, $transparency;

          key = $control.attr( 'data-customize-setting-link' );
          value = $control.wpColorPicker( 'color' );

          // Set the opacity value on the slider handle when the default color button is clicked.
          if ( defaultColor == value ) {
            alpha = acp_get_alpha_value_from_color( value );
            $alphaSlider.find( '.ui-slider-handle' ).text( alpha );
          }

          // Send ajax request to wp.customize to trigger the Save action.
          wp.customize( key, function( obj ) {
            obj.set( value );
          });

          $transparency = $container.find( '.transparency' );

          // Always show the background color of the opacity slider at 100% opacity.
          $transparency.css( 'background-color', ui.color.toString( 'no-alpha' ) );
        },
        palettes: palette // Use the passed in palette.
      };

      // Create the colorpicker.
      $control.wpColorPicker( colorPickerOptions );

      $container = $control.parents( '.wp-picker-container:first' );

      // Insert our opacity slider.
      $( '<div class="alpha-color-picker-container">' +
          '<div class="min-click-zone click-zone"></div>' +
          '<div class="max-click-zone click-zone"></div>' +
          '<div class="alpha-slider"></div>' +
          '<div class="transparency"></div>' +
        '</div>' ).appendTo( $container.find( '.wp-picker-holder' ) );

      $alphaSlider = $container.find( '.alpha-slider' );

      // If starting value is in format RGBa, grab the alpha channel.
      alphaVal = acp_get_alpha_value_from_color( startingColor );

      // Set up jQuery UI slider() options.
      sliderOptions = {
        create: function( event, ui ) {
          var value = $( this ).slider( 'value' );

          // Set up initial values.
          $( this ).find( '.ui-slider-handle' ).text( value );
          $( this ).siblings( '.transparency ').css( 'background-color', startingColor );
        },
        value: alphaVal,
        range: 'max',
        step: 1,
        min: 0,
        max: 100,
        animate: 300
      };

      // Initialize jQuery UI slider with our options.
      $alphaSlider.slider( sliderOptions );

      // Maybe show the opacity on the handle.
      if ( 'true' == showOpacity ) {
        $alphaSlider.find( '.ui-slider-handle' ).addClass( 'show-opacity' );
      }

      // Bind event handlers for the click zones.
      $container.find( '.min-click-zone' ).on( 'click', function() {
        acp_update_alpha_value_on_color_control( 0, $control, $alphaSlider, true );
      });
      $container.find( '.max-click-zone' ).on( 'click', function() {
        acp_update_alpha_value_on_color_control( 100, $control, $alphaSlider, true );
      });

      // Bind event handler for clicking on a palette color.
      $container.find( '.iris-palette' ).on( 'click', function() {
        var color, alpha;

        color = $( this ).css( 'background-color' );
        alpha = acp_get_alpha_value_from_color( color );

        acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );

        // Sometimes Iris doesn't set a perfect background-color on the palette,
        // for example rgba(20, 80, 100, 0.3) becomes rgba(20, 80, 100, 0.298039).
        // To compensante for this we round the opacity value on RGBa colors here
        // and save it a second time to the color picker object.
        if ( alpha != 100 ) {
          color = color.replace( /[^,]+(?=\))/, ( alpha / 100 ).toFixed( 2 ) );
        }

        $control.wpColorPicker( 'color', color );
      });

      // Bind event handler for clicking on the 'Clear' button.
      $container.find( '.button.wp-picker-clear' ).on( 'click', function() {
        var key = $control.attr( 'data-customize-setting-link' );

        // The #fff color is delibrate here. This sets the color picker to white instead of the
        // defult black, which puts the color picker in a better place to visually represent empty.
        $control.wpColorPicker( 'color', '#ffffff' );

        // Set the actual option value to empty string.
        wp.customize( key, function( obj ) {
          obj.set( '' );
        });

        acp_update_alpha_value_on_alpha_slider( 100, $alphaSlider );
      });

      // Bind event handler for clicking on the 'Default' button.
      $container.find( '.button.wp-picker-default' ).on( 'click', function() {
        var alpha = acp_get_alpha_value_from_color( defaultColor );

        acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
      });

      // Bind event handler for typing or pasting into the input.
      $control.on( 'input', function() {
        var value = $( this ).val();
        var alpha = acp_get_alpha_value_from_color( value );

        acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
      });

      // Update all the things when the slider is interacted with.
      $alphaSlider.slider().on( 'slide', function( event, ui ) {
        var alpha = parseFloat( ui.value ) / 100.0;

        acp_update_alpha_value_on_color_control( alpha, $control, $alphaSlider, false );

        // Change value shown on slider handle.
        $( this ).find( '.ui-slider-handle' ).text( ui.value );
      });

    });

    /**
     * Override the stock color.js toString() method to add support for outputting RGBa or Hex.
     */
    Color.prototype.toString = function( flag ) {

      // If our no-alpha flag has been passed in, output RGBa value with 100% opacity.
      // This is used to set the background color on the opacity slider during color changes.
      if ( 'no-alpha' == flag ) {
        return this.toCSS( 'rgba', '1' ).replace( /\s+/g, '' );
      }

      // If we have a proper opacity value, output RGBa.
      if ( 1 > this._alpha ) {
        return this.toCSS( 'rgba', this._alpha ).replace( /\s+/g, '' );
      }

      // Proceed with stock color.js hex output.
      var hex = parseInt( this._color, 10 ).toString( 16 );
      if ( this.error ) { return ''; }
      if ( hex.length < 6 ) {
        for ( var i = 6 - hex.length - 1; i >= 0; i-- ) {
          hex = '0' + hex;
        }
      }

      return '#' + hex;
    };

    /**
     * Given an RGBa, RGB, or hex color value, return the alpha channel value.
     */
    function acp_get_alpha_value_from_color( value ) {
      var alphaVal;

      // Remove all spaces from the passed in value to help our RGBa regex.
      value = value.replace( / /g, '' );

      if ( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ ) ) {
        alphaVal = parseFloat( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ )[1] ).toFixed(2) * 100;
        alphaVal = parseInt( alphaVal );
      } else {
        alphaVal = 100;
      }

      return alphaVal;
    }

    /**
     * Force update the alpha value of the color picker object and maybe the alpha slider.
     */
     function acp_update_alpha_value_on_color_control( alpha, $control, $alphaSlider, update_slider ) {
      var iris, colorPicker, color;

      iris = $control.data( 'a8cIris' );
      colorPicker = $control.data( 'wpWpColorPicker' );

      // Set the alpha value on the Iris object.
      iris._color._alpha = alpha;

      // Store the new color value.
      color = iris._color.toString();

      // Set the value of the input.
      $control.val( color );

      // Update the background color of the color picker.
      colorPicker.toggler.css({
        'background-color': color
      });

      // Maybe update the alpha slider itself.
      if ( update_slider ) {
        acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
      }

      // Update the color value of the color picker object.
      $control.wpColorPicker( 'color', color );
    }

    /**
     * Update the slider handle position and label.
     */
    function acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider ) {
      $alphaSlider.slider( 'value', alpha );
      $alphaSlider.find( '.ui-slider-handle' ).text( alpha.toString() );
    }

    /**
     * 5. Image Check Box Custom Control
     *
     * @author Anthony Hortin <http://maddisondesigns.com>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     * @link https://github.com/maddisondesigns
     */

    $('.multi-image-checkbox').on('change', function () {
      getAllCheckboxes($(this).parent().parent());
    });

    // Get the values from the checkboxes and add to our hidden field
    function getAllCheckboxes($element) {
      var inputValues = $element.find('.multi-image-checkbox').map(function() {
        if( $(this).is(':checked') ) {
          return $(this).val();
        }
      }).toArray();
      // Important! Make sure to trigger change event so Customizer knows it has to save the field
      $element.find('.customize-control-multi-image-checkbox').val(inputValues).trigger('change');
    }


} );