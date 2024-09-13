<?php
/**
 * Boilerplate
 *
 * @package Boilerplate
 * @author  Author
 */

namespace Boilerplate\Inc;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Boilerplate plugin class.
 */
class Boilerplate_Plugin {

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @return void
	 */
	private static function load_dependencies() {
		// require_once BOILERPLATE_PLUGIN_PATH . 'inc/...';
	}

	/**
	 * Init plugin.
	 */
	public static function init() {

		self::load_dependencies();
		self::hooks();
		self::filters();

	}

	/**
	 * Public hooks.
	 *
	 * @return void
	 */
	private static function hooks() {
		// Admin.
		add_action( 'admin_enqueue_scripts', array( '\Boilerplate\Inc\Boilerplate_Plugin', 'admin_enqueue_scripts' ), 15 );

		// Scripts.
		add_action( 'wp_enqueue_scripts', array( '\Boilerplate\Inc\Boilerplate_Plugin', 'enqueue_scripts' ) );
	}

	/**
	 * Public filters.
	 *
	 * @return void
	 */
	private static function filters() {
		// add_filter( 'woocommerce_add_to_cart_redirect', array( "\Boilerplate\Inc\Woocommerce", 'boilerplate_add_cart_redirect_checkout' ) );
	}

	/**
	 * Admin scripts.
	 *
	 * @param  string $hook Hook.
	 * @return void
	 */
	public static function admin_enqueue_scripts( $hook ) {
		wp_enqueue_style( 'boilerplate-admin', sprintf( '%sdist/css/admin.css', BOILERPLATE_PLUGIN_URL ), array(), BOILERPLATE_PLUGIN_VERSION );
	}


	/**
	 * Scripts.
	 *
	 * @param  string $hook Hook.
	 * @return void
	 */
	public static function enqueue_scripts( $hook ) {
		wp_enqueue_style( 'boilerplate-blocks', sprintf( '%sdist/css/style.css', BOILERPLATE_PLUGIN_URL ), array(), BOILERPLATE_PLUGIN_VERSION );
	}
}
