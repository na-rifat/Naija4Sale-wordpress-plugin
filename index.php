<?php
/*
Plugin Name: Naija4Sale
Plugin URI: https://naija4sale.rafalotech.com
Description: Adds more advance functionality
Version: 1.0
Author: Rafalo Tech
Author URI: https://rafalotech.com
Text Domain: naija
Domain Path: /languages
 */
namespace Naija;

use Naija\Admin\Menu;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin handler class
 */
final class Naija {

    /**
     * Holds the plugin version
     */
    public const version = '1.0';

    /**
     * Build the class
     */
    function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'activate'] );

        add_action( 'plugins_loaded', [$this, 'init_plugin'] );
    }
    public function activate() {

    }

    /**
     * Creates instance of the class
     *
     * @return void
     */
    public static function init() {
        $instance = false;
        if ( !$instance ) {
            $instance = new self();
        }
    }
    /**
     * Initializes the plugin
     *
     * @return void
     */
    public function init_plugin() {
        new Assets();
        new Frontend();
        new Captcha();
        new Trustedbadge();        

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new Ajax();
        }

        if ( is_admin() ) {
            new Menu();
        } else {

        }
    }

    /**
     * Defines important constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'NAIJA_VERSION', self::version );
        define( 'NAIJA_PATH', __DIR__ );
        define( 'NAIJA_FILE', __FILE__ );
        define( 'NAIJA_PLUGIN_PATH', plugins_url( '', NAIJA_FILE ) );
        define( 'NAIJA_ASSETS', NAIJA_PLUGIN_PATH . '/assets' );
        define( 'NAIJA_JS', NAIJA_ASSETS . '/js' );
        define( 'NAIJA_CSS', NAIJA_ASSETS . '/css' );
        define( 'NAIJA_IMAGES', NAIJA_ASSETS . '/images' );
        define('NAIJA_FUNCTIONS', __DIR__  . '/includes/functions.php');
    }
}
function naija() {
    return Naija::init();
}
naija();