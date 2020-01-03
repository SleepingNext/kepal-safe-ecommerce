<?php
session_start();
require "koneksi.php";
$title = 'Transactions';

cekLogin('Pelanggan');

$tableConf = array(
    array(
        "name" => "nama_pemesan",
        "caption" => "Nama Pemesan"
    ),
    array(
        "name" => "total_harga",
        "caption" => "Total Harga"
    ),
    array(
        "name" => "tgl_pesan",
        "caption" => "Tanggal Pesan"
    ),
    array(
        "name" => "status_pembayaran",
        "caption" => "Status Pembayaran"
    )
);

include "template/components.php";
include "template/head.php";
?>

<body>
<div id="all">
    <?php
    include "template/header.php";

    if (isset($_GET['id_pemesanan'])) {
        $detail = $db->from('tbl_pemesanan')
            ->leftJoin('tbl_pembayaran', array('tbl_pemesanan.id_pemesanan' => 'tbl_pembayaran.id_pemesanan'))
            ->join('tbl_produk', array('tbl_pemesanan.id_produk' => 'tbl_produk.id_produk'))
            ->join('tbl_kota', array('tbl_pemesanan.id_kota' => 'tbl_kota.id_kota'))
            ->where('tbl_pemesanan.id_pemesanan', $_GET['id_pemesanan'])
            ->where('id_user', $_SESSION['id_user'])
            ->select(array('tbl_pemesanan.*', 'tbl_pembayaran.status_pembayaran', 'tbl_produk.*', 'tbl_kota.*'))
            ->one();
    } else $dataTable = $db->from('tbl_pemesanan')
        ->distinct()
        ->leftJoin('tbl_pembayaran', array('tbl_pemesanan.id_pemesanan' => 'tbl_pembayaran.id_pemesanan'))
        ->where('id_user', $_SESSION['id_user'])
        ->select(array('tbl_pemesanan.*', 'tbl_pembayaran.status_pembayaran'))
        ->many();
    ?>
    <div id="content">
        <div class="container">
            <div class="row bar mb-0">
                <div class="col-md-12">
                    <?php
                    $msg->display();

                    if (isset($_GET['id_pemesanan'])) {
                        $pictures = $db->from('tbl_foto_produk')->where('id_produk', $detail['id_produk'])->select()->many();
                        ?>
                        <h2>Purchased Products</h2>
                        <hr>
                        <div class="products-big">
                            <div class="row products">
                                <?php
                                foreach ($pictures as $picture) {
                                    ?>
                                    <div class="col-md-4 col-xs-12">
                                        <div class="product">
                                            <div class="image">
                                                <img src="<?php echo $base_url; ?>/produk/<?php echo $picture['foto_produk']; ?>"
                                                     alt="" class="img-fluid image1">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <h2>Detail of Transaction</h2>
                        <hr>
                        <?php
                        if (empty($detail)) {
                            alert('danger', 'Transaction not found');
                        } else {
                            $detailForm = array(
                                array(
                                    "name" => "input_group",
                                    "list" => array(
                                        array(
                                            "name" => "nama_pemesan",
                                            "label" => "Nama Pemesan",
                                            "type" => "input",
                                            "inputType" => "text",
                                            "col" => "12",
                                            "value" => $detail['nama_pemesan'],
                                            "readonly" => true
                                        ),
                                        array(
                                            "name" => "id_kota",
                                            "label" => "Kota Tujuan",
                                            "type" => "input",
                                            "inputType" => "text",
                                            "col" => "12",
                                            "value" => $detail['nm_kota'] . " (Biaya pengiriman " . $detail['tarif'] . ")",
                                            "readonly" => true
                                        ),
                                        array(
                                            "name" => "alamat_pemesan",
                                            "label" => "Alamat Pemesan",
                                            "type" => "textarea",
                                            "inputType" => "text",
                                            "col" => "12",
                                            "value" => $detail['alamat_pemesan'],
                                            "readonly" => true
                                        ),
                                        array(
                                            "name" => "no_telp",
                                            "label" => "Nomor Telepon",
                                            "type" => "input",
                                            "inputType" => "text",
                                            "col" => "6",
                                            "value" => $detail['no_telp'],
                                            "readonly" => true
                                        ),
                                        array(
                                            "name" => "harga",
                                            "label" => "Harga Produk",
                                            "type" => "input",
                                            "inputType" => "number",
                                            "readonly" => true,
                                            "col" => "3",
                                            "value" => $detail['harga'],
                                            "readonly" => true
                                        ),
                                        array(
                                            "name" => "jumlah_pesan",
                                            "label" => "Jumlah Pesan",
                                            "type" => "input",
                                            "inputType" => "number",
                                            "readonly" => true,
                                            "col" => "3",
                                            "value" => $detail['jumlah_pesan'],
                                            "readonly" => true
                                        ),
                                        array(
                                            "name" => "total_harga",
                                            "label" => "Total Harga",
                                            "type" => "input",
                                            "inputType" => "number",
                                            "value" => $detail['total_harga'],
                                            "readonly" => true,
                                            "col" => "12",
                                            "readonly" => true
                                        )
                                    )
                                )
                            );
                            formGenerator($detailForm);
                            if ($detail['jenis_produk'] == 'Undangan') {
                                $dataUndangan = $db->from('tbl_detail_pesanan')->where('id_pemesanan', $_GET['id_pemesanan'])->select()->one();
                                ?>
                                <h2>Detail of Invitation</h2>
                                <label for="nama_mempelai"><b>Nama Mempelai</b></label>
                                <p class="form-control"><?php echo $dataUndangan['nama_mempelai']; ?></p>

                                <label for="nama_orangtua"><b>Nama Orang Tua</b></label>
                                <p class="form-control"><?php echo $dataUndangan['nama_orangtua']; ?></p>

                                <label for="tgl_akadnikah"><b>Tanggal Akad Nikah</b></label>
                                <p class="form-control"><?php echo $dataUndangan['tgl_akadnikah']; ?></p>

                                <label for="tgl_resepsi"><b>Tanggal Resepsi</b></label>
                                <p class="form-control"><?php echo $dataUndangan['tgl_resepsi']; ?></p>

                                <label for="waktu_akadnikah"><b>Jam Akad Nikah</b></label>
                                <p class="form-control"><?php echo $dataUndangan['waktu_akadnikah']; ?></p>

                                <label for="waktu_resepsi"><b>Jam Resepsi</b></label>
                                <p class="form-control"><?php echo $dataUndangan['waktu_resepsi']; ?></p>

                                <label for="alamat_akadnikah"><b>Alamat Akad Nikah</b></label>
                                <p class="form-control"><?php echo $dataUndangan['alamat_akadnikah']; ?></p>

                                <label for="alamat_resepsi"><b>Alamat Resepsi</b></label>
                                <p class="form-control"><?php echo $dataUndangan['alamat_resepsi']; ?></p>

                                <label for="anggota_keluarga"><b>Anggota Keluarga Yang Mengundang</b></label>
                                <p class="form-control"><?php echo $dataUndangan['anggota_keluarga']; ?></p>

                                <label for="foto_lokasi"><b>Foto Denah Lokasi</b></label>
                                <p class="form-control"><?php echo "<img src='" . $base_url . "/lokasi/" . $dataUndangan['foto_lokasi'] . "' width='300' height='300'/>" ?></p>
                                <?php
                            }
                            echo '<a class="btn btn-primary" href="daftar-transaksi.php">Back</a>';
                        }
                    } else {
                        ?>
                        <h2>Transactions</h2>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <?php
                                    foreach ($tableConf as $t) {
                                        echo "<th>" . $t['caption'] . "</th>";
                                    }
                                    ?>
                                    <th colspan=2>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
                                if (count($dataTable) == 0) {
                                    echo "<tr><td colspan=" . (count($tableConf) + 2) . ">Empty Data</td></tr>";
                                } else {
                                    foreach ($dataTable as $r) {
                                        echo "<tr><td>" . $no . "</td>";
                                        foreach ($tableConf as $t) {
                                            if ($t['name'] == 'status_pembayaran') {
                                                if ($r['status_pembayaran'] == null) {
                                                    echo "<td><span class='badge badge-danger'>Belum Bayar</span></td>";
                                                } else if ($r['status_pembayaran'] == 'Diterima') {
                                                    echo "<td><span class='badge badge-success'>" . $r['status_pembayaran'] . "</span></td>";
                                                } else if ($r['status_pembayaran'] == 'Diproses') {
                                                    echo "<td><span class='badge badge-info'>" . $r['status_pembayaran'] . "</span></td>";
                                                } else if ($r['status_pembayaran'] == 'Ditolak') {
                                                    echo "<td><span class='badge badge-danger'>" . $r['status_pembayaran'] . "</span></td>";
                                                }
                                            } else echo "<td>" . $r[$t['name']] . "</td>";
                                            if ($t['name'] == 'status_pembayaran') {
                                                if ($r['status_pembayaran'] == null) {
                                                    echo "<td><a class='btn btn-info btn-sm' href='konfirmasi-pembayaran.php?id_pemesanan=" . $r['id_pemesanan'] . "'>Konfirmasi Pembayaran</a></td>";
                                                } else if ($r['status_pembayaran'] == 'Diproses') echo "<td><span class='badge badge-warning'>Menunggu Verifikasi</span></td>";
                                                else if ($r['status_pembayaran'] == 'Diterima') echo "";
                                                else echo "<td><a class='btn btn-info btn-sm' href='konfirmasi-pembayaran.php?id_pemesanan=" . $r['id_pemesanan'] . "&ulang=ya'>Konfirmasi Ulang</a></td>";
                                            }
                                        }
                                        $no++;
                                        echo "<td><a class='btn btn-sm btn-primary' href='daftar-transaksi.php?id_pemesanan=" . $r['id_pemesanan'] . "'>Detail Pesanan</a></td>";
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
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
