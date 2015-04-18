-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2015 at 03:28 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `teacher_info_id`, `aimag_id`, `district_id`, `address_detail`) VALUES
(1, 1, 10, NULL, '25-р хороо 90-402'),
(5, 5, 22, 4, '13р хороолол 25р хороо 90-402');

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
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL,
  `site_title` varchar(1024) NOT NULL,
  `site_description` varchar(500) NOT NULL,
  `address` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `blog_per_page` varchar(255) NOT NULL,
  `lesson_per_page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `site_title`, `site_description`, `address`, `website`, `phone`, `facebook`, `twitter`, `blog_per_page`, `lesson_per_page`) VALUES
(777, 'Олон нийтэд тулгуурласан гамшгийн эрсдлийг бууруулах дэд хөтөлбөр', 'Тайлбар', 'Test Address', 'test@email.com', '99499248', 'testlink', 'testlink', '10', '10');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_name` varchar(1000) DEFAULT NULL,
  `lesson_content` text,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `lesson_category_id` int(11) NOT NULL,
  `lesson_channel_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT '1',
  `ppt_url` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lesson_lesson_category1_idx` (`lesson_category_id`),
  KEY `fk_lesson_lesson_channel1_idx` (`lesson_channel_id`),
  KEY `fk_lesson_teacher1_idx` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id`, `lesson_name`, `lesson_content`, `created_date`, `updated_date`, `is_active`, `lesson_category_id`, `lesson_channel_id`, `teacher_id`, `ppt_url`, `video_url`) VALUES
(4, 'Test 1', '<p>This is test</p>\r\n', '2015-04-01', NULL, 1, 4, 3, 1, 'assets/lib/lessons/dulmaa_ontsgoi/ppt/202500969_135246786.ppt', 'assets/lib/lessons/dulmaa_ontsgoi/video/273552480_77953475.mp4'),
(6, 'Тест хичээл', '<p>Hi there</p>\r\n', '2015-04-01', '2015-04-01', 1, 5, 2, 1, 'assets/lib/lessons/dulmaa_ontsgoi/ppt/227618629_37906703.ppt', ''),
(7, 'Test 2', '<p>asd</p>\r\n', '2015-04-01', NULL, 1, 3, 2, 1, '', ''),
(9, 'Галын аюулгүй байдал', '<p><em><strong>Гал, гал түймэр гэж юу вэ?</strong></em></p>\r\n\r\n<p>Гал нь шатах материал болон бодис, дулааны эх үүсвэр (шүдэнз, лаа, цахилгаан, химийн урвал гэх мэт), хүчилтөрөгч (агаар) гурвын харилцан үйлчлэлээр бий болдог, гэрэл, дулаан ялгаруулдаг физик, химийн үзэгдэл юм. Гал үүсгэгч дээрх гурван хүчин зүйлийг галын гурвалжин гэх бөгөөд эдгээрийн аль нэгийг тусгаарласан тохиолдолд гал асах, шаталт үүсэх үйл явц болохгүй. Гал үүсэх гурван нөхцөл бүрдсэнээс гал гарч, гал түймрийн дөрөв дэхь хүчин зүйл буюу цаашид дамжин шатах эд зүйл, бодис материал байгаа тохиолдолд ассан гал нь гал түймэр болон өргөжин дэлгэрдэг. Гал үүсч болох бодис, материал, эд зүйлс:</p>\r\n\r\n<p>- Хатуу биет (мод, цаас, картон, даавуу, пластик материал гэх мэт)</p>\r\n\r\n<p>- Шингэн буюу шингэн хэлбэрт шилжих бодисууд (бензин, тос, тосол, керосин, полиетлин, &nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp; полестрин гэх мэт)</p>\r\n\r\n<p>- Хий (бутан, пропан, хөнгөн цагаан, магни гэх мэт)</p>\r\n\r\n<p>Галын ангилал нь шатах бодис, материалын төлөв байдлаас шалтгаална. Галыг A, B, C, D ангилалд хуваан авч үздэг. А ангилалд хатуу бодисын гал, B ангилалд шингэн бодисын гал, C ангилалд хийн гал, D ангилалд металлын гал ордог байна. Галын ангиллыг тогтоосноор ямар арга хэрэгслээр аль ангиллын галыг унтрааж болохыг тэмдэглэн үзүүлж, гал унтраах ажлыг хөнгөвчлөх ач холбогдолтой. Галын аюултай бүтээгдэхүүн гэж галын аюулын ангилал, зэрэглэлийн дагуу гал асаах эх үүсвэрээс дөллөж авалцан асах буюу уугин асах бүтээгдэхүүнийг хэлнэ.</p>\r\n\r\n<p><strong><em>Гал түймрээс урьдчилан сэргийлэх</em></strong></p>\r\n\r\n<p>Галын гурвалжингийн тухай мэдлэгтэй байгаа тохиолдолд гал үүсгэгч гурван хүчин зүйлийн нэгийг нь тусгаарлаж чадаж байхад гал гарахгүй байх нөхцлийг бүрдүүлж чадна. Гал түймрийн ихэнх тохиолдол нь хүний санамсар болгоомжгүй үйлдлээс болж гардаг. Мөн аянга, газар хөдлөлт, хуурайшилт зэрэг байгалийн үзэгдлээс гал түймэр үүсэх тохиолдол байдаг ч харьцангуй бага байдаг. Аливаа гамшгаас урьдчилан сэргийлэх гол аргуудын нэг нь эрсдэл гарч болохуйц орчинд ажиллаж байгаа хүмүүсийг мэдээллээр хангах явдал юм. Тухайлбал, гал гарсан тохиолдолд тухайн гал ямар бодис материалд, хаана гарч байгаа, түүнээс үүдэн гарч болох үр дагавар, учирч болзошгүй хохирлын талаар дүн шинжилгээ хийн урьдчилсан дүгнэлт гарган мэдээлнэ.</p>\r\n\r\n<p><strong><em>Галын дохиоллын систем гэж юу вэ?</em></strong></p>\r\n\r\n<p>Болзошгүй гал түймрийн аюулыг түргэн шуурхай мэдээлж, хүний амь нас, эд хөрөнгийг хамгаалах зориулалт бүхий дохиоллын систем нь барилга байгууламжийн хэмжээ, зориулалтаас хамааран утсан холбоогоор ажилладаг галын мэдээлэгч, зайгаар ажилладаг мэдээлэгч гэж ангилагдана. Галын дохиолол нь утаа болон дулааны эх үүсвэрээс мэдээлдэг ялгаатай. Утааны мэдрэгч нь болзошгүй аюулыг мэдээлж, арга хэмжээ авах боломжийг илүүтэй олгодог учир гэр, орон сууцанд сонгож хэрэглэх нь зүйтэй. Барилга, байгууламж тоноглох галын дохиоллыг барилгын норм, дүрмийн (БНбД-21-0405) шаардлагаар сонгох хэрэгтэй.</p>\r\n\r\n<p>- Утаа гармагц шууд дээш тархдаг учир утааны дохиоллыг гэрийн тооно, баганын ойролцоо, аль болох өндөр цэгт байрлуулах</p>\r\n\r\n<p>- Дохиоллын дуут дохиог ямар ч нөхцөлд сонсогдохуйцаар хангалттай чанга дуугарахаар тохируулах</p>\r\n\r\n<p>- Зайгаар ажилладаг дохиоллын зайг тогтмол шалгаж, сольж, цэвэрлэж, шаардлагатай бусад үйлчилгээг хийлгэж, ашиглалтын бэлэн байдалд байлгаж занших</p>\r\n\r\n<p><strong>Дулаан мэдрэгч&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Утаа мэдрэгч</strong></p>\r\n\r\n<p><strong><img src="http://www.dsedn.mn/images/dsedn/hudulmur-hamgaalal/gal/pic%201.png" style="border:0px; height:237px; margin:0px; padding:0px; width:230px" /><img src="http://www.dsedn.mn/images/dsedn/hudulmur-hamgaalal/gal/pic%202.png" style="border:0px; height:237px; margin:0px; padding:0px; width:230px" /></strong></p>\r\n\r\n<p><strong><em>&nbsp;</em></strong></p>\r\n\r\n<p><strong><em>Цахилгаан хэрэгслийн галын аюулгүй байдлыг хангах:</em></strong></p>\r\n\r\n<ul>\r\n	<li>&nbsp;Цахилгаан хэрэгслийн ачааллыг тохируулж, цахилгааны утас халсан эсэхийг тогтмол шалгаж&nbsp; байх;</li>\r\n	<li>Цахилгаан хэрэгслийг анх худалдаж авахдаа бүрэн бүтэн байдал, чанарын шаардлага хангах эсэхийг сайтар нягтлах;</li>\r\n	<li>Олон оролттой залгуурын ачааллыг хэтрүүлэхгүй байж, гал гарахаас сэргийлэх;</li>\r\n	<li>&nbsp;Залгуур бүрийн цахилгааны чадал/ампер янз бүр байдгийг анхаарахад илүүдэхгүй;</li>\r\n	<li>&nbsp;Залгуурын чадлын дээд хязгаарыг хэтрүүлэхгүй байх;</li>\r\n	<li>Цахилгаан хэрэгслийн залгуур гэмтсэн, шалбарсан эсэхийг шалгаж, засварлах, ялангуяа тавилга,&nbsp;&nbsp; хивс зэргийг дор орж халхлагдсан бол тогтмол шалгаж байх;</li>\r\n	<li>&nbsp;Цахилгаан хэрэгслийг тогноос салгах нь гал гарах эрсдэлийг бууруулна, ялангуяа хэрэглээгүй&nbsp; болон унтахдаа заавал салгах нь зүйтэй;</li>\r\n	<li>Цахилгаан халаагуурыг хөшигнөөс зайтай байрлуулах, хувцас хатаах зорилгоор ашиглахгүй байх;</li>\r\n</ul>\r\n\r\n<p><strong><em>Өмсөж байгаа хувцас чинь шатвал яах вэ?</em></strong></p>\r\n\r\n<ul>\r\n	<li>&nbsp;Гүйж болохгүй, гүйвэл гал улам асах болно;</li>\r\n	<li>&nbsp;Газар хэвтээд, өнхөрөх нь гал нэмж асахыг багасгана;</li>\r\n	<li>&nbsp;Хөнжил, зузаан материалтай цув зэргийг нөмөргөж, галыг унтраах&nbsp; арга хэмжээ&nbsp; авах;</li>\r\n	<li>ЗОГС, ХЭВТ, ӨНХӨР командыг биелүүл!!!</li>\r\n</ul>\r\n\r\n<p style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ГАЛЫН АЮУЛААС ҮҮДЭЛТЭЙ БЭРТЭЛ, ГЭМТЛҮҮД,ТЭДГЭЭРИЙН ШИНЖ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n\r\n<p style="text-align:center">ЧАНАР, АНХНЫ ТУСЛАМЖИЙН АРГА ХЭМЖЭЭ</p>\r\n\r\n<p><strong><em>Нэг. Түлэгдэлт</em></strong></p>\r\n\r\n<p>Галын дөл, хэт халуун шингэн, халуун уур, химийн бодис, цахилгаан гүйдэл, цацраг туяа гэх мэт хүчин зүйлийн нөлөөллөөр арьс болон арьсан доорх өөхөн эд, эрхтэн гэмтэхийг түлэгдэлт гэнэ. Шалтгаанаар нь ангилж үзвэл:</p>\r\n\r\n<ol>\r\n	<li>Дулааны (халуун шингэн, улайссан хатуу биет, галын дөл, халуун уур гэх мэт)</li>\r\n	<li>Химийн (хүчил, шүлт, хүнд металл гэх мэт)</li>\r\n	<li>Туяаны (хэт ягаан туяа, рентген туяа, атомын цацраг туяа гэх мэт)</li>\r\n	<li>Цахилгааны (аянга, цахилгаан гүйдэл)</li>\r\n	<li>Холимог</li>\r\n</ol>\r\n\r\n<p>Дулааны түлэгдлийг гүнээр нь үндсэн 4 зэрэгт хуваадаг.</p>\r\n\r\n<p>I зэрэг. Арьс тод улаан өнгөтэй болж хавдана.</p>\r\n\r\n<p>II зэрэг. Тунгалаг, цайвар шаравтар шингэн бүхий цэврүү үүснэ.</p>\r\n\r\n<p>III зэрэг. Арьсны өнгөн давхарга бүхэлдээ үхэжсэн байна. Арьсны бүх давхарга гэмтэж үхэжсэн байна.</p>\r\n\r\n<p>IV зэрэг. Хальс, өөхлөг шөрмөс, булчин, ясаа хүртэл гэмтэж үхжинэ.</p>\r\n\r\n<p><strong><em>Түлэгдэлтийн аюултай эсэх нь:</em></strong></p>\r\n\r\n<ul>\r\n	<li>Түлэгдэлт юунаас болж үүсэв (галын дөл үү, химийн бодис уу гэх мэт)</li>\r\n	<li>Хаана түлэгдсэн (толгойд уу, хөлд үү гэх мэт)</li>\r\n	<li>Хэр талбай хамарсан</li>\r\n	<li>Түлэгдсэн хүний нас (хүүхэд үү, том хүн үү)</li>\r\n	<li>Түлэгдсэн хүний эрүүл мэндийн байдал (хэвтрийн хүн үү, архаг өвчтэй хүн үү)&nbsp; зэргээс &nbsp;&nbsp;&nbsp;хамаарна.</li>\r\n</ul>\r\n\r\n<p>Түлэгдэлт нь хэр зэрэг талбайг хамарснаас шалтгаалж 9-ийн тооны дүрмийг баримтална. 9 тооны дүрэм гэдэг нь насанд хүрсэн хүний гарын алгыг 1% гэж үзээд түлэгдэлтийн хэмжээг тогтоохыг хэлнэ. Насанд хүрсэн хүн 25-30%, хүүхэд 10-15% түлэгдсэн тохиолдолд шоконд орох эрсдэлтэй.</p>\r\n\r\n<p><strong>&nbsp; Шинж тэмдэг</strong></p>\r\n\r\n<p>Түлэгдэлтийн үед арьсан дээр илрэх дээрх өөрчлөлтүүдээс гадна их хэмжээний талбайг хамарсан тохиолдолд дараах шинж тэмдгүүд илэрнэ.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Судасны лугшилт олширно. (1 минутанд 80-аас дээш)</li>\r\n	<li>Амьсгал олширно. (1 минутанд 20-оос дээш)</li>\r\n	<li>Арьсны өнгө цайж, ам хамрын гурвалжин хөхөрнө.</li>\r\n	<li>&nbsp;Толгой эргэнэ.</li>\r\n	<li>Дотор муухайрна.</li>\r\n	<li>Огиулна.</li>\r\n	<li>Бөөлжинө.</li>\r\n	<li>Ам хатна.</li>\r\n	<li>Ухаан санаа өөрчлөгдөнө.</li>\r\n</ul>\r\n\r\n<p>Түлэнхий өвчнийг эмнэлзүйн шинжээр нь дараах 4 үе болгож үзнэ:</p>\r\n\r\n<ol>\r\n	<li>Түлэнхийн шок &ndash; цусны бичил эргэлтэнд өөрчлөлт гарна. Шээсний хэмжээ багасна. (1-3 хоног)</li>\r\n	<li>Хурц хордлогын үе &ndash; цусны эргэлтийн үйл ажиллагаа сайжрахын хамт нөгөө талаас цусанд хорт бүтээгдэхүүн орж, хордлого үүсгэнэ. Уураг, хлор багасч, шингэн их алдана. (3-14 хоног)</li>\r\n	<li>Халдвар хордлогын үе &ndash; түлэгдэлтийн 7-10 дахь хоногуудад түлэгдлийн гэмтсэн арьсны өнгөн үхэжсэн хэсэг унаж, шарх ил болно. (14-с дээш хоног)</li>\r\n	<li>Эдгэрэх үе &ndash; эмчилгээний үр дүнгээс хамаарна. Эхний 3 үеийн туршид гарсан өөрчлөлтүүд аажмаар сэргэнэ. Хүнд тохиолдолд (2-4 жил)</li>\r\n</ol>\r\n\r\n<p><strong><em>Түлэгдэлтийн үед үзүүлэх анхны тусламж</em></strong></p>\r\n\r\n<p>Аль ч хэлбэрийн түлэгдэлтийн үед анхны тусламжийн зарчим нь:</p>\r\n\r\n<ul>\r\n	<li>Хамгийн эхэнд тусламж үзүүлж буй хүн өөрийн аюулгүй байдлыг хангасан байх</li>\r\n	<li>&nbsp;Голомтоос холдуулах, түлж байгаа зүйлийг биеэс зайлуулна.</li>\r\n	<li>&nbsp;Урсгал хүйтэн усаар 10-25 минут угаах, химийн түлэгдлийн үед 20-30 минут тасралтгүй усаар угаана.</li>\r\n	<li>&nbsp;Нүдэнд орсон бол эрүүл нүд дээр байрлахаар угаана.</li>\r\n	<li>&nbsp;Цэвэр боолт хийнэ.</li>\r\n	<li>&nbsp;Бие барьсан хувцас, эд зүйлсийг яаралтай тайлж авна (бөгж, цаг, бүс гэх мэт)</li>\r\n	<li>Өвдөлт намдаах эм тариа хийж болно. (Анальгин, арьсан доор 2%- ийн промедолын&nbsp;&nbsp; уусмал 1 мл тарина)</li>\r\n	<li>Эмнэлгийн байгууллагад яаралтай хандана.</li>\r\n</ul>\r\n\r\n<p><strong><em>Хориглох зүйл</em></strong></p>\r\n\r\n<ol>\r\n	<li>&nbsp;Түлэгдсэн хэсэг дээр цас, мөс тавих</li>\r\n	<li>&nbsp;Түлэгдсэн хэсэгт үүссэн цэврүүг хагалах</li>\r\n	<li>&nbsp;Түлэгдсэн хэсэгт наалдсан хувцсыг хуулах</li>\r\n	<li>&nbsp;Түлэгдсэн хэсэг дээр хөвөн материал тавих</li>\r\n</ol>\r\n\r\n<p><strong><em>Түлэнхийн боолт:</em></strong></p>\r\n\r\n<ul>\r\n	<li>Химидин 0,5%</li>\r\n	<li>Тамедин 0,75%</li>\r\n	<li>Фурациллин 1: 5000</li>\r\n	<li>&nbsp;Панкипсины тос</li>\r\n	<li>Анестезинтэй тос</li>\r\n	<li>Чацаргананы цэвэр тос, вазелин, антибиотикийн холимог ариутгасан тос</li>\r\n	<li>&nbsp;Мөнгөжүүлсэн тос</li>\r\n	<li>&nbsp;Фламмазин</li>\r\n</ul>\r\n\r\n<p><strong><em>Хоёр. Угаартах</em></strong></p>\r\n\r\n<p>Гал түймрээс үүссэн утаа, хорт хийнд хүний амьсгал боогдох, амьсгал боломжгүй болох, улмаар үхлийн аюулд хүргэх ч эрсдэлтэй. Утаа, хийгээр амьсгалсан хүн угаартаж, хорддог. Угаартах үеийн шинж тэмдэг:</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Толгой эргэх, өвдөх</li>\r\n	<li>&nbsp;Бие сулрах, чих шуугих</li>\r\n	<li>&nbsp;Бөөлжих</li>\r\n	<li>Амьсгал боогдох, ухаан алдах гэх мэт.</li>\r\n</ul>\r\n\r\n<p>Эдгээр шинж тэмдэг илрэхэд өвчтөнд яаралтай тусламж үзүүлэхгүй бол амь насанд аюултай. Ахуйн хэрэглээнд элбэг байх болсон баллонтой хийг ашиглах, хадгалах дүрмийг баримтлаагүйгээс хийнд хордох явдал их гардаг байна. Хий нь өнгө, үнэргүй учир алдагдаж байгаа нь төдийлөн мэдэгддэггүй. Иймд хийн алдагдлыг хэмжих багажийг суурилуулах нь зүйтэй.</p>\r\n\r\n<p><strong><em>Угаартсан хүнд анхны тусламж үзүүлэхдээ:</em></strong></p>\r\n\r\n<ul>\r\n	<li>&nbsp;Утаа, хий бүхий өрөө тасалгаа, орчноос угаартсан хүнийг яаралтай гаргах</li>\r\n	<li>Хордсон өрөө тасалгаа, орчны цонх, хаалгыг онгойлгож, цэвэр агаар оруулах</li>\r\n	<li>&nbsp;Угаартсан хүнд тайвшруулах эм уулгах (валерин гэх мэт)</li>\r\n	<li>&nbsp;Угаартсан хүн ухаан алдсан болон амьсгалахад хүндрэлтэй байвал яаралтай&nbsp; эмнэлгийн тусламж дуудах, эмчийг иртэл нь өвчтөнд хиймэл амьсгал хийх</li>\r\n	<li>&nbsp;Ахуйн хийнд хордож угаартсан хүнд тусламж үзүүлэхдээ хувцасны товчийг тайлж амьсгалах замыг чөлөөлөх, толгойд нь хүйтэн жин тавих, спирт үнэртүүлэх, цээжин иллэг хийх<strong>,</strong>&nbsp;хөлийг цээжнээс өндөр түвшинд хэвтүүлэх арга хэмжээ авна</li>\r\n	<li>Өвчтөний амьсгал удааширах, тасалдах (минутанд 8-аас доош удаа амьсгалах) үед яаралтай хиймэл амьсгал хийх шаардлагатай.</li>\r\n</ul>\r\n', '2015-04-02', '2015-04-02', 1, 1, 1, 5, 'assets/lib/lessons/ankhaa1002/ppt/238726018_24620120.ppt', 'assets/lib/lessons/ankhaa1002/video/113910191_33483263.mp4'),
(10, 'Газар хөдлөлт гэж юу вэ?', '<p><strong>Газар хөдлөлт</strong>&nbsp;гэдэг нь&nbsp;<a href="https://mn.wikipedia.org/wiki/%D0%94%D1%8D%D0%BB%D1%85%D0%B8%D0%B9%D0%BD_%D1%86%D0%B0%D1%80%D1%86%D0%B4%D0%B0%D1%81" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Дэлхийн царцдас">газрын царцдасаас</a>&nbsp;<a href="https://mn.wikipedia.org/wiki/%D0%AD%D0%BD%D0%B5%D1%80%D0%B3%D0%B8" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Энерги">энерги</a>&nbsp;чөлөөлөгдөн,&nbsp;<a class="new" href="https://mn.wikipedia.org/w/index.php?title=%D0%A1%D0%B5%D0%B9%D1%81%D0%BC%D0%B8%D0%B9%D0%BD_%D0%B4%D0%BE%D0%BB%D0%B3%D0%B8%D0%BE%D0%BD&amp;action=edit&amp;redlink=1" style="text-decoration: none; color: rgb(165, 88, 88); background: none;" title="Сейсмийн долгион (ийм хуудас байхгүй)">сейсмийн долгион</a>&nbsp;үүсгэхийг хэлнэ. Үүссэн долгионыг сейсмометрээр тэмдэглэж авах ба газар хөдлөлтийн хүчийг&nbsp;<a class="new" href="https://mn.wikipedia.org/w/index.php?title=%D0%9C%D0%BE%D0%BC%D0%B5%D0%BD%D1%82_%D0%BC%D0%B0%D0%B3%D0%BD%D0%B5%D1%82%D1%83%D0%B4_%D1%88%D0%B0%D1%82%D0%BB%D0%B0%D0%BB&amp;action=edit&amp;redlink=1" style="text-decoration: none; color: rgb(165, 88, 88); background: none;" title="Момент магнетуд шатлал (ийм хуудас байхгүй)">момент магнетудаар</a>, эсвэл&nbsp;<a href="https://mn.wikipedia.org/wiki/%D0%A0%D0%B8%D1%85%D1%82%D0%B5%D1%80%D0%B8%D0%B9%D0%BD_%D1%88%D0%B0%D1%82%D0%B0%D0%BB%D0%B1%D0%B0%D1%80" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Рихтерийн шаталбар">Рихтерийн шаталбараар</a>&nbsp;хэмжинэ. Рихтерийн шатлалыг сүүлийн үед өргөн хэрэглэхгүй байгаа болно. Рихтерийн шаталбараар 3-с бага магнитуд бүхий газар хөдлөлт хүнд онцгой мэдрэгдэхгүй, харин магнитуд 7, түүнээс дээш болох үед том талбай хамарсан сүйрэл болно.</p>\r\n\r\n<p>Газар хөдлөлтөөр газрын гадаргуу чичирч, заримдаа эвдрэлд орно. Газар хөдлөлтөөр хөрсний гулсалт үүсэж, галт уул идэвхижиж болно. Томоохон газар хөдлөлт далайд тохиолдвол&nbsp;<a href="https://mn.wikipedia.org/wiki/%D0%A6%D1%83%D0%BD%D0%B0%D0%BC%D0%B8" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Цунами">цунами</a>&nbsp;үүснэ.</p>\r\n\r\n<p>Ерөнхий тохиолдолд&nbsp;<em>газар хөдлөлт</em>&nbsp;гэдэг ойлголтод байгалийн болон хүний нөлөөгөөр үүсэх бүх төрлийн чичирхийлэлийг багтааж байна. Газар хөдлөлт нь&nbsp;<a href="https://mn.wikipedia.org/wiki/%D0%94%D1%8D%D0%BB%D1%85%D0%B8%D0%B9%D0%BD_%D1%86%D0%B0%D1%80%D1%86%D0%B4%D0%B0%D1%81" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Дэлхийн царцдас">царцдаст</a>&nbsp;үүсэх&nbsp;<a class="new" href="https://mn.wikipedia.org/w/index.php?title=%D0%A5%D0%B0%D0%B3%D0%B0%D1%80%D0%B0%D0%BB&amp;action=edit&amp;redlink=1" style="text-decoration: none; color: rgb(165, 88, 88); background: none;" title="Хагарал (ийм хуудас байхгүй)">хагарал</a>, ихээхэн хэмжээний хийн ихэвчлэн (газрын гүн дэх&nbsp;<a href="https://mn.wikipedia.org/wiki/%D0%9D%D2%AF%D2%AF%D1%80%D1%81%D1%83%D1%81%D1%82%D3%A9%D1%80%D3%A9%D0%B3%D1%87" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Нүүрсустөрөгч">метан</a>) шилжилт,&nbsp;<a href="https://mn.wikipedia.org/wiki/%D0%93%D0%B0%D0%BB%D1%82_%D1%83%D1%83%D0%BB" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Галт уул">галт уулын</a>&nbsp;үйл ажиллагааны идэвхижилт,&nbsp;<a href="https://mn.wikipedia.org/wiki/%D0%A5%D3%A9%D1%80%D1%81%D0%BD%D0%B8%D0%B9_%D0%B3%D1%83%D0%BB%D1%81%D0%B0%D0%BB%D1%82" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Хөрсний гулсалт">хөрсний гулсалт</a>,&nbsp;<a class="new" href="https://mn.wikipedia.org/w/index.php?title=%D0%9C%D0%B8%D0%BD%D0%B0&amp;action=edit&amp;redlink=1" style="text-decoration: none; color: rgb(165, 88, 88); background: none;" title="Мина (ийм хуудас байхгүй)">минаны</a>&nbsp;тэсрэлт,&nbsp;<a class="new" href="https://mn.wikipedia.org/w/index.php?title=%D0%A6%D3%A9%D0%BC%D0%B8%D0%B9%D0%BD_%D0%B1%D3%A9%D0%BC%D0%B1%D3%A9%D0%B3&amp;action=edit&amp;redlink=1" style="text-decoration: none; color: rgb(165, 88, 88); background: none;" title="Цөмийн бөмбөг (ийм хуудас байхгүй)">цөмийн бөмбөгийн</a>&nbsp;туршилт зэргээр үүснэ.</p>\r\n\r\n<p>Газар хөдлөлт үүсэж байгаа голомтыг&nbsp;<strong><a class="new" href="https://mn.wikipedia.org/w/index.php?title=%D0%93%D0%B8%D0%BF%D0%BE%D1%86%D0%B5%D0%BD%D1%82%D1%80&amp;action=edit&amp;redlink=1" style="text-decoration: none; color: rgb(165, 88, 88); background: none;" title="Гипоцентр (ийм хуудас байхгүй)">гипоцентр</a></strong>&nbsp;буюу фокус гэх ба гипоцентрын эгц дээр, газрын гадаргуу дээхи цэгийг&nbsp;<strong><a class="new" href="https://mn.wikipedia.org/w/index.php?title=%D0%AD%D0%BF%D0%B8%D1%86%D0%B5%D0%BD%D1%82%D1%80&amp;action=edit&amp;redlink=1" style="text-decoration: none; color: rgb(165, 88, 88); background: none;" title="Эпицентр (ийм хуудас байхгүй)">эпицентр</a></strong>&nbsp;гэнэ.</p>\r\n\r\n<p>Тектоник гаралтай газар хөдлөлт дэлхий дээр хаа сайгүй тохиолдоно. Дэлхийн гүн дэх чулуулаг агшилт, суналтанд орох үед үүссэн энерги, тухайн чулуулаг тасарч эвдрэх үед хагаралын хавтгайн дагуу чөлөөлөгдөх үзэгдэлтэй холбоотойгоор газар хөдлөлт үүснэ.</p>\r\n\r\n<p>Плитийн&nbsp;<a class="mw-redirect" href="https://mn.wikipedia.org/wiki/%D0%9F%D0%BB%D0%B8%D1%82_%D1%82%D0%B5%D0%BA%D1%82%D0%BE%D0%BD%D0%B8%D0%BA#.D0.9F.D0.BB.D0.B8.D1.82.D0.B8.D0.B9.D0.BD_.D1.85.D0.B8.D0.BB_.D0.B7.D0.B0.D0.B0.D0.B3.D0.B8.D0.B9.D0.BD_.D1.82.D3.A9.D1.80.D3.A9.D0.BB" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Плит тектоник">трансформ</a>&nbsp;ба&nbsp;<a class="mw-redirect" href="https://mn.wikipedia.org/wiki/%D0%9F%D0%BB%D0%B8%D1%82_%D1%82%D0%B5%D0%BA%D1%82%D0%BE%D0%BD%D0%B8%D0%BA#.D0.9F.D0.BB.D0.B8.D1.82.D0.B8.D0.B9.D0.BD_.D1.85.D0.B8.D0.BB_.D0.B7.D0.B0.D0.B0.D0.B3.D0.B8.D0.B9.D0.BD_.D1.82.D3.A9.D1.80.D3.A9.D0.BB" style="text-decoration: none; color: rgb(11, 0, 128); background: none;" title="Плит тектоник">конвергент заагуудын</a>&nbsp;нь газрын гадаргууд, маш том хагарлын дагуу байрлах ба плитүүд энэ заагийн дагуу хөдөлж байдаг. Хагаралын дагуу уг хөдөлгөөнд ямар нэг өөрчлөлт орж, хөдөлгөөн зогсоход плитийн түлхэх хүчнээс ихээхэн энерги, тухайн хөдлөхөө болисон плитийн зааг, хагарал орчимд хуримтлагдана. Хуримтлагдаж буй энерги саадыг эвдэх хэмжээнд хүртэл энэ зогсонги байдал үргэлжлэх ба энерги хязгаараас давахад хөдөлгөөн огцом хөдлөхөд хуримтлагдсан энерги чөлөөлөгдөн газар хөдлөлт үүснэ.</p>\r\n\r\n<p>Хуримтлагдсан нийт энергийн зөвхөн 10% нь сейсмийн долгион буюу чичирхийлэл үүсгэдэг бөгөөд дийлэнхи нь хагарал үүсгэх, хагаралын дагуу үрэлтийн дулаан болон хувирдаг байна.</p>\r\n', '2015-04-02', NULL, 1, 1, 2, 5, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_category`
--

CREATE TABLE IF NOT EXISTS `lesson_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lesson_category`
--

INSERT INTO `lesson_category` (`id`, `name`, `is_active`) VALUES
(1, 'Урьдчилан сэргийлэх', 1),
(3, 'Хариу арга хэмжээ', 1),
(4, 'Сэргээн босгох', 1),
(5, 'Хор уршгийг арилгах', 1),
(7, 'Бэлэн байдлыг хангах', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_channel`
--

CREATE TABLE IF NOT EXISTS `lesson_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lesson_channel`
--

INSERT INTO `lesson_channel` (`id`, `name`, `is_active`) VALUES
(1, 'Гал түймэр', 1),
(2, 'Газар хөдлөлт', 1),
(3, 'Халдварт өвчин', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_log`
--

CREATE TABLE IF NOT EXISTS `lesson_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` varchar(45) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson` (`lesson_id`),
  KEY `teacher` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `lesson_log`
--

INSERT INTO `lesson_log` (`id`, `created_date`, `lesson_id`, `teacher_id`, `action`) VALUES
(1, '2015-03-31 05:04:21', 4, 1, 'үүсгэсэн'),
(3, '2015-03-31 07:03:19', 4, 1, 'засварласан'),
(4, '2015-03-31 07:04:27', 4, 1, 'засварласан'),
(5, '2015-03-31 07:53:23', 6, 1, 'үүсгэсэн'),
(6, '2015-03-31 07:53:44', 6, 1, 'засварласан'),
(7, '2015-04-01 07:41:11', 4, 1, 'засварласан'),
(8, '2015-04-01 07:41:46', 7, 1, 'үүсгэсэн'),
(9, '2015-04-01 08:29:33', 6, 1, 'засварласан'),
(11, '2015-04-01 09:31:48', 6, 1, 'засварласан'),
(12, '2015-04-01 09:31:48', 6, 1, 'засварласан'),
(13, '2015-04-02 04:07:57', 9, 5, 'үүсгэсэн'),
(14, '2015-04-02 04:16:25', 9, 5, 'засварласан'),
(15, '2015-04-02 04:19:33', 10, 5, 'үүсгэсэн');

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
(43, 'Хамтран ажиллах санамж бичигт гарын үсэг зурлаа', '<p>Онцгой байдлын асуудал эрхэлсэн байгууллагад олон улсын стандартад нийцсэн чадвартай боловсон хүчнийг бэлтгэх, эрдэмтэн, багш нарын мэргэжлийн ур чадварыг дээшлүүлэх, ажиллах, суралцах таатай орчныг бүрдүүлэх, хамтран ажиллагааг өргөжүүлэх зорилгоор Онцгой байдлын ерөнхий газрын дарга, бригадын генерал Т.Бадрал, Хууль сахиулахын их сургуулийн захирал, тэргүүн комиссар С.Баатаржав нар хамтран ажиллах санамж бичигт өнөөдөр гарын үсэг зурав.</p>\r\n\r\n<p>Уулзалтын үеэр хоёр тал Хууль сахиулах их сургуулийн Онцгой байдлын&nbsp; сургуулийн сургалтын хөтөлбөрт гамшгаас хамгаалах, гал түймэртэй тэмцэх мэргэжлийн хичээлийг түлхүү оруулах шаардлагатай байгаа, санал хүргүүлсэн боловсон хүчнийг томилуулж ажиллуулах, сонсогч, оюутан суралцагчдыг аврах, гал унтраах техникийн дадлага эзэмшүүлэх дадлагыг аврах, гал унтраах анги түшиглэн явуулах, клиник сургалтын төвтэй болгох, шинээр тэнхим байгуулах, сургалтын техник, тоног төхөөрөмжөөр ханган дэмжлэг үзүүлэхэд хамтран ажиллах талаар санал солилцож, тохиролцлоо.</p>\r\n\r\n<p>Мөн гамшиг судлал, судалгаа, эрдэм шинжилгээний ажлын үр нөлөөг дээшлүүлэх, сургалтын үйл ажиллагааг олон улсын жишигт хүргэх, багш, албан хаагчдын мэргэжлийн мэдлэг, ур чадварыг сайжруулах, ОХУ-ын Иргэний хамгаалалтын болон Гал эсэргүүцэх академи хооронд оюутан солилцох зэрэг асуудлаар ярилцсан.</p>\r\n\r\n<p>Онцгой байдлын ерөнхий газрын дарга, бригадын генерал Т.Бадрал, Хууль сахиулах их сургуулийн дэргэд гамшгаас хамгаалах, аврах, гал унтраах мэргэжлийн клиник сургалтын төв байгуулах, сургалтын төвийг автомашин, техник хэрэгслээр хангахад анхааран ажиллахаа хэллээ.</p>\r\n\r\n<p>Онцгой байдлын ерөнхий газраас Хууль сахиулах их сургуулийн Онцгой байдлын сургуулийн &nbsp;материаллаг баазыг бэхжүүлэх, сургалтын материал, багаж хэрэгслээр хангахад 340 гаруй сая төгрөгийн хөрөнгө оруулалтыг энэ хугацаанд хийжээ.<a href="http://nema.gov.mn/wp-content/uploads/2015/04/9X1A4664.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="9X1A4664" class="alignnone size-full wp-image-4844" src="http://nema.gov.mn/wp-content/uploads/2015/04/9X1A4664.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:5760px" /></a>&nbsp;<a href="http://nema.gov.mn/wp-content/uploads/2015/04/9X1A4650.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="9X1A4650" class="alignnone size-full wp-image-4847" src="http://nema.gov.mn/wp-content/uploads/2015/04/9X1A4650.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:5760px" /></a><a href="http://nema.gov.mn/wp-content/uploads/2015/04/9X1A4661.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="9X1A4661" class="alignnone size-full wp-image-4843" src="http://nema.gov.mn/wp-content/uploads/2015/04/9X1A4661.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:5760px" /></a></p>\r\n', '2015-03-01', '2015-04-08', 1, 1, 'assets/img/post/featured_image/235562933_200248592.jpg'),
(46, 'Иж бүрэн дадлага сургуулийг зохион байгууллаа', '<p>Онцгой байдлын ерөнхий газрын харъяа Аврах тусгай ангийн Тусгай чиг үүргийн салбар Хан-Уул дүүргийн Аврах гал унтраах 14-р анги, ДЦС-3-ын цагдаагийн тасагтай хамтран гамшгаас хамгаалах иж бүрэн сургуулийг зохион байгууллаа.</p>\r\n\r\n<p>Аврах, гал унтраах хэсэг, инженер, техникийн ажилчид усан хөшиг татах, тандалт явуулах, хорт бодисын алдаглыг таслан зогсоох ажиллагаанд хамтан оролцож, эмнэлэг, мэргэжлийн хяналтын байгууллагууд тус тусын чиг үүргээр сургуульд оролцлоо.</p>\r\n\r\n<p>&ldquo;Иж бүрэн сургууль&rdquo;-иар Болзошгүй гамшгийн аюулаас хүний амь нас, эрүүл мэнд, эд хөрөнгө, мал амьтныг хамгаалах, хүч хэрэгслийн харилцан ажиллагааг зохион байгуулах, Онцгой комисс, гамшгаас хамгаалах албад, мэргэжлийн анги, ард иргэдийг гамшгийн аюулаас хамгаалах арга ажиллагаанд сурган дадлагажуулахад чиглэгдсэн үр дүнтэй сургалт боллоо.<a href="http://nema.gov.mn/wp-content/uploads/2015/03/zur1.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="zur1" class="alignnone size-full wp-image-4740" src="http://nema.gov.mn/wp-content/uploads/2015/03/zur1.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:1430px" /></a><a href="http://nema.gov.mn/wp-content/uploads/2015/03/zur3.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="zur3" class="alignnone size-full wp-image-4742" src="http://nema.gov.mn/wp-content/uploads/2015/03/zur3.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:1430px" /></a><a href="http://nema.gov.mn/wp-content/uploads/2015/03/zur4.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="zur4" class="alignnone size-full wp-image-4743" src="http://nema.gov.mn/wp-content/uploads/2015/03/zur4.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:1430px" /></a><a href="http://nema.gov.mn/wp-content/uploads/2015/03/zur5.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="zur5" class="alignnone size-full wp-image-4744" src="http://nema.gov.mn/wp-content/uploads/2015/03/zur5.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:1430px" /></a><a href="http://nema.gov.mn/wp-content/uploads/2015/03/zur6.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="zur6" class="alignnone size-full wp-image-4745" src="http://nema.gov.mn/wp-content/uploads/2015/03/zur6.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:1430px" /></a></p>\r\n', '2015-03-06', '2015-04-08', 1, 1, 'assets/img/post/featured_image/95614712_145874427.jpg'),
(47, 'Гал унтраах техникийн олон төрөлт спортын Монгол Улсын шигшээ баг байгуулагдлаа', '<p>Онцгой байдлын ерөнхий газрын&nbsp; дарга бригадын генерал Т.Бадралын 2015 оны 02 дугаар сарын 19-ний өдрийн&nbsp; &ldquo;Шигшээ баг байгуулах тухай&rdquo;&nbsp; А/43 тоот тушаалаар&nbsp; 2015 оны Дэлхийн аварга шалгаруулах Гал унтраах техникийн олон төрөлт спортын тэмцээнд Монгол Улсаа төлөөлөн оролцох баг тамирчдын нэрс тодорсон билээ. Энэ жилийн дэлхийн аварга шалгаруулах XI удаагийн тэмцээн нь&nbsp; ОХУ-ын &ldquo;Санктпетербург&rdquo; хотноо явагдах бөгөөд уг тэмцээнд манай улсаас 8 тамирчин багийн ахлах дасгалжуулагчийн хамт оролцох болсон байна. 2013, 2014 онуудад зохион байгуулагдсан ГУТОТС-ын дэлхийн аварга шалгаруулах тэмцээнд манай баг тамирчид амжилттай оролцож 2 төрөлд Улсын дээд амжилтыг шинэчлэн тогтоож байсан. Шинээр бүрдсэн шигшээ багийн тамирчид 03 дугаар 23-ны өдрөөс эхлэн нэгдсэн бэлтгэлдээ хамрагдаж байгаа бөгөөд улирал тутам 14 хоногийн нэгдсэн цугларалт, дасгал сургуулилтыг ОБЕГ-ын &ldquo;Аврагч&rdquo; бэлтгэл сургуулилтын төвд хийж гүйцэтгэх ажээ. Энэ улирлын бэлтгэл сургуулилтыг ХСИС-ийн &nbsp;багш, ОУ-ын хэмжээний мастер, Онцгой байдлын дэд хурандаа С.Баттөмөр удирдан ерөнхий дасгалжуулагчаар ажиллаж байна.<a href="http://nema.gov.mn/wp-content/uploads/2015/04/zagsaalt.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="zagsaalt" class="alignnone size-full wp-image-4790" src="http://nema.gov.mn/wp-content/uploads/2015/04/zagsaalt.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:708px" /></a></p>\r\n\r\n<p><a href="http://nema.gov.mn/wp-content/uploads/2015/04/2.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="2" class="alignnone size-full wp-image-4792" src="http://nema.gov.mn/wp-content/uploads/2015/04/2.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:746px" /></a>&nbsp;<a href="http://nema.gov.mn/wp-content/uploads/2015/04/4.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="4" class="alignnone size-full wp-image-4794" src="http://nema.gov.mn/wp-content/uploads/2015/04/4.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:923px" /></a><a href="http://nema.gov.mn/wp-content/uploads/2015/04/3.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="3" class="alignnone size-full wp-image-4793" src="http://nema.gov.mn/wp-content/uploads/2015/04/3.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:694px" /></a></p>\r\n', '2015-03-05', '2015-04-08', 1, 1, 'assets/img/post/featured_image/225284939_79124386.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

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
(18, 46),
(17, 47),
(2, 43),
(17, 43);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `slug`, `content`, `is_active`, `created_date`, `updated_date`, `page_type_id`) VALUES
(8, 'Захирлын мэндчилгээ', 'zakhirlyn-mendchilgee', '<p><a href="http://nema.gov.mn/wp-content/uploads/2014/01/zurag1.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="zurag1" class="alignnone size-full wp-image-4835" src="http://nema.gov.mn/wp-content/uploads/2014/01/zurag1.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:2480px" /></a></p>\r\n\r\n<p><a href="http://nema.gov.mn/wp-content/uploads/2014/01/darga-mendchilgee-webd1.jpg" style="font-family: inherit; outline: none; margin: 0px; padding: 0px; border: 0px; font-size: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; color: rgb(0, 0, 0); text-decoration: none;"><img alt="darga-mendchilgee-webd" class="alignnone size-full wp-image-4837" src="http://nema.gov.mn/wp-content/uploads/2014/01/darga-mendchilgee-webd1.jpg" style="border-width:0px; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; line-height:inherit; margin:0px; max-width:100%; outline:none; padding:0px; vertical-align:baseline; width:1800px" /></a></p>\r\n', 1, '2015-03-04', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `page_type`
--

CREATE TABLE IF NOT EXISTS `page_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `icon` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `page_type`
--

INSERT INTO `page_type` (`id`, `name`, `icon`, `order`) VALUES
(1, 'CBDRM', 'fa-recycle', 3),
(2, 'Заах арга зүй', 'fa-magic', 2),
(3, 'Зөвлөмж', 'fa-lightbulb-o', 4),
(4, 'Мэндчилгээ', 'fa-spinner', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `username`, `password`) VALUES
(1, 'dulmaa_ontsgoi', '$2y$10$vdm21eOeewmvsja2IMZgTuWCCzo/C2clTpcxZgd67MyT24Iuu73re'),
(5, 'ankhaa1002', '$2y$10$bDDOrwMTGwRYG.H5oTPQTuS6gcBCDtqLmYuFCLJZbYifFnif0hzZW');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`id`, `firstname`, `lastname`, `birthdate`, `gender_id`, `company_name`, `position`, `phone`, `phone2`, `email`, `teacher_id`, `portrait_image`, `profession`) VALUES
(1, 'Дуламцэрэн', 'Баасан', '1965-03-09', 1, 'СБД 13-р хороо', 'Хэсгийн ахлагч', '95715013', '93048127', 'test@email.com', 1, NULL, 'Эмийн санч'),
(5, 'Анхбаяр', 'Цогтбаатар', '1993-10-02', 1, 'Интерактив ХХК', 'Програм зохиогч', '99499248', '', 'ankhaa1002@gmail.com', 5, 'assets/img/profile/teacher/226301355_235709297.JPG', 'Программист');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `email` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `is_active`, `email`, `firstname`, `lastname`) VALUES
(1, 'admin', '$2y$10$9l5X8bsBRmEbB7OLglBnZur2nQwlqLKoqdIcnRM.MZyFQ67ONlfnu', 1, 'admin@sur.mn', 'Test', 'Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`aimag_id`) REFERENCES `aimag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `address_ibfk_3` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `address_ibfk_4` FOREIGN KEY (`teacher_info_id`) REFERENCES `teacher_info` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`aimag_id`) REFERENCES `aimag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`lesson_category_id`) REFERENCES `lesson_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`lesson_channel_id`) REFERENCES `lesson_channel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_log`
--
ALTER TABLE `lesson_log`
  ADD CONSTRAINT `lesson_log_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_log_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
