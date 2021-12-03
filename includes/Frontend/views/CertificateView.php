<?php

global $wp;
$url = home_url( $wp->request );

$data = $url.'/?certificate-id='.$certificate_id;
?>
<div class="alert alert-success px-2 my-4" role="alert">
    Congratulations, your certificate is verified by <?php echo get_bloginfo().'!'?>
</div>
<div class="certificate" id="mainCertificate">
    <div class="default-certificate-image">
        <img src="<?php echo CERTIFICATE_VERIFY_ASSETS.'/images/default-certificate.png'?>" />
        <div class="certificate-details">
            <div class="row">
                <div class="col-md-3 col-3 certificate-details-heading">
                    <h5>ID No: <p class="font-weight-bold"><?php echo $get_result->certificate_id ?></p></h5>
                    <h5>Date of Issue: <p><?php echo date('d F. Y',strtotime($get_result->issue_date));?></p></h5>
                    <canvas id="qr-code"></canvas>
                    <h5><p>Scan to Verify</b></h5>
                </div>
                <div class="col-md-9 col-9 certificate-details-name">
                    <h3><p><?php echo $get_result->student_name;?></p></h3>
                    <p><?php echo $get_result->certificate_details ?> </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="has-text-align-center mt-2">
    <a href="" class="btnSave btn btn-primary text-white" download>Download Certificate</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js" integrity="sha512-jzL0FvPiDtXef2o2XZJWgaEpVAihqquZT/tT89qCVaxVuHwJ/1DFcJ+8TBMXplSJXE8gLbVAUv+Lj20qHpGx+A==" crossorigin="anonymous"></script>

<script>
    /* JS comes here */
    var qr;
    (function() {
        qr = new QRious({
            element: document.getElementById('qr-code'),
            size: 100,
            value: '<?php echo $data; ?>'
        });
    })();
</script>

<script>

    $(function() {
        //div id
        html2canvas($("#mainCertificate"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);
                $("#img-out").append(canvas);
                var canvas = document.querySelectorAll("canvas");
                var arr = Array.from(canvas)
                arr[1].style.transform = "scale(1.9)"
                // arr[1].width=1118
                // arr[1].height=818

                // console.log(canvas)
                arr[1].style.display= "none"
                // console.log(canvas)
                var img    = arr[1].toDataURL("image/png",{ pixelRatio: 30 });
                //download button id
                $(".btnSave").attr("href",img)
                // document.body.removeChild(canvas);
            }
        });
    });
    // $('#download_certificate_btn').click(function(){
    //   alert('OK SEE NOW');
    // });

</script>
