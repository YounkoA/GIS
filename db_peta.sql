-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 12:54 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabeluser`
--

CREATE TABLE `tabeluser` (
  `userid` varchar(20) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` varchar(15) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabeluser`
--

INSERT INTO `tabeluser` (`userid`, `username`, `password`, `level`, `nama`, `email`, `hp`) VALUES
('ihsan', '', '641645', 'admin', '-', 'ihsanilyas17@gmial.com', '081269259910'),
('younko', '', 'w', 'user', '-', 'ihsanilyas17@gmial.com', '6'),
('admin', '', 'admin', 'admin', '-', 'admin@gmail.com', '628890'),
('user', '', 'user', 'user', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gd`
--

CREATE TABLE `tbl_gd` (
  `id_gd` int(15) NOT NULL,
  `n_gd` text NOT NULL,
  `a_gd` text NOT NULL,
  `lat` varchar(10) NOT NULL,
  `lng` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gd`
--

INSERT INTO `tbl_gd` (`id_gd`, `n_gd`, `a_gd`, `lat`, `lng`) VALUES
(1, 'PT.Maar Perkasa Jaya Gas', 'Jl. Pesantren Kuta Krueng Ulee gle, Pidie Jaya, Muko Kuthang, Aceh, Kabupaten Pidie Jaya, Aceh 24152', '5.1996207', '96.3217061'),
(2, 'PT.Indung Tulot Energy', 'Garot Cut, Indrajaya, Kabupaten Pidie, Aceh 24182, Indonesia', '5.336906', '95.926151'),
(3, 'CV.Muhammad Noernikkmat', 'Jl. Kp. Blang - Lampoih Saka Meunasah Juerong, Simpang Tiga, Kabupaten Pidie, Aceh 24181', '5.323831', '95.983532'),
(4, 'SPPBE Rahmat Seulawah Jantan', 'Hagu, Panteraja, Kabupaten Pidie Jaya, Aceh', '5.269199', '96.130387');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `id_lokasi` int(5) NOT NULL,
  `id_gd` varchar(15) DEFAULT NULL,
  `namalokasi` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `lat` varchar(10) NOT NULL,
  `lng` varchar(10) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id_lokasi`, `id_gd`, `namalokasi`, `alamat`, `lat`, `lng`, `status`) VALUES
(2, '3', 'Mariah', 'Jl. Sigli - Kembang Tanjong, Simpang Tiga, Kabupaten Pidie, Aceh 24181, Indonesia', '5.343748', '95.994204', 'Pangkalan'),
(1, '1', 'Maar Perkasa', 'Jl. Profesor Abdul Majid Ibrahim, Lampeudeu Baroh, Pidie, Kabupaten Pidie, Aceh 24112, Indonesia', '5.369987', '95.958501', 'Pangkalan'),
(4, '2', 'Suci Hati', 'Jl. Sigli - Kembang Tanjong, Simpang Tiga, Kabupaten Pidie, Aceh 24181, Indonesia', '5.344613', '95.993571', 'Pangkalan'),
(5, '2', 'Efendi', 'Jl. Kp. Blang Meunasah Juerong, Simpang Tiga, Kabupaten Pidie, Aceh 24181, Indonesia', '5.3251566', '95.9837046', 'Pangkalan'),
(7, '3', 'Jufri', 'Jl. Kp. Blang - Lampoih Saka Meunasah Juerong, Simpang Tiga, Kabupaten Pidie, Aceh 24181, Indonesia\r\n', '5.3246708', '95.9836693', 'Pangkalan'),
(13, '3', 'Rakan LPG', 'Jl. Sigli - Kembang Tanjong, Kulam Baro, Simpang Tiga, Kabupaten Pidie, Aceh 24181, Indonesia', '5.325913', '96.000970', 'Pangkalan'),
(8, '2', 'BKPS', 'Jl. Sigli - Kembang Tanjong, Blang Paseh, Kota Sigli, Kabupaten Pidie, Aceh 24113, Indonesia\r\n', '5.3765771', '95.9702181', 'Pangkalan'),
(9, '3', 'Rahma Yanti', 'Jl. Sigli - Kembang Tanjong, Pante, Simpang Tiga, Kabupaten Pidie, Aceh 24181, Indonesia', '5.346218', '95.991918', 'Pangkalan'),
(10, '3', 'M Ali', 'Jl. Sigli - Kembang Tanjong, Sukon, Simpang Tiga, Kabupaten Pidie, Aceh 24181, Indonesia', '5.360859', '95.984626', 'Pangkalan'),
(14, '3', 'Maimun', 'Blang Leuen, Simpang Tiga, Kabupaten Pidie, Aceh 24181, Indonesia', '5.333038	', '96.005341', 'Pangkalan'),
(12, '2', 'UD. Jasa Keluarga', 'Lorong Mushalla, Kramat Luar, Kota Sigli, Kabupaten Pidie, Aceh 24114, Indonesia', '5.384432', '95.957527', 'Pangkalan'),
(15, '', 'PT.Maar Perkasa Jaya Gas', 'Jl. Pesantren Kuta Krueng Ulee gle, Pidie Jaya, Muko Kuthang, Aceh, Kabupaten Pidie Jaya, Aceh 24152', '5.1996207', '96.3217061', 'Gudang'),
(16, '', 'PT.Indung Tulot Energy', 'Garot Cut, Indrajaya, Kabupaten Pidie, Aceh 24182, Indonesia', '5.336906', '95.926151', 'Gudang\n'),
(17, '', 'CV.Muhammad Noernikkmat', 'Jl. Kp. Blang - Lampoih Saka Meunasah Juerong, Simpang Tiga, Kabupaten Pidie, Aceh 24181', '5.323831', '95.983532', 'Gudang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_gd`
--
ALTER TABLE `tbl_gd`
  ADD PRIMARY KEY (`id_gd`);

--
-- Indexes for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_gd`
--
ALTER TABLE `tbl_gd`
  MODIFY `id_gd` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id_lokasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
