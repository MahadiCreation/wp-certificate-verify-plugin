<?php
/**
 * Plugin Name:       Certificate verify
 * Plugin URI:        https://facebook.com/mahadi.creation/
 * Description:       This plugin develop for wordpress online course certificate verification system
 * Version:           1.0.0
 * Author:            Mahadi Hasan
 * Author URI:        https://facebook.com/mahadi.creation/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( !defined('ABSPATH') ){
    exit;
}
require_once __DIR__ .'/vendor/autoload.php';

/**
 The main plugin class
 */
final class Certificate_verify{
    /**
     * Plugin version
     */
    const version = '1.0';
    /**
     * class constructor
     */
    private function __construct(){
        $this->define_constants();
        register_activation_hook( __FILE__, [ $this, 'activate',  ] );

        // if plugin activate call the funtion below init_plugin
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes a singleton instance
     * @return Certificate_verify|false
     */
    public static function init(){
        static $instance = false;

        if ( ! $instance ){
            $instance = new self();
        }
        return $instance;
    }

    /**
     * Define the required plugin constance
     * @return void
     */
    public function define_constants(){
        define('CERTIFICATE_VERIFY_VERSION', self::version);
        define('CERTIFICATE_VERIFY_FILE', __FILE__);
        define('CERTIFICATE_VERIFY_PATH', __DIR__);
        define('CERTIFICATE_VERIFY_URL', plugins_url('', CERTIFICATE_VERIFY_FILE));
        define('CERTIFICATE_VERIFY_ASSETS', CERTIFICATE_VERIFY_URL . '/assets');
    }
    /*
     * Initialize the plugin
     */
    public function init_plugin(){
        new \Mahadicreation\CertificateVerify\Assets();
        if (is_admin()){
            new Mahadicreation\CertificateVerify\Admin();
        }else{
            new \Mahadicreation\CertificateVerify\Frontend();
        }
    }

    /**
     * do stuff upon activation
     * @return void
     */
    public function activate(){
        $installer = new Mahadicreation\CertificateVerify\Installer();
        $installer->run();
    }
}

/**
 *  Initializes the main plugin
 * @return Certificate_verify|false
 */
function certificate_verify(){
    return Certificate_verify::init();
}
// kick-off the plugin
certificate_verify();
