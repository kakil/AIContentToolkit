<?php
error_reporting(0);
include "header.php";
global $wp;

//if license_key doesn't exist we create the option in the DB
if(!get_option('license_key')) {
  AICONTENTT()->helpers->ai_content_add_option();
  
} else {
  $license_key = AICONTENTT()->helpers->ai_content_get_option();
  $pattern = '/^[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}$/';
  $verified = preg_match($pattern, $license_key);

  if(!$verified) {
    $license_key = '';
  }

}

global $wpdb;
$tablename = $wpdb->prefix.'ai_content_tool';

$sql = "SELECT * FROM $tablename";
$results = $wpdb->get_results($sql);
$getApiToken = $results[0]->api_token;
$getTemperature = $results[0]->temperature;
$getMaxTokens = $results[0]->max_tokens;
$getLanguage = $results[0]->language;

if($results[0]->max_tokens < 1500) {
  $getMaxTokens = 1500;
}

if($results[0]->temperature < 0.7) {
  $getTemperature = 0.7;
}


//$languages = array("tr","en");
$languages = array("en");
if(in_array($getLanguage,$languages)) {
    include AICONTENTT_PLUGIN_DIR . "/languages/".$getLanguage.".php";
} else {
  include AICONTENTT_PLUGIN_DIR . "/languages/en.php";
}

if(isset($_POST["submit"])){

  $temperatureValue = $_POST["temperatureValue"];
  $apiToken = $_POST["apiToken"];
  $maxTokens = $_POST["maxTokens"];
  $selectLanguage = $_POST["selectLanguage"];

  if($results){ // UPDATE
    $id = $results[0]->id;
    $wpdb->update( $tablename, array(
      'api_token' => $apiToken, 
      'temperature' => $temperatureValue,
      'max_tokens' => $maxTokens,
      'language' => $selectLanguage,
   ),
      array(
       'id'=>$id,
      ) 
    );

    echo "<script>location.reload();</script>";

  }

  if(!$results){ //INSERT
      $wpdb->insert( $tablename, array(
        'api_token' => $apiToken, 
        'temperature' => $temperatureValue,
        'max_tokens' => $maxTokens,
        'language' => $selectLanguage,
     ),
        array( '%s', '%s', '%s', '%s') 
     );

    echo "<script>location.reload();</script>";
  }


}



//Log function
//
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';

  if($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
  }

  echo $js_code;

}

//enqueue scripts
// function aicontent_script() {
//   wp_register_script('backend-scripts', AICONTENTT_PLUGIN_DIR . 'core/inlcudes/assets/js/backend-scripts.js');
//   wp_enqueue_script('backend-scripts');
// }
// add_action('wp_enqueue_scripts', 'aicontent_script');



?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=ai-content-tool-dashboard"><img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Navbar_Logo.png'; ?>" alt="AI Content Toolkit Logo" width="300" height="60">
	</a>
  </div>
</nav>

<!-- <div class="container px-5 my-5"> -->
<div class="container w-50 float-start px-5 my-5 bg-light border border-3 shadow p-3 rounded-4" id="settingsContainer"> 

  <!-- Heading -->
  <h1 class="display-3 mt-3 mb-3">AI Settings</h1>
  <div class="mt-3">
			<p><a href="https://www.toolkitsforsuccess.com/aicontenttoolkit" target="_blank" rel="noopener noreferrer"><b>CLICK HERE TO BUY THE PRO VERSION AND GET ACCESS TO 21 MORE TOOLS!</b></a></p>
	</div>
  <!-- License Key Form -->
  <form class="needs-validation" id="licenseForm" method="post" novalidate>

    <div class="mb-3">
      <label for="license_key" class="form-label" id="license_key_label"><b>License Key</b></label>
      <input class="form-control" type="text" id="license_key" name="license_key" value="<?php echo $license_key; ?>" placeholder="License Key" required/>
      <div class="invalid-feedback">License Key is required.</div>
    </div>
    <div class="mb-2 d-none" id="submitSuccessMessage">
      <div class="text-center text-success" class="form-label d-none" id="successLabel"><b>Enter License Key</b></label>
      </div>
    </div>
    <div class="d-none" id="submitErrorMessage">
        <div class="text-center text-danger mb-3">Error activating license!</div>
    </div>
        
    <div class="d-grid mb-5">
      <button type="submit" id="activate_license_btn" name="activate_license_btn" class="btn btn-primary "><?php echo $lang["activateLicense"]; ?>
        <span class="spinner-border spinner-border-sm" id="spinner-submit" role="status" aria-hidden="true" style="visibility: hidden"></span>
      </button>
      <button type="submit" id="deactivate_license_btn" name="deactivate_license_btn" class="btn btn-danger d-none"><?php echo $lang["deactivateLicense"]; ?>
        <span class="spinner-border spinner-border-sm" id="spinner-submit" role="status" aria-hidden="true" style="visibility: hidden"></span>
      </button>
    </div>
    <div class="d-none">
      <input type="hidden" id="ajaxurl" value="<?php echo esc_js(admin_url('admin-ajax.php')); ?>">
      <input type="hidden" id="currenturl" value="<?php echo home_url(add_query_arg(array(),$wp->request)); ?>">
      <input type="hidden" id="verified" value="<?php echo $verified; ?>">
    </div>
  </form>  

  <!-- Settings Form -->
  <form id="settingsForm" method="post">
    <!-- API Token -->
    <div class="mb-3">
      <label class="form-label"><b>ChatGPT API Token (sk-xxxxx):</b></label>
      <input class="form-control" type="text" id="apiToken" name="apiToken" value="<?php echo $getApiToken; ?>" placeholder="sk-"/>
      <a href="https://openai.com/api/" target="_blank" rel="noopener noreferrer"><btn btn-link class="mt-2">Get API Token</btn></a>
    </div>
    
    <div class="mb-3">
      <label class="form-label" id="temperatureTextValue"><b><?php echo $lang["temperature"]; ?><?php echo $getTemperature; ?></b></label><br>
      <input class="form-range" onchange="updateTemperature();" type="range" min="0" max="1" step="0.1" id="temperatureValue" name="temperatureValue" value="<?php echo $getTemperature; ?>">
      <p class=".5rem"><?php echo $lang["temperatureText"]; ?></p>
    </div>

    <div class="mb-3">
      <label class="form-label"><b><?php echo $lang["maxTokens"]; ?> (Maximum: 4000)</b></label>
      <input class="form-control" type="number" id="maxTokens" name="maxTokens" value="<?php echo $getMaxTokens; ?>"/>
      <p class=".5rem"><?php echo $lang["maxTokensText"]; ?></p>
    </div>
   
    <div class="mb-3">
      <label class="form-label"><b><?php echo $lang["selectLanguage"]; ?></b></label>
      <select class="form-select" name="selectLanguage" id="selectLanguage">
        <option value="en">English</option>
        <!-- <option value="tr">Türkçe</option> -->
      </select>
    </div>
    <div class="d-grid mb-5">
      <button class="btn btn-primary mb-5" type="submit" name="submit" ><?php echo $lang["saveSettings"]; ?></button>
    </div>
  </form>
</div>

<script>
function updateTemperature() {
  document.getElementById("temperatureTextValue").innerText = 'Temperature: ' + document.getElementById("temperatureValue").value
}

</script>