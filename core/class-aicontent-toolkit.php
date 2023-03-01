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
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new aicontent_Toolkit_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

if ( ! class_exists( 'AI_Content_Toolkit' ) ) :

	/**
	 * Main AI_Content_Toolkit Class.
	 *
	 * @package		AICONTENTT
	 * @subpackage	Classes/AI_Content_Toolkit
	 * @since		0.5.0
	 * @author		Kitwana Akil
	 */
	final class AI_Content_Toolkit {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	0.5.0
		 * @var		object|AI_Content_Toolkit
		 */
		private static $instance;

		/**
		 * AICONTENTT helpers object.
		 *
		 * @access	public
		 * @since	0.5.0
		 * @var		object|AI_Content_Toolkit_Helpers
		 */
		public $helpers;

		/**
		 * AICONTENTT settings object.
		 *
		 * @access	public
		 * @since	0.5.0
		 * @var		object|AI_Content_Toolkit_Settings
		 */
		public $settings;


		/**
		 * AICONTENTT license object.
		 *
		 * @access	public
		 * @since	0.7.0
		 * @var		object|AI_Content_Toolkit_License
		 */
		public $license;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	0.5.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'aicontent-toolkit' ), '0.5.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	0.5.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'aicontent-toolkit' ), '0.5.0' );
		}

		/**
		 * Main aicontent_Toolkit Instance.
		 *
		 * Insures that only one instance of aicontent_Toolkit exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		0.5.0
		 * @static
		 * @return		object|AI_Content_Toolkit	The one true AI_Content_Toolkit
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof AI_Content_Toolkit ) ) {
				self::$instance					= new AI_Content_Toolkit;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new AI_Content_Toolkit_Helpers();
				self::$instance->settings		= new AI_Content_Toolkit_Settings();
				self::$instance->license		= new AI_Content_Toolkit_License();

				//Fire the plugin logic
				new AI_Content_Toolkit_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'AICONTENTT/plugin_loaded' );
			}
			
			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   0.5.0
		 * @return  void
		 */
		private function includes() {
			require_once AICONTENTT_PLUGIN_DIR . 'core/includes/classes/class-ai-content-toolkit-helpers.php';
			require_once AICONTENTT_PLUGIN_DIR . 'core/includes/classes/class-ai-content-toolkit-settings.php';

			require_once AICONTENTT_PLUGIN_DIR . 'core/includes/classes/class-ai-content-toolkit-run.php';
			require_once AICONTENTT_PLUGIN_DIR . 'core/includes/classes/class-ai-content-toolkit-license.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   0.5.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   0.5.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'aicontent-toolkit', FALSE, dirname( plugin_basename( AICONTENTT_PLUGIN_FILE ) ) . '/languages/' );
		}




	}

endif; // End if class_exists check.
