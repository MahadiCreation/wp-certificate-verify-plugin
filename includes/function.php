<?php
/**
 * Insert a new certificate
 * @param array $args
 * @return int
 */
function certificate_insert( $args = [] ){
    global $wpdb;
    if (empty($args['student_name'])){
        return new \WP_Error('no-name', __('You must provide a name.', 'certificate-verify'));
    }
    $defaults = [
        'student_name' => '',
        'issue_date' => '',
        'certificate_details' => '',
        'certificate_id' => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time('mysql'),
    ];
    $data = wp_parse_args($args, $defaults);
    if (isset( $data['id']) ){

        $id = $data['id'];
        unset( $data['id'] );

        $updated = $wpdb->update(
            $wpdb->prefix . 'mahadi_certificate',
            $data,
            [ 'id' => $id ],
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
                '%s',
            ],
            [ '%d' ]
        );

        return $updated;
    }
    else{
        $inserted = $wpdb->insert(
            "{$wpdb->prefix}mahadi_certificate",
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
                '%s',
            ]
        );
        if ( ! $inserted ){
            return new \WP_Error('failed-to-insert', __('Faield to add certificate', 'certificate-verify'));
        }
        return $wpdb->insert_id;
    }
}

/**
 * Featch all certificate
 *
 * @param array $args
 * @return array|object|null
 */
function get_certificate( $args = [] ){
    global $wpdb;
    $defaults = [
        'number' => 20,
        'offset' => 0,
        'orderby' => 'id',
        'order'  => 'ASC'
    ];

    $args = wp_parse_args($args, $defaults);

    $items = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}mahadi_certificate
                    ORDER BY {$args['orderby']} {$args['order']}
                    LIMIT %d, %d",
                    $args['offset'], $args['number']
        )
    );
    return $items;
}

/**
 * Get the count the all certificate
 *
 * @return int
 */
function all_certificate_count(){
    global $wpdb;
    return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}mahadi_certificate" );
}

/**
 * Fetch a single edit data
 * @param $id
 * @return array|object|void|null
 */
function edit_certificate( $id ){
    global $wpdb;

    return $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}mahadi_certificate WHERE id = %d", $id
        )
    );
}

/**
 * Delete the single value from table
 * @param $id
 * @return bool|int
 */
 function delete_certificate( $id ){
    global $wpdb;
    return $wpdb->delete(
        $wpdb->prefix . 'mahadi_certificate',
        ['id' => $id],
        ['%d']
    );
 }

 function search_certificate( $certificate_id ){
     global $wpdb;

     return $wpdb->get_row(
         $wpdb->prepare(
             "SELECT * FROM {$wpdb->prefix}mahadi_certificate WHERE certificate_id = %s", $certificate_id
         )
     );
 }