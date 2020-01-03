<?php
session_start();
$title = 'About Us';

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
                <h2>About Us</h2>
                <ol>
                    <li>Our Manager: Vetra Mardino.</li>
                    <li>We provide invitation card and souvenir.</li>
                    <li>Trying to provide the best and fast service.</li>
                    <li>Trying to provide products suit the customers' needs.</li>
                    <li>Customers can purchase products online.</li>
                    <li>Maintaining quality by providing products that fulfill customer satisfaction.</li>
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
