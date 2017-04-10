<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://github.com/alleyinteractive
 * @since             1.0.0
 * @package           AI_VR
 *
 * @wordpress-plugin
 * Plugin Name:       Alley Interactive VR
 * Plugin URI:        #
 * Description:       Explore whats up with VR in Wordpress
 * Version:           1.0.0
 * Author:            Alley Interactive
 * Author URI:        http://github.com/alleyinteractive
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       AI_VR
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'AI_VR_PATH',  plugin_dir_path( __FILE__ ) );
define( 'AI_VR_URL',  plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ai-vr-activator.php
 */
function activate_ai_vr() {
	require_once AI_VR_PATH . 'includes/class-ai-vr-activator.php';
	AI_VR_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ai-vr-deactivator.php
 */
function deactivate_ai_vr() {
	require_once AI_VR_PATH . 'includes/class-ai-vr-deactivator.php';
	AI_VR_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ai_vr' );
register_deactivation_hook( __FILE__, 'deactivate_ai_vr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require AI_VR_PATH . 'includes/class-ai-vr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ai_vr() {
	$plugin = new AI_VR();
	$plugin->run();
}

run_ai_vr();
