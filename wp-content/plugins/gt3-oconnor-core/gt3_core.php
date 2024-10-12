<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeforest.net/user/gt3themes
 * @since             1.0.0
 * @package           Gt3_oconnor_core
 *
 * @wordpress-plugin
 * Plugin Name:       GT3 O'Connor Core
 * Plugin URI:        https://themeforest.net/user/gt3themes
 * Description:       Core plugin for O'Connor Theme.
 * Version:           1.1.0
 * Author:            GT3themes
 * Author URI:        https://themeforest.net/user/gt3themes
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gt3_oconnor_core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
$gt3_theme_check = wp_get_theme();
if ($gt3_theme_check->get('Name') !== 'O\'Connor' // Name
    && $gt3_theme_check->get('Template') !== 'oconnor' // Child Theme
) {
    return;
}

define( 'OCONNOR_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gt3_oconnor_core-activator.php
 */
function activate_gt3_oconnor_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gt3_oconnor_core-activator.php';
	gt3_oconnor_core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gt3_oconnor_core-deactivator.php
 */
function deactivate_gt3_oconnor_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gt3_oconnor_core-deactivator.php';
	gt3_oconnor_core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gt3_oconnor_core' );
register_deactivation_hook( __FILE__, 'deactivate_gt3_oconnor_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gt3_oconnor_core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gt3_oconnor_core() {

	$plugin = new Gt3_oconnor_core();
	$plugin->run();

}
run_gt3_oconnor_core();
