<?php
session_start();
$title = "How To Purchase";

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
                <div class="box-body">
                    <h2>How To Purchase</h2>
                    <ol>
                        <li>Register a new account and login with the newly registered account.</li>
                        <li>Choose the product wanted to be purchased.</li>
                        <li>Fill the right information about the product when purchasing.</li>
                        <li>Check the information before committing the purchase.</li>
                        <li>Finish the payment and upload the proof of payment.</li>
                        <li>The product will be processed as quickly as possible.</li>
                    </ol>
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
