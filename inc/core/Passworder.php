<?php

/**
 * The core of the plugin
 *
 * Functionality needed to set up pluugin.
 *
 * @since       0.0.1
 *
 * @package Passworder
 * @subpackage Passworder/inc/core/
 */

class Passworder {

    public function __construct()
    {

        if ( defined( 'PASSWORDER_VERSION' ) ) {
            $this->version = PASSWORDER_VERSION;
        } else {
            $this->version = '0.0.1';
        }
        $this->plugin_name = 'passworder';

        $this->requirements();
    }

    public function init()
    {

    }

    /**
     * Load required classes.
     *
     * Load class files needed for functionality. Additional modules will be enabled/disabled elsewhere.
     *
     * @since    0.0.1
     * @access   private
     */
    private function requirements() {

        /**
         * Create options page
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'core/Options.php';

        /**
         * Email Password Reset
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'email/Email.php';

    }
}
