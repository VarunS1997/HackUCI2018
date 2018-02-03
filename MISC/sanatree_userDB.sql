-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2018 at 04:27 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sanatree_userDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Histories`
--

CREATE TABLE IF NOT EXISTS `Histories` (
  `USER_ID` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `FIRST_NAME` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `LAST_NAME` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `USER_ID` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `DOB` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `ADDRESS` text COLLATE utf8_unicode_ci NOT NULL,
  `START_DATE` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
