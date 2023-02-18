<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This class contains all of the plugin related settings.
 * Everything that is relevant data and used multiple times throughout 
 * the plugin.
 * 
 * To define the actual values, we recommend adding them as shown above
 * within the __construct() function as a class-wide variable. 
 * This variable is then used by the callable functions down below. 
 * These callable functions can be called everywhere within the plugin 
 * as followed using the get_plugin_name() as an example: 
 * 
 * CHATGPTTOO->settings->get_plugin_name();
 * 
 * HELPER COMMENT END
 */

/**
 * Class Chatgpt_Toolkit_Settings
 *
 * This class contains all of the plugin settings.
 * Here you can configure the whole plugin data.
 *
 * @package		CHATGPTTOO
 * @subpackage	Classes/Chatgpt_Toolkit_Settings
 * @author		Kitwana Akil
 * @since		0.1.0
 */
class Chatgpt_Toolkit_Settings{

	/**
	 * The plugin name
	 *
	 * @var		string
	 * @since   0.1.0
	 */
	private $plugin_name;

	/**
	 * Our Chatgpt_Toolkit_Settings constructor 
	 * to run the plugin logic.
	 *
	 * @since 0.1.0
	 */
	function __construct(){

		$this->plugin_name = CHATGPTTOO_NAME;
	}

	/**
	 * ######################
	 * ###
	 * #### CALLABLE FUNCTIONS
	 * ###
	 * ######################
	 */

	/**
	 * Return the plugin name
	 *
	 * @access	public
	 * @since	0.1.0
	 * @return	string The plugin name
	 */
	public function get_plugin_name(){
		return apply_filters( 'CHATGPTTOO/settings/get_plugin_name', $this->plugin_name );
	}
	
}
