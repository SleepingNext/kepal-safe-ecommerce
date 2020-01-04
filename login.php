<?php
session_start();
$title = 'Login';
require "koneksi.php";
require_once 'googleauthenticator/PHPGangsta/GoogleAuthenticator.php';
include "template/components.php";
include "template/head.php";

if (isset($_SESSION['username'])) {
    header('Location: index.php');
}

$googleAuthenticator = new PHPGangsta_GoogleAuthenticator();

$errorMessage = "";

$loginForm = array(
    array(
        "name" => "username",
        "label" => "Username",
        "type" => "input",
        "inputType" => "text",
    ),
    array(
        "name" => "password",
        "label" => "Password",
        "type" => "input",
        "inputType" => "password",
    ),
    array(
        "name" => "mfa_code",
        "label" => "MFA Code",
        "type" => "input",
        "inputType" => "number",
    )
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $salt = "eCommerceWebsite";
    $data = $_POST;
    $result = $db->from('tbl_user')->where(array('username' => $data['username'], 'password' => hash("sha256", $data['password'].$salt)))->select()->one();
    if (empty($result)) {
        $errorMessage = alert('You entered the wrong credentials.', 'danger');
    } else {
        $checkMFA = $googleAuthenticator->verifyCode($result['mfa_secret'], $data['mfa_code'], 3);
        if ($checkMFA != 1) {
            $errorMessage = alert('You entered the wrong MFA code.', 'danger');
        } else {
            $_SESSION['username'] = $result['username'];
            $_SESSION['tipe_user'] = $result['tipe_user'];
            $_SESSION['id_user'] = $result['id_user'];
            header('Location: index.php');
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
                        <h2 class="text-uppercase">Login</h2>
                        <p>Login to make purchases.</p>
                        <hr>
                        <p><?php echo $errorMessage; ?></p>
                        <form action="login.php" method="post">
                            <?php formGenerator($loginForm); ?>
                            <div class="text-center">
                                <button type="submit" class="btn btn-template-outlined"><i class="fa fa-sign-in"></i>Login</button>
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
