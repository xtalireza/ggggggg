-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 10:29 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `userid`, `type`, `title`, `file`, `link`, `created_at`) VALUES
(1, 4, 'photos', 'عکس 1', '1.jpg', NULL, 1703952993),
(2, 4, 'photos', 'عکس 2', '2.jpg', NULL, 1703953002),
(3, 4, 'photos', 'عکس 3', '8839468-i-love-you-hd.jpg', NULL, 1703953010),
(4, 4, 'photos', 'عکس 4', '1f9c7df89a4e1595e3c69d953cda0f49.jpg', NULL, 1703953018),
(5, 4, 'photos', 'عکس 5', 'snowmobiletrail.jpg', NULL, 1703953029),
(6, 4, 'videos', 'ویدئو 1', 'video_2018-09-12_21-01-55.mov', NULL, 1703953052),
(7, 4, 'files', 'فایل 1', 'menu.svg', NULL, 1703953077);

-- --------------------------------------------------------

--
-- Table structure for table `pension`
--

CREATE TABLE `pension` (
  `pid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `base` int(11) NOT NULL,
  `house` int(11) NOT NULL,
  `reg_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pension`
--

INSERT INTO `pension` (`pid`, `userid`, `base`, `house`, `reg_date`) VALUES
(1, 4, 1200000, 300000, 1703953217),
(2, 4, 54000000, 450000, 1703953227),
(3, 2, 5380000, 500000, 1703953239),
(4, 2, 79000000, 670000, 1703953251),
(5, 2, 1490000, 123000, 1703953266);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `username`, `password`, `email`, `phone`, `address`, `permission`, `created_at`) VALUES
(1, 'مدیر', 'admin', '123456', 'aydamottaghi@gmail.com', '09114357976', '', 1, 1703940460),
(2, 'ahmad', 'ahmad', '123', '', '', '', 0, 1703940461),
(4, 'علی دایی', 'ali', '123456', 'aa@a.com', '123', 'تهران', 0, 1703952477);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pension`
--
ALTER TABLE `pension`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
