-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 07:53 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taruna`
--

-- --------------------------------------------------------

--
-- Table structure for table `informasi_pembangkit`
--

CREATE TABLE `informasi_pembangkit` (
  `id_pembangkit` int(10) NOT NULL,
  `nama_pembangkit` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `kapasitas` varchar(100) NOT NULL,
  `arus` varchar(10) NOT NULL,
  `tegangan` varchar(10) NOT NULL,
  `daya_aktif_reaktif` varchar(100) NOT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi_pembangkit`
--

INSERT INTO `informasi_pembangkit` (`id_pembangkit`, `nama_pembangkit`, `longitude`, `latitude`, `perusahaan`, `kapasitas`, `arus`, `tegangan`, `daya_aktif_reaktif`, `gambar`) VALUES
(4, 'PLTU AIR ANYIR', '106.104154586792', '-2.1392961536902892', 'PLN', '1200', '1344', '220', '344', NULL),
(5, 'PLTU AIR ANYIR', '106.104154586792', '-2.1392961536902892', 'PLN', '1200', '1344', '220', '344', NULL),
(7, 'Pltn balunijuk', '106.07977867126466', '-2.062786655100321', 'Julian Corp', '12000000', '30023', '300', '340', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status`, `level`) VALUES
(1, 'admin', 'admin', 'aktif', 'admin'),
(2, 'julian', 'julian', 'aktif', 'user'),
(3, 'user', 'user', 'aktif', 'user'),
(7, 'root', '', 'nonaktif', 'user'),
(8, 'root', '', 'nonaktif', 'user'),
(9, 'root', '', 'nonaktif', 'user'),
(10, 'root', '', 'nonaktif', 'user'),
(11, 'root', '', 'nonaktif', 'user'),
(12, 'root', '', 'nonaktif', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `data_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `nim` int(10) NOT NULL,
  `foto` text NOT NULL,
  `ijazah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informasi_pembangkit`
--
ALTER TABLE `informasi_pembangkit`
  ADD PRIMARY KEY (`id_pembangkit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `username_2` (`username`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informasi_pembangkit`
--
ALTER TABLE `informasi_pembangkit`
  MODIFY `id_pembangkit` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `data_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
