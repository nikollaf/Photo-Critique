-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2014 at 09:47 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `worldlens_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `exposure` decimal(4,2) NOT NULL,
  `focus` decimal(4,2) NOT NULL,
  `lighting` decimal(4,2) NOT NULL,
  `creativity` decimal(4,2) NOT NULL,
  `story` decimal(4,2) NOT NULL,
  `vote_id_fk` int(11) NOT NULL,
  `vote_img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`exposure`, `focus`, `lighting`, `creativity`, `story`, `vote_id_fk`, `vote_img_id`) VALUES
('0.20', '0.00', '0.00', '0.20', '0.20', 18, 14),
('0.60', '0.20', '0.60', '0.80', '0.10', 18, 17),
('0.50', '0.40', '0.70', '0.30', '0.20', 18, 19),
('0.50', '0.80', '0.90', '0.40', '0.20', 18, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
 ADD PRIMARY KEY (`vote_id_fk`,`vote_img_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
