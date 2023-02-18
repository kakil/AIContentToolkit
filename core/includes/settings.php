<?php
error_reporting(0);
include "header.php";

global $wpdb;
$tablename = $wpdb->prefix.'ai_content_tool';

$sql = "SELECT * FROM $tablename";
$results = $wpdb->get_results($sql);
$getApiToken = $results[0]->api_token;
$getTemperature = $results[0]->temperature;
$getMaxTokens = $results[0]->max_tokens;
$getLanguage = $results[0]->language;


$languages = array("tr","en");
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

?>
<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="display-2 mt-3 mb-3">AI Settings</h1>
  <form method="post">
    <div class="mb-5">
      <label class="form-label"><b>ChatGPT API Token (sk-xxxxx):</label>
      <input type="text" id="apiToken" name="apiToken" class="form-control" value="<?php echo $getApiToken; ?>"/>
    </div>
    
    <div class="mb-3">
    <label class="form-label"><?php echo $lang["temperature"]; ?><b id="temperatureTextValue"><?php echo $getTemperature; ?></b></label><br>
    <small><?php echo $lang["temperatureText"]; ?></small>
    <input onchange="updateTemperature();" type="range" class="form-range" min="0" max="1" step="0.1" id="temperatureValue" name="temperatureValue" value="<?php echo $getTemperature; ?>">
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