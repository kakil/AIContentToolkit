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
  
  $postTitle = $_POST['chatGptText'];   //adding prompt to Blog Title field

  AICONTENTT()->helpers->console_log('Keyword: ' . $postTitle);
  $prompt = AICONTENTT()->helpers->get_brainstorm_prompt( $postTitle );
  AICONTENTT()->helpers->console_log('prompt: ' . $prompt);
  $postContent = AICONTENTT()->helpers->get_chatgpt_response( $prompt, 'text-davinci-003', $getTemperature, $getMaxTokens);

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


<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="mt-5 mb-5">Brainstorm Topics</h1>
  <form method="post" id="blogPostForm"  class="needs-validation" novalidate>

    <!-- Brainstorming topic -->
    <div class="mb-3">
      <label for="validationCustom301" class="form-label"><?php echo $lang["brainstormingTopic"]; ?></label>
      <input type="text" class="form-control" id="validationCustom301" name="chatGptText" placeholder="[Keyword] For example: Facebook Ads" rows="3" min="0" max="80" value="<?php echo isset($_POST['chatGptText']) ? $_POST['chatGptText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide a brainstorming topic
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div>

    <!-- Submit Content to OpenAI API -->
    <div class="row mb-5">
       <div class="col-sm-9">
         <button type="submit" name="goTest" class="btn btn-primary mb-3" id="btn-submit"><?php echo $lang["brainstormButton"]; ?>
          <span class="spinner-border spinner-border-sm" id="spinner-submit" role="status" aria-hidden="true" style="visibility: hidden"></span>
         </button>
         <button type="reset" value="Reset" class="btn btn-danger ms-2 mb-3" id="reset-submit-info">Reset</button>
       </div>
     </div>
  </form>

  <form method="POST" id="blogForm" class="needs-validation" novalidate>

    <!-- Title -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["blogTitle"]; ?></label>
      <input type="text" name="postTitle" placeholder="How To Create Effective Facebook Ads" id="postTitle" class="form-control" value="<?php echo ucwords($postTitle); ?>"/>
    </div>

    <!-- Brainstorming Content -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["brainstormIdeas"]; ?></label>
      <textarea style="height:250px;" class="form-control" name="postContent" id="postContent" rows="3" oninput='this.style.height="";this.style.height=this.scrollHeight+3+"px"' required><?php echo $postContent; ?></textarea>
      <small><?php echo $lang["blogContentDesc"]; ?></small>
      <div class="invalid-feedback">
        Please submit the form above first
      </div>
    </div>

    <!-- Blog Category -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["blogCategory"]; ?></label>
      <select name="postCategory" id="postCategory" class="form-select">
      <?php
        $categories = get_categories(array( 'hide_empty' => 0 ));
        foreach ($categories as $category) {
            echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
        }
      ?>
    </select>
    </div>

    <!-- Keywords -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["blogKeywords"]; ?></label>
      <textarea class="form-control" name="postKeywords" placeholder="affiliate marketer, affiliate marketing, affiliate programs, etc..." id="postKeywords" rows="3"></textarea>
    </div>

    <!-- Submit Content to Blog -->
    <div class="row mb-5">
       <div class="col-sm-9">
         <button type="submit" name="addBlog" class="btn btn-success mb-3" id="blog-submit"><?php echo $lang["addBlogButton"]; ?>
          <span class="spinner-border spinner-border-sm" id="spinner-blog-submit" role="status" aria-hidden="true" style="visibility: hidden"></span>
         </button>
         <button type="reset" value="Reset" class="btn btn-danger ms-2 mb-3" id="reset-submit-blog">Reset</button>
       </div>
     </div>
  </form>
</div>


