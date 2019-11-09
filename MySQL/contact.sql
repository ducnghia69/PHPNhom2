-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2019 at 03:11 PM
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
  UNIQUE KEY `Phone` (`Phone`),
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

-- --------------------------------------------------------

--
-- Table structure for table `contact_label`
--

DROP TABLE IF EXISTS `contact_label`;
CREATE TABLE IF NOT EXISTS `contact_label` (
  `IDContact` int(11) NOT NULL,
  `IDLabel` int(11) NOT NULL,
  PRIMARY KEY (`IDContact`,`IDLabel`),
  KEY `IDLabel` (`IDLabel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_label`
--

INSERT INTO `contact_label` (`IDContact`, `IDLabel`) VALUES
(1, 1),
(5, 1),
(1, 2),
(6, 2),
(7, 2),
(2, 3),
(3, 3),
(4, 3),
(6, 3),
(2, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

DROP TABLE IF EXISTS `label`;
CREATE TABLE IF NOT EXISTS `label` (
  `IDLabel` int(11) NOT NULL AUTO_INCREMENT,
  `LabelName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IDUser` int(11) NOT NULL,
  PRIMARY KEY (`IDLabel`),
  KEY `IDUser` (`IDUser`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`IDLabel`, `LabelName`, `IDUser`) VALUES
(1, 'Gia Đình', 1),
(2, 'Người yêu', 1),
(3, 'Chó', 2),
(4, 'Mèo', 2),
(5, 'Người trong mộng', 1),
(6, 'Người trong mộng 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `IDUser` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PassWord` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FullName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDUser`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`IDUser`, `UserName`, `PassWord`, `FullName`) VALUES
(1, 'ducnghia', '123', 'Nguyễn Đức Nghĩa'),
(2, 'lenhhoxung', '123', 'Lệnh Hồ Xung');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `user` (`IDUser`);

--
-- Constraints for table `contact_label`
--
ALTER TABLE `contact_label`
  ADD CONSTRAINT `contact_label_ibfk_1` FOREIGN KEY (`IDContact`) REFERENCES `contact` (`IDContact`),
  ADD CONSTRAINT `contact_label_ibfk_2` FOREIGN KEY (`IDLabel`) REFERENCES `label` (`IDLabel`);

--
-- Constraints for table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `label_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `user` (`IDUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
