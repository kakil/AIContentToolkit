/*------------------------ 
Backend related javascript
------------------------*/

/**
 * HELPER COMMENT START
 * 
 * This file contains all of the backend related javascript. 
 * With backend, it is meant the WordPress admin area.
 * 
 * You can add the localized variables in here as followed: aicontentt.plugin_name
 * These variables are defined within the localization function in the following file:
 * core/includes/classes/class-aicontent-toolkit-run.php
 * 
 * HELPER COMMENT END
 */


jQuery(document).ready(function() {
    jQuery("#btn-submit").click(function () {

        //alert(jQuery('#chatGptText').val());

        //jQuery('#spinner-div').show();//Load button clicked show spinner
        let spinner = document.getElementById("spinner-submit");
         spinner.style.visibility = 'visible';
    });

    jQuery('#blog-submit').click(function () {
        let spinner = document.getElementById("spinner-blog-submit");
        spinner.style.visibility = 'visible';

        // let imageInfoText = document.getElementById('imageInfoText');
        // imageInfoText.style.visibility = 'visible';
    });

    jQuery('#postContent').change( function() {
      jQuery('#spinner-div').hide();
    });

    jQuery('#reset-submit-info').click(function () {
        console.log('Reset Info');
       jQuery('#blogPostForm').removeClass('was-validated');
     });

     jQuery('#reset-submit-blog').click(function () {
        console.log('Reset Blog');
       jQuery('#blogForm').removeClass('was-validated');

     });

     //Image Generator 
     //
     //Spinners
    // Toggle spinner visible
     jQuery('#addToLibrary').on('click', function() {
        console.log('Button Clicked');
        let spinner = document.getElementById("spinner");
        spinner.style.visibility = 'visible';
      });
  
      jQuery('#addToLibrary2').on('click', function() {
        console.log('Button Clicked');
        let spinner = document.getElementById("spinner2");
        spinner.style.visibility = 'visible';
      });
  
      jQuery('#addToLibrary3').on('click', function() {
        console.log('Button Clicked');
        let spinner = document.getElementById("spinner3");
        spinner.style.visibility = 'visible';
      });
  
  
      //toggle button enabled on change of Image
      
      // for t11-longtailkeyword.php
      jQuery('#validationCustom1102').change(function() {
        jQuery('#question_hidden').val(('#validationCustom1102').find(':selected').text());
      });
  
      //This is not currently used.  Placing code here for later
      jQuery('#validationCustom1102').on( "change", function() {
        var selValue = jQuery("#validationCustom1102").val();
        var selText = jQuery('#validationCustom1102').text();
        //console.log(selValue);
        //console.log(selText);
  
        if(selValue == 1) {
          //console.log('selValue == 1');
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 2) {
          //console.log('selValue == 2');
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 3) {
          //console.log('selValue == 3');
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 4) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 5) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 6) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 7) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 8) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 9) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 10) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 11) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 12) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 13) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 14) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 15) {
          jQuery('#validationCustom1201').val('');
        } else if (selValue == 16) {
          jQuery('#validationCustom1201').val('');
        }

        
        //jQuery('#validationCustom1201').val(selValue);
      });

      
      jQuery('#validationCustom1203').on( "change", function() {
        var selValue = jQuery("#validationCustom1203").val();
        var selText = jQuery('#validationCustom1203').text();
        //console.log(selValue);
        //console.log(selText);
  
        if(selValue == 1) {
          //console.log('selValue == 1');
          jQuery('#validationCustom1201').val('illustration of a puppy, modern design, cute, happy, 4k, high resolution, trending in deviantart');
        } else if (selValue == 2) {
          //console.log('selValue == 2');
          jQuery('#validationCustom1201').val('A beautiful young African-American dieselpunk policewoman | | fine-face, handsome face, realistic shaded Perfect face, fine details. Anime. realistic shaded lighting poster by Ilya Kuvshinov katsuhiro otomo ghost-in-the-shell, magali villeneuve, artgerm, Jeremy Lipkin and Michael Garmash and Rob Rey');
        } else if (selValue == 3) {
          //console.log('selValue == 3');
          jQuery('#validationCustom1201').val('Mid-west USA, neighborhood, sleepy street, Thomas Kinkade oil painting, high resolution, 4k');
        } else if (selValue == 4) {
          jQuery('#validationCustom1201').val('Curving wing of modern hospital building in Californian redwood forest, architecture by Frank Gehry, wide-angle architectural photography from magazine');
        } else if (selValue == 5) {
          jQuery('#validationCustom1201').val('Stunning modern renovation of village church at dawn, huge shards of translucent coloured perspex, architectural photography');
        } else if (selValue == 6) {
          jQuery('#validationCustom1201').val('Refreshment kiosk in park, neo-Andean architectural style, editorial photograph at golden hour');
        } else if (selValue == 7) {
          jQuery('#validationCustom1201').val('Steampunk airport terminal architecture, exterior view, award-winning architectural photography from magazine.');
        } else if (selValue == 8) {
          jQuery('#validationCustom1201').val('Innovative interior design of a restaurant in rural Japan, neutral wooden materials, floor-to-ceiling windows with views of nature');
        } else if (selValue == 9) {
          jQuery('#validationCustom1201').val('Award-winning interior design of a modern hotel bar, playful furry furniture, warm lamp lighting');
        } else if (selValue == 10) {
          jQuery('#validationCustom1201').val('A super-minimal brutalist interior, plunge pool sunk into floor, huge windows with daylight streaming in, a single table, high-resolution photo from architecture website');
        } else if (selValue == 11) {
          jQuery('#validationCustom1201').val('Interior design photo of top floor maisonette in a Victorian terraced house, bold colourful furniture, dark blue walls.');
        } else if (selValue == 12) {
          jQuery('#validationCustom1201').val('Award-winning landscape design, a long thin Mediterranean garden with olive tree draped in fairy lights, high-quality photograph at twilight.');
        } else if (selValue == 13) {
          jQuery('#validationCustom1201').val('Artists impression of award-winning rooftop garden design, white marble benches amidst wildflower meadow, NYC skyline in background, photograph at golden hour. ');
        } else if (selValue == 14) {
          jQuery('#validationCustom1201').val('Beautiful pond surrounded by lavender and lilac, dappled sunbeams illuminating the scene, stunning photograph from lansdcaping magazine.');
        } else if (selValue == 15) {
          jQuery('#validationCustom1201').val('Aged bronze statue of a Buffalo Soldier on his horse, shiny patches on face, in a london park on a sunny day ');
        } else if (selValue == 16) {
          jQuery('#validationCustom1201').val('A marble Greek statue of Black Panther');
        }

        
        //jQuery('#validationCustom1201').val(selValue);
      });


     // Validations
     // Example starter JavaScript for disabling form submissions if there are invalid fields
     (function () {
        'use strict'
          
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
  
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                //jQuery('#spinner-div').hide();
                let spinner = document.getElementById("spinner-submit");
                 spinner.style.visibility = 'hidden';

                 let addBlogSpinner = document.getElementById("spinner-blog-submit");
                 if(addBlogSpinner) {
                    addBlogSpinner.style.visibility = 'hidden';
                 }

                //  let imageInfoText = document.getElementById('imageInfoText');
                //  imageInfoText.style.visibility = 'visible';
                 
                 console.log("Checked Validation");
              }
  
              form.classList.add('was-validated')
            }, false)
          })
    })();

    // jQuery('#temperatureValue').on('slide', function(event,ui) {
    //   console.log("Slider: " + ui.value );
    //   document.getElementById("temperatureTextValue").innerText = ui.value;
    // });
      

});


function insertTextIntoTitle( form, inputText) {

    form.postTitle.value = inputText;
}

