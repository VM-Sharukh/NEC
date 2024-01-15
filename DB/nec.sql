-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 02:32 PM
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
-- Database: `nec`
--
CREATE DATABASE IF NOT EXISTS `nec` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nec`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UserID` bigint(11) NOT NULL,
  `FullName` varchar(55) NOT NULL,
  `EmailID` varchar(55) NOT NULL,
  `Password` varchar(55) NOT NULL,
  `Gender` int(1) NOT NULL COMMENT '1 For Male, 2 For Female',
  `UserRole` int(1) NOT NULL DEFAULT 2 COMMENT '1 For Admin Users, 2 For Normal Users',
  `UserStatus` int(1) NOT NULL DEFAULT 1 COMMENT '1 For Active, 0 For Inactive',
  `UserProfileImage` varchar(55) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `LastUpdated` datetime NOT NULL,
  `LastLoggedIn` datetime DEFAULT NULL,
  `LastLoggedOut` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `EmailID`, `Password`, `Gender`, `UserRole`, `UserStatus`, `UserProfileImage`, `CreatedAt`, `LastUpdated`, `LastLoggedIn`, `LastLoggedOut`) VALUES
(1, 'Admin', 'admin@gmail.com', '9870987666', 1, 1, 1, 'Admin.jpg', '2024-01-12 17:25:17', '2024-01-12 17:25:17', '2024-01-14 18:37:27', '2024-01-14 18:37:16'),
(2, 'Mohd Sharukh Varyala', 'vsharukh@gmail.com', '7208136767', 1, 2, 1, '17052058724IutKrvYgLo!eVa.png', '2024-01-12 17:25:17', '2024-01-14 18:47:46', '2024-01-14 18:43:09', '2024-01-14 18:36:25'),
(3, 'Mohammed Shaheer', 'mohammedshaheer@gmail.com', '7234572822', 1, 2, 1, '1705237662wrileBjT!c1X-6A.jpg', '2024-01-13 13:15:45', '2024-01-14 18:47:30', NULL, NULL),
(4, 'Afreen', 'afreen.dattari@gmail.com', '7977654876', 2, 2, 1, '1705237691wbomygiN3jSkI51.jpg', '2024-01-13 14:49:41', '2024-01-14 18:47:32', NULL, NULL),
(5, 'Ameerah', 'ameerah@gmail.com', '9876543210', 2, 2, 1, '1705229992F80Ie!zYUsgVlbG.png', '2024-01-14 16:29:52', '2024-01-14 18:47:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logged_in_details`
--

DROP TABLE IF EXISTS `user_logged_in_details`;
CREATE TABLE `user_logged_in_details` (
  `ULIDID` bigint(11) NOT NULL,
  `UserID` bigint(11) NOT NULL,
  `LogginDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_page_visited_logs`
--

DROP TABLE IF EXISTS `user_page_visited_logs`;
CREATE TABLE `user_page_visited_logs` (
  `UPVLID` bigint(11) NOT NULL,
  `PageURL` varchar(55) NOT NULL,
  `ReferrerURL` varchar(55) NOT NULL,
  `UserIPAddress` varchar(55) NOT NULL,
  `UserAgent` varchar(55) NOT NULL,
  `UserID` bigint(11) NOT NULL,
  `AddedDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_logged_in_details`
--
ALTER TABLE `user_logged_in_details`
  ADD PRIMARY KEY (`ULIDID`);

--
-- Indexes for table `user_page_visited_logs`
--
ALTER TABLE `user_page_visited_logs`
  ADD PRIMARY KEY (`UPVLID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_logged_in_details`
--
ALTER TABLE `user_logged_in_details`
  MODIFY `ULIDID` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_page_visited_logs`
--
ALTER TABLE `user_page_visited_logs`
  MODIFY `UPVLID` bigint(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
