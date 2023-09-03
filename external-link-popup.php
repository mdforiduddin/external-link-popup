<?php
/**
 * Plugin Name: External Link Popup
 * Plugin URI: https://bdteamwork.com
 * Description: Enhance user experience with a customizable popup for external links on your WordPress site.
 * Version: 1.0.0
 * Author: Md Forid Uddin
 * Author URI: https://bdteamwork.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: external-link-popup
 * Domain Path: /languages
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once __DIR__ . '/autoloader.php';

use External_Link_Popup\Includes\Admin;
use External_Link_Popup\Includes\Assets;
use External_Link_Popup\Includes\Customize;
use External_Link_Popup\Includes\Frontend;
use External_Link_Popup\Includes\Installer;
use External_Link_Popup\Includes\Uninstall;

/**
 * Main plugin class
 *
 * @author   Md Forid Uddin
 */
final class External_Link_Popup {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.0';

    /**
     * The unique instance of the plugin.
     *
     * @var External_Link_Popup
     */
    private static $instance;

    /**
     * Class Constructor
     */
    private function __construct() {

        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'activate'] );

        add_action( 'plugins_loaded', [$this, 'init_plugin'] );

        register_deactivation_hook( __FILE__, [$this, 'deactivate'] );
    }

    /**
     * Initiatizes a singleton instance
     *
     * @return /External_Link_Popup
     */
    public static function init() {

        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'External_Link_Popup_Version', time() );
        define( 'External_Link_Popup_File', __FILE__ );
        define( 'External_Link_Popup_Path', __DIR__ );
        define( 'External_Link_Popup_Url', plugins_url( '', External_Link_Popup_File ) );
        define( 'External_Link_Popup_Assets', External_Link_Popup_Url . '/assets' );
        define( 'External_Link_Popup_Plugin_Base', plugin_basename( External_Link_Popup_File ) );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        load_plugin_textdomain( 'external-link-popup', false, External_Link_Popup_Url . '/languages' );

        new Assets();

        if ( is_admin() ) {
            new Admin();
        } else {

            new Frontend();
        }

        // if ( !function_exists( 'is_user_logged_in' ) ) {
        //     require_once ABSPATH . 'wp-includes/pluggable.php';
        // }

        if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {
            new Customize();
        }
    }

    /**
     * Plugin Activation Function
     *
     * @return void
     */
    public function activate() {

        new Installer();
    }

    /**
     * Plugin Activation Function
     *
     * @return void
     */
    public function deactivate() {

        new Uninstall();
    }
}


/**
 * Initializes the main plugin
 *
 * @return /External_Link_Popup
 */
function External_Link_Popup_Run() {

    return External_Link_Popup::init();
}

// kick-off the plugin
External_Link_Popup_Run();
