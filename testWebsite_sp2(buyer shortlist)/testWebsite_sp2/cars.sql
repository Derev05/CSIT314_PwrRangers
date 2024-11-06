-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 05:16 AM
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
  `imagePath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carlistings`
--

INSERT INTO `carlistings` (`id`, `seller_name`, `agent_name`, `car_name`, `plate_no`, `noOfOwners`, `regDate`, `price`, `vehType`, `noOfViews`, `noOfShortlists`, `description`, `imagePath`) VALUES
(1, 'User003', 'User004', 'Some Car 1', 'STF1225J', 2, '2018-11-01', 65000.00, 'Luxury Sedan', 0, 0, 'Some description', 'assets/images/carListingimages/car_exterior.jpg'),
(2, 'User003', 'User004', 'Some Car 2', 'ST11435K', 3, '2018-11-01', 75000.00, 'Luxury Sedan', 0, 0, 'Some description', 'assets/images/carListingimages/car_interior.png'),
(3, 'User003', 'User004', 'Some Car 3', 'SM25525J', 4, '2018-11-01', 150000.00, 'Luxury Sedan', 0, 0, 'Some description', 'assets/images/carListingimages/car_interior.png'),
(4, 'User006', 'User004', 'Some Car 4', 'SM25525J', 2, '2018-11-01', 65000.00, 'Luxury Sedan', 0, 0, 'Some description', 'assets/images/carListingimages/car_interior.png'),
(5, 'User006', 'User004', 'Some Car 5', 'SM25525J', 2, '2018-11-01', 65000.00, 'Luxury Sedan', 0, 0, 'Some description', 'assets/images/carListingimages/car_interior.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carlistings`
--
ALTER TABLE `carlistings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carlistings`
--
ALTER TABLE `carlistings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
