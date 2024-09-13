<?php
/**
 * Plugin Name: Boilerplate
 * Description: Plugin provides additional functionalities for SiteName's website
 * Version: 1.0.0
 * Author: Author
 * Text Domain: boilerplate-text-domain
 * Domain Path: /languages
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * WC requires at least: 3.0
 * WC tested up to: 7.5.0
 *
 * @package Boilerplate
 * @author  Author
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Set constants.
define( 'BOILERPLATE_PLUGIN_NAME', 'Boilerplate' );
define( 'BOILERPLATE_PLUGIN_VERSION', '1.0.0' );
define( 'BOILERPLATE_PLUGIN_MIN_PHP_VER', '7.4.0' );
define( 'BOILERPLATE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'BOILERPLATE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load the textdomain.
load_plugin_textdomain( 'boilerplate-text-domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

// Includes.
require_once BOILERPLATE_PLUGIN_PATH . 'functions.php';

add_action( 'plugins_loaded', 'boilerplate_plugin_init' );

/**
 * Register deactivation hook.
 */
register_deactivation_hook( __FILE__, 'boilerplate_plugin_deactivate' );
