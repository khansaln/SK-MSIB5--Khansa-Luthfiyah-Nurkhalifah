-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 16, 2023 at 10:56 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apotikdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

DROP TABLE IF EXISTS `obat`;
CREATE TABLE IF NOT EXISTS `obat` (
  `id_obat` int NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_obat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `jenis_obat` enum('Kapsul','Tablet','Sirup','Serbuk','Oles') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_jual` int NOT NULL,
  PRIMARY KEY (`id_obat`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `gambar_obat`, `jenis_obat`, `harga_jual`) VALUES
(1, 'Simvastatin', '../asset/img/upload/obat.png', '', 7000),
(2, 'Glimipiride 2 Mg', '../asset/img/upload/bintang.png', '', 1234),
(38, 'paracetamol', '../asset/img/upload/anak kecil.png', '', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE IF NOT EXISTS `pembelian` (
  `no_faktur` int NOT NULL,
  `tgl` date NOT NULL,
  `total` int NOT NULL,
  `id_suplier` int NOT NULL,
  PRIMARY KEY (`no_faktur`),
  KEY `id_suplier` (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_faktur`, `tgl`, `total`, `id_suplier`) VALUES
(0, '0000-00-00', 0, 0),
(3209, '2023-11-01', 10000000, 110);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

DROP TABLE IF EXISTS `pembelian_detail`;
CREATE TABLE IF NOT EXISTS `pembelian_detail` (
  `id_pb` int NOT NULL AUTO_INCREMENT,
  `id_obat` int NOT NULL,
  `qty` int NOT NULL,
  `harga_beli` int NOT NULL,
  `subtotal` int NOT NULL,
  `no_faktur` int NOT NULL,
  PRIMARY KEY (`id_pb`),
  KEY `id_obat` (`id_obat`),
  KEY `no_faktur` (`no_faktur`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_pb`, `id_obat`, `qty`, `harga_beli`, `subtotal`, `no_faktur`) VALUES
(101, 1, 1000, 3500, 3500000, 3209),
(102, 2, 454, 222222, 400020000, 3209),
(104, 38, 100, 20000, 2000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

DROP TABLE IF EXISTS `suplier`;
CREATE TABLE IF NOT EXISTS `suplier` (
  `id_suplier` int NOT NULL AUTO_INCREMENT,
  `nama_suplier` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hp` int NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `nama_suplier`, `hp`, `alamat`) VALUES
(110, 'PT. Kimia Farma', 5435572, 'Jalan Anggrek Raya, Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jk` enum('Laki - laki','Perempuan','','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hp_user` int NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_obat_pembelian`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_obat_pembelian`;
CREATE TABLE IF NOT EXISTS `v_obat_pembelian` (
`gambar_obat` text
,`harga_beli` int
,`harga_jual` int
,`id_obat` int
,`jenis_obat` enum('Kapsul','Tablet','Sirup','Serbuk','Oles')
,`nama_obat` varchar(50)
,`qty` int
);

-- --------------------------------------------------------

--
-- Structure for view `v_obat_pembelian`
--
DROP TABLE IF EXISTS `v_obat_pembelian`;

DROP VIEW IF EXISTS `v_obat_pembelian`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_obat_pembelian`  AS SELECT `obat`.`id_obat` AS `id_obat`, `obat`.`nama_obat` AS `nama_obat`, `obat`.`gambar_obat` AS `gambar_obat`, `obat`.`jenis_obat` AS `jenis_obat`, `pembelian_detail`.`harga_beli` AS `harga_beli`, `obat`.`harga_jual` AS `harga_jual`, `pembelian_detail`.`qty` AS `qty` FROM (`obat` join `pembelian_detail` on((`obat`.`id_obat` = `pembelian_detail`.`id_obat`)))  ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD CONSTRAINT `pembelian_detail_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
