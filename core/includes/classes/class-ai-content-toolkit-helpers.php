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
	
	 public function get_blog_prompt($topic) {
		$prompt = 'Please write a structured markdown blog post in a press release style like an experienced news reporter in English for the Keyword ' . $topic . ' e. The article should include Creative Title, SEO meta description, Introduction, headings, sub headings, bullet points or Numbered list if needed, frequently asked questions and conclusion. The post should not be less than 1200 words. Do not change the original keyword while writing the Title. Use the keyword at least 2-3 times in the text body.';
		return $prompt;
	}

	public function get_blog_post_outline_prompt($topic, $personality) {
		$prompt = 'You will act as a Content and Digital Marketing Strategist expert. You have strong writing and editing skills and are able to create compelling, high-quality content that resonates with the target audience. You are an outstanding strategic thinker. You are able to think critically and strategically about our overall content and digital marketing goals, and how to achieve them. You have a deep understanding of SEO best practices, as well as an understanding of the various digital marketing channels and how to leverage them effectively. Write a detailed structured markdown outline for a blog article. The article topic is "' . $topic . '". Use this tone: "' . $personality . '".  Keep each item on a separate line.';
		return $prompt;
	}

	public function get_brainstorm_prompt($topic) {
		//$prompt = 'Please write 10 article title ideas and 10 alternative title ideas for ' . $topic;
		$prompt = 'You will act as a Content and Digital Marketing Strategist expert. You have strong writing and editing skills and are able to create compelling, high-quality content that resonates with the target audience. You are an outstanding strategic thinker. You are able to think critically and strategically about our overall content and digital marketing goals, and how to achieve them. You have a deep understanding of SEO best practices, as well as an understanding of the various digital marketing channels and how to leverage them effectively. You have a strong understanding of branding and marketing principles. You are extremely creative and are able to think outside the box and come up with unique and innovative ideas for content. You have a passion for learning and staying up to date with the latest trends and developments. Create a structured markdown article that Brainstorms new angles and a approaches and prioritize ideas that are uncommon or novel for the following: ' . $topic . '.';
		return $prompt;
	}

	 public function get_mindmap_prompt($topic) {
		$prompt = 'Please create a structured markdown mind-map for the topic: ' . $topic . ' and include the central idea, main branches, and sub-branches.  The mind-map should have at least 3 subitems under each item. The main branches and sub-branches should be formatted with markdown headers.';
		return $prompt;
	}

	public function get_advanced_blog_prompt( $topic, $niche, $problem, $action, $tone, $keywords) {
		$prompt = 'Please write a structured markdown blog post in a press release style like an experienced news reporter in English for the Keyword ' . $topic . '. The article should include Creative Title, SEO meta description, Introduction, headings, sub headings, bullet points or Numbered list if needed, frequently asked questions and conclusion. The post should not be less than 1200 words. Do not change the original keyword while writing the Title. Use the keyword at least 2-3 times in the text body. The niche is "' . $niche . '". The problem is "' . $problem . '". The tone is "' . $tone . '". The keywords are "' . $keywords . '"';
		return $prompt;
	}


	public function get_keywords_prompt($topic) {
		$prompt = 'Create a structured markdown article Provide 25 long tail keywords related to ' . $topic . '.  Match each keyword with any of the 4 types of search intent.  Cluster the list of keywords according to funnel stages whether they are top of the funnel, middle of the funnel, or bottom of the funnel keywords. Each funnel stage should be formatted as a header.';
		return $prompt;
	}

	public function get_how_to_prompt($topic, $tone ) {
		// $prompt = 'I want you to act as a Content and ' . $topic . ' expert. You are writing a blog post for your ' . $niche . ' blog. You are writing a How To blog post for ' . $topic . '. This post should be helpful for people researching ' . $topic . '. The blog post title will start with: How To, and the title will be 60 characters or less in length.  The next section will be titled: What is ' . $topic . ', and Why Does It Matter? The next section will be titled: How to ' . $topic . '. The next section will be: 10 Tips and Reminders for ' . $topic . '. The next section will be the Conclusion. The tone will be ' . $tone . '. You should be writing as an individual blogger with a personal approach so do not use plural first-person to refer to yourself. Only use singular first-person. Do not use passive voice. H2 tag for the title. H3 tags for the section titles.';
		$prompt = 'You will act as a Content and Digital Marketing Strategist expert.  Create detailed "How To" article for ' . $topic . '. You will Include top-level keywords and long-tail keywords.  Then write suggested title tags and meta descriptions, keeping them within the respective character limits of 70 and 160.  Put all this content into a structured blog post.  Your tone is ' . $tone . '.';
		return $prompt;
	}

	public function get_list_prompt($topic) {
		//$prompt = 'I want you to act as a blogger and ' . $topic . ' expert. You are writing a list blog post for your ' . $niche . ' blog. Create an appropriate article title. The first section will be an Introduction. The introduction will highlight why ' . $topic . ' is important, who ' . $topic . ' applies to, and what the article covers. The next section will disscuss why understanding ' . $topic . ' is important. The next section will be a list of at least 10 examples of ' . $topic . ' and each example will be briefly discussed. The final section will be a conclusion.  You will be writing as an individual blogger with a personal approach so do not use plural first-person to refer to yourself. Only use singular first-person. Do not use passive voice. H2 tag for title. H3 tags for the section titles.';
		$prompt = 'You will act as a Content and Digital Marketing Strategist expert.  Create a detailed "List" article for ' . $topic . '. You will include top-level keywords and long-tail keywords.  Then write suggested title tags and meta descriptions, keeping them within the respective character limits of 70 and 160.  Put all this content into a structured blog post.';
		return $prompt;
	}

	public function get_astrology_prompt($topic, $dateOfBirth, $timeOfBirth, $birthPlace) {
		$prompt = 'I want you to act as an astrologer. You will learn about the zodiac signs and their meanings, understand planetary positions and how they affect human lives, be able to interpret horoscopes accurately, and share your insights with those seeking guidance or advice. My request is: I need help providing an in-depth reading. I am interested in ' . $topic . ' based on my birth chart. I was born on ' . $dateOfBirth . ' at ' . $timeOfBirth . ' in ' . $birthPlace;
		return $prompt;
	}

	public function get_video_script_prompt($topic, $tone) {
		//$prompt = 'You are a professional copywriter and YouTube expert.  Write a YouTube shorts script explaining ' . $topic . '. This video will be no longer than 60 seconds. Please be ' . $tone . '.';
		//$prompt = 'You are a professional copywriter and YouTube expert.  Create a compelling and captivating YouTube video script from the following description: '. $topic . '. You will use the following tone: ' . $tone . '.';
		$prompt = 'You act as a very proficient SEO and high-end copy writer that speaks and writes fluently English. Provide me content for a YouTube Script for the topic: ' . $topic . '. There must be an intro, body, and conclusion part. The body must contain 5 segments, and each segment must be of 200 words in length. The script length must be 700 words. If there is a subheading, then change them into bold characters. The tone is ' . $tone . '. At the end of the result show this line “Please, checkout  https://toolkitsforsuccess.com  for more tools and content."';
		return $prompt;
	}

	public function get_long_tail_keyword_prompt($keyword, $question) {
		// $prompt = 'give me a list of long tail keywords that contain the phrase: ' . $topic . '. The first list should be a list of why ' . $topic . '. The second list should be how to ' . $topic . '. The third list should be who ' . $topic . '. The fourth list should be what ' . $topic . '. The fifth list should be when ' . $topic . '. The sixth list should be where ' . $topic . '.' ;

		$prompt = 'I want you to act as a very proficient SEO and most powerful SEO Audit and Keyword Explorer tools that speak and write so well in English.  I want you to ';
		if($question == 1) {
			$prompt = $prompt . 'create a list of question keywords that use or imply the adverb "how" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword.';
		} else if($question == 2) {
			$prompt = $prompt . 'create a list of question keywords that use or imply the pronoun "who" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword.';
		} else if($question == 3) {
			$prompt = $prompt . 'create a list of question keywords that use or imply the pronoun "what" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword. Do not use the following words: how, who, when, where, why, which, will, can';
		} else if($question == 4) {
			$prompt = $prompt . 'create a list of question keywords that use or imply the adverb "when" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword. Do not use the following words: how, who, what, where, why, which, will, can';
		} else if($question == 5) {
			$prompt = $prompt . 'create a list of question keywords that use or imply the adverb "where" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword. Do not use the following words: how, who, what, when, why, which, will, can';
		} else if($question == 6) {
			$prompt = $prompt . 'create a list of question keywords that use or imply the adverb "why" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword. Do not use the following words: how, who, what, when, where, which, will, can';
		} else if($question == 7) { 
            $prompt = $prompt . 'create a list of question keywords that use or imply the pronoun "which" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword. Do not use the following words: how, who, what, when, where, why, will, can';
        } else if($question == 8) { 
            $prompt = $prompt . 'create a list of question keywords that use or imply the verb "will" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword. Do not use the following words: how, who, what, when, where, why, which, can';
        } else if($question == 9) { 
            $prompt = $prompt . 'create a list of question keywords that use or imply the verb "can" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword. Do not use the following words: how, who, what, when, where, why, which, will';
        } else if($question == 10) { 
            $prompt = $prompt . 'create a list of question keywords that use or imply the verb "are" and use the following keyword phrase: "' . $keyword . '". The phrase "' . $keyword . '" must appear in each keyword. Do not use the following words: how, who, what, when, where, why, which, will, can';
        }
		
		$prompt = $prompt . '. Also provide search volume and SEO difficulty';
		
		return $prompt;
	}

	public function get_images_prompt($imagePrompt, $promptNumber) {
		if($promptNumber == 1) {
			$imagePrompt = 'illustration of a puppy, modern design, cute, happy, 4k, high resolution, trending in deviantart';
		} else if($promptNumber == 2) {
			$imagePrompt = 'A beautiful young African-American dieselpunk policewoman | | fine-face, handsome face, realistic shaded Perfect face, fine details. Anime. realistic shaded lighting poster by Ilya Kuvshinov katsuhiro otomo ghost-in-the-shell, magali villeneuve, artgerm, Jeremy Lipkin and Michael Garmash and Rob Rey';
		} else if($promptNumber == 3) {
			$imagePrompt = 'Mid-west USA, neighborhood, sleepy street, Thomas Kinkade oil painting, high resolution, 4k';
		} else if($promptNumber == 4) {
			$imagePrompt = 'Curving wing of modern hospital building in Californian redwood forest, architecture by Frank Gehry, wide-angle architectural photography from magazine';
		} else if($promptNumber == 5) {
			$imagePrompt = 'Stunning modern renovation of village church at dawn, huge shards of translucent coloured perspex, architectural photography';
		} else if($promptNumber == 6) {
			$imagePrompt = 'Refreshment kiosk in park, neo-Andean architectural style, editorial photograph at golden hour';
		} else if($promptNumber == 7) {
			$imagePrompt = 'Steampunk airport terminal architecture, exterior view, award-winning architectural photography from magazine.';
		} else if($promptNumber == 8) {
			$imagePrompt = 'Innovative interior design of a restaurant in rural Japan, neutral wooden materials, floor-to-ceiling windows with views of nature';
		} else if($promptNumber == 9) {
			$imagePrompt = 'Award-winning interior design of a modern hotel bar, playful furry furniture, warm lamp lighting';
		} else if($promptNumber == 10) {
			$imagePrompt = 'A super-minimal brutalist interior, plunge pool sunk into floor, huge windows with daylight streaming in, a single table, high-resolution photo from architecture website';
		} else if($promptNumber == 11) {
			$imagePrompt = 'Interior design photo of top floor maisonette in a Victorian terraced house, bold colourful furniture, dark blue walls.';
		} else if($promptNumber == 12) {
			$imagePrompt = 'Award-winning landscape design, a long thin Mediterranean garden with olive tree draped in fairy lights, high-quality photograph at twilight. ';
		} else if($promptNumber == 13) {
			$imagePrompt = 'Artists impression of award-winning rooftop garden design, white marble benches amidst wildflower meadow, NYC skyline in background, photograph at golden hour. ';
		} else if($promptNumber == 14) {
			$imagePrompt = 'Beautiful pond surrounded by lavender and lilac, dappled sunbeams illuminating the scene, stunning photograph from lansdcaping magazine.';
		} else if($promptNumber == 15) {
			$imagePrompt = 'Aged bronze statue of a Buffalo Soldier on his horse, shiny patches on face, in a london park on a sunny day ';
		} else if($promptNumber == 16) {
			$imagePrompt = 'A marble Greek statue of Black Panther';
		} else if($promptNumber == 17) {
			$imagePrompt = 'botticelli’s simonetta vespucci young portrait photography hyperrealistic modern dressed, futuristic';
		} else if($promptNumber == 18) {
			$imagePrompt = 'a portrait of an old coal miner in 19th century, beautiful painting with highly detailed face by greg rutkowski and magali villanueve';
		} else if($promptNumber == 19) {
			$imagePrompt = 'sango fantasy, fantasy magic,  , intricate, sharp focus, illustration, highly detailed, digital painting, concept art, matte, Artgerm and Paul lewin and kehinde wiley, masterpiece';
		} else if($promptNumber == 20) {
			$imagePrompt = 'Beautiful Woman with smile appearing from colorful flowers, wet, dewdrops, cinematic lighting, photo realistic, by karol bak --ar 2:3 --beta --upbeta';
		}  else if($promptNumber == 21) {
			$imagePrompt = 'Elsa, d & d, fantasy, intricate, elegant, highly detailed, digital painting, artstation, concept art, matte, sharp focus, illustration, hearthstone, art by artgerm and greg rutkowski and alphonse mucha, 8k';
		} else if($promptNumber == 22) {
			$imagePrompt = 'painted portrait of rugged zulu warrior, bald, masculine, mature, handsome, upper body, muscular, hairless torso, fantasy, intricate, elegant, highly detailed, digital painting, artstation, concept art, smooth, sharp focus, illustration, art by gaston bussiere and alphonse mucha';
		} else if($promptNumber == 23) {
			$imagePrompt = 'photo of a gorgeous mixed-race female, realistic, professional body shot, sharp focus, a hint of cleavage, 8K, insanely detailed, intricate, elegant, intricate office background';
		} else if($promptNumber == 24) {
			$imagePrompt = 'realistic portrait of an orange cat, bright eyes, with angel wings, radiant and ethereal intricately detailed photography, cinematic lighting, 50mm lens with bokeh';
		} else if($promptNumber == 25) {
			$imagePrompt = 'a teenage girl of afghani descent with striking rainbow eyes stares at the camera with a deep read head scarf. kodachrome film';
		} else if($promptNumber == 26) {
			$imagePrompt = 'a portrait of a anime ghibli akihiko yoshida style african princess of china and japan, at the throne room, soft light, finely detailed features, perfect art, at an ancient city, gapmoe yandere grimdark, trending on pixiv fanbox, painted by greg rutkowski makoto shinkai takashi takeuchi studio ghibli, akihiko yoshida ';
		} else if($promptNumber == 27) {
			$imagePrompt = 'hyperrealistic full length portrait of gorgeous goddess | standing in field full of flowers | (detailed gorgeous face) | full body | (skimpy armor) | god rays | intricate | elegant | realistic | hyperrealistic | cinematic | character design | concept art | highly detailed | illustration | digital art | digital painting | depth of field';
		} else if($promptNumber == 28) {
			$imagePrompt = 'hyperrealistic portrait of female tank commander in dgs illustration style| full shot| detailed face| symmetric| intricate| realistic| cinematic| character design| concept art| highly detailed| illustration| digital art| digital painting| by Anders Zorn and Ruan Jia and Mandy Jurgens';
		} else if($promptNumber == 29) {
			$imagePrompt = 'nike sneaker made of colorful plasma :: redshift render, digital art, hyper-detailed, ultra-realistic, 8k post-production';
		} else if($promptNumber == 30) {
			$imagePrompt = 'well lit fashion shoot portrait of extremely beautiful female wearing massively over size puffer jacket by craig green, dingyun zhang, yeezy, balenciaga, vetements, sharp focus, clear, detailed, , cinematic, detailed, off white, glamourous, symmetrical, vogue, editorial, fashion, magazine shoot, glossy --q 2';
		} else if($promptNumber == 31) {
			$imagePrompt = 'aerial photography of an Italian manor in Tuscany, poolsuite style';
		} else if($promptNumber == 32) {
			$imagePrompt = 'a big Persian Villa surrounded by water and nature, village, close view, volumetric lighting, photorealistic, insanely detailed and intricate, Fantasy, epic cinematic shot, trending on ArtStation, mountains, 8k ultra hd, magical, mystical, matte painting, bright sunny day, flowers, massive cliffs, Sweeper3D';
		} else if($promptNumber == 33) {
			$imagePrompt = 'a big Persian Villa surrounded by water and nature, village, close view, volumetric lighting, photorealistic, insanely detailed and intricate, Fantasy, epic cinematic shot, trending on ArtStation, mountains, 8k ultra hd, magical, mystical, matte painting, bright sunny day, flowers, massive cliffs, Sweeper3D';
		} else if($promptNumber == 34) {
			$imagePrompt = 'photo of a ultra realistic sailing ship, dramatic light, pale sunrise, cinematic lighting, battered, low angle, trending on artstation, 4k, hyper realistic, focused, extreme details, unreal engine 5, cinematic, masterpiece, art by studio ghibli, intricate artwork by john william turner
			';
		} else if($promptNumber == 35) {
			$imagePrompt = 'Emerald Lake::0.3 fairy pools::0.5 archival fine-art print of a misty sunset alpine landscape photograph::1.5 Captured with a medium format Fujifilm GFX100s:: stunning view of Emerald Lake in rocky mountain national park::1.1 sunset glow on the mountains and clouds::0.5 detailed pencil watercolor painting of::0.1 a tranquil alpine forest full small flowers:: a painterly, book illustration watercolor granular splatter dripping paper texture::0.2 award winning:: black paper::0.1 --h 320 --uplight';
		} else if($promptNumber == 36) {
			$imagePrompt = 'sci fi people standing surrounded by huge sci fi robotic cyborg city with intricate mechancial and sci-fi details, insane level of details, hyper realistic, cinematic, composition';
		} else if($promptNumber == 37) {
			$imagePrompt = 'Close-up portrait of a Nubian king from ancient egypt walking into no mans land, metallic armor,white black gold, porcelain face, mechanical features, baroque rococo, cinematic lighting, golden ratio, league of legends, dynamic pose,detailed energetic crystal chain wearing armor,sigil metallic armor, cryptic writing, ritual, intricate gold, 3D ornate alter, pineal gland, highly detailed ornaments crystallized black gems, ambient oclusion, highkey photography, bokeh 8K beautiful, detailed scenery, metal diamond design gold photorealistic, insanely detailed and intricate, hypermaximalist, elegant, ornate, hyper realistic, super detailed, 8K --c 50 --v 4';
		} else if($promptNumber == 38) {
			$imagePrompt = 'mdjrny-v4 style, highly detailed marble and jade sculpture of a sugar skull, day of the dead, volumetric fog, volumetric lighting, Hyperrealism, breathtaking, ultra realistic, unreal engine, ultra detailed, cyber background, highly detailed, breathtaking, photography, stunning environment, wide-angle';
		} else if($promptNumber == 39) {
			$imagePrompt = '(nousr robot:1.1), city street background, highly detailed, ultra-realistic, cinematic';
		} else if($promptNumber == 40) {
			$imagePrompt = 'redshift style, painted portrait of a paladin, masculine, mature, handsome, upper body, grey and silver, fantasy, intricate, elegant, highly detailed, digital painting, artstation, concept art, smooth, sharp focus, illustration, art by gaston bussiere and alphonse mucha';
		} else if($promptNumber == 41) {
			$imagePrompt = 'Chibi spiderman, octane rendering, modern Disney style';
		} else if($promptNumber == 42) {
			$imagePrompt = '12th century female samurai in the style of greg rutkowski and Guweiz and Yoji Shinkawa, intricate black and red samurai armor, cinematic lighting, dark rainy city, depth of field, lumen reflections, photography, stunning environment, hyperrealism, insanely detailed --v 4';
		} else if($promptNumber == 43) {
			$imagePrompt = 'yummy beef grill steak and colorful vegetables in a single big white dish centered, tableware, food photograph, food styling, long shot, lens 85 mm, f 11, studio photograph, ultra detailed, octane render, 8k, --q 2 --s 6000 --ar 2:3';
		}

		return $imagePrompt; 
	}

	/**
	 *  Prompts for Pro Tools
	 * 
	 */
	
	public function get_product_comparison_prompt($product1, $product2) {

		$prompt = 'You are an e-commerce expert. You have extensive knowledge of products in variety of categories. Create a detailed and structured blog post comparing the features of two products and provide short details for each feature?  Analyze the results: Compare the scores and ratings of each product to identify which one performs better overall. Draw conclusions: Based on the analysis, draw conclusions about which product is the better choice for your needs. You will Include top-level keywords, long-tail keywords, and a list of 3 optimized suggested titles.  Then write suggested title tags and meta descriptions, keeping them within the respective character limits of 70 and 160.  The two products are' . $product1 . ' vs ' . $product2 . '. ';
		return $prompt;
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
			  'frequency_penalty' 		=> 1.0,					// prevent repeating of words and content (increase number)
			  'presence_penalty' 		=> 1.0,					// prevent staying on one topic too long (increase number)
			  'n'						=> 1,
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
