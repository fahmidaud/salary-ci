-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql100.epizy.com
-- Generation Time: Nov 24, 2022 at 02:16 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_32750102_salary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `namalengkap` varchar(40) NOT NULL,
  `photo` varchar(50) NOT NULL DEFAULT 'Avatar.png',
  `email` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`, `namalengkap`, `photo`, `email`, `level`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Pixel', 'admin361552.png', 'pixelsalary@gmail.com', 'admin'),
(10, 'fahmiadmin', '0ddff0c492465695c3d7936ef4a83de69f1895fb', 'Fahmi Daud Abdillah', 'admin3615521.png', 'fahmidaud354@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `kode_golongan` varchar(3) NOT NULL,
  `nama_golongan` varchar(50) NOT NULL,
  `tunjangan_suami_istri` int(10) NOT NULL,
  `tunjangan_anak` int(10) NOT NULL,
  `uang_makan` int(10) NOT NULL,
  `uang_lembur` int(10) NOT NULL,
  `asuransi_kesehatan` int(10) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`kode_golongan`, `nama_golongan`, `tunjangan_suami_istri`, `tunjangan_anak`, `uang_makan`, `uang_lembur`, `asuransi_kesehatan`, `bulan`, `tahun`) VALUES
('G01', 'II/a', 2700000, 1500000, 1000000, 420000, 4500000, '02', '2019'),
('G02', 'V/a', 1500000, 1200000, 900000, 250000, 3500000, '01', '2019'),
('G03', 'I/b', 4500000, 1900000, 2000000, 500000, 8000000, '04', '2019'),
('G04', 'III/a', 2000000, 1500000, 1000000, 300000, 4500000, '03', '2019'),
('G05', 'IV/a', 1700000, 1200000, 1000000, 270000, 3700000, '04', '2019'),
('G06', 'V/a', 10000000, 7000000, 500000, 100000, 1000000, '11', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `kode_jabatan` varchar(3) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `tunjangan_jabatan` int(10) NOT NULL,
  `potongan_sakit` int(10) NOT NULL,
  `potongan_izin` int(10) NOT NULL,
  `potongan_alpha` int(10) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`kode_jabatan`, `nama_jabatan`, `gaji_pokok`, `tunjangan_jabatan`, `potongan_sakit`, `potongan_izin`, `potongan_alpha`, `bulan`, `tahun`) VALUES
('J01', 'Manager', 7500000, 4500000, 0, 225000, 375000, '01', '2019'),
('J02', 'IT', 6000000, 2000000, 0, 180000, 300000, '02', '2019'),
('J03', 'HRD', 9500000, 3200000, 0, 285000, 475000, '04', '2019'),
('J04', 'SDM', 6500000, 2700000, 0, 195000, 325000, '03', '2019'),
('J06', 'Direktur', 10500000, 6000000, 0, 315000, 525000, '03', '2019'),
('J07', 'Programmer', 11000000, 11000000, 0, 330000, 550000, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_gaji`
--

CREATE TABLE `master_gaji` (
  `id` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `masuk` int(5) NOT NULL,
  `sakit` int(5) NOT NULL,
  `izin` int(5) NOT NULL,
  `alpha` int(5) NOT NULL,
  `lembur` int(5) NOT NULL,
  `uang_lembur` int(15) NOT NULL,
  `potongan` int(10) NOT NULL,
  `potongan_sakit` int(10) NOT NULL,
  `potongan_izin` int(10) NOT NULL,
  `potongan_alpha` int(10) NOT NULL,
  `pendapatan` int(15) NOT NULL,
  `total_gaji` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_gaji`
--

INSERT INTO `master_gaji` (`id`, `bulan`, `tahun`, `nip`, `masuk`, `sakit`, `izin`, `alpha`, `lembur`, `uang_lembur`, `potongan`, `potongan_sakit`, `potongan_izin`, `potongan_alpha`, `pendapatan`, `total_gaji`) VALUES
(649, '09', '2022', '116', 30, 0, 0, 0, 10, 4200000, 0, 0, 0, 0, 21700000, 21700000),
(648, '09', '2022', '118', 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 22700000, 22700000),
(647, '09', '2022', '117', 30, 0, 0, 0, 10, 2500000, 0, 0, 0, 0, 21600000, 21600000),
(646, '09', '2022', '119', 29, 1, 0, 0, 7, 2100000, 50000, 0, 0, 0, 21800000, 21750000),
(645, '09', '2022', '120', 28, 1, 1, 0, 3, 810000, 300000, 0, 315000, 0, 27310000, 26695000),
(644, '09', '2022', '121', 20, 3, 3, 4, 5, 500000, 500000, 0, 990000, 2200000, 24000000, 20310000);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `namalengkap` varchar(40) NOT NULL,
  `kode_jabatan` varchar(3) NOT NULL,
  `kode_golongan` varchar(3) NOT NULL,
  `status` varchar(15) NOT NULL,
  `jumlah_anak` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `photo` varchar(50) NOT NULL DEFAULT 'Avatar.png',
  `email` varchar(50) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `notelp` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `namalengkap`, `kode_jabatan`, `kode_golongan`, `status`, `jumlah_anak`, `username`, `password`, `photo`, `email`, `bulan`, `tahun`, `alamat`, `notelp`) VALUES
('121', 'Fahmi', 'J07', 'G06', 'Belum Menikah', 0, 'fahmi', 'b3f421c567b0d560d5865d9c96bbaff2cd336472', 'userss6.png', 'fahmi@gmail.com', '10', '2022', 'Bekasi Timur', '08153627548'),
('120', 'Bima', 'J06', 'G05', 'Menikah', 5, 'bima', '91584746e4f729423f8347a73e845593dc88ccc2', 'userss5.png', 'bima@gmail.com', '10', '2022', 'Jakarta', '81526377'),
('119', 'Cakra', 'J04', 'G04', 'Menikah', 2, 'cakra', '167b3754521161ee60b9a4d2c828c69904d557d7', 'userss4.png', 'cakra@gmail.com', '10', '2022', 'Bogor', '08152674832'),
('117', 'Iqbal F', 'J01', 'G02', 'Menikah', 1, 'iqbal', '65f568e1b3ac89d15bd804b9f1bd95cd37ca0ecb', 'userss2.png', 'iqbal@gmail.com', '10', '2022', 'Bekasi Timur', '081563723283'),
('118', 'Sekar', 'J03', 'G03', 'Belum Menikah', 0, 'sekar', 'b37c8335aef9ef7aa168de5e844eea32419ec57f', 'userss3.png', 'sekar@gmail.com', '10', '2022', 'Jakarta', '081563527328'),
('116', 'Arya Surya', 'J01', 'G01', 'Belum Menikah', 0, 'aryasurya', '6c8f39e16d4af97c30f1609af49ed2dbe24a7d91', 'userss1.png', 'aryasurya@gmail.com', '10', '2022', 'Jakarta Timur', '085156543647');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`kode_golongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indexes for table `master_gaji`
--
ALTER TABLE `master_gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`) USING BTREE;

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kode_jabatan` (`kode_jabatan`),
  ADD KEY `kode_golongan` (`kode_golongan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_gaji`
--
ALTER TABLE `master_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=650;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
