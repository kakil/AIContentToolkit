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


//This code runs after all asynchonous operations have completed
window.onload = function() {
  if(jQuery('#license_key').val() === "" || jQuery('#license').val() === null ) {
    console.log('license key is null');
    jQuery('#activate_license_btn').removeClass('d-none');    // no license key - show activate btn
    jQuery('#deactivate_license_btn').addClass('d-none');     // no license key - hide deactivate btn
    jQuery('#license_key').prop('disabled', false);
  } else {

    jQuery('#license_key').prop('disabled', true);
    jQuery('#activate_license_btn').addClass('d-none');       // license key - hide activate btn
    jQuery('#deactivate_license_btn').removeClass('d-none');  // license key - show deactivate btn
    jQuery('#license_key').prop('disabled', true);            // license key - textfield uneditable

    // var license_key = "ZTYJ-IMO9-HQVE-UUDH";
    // var pattern = /^[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}$/;
    // var verified = pattern.test(license_key);

    // if (jQuery('#verified').val() == 'true') {
    //   console.log("License key is valid.");
    //   jQuery('#activate_license_btn').addClass('d-none');       // license key - hide activate btn
    //   jQuery('#deactivate_license_btn').removeClass('d-none');  // license key - show deactivate btn
    //   jQuery('#license_key').prop('disabled', true);
    // } else {
    //   console.log("License key is invalid.");
    //   jQuery('#activate_license_btn').removeClass('d-none');    // no license key - show activate btn
    //   jQuery('#deactivate_license_btn').addClass('d-none');     // no license key - hide deactivate btn
    //   jQuery('#license_key').val('');
    //   jQuery('#license_key').prop('disabled', false);
    // }
    
  }

  console.log("verified: " + jQuery('#verified').val());
  if(jQuery('#verified').val() === 'false') {
    jQuery('#createBlogButton').addClass('disabled');
    jQuery('#createBlogPostOutline').addClass('disabled');
    jQuery('#brainstorm').addClass('disabled');
    jQuery('#mindmap').addClass('disabled');
    jQuery('#advancedpost').addClass('disabled');
    jQuery('#findkeywords').addClass('disabled');
    jQuery('#createarticle').addClass('disabled');
    jQuery('#createlistpost').addClass('disabled');
    jQuery('#astrologyreading').addClass('disabled');
    jQuery('#createscript').addClass('disabled');
    jQuery('#createkeywordlist').addClass('disabled');
    jQuery('#generateimages').addClass('disabled');

    //Pro Tools
    jQuery('#Pro1').addClass('disabled');
    jQuery('#Pro2').addClass('disabled');
    jQuery('#Pro3').addClass('disabled');
    jQuery('#Pro4').addClass('disabled');
    jQuery('#Pro5').addClass('disabled');
    jQuery('#Pro6').addClass('disabled');
    jQuery('#Pro7').addClass('disabled');
    jQuery('#Pro8').addClass('disabled');
    jQuery('#Pro9').addClass('disabled');
    jQuery('#Pro10').addClass('disabled');
    jQuery('#Pro11').addClass('disabled');
    jQuery('#Pro12').addClass('disabled');
    jQuery('#Pro13').addClass('disabled');
    jQuery('#Pro14').addClass('disabled');
    jQuery('#Pro15').addClass('disabled');
    jQuery('#Pro16').addClass('disabled');
    jQuery('#Pro17').addClass('disabled');
    jQuery('#Pro18').addClass('disabled');
    jQuery('#Pro19').addClass('disabled');
    jQuery('#Pro20').addClass('disabled');
    jQuery('#Pro21').addClass('disabled');
    
  }

  //disable pro tools buttons
  //jQuery('button[id^="#Pro"]').prop('disabled', true);

};


jQuery(document).ready(function() {


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



  //license code
  // Activate License
  jQuery('#activate_license_btn').on('click', function(event) {

    console.log('Button clicked');
    jQuery('#submitSuccessMessage').addClass('d-none');
    jQuery('#submitErrorMessage').addClass('d-none');
    
    event.preventDefault();

    let spinner = document.getElementById("spinner-submit");
    spinner.style.visibility = 'visible'; 

    //client-side license verification
    //
    
    var license_key = jQuery('#license_key').val() == undefined ? '' : jQuery('#license_key').val().trim();
    var pattern = /^[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}-[A-Z\d]{4}$/;
    var verified = pattern.test(license_key);

    if (verified) {
      console.log("License key is valid.");

      var ajaxurl = jQuery('#ajaxurl').val();

      // Set the API key and GUID parameters
      var api_key = 'f3e5e21f4b56e07bcc0c1518e06f53db'
      var guid = jQuery('#currenturl').val();
      console.log('GUID: ' + guid);
      console.log('license key: ' + license_key);
      console.log('ajax url: ' + ajaxurl);

      jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
          'action': 'verify_license',
          _api_key: api_key,
          license_key: license_key,
          guid: guid

        },
        success: function(response) {
          //alert('obj: ' + obj);
          spinner.style.visibility = 'hidden';

          var data = JSON.parse(response);

          if (data.success !== undefined && data.success === false) {
            console.log('License not found');
            jQuery('#submitSuccessMessage').addClass('d-none');
            jQuery('#submitErrorMessage').removeClass('d-none');
            jQuery('#activate_license_btn').removeClass('d-none');
            jQuery('#submitSuccessMessage').text('License Activation Error - Try Again');
            jQuery('#license_key').prop('disabled', false);
          } else if (data.license_key !== undefined) {
            console.log('License Key: ' + data.license_key);
            console.log('Activated At: ' + data.activated_at);
            jQuery('#activate_license_btn').addClass('d-none');
            jQuery('#deactivate_license_btn').removeClass('d-none');
            jQuery('#submitSuccessMessage').removeClass('d-none');
            jQuery('#submitSuccessMessage').text('License Activated');
            jQuery('#submitErrorMessage').addClass('d-none');
            jQuery('#license_key').prop('disabled', true);
          } else {
            console.log('Activation Response returned undefined');
            jQuery('#submitSuccessMessage').addClass('d-none');
            jQuery('#submitErrorMessage').removeClass('d-none');
            jQuery('#activate_license_btn').removeClass('d-none');
            jQuery('#submitSuccessMessage').text('License Activation Error - Try Again');
            jQuery('#license_key').prop('disabled', false);
          }
          
        },
        error: function(msg) {  //xhr, textStatus, errThrown
          console.log('Error during license activation: ' + msg);
          jQuery('#submitSuccessMessage').addClass('d-none');
          jQuery('#submitErrorMessage').removeClass('d-none');
          jQuery('#activate_license_btn').removeClass('d-none');
          jQuery('#submitSuccessMessage').text('License Activation Error - Try Again');
          jQuery('#license_key').prop('disabled', false);
        }
      });

    } else {
      console.log("License key is invalid.");
      spinner.style.visibility = 'hidden';
      jQuery('#submitErrorMessage').removeClass('d-none');                  //make message visible
      jQuery('#submitSuccessMessage').addClass('d-none');                   //make success message hidden
      jQuery('#activate_license_btn').removeClass('d-none');                //make btn visible
      jQuery('#submitSuccessMessage').text('License Activation Error - Try Again');
      jQuery('#license_key').prop('disabled', false);                       //make textfield editable
    }
    
  });


  //Deactivate License

  
  jQuery('#deactivate_license_btn').on('click', function(event) {

    console.log('Button clicked');
    
    event.preventDefault();

    let spinner = document.getElementById("spinner-submit");
    spinner.style.visibility = 'visible'; 

    var ajaxurl = jQuery('#ajaxurl').val();
    var license_key = jQuery('#license_key').val();


      // Set the API key and GUID parameters
      var api_key = '588e6bf7b14c8b63114fb0f147afc5c3'
      //var guid = jQuery('#currenturl').val();
      console.log('license key: ' + license_key);
      console.log('ajax url: ' + ajaxurl);

      jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
          'action': 'deactivate_license',
          _api_key: api_key,
          license_key: license_key,

        },
        success: function(response) {
          //alert('obj: ' + obj);
          spinner.style.visibility = 'hidden';

          var data = JSON.parse(response);

          if(typeof data.deactivated_at !== "undefined") {
            console.log('License Key: ' + data.license_key);
            console.log('Deactivated At: ' + data.deactivated_at);

            jQuery('#activate_license_btn').removeClass('d-none');          //make btn visible
            jQuery('#deactivate_license_btn').addClass('d-none');           //make btn hidden
            jQuery('#submitSuccessMessage').removeClass('d-none');          //make success message visible
            jQuery('#submitSuccessMessage').text('License Deactivated');    
            jQuery('#submitErrorMessage').addClass('d-none');               //make error message hidden
            jQuery('#license_key').prop('disabled', false);                 //make textfield editable
            jQuery('#license_key').val('');                                 
          } else {
            console.log('Deactivation Response is undefined: ' + data);
            jQuery('#submitSuccessMessage').addClass('d-none');             //make btn hidden
            jQuery('#submitErrorMessage').removeClass('d-none');            //make btn visible 
            jQuery('#submitErrorMessage').text('Error During License Deactivated - Try Again');    
            jQuery('#license_key').prop('disabled', true);                 //make textfield editable
            
          }
  
        },
        error: function(msg) {  //xhr, textStatus, errThrown
          console.log('error deactivating license: ' + msg);
          jQuery('#submitSuccessMessage').removeClass('d-none');
          jQuery('#submitErrorMessage').addClass('d-none');
        }
      });

  });





  /**
   * ********************************************************************************
   * 
   */
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
    //  jQuery('#addToLibrary').on('click', function() {
    //     console.log('Button Clicked');
    //     let spinner = document.getElementById("spinner");
    //     spinner.style.visibility = 'visible';
    //   });
  
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
      // jQuery('#validationCustom1102').change(function() {
      //   jQuery('#question_hidden').val(('#validationCustom1102').find(':selected').text());
      // });
  
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
        }else if (selValue == 17) {
          jQuery('#validationCustom1201').val('botticelli’s simonetta vespucci young portrait photography hyperrealistic modern dressed, futuristic');
        }else if (selValue == 18) {
          jQuery('#validationCustom1201').val('a portrait of an old coal miner in 19th century, beautiful painting with highly detailed face by greg rutkowski and magali villanueve');
        }else if (selValue == 19) {
          jQuery('#validationCustom1201').val('sango fantasy, fantasy magic,  , intricate, sharp focus, illustration, highly detailed, digital painting, concept art, matte, Artgerm and Paul lewin and kehinde wiley, masterpiece');
        }else if (selValue == 20) {
          jQuery('#validationCustom1201').val('Beautiful Woman with smile appearing from colorful flowers, wet, dewdrops, cinematic lighting, photo realistic, by karol bak --ar 2:3 --beta --upbeta');
        }else if (selValue == 21) {
          jQuery('#validationCustom1201').val('Elsa, d & d, fantasy, intricate, elegant, highly detailed, digital painting, artstation, concept art, matte, sharp focus, illustration, hearthstone, art by artgerm and greg rutkowski and alphonse mucha, 8k');
        }else if (selValue == 22) {
          jQuery('#validationCustom1201').val('painted portrait of rugged zulu warrior, bald, masculine, mature, handsome, upper body, muscular, hairless torso, fantasy, intricate, elegant, highly detailed, digital painting, artstation, concept art, smooth, sharp focus, illustration, art by gaston bussiere and alphonse mucha');
        }else if (selValue == 23) {
          jQuery('#validationCustom1201').val('photo of a gorgeous mixed-race female, realistic, professional body shot, sharp focus, a hint of cleavage, 8K, insanely detailed, intricate, elegant, intricate office background');
        }else if (selValue == 24) {
          jQuery('#validationCustom1201').val('realistic portrait of an orange cat, bright eyes, with angel wings, radiant and ethereal intricately detailed photography, cinematic lighting, 50mm lens with bokeh');
        }else if (selValue == 25) {
          jQuery('#validationCustom1201').val('a teenage girl of afghani descent with striking rainbow eyes stares at the camera with a deep read head scarf. kodachrome film');
        }else if (selValue == 26) {
          jQuery('#validationCustom1201').val('a portrait of a anime ghibli akihiko yoshida style african princess of china and japan, at the throne room, soft light, finely detailed features, perfect art, at an ancient city, gapmoe yandere grimdark, trending on pixiv fanbox, painted by greg rutkowski makoto shinkai takashi takeuchi studio ghibli, akihiko yoshida ');
        }else if (selValue == 27) {
          jQuery('#validationCustom1201').val('hyperrealistic full length portrait of gorgeous goddess | standing in field full of flowers | (detailed gorgeous face) | full body | (skimpy armor) | god rays | intricate | elegant | realistic | hyperrealistic | cinematic | character design | concept art | highly detailed | illustration | digital art | digital painting | depth of field');
        }else if (selValue == 28) {
          jQuery('#validationCustom1201').val('hyperrealistic portrait of female tank commander in dgs illustration style| full shot| detailed face| symmetric| intricate| realistic| cinematic| character design| concept art| highly detailed| illustration| digital art| digital painting| by Anders Zorn and Ruan Jia and Mandy Jurgens');
        }else if (selValue == 29) {
          jQuery('#validationCustom1201').val('nike sneaker made of colorful plasma :: redshift render, digital art, hyper-detailed, ultra-realistic, 8k post-production');
        }else if (selValue == 30) {
          jQuery('#validationCustom1201').val('well lit fashion shoot portrait of extremely beautiful female wearing massively over size puffer jacket by craig green, dingyun zhang, yeezy, balenciaga, vetements, sharp focus, clear, detailed, , cinematic, detailed, off white, glamourous, symmetrical, vogue, editorial, fashion, magazine shoot, glossy --q 2');
        }else if (selValue == 31) {
          jQuery('#validationCustom1201').val('aerial photography of an Italian manor in Tuscany, poolsuite style');
        }else if (selValue == 32) {
          jQuery('#validationCustom1201').val('a big Persian Villa surrounded by water and nature, village, close view, volumetric lighting, photorealistic, insanely detailed and intricate, Fantasy, epic cinematic shot, trending on ArtStation, mountains, 8k ultra hd, magical, mystical, matte painting, bright sunny day, flowers, massive cliffs, Sweeper3D');
        }else if (selValue == 33) {
          jQuery('#validationCustom1201').val('a big Persian Villa surrounded by water and nature, village, close view, volumetric lighting, photorealistic, insanely detailed and intricate, Fantasy, epic cinematic shot, trending on ArtStation, mountains, 8k ultra hd, magical, mystical, matte painting, bright sunny day, flowers, massive cliffs, Sweeper3D');
        }else if (selValue == 34) {
          jQuery('#validationCustom1201').val('photo of a ultra realistic sailing ship, dramatic light, pale sunrise, cinematic lighting, battered, low angle, trending on artstation, 4k, hyper realistic, focused, extreme details, unreal engine 5, cinematic, masterpiece, art by studio ghibli, intricate artwork by john william turner');
        }else if (selValue == 35) {
          jQuery('#validationCustom1201').val('Emerald Lake::0.3 fairy pools::0.5 archival fine-art print of a misty sunset alpine landscape photograph::1.5 Captured with a medium format Fujifilm GFX100s:: stunning view of Emerald Lake in rocky mountain national park::1.1 sunset glow on the mountains and clouds::0.5 detailed pencil watercolor painting of::0.1 a tranquil alpine forest full small flowers:: a painterly, book illustration watercolor granular splatter dripping paper texture::0.2 award winning:: black paper::0.1 --h 320 --uplight');
        }else if (selValue == 36) {
          jQuery('#validationCustom1201').val('sci fi people standing surrounded by huge sci fi robotic cyborg city with intricate mechancial and sci-fi details, insane level of details, hyper realistic, cinematic, composition');
        }else if (selValue == 37) {
          jQuery('#validationCustom1201').val('Close-up portrait of a Nubian king from ancient egypt walking into no mans land, metallic armor,white black gold, porcelain face, mechanical features, baroque rococo, cinematic lighting, golden ratio, league of legends, dynamic pose,detailed energetic crystal chain wearing armor,sigil metallic armor, cryptic writing, ritual, intricate gold, 3D ornate alter, pineal gland, highly detailed ornaments crystallized black gems, ambient oclusion, highkey photography, bokeh 8K beautiful, detailed scenery, metal diamond design gold photorealistic, insanely detailed and intricate, hypermaximalist, elegant, ornate, hyper realistic, super detailed, 8K --c 50 --v 4');
        }else if (selValue == 38) {
          jQuery('#validationCustom1201').val('mdjrny-v4 style, highly detailed marble and jade sculpture of a sugar skull, day of the dead, volumetric fog, volumetric lighting, Hyperrealism, breathtaking, ultra realistic, unreal engine, ultra detailed, cyber background, highly detailed, breathtaking, photography, stunning environment, wide-angle');
        }else if (selValue == 39) {
          jQuery('#validationCustom1201').val('(nousr robot:1.1), city street background, highly detailed, ultra-realistic, cinematic');
        }else if (selValue == 40) {
          jQuery('#validationCustom1201').val('redshift style, painted portrait of a paladin, masculine, mature, handsome, upper body, grey and silver, fantasy, intricate, elegant, highly detailed, digital painting, artstation, concept art, smooth, sharp focus, illustration, art by gaston bussiere and alphonse mucha');
        }else if (selValue == 41) {
          jQuery('#validationCustom1201').val('Chibi spiderman, octane rendering, modern Disney style');
        }else if (selValue == 42) {
          jQuery('#validationCustom1201').val('12th century female samurai in the style of greg rutkowski and Guweiz and Yoji Shinkawa, intricate black and red samurai armor, cinematic lighting, dark rainy city, depth of field, lumen reflections, photography, stunning environment, hyperrealism, insanely detailed --v 4');
        }else if (selValue == 43) {
          jQuery('#validationCustom1201').val('yummy beef grill steak and colorful vegetables in a single big white dish centered, tableware, food photograph, food styling, long shot, lens 85 mm, f 11, studio photograph, ultra detailed, octane render, 8k, --q 2 --s 6000 --ar 2:3');
        }

        
        //jQuery('#validationCustom1201').val(selValue);
      });


     

    jQuery('#btn-submit-modal').click(function (e) {
      let spinner = document.getElementById("spinner-blog-submit");
      spinner.style.visibility = 'visible';

      jQuery('#myModal').preventDefault();
      
  });



/**
 * 
 * Image Upload to Media Library
 * 
 * 
 */

  jQuery('#addToLibrary1, #addToLibrary2, #addToLibrary3').on('click', function() {

    //reset success and error messages
    jQuery('#submitSuccessMessage').addClass('d-none');
    jQuery('#submitErrorMessage').addClass('d-none');
            

    var id = this.id;
    var num = id.replace(/[^0-9]/g, '');
    var imageURLString = '#imageId' + num;
    var image_url = jQuery(imageURLString).prop('src');
    //var image_url = jQuery(this).closest('.mb-3').find('img').prop('src'); 

    console.log('Add To Library 1 Button Clicked');

    var ajaxurl = jQuery('#ajaxurl').val();
    //var image_url = jQuery('#imageURL1').val();
    //var image_name = jQuery('#imageURL1').prop('id');
    const imageBaseStr = 'dalle';
    var image_name = addRandomChars(imageBaseStr);

    var button = $(this);
    button.prop('disabled', true); // disable the button to prevent multiple clicks
    var spinner = button.find('.spinner-border');
    spinner.css('visibility', 'visible'); // show the spinner

    console.log('Image URL String: ' + imageURLString);
    console.log('Image URL: ' + image_url);
    console.log('Image Name: ' + image_name);


    // make an Ajax request to the server
    jQuery.ajax({
      type: 'POST',
      url: ajaxurl, // ajaxurl is a global variable that points to admin-ajax.php
      data: {
        action: 'rudr_upload_file_by_url_callback',
        image_url: image_url,
        imageName: image_name,
      },
      success: function(response) {
        if (response !== 'false') {
          console.log(response); // log the response to the console
          button.prop('disabled', true); // disable the button after the image has been added
          spinner.css('visibility', 'hidden'); // hide the spinner
          jQuery('#submitSuccessMessage').removeClass('d-none');
          jQuery('#submitErrorMessage').addClass('d-none');
            
        } else {
          console.log('Error uploading image');
          button.prop('disabled', false); // enable the button in case of error
          spinner.css('visibility', 'hidden'); // hide the spinner
          button.prop('disabled', false);
          jQuery('#submitSuccessMessage').addClass('d-none');
          jQuery('#submitErrorMessage').removeClass('d-none');
            
        }
      },
    });
  });



  function addRandomChars(str) {
    // generate 2 random alphanumeric characters
    const randomChars1 = Math.random().toString(26).slice(2, 4);
    // generate 4 random alphanumeric or numeric characters
    const randomChars2 = Math.random().toString(36).substr(2, 4);
    // combine the strings
    return str + '-' + randomChars1 + randomChars2 + '.png';
  }


  /**
   * Generate Images
   * 
   */

  jQuery('#btn-submit-image-generation').on('click', function() {

    //reset image buttons
    var image1 = jQuery('#imageId1');
    var image2 = jQuery('#imageId2');
    var image3 = jQuery('#imageId3');
    
    //reset success and error messages
    jQuery('#submitSuccessMessage').addClass('d-none');
    jQuery('#submitErrorMessage').addClass('d-none');
    
    //reset image placeholders
    image1.attr('src', jQuery('#tempPlaceholder').val());
    image2.attr('src', jQuery('#tempPlaceholder').val());
    image3.attr('src', jQuery('#tempPlaceholder').val());

    //reset addd to library buttons
    jQuery('#addToLibrary1').prop('disabled', false);
    jQuery('#addToLibrary2').prop('disabled', false);
    jQuery('#addToLibrary3').prop('disabled', false);

    var numberOfImagesSelection = jQuery('#validationCustom1202').val();
    var sizeOfImagesSelection = jQuery('#validationCustom1204').val();
    var prompt = jQuery('#validationCustom1201').val();
    var ajaxurl = jQuery('#ajaxurl').val();
    var numberOfImages = 1;
    var sizeOfImages = '512x512';

    console.log('Size of Images Selection: ' + sizeOfImagesSelection);
    if (numberOfImagesSelection == 'Select # of Images') {
      numberOfImages = 1;
    } else {
      numberOfImages = numberOfImagesSelection;
    }

    if (sizeOfImagesSelection == 'Select Size of Images' || sizeOfImagesSelection == '1') {
      sizeOfImages = '256x256';
    } else if (sizeOfImagesSelection == '2') {
      sizeOfImages = '512x512';
    } else {
      sizeOfImages = '1024x1024';
    }

    console.log('Number of Images: ' + numberOfImages);
    console.log('Size of Images: ' + sizeOfImages);
    console.log('Prompt: ' + prompt);

    //show spinner
    var button = $(this);
    button.prop('disabled', true); // disable the button to prevent multiple clicks
    var spinner = button.find('.spinner-border');
    spinner.css('visibility', 'visible'); // show the spinner


    //disable button
    jQuery(this).prop('disabled', true);

    //make ajax request to server
    jQuery.ajax({

      type: 'POST',
      url: ajaxurl,
      dataType: 'json',
      data: {
        action: 'get_chatgpt_image_response',
        chatGptText: prompt,
        numberOfImages: numberOfImages,
        sizeOfImages: sizeOfImages,
      },
      success: function(response) {
        if(response !== 'false') {
          //console.log(response);
          console.log('Success: ' + response[0].url);
          button.prop('disabled', false);
          // var image1 = jQuery('#imageId1');
          // var image2 = jQuery('#imageId2');
          // var image3 = jQuery('#imageId3');

          if(response[0]) {
            image1.attr('src', response[0].url);
            image1.parent('a').prop("href", response[0].url);
          }

          if(response[1]) {
            image2.attr('src', response[1].url);
            image2.parent('a').prop("href", response[1].url);
          }

          if(response[2]) {
            image3.attr('src', response[2].url);
            image3.parent('a').prop("href", response[2].url);
          }
          
          spinner.css('visibility', 'hidden');

        } else {
          console.log('Error generating images');
          jQuery(this).prop('disabled', false);
          spinner.css('visibility', 'hidden');

        }
      }
    });

    




  });

});