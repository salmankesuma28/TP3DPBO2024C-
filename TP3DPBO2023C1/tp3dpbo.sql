-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 08:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp3dpbo`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `divisi_id` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`divisi_id`, `nama_divisi`) VALUES
(1, 'MotoGP'),
(2, 'Formula One'),
(8, 'World SuperBike');

-- --------------------------------------------------------

--
-- Table structure for table `pembalap`
--

CREATE TABLE `pembalap` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `asal_negara` varchar(50) NOT NULL,
  `team_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembalap`
--

INSERT INTO `pembalap` (`id`, `foto`, `nama`, `asal_negara`, `team_id`, `divisi_id`) VALUES
(1, 'max.jpg', 'Max Verstappen', 'Belanda', 1, 2),
(2, 'marc1.jpg', 'Marc Marquez', 'Spanyol', 6, 1),
(3, 'lewis.jpg', 'Lewis Hamilton', 'Inggris', 1, 2),
(4, 'Alvaro_Bautista,_2022.jpg', 'Alvaro Bautista', 'Spanyol', 8, 8),
(5, 'pecco.jpg', 'Francesco Bagnaia', 'Italy', 9, 1),
(8, 'leclerc.jpg', 'Charles Leclerc', 'Monaco', 11, 2),
(9, 'sergio.JPG', 'Sergio Perez', 'Meksiko', 1, 2),
(14, 'alonso.jpg', 'Fernando Alonso', 'Spanyol', 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `nama_team` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `nama_team`) VALUES
(1, 'Redbull Racing F1 Team'),
(6, 'Repsol Honda Team'),
(7, 'Monster Yamaha Team'),
(8, 'Ducati Aruba It'),
(9, 'Ducati Lenovo Team'),
(10, 'Mercedes F1 Team'),
(11, 'Ferrari F1 Team'),
(13, 'Aston Martin f1 team');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`divisi_id`);

--
-- Indexes for table `pembalap`
--
ALTER TABLE `pembalap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `divisi_id` (`divisi_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `divisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembalap`
--
ALTER TABLE `pembalap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembalap`
--
ALTER TABLE `pembalap`
  ADD CONSTRAINT `pembalap_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`),
  ADD CONSTRAINT `pembalap_ibfk_2` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`divisi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
