-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 05, 2025 at 11:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab4`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `id` int NOT NULL,
  `components` varchar(200) NOT NULL,
  `expenditure2010` int NOT NULL,
  `expenditure2011` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`id`, `components`, `expenditure2010`, `expenditure2011`) VALUES
(1, 'shopping', 8914, 13149),
(2, 'transport', 8098, 10019),
(3, 'fnb', 7975, 9691),
(4, 'accomodation', 6130, 5028),
(5, 'tickets', 894, 1097),
(6, 'other ', 2667, 3362),
(7, 'total', 34679, 42346);

-- --------------------------------------------------------

--
-- Table structure for table `expenditure2`
--

CREATE TABLE `expenditure2` (
  `id` int NOT NULL,
  `components` varchar(200) NOT NULL,
  `expenditure2010` int NOT NULL,
  `expenditure2011` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `expenditure2`
--

INSERT INTO `expenditure2` (`id`, `components`, `expenditure2010`, `expenditure2011`) VALUES
(1, 'food & beverages', 6448, 7756),
(2, 'transport', 6220, 7417),
(3, 'accomodation', 6096, 4985),
(4, 'shopping', 2603, 3801),
(5, 'before trip', 595, 801),
(6, 'other', 1722, 2249),
(7, 'total', 23684, 27009);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure2`
--
ALTER TABLE `expenditure2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=668;

--
-- AUTO_INCREMENT for table `expenditure2`
--
ALTER TABLE `expenditure2`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
