<?php
/**
 * Class PassworderEnvironmentChecker
 *
 * This class checks the environment for minimum requirements. If minimums are not met, the plugin is deactivated and
 * an error message is returned to the user. This is HEAVILY influenced by Mark Jaquiths article "Handling old WordPress
 * and PHP versions in your plugin".
 *
 * @package Passworder
 */

class PassworderEnvironmentChecker {

    private $title = '';

    private $php = '7.0';

    private $wp = '4.9';

    private $file;


    public function __construct( $args ) {
        foreach ( array( 'title', 'php', 'wp', 'file' ) as $setting ) {
            if ( isset( $args[$setting] ) ) {
                $this->$setting = $args[$setting];
            }
        }
    }

    public function passes() {
        $passes = $this->php_passes() && $this->wp_passes();
        if ( ! $passes ) {
            add_action( 'admin_notices', array( $this, 'deactivate' ) );
        }
        return $passes;
    }

    public function deactivate() {
        if ( isset( $this->file ) ) {
            deactivate_plugins( plugin_basename( $this->file ) );
        }
    }

    private function php_passes() {
        if ( $this->__php_at_least( $this->php ) ) {
            return true;
        } else {
            add_action( 'admin_notices', array( $this, 'php_version_notice' ) );
            return false;
        }
    }

    private static function __php_at_least( $min_version ) {
        return version_compare( phpversion(), $min_version, '>=' );
    }

    public function php_version_notice() {
        echo '<div class="error">';
        echo "<p>The &#8220;" . esc_html( $this->title ) . "&#8221; plugin cannot run on PHP versions older than " . $this->php . '. Please contact your host and ask them to upgrade.</p>';
        echo '</div>';
    }

    private function wp_passes() {
        if ( $this->__wp_at_least( $this->wp ) ) {
            return true;
        } else {
            add_action( 'admin_notices', array( $this, 'wp_version_notice' ) );
            return false;
        }
    }

    private static function __wp_at_least( $min_version ) {
        return version_compare( get_bloginfo( 'version' ), $min_version, '>=' );
    }

    public function wp_version_notice() {
        echo '<div class="error">';
        echo "<p>The &#8220;" . esc_html( $this->title ) . "&#8221; plugin cannot run on WordPress versions older than " . $this->wp . '. Please update WordPress.</p>';
        echo '</div>';
    }
}
