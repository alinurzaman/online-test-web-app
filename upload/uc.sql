-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2019 at 02:28 AM
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
-- Table structure for table `uc`
--

CREATE TABLE IF NOT EXISTS `uc` (
  `id_uc` int(11) NOT NULL AUTO_INCREMENT,
  `nama_uc` varchar(35) NOT NULL,
  `pin_uc` varchar(6) NOT NULL,
  PRIMARY KEY (`id_uc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `uc`
--

INSERT INTO `uc` (`id_uc`, `nama_uc`, `pin_uc`) VALUES
(5, 'UC-1 INTENSIF PKN STAN 2019', '030519');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
