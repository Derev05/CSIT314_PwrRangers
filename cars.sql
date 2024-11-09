-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 11:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--

-- --------------------------------------------------------

--
-- Table structure for table `carlistings`
--

CREATE TABLE `carlistings` (
  `id` int(11) NOT NULL,
  `seller_name` varchar(20) NOT NULL,
  `agent_name` varchar(20) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `plate_no` varchar(20) NOT NULL,
  `noOfOwners` int(11) NOT NULL,
  `regDate` date NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `vehType` varchar(20) NOT NULL,
  `noOfViews` int(11) NOT NULL,
  `noOfShortlists` int(11) NOT NULL,
  `description` text NOT NULL,
  `imagePath` text NOT NULL,
  `viewsTracked` tinyint(1) NOT NULL,
  `shortlistsTracked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carlistings`
--

INSERT INTO `carlistings` (`id`, `seller_name`, `agent_name`, `car_name`, `plate_no`, `noOfOwners`, `regDate`, `price`, `vehType`, `noOfViews`, `noOfShortlists`, `description`, `imagePath`, `viewsTracked`, `shortlistsTracked`) VALUES
(2, 'User003', 'User004', 'Some Car 2', 'ST11435K', 3, '2018-11-01', 75000.00, 'Luxury Sedan', 0, 1, 'Some description', '../assets/images/carListingimages/car_interior.png', 0, 1),
(3, 'User003', 'User004', 'Some Car 3', 'SM25525J', 4, '2018-11-01', 150000.00, 'Luxury Sedan', 0, 0, 'Some description', '../assets/images/carListingimages/car_interior.png', 1, 1),
(4, 'User006', 'User004', 'Some Car 4', 'SM25525J', 2, '2018-11-01', 65000.00, 'Luxury Sedan', 0, 0, 'Some description', '../assets/images/carListingimages/car_interior.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_bookmarks`
--

CREATE TABLE `user_bookmarks` (
  `username` varchar(20) NOT NULL,
  `carListingId` int(11) NOT NULL,
  `bookmarkedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_bookmarks`
--

INSERT INTO `user_bookmarks` (`username`, `carListingId`, `bookmarkedAt`) VALUES
('User005', 2, '2024-11-04 16:14:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carlistings`
--
ALTER TABLE `carlistings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  ADD PRIMARY KEY (`username`,`carListingId`),
  ADD KEY `carListingId` (`carListingId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carlistings`
--
ALTER TABLE `carlistings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  ADD CONSTRAINT `user_bookmarks_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_management`.`users` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_bookmarks_ibfk_2` FOREIGN KEY (`carListingId`) REFERENCES `carlistings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
