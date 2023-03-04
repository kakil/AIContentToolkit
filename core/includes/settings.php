<?php
error_reporting(0);
include "header.php";

include AICONTENTT_PLUGIN_DIR . "/core/includes/classes/class-ai-content-toolkit-license.php";

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


<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="display-3 mt-3 mb-3">AI Settings</h1>
  <form method="post">
    <div class="mb-5">
      <label class="form-label" id="license_key_label"><b>License Key</label>
      <input type="text" id="license_key" name="license_key" value="<?php echo get_option('license_key'); ?>" />
      <button type="button" id="activate_license_btn" name="activate_license_btn" class="btn btn-primary "><?php echo $lang["activateLicense"]; ?></button>
      <input type="hidden" id="ajaxurl" value="<?php echo esc_js(admin_url('admin-ajax.php')); ?>">
      <input type="hidden" id="currenturl" value="<?php echo home_url(add_query_arg(array(),$wp->request)); ?>">
    <div>
    <div class="mb-5">
      <label class="form-label"><b>ChatGPT API Token (sk-xxxxx):</label>
      <input type="text" id="apiToken" name="apiToken" class="form-control" value="<?php echo $getApiToken; ?>" placeholder="sk-"/>
      <a href="https://openai.com/api/" target="_blank" rel="noopener noreferrer"><btn btn-link class="mt-2">Get API Token</btn></a>
    </div>
    
    <div class="mb-5">
    <label class="form-label"><?php echo $lang["temperature"]; ?><b id="temperatureTextValue"><?php echo $getTemperature; ?></b></label><br>
    <input onchange="updateTemperature();" type="range" class="form-range" min="0" max="1" step="0.1" id="temperatureValue" name="temperatureValue" value="<?php echo $getTemperature; ?>">
    <small><?php echo $lang["temperatureText"]; ?></small>

  </div>

    <div class="mb-5">
      <label class="form-label"><?php echo $lang["maxTokens"]; ?> (Maximum: 4000)</label>
      <input type="number" id="maxTokens" name="maxTokens" class="form-control" value="<?php echo $getMaxTokens; ?>"/>
      <small><?php echo $lang["maxTokensText"]; ?></small>
    </div>
   
    <div class="mb-5">
      <label class="form-label"><?php echo $lang["selectLanguage"]; ?></label>
      <select name="selectLanguage" id="selectLanguage" class="form-select">
        <option value="en">English</option>
        <!-- <option value="tr">Türkçe</option> -->
      </select>
    </div>
    
    <button type="submit" name="submit" class="btn btn-primary mb-5"><?php echo $lang["saveSettings"]; ?></button>
  </form>
</div>

<script>
function updateTemperature() {
  document.getElementById("temperatureTextValue").innerText = document.getElementById("temperatureValue").value
}

</script>