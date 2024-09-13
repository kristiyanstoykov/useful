<?php
/**
 * Uninstall actions.
 *
 * @package Google Calendar
 * @author  Engenuity
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// If uninstall not called from WordPress exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
