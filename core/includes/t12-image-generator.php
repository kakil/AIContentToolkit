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

// This function allows us to log a variable to the console - converting php to js
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';

  if($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
  }

  echo $js_code;

}



?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=ai-content-tool-dashboard"><img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Navbar_Logo.png'; ?>" alt="AI Content Toolkit Logo" width="300" height="60">
	</a>
  </div>
</nav>

<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="mt-3 mb-3">Image Generator</h1>
  <form method="post" id="blogPostForm" class="needs-validation" novalidate>

    <!-- Number of Images -->
    <div class="mb-3">
      <select class="form-select" aria-label="Default select example" name="numberOfImages" id="validationCustom1202" value="<?php echo isset($_POST['numberOfImages']) ? $_POST['numberOfImages'] : '' ?>" >
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
      <select class="form-select" aria-label="Default select example" name="sizeOfImages" id="validationCustom1204" value="<?php echo isset($_POST['sizeOfImages']) ? $_POST['sizeOfImages'] : '' ?>" >
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
      <select class="form-select" aria-label="Default select example" name="starterPromtValue" id="validationCustom1203" value="<?php echo isset($_POST['starterPromtValue']) ? $_POST['starterPromtValue'] : '' ?>" >
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
        <option value="17">Young Girl Portrait</option>
        <option value="18">Old Coal Miner</option>
        <option value="19">Sango Fantasy</option>
        <option value="20">Woman With Flowers</option>
        <option value="21">Elsa</option>
        <option value="22">Zulu Warrior</option>
        <option value="23">Realistic Photo</option>
        <option value="24">Realistic Cat Photo</option>
        <option value="25">Afghani Girl</option>
        <option value="26">Anime Princess</option>
        <option value="27">Goddess</option>
        <option value="28">Tank Commander</option>
        <option value="29">Nike Sneaker</option>
        <option value="30">Woman Wearing Jacket</option>
        <option value="31">Italian Manor</option>
        <option value="32">Persian Villa</option>
        <option value="33">Modern House</option>
        <option value="34">Sailing Ship</option>
        <option value="35">Sunset Landscape</option>
        <option value="36">Sci-Fi Robot</option>
        <option value="37">Nubian King</option>
        <option value="38">Marble Sculpture</option>
        <option value="39">Robot In City</option>
        <option value="40">Portrait of Paladin</option>
        <option value="41">Chibi Spiderman</option>
        <option value="42">Female Samurai</option>
        <option value="43">Grilled Steak</option>
      </select>
      <div class="invalid-feedback">
        Please select a prompt or enter one below.
      </div>
    </div>


    <!-- Prompt -->
    <div class="mb-3">
      <label for="validationCustom1201" class="form-label"><?php echo $lang["imagePrompt"]; ?></label>
      <textarea class="form-control" id="validationCustom1201" name="chatGptText" placeholder="Cute cartoon cat" rows="5" min="0" max="200" value="<?php echo isset($_POST['chatGptText']) ? $_POST['chatGptText'] : '' ?>" required></textarea>
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
        <button type="button" name="btn-submit-image-generation" class="btn btn-primary mb-3" id="btn-submit-image-generation" ><?php echo $lang["imageButton"]; ?>
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
        <input type="hidden" name="imageURL1" id="imageURL1" value="<?php echo $imageOne; ?>"/>
        <div class="text-center">
          <button type="button" name="addToLibrary1" class="btn btn-primary mb-3" id="addToLibrary1"><?php echo $lang["addToMediaLibrary"]; ?>
            <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true" style="visibility: hidden"></span>
          </button>
        </div>
      </div>

      <!-- Image 2 -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <a href="<?php echo $imageTwo; ?>" target="_blank">
          <img src="<?php echo $imageTwo; ?>" class="img-thumbnail mb-3" id="imageId2" alt="Image 2">
        </a>
        <input type="hidden" name="imageURL2" id="imageURL2" value="<?php echo $imageTwo; ?>"/>
        <div class="text-center">
          <button type="submit" name="addToLibrary2" class="btn btn-primary mb-3" id="addToLibrary2"><?php echo $lang["addToMediaLibrary"]; ?>
            <span class="spinner-border spinner-border-sm" id="spinner2" role="status" aria-hidden="true" style="visibility: hidden"></span>
          </button>
        </div>
      </div>

      <!-- Image 3 -->
      <div class="col-12 col-md-6 col-lg-4 mb-3">
        <a href="<?php echo $imageThree; ?>" target="_blank">
          <img src="<?php echo $imageThree; ?>" class="img-thumbnail mb-3" id="imageId3" alt="Image 3">
        </a>
        <input type="hidden" name="imageURL3" id="imageURL3" value="<?php echo $imageThree; ?>"/>
        <div class="text-center">
          <button type="submit" name="addToLibrary3" class="btn btn-primary mb-3" id="addToLibrary3"><?php echo $lang["addToMediaLibrary"]; ?>
            <span class="spinner-border spinner-border-sm" id="spinner3" role="status" aria-hidden="true" style="visibility: hidden"></span>
          </button>
        </div>
      </div>
    </div>
    
    <!-- Images Row 2 -->
    <div class="row mb-3">
      <div class="mb-2 d-none" id="submitSuccessMessage">
        <div class="text-center text-success" class="form-label d-none" id="successLabel"><b><i>Image Upload To Media Library Complete!</i></b></label>
        </div>
      </div>
      <div class="d-none" id="submitErrorMessage">
          <div class="text-center text-danger mb-3"><b><i>Error Uploading To Media Library!</i></b></div>
      </div>
    </div>
    <div class="imageInfoText" style="visibility: visible" id="imageInfoText">
      <p><small><i>Click the image to download</i></small></p>
    </div>
    <!-- Images Row 3 -->
    
    <div>
      <input type="hidden" id="ajaxurl" value="<?php echo esc_js(admin_url('admin-ajax.php')); ?>">
      <input type="hidden" id="tempPlaceholder" value="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/image_placeholder.png'; ?>">
    </div>
  </form>
</div>

