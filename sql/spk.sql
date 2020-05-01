-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 09:34 AM
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
-- Table structure for table `tbl_konfigurasi`
--

CREATE TABLE `tbl_konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `nama_website` varchar(225) NOT NULL,
  `logo` varchar(225) NOT NULL,
  `favicon` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `facebook` varchar(225) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `keywords` varchar(225) NOT NULL,
  `metatext` varchar(225) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_konfigurasi`
--

INSERT INTO `tbl_konfigurasi` (`id_konfigurasi`, `nama_website`, `logo`, `favicon`, `email`, `no_telp`, `alamat`, `facebook`, `instagram`, `keywords`, `metatext`, `about`) VALUES
(1, 'SUSANTOKUN', 'member.png', 'admin.png', 'admin@susantokun.com', '081906515912', 'KOMPLEK BTN Munjul No.12A 02/06, Sukaresmi, Cianjur, Jawa Barat, Indonesia (43253)', 'https://facebook.com/susantokundotcom', 'https://instagram.com/susantokun', 'info-susantokun, demo-susantokun, susantokun', 'Situs Edukasi, Tips dan Tutorial', 'Susantokun adalah situs edukasi seperti pelajaran dan ilmu pengetahuan, serta membahas tentang tips, tutorial, teknologi, tugas-tugas hingga berita terkini.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `name`, `description`) VALUES
(1, 'Administrator', 'Hak akses Administrator'),
(2, 'Member', 'Hak akses Member');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_distribusi`
--

CREATE TABLE `tbl_surat_distribusi` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` varchar(5) NOT NULL DEFAULT '9105',
  `no_urut` varchar(4) NOT NULL,
  `instansi_asal` varchar(50) NOT NULL DEFAULT 'BPS',
  `kode_satker` char(1) NOT NULL DEFAULT '4',
  `id_bulan` char(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_ipds`
--

CREATE TABLE `tbl_surat_ipds` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` varchar(5) NOT NULL DEFAULT '9105',
  `no_urut` varchar(4) NOT NULL,
  `instansi_asal` varchar(50) NOT NULL DEFAULT 'BPS',
  `kode_satker` char(1) NOT NULL DEFAULT '6',
  `id_bulan` char(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_surat_ipds`
--

INSERT INTO `tbl_surat_ipds` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`) VALUES
(1, '9105', '001', 'BPS', '6', '04', 2020, '2020-04-03', 'Surat Rilis', 'BPS Provinsi Papua Barat', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_kepala`
--

CREATE TABLE `tbl_surat_kepala` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` varchar(5) NOT NULL DEFAULT '9105',
  `no_urut` varchar(4) NOT NULL,
  `instansi_asal` varchar(50) NOT NULL DEFAULT 'BPS',
  `kode_satker` char(1) NOT NULL DEFAULT '0',
  `id_bulan` char(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(11) NOT NULL,
  `nomor_surat` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `instansi_asal` varchar(50) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id_surat`, `nomor_surat`, `tanggal`, `instansi_asal`, `perihal`, `instansi_tujuan`, `photo`, `keterangan`) VALUES
(1, '900/524/BPKAD/III/2020', '2020-03-03', 'BPKAD Kabupaten Manokwari', 'Permintaan Data untuk LKPD 2019', 'BPS Kabupaten Manokwari', NULL, 'Sudah Terbalas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_nerwilis`
--

CREATE TABLE `tbl_surat_nerwilis` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` varchar(5) NOT NULL DEFAULT '9105',
  `no_urut` varchar(4) NOT NULL,
  `instansi_asal` varchar(50) NOT NULL DEFAULT 'BPS',
  `kode_satker` char(1) NOT NULL DEFAULT '5',
  `id_bulan` char(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_produksi`
--

CREATE TABLE `tbl_surat_produksi` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` varchar(5) NOT NULL DEFAULT '9105',
  `no_urut` varchar(4) NOT NULL,
  `instansi_asal` varchar(50) NOT NULL DEFAULT 'BPS',
  `kode_satker` char(1) NOT NULL DEFAULT '3',
  `id_bulan` char(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_surat_produksi`
--

INSERT INTO `tbl_surat_produksi` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`) VALUES
(2, '9105', '001', 'BPS', '3', '04', 2020, '2020-04-03', 'Surat Balasan', 'BPS Provinsi Papua Barat', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_sosial`
--

CREATE TABLE `tbl_surat_sosial` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` varchar(5) NOT NULL DEFAULT '9105',
  `no_urut` varchar(4) NOT NULL,
  `instansi_asal` varchar(50) NOT NULL DEFAULT 'BPS',
  `kode_satker` char(1) NOT NULL DEFAULT '2',
  `id_bulan` char(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_surat_sosial`
--

INSERT INTO `tbl_surat_sosial` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`) VALUES
(2, '9105', '001', 'BPS', '2', '01', 2020, '2020-01-02', 'Surat Balasan', 'BPS Provinsi Papua Barat', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_tu`
--

CREATE TABLE `tbl_surat_tu` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` varchar(5) NOT NULL DEFAULT '9105',
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
(1, '9105', '001', 'BPS', '1', '01', 2020, '2020-01-02', 'Surat Pemberitahuan', 'BPS Provinsi Papua Barat', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password_reset_key` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'default.png',
  `activated` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `id_role`, `username`, `password`, `password_reset_key`, `first_name`, `last_name`, `email`, `phone`, `photo`, `activated`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '$2y$05$OA.OoeNHoEkbGGKazYqPU.UOaI5jmgro8x2pRSV56ClTWlDf0EEn2', '', 'ADMIN', 'SUSANTOKUN', 'admin@mail.com', '081906515912', '1526456245974.png', 1, '2020-03-14 22:34:49', '2020-03-14 21:58:17', NULL),
(2, 2, 'member', '$2y$05$8GdJw3BVbmhN6x2t0MNise7O0xqLMCNAN1cmP6fkhy0DZl4SxB5iO', '', 'MEMBER', 'SUSANTOKUN', 'member@mail.com', '081906515912', '1583991814826.png', 1, '2020-03-14 22:32:04', '2020-03-14 22:00:32', NULL),
(16, 2, 'arif', '$2y$10$o1NuKGChFcwnaGh6fW4IAOwWBY.iOA6rAJa9ffHzqsthnnYXU9Xay', NULL, 'Arif', 'Wicaksono', 'acipoey@gmail.com', '081388800095', 'default.png', 1, NULL, NULL, NULL),
(18, 2, 'imron', '$2y$10$7lD90UqwVDQAtsjaB4JBbu3H29.0nkaor7nbuAwGlX3UFgNfsvZDu', NULL, 'Imron', 'Suyuti', 'imsuyuti@bps.go.id', '081388800095', '', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_distribusi`
--
ALTER TABLE `tbl_surat_distribusi`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_ipds`
--
ALTER TABLE `tbl_surat_ipds`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_kepala`
--
ALTER TABLE `tbl_surat_kepala`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_nerwilis`
--
ALTER TABLE `tbl_surat_nerwilis`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_produksi`
--
ALTER TABLE `tbl_surat_produksi`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_sosial`
--
ALTER TABLE `tbl_surat_sosial`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_surat_tu`
--
ALTER TABLE `tbl_surat_tu`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_surat_distribusi`
--
ALTER TABLE `tbl_surat_distribusi`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_surat_ipds`
--
ALTER TABLE `tbl_surat_ipds`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_surat_kepala`
--
ALTER TABLE `tbl_surat_kepala`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_surat_nerwilis`
--
ALTER TABLE `tbl_surat_nerwilis`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_surat_produksi`
--
ALTER TABLE `tbl_surat_produksi`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_surat_sosial`
--
ALTER TABLE `tbl_surat_sosial`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_surat_tu`
--
ALTER TABLE `tbl_surat_tu`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
