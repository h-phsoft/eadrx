-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 04, 2019 at 04:30 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `normal_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpy_block`
--

DROP TABLE IF EXISTS `cpy_block`;
CREATE TABLE IF NOT EXISTS `cpy_block` (
  `blk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `blk_name` varchar(200) NOT NULL COMMENT 'Name',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `type_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Type',
  `blk_stext` text COMMENT 'Search Text',
  PRIMARY KEY (`blk_id`),
  UNIQUE KEY `blk_name` (`blk_name`),
  KEY `status_id` (`status_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_block`
--

INSERT INTO `cpy_block` (`blk_id`, `blk_name`, `status_id`, `type_id`, `blk_stext`) VALUES
(1, 'Home Welcome', 1, 1, NULL),
(2, 'Home About', 1, 1, NULL),
(4, 'Home Wide Image', 1, 4, NULL),
(5, 'News', 1, 5, NULL),
(7, 'Air Freight 01', 1, 1, 'Air freight Export and Airfreight Import are products that predominately use air mode and offers a choice in delivery speeds to best suit customer requirements.\r\nWorking together with carefully selected carriers, we operate with schedules on all the world’s major routes so you can plan with certainty for greater efficiency.\r\nOur Air freight service is also highly flexible to meet specific customer requirements. Including \r\n1.	Airport to airport\r\n2.	Door to door\r\n3.	Door to airport \r\n4.	Airport to door \r\n\r\nadded value services \r\n•	AIR CHARTER - Specialist Cargo Handling\r\n•	AIR THERMONET - Standard Temperature Controlled Air Freight\r\n•	Cross Trade – moving shipments between two countries regardless of customer location'),
(8, 'Ocean Freight', 1, 1, 'Ocean Freight'),
(9, 'Road Freight', 1, 1, 'Road Freight'),
(10, 'Intermodal & Multimodal Transport', 1, 1, 'Intermodal & Multimodal Transport'),
(11, 'Customs Clearance', 1, 1, 'Customs Clearance'),
(12, 'Warehousing', 1, 1, 'Warehousing'),
(13, 'Packing & Removal', 1, 1, 'Packing & Removal'),
(14, 'Projects', 1, 1, 'Projects'),
(15, 'Fairs & Events', 1, 1, 'Fairs & Events'),
(16, 'Aid & Relief Services', 1, 1, 'Aid & Relief Services'),
(17, 'Corporate Social Responsibility', 1, 1, 'Corporate Social Responsibility'),
(18, 'Nazha Logistics', 1, 1, 'Nazha Logistics'),
(19, 'Quality Assurance', 1, 1, 'Quality Assurance'),
(20, 'Insurance', 1, 1, 'Insurance'),
(21, 'Contact Us', 1, 1, 'Contact Us'),
(22, 'Air Freight 03', 1, 1, 'added value services\r\n\r\n    AIR CHARTER - Specialist Cargo Handling\r\n    AIR THERMONET - Standard Temperature Controlled Air Freight\r\n\r\nCross Trade – moving shipments between two countries regardless of customer location'),
(23, 'Air Freight 02', 1, 3, NULL),
(24, 'Air Freight 04', 1, 2, NULL),
(25, 'SYDI 01', 1, 1, NULL),
(26, 'SYDI 02', 1, 1, NULL),
(27, 'SYDI 03', 1, 3, NULL),
(28, 'SYDI 04', 1, 1, NULL),
(29, 'SYDI 05', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_block_col`
--

DROP TABLE IF EXISTS `cpy_block_col`;
CREATE TABLE IF NOT EXISTS `cpy_block_col` (
  `col_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `col_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`col_id`),
  UNIQUE KEY `col_name` (`col_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_block_col`
--

INSERT INTO `cpy_block_col` (`col_id`, `col_name`) VALUES
(1, '1'),
(10, '10'),
(11, '11'),
(12, '12'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_block_detail`
--

DROP TABLE IF EXISTS `cpy_block_detail`;
CREATE TABLE IF NOT EXISTS `cpy_block_detail` (
  `dblk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `blk_id` int(11) NOT NULL COMMENT 'Block FK',
  `dblk_order` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Order',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `col_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Columns',
  `dblk_name` varchar(200) NOT NULL COMMENT 'Name',
  `dblk_image` varchar(200) DEFAULT NULL COMMENT 'Image',
  `dblk_text` text COMMENT 'Text',
  `dblk_stext` text COMMENT 'Search Text',
  PRIMARY KEY (`dblk_id`),
  UNIQUE KEY `dblk_name` (`blk_id`,`dblk_name`),
  KEY `status_id` (`status_id`),
  KEY `col_id` (`col_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_block_detail`
--

INSERT INTO `cpy_block_detail` (`dblk_id`, `blk_id`, `dblk_order`, `status_id`, `col_id`, `dblk_name`, `dblk_image`, `dblk_text`, `dblk_stext`) VALUES
(1, 1, 1, 1, 12, 'Main Page Welcome', NULL, '<p><strong>Nazha Logistics LLC, DHL Global Forwarding</strong> / DHL Freight Exclusive Agent in Syria, is your logistics partner<br />\r\nto deliver freight of any kind, to any place via air, ocean or road, giving its customers the personal attention they need.</p>', NULL),
(2, 2, 1, 1, 12, 'OUR MISSION 11-2018', NULL, '<h1><span style=\"color:#c0392b\">OUR MISSION</span></h1>\r\n\r\n<div>\r\n<p><strong>Excellence. Simply Delivered.</strong> This mean that we provide the best, smartest, and integrated logistic services<br />\r\nwith full transparency, flexibility and reliability to create sustainable growth to our business and society.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n</div>', NULL),
(3, 2, 2, 1, 12, 'OUR VALUES 11-2018', NULL, '<h1><span style=\"color:#c0392b\">OUR VALUES</span></h1>', NULL),
(4, 2, 3, 1, 3, 'Quality 11-2018', NULL, '<h3>Quality</h3>\r\n\r\n<p>What we do, we do very well</p>', NULL),
(5, 2, 4, 1, 3, 'Excellence 11-2018', NULL, '<h3>Excellence</h3>\r\n            <p>We exceed our customers’ expectations<br> by delivering superior added values</p>', NULL),
(6, 2, 5, 1, 3, 'Confidence 11-2018', NULL, '<h3>Confidence</h3>\r\n            <p>What we do, we do always right</p>', NULL),
(7, 2, 6, 1, 3, 'Responsibility 11-2018', NULL, '<h3>Responsibility</h3>\r\n\r\n<p>Laws &amp; Ethical Responsibility<br />\r\nSocial Responsibility<br />\r\nEnvironmental Responsibility</p>', NULL),
(8, 4, 1, 1, 1, 'home-wide-11-2018', 'home-wide-11-2018.jpg', NULL, NULL),
(19, 7, 1, 1, 12, 'Air Freight', NULL, '<h2 style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"color:#c0392b\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Air Freight</span></span></span></h2>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Airfreight Export</span></span></strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> and <strong>Airfreight Import</strong> are products that predominately use air mode and offers a choice in delivery speeds to best suit customer requirements.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Working together with carefully selected carriers, we operate with schedules on all the world&rsquo;s major routes so you can plan with certainty for greater efficiency.<br />\r\nOur Airfreight service is also highly flexible to meet specific customer requirements. Including </span></span></span></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Airport to airport</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Door to door</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Door to airport </span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Airport to door </span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>', 'Airfreight Export and Airfreight Import are products that predominately use air mode and offers a choice in delivery speeds to best suit customer requirements.\r\nWorking together with carefully selected carriers, we operate with schedules on all the world’s major routes so you can plan with certainty for greater efficiency.\r\nOur Airfreight service is also highly flexible to meet specific customer requirements. Including \r\n1.	Airport to airport\r\n2.	Door to door\r\n3.	Door to airport \r\n4.	Airport to door \r\n\r\nadded value services \r\n•	AIR CHARTER - Specialist Cargo Handling\r\n•	AIR THERMONET - Standard Temperature Controlled Air Freight\r\n•	Cross Trade – moving shipments between two countries regardless of customer location'),
(20, 8, 1, 1, 12, 'Ocean Freight', NULL, '<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Ocean Freight</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Ocean Freight Export and Ocean Freight Import</span></span></strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">; with our broad range of Ocean Freight products covering different equipment types and consolidation services, we ensure your cargo reaches the right place, at the right time in a cost-efficient way. We work with a spread of ocean carriers covering major carrier alliances with planned space protection from every major container port in the world to deliver reliability.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Naturally, our expertise also includes focused and professional handling of all conventional cargo transportation.<br />\r\n<br />\r\nDHL Global Forwarding currently handle in excess of 2.8 million TEU&rsquo;s and more than 2 million cubic meters of LCL freight annually, across all continents, with the following services </span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">OCEAN DIRECT FCL - Full container load</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">OCEAN CONNECT LCL - Less than container load</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">OCEAN CONTAINER MANAGEMENT - FCL inland services</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">OCEAN SPECIAL - Conventional load services</span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">added value services </span></span></strong></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">OCEAN ASSEMBLY - Single &amp; multi country consolidation</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">OCEAN CHARTER - Cargo vessel charter</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">FLEXITANKS - Transportation of bulk-liquids</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">OCEAN THERMONET - Temperature Controlled Ocean Freight</span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Cross Trade &ndash; moving shipments between two countries regardless of customer location</span></span></p>', 'Ocean Freight Export and Ocean Freight Import; with our broad range of Ocean Freight products covering different equipment types and consolidation services, we ensure your cargo reaches the right place, at the right time in a cost-efficient way. We work with a spread of ocean carriers covering major carrier alliances with planned space protection from every major container port in the world to deliver reliability.\r\n\r\nNaturally, our expertise also includes focused and professional handling of all conventional cargo transportation.\r\n\r\nDHL Global Forwarding currently handle in excess of 2.8 million TEU’s and more than 2 million cubic meters of LCL freight annually, across all continents, with the following services \r\n\r\n•	OCEAN DIRECT FCL - Full container load\r\n•	OCEAN CONNECT LCL - Less than container load\r\n•	OCEAN CONTAINER MANAGEMENT - FCL inland services\r\n•	OCEAN SPECIAL - Conventional load services\r\n\r\nadded value services \r\n•	OCEAN ASSEMBLY - Single & multi country consolidation\r\n•	OCEAN CHARTER - Cargo vessel charter\r\n•	FLEXITANKS - Transportation of bulk-liquids\r\n•	OCEAN THERMONET - Temperature Controlled Ocean Freight\r\n•	Cross Trade – moving shipments between two countries regardless of customer location'),
(21, 9, 1, 1, 12, 'Road Freight', NULL, '<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Road Freight</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">We provide Road Freight Import, Export and within the country regular transportation (with a range of additional services), giving you truly extensive coverage at domestic and international level. With our dispatch flexibility and long term co-operation with trucking specialists, DHL Freight handles regular part loads, as well as full loads, safely and punctually in all directions.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Our wide range of transportation equipment &ndash; road-trains, swap-bodies and semi-trailers &ndash; guarantees flexible loading conditions. With DHL Freight you also benefit from seamless communication via the EDI interface, which transmits your order entries and offers reporting and statistics.&nbsp;</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Core Services:</span></span></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Full Truck Loads </span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Part Truck Loads </span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Value Added Services:</span></span></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Direct pick-up and delivery service using one vehicle, dedicated to your shipment</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">DHL Freight managed and quality-measured transport fleet</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Service embedded in DHL Freight&rsquo;s international network, with 208 terminals across Europe</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Defined lead times based on origin/destination</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Support provided via direct contact with local DHL Freight experts</span></span></span></span></span></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Proof of delivery (POD)</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Transportation of dangerous goods</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Additional insurance</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Individual performance reports</span></span></span></span></span></li>\r\n</ul>', 'We provide Road Freight Import, Export and within the country regular transportation (with a range of additional services), giving you truly extensive coverage at domestic and international level. With our dispatch flexibility and long term co-operation with trucking specialists, DHL Freight handles regular part loads, as well as full loads, safely and punctually in all directions.\r\n\r\nOur wide range of transportation equipment – road-trains, swap-bodies and semi-trailers – guarantees flexible loading conditions. With DHL Freight you also benefit from seamless communication via the EDI interface, which transmits your order entries and offers reporting and statistics. \r\n\r\nCore Services:\r\n•	Full Truck Loads \r\n•	Part Truck Loads \r\n\r\nValue Added Services:\r\n•	Direct pick-up and delivery service using one vehicle, dedicated to your shipment\r\n•	DHL Freight managed and quality-measured transport fleet\r\n•	Service embedded in DHL Freight’s international network, with 208 terminals across Europe\r\n•	Defined lead times based on origin/destination\r\n•	Support provided via direct contact with local DHL Freight experts\r\n•	Proof of delivery (POD)\r\n•	Transportation of dangerous goods\r\n•	Additional insurance\r\n•	Individual performance reports'),
(22, 10, 1, 1, 12, 'Intermodal & Multimodal Transport', NULL, '<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"color:red\">Intermodal &amp; Multimodal Transport</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Road-Air and Ocean-Air Combing the speed of air freight with the economy of ocean freight / road freight we offer faster transit times at a considerably lower cost and lower carbon footprint than pure air freight.<br />\r\nEnsuring cargo remains in DHL&rsquo;s control at all times, this product offers a multi-modal service. </span></span></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Import/export customs brokerage &ndash; we take control of all customs formalities and delivery documentation</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">An alternative modal option during peak season congestion</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">End-to-end real time visibility</span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Green transport</span></span></p>', 'Road-Air and Ocean-Air Combing the speed of air freight with the economy of ocean freight / road freight we offer faster transit times at a considerably lower cost and lower carbon footprint than pure air freight.\r\nEnsuring cargo remains in DHL’s control at all times, this product offers a multi-modal service. \r\n•	Import/export customs brokerage – we take control of all customs formalities and delivery documentation\r\n•	An alternative modal option during peak season congestion\r\n•	End-to-end real time visibility\r\n•	Green transport'),
(23, 11, 1, 1, 12, 'Customs Clearance', NULL, '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:15.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Customs Clearance</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We have long experience in customs clearance we handle clearance at </span></strong></span></span></p>\r\n\r\n<ul style=\"list-style-type:square\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Airports</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Ports</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Cross borders</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Customs secretariats </span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Free Zones. </span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Clearing Services offered are :</span></strong></span></span></p>\r\n\r\n<ul style=\"list-style-type:square\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Import Customs Clearance </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Export Clearance </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Transit Customs Clearance </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Customs Approval follow up </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Import License follow up </span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Analysis follow up </span></span></span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Range of additional clearance services based on shipment purpose </span></span></p>', 'We have long experience in customs clearance we handle clearance at \r\nAirports\r\nPorts\r\nCross borders\r\nCustoms secretariats \r\nFree Zones. \r\nClearing Services offered are :\r\nImport Customs Clearance \r\nExport Clearance \r\nTransit Customs Clearance \r\nCustoms Approval follow up \r\nImport License follow up \r\nAnalysis follow up \r\nRange of additional clearance services based on shipment purpose'),
(24, 12, 1, 1, 12, 'Warehousing', NULL, '<p style=\"margin-left:0cm; margin-right:0cm\"><strong><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Warehousing</span></span></strong></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We offer warehouse management at any location in the country based on customer requirements.</span></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">DHL Global Forwarding Damascus Logistics Facility:<br />\r\nLocated 7 KM from Damascus Airport and 23 KM from Damascus city center.<br />\r\nTotal Land area: 110,000 sqm, out of which 40,000 sqm are encircled by a 3.5 m high fence; this part contains the present warehouses and offices. </span></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Total Warehouses Space:&nbsp; 5,000 sqm of fully equipped warehouses that will be extended to 14,000 sqm in phase two.</span></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Facility specifications and equipment:</span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Fire alerts, protection and escape routes</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Security guards </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Material Handling Equipment</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Racking &amp; Shelving</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">HSE needs</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Warehouse Management System (WMS)</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Insurance coverage</span></span></span><br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:12.0pt\">Our Warehousing Solutions</span></strong><span style=\"font-size:12.0pt\"> improve inventory efficiency and accelerate your response to changing customer demand. Our experts design, implement, and operate flexible warehousing and distribution solutions tailored to your business needs. They analyze every point in your supply chain to determine the optimal solution.</span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Dedicated Warehouses </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Multi Customer Warehousing </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Ambient and temperature-controlled facilities</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Storage, pick, pack and dispatch</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Delivery and returns management</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:12.0pt\">Inventory Optimization</span></strong><br />\r\n<span style=\"font-size:12.0pt\">Through effective inventory management, inefficiencies can be driven out of the supply chain, overall costs reduced and high service levels achieved. We optimize inventory at a line-item level at every stage of the supply chain.</span></span></span><br />\r\n&nbsp;</p>\r\n\r\n<p><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Multi-Customer Warehousing</span></span></strong><br />\r\n<span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Our shared-user facilities are designed to meet the needs of any customer for consumer products, industrial equipment, chemicals and technology.<br />\r\nThrough sharing of DHL\'s resources, such as space, labor, equipment and transportation, customers benefit from synergies that considerably reduce supply chain costs.<br />\r\nThis environment returns significant value to a small business requiring distribution operations without long term lease or capital commitments, or a large enterprise handling a new acquisition, product launches or seasonal overflow</span></span></p>', 'We offer warehouse management at any location in the country based on customer requirements.\r\nDHL Global Forwarding Damascus Logistics Facility:\r\nLocated 7 KM from Damascus Airport and 23 KM from Damascus city center.\r\nTotal Land area: 110,000 sqm, out of which 40,000 sqm are encircled by a 3.5 m high fence; this part contains the present warehouses and offices. \r\nTotal Warehouses Space:  5,000 sqm of fully equipped warehouses that will be extended to 14,000 sqm in phase two.\r\nFacility specifications and equipment:\r\n•	Fire alerts, protection and escape routes\r\n•	Security guards \r\n•	Material Handling Equipment\r\n•	Racking & Shelving\r\n•	HSE needs\r\n•	Warehouse Management System (WMS)\r\n•	Insurance coverage\r\n\r\nOur Warehousing Solutions improve inventory efficiency and accelerate your response to changing customer demand. Our experts design, implement, and operate flexible warehousing and distribution solutions tailored to your business needs. They analyze every point in your supply chain to determine the optimal solution.\r\n•	Dedicated Warehouses \r\n•	Multi Customer Warehousing \r\n•	Ambient and temperature-controlled facilities\r\n•	Storage, pick, pack and dispatch\r\n•	Delivery and returns management\r\n\r\nInventory Optimization\r\nThrough effective inventory management, inefficiencies can be driven out of the supply chain, overall costs reduced and high service levels achieved. We optimize inventory at a line-item level at every stage of the supply chain.\r\n\r\nMulti-Customer Warehousing\r\nOur shared-user facilities are designed to meet the needs of any customer for consumer products, industrial equipment, chemicals and technology.\r\nThrough sharing of DHL\'s resources, such as space, labor, equipment and transportation, customers benefit from synergies that considerably reduce supply chain costs.\r\nThis environment returns significant value to a small business requiring distribution operations without long term lease or capital commitments, or a large enterprise handling a new acquisition, product launches or seasonal overflow'),
(25, 13, 1, 1, 12, 'Packing & Removal', NULL, '<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:20.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Packing &amp; Removal</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Our mission is turning your Packing &amp; Removal experience into an exciting, enjoyable and Stress Free task.<br />\r\nOne stop shopping point as follows:</span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Packing</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Storage </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Customs Clearance</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Shipping Services: Airfreight, Ocean Freight and Road Freight</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Destination Services </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Unpacking and removal of debris.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Packing Steps:<br />\r\nOur packing process has a defined outline, solid to ensure our customers trust and peace of mind, flexible enough to adjust according to needed requirements. Don&rsquo;t wait until you have a moving day. Contact us at least one month before you intend to move, we will then work with you to help you through the process.<br />\r\n&nbsp;1.&nbsp; Assessment: Our Experts will undertake an assessment survey to estimate our customers&rsquo; requirements and needs.<br />\r\n&nbsp; 2. Offer: will be submitted promptly after thorough study.<br />\r\n&nbsp;3. Plan: a plan will be developed tailor made to fit each customer&rsquo;s requirements and commodities.</span></span></p>', 'Our mission is turning your Packing & Removal experience into an exciting, enjoyable and Stress Free task.\r\nOne stop shopping point as follows:\r\n•	Packing\r\n•	Storage \r\n•	Customs Clearance\r\n•	Shipping Services: Airfreight, Ocean Freight and Road Freight\r\n•	Destination Services \r\n•	Unpacking and removal of debris.\r\n\r\nPacking Steps:\r\nOur packing process has a defined outline, solid to ensure our customers trust and peace of mind, flexible enough to adjust according to needed requirements. Don’t wait until you have a moving day. Contact us at least one month before you intend to move, we will then work with you to help you through the process.\r\n 1.  Assessment: Our Experts will undertake an assessment survey to estimate our customers’ requirements and needs.\r\n  2. Offer: will be submitted promptly after thorough study.\r\n 3. Plan: a plan will be developed tailor made to fit each customer’s requirements and commodities.'),
(26, 14, 1, 1, 12, 'Projects', NULL, '<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Projects</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">DHL understands the unique logistics challenges related to projects shipments. We provide a range of services that help align logistics operations with your business strategies. Our processes, technology and people drive cost and capital out of your operations, whilst ensuring consistent and predictable service.</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">We let you focus on what you do best: design, engineer, install, construct and manufacture products the world depends on. With DHL as a partner, your goods will be delivered as safely and efficiently as possible.</span></span></span></span></p>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</h2>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:13pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"color:#4f81bd\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Core Services</span></span></span></span></span></span></h2>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Warehousing and Order Fulfillment</span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Sub-assembly and Kitting</span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Transportation Management</span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Lead Logistics Provider (LLP)</span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Industrial Projects Transportation</span></span></span></span></li>\r\n</ul>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</h2>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:13pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"color:#4f81bd\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We address</span></span></span></span></span></span></h2>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Transport and Logistics Design</span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Logistics Management</span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Project Cargo Logistics </span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\">Heavy Loads </span></span></span></span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Outsized Loads</span></span></p>', 'DHL understands the unique logistics challenges related to projects shipments. We provide a range of services that help align logistics operations with your business strategies. Our processes, technology and people drive cost and capital out of your operations, whilst ensuring consistent and predictable service.\r\n\r\nWe let you focus on what you do best: design, engineer, install, construct and manufacture products the world depends on. With DHL as a partner, your goods will be delivered as safely and efficiently as possible.\r\n\r\nCore Services\r\n•	Warehousing and Order Fulfillment\r\n•	Sub-assembly and Kitting\r\n•	Transportation Management\r\n•	Lead Logistics Provider (LLP)\r\n•	Industrial Projects Transportation\r\n\r\nWe address\r\n•	Transport and Logistics Design\r\n•	Logistics Management\r\n•	Project Cargo Logistics \r\n•	Heavy Loads \r\n•	Outsized Loads');
INSERT INTO `cpy_block_detail` (`dblk_id`, `blk_id`, `dblk_order`, `status_id`, `col_id`, `dblk_name`, `dblk_image`, `dblk_text`, `dblk_stext`) VALUES
(27, 15, 1, 1, 12, 'Fairs & Events', NULL, '<p style=\"margin-left:0cm; margin-right:0cm\"><strong><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Fairs &amp; Events</span></span></strong></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We offer complete logistics services for both Fairs &amp; Events Organizers and Clients.</span></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Infrastructure</strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We accompany you! Wherever your customers and suppliers need us - we are already there </span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Our <strong>specialists</strong> are located around the globe and support you at <strong>every location worldwide</strong></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Organizers and venues worldwide <strong>trust</strong> in us and appoint DHL as <strong>official forwarder</strong></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Dedicated network </strong>of experienced operations personnel</span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Reliability and Quality of Service</strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We help you preserve and deliver the highest quality to your customers</span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">One partner with the ability to provide the <strong>most extensive product offering </strong></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Experience in handling and shipping of <strong>exceptional shipments</strong></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Full service </strong>approach before, during and after the show or event</span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Innovation and Tailor-made Solutions</strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We anticipate your needs while setting standards for the industry</span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Customized relationship management </strong>programs that mirror clients&rsquo; organizational needs</span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Providing <strong>specialized services</strong>, e.g. Project management, document support, customs clearance, on-site handling, delivery, storage concepts, packing</span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Industry expertise and Know-How</strong></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Our experts are at your service to provide you with state-of-the-art service</span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Global expertise teamed </strong>with local knowledge &ndash; we deliver the right integrated solution</span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Unique understanding </strong>of customer requirements </span></span></li>\r\n</ul>\r\n\r\n<p><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">One personal and&nbsp; dedicated point of contact for all your needs</span></span></strong></p>', 'We offer complete logistics services for both Fairs & Events Organizers and Clients.\r\nInfrastructure\r\nWe accompany you! Wherever your customers and suppliers need us - we are already there \r\n•	Our specialists are located around the globe and support you at every location worldwide\r\n•	Organizers and venues worldwide trust in us and appoint DHL as official forwarder\r\n•	Dedicated network of experienced operations personnel\r\n\r\nReliability and Quality of Service\r\nWe help you preserve and deliver the highest quality to your customers\r\n•	One partner with the ability to provide the most extensive product offering \r\n•	Experience in handling and shipping of exceptional shipments\r\n•	Full service approach before, during and after the show or event\r\n\r\nInnovation and Tailor-made Solutions\r\nWe anticipate your needs while setting standards for the industry\r\n1.	Customized relationship management programs that mirror clients’ organizational needs\r\n2.	Providing specialized services, e.g. Project management, document support, customs clearance, on-site handling, delivery, storage concepts, packing\r\n\r\nIndustry expertise and Know-How\r\nOur experts are at your service to provide you with state-of-the-art service\r\n•	Global expertise teamed with local knowledge – we deliver the right integrated solution\r\n•	Unique understanding of customer requirements \r\n•	One personal and  dedicated point of contact for all your needs'),
(28, 16, 1, 1, 12, 'Aid & Relief Services', NULL, '<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Aid &amp; Relief Services</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:12.0pt\">Due to the need of logistics services for the humanitarian aid across the country, DHL Global Forwarding -Syria set up a department under the name of Aid &amp; Relief Services responsible for the Humanitarian Aid Logistics within Syria through the following services:</span></strong></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Transportation&nbsp; </span></span></span>\r\n\r\n	<ul>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Primary Transportation, from Syrian Ports (Lattakia &amp; Tartous) or from Lebanon and Jordan borders to our warehouses.</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Secondary Transportation, from local warehouses or directly from Ports to all Cities in Syria, according to a pre-defined monthly cycle.</span></span></span></li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Charters<br />\r\n	Cargo Charters to difficult-to-access and faraway areas within Syria</span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<ol start=\"3\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Customs Clearance<br />\r\n	Done at Ports and Borders as a supporting service to the transportation operations and for urgent Aid &amp; Relief shipments, we arrange direct withdrawal (when required) to speed up the delivery process and settle the declarations later on.</span></span></span><br />\r\n	&nbsp;</li>\r\n</ol>\r\n\r\n<ol start=\"4\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Warehousing</span></span></span>\r\n\r\n	<ul>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Dedicated warehouses with full warehousing management services for UN Agencies and NGOs which have huge operations in any location in Syria </span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Multi-Customer warehousing services for UN Agencies and NGOs which need temporary services for small operations at our DHL Facility in Damascus </span></span></span></li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Packaging</span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Aid &amp; Relief Packaging Department was established to provide re-packing and re-bagging services of a monthly pre-defined content of Aid &amp; Relief Family Food and Non-Food Rations. These services are done through:</span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">\r\n	<ul>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Well trained staff with high productivity performance</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Ability to work 24 hours on shifts basis</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Ability to supply all kinds of packing equipment and packing materials</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Safety &amp; Hygiene standards are strictly implemented</span></span></span></li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<ol start=\"6\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Supply</span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">DHL Global Forwarding can supply raw materials, re-pack them into kits and deliver them to the service requester as per the standards required by any UN Agency or Humanitarian Organization, giving priority to the local market in order to support the local Syrian families as per DHL Global Forwarding Aid &amp; Relief policies which are in line with UN agencies and other humanitarian organizations. However, when the raw materials must be imported, DHL Global Forwarding is the most eligible company in Syria to arrange the import of such material through its worldwide network.&nbsp; Kits types may include (but not limited to) the following types.</span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">\r\n	<ul>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Hygiene Kits</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Clothing Kits</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Food Kits</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Baby Kits</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Plastic Sheets</span></span></span></li>\r\n		<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">School Kits</span></span></span></li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Mosquito Nets</span></span></p>', 'Due to the need of logistics services for the humanitarian aid across the country, DHL Global Forwarding -Syria set up a department under the name of Aid & Relief Services responsible for the Humanitarian Aid Logistics within Syria through the following services:\r\n1.	Transportation  \r\n•	Primary Transportation, from Syrian Ports (Lattakia & Tartous) or from Lebanon and Jordan borders to our warehouses.\r\n•	Secondary Transportation, from local warehouses or directly from Ports to all Cities in Syria, according to a pre-defined monthly cycle.\r\n2.	Charters\r\nCargo Charters to difficult-to-access and faraway areas within Syria\r\n\r\n3.	Customs Clearance\r\nDone at Ports and Borders as a supporting service to the transportation operations and for urgent Aid & Relief shipments, we arrange direct withdrawal (when required) to speed up the delivery process and settle the declarations later on.\r\n\r\n\r\n4.	Warehousing\r\n•	Dedicated warehouses with full warehousing management services for UN Agencies and NGOs which have huge operations in any location in Syria \r\n•	Multi-Customer warehousing services for UN Agencies and NGOs which need temporary services for small operations at our DHL Facility in Damascus \r\n5.	Packaging\r\nAid & Relief Packaging Department was established to provide re-packing and re-bagging services of a monthly pre-defined content of Aid & Relief Family Food and Non-Food Rations. These services are done through:\r\n•	Well trained staff with high productivity performance\r\n•	Ability to work 24 hours on shifts basis\r\n•	Ability to supply all kinds of packing equipment and packing materials\r\n•	Safety & Hygiene standards are strictly implemented\r\n\r\n6.	Supply\r\nDHL Global Forwarding can supply raw materials, re-pack them into kits and deliver them to the service requester as per the standards required by any UN Agency or Humanitarian Organization, giving priority to the local market in order to support the local Syrian families as per DHL Global Forwarding Aid & Relief policies which are in line with UN agencies and other humanitarian organizations. However, when the raw materials must be imported, DHL Global Forwarding is the most eligible company in Syria to arrange the import of such material through its worldwide network.  Kits types may include (but not limited to) the following types.\r\n•	Hygiene Kits\r\n•	Clothing Kits\r\n•	Food Kits\r\n•	Baby Kits\r\n•	Plastic Sheets\r\n•	School Kits\r\n•	Mosquito Nets'),
(29, 17, 1, 1, 12, 'Corporate Social Responsibility', NULL, '<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Corporate Social Responsibility</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">We follow Deutsche Post DHL Corporate Responsibility and mostly we focus on </span></span></span></p>\r\n\r\n<ol>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:12.0pt\">Environment protection </span></strong></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Committed to sustainable development, we create innovative, effective, environmentally friendly logistics services that fulfill customer\'s needs, while minimizing undesirable impacts. (Policy Enclosed)</span></span></span></p>\r\n\r\n<ol start=\"2\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:12.0pt\">Culture Support &nbsp; </span></strong></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">DHL Global Forwarding Syria has launched its project of sponsoring, encouraging and spreading Culture in all its aspects in Syria. </span></span></span></p>\r\n\r\n<ul style=\"list-style-type:square\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Sponsorship of photo Exhibition &ldquo;Dervish Rituals&rdquo; by a Syrian artist. The exhibition was held in the historical hall of Khan As&rsquo;ad Pasha under the high auspices of the Syrian Minister of Culture in&nbsp;2007. </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Sponsorship of a Jazz concert performed by a specialized Russian Band in Damascus in 2007</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Sponsorship of the shielding cover when Salahuddin Ayyubi statue was under restoration in 2007.</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Partnership in the International Violin Competition with Solhi Al Wadi Institute of Music in 2008</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Sponsoring Yes Academy &quot;Youth Excellence on Stage&quot; in 2010</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Sponsoring Jazz Lives in 2010 </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Sponsoring the Visual arts festival in Damascus in 2010</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Sponsoring &ldquo;</span><span style=\"font-size:12.0pt\">T</span><span style=\"font-size:12.0pt\">he Mirror&rdquo; play performed by </span><span style=\"font-size:12.0pt\">the university team</span><span style=\"font-size:12.0pt\"> of the &ldquo;Lady of Damascus&rdquo; Church</span> <span style=\"font-size:12.0pt\">in 2015.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<ol start=\"3\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong><span style=\"font-size:12.0pt\">Syrian Youth Development Initiative </span></strong></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Due to the impacts caused by the Syrian crisis, there was a clear need to switch CSR into this phase priorities, Syrian youth need tools to enable them enhance their knowledge and skills, which will prepare them for better future and empower them to be part of the reconstruction of Syria; thus we launched the &ldquo;<strong>Syrian Youth Development Initiative&rdquo;</strong> </span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<ul style=\"list-style-type:square\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">AKDN - Aga Khan Development Network</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">In 2017 we signed MoU with AKDN to donate books to a prototype library established recently by AKDN in an elementary school in Damascus old city that has 425 students. The 408 donated books varied among encyclopedias, cultural books, educational books, and purposeful stories.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<ul style=\"list-style-type:square\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">SOS - SOS Children&rsquo;s Villages</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">As part of Deutsche Post DHL Group-wide program &ldquo;GoTeach&rdquo;, we work together with international partners to improve educational opportunity and employability for young people, especially those from disadvantaged socio-economic backgrounds.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Deutsche Post DHL Group and&nbsp;</span><a href=\"http://www.dpdhl.com/en/sitemap/disclaimer.html?ref=URJ+gUERGT0ryrNE5eQGEzDaNPeknX6PBvkHO7SNl3ATnJd6gWkb9w==\">SOS Children\'s Villages</a><span style=\"font-size:12.0pt\">&nbsp;International have been partners in the GoTeach program since 2011.&nbsp;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">The partnership covers a wide variety of activities; these can be clustered into the following categories:</span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Job orientation &ndash; to educate teens about the job market</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Soft and basic skills training &ndash; to enable access to the job market</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Exposure to professional working environment &ndash; to gain initial work experience</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Training and support for establishing own businesses</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">The program started in four countries in 2011 and expanded rapidly to 26 countries worldwide by 2015 and in 2017 it was launched in Syria.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">In Syria DGF support SOS by training a group of SOS youths on the above categories by specialized DHL trainers. The project started in 2017 and is still ongoing </span></span></p>', 'We follow Deutsche Post DHL Corporate Responsibility and mostly we focus on \r\n1.	Environment protection \r\nCommitted to sustainable development, we create innovative, effective, environmentally friendly logistics services that fulfill customer\'s needs, while minimizing undesirable impacts. (Policy Enclosed)\r\n2.	Culture Support   \r\nDHL Global Forwarding Syria has launched its project of sponsoring, encouraging and spreading Culture in all its aspects in Syria. \r\n	Sponsorship of photo Exhibition “Dervish Rituals” by a Syrian artist. The exhibition was held in the historical hall of Khan As’ad Pasha under the high auspices of the Syrian Minister of Culture in 2007. \r\n	Sponsorship of a Jazz concert performed by a specialized Russian Band in Damascus in 2007\r\n	Sponsorship of the shielding cover when Salahuddin Ayyubi statue was under restoration in 2007.\r\n	Partnership in the International Violin Competition with Solhi Al Wadi Institute of Music in 2008\r\n	Sponsoring Yes Academy \"Youth Excellence on Stage\" in 2010\r\n	Sponsoring Jazz Lives in 2010 \r\n	Sponsoring the Visual arts festival in Damascus in 2010\r\n	Sponsoring “The Mirror” play performed by the university team of the “Lady of Damascus” Church in 2015.\r\n\r\n3.	Syrian Youth Development Initiative \r\nDue to the impacts caused by the Syrian crisis, there was a clear need to switch CSR into this phase priorities, Syrian youth need tools to enable them enhance their knowledge and skills, which will prepare them for better future and empower them to be part of the reconstruction of Syria; thus we launched the “Syrian Youth Development Initiative” \r\n\r\n	AKDN - Aga Khan Development Network\r\nIn 2017 we signed MoU with AKDN to donate books to a prototype library established recently by AKDN in an elementary school in Damascus old city that has 425 students. The 408 donated books varied among encyclopedias, cultural books, educational books, and purposeful stories.\r\n\r\n\r\n	SOS - SOS Children’s Villages\r\nAs part of Deutsche Post DHL Group-wide program “GoTeach”, we work together with international partners to improve educational opportunity and employability for young people, especially those from disadvantaged socio-economic backgrounds.\r\nDeutsche Post DHL Group and SOS Children\'s Villages International have been partners in the GoTeach program since 2011. \r\nThe partnership covers a wide variety of activities; these can be clustered into the following categories:\r\n•	Job orientation – to educate teens about the job market\r\n•	Soft and basic skills training – to enable access to the job market\r\n•	Exposure to professional working environment – to gain initial work experience\r\n•	Training and support for establishing own businesses\r\nThe program started in four countries in 2011 and expanded rapidly to 26 countries worldwide by 2015 and in 2017 it was launched in Syria.\r\nIn Syria DGF support SOS by training a group of SOS youths on the above categories by specialized DHL trainers. The project started in 2017 and is still ongoing'),
(30, 18, 1, 1, 12, 'Nazha Logistics', NULL, '<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Nazha Logistics</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Nazha Logistics is the Exclusive Agent of DHL Global Forwarding / DHL Freight in Syria and the logistics market leader locally. </span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">DHL is present in over 220 countries and territories across the globe, making it the most international company in the world. With a workforce exceeding 350,000 employees, DHL provides solutions for an almost infinite number of logistics needs.&nbsp;</span></span></span><br />\r\n&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">We signify the &ldquo;One Stop Shopping&rdquo; concept with the full range of logistic products we provide starting from the basic conventional freight services fulfilling the small customers demand up to the most complicated &ldquo;Customer Program Management&rdquo; systems which we provide to our Multi National Customers.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:16.0pt\">Company history</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">1972<br />\r\nThe establishment of NAZHA, with headquarter in Damascus, as the first company specialized in Air Freight in Syria. Nazha kept its leading position in this field for several years.<br />\r\n2002<br />\r\nNazha became the exclusive agent of Danzas AEI Intercontinental in Syria and since then has broadened its services to include all kinds of Freight Forwarding services that can be delivered to customers. By the end of 2002, DHL Worldwide Express was fully owned by Deutsche Post World Net.<br />\r\n2003<br />\r\nDeutsche Post World Net consolidated all of its express and logistics activities into one single brand: DHL. Eventually NAZHA became the Exclusive Agent of DHL Danzas Air and Ocean division.<br />\r\n2005<br />\r\nBy the end of 2005, Deutsche Post World Net completed the acquisition of Exel, a major international company in Freight Forwarding and Contracted Logistics, and integrated it into the DHL group.<br />\r\n2006<br />\r\nTwo new Brands were born to substitute DHL Solutions and DHL Danzas Air &amp; Ocean. The new Brands are: DHL Global Forwarding and DHL Freight. Consequently NAZHA became the exclusive agent in Syria of both Brands.<br />\r\n2014<br />\r\nAs of January 1st, 2014, &ldquo;NAZHA Travel, Tourism &amp; Freight&rdquo; name has been re-branded to be &ldquo;NAZHA Logistics&rdquo;.</span></span></span><br />\r\n&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Offices</span></span></span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Damascus Head Office</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Tartous Port office</span></span></span></li>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Lattakia Port office </span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Employees: 150&nbsp;</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Opening hours: </span></span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Offices SAT &ndash; THU 08h30 &ndash; 16h30</span></span></span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Warehouses / Airport / Ports / Terminals services: 24/24 Hours 7days/week</span></span></p>', 'Nazha Logistics is the Exclusive Agent of DHL Global Forwarding / DHL Freight in Syria and the logistics market leader locally. \r\nDHL is present in over 220 countries and territories across the globe, making it the most international company in the world. With a workforce exceeding 350,000 employees, DHL provides solutions for an almost infinite number of logistics needs. \r\n\r\nWe signify the “One Stop Shopping” concept with the full range of logistic products we provide starting from the basic conventional freight services fulfilling the small customers demand up to the most complicated “Customer Program Management” systems which we provide to our Multi National Customers.\r\n\r\nCompany history\r\n1972\r\nThe establishment of NAZHA, with headquarter in Damascus, as the first company specialized in Air Freight in Syria. Nazha kept its leading position in this field for several years.\r\n2002\r\nNazha became the exclusive agent of Danzas AEI Intercontinental in Syria and since then has broadened its services to include all kinds of Freight Forwarding services that can be delivered to customers. By the end of 2002, DHL Worldwide Express was fully owned by Deutsche Post World Net.\r\n2003\r\nDeutsche Post World Net consolidated all of its express and logistics activities into one single brand: DHL. Eventually NAZHA became the Exclusive Agent of DHL Danzas Air and Ocean division.\r\n2005\r\nBy the end of 2005, Deutsche Post World Net completed the acquisition of Exel, a major international company in Freight Forwarding and Contracted Logistics, and integrated it into the DHL group.\r\n2006\r\nTwo new Brands were born to substitute DHL Solutions and DHL Danzas Air & Ocean. The new Brands are: DHL Global Forwarding and DHL Freight. Consequently NAZHA became the exclusive agent in Syria of both Brands.\r\n2014\r\nAs of January 1st, 2014, “NAZHA Travel, Tourism & Freight” name has been re-branded to be “NAZHA Logistics”.\r\n\r\nOffices\r\n•	Damascus Head Office\r\n•	Tartous Port office\r\n•	Lattakia Port office \r\n\r\nEmployees: 150 \r\n\r\nOpening hours: \r\n•	Offices SAT – THU 08h30 – 16h30\r\n•	Warehouses / Airport / Ports / Terminals services: 24/24 Hours 7days/week'),
(31, 19, 1, 1, 12, 'Quality Assurance', NULL, '<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><strong><span style=\"font-size:16.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Quality Assurance</span></span></strong></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Nazha Logistics the Exclusive Agent of DHL Global Forwarding<span style=\"background-color:white\"> in Syria </span>believes that success depends on the supply of high quality logistic services that meet or exceed customer expectations. </span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">The Quality Policy of Nazha Logistics indicates the basic principles that control our business and the commitment that the logistic services we provide to our customers shall be the best possible available in the market.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">(full quality policy is enclosed)</span></span></p>', 'Nazha Logistics the Exclusive Agent of DHL Global Forwarding in Syria believes that success depends on the supply of high quality logistic services that meet or exceed customer expectations. \r\nThe Quality Policy of Nazha Logistics indicates the basic principles that control our business and the commitment that the logistic services we provide to our customers shall be the best possible available in the market.\r\n(full quality policy is enclosed)'),
(32, 20, 1, 1, 12, 'Insurance', NULL, '<p><span style=\"font-size:20.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Insurance</span></span></p>\r\n\r\n<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Insurance services that offer our customers financial protection against all risks of physical loss or damage from any external cause such as fire, storms, thunderbolts and other standard insured risks for the total amount of the stored materials (our policy covers the accurate exact amount on daily basis). Thus, our customers can significantly reduce the financial impact associated with these unfortunate events.</span></span></p>', 'Insurance services that offer our customers financial protection against all risks of physical loss or damage from any external cause such as fire, storms, thunderbolts and other standard insured risks for the total amount of the stored materials (our policy covers the accurate exact amount on daily basis). Thus, our customers can significantly reduce the financial impact associated with these unfortunate events.'),
(33, 21, 1, 1, 12, 'Contact Us', NULL, '<p style=\"margin-left:0cm; margin-right:0cm\"><strong><span style=\"font-size:20.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Contact Us</span></span></strong></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Nazha Logistics LLC - Exclusive Agent of DHL Global Forwarding in Syria.</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Sabbagh Building, Victoria Bridge. </span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Damascus &ndash; Syria. </span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">P.O.Box: 2170</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Tel.: +963 11 2221857 &ndash; 2200235 / Fax: +963 11 2243933</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Mobile: +963 944 673 303</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">E-mail: <span style=\"color:blue\"><u><a href=\"mailto:dhl.gf@nazhaco.com\" style=\"color:blue; text-decoration:underline\">dhl.gf@nazhaco.com</a></u></span></span></span></p>', 'Nazha Logistics LLC - Exclusive Agent of DHL Global Forwarding in Syria.\r\nSabbagh Building, Victoria Bridge. \r\nDamascus – Syria. \r\nP.O.Box: 2170\r\nTel.: +963 11 2221857 – 2200235 / Fax: +963 11 2243933\r\nMobile: +963 944 673 303\r\nE-mail: dhl.gf@nazhaco.com'),
(34, 22, 1, 1, 12, 'Air Freight 03', NULL, '<h2><span style=\"color:#c0392b\">added value services</span></h2>\r\n\r\n<p><br />\r\nAIR CHARTER - Specialist Cargo Handling<br />\r\nAIR THERMONET - Standard Temperature Controlled Air Freight</p>\r\n\r\n<p>Cross Trade &ndash; moving shipments between two countries regardless of customer location</p>', 'added value services\r\n\r\n    AIR CHARTER - Specialist Cargo Handling\r\n    AIR THERMONET - Standard Temperature Controlled Air Freight\r\n\r\nCross Trade – moving shipments between two countries regardless of customer location'),
(35, 23, 1, 1, 6, 'Air Freight 0201', 'Middle 1 - 600 x 400.jpg', NULL, NULL),
(36, 23, 2, 1, 6, 'Air Freight 0202', 'Middle 2.jpg', NULL, NULL),
(37, 24, 1, 1, 12, 'Air Freight 0401', 'Slider 1 - 1100 x 650.jpg', NULL, NULL),
(38, 24, 2, 1, 12, 'Air Freight 0402', 'Slider 2.jpg', NULL, NULL),
(39, 24, 1, 1, 12, 'Air Freight 0403', 'Slider 3.jpg', NULL, NULL),
(40, 24, 1, 1, 12, 'Air Freight 0404', 'Slider 4.jpg', NULL, NULL),
(41, 24, 1, 1, 12, 'Air Freight 0405', 'Slider 5.jpg', NULL, NULL),
(42, 24, 1, 1, 12, 'Air Freight 0406', 'Slider 6.jpg', NULL, NULL),
(43, 24, 1, 1, 12, 'Air Freight 0407', 'Slider 7.jpg', NULL, NULL),
(44, 24, 1, 1, 12, 'Air Freight 0408', 'Slider 8.jpg', NULL, NULL),
(45, 25, 1, 1, 12, 'SYDI 0101', NULL, '<h2><span style=\"color:#c0392b\">Syrian Youth Development Initiative</span></h2>\r\n\r\n<p>Due to the impacts caused by the Syrian crisis, there was a clear need to switch CSR into this phase priorities,</p>\r\n\r\n<p>Syrian youth need tools to enable them enhance their knowledge and skills, which will prepare them</p>\r\n\r\n<p>for better future and empower them to be part of the reconstruction of Syria; thus we launched the &ldquo;Syrian Youth Development Initiative&rdquo;</p>', NULL),
(46, 26, 1, 1, 12, 'SYDI 0201', NULL, '<h2>AKDN - Aga Khan Development Network</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In 2017 we signed MoU with AKDN to donate books to a prototype library</p>\r\n\r\n<p>established recently by AKDN in an elementary school in Damascus old city that has 425 students. The 408 donated</p>\r\n\r\n<p>books varied among encyclopedias, cultural books, educational books, and purposeful stories.</p>', NULL),
(47, 27, 1, 1, 6, 'SYDI 0301', 'Middle 1.jpg', NULL, NULL),
(48, 27, 2, 1, 6, 'SYDI 0302', 'Middle 2(1).jpg', NULL, NULL),
(49, 28, 1, 1, 12, 'SYDI 0401', NULL, '<h2 style=\"text-align:center\">SOS - SOS Children&rsquo;s Villages</h2>\r\n\r\n<p style=\"text-align:center\">As part of Deutsche Post DHL Group-wide program &ldquo;GoTeach&rdquo;, we work together with international partners to improve educational opportunity and employability for young people, especially those from disadvantaged socio-economic backgrounds.</p>\r\n\r\n<p style=\"text-align:center\">Deutsche Post DHL Group and SOS Children\'s Villages International have been partners in the GoTeach program since 2011.</p>\r\n\r\n<p style=\"text-align:center\">The partnership covers a wide variety of activities; these can be clustered into the following categories:</p>', NULL),
(50, 29, 1, 1, 12, 'SYDI 0501', 'Slider 1.jpg', NULL, NULL),
(51, 29, 2, 1, 12, 'SYDI 0502', 'Slider 2(1).jpg', NULL, NULL),
(52, 29, 3, 1, 12, 'SYDI 0503', 'Slider 3(1).jpg', NULL, NULL),
(53, 29, 4, 1, 12, 'SYDI 0504', 'Slider 4(1).jpg', NULL, NULL),
(54, 29, 5, 1, 12, 'SYDI 0505', 'Slider 5(1).jpg', NULL, NULL),
(55, 29, 6, 1, 12, 'SYDI 0506', 'Slider 6(1).jpg', NULL, NULL),
(56, 29, 7, 1, 12, 'SYDI 0507', 'Slider 7(1).jpg', NULL, NULL),
(57, 29, 8, 1, 12, 'SYDI 0508', 'Slider 8(1).jpg', NULL, NULL),
(58, 29, 9, 1, 12, 'SYDI 0509', 'Slider 9.jpg', NULL, NULL),
(59, 28, 2, 1, 3, 'SYDI 0402', NULL, NULL, NULL),
(60, 28, 3, 1, 6, 'SYDI 0403', NULL, '<p style=\"text-align:justify\"><span style=\"color:#c0392b\">&bull; Job orientation &ndash; to educate teens about the job market</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#c0392b\">&bull; Soft and basic skills training &ndash; to enable access to the job market</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#c0392b\">&bull; Exposure to professional working environment &ndash; to gain initial work experience</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#c0392b\">&bull; Training and support for establishing own businesses</span></p>', NULL),
(61, 28, 4, 1, 3, 'SYDI 0404', NULL, NULL, NULL),
(62, 28, 5, 1, 12, 'SYDI 0405', NULL, '<p style=\"text-align:center\">The program started in four countries in 2011 and expanded rapidly to 26 countries worldwide by 2015 and in 2017 it was launched in Syria.</p>\r\n\r\n<p style=\"text-align:center\">In Syria DGF support SOS by training a group of SOS youths on the above categories by specialized DHL trainers. The project started in 2017 and is still ongoing</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_block_type`
--

DROP TABLE IF EXISTS `cpy_block_type`;
CREATE TABLE IF NOT EXISTS `cpy_block_type` (
  `type_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `type_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_block_type`
--

INSERT INTO `cpy_block_type` (`type_id`, `type_name`) VALUES
(3, 'Image Gallery'),
(5, 'News'),
(2, 'Slider'),
(1, 'Text'),
(4, 'Wide Image');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_news`
--

DROP TABLE IF EXISTS `cpy_news`;
CREATE TABLE IF NOT EXISTS `cpy_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `news_date` date NOT NULL COMMENT 'News Date',
  `news_image` varchar(200) NOT NULL COMMENT 'News Cover Image',
  `news_title` varchar(200) NOT NULL COMMENT 'News Title',
  `news_stext` text,
  `news_text` text,
  PRIMARY KEY (`news_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_news`
--

INSERT INTO `cpy_news` (`news_id`, `status_id`, `news_date`, `news_image`, `news_title`, `news_stext`, `news_text`) VALUES
(2, 1, '2018-05-10', 'img2.jpg', 'Participation at \"Techno Build” Exhibition 2018', NULL, '<p style=\"text-align:justify\">DHL Global Forwarding Syria participated in &quot;Techno Build&rdquo; Exhibition that was organized by Tayara Establishment for Exhibitions and Conferences at Damascus Fairgrounds from 10 to 14 May 2018. The exhibition included more than 80 Syrian and International Exhibitors from several construction and re-building companies. Represented by its exclusive agent in Syria, Nazha Logistics, DHL Global Forwarding participation in this exhibition came as it is one of the biggest international companies that support and develop construction by providing comprehensive, smart and flexible logistics solutions through its dedicated team of specialized experts and worldwide network</p>'),
(3, 1, '2019-01-12', '02b814765c80add12980b28c8d67bd9e.jpg', 'new event', NULL, '<p>fkjgh lsdfhgl sdf</p>\r\n\r\n<p>f sdlkgh ldfsg</p>\r\n\r\n<p>sdf lghsdf lkgsdf</p>\r\n\r\n<p>&nbsp;sdfhgl dskf</p>\r\n\r\n<p>&nbsp;</p>'),
(4, 1, '2019-01-16', '207505-1000-144716078614597160-R3L8T8D-1000-14.jpg', 'cvhjjjh', NULL, '<p>dfgjdyjdfhjdfhjjdfhjhddfjj</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_news_images`
--

DROP TABLE IF EXISTS `cpy_news_images`;
CREATE TABLE IF NOT EXISTS `cpy_news_images` (
  `nimg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `news_id` int(11) NOT NULL COMMENT 'Parent',
  `nimg_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Image Order',
  `nimg_photo` varchar(200) NOT NULL COMMENT 'Image',
  PRIMARY KEY (`nimg_id`),
  KEY `news_id` (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_news_images`
--

INSERT INTO `cpy_news_images` (`nimg_id`, `news_id`, `nimg_order`, `nimg_photo`) VALUES
(1, 2, 1, 'Nazha Logo.png'),
(2, 2, 2, '210005-1000-1447160788eio-u-io-io-1000-1446447971.jpg'),
(3, 4, 0, 'Picture003.jpg'),
(4, 4, 1, 'Picture010.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_page`
--

DROP TABLE IF EXISTS `cpy_page`;
CREATE TABLE IF NOT EXISTS `cpy_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `page_name` varchar(200) NOT NULL COMMENT 'Name',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `slid_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Slider FK',
  `page_stext` text COMMENT 'Search Text',
  `page_desc` text COMMENT 'Description',
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `page_name` (`page_name`),
  KEY `slid_id` (`slid_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_page`
--

INSERT INTO `cpy_page` (`page_id`, `page_name`, `status_id`, `slid_id`, `page_stext`, `page_desc`) VALUES
(0, 'Home Page', 1, 1, 'Home Page', 'Home Page'),
(1, 'Air Freight', 1, 1, 'Air Freight', 'Airfreight Export and Airfreight Import are products that predominately use air mode and offers a choice in delivery speeds to best suit customer requirements....'),
(2, 'Ocean Freight', 1, 1, 'Ocean Freight', '<p><strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Ocean Freight Export and Ocean Freight Import</span></span></strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">; with our broad range of Ocean Freight products covering different equipment types and consolidation services, we ensure your cargo reaches the right place, at the right time in a cost-efficient way. We work with a spread of ocean carriers covering major carrier alliances with planned space protection from every major container port in the world to deliver reliability...</span></span></p>'),
(3, 'Road Freight', 1, 1, 'Road Freight', '<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">We provide Road Freight Import, Export and within the country regular transportation (with a range of additional services), giving you truly extensive coverage at domestic and international level. With our dispatch flexibility and long term co-operation with trucking specialists, DHL Freight handles regular part loads, as well as full loads, safely and punctually in all directions...</span></span></p>'),
(4, 'Intermodal & Multimodal Transport', 1, 1, 'Intermodal & Multimodal Transport', '<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Road-Air and Ocean-Air Combing the speed of air freight with the economy of ocean freight / road freight we offer faster transit times at a considerably lower cost and lower carbon footprint than pure air freight.<br />\r\nEnsuring cargo remains in DHL&rsquo;s control at all times, this product offers a multi-modal service...</span></span></p>'),
(5, 'Customs Clearance', 1, 1, 'Customs Clearance', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We have long experience in customs clearance we handle clearance at </span></strong></span></span></p>\r\n\r\n<ul style=\"list-style-type:square\">\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Airports</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Ports</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Cross borders</span></span></span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Customs secretariats </span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Free Zones.</span></span></p>'),
(6, 'Warehousing', 1, 1, 'Warehousing', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We offer warehouse management at any location in the country based on customer requirements.</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">DHL Global Forwarding Damascus Logistics Facility:<br />\r\nLocated 7 KM from Damascus Airport and 23 KM from Damascus city center.<br />\r\nTotal Land area: 110,000 sqm, out of which 40,000 sqm are encircled by a 3.5 m high fence; this part contains the present warehouses and offices...</span></span></p>'),
(7, 'Packing & Removal', 1, 1, 'Packing & Removal', '<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Our mission is turning your Packing &amp; Removal experience into an exciting, enjoyable and Stress Free task.<br />\r\nOne stop shopping point as follows:</span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Packing</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Storage </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Customs Clearance</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Shipping Services: Airfreight, Ocean Freight and Road Freight</span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Destination Services </span></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Unpacking and removal of debris....</span></span></span></li>\r\n</ul>'),
(8, 'Projects', 1, 1, 'Projects', '<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">DHL understands the unique logistics challenges related to projects shipments. We provide a range of services that help align logistics operations with your business strategies. Our processes, technology and people drive cost and capital out of your operations, whilst ensuring consistent and predictable service...</span></span></p>'),
(9, 'Fairs & Events', 1, 1, 'Fairs & Events', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We offer complete logistics services for both Fairs &amp; Events Organizers and Clients.</span></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><strong>Infrastructure</strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">We accompany you! Wherever your customers and suppliers need us - we are already there </span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Our <strong>specialists</strong> are located around the globe and support you at <strong>every location worldwide</strong></span></span></li>\r\n	<li style=\"text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Organizers and venues worldwide <strong>trust</strong> in us and appoint DHL as <strong>official forwarder</strong></span></span></li>\r\n	<li style=\"text-align:left\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Dedicated network </span></span></strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">of experienced operations personnel</span></span></li>\r\n</ul>'),
(10, 'Aid & Relief Services', 1, 1, 'Aid & Relief Services', '<p><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Due to the need of logistics services for the humanitarian aid across the country, DHL Global Forwarding -Syria set up a department under the name of Aid &amp; Relief Services responsible for the Humanitarian Aid Logistics within Syria through the following services...</span></span></strong></p>'),
(11, 'Environment protection', 1, 1, 'Environment protection', '<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Committed to sustainable development, we create innovative, effective, environmentally friendly logistics services that fulfill customer\'s needs, while minimizing undesirable impacts</span></span></p>'),
(12, 'Culture Support', 1, 1, 'Culture Support', '<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">DHL Global Forwarding Syria has launched its project of sponsoring, encouraging and spreading Culture in all its aspects in Syria</span></span></p>'),
(13, 'Syrian Youth Development Initiative', 1, 1, 'Syrian Youth Development Initiative', '<p><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Due to the impacts caused by the Syrian crisis, there was a clear need to switch CSR into this phase priorities, Syrian youth need tools to enable them enhance their knowledge and skills, which will prepare them for better future and empower them to be part of the reconstruction of Syria; thus we launched the &ldquo;<strong>Syrian Youth Development Initiative&rdquo;...</strong></span></span></p>'),
(14, 'Nazha Logistics', 1, 1, 'Nazha Logistics', '<p style=\"margin-left:0cm; margin-right:36pt; text-align:left\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\">Nazha Logistics is the Exclusive Agent of DHL Global Forwarding / DHL Freight in Syria and the logistics market leader locally. </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">DHL is present in over 220 countries and territories across the globe, making it the most international company in the world. With a workforce exceeding 350,000 employees, DHL provides solutions for an almost infinite number of logistics needs...</span></span></p>'),
(15, 'Quality Assurance', 1, 1, 'Quality Assurance', '<p><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Nazha Logistics the Exclusive Agent of DHL Global Forwarding<span style=\"background-color:white\"> in Syria </span>believes that success depends on the supply of high quality logistic services that meet or exceed customer expectations...</span></span></p>'),
(16, 'Insurance', 1, 1, 'Insurance', '<p><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Insurance services that offer our customers financial protection against all risks of physical loss or damage from any external cause such as fire, storms, thunderbolts and other standard insured risks for the total amount of the stored materials...</span></span></p>'),
(17, 'Contact Us', 1, 1, 'Contact Us', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Nazha Logistics LLC - Exclusive Agent of DHL Global Forwarding in Syria.</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Sabbagh Building, Victoria Bridge. </span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:9.0pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Damascus &ndash; Syria. </span></span></span></span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_page_block`
--

DROP TABLE IF EXISTS `cpy_page_block`;
CREATE TABLE IF NOT EXISTS `cpy_page_block` (
  `pblk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `page_id` int(11) NOT NULL COMMENT 'Page FK',
  `blk_id` int(11) NOT NULL COMMENT 'Block FK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `pblk_order` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Order',
  `pblk_name` varchar(200) NOT NULL COMMENT 'Name',
  `pblk_bgcolor` varchar(50) DEFAULT NULL COMMENT 'Background Color',
  `pblk_stext` text COMMENT 'Search Text',
  PRIMARY KEY (`pblk_id`),
  UNIQUE KEY `pblk_name` (`page_id`,`pblk_name`),
  KEY `blk_id` (`blk_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_page_block`
--

INSERT INTO `cpy_page_block` (`pblk_id`, `page_id`, `blk_id`, `status_id`, `pblk_order`, `pblk_name`, `pblk_bgcolor`, `pblk_stext`) VALUES
(1, 0, 1, 1, 1, 'Welcome Message', '0', NULL),
(2, 0, 4, 1, 2, 'Home Wide Image 11-2018', '0', NULL),
(4, 0, 2, 1, 3, 'About', '0', NULL),
(5, 0, 5, 1, 4, 'News', '#CECECE', NULL),
(8, 1, 7, 1, 1, 'Air Freight 01', '0', NULL),
(9, 2, 8, 1, 0, 'Ocean Freight', '0', NULL),
(10, 3, 9, 1, 0, 'Road Freight', '0', NULL),
(11, 4, 10, 1, 0, 'Intermodal & Multimodal Transport', '0', NULL),
(12, 5, 11, 1, 0, 'Customs Clearance', '0', NULL),
(13, 6, 12, 1, 0, 'Warehousing', '0', NULL),
(14, 7, 13, 1, 0, 'Packing & Removal', '0', 'Packing & Removal'),
(15, 8, 14, 1, 0, 'Projects', '0', NULL),
(16, 9, 15, 1, 0, 'Fairs & Events', '0', 'Fairs & Events'),
(17, 10, 16, 1, 0, 'Aid & Relief Services', '0', 'Aid & Relief Services'),
(18, 11, 17, 1, 0, 'Environment protection', '0', NULL),
(19, 12, 17, 1, 0, 'Culture Support', '0', NULL),
(21, 14, 18, 1, 0, 'Nazha Logistics', NULL, 'Nazha Logistics'),
(22, 15, 19, 1, 0, 'Quality Assurance', '0', 'Quality Assurance'),
(23, 16, 20, 1, 0, 'Insurance', '0', NULL),
(24, 17, 21, 1, 0, 'Contact Us', '0', 'Contact Us'),
(25, 1, 23, 1, 2, 'Air Freight 02', '0', NULL),
(26, 1, 22, 1, 3, 'Air Freight 03', '#CECECE', NULL),
(27, 1, 24, 1, 4, 'Air Freight 04', '0', NULL),
(28, 13, 25, 1, 1, 'SYDI 01', '0', NULL),
(29, 13, 26, 1, 2, 'SYDI 02', '#CECECE', NULL),
(30, 13, 27, 1, 3, 'SYDI 03', '0', NULL),
(31, 13, 28, 1, 4, 'SYDI 04', '#CECECE', NULL),
(32, 13, 29, 1, 5, 'SYDI 05', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cpy_pgroup`
--

DROP TABLE IF EXISTS `cpy_pgroup`;
CREATE TABLE IF NOT EXISTS `cpy_pgroup` (
  `pgrp_id` int(10) NOT NULL COMMENT 'PK',
  `pgrp_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`pgrp_id`),
  UNIQUE KEY `pgrp_name` (`pgrp_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_pgroup`
--

INSERT INTO `cpy_pgroup` (`pgrp_id`, `pgrp_name`) VALUES
(-1, 'Administrators'),
(0, 'Consultant'),
(1, 'Registered Users');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_slider_mst`
--

DROP TABLE IF EXISTS `cpy_slider_mst`;
CREATE TABLE IF NOT EXISTS `cpy_slider_mst` (
  `slid_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `slid_name` varchar(200) NOT NULL COMMENT 'Slider Name',
  `slid_rem` varchar(200) DEFAULT NULL COMMENT 'Slider Remark',
  PRIMARY KEY (`slid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_slider_mst`
--

INSERT INTO `cpy_slider_mst` (`slid_id`, `slid_name`, `slid_rem`) VALUES
(1, 'Main Slider', 'Main Slider');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_slider_trn`
--

DROP TABLE IF EXISTS `cpy_slider_trn`;
CREATE TABLE IF NOT EXISTS `cpy_slider_trn` (
  `tslid_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `slid_id` int(11) NOT NULL COMMENT 'Parent',
  `slid_order` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Slide Order',
  `slid_header` varchar(200) DEFAULT NULL,
  `slid_link` varchar(200) DEFAULT NULL,
  `slid_label` varchar(200) DEFAULT NULL,
  `slid_text` text,
  `slid_photo` varchar(200) NOT NULL COMMENT 'Image',
  PRIMARY KEY (`tslid_id`),
  KEY `slid_id` (`slid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_slider_trn`
--

INSERT INTO `cpy_slider_trn` (`tslid_id`, `slid_id`, `slid_order`, `slid_header`, `slid_link`, `slid_label`, `slid_text`, `slid_photo`) VALUES
(1, 1, 0, 'Expore the power<br> <span class=\"carousel-title-normal\">of Metronic</span>', '#', 'Purchase Now!', 'This is what you were looking for', 'bg9.jpg'),
(2, 1, 1, '<span style=\'background-color: red;\'>Need a website design?</span>', '', 'Go', 'Lorem ipsum dolor sit amet,<br> consectetur adipiscing elit.\r\nSed est nunc,<br> sagittis at consectetur id. ', 'bg1.jpg'),
(3, 1, 3, '<span style=\'background-color: blue;\'>Powerful & Clean</span>', NULL, NULL, 'Responsive Website & Admin Theme<br>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit.<br>\r\nSed est nunc, sagittis at consectetur id. ', 'bg2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cpy_user`
--

DROP TABLE IF EXISTS `cpy_user`;
CREATE TABLE IF NOT EXISTS `cpy_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `cntry_id` int(11) NOT NULL COMMENT 'Country',
  `lang_id` int(11) NOT NULL COMMENT 'Language',
  `pgrp_id` int(11) NOT NULL DEFAULT '1' COMMENT ' Type',
  `status_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Status',
  `gend_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Gender',
  `user_name` varchar(200) NOT NULL COMMENT 'Name',
  `user_email` varchar(200) NOT NULL COMMENT 'Email, Logon Name, UK',
  `user_password` varchar(200) NOT NULL COMMENT 'Passowrd',
  `user_mobile` varchar(200) DEFAULT NULL COMMENT 'Mobile Number',
  `user_token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `ins_datetime` timestamp NULL DEFAULT NULL COMMENT 'Created datetime',
  `upd_datetime` timestamp NULL DEFAULT NULL COMMENT 'Last Updated Datetime',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_token` (`user_token`),
  KEY `cntry_id` (`cntry_id`),
  KEY `lang_id` (`lang_id`),
  KEY `user_type` (`pgrp_id`),
  KEY `user_Status` (`status_id`),
  KEY `user_gender` (`gend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cpy_user`
--

INSERT INTO `cpy_user` (`user_id`, `cntry_id`, `lang_id`, `pgrp_id`, `status_id`, `gend_id`, `user_name`, `user_email`, `user_password`, `user_mobile`, `user_token`, `ins_datetime`, `upd_datetime`) VALUES
(1, 213, 2, -1, 1, 1, 'Administrator', 'admin@doctorx.cc', '123456', NULL, NULL, '2018-12-22 15:48:37', NULL),
(2, 213, 2, 0, 1, 2, 'Dr Hala', 'hala@doctorx.cc', '123456', NULL, NULL, '2018-12-22 15:50:30', '2018-12-22 15:51:35');

-- --------------------------------------------------------

--
-- Stand-in structure for view `cpy_vblock`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `cpy_vblock`;
CREATE TABLE IF NOT EXISTS `cpy_vblock` (
`blk_id` int(11)
,`blk_name` varchar(200)
,`blk_status_id` tinyint(4)
,`type_id` tinyint(4)
,`blk_stext` text
,`dblk_id` int(11)
,`dblk_order` smallint(6)
,`dblk_status_id` tinyint(4)
,`col_id` tinyint(4)
,`dblk_name` varchar(200)
,`dblk_image` varchar(200)
,`dblk_text` text
,`dblk_stext` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cpy_vpage`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `cpy_vpage`;
CREATE TABLE IF NOT EXISTS `cpy_vpage` (
`page_id` int(11)
,`page_name` varchar(200)
,`page_status_id` tinyint(4)
,`slid_id` int(11)
,`page_stext` text
,`pblk_id` int(11)
,`blk_id` int(11)
,`pblk_status_id` tinyint(4)
,`pblk_order` smallint(6)
,`pblk_name` varchar(200)
,`pblk_bgcolor` varchar(50)
,`pblk_stext` text
);

-- --------------------------------------------------------

--
-- Table structure for table `phs_country`
--

DROP TABLE IF EXISTS `phs_country`;
CREATE TABLE IF NOT EXISTS `phs_country` (
  `cntry_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL COMMENT 'Status',
  `cntry_code` varchar(2) NOT NULL DEFAULT '' COMMENT 'Country Code',
  `cntry_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Country Name',
  PRIMARY KEY (`cntry_id`),
  UNIQUE KEY `cntry_name` (`cntry_name`),
  UNIQUE KEY `cntry_code` (`cntry_code`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_country`
--

INSERT INTO `phs_country` (`cntry_id`, `status_id`, `cntry_code`, `cntry_name`) VALUES
(1, 1, 'AF', 'Afghanistan'),
(2, 1, 'AL', 'Albania'),
(3, 1, 'DZ', 'Algeria'),
(4, 1, 'DS', 'American Samoa'),
(5, 1, 'AD', 'Andorra'),
(6, 1, 'AO', 'Angola'),
(7, 1, 'AI', 'Anguilla'),
(8, 1, 'AQ', 'Antarctica'),
(9, 1, 'AG', 'Antigua and Barbuda'),
(10, 1, 'AR', 'Argentina'),
(11, 1, 'AM', 'Armenia'),
(12, 1, 'AW', 'Aruba'),
(13, 1, 'AU', 'Australia'),
(14, 1, 'AT', 'Austria'),
(15, 1, 'AZ', 'Azerbaijan'),
(16, 1, 'BS', 'Bahamas'),
(17, 1, 'BH', 'Bahrain'),
(18, 1, 'BD', 'Bangladesh'),
(19, 1, 'BB', 'Barbados'),
(20, 1, 'BY', 'Belarus'),
(21, 1, 'BE', 'Belgium'),
(22, 1, 'BZ', 'Belize'),
(23, 1, 'BJ', 'Benin'),
(24, 1, 'BM', 'Bermuda'),
(25, 1, 'BT', 'Bhutan'),
(26, 1, 'BO', 'Bolivia'),
(27, 1, 'BA', 'Bosnia and Herzegovina'),
(28, 1, 'BW', 'Botswana'),
(29, 1, 'BV', 'Bouvet Island'),
(30, 1, 'BR', 'Brazil'),
(31, 1, 'IO', 'British Indian Ocean Territory'),
(32, 1, 'BN', 'Brunei Darussalam'),
(33, 1, 'BG', 'Bulgaria'),
(34, 1, 'BF', 'Burkina Faso'),
(35, 1, 'BI', 'Burundi'),
(36, 1, 'KH', 'Cambodia'),
(37, 1, 'CM', 'Cameroon'),
(38, 1, 'CA', 'Canada'),
(39, 1, 'CV', 'Cape Verde'),
(40, 1, 'KY', 'Cayman Islands'),
(41, 1, 'CF', 'Central African Republic'),
(42, 1, 'TD', 'Chad'),
(43, 1, 'CL', 'Chile'),
(44, 1, 'CN', 'China'),
(45, 1, 'CX', 'Christmas Island'),
(46, 1, 'CC', 'Cocos (Keeling) Islands'),
(47, 1, 'CO', 'Colombia'),
(48, 1, 'KM', 'Comoros'),
(49, 1, 'CG', 'Congo'),
(50, 1, 'CK', 'Cook Islands'),
(51, 1, 'CR', 'Costa Rica'),
(52, 1, 'HR', 'Croatia (Hrvatska)'),
(53, 1, 'CU', 'Cuba'),
(54, 1, 'CY', 'Cyprus'),
(55, 1, 'CZ', 'Czech Republic'),
(56, 1, 'DK', 'Denmark'),
(57, 1, 'DJ', 'Djibouti'),
(58, 1, 'DM', 'Dominica'),
(59, 1, 'DO', 'Dominican Republic'),
(60, 1, 'TP', 'East Timor'),
(61, 1, 'EC', 'Ecuador'),
(62, 1, 'EG', 'Egypt'),
(63, 1, 'SV', 'El Salvador'),
(64, 1, 'GQ', 'Equatorial Guinea'),
(65, 1, 'ER', 'Eritrea'),
(66, 1, 'EE', 'Estonia'),
(67, 1, 'ET', 'Ethiopia'),
(68, 1, 'FK', 'Falkland Islands (Malvinas)'),
(69, 1, 'FO', 'Faroe Islands'),
(70, 1, 'FJ', 'Fiji'),
(71, 1, 'FI', 'Finland'),
(72, 1, 'FR', 'France'),
(73, 1, 'FX', 'France, Metropolitan'),
(74, 1, 'GF', 'French Guiana'),
(75, 1, 'PF', 'French Polynesia'),
(76, 1, 'TF', 'French Southern Territories'),
(77, 1, 'GA', 'Gabon'),
(78, 1, 'GM', 'Gambia'),
(79, 1, 'GE', 'Georgia'),
(80, 1, 'DE', 'Germany'),
(81, 1, 'GH', 'Ghana'),
(82, 1, 'GI', 'Gibraltar'),
(83, 1, 'GK', 'Guernsey'),
(84, 1, 'GR', 'Greece'),
(85, 1, 'GL', 'Greenland'),
(86, 1, 'GD', 'Grenada'),
(87, 1, 'GP', 'Guadeloupe'),
(88, 1, 'GU', 'Guam'),
(89, 1, 'GT', 'Guatemala'),
(90, 1, 'GN', 'Guinea'),
(91, 1, 'GW', 'Guinea-Bissau'),
(92, 1, 'GY', 'Guyana'),
(93, 1, 'HT', 'Haiti'),
(94, 1, 'HM', 'Heard and Mc Donald Islands'),
(95, 1, 'HN', 'Honduras'),
(96, 1, 'HK', 'Hong Kong'),
(97, 1, 'HU', 'Hungary'),
(98, 1, 'IS', 'Iceland'),
(99, 1, 'IN', 'India'),
(100, 1, 'IM', 'Isle of Man'),
(101, 1, 'ID', 'Indonesia'),
(102, 1, 'IR', 'Iran (Islamic Republic of)'),
(103, 1, 'IQ', 'Iraq'),
(104, 1, 'IE', 'Ireland'),
(105, 1, 'IL', 'Israel'),
(106, 1, 'IT', 'Italy'),
(107, 1, 'CI', 'Ivory Coast'),
(108, 1, 'JE', 'Jersey'),
(109, 1, 'JM', 'Jamaica'),
(110, 1, 'JP', 'Japan'),
(111, 1, 'JO', 'Jordan'),
(112, 1, 'KZ', 'Kazakhstan'),
(113, 1, 'KE', 'Kenya'),
(114, 1, 'KI', 'Kiribati'),
(115, 1, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 1, 'KR', 'Korea, Republic of'),
(117, 1, 'XK', 'Kosovo'),
(118, 1, 'KW', 'Kuwait'),
(119, 1, 'KG', 'Kyrgyzstan'),
(120, 1, 'LA', 'Lao People\'s Democratic Republic'),
(121, 1, 'LV', 'Latvia'),
(122, 1, 'LB', 'Lebanon'),
(123, 1, 'LS', 'Lesotho'),
(124, 1, 'LR', 'Liberia'),
(125, 1, 'LY', 'Libyan Arab Jamahiriya'),
(126, 1, 'LI', 'Liechtenstein'),
(127, 1, 'LT', 'Lithuania'),
(128, 1, 'LU', 'Luxembourg'),
(129, 1, 'MO', 'Macau'),
(130, 1, 'MK', 'Macedonia'),
(131, 1, 'MG', 'Madagascar'),
(132, 1, 'MW', 'Malawi'),
(133, 1, 'MY', 'Malaysia'),
(134, 1, 'MV', 'Maldives'),
(135, 1, 'ML', 'Mali'),
(136, 1, 'MT', 'Malta'),
(137, 1, 'MH', 'Marshall Islands'),
(138, 1, 'MQ', 'Martinique'),
(139, 1, 'MR', 'Mauritania'),
(140, 1, 'MU', 'Mauritius'),
(141, 1, 'TY', 'Mayotte'),
(142, 1, 'MX', 'Mexico'),
(143, 1, 'FM', 'Micronesia, Federated States of'),
(144, 1, 'MD', 'Moldova, Republic of'),
(145, 1, 'MC', 'Monaco'),
(146, 1, 'MN', 'Mongolia'),
(147, 1, 'ME', 'Montenegro'),
(148, 1, 'MS', 'Montserrat'),
(149, 1, 'MA', 'Morocco'),
(150, 1, 'MZ', 'Mozambique'),
(151, 1, 'MM', 'Myanmar'),
(152, 1, 'NA', 'Namibia'),
(153, 1, 'NR', 'Nauru'),
(154, 1, 'NP', 'Nepal'),
(155, 1, 'NL', 'Netherlands'),
(156, 1, 'AN', 'Netherlands Antilles'),
(157, 1, 'NC', 'New Caledonia'),
(158, 1, 'NZ', 'New Zealand'),
(159, 1, 'NI', 'Nicaragua'),
(160, 1, 'NE', 'Niger'),
(161, 1, 'NG', 'Nigeria'),
(162, 1, 'NU', 'Niue'),
(163, 1, 'NF', 'Norfolk Island'),
(164, 1, 'MP', 'Northern Mariana Islands'),
(165, 1, 'NO', 'Norway'),
(166, 1, 'OM', 'Oman'),
(167, 1, 'PK', 'Pakistan'),
(168, 1, 'PW', 'Palau'),
(169, 1, 'PS', 'Palestine'),
(170, 1, 'PA', 'Panama'),
(171, 1, 'PG', 'Papua New Guinea'),
(172, 1, 'PY', 'Paraguay'),
(173, 1, 'PE', 'Peru'),
(174, 1, 'PH', 'Philippines'),
(175, 1, 'PN', 'Pitcairn'),
(176, 1, 'PL', 'Poland'),
(177, 1, 'PT', 'Portugal'),
(178, 1, 'PR', 'Puerto Rico'),
(179, 1, 'QA', 'Qatar'),
(180, 1, 'RE', 'Reunion'),
(181, 1, 'RO', 'Romania'),
(182, 1, 'RU', 'Russian Federation'),
(183, 1, 'RW', 'Rwanda'),
(184, 1, 'KN', 'Saint Kitts and Nevis'),
(185, 1, 'LC', 'Saint Lucia'),
(186, 1, 'VC', 'Saint Vincent and the Grenadines'),
(187, 1, 'WS', 'Samoa'),
(188, 1, 'SM', 'San Marino'),
(189, 1, 'ST', 'Sao Tome and Principe'),
(190, 1, 'SA', 'Saudi Arabia'),
(191, 1, 'SN', 'Senegal'),
(192, 1, 'RS', 'Serbia'),
(193, 1, 'SC', 'Seychelles'),
(194, 1, 'SL', 'Sierra Leone'),
(195, 1, 'SG', 'Singapore'),
(196, 1, 'SK', 'Slovakia'),
(197, 1, 'SI', 'Slovenia'),
(198, 1, 'SB', 'Solomon Islands'),
(199, 1, 'SO', 'Somalia'),
(200, 1, 'ZA', 'South Africa'),
(201, 1, 'GS', 'South Georgia South Sandwich Islands'),
(202, 1, 'SS', 'South Sudan'),
(203, 1, 'ES', 'Spain'),
(204, 1, 'LK', 'Sri Lanka'),
(205, 1, 'SH', 'St. Helena'),
(206, 1, 'PM', 'St. Pierre and Miquelon'),
(207, 1, 'SD', 'Sudan'),
(208, 1, 'SR', 'Suriname'),
(209, 1, 'SJ', 'Svalbard and Jan Mayen Islands'),
(210, 1, 'SZ', 'Swaziland'),
(211, 1, 'SE', 'Sweden'),
(212, 1, 'CH', 'Switzerland'),
(213, 1, 'SY', 'Syrian Arab Republic'),
(214, 1, 'TW', 'Taiwan'),
(215, 1, 'TJ', 'Tajikistan'),
(216, 1, 'TZ', 'Tanzania, United Republic of'),
(217, 1, 'TH', 'Thailand'),
(218, 1, 'TG', 'Togo'),
(219, 1, 'TK', 'Tokelau'),
(220, 1, 'TO', 'Tonga'),
(221, 1, 'TT', 'Trinidad and Tobago'),
(222, 1, 'TN', 'Tunisia'),
(223, 1, 'TR', 'Turkey'),
(224, 1, 'TM', 'Turkmenistan'),
(225, 1, 'TC', 'Turks and Caicos Islands'),
(226, 1, 'TV', 'Tuvalu'),
(227, 1, 'UG', 'Uganda'),
(228, 1, 'UA', 'Ukraine'),
(229, 1, 'AE', 'United Arab Emirates'),
(230, 1, 'GB', 'United Kingdom'),
(231, 1, 'US', 'United States'),
(232, 1, 'UM', 'United States minor outlying islands'),
(233, 1, 'UY', 'Uruguay'),
(234, 1, 'UZ', 'Uzbekistan'),
(235, 1, 'VU', 'Vanuatu'),
(236, 1, 'VA', 'Vatican City State'),
(237, 1, 'VE', 'Venezuela'),
(238, 1, 'VN', 'Vietnam'),
(239, 1, 'VG', 'Virgin Islands (British)'),
(240, 1, 'VI', 'Virgin Islands (U.S.)'),
(241, 1, 'WF', 'Wallis and Futuna Islands'),
(242, 1, 'EH', 'Western Sahara'),
(243, 1, 'YE', 'Yemen'),
(244, 1, 'ZR', 'Zaire'),
(245, 1, 'ZM', 'Zambia'),
(246, 1, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `phs_gender`
--

DROP TABLE IF EXISTS `phs_gender`;
CREATE TABLE IF NOT EXISTS `phs_gender` (
  `gend_id` tinyint(4) NOT NULL COMMENT 'PK',
  `gend_name` varchar(100) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`gend_id`),
  UNIQUE KEY `gend_name` (`gend_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_gender`
--

INSERT INTO `phs_gender` (`gend_id`, `gend_name`) VALUES
(2, 'Female'),
(1, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `phs_keys`
--

DROP TABLE IF EXISTS `phs_keys`;
CREATE TABLE IF NOT EXISTS `phs_keys` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `key_name` varchar(100) NOT NULL COMMENT 'Status',
  `key_defvalue` varchar(100) NOT NULL COMMENT 'Default Value',
  PRIMARY KEY (`key_id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1312 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_keys`
--

INSERT INTO `phs_keys` (`key_id`, `key_name`, `key_defvalue`) VALUES
(1128, 'Info', 'Info'),
(1129, 'Info Mail', 'Info Mail'),
(1130, 'Phone No', '+1 2345 6789'),
(1131, 'about', 'about'),
(1155, 'home', 'home'),
(1157, 'language', 'language'),
(1170, 'notes', 'notes'),
(1234, 'ALL Rights Reserved.', 'ALL Rights Reserved.'),
(1246, 'Site-Name', 'PhSoft'),
(1247, 'Agent', 'Agent'),
(1248, 'Agents', 'Agents'),
(1249, 'Services', 'Services'),
(1250, 'Team', 'Team'),
(1251, 'Contact', 'Contact'),
(1252, 'About us', 'About us'),
(1253, 'Sign In', 'Sign In'),
(1254, 'Talk About US', 'Talk About US'),
(1255, 'Contact Us', 'Contact Us'),
(1256, 'Address', 'Address'),
(1257, 'Phone', 'Phone'),
(1258, 'Email', 'Email'),
(1259, 'Website', 'Website'),
(1260, 'Name', 'Name'),
(1261, 'Email Address', 'Email Address'),
(1262, 'Subject', 'Subject'),
(1263, 'Enter your message', 'Enter your message'),
(1264, 'Send Now', 'Send Now'),
(1265, 'mail-form-status-message', 'mail-form-status-message'),
(1266, 'Start Now', 'Start Now'),
(1267, 'Clients', 'Clients'),
(1268, 'Subscribe', 'Subscribe'),
(1269, 'CRM', 'CRM'),
(1270, 'Fax', 'Fax'),
(1271, 'Sale', 'Sale'),
(1272, 'Rent', 'Rent'),
(1273, 'none', 'none'),
(1309, 'Log In', 'Log In'),
(1310, 'Registration', 'Registration'),
(1311, 'Powered by:', 'Powered By: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">PhSoft Team</a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `phs_keyvalues`
--

DROP TABLE IF EXISTS `phs_keyvalues`;
CREATE TABLE IF NOT EXISTS `phs_keyvalues` (
  `kval_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `key_id` int(11) NOT NULL COMMENT 'Key FK',
  `lang_id` int(11) NOT NULL COMMENT 'Language FK',
  `key_value` varchar(250) NOT NULL COMMENT 'Value',
  `key_rvalue` varchar(250) NOT NULL COMMENT 'Related Value',
  `key_text` text COMMENT 'Text',
  PRIMARY KEY (`kval_id`),
  UNIQUE KEY `keyLang` (`key_id`,`lang_id`),
  KEY `key_value` (`key_value`),
  KEY `key_rvalue` (`key_rvalue`),
  KEY `key_id` (`key_id`),
  KEY `lang_id_2` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1420 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_keyvalues`
--

INSERT INTO `phs_keyvalues` (`kval_id`, `key_id`, `lang_id`, `key_value`, `key_rvalue`, `key_text`) VALUES
(5, 0, 1, 'none', 'no value', NULL),
(989, 1131, 2, 'About', 'About', '<h1>About us</h1>\r\n\r\n<div class=\"content-page\">\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>\r\n\r\n<h2>Lorem ipsum dolor sit amet</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</p>\r\n\r\n<h3>Investigationes demonstraverunt</h3>\r\n\r\n<ul>\r\n	<li>Lorem ipsum dolor sit amet</li>\r\n	<li>Claritas est etiam processus dynamicus</li>\r\n	<li>Duis autem vel eum iriure dolor</li>\r\n	<li>Eodem modo typi</li>\r\n</ul>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>\r\n\r\n<h2>Nam liber tempor cum soluta nobis</h2>\r\n\r\n<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>\r\n</div>'),
(1013, 1155, 2, 'Home', '', NULL),
(1015, 1157, 2, 'Language', '', NULL),
(1028, 1170, 2, 'Notes', '', NULL),
(1053, 1131, 1, 'حول', 'حول', '<p dir=\"rtl\" style=\"text-align:justify\"><strong><span style=\"font-size:26px\">حول</span></strong></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">لكل الإطلاق التخطيط ان. أم وتم التبرعات التاريخ،. أم بعض وتنصيب العالم،. بداية السيطرة بحق عن, فعل تمهيد البولندي البشريةً في. إذ انه بالحرب والفلبين. يبق نقطة السيء ولكسمبورغ من, به، سياسة حاملات الحيلولة ثم.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">أخذ العدّ بلديهما و, بل أراضي سنغافورة حدى. الله بالعمل يكن لم, حدى أي سقوط المدن. ثمّة الجنوبي بعد ان, قد لها بينما بأيدي. بل كلّ الجنود بالمطالبة, أم هذا كنقطة الساحة وهولندا،. حادثة الساحة المنتصر بل لكل, المشترك الخاصّة الإطلاق تم أما.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">كما لم مكّن أوزار, أي وزارة يتبقّ إستعمل دنو, وبداية ايطاليا، ما لها. ما هناك ساعة نفس, هاربر العسكري وقد أن. شاسعة ليركز ديسمبر لها مع, ودول فاتّبع يتم لم. فكان أخرى والحزب بين ٣٠. هو نفس حاول اليها وصافرات.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">تم تعد ألمّ تنفّس ممثّلة. بداية تصرّف الثانية ان تحت. غير جيوب واستمرت ما, من لكل فاتّبع بالمحور اقتصادية, دول مسرح بلاده ان. وقام الصعداء ومطالبة ذلك ثم. تسبب الأبرياء عن أخذ, ان عقبت والكساد المتّبعة يبق. شيء من الله الضغوط بالرّغم, فرنسية الشمال المجتمع بل فقد.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">٣٠ مما أجزاء الأوربيين. أن الصين وبحلول الحكومة بحق, إذ غير فمرّ ويكيبيديا. حتى ٢٠٠٤ تحرّك ابتدعها عل. تونس عالمية أخر هو, بين بل جنوب مرمى, بينما الإتحاد هذا أي. دول فشكّل معزّزة ماليزيا، قد, دون إذ إحكام التخطيط. مما بخطوط الثقيل تم, عن ليركز الحيلولة فصل.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">فعل قد فرنسية ومطالبة. الدول نتيجة وحلفاؤها نفس عن. لان ٣٠ بتحدّي الرئيسية وبالتحديد،, عل دون جورج والروسية. بها معاملة المواد ثم, انه هو وبدون اسبوعين بالمطالبة.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">دنو في ومضى أفاق تمهيد. أما عن قامت مشارف ليرتفع, أن سابق سبتمبر هذا. قد يكن كانت ا. ان قام وسوء والكساد, بحث اتّجة كثيرة أفريقيا قد. هو الحرة العالم، استمرار حدى, دار هو لإعادة ليرتفع, هذا لم وإعلان الإكتفاء.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">عل جُل خيار بمعارضة المؤلّفة, بحث تم الثالث الموسوعة. أم تعد اتّجة الباهضة بالسيطرة. جعل وقبل إجلاء قد. تعد تعديل إحكام يتبقّ ٣٠. هو به، بخطوط بزمام يعادل, جنوب العالم أن حتى, أم ٢٠٠٤ تجهيز بالفشل انه. دون لأداء الإيطالية ٣٠, دار الفترة بمحاولة ولاتّساع مع.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">مايو ليبين بل ذلك, تم كان البولندي بالمطالبة, أم وصل هناك عشوائية. إعمار انتصارهم عن وفي, عل رئيس ومضى لمحاكم أسر. لم دارت وعلى مواقعها مدن. بلا عقبت بقسوة تكتيكاً مع, أخذ هو أخرى سبتمبر.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">جورج وزارة غريمه لم قام, إذ فصل لتقليعة لإنعدام, عن وصل حقول الأثناء،. أثره، التّحول عن مدن, عدد ما فشكّل ا, قد ذات استبدال التخطيط. شدّت مليارات مكن إذ, أملاً أثره، للمجهود و أضف, ٠٨٠٤ ماشاء قد تلك. وسفن لليابان ولم إذ, من على ثانية هاربر, يبق إحتار بتحدّي المشترك ان.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">جهة إذ حكومة الخاطفة تغييرات, وقد عن قِبل بأيدي الجديدة،, حدى أجزاء تزامناً ان. عل فرنسا قُدُماً حيث. بـ كانتا تغييرات الإتحاد كان. تم ذلك بزمام أعمال المنتصر.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">ذلك والكوري والنرويج الدنمارك أن. الأخذ أفريقيا وصل لم, عن ولم تاريخ واندونيسيا،. أم وقد أوروبا العالمي, احداث أطراف الصينية عل كلا, حين كل السبب إنطلاق. أن بلاده الخاسرة به،. و تلك الساحلية اليابان، اليابانية.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">تعداد والتي اعتداء لان أي, ما وأزيز اتفاقية كلّ. قامت لليابان بـ ذلك, كلا بـ قدما الحكومة انتصارهم. مرجع بقسوة عدم ثم. أي مكّن المتّبعة كلّ, اعلان وحلفاؤها الإتفاقية بـ وتم, مع بوابة الدولارات جعل.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">سقوط العظمى الصعداء ان فصل, وقد أطراف الخاطفة لم, لغزو بلاده والكساد ومن ما. وشعار وبغطاء لمحاكم جعل في. هو ثانية إحتار دون, مدن يعبأ وتتحمّل عل, ماشاء وبلجيكا، بها ثم. قبل ٣٠ السيطرة المتاخمة. أسر عن تحرّكت التكاليف. قد الا عجّل قُدُماً, بفرض بتحدّي الضغوط ان قام, قد جُل يذكر وجهان.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">عدم نتيجة النفط ثم, العالم، ويكيبيديا، أم أضف, القادة التغييرات ما كلا. بالرّد الشتاء الإمتعاض لها هو, وحتّى إجلاء للجزر عن تعد, كلّ أم السادس وفرنسا الأوضاع. يتم أدنى فشكّل المتحدة في. وعلى اتفاق المسرح بل أخذ, أم السبب الشهير اليميني كلّ. مدن اوروبا مسؤولية ما, جزيرتي والفرنسي مع كلّ.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">إحتار الشرقية والعتاد جُل أم, كان بل الأجل الحدود الحكومة. يطول لغزو ثم حيث, مشروط انتهت ويتّفق تحت عل, لم قررت مشروط بأضرار يتم. مما مع بسبب ايطاليا،, حين عل لفشل الحكومة. جعل هو سبتمبر الضغوط, شدّت وقدّموا في جهة. عُقر لإعادة فصل مع, من غير تونس ومضى الصفحة.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">مع بحث جزيرتي للمجهود, فكان بخطوط ا أم لها, الأحمر وهولندا، الأوروبية لان ٣٠. هناك أوروبا الا هو. أن الغالي للإتحاد جُل. إذ لفشل والنفيس مما, فكان هاربر أن كلا. وكسبت يتعلّق لم فقد. الهادي الإيطالية من أخر.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">فقد في وبغطاء بلديهما, كل وقد اكتوبر والعتاد التاريخ،. شيء لمحاكم الجنوب عل. تعد و بخطوط وقامت لهيمنة, أن هذه إستيلاء اليابان الجديدة،, أي الشمل ليتسنّى الجنوبي عدم. انه لمحاكم بمعارضة واندونيسيا، كل, كلّ عن زهاء غينيا الصفحات. فسقط بقسوة يتعلّق مع بلا.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">٣٠ أفاق جديدة عدم. و أخر عقبت إعادة, العالمي للأراضي ثم يبق. أراض جزيرتي التخطيط ولم بل, الرئيسية ويكيبيديا، المتساقطة، جُل عل. و قائمة الأبرياء ولم. عالمية أوراقهم وانتهاءً به، في, إعادة غينيا رجوعهم عن بين.</span></p>\r\n\r\n<p dir=\"rtl\" style=\"text-align:justify\"><span style=\"font-size:16px\">الأولى استدعى أي جهة, أم خلاف وإيطالي الطرفين وقد. مئات إعمار لم أخر, و نتيجة عليها يعادل مما, من فشكّل بالعمل مليارات يكن. شيء ان الخاسرة والإتحاد واندونيسيا،. الصفحات والنرويج كل حين. عن غير الضروري مواقعها, أم الستار مشاركة مليارات بها.</span></p>'),
(1077, 1155, 1, 'الرئيسية', '', NULL),
(1079, 1157, 1, 'اللغة', '', NULL),
(1092, 1170, 1, 'ملاحظات', '', NULL),
(1323, 1234, 1, 'جميع الحقوق محفوظة', '', NULL),
(1352, 1246, 1, 'PhSoft', '', NULL),
(1353, 1246, 2, 'PhSoft', '', NULL),
(1354, 1247, 1, 'وكيل', 'وكيل', NULL),
(1355, 1247, 2, 'Agent', 'Agent', NULL),
(1356, 1248, 1, 'وكلاؤنا', 'وكلاؤنا', NULL),
(1357, 1248, 2, 'Agents', 'Agents', NULL),
(1360, 1249, 1, 'خدماتنا', 'خدماتنا', NULL),
(1361, 1249, 2, 'Services', 'Services', NULL),
(1362, 1250, 1, 'فريقنا', 'فريقنا', NULL),
(1363, 1250, 2, 'Team', 'Team', NULL),
(1364, 1252, 1, 'من نحن', 'من نحن', NULL),
(1365, 1252, 2, 'About us', 'About us', NULL),
(1366, 1251, 1, 'اتصل', 'اتصل', NULL),
(1367, 1251, 2, 'Contact', 'Contact', NULL),
(1368, 1253, 1, 'دخول', 'دخول', NULL),
(1369, 1253, 2, 'Sign In', 'Sign In', NULL),
(1370, 1254, 1, 'قالوا فينا', 'قالوا فينا', NULL),
(1371, 1254, 2, 'Talk About US', 'Talk About US', NULL),
(1372, 1255, 1, 'اتصل بنا', 'اتصل بنا', NULL),
(1373, 1255, 2, 'Contact Us', 'Contact Us', NULL),
(1374, 1256, 1, 'العنوان', 'العنوان', NULL),
(1376, 1256, 2, 'Address', 'Address', NULL),
(1377, 1257, 1, 'الهاتف', 'الهاتف', NULL),
(1378, 1257, 2, 'Phone', 'Phone', NULL),
(1379, 1259, 1, 'الموقع الالكتروني', 'الموقع الالكتروني', NULL),
(1380, 1259, 2, 'Website', 'Website', NULL),
(1381, 1258, 1, 'بريد الكتروني', 'بريد الكتروني', NULL),
(1382, 1258, 2, 'Email', 'Email', NULL),
(1383, 1263, 1, 'ادخل رسالتك', 'ادخل رسالتك', NULL),
(1384, 1263, 2, 'Enter your message', 'Enter your message', NULL),
(1385, 1262, 1, 'الموضوع', 'الموضوع', NULL),
(1386, 1262, 2, 'Subject', 'Subject', NULL),
(1387, 1260, 1, 'الاسم', 'الاسم', NULL),
(1388, 1260, 2, 'Name', 'Name', NULL),
(1389, 1261, 1, 'البريد الالكتروني', 'البريد الالكتروني', NULL),
(1390, 1261, 2, 'Email Address', 'Email Address', NULL),
(1391, 1264, 1, 'ارسال', 'ارسال', NULL),
(1392, 1264, 2, 'Send Now', 'Send Now', NULL),
(1393, 1265, 1, 'شكرا لاتصالك بنا. سيحاول فريقنا الرد عليك في أقرب وقت ممكن', 'شكرا لاتصالك بنا. سيحاول فريقنا الرد عليك في أقرب وقت ممكن', NULL),
(1394, 1265, 2, 'Thank you for contact us. As early as possible we will contact you', 'Thank you for contact us. As early as possible we will contact you', NULL),
(1395, 1266, 1, 'ابدأ الآن', 'ابدأ الآن', NULL),
(1396, 1266, 2, 'Start Now', 'Start Now', NULL),
(1397, 1267, 1, 'زبائننا', 'زبائننا', NULL),
(1398, 1267, 2, 'Clients', 'Clients', NULL),
(1399, 1268, 1, 'اشترك معنا', 'اشترك معنا', NULL),
(1400, 1268, 2, 'Subscribe', 'Subscribe', NULL),
(1401, 1269, 1, 'خدمة الزبائن', 'خدمة الزبائن', NULL),
(1402, 1269, 2, 'CRM', 'CRM', NULL),
(1403, 1270, 1, 'فاكس', 'فاكس', NULL),
(1404, 1270, 2, 'Fax', 'Fax', NULL),
(1405, 1271, 1, 'مبيع', 'مبيع', NULL),
(1406, 1272, 1, 'إيجار', 'إيجار', NULL),
(1407, 1271, 2, 'Sale', 'Sale', NULL),
(1408, 1272, 2, 'Rent', 'Rent', NULL),
(1409, 1130, 1, '+1 2345 6789', '+1 2345 6789', NULL),
(1410, 1130, 2, '+1 2345 6789', '+1 2345 6789', NULL),
(1411, 1129, 1, 'info', 'info@site.com', NULL),
(1412, 1128, 1, 'بريد', '', NULL),
(1413, 1309, 1, 'دخول', '', NULL),
(1414, 1310, 1, 'تسجيل', '', NULL),
(1418, 1311, 1, 'تطوير: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">فريق PhSoft</a></p>', 'تطوير: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">فريق PhSoft</a></p>', NULL),
(1419, 1311, 2, 'Powered By: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">PhSoft Team</a></p>', 'Powered By: <a href=\"http://www.phsoft.biz/\" target=\"_BLANK\">PhSoft Team</a></p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phs_language`
--

DROP TABLE IF EXISTS `phs_language`;
CREATE TABLE IF NOT EXISTS `phs_language` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `lang_code` varchar(10) NOT NULL DEFAULT '' COMMENT 'Language Code',
  `lang_dir` varchar(10) NOT NULL DEFAULT '' COMMENT 'Language Direction',
  `lang_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Language Name',
  `lang_dname` varchar(200) DEFAULT NULL COMMENT 'Display Name',
  `lang_ccode` varchar(5) DEFAULT NULL COMMENT 'Country Code',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `lang_code` (`lang_code`),
  UNIQUE KEY `lang_name` (`lang_name`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_language`
--

INSERT INTO `phs_language` (`lang_id`, `status_id`, `lang_code`, `lang_dir`, `lang_name`, `lang_dname`, `lang_ccode`) VALUES
(1, 1, 'ar', 'rtl', 'Arabic', 'العربية', 'sa'),
(2, 1, 'en', 'ltr', 'English', 'English', 'gb'),
(3, 1, 'fr', 'LTR', 'Français', 'Éve et Adam', 'fr'),
(4, 1, 'es', 'LTR', 'Español', 'Adán y Eva', 'es'),
(5, 1, 'de', 'LTR', 'Deutsch', 'Eva und Adam', 'de'),
(7, 2, 'ru', 'LTR', 'русский', 'Ева и Адам', NULL),
(8, 2, 'en5', 'LTR', 'Dansk', 'Eva og Adam', NULL),
(9, 2, 'en6', 'LTR', 'Türk', 'Havva ve Adem', NULL),
(10, 2, 'en7', 'LTR', '中国', '亚当和夏娃', NULL),
(11, 2, 'en8', 'LTR', 'Italiano', 'Adamo ed Eva', NULL),
(12, 2, 'en9', 'RTL', 'فارسي', 'حوا و آدم', NULL),
(13, 2, 'en0', 'LTR', 'Kiswahili', 'Hawa na Adamu', NULL),
(14, 2, 'en11', 'LTR', 'Հայերեն', 'Ադամն ու Եվան', NULL),
(15, 2, 'en12', 'LTR', 'Bosanski', 'Adam i Eva', NULL),
(16, 2, 'en13', 'LTR', 'Nederlands', 'Eva en Adam', NULL),
(17, 2, 'en14', 'LTR', 'Filebenah', 'Sina Adan at Eba', NULL),
(18, 2, 'en15', 'LTR', 'Suomi', 'Eeva ja Aatami', NULL),
(19, 2, 'en16', 'LTR', 'ქართული ენის', 'ადამი და ევა', NULL),
(20, 2, 'en17', 'LTR', 'Ελληνικά', 'Αδάμ και Εύα', NULL),
(21, 2, 'en18', 'LTR', 'हिंदी', 'आदम और हव्वा', NULL),
(22, 2, 'en19', 'LTR', 'magyar', 'Ádám és Éva', NULL),
(23, 2, 'en20', 'LTR', 'bahasa Indonesia', 'Adam dan Hawa', NULL),
(24, 2, 'en21', 'LTR', '日本人', 'アダムとイヴ', NULL),
(25, 2, 'en22', 'LTR', '한국의', '아담과 이브', NULL),
(26, 2, 'en23', 'LTR', 'नेपाली भाषा', 'आदम र हव्वाले', NULL),
(27, 2, 'en24', 'LTR', 'português', 'Adão e Eva', NULL),
(28, 2, 'en25', 'LTR', 'limba română', 'Adam și Eva', NULL),
(29, 2, 'en26', 'LTR', 'svenska', 'Adam och Eva', NULL),
(30, 2, 'en27', 'LTR', 'ภาษาไทย', 'อาดัมและอีฟ', NULL),
(31, 2, 'en28', 'LTR', 'українська мова', 'Адам і Єва', NULL),
(32, 2, 'en29', 'LTR', 'tiếng Việt', 'Adam và Eve', NULL),
(33, 1, 'tr', 'ltr', 'Turkey', NULL, 'tr'),
(34, 1, 'sw', 'ltr', 'Sweden', NULL, 'se'),
(35, 1, 'be', 'ltr', 'Belgium', NULL, 'be');

-- --------------------------------------------------------

--
-- Table structure for table `phs_menu`
--

DROP TABLE IF EXISTS `phs_menu`;
CREATE TABLE IF NOT EXISTS `phs_menu` (
  `menu_id` int(10) NOT NULL COMMENT 'PK',
  `menu_pid` int(11) NOT NULL COMMENT 'Parent Menu',
  `type_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Type',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status',
  `menu_order` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Order to display menu',
  `menu_name` varchar(200) NOT NULL COMMENT 'Name',
  `menu_icon` varchar(50) DEFAULT NULL COMMENT 'Icon',
  `menu_href` varchar(200) DEFAULT NULL COMMENT 'Link',
  `menu_page` varchar(50) DEFAULT NULL COMMENT 'Page file name',
  PRIMARY KEY (`menu_id`),
  KEY `menu_type` (`type_id`),
  KEY `menu_status` (`status_id`),
  KEY `menu_pid` (`menu_pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_menu`
--

INSERT INTO `phs_menu` (`menu_id`, `menu_pid`, `type_id`, `status_id`, `menu_order`, `menu_name`, `menu_icon`, `menu_href`, `menu_page`) VALUES
(-1, -1, 0, 1, 0, 'Menu', NULL, NULL, NULL),
(0, 0, 0, 1, 0, 'Main Menu', NULL, NULL, NULL),
(1, -1, 1, 1, 0, 'Top Left Menu', NULL, NULL, NULL),
(2, -1, 2, 1, 0, 'Top Right Menu', NULL, NULL, NULL),
(10, 0, 10, 1, 0, 'Home', 'fa fa-home', NULL, 'page-main.php'),
(11, 0, 11, 1, 1, 'Mega Menu', NULL, NULL, NULL),
(12, 0, 12, 1, 1, 'Services', NULL, NULL, NULL),
(13, 0, 12, 1, 1, 'About', NULL, NULL, NULL),
(31, 1, 10, 1, 0, 'Phone No', 'fa fa-phone', NULL, NULL),
(32, 1, 10, 1, 0, 'Info', 'fa fa-envelope-o', 'mailto:info@site.com', NULL),
(51, 2, 10, 1, 0, 'Log In', 'fa fa-user', NULL, 'page-user-login.php'),
(52, 2, 10, 1, 0, 'Registration', 'fa fa-user-plus', NULL, 'page-user-reg.php'),
(101, 11, 12, 1, 1, 'Search', '', NULL, NULL),
(102, 11, 12, 1, 2, 'Portfolio', NULL, NULL, NULL),
(103, 11, 12, 1, 3, 'Blogs', NULL, NULL, NULL),
(121, 12, 12, 1, 1, 'OUR Services', NULL, NULL, 'page-services.php'),
(122, 12, 12, 1, 2, 'Prices', NULL, NULL, 'page-prices.php'),
(123, 12, 12, 1, 3, 'Gallery', NULL, NULL, 'page-gallery.php'),
(131, 13, 12, 1, 1, 'About us', NULL, NULL, 'page-about.php'),
(132, 13, 12, 1, 2, 'Contacts', NULL, NULL, 'page-contacts.php'),
(133, 13, 12, 1, 3, 'FAQs', NULL, NULL, 'page-faq.php'),
(134, 13, 12, 1, 4, 'Careers', NULL, NULL, 'page-careers.php'),
(135, 13, 12, 1, 5, 'Site Map', NULL, NULL, 'page-site-map.php'),
(1011, 101, 10, 1, 1, 'Search Result', NULL, NULL, 'page-search-result.php'),
(1012, 101, 10, 1, 1, 'Test Page', NULL, NULL, NULL),
(1021, 102, 10, 1, 1, 'Portfolio-2', NULL, NULL, 'page-portfolio-2.php'),
(1022, 102, 10, 1, 2, 'Portfolio-3', NULL, NULL, 'page-portfolio-3.php'),
(1023, 102, 10, 1, 3, 'Portfolio-4', NULL, NULL, 'page-portfolio-4.php'),
(1024, 102, 10, 1, 4, 'Portfolio Item', NULL, NULL, 'page-portfolio-item.php'),
(1031, 103, 10, 1, 1, 'Blog', NULL, NULL, 'page-blog.php'),
(1032, 103, 10, 1, 2, 'Blog Item', NULL, NULL, 'page-blog-item.php');

-- --------------------------------------------------------

--
-- Table structure for table `phs_menu_type`
--

DROP TABLE IF EXISTS `phs_menu_type`;
CREATE TABLE IF NOT EXISTS `phs_menu_type` (
  `type_id` tinyint(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `type_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_menu_type`
--

INSERT INTO `phs_menu_type` (`type_id`, `type_name`) VALUES
(12, 'Dropdown'),
(10, 'Link'),
(11, 'Mega Menu'),
(0, 'Menu'),
(1, 'Top Left Menu'),
(2, 'Top Right Menu');

-- --------------------------------------------------------

--
-- Table structure for table `phs_metta`
--

DROP TABLE IF EXISTS `phs_metta`;
CREATE TABLE IF NOT EXISTS `phs_metta` (
  `mtta_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `metta_type` varchar(50) NOT NULL DEFAULT 'name' COMMENT 'Type',
  `metta_name` varchar(200) NOT NULL COMMENT 'Name',
  `metta_value` text NOT NULL COMMENT 'Value',
  PRIMARY KEY (`mtta_id`),
  UNIQUE KEY `metta_name` (`metta_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_metta`
--

INSERT INTO `phs_metta` (`mtta_id`, `metta_type`, `metta_name`, `metta_value`) VALUES
(0, 'http-equiv', 'X-UA-Compatible', 'IE=edge,chrome=1'),
(1, 'name', 'autor', 'PhSoft'),
(3, 'name', 'keywords', 'Software, PhSoft, Software house, ERP, ORACLE, JAVA, PHP'),
(4, 'name', 'description', 'PhSoft is a famous Software house in the middle east'),
(5, 'name', 'viewport', 'width=device-width, initial-scale=1.0'),
(7, 'property', 'og:site_name', 'PhSoft'),
(8, 'property', 'og:title', 'PhSoft'),
(9, 'property', 'og:description', 'PhSoft is a famous Software house in the middle east'),
(10, 'property', 'og:type', 'website'),
(11, 'property', 'og:image', 'http://www.phsoft.biz/images/phsoft.png'),
(12, 'property', 'og:url', 'http://www.phsoft.biz');

-- --------------------------------------------------------

--
-- Table structure for table `phs_perms`
--

DROP TABLE IF EXISTS `phs_perms`;
CREATE TABLE IF NOT EXISTS `phs_perms` (
  `perm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `pgrp_id` int(11) NOT NULL COMMENT 'Permission Group',
  `perm_table` varchar(255) NOT NULL COMMENT 'Table Name',
  `perm_perm` int(11) NOT NULL COMMENT 'Permission',
  PRIMARY KEY (`perm_id`),
  KEY `pgrp_id` (`pgrp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phs_pgroup`
--

DROP TABLE IF EXISTS `phs_pgroup`;
CREATE TABLE IF NOT EXISTS `phs_pgroup` (
  `pgrp_id` int(11) NOT NULL COMMENT 'PK',
  `pgrp_name` varchar(255) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`pgrp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_pgroup`
--

INSERT INTO `phs_pgroup` (`pgrp_id`, `pgrp_name`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `phs_setting`
--

DROP TABLE IF EXISTS `phs_setting`;
CREATE TABLE IF NOT EXISTS `phs_setting` (
  `set_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `set_name` varchar(100) NOT NULL COMMENT 'Name',
  `set_val` varchar(255) NOT NULL DEFAULT 'none' COMMENT 'Value',
  PRIMARY KEY (`set_id`),
  UNIQUE KEY `set_name` (`set_name`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_setting`
--

INSERT INTO `phs_setting` (`set_id`, `set_name`, `set_val`) VALUES
(7, 'Disp-Header', '1'),
(8, 'Disp-Footer', '1'),
(10, 'Search-Result-Lines', '3'),
(27, 'Main-Menu', '0'),
(29, 'Site-Name', 'Site Name'),
(30, 'Disp-Facebook', '1'),
(31, 'URL-facebook', 'https://www.facebook.com/PageRef'),
(32, 'Disp-Search', '1'),
(34, 'Default-Slider', 'Main Slider'),
(35, 'Top-Right-Menu', '2'),
(36, 'Top-Left-Menu', '1'),
(37, 'Disp-Top-Right-Menu', '1'),
(38, 'Disp-Top-Left-Menu', '1'),
(39, 'Disp-Slider', '1'),
(40, 'Disp-PreHeader', '1'),
(41, 'Disp-Menu-Search', '1'),
(42, 'Disp-PreFooter', '1'),
(43, 'Home-Menu', '10'),
(44, 'Disp-Langs', '1');

-- --------------------------------------------------------

--
-- Table structure for table `phs_status`
--

DROP TABLE IF EXISTS `phs_status`;
CREATE TABLE IF NOT EXISTS `phs_status` (
  `status_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_name` varchar(200) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `status_name` (`status_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_status`
--

INSERT INTO `phs_status` (`status_id`, `status_name`) VALUES
(1, 'Active'),
(2, 'Not Active');

-- --------------------------------------------------------

--
-- Table structure for table `phs_users`
--

DROP TABLE IF EXISTS `phs_users`;
CREATE TABLE IF NOT EXISTS `phs_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `pgrp_id` int(11) DEFAULT NULL COMMENT 'Permission Group',
  `user_logon` varchar(100) NOT NULL COMMENT 'Logon Name',
  `user_password` varchar(100) NOT NULL COMMENT 'Password',
  `user_email` varchar(100) NOT NULL COMMENT 'Email',
  PRIMARY KEY (`user_id`),
  KEY `pgrp_id` (`pgrp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phs_users`
--

INSERT INTO `phs_users` (`user_id`, `pgrp_id`, `user_logon`, `user_password`, `user_email`) VALUES
(3, -1, 'haytham', '964dfe818a21e507d424ac718218fbf0', 'h.phsoft@gmail.com'),
(4, -1, 'admin', 'eb0a191797624dd3a48fa681d3061212', 'site_admin@nazha.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `phs_vkeys`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `phs_vkeys`;
CREATE TABLE IF NOT EXISTS `phs_vkeys` (
`key_id` int(11)
,`key_name` varchar(100)
,`key_defvalue` varchar(100)
,`lang_id` int(11)
,`lang_name` varchar(100)
,`lang_dir` varchar(10)
,`status_id` tinyint(4)
,`lang_code` varchar(10)
,`kval_id` int(11)
,`key_value` varchar(250)
,`key_rvalue` varchar(250)
,`key_text` text
);

-- --------------------------------------------------------

--
-- Structure for view `cpy_vblock`
--
DROP TABLE IF EXISTS `cpy_vblock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cpy_vblock`  AS  select `b`.`blk_id` AS `blk_id`,`b`.`blk_name` AS `blk_name`,`b`.`status_id` AS `blk_status_id`,`b`.`type_id` AS `type_id`,`b`.`blk_stext` AS `blk_stext`,`d`.`dblk_id` AS `dblk_id`,`d`.`dblk_order` AS `dblk_order`,`d`.`status_id` AS `dblk_status_id`,`d`.`col_id` AS `col_id`,`d`.`dblk_name` AS `dblk_name`,`d`.`dblk_image` AS `dblk_image`,`d`.`dblk_text` AS `dblk_text`,`d`.`dblk_stext` AS `dblk_stext` from (`cpy_block` `b` left join `cpy_block_detail` `d` on((`d`.`blk_id` = `b`.`blk_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `cpy_vpage`
--
DROP TABLE IF EXISTS `cpy_vpage`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cpy_vpage`  AS  select `p`.`page_id` AS `page_id`,`p`.`page_name` AS `page_name`,`p`.`status_id` AS `page_status_id`,`p`.`slid_id` AS `slid_id`,`p`.`page_stext` AS `page_stext`,`b`.`pblk_id` AS `pblk_id`,`b`.`blk_id` AS `blk_id`,`b`.`status_id` AS `pblk_status_id`,`b`.`pblk_order` AS `pblk_order`,`b`.`pblk_name` AS `pblk_name`,`b`.`pblk_bgcolor` AS `pblk_bgcolor`,`b`.`pblk_stext` AS `pblk_stext` from (`cpy_page` `p` left join `cpy_page_block` `b` on((`b`.`page_id` = `p`.`page_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `phs_vkeys`
--
DROP TABLE IF EXISTS `phs_vkeys`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `phs_vkeys`  AS  select `k`.`key_id` AS `key_id`,`k`.`key_name` AS `key_name`,`k`.`key_defvalue` AS `key_defvalue`,`l`.`lang_id` AS `lang_id`,`l`.`lang_name` AS `lang_name`,`l`.`lang_dir` AS `lang_dir`,`l`.`status_id` AS `status_id`,`l`.`lang_code` AS `lang_code`,`v`.`kval_id` AS `kval_id`,`v`.`key_value` AS `key_value`,`v`.`key_rvalue` AS `key_rvalue`,`v`.`key_text` AS `key_text` from ((`phs_keys` `k` join `phs_language` `l`) join `phs_keyvalues` `v`) where ((`v`.`key_id` = `k`.`key_id`) and (`v`.`lang_id` = `l`.`lang_id`)) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpy_block`
--
ALTER TABLE `cpy_block`
  ADD CONSTRAINT `cpy_block_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `cpy_block_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `cpy_block_type` (`type_id`);

--
-- Constraints for table `cpy_block_detail`
--
ALTER TABLE `cpy_block_detail`
  ADD CONSTRAINT `cpy_block_detail_ibfk_1` FOREIGN KEY (`blk_id`) REFERENCES `cpy_block` (`blk_id`),
  ADD CONSTRAINT `cpy_block_detail_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `cpy_block_detail_ibfk_3` FOREIGN KEY (`col_id`) REFERENCES `cpy_block_col` (`col_id`);

--
-- Constraints for table `cpy_news`
--
ALTER TABLE `cpy_news`
  ADD CONSTRAINT `cpy_news_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `cpy_news_images`
--
ALTER TABLE `cpy_news_images`
  ADD CONSTRAINT `cpy_news_images_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `cpy_news` (`news_id`);

--
-- Constraints for table `cpy_page`
--
ALTER TABLE `cpy_page`
  ADD CONSTRAINT `cpy_page_ibfk_1` FOREIGN KEY (`slid_id`) REFERENCES `cpy_slider_mst` (`slid_id`),
  ADD CONSTRAINT `cpy_page_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `cpy_page_block`
--
ALTER TABLE `cpy_page_block`
  ADD CONSTRAINT `cpy_page_block_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `cpy_page` (`page_id`),
  ADD CONSTRAINT `cpy_page_block_ibfk_2` FOREIGN KEY (`blk_id`) REFERENCES `cpy_block` (`blk_id`),
  ADD CONSTRAINT `cpy_page_block_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `cpy_slider_trn`
--
ALTER TABLE `cpy_slider_trn`
  ADD CONSTRAINT `cpy_slider_trn_ibfk_1` FOREIGN KEY (`slid_id`) REFERENCES `cpy_slider_mst` (`slid_id`);

--
-- Constraints for table `cpy_user`
--
ALTER TABLE `cpy_user`
  ADD CONSTRAINT `cpy_user_ibfk_1` FOREIGN KEY (`cntry_id`) REFERENCES `phs_country` (`cntry_id`),
  ADD CONSTRAINT `cpy_user_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `cpy_user_ibfk_3` FOREIGN KEY (`gend_id`) REFERENCES `phs_gender` (`gend_id`);

--
-- Constraints for table `phs_country`
--
ALTER TABLE `phs_country`
  ADD CONSTRAINT `phs_country_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `phs_language`
--
ALTER TABLE `phs_language`
  ADD CONSTRAINT `phs_language_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

--
-- Constraints for table `phs_menu`
--
ALTER TABLE `phs_menu`
  ADD CONSTRAINT `phs_menu_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`),
  ADD CONSTRAINT `phs_menu_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `phs_menu_type` (`type_id`),
  ADD CONSTRAINT `phs_menu_ibfk_3` FOREIGN KEY (`menu_pid`) REFERENCES `phs_menu` (`menu_id`);

--
-- Constraints for table `phs_perms`
--
ALTER TABLE `phs_perms`
  ADD CONSTRAINT `phs_perms_ibfk_1` FOREIGN KEY (`pgrp_id`) REFERENCES `phs_pgroup` (`pgrp_id`);

--
-- Constraints for table `phs_users`
--
ALTER TABLE `phs_users`
  ADD CONSTRAINT `phs_users_ibfk_1` FOREIGN KEY (`pgrp_id`) REFERENCES `phs_pgroup` (`pgrp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
