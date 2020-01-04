<?php
session_start();
$title = 'Registration';
require "koneksi.php";
require_once 'googleauthenticator/PHPGangsta/GoogleAuthenticator.php';

if (isset($_SESSION['username'])) {
    header('Location: index.php');
}

$googleAuthenticator = new PHPGangsta_GoogleAuthenticator();

$mfaSecret = $googleAuthenticator->createSecret();
$qrCode = "";

$errorMessage = "";
$registrationMessage = "";

$registrationForm = array(
    array(
        "name" => "username",
        "label" => "Username",
        "type" => "input",
        "inputType" => "text",
    ),
    array(
        "name" => "email",
        "label" => "Email",
        "type" => "input",
        "inputType" => "email",
    ),
    array(
        "name" => "password",
        "label" => "Password",
        "type" => "input",
        "inputType" => "password",
    )
);

include "template/components.php";
include "template/head.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $salt = "eCommerceWebsite";
    $data = $_POST;
    $usernameAvailabilityCheck = $db->from('tbl_user')->where('username', $data['username'])->select('username')->many();
    $emailAvailabilityCheck = $db->from('tbl_user')->where('email', $data['email'])->select('username')->many();
    $data['password'] = hash("sha256", $data['password'].$salt);
    $data['tipe_user'] = 'Pelanggan';
    $data['mfa_secret'] = $mfaSecret;

    if (count($usernameAvailabilityCheck) != 0) $errorMessage = "username";
    else if (count($emailAvailabilityCheck) != 0) $errorMessage = "email";
    else {
        $result = $db->from('tbl_user')->insert($data)->execute();
        if ($result) $errorMessage = "success";
        else $errorMessage = "db";
    }
    if ($errorMessage != "") {
        switch ($errorMessage) {
            case 'db' :
                $registrationMessage = alert('Terjadi kesalahan pada aplikasi!', 'danger');
                break;
            case 'username' :
                $registrationMessage = alert('Username sudah digunakan', 'danger');
                break;
            case 'email' :
                $registrationMessage = alert('Email sudah digunakan', 'danger');
                break;
            case 'success' :
                $registrationMessage = alert('Registrasi berhasil. Silahkan login.', 'success');
                $qrCode = $googleAuthenticator->getQRCodeGoogleUrl($data['username'], $data['mfa_secret']);
                break;
        }
    }
}

?>

<body>
<div id="all">
    <?php include "template/header.php"; ?>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <h2 class="text-uppercase">Registration</h2>
                        <p>All purchases can only happen after you registered an account.</p>
                        <hr>
                        <p><?php echo $registrationMessage; ?></p>
                        <form action="registrasi.php" method="post">
                            <?php formGenerator($registrationForm); ?>
                            <div class="text-center">
                                <?php
                                if ($qrCode != "") {
                                    echo "<img src='$qrCode' alt='QR Code'><br><br>";
                                }
                                ?>
                                <button type="submit" class="btn btn-template-outlined"><i class="fa fa-user-md"></i>Register</button>
                            </div>
                        </form>
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
