<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new Chatgpt_Toolkit_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

if ( ! class_exists( 'Chatgpt_Toolkit' ) ) :

	/**
	 * Main Chatgpt_Toolkit Class.
	 *
	 * @package		CHATGPTTOO
	 * @subpackage	Classes/Chatgpt_Toolkit
	 * @since		0.1.0
	 * @author		Kitwana Akil
	 */
	final class Chatgpt_Toolkit {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	0.1.0
		 * @var		object|Chatgpt_Toolkit
		 */
		private static $instance;

		/**
		 * CHATGPTTOO helpers object.
		 *
		 * @access	public
		 * @since	0.1.0
		 * @var		object|Chatgpt_Toolkit_Helpers
		 */
		public $helpers;

		/**
		 * CHATGPTTOO settings object.
		 *
		 * @access	public
		 * @since	0.1.0
		 * @var		object|Chatgpt_Toolkit_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	0.1.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'chatgpt-toolkit' ), '0.1.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	0.1.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'chatgpt-toolkit' ), '0.1.0' );
		}

		/**
		 * Main Chatgpt_Toolkit Instance.
		 *
		 * Insures that only one instance of Chatgpt_Toolkit exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		0.1.0
		 * @static
		 * @return		object|Chatgpt_Toolkit	The one true Chatgpt_Toolkit
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Chatgpt_Toolkit ) ) {
				self::$instance					= new Chatgpt_Toolkit;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Chatgpt_Toolkit_Helpers();
				self::$instance->settings		= new Chatgpt_Toolkit_Settings();

				//Fire the plugin logic
				new Chatgpt_Toolkit_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'CHATGPTTOO/plugin_loaded' );
			}
			
			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   0.1.0
		 * @return  void
		 */
		private function includes() {
			require_once CHATGPTTOO_PLUGIN_DIR . 'core/includes/classes/class-chatgpt-toolkit-helpers.php';
			require_once CHATGPTTOO_PLUGIN_DIR . 'core/includes/classes/class-chatgpt-toolkit-settings.php';

			require_once CHATGPTTOO_PLUGIN_DIR . 'core/includes/classes/class-chatgpt-toolkit-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   0.1.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   0.1.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'chatgpt-toolkit', FALSE, dirname( plugin_basename( CHATGPTTOO_PLUGIN_FILE ) ) . '/languages/' );
		}




	}

endif; // End if class_exists check.
