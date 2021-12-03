<?php
namespace Mahadicreation\CertificateVerify\Admin;
if (! class_exists('WP_List_Table')){
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List table class
 */
class Certificatelist extends \WP_List_Table {
    function __construct()
    {
        parent::__construct([
            'singular' => 'Certificate',
            'plural'   => 'Certificate',
            'ajax'     => false
        ]);
    }
    public function get_columns()
    {
        return [
            'cb'  => '<input type="checkbox"/>',
            'student_name' => __('Student Name', 'certificate-verify'),
            'certificate_id' => __('Certificate Id', 'certificate-verify'),
            'certificate_details' => __('Certificate Details', 'certificate-verify'),
            'issue_date' => __('Issue Date', 'certificate-verify'),
            'created_at' => __('Date', 'certificate-verify'),

        ];
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = [
            'student_name'       => [ 'student_name', true ],
            'created_at' => [ 'created_at', true ],
        ];

        return $sortable_columns;
    }
    protected function column_default( $item, $column_name ) {

        switch ( $column_name ) {

            case 'created_at':
                return wp_date( get_option( 'date_format' ), strtotime( $item->created_at ) );

            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
        }
    }


    public function column_student_name( $item ){
        $action = [];
        $action['edit'] = sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=all-certificate&action=edit&id=' . $item->id ), $item->id, __( 'Edit', 'certificate-verify' ), __( 'Edit', 'certificate-verify' ) );
        $action['delete'] = sprintf( '<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=certificate-delete&id=' . $item->id ), 'certificate-delete' ), $item->id, __( 'Delete', 'certificate-verify' ), __( 'Delete', 'certificate-verify' ) );
        return sprintf(
            '<a href="%1$s" target="_blank"><strong>%2$s</strong><a/>%3$s', site_url('certificate-verify/?certificate-id='. $item->certificate_id), $item->student_name, $this->row_actions( $action )
        );
    }
  protected function column_cb($item)
  {
      return sprintf(
          '<input type="checkbox" name="certificate_id[]" value="%d" />', $item->id
      );
  }

    public function prepare_items()
    {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [ $column, $hidden, $sortable ];

        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;
        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'] ;
        }
        $this->items = get_certificate($args);

        $this->set_pagination_args([
            'total_items' => all_certificate_count(),
            'per_page' => $per_page,
        ]);
    }
}