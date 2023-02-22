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

  $TEXT = $_POST["chatGptText"];
  $postTitle = $_POST['chatGptText'];   //adding prompt to Blog Title field
  $postKeywords = $_POST['blogKeywordText'];  //adding prompt to Blog Keyword field

  $prompt = AICONTENTT()->helpers->get_advanced_blog_prompt( $_POST["chatGptText"], $_POST["blogNicheText"], $_POST["blogProblemText"], $_POST["blogActionText"], $_POST["blogToneText"], $_POST["blogKeywordText"]);
  $postTitle = $_POST['chatGptText'];   //adding prompt to Blog Title field
  //console_log($prompt);
  $postContent = AICONTENTT()->helpers->get_chatgpt_response( $prompt,'text-davinci-003', $getTemperature, $getMaxTokens);
  //console_log($postContent);

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
  $my_post['tags_input']  = $_POST["postKeywords"];;
  $my_post['post_status']   = 'publish';
  $my_post['post_author']   = 1;
  $my_post['post_category'] = array($_POST["postCategory"]);
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


<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="mt-5 mb-5">Create An Advanced Blog Post</h1>
  <form method="post" id="blogPostForm" class="needs-validation" novalidate>
    
    <!-- Blog Post Topic -->
    <div class="mb-3">
      <label for="validationCustom01" class="form-label"><?php echo $lang["blogTopic"]; ?></label>
      <input type="text" class="form-control" id="validationCustom01" name="chatGptText" placeholder="Dieting" rows="3" min="0" max="80" value="<?php echo isset($_POST['chatGptText']) ? $_POST['chatGptText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide a blog topic
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div>

    <!-- Niche -->
    <div class="mb-3">
      <label for="validationCustom02" class="form-label"><?php echo $lang["blogNiche"]; ?></label>
      <input type="text" class="form-control" id="validationCustom02" name="blogNicheText" placeholder="Weight Loss" rows="3" min="0" max="80" value="<?php echo isset($_POST['blogNicheText']) ? $_POST['blogNicheText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide a niche
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div>

    <!-- Problem -->
    <div class="mb-3">
      <label for="validationCustom03" class="form-label"><?php echo $lang["blogProblem"]; ?></label>
      <input type="text" class="form-control" id="validationCustom03" name="blogProblemText" placeholder="The most popular diets" rows="3" min="0" max="80" value="<?php echo isset($_POST['blogProblemText']) ? $_POST['blogProblemText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide a problem
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div>

    <!-- Action -->
    <div class="mb-3">
      <label for="validationCustom04" class="form-label"><?php echo $lang["blogAction"]; ?></label>
      <input type="text" class="form-control" id="validationCustom04" name="blogActionText" placeholder="Verb: choosing,buying,researching,learning,etc..." rows="3" min="0" max="80" value="<?php echo isset($_POST['blogActionText']) ? $_POST['blogActionText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide an action
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div>

    <!-- Tone -->
    <div class="mb-3">
      <label for="validationCustom06" class="form-label"><?php echo $lang["blogTone"]; ?></label>
      <input type="text" class="form-control" id="validationCustom06" name="blogToneText" placeholder="Tone: informal, helpful, persuasive, professional, authoritative, etc..." rows="3" min="0" max="80" value="<?php echo isset($_POST['blogToneText']) ? $_POST['blogToneText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide a tone
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div>

    <!-- Keywords -->
    <div class="mb-3">
      <label for="validationCustom07" class="form-label"><?php echo $lang["blogKeywords"]; ?></label>
      <input type="text" class="form-control" id="validationCustom07" name="blogKeywordText" placeholder="Keywords: weight loss, keto, vegan" rows="3" min="0" max="80" value="<?php echo isset($_POST['blogKeywordText']) ? $_POST['blogKeywordText'] : '' ?>" required>
      <div class="invalid-feedback">
        Please provide at least one keyword
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/80</label>
    </div>

    <!-- Submit Content to OpenAPI -->
    <div class="row mb-5">
      <div class="col-sm-9">
        <button type="submit" name="goTest" class="btn btn-primary mb-3" id="btn-submit"><?php echo $lang["testButton"]; ?>
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
      <label class="form-label"><?php echo $lang["blogContent"]; ?></label>
      <textarea style="height:250px;" class="form-control" name="postContent" id="postContent" rows="3" oninput='this.style.height="";this.style.height=this.scrollHeight+3+"px"' required><?php echo $postContent; ?></textarea>
      <small><?php echo $lang["blogContentDesc"]; ?></small>
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
  <br/>
  <br/>
</div>


