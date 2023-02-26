<?php

include "header.php";
$postContent = NULL;
$postTitle = NULL;

global $wpdb;
$tablename = $wpdb->prefix.'ai_content_tool';
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


if(isset($_POST["chatGptText"])){
  
  //old prompt code
  //$TEXT = "Topic: " . $postTitle . ". Create a mind map or outline on the topic. The mind map should have a list of the central idea, main branches, and a sub-branch for each main branch.  List some details for each sub-branch";
  //echo "<script> alert('.$TEXT'); </script>";  //testing prompt

  $postTitle = $_POST['chatGptText'];   //adding prompt to Blog Title field
  $prompt = AICONTENTT()->helpers->get_mindmap_prompt( $_POST['chatGptText'] );
  $postContent = AICONTENTT()->helpers->get_chatgpt_response( $prompt, 'text-davinci-003', $getTemperature, $getMaxTokens);

  // Replace multiple spaces of all positions (deal with linebreaks) with single linebreak
  $postContent = preg_replace('/\s{2,}/', "\n", $postContent); 

  //place a newline character before "##"
  $pattern = '/\n?(?=##)/';
  $replacement = "\n";
  $postContent = preg_replace($pattern, $replacement, $postContent);


}


if(isset($_POST["addBlog"])){
  $my_post = array();
  $my_post['post_title']    = $_POST["postTitle"];
  $my_post['post_content']  = $_POST["postContent"];
  $my_post['post_status']   = 'publish';
  $my_post['tags_input']  = $_POST["postKeywords"];;
  $my_post['post_author']   = 1;
  $my_post['post_category'] = array($_POST["postCategory"]);
  // Insert the post into the database
  wp_insert_post( $my_post );
}


?>

<!-- <div id="spinner-div" class="pt-5">
    <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
    </div>
</div> -->

<div class="container-fluid bg-light border border-3 shadow p-3 rounded-4"> 
  <form method="post" id="blogPostForm"  class="needs-validation" novalidate>

    <!-- Topic -->
    <div class="mb-3">
      <input type="text" class="form-control" id="validationCustom01" name="chatGptText" placeholder="Popular Diets" rows="3" min="0" max="80" value="<?php echo isset($_POST['chatGptText']) ? $_POST['chatGptText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide a mind map topic
      </div>
    </div>
    <!--<div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div> -->

    <!-- Submit to OpenAI -->
    <div class="row mb-5">
       <div class="col-sm-9">
        <button type="submit" name="goTest" class="btn btn-primary btn-small mb-2" id="btn-submit-modal"><?php echo $lang["mindmapButton"]; ?>
          <span class="spinner-border spinner-border-sm" id="spinner-submit" role="status" aria-hidden="true" style="visibility: hidden"></span>
        </button>
        <!-- <button type="reset" value="Reset" class="btn btn-danger ms-2 mb-3" id="reset-submit-info">Reset</button> -->
       </div>
     </div>
</form>

<form method="POST" id="blogForm" class="needs-validation" novalidate>
    <!-- Mind Map Content Response -->
    <div class="mb-3">
      <!-- <label class="form-label"><?php echo $lang["mindmapList"]; ?></label> -->
      <textarea style="height:100px;" class="form-control fs-6" name="postContent" id="postContent" rows="3" oninput='this.style.height="";this.style.height=this.scrollHeight+3+"px"' required><?php echo $postContent; ?></textarea>
      <div class="invalid-feedback">
         Please submit the form above first
      </div>
    </div>
    
  </form>
</div>

