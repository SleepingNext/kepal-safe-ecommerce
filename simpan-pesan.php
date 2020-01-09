<?php
session_start();
require "koneksi.php";
require "RSA.php";
$data = $_POST;
$now = DateTime::createFromFormat('U.u', microtime(true));
$id_pemesanan = $now->format("mdYHisu");
	$pemesanan = array(
	"id_pemesanan"		=> $id_pemesanan,
	"nama_pemesan"		=> encrypt($data['nama_pemesan']),
	"alamat_pemesan"	=> encrypt($data['alamat_pemesan']),
	"no_telp"			=> encrypt($data['no_telp']),
	"id_user"			=> $_SESSION['id_user'],
	"total_harga"		=> encrypt($data['total_harga']),
	"jumlah_pesan"		=> encrypt($data['jumlah_pesan']),
	"id_kota"			=> encrypt($data['id_kota']),
	"id_produk"			=> encrypt($data['id_produk'])
	);
	$db->from('tbl_pemesanan')->insert($pemesanan)->execute();
	if($data['jenis_produk'] == 'Undangan'){
		$detail = array(
			"nama_mempelai"		=> encrypt($data['nama_mempelai']),
			"nama_orangtua"		=> encrypt($data['nama_orangtua']),
			"tgl_akadnikah"		=> encrypt($data['tgl_akadnikah']),
			"tgl_resepsi"		=> encrypt($data['tgl_resepsi']),
			"waktu_akadnikah"	=> encrypt($data['waktu_akadnikah']),
			"waktu_resepsi"		=> encrypt($data['waktu_resepsi']),
			"alamat_akadnikah"	=> encrypt($data['alamat_akadnikah']),
			"alamat_resepsi"	=> encrypt($data['alamat_resepsi']),
			"anggota_keluarga"	=> encrypt($data['anggota_keluarga']),
			"foto_lokasi"		=> encrypt($data['foto_lokasi']),
			"id_pemesanan"		=> $id_pemesanan
		);
		$db->from('tbl_detail_pesanan')->insert($detail)->execute();
	}
$msg->info('You have successfully purchased the product. Please confirm your payment in the Transaction menu.');
header('Location: index.php');
?>
