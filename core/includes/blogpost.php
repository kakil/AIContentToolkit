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
$model = 'text-davinci-003';

$languages = array("tr","en");
if(in_array($getLanguage,$languages)) {
    include AICONTENTT_PLUGIN_DIR . "/languages/".$getLanguage.".php";
} else {
  include AICONTENTT_PLUGIN_DIR . "/languages/en.php";
}


if(isset($_POST["chatGptText"])){

  $TEXT = $_POST["chatGptText"];

  $postTitle = $_POST['chatGptText'];   //adding prompt to Blog Title field;

  $prompt = AICONTENTT()->helpers->get_blog_prompt($TEXT);
  $postContent = AICONTENTT()->helpers->get_chatgpt_response($prompt, $model, $getTemperature, $getMaxTokens);

  // Replace multiple spaces of all positions (deal with linebreaks) with single linebreak
  $postContent = preg_replace('/\s{3,}/', "\n", $postContent); 

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

?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=ai-content-tool-dashboard"><img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Navbar_Logo.png'; ?>" alt="AI Content Toolkit Logo" width="300" height="60">
	</a>
  </div>
</nav>

<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="mt-5 mb-5">Create A Blog Post</h1>
  <form method="post" id="blogPostForm" class="needs-validation" novalidate>

    <!-- Topic -->
    <div class="mb-3">
      <label for="validationCustom101" class="form-label"><?php echo $lang["blogTitle"]; ?></label>
      <textarea class="form-control" id="validationCustom101" name="chatGptText" placeholder="Niche topic or keyword.  For  example: Affiliate Marketing, Traffic Generation, etc..." rows="3" min="0" max="200" value="<?php echo isset($_POST['chatGptText']) ? $_POST['chatGptText'] : '' ?>" required></textarea>
      <div class="invalid-feedback">
        Please provide a blog topic
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <label for="decimal_input">0/200</label>
    </div>

    <!-- Get OpenAI Response -->
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
    <!-- Blog Post Title -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["blogTitle"]; ?></label>
      <input type="text" name="postTitle" placeholder="How To Become An Affiliate Marketer" id="postTitle" class="form-control" value="<?php echo ucwords($postTitle); ?>"/>
    </div>

    <!-- Blog Post Content -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["blogContent"]; ?></label>
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

    <!-- Blog Keywords -->
    <div class="mb-3">
      <label class="form-label"><?php echo $lang["blogKeywords"]; ?></label>
      <textarea class="form-control" name="postKeywords" placeholder="affiliate marketer, affiliate marketing, affiliate programs, etc..." id="postKeywords" rows="3"></textarea>
    </div>

    <!-- Submit Blog Post -->
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

