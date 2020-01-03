<!-- Top bar-->
<div class="top-bar">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 d-md-block d-none">
                <p>Selling Invitation Card and Souvenir</p>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-md-end justify-content-between">
                    <?php
                    if (!isset($_SESSION['username'])) {
                        ?>
                        <div class="login">
                            <a href="<?php echo $base_url . "/login.php"; ?>" class="login-btn">Login</a>
                            <a href="<?php echo $base_url . "/registrasi.php"; ?>" class="signup-btn">Register</a>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="login">
                            <a href="#" class="login-btn"><?php echo "Hello, " . $_SESSION['username']; ?></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top bar end-->
