<?php
namespace Mahadicreation\CertificateVerify;

class Installer{
    /**
     * Run the installer
     *
     * @return void
     */
    public function run(){
        $this->add_version();
        $this->create_table();
    }

    public function add_version(){
        $instlled = get_option('certificate_verify_installed');
        /**
         * Check if already installed this plugin
         */
        if ( ! $instlled ) {
            update_option('certificate_verify_installed', time());
        }
        update_option('certificate_verify_version', CERTIFICATE_VERIFY_VERSION);
    }

    /**
     * Create necessary tables
     *
     * @return void
     */
    public function create_table(){
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}mahadi_certificate` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `student_name` varchar(255) NOT NULL DEFAULT '',
          `issue_date` varchar(255) NOT NULL DEFAULT '',
          `certificate_details` varchar(255) DEFAULT NULL,
          `certificate_id` varchar(30) DEFAULT NULL,
          `created_by` bigint(20) unsigned NOT NULL,
          `created_at` datetime NOT NULL,
          PRIMARY KEY (`id`)
        ) $charset_collate";
        if ( ! function_exists('dbDelta') ){
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }
        dbDelta( $schema );
    }
}