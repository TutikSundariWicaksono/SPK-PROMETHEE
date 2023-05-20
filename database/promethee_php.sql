-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 04:17 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promethee_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `alternatif` varchar(50) NOT NULL,
  `id_divisi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nik`, `alternatif`, `id_divisi`) VALUES
(6, 'J20210438', 'Stevanus Christian', 10),
(7, 'J20190823', 'Leon Jovensen', 6),
(8, 'J20181004', 'Prayogi Pangestu', 4),
(9, 'J20180923', 'Ahmad Riduan', 2),
(10, 'J20200253', 'Mario Fernando', 3),
(17, 'J20170342', 'Ridwan Meidiyandi', 8),
(18, 'J20180523', 'Hendra Bhaktiawan', 3),
(19, 'J20180323', 'Jeni Saputra', 2),
(20, 'J20170048', 'Ryo Handoko', 7),
(21, 'J20180201', 'Kristian', 8),
(22, 'J20190183', 'Sandy Indrawan', 3),
(23, 'J20190023', 'Deden Afriansyah', 1),
(24, 'J20200345', 'Cynthia Caroline', 1),
(25, 'J20210133', 'Efin San Agiarta Sinaga', 2),
(26, 'J20180182', 'Titin Chen', 7),
(27, 'J20210132', 'Thirto Pardede', 10);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `divisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `divisi`) VALUES
(1, 'HR'),
(2, 'IT dan CCTV'),
(3, 'Operasional'),
(4, 'Network'),
(5, 'Quality Control'),
(6, 'POP'),
(7, 'Finance'),
(8, 'Call Center'),
(10, 'Asset Management');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_akhir`
--

CREATE TABLE `hasil_akhir` (
  `id_hasil_akhir` int(11) NOT NULL,
  `id_seleksi_alternatif` int(11) NOT NULL,
  `nilai_lf` double NOT NULL,
  `nilai_ef` double NOT NULL,
  `nilai_nf` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hasil_akhir`
--

INSERT INTO `hasil_akhir` (`id_hasil_akhir`, `id_seleksi_alternatif`, `nilai_lf`, `nilai_ef`, `nilai_nf`) VALUES
(1, 1, 0.055555555555557, 0.074074074074073, -0.018518518518517),
(2, 2, 0.27777777777778, 0.2962962962963, -0.018518518518523),
(3, 3, 0.092592592592593, 0.37037037037037, -0.27777777777778),
(4, 4, 0, 0, 0),
(5, 5, 0, 0, 0),
(6, 10, 0.38888888888889, 0.074074074074073, 0.31481481481482),
(7, 12, 2.5, 0, 2.5),
(8, 15, 2.1683673469388, 0.30612244897959, 1.8622448979592),
(9, 19, 2.969387755102, 0.22959183673469, 2.7397959183673),
(10, 20, 1.5, 0.92857142857143, 0.57142857142856),
(11, 21, 0.88775510204081, 1.234693877551, -0.3469387755102),
(12, 23, 2.1428571428571, 0, 2.1428571428571),
(13, 24, 0.025, 2, -1.975),
(14, 26, 1.125, 0, 1.125),
(15, 27, 0.3125, 0.8125, -0.5),
(16, 28, 0, 0.625, -0.625),
(17, 29, 2.6530612244898, 0.77551020408163, 1.8775510204082),
(18, 30, 1.530612244898, 1.030612244898, 0.5),
(19, 31, 1.6428571428571, 0.91836734693877, 0.72448979591836),
(20, 32, 1.2857142857143, 1.3010204081633, -0.015306122448971),
(21, 33, 1.265306122449, 1.6530612244898, -0.38775510204081),
(22, 34, 0.78571428571429, 1.8061224489796, -1.0204081632653),
(23, 35, 0.58163265306122, 3.0051020408163, -2.4234693877551),
(24, 36, 0.38775510204081, 2.7295918367347, -2.3418367346939),
(25, 37, 0.17857142857143, 2.2551020408163, -2.0765306122449),
(26, 38, 0, 2.1632653061224, -2.1632653061224),
(27, 39, 0.125, 0, 0.125),
(28, 40, 0, 0.125, -0.125),
(29, 41, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_awal`
--

CREATE TABLE `hasil_awal` (
  `id_hasil_awal` int(11) NOT NULL,
  `id_seleksi_alternatif_1` int(11) NOT NULL,
  `id_seleksi_alternatif_2` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `id_seleksi` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hasil_awal`
--

INSERT INTO `hasil_awal` (`id_hasil_awal`, `id_seleksi_alternatif_1`, `id_seleksi_alternatif_2`, `nilai`, `id_seleksi`, `status`) VALUES
(1, 1, 2, 0.16666666666667, 1, 1),
(2, 1, 3, 0, 1, 1),
(3, 2, 1, 0, 1, 1),
(4, 2, 3, 0.72222222222222, 1, 1),
(5, 3, 1, 0, 1, 1),
(6, 3, 2, 0.16666666666667, 1, 1),
(7, 4, 5, 0, 2, 1),
(8, 5, 4, 0, 2, 1),
(9, 1, 10, 0, 1, 1),
(10, 2, 10, 0.11111111111111, 1, 1),
(11, 3, 10, 0.11111111111111, 1, 1),
(12, 10, 1, 0.22222222222222, 1, 1),
(13, 10, 2, 0.55555555555556, 1, 1),
(14, 10, 3, 0.38888888888889, 1, 1),
(15, 12, 15, 4.2857142857143, 4, 1),
(16, 12, 19, 0, 4, 1),
(17, 12, 20, 4.8571428571429, 4, 1),
(18, 12, 21, 4.1428571428571, 4, 1),
(19, 15, 12, 0, 4, 1),
(20, 15, 19, 3.2142857142857, 4, 1),
(21, 15, 20, 2.7142857142857, 4, 1),
(22, 15, 21, 2.7142857142857, 4, 1),
(23, 19, 12, 0, 4, 1),
(24, 19, 15, 0, 4, 1),
(25, 19, 20, 5.4285714285714, 4, 1),
(26, 19, 21, 6.1428571428571, 4, 1),
(27, 20, 12, 0, 4, 1),
(28, 20, 15, 0, 4, 1),
(29, 20, 19, 0, 4, 1),
(30, 20, 21, 4.2857142857143, 4, 1),
(31, 21, 12, 0, 4, 1),
(32, 21, 15, 0, 4, 1),
(33, 21, 19, 0, 4, 1),
(34, 21, 20, 0, 4, 1),
(35, 12, 23, 0, 4, 0),
(36, 15, 23, 0, 4, 0),
(37, 19, 23, 0, 4, 0),
(38, 20, 23, 0, 4, 0),
(39, 21, 23, 0, 4, 0),
(40, 23, 12, 2.1428571428571, 4, 0),
(41, 23, 15, 2.1428571428571, 4, 0),
(42, 23, 19, 2.1428571428571, 4, 0),
(43, 23, 20, 2.1428571428571, 4, 0),
(44, 23, 21, 2.1428571428571, 4, 0),
(45, 12, 24, 3.125, 4, 0),
(46, 15, 24, 1.875, 4, 0),
(47, 19, 24, 3.125, 4, 0),
(48, 20, 24, 1.875, 4, 0),
(49, 21, 24, 0, 4, 0),
(50, 24, 12, 0, 4, 0),
(51, 24, 15, 0, 4, 0),
(52, 24, 19, 0.125, 4, 0),
(53, 24, 20, 0, 4, 0),
(54, 24, 21, 0, 4, 0),
(55, 26, 27, 1.625, 5, 1),
(56, 26, 28, 0.625, 5, 1),
(57, 27, 26, 0, 5, 1),
(58, 27, 28, 0.625, 5, 1),
(59, 28, 26, 0, 5, 1),
(60, 28, 27, 0, 5, 1),
(61, 12, 29, 1.1428571428571, 4, 1),
(62, 12, 30, 2.5714285714286, 4, 1),
(63, 12, 31, 0, 4, 1),
(64, 12, 32, 1.4285714285714, 4, 1),
(65, 12, 33, 3.4285714285714, 4, 1),
(66, 12, 34, 1.4285714285714, 4, 1),
(67, 12, 35, 4.2857142857143, 4, 1),
(68, 12, 36, 4.2857142857143, 4, 1),
(69, 12, 37, 2.5714285714286, 4, 1),
(70, 12, 38, 0.57142857142857, 4, 1),
(71, 15, 29, 4.3571428571429, 4, 1),
(72, 15, 30, 2.2142857142857, 4, 1),
(73, 15, 31, 2.1428571428571, 4, 1),
(74, 15, 32, 3.2142857142857, 4, 1),
(75, 15, 33, 1.6428571428571, 4, 1),
(76, 15, 34, 1.0714285714286, 4, 1),
(77, 15, 35, 3.2142857142857, 4, 1),
(78, 15, 36, 2.1428571428571, 4, 1),
(79, 15, 37, 1.1428571428571, 4, 1),
(80, 15, 38, 0.57142857142857, 4, 1),
(81, 19, 29, 1.7142857142857, 4, 1),
(82, 19, 30, 3.1428571428571, 4, 1),
(83, 19, 31, 1.4285714285714, 4, 1),
(84, 19, 32, 1.4285714285714, 4, 1),
(85, 19, 33, 4, 4, 1),
(86, 19, 34, 3.4285714285714, 4, 1),
(87, 19, 35, 4.8571428571429, 4, 1),
(88, 19, 36, 4.2857142857143, 4, 1),
(89, 19, 37, 3.1428571428571, 4, 1),
(90, 19, 38, 2.5714285714286, 4, 1),
(91, 20, 29, 2, 4, 1),
(92, 20, 30, 0.57142857142857, 4, 1),
(93, 20, 31, 1.4285714285714, 4, 1),
(94, 20, 32, 2.1428571428571, 4, 1),
(95, 20, 33, 2.5, 4, 1),
(96, 20, 34, 2.5, 4, 1),
(97, 20, 35, 0, 4, 1),
(98, 20, 36, 1.4285714285714, 4, 1),
(99, 20, 37, 2, 4, 1),
(100, 20, 38, 2.1428571428571, 4, 1),
(101, 21, 29, 1.6428571428571, 4, 1),
(102, 21, 30, 1.6428571428571, 4, 1),
(103, 21, 31, 0, 4, 1),
(104, 21, 32, 1.0714285714286, 4, 1),
(105, 21, 33, 1.0714285714286, 4, 1),
(106, 21, 34, 1.0714285714286, 4, 1),
(107, 21, 35, 3.9285714285714, 4, 1),
(108, 21, 36, 1.4285714285714, 4, 1),
(109, 21, 37, 0.57142857142857, 4, 1),
(110, 21, 38, 0, 4, 1),
(111, 29, 12, 0, 4, 1),
(112, 29, 15, 0, 4, 1),
(113, 29, 19, 0, 4, 1),
(114, 29, 20, 0, 4, 1),
(115, 29, 21, 0, 4, 1),
(116, 29, 30, 4.2857142857143, 4, 1),
(117, 29, 31, 4.2857142857143, 4, 1),
(118, 29, 32, 2.1428571428571, 4, 1),
(119, 29, 33, 2.8571428571429, 4, 1),
(120, 29, 34, 5.7142857142857, 4, 1),
(121, 29, 35, 4.2857142857143, 4, 1),
(122, 29, 36, 4.2857142857143, 4, 1),
(123, 29, 37, 4.2857142857143, 4, 1),
(124, 29, 38, 5, 4, 1),
(125, 30, 12, 0, 4, 1),
(126, 30, 15, 0, 4, 1),
(127, 30, 19, 0, 4, 1),
(128, 30, 20, 0, 4, 1),
(129, 30, 21, 0, 4, 1),
(130, 30, 29, 0, 4, 1),
(131, 30, 31, 3.5714285714286, 4, 1),
(132, 30, 32, 3.5714285714286, 4, 1),
(133, 30, 33, 1.4285714285714, 4, 1),
(134, 30, 34, 1.4285714285714, 4, 1),
(135, 30, 35, 5, 4, 1),
(136, 30, 36, 3.5714285714286, 4, 1),
(137, 30, 37, 1.4285714285714, 4, 1),
(138, 30, 38, 1.4285714285714, 4, 1),
(139, 31, 12, 0, 4, 1),
(140, 31, 15, 0, 4, 1),
(141, 31, 19, 0, 4, 1),
(142, 31, 20, 0, 4, 1),
(143, 31, 21, 0, 4, 1),
(144, 31, 29, 0, 4, 1),
(145, 31, 30, 0, 4, 1),
(146, 31, 32, 3.2142857142857, 4, 1),
(147, 31, 33, 2.2142857142857, 4, 1),
(148, 31, 34, 3.0714285714286, 4, 1),
(149, 31, 35, 5.9285714285714, 4, 1),
(150, 31, 36, 2.5, 4, 1),
(151, 31, 37, 3.1428571428571, 4, 1),
(152, 31, 38, 2.9285714285714, 4, 1),
(153, 32, 12, 0, 4, 1),
(154, 32, 15, 0, 4, 1),
(155, 32, 19, 0, 4, 1),
(156, 32, 20, 0, 4, 1),
(157, 32, 21, 0, 4, 1),
(158, 32, 29, 0, 4, 1),
(159, 32, 30, 0, 4, 1),
(160, 32, 31, 0, 4, 1),
(161, 32, 33, 4, 4, 1),
(162, 32, 34, 2, 4, 1),
(163, 32, 35, 3.4285714285714, 4, 1),
(164, 32, 36, 4.2857142857143, 4, 1),
(165, 32, 37, 1.7142857142857, 4, 1),
(166, 32, 38, 2.5714285714286, 4, 1),
(167, 33, 12, 0, 4, 1),
(168, 33, 15, 0, 4, 1),
(169, 33, 19, 0, 4, 1),
(170, 33, 20, 0, 4, 1),
(171, 33, 21, 0, 4, 1),
(172, 33, 29, 0, 4, 1),
(173, 33, 30, 0, 4, 1),
(174, 33, 31, 0, 4, 1),
(175, 33, 32, 0, 4, 1),
(176, 33, 34, 3.5714285714286, 4, 1),
(177, 33, 35, 2.1428571428571, 4, 1),
(178, 33, 36, 4.2857142857143, 4, 1),
(179, 33, 37, 3.4285714285714, 4, 1),
(180, 33, 38, 4.2857142857143, 4, 1),
(181, 34, 12, 0, 4, 1),
(182, 34, 15, 0, 4, 1),
(183, 34, 19, 0, 4, 1),
(184, 34, 20, 0, 4, 1),
(185, 34, 21, 0, 4, 1),
(186, 34, 29, 0, 4, 1),
(187, 34, 30, 0, 4, 1),
(188, 34, 31, 0, 4, 1),
(189, 34, 32, 0, 4, 1),
(190, 34, 33, 0, 4, 1),
(191, 34, 35, 5, 4, 1),
(192, 34, 36, 3.5714285714286, 4, 1),
(193, 34, 37, 1.1428571428571, 4, 1),
(194, 34, 38, 1.2857142857143, 4, 1),
(195, 35, 12, 0, 4, 1),
(196, 35, 15, 0, 4, 1),
(197, 35, 19, 0, 4, 1),
(198, 35, 20, 0, 4, 1),
(199, 35, 21, 0, 4, 1),
(200, 35, 29, 0, 4, 1),
(201, 35, 30, 0, 4, 1),
(202, 35, 31, 0, 4, 1),
(203, 35, 32, 0, 4, 1),
(204, 35, 33, 0, 4, 1),
(205, 35, 34, 0, 4, 1),
(206, 35, 36, 2.1428571428571, 4, 1),
(207, 35, 37, 3.2857142857143, 4, 1),
(208, 35, 38, 2.7142857142857, 4, 1),
(209, 36, 12, 0, 4, 1),
(210, 36, 15, 0, 4, 1),
(211, 36, 19, 0, 4, 1),
(212, 36, 20, 0, 4, 1),
(213, 36, 21, 0, 4, 1),
(214, 36, 29, 0, 4, 1),
(215, 36, 30, 0, 4, 1),
(216, 36, 31, 0, 4, 1),
(217, 36, 32, 0, 4, 1),
(218, 36, 33, 0, 4, 1),
(219, 36, 34, 0, 4, 1),
(220, 36, 35, 0, 4, 1),
(221, 36, 37, 3.7142857142857, 4, 1),
(222, 36, 38, 1.7142857142857, 4, 1),
(223, 37, 12, 0, 4, 1),
(224, 37, 15, 0, 4, 1),
(225, 37, 19, 0, 4, 1),
(226, 37, 20, 0, 4, 1),
(227, 37, 21, 0, 4, 1),
(228, 37, 29, 0, 4, 1),
(229, 37, 30, 0, 4, 1),
(230, 37, 31, 0, 4, 1),
(231, 37, 32, 0, 4, 1),
(232, 37, 33, 0, 4, 1),
(233, 37, 34, 0, 4, 1),
(234, 37, 35, 0, 4, 1),
(235, 37, 36, 0, 4, 1),
(236, 37, 38, 2.5, 4, 1),
(237, 38, 12, 0, 4, 1),
(238, 38, 15, 0, 4, 1),
(239, 38, 19, 0, 4, 1),
(240, 38, 20, 0, 4, 1),
(241, 38, 21, 0, 4, 1),
(242, 38, 29, 0, 4, 1),
(243, 38, 30, 0, 4, 1),
(244, 38, 31, 0, 4, 1),
(245, 38, 32, 0, 4, 1),
(246, 38, 33, 0, 4, 1),
(247, 38, 34, 0, 4, 1),
(248, 38, 35, 0, 4, 1),
(249, 38, 36, 0, 4, 1),
(250, 38, 37, 0, 4, 1),
(251, 39, 40, 0.25, 6, 1),
(252, 39, 41, 0, 6, 1),
(253, 40, 39, 0, 6, 1),
(254, 40, 41, 0, 6, 1),
(255, 41, 39, 0, 6, 1),
(256, 41, 40, 0, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `preferensi` char(3) NOT NULL,
  `tipe_preferensi` int(1) NOT NULL,
  `nilai_q` double NOT NULL,
  `nilai_p` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `preferensi`, `tipe_preferensi`, `nilai_q`, `nilai_p`) VALUES
(26, 'Loyalitas', 'Max', 4, 1, 5),
(25, 'Kepribadian', 'Max', 1, 1, 5),
(24, 'Kejujuran', 'Max', 3, 1, 5),
(27, 'Penampilan', 'Max', 2, 1, 5),
(28, 'Kehadiran', 'Max', 4, 1, 5),
(29, 'Tanggung Jawab', 'Max', 1, 1, 5),
(30, 'Disiplin', 'Max', 2, 1, 5),
(36, 'Tes', 'Max', 3, 0, 10),
(37, 'Perilaku', 'Max', 4, 0.5, 2),
(38, 'Pengalaman', 'Max', 4, 0.5, 2),
(39, 'Pendidikan', 'Max', 4, 0.5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai_kriteria` int(11) NOT NULL,
  `id_seleksi_alternatif` int(11) NOT NULL,
  `id_seleksi_kriteria` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai_kriteria`, `id_seleksi_alternatif`, `id_seleksi_kriteria`, `nilai`) VALUES
(1, 1, 1, 3000),
(2, 1, 2, 85),
(3, 1, 3, 2),
(4, 1, 4, 4),
(5, 1, 5, 2),
(6, 2, 1, 1000),
(7, 2, 2, 75),
(8, 2, 3, 3),
(9, 2, 4, 3),
(10, 2, 5, 4),
(11, 3, 1, 1500),
(12, 3, 2, 90),
(13, 3, 3, 2),
(14, 3, 4, 4),
(15, 3, 5, 4),
(16, 1, 6, 2),
(17, 1, 7, 2),
(18, 1, 8, 6),
(19, 1, 9, 1),
(20, 1, 10, 7),
(21, 1, 11, 5),
(22, 2, 6, 3),
(23, 2, 7, 2),
(24, 2, 8, 4),
(25, 2, 9, 2),
(26, 2, 10, 4),
(27, 2, 11, 3),
(28, 3, 6, 2),
(29, 3, 7, 4),
(30, 3, 8, 3),
(31, 3, 9, 6),
(32, 3, 10, 3),
(33, 3, 11, 4),
(34, 10, 1, 2000),
(35, 10, 3, 6),
(36, 10, 4, 4),
(37, 10, 5, 3),
(38, 10, 6, 8),
(39, 10, 7, 9),
(40, 10, 8, 5),
(41, 10, 9, 9),
(42, 10, 10, 9),
(43, 12, 24, 3),
(44, 12, 23, 4),
(45, 12, 18, 4),
(46, 12, 19, 2),
(47, 12, 20, 3),
(48, 12, 21, 2),
(49, 12, 22, 1),
(50, 15, 24, 4),
(51, 15, 23, 3),
(52, 15, 18, 2),
(53, 15, 19, 4),
(54, 15, 20, 3),
(55, 15, 21, 1),
(56, 15, 22, 2),
(57, 19, 24, 3),
(58, 19, 23, 4),
(59, 19, 18, 4),
(60, 19, 19, 2),
(61, 19, 20, 4),
(62, 19, 21, 3),
(63, 19, 22, 1),
(64, 20, 24, 3),
(65, 20, 23, 2),
(66, 20, 18, 1),
(67, 20, 19, 3),
(68, 20, 20, 2),
(69, 20, 21, 4),
(70, 20, 22, 3),
(71, 21, 24, 1),
(72, 21, 23, 2),
(73, 21, 18, 3),
(74, 21, 19, 4),
(75, 21, 20, 2),
(76, 21, 21, 2),
(77, 21, 22, 1),
(78, 23, 24, 5),
(79, 23, 23, 5),
(80, 23, 18, 5),
(81, 23, 19, 5),
(82, 23, 20, 5),
(83, 23, 21, 5),
(84, 23, 22, 5),
(85, 12, 28, 5),
(86, 15, 28, 5),
(87, 19, 28, 2),
(88, 20, 28, 3),
(89, 21, 28, 4),
(90, 24, 24, 1),
(91, 24, 23, 2),
(92, 24, 18, 3),
(93, 24, 19, 4),
(94, 24, 20, 5),
(95, 24, 21, 6),
(96, 24, 22, 7),
(97, 24, 28, 3),
(98, 26, 29, 85),
(99, 26, 30, 2),
(100, 26, 31, 4),
(101, 26, 32, 2),
(102, 27, 29, 75),
(103, 27, 30, 3),
(104, 27, 31, 3),
(105, 27, 32, 1),
(106, 28, 29, 90),
(107, 28, 30, 1),
(108, 28, 31, 4),
(109, 28, 32, 4),
(110, 29, 24, 3),
(111, 29, 23, 4),
(112, 29, 18, 5),
(113, 29, 19, 2),
(114, 29, 20, 1),
(115, 29, 21, 3),
(116, 29, 22, 3),
(117, 30, 24, 4),
(118, 30, 23, 2),
(119, 30, 18, 3),
(120, 30, 19, 2),
(121, 30, 20, 1),
(122, 30, 21, 4),
(123, 30, 22, 2),
(124, 31, 24, 3),
(125, 31, 23, 4),
(126, 31, 18, 3),
(127, 31, 19, 5),
(128, 31, 20, 4),
(129, 31, 21, 2),
(130, 31, 22, 3),
(131, 32, 24, 3),
(132, 32, 23, 2),
(133, 32, 18, 4),
(134, 32, 19, 2),
(135, 32, 20, 4),
(136, 32, 21, 3),
(137, 32, 22, 1),
(138, 33, 24, 5),
(139, 33, 23, 3),
(140, 33, 18, 2),
(141, 33, 19, 1),
(142, 33, 20, 2),
(143, 33, 21, 3),
(144, 33, 22, 4),
(145, 34, 24, 4),
(146, 34, 23, 2),
(147, 34, 18, 3),
(148, 34, 19, 1),
(149, 34, 20, 3),
(150, 34, 21, 2),
(151, 34, 22, 3),
(152, 35, 24, 3),
(153, 35, 23, 2),
(154, 35, 18, 1),
(155, 35, 19, 2),
(156, 35, 20, 3),
(157, 35, 21, 4),
(158, 35, 22, 5),
(159, 36, 24, 3),
(160, 36, 23, 4),
(161, 36, 18, 2),
(162, 36, 19, 3),
(163, 36, 20, 5),
(164, 36, 21, 1),
(165, 36, 22, 2),
(166, 37, 24, 4),
(167, 37, 23, 2),
(168, 37, 18, 3),
(169, 37, 19, 5),
(170, 37, 20, 1),
(171, 37, 21, 3),
(172, 37, 22, 2),
(173, 38, 24, 4),
(174, 38, 23, 4),
(175, 38, 18, 3),
(176, 38, 19, 3),
(177, 38, 20, 2),
(178, 38, 21, 2),
(179, 38, 22, 1),
(180, 39, 33, 3),
(181, 39, 34, 4),
(182, 40, 33, 4),
(183, 40, 34, 3),
(184, 41, 33, 4),
(185, 41, 34, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `peran` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `username`, `password`, `peran`) VALUES
(3, 'Administrator', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 1),
(7, 'Stevanus Christian', 'stevanuschristian88@gmail.com', '6ed61d4b80bb0f81937b32418e98adca', 2);

-- --------------------------------------------------------

--
-- Table structure for table `seleksi`
--

CREATE TABLE `seleksi` (
  `id_seleksi` int(11) NOT NULL,
  `seleksi` varchar(50) NOT NULL,
  `tahun` int(4) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seleksi`
--

INSERT INTO `seleksi` (`id_seleksi`, `seleksi`, `tahun`, `keterangan`) VALUES
(4, 'Karyawan Terbaik', 2023, 'Pemilihan karyawan terbaik periode tahun 2023'),
(5, 'Promosi Jabatan', 2020, 'Bag. Office'),
(6, 'Kenaikan Jabatan dan Mutasi Karyawan', 2023, 'Mutasi karyawan dan Promosi');

-- --------------------------------------------------------

--
-- Table structure for table `seleksi_alternatif`
--

CREATE TABLE `seleksi_alternatif` (
  `id_seleksi_alternatif` int(11) NOT NULL,
  `id_seleksi` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seleksi_alternatif`
--

INSERT INTO `seleksi_alternatif` (`id_seleksi_alternatif`, `id_seleksi`, `id_alternatif`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(10, 1, 5),
(12, 4, 7),
(15, 4, 8),
(19, 4, 6),
(20, 4, 9),
(21, 4, 10),
(26, 5, 17),
(27, 5, 19),
(28, 5, 18),
(29, 4, 20),
(30, 4, 17),
(31, 4, 26),
(32, 4, 21),
(33, 4, 19),
(34, 4, 18),
(35, 4, 23),
(36, 4, 22),
(37, 4, 24),
(38, 4, 25),
(39, 6, 20),
(40, 6, 17),
(41, 6, 26);

-- --------------------------------------------------------

--
-- Table structure for table `seleksi_kriteria`
--

CREATE TABLE `seleksi_kriteria` (
  `id_seleksi_kriteria` int(11) NOT NULL,
  `id_seleksi` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `bobot` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seleksi_kriteria`
--

INSERT INTO `seleksi_kriteria` (`id_seleksi_kriteria`, `id_seleksi`, `id_kriteria`, `bobot`) VALUES
(24, 4, 29, 15),
(23, 4, 27, 10),
(18, 4, 30, 20),
(19, 4, 28, 15),
(20, 4, 24, 20),
(21, 4, 25, 10),
(22, 4, 26, 10),
(29, 5, 36, 4),
(30, 5, 37, 5),
(31, 5, 38, 3),
(32, 5, 39, 2),
(33, 6, 30, 3),
(34, 6, 36, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD PRIMARY KEY (`id_hasil_akhir`);

--
-- Indexes for table `hasil_awal`
--
ALTER TABLE `hasil_awal`
  ADD PRIMARY KEY (`id_hasil_awal`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai_kriteria`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `seleksi`
--
ALTER TABLE `seleksi`
  ADD PRIMARY KEY (`id_seleksi`);

--
-- Indexes for table `seleksi_alternatif`
--
ALTER TABLE `seleksi_alternatif`
  ADD PRIMARY KEY (`id_seleksi_alternatif`);

--
-- Indexes for table `seleksi_kriteria`
--
ALTER TABLE `seleksi_kriteria`
  ADD PRIMARY KEY (`id_seleksi_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  MODIFY `id_hasil_akhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `hasil_awal`
--
ALTER TABLE `hasil_awal`
  MODIFY `id_hasil_awal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seleksi`
--
ALTER TABLE `seleksi`
  MODIFY `id_seleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seleksi_alternatif`
--
ALTER TABLE `seleksi_alternatif`
  MODIFY `id_seleksi_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `seleksi_kriteria`
--
ALTER TABLE `seleksi_kriteria`
  MODIFY `id_seleksi_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
