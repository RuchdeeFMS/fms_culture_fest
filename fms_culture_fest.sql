-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2018 at 02:09 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms_culture_fest`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `q1` tinyint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants_zones`
--

CREATE TABLE `participants_zones` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `zone_0` tinyint(11) NOT NULL DEFAULT '0',
  `zone_0_ts` timestamp NULL DEFAULT NULL,
  `zone_0_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_0_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_1` tinyint(1) NOT NULL DEFAULT '0',
  `zone_1_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_1_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_1_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_2` tinyint(1) NOT NULL DEFAULT '0',
  `zone_2_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_2_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_2_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_3` tinyint(1) NOT NULL DEFAULT '0',
  `zone_3_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_3_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_3_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_4` tinyint(1) NOT NULL DEFAULT '0',
  `zone_4_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_4_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_4_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_5` tinyint(1) NOT NULL DEFAULT '0',
  `zone_5_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_5_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_5_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_6` tinyint(1) NOT NULL DEFAULT '0',
  `zone_6_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_6_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_6_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_7` tinyint(1) NOT NULL DEFAULT '0',
  `zone_7_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_7_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_7_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_8` tinyint(1) NOT NULL DEFAULT '0',
  `zone_8_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_8_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_8_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_9` tinyint(1) NOT NULL DEFAULT '0',
  `zone_9_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zone_9_lat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zone_9_long` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `all_zones` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants_zones`
--
ALTER TABLE `participants_zones`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
