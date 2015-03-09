-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2015 at 05:05 PM
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
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_info_id` int(11) NOT NULL,
  `aimag_id` int(11) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `address_detail` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teacher` (`teacher_info_id`),
  KEY `district` (`district_id`),
  KEY `aimag` (`aimag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `teacher_info_id`, `aimag_id`, `district_id`, `address_detail`) VALUES
(1, 1, 22, 1, '25-р хороо 90-402'),
(3, 3, 1, NULL, ''),
(4, 4, 2, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `aimag`
--

CREATE TABLE IF NOT EXISTS `aimag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `aimag`
--

INSERT INTO `aimag` (`id`, `name`) VALUES
(1, 'Архангай'),
(2, 'Баян-Өлгий'),
(3, 'Баянхонгор'),
(4, 'Булган'),
(5, 'Говь-Алтай'),
(6, 'Говьсүмбэр'),
(7, 'Дархан-Уул'),
(8, 'Дорноговь'),
(9, 'Дорнод'),
(10, 'Дундговь'),
(11, 'Завхан'),
(12, 'Орхон'),
(13, 'Өвөрхангай'),
(14, 'Өмнөговь'),
(15, 'Сүхбаатар'),
(16, 'Сэлэнгэ'),
(17, 'Төв'),
(18, 'Увс'),
(19, 'Ховд'),
(20, 'Хөвсгөл'),
(21, 'Хэнтий'),
(22, 'Улаанбаатар');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `aimag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aimag` (`aimag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `aimag_id`) VALUES
(1, 'Багануур', 22),
(2, 'Багахангай', 22),
(3, 'Баянгол', 22),
(4, 'Баянзүрх', 22),
(5, 'Налайх', 22),
(6, 'Сонгинохайрхан', 22),
(7, 'Сүхбаатар', 22),
(8, 'Хан-Уул', 22),
(9, 'Чингэлтэй', 22);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'Эр'),
(2, 'Эм');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `created_date`, `updated_date`, `created_user`, `is_active`, `featured_image`) VALUES
(43, 'Test 1', '<p>This is test</p>\r\n', '2015-03-01', '2015-03-08', 1, 1, 'assets/img/post/featured_image/148533370_268657423.png'),
(46, 'Test 2', '<p>This is test 2</p>\r\n', '2015-03-06', '2015-03-08', 1, 1, NULL),
(47, 'Test 3', '<p>asdasd</p>\r\n', '2015-03-05', NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=385 ;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`id`, `name`, `is_active`) VALUES
(2, 'Цаг үеийн мэдээ', 1),
(17, 'Аюулгүйн байдал', 1),
(18, 'Орон нутгийн мэдээлэл', 1);

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
(18, 43),
(18, 46),
(17, 47);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  `slug` varchar(1000) DEFAULT NULL,
  `content` text,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `page_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_type_id` (`page_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `slug`, `content`, `is_active`, `created_date`, `updated_date`, `page_type_id`) VALUES
(8, 'Захирлын мэндчилгээ', 'zakhirlyn-mendchilgee', '<p>Захирлын мэндчилгээ</p>\r\n', 1, '2015-03-04', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `page_type`
--

CREATE TABLE IF NOT EXISTS `page_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_type_name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `page_type`
--

INSERT INTO `page_type` (`id`, `page_type_name`) VALUES
(1, 'CBDRM'),
(2, 'Заах арга зүй'),
(3, 'Зөвлөмж'),
(4, 'Мэндчилгээ');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `username`, `password`) VALUES
(1, 'dulmaa_ontsgoi', '123'),
(3, 'dondog', '123'),
(4, 'sss', '123');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE IF NOT EXISTS `teacher_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(500) DEFAULT NULL,
  `lastname` varchar(500) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `company_name` varchar(500) DEFAULT NULL,
  `position` varchar(500) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `portrait_image` text,
  `profession` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher` (`teacher_id`),
  KEY `gender` (`gender_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`id`, `firstname`, `lastname`, `birthdate`, `gender_id`, `company_name`, `position`, `phone`, `phone2`, `email`, `teacher_id`, `portrait_image`, `profession`) VALUES
(1, 'Дуламрцэрэн', 'Баасан', '1965-03-09', 1, 'СБД 13-р хороо', 'Хэсгийн ахлагч', '95715013', '93048127', 'test@email.com', 1, NULL, 'Эмийн санч'),
(3, 'Дондогмаа', 'Цэеэнноров', '2015-03-09', 2, 'Дэлбээ', 'Захирал', '99859048', '', 'dondog@gogo.mn', 3, 'assets/img/profile/teacher/222983775_240457990.jpg', 'Эм зүйч'),
(4, 'asdasd', 'asd', '2015-03-05', 1, 'asdasd', 'asdasd', '546456', '', 'ankhaa1002@gmail.com', 4, 'assets/img/profile/teacher/25425121_188872869.jpg', 'asasd');

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
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_4` FOREIGN KEY (`teacher_info_id`) REFERENCES `teacher_info` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`aimag_id`) REFERENCES `aimag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `address_ibfk_3` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`aimag_id`) REFERENCES `aimag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`lesson_category_id`) REFERENCES `lesson_category` (`lesson_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`lesson_channel_id`) REFERENCES `lesson_channel` (`lesson_channel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_category_map`
--
ALTER TABLE `news_category_map`
  ADD CONSTRAINT `news_category_map_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `news_category_map_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `news_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`page_type_id`) REFERENCES `page_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD CONSTRAINT `teacher_info_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `teacher_info_ibfk_3` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
