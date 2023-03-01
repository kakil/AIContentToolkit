<?php

    // Exit if accessed directly.
    if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * HELPER COMMENT START
 * 
 * This class contains all of the plugin related licensing code.
 * Everything that is relevant verifying, activating, checking, 
 * and deactivating the licensing for the plugin.
 * 
 * To define the actual values, we recommend adding them as shown above
 * within the __construct() function as a class-wide variable. 
 * This variable is then used by the callable functions down below. 
 * These callable functions can be called everywhere within the plugin 
 * as followed using the get_plugin_name() as an example: 
 * 
 * AICONTENTT->license->get_activate_plugin();
 * 
 * HELPER COMMENT END
 */

 /**
 * Class AIContent_Toolkit_License
 *
 * This class contains all of the plugin license code.
 * Here you can configure the licensing scheme.
 *
 * @package		AICONTENTT
 * @subpackage	Classes/AIContent_Toolkit_License
 * @author		Kitwana Akil
 * @since		0.7.0
 */

 lass AI_Content_Toolkit_License {

	/**
	 * The plugin name
	 *
	 * @var		string
	 * @since   0.5.0
	 */
	private $plugin_name;

	/**
	 * Our AI_Content_Toolkit_License constructor 
	 * to run the plugin logic.
	 *
	 * @since 0.7.0
	 */
	function __construct(){

		$this->plugin_name = AICONTENTT_NAME;
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
	 * @since	0.5.0
	 * @return	string The plugin name
	 */
	public function get_plugin_name(){
		return apply_filters( 'AICONTENTT/settings/get_plugin_name', $this->plugin_name );
	}

    
    /**
	 * Verify the license
     * 
     * Will check the validity of a license key. This function will be called 
     * every time the user activates the plugin,
     * and will determine whether the plugin should be allowed to run.
     * 
	 *
	 * @access	public
	 * @since	0.7.0
	 * @return	bool
	 */

     function verify_license_key($license_key) {
        // Perform a check to determine if the license key is valid
        if ($valid) {
            return true;
        } else {
            return false;
        }
    }
	

    /**
	 * Display the license key input field
	 *
     * Add an input field to the plugin settings page where users
     * can enter their license key. This will be used to verify
     * the license key when the user activates the plugin.
     * 
	 * @access	public
	 * @since	0.7.0
	 * @return	void
	 */

     function plugin_settings_page() {
        // Display the license key input field
        ?>
        <input type="text" name="license_key" value="<?php echo get_option('license_key'); ?>" />
        <?php
    }


    /**
	 * Verify the license key on activation
	 *
     * When the user activates the plugin, verify the
     * license key using the verify_license_key function.
     * If the license key is valid, save it to
     * the WordPress options table.
     * 
	 * @access	public
	 * @since	0.7.0
	 * @return	void
	 */

     function activate_plugin() {
        $license_key = $_POST['license_key'];
        if (verify_license_key($license_key)) {
            update_option('license_key', $license_key);
        } else {
            // Display an error message to the user
            echo 'Invalid license key';
        }
    }


    /**
	 * Check the license key on plugin load
	 *
     * Finally, check the license key every time the plugin is loaded
     * to ensure that it is still valid. If the license key is not valid,
     * disable the plugin or display a warning message to the user.
     * 
	 * @access	public
	 * @since	0.7.0
	 * @return	void
	 */


     function plugin_loaded() {
        $license_key = get_option('license_key');
        if (!verify_license_key($license_key)) {
            // Disable the plugin or display a warning message
            echo 'Your license key is invalid';
            exit;
        }
    }



}