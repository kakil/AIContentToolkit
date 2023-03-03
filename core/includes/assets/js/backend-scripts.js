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
    
    
    //t34-chatgpt-modal.php

    // jQuery('#blogPostForm').on('submit', function() {
    //   jQuery('#myModal').on('hide.bs.modal', function(e) {
    //     e.preventDefault();
    //   })
    // });

    // jQuery("#blogPostForm").submit(function(event) {
    //   event.preventDefault();
    // });

    jQuery('#btn-submit-modal').click(function (e) {
      let spinner = document.getElementById("spinner-blog-submit");
      spinner.style.visibility = 'visible';

      jQuery('#myModal').preventDefault();
      
  });


    //license code

    jQuery( document ).ready( function() {

      jQuery('#activate_license_btn').on('click', function(event) {
  
        event.preventDefault();
        
        console.log('Button clicked');
        var license_key = jQuery('#license_key').val() == undefined ? '' : jQuery('#license_key').val().trim();
  
        if(!license_key) {
          console.log('license key is null');
        } else {
  
          var ajaxurl = jQuery('#ajaxurl').val();
  
          // Get the license key from the input field
          var license_key = jQuery('#license_key').val();
  
          // Set the API key and GUID parameters
          var api_key = '588e6bf7b14c8b63114fb0f147afc5c3'
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
            success: function(obj, textStatus) {
              alert('obj: ' + obj);
            },
            error: function(msg) {  //xhr, textStatus, errThrown
              console.log(msg)
            }
          });
  
        }
      });
    });
});