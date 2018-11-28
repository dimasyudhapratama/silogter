-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 06:47 AM
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
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `id_bantuan` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`id_bantuan`, `pertanyaan`, `jawaban`) VALUES
(1, 'TES', 'Lorem ipsum dolor sit amet'),
(2, 'zzzzzzzzzzzzz', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore'),
(3, 'zzzzzzzzzzzz', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(4, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz');

-- --------------------------------------------------------

--
-- Table structure for table `instansi_penerima`
--

CREATE TABLE `instansi_penerima` (
  `id_instansi_penerima` int(2) NOT NULL,
  `nm_instansi_penerima` varchar(50) NOT NULL,
  `alamat_instansi_penerima` varchar(70) NOT NULL,
  `cp_instansi_penerima` varchar(12) NOT NULL,
  `email_instansi_penerima` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi_penerima`
--

INSERT INTO `instansi_penerima` (`id_instansi_penerima`, `nm_instansi_penerima`, `alamat_instansi_penerima`, `cp_instansi_penerima`, `email_instansi_penerima`) VALUES
(1, 'Puskesmas Kec. Lumajang', 'Jl. Semeru No. 3 Lumajang', '334100222', 'ddd@gm.com'),
(2, 'Puskemas Desa Krai Kec. Yosowi', 'asasasass', '0823219001', 'zx@c.c'),
(3, 'puskesmas testz', 'asasasdadasdasdsadasd', '0829291222', 'sa@as.comn');

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
(27, 'Suntik'),
(28, 'Oksigen'),
(29, 'Obat Gigi'),
(30, 'Reagen'),
(31, 'Obat Program Tb Paru'),
(32, 'Obat Program Kusta'),
(33, 'Obat Program Imunisasi');

-- --------------------------------------------------------

--
-- Table structure for table `logistik`
--

CREATE TABLE `logistik` (
  `id_logistik` int(11) NOT NULL,
  `id_kat_logistik` int(2) NOT NULL,
  `nm_logistik` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `minimal_stok` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_satuan` int(20) NOT NULL,
  `id_anggaran` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logistik`
--

INSERT INTO `logistik` (`id_logistik`, `id_kat_logistik`, `nm_logistik`, `stok`, `minimal_stok`, `satuan`, `harga_satuan`, `id_anggaran`) VALUES
(3, 27, 'S', 10382, 0, 'Botol', 10000, 22),
(4, 28, 'aasassssfffg', 0, 0, 'Botol', 3, 23),
(5, 27, 'zxxx', 900, 0, 'Botol', 11121222, 22),
(6, 28, 'Pinicyln', 500, 0, 'Tablet', 10000, 22),
(7, 27, 'Oke', 0, 0, 'Botol', 1222, 22),
(8, 27, 'zx', 0, 0, 'Botol', 12, 23),
(9, 27, 'z', 0, 100, 'Botol', 10000, 22),
(10, 29, 'Obat Gigi 1', 0, 100, 'Botol', 1000, 22),
(11, 29, 'Obat Gigi 2', 0, 111, 'Botol', 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jabatan` enum('Pimpinan','Penanggung Jawab','Petugas Gudang') NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nip`, `nama`, `jabatan`, `status`) VALUES
(1, '192919', 'Dimas Yudha Pratama', 'Petugas Gudang', 'Aktif'),
(8, '1220002', 'jainuri', 'Petugas Gudang', 'Aktif'),
(42, '11', 'a', 'Pimpinan', 'Non Aktif'),
(43, 'a', 'anjir', 'Pimpinan', 'Non Aktif'),
(44, '111', 'dani', 'Pimpinan', 'Aktif'),
(45, '1111', 'test_pj', 'Penanggung Jawab', 'Aktif'),
(46, '1212', 'test_pg_admin', 'Petugas Gudang', 'Aktif'),
(47, '121212222222', 'test_pg_op', 'Petugas Gudang', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(2) NOT NULL,
  `nm_supplier` varchar(50) NOT NULL,
  `cp_supplier` varchar(12) NOT NULL,
  `email_supplier` varchar(30) NOT NULL,
  `alamat_supplier` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nm_supplier`, `cp_supplier`, `email_supplier`, `alamat_supplier`) VALUES
(3, 'zxzx', 'zxzx', 'zxzxzxz', 'zxzxzxz'),
(8, 'Indofarma', '0823111', 'a@a.com', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail_logistik_keluar`
--

CREATE TABLE `trx_detail_logistik_keluar` (
  `id_detail_keluar` int(13) NOT NULL,
  `no_regist_keluar` varchar(15) NOT NULL,
  `id_logistik` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_detail_logistik_keluar`
--

INSERT INTO `trx_detail_logistik_keluar` (`id_detail_keluar`, `no_regist_keluar`, `id_logistik`, `harga`, `qty`, `subtotal`) VALUES
(1, 'BM/1/23112018', 3, 10000, 100, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail_logistik_masuk`
--

CREATE TABLE `trx_detail_logistik_masuk` (
  `id_detail_masuk` int(13) NOT NULL,
  `no_regist_masuk` varchar(15) NOT NULL,
  `id_logistik` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_detail_logistik_masuk`
--

INSERT INTO `trx_detail_logistik_masuk` (`id_detail_masuk`, `no_regist_masuk`, `id_logistik`, `harga`, `qty`, `subtotal`) VALUES
(3, 'BM/1/23112018', 3, 10000, 1, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `trx_logistik_keluar`
--

CREATE TABLE `trx_logistik_keluar` (
  `no_regist_keluar` varchar(15) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `id_pegawai_pimpinan` int(3) NOT NULL,
  `id_pegawai_pen_jawab` int(3) NOT NULL,
  `id_instansi_penerima` int(2) NOT NULL,
  `nm_penerima` varchar(30) NOT NULL,
  `nip_penerima` varchar(15) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_logistik_keluar`
--

INSERT INTO `trx_logistik_keluar` (`no_regist_keluar`, `tgl_keluar`, `id_pegawai_pimpinan`, `id_pegawai_pen_jawab`, `id_instansi_penerima`, `nm_penerima`, `nip_penerima`, `grand_total`, `status`) VALUES
('BM/1/23112018', '2018-11-23', 42, 43, 1, 'a', '1212', 1000000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `trx_logistik_masuk`
--

CREATE TABLE `trx_logistik_masuk` (
  `no_regist_masuk` varchar(15) NOT NULL,
  `tgl_regist` date NOT NULL,
  `id_supplier` int(2) NOT NULL,
  `id_pegawai_pimpinan` int(3) NOT NULL,
  `id_pegawai_pen_jawab` int(3) NOT NULL,
  `grand_total` int(15) NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_logistik_masuk`
--

INSERT INTO `trx_logistik_masuk` (`no_regist_masuk`, `tgl_regist`, `id_supplier`, `id_pegawai_pimpinan`, `id_pegawai_pen_jawab`, `grand_total`, `status`) VALUES
('BM/1/23112018', '2018-11-23', 3, 42, 43, 10000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Pimpinan','Operator') NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_pegawai`, `username`, `password`, `level`, `status`) VALUES
(1, 1, 'dypo', '$2y$10$RKFmTJyV4AJx4MEZGgMBKeqSpndBB1tGfs1Z5GxmuN2vltiZqXPkC', 'Admin', 'Aktif'),
(36, 42, 'a', '$2y$10$/z5Bz3zjT3ano4M0JBPvaeE5U6khaeWbilx/GatMKAu4bfyA.mE3G', 'Pimpinan', 'Aktif'),
(38, 43, 'test', '', 'Pimpinan', 'Aktif'),
(39, 44, 'dani', '$2y$10$R1M2xG22ETVXs4ikq7r.AOGc7/V3JaWLGd0hr4sk9Ypq5yZ0apCSe', 'Pimpinan', 'Aktif'),
(40, 46, 'test_pg_admin', '$2y$10$a.KhnGyFec9nouZuQDlnDOr1MR3dXQXGVOHq5Ws46eMwwwPxOVo3G', 'Admin', 'Aktif'),
(42, 47, 'test_pg_op', '$2y$10$IikG0wSk336fO.ELLGpJfuD0wBfn5Yc3NvjthasVQFJD5HutlcOY2', 'Operator', 'Aktif');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tlk`
--
CREATE TABLE `v_tlk` (
`no_regist_keluar` varchar(15)
,`tgl_keluar` date
,`nm_pimpinan` varchar(30)
,`nm_pen_jawab` varchar(30)
,`nm_instansi_penerima` varchar(50)
,`nm_penerima` varchar(30)
,`nip_penerima` varchar(15)
,`grand_total` int(11)
,`status` enum('0','1','2')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tlm`
--
CREATE TABLE `v_tlm` (
`no_regist_masuk` varchar(15)
,`tgl_regist` date
,`nm_supplier` varchar(50)
,`nama_pimpinan` varchar(30)
,`nama_penanggung_jawab` varchar(30)
,`grand_total` int(15)
,`status` enum('0','1','2')
);

-- --------------------------------------------------------

--
-- Structure for view `v_tlk`
--
DROP TABLE IF EXISTS `v_tlk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tlk`  AS  select `tlk`.`no_regist_keluar` AS `no_regist_keluar`,`tlk`.`tgl_keluar` AS `tgl_keluar`,`pe1`.`nama` AS `nm_pimpinan`,`pe2`.`nama` AS `nm_pen_jawab`,`ip`.`nm_instansi_penerima` AS `nm_instansi_penerima`,`tlk`.`nm_penerima` AS `nm_penerima`,`tlk`.`nip_penerima` AS `nip_penerima`,`tlk`.`grand_total` AS `grand_total`,`tlk`.`status` AS `status` from (((`trx_logistik_keluar` `tlk` join `pegawai` `pe1` on((`tlk`.`id_pegawai_pimpinan` = `pe1`.`id_pegawai`))) join `pegawai` `pe2` on((`tlk`.`id_pegawai_pen_jawab` = `pe2`.`id_pegawai`))) join `instansi_penerima` `ip` on((`tlk`.`id_instansi_penerima` = `ip`.`id_instansi_penerima`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_tlm`
--
DROP TABLE IF EXISTS `v_tlm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tlm`  AS  select `trx_logistik_masuk`.`no_regist_masuk` AS `no_regist_masuk`,`trx_logistik_masuk`.`tgl_regist` AS `tgl_regist`,`supplier`.`nm_supplier` AS `nm_supplier`,`pe1`.`nama` AS `nama_pimpinan`,`pe2`.`nama` AS `nama_penanggung_jawab`,`trx_logistik_masuk`.`grand_total` AS `grand_total`,`trx_logistik_masuk`.`status` AS `status` from (((`trx_logistik_masuk` join `supplier` on((`trx_logistik_masuk`.`id_supplier` = `supplier`.`id_supplier`))) join `pegawai` `pe1` on((`trx_logistik_masuk`.`id_pegawai_pimpinan` = `pe1`.`id_pegawai`))) join `pegawai` `pe2` on((`trx_logistik_masuk`.`id_pegawai_pen_jawab` = `pe2`.`id_pegawai`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`id_bantuan`);

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
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `nip` (`nip`);

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
  ADD KEY `id_pegawai` (`id_pegawai_pen_jawab`),
  ADD KEY `id_pegawai_pimpinan` (`id_pegawai_pimpinan`);

--
-- Indexes for table `trx_logistik_masuk`
--
ALTER TABLE `trx_logistik_masuk`
  ADD PRIMARY KEY (`no_regist_masuk`),
  ADD KEY `id_supplier` (`id_supplier`,`id_pegawai_pen_jawab`),
  ADD KEY `id_pegawai` (`id_pegawai_pen_jawab`),
  ADD KEY `id_pegawai_pimpinan` (`id_pegawai_pimpinan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `id_bantuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `instansi_penerima`
--
ALTER TABLE `instansi_penerima`
  MODIFY `id_instansi_penerima` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kat_logistik`
--
ALTER TABLE `kat_logistik`
  MODIFY `id_kat_logistik` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `logistik`
--
ALTER TABLE `logistik`
  MODIFY `id_logistik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `trx_detail_logistik_keluar`
--
ALTER TABLE `trx_detail_logistik_keluar`
  MODIFY `id_detail_keluar` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trx_detail_logistik_masuk`
--
ALTER TABLE `trx_detail_logistik_masuk`
  MODIFY `id_detail_masuk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
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
  ADD CONSTRAINT `trx_detail_logistik_masuk_ibfk_2` FOREIGN KEY (`id_logistik`) REFERENCES `logistik` (`id_logistik`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_detail_logistik_masuk_ibfk_3` FOREIGN KEY (`no_regist_masuk`) REFERENCES `trx_logistik_masuk` (`no_regist_masuk`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_logistik_keluar`
--
ALTER TABLE `trx_logistik_keluar`
  ADD CONSTRAINT `trx_logistik_keluar_ibfk_1` FOREIGN KEY (`id_instansi_penerima`) REFERENCES `instansi_penerima` (`id_instansi_penerima`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_logistik_keluar_ibfk_2` FOREIGN KEY (`id_pegawai_pen_jawab`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_logistik_masuk`
--
ALTER TABLE `trx_logistik_masuk`
  ADD CONSTRAINT `trx_logistik_masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_logistik_masuk_ibfk_2` FOREIGN KEY (`id_pegawai_pen_jawab`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
