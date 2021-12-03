<?php

namespace Mahadicreation\CertificateVerify\Admin;
use Mahadicreation\CertificateVerify\Traits\From_Error;
class AllCertificate
{
    use From_Error;
    public function plugin_page(){
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        switch ( $action ){
            case 'new':
                $template = __DIR__.'/views/add-certificate.php';
                break;

            case 'edit':
                $certificate = edit_certificate($id);
                $template = __DIR__.'/views/edit-certificate.php';
                break;

            case 'view':
                $template = __DIR__.'/views/view-certificate.php';
                break;

            default:
                $template = __DIR__.'/views/all-certificate.php';
                break;
        }

        if (file_exists($template)){
            include $template;
        }
    }

    /**
     * Handler submit certificate form
     * @return void
     */
    public function submit_certificate_handler(){
        if ( ! isset($_POST['submit_certificate']) ){
            return;
        }
        if ( ! wp_verify_nonce($_POST['_wpnonce'], 'add-new-certificate')){
            wp_die('Are you cheating?');
        }

        if ( ! current_user_can('manage_options')){
            wp_die('Are you cheating?');
        }
    $id = isset($_POST['update_id']) ? intval($_POST['update_id']) : 0;
    $student_name = isset($_POST['student_name']) ? sanitize_text_field($_POST['student_name']) : '';
    $certificate_id = isset($_POST['certificate_id']) ? sanitize_text_field($_POST['certificate_id']) : '';
    $issue_date = isset($_POST['issue_date']) ? sanitize_text_field($_POST['issue_date']) : '';
    $certificate_details = isset($_POST['certificate_details']) ? $_POST['certificate_details'] : '';

        if ( empty($student_name)){
            $this->errors['student_name'] = __('Please provide a student name');
        }
        if ( empty($certificate_id)){
            $this->errors['certificate_id'] = __('Please provide a certificate id');
        }
        if ( empty($issue_date)){
            $this->errors['issue_date'] = __('Please provide a issue date');
        }
        if ( empty($certificate_details)){
            $this->errors['certificate_details'] = __('Please provide a certificate details');
        }

        if (!empty($this->errors)){
            return;
        }
        $args = [
            'student_name' => $student_name,
            'certificate_id' => $certificate_id,
            'issue_date' => $issue_date,
            'certificate_details' => $certificate_details,
        ];
        if ($id){
            $args['id'] = $id;
        }
       $insert_id = certificate_insert($args);
       if (is_wp_error($insert_id)){
            wp_die($insert_id->get_error_message());
       }
       if ($id){

           $redirect_to = admin_url('admin.php?page=all-certificate&certificate-update=true&action=edit&id='.$id);
       }
       else{
           $redirect_to = admin_url('admin.php?page=all-certificate&inserted=true', 'admin');
       }
       wp_redirect($redirect_to);
        exit;
    }

    public function delete_certificate(){
        if ( ! wp_verify_nonce($_REQUEST['_wpnonce'], 'certificate-delete')){
            wp_die('Are you cheating?');
        }

        if ( ! current_user_can('manage_options')){
            wp_die('Are you cheating?');
        }
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        $deleted = delete_certificate($id);
        if ($deleted){
            $redirect_to = admin_url('admin.php?page=all-certificate&certificate-deleted=true', 'admin');
        }else{
            $redirect_to = admin_url('admin.php?page=all-certificate&ertificate-deleted=false', 'admin');
        }
        wp_redirect($redirect_to);
        exit;
    }
}