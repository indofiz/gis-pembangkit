-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 02:11 PM
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
  `gambar` text DEFAULT NULL,
  `tipe` varchar(100) NOT NULL,
  `isolated` tinyint(1) NOT NULL,
  `bahan_bakar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi_pembangkit`
--

INSERT INTO `informasi_pembangkit` (`id_pembangkit`, `nama_pembangkit`, `longitude`, `latitude`, `perusahaan`, `kapasitas`, `arus`, `tegangan`, `gambar`, `tipe`, `isolated`, `bahan_bakar`) VALUES
(9, 'PLTS GG Banget', '106.1078453063965', '-2.098640227434214', 'Makan Jambu', '123', '1234', '1234', 'assets/img/foto/a82a1cf4b4057bfab841558baf8d140dDesert.jpg', '1', 0, 'Jambu Segar'),
(10, 'PLTD Pongok', '106.11196517944336', '-2.1442708558900843', 'Makan Nanas', '123', '1234', '1234', 'assets/img/foto/91f26dea0fb3cb266e8d3a15ad534b13Tulips.jpg', '2', 1, 'NanasSegar'),
(11, 'PLTD SW Toboali 1', '106.09342575073244', '-2.102585785911705', 'Makan Nanas Hijau', '123', '1234', '1234', 'assets/img/foto/2ee5613e9b81498fbdbe92dec2df0f47Jellyfish.jpg', '2', 1, 'Nanas Segar Mentah Pahit manis');

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
(3, 'user', 'user', 'aktif', 'user');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informasi_pembangkit`
--
ALTER TABLE `informasi_pembangkit`
  MODIFY `id_pembangkit` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
