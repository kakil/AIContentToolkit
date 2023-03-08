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
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=ai-content-tool-dashboard"><img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Navbar_Logo.png'; ?>" alt="AI Content Toolkit Logo" width="300" height="60">
	</a>
  </div>
</nav>


<div class="container-fluid w-50 m-3 bg-light border border-3 shadow p-3 rounded-4"> 
  <h1 class="mt-5 mb-5">Chat With GPT Button Shortcode</h1>
  <form method="post" id="blogPostForm"  class="needs-validation" novalidate>

    <!-- Chat with gpt topic -->
    <div class="wysiwyg" data-mdb-wysiwyg="wysiwyg">
            <br />
            <p style="text-align: center;"><img
                src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Chat_With_GPT.png'; ?>" class="img-fluid">
            </p>
            <p style="text-align: center;">Chat With GPT</p>
            <p style="text-align: center;"><a href="https://toolkitsforsuccess.com" target="_blank" contenteditable="false"
                style="font-size: 1rem; text-align: left;">toolkitsforsuccess.com</a>&nbsp;© 2023</p>
            <p style="text-align: left;"><b>Use Chat With GPT On Your Website</b></p>
            <p>
              You can harness the power of ChatGPT 3.5 Turbo on your WordPress sites with this powerful shortcode.
              
            </p>
            <p>
              Looking to take your website's productivity to the next level? Look no further than ChatGPT! With our cutting-edge AI technology, you can easily generate top-notch content, receive helpful guidance, and enjoy constant, high-quality assistance that will help you boost your productivity by a whopping 100x!
              
            </p>
            <p>
              But that's not all – with ChatGPT, you can also ask any questions you have, no matter what the topic. Our AI is here to guide you through any challenge, big or small, and help you find the solutions you need. And speaking of solutions, ChatGPT delivers them instantly – you'll never have to wait around for answers again! So why wait? Try ChatGPT today and start enjoying the benefits of top-tier AI technology on your website.
              
            </p>
            <p>
              You select one of the shortcodes below that you can use to position your Chat With GPT button in any one of nine positions on your website.
              
            </p>
            <p style="text-align: left;"><b><u>List of Chat With GPT Shortcodes</u></b></p>
            <p><small>Copy a shortcode below and paste the code onto a post or page.</small>
              
            </p>
            
            <ul>
              <li>[chatgpt_button position="top-left"] </li>
              <li>[chatgpt_button position="top-center"] </li>
              <li>[chatgpt_button position="top-right"] </li>
              <li>[chatgpt_button position="middle-left"] </li>
              <li>[chatgpt_button position="middle-center"] </li>
              <li>[chatgpt_button position="middle-right"] </li>
              <li>[chatgpt_button position="bottom-left"] </li>
              <li>[chatgpt_button position="bottom-center"] </li>
              <li>[chatgpt_button position="bottom-right"] </li>
              
            </ul>
            <p><b>Examples:</b></p>
            <p style="text-align: center;"><img
                src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Plugin_Image_chatgpt-left-bottom.png'; ?>" class="img-fluid">
            </p>
            <!-- <p><b>Methods:</b></p> -->
           
          </div>
  </form>
</div>


