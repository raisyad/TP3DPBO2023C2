-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 03:51 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dpbo_tp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `keyboard`
--

CREATE TABLE `keyboard` (
  `keyboard_id` int(11) NOT NULL,
  `keyboard_spesification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keyboard`
--

INSERT INTO `keyboard` (`keyboard_id`, `keyboard_spesification`) VALUES
(1, 'Backlight - Mechanical'),
(3, 'NonBacklight - Membran'),
(4, 'NonBacklight - Semi Mechanical'),
(5, 'Backlight - Semi Mechanical');

-- --------------------------------------------------------

--
-- Table structure for table `monitor`
--

CREATE TABLE `monitor` (
  `monitor_id` int(11) NOT NULL,
  `monitor_spesification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitor`
--

INSERT INTO `monitor` (`monitor_id`, `monitor_spesification`) VALUES
(1, '280Hz - IPS'),
(2, '240Hz - VA'),
(4, '144Hz - OLED'),
(6, '75Hz - VA'),
(7, '120Hz - IPS');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username_pc` varchar(255) NOT NULL,
  `password_pc` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pict` varchar(255) NOT NULL,
  `billing` varchar(255) NOT NULL,
  `no_pc` varchar(255) NOT NULL,
  `monitor_id` int(11) NOT NULL,
  `keyboard_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username_pc`, `password_pc`, `user_name`, `user_pict`, `billing`, `no_pc`, `monitor_id`, `keyboard_id`) VALUES
(8, 'pc02x1-x1', 'pc02x1-x1', 'Raisyad', 'header-logo.png', '24 Jam', '29', 1, 1),
(9, 'pc03x1x-x1x', 'pc03x1x-x1x', 'Leisya', 'before_pict.png', '5 Jam', '25', 4, 3),
(10, 'pc04xx1x-xx1x', 'pc04xx1x-xx1x', 'Annara', 'hogwards-logo.png', '7 Jam', '25', 4, 3),
(11, 'pc05x11x-x11x', 'pc05x11x-x11x', 'Sananta', 'receive_logo.png', '13 Jam', '30', 4, 5),
(12, 'pc06x6xx-x6xx', 'pc06x6xx-x6xx', 'Dewangga', 'send_logo.png', '19 Jam', '35', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keyboard`
--
ALTER TABLE `keyboard`
  ADD PRIMARY KEY (`keyboard_id`);

--
-- Indexes for table `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`monitor_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_to_monitor` (`monitor_id`),
  ADD KEY `fk_to_keyboard` (`keyboard_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keyboard`
--
ALTER TABLE `keyboard`
  MODIFY `keyboard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `monitor`
--
ALTER TABLE `monitor`
  MODIFY `monitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_to_keyboard` FOREIGN KEY (`keyboard_id`) REFERENCES `keyboard` (`keyboard_id`),
  ADD CONSTRAINT `fk_to_monitor` FOREIGN KEY (`monitor_id`) REFERENCES `monitor` (`monitor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
