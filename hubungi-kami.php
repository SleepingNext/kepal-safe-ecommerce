<?php
session_start();
$title = 'Contact Us';

include "template/head.php";
?>

<body>
<div id="all">
    <?php
    include "template/header.php";
    ?>
    <div id="content">
        <div class="container">
            <div class="box">
                <h2 class="text-center">CV. PERMATA OFFSET</h2>
                <h4 class="text-center">Address: Raya Indarung Street Num. 04 Tanjung Sabar Village, Padang</h4>
                <hr>
                <div class="row text-center">
                    <div class="col-sm-3">
                        <img src="<?php echo $base_url; ?>/assets/img/whatsapp.png" style="width:100%;"
                             class="assets/img-thumbnail assets/img-responsive" alt="Image"/>
                        <br><br>
                        <p class="text-center"><b>WhatsApp<br>(+62) 812-3456-7890</b></p>
                    </div>

                    <div class="col-sm-3">
                        <img src="<?php echo $base_url; ?>/assets/img/instagram.png" style="width:100%;"
                             class="assets/img-thumbnail assets/img-responsive" alt="Image"/>
                        <br><br>
                        <p class="text-center"><b>Instagram<br>@permataoffset</b></p>
                    </div>

                    <div class="col-sm-3">
                        <img src="<?php echo $base_url; ?>/assets/img/gmail.png" style="width:100%;"
                             class="assets/img-thumbnail assets/img-responsive" alt="Image"/>
                        <br><br>
                        <p class="text-center"><b>Gmail<br>permataoffset@gmail.com</b></p>
                    </div>

                    <div class="col-sm-3">
                        <img src="<?php echo $base_url; ?>/assets/img/telephone.png" style="width:100%;"
                             class="assets/img-thumbnail assets/img-responsive" alt="Image"/>
                        <br><br>
                        <p class="text-center"><b>Phone<br>(+62) 812-3456-7890</b></p>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-sm-12">
                        <p class="text-center"><b>No.Rekening</b></p>
                        <div class="row">
                            <div class="col-sm-4">CIMB: 123-45-67890-12-3</div>
                            <div class="col-sm-4">BRI: 1234-56-789012-34-5</div>
                            <div class="col-sm-4">NOBU: 123-45-67890-1</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <?php include "template/footer.php"; ?>
    </div>
    <!-- Javascript files-->
    <?php include "template/javascript.php"; ?>
</body>
</html>
