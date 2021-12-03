<?php

namespace Mahadicreation\CertificateVerify;
/**
 * Assets handlers class
 */
class Assets{
    function __construct(){
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets(){
        wp_enqueue_style('certificate-styles',CERTIFICATE_VERIFY_ASSETS.'/css/Certificate.css',true, CERTIFICATE_VERIFY_VERSION);
        wp_enqueue_style('certificate-bootstarp-style',CERTIFICATE_VERIFY_ASSETS.'/css/bootstarp.css',true, CERTIFICATE_VERIFY_VERSION);
    }
}
