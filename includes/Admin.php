<?php
namespace Mahadicreation\CertificateVerify;

/**
 * The admin class
 */
class Admin{
    function __construct()
    {
        $allCertificate = new Admin\AllCertificate();
        $this->dispath_actions($allCertificate);

        new Admin\Menu($allCertificate);
    }

    public function dispath_actions($allCertificate){
        add_action('admin_init', [$allCertificate, 'submit_certificate_handler']);
        add_action('admin_post_certificate-delete', [$allCertificate, 'delete_certificate']);
    }
}