-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2014 at 12:40 AM
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
-- Table structure for table `com_votes`
--

CREATE TABLE IF NOT EXISTS `com_votes` (
  `cv_user_id` int(11) unsigned NOT NULL,
  `cv_img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_votes`
--

INSERT INTO `com_votes` (`cv_user_id`, `cv_img_id`) VALUES
(18, 8),
(18, 11),
(18, 12),
(18, 13);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `liked_image` int(11) unsigned NOT NULL,
  `user_id_fk` int(11) unsigned NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`liked_image`, `user_id_fk`, `created`) VALUES
(2, 18, '2014-12-22 21:17:48'),
(4, 10, '2014-02-17 23:52:40'),
(5, 10, '2014-02-17 02:45:22'),
(7, 10, '2014-02-17 02:45:20'),
(7, 18, '2014-12-22 21:17:42'),
(14, 10, '2014-02-26 03:40:00'),
(15, 18, '2014-12-23 21:56:45'),
(16, 10, '2014-02-20 01:12:19'),
(16, 18, '2014-12-23 21:56:26'),
(17, 18, '2014-12-22 21:20:48'),
(18, 10, '2014-02-18 02:30:03'),
(19, 10, '2014-02-17 02:45:15'),
(19, 18, '2014-12-23 21:56:47'),
(20, 10, '2014-02-17 02:45:14'),
(20, 18, '2014-12-22 21:17:39'),
(21, 15, '2014-02-19 02:29:18'),
(22, 10, '0000-00-00 00:00:00'),
(23, 10, '0000-00-00 00:00:00'),
(24, 10, '2014-02-17 02:45:08'),
(24, 18, '2014-12-22 21:17:44'),
(25, 10, '0000-00-00 00:00:00'),
(26, 10, '2014-02-20 01:58:44'),
(26, 15, '2014-02-19 02:29:17'),
(27, 10, '2014-02-01 13:04:18'),
(27, 12, '2014-02-27 07:09:32'),
(28, 10, '2014-02-17 02:45:06'),
(29, 10, '2014-02-20 01:12:26'),
(30, 10, '2014-02-20 01:57:58'),
(30, 15, '2014-02-19 02:29:19'),
(32, 10, '2014-02-20 01:58:00'),
(36, 18, '2014-12-22 21:17:43'),
(39, 18, '2014-12-23 21:56:42'),
(43, 18, '2014-12-22 21:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE IF NOT EXISTS `feature` (
  `feature_user_id` int(11) unsigned NOT NULL,
  `feature_id` int(11) unsigned NOT NULL,
  `feature_image_id` int(11) unsigned NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`feature_user_id`, `feature_id`, `feature_image_id`, `created`) VALUES
(10, 11, 27, '2014-02-11 08:18:08'),
(12, 10, 27, '2014-02-11 08:20:06'),
(8, 10, 27, '2014-02-20 08:25:11'),
(10, 10, 23, '0000-00-00 00:00:00'),
(10, 10, 22, '0000-00-00 00:00:00'),
(10, 12, 18, '0000-00-00 00:00:00'),
(10, 10, 19, '0000-00-00 00:00:00'),
(10, 10, 15, '0000-00-00 00:00:00'),
(10, 10, 20, '0000-00-00 00:00:00'),
(10, 11, 1, '0000-00-00 00:00:00'),
(10, 10, 29, '0000-00-00 00:00:00'),
(10, 10, 24, '2014-02-16 21:58:35'),
(10, 11, 5, '2014-02-17 03:13:28'),
(10, 10, 28, '2014-02-17 20:52:48'),
(10, 10, 26, '2014-02-17 20:52:50'),
(10, 10, 25, '2014-02-17 20:52:51'),
(10, 10, 21, '2014-02-17 20:52:53'),
(15, 10, 32, '2014-02-19 02:26:53'),
(15, 10, 30, '2014-02-19 02:26:55'),
(10, 10, 32, '2014-02-26 23:30:31'),
(10, 11, 7, '2014-02-28 00:14:03'),
(17, 10, 33, '2014-12-05 01:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `user_id` int(11) unsigned NOT NULL,
  `follower_id` int(11) unsigned NOT NULL,
  `f_status` varchar(1) NOT NULL DEFAULT 'W'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`user_id`, `follower_id`, `f_status`) VALUES
(8, 10, 'Y'),
(11, 10, 'Y'),
(10, 11, 'W'),
(9, 15, 'N'),
(14, 15, 'Y'),
(9, 15, 'N'),
(12, 15, 'N'),
(19, 18, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `user_id_fk` int(11) unsigned NOT NULL,
`image_id_fk` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`user_id_fk`, `image_id_fk`) VALUES
(10, 6),
(10, 9),
(10, 10),
(10, 11),
(10, 12),
(10, 13),
(10, 14),
(10, 15),
(10, 16),
(10, 17),
(10, 18),
(11, 4),
(11, 5),
(12, 7),
(12, 8),
(18, 19),
(18, 20),
(18, 21),
(18, 22),
(18, 23),
(18, 24),
(18, 25),
(18, 26),
(18, 27),
(18, 28),
(18, 29),
(18, 30),
(18, 31),
(18, 32),
(18, 33),
(18, 34),
(18, 35),
(18, 36),
(18, 37),
(18, 38),
(18, 39),
(18, 40),
(18, 41),
(18, 42),
(18, 43),
(18, 44),
(18, 45),
(18, 46),
(18, 47),
(18, 48),
(18, 49),
(18, 50),
(18, 51),
(18, 52),
(18, 53),
(18, 54),
(18, 55);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
`image_id` int(11) unsigned NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_points` int(11) NOT NULL,
  `h_points` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `categories` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vibes` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id_fk` int(11) unsigned NOT NULL,
  `gallery_id` int(11) unsigned NOT NULL,
  `img_caption` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_url`, `created`, `img_points`, `h_points`, `status`, `categories`, `vibes`, `user_id_fk`, `gallery_id`, `img_caption`) VALUES
(1, 'tgeeiz5puymckcqsp8es', '2014-02-02 05:52:43', 9, 8, 'Y', 'Architecture', 'Inspiration', 11, 4, ''),
(2, 'lhgp0xk59vw9v4s10znk', '2014-02-02 16:24:36', 8, 3, 'Y', 'Architecture', 'Happiness', 11, 5, ''),
(3, 'gmaddsglkw9ufq8ek2d3', '2014-02-02 16:24:37', 12, 3, 'Y', 'People', 'Happiness', 11, 5, ''),
(4, 'mnrilmigck6gh21as9yp', '2014-02-02 16:24:37', 13, 8, 'Y', 'Nature', 'Happiness', 11, 5, ''),
(5, 'ns9vnjxbgmugbybgdoln', '2014-02-02 16:24:38', 11, 3, 'Y', 'People', 'Happiness', 11, 5, ''),
(6, 'f4nuupeert01nokyp0l3', '2014-02-02 16:24:38', 9, 4, 'Y', 'Architecture', 'Happiness', 11, 5, ''),
(7, 'iskly2oeldxedhtutdiy', '2014-02-02 16:24:39', 18, 1, 'Y', 'Nature', 'Happiness', 11, 5, ''),
(14, 'ifpnaqke9jjod4yqsgcg', '2014-02-02 18:21:56', 10, 4, 'Y', 'Nature', 'Inspiration', 10, 6, ''),
(15, 'iuewfc4w5ehbbqql1cnn', '2014-02-02 18:21:57', 12, 4, 'Y', 'Architecture', 'Inspiration', 10, 6, ''),
(16, 'vsuovgh8xvpbzxfyrnqs', '2014-02-02 18:21:58', 15, 3, 'Y', 'Architecture', 'Inspiration', 10, 6, ''),
(17, 'vsgdjmt7z8ptpasjqzuo', '2014-02-02 18:21:58', 12, 2, 'Y', 'People', 'Happiness', 10, 6, ''),
(18, 'y11zlsbaczga5lvdnopw', '2014-02-05 00:06:21', 22, 5, 'Y', 'People', 'Happiness', 12, 8, ''),
(19, 'obxeuah38as1vqkbdm28', '2014-02-05 05:43:39', 25, 3, 'Y', 'Food', 'Happiness', 10, 9, 'Yummy cupcakes'),
(20, 't6xgqdtgjmizbego2g5x', '2014-02-05 05:49:56', 19, 3, 'Y', 'Nature', 'Inspiration', 10, 10, ''),
(21, 'xsbiojthmc3cndhiyvuk', '2014-02-09 18:11:49', 3, 9, 'Y', 'Architecture', 'Cold', 10, 12, ''),
(22, 'xl2dpxhnmcbcmzzyzi3x', '2014-02-09 18:11:50', 4, 0, 'Y', '', 'Cold', 10, 12, ''),
(23, 'x4ks8uew4u26qqg4z4fq', '2014-02-09 18:11:51', 4, 0, 'Y', 'Other', 'Other', 10, 12, ''),
(24, 'wrogzkext66ngcpey7rv', '2014-02-09 18:11:51', 6, 8, 'Y', 'Architecture', 'Cold', 10, 12, ''),
(25, 'b4jwyah2dk0m4v8qgrfn', '2014-02-09 18:11:52', 4, 0, 'Y', 'Nature', 'Cold', 10, 12, ''),
(26, 'b1wwbqprhayvodrftnfw', '2014-02-09 18:11:53', 6, 7, 'Y', 'Architecture', 'Cold', 10, 12, ''),
(27, 'elz2jnifhgjig0xeozgn', '2014-02-09 18:19:17', 6, 0, 'Y', 'Nature', '', 10, 13, ''),
(28, 'sacktqdxkx3gqh8nkek3', '2014-02-09 18:19:17', 4, 5, 'Y', 'Nature', '', 10, 13, ''),
(29, 'y1iayk2c3aln8qbmvc00', '2014-02-09 18:19:18', 1, 2, 'Y', 'Nature', '', 10, 13, ''),
(30, 'fas8qmqondziqdx58adh', '2014-02-09 18:22:11', 4, 4, 'Y', 'Other', 'Peace', 10, 14, ''),
(32, 'qrqz2qvhytupzjaoexls', '2014-02-10 23:29:56', 5, 3, 'Y', 'Nature', 'Beautiful', 10, 16, ''),
(33, 'hfe3mgup00vd2dd6982z', '2014-02-27 23:59:27', 1, 0, 'Y', 'Nature', 'Beautiful', 10, 18, NULL),
(34, 'xoclreurq2zuxeal1l1p', '2014-12-10 16:42:38', 0, 0, 'Y', 'People', 'Sad', 18, 19, 'Drugstore RX'),
(36, 'ht74ozjpwgcyfxymboyo', '2014-12-22 20:07:26', 4, 0, 'Y', 'Food', NULL, 18, 42, 'Clothes'),
(37, 'synqy7bnxsjrl8ydgu6n', '2014-12-22 20:24:47', 0, 0, 'Y', 'People', NULL, 18, 48, ''),
(38, 'zq0sdgtivuq7dgym1ke1', '2014-12-22 20:24:47', 1, 0, 'Y', 'People', NULL, 18, 48, ''),
(39, 'fqqprwyjsiortfqvdm7u', '2014-12-22 20:24:48', 2, 0, 'Y', 'People', NULL, 18, 48, ''),
(40, 'dxj9k0mmx3njwk7uwlq9', '2014-12-22 20:24:48', 0, 0, 'Y', 'People', NULL, 18, 48, ''),
(41, 'adibf5dy5gn5yxatisgw', '2014-12-22 20:31:17', 0, 0, 'Y', 'People', NULL, 18, 54, ''),
(42, 'gnotpbajduxvglewc1na', '2014-12-22 20:31:18', 1, 0, 'Y', 'People', NULL, 18, 54, ''),
(43, 'yuyoomljr9qzfmgtjbcr', '2014-12-22 20:31:18', 3, 0, 'Y', 'People', NULL, 18, 54, '');

-- --------------------------------------------------------

--
-- Table structure for table `img_comments`
--

CREATE TABLE IF NOT EXISTS `img_comments` (
`com_img_id` int(11) unsigned NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `image_id_fk` int(11) NOT NULL,
  `comment` varchar(240) NOT NULL,
  `votes` int(7) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `img_comments`
--

INSERT INTO `img_comments` (`com_img_id`, `user_id_fk`, `image_id_fk`, `comment`, `votes`, `created`) VALUES
(1, 10, 27, 'This picture rocks!  Leaves! Yeah!', 0, '2014-02-04 08:10:02'),
(2, 11, 27, 'Whoa! So pretty! Awesome! ', 0, '2014-02-16 09:04:13'),
(3, 9, 27, 'Austin has such pretty leaves!  I want to move there.', 0, '2014-02-16 17:56:04'),
(4, 10, 27, 'AMAZING', 0, '2014-02-17 21:36:01'),
(5, 10, 27, 'I love this picture.  I can not stop looking at it.', 0, '2014-02-17 21:37:59'),
(6, 10, 27, 'Great picture', 0, '2014-02-17 23:53:28'),
(7, 17, 1, 'TEst', 0, '2014-12-05 01:41:40'),
(8, 17, 1, 'WOW', 0, '2014-12-05 01:41:45'),
(9, 18, 29, 'asdfasdfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 0, '2014-12-19 13:56:04'),
(10, 18, 29, '<script>alert(''Hi'')</script>', 0, '2014-12-19 13:56:48'),
(11, 18, 42, 'Wow', 4, '2014-12-23 22:03:34'),
(12, 18, 39, 'COOL', 11, '2014-12-23 23:09:33'),
(13, 18, 39, 'Very amazing', 4, '2014-12-23 23:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`l_id` int(11) unsigned NOT NULL,
  `city` varchar(254) NOT NULL,
  `state` varchar(254) NOT NULL,
  `country` varchar(254) NOT NULL,
  `cont` varchar(254) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`l_id`, `city`, `state`, `country`, `cont`, `points`) VALUES
(2, 'Los Angeles', 'CA', '', 'USA', 23988),
(3, 'Gera', '', 'Germany', 'Europe', 5),
(4, 'Munich', '', 'Germany', 'Europe', 66003),
(5, 'Genoa', '', 'Italy', 'Europe', 54800),
(6, 'Formosa Province', '', 'Argentina', 'Latin America', 13000),
(8, 'Lichtenstein', '', 'Germany', 'Europe', 1),
(11, 'Ticino', '', 'Switzerland', 'Europe', 2),
(14, 'Chicago', 'IL', '', 'USA', 90009),
(15, 'Tirana', '', 'Albania', 'Europe', 2),
(16, 'Essen', '', 'Germany', '', 16),
(18, 'Barcelona', '', 'Spain', 'Europe', 1),
(19, 'Rome', '', 'Italy', 'Europe', 1),
(20, 'Polany', '', 'Poland', 'Europe', 1),
(21, 'Manila', '', 'Philippines', 'Asia', 1),
(22, 'New York', 'NY', '', 'USA', 0),
(23, 'Dallas', 'TX', '', 'USA', 0),
(24, 'Brasilia', '', 'Brazil', 'Latin America', 0),
(25, 'Mexico City', '', 'Mexico', 'Latin America', 5),
(26, 'Cape Town', '', 'South Africa', 'Africa', 0),
(27, 'Melbourne', '', 'Australia', 'Australia', 0),
(28, 'Amsterdam', '', 'Netherlands', 'Europe', 5),
(29, 'London', '', 'England', 'Europe', 93),
(31, 'Palatine', 'IL', '', 'USA', 30),
(33, 'Luga', '', 'Switz', 'Europe', 24),
(34, 'Boston', 'MA', '', 'North America ', 77),
(35, 'Austin', 'TX', '', 'North America ', 43),
(36, 'Tokyo', '', 'Japan', 'Asia ', 35),
(37, 'Aarau', '', 'Switzerland', 'Europe ', 46),
(38, 'Alpine', 'CA', '', 'North America ', 6),
(39, 'Pala', 'CA', '', 'North America ', 1),
(40, '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `points`, `info`, `profile_pic`, `location`, `created_at`) VALUES
(8, 'yeah@yahoo.com', '$2y$12$8678483852d9d48713615uuwGroR3Z.U9J6rVXG1X3LF7eTTScQpG', 'Jenny', 0, 'I like traveling.', 'zdvvdzyxrrxcl55vdrau', NULL, '2014-01-18 01:10:31'),
(9, 'lee@yahoo.com', '$2y$12$578115653852d9d6b2781uj6BNe9VZ4OrYQhE6c/5rP/zUjd0.lFu', 'Suh', 0, 'I am asian.', 'h8se1gljj50umwmtlskj', NULL, '2014-01-18 01:19:47'),
(10, 'asdfasdf@yahoo.com', '$2y$12$494358291452d9dbb8479Of8.0KyTjts8SOKMNPsWOBLDniDX5KAq', 'Craig Denver', 0, 'You possess only that which you will not lose in a boat wreck.                                                                ', 'pxvmjuamuhk1ietuzjuq', '', '2014-01-18 01:41:12'),
(11, 'asdf1234@yahoo.com', '$2y$12$63808678852dc6b802727u1kDS3Y60iKy3abNLl8WJNzoSsB8rEpy', 'Emily', 0, '', 'guxh3blux86nwaevxzkk', NULL, '2014-01-20 00:19:12'),
(12, 'elkriko60@yahoo.com', '$2y$12$810544136252f17f2da05uh4Ma/dqqecetL/ZKOhdNc2YAXV/Ny.G', 'Elsa', 0, '', 'otpgwwscsrzvvqzsmupu', NULL, '2014-02-05 00:00:46'),
(13, 'ted@yahoo.com', '$2y$12$43923098005303f1f3138OM.1pVadiT9nKD1aMO7fahWWudfFYopK', 'Ted', 0, '', '', NULL, '2014-02-18 23:51:15'),
(14, 'mike_jones@yahoo.com', '$2y$12$10027411595303f219af3uQLcckyfYcnVGfM9FBv.MJRecqhyddna', 'Mike Jones', 0, '', '', NULL, '2014-02-18 23:51:54'),
(15, 'jennyjenny@yahoo.com', '$2y$12$07279431345304065e385u1GkQ2.9trxcDuJgiT5eFdxD./UzgtUe', 'Jennifer Lopez', 0, '', '', NULL, '2014-02-19 01:18:22'),
(16, 'blank@test.com', '$2y$12$2152062815373f174ad37uk5D358yTduYz4vmNNboJDfqzz/zDs.2', 'Blank Mang', 0, 'I like to do things.', '', '', '2014-05-14 22:43:01'),
(17, 'test@test.com', 'test123', 'test', 0, '', '', NULL, '2014-12-05 01:39:28'),
(18, 'test123@test.com', '$2y$12$11731895554873c577353Oqujt2Byz9EcpXLSIH2nhWOwN0R0V1xe', 'teD', 0, '', '', NULL, '2014-12-09 18:15:51'),
(19, 'blah123@test.com', '$2y$12$120643012754999ab304dOM7je3rloHUPsZIxqtyFVbmhb6d4Vr9m', '', 0, '', '', NULL, '2014-12-23 16:39:15');

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
('0.50', '0.80', '0.90', '0.40', '0.20', 18, 20),
('0.90', '0.30', '0.50', '1.00', '1.00', 18, 38),
('0.70', '0.50', '0.60', '0.40', '0.40', 19, 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `com_votes`
--
ALTER TABLE `com_votes`
 ADD PRIMARY KEY (`cv_img_id`), ADD KEY `cv_user_id` (`cv_user_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
 ADD PRIMARY KEY (`liked_image`,`user_id_fk`), ADD KEY `user_id_fk` (`user_id_fk`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
 ADD KEY `feature_user_id` (`feature_user_id`,`feature_id`,`feature_image_id`), ADD KEY `feature_id` (`feature_id`), ADD KEY `feature_image_id` (`feature_image_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
 ADD KEY `user_id` (`user_id`), ADD KEY `follower_id` (`follower_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
 ADD PRIMARY KEY (`image_id_fk`), ADD KEY `user_id_fk` (`user_id_fk`), ADD KEY `image_id_fk` (`image_id_fk`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`image_id`), ADD KEY `user_id_fk` (`user_id_fk`), ADD KEY `gallery_id` (`gallery_id`);

--
-- Indexes for table `img_comments`
--
ALTER TABLE `img_comments`
 ADD PRIMARY KEY (`com_img_id`), ADD KEY `user_id_fk` (`user_id_fk`,`image_id_fk`), ADD KEY `image_id_fk` (`image_id_fk`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`l_id`), ADD KEY `l_id` (`l_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
 ADD PRIMARY KEY (`vote_id_fk`,`vote_img_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
MODIFY `image_id_fk` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
MODIFY `image_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `img_comments`
--
ALTER TABLE `img_comments`
MODIFY `com_img_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `l_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `com_votes`
--
ALTER TABLE `com_votes`
ADD CONSTRAINT `cv_user_fk` FOREIGN KEY (`cv_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`id`);

--
-- Constraints for table `feature`
--
ALTER TABLE `feature`
ADD CONSTRAINT `feature_ibfk_1` FOREIGN KEY (`feature_user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `feature_ibfk_2` FOREIGN KEY (`feature_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `feature_ibfk_3` FOREIGN KEY (`feature_image_id`) REFERENCES `images` (`image_id`);

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
ADD CONSTRAINT `gallery_ibfk_3` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
