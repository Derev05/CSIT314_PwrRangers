-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 06:56 AM
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
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contactno` varchar(8) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_suspended` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `contactno`, `email`, `dob`, `role`, `created_at`, `is_suspended`) VALUES
(22, 'User009', 'password009', NULL, 'user009@example.com', '2024-01-09', 'Seller', '2024-10-23 08:55:41', 1),
(23, 'User010', 'password010', NULL, 'user010@example.com', '2024-01-10', 'Agent', '2024-10-23 08:55:41', 0),
(24, 'User011', 'password011', NULL, 'user011@example.com', '2024-01-11', 'Buyer', '2024-10-23 08:55:41', 0),
(25, 'User012', 'password012', NULL, 'user012@example.com', '2024-01-12', 'Seller', '2024-10-23 08:55:41', 0),
(26, 'User013', 'password013', NULL, 'user013@example.com', '2024-01-13', 'Agent', '2024-10-23 08:55:41', 0),
(27, 'User014', 'password014', NULL, 'user014@example.com', '2024-01-14', 'Buyer', '2024-10-23 08:55:41', 0),
(28, 'User015', 'password015', NULL, 'user015@example.com', '2024-01-15', 'Seller', '2024-10-23 08:55:41', 0),
(29, 'User016', 'password016', NULL, 'user016@example.com', '2024-01-16', 'Agent', '2024-10-23 08:55:41', 0),
(30, 'User017', 'password017', NULL, 'user017@example.com', '2024-01-17', 'Buyer', '2024-10-23 08:55:41', 0),
(31, 'User018', 'password018', NULL, 'user018@example.com', '2024-01-18', 'Seller', '2024-10-23 08:55:41', 0),
(32, 'User019', 'password019', NULL, 'user019@example.com', '2024-01-19', 'Agent', '2024-10-23 08:55:41', 0),
(33, 'User020', 'password020', NULL, 'user020@example.com', '2024-01-20', 'Buyer', '2024-10-23 08:55:41', 0),
(48, 'User000549t6595349', 'dqwdwqdwqd', '12345678', 'user004@example.com', '2024-10-10', 'Buyer', '2024-10-31 05:56:29', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
