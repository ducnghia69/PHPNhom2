-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2019 at 03:14 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `IDContact` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isMajor` tinyint(1) NOT NULL,
  `IDUser` int(11) NOT NULL,
  PRIMARY KEY (`IDContact`),
  KEY `IDUser` (`IDUser`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`IDContact`, `Name`, `Email`, `Phone`, `isMajor`, `IDUser`) VALUES
(1, 'Người yêu 1', 'nguoiyeu1@gmail.com', '01234567981', 0, 1),
(2, 'Người yêu 2', 'nguoiyeu2@gmail.com', '01234567982', 0, 1),
(3, 'Người yêu Hồ Xung 1', 'nguoiyeuhoxung1@gmail.com', '012345465113', 0, 2),
(4, 'Người yêu Hồ Xung 2', 'nguoiyeuhoxung2@gmail.com', '012345465114', 0, 2),
(5, 'Người yêu 3', 'nguoiyeu3@gmail.com', '01231210', 1, 1),
(6, 'Người yêu 4', 'nguoiyeu4@gmail.com', '01231211', 0, 1),
(7, 'Người yêu 5', 'nguoiyeu5@gmail.com', '01231212', 1, 1),
(8, 'Người yêu 6', 'nguoiyeu6@gmail.com', '01231213', 0, 1),
(9, '123123', '1231231@gmail.com', '123213', 1, 1),
(10, '123123', 'ndnghia69@gmail.com', '123123', 1, 1),
(11, 'nghia', 'ndnghia69@gmail.com', '12312321321321312x3123123', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `user` (`IDUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
