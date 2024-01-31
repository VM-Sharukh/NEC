-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 01:11 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `EmailID`, `Password`, `Gender`, `UserRole`, `UserStatus`, `UserProfileImage`, `CreatedAt`, `LastUpdated`, `LastLoggedIn`, `LastLoggedOut`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Sm6Fz/FR4KtObw==', 1, 1, 1, 'Admin.jpg', '2024-01-12 17:25:17', '2024-01-12 17:25:17', '2024-01-31 17:39:11', '2024-01-31 17:39:02'),
(2, 'Mohd Sharukh Varyala', 'vsharukh@gmail.com', 'QmSBzfFT5KFGbw==', 1, 2, 1, '17052058724IutKrvYgLo!eVa.png', '2024-01-12 17:25:17', '2024-01-31 17:39:49', '2024-01-14 18:43:09', '2024-01-14 18:36:25'),
(3, 'Mohammed Shaheer', 'mohammedshaheer@gmail.com', 'Sm6Fz/FR4KtObw==', 1, 2, 1, '1705237662wrileBjT!c1X-6A.jpg', '2024-01-13 13:15:45', '2024-01-14 18:47:30', NULL, NULL),
(4, 'Afreen', 'afreen.dattari@gmail.com', 'Sm6Fz/FR4KtObw==', 2, 2, 1, '1705237691wbomygiN3jSkI51.jpg', '2024-01-13 14:49:41', '2024-01-14 18:47:32', NULL, NULL),
(5, 'Ameerah', 'ameerah@gmail.com', 'Sm6Fz/FR4KtObw==', 2, 2, 1, '1705229992F80Ie!zYUsgVlbG.png', '2024-01-14 16:29:52', '2024-01-14 18:47:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logged_in_details`
--

DROP TABLE IF EXISTS `user_logged_in_details`;
CREATE TABLE `user_logged_in_details` (
  `ULIDID` bigint(11) NOT NULL,
  `UserID` bigint(11) NOT NULL,
  `LogginDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_logged_in_details`
--

INSERT INTO `user_logged_in_details` (`ULIDID`, `UserID`, `LogginDateTime`) VALUES
(1, 1, '2024-01-31 17:28:47'),
(2, 1, '2024-01-31 17:39:11');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_page_visited_logs`
--

INSERT INTO `user_page_visited_logs` (`UPVLID`, `PageURL`, `ReferrerURL`, `UserIPAddress`, `UserAgent`, `UserID`, `AddedDateTime`) VALUES
(1, 'http://10.10.1.145:8082/NEC/Login.php', 'http://10.10.1.145:8082/NEC/', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:28:47'),
(2, 'http://10.10.1.145:8082/NEC/Dashboard.php', 'http://10.10.1.145:8082/NEC/', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:28:47'),
(3, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/Dashboard.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:28:49'),
(4, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:28:50'),
(5, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:29:02'),
(6, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:29:02'),
(7, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:29:13'),
(8, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:29:32'),
(9, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:29:36'),
(10, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:29:57'),
(11, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:29:57'),
(12, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:30:05'),
(13, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:31:10'),
(14, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:31:10'),
(15, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:31:16'),
(16, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:31:34'),
(17, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:31:34'),
(18, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:31:37'),
(19, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:35:09'),
(20, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:35:39'),
(21, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:35:51'),
(22, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:35:52'),
(23, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:36:20'),
(24, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:36:35'),
(25, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:36:35'),
(26, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:36:38'),
(27, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:37:06'),
(28, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:37:45'),
(29, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:37:48'),
(30, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:37:58'),
(31, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:37:58'),
(32, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:38:00'),
(33, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:38:13'),
(34, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:38:13'),
(35, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:38:16'),
(36, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:38:23'),
(37, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:38:23'),
(38, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:38:26'),
(39, 'http://10.10.1.145:8082/NEC/Login.php', 'http://10.10.1.145:8082/NEC/index.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:11'),
(40, 'http://10.10.1.145:8082/NEC/Dashboard.php', 'http://10.10.1.145:8082/NEC/index.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:11'),
(41, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/Dashboard.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:13'),
(42, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:14'),
(43, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:17'),
(44, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:19'),
(45, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:25'),
(46, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:27'),
(47, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:31'),
(48, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:31'),
(49, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:33'),
(50, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:37'),
(51, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:37'),
(52, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:41'),
(53, 'http://10.10.1.145:8082/NEC/ManageUserData.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:49'),
(54, 'http://10.10.1.145:8082/NEC/UsersList.php', 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:49'),
(55, 'http://10.10.1.145:8082/NEC/ManageUser.php?mode=edit&id', 'http://10.10.1.145:8082/NEC/UsersList.php', '10.10.1.186', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/5', 1, '2024-01-31 17:39:55');

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
  MODIFY `ULIDID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_page_visited_logs`
--
ALTER TABLE `user_page_visited_logs`
  MODIFY `UPVLID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
