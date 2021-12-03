<?php
namespace Mahadicreation\CertificateVerify\Admin;

/**
 * The menu handler class
 */
class Menu
{
    public $allCertificate;

    function __construct($allCertificate){
        $this->allCertificate = $allCertificate;
        add_action('admin_menu', [$this, 'custom_menu']);
    }
    public function custom_menu(){
        $menu_slug = 'certificate-verify';
        $capability = 'manage_options';

        add_menu_page(__('Certificate Verify', 'certificate-verify'), __('Certificate Verify', 'certificate-verify'), $capability, $menu_slug, [$this, 'plugin_page'],'dashicons-welcome-learn-more');
        add_submenu_page($menu_slug, __('All Certificate', 'all-certificate'), __('All Certificate', 'all-certificate'), $capability ,'all-certificate', [$this, 'all_certificate']);
    }

    public function plugin_page(){
        $doc = __DIR__.'/views/Documentation.php';
        if (file_exists($doc)){
            include $doc;
        }
    }

    public function all_certificate(){
        $this->allCertificate->plugin_page();
    }
}