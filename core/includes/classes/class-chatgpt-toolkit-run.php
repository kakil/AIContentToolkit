<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


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
 * Class Chatgpt_Toolkit_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		CHATGPTTOO
 * @subpackage	Classes/Chatgpt_Toolkit_Run
 * @author		Kitwana Akil
 * @since		0.1.0
 */
class Chatgpt_Toolkit_Run{

	/**
	 * Our Chatgpt_Toolkit_Run constructor 
	 * to run the plugin logic.
	 *
	 * @since 0.1.0
	 */
	function __construct(){

		//register_activation_hook(__FILE__, array( $this, 'create_table_chatgpt_content_tool' ) );
		//register_activation_hook(CHATGPTTOO_PLUGIN_FILE, array( $this, 'create_table_chatgpt_content_tool') );
		
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
	 * @since	0.1.0
	 * @return	void
	 */
	private function add_hooks(){
	
		
		add_action( 'plugin_action_links_' . CHATGPTTOO_PLUGIN_BASE, array( $this, 'add_plugin_action_link' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts_and_styles' ), 20 );
		add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_menu_items' ), 100, 1 );
		add_action( 'admin_menu', array( $this, 'add_chatgpt_tools_menu_items' ), 100 );
		//add_action('admin_menu', array($this, 'remove_submenus'), 101);

		register_activation_hook(CHATGPTTOO_PLUGIN_FILE, array( $this, 'create_table_chatgpt_content_tool') );
		
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
	* @since	0.1.0
	*
	* @param	array	$links An array of plugin action links.
	*
	* @return	array	An array of plugin action links.
	*/
	public function add_plugin_action_link( $links ) {

		$links['our_shop'] = sprintf( '<a href="%s" title="Settings" style="font-weight:700;">%s</a>', 'https://toolkitsforsuccess.com', __( 'Settings', 'chatgpt-toolkit' ) );

		return $links;
	}

	/**
	 * Enqueue the backend related scripts and styles for this plugin.
	 * All of the added scripts and styles will be available on every page within the backend.
	 *
	 * @access	public
	 * @since	0.1.0
	 *
	 * @return	void
	 */
	public function enqueue_backend_scripts_and_styles() {
		wp_enqueue_style( 'chatgpttoo-backend-styles', CHATGPTTOO_PLUGIN_URL . 'core/includes/assets/css/backend-styles.css', array(), CHATGPTTOO_VERSION, 'all' );
		wp_enqueue_script( 'chatgpttoo-backend-scripts', CHATGPTTOO_PLUGIN_URL . 'core/includes/assets/js/backend-scripts.js', array(), CHATGPTTOO_VERSION, false );
		wp_localize_script( 'chatgpttoo-backend-scripts', 'chatgpttoo', array(
			'plugin_name'   	=> __( CHATGPTTOO_NAME, 'chatgpt-toolkit' ),
		));
		wp_enqueue_media();

		wp_footer();
	}

	/**
	 * Add a new menu item to the WordPress topbar
	 *
	 * @access	public
	 * @since	0.1.0
	 *
	 * @param	object $admin_bar The WP_Admin_Bar object
	 *
	 * @return	void
	 */
	public function add_admin_bar_menu_items( $admin_bar ) {

		$admin_bar->add_menu( array(
			'id'		=> 'chatgpt-toolkit-id', // The ID of the node.
			'title'		=> __( 'ChatGPT Tools', 'chatgpt-toolkit' ), // The text that will be visible in the Toolbar. Including html tags is allowed.
			'parent'	=> false, // The ID of the parent node.
			'href'		=> '#', // The ‘href’ attribute for the link. If ‘href’ is not set the node will be a text node.
			'group'		=> false, // This will make the node a group (node) if set to ‘true’. Group nodes are not visible in the Toolbar, but nodes added to it are.
			'meta'		=> array(
				'title'		=> __( 'ChatGPT Tools', 'chatgpt-toolkit' ), // The title attribute. Will be set to the link or to a div containing a text node.
				'target'	=> '_blank', // The target attribute for the link. This will only be set if the ‘href’ argument is present.
				'class'		=> 'chatgpt-toolkit-class', // The class attribute for the list item containing the link or text node.
				'html'		=> false, // The html used for the node.
				'rel'		=> false, // The rel attribute.
				'onclick'	=> false, // The onclick attribute for the link. This will only be set if the ‘href’ argument is present.
				'tabindex'	=> false, // The tabindex attribute. Will be set to the link or to a div containing a text node.
			),
		));

		$admin_bar->add_menu( array(
			'id'		=> 'chatgpt-toolkit-sub-id',
			'title'		=> __( 'ChatGPT Tools Sub Menu', 'chatgpt-toolkit' ),
			'parent'	=> 'chatgpt-toolkit-id',
			'href'		=> '#',
			'group'		=> false,
			'meta'		=> array(
				'title'		=> __( 'ChatGPT Tools Sub Menu', 'chatgpt-toolkit' ),
				'target'	=> '_blank',
				'class'		=> 'chatgpt-toolkit-sub-class',
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
	 * @since	0.1.0
	 *
	 * @param	object $admin_menu The admin_menu object
	 *
	 * @return	void
	 */

	 public function add_chatgpt_tools_menu_items() {

		add_menu_page( 
			'ChatGPT Tools',												//page title
			'ChatGPT Tools',												//menu title
			'manage_options',												//capability - https://wordpress.org/documentation/article/roles-and-capabilities/#manage_options
			'chatgpt-content-tool-dashboard-selector',						//menu slug
			array( $this, 'chatgpt_content_tool_dashboard_selector' ),		//function
			'dashicons-admin-tools',										//menu icon
			999																//menu position
		);

		add_submenu_page(
			'chatgpt-content-tool-dashboard-selector',				//parent slug
			'ChatGPT Tool Settings',								//page title
			'ChatGPT Tool Settings',								//menu title
			'manage_options',										//capability
			'chatgpt-content-tool-settings',						//menu slug
			array( $this, 'chatgpt_content_tool_settings' ),		//function callback
			100
		);

		add_submenu_page(
			null,
			'ChatGPT Tool Blog Post',
			'ChatGPT Tool Blog Post',
			'manage_options',
			'chatgpt-content-tool-blog-post',
			array( $this, 'chatgpt_content_tool_blog_post' ),
			20
		);

		add_submenu_page(
			null,
			'ChatGPT Tool Blog Post Outline',
			'ChatGPT Tool Blog Post Outline',
			'manage_options',
			'chatgpt-content-tool-blog-post-outline',
			array( $this, 'chatgpt_content_tool_blog_post_outline' ),
			25
		);

		add_submenu_page(
			null,
			'AI Brainstorming Tool',
			'AI Brainstorming Tool',
			'manage_options',
			'chatgpt-content-tool-brainstorming',
			array( $this, 'chatgpt_content_tool_brainstorming'),
			30
		);

		add_submenu_page(
			null,
			'AI Mindmap Tool',
			'AI Mindmap Tool',
			'manage_options',
			'chatgpt-content-tool-mindmap',
			array( $this, 'chatgpt_content_tool_mindmap'),
			35
		);

		add_submenu_page(
			null,
			'AI Advanced Blog Post Tool',
			'AI Advanced Blog Post Tool',
			'manage_options',
			'chatgpt-content-tool-advanced-blog-post',
			array( $this, 'chatgpt_content_tool_advanced_blog_post'),
			40
		);

		add_submenu_page(
			null,
			'AI Keyword Tool',
			'AI Keyword Tool',
			'manage_options',
			'chatgpt-content-tool-keywords',
			array( $this, 'chatgpt_content_tool_keywords'),
			45
		);

		add_submenu_page(
			null,
			'AI How To Article Tool',
			'AI How To Article Tool',
			'manage_options',
			'chatgpt-content-tool-how-to-article',
			array( $this, 'chatgpt_content_tool_how_to_article'),
			50
		);

		add_submenu_page(
			null,
			'AI List Article Tool',
			'AI List Article Tool',
			'manage_options',
			'chatgpt-content-tool-list-article',
			array( $this, 'chatgpt_content_tool_list_article'),
			50
		);

		add_submenu_page(
			null,
			'AI Astrology Tool',
			'AI Astrology Tool',
			'manage_options',
			'chatgpt-content-tool-astrology',
			array( $this, 'chatgpt_content_tool_astrology'),
			50
		);

		add_submenu_page(
			null,
			'AI Video Script Tool',
			'AI Video Script Tool',
			'manage_options',
			'chatgpt-content-tool-video-script',
			array( $this, 'chatgpt_content_tool_video_script'),
			50
		);

		add_submenu_page(
			null,
			'AI Long Tail Keyword Tool',
			'AI Long Tail Keyword Tool',
			'manage_options',
			'chatgpt-content-tool-long-tail-keywords',
			array( $this, 'chatgpt_content_tool_long_tail_keywords'),
			50
		);

		add_submenu_page(
			null,
			'AI Image Generator Tool',
			'AI Image Generator Tool',
			'manage_options',
			'chatgpt-content-tool-image-generator',
			array( $this, 'chatgpt_content_tool_image_generator'),
			50
		);

	 }

	 function remove_submenus() {
		remove_submenu_page(
			'chatgpt-content-tool-dashboard-selector',
			'chatgpt-content-tool-blog-post'
		);
	  }

	 function chatgpt_content_tool_blog_post() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/blogpost.php";
	 }

	 function chatgpt_content_tool_settings() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/settings.php";
	 }

	 function chatgpt_content_tool_dashboard_selector() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/dashboard-selector.php";
	 }

	 function chatgpt_content_tool_blog_post_outline() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/blogpost-outline.php";
	 }

	 function chatgpt_content_tool_brainstorming() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t3-brainstorming.php";
	 }

	 function chatgpt_content_tool_mindmap() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t4-mindmap.php";
	 }

	 function chatgpt_content_tool_advanced_blog_post() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t5-blogpost-advanced.php";
	 }

	 function chatgpt_content_tool_keywords() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t6-keywords.php";
	 }

	 function chatgpt_content_tool_how_to_article() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t7-how-to.php";
	 }

	 function chatgpt_content_tool_list_article() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t8-list.php";
	 }

	 function chatgpt_content_tool_astrology() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t9-astrology-generator.php";
	 }

	 function chatgpt_content_tool_video_script() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t10-video-script.php";
	 }

	 function chatgpt_content_tool_long_tail_keywords() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t11-longtailKeyword.php";
	 }

	 function chatgpt_content_tool_image_generator() {
		include CHATGPTTOO_PLUGIN_DIR . "core/includes/t12-image-generator.php";
	 }

	 //CREATE TABLES
	function create_table_chatgpt_content_tool() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$table_name = $wpdb->prefix . 'chatgpt_content_tool';

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

	/*

	add_menu_page( 
	string $page_title, 
	string $menu_title, 
	string $capability, 
	string $menu_slug, 
	callable $callback = '', 
	string $icon_url = '', 
	int|float $position = null ): string

*/


