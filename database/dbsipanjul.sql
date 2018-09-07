-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2018 at 11:42 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbsipanjul`
--

-- --------------------------------------------------------

--
-- Table structure for table `iw_jenis`
--

CREATE TABLE IF NOT EXISTS `iw_jenis` (
`id_jenis` int(5) NOT NULL,
  `nm_jenis` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `id_kategori` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `iw_jenis`
--

INSERT INTO `iw_jenis` (`id_jenis`, `nm_jenis`, `keterangan`, `status`, `id_kategori`) VALUES
(1, '70/90-17', '', 'Y', 2),
(2, '80/90-17', '', 'Y', 2),
(3, '90/90-17', '', 'Y', 2);

-- --------------------------------------------------------

--
-- Table structure for table `iw_kategori`
--

CREATE TABLE IF NOT EXISTS `iw_kategori` (
`id_kategori` int(5) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `iw_kategori`
--

INSERT INTO `iw_kategori` (`id_kategori`, `nm_kategori`, `keterangan`, `status`) VALUES
(1, 'OLIE', '', 'Y'),
(2, 'BAN', 'UNTUK BAN SEPEDA MOTOR', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `iw_merk`
--

CREATE TABLE IF NOT EXISTS `iw_merk` (
`id_merk` int(5) NOT NULL,
  `nm_merk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `iw_merk`
--

INSERT INTO `iw_merk` (`id_merk`, `nm_merk`, `keterangan`, `status`) VALUES
(1, 'YAMAHA', 'ban corsa', 'N'),
(2, 'HONDA', '', 'Y'),
(3, 'SUZUKI', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `iw_mutasi`
--

CREATE TABLE IF NOT EXISTS `iw_mutasi` (
`id_mutasi` int(5) NOT NULL,
  `nm_anggota` varchar(100) NOT NULL,
  `id_polda` int(11) NOT NULL,
  `id_pangkat` int(11) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `iw_mutasi`
--

INSERT INTO `iw_mutasi` (`id_mutasi`, `nm_anggota`, `id_polda`, `id_pangkat`, `id_pendidikan`, `keterangan`, `status`) VALUES
(1, 'TEST 1', 0, 0, 0, 'q', 'N'),
(2, 'TEST 2', 0, 0, 0, '', 'Y'),
(3, 'WWWW', 0, 0, 0, '0', 'N'),
(4, '2Q', 0, 0, 0, '2', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `iw_pangkat`
--

CREATE TABLE IF NOT EXISTS `iw_pangkat` (
`id_pangkat` int(5) NOT NULL,
  `nm_pangkat` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `iw_pangkat`
--

INSERT INTO `iw_pangkat` (`id_pangkat`, `nm_pangkat`, `keterangan`, `status`) VALUES
(1, 'IPDA', '', 'Y'),
(2, 'IPTU', '', 'Y'),
(3, 'AKP', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `iw_pembelian`
--

CREATE TABLE IF NOT EXISTS `iw_pembelian` (
  `no_pembelian` int(10) NOT NULL,
  `tgl_pembelian` datetime NOT NULL,
  `catatan` text NOT NULL,
  `id_supplier` int(5) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iw_pembelian`
--

INSERT INTO `iw_pembelian` (`no_pembelian`, `tgl_pembelian`, `catatan`, `id_supplier`, `username`) VALUES
(1, '2018-07-02 10:50:28', '', 2, 'admin'),
(2, '2018-09-03 14:43:54', '', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `iw_pembelian_item`
--

CREATE TABLE IF NOT EXISTS `iw_pembelian_item` (
  `no_pembelian` int(10) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `harga_beli` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iw_pembelian_item`
--

INSERT INTO `iw_pembelian_item` (`no_pembelian`, `id_produk`, `harga_beli`, `harga_jual`, `jumlah`) VALUES
(1, 1, 200000, 210000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `iw_pembelian_tmp`
--

CREATE TABLE IF NOT EXISTS `iw_pembelian_tmp` (
`id` int(10) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `iw_pembelian_tmp`
--

INSERT INTO `iw_pembelian_tmp` (`id`, `id_produk`, `jumlah`, `username`) VALUES
(1, 1, 2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `iw_pendidikan`
--

CREATE TABLE IF NOT EXISTS `iw_pendidikan` (
`id_pendidikan` int(5) NOT NULL,
  `nm_pendidikan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `iw_pendidikan`
--

INSERT INTO `iw_pendidikan` (`id_pendidikan`, `nm_pendidikan`, `keterangan`, `status`) VALUES
(1, 'PTIK', '', 'Y'),
(2, 'SESPIMMA', '', 'Y'),
(3, 'AKPOL', '', 'Y'),
(4, 'SIPSS', '', 'Y'),
(5, 'SIP ', '', 'Y'),
(6, 'SEBA', '', 'Y'),
(7, 'SETA', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `iw_penjualan`
--

CREATE TABLE IF NOT EXISTS `iw_penjualan` (
  `no_penjualan` int(10) NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `catatan` text NOT NULL,
  `id_merk` int(5) NOT NULL,
  `id_type` int(5) NOT NULL,
  `nomor_kendaraan` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iw_penjualan`
--

INSERT INTO `iw_penjualan` (`no_penjualan`, `tgl_penjualan`, `catatan`, `id_merk`, `id_type`, `nomor_kendaraan`, `username`) VALUES
(1, '2018-07-02 10:53:44', '', 1, 1, 'B 1234 LL', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `iw_penjualan_item`
--

CREATE TABLE IF NOT EXISTS `iw_penjualan_item` (
  `no_penjualan` int(10) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `harga_beli` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iw_penjualan_item`
--

INSERT INTO `iw_penjualan_item` (`no_penjualan`, `id_produk`, `harga_beli`, `harga_jual`, `jumlah`) VALUES
(1, 2, 30000, 35000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `iw_penjualan_tmp`
--

CREATE TABLE IF NOT EXISTS `iw_penjualan_tmp` (
`id` int(10) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `iw_polda`
--

CREATE TABLE IF NOT EXISTS `iw_polda` (
`id_polda` int(5) NOT NULL,
  `nm_polda` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `iw_polda`
--

INSERT INTO `iw_polda` (`id_polda`, `nm_polda`, `keterangan`, `status`) VALUES
(1, 'POLDA ACEH', '', 'Y'),
(2, 'POLDA BALI', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `iw_produk`
--

CREATE TABLE IF NOT EXISTS `iw_produk` (
`id_produk` int(5) NOT NULL,
  `nm_produk` varchar(100) NOT NULL,
  `harga_beli` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `stok` int(5) NOT NULL,
  `keterangan` text NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_jenis` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `iw_produk`
--

INSERT INTO `iw_produk` (`id_produk`, `nm_produk`, `harga_beli`, `harga_jual`, `stok`, `keterangan`, `id_kategori`, `id_jenis`) VALUES
(1, 'CORSA', 200000, 210000, 16, '', 2, 2),
(2, 'YAMALUBE', 30000, 35000, 8, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `iw_supplier`
--

CREATE TABLE IF NOT EXISTS `iw_supplier` (
`id_supplier` int(5) NOT NULL,
  `nm_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `iw_supplier`
--

INSERT INTO `iw_supplier` (`id_supplier`, `nm_supplier`, `alamat`, `no_telp`, `keterangan`, `status`) VALUES
(1, 'YAMA OLIE', 'BEKASI UTARA', '081334347673', '', 'Y'),
(2, 'ANEKA MOTOR', 'BEKASI', '081334347673', '', 'Y'),
(3, 'PRIMA BAN', 'BEKASI', '081334347673', 'UNTUK SUPPLIER BAN SEPEDA MOTOR', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `iw_tools_stok`
--

CREATE TABLE IF NOT EXISTS `iw_tools_stok` (
`id` int(5) NOT NULL,
  `batas_1` int(5) NOT NULL,
  `batas_2` int(5) NOT NULL,
  `batas_3` int(5) NOT NULL,
  `warna_1` varchar(20) NOT NULL,
  `warna_2` varchar(20) NOT NULL,
  `warna_3` varchar(20) NOT NULL,
  `keterangan_1` varchar(100) NOT NULL,
  `keterangan_2` varchar(100) NOT NULL,
  `keterangan_3` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `iw_tools_stok`
--

INSERT INTO `iw_tools_stok` (`id`, `batas_1`, `batas_2`, `batas_3`, `warna_1`, `warna_2`, `warna_3`, `keterangan_1`, `keterangan_2`, `keterangan_3`) VALUES
(1, 5, 7, 10, 'FF2108', 'FFE608', '5AFF08', 'stock habis', 'Stok Masih Aman', 'Stok Sangat Banyak');

-- --------------------------------------------------------

--
-- Table structure for table `iw_type`
--

CREATE TABLE IF NOT EXISTS `iw_type` (
`id_type` int(5) NOT NULL,
  `nm_type` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `iw_type`
--

INSERT INTO `iw_type` (`id_type`, `nm_type`, `keterangan`, `status`) VALUES
(1, 'MATIC', '', 'Y'),
(2, 'SPORT', '', 'Y'),
(3, '4 TRANSMISI', '', 'Y'),
(4, '2 TRANSMISI', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `iw_users`
--

CREATE TABLE IF NOT EXISTS `iw_users` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT 'default.png',
  `level` varchar(20) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iw_users`
--

INSERT INTO `iw_users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `foto`, `level`, `blokir`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'admin@gmail.com', '081334347673', 'default.png', 'admin', 'N', '21232f297a57a5a743894a0e4a801fc3'),
('erwan', 'ac4256575f3ccee1601f115d8a333551', 'Erwan Ari Kusuma', 'erwanarie@gmail.com', '081334347673', 'default.png', 'admin', 'N', 'ac4256575f3ccee1601f115d8a333551'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 'user@gmail.com', '081334347673', 'default.png', 'user', 'N', 'ee11cbb19052e40b07aac0ca060c23ee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iw_jenis`
--
ALTER TABLE `iw_jenis`
 ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `iw_kategori`
--
ALTER TABLE `iw_kategori`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `iw_merk`
--
ALTER TABLE `iw_merk`
 ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `iw_mutasi`
--
ALTER TABLE `iw_mutasi`
 ADD PRIMARY KEY (`id_mutasi`);

--
-- Indexes for table `iw_pangkat`
--
ALTER TABLE `iw_pangkat`
 ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `iw_pembelian`
--
ALTER TABLE `iw_pembelian`
 ADD PRIMARY KEY (`no_pembelian`);

--
-- Indexes for table `iw_pembelian_tmp`
--
ALTER TABLE `iw_pembelian_tmp`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iw_pendidikan`
--
ALTER TABLE `iw_pendidikan`
 ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `iw_penjualan`
--
ALTER TABLE `iw_penjualan`
 ADD PRIMARY KEY (`no_penjualan`);

--
-- Indexes for table `iw_penjualan_tmp`
--
ALTER TABLE `iw_penjualan_tmp`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iw_polda`
--
ALTER TABLE `iw_polda`
 ADD PRIMARY KEY (`id_polda`);

--
-- Indexes for table `iw_produk`
--
ALTER TABLE `iw_produk`
 ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `iw_supplier`
--
ALTER TABLE `iw_supplier`
 ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `iw_tools_stok`
--
ALTER TABLE `iw_tools_stok`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iw_type`
--
ALTER TABLE `iw_type`
 ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `iw_users`
--
ALTER TABLE `iw_users`
 ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iw_jenis`
--
ALTER TABLE `iw_jenis`
MODIFY `id_jenis` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `iw_kategori`
--
ALTER TABLE `iw_kategori`
MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `iw_merk`
--
ALTER TABLE `iw_merk`
MODIFY `id_merk` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `iw_mutasi`
--
ALTER TABLE `iw_mutasi`
MODIFY `id_mutasi` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `iw_pangkat`
--
ALTER TABLE `iw_pangkat`
MODIFY `id_pangkat` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `iw_pembelian_tmp`
--
ALTER TABLE `iw_pembelian_tmp`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `iw_pendidikan`
--
ALTER TABLE `iw_pendidikan`
MODIFY `id_pendidikan` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `iw_penjualan_tmp`
--
ALTER TABLE `iw_penjualan_tmp`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iw_polda`
--
ALTER TABLE `iw_polda`
MODIFY `id_polda` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `iw_produk`
--
ALTER TABLE `iw_produk`
MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `iw_supplier`
--
ALTER TABLE `iw_supplier`
MODIFY `id_supplier` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `iw_tools_stok`
--
ALTER TABLE `iw_tools_stok`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `iw_type`
--
ALTER TABLE `iw_type`
MODIFY `id_type` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
