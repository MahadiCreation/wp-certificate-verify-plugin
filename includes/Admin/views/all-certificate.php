<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('All Certificate', 'certificate-verification'); ?></h1>
    <a href="<?php echo admin_url('admin.php?page=all-certificate&action=new')?>" class="page-title-action">Add New</a>
    <?php if (isset( $_GET['inserted'] )) { ?>
        <div class="notice notice-success">
            <p><?php _e('Certificate has been added successfully done', 'certificate-verify'); ?></p>
        </div>
    <?php } ?>
    <?php if (isset( $_GET['certificate-deleted'] )) { ?>
        <div class="notice notice-success">
            <p><?php _e('Certificate has been deleted successfully done', 'certificate-verify'); ?></p>
        </div>
    <?php }?>
    <form action="" method="post">
        <?php
          $table = new \Mahadicreation\CertificateVerify\Admin\Certificatelist();
          $table->prepare_items();
          $table->display();

        ?>
    </form>
</div>