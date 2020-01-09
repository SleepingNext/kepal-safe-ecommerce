<?php
	require_once __DIR__ . '/vendor/autoload.php';
	include "db.php";
	$base_url = "https://kepal-ecommerce.herokuapp.com/";
//	$base_url = "https://localhost/skripsi/";
	$db = new Sparrow();
	$db->show_sql = true;
	$db->setDb("mysqli://b07e7a8f565913:4b484d0b@us-cdbr-iron-east-05.cleardb.net/heroku_6755fb779f11b5f?reconnect=true");
//	$db->setDb("mysqli://root:@localhost/dbsouvenir");
	function cekLogin($userType){
		$username = $_SESSION['username'];
		if(!isset($username)){
			header('Location: '. $base_url .'login.php');
		}else{
			if($_SESSION['tipe_user'] != $userType && $userType != 'all'){
				header('Location: ' . $base_url);
			}
		}
	}
	$msg = new \Plasticbrain\FlashMessages\FlashMessages();
?>
