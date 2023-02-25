<?php

include "header.php";
$postContent = NULL;

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

/**
 * Prompt inspiration:
 * https://ed.codes/blog/chatgpt-for-blogging-seo-best-prompts-process
 */
if(isset($_POST["chatGptText"])){

  $postTitle = $_POST['chatGptText'];   //adding prompt to Blog Title field
  $postKeywords = $_POST['blogKeywordText'];  //adding prompt to Blog Keyword field
  $keyword = $_POST['chatGpt'];               //adding keyword back to Seed Keyword field

  
  $prompt = AICONTENTT()->helpers->get_long_tail_keyword_prompt( $_POST["chatGptText"], intVal($_POST["questionPromtValue"]));
  console_log($prompt);

  $postContent = AICONTENTT()->helpers->get_chatgpt_response( $prompt,'text-davinci-003', $getTemperature, $getMaxTokens);
  console_log($postContent);
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

<!-- <div id="spinner-div" class="pt-5">
<div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
    </div>
</div> -->

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=ai-content-tool-dashboard"><img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Navbar_Logo.png'; ?>" alt="AI Content Toolkit Logo" width="300" height="60">
	</a>
  </div>
</nav>

<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="mt-3 mb-3">Answer The People Keyword Tool</h1>
  <form method="post" id="blogPostForm" class="needs-validation" novalidate>
    <!-- Keyword -->
    <div class="mb-3">
      <label for="validationCustom01" class="form-label"><?php echo $lang["keywordTopic"]; ?></label>
      <input type="text" class="form-control" id="validationCustom1101" name="chatGptText" placeholder="Make Money Online" rows="3" min="0" max="80"  value="<?php echo isset($_POST['chatGptText']) ? $_POST['chatGptText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide a keyword
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div>

    <!-- Select A Question -->
    <div class="mb-3">
      <select class="form-select" aria-label="Default select example" name="questionPromtValue" id="validationCustom1102">
        <option selected>Select A Question</option>
        <option value="1">How</option>
        <option value="2">Who</option>
        <option value="3">What</option>
        <option value="4">When</option>
        <option value="5">Where</option>
        <option value="6">Why</option>
        <option value="7">Which</option>
        <option value="8">Will</option>
        <option value="9">Can</option>
        <option value="10">Are</option>
      </select>
      <input type="hidden" name="question" id="question_hidden">
      <div class="invalid-feedback">
        Please select a prompt or enter one below.
      </div>
    </div>

    <!-- Submit Content to OpenAPI -->
    <div class="row mb-5">
      <div class="col-sm-9">
        <button type="submit" name="goTest" class="btn btn-primary mb-3" id="btn-submit" ><?php echo $lang["testButton"]; ?>
        <span class="spinner-border spinner-border-sm" id="spinner-submit" role="status" aria-hidden="true" style="visibility: hidden"></span>
        </button>
        <button type="reset" value="Reset" class="btn btn-danger ms-2 mb-3" id="reset-submit-info">Reset</button>
      </div>
    </div>
  </form>

  <form method="POST" id="blogForm" class="needs-validation" novalidate>
    <!-- Blog Title -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["blogTitle"]; ?></label>
      <input type="text" name="postTitle" placeholder="How To Become An Affiliate Marketer" id="postTitle" class="form-control" value="<?php echo ucwords($postTitle); ?>"/>
    </div>

    <!-- Blog Content Response -->
    <div class="mb-3">
      <label  for="validationCustom04" class="form-label"><?php echo $lang["blogContent"]; ?></label>
      <textarea style="height:250px;" class="form-control" name="postContent" id="postContent" rows="3" oninput='this.style.height="";this.style.height=this.scrollHeight+3+"px"'  required><?php echo $postContent; ?></textarea>
      <small><?php echo $lang["blogContentDesc"]; ?></small>
      <div class="invalid-feedback">
        Please submit the form above first
      </div>
    </div>
    
    <!-- Blog Category -->
    <div class="mb-3">
      <label  class="form-label"><?php echo $lang["blogCategory"]; ?></label>
      <select name="postCategory" id="postCategory" class="form-select">
      <?php
        $categories = get_categories(array( 'hide_empty' => 0 ));
        foreach ($categories as $category) {
            echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
        }
      ?>
  </select>
    </div>

    <!-- Blog Keywords -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["blogKeywords"]; ?></label>
      <textarea class="form-control" name="postKeywords" placeholder="affiliate marketer, affiliate marketing, affiliate programs, etc..." id="postKeywords" rows="3" value="<?php echo ucwords($postKeywords); ?>"></textarea>
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


