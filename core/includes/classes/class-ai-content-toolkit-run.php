<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

include_once( AICONTENTT_PLUGIN_DIR . 'core/includes/classes/class-ai-content-toolkit-helpers.php');


/**
 * HELPER COMMENT START
 * 
 * This class is used to bring your plugin to life. 
 * All the other registered classed bring features which are
 * controlled and managed by this class.
 * 
 * Within the add_hooks() function, you can register all of 
 * your WordPress related actions and filters as followed:
 * 
 * add_action( 'my_action_hook_to_call', array( $this, 'the_action_hook_callback', 10, 1 ) );
 * or
 * add_filter( 'my_filter_hook_to_call', array( $this, 'the_filter_hook_callback', 10, 1 ) );
 * or
 * add_shortcode( 'my_shortcode_tag', array( $this, 'the_shortcode_callback', 10 ) );
 * 
 * Once added, you can create the callback function, within this class, as followed: 
 * 
 * public function the_action_hook_callback( $some_variable ){}
 * or
 * public function the_filter_hook_callback( $some_variable ){}
 * or
 * public function the_shortcode_callback( $attributes = array(), $content = '' ){}
 * 
 * 
 * HELPER COMMENT END
 */

/**
 * Class AI_Content_Toolkit_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		AICONTENTT
 * @subpackage	Classes/AIContent_Toolkit_Run
 * @author		Kitwana Akil
 * @since		0.5.0
 */
class AI_Content_Toolkit_Run{

	/**
	 * Our AIContent_Toolkit_Run constructor 
	 * to run the plugin logic.
	 *
	 * @since 0.5.0
	 */
	function __construct(){

		//register_activation_hook(__FILE__, array( $this, 'create_table_ai_content_tool' ) );
		//register_activation_hook(AICONTENTT_PLUGIN_FILE, array( $this, 'create_table_ai_content_tool') );
		
		$this->add_hooks();
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOKS
	 * ###
	 * ######################
	 */

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	0.5.0
	 * @return	void
	 */
	private function add_hooks(){
	
		
		add_action( 'plugin_action_links_' . AICONTENTT_PLUGIN_BASE, array( $this, 'add_plugin_action_link' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts_and_styles' ), 20 );
		//add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_menu_items' ), 100, 1 );
		add_action( 'admin_menu', array( $this, 'add_chatgpt_tools_menu_items' ), 100 );
		//add_action('admin_menu', array($this, 'remove_submenus'), 101);

		add_action( 'wp_ajax_chatgpt_submit', 'chatgpt_submit' );
		add_action( 'wp_ajax_nopriv_chatgpt_submit', 'chatgpt_submit' );

		//Register license code
		add_action('wp_ajax_activate_license', 'activate_license_ajax_handler');

		//add_shortcode( 'chatgpt', array( $this, 'chatgpt_shortcode', 10 ) );
		add_shortcode('subscribe', 'subscribe_link');
		
		// Register the shortcode
		add_shortcode( 'my_modal', 'my_modal_shortcode' );

		register_activation_hook(AICONTENTT_PLUGIN_FILE, array( $this, 'create_table_ai_content_tool') );

		AICONTENTT()->helpers->ai_content_add_option();
		
	}



	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOK CALLBACKS
	 * ###
	 * ######################
	 */

	/**
	* Adds action links to the plugin list table
	*
	* @access	public
	* @since	0.5.0
	*
	* @param	array	$links An array of plugin action links.
	*
	* @return	array	An array of plugin action links.
	*/
	public function add_plugin_action_link( $links ) {

		$links['our_shop'] = sprintf( '<a href="%s" title="Settings" style="font-weight:700;">%s</a>', '/wp-admin/admin.php?page=ai-content-tool-settings', __( 'Settings', 'ai-content-toolkit' ) );

		return $links;
	}

	/**
	 * Enqueue the backend related scripts and styles for this plugin.
	 * All of the added scripts and styles will be available on every page within the backend.
	 *
	 * @access	public
	 * @since	0.5.0
	 *
	 * @return	void
	 */
	public function enqueue_backend_scripts_and_styles() {

		wp_enqueue_script('jquery');
		wp_enqueue_style( 'aicontentt-backend-styles', AICONTENTT_PLUGIN_URL . 'core/includes/assets/css/backend-styles.css', array(), AICONTENTT_VERSION, 'all' );
		wp_enqueue_script( 'aicontentt-backend-scripts', AICONTENTT_PLUGIN_URL . 'core/includes/assets/js/backend-scripts.js', array(), AICONTENTT_VERSION, false );
		wp_localize_script( 'aicontentt-backend-scripts', 'aicontentt', array(
			'plugin_name'   	=> __( AICONTENTT_NAME, 'aicontent-toolkit' ),
		));

		wp_enqueue_media();

		//wp_footer();
	}



	/**
	 * Add a new menu item to the WordPress topbar
	 *
	 * @access	public
	 * @since	0.5.0
	 *
	 * @param	object $admin_bar The WP_Admin_Bar object
	 *
	 * @return	void
	 */
	public function add_admin_bar_menu_items( $admin_bar ) {

		$admin_bar->add_menu( array(
			'id'		=> 'aicontent-toolkit-id', // The ID of the node.
			'title'		=> __( 'AI Content Toolkit', 'aicontent-toolkit' ), // The text that will be visible in the Toolbar. Including html tags is allowed.
			'parent'	=> false, // The ID of the parent node.
			'href'		=> '#', // The ‘href’ attribute for the link. If ‘href’ is not set the node will be a text node.
			'group'		=> false, // This will make the node a group (node) if set to ‘true’. Group nodes are not visible in the Toolbar, but nodes added to it are.
			'meta'		=> array(
				'title'		=> __( 'AI Content Toolkit', 'aicontent-toolkit' ), // The title attribute. Will be set to the link or to a div containing a text node.
				'target'	=> '_blank', // The target attribute for the link. This will only be set if the ‘href’ argument is present.
				'class'		=> 'aicontent-toolkit-class', // The class attribute for the list item containing the link or text node.
				'html'		=> false, // The html used for the node.
				'rel'		=> false, // The rel attribute.
				'onclick'	=> false, // The onclick attribute for the link. This will only be set if the ‘href’ argument is present.
				'tabindex'	=> false, // The tabindex attribute. Will be set to the link or to a div containing a text node.
			),
		));

		$admin_bar->add_menu( array(
			'id'		=> 'aicontent-toolkit-sub-id',
			'title'		=> __( 'AI Tools Sub Menu', 'aicontent-toolkit' ),
			'parent'	=> 'aicontent-toolkit-id',
			'href'		=> '#',
			'group'		=> false,
			'meta'		=> array(
				'title'		=> __( 'AI Tools Sub Menu', 'aicontent-toolkit' ),
				'target'	=> '_blank',
				'class'		=> 'aicontent-toolkit-sub-class',
				'html'		=> false,    
				'rel'		=> false,
				'onclick'	=> false,
				'tabindex'	=> false,
			),
		));

	}

	/**
	 * Add a new menu item to the WordPress sidebar
	 *
	 * @access	public
	 * @since	0.5.0
	 *
	 * @param	object $admin_menu The admin_menu object
	 *
	 * @return	void
	 */

	 public function add_chatgpt_tools_menu_items() {

		add_menu_page( 
			'AI Content Tools',												//page title
			'AI Content Tools',												//menu title
			'manage_options',												//capability - https://wordpress.org/documentation/article/roles-and-capabilities/#manage_options
			'ai-content-tool-dashboard-selector',						//menu slug
			array( $this, 'ai_content_tool_dashboard_selector' ),		//function
			'dashicons-admin-tools',										//menu icon
			99																//menu position
		);

		add_submenu_page(
			'ai-content-tool-dashboard-selector',				//parent slug
			'AI Pro Tools',								//page title
			'AI Pro Tools',								//menu title
			'manage_options',										//capability
			'ai-content-tool-pro-tools',						//menu slug
			array( $this, 'ai_content_tool_pro_tools' ),		//function callback
			10
		);

		add_submenu_page(
			'ai-content-tool-dashboard-selector',				//parent slug
			'AI Tool Settings',								//page title
			'AI Tool Settings',								//menu title
			'manage_options',										//capability
			'ai-content-tool-settings',						//menu slug
			array( $this, 'ai_content_tool_settings' ),		//function callback
			15
		);

		
		add_submenu_page(
			null,
			'AI Tool Blog Post',
			'AI Tool Blog Post',
			'manage_options',
			'ai-content-tool-blog-post',
			array( $this, 'ai_content_tool_blog_post' ),
			20
		);

		add_submenu_page(
			null,
			'AI Tool Blog Post Outline',
			'AI Tool Blog Post Outline',
			'manage_options',
			'ai-content-tool-blog-post-outline',
			array( $this, 'ai_content_tool_blog_post_outline' ),
			25
		);

		add_submenu_page(
			null,
			'AI Brainstorming Tool',
			'AI Brainstorming Tool',
			'manage_options',
			'ai-content-tool-brainstorming',
			array( $this, 'ai_content_tool_brainstorming'),
			30
		);

		add_submenu_page(
			null,
			'AI Mindmap Tool',
			'AI Mindmap Tool',
			'manage_options',
			'ai-content-tool-mindmap',
			array( $this, 'ai_content_tool_mindmap'),
			35
		);

		add_submenu_page(
			null,
			'AI Advanced Blog Post Tool',
			'AI Advanced Blog Post Tool',
			'manage_options',
			'ai-content-tool-advanced-blog-post',
			array( $this, 'ai_content_tool_advanced_blog_post'),
			40
		);

		add_submenu_page(
			null,
			'AI Keyword Tool',
			'AI Keyword Tool',
			'manage_options',
			'ai-content-tool-keywords',
			array( $this, 'ai_content_tool_keywords'),
			45
		);

		add_submenu_page(
			null,
			'AI How To Article Tool',
			'AI How To Article Tool',
			'manage_options',
			'ai-content-tool-how-to-article',
			array( $this, 'ai_content_tool_how_to_article'),
			50
		);

		add_submenu_page(
			null,
			'AI List Article Tool',
			'AI List Article Tool',
			'manage_options',
			'ai-content-tool-list-article',
			array( $this, 'ai_content_tool_list_article'),
			55
		);

		add_submenu_page(
			null,
			'AI Astrology Tool',
			'AI Astrology Tool',
			'manage_options',
			'ai-content-tool-astrology',
			array( $this, 'ai_content_tool_astrology'),
			60
		);

		add_submenu_page(
			null,
			'AI Video Script Tool',
			'AI Video Script Tool',
			'manage_options',
			'ai-content-tool-video-script',
			array( $this, 'ai_content_tool_video_script'),
			65
		);

		add_submenu_page(
			null,
			'AI Long Tail Keyword Tool',
			'AI Long Tail Keyword Tool',
			'manage_options',
			'ai-content-tool-long-tail-keywords',
			array( $this, 'ai_content_tool_long_tail_keywords'),
			70
		);

		add_submenu_page(
			null,
			'AI Image Generator Tool',
			'AI Image Generator Tool',
			'manage_options',
			'ai-content-tool-image-generator',
			array( $this, 'ai_content_tool_image_generator'),
			75
		);

		/**
		 * Pro Tools Menus
		 * 
		 */
		add_submenu_page(
			null,
			'AI Product Comparison Tool',
			'AI Product Comparison Tool',
			'manage_options',
			'ai-content-tool-product-comparison',
			array( $this, 'ai_content_tool_product_comparison'),
			80
		);

		add_submenu_page(
			null,
			'AI Single Product Review Tool',
			'AI Single Product Review Tool',
			'manage_options',
			'ai-content-tool-multiple-product-review',
			array( $this, 'ai_content_tool_multiple_product_review'),
			85
		);

		add_submenu_page(
			null,
			'AI Amazon Product Review Tool',
			'AI Amazon Product Review Tool',
			'manage_options',
			'ai-content-tool-amazon-product-review',
			array( $this, 'ai_content_tool_amazon_product_review'),
			90
		);

		add_submenu_page(
			null,
			'AI Product Review Tool',
			'AI Product Review Tool',
			'manage_options',
			'ai-content-tool-product-review',
			array( $this, 'ai_content_tool_product_review'),
			85
		);

		add_submenu_page(
			null,
			'AI Product Description Tool',
			'AI Product Description Tool',
			'manage_options',
			'ai-content-tool-product-description',
			array( $this, 'ai_content_tool_product_description'),
			95
		);

		add_submenu_page(
			null,
			'AI Misconceptions Tool',
			'AI Misconceptions Tool',
			'manage_options',
			'ai-content-tool-misconceptions',
			array( $this, 'ai_content_tool_misconceptions'),
			100
		);

		add_submenu_page(
			null,
			'AI Long Form Blog Post Tool',
			'AI Long Form Blog Post Tool',
			'manage_options',
			'ai-content-tool-long-form-blog-post',
			array( $this, 'ai_content_tool_long_form_blog_post'),
			105
		);

		add_submenu_page(
			null,
			'AI Short Story Tool',
			'AI Short Story Tool',
			'manage_options',
			'ai-content-tool-short-story',
			array( $this, 'ai_content_tool_short_story'),
			107
		);

		add_submenu_page(
			null,
			'AI Book Chapter Tool',
			'AI Book Chapter Tool',
			'manage_options',
			'ai-content-tool-book-chapter',
			array( $this, 'ai_content_tool_book_chapter'),
			110
		);

		add_submenu_page(
			null,
			'AI SEO Article Tool',
			'AI SEO Article Tool',
			'manage_options',
			'ai-content-tool-seo-article',
			array( $this, 'ai_content_tool_seo_article'),
			115
		);

		add_submenu_page(
			null,
			'AI Inspirational Quotes Tool',
			'AI Inspirational Quotes Tool',
			'manage_options',
			'ai-content-tool-inspirational-quotes',
			array( $this, 'ai_content_tool_inspirational_quotes'),
			120
		);

		add_submenu_page(
			null,
			'AI Email Generator Tool',
			'AI Email Generator Tool',
			'manage_options',
			'ai-content-tool-email-generator',
			array( $this, 'ai_content_tool_email_generator'),
			125
		);

		add_submenu_page(
			null,
			'AI Youtube Tag Generator Tool',
			'AI Youtube Tag Generator Tool',
			'manage_options',
			'ai-content-tool-youtube-tag-generator',
			array( $this, 'ai_content_tool_youtube_tag_generator'),
			130
		);

		add_submenu_page(
			null,
			'AI Dall-e Prompt Tool',
			'AI Dall-e Prompt Tool',
			'manage_options',
			'ai-content-tool-dalle-prompt',
			array( $this, 'ai_content_tool_dalle_prompt'),
			135
		);

		add_submenu_page(
			null,
			'AI Alternative Article Tool',
			'AI Alternative Article Tool',
			'manage_options',
			'ai-content-tool-alternative-article',
			array( $this, 'ai_content_tool_alternative_article'),
			140
		);

		add_submenu_page(
			null,
			'AI Alternative Article Tool',
			'AI Alternative Article Tool',
			'manage_options',
			'ai-content-tool-alternative-article',
			array( $this, 'ai_content_tool_alternative_article'),
			145
		);

		add_submenu_page(
			null,
			'AI Content Calendar Tool',
			'AI Content Calendar Tool',
			'manage_options',
			'ai-content-tool-content-calendar',
			array( $this, 'ai_content_tool_content_calendar'),
			150
		);

		add_submenu_page(
			null,
			'AI Silo Structure Tool',
			'AI Silo Structure Tool',
			'manage_options',
			'ai-content-tool-silo-structure',
			array( $this, 'ai_content_tool_silo_structure'),
			155
		);

		add_submenu_page(
			null,
			'AI FAQ Tool',
			'AI FAQ Tool',
			'manage_options',
			'ai-content-tool-faq',
			array( $this, 'ai_content_tool_faq'),
			160
		);

		add_submenu_page(
			null,
			'AI Prepositions Keyword Tool',
			'AI Prepositions Keyword Tool',
			'manage_options',
			'ai-content-tool-prepositions',
			array( $this, 'ai_content_tool_prepositions'),
			165
		);

		add_submenu_page(
			null,
			'AI Alphabetical Keyword Tool',
			'AI Alphabetical Keyword Tool',
			'manage_options',
			'ai-content-tool-alphabetical',
			array( $this, 'ai_content_tool_alphabetical'),
			170
		);

		add_submenu_page(
			null,
			'AI Comparisons Keyword Tool',
			'AI Comparisons Keyword Tool',
			'manage_options',
			'ai-content-tool-comparisons',
			array( $this, 'ai_content_tool_comparisons'),
			175
		);

		add_submenu_page(
			null,
			'Chat With GPT',
			'Chat With GPT',
			'manage_options',
			'ai-content-tool-chat-with-gpt',
			array( $this, 'ai_content_tool_chat_with_gpt'),
			180
		);


	 }

	 function remove_submenus() {
		remove_submenu_page(
			'ai-content-tool-dashboard-selector',
			'ai-content-tool-blog-post'
		);
	  }

	 function ai_content_tool_blog_post() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/blogpost.php";
	 }

	 function ai_content_tool_settings() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/settings.php";
	 }

	 function ai_content_tool_dashboard_selector() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/dashboard-selector.php";
	 }

	 function ai_content_tool_pro_tools() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/pro-tools-selector.php";
	 }

	 function ai_content_tool_blog_post_outline() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/blogpost-outline.php";
	 }

	 function ai_content_tool_brainstorming() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t3-brainstorming.php";
	 }

	 function ai_content_tool_mindmap() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t4-mindmap.php";
	 }

	 function ai_content_tool_advanced_blog_post() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t5-blogpost-advanced.php";
	 }

	 function ai_content_tool_keywords() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t6-keywords.php";
	 }

	 function ai_content_tool_how_to_article() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t7-how-to.php";
	 }

	 function ai_content_tool_list_article() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t8-list.php";
	 }

	 function ai_content_tool_astrology() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t9-astrology-generator.php";
	 }

	 function ai_content_tool_video_script() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t10-video-script.php";
	 }

	 function ai_content_tool_long_tail_keywords() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t11-longtailKeyword.php";
	 }

	 function ai_content_tool_image_generator() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t12-image-generator.php";
	 }
	 
	 /**
	  * Pro Tools
	  *
	  */

	 function ai_content_tool_product_comparison() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t13-product-comparison.php";
	 }

	 function ai_content_tool_multiple_product_review() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t14-multiple-product-review.php";
	 }

	 function ai_content_tool_amazon_product_review() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t15-amazon-product-review.php";
	 }

	 function ai_content_tool_product_review() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t16-product-review.php";
	 }

	 function ai_content_tool_product_description() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t17-product-description.php";
	 }

	 function ai_content_tool_misconceptions() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t18-misconceptions.php";
	 }

	 function ai_content_tool_long_form_blog_post() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t19-long-form.php";
	 }

	 function ai_content_tool_short_story() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t20-short-story.php";
	 }

	 function ai_content_tool_book_chapter() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t21-book-chapter.php";
	 }

	 function ai_content_tool_seo_article() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t22-seo-article.php";
	 }

	 function ai_content_tool_inspirational_quotes() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t23-inpirational-quotes.php";
	 }

	 function ai_content_tool_email_generator() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t24-email-generator.php";
	 }

	 function ai_content_tool_youtube_tag_generator() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t25-youtube-tag-generator.php";
	 }

	 function ai_content_tool_dalle_prompt() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t26-dalleprompt.php";
	 }

	 function ai_content_tool_alternative_article() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t27-alternative-article.php";
	 }

	 function ai_content_tool_content_calendar() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t28-content-calendar.php";
	 }

	 function ai_content_tool_silo_structure() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t29-silo-structure.php";
	 }

	 function ai_content_tool_faq() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t30-faq.php";
	 }

	 function ai_content_tool_alphabetical() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t32-alphabetical.php";
	 }

	 function ai_content_tool_prepositions() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t31-prepositions.php";
	 }

	 function ai_content_tool_comparisons() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t33-comparisons.php";
	 }

	 function ai_content_tool_chat_with_gpt() {
		include AICONTENTT_PLUGIN_DIR . "core/includes/t34-chatgpt-button.php";
	 }

	 

	 //CREATE TABLES
	function create_table_ai_content_tool() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$table_name = $wpdb->prefix . 'ai_content_tool';

		$sql = "CREATE TABLE " . $table_name . " (
		id int(11) NOT NULL AUTO_INCREMENT,
		api_token tinytext NOT NULL,
		temperature tinytext NOT NULL,
		max_tokens tinytext NOT NULL,
		language tinytext NOT NULL,
		PRIMARY KEY  (id)
		) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

	}

}


/**
 * Short code
 * 
 */

function chatgpt_shortcode( $atts ) {

	$output = '';

	//Retrieve settings from the database
	global $wpdb;
	$tableName = $wpdb->prefix.'ai_content_tool';
	$sql = "SELECT * FROM $tableName";

	$results = $wpdb->get_results($sql);
	$getApiToken = $results[0]->api_token;
	$getTemperature = intval($results[0]->temperature);
	$getMaxTokens = intval($results[0]->max_tokens);
	$getLanguage = $results[0]->language;
	
	//Select the language
	$languages = array("en");
	if(in_array($getLanguage,$languages)) {
		include AICONTENTT_PLUGIN_DIR . "/languages/".$getLanguage.".php";
	} else {
		include AICONTENTT_PLUGIN_DIR . "/languages/en.php";
	}

	//Get response from server
	if ( isset( $_POST['sitePrompt'] ) ) {
		$sitePrompt = $_POST['sitePrompt'];
		
		//Set Headers
		$header = array(
			'Authorization: Bearer ' . $getApiToken,
			'Content-type: application/json',
		);

		//Set Parameters
		$param = json_encode(array(
			'prompt'					=> $sitePrompt,
			'model'						=> 'text-davinci-003',
			'temperature'				=> $getTemperature,
			'max_tokens'				=> $getMaxTokens,
			'frequency_penalty'			=> 0.5,
			'presence_penalty'			=> 0.5,
			'n'							=> 1,
		));

		//Connect to server
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

		if($httpcode == 200) {
			$json_array = json_decode($response, true);
			$choices = $json_arry['choices'];
			$postContent = $choices[0]["text"];
		} else {
			$postContent = "No Result";
		}

		$postContent .= '<form method="post">';
		$postContent .= '<input type="text" name="sitePrompt" placeholder="Enter your prompt">';
		$postContent .= '<input type="submit" value="Submit">';
		$postContent .= '</form>';

		return $postContent;
	}

}


function subscribe_link(){
	return 'Follow us on <a rel="nofollow" href="https://twitter.com/Hostinger?s=20">Twitter</a>';
}


// Register and enqueue Bootstrap CSS and JS
function my_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array('jquery'), '', true);
	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', array( 'jquery' ), '', true );
	
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );


// Add shortcode to display button and popup
function chatgpt_button_shortcode($atts) {
    ob_start();

	// Define the shortcode attributes and their default values
    $atts = shortcode_atts( array(
        'position' => 'bottom-right', // default button position is bottom-right
    ), $atts );

	// Add CSS classes to the button based on the position attribute
    $button_class = 'custom-button';
    switch ( $atts['position'] ) {
        case 'top-left':
            $button_class .= ' top-left';
            break;
        case 'top-center':
            $button_class .= ' top-center';
            break;
        case 'top-right':
            $button_class .= ' top-right';
            break;
        case 'middle-left':
            $button_class .= ' middle-left';
            break;
        case 'middle-center':
            $button_class .= ' middle-center';
            break;
        case 'middle-right':
            $button_class .= ' middle-right';
            break;
        case 'bottom-left':
            $button_class .= ' bottom-left';
            break;
        case 'bottom-center':
            $button_class .= ' bottom-center';
            break;
        default:
            // default position is bottom-right
            $button_class .= ' bottom-right';
            break;
    }

	// Add position attribute to button class
    $button_class .= ' position-' . $atts['position'];


	//Check for valid license
	if(!AICONTENTT()->helpers->ai_content_license_is_valid()) {
		return '';
	}

    ?>
	<!-- Style Block with CSS Rules -->
	<style>
		.btn-circle.btn-xl {
			width: 128px;
			height: 128px;
			border-radius: 50%;
			background-color: #54AE58;
			background-image: url('<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Button_Image_96x96.png'; ?>');
			background-size: 96px 96px;
			background-repeat: no-repeat;
			background-position: center;
			font-size: 24px;
			line-height: 128px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			margin-bottom: 10px;
		}

		.btn-circle {
			width: 80px;
			height: 80px;
			border-radius: 50%;
			background-color: #54AE58;
			background-image: url('<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Button_Image_56x56.png'; ?>');
			background-size: 56px 56px;
			background-repeat: no-repeat;
			background-position: center;
			font-size: 10px;
			line-height: 80px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			margin-bottom: 10px;
		}

		.text {
			font-size: 12px;
			font-weight: bold;
			margin: 0;
			padding: 0;
		}

		.custom-button {
			position: fixed;
		}

		.custom-button.top-left {
			top: 20px;
			left: 20px;
		}

		.custom-button.top-center {
			top: 20px;
			left: 50%;
			transform: translateX(-50%);
		}

		.custom-button.top-right {
			top: 20px;
			right: 20px;
		}

		.custom-button.middle-left {
			top: 50%;
			left: 20px;
			transform: translateY(-50%);
		}

		.custom-button.middle-center {
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.custom-button.middle-right {
			top: 50%;
			right: 20px;
			transform: translateY(-50%);
		}

		.custom-button.bottom-left {
			bottom: 20px;
			left: 20px;
		}

		.custom-button.bottom-center {
			bottom: 20px;
			left: 50%;
			transform: translateX(-50%);
		}

		.custom-button.bottom-right {
			bottom: 20px;
			right: 20px;
		}
	</style>
	<div class="<?php echo $button_class ?>">
    	<button type="button" class="btn btn-success btn-circle" data-bs-toggle="modal" data-bs-target="#chatgpt-modal"></button>
		<p class="text"><small>Chat With GPT</small></p>
	</div>
    <div class="modal fade" id="chatgpt-modal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="chatgpt-modal-label" aria-hidden="true">
		<style>
			.modal {position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); font:.5rem; background: rgba(0,0,0,0.5);}
			.vertical-alignment-helper{display:table; height: 100%; width: 100%; pointer-events:none;}
			.vertical-align-center{display: table-cell; vertical-align: middle; pointer-events:none;}
			.modal-content{width:inherit; max-width:inherit; height:inherit; margin:0 auto; pointer-events:all; z-index: 1100 !important;}
			.modal-backdrop { display: none; }
			.response-label {display:none;}
			.chatgpt-response {display:none;}
			.text-center {
				text-align: center;
			}
		</style>
		<div class="vertical-alignment-helper">
			<div class="modal-dialog vertical-align-center" role="document">
				<div class="modal-content" style="font: .5rem">
					<div class="modal-header">
						<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Small_Logo_60x60.png'; ?>" >
						<h5 class="modal-title ms-2" id="chatgpt-modal-label">Chat with GPT</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>  <!-- modal header end -->
					<div class="modal-body">
						<form id="chatgpt-form">
							<div class="form-group">
								<label for="validationCustom09">Enter your question:</label>
								<input type="text" class="form-control" id="chatgpt-prompt" name="chatgpt-prompt" required>
								<div class="prompt-validation" style="visibility: hidden">
										<p class="text-danger">Please enter a question...</p>
								</div>
							</div> <!-- form group end -->
							
							<div class="form-group d-none">
								<label for="chatgpt-response" id="response-label">Response:</label>
								<textarea class="form-control" id="chatgpt-response" name="chatgpt-response" rows="3" readonly></textarea>
							</div>
						</form> <!-- form end -->
						<div class="copyLink d-none text-center">
							<button class="btn btn-link" id="copyButton" style="font-size: medium">Copy To Clipboard</button>
						</div> <!-- copy button end -->
						<div>
							<div class="homeLink mt-2 text-center">
								<a href="http://toolkitsforsuccess.com" style="font-size: small">Made By ToolkitsForSuccess.com in Florida</a>
							</div>
						</div>
					</div> <!-- modal body end -->
					<div class="modal-footer text-center">
						<button type="button" class="btn btn-primary" id="chatgpt-submit">Submit
							<span class="spinner-border spinner-border-sm" id="spinner-submit" role="status" aria-hidden="true" style="visibility: hidden"></span>
						</button>
					</div> <!-- modal-footer end -->
				</div>  <!-- modal-content end -->
			</div>  <!-- modal-dialog end -->
		</div> <!-- vertical-alignment-helper end -->
	</div>  <!-- modal end -->


    <script>
        jQuery( document ).ready( function() {

			jQuery('#chatgpt-modal').on('shown.bs.modal', function() {

				jQuery('#chatWithGPTButton').on('click', function() {
					console.log('Modal Button Pressed');
					jQuery('#chatgpt-modal').appendTo("body").modal('show');
				})

				jQuery('#copyButton').on('click', function() {
					var value = jQuery('#chatgpt-response').val();
					jQuery(this).html("Copied!");
					//jQuery(this).addClass('green');

					copyText(value);
				})

				
				jQuery('#chatgpt-response').change( function() {
					//alert('Stop Spinner');
					let spinner = document.getElementById("#spinner-submit");
					spinner.style.visibility = 'hidden';
				});

				// Listen for the keydown event on the input fields inside the modal
				document.addEventListener('keydown', function(event) {
					// Check if the key pressed is the "Enter" key
					if (event.key === 'Enter') {
						// Prevent the default behavior of the "Enter" key
						event.preventDefault();
						
						// Trigger the button click event
						var prompt = jQuery('#chatgpt-prompt').val() == undefined ? '' : jQuery('#chatgpt-prompt').val().trim();
						
						if(!prompt){							//validate prompt is not empty
							console.log('prompt is null');
							jQuery('.prompt-validation').css({"visibility":"visible"});
							
						} else {
							jQuery('#chatgpt-submit').click();	// Trigger button click event
						}
					}
				});

				jQuery( '#chatgpt-submit' ).on( 'click', function() {
					//alert('Button Pressed');
					console.log(jQuery('#chatgpt-prompt').val());
						var prompt = jQuery('#chatgpt-prompt').val() == undefined ? '' : jQuery('#chatgpt-prompt').val().trim();
						
						if(!prompt){
							console.log('prompt is null');
							jQuery('.prompt-validation').css({"visibility":"visible"});
							
						} else {
							jQuery('#copyButton').html("Copy To Clipboard");
							jQuery('.prompt-validation').css({"visibility":"hidden"});
							let spinner = document.getElementById("spinner-submit");
							spinner.style.visibility = 'visible';
							var prompt = jQuery( '#chatgpt-prompt' ).val();
							jQuery.ajax( {
								type: 'POST',
								url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
								data: {
									'action': 'chatgpt_submit',
									'prompt': prompt
								},
								success: function( data ) {
									jQuery( '#chatgpt-response' ).val( jQuery.trim(data) );
									jQuery( '#spinner-submit').css("visibility", "hidden");
									jQuery( '#prompt-validation').css("visibility", "hidden");
									jQuery( '.form-group' ).removeClass("d-none");
									jQuery( '.copyLink' ).removeClass("d-none");
							
								}
							});
						}


				});

				// Validations
				// Example starter JavaScript for disabling form submissions if there are invalid fields
				(function () {
					'use strict'
					
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					var forms = document.querySelectorAll('.needs-validation')
			
					// Loop over them and prevent submission
					Array.prototype.slice.call(forms)
					.forEach(function (form) {
						form.addEventListener('submit', function (event) {
						if (!form.checkValidity()) {
							event.preventDefault()
							event.stopPropagation()
							//jQuery('#spinner-div').hide();
							let spinner = document.getElementById("spinner-submit");
							spinner.style.visibility = 'hidden';

							let addBlogSpinner = document.getElementById("spinner-blog-submit");
							if(addBlogSpinner) {
								addBlogSpinner.style.visibility = 'hidden';
							}

							//  let imageInfoText = document.getElementById('imageInfoText');
							//  imageInfoText.style.visibility = 'visible';
							
							console.log("Checked Validation");
						}
			
						form.classList.add('was-validated')
						}, false)
					})
				})();

				//copyText(value);
			})

			jQuery('#chatgpt-submit').click(function() {
				//Show spinner
				let spinner = document.getElementById("spinner-submit");
         		spinner.style.visibility = 'visible';

			});

			

            jQuery( '#chatgpt-submit' ).on( 'click', function() {
				//alert('Button Pressed');
                var prompt = jQuery( '#chatgpt-prompt' ).val();
                jQuery.ajax( {
                    type: 'POST',
                    url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
                    data: {
                        'action': 'chatgpt_submit',
                        'prompt': prompt
                    },
                    success: function( data ) {
                        jQuery( '#chatgpt-response' ).val( jQuery.trim(data) );
						jQuery( '#spinner-submit').css("visibility", "hidden");
						jQuery( '.form-group' ).removeClass("d-none");
						jQuery( '.copyLink' ).removeClass("d-none");
						
                    }
                } );
            } );
        } );
		
		function copyText(text) {
			if (!navigator.clipboard) {  // if Clipboard API is not available, fallback to the old method
				var textField = document.createElement('textarea');
				textField.innerText = text;
				document.body.appendChild(textField);
				textField.select();
				textField.focus(); //SET FOCUS on the TEXTFIELD
				document.execCommand('copy');
				textField.remove();
				console.log('should have copied ' + text); 
				document.getElementById('chatgpt-response').focus(); //SET FOCUS BACK to MODAL
			} else { // use Clipboard API
				navigator.clipboard.writeText(text).then(() => {
					console.log('should have copied ' + text);
					document.getElementById('chatgpt-response').focus(); //SET FOCUS BACK to MODAL
				}).catch(err => {
					console.error('Could not copy text: ', err);
				});
			}
		}

    </script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'chatgpt_button', 'chatgpt_button_shortcode' );



// Handle AJAX request to generate response
function chatgpt_submit() {

	//Retrieve settings from the database
	global $wpdb;
	$tableName = $wpdb->prefix.'ai_content_tool';
	$sql = "SELECT * FROM $tableName";

	$results = $wpdb->get_results($sql);
	$getApiToken = $results[0]->api_token;
	$getTemperature = intval($results[0]->temperature);
	$getMaxTokens = intval($results[0]->max_tokens);
	$getLanguage = $results[0]->language;
	
	//Select the language
	$languages = array("en");
	if(in_array($getLanguage,$languages)) {
		include AICONTENTT_PLUGIN_DIR . "/languages/".$getLanguage.".php";
	} else {
		include AICONTENTT_PLUGIN_DIR . "/languages/en.php";
	}

    if ( isset( $_POST['prompt'] ) ) {
        $prompt = $_POST['prompt'];

        // Generate response using OpenAI API (replace YOUR_API_KEY with your actual API key)
        $api_key = $getApiToken;
        $api_url = 'https://api.openai.com/v1/chat/completions';
        $request_data = array(
            'model' => 'gpt-3.5-turbo',
            'messages' => array(
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'max_tokens' => $getMaxTokens,
            'temperature' => $getTemperature,
            'stop' => ['\n']
        );
        $request_headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        );
        $curl = curl_init();
        curl_setopt_array( $curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode( $request_data ),
            CURLOPT_HTTPHEADER => $request_headers,
            CURLOPT_RETURNTRANSFER => true
        ) );
        $response = curl_exec( $curl );
        $response_info = curl_getinfo( $curl );
        $curl_error = curl_error( $curl );
        curl_close( $curl );
        if ( $response_info['http_code'] == 200 ) {
            $response_data = json_decode( $response, true );
            if ( isset( $response_data['choices'] ) && count( $response_data['choices'] ) > 0 ) {
                $content = $response_data['choices'][0]['message']['content'];
                echo $content;
            }
        } else {
            echo 'Error: ' . $curl_error;
        }
        exit;
    }
}



//license code
//
// Add an AJAX action for verifying the license key
function verify_license() {

	//echo 'In the Verify License function';
  
	$license_key = $_POST['license_key'];
	$api_key = $_POST['_api_key'];
	$guid = $_POST['guid'];
  
	$api_url = 'https://app.productdyno.com/api/v1/licenses/activate';
	$request_data = array(
	  'license_key' => $license_key,
	  '_api_key' => $api_key,
	  'guid' => $guid
		// 'license_key' => 'ZTYJ-IMO9-HQVE-UUD',
		// '_api_key' => '588e6bf7b14c8b63114fb0f147afc5c3',
	  	// 'guid' => 'takeactionreview.com'
	);
  
	$request_headers = array(
	  'Content-Type: application/json'
	);
  
	$curl = curl_init();
	curl_setopt_array( $curl, array(
	  CURLOPT_URL => $api_url,
		  CURLOPT_POST => true,
		  CURLOPT_POSTFIELDS => json_encode( $request_data ),
		  CURLOPT_HTTPHEADER => $request_headers,
		  CURLOPT_RETURNTRANSFER => true
	));
  
	$response = curl_exec( $curl );				//has the actual response from the API
	$response_info = curl_getinfo( $curl );		// has the HTTP response code
	$curl_error = curl_error( $curl );
	curl_close( $curl );
  
	/**
	 *  Example Response:
	 * 	{
	 *		"license_key": "PW1V-FP0N-Q5IY-RRBZ",
	 *		"activated_at": "2021-04-28 14:12:43",
	 *		"product_id": 58
	 *	}	
	 */

	 $response_data = json_decode($response, true);


	if( $response_info['http_code'] == 200 && $response_data['product_id'] == 22006 ) {

		$response_license_key = $response_data['license_key'];
		$response_activated_at = $response_data['activated_at'];
		$response_product_id = $response_data['product_id'];

	  	AICONTENTT()->helpers->ai_content_update_option($response_license_key);
	  	AICONTENTT()->helpers->ai_content_deactivation_update_option('');
		verify_license_on_admin_pages();
	  	echo json_encode($response_data);

	  	//update_option('license_key', $response_data['license_key']);
	  	//return 'ProductDyno Response: ' . $response_data['license_key'];
	} else {
	  //echo $curl_error;
	  AICONTENTT()->helpers->ai_content_update_option('');
	  $error_response = array(
		"success" => false
	  );
	  echo json_encode($error_response);
	  //return $curl_error;
	}
  
  wp_die();
  
}
  
add_action('wp_ajax_verify_license', 'verify_license');
add_action('wp_ajax_nopriv_verify_license', 'verify_license');


//Verify license for admin pages
function verify_license_on_admin_pages() {
	if (is_admin() && !AICONTENTT()->helpers->ai_content_license_is_valid()) {
		add_action('admin_notices', 'show_license_notice');
	}
}

function show_license_notice() {
	if (AICONTENTT()->helpers->ai_content_license_is_valid()) {
		remove_action('admin_notices', 'show_license_notice');
		return;
	}
	
	?>
	<div class="notice notice-error">
	<p>Your AI Content Tool license key is not valid. Please enter a valid license key in the plugin settings to continue using this plugin.</p>
	</div>
	<?php
}

add_action('current_screen', 'verify_license_on_admin_pages');


//Deactivate license 

function deactivate_license() {

	//echo 'In the Verify License function';
  
	$license_key = $_POST['license_key'];
	$api_key = $_POST['_api_key'];
	//$guid = $_POST['guid'];
  
	$api_url = 'https://app.productdyno.com/api/v1/licenses/deactivate';
	$request_data = array(
	  'license_key' => $license_key,
	  '_api_key' => $api_key,
		// 'license_key' => 'ZTYJ-IMO9-HQVE-UUD',
		// '_api_key' => '588e6bf7b14c8b63114fb0f147afc5c3',
	  	// 'guid' => 'takeactionreview.com'
	);
  
	$request_headers = array(
	  'Content-Type: application/json'
	);
  
	$curl = curl_init();
	curl_setopt_array( $curl, array(
	  CURLOPT_URL => $api_url,
		  CURLOPT_POST => true,
		  CURLOPT_POSTFIELDS => json_encode( $request_data ),
		  CURLOPT_HTTPHEADER => $request_headers,
		  CURLOPT_RETURNTRANSFER => true
	));
  
	$response = curl_exec( $curl );
	$response_info = curl_getinfo( $curl );
	$curl_error = curl_error( $curl );
	curl_close( $curl );
  
	if( $response_info['http_code'] == 200 ) {

		$response_data = json_decode($response, true);

		$deactivated_at = $response_data['deactivated_at'];
		$response_license_key = $response_data['license_key'];

		AICONTENTT()->helpers->ai_content_deactivation_update_option($deactivated_at);
		AICONTENTT()->helpers->ai_content_update_option('');
		verify_license_on_admin_pages();
		echo json_encode($response_data);
	  
	} else {
	  echo $curl_error;			//simple strings do not need json_encode()
	  //AICONTENTT()->helpers->ai_content_deactivation_update_option('');
	  
	}
  
  wp_die();
  
}
  
add_action('wp_ajax_deactivate_license', 'deactivate_license');
add_action('wp_ajax_nopriv_deactivate_license', 'deactivate_license');



add_action( 'wp_ajax_rudr_upload_file_by_url_callback', 'rudr_upload_file_by_url_callback' );
add_action( 'wp_ajax_nopriv_rudr_upload_file_by_url_callback', 'rudr_upload_file_by_url_callback' );

function rudr_upload_file_by_url_callback() {
    if ( isset( $_POST['image_url'] ) ) {
		//$attachment_id = 'true';
		$image_url = $_POST['image_url'];
		$imageName = $_POST['imageName'];
        

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
		echo 'download_url did not return a file name';
		} //else {
		// 	echo 'download_url returned a file name: ' . $temp_file;
		// }

	
		// move the temp file into the uploads directory
		$file = array(
			'name'     => basename( $imageName ),
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

			echo 'false';
			//return false;
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
			
			echo 'false';
			//return false;
		}

		
		// // update medatata, regenerate image sizes
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
	
		wp_update_attachment_metadata(
			$attachment_id,
			wp_generate_attachment_metadata( $attachment_id, $sideload[ 'file' ] )
		);
		$image_url = NULL;
		echo json_encode($attachment_id);
		
		//return $attachment_id;
	

		/**
		 * This is the test code for the various stages of the
		 * upload code.
		 */
		//$attachment_id = 'true';
		// if ( $attachment_id ) {
        //     //echo 'Attachment ID: ' . $attachment_id; // return the attachment ID to the Ajax request
		// 	echo json_encode($attachment_id);
        // } else {
        //     echo 'false'; // return false if there was an error
        // }

    }

    wp_die();
}