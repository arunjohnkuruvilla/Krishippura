-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2015 at 07:19 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prototype`
--

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
`page_id` int(10) NOT NULL,
  `prim_cat` int(10) DEFAULT NULL,
  `sec_cat` varchar(5) DEFAULT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_creator` int(10) NOT NULL,
  `page_counter` int(11) DEFAULT NULL,
  `page_content` text
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `prim_cat`, `sec_cat`, `page_title`, `page_creator`, `page_counter`, `page_content`) VALUES
(1, 1, 'D', 'Harry Potter', 1, NULL, 'Harry Potter is a fictional character who was created by J.K. Rowling [[Harry Potter]] <b>Harry Potter</b> [[Spiderman]]--http://www.example.com++Link title--||sec||Books||ttl||There are seven books in the series, with a rumor that more are on the way [[Superman]]||sec||Etymology||ttl||The word Wisconsin originates from the name given to the Wisconsin River by one of the Algonquian-speaking American Indian groups living in the region at the time of European contact.[4] French explorer Jacques Marquette was the first European to reach the Wisconsin River, arriving in 1673 and calling the river Meskousing in his journal.[5] This spelling was later corrupted to Ouisconsin by other French explorers, and over time this became the French name for both the Wisconsin River and the surrounding lands. English speakers anglicized the spelling to its modern form when they began to arrive in greater numbers during the early 19th century. The current spelling was made official by the legislature of Wisconsin Territory in 1845.[6]\r\n\r\nThe Algonquian word for Wisconsin and its original meaning have both grown obscure. Interpretations vary, but most implicate the river and the red sandstone that lines its banks. One leading theory holds that the name originated from the Miami word Meskonsing, meaning "it lies red," a reference to the setting of the Wisconsin River as it flows through the reddish sandstone of the Wisconsin Dells.[7] Other theories include claims that the name originated from one of a variety of Ojibwa words meaning "red stone place," "where the waters gather," or "great rock."[8]||sec||History||ttl||Wisconsin has been home to a wide variety of cultures over the past 12,000 years. The first people arrived around 10,000 BCE during the Wisconsin Glaciation. These early inhabitants, called Paleo-Indians, hunted now-extinct ice age animals exemplified by the Boaz mastodon, a prehistoric mastodon skeleton unearthed along with spear points in southwest Wisconsin.[9] After the ice age ended around 8000 BCE, people in the subsequent Archaic period lived by hunting, fishing, and gathering food from wild plants. Agricultural societies emerged gradually over the Woodland period between 1000 BCE to 1000 CE. Toward the end of this period, Wisconsin was the heartland of the "Effigy Mound culture", which built thousands of animal-shaped mounds across the landscape.[10] Later, between 1000 and 1500 CE, the Mississippian and Oneota cultures built substantial settlements including the fortified village at Aztalan in southeast Wisconsin.[11] The Oneota may be the ancestors of the modern Ioway and Ho-Chunk tribes who shared the Wisconsin region with the Menominee at the time of European contact.[12] Other American Indian groups living in Wisconsin when Europeans first settled included the Ojibwa, Sauk, Fox, Kickapoo, and Pottawatomie, who migrated to Wisconsin from the east between 1500 and 1700.[13]'),
(5, 1, 'A', 'Superman', 1, NULL, 'Superman is a superhero from the planet of Kryptonite'),
(6, 2, 'C', 'Spiderman', 1, NULL, 'Spiderman was bitten by a radioactive spider. He is also a superhero like <a href="articles/Superman">Superman</a>'),
(7, 2, 'B', 'Flash', 1, NULL, NULL),
(8, 1, 'C', 'Batman', 1, NULL, NULL),
(9, 1, 'B', 'Thor', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `primary_category`
--

CREATE TABLE IF NOT EXISTS `primary_category` (
`cat_id` int(5) NOT NULL,
  `cat_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `primary_category`
--

INSERT INTO `primary_category` (`cat_id`, `cat_name`) VALUES
(1, 'Crops'),
(2, 'Soil');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_category`
--

CREATE TABLE IF NOT EXISTS `secondary_category` (
`cat_id` int(10) NOT NULL,
  `primary_cat` int(10) DEFAULT NULL,
  `sub_cat` varchar(5) DEFAULT NULL,
  `cat_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secondary_category`
--

INSERT INTO `secondary_category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES
(1, 1, 'A', 'Beans'),
(2, 1, 'B', 'Flowers'),
(3, 1, 'C', 'Leaves'),
(4, 1, 'D', 'Roots'),
(5, 2, 'A', 'Alappuzha'),
(6, 2, 'B', 'Ernakulam'),
(7, 2, 'C', 'Idukki');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(10) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_real_name` varchar(40) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_email` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_real_name`, `user_password`, `user_creation_time`, `user_email`) VALUES
(1, 'admin', 'administrator', 'admin', '2015-02-15 15:28:50', 'admin@admin.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `page`
--
ALTER TABLE `page`
 ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `primary_category`
--
ALTER TABLE `primary_category`
 ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `secondary_category`
--
ALTER TABLE `secondary_category`
 ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
MODIFY `page_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `primary_category`
--
ALTER TABLE `primary_category`
MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `secondary_category`
--
ALTER TABLE `secondary_category`
MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
