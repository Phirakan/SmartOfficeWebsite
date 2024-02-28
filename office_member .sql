-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 05:28 PM
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
-- Database: `office_member`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `device_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `device_name` varchar(225) NOT NULL,
  `watt` int(11) NOT NULL,
  `ip_sensor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `room_id`, `device_name`, `watt`, `ip_sensor`) VALUES
(1, 1, 'คอมพิวเตอร์ ', 750, 198);

-- --------------------------------------------------------

--
-- Table structure for table `power_usage`
--

CREATE TABLE `power_usage` (
  `power_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `datetime_start` datetime NOT NULL,
  `datetime_stop` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `power_usage`
--

INSERT INTO `power_usage` (`power_id`, `device_id`, `datetime_start`, `datetime_stop`) VALUES
(1, 1, '2024-02-27 22:41:16', '2024-02-29 04:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `user_id`, `room_name`) VALUES
(1, 1, 'UD245'),
(2, 3, 'LC214'),
(5, 2, 'LC212');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `tel` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `tel`, `img`, `f_name`, `l_name`, `role`) VALUES
(1, 'mosu', '25d55ad283aa400af464c76d713c07ad', 'mosu@gmail.com', 952616334, '', 'พีระกานต์', 'คงแพทย์', 0),
(2, 'tlez', '594cc14ca4a2deb26c1bf797872fb494', 'kwaitlez@gmail.com', 952616334, '', 'sunhanut', 'sarakitpan', 0),
(3, 'sudarat', '3eb35639397fbead9f6d5d9280af778d', 'sudarat@gmail.com', 886645535, '', 'สุดารัตน์', '', 0),
(4, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', 952616334, '', 'admin1', 'admin', 1),
(5, 'admin2', '81dc9bdb52d04dc20036dbd8313ed055', 'admin2@gmail.com', 888888888, '', '', '', 1),
(6, 'admin3', '81dc9bdb52d04dc20036dbd8313ed055', 'admin3@gmail.com', 888888888, '', 'admin3', 'admin3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `power_usage`
--
ALTER TABLE `power_usage`
  ADD PRIMARY KEY (`power_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_name` (`room_name`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `power_usage`
--
ALTER TABLE `power_usage`
  MODIFY `power_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Constraints for table `power_usage`
--
ALTER TABLE `power_usage`
  ADD CONSTRAINT `power_usage_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
