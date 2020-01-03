-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 03, 2020 at 07:44 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsouvenir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_pesanan`
--

CREATE TABLE `tbl_detail_pesanan` (
  `nama_mempelai` text NOT NULL,
  `nama_orangtua` text NOT NULL,
  `tgl_akadnikah` date NOT NULL,
  `tgl_resepsi` date NOT NULL,
  `waktu_akadnikah` time NOT NULL,
  `waktu_resepsi` time NOT NULL,
  `alamat_akadnikah` varchar(255) NOT NULL,
  `alamat_resepsi` varchar(255) NOT NULL,
  `anggota_keluarga` text NOT NULL,
  `foto_lokasi` text NOT NULL,
  `id_detail` int(11) NOT NULL,
  `id_pemesanan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detail_pesanan`
--

INSERT INTO `tbl_detail_pesanan` (`nama_mempelai`, `nama_orangtua`, `tgl_akadnikah`, `tgl_resepsi`, `waktu_akadnikah`, `waktu_resepsi`, `alamat_akadnikah`, `alamat_resepsi`, `anggota_keluarga`, `foto_lokasi`, `id_detail`, `id_pemesanan`) VALUES
('buyer', 'buyer', '2020-01-01', '2020-01-01', '00:00:00', '00:00:00', 'buyer', 'buyer', 'buyer', 'example.jpg', 1, '01032020064106720600');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foto_produk`
--

CREATE TABLE `tbl_foto_produk` (
  `id_foto_produk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `foto_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_foto_produk`
--

INSERT INTO `tbl_foto_produk` (`id_foto_produk`, `id_produk`, `foto_produk`) VALUES
(1, 1, 'undangan1.jpg'),
(2, 1, 'undangan2.jpg'),
(3, 1, 'undangan3.jpg'),
(4, 2, 'kipas1.jpg'),
(5, 2, 'kipas2.png'),
(6, 2, 'kipas3.jpg'),
(7, 3, 'gerabah1.jpg'),
(8, 3, 'gerabah2.jpg'),
(9, 3, 'gerabah3.jpg'),
(10, 4, 'gelas1.jpg'),
(11, 4, 'gelas2.jpg'),
(12, 4, 'gelas3.jpeg'),
(13, 5, 'asbak1.jpg'),
(14, 5, 'asbak2.jpg'),
(15, 5, 'asbak3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kota`
--

CREATE TABLE `tbl_kota` (
  `id_kota` int(11) NOT NULL,
  `nm_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_kota`
--

INSERT INTO `tbl_kota` (`id_kota`, `nm_kota`, `tarif`) VALUES
(1, 'Jakarta Barat', 1000),
(2, 'Jakarta Utara', 2000),
(3, 'Jakarta Timur', 3000),
(4, 'Jakarta Selatan', 4000),
(5, 'Jakarta Pusat', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pemesanan` varchar(50) NOT NULL,
  `nama_pembayar` varchar(100) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `total` int(11) NOT NULL,
  `foto_bukti` text NOT NULL,
  `status_pembayaran` enum('Diproses','Diterima','Ditolak') NOT NULL DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_pemesanan`, `nama_pembayar`, `no_rek`, `nama_bank`, `tgl_pembayaran`, `total`, `foto_bukti`, `status_pembayaran`) VALUES
(1, '01032020064106720600', 'buyer', '1234567890', 'buyer', '2020-01-01', 2000, 'example.jpg', 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemesanan`
--

CREATE TABLE `tbl_pemesanan` (
  `id_pemesanan` varchar(100) NOT NULL,
  `nama_pemesan` varchar(200) NOT NULL,
  `alamat_pemesan` varchar(255) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tgl_pesan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_kota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pemesanan`
--

INSERT INTO `tbl_pemesanan` (`id_pemesanan`, `nama_pemesan`, `alamat_pemesan`, `no_telp`, `id_user`, `total_harga`, `jumlah_pesan`, `id_produk`, `tgl_pesan`, `id_kota`) VALUES
('01032020064106720600', 'buyer', 'buyer', '08123456789', 2, 2000, 1, 1, '2020-01-03 06:41:06', 1);

--
-- Triggers `tbl_pemesanan`
--
DELIMITER $$
CREATE TRIGGER `stokKurang` AFTER INSERT ON `tbl_pemesanan` FOR EACH ROW update tbl_produk set stok = stok - NEW.jumlah_pesan where id_produk = NEW.id_produk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `nm_produk` varchar(100) NOT NULL,
  `jenis_produk` varchar(15) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nm_produk`, `jenis_produk`, `harga`, `stok`) VALUES
(1, 'Undangan Pernikahan', 'Undangan', 1000, 9),
(2, 'Souvenir Kipas', 'Souvenir', 2000, 10),
(3, 'Souvenir Gerabah', 'Souvenir', 3000, 10),
(4, 'Souvenir Gelas', 'Souvenir', 4000, 10),
(5, 'Souvenir Asbak', 'Souvenir', 5000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `mfa_secret` varchar(255) NOT NULL,
  `email` varchar(20) NOT NULL,
  `tipe_user` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `mfa_secret`, `email`, `tipe_user`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'VBLPBPUIMIY27TQ3', 'admin@admin.com', 'Admin'),
(2, 'buyer', '794aad24cbd58461011ed9094b7fa212', 'JE3QRZ6DLIQ2D2MV', 'buyer@buyer.com', 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tbl_foto_produk`
--
ALTER TABLE `tbl_foto_produk`
  ADD PRIMARY KEY (`id_foto_produk`);

--
-- Indexes for table `tbl_kota`
--
ALTER TABLE `tbl_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_foto_produk`
--
ALTER TABLE `tbl_foto_produk`
  MODIFY `id_foto_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_kota`
--
ALTER TABLE `tbl_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
