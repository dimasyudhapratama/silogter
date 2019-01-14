-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2019 at 04:09 PM
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
(25, 'DAK 17'),
(26, 'DAK 16'),
(27, 'Prop 18'),
(28, 'APBD II-16'),
(29, 'JKN 14');

-- --------------------------------------------------------

--
-- Table structure for table `detail_logistik`
--

CREATE TABLE `detail_logistik` (
  `id_detail_logistik` int(11) NOT NULL,
  `id_logistik` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jml_detail_stok` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `id_anggaran` int(3) NOT NULL,
  `exp_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_logistik`
--

INSERT INTO `detail_logistik` (`id_detail_logistik`, `id_logistik`, `tgl_masuk`, `jml_detail_stok`, `harga_satuan`, `id_anggaran`, `exp_date`) VALUES
(12, 9, '2019-01-14', 200, 25000, 28, '2019-01-31'),
(13, 8, '2019-01-14', -350, 17500, 26, '2019-02-01');

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
(1, 'Puskesmas Kec. Lumajang', 'Kec. Lumajang', '081000000000', 'puskesmas@test.com'),
(2, 'Puskesmas Kec. Yosowilangun', 'Jl. Raya Pasar Yosowilangun', '082311200', 'test@test.com');

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
(33, 'Obat Program Imunisasi'),
(34, 'BMHP'),
(35, 'Obat Program HIV'),
(36, 'Obat Program Gizi'),
(37, 'Obat Program Jiwa');

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
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logistik`
--

INSERT INTO `logistik` (`id_logistik`, `id_kat_logistik`, `nm_logistik`, `stok`, `minimal_stok`, `satuan`) VALUES
(6, 37, 'Clozapin 25 mg Tablet', 0, 2000, 'Tablet'),
(7, 37, 'Diazepam Tablet 2mg', 0, 2000, 'Tablet'),
(8, 33, 'Alat Suntik Sekali Pakai 5ml', -350, 500, 'Biji'),
(9, 34, 'Alat Suntik 3ml', 200, 200, 'Biji'),
(10, 34, 'Kapas Pembalut Hidrofil Drc 4 M x 10 cm', 0, 1000, 'Biji');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(3) NOT NULL,
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
(48, '19630411 199203 2 005', 'Dra. Tri Musyarofah, Apt', 'Pimpinan', 'Aktif'),
(49, '19861009 200604 2 003', 'Nur Latifah', 'Penanggung Jawab', 'Aktif'),
(50, '1212 12121', 'Dani', 'Petugas Gudang', 'Aktif');

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
(1, 'PT. Indofarma Abadi', '0334211222', 'cs@indofarma.com', 'Jl. Bumi Negara 12 Bandung'),
(2, 'ffzzz', '11112345', 'alirahmatullah@gmail.comzzzzz', 'dfsfs11');

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail_logistik_keluar`
--

CREATE TABLE `trx_detail_logistik_keluar` (
  `id_detail_keluar` int(13) NOT NULL,
  `no_regist_keluar` varchar(15) NOT NULL,
  `id_detail_logistik` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `id_anggaran` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_detail_logistik_keluar`
--

INSERT INTO `trx_detail_logistik_keluar` (`id_detail_keluar`, `no_regist_keluar`, `id_detail_logistik`, `harga`, `qty`, `subtotal`, `exp_date`, `id_anggaran`) VALUES
(12, 'BM/1/14012019', 12, 25000, 300, 7500000, '2019-01-31', 28),
(13, 'BM/1/14012019', 13, 17500, 600, 10500000, '2019-02-01', 26),
(14, 'BM/2/14012019', 12, 25000, 200, 5000000, '2019-01-31', 28),
(15, 'BM/2/14012019', 13, 17500, 150, 2625000, '2019-02-01', 26);

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
  `subtotal` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `id_anggaran` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_detail_logistik_masuk`
--

INSERT INTO `trx_detail_logistik_masuk` (`id_detail_masuk`, `no_regist_masuk`, `id_logistik`, `harga`, `qty`, `subtotal`, `exp_date`, `id_anggaran`) VALUES
(10, 'BM/1/14012019', 9, 25000, 1000, 25000000, '2019-01-31', 28),
(11, 'BM/1/14012019', 8, 17500, 1000, 17500000, '2019-02-01', 26);

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
  `nip_penerima` varchar(30) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_logistik_keluar`
--

INSERT INTO `trx_logistik_keluar` (`no_regist_keluar`, `tgl_keluar`, `id_pegawai_pimpinan`, `id_pegawai_pen_jawab`, `id_instansi_penerima`, `nm_penerima`, `nip_penerima`, `grand_total`, `status`) VALUES
('BM/1/14012019', '2019-01-14', 48, 49, 1, 'dr. Imron', '192002991201', 18000000, '1'),
('BM/2/14012019', '2019-01-14', 48, 49, 2, 'Japri Irwansyah', '20102 20012 12012', 7625000, '1');

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
('BM/1/14012019', '2019-01-14', 1, 48, 49, 42500000, '1');

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
(43, 48, 'tri1', '$2y$10$fkbwjGFEslzYIsAID9YPxOTj3Fr4Z6KO8mJSu34.UTpdj6o1TviZa', 'Pimpinan', 'Aktif'),
(44, 50, 'dani', '$2y$10$Qs1jHVfgd71O27kg/qArwuRq1LbV/xhFoxdCJbpHhWA4aPAMxxGpa', 'Operator', 'Aktif');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_stok`
--
CREATE TABLE `v_detail_stok` (
`id_detail_logistik` int(11)
,`nm_logistik` varchar(50)
,`tgl_masuk` date
,`jml_detail_stok` int(11)
,`stok_masuk` decimal(32,0)
,`stok_keluar` decimal(32,0)
,`exp_date` date
,`asal_anggaran` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_dl`
--
CREATE TABLE `v_dl` (
`id_detail_logistik` int(11)
,`id_logistik` int(11)
,`nm_logistik` varchar(50)
,`tgl_masuk` date
,`stok_masuk` decimal(32,0)
,`stok_keluar` decimal(32,0)
,`jml_real` int(11)
,`jml_operation` decimal(33,0)
,`exp_date` date
,`asal_anggaran` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tdlk`
--
CREATE TABLE `v_tdlk` (
`id_detail_keluar` int(13)
,`no_regist_keluar` varchar(15)
,`nm_logistik` varchar(50)
,`nm_kat_logistik` varchar(50)
,`satuan` varchar(20)
,`asal_anggaran` varchar(50)
,`exp_date` date
,`harga` int(11)
,`qty` int(11)
,`subtotal` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tdlm`
--
CREATE TABLE `v_tdlm` (
`id_detail_masuk` int(13)
,`no_regist_masuk` varchar(15)
,`nm_logistik` varchar(50)
,`nm_kat_logistik` varchar(50)
,`satuan` varchar(20)
,`asal_anggaran` varchar(50)
,`exp_date` date
,`harga` int(11)
,`qty` int(11)
,`subtotal` int(11)
);

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
,`nip_penerima` varchar(30)
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
-- Structure for view `v_detail_stok`
--
DROP TABLE IF EXISTS `v_detail_stok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_stok`  AS  select `dl`.`id_detail_logistik` AS `id_detail_logistik`,`logistik`.`nm_logistik` AS `nm_logistik`,`dl`.`tgl_masuk` AS `tgl_masuk`,`dl`.`jml_detail_stok` AS `jml_detail_stok`,(select sum(`tdlm`.`qty`) from (`trx_detail_logistik_masuk` `tdlm` join `trx_logistik_masuk` `tlm` on((`tdlm`.`no_regist_masuk` = `tlm`.`no_regist_masuk`))) where ((`dl`.`id_logistik` = `tdlm`.`id_logistik`) and (`dl`.`tgl_masuk` = `tlm`.`tgl_regist`) and (`dl`.`harga_satuan` = `tdlm`.`harga`) and (`dl`.`id_anggaran` = `tdlm`.`id_anggaran`) and (`dl`.`exp_date` = `tdlm`.`exp_date`))) AS `stok_masuk`,(select sum(`tdlk`.`qty`) from `trx_detail_logistik_keluar` `tdlk` where (`tdlk`.`id_detail_logistik` = `dl`.`id_detail_logistik`)) AS `stok_keluar`,`dl`.`exp_date` AS `exp_date`,`anggaran`.`asal_anggaran` AS `asal_anggaran` from ((`detail_logistik` `dl` join `logistik` on((`dl`.`id_logistik` = `logistik`.`id_logistik`))) join `anggaran` on((`dl`.`id_anggaran` = `anggaran`.`id_anggaran`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_dl`
--
DROP TABLE IF EXISTS `v_dl`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dl`  AS  select `dl`.`id_detail_logistik` AS `id_detail_logistik`,`logistik`.`id_logistik` AS `id_logistik`,`logistik`.`nm_logistik` AS `nm_logistik`,`dl`.`tgl_masuk` AS `tgl_masuk`,(select sum(`tdlm`.`qty`) from (`trx_detail_logistik_masuk` `tdlm` join `trx_logistik_masuk` `tlm` on((`tdlm`.`no_regist_masuk` = `tlm`.`no_regist_masuk`))) where ((`dl`.`id_logistik` = `tdlm`.`id_logistik`) and (`dl`.`tgl_masuk` = `tlm`.`tgl_regist`) and (`dl`.`harga_satuan` = `tdlm`.`harga`) and (`dl`.`id_anggaran` = `tdlm`.`id_anggaran`) and (`dl`.`exp_date` = `tdlm`.`exp_date`))) AS `stok_masuk`,(select sum(`tdlk`.`qty`) from `trx_detail_logistik_keluar` `tdlk` where (`tdlk`.`id_detail_logistik` = `dl`.`id_detail_logistik`)) AS `stok_keluar`,`dl`.`jml_detail_stok` AS `jml_real`,((select sum(`tdlm`.`qty`) from (`trx_detail_logistik_masuk` `tdlm` join `trx_logistik_masuk` `tlm` on((`tdlm`.`no_regist_masuk` = `tlm`.`no_regist_masuk`))) where ((`dl`.`id_logistik` = `tdlm`.`id_logistik`) and (`dl`.`tgl_masuk` = `tlm`.`tgl_regist`) and (`dl`.`harga_satuan` = `tdlm`.`harga`) and (`dl`.`id_anggaran` = `tdlm`.`id_anggaran`) and (`dl`.`exp_date` = `tdlm`.`exp_date`))) - (select sum(`tdlk`.`qty`) from `trx_detail_logistik_keluar` `tdlk` where (`tdlk`.`id_detail_logistik` = `dl`.`id_detail_logistik`))) AS `jml_operation`,`dl`.`exp_date` AS `exp_date`,`anggaran`.`asal_anggaran` AS `asal_anggaran` from ((`detail_logistik` `dl` join `logistik` on((`dl`.`id_logistik` = `logistik`.`id_logistik`))) join `anggaran` on((`dl`.`id_anggaran` = `anggaran`.`id_anggaran`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_tdlk`
--
DROP TABLE IF EXISTS `v_tdlk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tdlk`  AS  select `tdlk`.`id_detail_keluar` AS `id_detail_keluar`,`tdlk`.`no_regist_keluar` AS `no_regist_keluar`,`logistik`.`nm_logistik` AS `nm_logistik`,`kat_logistik`.`nm_kat_logistik` AS `nm_kat_logistik`,`logistik`.`satuan` AS `satuan`,`anggaran`.`asal_anggaran` AS `asal_anggaran`,`tdlk`.`exp_date` AS `exp_date`,`tdlk`.`harga` AS `harga`,`tdlk`.`qty` AS `qty`,`tdlk`.`subtotal` AS `subtotal` from ((((`trx_detail_logistik_keluar` `tdlk` join `detail_logistik` `dl` on((`tdlk`.`id_detail_logistik` = `dl`.`id_detail_logistik`))) join `logistik` on((`logistik`.`id_logistik` = `dl`.`id_logistik`))) join `anggaran` on((`dl`.`id_anggaran` = `anggaran`.`id_anggaran`))) join `kat_logistik` on((`logistik`.`id_kat_logistik` = `kat_logistik`.`id_kat_logistik`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_tdlm`
--
DROP TABLE IF EXISTS `v_tdlm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tdlm`  AS  select `tdlm`.`id_detail_masuk` AS `id_detail_masuk`,`tdlm`.`no_regist_masuk` AS `no_regist_masuk`,`l`.`nm_logistik` AS `nm_logistik`,`kl`.`nm_kat_logistik` AS `nm_kat_logistik`,`l`.`satuan` AS `satuan`,`a`.`asal_anggaran` AS `asal_anggaran`,`tdlm`.`exp_date` AS `exp_date`,`tdlm`.`harga` AS `harga`,`tdlm`.`qty` AS `qty`,`tdlm`.`subtotal` AS `subtotal` from (((`trx_detail_logistik_masuk` `tdlm` join `logistik` `l` on((`tdlm`.`id_logistik` = `l`.`id_logistik`))) join `anggaran` `a` on((`tdlm`.`id_anggaran` = `a`.`id_anggaran`))) join `kat_logistik` `kl` on((`l`.`id_kat_logistik` = `kl`.`id_kat_logistik`))) ;

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
-- Indexes for table `detail_logistik`
--
ALTER TABLE `detail_logistik`
  ADD PRIMARY KEY (`id_detail_logistik`),
  ADD KEY `id_anggaran` (`id_anggaran`),
  ADD KEY `id_logistik` (`id_logistik`);

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
  ADD KEY `id_kat_perbekalan` (`id_kat_logistik`);

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
  ADD KEY `id_perbekalan` (`id_detail_logistik`),
  ADD KEY `no_regist_keluar` (`no_regist_keluar`),
  ADD KEY `id_asal_anggaran` (`id_anggaran`);

--
-- Indexes for table `trx_detail_logistik_masuk`
--
ALTER TABLE `trx_detail_logistik_masuk`
  ADD PRIMARY KEY (`id_detail_masuk`),
  ADD KEY `no_regist_masuk` (`no_regist_masuk`),
  ADD KEY `id_perbekalan` (`id_logistik`),
  ADD KEY `id_asal_anggaran` (`id_anggaran`);

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
  MODIFY `id_anggaran` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `detail_logistik`
--
ALTER TABLE `detail_logistik`
  MODIFY `id_detail_logistik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `instansi_penerima`
--
ALTER TABLE `instansi_penerima`
  MODIFY `id_instansi_penerima` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kat_logistik`
--
ALTER TABLE `kat_logistik`
  MODIFY `id_kat_logistik` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `logistik`
--
ALTER TABLE `logistik`
  MODIFY `id_logistik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trx_detail_logistik_keluar`
--
ALTER TABLE `trx_detail_logistik_keluar`
  MODIFY `id_detail_keluar` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `trx_detail_logistik_masuk`
--
ALTER TABLE `trx_detail_logistik_masuk`
  MODIFY `id_detail_masuk` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_logistik`
--
ALTER TABLE `detail_logistik`
  ADD CONSTRAINT `detail_logistik_ibfk_1` FOREIGN KEY (`id_anggaran`) REFERENCES `anggaran` (`id_anggaran`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_logistik_ibfk_2` FOREIGN KEY (`id_logistik`) REFERENCES `logistik` (`id_logistik`) ON UPDATE CASCADE;

--
-- Constraints for table `logistik`
--
ALTER TABLE `logistik`
  ADD CONSTRAINT `logistik_ibfk_1` FOREIGN KEY (`id_kat_logistik`) REFERENCES `kat_logistik` (`id_kat_logistik`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_detail_logistik_keluar`
--
ALTER TABLE `trx_detail_logistik_keluar`
  ADD CONSTRAINT `trx_detail_logistik_keluar_ibfk_2` FOREIGN KEY (`no_regist_keluar`) REFERENCES `trx_logistik_keluar` (`no_regist_keluar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_detail_logistik_keluar_ibfk_4` FOREIGN KEY (`id_anggaran`) REFERENCES `anggaran` (`id_anggaran`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_detail_logistik_keluar_ibfk_5` FOREIGN KEY (`id_detail_logistik`) REFERENCES `detail_logistik` (`id_detail_logistik`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_detail_logistik_masuk`
--
ALTER TABLE `trx_detail_logistik_masuk`
  ADD CONSTRAINT `trx_detail_logistik_masuk_ibfk_3` FOREIGN KEY (`no_regist_masuk`) REFERENCES `trx_logistik_masuk` (`no_regist_masuk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_detail_logistik_masuk_ibfk_4` FOREIGN KEY (`id_logistik`) REFERENCES `logistik` (`id_logistik`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_detail_logistik_masuk_ibfk_5` FOREIGN KEY (`id_anggaran`) REFERENCES `anggaran` (`id_anggaran`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_logistik_keluar`
--
ALTER TABLE `trx_logistik_keluar`
  ADD CONSTRAINT `trx_logistik_keluar_ibfk_1` FOREIGN KEY (`id_instansi_penerima`) REFERENCES `instansi_penerima` (`id_instansi_penerima`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_logistik_keluar_ibfk_2` FOREIGN KEY (`id_pegawai_pen_jawab`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_logistik_keluar_ibfk_3` FOREIGN KEY (`id_pegawai_pimpinan`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `trx_logistik_masuk`
--
ALTER TABLE `trx_logistik_masuk`
  ADD CONSTRAINT `trx_logistik_masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_logistik_masuk_ibfk_2` FOREIGN KEY (`id_pegawai_pen_jawab`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trx_logistik_masuk_ibfk_3` FOREIGN KEY (`id_pegawai_pimpinan`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
