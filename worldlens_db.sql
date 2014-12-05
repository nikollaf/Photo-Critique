-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2014 at 04:55 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `liked_image` int(11) unsigned NOT NULL,
  `user_id_fk` int(11) unsigned NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`liked_image`,`user_id_fk`),
  KEY `user_id_fk` (`user_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`liked_image`, `user_id_fk`, `created`) VALUES
(4, 10, '2014-02-17 23:52:40'),
(5, 10, '2014-02-17 02:45:22'),
(7, 10, '2014-02-17 02:45:20'),
(14, 10, '2014-02-26 03:40:00'),
(16, 10, '2014-02-20 01:12:19'),
(18, 10, '2014-02-18 02:30:03'),
(19, 10, '2014-02-17 02:45:15'),
(20, 10, '2014-02-17 02:45:14'),
(21, 15, '2014-02-19 02:29:18'),
(22, 10, '0000-00-00 00:00:00'),
(23, 10, '0000-00-00 00:00:00'),
(24, 10, '2014-02-17 02:45:08'),
(25, 10, '0000-00-00 00:00:00'),
(26, 10, '2014-02-20 01:58:44'),
(26, 15, '2014-02-19 02:29:17'),
(27, 10, '2014-02-01 13:04:18'),
(27, 12, '2014-02-27 07:09:32'),
(28, 10, '2014-02-17 02:45:06'),
(29, 10, '2014-02-20 01:12:26'),
(30, 10, '2014-02-20 01:57:58'),
(30, 15, '2014-02-19 02:29:19'),
(32, 10, '2014-02-20 01:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE IF NOT EXISTS `feature` (
  `feature_user_id` int(11) unsigned NOT NULL,
  `feature_id` int(11) unsigned NOT NULL,
  `feature_image_id` int(11) unsigned NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `feature_user_id` (`feature_user_id`,`feature_id`,`feature_image_id`),
  KEY `feature_id` (`feature_id`),
  KEY `feature_image_id` (`feature_image_id`)
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
  `f_status` varchar(1) NOT NULL DEFAULT 'W',
  KEY `user_id` (`user_id`),
  KEY `follower_id` (`follower_id`)
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
(12, 15, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `user_id_fk` int(11) unsigned NOT NULL,
  `image_id_fk` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_id_fk` int(11) unsigned NOT NULL,
  PRIMARY KEY (`image_id_fk`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `image_id_fk` (`image_id_fk`),
  KEY `city_id_fk` (`city_id_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`user_id_fk`, `image_id_fk`, `city_id_fk`) VALUES
(11, 4, 14),
(11, 5, 4),
(10, 6, 29),
(12, 7, 30),
(12, 8, 31),
(10, 9, 29),
(10, 10, 33),
(10, 11, 34),
(10, 12, 34),
(10, 13, 35),
(10, 14, 36),
(10, 15, 14),
(10, 16, 37),
(10, 17, 31),
(10, 18, 38);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_points` int(11) NOT NULL,
  `h_points` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `categories` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vibes` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id_fk` int(11) unsigned NOT NULL,
  `image_l_id` int(11) unsigned NOT NULL,
  `gallery_id` int(11) unsigned NOT NULL,
  `img_caption` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `gallery_id` (`gallery_id`),
  KEY `image_l_id` (`image_l_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_url`, `created`, `img_points`, `h_points`, `status`, `categories`, `vibes`, `user_id_fk`, `image_l_id`, `gallery_id`, `img_caption`) VALUES
(1, 'tgeeiz5puymckcqsp8es', '2014-02-02 05:52:43', 9, 8, 'Y', 'Architecture', 'Inspiration', 11, 14, 4, ''),
(2, 'lhgp0xk59vw9v4s10znk', '2014-02-02 16:24:36', 7, 3, 'Y', 'Architecture', 'Happiness', 11, 4, 5, ''),
(3, 'gmaddsglkw9ufq8ek2d3', '2014-02-02 16:24:37', 12, 3, 'Y', 'People', 'Happiness', 11, 4, 5, ''),
(4, 'mnrilmigck6gh21as9yp', '2014-02-02 16:24:37', 12, 8, 'Y', 'Nature', 'Happiness', 11, 4, 5, ''),
(5, 'ns9vnjxbgmugbybgdoln', '2014-02-02 16:24:38', 11, 3, 'Y', 'People', 'Happiness', 11, 4, 5, ''),
(6, 'f4nuupeert01nokyp0l3', '2014-02-02 16:24:38', 8, 4, 'Y', 'Architecture', 'Happiness', 11, 4, 5, ''),
(7, 'iskly2oeldxedhtutdiy', '2014-02-02 16:24:39', 17, 1, 'Y', 'Nature', 'Happiness', 11, 4, 5, ''),
(14, 'ifpnaqke9jjod4yqsgcg', '2014-02-02 18:21:56', 10, 4, 'Y', 'Nature', 'Inspiration', 10, 29, 6, ''),
(15, 'iuewfc4w5ehbbqql1cnn', '2014-02-02 18:21:57', 10, 4, 'Y', 'Architecture', 'Inspiration', 10, 29, 6, ''),
(16, 'vsuovgh8xvpbzxfyrnqs', '2014-02-02 18:21:58', 12, 3, 'Y', 'Architecture', 'Inspiration', 10, 29, 6, ''),
(17, 'vsgdjmt7z8ptpasjqzuo', '2014-02-02 18:21:58', 10, 2, 'Y', 'People', 'Happiness', 10, 29, 6, ''),
(18, 'y11zlsbaczga5lvdnopw', '2014-02-05 00:06:21', 20, 5, 'Y', 'People', 'Happiness', 12, 31, 8, ''),
(19, 'obxeuah38as1vqkbdm28', '2014-02-05 05:43:39', 19, 3, 'Y', 'Food', 'Happiness', 10, 16, 9, 'Yummy cupcakes.  I make them all the time.'),
(20, 't6xgqdtgjmizbego2g5x', '2014-02-05 05:49:56', 18, 3, 'Y', 'Nature', 'Inspiration', 10, 33, 10, ''),
(21, 'xsbiojthmc3cndhiyvuk', '2014-02-09 18:11:49', 2, 9, 'Y', 'Architecture', 'Cold', 10, 34, 12, ''),
(22, 'xl2dpxhnmcbcmzzyzi3x', '2014-02-09 18:11:50', 4, 0, 'Y', '', 'Cold', 10, 34, 12, ''),
(23, 'x4ks8uew4u26qqg4z4fq', '2014-02-09 18:11:51', 4, 0, 'Y', 'Other', 'Other', 10, 34, 12, ''),
(24, 'wrogzkext66ngcpey7rv', '2014-02-09 18:11:51', 4, 8, 'Y', 'Architecture', 'Cold', 10, 34, 12, ''),
(25, 'b4jwyah2dk0m4v8qgrfn', '2014-02-09 18:11:52', 3, 0, 'Y', 'Nature', 'Cold', 10, 34, 12, ''),
(26, 'b1wwbqprhayvodrftnfw', '2014-02-09 18:11:53', 5, 7, 'Y', 'Architecture', 'Cold', 10, 34, 12, ''),
(27, 'elz2jnifhgjig0xeozgn', '2014-02-09 18:19:17', 4, 0, 'Y', 'Nature', '', 10, 35, 13, ''),
(28, 'sacktqdxkx3gqh8nkek3', '2014-02-09 18:19:17', 4, 5, 'Y', 'Nature', '', 10, 35, 13, ''),
(29, 'y1iayk2c3aln8qbmvc00', '2014-02-09 18:19:18', 1, 2, 'Y', 'Nature', '', 10, 35, 13, ''),
(30, 'fas8qmqondziqdx58adh', '2014-02-09 18:22:11', 4, 4, 'Y', 'Other', 'Peace', 10, 36, 14, ''),
(32, 'qrqz2qvhytupzjaoexls', '2014-02-10 23:29:56', 4, 3, 'Y', 'Nature', 'Beautiful', 10, 37, 16, ''),
(33, 'hfe3mgup00vd2dd6982z', '2014-02-27 23:59:27', 0, 0, 'Y', 'Nature', 'Beautiful', 10, 38, 18, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `img_comments`
--

CREATE TABLE IF NOT EXISTS `img_comments` (
  `user_id_fk` int(11) NOT NULL,
  `image_id_fk` int(11) NOT NULL,
  `comment` varchar(240) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user_id_fk` (`user_id_fk`,`image_id_fk`),
  KEY `image_id_fk` (`image_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `img_comments`
--

INSERT INTO `img_comments` (`user_id_fk`, `image_id_fk`, `comment`, `created`) VALUES
(10, 27, 'This picture rocks!  Leaves! Yeah!', '2014-02-04 08:10:02'),
(11, 27, 'Whoa! So pretty! Awesome! ', '2014-02-16 09:04:13'),
(9, 27, 'Austin has such pretty leaves!  I want to move there.', '2014-02-16 17:56:04'),
(10, 27, 'AMAZING', '2014-02-17 21:36:01'),
(10, 27, 'I love this picture.  I can not stop looking at it.', '2014-02-17 21:37:59'),
(10, 27, 'Great picture', '2014-02-17 23:53:28'),
(17, 1, 'TEst', '2014-12-05 01:41:40'),
(17, 1, 'WOW', '2014-12-05 01:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `l_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(254) NOT NULL,
  `state` varchar(254) NOT NULL,
  `country` varchar(254) NOT NULL,
  `cont` varchar(254) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`l_id`),
  KEY `l_id` (`l_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`l_id`, `city`, `state`, `country`, `cont`, `points`) VALUES
(2, 'Los Angeles', 'CA', '', 'USA', 23988),
(3, 'Gera', '', 'Germany', 'Europe', 5),
(4, 'Munich', '', 'Germany', 'Europe', 66002),
(5, 'Genoa', '', 'Italy', 'Europe', 54800),
(6, 'Formosa Province', '', 'Argentina', 'Latin America', 13000),
(8, 'Lichtenstein', '', 'Germany', 'Europe', 1),
(11, 'Ticino', '', 'Switzerland', 'Europe', 2),
(14, 'Chicago', 'IL', '', 'USA', 90009),
(15, 'Tirana', '', 'Albania', 'Europe', 2),
(16, 'Essen', '', 'Germany', '', 15),
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
(29, 'London', '', 'England', 'Europe', 92),
(31, 'Palatine', 'IL', '', 'USA', 28),
(33, 'Luga', '', 'Switz', 'Europe', 24),
(34, 'Boston', 'MA', '', 'North America ', 76),
(35, 'Austin', 'TX', '', 'North America ', 43),
(36, 'Tokyo', '', 'Japan', 'Asia ', 35),
(37, 'Aarau', '', 'Switzerland', 'Europe ', 45),
(38, 'Alpine', 'CA', '', 'North America ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

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
(17, 'test@test.com', '$2y$12$14756462054810ccfc45duXAf/ZKtY9wjdwXRewFo.QW31UjLXwD6', 'test', 0, '', '', NULL, '2014-12-05 01:39:28');

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `images_ibfk_2` FOREIGN KEY (`image_l_id`) REFERENCES `location` (`l_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
