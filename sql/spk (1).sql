-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Bulan Mei 2020 pada 15.00
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

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
-- Struktur dari tabel `tbl_aktivitas`
--

CREATE TABLE `tbl_aktivitas` (
  `id_aktivitas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `aktivitas` varchar(100) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_aktivitas`
--

INSERT INTO `tbl_aktivitas` (`id_aktivitas`, `username`, `aktivitas`, `waktu`) VALUES
(2, 'admin', 'Edit Surat IPDS', '2020-04-06 18:02:49'),
(3, 'admin', 'Mengupdate Surat Seksi TU', '2020-04-06 20:31:09'),
(4, 'admin', 'Menambahkan Surat Seksi Stat. Sosial', '2020-04-06 20:31:37'),
(5, 'admin', 'Menghapus Surat Seksi Stat. Sosial', '2020-04-06 20:31:49'),
(6, 'admin', 'Menambahkan Link', '2020-04-08 18:59:57'),
(7, 'admin', 'Menghapus Link', '2020-04-08 19:00:01'),
(8, 'admin', 'Mengupdate Link', '2020-04-08 19:07:03'),
(9, 'admin', 'Mengupdate Link', '2020-04-08 19:07:09'),
(10, 'admin', 'Mengupdate Link', '2020-04-08 19:07:51'),
(11, 'admin', 'Mengupdate Link', '2020-04-08 19:07:57'),
(12, 'admin', 'Mengupdate Link', '2020-04-08 19:18:14'),
(13, 'admin', 'Menambahkan Surat Masuk', '2020-04-10 23:56:14'),
(14, 'admin', 'Menambahkan Surat Masuk', '2020-04-10 23:56:26'),
(15, 'admin', 'Menambahkan Surat Masuk', '2020-04-10 23:57:56'),
(16, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:00:10'),
(17, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:02:58'),
(18, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:17:37'),
(19, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:23:08'),
(20, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:23:58'),
(21, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:26:31'),
(22, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:29:14'),
(23, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:30:03'),
(24, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:31:24'),
(25, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:36:39'),
(26, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:40:06'),
(27, 'admin', 'Mengupdate Surat Masuk', '2020-04-11 00:45:15'),
(28, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:45:28'),
(29, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:46:33'),
(30, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 00:55:05'),
(31, 'admin', 'Mengupdate Surat Masuk', '2020-04-11 00:55:37'),
(32, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:08:38'),
(33, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:08:41'),
(34, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:08:44'),
(35, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:17:37'),
(36, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:17:40'),
(37, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:17:41'),
(38, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:17:42'),
(39, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:17:45'),
(40, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:23:31'),
(41, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:23:34'),
(42, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:35:40'),
(43, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:40:19'),
(44, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:40:24'),
(45, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:40:53'),
(46, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:41:54'),
(47, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 01:42:03'),
(48, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:42:44'),
(49, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:43:09'),
(50, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 01:43:33'),
(51, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:47:08'),
(52, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 01:47:23'),
(53, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:49:19'),
(54, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 01:49:56'),
(55, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:51:41'),
(56, 'admin', 'Menghapus Surat Masuk', '2020-04-11 01:52:13'),
(57, 'admin', 'Menghapus Surat Masuk', '2020-04-11 02:03:51'),
(58, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 02:04:06'),
(59, 'admin', 'Menghapus Surat Masuk', '2020-04-11 02:04:31'),
(60, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 02:04:43'),
(61, 'admin', 'Menghapus Surat Masuk', '2020-04-11 02:04:47'),
(62, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 02:05:40'),
(63, 'admin', 'Menghapus Surat Masuk', '2020-04-11 02:05:44'),
(64, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 02:08:18'),
(65, 'admin', 'Menghapus Surat Masuk', '2020-04-11 02:08:20'),
(66, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 02:08:37'),
(67, 'admin', 'Menghapus Surat Masuk', '2020-04-11 02:08:42'),
(68, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 02:13:51'),
(69, 'admin', 'Menghapus Surat Masuk', '2020-04-11 02:13:55'),
(70, 'admin', 'Menambahkan Surat Masuk', '2020-04-11 03:50:46'),
(71, 'admin', 'Menghapus Surat Masuk', '2020-04-11 03:50:58'),
(72, 'admin', 'Menambahkan Link', '2020-04-11 07:24:37'),
(73, 'admin', 'Menghapus Surat Masuk', '2020-04-11 07:24:40'),
(74, 'admin', 'Menghapus Link', '2020-04-11 07:36:41'),
(75, 'admin', 'Menambahkan Surat Seksi Stat. Distribusi', '2020-04-11 07:38:23'),
(76, 'admin', 'Menghapus Surat Seksi Stat. Distribusi', '2020-04-11 07:38:27'),
(77, 'admin', 'Menambahkan Link', '2020-04-11 07:50:26'),
(78, 'admin', 'Mengupdate Link', '2020-04-11 07:50:41'),
(79, 'admin', 'Mengupdate Surat Seksi Stat. Sosial', '2020-04-14 05:30:19'),
(80, 'admin', 'Menambahkan Surat Seksi TU', '2020-04-14 05:30:50'),
(81, 'admin', 'Menambahkan Surat Sekretariat SP2020', '2020-04-14 06:07:24'),
(82, 'admin', 'Mengupdate Surat Sekretariat SP2020', '2020-04-14 06:10:14'),
(83, 'admin', 'Mengupdate Surat Sekretariat SP2020', '2020-04-14 06:10:20'),
(84, 'admin', 'Menghapus Link', '2020-04-14 07:14:55'),
(85, 'khaerul.umam', 'Menambahkan Surat Seksi Stat. Distribusi', '2020-04-14 08:07:45'),
(86, 'khaerul.umam', 'Mengupdate Surat Seksi Stat. Distribusi', '2020-04-14 08:07:49'),
(87, 'khaerul.umam', 'Mengupdate Surat Seksi Stat. Distribusi', '2020-04-14 08:10:03'),
(88, 'khaerul.umam', 'Mengupdate Surat Seksi Stat. Distribusi', '2020-04-14 08:10:03'),
(89, 'ekakristanto', 'Menambahkan Surat Seksi IPDS', '2020-04-14 08:12:40'),
(90, 'ekakristanto', 'Mengupdate Surat Seksi IPDS', '2020-04-14 08:12:51'),
(91, 'admin', 'Mengupdate Surat Seksi TU', '2020-04-14 08:24:30'),
(92, 'admin', 'Mengupdate Surat Seksi TU', '2020-04-15 18:38:32'),
(93, 'ekakristanto', 'Mengupdate Surat Seksi IPDS', '2020-04-15 18:41:08'),
(94, 'ekakristanto', 'Mengupdate Surat Seksi IPDS', '2020-04-15 18:41:16'),
(95, 'ekakristanto', 'Mengupdate Surat Seksi IPDS', '2020-04-15 18:41:29'),
(96, 'ekakristanto', 'Menambahkan Surat Seksi IPDS', '2020-04-15 18:41:58'),
(97, 'ekakristanto', 'Menghapus Surat Seksi IPDS', '2020-04-15 18:42:05'),
(98, 'ekakristanto', 'Menghapus Surat Seksi IPDS', '2020-04-15 18:43:10'),
(99, 'ekakristanto', 'Menambahkan Surat Masuk', '2020-04-15 18:43:41'),
(100, 'ekakristanto', 'Mengupdate Surat Masuk', '2020-04-15 18:43:50'),
(101, 'ekakristanto', 'Menghapus Surat Masuk', '2020-04-15 18:43:59'),
(102, 'mustamir', 'Menambahkan Surat Kepala', '2020-04-15 18:44:50'),
(103, 'mustamir', 'Mengupdate Surat Kepala', '2020-04-15 18:44:55'),
(104, 'mustamir', 'Menghapus Surat Kepala', '2020-04-15 18:45:00'),
(105, 'admin', 'Menambahkan Surat Seksi TU', '2020-04-15 20:57:55'),
(106, 'admin', 'Menambahkan Surat Seksi TU', '2020-04-15 21:07:42'),
(107, 'admin', 'Menghapus Surat Seksi TU', '2020-04-15 21:08:44'),
(108, 'admin', 'Menghapus Surat Seksi TU', '2020-04-15 21:08:46'),
(109, 'admin', 'Menambahkan Surat Seksi TU', '2020-04-15 21:49:41'),
(110, 'admin', 'Mengunggah Surat Seksi IPDS', '2020-04-15 21:56:29'),
(111, 'admin', 'Mengunggah Surat Kepala', '2020-04-16 06:51:39'),
(112, 'admin', 'Menambahkan Surat Kepala', '2020-04-16 06:52:18'),
(113, 'admin', 'Menambahkan Surat Masuk', '2020-04-16 16:12:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bmn`
--

CREATE TABLE `tbl_bmn` (
  `id_bmn` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `file_bast` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_bmn`
--

INSERT INTO `tbl_bmn` (`id_bmn`, `nama_barang`, `jenis_barang`, `tanggal_masuk`, `keterangan`, `file_bast`) VALUES
(1, 'Lenovo Yoga', 'Laptop', '2010-01-15', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kepemilikan_bmn`
--

CREATE TABLE `tbl_kepemilikan_bmn` (
  `id_kepemilikan_bmn` int(11) NOT NULL,
  `id_bmn` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `file_bast` varchar(100) NOT NULL,
  `file_sk` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_konfigurasi`
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
-- Dumping data untuk tabel `tbl_konfigurasi`
--

INSERT INTO `tbl_konfigurasi` (`id_konfigurasi`, `nama_website`, `logo`, `favicon`, `email`, `no_telp`, `alamat`, `facebook`, `instagram`, `keywords`, `metatext`, `about`) VALUES
(1, 'Sistem Pendukung Kerja', 'member.png', 'admin.png', 'admin@susantokun.com', '081906515912', 'Jalan Percetakan Negara, Manokwari Barat, Kabupaten Manokwari, Papua Barat', 'https://facebook.com/bps9105', 'https://instagram.com/bps9105', 'info-susantokun, demo-susantokun, susantokun', 'Situs Edukasi, Tips dan Tutorial', 'SPK (Sistem Pendukung Kerja)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_link`
--

CREATE TABLE `tbl_link` (
  `id_link` int(11) NOT NULL,
  `nama_link` varchar(100) NOT NULL,
  `link` varchar(250) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_link`
--

INSERT INTO `tbl_link` (`id_link`, `nama_link`, `link`, `keterangan`) VALUES
(1, 'Laporan WFH2', 'http://www.bps.go.id', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `name`, `description`) VALUES
(1, 'Administrator', 'Hak akses Administrator'),
(2, 'Member', 'Hak akses Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_status_bmn`
--

CREATE TABLE `tbl_status_bmn` (
  `id_status_bmn` int(11) NOT NULL,
  `id_bmn` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_distribusi`
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
  `keterangan` varchar(150) DEFAULT NULL,
  `is_upload` int(1) NOT NULL DEFAULT '0',
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_surat_distribusi`
--

INSERT INTO `tbl_surat_distribusi` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`, `is_upload`, `file`) VALUES
(1, '9105', '002', 'BPS', '4', '04', 2020, '2020-04-02', 'Surat Balasan', 'BPS Kabupaten Manokwari', '', 1, 'Bukti_pengisian_SP2020_Online.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_ipds`
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
  `keterangan` varchar(150) DEFAULT NULL,
  `is_upload` int(1) NOT NULL DEFAULT '0',
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_surat_ipds`
--

INSERT INTO `tbl_surat_ipds` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`, `is_upload`, `file`) VALUES
(1, '9105', '001', 'BPS', '6', '04', 2020, '2020-04-03', 'Surat Rilis', 'BPS Provinsi Papua Barat', 'DDA edisi 1', 1, 'Bukti_pengisian_SP2020_Online.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_kepala`
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
  `keterangan` varchar(150) DEFAULT NULL,
  `is_upload` int(1) NOT NULL DEFAULT '0',
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_surat_kepala`
--

INSERT INTO `tbl_surat_kepala` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`, `is_upload`, `file`) VALUES
(1, '9105', '001', 'BPS', '0', '02', 2020, '2020-02-03', 'SK', 'BPS Provinsi Papua Barat', NULL, 1, 'trifold_leaflet.pdf'),
(2, '9105', '002', 'BPS', '0', '04', 2020, '2020-04-01', 'Surat Pemberitahuan', 'BPS Kabupaten Manokwari', '', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(11) NOT NULL,
  `nomor_surat` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `instansi_asal` varchar(50) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `photo` varchar(100) DEFAULT 'no_image.png',
  `keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id_surat`, `nomor_surat`, `tanggal`, `instansi_asal`, `perihal`, `instansi_tujuan`, `photo`, `keterangan`) VALUES
(1, '900/524/BPKAD/III/2020', '2020-03-03', 'BPKAD Kabupaten Manokwari', 'Permintaan Data untuk LKPD 2019', 'BPS Kabupaten Manokwari', 'no_image.png', 'Terbalasa'),
(2, '901', '2020-04-17', 'BPKAD', 'Surat Balasan', 'BPS Kabupaten Manokwari', 'avatar.png', 'Terbalas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_nerwilis`
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
  `keterangan` varchar(150) DEFAULT NULL,
  `is_upload` int(11) NOT NULL DEFAULT '0',
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_produksi`
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
  `keterangan` varchar(150) DEFAULT NULL,
  `is_upload` int(1) NOT NULL DEFAULT '0',
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_surat_produksi`
--

INSERT INTO `tbl_surat_produksi` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`, `is_upload`, `file`) VALUES
(2, '9105', '001', 'BPS', '3', '04', 2020, '2020-04-03', 'Surat Balasan', 'BPS Provinsi Papua Barat', '', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_sosial`
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
  `keterangan` varchar(150) DEFAULT NULL,
  `is_upload` int(1) NOT NULL DEFAULT '0',
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_surat_sosial`
--

INSERT INTO `tbl_surat_sosial` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`, `is_upload`, `file`) VALUES
(2, '9105', '001', 'BPS', '2', '01', 2020, '2020-01-02', 'Surat Balasan', 'BPS Provinsi Papua Barat', '', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_sp2020`
--

CREATE TABLE `tbl_surat_sp2020` (
  `id_surat` int(11) NOT NULL,
  `id_instansi` varchar(5) NOT NULL DEFAULT '9105',
  `no_urut` varchar(4) NOT NULL,
  `instansi_asal` varchar(50) NOT NULL DEFAULT 'BPS',
  `sensus` varchar(6) NOT NULL DEFAULT 'SP2020',
  `id_bulan` char(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `instansi_tujuan` varchar(50) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `is_upload` int(1) NOT NULL DEFAULT '0',
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_surat_sp2020`
--

INSERT INTO `tbl_surat_sp2020` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `sensus`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`, `is_upload`, `file`) VALUES
(1, '9105', '002', 'BPS', 'SP2020', '04', 2020, '2020-04-09', 'Surat Balasana', 'BPS Kabupaten Manokwari', '', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_tu`
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
  `keterangan` varchar(150) DEFAULT NULL,
  `is_upload` int(1) NOT NULL DEFAULT '0',
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_surat_tu`
--

INSERT INTO `tbl_surat_tu` (`id_surat`, `id_instansi`, `no_urut`, `instansi_asal`, `kode_satker`, `id_bulan`, `tahun`, `tanggal`, `perihal`, `instansi_tujuan`, `keterangan`, `is_upload`, `file`) VALUES
(1, '9105', '001', 'BPS', '1', '01', 2020, '2020-01-02', 'Surat Pemberitahuana', 'BPS Provinsi Papua Barat', '', 1, 'Panduan_Backup_ke_Zimbra_Desktop2.pdf'),
(2, '9105', '002', 'BPS', '1', '04', 2020, '2020-04-11', 'Surat Pemberitahuan', 'BPS Kabupaten Manokwari', '', 1, 'Bukti_pengisian_SP2020_Online1.pdf'),
(5, '9105', '003', 'BPS', '1', '04', 2020, '2020-04-16', 'Surat Balasan', 'BPS Kabupaten Manokwari', '', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
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
  `id_satker` int(1) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `id_role`, `username`, `password`, `password_reset_key`, `first_name`, `last_name`, `email`, `phone`, `photo`, `id_satker`, `activated`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '$2y$05$OA.OoeNHoEkbGGKazYqPU.UOaI5jmgro8x2pRSV56ClTWlDf0EEn2', '', 'ADMIN', 'bps9105', 'admin@mail.com', '081906515912', '1526456245974.png', 0, 1, '2020-03-14 22:34:49', '2020-03-14 21:58:17', NULL),
(2, 2, 'member', '$2y$05$8GdJw3BVbmhN6x2t0MNise7O0xqLMCNAN1cmP6fkhy0DZl4SxB5iO', '', 'MEMBER', 'SUSANTOKUN', 'member@mail.com', '081906515912', 'member.png', 0, 1, '2020-03-14 22:32:04', '2020-03-14 22:00:32', NULL),
(16, 2, 'arif', '$2y$10$o1NuKGChFcwnaGh6fW4IAOwWBY.iOA6rAJa9ffHzqsthnnYXU9Xay', NULL, 'Arif', 'Wicaksono', 'acipoey@gmail.com', '081388800095', 'avatar04.png', 6, 1, NULL, NULL, NULL),
(18, 2, 'imron', '$2y$10$7lD90UqwVDQAtsjaB4JBbu3H29.0nkaor7nbuAwGlX3UFgNfsvZDu', NULL, 'Imron', 'Suyuti', 'imsuyuti@bps.go.id', '081388800095', 'member.png', 6, 1, NULL, NULL, NULL),
(20, 2, 'mustamir', '$2y$10$.M.M39QfdDTDBlI/bBwNKOcgBfbZ7BUSv4.Nihb.sEilxLhhzup7i', NULL, 'Mustamir', ', SE., MM.', 'mustamir@bps.go.id', '08999999', 'member.png', 0, 1, NULL, NULL, NULL),
(21, 2, 'khaerul.umam', '$2y$10$iNc8es1h6pHaDLogQ.eu8OpkGrvFcFJ1w6h8pozyMP7D0KqpTRdpS', NULL, 'Khaerul', 'Umam', 'khaerul.umam@bps.go.id', '08139999999', 'member1.png', 4, 1, NULL, NULL, NULL),
(23, 2, 'yohilda', '$2y$10$G8JmsuA6f7wYoqtO7lXN3uPpQZhAkuedI8VdTIJLa/0X4hmO0Ca06', NULL, 'Yohilda', 'Kutani', 'yohilda@bps.go.id', '08139999999', 'member5.png', 1, 1, NULL, NULL, NULL),
(24, 2, 'bps9105', '$2y$10$piyt5VOdetvlhrNFLwNx2OgFl4pYDm2YLjM9ik5MsC00v339tUh8q', NULL, 'asd', 'asd', 'yohilda@bps.go.id', '08139999999', 'admin1.png', 2, 1, NULL, NULL, NULL),
(25, 2, 'ekakristanto', '$2y$10$bcYVSe/4.M8Lpk4YdKUqT.qsCFS0.n746rVLAyO9Y3P6GxsumdCCi', NULL, 'Eka', 'Kristanto', 'ekakristanto@bps.go.id', '08139999999', 'member6.png', 6, 1, NULL, NULL, NULL),
(26, 2, 'henny', '$2y$10$T4Bj6y3RrGfLyRgPvYqoXuPFaP9XFwMCEs5D35CV12ROLDfs5kD4G', NULL, 'Henny', 'Wardhani', 'wardhany@bps.go.id', '08139999999', 'member7.png', 5, 1, NULL, NULL, NULL),
(27, 2, 'aris.surya', '$2y$10$V6kX94s5v9mGcUvoiN1EW.gUBjJu48jH8soGwHMtQsQfl1l2zNwO6', NULL, 'Aris', 'Suryawan', 'aris.surya@bps.go.id', '08139999999', 'member8.png', 3, 1, NULL, NULL, NULL),
(28, 2, 'yuni.astuti', '$2y$10$ubzrcYCsk8zfmtaIa5752OvrnldN5K2ybWWcqQEScvHMSsPfknV32', NULL, 'Yuni', 'Astuti', 'yuni.astuti@bps.go.id', '08139999999', 'member9.png', 2, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_aktivitas`
--
ALTER TABLE `tbl_aktivitas`
  ADD PRIMARY KEY (`id_aktivitas`);

--
-- Indeks untuk tabel `tbl_bmn`
--
ALTER TABLE `tbl_bmn`
  ADD PRIMARY KEY (`id_bmn`);

--
-- Indeks untuk tabel `tbl_kepemilikan_bmn`
--
ALTER TABLE `tbl_kepemilikan_bmn`
  ADD PRIMARY KEY (`id_kepemilikan_bmn`);

--
-- Indeks untuk tabel `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `tbl_link`
--
ALTER TABLE `tbl_link`
  ADD PRIMARY KEY (`id_link`);

--
-- Indeks untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_status_bmn`
--
ALTER TABLE `tbl_status_bmn`
  ADD PRIMARY KEY (`id_status_bmn`);

--
-- Indeks untuk tabel `tbl_surat_distribusi`
--
ALTER TABLE `tbl_surat_distribusi`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_ipds`
--
ALTER TABLE `tbl_surat_ipds`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_kepala`
--
ALTER TABLE `tbl_surat_kepala`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_nerwilis`
--
ALTER TABLE `tbl_surat_nerwilis`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_produksi`
--
ALTER TABLE `tbl_surat_produksi`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_sosial`
--
ALTER TABLE `tbl_surat_sosial`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_sp2020`
--
ALTER TABLE `tbl_surat_sp2020`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_tu`
--
ALTER TABLE `tbl_surat_tu`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_aktivitas`
--
ALTER TABLE `tbl_aktivitas`
  MODIFY `id_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT untuk tabel `tbl_bmn`
--
ALTER TABLE `tbl_bmn`
  MODIFY `id_bmn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_kepemilikan_bmn`
--
ALTER TABLE `tbl_kepemilikan_bmn`
  MODIFY `id_kepemilikan_bmn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_link`
--
ALTER TABLE `tbl_link`
  MODIFY `id_link` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_status_bmn`
--
ALTER TABLE `tbl_status_bmn`
  MODIFY `id_status_bmn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_distribusi`
--
ALTER TABLE `tbl_surat_distribusi`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_ipds`
--
ALTER TABLE `tbl_surat_ipds`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_kepala`
--
ALTER TABLE `tbl_surat_kepala`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_nerwilis`
--
ALTER TABLE `tbl_surat_nerwilis`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_produksi`
--
ALTER TABLE `tbl_surat_produksi`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_sosial`
--
ALTER TABLE `tbl_surat_sosial`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_sp2020`
--
ALTER TABLE `tbl_surat_sp2020`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_tu`
--
ALTER TABLE `tbl_surat_tu`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
