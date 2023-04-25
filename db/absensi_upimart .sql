-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2023 at 12:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_upimart`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
CREATE TABLE IF NOT EXISTS `absensi` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(200) NOT NULL,
  `tgl` int(200) NOT NULL,
  `absen` varchar(10) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_absen_karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `id_karyawan`, `tgl`, `absen`, `date`) VALUES
(19, 21, 1678534294, 'alpa', '2023:03:11'),
(20, 23, 1678534483, 'alpa', '2023:03:11'),
(21, 24, 1678534583, 'alpa', '2023:03:11'),
(22, 25, 1678534680, 'alpa', '2023:03:11'),
(23, 26, 1678534887, 'alpa', '2023:03:11'),
(24, 27, 1678534957, 'alpa', '2023:03:11'),
(25, 27, 1678575614, 'hadir', '2023:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` int(200) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `hp` varchar(12) NOT NULL,
  `alamat` text DEFAULT NULL,
  `shif` varchar(20) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `hp`, `alamat`, `shif`, `pic`) VALUES
(15, 'admin', '081234567890', '-', '-', 'admin.jpg'),
(21, 'firman abdulah', '08xxxxxxxxxx', 'tomalou', '14:00:00 - 17:00:00', 'firman abdulah.jpeg'),
(23, 'zulkarnain harun', '08xxxxxxxxxx', 'tambula', '08:00:00 - 12:00:00', 'zulkarnain harun.png'),
(24, 'putri jiran m.yamin', '08xxxxxxxxxx', 'indonesiana', '14:00:00 - 17:00:00', 'putri jiran m.yamin.jpeg'),
(25, 'jubaida hamjah', '08xxxxxxxxxx', 'tomagoba', '14:00:00 - 17:00:00', 'jubaida hamjah.jpeg'),
(26, 'fikri abjat', '08xxxxxxxxxx', 'akemam', '08:00:00 - 12:00:00', 'fikri abjat.jpeg'),
(27, 'arisandi kader', '08xxxxxxxxxx', 'sirongo', '08:00:00 - 12:00:00', 'arisandi kader.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL DEFAULT 'karyawan',
  `id_karyawan` int(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_karyawan` (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `type`, `id_karyawan`) VALUES
(3, 'admin', '123', 'admin', 15),
(9, 'firman abdulah', 'firman abdulah', 'karyawan', 21),
(11, 'zulkarnain harun', 'zulkarnain harun', 'karyawan', 23),
(12, 'putri jiran m.yamin', 'putri jiran m.yamin', 'karyawan', 24),
(13, 'jubaida hamjah', 'jubaida hamjah', 'karyawan', 25),
(14, 'fikri abjat', 'fikri abjat', 'karyawan', 26),
(15, 'arisandi kader', 'arisandi kader', 'karyawan', 27);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absen_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
