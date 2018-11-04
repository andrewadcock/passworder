<?php

/**
 * Passworder bootstrap
 *
 * Plugin bootstrap
 *
 * @link              https://andrewadcock.com/passworder
 * @since             0.0.1
 * @package           Passworder
 *
 * @passworder
 * Plugin Name:       Passworder
 * Plugin URI:        https://andrewadcock.com/passworder
 * Description:       A plugin to assist in updating user passwords.
 * Version:           0.0.1
 * Author:            Andrew Adcock
 * Author URI:        https://andrewadcock.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       passworder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Current plugin version.
 */
define( 'PASSWORDER_VERSION', '0.0.1' );

/**
 * Minimum version of PHP supported.
 */
define( 'PASSWORDER_PHP_MIN_VERSION', '7.0');

/**
 * Minimum version of WordPress supported.
 */
define( 'PASSWORDER_WP_MIN_VERSION', '4.9');

/**
 * Core plugin functionality
 */
require plugin_dir_path( __FILE__ ) . 'inc/core/Passworder.php';

/**
 * Starts Passworder
 *
 * Starts the core of Passworder which relies on hooks to function.
 *
 * @since    0.0.1
 */
function passworder_init() {

    $plugin = new Passworder();
    $plugin->init();

}

/**
 * Environment checker
 *
 * Check to make sure the minimum version of PHP and WordPress are being used. If not, deactivate the plugin to avoid
 * fatal errors.
 */
require_once('inc/EnvironmentChecker.php');

$passworderEnvCheck= new \PassworderEnvironmentChecker( [
    'title' => 'Passworder',
    'php'   => PASSWORDER_PHP_MIN_VERSION,
    'wp'    => PASSWORDER_WP_MIN_VERSION,
    'file'  => __FILE__,
]);

if ( $passworderEnvCheck->passes() ) {

    /**
     * Initialize plugin code
     */
    passworder_init();
}

// Clean up
unset( $passworderEnvCheck );
