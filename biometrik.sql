-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2017 at 11:34 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biometrik`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int(11) NOT NULL,
  `tipe_berkas` varchar(20) NOT NULL,
  `no_berkas` varchar(50) NOT NULL,
  `path_berkas` varchar(110) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `tipe_berkas`, `no_berkas`, `path_berkas`, `creation_date`) VALUES
(1, '0', 'mama/A1234mma/IX/2017', 'Daftar_Riwayat_Hidup1.pdf', '2017-10-01 11:57:33'),
(2, '0', 'mama/A1234mma/IX/2017', 'Daftar_Riwayat_Hidup2.pdf', '2017-10-01 11:58:08'),
(3, '0', 'mama/A1234mma/IX/2017', 'Daftar_Riwayat_Hidup3.pdf', '2017-10-01 11:58:28'),
(4, '0', 'mama/A1234mma/IX/2017', 'Daftar_Riwayat_Hidup.pdf', '2017-10-01 12:00:33'),
(5, '0', 'mama/A1234mma/IX/2017', 'Daftar_Riwayat_Hidup1.pdf', '2017-10-01 12:00:40'),
(6, '0', 'mama/A1234mma/IX/2017', 'Daftar_Riwayat_Hidup2.pdf', '2017-10-01 12:01:21'),
(7, 'splp', 'Mama/123/IX/2017', 'Daftar_Riwayat_Hidup3.pdf', '2017-10-01 13:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id_config` int(11) NOT NULL,
  `nama_config` varchar(200) NOT NULL,
  `value` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id_config`, `nama_config`, `value`) VALUES
(1, 'Atase Hukum', 'Fajar Sulaeman T.'),
(2, 'Sekretaris Kedua Tituler', 'Fajar Sulaeman T.');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `id_role` int(11) NOT NULL,
  `lastvisit_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `id_role`, `lastvisit_at`) VALUES
(1, 'admin', 'admin', 1, '2017-09-30 11:23:25'),
(2, 'pegawai', 'pegawai', 2, '2017-09-30 11:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `pasal_splp`
--

CREATE TABLE `pasal_splp` (
  `id_pasal_splp` int(11) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasal_splp`
--

INSERT INTO `pasal_splp` (`id_pasal_splp`, `value`) VALUES
(1, 'Pasal 4 huruf b Undang - Undang Nomor 12 Tahun 2006');

-- --------------------------------------------------------

--
-- Table structure for table `pelepasan`
--

CREATE TABLE `pelepasan` (
  `id_pelepasan` int(11) NOT NULL,
  `kode_pelepasan` varchar(30) NOT NULL,
  `tipe_surat_sijil` int(11) NOT NULL,
  `no_surat_sijil` varchar(255) NOT NULL,
  `tgl_surat_sijil` varchar(30) NOT NULL,
  `nama` varchar(400) NOT NULL,
  `no_paspor` varchar(20) NOT NULL,
  `tgl_paspor` varchar(30) NOT NULL,
  `diterbitkan_oleh` varchar(200) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `tipe_kehilangan_menyerahkan` int(11) NOT NULL,
  `tempat_lahir` varchar(300) NOT NULL,
  `tgl_lahir` varchar(30) NOT NULL,
  `alamat_indonesia` varchar(300) NOT NULL,
  `alamat_malaysia` varchar(300) NOT NULL,
  `no_pengenalan` varchar(50) NOT NULL,
  `alasan` varchar(200) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelepasan`
--

INSERT INTO `pelepasan` (`id_pelepasan`, `kode_pelepasan`, `tipe_surat_sijil`, `no_surat_sijil`, `tgl_surat_sijil`, `nama`, `no_paspor`, `tgl_paspor`, `diterbitkan_oleh`, `no_telp`, `tipe_kehilangan_menyerahkan`, `tempat_lahir`, `tgl_lahir`, `alamat_indonesia`, `alamat_malaysia`, `no_pengenalan`, `alasan`, `creation_date`) VALUES
(1, '0001/MWNI.ATKUM/X/2017', 0, 'nanana', '14 September 2009', 'Udin Rahardjo', '123QWER', '25 Oktober 2017', 'Kanim Surabaya', '6262662616', 0, 'Surabaya', '25 Mei 1995', 'alamat di Indoneisa', 'ALmaanr nananw 1', '122484hNNakka', 'Karena nana', '2017-10-01 09:49:16'),
(2, '0002/MWNI.ATKUM/X/2017', 0, 'nanana', '14 September 2009', 'Udin Rahardjo', '123QWER', '25 Oktober 2017', 'Kanim Surabaya', '6262662616', 0, 'Surabaya', '25 Mei 1995', 'alamat di Indoneisa', 'ALmaanr nananw 1', '122484hNNakka', 'Karena nana', '2017-10-01 09:49:32'),
(3, '0003/MWNI.ATKUM/X/2017', 0, 'nanana', '14 September 2009', 'Udin Rahardjo', '123QWER', '25 Oktober 2017', 'Kanim Surabaya', '6262662616', 0, 'Surabaya', '25 Mei 1995', 'alamat di Indoneisa', 'ALmaanr nananw 1', '122484hNNakka', 'Karena nana', '2017-10-01 09:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `splp`
--

CREATE TABLE `splp` (
  `id_splp` int(11) NOT NULL,
  `kode_splp` varchar(50) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jenis_kel` varchar(2) NOT NULL,
  `id_pasal` int(11) NOT NULL,
  `tempat_lahir` varchar(500) NOT NULL,
  `tgl_lahir` varchar(30) NOT NULL,
  `nama_ibu` varchar(200) NOT NULL,
  `tempat_lahir_ibu` varchar(500) NOT NULL,
  `tgl_lahir_ibu` varchar(30) NOT NULL,
  `kewarganegaraan_ibu` varchar(100) NOT NULL,
  `nama_bapak` varchar(200) NOT NULL,
  `tempat_lahir_bapak` varchar(500) NOT NULL,
  `tgl_lahir_bapak` varchar(30) NOT NULL,
  `kewarganegaraan_bapak` varchar(100) NOT NULL,
  `alamat_indonesia` varchar(250) NOT NULL,
  `alamat_ln` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `splp`
--

INSERT INTO `splp` (`id_splp`, `kode_splp`, `nama`, `jenis_kel`, `id_pasal`, `tempat_lahir`, `tgl_lahir`, `nama_ibu`, `tempat_lahir_ibu`, `tgl_lahir_ibu`, `kewarganegaraan_ibu`, `nama_bapak`, `tempat_lahir_bapak`, `tgl_lahir_bapak`, `kewarganegaraan_bapak`, `alamat_indonesia`, `alamat_ln`, `created_by`, `creation_date`) VALUES
(1, '1', 'Sudirman', 'L', 1, 'Kuala Lumpur', '09/30/2017', 'Siti', 'Surabaya', '09/25/1992', '', 'Khoiruddin', 'Jakarta', '05/14/1992', '', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur', 2, '2017-09-30 11:47:10'),
(2, '1', 'Sudirman', 'L', 1, 'Kuala Lumpur', '09/30/2017', 'Siti', 'Surabaya', '09/25/1992', '', 'Khoiruddin', 'Jakarta', '05/14/1992', '', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur', 2, '2017-09-30 11:48:15'),
(3, '1', 'Sudirman', 'L', 1, 'Kuala Lumpur', '09/30/2017', 'Siti', 'Surabaya', '09/25/1992', '', 'Khoiruddin', 'Jakarta', '05/14/1992', '', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur', 2, '2017-09-30 11:49:06'),
(4, '1', 'Sudirman', 'L', 1, 'Kuala Lumpur', '09/30/2017', 'Siti', 'Surabaya', '09/25/1992', '', 'Khoiruddin', 'Jakarta', '05/14/1992', '', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur', 2, '2017-09-30 11:49:26'),
(5, '1', 'Sudirman', 'L', 1, 'Kuala Lumpur', '09/30/2017', 'Siti', 'Surabaya', '09/25/1992', '', 'Khoiruddin', 'Jakarta', '05/14/1992', '', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur', 2, '2017-09-30 11:49:51'),
(6, '0001/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:48:31'),
(7, '0002/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:49:08'),
(8, '0003/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:49:14'),
(9, '0004/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:49:31'),
(10, '0005/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:49:34'),
(11, '0006/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:50:28'),
(12, '0007/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:50:32'),
(13, '0008/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:56:55'),
(14, '0009/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 04:56:59'),
(15, '0010/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 05:18:44'),
(16, '0011/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 05:18:48'),
(17, '0012/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 05:19:23'),
(18, '0013/WNI/ATKUM/X/2017', 'Sudirman', 'P', 1, 'Kuala Lumpur', '09/09/2016', 'Siti Rohmana', 'Surabaya', '06/06/1999', 'INDONESIA', 'Kidomaru', 'Bengkulu', '05/25/1995', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa 58000 Kuala Lumpur ', 2, '2017-10-01 05:19:27'),
(19, '0014/WNI/ATKUM/X/2017', 'ALIFAH KHAIRAH RAHMAH ', 'P', 1, 'Kuala Lumpur', '16 Juni 20', 'Kurnia Diana', 'Surabaya', '25 Mei 199', 'INDONESIA', 'Buni Yani', 'Majalengka', '22 Desembe', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa\r\n58000 Kuala Lumpur ', 2, '2017-10-01 09:41:38'),
(20, '0015/WNI/ATKUM/X/2017', 'ALIFAH KHAIRAH RAHMAH ', 'P', 1, 'Kuala Lumpur', '16 Juni 20', 'Kurnia Diana', 'Surabaya', '25 Mei 199', 'INDONESIA', 'Buni Yani', 'Majalengka', '22 Desembe', 'INDONESIA', 'Ds.Subanayam, Kec.Selukukerjang, Kab.Bengkulu ', 'Blok 49-01-02 Jalan Sri Sentosa 8 Taman Seri Sentosa\r\n58000 Kuala Lumpur ', 2, '2017-10-01 09:41:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pasal_splp`
--
ALTER TABLE `pasal_splp`
  ADD PRIMARY KEY (`id_pasal_splp`);

--
-- Indexes for table `pelepasan`
--
ALTER TABLE `pelepasan`
  ADD PRIMARY KEY (`id_pelepasan`);

--
-- Indexes for table `splp`
--
ALTER TABLE `splp`
  ADD PRIMARY KEY (`id_splp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pasal_splp`
--
ALTER TABLE `pasal_splp`
  MODIFY `id_pasal_splp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pelepasan`
--
ALTER TABLE `pelepasan`
  MODIFY `id_pelepasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `splp`
--
ALTER TABLE `splp`
  MODIFY `id_splp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
