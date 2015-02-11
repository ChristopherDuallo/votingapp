-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 06:13 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fbvoteapp`
--
CREATE DATABASE IF NOT EXISTS `fbvoteapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fbvoteapp`;

-- --------------------------------------------------------

--
-- Table structure for table `fblogin`
--

CREATE TABLE IF NOT EXISTS `fblogin` (
  `fbid` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `last_voted` datetime NOT NULL,
  `votes_today` int(11) NOT NULL,
  PRIMARY KEY (`fbid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fblogin`
--

INSERT INTO `fblogin` (`fbid`, `name`, `email`, `last_voted`, `votes_today`) VALUES
('482159201927080', 'Omondi John', 'samkivu@gmail.com', '2015-02-10 07:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(255) NOT NULL,
  `fruit` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `fbid`, `fruit`) VALUES
(1, '482159201927080', 'grape'),
(2, '482159201927080', 'grape'),
(3, '482159201927080', 'grape'),
(4, '482159201927080', 'mango'),
(5, '482159201927080', 'grape'),
(6, '482159201927080', 'apple'),
(7, '482159201927080', 'apple'),
(8, '482159201927080', 'apple'),
(9, '482159201927080', 'apple'),
(10, '482159201927080', 'apple'),
(11, '482159201927080', 'mango'),
(12, '482159201927080', 'mango'),
(13, '482159201927080', 'mango'),
(14, '482159201927080', 'apple'),
(15, '482159201927080', 'apple'),
(16, '482159201927080', 'apple'),
(17, '482159201927080', 'mango'),
(18, '482159201927080', 'apple'),
(19, '482159201927080', 'apple'),
(20, '482159201927080', 'apple'),
(21, '482159201927080', 'apple'),
(22, '482159201927080', 'apple');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
