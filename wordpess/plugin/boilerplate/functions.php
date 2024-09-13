<?php
/**
 * Functions.
 *
 * @package Boilerplate
 * @author  Author
 */


/**
 * Check if requirements are ok.
 *
 * @return bool
 */
function boilerplate_plugin_requirements() {
	// Check if all requirements are ok.
	$php_version = version_compare( PHP_VERSION, BOILERPLATE_PLUGIN_MIN_PHP_VER, '>=' );

	return $php_version;
}


/**
 * Requirements error message.
 *
 * @return void
 */
function boilerplate_plugin_requirements_error() {
	global $pagenow;

	if ( 'plugins.php' !== $pagenow ) {
		return;
	}

	?>
	<div class="notice notice-error">
		<p>
			<?php
			printf(
				// translators: %1$s is plugin name, %2$s is PHP version.
				esc_html__( '<strong>%1$s</strong> needs PHP version %2$s.', 'boilerplate' ),
				BOILERPLATE_PLUGIN_NAME,
				esc_html( BOILERPLATE_PLUGIN_MIN_PHP_VER )
			);
			?>
			</strong>
		</p>
	</div>
	<?php
}


/**
 * Init.
 *
 * @return void
 */
function boilerplate_plugin_init() {
    // Check requirements.
    if ( boilerplate_plugin_requirements() ) {
		require_once BOILERPLATE_PLUGIN_PATH . 'inc/class-boilerplate-plugin.php';
    	\Boilerplate\Inc\Boilerplate_Plugin::init();
    } else {
    	add_action( 'admin_notices', 'boilerplate_plugin_requirements_error' );
    }
}


/**
 * Activate plugin.
 *
 * @return void
 */
function boilerplate_plugin_activate() {}

/**
 * Deactivate plugin.
 *
 * @return void
 */
function boilerplate_plugin_deactivate() {}