<?php
	require_once __DIR__ . '/vendor/autoload.php';
	include "db.php";
	$base_url = "http://localhost/skripsi/";
	$db = new Sparrow();
	$db->show_sql = true;
	$db->setDb("mysqli://root@localhost/dbsouvenir");
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
