-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 11:30 AM
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
(1, 'Admin', 'admin@gmail.com', 'Sm6Fz/FR4KtObw==', 1, 1, 1, 'Admin.jpg', '2024-01-12 17:25:17', '2024-01-12 17:25:17', '2024-01-31 15:48:14', '2024-01-31 15:58:17'),
(2, 'Mohd Sharukh Varyala', 'vsharukh@gmail.com', 'Sm6Fz/FR4KtObw==', 1, 2, 1, '17052058724IutKrvYgLo!eVa.png', '2024-01-12 17:25:17', '2024-01-31 15:57:02', '2024-01-14 18:43:09', '2024-01-14 18:36:25'),
(3, 'Mohammed Shaheer', 'mohammedshaheer@gmail.com', 'Sm6Fz/FR4KtObw==', 1, 2, 1, '1705237662wrileBjT!c1X-6A.jpg', '2024-01-13 13:15:45', '2024-01-31 15:57:21', NULL, NULL),
(4, 'Afreen', 'afreen.dattari@gmail.com', 'QmSBzfFT5KFGbw==', 2, 2, 1, '1705237691wbomygiN3jSkI51.jpg', '2024-01-13 14:49:41', '2024-01-31 15:57:37', '2024-01-31 15:58:23', '2024-01-31 15:58:24'),
(5, 'Ameerah', 'ameerah@gmail.com', 'Sm6Fz/FR4KtObw==', 2, 2, 1, '1705229992F80Ie!zYUsgVlbG.png', '2024-01-14 16:29:52', '2024-01-31 15:57:57', NULL, NULL),
(6, 'Shafin raza', 'shafinraza@gmail.com', 'Sm6Fz/FR4KtObw==', 1, 2, 1, '1706696343WEsC63B4ThvMq!X.jpeg', '2024-01-31 15:49:03', '2024-01-31 15:58:09', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
