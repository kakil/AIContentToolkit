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

 class AI_Content_Toolkit_License {

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
	 * The api key
	 *
	 * @var		string
	 * @since   0.7.0
	 */
	private $apiKey = '588e6bf7b14c8b63114fb0f147afc5c3';


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

        // Define the API endpoint URL
        $apiURL = 'https://app.productdyno.com/api/v1/licenses/get';

        // Define the API key and license key parameters
        $params = array(
            '_api_key' => $apiKey,
            'license_key' => $licenseKey
        );

        // Initialize a cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $apiURL . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check if there was an error with the cURL request
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            // Parse the JSON response
            $json = json_decode($response, true);
            
            // Check if the license key is valid
            if ($json && isset($json['license_key'])) {
                // The license key is valid
                echo 'License key is valid for product ID ' . $json['product_id'];
            } else {
                // The license key is not valid
                echo 'Invalid license key';
            }
        }

        // Close the cURL session
        curl_close($ch);
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

     function activate_plugin($license_key) {
        // Define the API endpoint URL
        $url = 'https://app.productdyno.com/api/v1/licenses/get';
        alert('license key: ' . $license_key);
        // Define the API key and license key parameters
        $params = array(
            '_api_key' => 'YOUR_API_KEY',
            'license_key' => $license_key
        );

        // Initialize a cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check if there was an error with the cURL request
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            // Parse the JSON response
            $json = json_decode($response, true);
            
            // Check if the license key is valid
            if ($json && isset($json['license_key'])) {
                // The license key is valid
                echo 'License key is valid for product ID ' . $json['product_id'];
                
                // Save the license key to the WordPress options table
                update_option('license_key', 'USER_LICENSE_KEY');
            } else {
                // The license key is not valid
                echo 'Invalid license key';
            }
        }

        // Close the cURL session
        curl_close($ch);

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
        // Retrieve the license key from the WordPress options table
        $license_key = get_option('license_key');

        // Define the API endpoint URL
        $url = 'https://app.productdyno.com/api/v1/licenses/get';

        // Define the API key and license key parameters
        $params = array(
            '_api_key' => 'YOUR_API_KEY',
            'license_key' => $license_key
        );

        // Initialize a cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check if there was an error with the cURL request
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            // Parse the JSON response
            $json = json_decode($response, true);

            // Check if the license key is valid
            if ($json && isset($json['license_key'])) {
                // The license key is valid
                echo 'License key is valid for product ID ' . $json['product_id'];
            } else {
                // The license key is not valid
                echo 'Invalid license key';
            }
        }

        // Close the cURL session
        curl_close($ch);
    }

    // Hook the verify_license function to the WordPress init action
    add_action('init', 'verify_license');

    /**
	 * Connect to server
	 *
     * Connect to the licensing server
     * 
     * 
	 * @access	public
	 * @since	0.7.0
	 * @return	void
	 */

     function connect_to_server_post($apiURL, $apiKey, $licenseKey, $guid) {

        $curl = curl_init();
		curl_setopt_array( $curl, array(
			CURLOPT_URL => $apiURL,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => json_encode( $request_data ),
			CURLOPT_HTTPHEADER => $request_headers,
			CURLOPT_RETURNTRANSFER => true
		) );
		
     }

     function connect_to_server_get($apiURL, $apiKey, $licenseKey, $memberId) {

        // Define the API key and license key parameters
        $params = array(
            '_api_key' => $apiKey,
            'license_key' => $licenseKey
        );

        // Initialize a cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $apiURL . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check if there was an error with the cURL request
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            // Parse the JSON response
            $json = json_decode($response, true);
            
            // Check if the license key is valid
            if ($json && isset($json['license_key'])) {
                // The license key is valid
                echo 'License key is valid for product ID ' . $json['product_id'];
            } else {
                // The license key is not valid
                echo 'Invalid license key';
            }
        }

        // Close the cURL session
        curl_close($ch);


     }


}