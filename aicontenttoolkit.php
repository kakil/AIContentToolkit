<?php
/**
 * AI Content ToolKit
 *
 * @package       AICONTENTT
 * @author        Kitwana Akil
 * @license       gplv3-or-later
 * @version       1.0.1
 *
 * @wordpress-plugin
 * Plugin Name:   AI Content ToolKit
 * Plugin URI:    https://toolkitsforsuccess.com/aicontenttoolkit
 * Description:   This WordPress plugin is a collection of tools that allows you to do a variety of different tasks using ChatGPT API.
 * Version:       1.0.1
 * Author:        Kitwana Akil
 * Author URI:    https://toolkitsforsuccess.com
 * Text Domain:   aicontent-toolkit
 * Domain Path:   /languages
 * License:       GPLv3 or later
 * License URI:   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with AI Content ToolKit. If not, see <https://www.gnu.org/licenses/gpl-3.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function AICONTENTT() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'AICONTENTT_NAME',			'AI Content ToolKit' );

// Plugin version
define( 'AICONTENTT_VERSION',		'1.0.1' );

// Plugin Root File
define( 'AICONTENTT_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'AICONTENTT_PLUGIN_BASE',	plugin_basename( AICONTENTT_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'AICONTENTT_PLUGIN_DIR',	plugin_dir_path( AICONTENTT_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'AICONTENTT_PLUGIN_URL',	plugin_dir_url( AICONTENTT_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once AICONTENTT_PLUGIN_DIR . 'core/class-aicontent-toolkit.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Kitwana Akil
 * @since   0.1.0
 * @return  object|AI_Content_Toolkit
 */
function AICONTENTT() {
	return AI_Content_Toolkit::instance();
}

AICONTENTT();
