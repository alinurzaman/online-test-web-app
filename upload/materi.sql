-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2019 at 02:27 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbujicoba`
--

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE IF NOT EXISTS `materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_materi` varchar(10) NOT NULL,
  `ujian_materi` varchar(10) NOT NULL,
  `jawaban_materi` int(11) NOT NULL,
  `jmlsoal_materi` int(11) NOT NULL,
  `nilaimati_materi` int(11) NOT NULL,
  `batasnilai_materi` int(11) NOT NULL,
  `waktu_materi` int(11) NOT NULL,
  `status_materi` varchar(15) NOT NULL,
  `kunci_materi` varchar(15) NOT NULL,
  `id_uc` int(11) NOT NULL,
  PRIMARY KEY (`id_materi`),
  KEY `id_uc` (`id_uc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `tipe_materi`, `ujian_materi`, `jawaban_materi`, `jmlsoal_materi`, `nilaimati_materi`, `batasnilai_materi`, `waktu_materi`, `status_materi`, `kunci_materi`, `id_uc`) VALUES
(21, 'SKD', 'TWK', 1, 35, 0, 75, 30, 'SUDAH DIUPLOAD', 'SUDAH DIUPLOAD', 5),
(22, 'SKD', 'TIU', 1, 30, 0, 80, 30, 'SUDAH DIUPLOAD', 'SUDAH DIUPLOAD', 5),
(23, 'SKD', 'TKP', 5, 35, 0, 143, 30, 'SUDAH DIUPLOAD', 'SUDAH DIUPLOAD', 5),
(24, 'TPA', 'TPA', 1, 45, 0, 67, 40, 'SUDAH DIUPLOAD', 'SUDAH DIUPLOAD', 5),
(25, 'TBI', 'TBI', 1, 30, 0, 30, 20, 'SUDAH DIUPLOAD', 'SUDAH DIUPLOAD', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_uc`) REFERENCES `uc` (`id_uc`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
