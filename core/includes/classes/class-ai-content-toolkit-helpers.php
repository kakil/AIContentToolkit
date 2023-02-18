<?php
include_once( ABSPATH . 'wp-admin/includes/admin.php' );

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class AI_Content_Toolkit_Helpers
 *
 * This class contains repetitive functions that
 * are used globally within the plugin.
 *
 * @package		AICONTENTT
 * @subpackage	Classes/AI_Content_Toolkit_Helpers
 * @author		Kitwana Akil
 * @since		0.5.0
 */
class AI_Content_Toolkit_Helpers{

	/**
	 * ######################
	 * ###
	 * #### CALLABLE FUNCTIONS
	 * ###
	 * ######################
	 */

	/**
	 * HELPER COMMENT START
	 *
	 * Within this class, you can define common functions that you are 
	 * going to use throughout the whole plugin. 
	 * 
	 * Down below you will find a demo function called output_text()
	 * To access this function from any other class, you can call it as followed:
	 * 
	 * AICONTENTT()->helpers->output_text( 'my text' );
	 * 
	 */

	 //global $wpdb;
	 private $postContent = NULL;
	 
	/**
	 * Output some text
	 *
	 * @param	string	$text	The text to output
	 * @since	0.5.0
	 *
	 * @return	void
	 */
	 public function output_text( $text = '' ){
		// echo $text;
	 }

	 /**
	  * @param 	string $prompt
	  * @since 	0.5.0
	  * 
	  * @return string
	  */

	/**
	 * Prompts
	 */
	
	 public function get_blog_prompt($topic, $niche, $problem, $action, $tone, $keywords ) {
		$prompt = 'I want you to act as a blogger and ' . $topic . ' expert.  You are writing a blog post for your ' . $niche . ' blog.  The topic of the post will be ' . $problem . '.  This post should be helpful for people ' . $action . '. The length of the blog post will be 400 to 600 words.  The tone will be ' . $tone . '.  You should be writing as an individual blogger with a personal approach so do not use plural first-person to refer to yourself.  Only use singular first-person.  Do not use passive voice. I want you to include these keywords: ' . $keywords . 'H2 tag for the title. H3 tags for the section titles.';

		return $prompt;
	}

	public function get_blog_post_outline_prompt($topic, $personality) {
		$prompt = 'I want you to act as a blogger and ' . $topic . ' expert.  Please create a blog post outline for the topic: ' . $topic . '. The outline should have five sections including an introduction and a conclusion. Your tone is ' . $personality;
		return $prompt;
	}

	public function get_brainstorm_prompt($topic) {
		$prompt = 'Please write 10 article title ideas and 10 alternative title ideas for ' . $topic;
		return $prompt;
	}

	 public function get_mindmap_prompt($topic) {
		$prompt = 'Please create a mind map for the topic: ' . $topic . ' and include the central idea, main branches, and sub-branches.';
		return $prompt;
	}

	public function get_keywords_prompt($topic) {
		$prompt = 'Provide 25 long tail keywords related to ' . $topic . '.  Match each keyword with any of the 4 types of search intent.  Cluster the list of keywords according to funnel stages whether they are top of the funnel, middle of the funnel, or bottom of the funnel keywords.';
		return $prompt;
	}

	public function get_how_to_prompt($topic, $niche, $tone ) {
		$prompt = 'I want you to act as a blogger and ' . $topic . ' expert. You are writing a blog post for your ' . $niche . ' blog. You are writing a How To blog post for ' . $topic . '. This post should be helpful for people researching ' . $topic . '. The blog post title will start with: How To, and the title will be 60 characters or less in length.  The next section will be titled: What is ' . $topic . ', and Why Does It Matter? The next section will be titled: How to ' . $topic . '. The next section will be: 10 Tips and Reminders for ' . $topic . '. The next section will be the Conclusion. The tone will be ' . $tone . '. You should be writing as an individual blogger with a personal approach so do not use plural first-person to refer to yourself. Only use singular first-person. Do not use passive voice. H2 tag for the title. H3 tags for the section titles.';
		return $prompt;
	}

	public function get_list_prompt($topic, $niche) {
		$prompt = 'I want you to act as a blogger and ' . $topic . ' expert. You are writing a list blog post for your ' . $niche . ' blog. Create an appropriate article title. The first section will be an Introduction. The introduction will highlight why ' . $topic . ' is important, who ' . $topic . ' applies to, and what the article covers. The next section will disscuss why understanding ' . $topic . ' is important. The next section will be a list of at least 10 examples of ' . $topic . ' and each example will be briefly discussed. The final section will be a conclusion.  You will be writing as an individual blogger with a personal approach so do not use plural first-person to refer to yourself. Only use singular first-person. Do not use passive voice. H2 tag for title. H3 tags for the section titles.';
		return $prompt;
	}

	public function get_astrology_prompt($topic, $dateOfBirth, $timeOfBirth, $birthPlace) {
		$prompt = 'I want you to act as an astrologer. You will learn about the zodiac signs and their meanings, understand planetary positions and how they affect human lives, be able to interpret horoscopes accurately, and share your insights with those seeking guidance or advice. My request is: I need help providing an in-depth reading. I am interested in ' . $topic . ' based on my birth chart. I was born on ' . $dateOfBirth . ' at ' . $timeOfBirth . ' in ' . $birthPlace;
		return $prompt;
	}

	public function get_video_script_prompt($topic, $tone) {
		$prompt = 'You are a professional copywriter and YouTube expert.  Write a YouTube shorts script explaining ' . $topic . '. This video will be no longer than 60 seconds. Please be ' . $tone . '.';
		return $prompt;
	}

	public function get_long_tail_keyword_prompt($topic) {
		$prompt = 'give me a list of long tail keywords that contain the phrase: ' . $topic . '. The first list should be a list of why ' . $topic . '. The second list should be how to ' . $topic . '. The third list should be who ' . $topic . '. The fourth list should be what ' . $topic . '. The fifth list should be when ' . $topic . '. The sixth list should be where ' . $topic . '.' ;
		return $prompt;
	}

	public function get_images_prompt($imagePrompt, $promptNumber) {
		if($promptNumber == 1) {
			$imagePrompt = 'illustration of a puppy, modern design, cute, happy, 4k, high resolution, trending in deviantart';
		} else if($promptNumber == 2) {
			$imagePrompt = 'A beautiful young African-American dieselpunk policewoman | | fine-face, handsome face, realistic shaded Perfect face, fine details. Anime. realistic shaded lighting poster by Ilya Kuvshinov katsuhiro otomo ghost-in-the-shell, magali villeneuve, artgerm, Jeremy Lipkin and Michael Garmash and Rob Rey';
		} else {
			$imagePrompt = 'Mid-west USA, neighborhood, sleepy street, Thomas Kinkade oil painting, high resolution, 4k';
		}
		return $imagePrompt; 
	}

	/**
	 * end of prompts
	 */

	  public function get_chatgpt_response( $prompt, $model, $temperature, $maxTokens) {

		
		global $wpdb;
		$tableName = $wpdb->prefix.'ai_content_tool';
		$sql = "SELECT * FROM $tableName";

		$results = $wpdb->get_results($sql);
		$getApiToken = $results[0]->api_token;
		$getTemperature = intval($results[0]->temperature);
		$getMaxTokens = intval($results[0]->max_tokens);
		$getLanguage = $results[0]->language;
		
		$languages = array("en");
		if(in_array($getLanguage,$languages)) {
			include AICONTENTT_PLUGIN_DIR . "/languages/".$getLanguage.".php";
		} else {
		  include AICONTENTT_PLUGIN_DIR . "/languages/en.php";
		}

		if(isset($_POST['goTest'])){
			//$TEXT = $_POST["chatGptText"];
			$TEXT = $prompt;
			$header = array(
			  'Authorization: Bearer '.$getApiToken,
			  'Content-type: application/json; charset=utf-8',
			);
			$params = json_encode(array(
			  'prompt'					=> $TEXT,
			  'model'					=> 'text-davinci-003',
			  'temperature'				=> $getTemperature,
			  'max_tokens' 				=> $getMaxTokens,
			  'number_of_completions'	=> 1,
			));
			$curl = curl_init('https://api.openai.com/v1/completions');
			$options = array(
				CURLOPT_POST => true,
				CURLOPT_HTTPHEADER =>$header,
				CURLOPT_POSTFIELDS => $params,
				CURLOPT_RETURNTRANSFER => true,
			);
			curl_setopt_array($curl, $options);
			$response = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

			// echo "<script>";
			// echo "$(function() {";
			// echo "stopSpinner();";
			// echo "});";
			// echo "</script>";
			

			if(200 == $httpcode){
			  $json_array = json_decode($response, true);
			  $choices = $json_array['choices'];
			  return $postContent = $choices[0]["text"];
			} else {
				return $postContent = "No Results";
			}
		}
	  }


	  /**
	   * Get OpenAI Image Response
	   */

	  public function get_chatgpt_image_response( $prompt, $numberOfImages, $sizeOfImages) {

		
		global $wpdb;
		$tableName = $wpdb->prefix.'ai_content_tool';
		$sql = "SELECT * FROM $tableName";

		$results = $wpdb->get_results($sql);
		$getApiToken = $results[0]->api_token;
		
		if(isset($_POST['goTest'])){
			//$TEXT = $_POST["chatGptText"];
			$TEXT = $prompt;
			$header = array(
			  'Authorization: Bearer '.$getApiToken,
			  'Content-type: application/json',
			);
			$params = json_encode(array(
			  'prompt'		=> $prompt,
			  'n'			=> (int)$numberOfImages,
			  'size'		=> $sizeOfImages,
			  
			));
			$curl = curl_init('https://api.openai.com/v1/images/generations');
			$options = array(
				CURLOPT_POST => true,
				CURLOPT_HTTPHEADER =>$header,
				CURLOPT_POSTFIELDS => $params,
				CURLOPT_RETURNTRANSFER => true,
			);
			curl_setopt_array($curl, $options);
			$response = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

			// echo "<script>";
			// echo "$(function() {";
			// echo "stopSpinner();";
			// echo "});";
			// echo "</script>";
			
			//console_log('Server Response: ' . $httpcode);
			if(200 == $httpcode){
				//console_log('RESPONSE: ' . $response);
			  $json_array = json_decode($response, true);
			  $data_array = $json_array['data'];
			  return $data_array;
			} else {
				return null;
			}
		}
	  }

	  function console_log($output, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
	  
		if($with_script_tags) {
		  $js_code = '<script>' . $js_code . '</script>';
		}
	  
		echo $js_code;
	  
	  }
	  
	  /**
	   *  CODE TO UPLOAD URLs TO MEDIA LIBRARY
	   * 
	   */
	  function rudr_upload_file_by_url( $image_url, $imageName ) {
		console_log($image_url);

		// it allows us to use download_url() and wp_handle_sideload() functions
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		
		/**
		 * This line is a temp fix for the error:  
		 * SIDELOAD ERROR = Sorry, you are not allowed to upload this file type.
		 */
		define('ALLOW_UNFILTERED_UPLOADS', true);

		// download to temp dir
		$temp_file = download_url( $image_url );
	
		if( is_wp_error( $temp_file ) ) {
			console_log('TEMP FILE ERROR');
		return false;
		}
	
		// move the temp file into the uploads directory
		$file = array(
			'name'     => basename( $image_url ),
			'type'     => mime_content_type( $temp_file ),
			'tmp_name' => $temp_file,
			'size'     => filesize( $temp_file ),
		);
		$sideload = wp_handle_sideload(
			$file,
			array(
				'test_form'   => false // no needs to check 'action' parameter
			)
		);
	
		if( ! empty( $sideload[ 'error' ] ) ) {
			// you may return error message if you want
			console_log('SIDELOAD ERROR = ' . $sideload[ 'error' ]);
			return false;
		}
	
		// it is time to add our uploaded image into WordPress media library
		$attachment_id = wp_insert_attachment(
			array(
				'guid'           => $sideload[ 'url' ],
				'post_mime_type' => $sideload[ 'type' ],
				'post_title'     => basename( $sideload[ 'file' ]),
				'post_content'   => '',
				'post_status'    => 'inherit',
			),
			$sideload[ 'file' ]
		);
	
		if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
			console_log('ATTACHMENT ERROR: ' . $attachment_id);
			
			return false;
		}
	
		// update medatata, regenerate image sizes
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
	
		wp_update_attachment_metadata(
			$attachment_id,
			wp_generate_attachment_metadata( $attachment_id, $sideload[ 'file' ] )
		);
		$image_url = NULL;
		return $attachment_id;
	
	}
	  
	  

	 /**
	  * HELPER COMMENT END
	  */

}
