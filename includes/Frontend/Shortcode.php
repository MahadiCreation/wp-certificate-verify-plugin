<?php

namespace Mahadicreation\CertificateVerify\Frontend;

class Shortcode
{
    /**
     * Initializes the class
     */
    function __construct(){
        add_shortcode('certificate', [$this, 'render_shortcode']);
    }

    /**
     * Shortcode handler class
     *
     * @param $atts
     * @param string $content
     * @return string
     */
    public function render_shortcode($atts, $content = ''){
        $certificate_id= isset($_GET['certificate-id']) ? $_GET['certificate-id'] : 0;
        $get_result = null;
        $not_found = false;
        if (isset($_GET['certificate-id'])){
            $get_result = search_certificate($certificate_id);
            //var_dump($get_result);
            if ($get_result == null){
                $not_found = true;
            }
        }
        if ($get_result != null){
            $template = __DIR__.'/views/CertificateView.php';
        }else{
            $template = __DIR__.'/views/Search.php';
        }
        if (file_exists($template)){
            include $template;
        }
    }
}