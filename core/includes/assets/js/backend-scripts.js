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

        let imageInfoText = document.getElementById('imageInfoText');
        imageInfoText.style.visibility = 'visible';
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
        } else {
          //console.log('selValue == 3');
          jQuery('#validationCustom1201').val('Mid-west USA, neighborhood, sleepy street, Thomas Kinkade oil painting, high resolution, 4k');
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

                 let imageInfoText = document.getElementById('imageInfoText');
                 imageInfoText.style.visibility = 'visible';
                 
                 console.log("Checked Validation");
              }
  
              form.classList.add('was-validated')
            }, false)
          })
    })();

    jQuery('#temperatureValue').on('slide', function(event,ui) {
      console.log("Slider: " + ui.value );
      document.getElementById("temperatureTextValue").innerText = ui.value;
    });
      

});


function insertTextIntoTitle( form, inputText) {

    form.postTitle.value = inputText;
}

