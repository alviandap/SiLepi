-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 01, 2015 at 04:24 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crs`
--

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `sess_id` int(11) NOT NULL AUTO_INCREMENT,
  `sess_date` datetime NOT NULL,
  `sess_user` int(11) NOT NULL,
  `sess_fr` varchar(100) NOT NULL,
  `sess_status` varchar(5) NOT NULL,
  `sess_u` varchar(10) NOT NULL,
  PRIMARY KEY (`sess_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sess_id`, `sess_date`, `sess_user`, `sess_fr`, `sess_status`, `sess_u`) VALUES
(1, '2015-06-01 16:14:33', 4, 'Koleksi_Foto_dan_Video', 'fh', 'u1'),
(2, '2015-06-01 16:14:33', 4, 'Aktifitas_Di_Lapangan', 'fh', 'u1'),
(3, '2015-06-01 16:14:33', 4, 'Bekerja_Dengan_Dokumen', 'fh', 'u1'),
(4, '2015-06-01 16:14:33', 4, 'Bermain_Game', 'fh', 'u1'),
(5, '2015-06-01 16:14:37', 4, 'Bermain_Game_nonHD', 'fh', 'u4'),
(6, '2015-06-01 16:14:37', 4, 'Edit_Document', 'fh', 'u4'),
(7, '2015-06-01 16:14:37', 4, 'Bermain_Game_HD', 'fh', 'u4'),
(8, '2015-06-01 16:14:37', 4, 'Membaca_Dokumen', 'fh', 'u4'),
(9, '2015-06-01 16:15:07', 4, 'Advan_Vandroid_T3C', '', 'u2'),
(10, '2015-06-01 16:15:07', 4, 'Apple_iPad_2_3G_-_32_GB', '', 'u2'),
(11, '2015-06-01 16:15:31', 4, 'Apple_iPad_2_3G_-_32_GB', '', 'choose'),
(12, '2015-06-01 16:16:21', 5, 'Bekerja_Dengan_Dokumen', 'fh', 'u1'),
(13, '2015-06-01 16:16:21', 5, 'Fasilitas_Hiburan', 'fh', 'u1'),
(14, '2015-06-01 16:16:21', 5, 'Bermain_Game', 'fh', 'u1'),
(15, '2015-06-01 16:16:21', 5, 'Koleksi_Foto_dan_Video', 'fh', 'u1'),
(16, '2015-06-01 16:16:24', 5, 'Fotografi', 'fh', 'u4'),
(17, '2015-06-01 16:16:24', 5, 'Bermain_Game_HD', 'fh', 'u4'),
(18, '2015-06-01 16:16:24', 5, 'Menonton_Video', 'fh', 'u4'),
(19, '2015-06-01 16:16:24', 5, 'Edit_Document', 'fh', 'u4'),
(20, '2015-06-01 16:16:41', 5, 'Bermain_Game_nonHD', 'fh', 'u3'),
(21, '2015-06-01 16:16:41', 5, 'Merekam_Video', 'fh', 'u3'),
(22, '2015-06-01 16:16:41', 5, 'Presentasi', 'fh', 'u3'),
(23, '2015-06-01 16:16:41', 5, 'Membaca_Dokumen', 'fh', 'u3'),
(24, '2015-06-01 16:19:07', 6, 'Koleksi_Foto_dan_Video', 'fh', 'u1'),
(25, '2015-06-01 16:19:07', 6, 'Bermain_Game', 'fh', 'u1'),
(26, '2015-06-01 16:19:07', 6, 'Aktifitas_Di_Lapangan', 'fh', 'u1'),
(27, '2015-06-01 16:19:07', 6, 'Aktifitas_Online', 'fh', 'u1'),
(28, '2015-06-01 16:19:10', 6, 'Surfing_Internet', 'fh', 'u4'),
(29, '2015-06-01 16:19:10', 6, 'Bermain_Game_nonHD', 'fh', 'u4'),
(30, '2015-06-01 16:19:10', 6, 'Media_Sosial', 'fh', 'u4'),
(31, '2015-06-01 16:19:10', 6, 'Fotografi', 'fh', 'u4'),
(32, '2015-06-01 16:19:13', 6, 'Menonton_TV_Secara_Online', 'fh', 'u4'),
(33, '2015-06-01 16:19:13', 6, 'Download', 'fh', 'u4'),
(34, '2015-06-01 16:19:13', 6, 'Facebook_Path_dan_Twitter', 'fh', 'u4'),
(35, '2015-06-01 16:19:13', 6, 'Memotret_Kejadian_Sehari-hari', 'fh', 'u4'),
(36, '2015-06-01 16:19:16', 6, 'Bermain_Game_Non_HD_Secara_Offline', 'fh', 'u4'),
(37, '2015-06-01 16:19:16', 6, 'Bermain_Game_Non_HD_Secara_Online', 'fh', 'u4'),
(38, '2015-06-01 16:19:16', 6, 'Instagram', 'fh', 'u4'),
(39, '2015-06-01 16:19:16', 6, 'Membuka_Situs-situs_di_Internet', 'fh', 'u4'),
(40, '2015-06-01 16:19:19', 6, 'Mobile_Banking', 'fh', 'u4'),
(41, '2015-06-01 16:19:19', 6, 'Social_Network_yang_Lain', 'fh', 'u4'),
(42, '2015-06-01 16:19:19', 6, 'Memotret_untuk_upload_di_Media_Sosial', 'fh', 'u4'),
(43, '2015-06-01 16:19:19', 6, 'Fotografi_Kualitas_Mendekati_Profesional', 'fh', 'u4'),
(44, '2015-06-01 16:20:11', 6, 'Advan_Vandroid_S5K', '', 'choose'),
(45, '2015-06-01 16:23:07', 7, 'Fasilitas_Hiburan', 'fh', 'u1'),
(46, '2015-06-01 16:23:07', 7, 'Aktifitas_Di_Lapangan', 'fh', 'u1'),
(47, '2015-06-01 16:23:07', 7, 'Aktifitas_Online', 'fh', 'u1'),
(48, '2015-06-01 16:23:07', 7, 'Koleksi_Foto_dan_Video', 'fh', 'u1'),
(49, '2015-06-01 16:23:16', 7, 'Advan_S5', '', 'u2'),
(50, '2015-06-01 16:23:16', 7, 'Advan_Vandroid_S5F', '', 'u2'),
(51, '2015-06-01 16:23:56', 8, 'Aktifitas_Di_Lapangan', 'fh', 'u1'),
(52, '2015-06-01 16:23:56', 8, 'Koleksi_Foto_dan_Video', 'fh', 'u1'),
(53, '2015-06-01 16:23:56', 8, 'Aktifitas_Online', 'fh', 'u1'),
(54, '2015-06-01 16:23:56', 8, 'Bermain_Game', 'fh', 'u1'),
(55, '2015-06-01 16:24:04', 8, 'Advan_S5', '', 'u2'),
(56, '2015-06-01 16:24:04', 8, 'Advan_Vandroid_S5F', '', 'u2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(50) NOT NULL,
  `u_old` int(11) NOT NULL,
  `u_kategori` varchar(1) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_old`, `u_kategori`) VALUES
(1, 'Paijo', 18, 'L'),
(2, 'paijo', 19, 'L'),
(3, 'foku', 19, 'L'),
(4, 'aku', 18, 'L'),
(5, 'aku', 19, 'L'),
(6, 'yuza', 18, 'L'),
(7, 'yusza', 18, 'Y'),
(8, 'adasa', 14, 'Y');
