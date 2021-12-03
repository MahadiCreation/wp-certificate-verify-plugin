<div class="certificate-container mt-5">
    <?php if ($not_found) { ?>
    <div class="alert alert-danger mt-5" role="alert">
        This Certificate ID has not been valid or issued yet.
    </div>
    <?php }?>
    <form action="" method="get">
        <div class="row">
            <div class="col-lg-12">
                <div class="row form">
                    <div class="col-lg-12 form-head mb-3">
                        <h3>Check Your Certificate</h3>
                    </div>
                    <div class="col-lg-8 col-sm-12 pr-lg-0">
                        <input type="text" placeholder="Certificate ID*" name="certificate-id" class="form-control" value="" style="border-top-right-radius: 0;border-bottom-right-radius: 0;height: 49px;" required>
                    </div>
                    <div class="col-lg-4 col-sm-12 pl-lg-0">
                            <button type="submit" class="btn btn-danger" style="border-top-left-radius: 0; border-bottom-left-radius: 0; padding: 11px 10px">Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>