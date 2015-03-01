-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2015 at 08:42 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ontsgoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE IF NOT EXISTS `lesson` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_name` varchar(1000) DEFAULT NULL,
  `lesson_content` text,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `lesson_category_id` int(11) NOT NULL,
  `lesson_channel_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`lesson_id`),
  KEY `fk_lesson_lesson_category1_idx` (`lesson_category_id`),
  KEY `fk_lesson_lesson_channel1_idx` (`lesson_channel_id`),
  KEY `fk_lesson_teacher1_idx` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_category`
--

CREATE TABLE IF NOT EXISTS `lesson_category` (
  `lesson_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_category_name` varchar(1000) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lesson_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_channel`
--

CREATE TABLE IF NOT EXISTS `lesson_channel` (
  `lesson_channel_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_channel_name` varchar(1000) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lesson_channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) DEFAULT NULL,
  `content` text,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `created_user` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `featured_image` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `created_date`, `updated_date`, `created_user`, `is_active`, `featured_image`) VALUES
(33, 'Test 1', '<p>This is test</p>\r\n', '2015-03-04', NULL, 1, 1, 'assets/img/post/featured_image/logo.png'),
(37, 'Test 3', '<p>This is test</p>\r\n', '2015-03-07', NULL, 1, 1, 'assets/img/post/featured_image/big_logo.png'),
(38, 'Test 2', '<p>This is test</p>\r\n', '2015-03-05', NULL, 1, 1, 'assets/img/post/featured_image/111535844_57779660.jpg'),
(39, 'Test 35', '<p>asdasd</p>\r\n', '2015-03-04', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`id`, `name`, `is_active`) VALUES
(1, 'Аюулгүйн байдал', 1),
(2, 'Цаг үеийн мэдээ', 1),
(3, 'Орон нутгийн мэдээ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_category_map`
--

CREATE TABLE IF NOT EXISTS `news_category_map` (
  `category_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  KEY `fk_news_category_news_idx` (`news_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_category_map`
--

INSERT INTO `news_category_map` (`category_id`, `news_id`) VALUES
(3, 33),
(3, 37),
(3, 38),
(3, 39);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(1000) DEFAULT NULL,
  `page_slug` varchar(1000) DEFAULT NULL,
  `page_content` text,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_username` varchar(255) DEFAULT NULL,
  `teacher_password` varchar(10) DEFAULT NULL,
  `teacher_info_id` int(11) NOT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `fk_teacher_teacher_info1_idx` (`teacher_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE IF NOT EXISTS `teacher_info` (
  `teacher_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(500) DEFAULT NULL,
  `firstname` varchar(500) DEFAULT NULL,
  `lastname` varchar(500) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender_id` tinyint(1) DEFAULT NULL,
  `company_name` varchar(500) DEFAULT NULL,
  `position` varchar(500) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`teacher_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `is_active`) VALUES
(1, 'admin', '$2y$10$9l5X8bsBRmEbB7OLglBnZur2nQwlqLKoqdIcnRM.MZyFQ67ONlfnu', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`lesson_category_id`) REFERENCES `lesson_category` (`lesson_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`lesson_channel_id`) REFERENCES `lesson_channel` (`lesson_channel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_category_map`
--
ALTER TABLE `news_category_map`
  ADD CONSTRAINT `news_category_map_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `news_category_map_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `news_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`teacher_info_id`) REFERENCES `teacher_info` (`teacher_info_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
