<div class="wrap">
    <h1><?php _e('Add New Certificate', 'certificate-verification'); ?></h1>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="name"><?php _e('Student Name', 'certificate-verification') ?></label>
                    </th>
                    <td>
                        <input type="text" name="student_name" id="name" class="reqular-text" value="" />
                        <?php if ($this->has_error('student_name')) { ?>
                            <p class="description error" style="color:red"><?php echo $this->get_error('student_name')?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="certificate_id"><?php _e('Certificate Id', 'certificate-verification') ?></label>
                    </th>
                    <td>
                        <input type="text" name="certificate_id" id="certificate_id" class="reqular-text" value="" />
                        <?php if ($this->has_error('student_id')) { ?>
                            <p class="description error" style="color:red"><?php echo $this->get_error('student_id')?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="issue_date"><?php _e('Date of Issue', 'certificate-verification') ?></label>
                    </th>
                    <td>
                        <input type="date" name="issue_date" id="issue_date" class="reqular-text" value="" />
                        <?php if ($this->has_error('issue_date')) { ?>
                            <p class="description error" style="color:red"><?php echo $this->get_error('issue_date')?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="certificate_details"><?php _e('Certificate Details', 'certificate-verification') ?></label>
                    </th>
                    <td>
                        <?php wp_editor( '' , 'desired_id_of_textarea', $settings = array('textarea_name'=>'certificate_details') ); ?>
                        <?php if ($this->has_error('certificate_details')) { ?>
                            <p class="description error" style="color:red"><?php echo $this->get_error('certificate_details')?></p>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php wp_nonce_field('add-new-certificate'); ?>
        <?php submit_button(__('Add Certificate', 'certificate-verify'), 'primary', 'submit_certificate'); ?>
    </form>
</div>