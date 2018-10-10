-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2018 at 03:04 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silogter`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(3) NOT NULL,
  `asal_anggaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `asal_anggaran`) VALUES
(22, 'Prov. Jawa Timur'),
(23, 'aassdsds');

-- --------------------------------------------------------

--
-- Table structure for table `instansi_penerima`
--

CREATE TABLE `instansi_penerima` (
  `id_instansi_penerima` int(2) NOT NULL,
  `nm_instansi_penerima` varchar(30) NOT NULL,
  `alamat_instansi_penerima` varchar(70) NOT NULL,
  `cp_instansi_penerima` int(12) UNSIGNED NOT NULL,
  `email_instansi_penerima` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi_penerima`
--

INSERT INTO `instansi_penerima` (`id_instansi_penerima`, `nm_instansi_penerima`, `alamat_instansi_penerima`, `cp_instansi_penerima`, `email_instansi_penerima`) VALUES
(1, 'Puskesmas Kec. Lumajang', 'Jl. Semeru No. 3 Lumajang', 334100222, 'ddd@gm.com');

-- --------------------------------------------------------

--
-- Table structure for table `kat_logistik`
--

CREATE TABLE `kat_logistik` (
  `id_kat_logistik` int(2) NOT NULL,
  `nm_kat_logistik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kat_logistik`
--

INSERT INTO `kat_logistik` (`id_kat_logistik`, `nm_kat_logistik`) VALUES
(8, 'bismillah'),
(9, 'zx'),
(10, 'xsdsdsd'),
(11, 'zxzxzxzxzxzxzxzxz'),
(12, 'zxzx'),
(13, 'zxzxzxzxzxzxzxz'),
(14, 'test'),
(15, ' -=[]'),
(16, 'zxzxzx'),
(17, 'zxzxzx'),
(18, 'zxzxzxzxzxzxzxzxzxzx'),
(19, 'zxzxzx'),
(20, 'zxzxzxzxzxsdssdsdsdsd'),
(21, 'u'),
(22, 'zxzxzx'),
(23, 'asasasasasasasasasasa'),
(24, 'zxz'),
(25, 'za'),
(26, 'zasasas');

-- --------------------------------------------------------

--
-- Table structure for table `logistik`
--

CREATE TABLE `logistik` (
  `id_logistik` int(11) NOT NULL,
  `id_kat_logistik` int(2) NOT NULL,
  `nm_logistik` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_satuan` int(20) NOT NULL,
  `id_anggaran` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jabatan` enum('pimpinan','pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(2) NOT NULL,
  `nm_supplier` varchar(30) NOT NULL,
  `cp_supplier` varchar(12) NOT NULL,
  `email_supplier` varchar(30) NOT NULL,
  `alamat_supplier` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nm_supplier`, `cp_supplier`, `email_supplier`, `alamat_supplier`) VALUES
(1, 'Biofarma', '0334111000', 'email@biofarma.com', 'Jl. Bangka 11 Bandung');

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail_logistik_keluar`
--

CREATE TABLE `trx_detail_logistik_keluar` (
  `id_detail_keluar` int(13) NOT NULL,
  `no_regist_keluar` int(11) NOT NULL,
  `id_logistik` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail_logistik_masuk`
--

CREATE TABLE `trx_detail_logistik_masuk` (
  `id_detail_masuk` int(13) NOT NULL,
  `no_regist_masuk` int(11) NOT NULL,
  `id_logistik` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trx_logistik_keluar`
--

CREATE TABLE `trx_logistik_keluar` (
  `no_regist_keluar` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_instansi_penerima` int(2) NOT NULL,
  `nm_penerima` varchar(30) NOT NULL,
  `nip_penerima` varchar(15) NOT NULL,
  `grand_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trx_logistik_masuk`
--

CREATE TABLE `trx_logistik_masuk` (
  `no_regist_masuk` int(11) NOT NULL,
  `tgl_regist` date NOT NULL,
  `id_supplier` int(2) NOT NULL,
  `id_pegawai` int(3) NOT NULL,
  `grand_total` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `instansi_penerima`
--
ALTER TABLE `instansi_penerima`
  ADD PRIMARY KEY (`id_instansi_penerima`);

--
-- Indexes for table `kat_logistik`
--
ALTER TABLE `kat_logistik`
  ADD PRIMARY KEY (`id_kat_logistik`);

--
-- Indexes for table `logistik`
--
ALTER TABLE `logistik`
  ADD PRIMARY KEY (`id_logistik`),
  ADD KEY `id_kat_perbekalan` (`id_kat_logistik`,`id_anggaran`),
  ADD KEY `id_anggaran` (`id_anggaran`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `trx_detail_logistik_keluar`
--
ALTER TABLE `trx_detail_logistik_keluar`
  ADD PRIMARY KEY (`id_detail_keluar`),
  ADD KEY `id_perbekalan` (`id_logistik`);

--
-- Indexes for table `trx_detail_logistik_masuk`
--
ALTER TABLE `trx_detail_logistik_masuk`
  ADD PRIMARY KEY (`id_detail_masuk`),
  ADD KEY `no_regist_masuk` (`no_regist_masuk`),
  ADD KEY `id_perbekalan` (`id_logistik`);

--
-- Indexes for table `trx_logistik_keluar`
--
ALTER TABLE `trx_logistik_keluar`
  ADD PRIMARY KEY (`no_regist_keluar`),
  ADD KEY `id_instansi_penerima` (`id_instansi_penerima`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `trx_logistik_masuk`
--
ALTER TABLE `trx_logistik_masuk`
  ADD PRIMARY KEY (`no_regist_masuk`),
  ADD KEY `id_supplier` (`id_supplier`,`id_pegawai`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `instansi_penerima`
--
ALTER TABLE `instansi_penerima`
  MODIFY `id_instansi_penerima` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kat_logistik`
--
ALTER TABLE `kat_logistik`
  MODIFY `id_kat_logistik` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `logistik`
--
ALTER TABLE `logistik`
  MODIFY `id_logistik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trx_detail_logistik_keluar`
--
ALTER TABLE `trx_detail_logistik_keluar`
  MODIFY `id_detail_keluar` int(13) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trx_detail_logistik_masuk`
--
ALTER TABLE `trx_detail_logistik_masuk`
  MODIFY `id_detail_masuk` int(13) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trx_logistik_keluar`
--
ALTER TABLE `trx_logistik_keluar`
  MODIFY `no_regist_keluar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trx_logistik_masuk`
--
ALTER TABLE `trx_logistik_masuk`
  MODIFY `no_regist_masuk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `logistik`
--
ALTER TABLE `logistik`
  ADD CONSTRAINT `logistik_ibfk_1` FOREIGN KEY (`id_kat_logistik`) REFERENCES `kat_logistik` (`id_kat_logistik`) ON UPDATE CASCADE,
  ADD CONSTRAINT `logistik_ibfk_2` FOREIGN KEY (`id_anggaran`) REFERENCES `anggaran` (`id_anggaran`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_detail_logistik_keluar`
--
ALTER TABLE `trx_detail_logistik_keluar`
  ADD CONSTRAINT `trx_detail_logistik_keluar_ibfk_1` FOREIGN KEY (`id_logistik`) REFERENCES `logistik` (`id_logistik`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_detail_logistik_masuk`
--
ALTER TABLE `trx_detail_logistik_masuk`
  ADD CONSTRAINT `trx_detail_logistik_masuk_ibfk_1` FOREIGN KEY (`no_regist_masuk`) REFERENCES `trx_logistik_masuk` (`no_regist_masuk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_detail_logistik_masuk_ibfk_2` FOREIGN KEY (`id_logistik`) REFERENCES `logistik` (`id_logistik`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_logistik_keluar`
--
ALTER TABLE `trx_logistik_keluar`
  ADD CONSTRAINT `trx_logistik_keluar_ibfk_1` FOREIGN KEY (`id_instansi_penerima`) REFERENCES `instansi_penerima` (`id_instansi_penerima`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_logistik_keluar_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_logistik_masuk`
--
ALTER TABLE `trx_logistik_masuk`
  ADD CONSTRAINT `trx_logistik_masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_logistik_masuk_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
