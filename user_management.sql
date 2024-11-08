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
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `contactno` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_suspended` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `dob`, `contactno`, `role`, `created_at`, `is_suspended`) VALUES
(1, 'Admin', 'password', 'admin@example.com', '2024-01-04', 12345671, 'Admin', '2024-10-23 00:55:41', 0),
(15, 'User002', 'password002', 'user002@example.com', '2024-01-02', 12345678, 'Buyer', '2024-10-23 00:55:41', 1),
(16, 'User003', 'password003', 'user003@example.com', '2024-01-03', 12345679, 'Seller', '2024-10-23 00:55:41', 0),
(17, 'User004', 'password004', 'user004@example.com', '2024-01-04', 12345671, 'Agent', '2024-10-23 00:55:41', 0),
(18, 'User005', 'password005', 'user005@example.com', '2024-01-05', 12345672, 'Buyer', '2024-10-23 00:55:41', 0),
(19, 'User006', 'password006', 'user006@example.com', '2024-01-06', 12345673, 'Seller', '2024-10-23 00:55:41', 0),
(20, 'User007', 'password007', 'user007@example.com', '2024-01-07', 12345674, 'Agent', '2024-10-23 00:55:41', 1),
(21, 'User008', 'password008', 'user008@example.com', '2024-01-08', 12345675, 'Buyer', '2024-10-23 00:55:41', 0),
(22, 'User009', 'password009', 'user009@example.com', '2024-01-09', 12345676, 'Seller', '2024-10-23 00:55:41', 0),
(23, 'User010', 'password010', 'user010@example.com', '2024-01-10', 12345677, 'Agent', '2024-10-23 00:55:41', 0),
(24, 'User011', 'password011', 'user011@example.com', '2024-01-11', 12345618, 'Buyer', '2024-10-23 00:55:41', 0),
(25, 'User012', 'password012', 'user012@example.com', '2024-01-12', 12345628, 'Seller', '2024-10-23 00:55:41', 0),
(26, 'User013', 'password013', 'user013@example.com', '2024-01-13', 12345638, 'Agent', '2024-10-23 00:55:41', 0),
(27, 'User014', 'password014', 'user014@example.com', '2024-01-14', 12345648, 'Buyer', '2024-10-23 00:55:41', 0),
(28, 'User015', 'password015', 'user015@example.com', '2024-01-15', 12345658, 'Seller', '2024-10-23 00:55:41', 0),
(29, 'User016', 'password016', 'user016@example.com', '2024-01-16', 12345668, 'Agent', '2024-10-23 00:55:41', 0),
(30, 'User017', 'password017', 'user017@example.com', '2024-01-17', 12345688, 'Buyer', '2024-10-23 00:55:41', 0),
(31, 'User018', 'password018', 'user018@example.com', '2024-01-18', 12345698, 'Seller', '2024-10-23 00:55:41', 0),
(32, 'User019', 'password019', 'user019@example.com', '2024-01-19', 12345178, 'Agent', '2024-10-23 00:55:41', 0),
(33, 'User020', 'password020', 'user020@example.com', '2024-01-20', 12345278, 'Buyer', '2024-10-23 00:55:41', 0),
(37, 'Shaheed677777', 'pmfg8lOlB1NXP81ZTQ==', 'syzwanozzie@gmail.com', '2024-10-02', 12345478, 'Agent', '2024-10-24 09:16:54', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
