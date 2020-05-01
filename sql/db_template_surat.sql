-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2020 at 06:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_tu`
--

CREATE TABLE `tbl_surat_tu` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL DEFAULT 9105,
  `no_urut` varchar(4) NOT NULL,
  `instansi_asal` varchar(50) NOT NULL DEFAULT 'BPS',
  `kode_satker` char(1) NOT NULL DEFAULT '1',
  `id_bulan` char(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_surat_tu`
--

INSERT INTO `tbl_surat_tu` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`) VALUES
(1, 9105, '001', 'BPS', '1', '01', 2020, '2020-01-02', 'Surat Pemberitahuan', 'BPS Provinsi Papua Barat', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_surat_tu`
--
ALTER TABLE `tbl_surat_tu`
  ADD PRIMARY KEY (`id_surat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_surat_tu`
--
ALTER TABLE `tbl_surat_tu`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
