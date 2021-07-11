<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://benoithubert.me
 * @since             1.0.0
 * @package           Access_Log
 *
 * @wordpress-plugin
 * Plugin Name:       Access Log
 * Plugin URI:        https://benoithubert.me/wordpress/wp-access-log
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Benoît Hubert
 * Author URI:        https://benoithubert.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       access-log
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ACCESS_LOG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-access-log-activator.php
 */
function activate_access_log() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-access-log-activator.php';
	Access_Log_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-access-log-deactivator.php
 */
function deactivate_access_log() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-access-log-deactivator.php';
	Access_Log_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_access_log' );
register_deactivation_hook( __FILE__, 'deactivate_access_log' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-access-log.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_access_log() {

	$plugin = new Access_Log();
	$plugin->run();

}
run_access_log();
