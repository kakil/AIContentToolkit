<?php

include "header.php";


$imageData = NULL;
$imageOne = AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/image_placeholder.png';
$imageTwo = AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/image_placeholder.png';
$imageThree = AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/image_placeholder.png';
$imageName1 = 'dalleImage1.png';
$imageName2 = 'dalleImage2.png';
$imageName3 = 'dalleImage3.png';
$numberOfImages = '1';
$sizeOfImages = '256x256';

global $wpdb;
$tablename = $wpdb->prefix.'chatgpt_content_tool';
$sql = "SELECT * FROM $tablename";

$results = $wpdb->get_results($sql);
$getApiToken = $results[0]->api_token;
$getTemperature = intval($results[0]->temperature);
$getMaxTokens = intval($results[0]->max_tokens);
$getLanguage = $results[0]->language;

$languages = array("tr","en");
if(in_array($getLanguage,$languages)) {
    include AICONTENTT_PLUGIN_DIR . "/languages/".$getLanguage.".php";
} else {
  include AICONTENTT_PLUGIN_DIR . "/languages/en.php";
}

/**
 * Prompt inspiration:
 * https://ed.codes/blog/chatgpt-for-blogging-seo-best-prompts-process
 */
if(isset($_POST["chatGptText"])){

  $prompt = $_POST["chatGptText"];
  //$postTitle = $_POST['chatGptText'];   //adding prompt to Blog Title field
  //$postKeywords = $_POST['blogKeywordText'];  //adding prompt to Blog Keyword field

  $promptNumber = $_POST["starterPromtValue"];
  //$prompt = AICONTENTT()->helpers->get_images_prompt( $_POST["chatGptText"], $promptNumber);
  //console_log($_POST["numberOfImages"]);

  if(isset($_POST["numberOfImages"])) {

    if($_POST['numberOfImages'] != 'Select # of Images') {
      $numberOfImages = $_POST['numberOfImages'];
    };
    
  }

  if(isset($_POST["sizeOfImages"])) {
    if($_POST["sizeOfImages"] == 2) {
      $sizeOfImages = "512x512";
    } else if ($_POST["sizeOfImages"] == 3) {
      $sizeOfImages = "1024x1024";
    }

    //else $sizeOfImages = 1 > the default
  }

  console_log('Number of Images: ' . $numberOfImages);
  $imageData = AICONTENTT()->helpers->get_chatgpt_image_response( $prompt, $numberOfImages, $sizeOfImages);
  console_log('Image Data: ' . $imageData[0]["url"]);
  
  if(!empty($imageData[0]["url"])) {
    $imageOne = $imageData[0]["url"];
    //$imageOneUpload = $imageData[0]["url"];
  }

  if(!empty($imageData[1]["url"])) {
    $imageTwo = $imageData[1]["url"];
    //$imageTwoUpload = $imageData[1]["url"];
  } 

  if(!empty($imageData[2]["url"])) {
    $imageThree = $imageData[2]["url"];
    //$imageThreeUpload = $imageData[2]["url"];
  } 

  $_POST["chatGptText"];
 
}

if(isset($_POST["addBlog"])){
  $my_post = array();
  $my_post['post_title']    = $_POST["postTitle"];
  $my_post['post_content']  = $_POST["postContent"];
  $my_post['tags_input']  = $_POST["postKeywords"];;
  $my_post['post_status']   = 'publish';
  $my_post['post_author']   = 1;
  $my_post['post_category'] = array($_POST["postCategory"]);
  //console_log($my_post);
  // Insert the post into the database
  wp_insert_post( $my_post );
}

if(isset($_POST["addToLibrary"])) {


  console_log($imageOne);
  $imageOne = $_POST["imageURL"];
  $imageTwo = $_POST["imageURL2"];
  $imageThree = $_POST["imageURL3"];

  //console_log($_POST["imageURL"]);
  $attachment_id = AICONTENTT()->helpers->rudr_upload_file_by_url($_POST["imageURL"], $imageName1);
  
  $_POST[$imageOne];
  $_POST[$imageTwo];
  $_POST[$imageThree];
  
  console_log($attachment_id);
}

if(isset($_POST["addToLibrary2"])) {
  $imageOne = $_POST["imageURL"];
  $imageTwo = $_POST["imageURL2"];
  $imageThree = $_POST["imageURL3"];

  $attachment_id2 = AICONTENTT()->helpers->rudr_upload_file_by_url($_POST["imageURL2"], $imageName2);

  $_POST[$imageOne];
  $_POST[$imageTwo];
  $_POST[$imageThree];
  
}

if(isset($_POST["addToLibrary3"])) {
  $imageOne = $_POST["imageURL"];
  $imageTwo = $_POST["imageURL2"];
  $imageThree = $_POST["imageURL3"];

  $attachment_id3 = AICONTENTT()->helpers->rudr_upload_file_by_url($_POST["imageURL3"], $imageName3);

  $_POST[$imageOne];
  $_POST[$imageTwo];
  $_POST[$imageThree];
}

// This function allows us to log a variable to the console - converting php to js
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';

  if($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
  }

  echo $js_code;

}



?>


<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="mt-3 mb-3">Image Generator</h1>
  <form method="post" id="blogPostForm" class="needs-validation" novalidate>

    <!-- Number of Images -->
    <div class="mb-3">
      <select class="form-select" aria-label="Default select example" name="numberOfImages" id="validationCustom1202">
        <option selected>Select # of Images</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
      <div>
        <div class=" row mb-3" name="imagesInfoText" id="imagesInfoText">
          <p><small><i>* Default is 1</i></small></p>
        </div>
      </div>
      <div class="invalid-feedback">
        Please select number of images to generate.
      </div>
    </div>

     <!-- Select Size of Images -->
    <div class="mb-3">
      <select class="form-select" aria-label="Default select example" name="sizeOfImages" id="validationCustom1204">
        <option selected>Select Size of Images</option>
        <option value="1">256px</option>
        <option value="2">512px</option>
        <option value="3">1024px</option>
      </select>
      <div>
        <div class=" row mb-3" name="sizeInfoText" id="sizeInfoText">
          <p><small><i>Default is 256px</i></small></p>
        </div>
      </div>
      <div class="invalid-feedback">
        Please select size of images to generate.
      </div>
    </div>

    <!-- Select A Prompt -->
    <div class="mb-3">
      <select class="form-select" aria-label="Default select example" name="starterPromtValue" id="validationCustom1203">
        <option selected>Select A Starter Prompt</option>
        <option value="1">Cute Dog</option>
        <option value="2">Diesel Punk Female</option>
        <option value="3">Oil Painting</option>
        <option value="4">Hospital Building</option>
        <option value="5">Modern Church</option>
        <option value="6">Kiosk in Park</option>
        <option value="7">Steampunk Spaceport Terminal</option>
        <option value="8">Restaurant Interior</option>
        <option value="9">Modern Hotel Bar</option>
        <option value="10">Minimalist Interior</option>
        <option value="11">Interior Design Photo</option>
        <option value="12">Mediterranean Garden</option>
        <option value="13">Rooftop Garden</option>
        <option value="14">Beautiful Pond</option>
        <option value="15">Aged Bronze Statue</option>
        <option value="16">Marble Greek Statue</option>
      </select>
      <div class="invalid-feedback">
        Please select a prompt or enter one below.
      </div>
    </div>


    <!-- Prompt -->
    <div class="mb-3">
      <label for="validationCustom1201" class="form-label"><?php echo $lang["imagePrompt"]; ?></label>
      <textarea class="form-control" id="validationCustom1201" name="chatGptText" placeholder="Cute cartoon cat" rows="5" min="0" max="200"  value="<?php echo isset($_POST['chatGptText']) ? $_POST['chatGptText'] : '' ?>" required></textarea>
      <div class="invalid-feedback">
        Please describe your image or select a starter prompt above
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/200</label>
    </div>

    
    
    <!-- Submit Content to OpenAPI -->
    <div class="row mb-5">
      <div class="col-sm-9">
        <button type="submit" name="goTest" class="btn btn-primary mb-3" id="btn-submit" ><?php echo $lang["imageButton"]; ?>
          <span class="spinner-border spinner-border-sm" id="spinner-submit" role="status" aria-hidden="true" style="visibility: hidden"></span>
        </button>
        <button type="reset" value="Reset" class="btn btn-danger ms-2 mb-3" id="reset-submit-info">Reset</button>
      </div>
    </div>
  </form>

  <form method="POST" id="blogForm" class="needs-validation" enctype="multipart/form-data" novalidate>
    
    <!-- Images Row 1 -->
    <div class="row mb-3">

      <!-- Image 1 -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <a href="<?php echo $imageOne; ?>" target="_blank">
          <img src="<?php echo $imageOne; ?>" class="img-thumbnail mb-3" id="imageId1" alt="">
        </a>
        <input type="hidden" name="imageURL" id="imageURL" value="<?php echo $imageOne; ?>"/>
        <div class="text-center">
          <button type="submit" name="addToLibrary" class="btn btn-primary mb-3" id="addToLibrary"><?php echo $lang["addToMediaLibrary"]; ?>
            <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true" style="visibility: hidden"></span>
          </button>
        </div>
      </div>

      <!-- Image 2 -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <a href="<?php echo $imageTwo; ?>" target="_blank">
          <img src="<?php echo $imageTwo; ?>" class="img-thumbnail mb-3" alt="Image 2">
        </a>
        <input type="hidden" name="imageURL2" value="<?php echo $imageTwo; ?>"/>
        <div class="text-center">
          <button type="submit" name="addToLibrary2" class="btn btn-primary mb-3" id="addToLibrary2"><?php echo $lang["addToMediaLibrary"]; ?>
            <span class="spinner-border spinner-border-sm" id="spinner2" role="status" aria-hidden="true" style="visibility: hidden"></span>
          </button>
        </div>
      </div>

      <!-- Image 3 -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <a href="<?php echo $imageThree; ?>" target="_blank">
          <img src="<?php echo $imageThree; ?>" class="img-thumbnail mb-3" alt="Image 3">
        </a>
        <input type="hidden" name="imageURL3" value="<?php echo $imageThree; ?>"/>
        <div class="text-center">
          <button type="submit" name="addToLibrary3" class="btn btn-primary mb-3" id="addToLibrary3"><?php echo $lang["addToMediaLibrary"]; ?>
            <span class="spinner-border spinner-border-sm" id="spinner3" role="status" aria-hidden="true" style="visibility: hidden"></span>
          </button>
        </div>
      </div>
    </div>
    
    <!-- Images Row 2 -->

    <div class="imageInfoText" style="visibility: visible" id="imageInfoText">
      <p><small><i>Click the image to download</i></small></p>
    </div>
   
  </form>
</div>

