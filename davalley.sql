
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 68.178.143.144
-- Generation Time: Oct 15, 2016 at 05:52 AM
-- Server version: 5.5.43
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `davalley`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `loginID` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `logintype` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` VALUES(1, 'eric', 'customer', 'test', 'customer');
INSERT INTO `admin` VALUES(2, 'ijaz', 'cashier', 'test', 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(50) NOT NULL,
  `CategoryNote` varchar(100) NOT NULL,
  `OrderID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CategoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES(1, 'Dessert', '', 2);
INSERT INTO `categories` VALUES(2, 'Beverages', '', 1);
INSERT INTO `categories` VALUES(3, 'Lunch & Dinner', '**All plates are served with 2 choices: coleslaw OR potato salad OR rice** ', 0);
INSERT INTO `categories` VALUES(4, 'Appetizers', '', 3);
INSERT INTO `categories` VALUES(5, 'Others', '', 4);
INSERT INTO `categories` VALUES(6, 'Side Orders', '', 5);
INSERT INTO `categories` VALUES(8, 'Soda', 'type of soda', 0);
INSERT INTO `categories` VALUES(9, 'Curry type', '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `cName` varchar(200) NOT NULL,
  `cPhone` varchar(200) NOT NULL,
  `cEmail` varchar(200) NOT NULL,
  `cCountry` varchar(200) NOT NULL,
  `cCity` varchar(200) NOT NULL,
  `cZip` int(11) NOT NULL,
  `cDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cItemPrefered` int(11) NOT NULL DEFAULT '1',
  `counter` tinyint(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` VALUES(25, 'test', '123123123', 'test@test.test', 'uhi', 'hiuhi', 0, '2013-10-07 01:14:57', 1, 3);
INSERT INTO `customers` VALUES(26, 'et  ', '18085541582', '', 'US', 'HONOLULU', 96825, '2013-10-07 04:26:39', 1, 4);
INSERT INTO `customers` VALUES(28, 'ERIC Y  TANG', '', '', '', '', 0, '2013-11-10 20:00:32', 1, 0);
INSERT INTO `customers` VALUES(29, '', '1234', '', '', '', 0, '2013-11-12 19:35:07', 1, 0);
INSERT INTO `customers` VALUES(30, '', '18085541764', '', 'US', 'HONOLULU', 96825, '2013-11-20 11:32:10', 1, 4);
INSERT INTO `customers` VALUES(31, '', '15034812365', '', 'US', 'PORTLAND', 97281, '2013-11-28 04:07:08', 1, 0);
INSERT INTO `customers` VALUES(32, 'mike', '6027913519', '', '', '', 0, '2013-12-02 17:25:05', 1, 0);
INSERT INTO `customers` VALUES(33, '', '18086758579', '', 'US', 'WAIPAHU', 96813, '2013-12-02 23:03:32', 1, 0);
INSERT INTO `customers` VALUES(34, '', '18086758576', '', 'US', 'WAIPAHU', 96813, '2013-12-18 21:38:22', 1, 1);
INSERT INTO `customers` VALUES(35, '', '0000', '', '', '', 0, '2014-01-20 13:35:44', 1, 0);
INSERT INTO `customers` VALUES(36, '', ' 40771101268', '', '', '', 0, '2014-01-20 13:44:42', 1, 0);
INSERT INTO `customers` VALUES(37, '', '0040771101268', '', '', '', 0, '2014-01-20 13:44:54', 1, 0);
INSERT INTO `customers` VALUES(38, '', ' 16029046356', '', '', '', 0, '2014-01-20 13:48:23', 1, 0);
INSERT INTO `customers` VALUES(39, '', '16029046356', '', 'US', 'PHOENIX', 85021, '2014-01-20 13:48:23', 1, 0);
INSERT INTO `customers` VALUES(40, '', '18083522580', '', 'US', 'HONOLULU', 96813, '2014-02-01 10:09:15', 1, 0);
INSERT INTO `customers` VALUES(41, '', '16027913519', '', 'US', 'PHOENIX', 85255, '2014-02-14 00:35:07', 1, 0);
INSERT INTO `customers` VALUES(42, '', '18085619421', '', 'US', 'HONOLULU', 96824, '2014-03-07 23:24:37', 1, 0);
INSERT INTO `customers` VALUES(43, '', '16025054850', '', 'US', 'PHOENIX', 85308, '2014-03-09 22:04:40', 1, 0);
INSERT INTO `customers` VALUES(44, '', '17194593070', '', 'US', 'COLORADO SPRINGS', 80907, '2014-03-14 19:27:20', 1, 0);
INSERT INTO `customers` VALUES(45, '', ' 40767412089', '', '', '', 0, '2014-03-23 22:01:12', 1, 0);
INSERT INTO `customers` VALUES(46, '', '0040767412089', '', '', '', 0, '2014-03-23 22:01:23', 1, 0);
INSERT INTO `customers` VALUES(47, '', '1234123123123', '', '', '', 0, '2014-03-23 22:03:06', 1, 0);
INSERT INTO `customers` VALUES(48, '', '16029891022', '', 'US', 'PHOENIX', 85306, '2014-04-10 01:05:21', 1, 1);
INSERT INTO `customers` VALUES(49, '', '19724395805', '', 'US', 'MC KINNEY', 75006, '2014-05-07 23:08:56', 1, 0);
INSERT INTO `customers` VALUES(50, '', '16026350715', '', 'US', 'PHOENIX', 85204, '2014-11-21 03:30:16', 1, 0);
INSERT INTO `customers` VALUES(51, '', '16025162641', '', 'US', 'TEMPE', 85282, '2014-11-26 23:16:16', 1, 0);
INSERT INTO `customers` VALUES(52, '', '16024481615', '', 'US', 'PHOENIX', 85215, '2015-03-24 22:12:06', 1, 0);
INSERT INTO `customers` VALUES(53, '', '18082801877', '', 'US', 'WAILUKU', 96790, '2015-05-16 00:28:16', 1, 0);
INSERT INTO `customers` VALUES(54, '', '17809057041', '', 'CA', 'EDMONTON', 0, '2015-10-04 04:54:21', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `indoor_orders`
--

CREATE TABLE `indoor_orders` (
  `orderID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `itemID` varchar(20) NOT NULL,
  `cookWith` varchar(100) NOT NULL,
  `itemOrder` varchar(500) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `employeeID` varchar(50) NOT NULL,
  `bill` double NOT NULL,
  `paid` varchar(10) NOT NULL,
  `orderDate` varchar(50) NOT NULL,
  `late` varchar(10) NOT NULL,
  `tax` float NOT NULL,
  `min` int(11) NOT NULL,
  UNIQUE KEY `orderID` (`orderID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `indoor_orders`
--

INSERT INTO `indoor_orders` VALUES(1, '0', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', '', ',1,1,1,1,1', '', 41.52, 'No', '2015-10-06 04:58:29', '0', 3.18, 5);
INSERT INTO `indoor_orders` VALUES(2, '0', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', '', ',1,1,1,1,1', 'eric', 41.52, 'No', '2015-10-06 04:59:15', '0', 3.18, 0);
INSERT INTO `indoor_orders` VALUES(3, '0', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', '', ',1,1,1,1,1', '', 41.52, 'No', '2015-10-06 05:02:41', '0', 3.18, 0);
INSERT INTO `indoor_orders` VALUES(4, '0', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', '', ',1,1,1,1,1', 'eric', 41.52, 'No', '2015-10-06 05:02:58', '0', 3.18, 0);
INSERT INTO `indoor_orders` VALUES(5, '0', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', '', ',1,1,2,1,1', 'eric', 50.13, 'No', '2015-10-06 05:11:24', '0', 3.84, 10);
INSERT INTO `indoor_orders` VALUES(6, '0', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', '', ',1,1,2,1,1', 'eric', 50.13, 'No', '2015-10-06 05:14:36', '0', 3.84, 5555);
INSERT INTO `indoor_orders` VALUES(7, ',2,34,35,38,1', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', '', ',1,1,2,1,1', 'eric', 50.13, 'No', '2015-10-06 09:05:51', '0', 3.84, 6);
INSERT INTO `indoor_orders` VALUES(8, ',2,34,35,38,1', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', '', ',1,1,2,1,1', 'eric', 50.13, 'Yes', '2015-10-06 09:49:27', 'Yes', 3.84, 54);
INSERT INTO `indoor_orders` VALUES(9, ',2,34,35,38,1', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', ',LemonGrass Chicken,Mix Veges in special sauce,Kal', ',1,1,2,1,1', 'eric', 50.13, 'Yes', '2015-10-06 09:53:43', 'Yes', 3.84, 45);
INSERT INTO `indoor_orders` VALUES(10, ',2,34,35,38,1', ',Rice & Coleslaw &,Rice & Mac Salad &,&,Rice & Mac Salad & coke,Rice & Mac Salad & ok', ',LemonGrass Chicken,Mix Veges in special sauce,Kalua Pork,Kalbi,Chicken with special sauce', ',1,1,2,1,1', 'eric', 50.13, 'Yes', '2015-10-06 09:57:44', 'No', 3.84, 554);
INSERT INTO `indoor_orders` VALUES(11, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',adzcd c,bs adasd', 'eric', 14.57, 'Yes', '2015-10-06 22:34:51', 'Yes', 1.12, 21);
INSERT INTO `indoor_orders` VALUES(12, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', 'eric', 14.57, 'No', '2015-10-07 03:09:08', '0', 1.12, 10);
INSERT INTO `indoor_orders` VALUES(13, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', 'eric', 14.57, 'No', '2015-10-07 03:13:47', '0', 1.12, 41);
INSERT INTO `indoor_orders` VALUES(14, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', '', 14.57, 'No', '2015-10-07 05:13:06', '0', 1.12, 2);
INSERT INTO `indoor_orders` VALUES(15, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', 'eric', 14.57, 'Yes', '2015-10-07 05:16:30', 'No', 1.12, 5);
INSERT INTO `indoor_orders` VALUES(16, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', '', 14.57, 'No', '2015-10-07 05:23:23', '0', 1.12, 5);
INSERT INTO `indoor_orders` VALUES(17, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', '', 14.57, 'No', '2015-10-07 05:25:13', '0', 1.12, 0);
INSERT INTO `indoor_orders` VALUES(18, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', '', 14.57, 'No', '2015-10-07 05:34:22', '0', 1.12, 6);
INSERT INTO `indoor_orders` VALUES(19, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', '', 14.57, 'Yes', '2015-10-07 05:37:02', 'Yes', 1.12, 5);
INSERT INTO `indoor_orders` VALUES(20, ',34,2', ',Mac Salad & Coleslaw & coke,Rice & Mac Salad & be quick', ',Mix Veges in special sauce,LemonGrass Chicken', ',1,1', '', 14.57, 'Yes', '2015-10-07 05:38:01', 'Yes', 1.12, 5);
INSERT INTO `indoor_orders` VALUES(21, ',33,35', ',new,Coleslaw & new', ',Tofu in special sauce,Kalua Pork', ',1,1', '', 15.92, 'Yes', '2015-10-07 08:58:17', 'Yes', 1.22, 12);
INSERT INTO `indoor_orders` VALUES(22, ',33,63', ',,Red &', ',Tofu in special sauce,Thai Curry veggies', ',1,1', '', 17.06, 'Yes', '2015-10-07 23:05:56', 'No', 1.31, 12);
INSERT INTO `indoor_orders` VALUES(23, ',3,1', ',Coleslaw &,Rice & Mac Salad &', ',Shrimp with special sauce,Chicken with special sauce', ',1,1', 'eric', 18.35, 'Yes', '2015-10-08 05:16:27', 'No', 1.41, 87);
INSERT INTO `indoor_orders` VALUES(24, ',1', ',Coleslaw & ok', ',Chicken with special sauce', ',1', 'eric', 7.53, 'Yes', '2015-10-09 03:18:27', 'No', 0.58, 8);
INSERT INTO `indoor_orders` VALUES(25, ',37', ',&', ',Kahuku shrimp', ',1', '', 10.82, 'No', '2015-10-19 05:03:14', 'Yes', 0.83, 4555);
INSERT INTO `indoor_orders` VALUES(26, ',38', ',&', ',Kalbi', ',1', '', 10.82, 'Yes', '2015-10-19 05:38:02', 'No', 0.83, 45555555);
INSERT INTO `indoor_orders` VALUES(27, '', '', '', '', '', 0, 'No', '2015-10-19 05:51:06', '0', 0, 0);
INSERT INTO `indoor_orders` VALUES(28, '', '', '', '', '', 0, 'No', '2015-10-19 05:54:20', '0', 0, 0);
INSERT INTO `indoor_orders` VALUES(29, '', '', '', '', '', 0, 'No', '2015-10-19 05:54:23', 'Yes', 0, 0);
INSERT INTO `indoor_orders` VALUES(30, ',4', ',&', ',Mahi with special sauce', ',1', '', 9.74, 'Yes', '2015-10-19 06:43:59', 'Yes', 0.75, 20);
INSERT INTO `indoor_orders` VALUES(38, '', ',', ',', ',', '', 0, 'No', '2015-10-21 01:50:41', '0', 0, 8);
INSERT INTO `indoor_orders` VALUES(39, '', ',', ',', ',', '', 0, 'No', '2015-10-21 01:52:21', '0', 0, 0);
INSERT INTO `indoor_orders` VALUES(40, '', '', '', '', '', 0, 'No', '2015-10-21 03:35:50', '0', 0, 0);
INSERT INTO `indoor_orders` VALUES(41, '', '', '', '', '', 0, 'No', '2015-10-21 04:00:13', '0', 0, 8);
INSERT INTO `indoor_orders` VALUES(42, '', '', '', '', '', 0, 'No', '2015-10-21 04:04:54', '0', 0, 55);
INSERT INTO `indoor_orders` VALUES(43, '', '', '', '', '', 0, 'No', '2015-10-21 04:05:50', '0', 0, 0);
INSERT INTO `indoor_orders` VALUES(44, '', ',Rice & Mac Salad &', ',Chicken with special sauce', ',1', '', 7.53, 'No', '2015-10-21 04:12:34', '0', 0.58, 0);
INSERT INTO `indoor_orders` VALUES(45, ',37', ',Mac Salad & Coleslaw &', ',Kahuku shrimp', ',1', '', 10.82, 'No', '2015-10-21 04:16:27', '0', 0.83, 8);
INSERT INTO `indoor_orders` VALUES(46, ',1', ',Mac Salad &', ',Chicken with special sauce', ',1', 'eric', 7.53, 'Yes', '2015-10-21 04:36:20', 'Yes', 0.58, 7);
INSERT INTO `indoor_orders` VALUES(47, ',1,36', ',Mac Salad &,Mac Salad & Coleslaw &', ',Chicken with special sauce,Pineapple chicken', ',1,1', 'eric', 16.14, 'Yes', '2015-10-21 04:39:07', 'Yes', 1.24, 88);
INSERT INTO `indoor_orders` VALUES(48, ',1,36', ',Mac Salad &,Mac Salad & Coleslaw &', ',Chicken with special sauce,Pineapple chicken', ',1,1', 'eric', 16.14, 'Yes', '2015-10-21 04:42:55', 'No', 1.24, 77);
INSERT INTO `indoor_orders` VALUES(49, ',33', ',be quick', ',Tofu in special sauce', ',1', 'eric', 7.31, 'Yes', '2015-10-27 09:40:10', 'No', 0.56, 5);
INSERT INTO `indoor_orders` VALUES(50, ',1,2,3', ',Rice & test 1,Mac Salad & test 2,Coleslaw & test 3', ',Chicken with special sauce,LemonGrass Chicken,Shrimp with special sauce', ',1,1,1', 'eric', 25.87, 'Yes', '2015-10-27 09:48:24', '0', 1.98, 8);
INSERT INTO `indoor_orders` VALUES(51, ',1', ',Rice & test', ',Chicken with special sauce', ',1', 'eric', 7.53, 'Yes', '2015-10-28 09:44:01', 'Yes', 0.58, 5);
INSERT INTO `indoor_orders` VALUES(52, ',1', ',& test', ',Chicken with special sauce', ',1', 'eric', 7.53, 'Yes', '2015-10-29 12:22:35', '0', 0.58, 5);
INSERT INTO `indoor_orders` VALUES(53, ',3', ',Mac Salad & Coleslaw &', ',Shrimp with special sauce', ',1', 'eric', 10.82, 'Yes', '2015-10-29 23:47:25', 'Yes', 0.83, 3);
INSERT INTO `indoor_orders` VALUES(54, ',2', ',Mac Salad &', ',LemonGrass Chicken', ',1', 'eric', 7.53, 'Yes', '2015-11-03 10:42:55', 'No', 0.58, 3);
INSERT INTO `indoor_orders` VALUES(55, ',38,35', ',&,Rice & Mac Salad &', ',Kalbi,Kalua Pork', ',1,1', 'eric', 19.43, 'No', '2015-11-03 10:50:06', '0', 1.49, 20);
INSERT INTO `indoor_orders` VALUES(56, ',38,35', ',&,Rice & Mac Salad &', ',Kalbi,Kalua Pork', ',1,1', 'eric', 19.43, 'No', '2015-11-03 10:53:44', '0', 1.49, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `itemDescription` varchar(150) NOT NULL,
  `itemPrice` float(4,2) NOT NULL,
  `itemCode` int(11) NOT NULL DEFAULT '0',
  `itemImage` varchar(200) NOT NULL,
  `cooktime` varchar(100) NOT NULL,
  `itemAudio` varchar(555) NOT NULL,
  `sideOrderCat` int(11) NOT NULL DEFAULT '0',
  `sideOrderLimit` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`itemID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` VALUES(1, 3, 'Chicken with special sauce', 'Bite size chicken breast meat stirred fried with special sauce.', 6.95, 1, 'a.jpg', '1:0:0', 'myRecording1.wav', 6, 2);
INSERT INTO `items` VALUES(2, 3, 'LemonGrass Chicken', 'Same as item 1 but more lemon grass spice added.', 6.95, 2, 'a.jpg', '', 'myRecording2.wav', 6, 2);
INSERT INTO `items` VALUES(3, 3, 'Shrimp with special sauce', 'Shrimp with shells removed and stirred fried with special sauce.', 9.99, 3, 'c.jpg', '', '', 6, 2);
INSERT INTO `items` VALUES(4, 3, 'Mahi with special sauce', 'Bite size fish stirred fried with special sauce.', 8.99, 4, '', '', '', 6, 2);
INSERT INTO `items` VALUES(42, 3, 'Curry Katsu', '', 8.50, 14, 'n.jpg', '', '', 6, 2);
INSERT INTO `items` VALUES(43, 3, 'Curry Katsu+cheese', '', 9.50, 15, 'o.jpg', '', '', 6, 2);
INSERT INTO `items` VALUES(44, 3, 'Mahi Fried', '', 8.99, 16, '', '', '', 6, 2);
INSERT INTO `items` VALUES(45, 3, 'TeriChicken', '', 7.50, 17, 'p.jpg', '', 'baasheep2.wav', 6, 2);
INSERT INTO `items` VALUES(46, 3, 'NinjaBowl', '', 5.99, 18, 'q.jpg', '', '', 0, 0);
INSERT INTO `items` VALUES(47, 3, 'NinjaBowl+bacon', '', 6.99, 19, 'q.jpg', '', '', 0, 0);
INSERT INTO `items` VALUES(48, 3, 'Philly cheese steak', '', 5.99, 20, '', '', '', 0, 0);
INSERT INTO `items` VALUES(49, 2, 'Can Soda', '', 0.79, 100, '', '', '', 8, 1);
INSERT INTO `items` VALUES(50, 2, 'Hot Tea (Lipton)', '', 1.39, 101, '', '', '', 0, 1);
INSERT INTO `items` VALUES(52, 2, 'Hawaiian Sun Juice', '', 1.59, 103, '', '', '', 0, 1);
INSERT INTO `items` VALUES(51, 2, 'Bottle Water', '', 1.00, 102, '', '', '', 0, 1);
INSERT INTO `items` VALUES(41, 3, 'Chicken Katsu', '', 7.95, 13, 'm.jpg', '', '', 6, 2);
INSERT INTO `items` VALUES(39, 3, 'LocoMoco', '', 6.99, 11, 'k.jpg', '', '', 0, 0);
INSERT INTO `items` VALUES(40, 3, 'TeriBeef', '', 8.99, 12, '', '', '', 6, 2);
INSERT INTO `items` VALUES(38, 3, 'Kalbi', 'Hawaiian style korean kalbi with boneless short ribs. ', 9.99, 10, 'j.jpg', '', '', 6, 2);
INSERT INTO `items` VALUES(37, 3, 'Kahuku shrimp', 'Un-shelled shrimp stirred fried on butter, garlic and special chilli sauce.', 9.99, 9, 'i.jpg', '', '', 6, 2);
INSERT INTO `items` VALUES(36, 3, 'Pineapple chicken', 'Bite size chicken breast meat deep fried and served with pineapple sauce.', 7.95, 36, 'h.jpg', '', '', 6, 2);
INSERT INTO `items` VALUES(35, 3, 'Kalua Pork', 'Hawaiian style pull pork.', 7.95, 7, 'kalua pork.jpg', '3:0:10', 'myRecording7.wav', 6, 2);
INSERT INTO `items` VALUES(34, 3, 'Mix Veges in special sauce', 'Cabbage, onions, broccoli, carrots slices and celery stirred fried with special sauce.', 6.50, 34, 'f.jpg', '', '', 6, 2);
INSERT INTO `items` VALUES(33, 3, 'Tofu in special sauce', 'Bite size tofu stirred fried with special sauce.', 6.75, 5, 'e.jpg', '', '', 0, 1);
INSERT INTO `items` VALUES(55, 3, 'Spam musubi', '', 2.50, 21, 'u.jpg', '', '', 0, 0);
INSERT INTO `items` VALUES(57, 3, 'Bento', '', 7.95, 23, '', '', '', 6, 2);
INSERT INTO `items` VALUES(58, 3, 'Pineapple Fried Rice w/BBQ Chicken', '', 7.50, 30, '', '', '', 0, 0);
INSERT INTO `items` VALUES(59, 3, 'Pineapple Fried Rice w/Garlic Shrimp', '', 9.50, 31, '', '', '', 0, 0);
INSERT INTO `items` VALUES(62, 3, 'Thai Curry chicken', '', 9.00, 40, '', '', '', 9, 1);
INSERT INTO `items` VALUES(63, 3, 'Thai Curry veggies', '', 9.00, 41, '', '', '', 9, 1);
INSERT INTO `items` VALUES(65, 4, 'Veggies Spring Rolls', '', 3.99, 91, '', '', '', 0, 1);
INSERT INTO `items` VALUES(66, 5, 'BBQ Chicken Salad', '', 5.50, 200, '', '', '', 0, 0);
INSERT INTO `items` VALUES(69, 6, 'Coleslaw', '', 1.50, 203, '', '', '', 0, 1);
INSERT INTO `items` VALUES(70, 1, 'Haupia Cake', '', 2.75, 300, '', '', '', 0, 1);
INSERT INTO `items` VALUES(71, 1, 'Brownie Haupia', '', 2.75, 301, '', '', '', 0, 1);
INSERT INTO `items` VALUES(72, 1, 'Cheesecake', '', 2.75, 302, '', '', '', 0, 1);
INSERT INTO `items` VALUES(73, 1, 'Chocolate Moussecake', '', 2.75, 303, '', '', '', 0, 1);
INSERT INTO `items` VALUES(74, 2, 'Fountain Soda (L)', '', 1.59, 104, '', '', '', 0, 1);
INSERT INTO `items` VALUES(75, 2, 'Fountain soda(M)', '', 1.39, 105, '', '', '', 0, 1);
INSERT INTO `items` VALUES(76, 2, 'Thai Ice Tea', '', 2.50, 106, '', '', '', 0, 1);
INSERT INTO `items` VALUES(77, 2, 'Vietnamese Ice Coffee', '', 2.79, 107, '', '', '', 0, 1);
INSERT INTO `items` VALUES(78, 1, 'Pineapple Li Hing Mui', '', 2.75, 304, '', '', '', 0, 1);
INSERT INTO `items` VALUES(79, 2, 'Ice Tea', '', 1.59, 108, '', '', '', 0, 1);
INSERT INTO `items` VALUES(80, 5, 'Catering service deposit', '', 90.00, 99, '', '', '', 0, 1);
INSERT INTO `items` VALUES(81, 2, 'Coffee (M)', '', 1.39, 109, '', '', '', 0, 1);
INSERT INTO `items` VALUES(82, 6, 'Rice', '', 1.00, 82, '', '', '', 0, 1);
INSERT INTO `items` VALUES(83, 6, 'Mac Salad', 'Macaroni Salad', 1.50, 83, '', '', '', 0, 1);
INSERT INTO `items` VALUES(84, 8, 'Coke', '', 0.79, 120, '', '', '', 0, 1);
INSERT INTO `items` VALUES(85, 8, '7Up', '', 0.79, 121, '', '', '', 0, 1);
INSERT INTO `items` VALUES(86, 8, 'Pepsi', '', 0.79, 122, '', '', '', 0, 1);
INSERT INTO `items` VALUES(87, 8, 'DrPep', '', 0.79, 123, '', '', '', 0, 1);
INSERT INTO `items` VALUES(88, 9, 'Red', '', 0.00, 501, '', '', '', 0, 1);
INSERT INTO `items` VALUES(89, 9, 'Green', '', 0.00, 502, '', '', '', 0, 1);
INSERT INTO `items` VALUES(90, 9, 'Yellow', '', 0.00, 503, '', '', '', 0, 1);
INSERT INTO `items` VALUES(91, 3, 'Thai curry Tofu', '', 9.00, 42, '', '', '', 9, 1);
INSERT INTO `items` VALUES(92, 3, 'Thai curry shrimp', '', 11.00, 43, '', '1:5:0', '', 9, 1);
INSERT INTO `items` VALUES(93, 3, 'Thai curry fish', '', 11.00, 44, '', '', '', 9, 1);
INSERT INTO `items` VALUES(94, 2, 'Coffee (L)', '', 1.59, 110, '', '', '', 0, 1);
INSERT INTO `items` VALUES(95, 1, 'test', 'test', 22.00, 22, '', '', '', 0, 1);
INSERT INTO `items` VALUES(96, 0, 'test123', 'test122334', 99.99, 4152563, '', '', '', 0, 1);
INSERT INTO `items` VALUES(97, 2, 'etrtre', 'treterter', 22.00, 123410, '', '', '', 0, 1);
INSERT INTO `items` VALUES(98, 2, 'test item', 'test item', 22.00, 1007, '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(200) NOT NULL,
  `menuPhone` varchar(200) NOT NULL,
  `menuAddress` varchar(200) NOT NULL,
  `menuCity` varchar(200) NOT NULL,
  `menuZip` int(11) NOT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `phoneNumber` varchar(50) NOT NULL,
  `itemID` int(11) NOT NULL,
  `cookWith` varchar(500) NOT NULL,
  `sideOrder` varchar(555) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `dateOrdered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=460 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` VALUES(403, '6028027785', 1, 'Rice & Mac Salad & Rice & Mac Salad &', '82,83', 2, '2015-10-21 05:05:14');
INSERT INTO `orders` VALUES(393, '12345678901', 5, '', '', 1, '2015-10-17 03:11:36');
INSERT INTO `orders` VALUES(402, '6028027785', 17, 'Rice & Mac Salad & pick up at 6 pm thank you Rice & Mac Salad & pick up at 6 pm thank you', '82,83', 2, '2015-10-21 05:05:14');
INSERT INTO `orders` VALUES(401, 'testing', 2, '&', '', 2, '2015-10-20 10:07:49');
INSERT INTO `orders` VALUES(387, '8312123573', 6, 'Rice &', '82', 1, '2015-10-13 02:43:04');
INSERT INTO `orders` VALUES(386, '8312123573', 91, '', '', 1, '2015-10-13 02:43:04');
INSERT INTO `orders` VALUES(385, '8312123573', 40, 'Yellow &', '90', 1, '2015-10-13 02:43:04');
INSERT INTO `orders` VALUES(375, '123', 4, 'Mac Salad & test2', '83', 1, '2015-10-08 10:02:14');
INSERT INTO `orders` VALUES(373, '035765558666', 1, 'Coleslaw & ok Coleslaw & ok', '69', 2, '2015-10-08 09:29:52');
INSERT INTO `orders` VALUES(374, '123', 1, 'Rice & Mac Salad & test1', '82,83', 1, '2015-10-08 10:02:14');
INSERT INTO `orders` VALUES(218, '6023502331', 16, 'Rice & Mac Salad &', '82,83', 1, '2014-12-29 00:10:11');
INSERT INTO `orders` VALUES(194, '65895', 2, 'Potato Salad & Coleslaw & ww', '68,69', 1, '2014-12-22 18:37:28');
INSERT INTO `orders` VALUES(74, '9988777', 1, 'Rice & Mac Salad & test', '82,83', 1, '2014-12-10 19:09:36');
INSERT INTO `orders` VALUES(129, '55555555', 1, 'Rice & Mac Salad & test', '82,83', 1, '2014-12-14 16:36:41');
INSERT INTO `orders` VALUES(331, '6027157031', 42, 'Red & add veggies', '88', 1, '2015-04-23 22:26:07');
INSERT INTO `orders` VALUES(330, '6027157031', 9, 'Rice & Coleslaw &', '82,69', 1, '2015-04-23 22:26:07');
INSERT INTO `orders` VALUES(329, '16027913519', 7, 'are u open at', '', 0, '2015-04-22 18:51:12');
INSERT INTO `orders` VALUES(413, '1234567890', 1110, 'nothing', 'nothing', 0, '2015-10-21 05:05:14');
INSERT INTO `orders` VALUES(410, 'testiing', 3, 'Mac Salad & Coleslaw & Mac Salad & Coleslaw &', '83,69', 2, '2015-10-29 17:04:30');
INSERT INTO `orders` VALUES(313, '14802380233', 1, 'Rice & Mac Salad &', '82,83', 1, '2015-02-23 22:56:37');
INSERT INTO `orders` VALUES(250, '480-622-2750', 1, 'Potato Salad & Coleslaw &', '68,69', 1, '2015-02-04 22:55:42');
INSERT INTO `orders` VALUES(249, '480-622-2750', 3, 'Rice & Mac Salad &', '82,83', 1, '2015-02-04 22:55:42');
INSERT INTO `orders` VALUES(247, 'erictest', 1, 'Rice & Rice &', '82', 2, '2015-01-14 03:00:19');
INSERT INTO `orders` VALUES(334, '4802762900', 2, 'Rice & Mac Salad &', '82,83', 1, '2015-06-25 06:16:56');
INSERT INTO `orders` VALUES(384, '8312123573', 18, '', '', 1, '2015-10-13 02:43:04');
INSERT INTO `orders` VALUES(336, '16235654876', 3, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-07-13 22:51:32');
INSERT INTO `orders` VALUES(337, '16235654876', 8, 'Mac Salad & Coleslaw & Allergic to dairy!', '83,69', 1, '2015-07-13 22:51:32');
INSERT INTO `orders` VALUES(383, '6235870421', 13, 'Rice &', '82', 1, '2015-10-12 21:55:05');
INSERT INTO `orders` VALUES(379, 'test4', 11, '  ', '', 3, '2015-10-08 21:56:07');
INSERT INTO `orders` VALUES(380, '25563163022358', 8, 'Rice & Coleslaw &', '82,69', 1, '2015-10-11 16:25:18');
INSERT INTO `orders` VALUES(382, '525585285528', 3, 'Rice & Mac Salad &', '82,83', 1, '2015-10-12 12:58:11');
INSERT INTO `orders` VALUES(420, '5073824515', 14, 'Rice & Coleslaw &', '82,69', 1, '2015-11-16 00:32:27');
INSERT INTO `orders` VALUES(367, '008246844123667', 10, 'Rice & Mac Salad & check Rice & Mac Salad & check', '82,83', 2, '2015-09-28 11:32:10');
INSERT INTO `orders` VALUES(369, '008246844123667', 4, 'Rice & Mac Salad &', '82,83', 1, '2015-09-28 12:16:52');
INSERT INTO `orders` VALUES(421, '5073824515', 15, 'Rice & Coleslaw & spicy', '82,69', 1, '2015-11-16 00:32:27');
INSERT INTO `orders` VALUES(371, 'undefined', 16, 'Rice & Mac Salad &', '82,83', 1, '2015-10-01 23:04:03');
INSERT INTO `orders` VALUES(428, 'jjjjjjjjj', 1, 'Rice & Mac Salad &', '82,83', 1, '2015-12-08 00:36:27');
INSERT INTO `orders` VALUES(429, 'jjjjjjjjj', 1, 'Rice & Mac Salad & hi', '82,83', 1, '2015-12-08 00:36:27');
INSERT INTO `orders` VALUES(445, 'Indoor', 3, 'Rice & Mac Salad & none', '82,83', 1, '2015-12-11 11:00:52');
INSERT INTO `orders` VALUES(440, '9814235647', 4, 'Rice & test', '82', 1, '2015-12-11 10:21:04');
INSERT INTO `orders` VALUES(444, 'Indoor', 1, 'Rice & Rice &', '82', 2, '2015-12-11 10:58:40');
INSERT INTO `orders` VALUES(439, '9814235647', 3, 'Rice & test', '82', 1, '2015-12-11 10:21:04');
INSERT INTO `orders` VALUES(443, 'Indoor', 3, 'Rice & Mac Salad & none Rice & Mac Salad & none', '82,83', 2, '2015-12-11 10:35:18');
INSERT INTO `orders` VALUES(446, '6023597938', 18, '', '', 1, '2015-12-11 23:28:22');
INSERT INTO `orders` VALUES(458, 'test''', 108, '', '', 1, '2016-01-05 12:38:12');
INSERT INTO `orders` VALUES(453, '9804361575', 4, 'Coleslaw &', '69', 1, '2016-01-02 05:33:47');
INSERT INTO `orders` VALUES(457, 'test''', 109, '', '', 1, '2016-01-05 12:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `ordersPaid`
--

CREATE TABLE `ordersPaid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(200) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `itemID` int(11) NOT NULL,
  `cookWith` text NOT NULL,
  `sideOrder` varchar(555) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `dateOrdered` datetime NOT NULL,
  `cash` tinyint(1) NOT NULL DEFAULT '0',
  `orderRead` tinyint(1) NOT NULL DEFAULT '0',
  `orderCompleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Completed Order',
  `orderBy` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `status` enum('C','D','L') NOT NULL DEFAULT 'C' COMMENT 'C->''cooking'',D->''Done,L->''Late''''',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=841 ;

--
-- Dumping data for table `ordersPaid`
--

INSERT INTO `ordersPaid` VALUES(1, '123', 1, 2, 'C B', '', 1, '2013-11-26 14:45:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(2, '123', 0, 1, '', '', 3, '2013-11-26 14:45:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(3, '18085541582', 0, 3, '', '', 1, '2013-11-26 15:48:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(4, '18085541582', 0, 18, '', '', 2, '2013-11-26 15:48:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(5, '18085541582', 0, 200, '', '', 1, '2013-12-03 02:42:16', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(6, '18085541582', 0, 100, '', '', 1, '2013-12-03 02:42:16', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(7, '18085541582', 0, 7, '', '', 1, '2013-12-03 02:42:16', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(8, '18085541582', 0, 200, '', '', 1, '2013-12-03 10:55:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(9, '18085541582', 0, 100, '', '', 2, '2013-12-03 10:55:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(10, '18085541582', 0, 1, '', '', 1, '2013-12-03 10:55:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(11, '123', 0, 100, '', '', 1, '2013-12-07 06:35:19', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(12, '123', 0, 1, 'C', '', 1, '2013-12-07 06:35:19', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(13, '123', 0, 7, 'P', '', 1, '2013-12-07 06:35:19', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(14, '18085541582', 0, 100, '', '', 1, '2013-12-10 07:30:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(15, '18085541582', 0, 7, 'P', '', 1, '2013-12-10 07:30:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(16, '18085541582', 0, 1, 'C', '', 1, '2013-12-10 07:30:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(17, '18085541582', 0, 102, '', '', 1, '2013-12-10 07:36:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(18, '18085541582', 0, 3, 'P', '', 1, '2013-12-10 07:36:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(19, '18085541582', 0, 23, 'KPCKSM', '', 1, '2013-12-10 07:36:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(20, '18085541582', 0, 1, '', '', 2, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(21, '18085541582', 0, 17, 'C', '', 1, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(22, '18085541582', 0, 100, '', '', 1, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(23, '18085541582', 0, 3, '', '', 5, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(24, '18085541582', 0, 7, 'P', '', 3, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(25, '18085541582', 0, 2, '', '', 2, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(26, '18085541582', 0, 4, '', '', 2, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(27, '18085541582', 0, 5, '', '', 2, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(28, '18085541582', 0, 6, '', '', 2, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(29, '18085541582', 0, 101, '', '', 1, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(30, '18085541582', 0, 102, '', '', 1, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(31, '18085541582', 0, 103, '', '', 1, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(32, '18085541582', 0, 22, '', '', 1, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(33, '18085541582', 0, 23, '', '', 1, '2014-01-23 04:43:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(34, '18085541582', 0, 2, 'C', '', 1, '2014-01-24 20:35:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(35, '18085541582', 0, 1, 'P', '', 1, '2014-01-24 20:35:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(36, '18085541582', 0, 17, 'PHOT', '', 1, '2014-01-24 20:45:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(37, '18085541582', 0, 7, 'VEGGIES', '', 1, '2014-01-24 20:45:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(38, '18085541582', 0, 10, 'CNOOINION', '', 1, '2014-01-24 21:12:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(39, '18085541582', 0, 7, 'P', '', 1, '2014-01-24 21:12:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(40, '18085541582', 0, 1, 'POTATOSERACHA', '', 1, '2014-01-24 21:12:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(41, '18085541582', 0, 3, ' P', '', 1, '2014-01-29 07:53:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(42, '18085541582', 0, 4, ' HOT', '', 1, '2014-01-29 07:53:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(43, '18085541582', 0, 2, 'C', '', 1, '2014-01-29 07:53:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(44, '18085541582', 0, 1, '', '', 1, '2014-01-29 07:53:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(45, '18085541582', 0, 11, 'ABCDEFGGIJKLMNOPRSTUVWXYZ', '', 1, '2014-01-29 08:03:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(46, '18085541582', 0, 10, '', '', 2, '2014-01-29 08:03:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(47, '18085541582', 0, 11, ' C HOT', '', 1, '2014-01-30 04:46:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(48, '18085541582', 0, 10, '', '', 1, '2014-01-30 04:46:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(49, '18085541582', 0, 9, '', '', 1, '2014-01-30 04:46:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(50, '18085541582', 0, 8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ', '', 1, '2014-01-30 04:46:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(51, '0000', 0, 2, '', '', 4, '2014-01-30 12:29:32', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(52, '0000', 0, 1, 'P', '', 10, '2014-01-30 12:29:32', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(53, '18085541582', 0, 1, '', '', 1, '2014-01-30 20:42:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(54, '18085541582', 0, 3, 'P', '', 1, '2014-01-30 20:51:53', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(55, '18085541582', 0, 17, 'C', '', 1, '2014-01-31 06:11:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(56, '0000', 0, 1, '', '', 1, '2014-01-31 07:35:14', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(57, '18085541582', 0, 1, '', '', 1, '2014-01-31 10:40:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(58, '18085541764', 0, 17, '', '', 1, '2014-01-31 10:50:18', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(59, '18085541764', 0, 1, '', '', 1, '2014-01-31 10:50:18', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(60, '18085541764', 0, 19, '', '', 1, '2014-01-31 10:50:18', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(61, '18085541764', 0, 7, 'P', '', 1, '2014-01-31 10:50:18', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(62, '18085541764', 0, 23, 'KST', '', 2, '2014-01-31 10:55:57', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(63, '18085541582', 0, 1, ' C', '', 2, '2014-01-31 10:58:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(64, '18085541582', 0, 1, 'P  C', '', 2, '2014-01-31 12:29:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(65, '0000', 0, 1, 'P  C', '', 2, '2014-01-31 12:32:34', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(66, '18085541582', 0, 1, 'P  C HOT', '', 2, '2014-01-31 12:36:12', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(67, '0000', 0, 1, 'P  C HOT', '', 2, '2014-01-31 12:40:39', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(68, '0000', 0, 1, ' X HOT', '', 1, '2014-01-31 12:44:59', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(69, '0000', 0, 1, 'C', '', 1, '2014-01-31 12:44:59', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(70, '18085541582', 0, 1, ' C HOT', '', 1, '2014-01-31 12:50:20', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(71, '18085541582', 0, 1, 'P', '', 1, '2014-01-31 12:50:20', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(72, '18085541582', 0, 1, 'HOT', '', 1, '2014-02-01 10:43:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(73, '18085541582', 0, 1, 'P', '', 1, '2014-02-01 10:43:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(74, '18085541582', 0, 2, 'C', '', 1, '2014-02-01 10:43:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(75, '18085541582', 0, 1, ' ', '', 2, '2014-02-01 10:43:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(76, '18085541764', 0, 18, '', '', 1, '2014-02-01 20:32:24', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(77, '18085541764', 0, 9, '', '', 1, '2014-02-01 20:32:24', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(78, '18085541582', 0, 7, 'in', '', 1, '2014-02-02 18:10:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(79, '18085541582', 0, 1, 'p', '', 1, '2014-02-02 18:10:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(80, '18085541582', 0, 2, '', '', 1, '2014-02-02 18:10:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(81, '18085541582', 0, 1, ' ', '', 2, '2014-02-02 18:10:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(82, '18085541582', 0, 7, '', '', 1, '2014-02-04 03:39:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(83, '18085541582', 0, 9, '', '', 1, '2014-02-04 03:40:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(84, '18085541582', 0, 17, '', '', 1, '2014-02-04 03:48:24', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(85, '18085541582', 2, 2, '', '', 1, '2014-02-04 13:32:21', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(86, '18085541582', 2, 1, '', '', 1, '2014-02-04 13:32:21', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(87, '18085541582', 3, 2, '', '', 1, '2014-02-04 14:28:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(88, '18085541582', 3, 1, '', '', 1, '2014-02-04 14:28:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(89, '18085541582', 4, 2, '', '', 1, '2014-02-04 21:37:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(90, '18085541582', 4, 1, '', '', 1, '2014-02-04 21:37:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(91, '18085541582', 5, 3, '', '', 1, '2014-02-04 21:44:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(92, '18085541582', 5, 2, '', '', 1, '2014-02-04 21:44:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(93, '18085541582', 5, 1, '', '', 1, '2014-02-04 21:44:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(94, '18085541582', 6, 1, '', '', 1, '2014-02-05 20:47:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(95, '18085541582', 7, 7, '', '', 1, '2014-02-05 20:53:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(96, '18085541582', 7, 2, '', '', 1, '2014-02-05 20:53:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(97, '18085541582', 7, 1, '', '', 1, '2014-02-05 20:53:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(98, '18085541582', 8, 1, '', '', 1, '2014-02-06 07:18:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(99, '18085541582', 9, 7, '', '', 1, '2014-02-06 21:30:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(100, '18085541582', 9, 2, '', '', 1, '2014-02-06 21:30:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(101, '18085541582', 9, 1, '', '', 1, '2014-02-06 21:30:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(102, '18085541764', 10, 1, '', '', 1, '2014-02-07 10:14:16', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(103, '18085541764', 11, 2, '', '', 1, '2014-02-07 10:16:17', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(104, '18085541764', 12, 7, '', '', 1, '2014-02-07 10:47:10', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(105, '18085541764', 13, 9, '', '', 1, '2014-02-07 11:37:19', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(106, '18085541764', 14, 9, '', '', 1, '2014-02-07 11:40:31', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(107, '18085541582', 15, 1, '', '', 1, '2014-02-09 19:32:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(108, '18085541582', 16, 7, 'eric', '', 1, '2014-02-09 19:35:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(109, '18085541582', 16, 2, '', '', 1, '2014-02-09 19:35:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(110, '18085541582', 16, 1, '', '', 1, '2014-02-09 19:35:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(111, '18085541582', 17, 2, '', '', 1, '2014-02-09 19:41:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(112, '18085541582', 18, 1, '', '', 1, '2014-02-10 11:42:53', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(113, '18085541582', 19, 1, '', '', 1, '2014-02-11 06:13:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(114, '18085541582', 20, 1, '', '', 1, '2014-02-11 11:38:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(115, '18085541582', 21, 2, '', '', 1, '2014-02-11 11:39:35', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(116, '18085541582', 22, 17, '', '', 1, '2014-02-11 12:59:31', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(117, '0000', 23, 1, '   ', '', 4, '2014-02-11 13:07:34', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(118, '0000', 23, 2, 'C', '', 1, '2014-02-11 13:07:34', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(119, '0000', 23, 1, 'P ', '', 2, '2014-02-11 13:07:34', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(120, '0000', 24, 1, '', '', 1, '2014-02-11 13:09:11', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(121, '18085541582', 25, 2, '', '', 1, '2014-02-11 13:11:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(122, '18085541582', 26, 1, '', '', 1, '2014-02-11 13:20:17', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(123, '18085541582', 27, 1, '', '', 1, '2014-02-11 13:50:20', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(124, '18085541582', 28, 17, '', '', 1, '2014-02-12 15:09:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(125, '18085541582', 29, 7, '', '', 1, '2014-02-12 15:10:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(126, '18085541764', 30, 1, '', '', 1, '2014-02-12 15:12:23', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(127, '18085541582', 31, 2, '', '', 1, '2014-02-12 15:17:42', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(128, '18085541582', 32, 5, '', '', 1, '2014-02-12 15:27:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(129, '18085541582', 32, 3, '', '', 1, '2014-02-12 15:27:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(130, '18085541764', 33, 7, '', '', 1, '2014-02-13 10:45:57', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(131, '18085541582', 34, 1, '', '', 1, '2014-02-13 10:51:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(132, '18085541582', 35, 2, '', '', 1, '2014-02-13 11:07:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(133, '18085541582', 35, 7, 'c', '', 1, '2014-02-13 11:07:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(134, '18085541764', 36, 30, '', '', 1, '2014-02-13 17:46:31', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(135, '18085541764', 37, 104, '', '', 1, '2014-02-13 17:47:54', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(136, '18085541764', 37, 9, '', '', 1, '2014-02-13 17:47:54', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(137, '18085541764', 38, 23, 'sm tc mf', '', 1, '2014-02-13 17:52:31', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(138, '18085541582', 39, 1, ' ', '', 2, '2014-02-14 08:22:20', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(139, '16027913519', 40, 11, 'loco moco', '', 1, '2014-02-14 13:05:26', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(140, '18085541582', 41, 1, '', '', 1, '2014-02-14 15:55:14', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(141, '18085541582', 41, 100, '', '', 1, '2014-02-14 15:55:14', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(142, '18085541582', 42, 2, '', '', 1, '2014-02-14 15:57:14', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(143, '18085541582', 43, 100, '', '', 1, '2014-02-14 21:25:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(144, '18085541582', 44, 100, '', '', 1, '2014-02-14 21:29:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(145, '18085541582', 45, 100, '', '', 1, '2014-02-14 21:32:08', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(146, '18085541582', 46, 1, ' ', '', 2, '2014-02-17 13:57:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(147, '18085541582', 46, 2, '  ', '', 3, '2014-02-17 13:57:36', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(148, '16027913519', 47, 15, 'cutlet cheese curry sauce on the side', '', 1, '2014-02-20 13:57:30', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(149, '18085541582', 48, 1, '', '', 1, '2014-02-21 11:27:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(150, '18085541582', 49, 2, '', '', 1, '2014-02-21 14:50:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(151, '18085541582', 50, 2, '', '', 1, '2014-02-21 15:02:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(152, '18085541582', 51, 7, '', '', 1, '2014-02-21 15:03:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(153, '18085541582', 52, 1, '', '', 1, '2014-02-24 10:56:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(154, '18085541582', 53, 8, '', '', 1, '2014-02-24 11:02:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(155, '18085541582', 54, 99, '', '', 1, '2014-02-24 17:27:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(156, '18085541582', 54, 9, '', '', 1, '2014-02-24 17:27:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(157, '18085541582', 55, 7, '', '', 1, '2014-02-24 18:03:12', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(158, '18085541582', 56, 1, '', '', 1, '2014-02-25 13:41:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(159, '18085541582', 57, 7, '', '', 1, '2014-02-27 15:17:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(160, '18085541582', 58, 1, '', '', 1, '2014-02-28 09:40:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(161, '18085541582', 59, 2, '', '', 1, '2014-03-03 13:01:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(162, '18085541582', 60, 2, '', '', 1, '2014-03-06 12:21:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(163, '16027913519', 61, 7, 'kalua pork half order iced coffee', '', 1, '2014-03-07 13:34:26', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(164, '16025054850', 62, 15, '', '', 1, '2014-03-10 10:34:51', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(165, '16025054850', 63, 40, '', '', 1, '2014-03-11 12:27:38', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(166, '18085541582', 64, 1, '', '', 1, '2014-03-12 10:39:54', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(167, '18085541582', 65, 1, '', '', 1, '2014-03-26 07:43:42', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(168, '16027913519', 66, 7, '', '', 1, '2014-03-26 13:36:02', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(169, '18085541582', 67, 7, '', '', 1, '2014-03-27 10:31:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(170, '16029891022', 68, 1, '', '', 1, '2014-04-10 13:36:18', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(171, '18085541582', 69, 7, '', '', 1, '2014-04-11 17:31:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(172, '18085541582', 69, 2, '', '', 1, '2014-04-11 17:31:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(173, '18085541582', 70, 1, '', '', 1, '2014-04-15 11:53:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(174, '16029891022', 71, 1, '', '', 1, '2014-04-18 13:02:06', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(175, '16029891022', 71, 30, '', '', 1, '2014-04-18 13:02:06', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(176, '19724395805', 72, 18, '', '', 1, '2014-05-08 11:40:10', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(177, '16029891022', 73, 2, 'cc', '', 1, '2014-05-13 13:37:19', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(178, '16029891022', 73, 30, '', '', 1, '2014-05-13 13:37:19', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(179, '16029891022', 74, 2, '', '', 1, '2014-05-29 12:35:34', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(180, '18085541764', 75, 1, '', '', 1, '2014-06-17 10:11:20', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(181, '18085541582', 76, 2, '', '', 1, '2014-06-17 10:11:20', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(182, '18085541764', 77, 3, '', '', 1, '2014-06-17 10:12:59', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(183, '18085541582', 78, 4, '', '', 1, '2014-06-17 10:13:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(184, '18085541582', 79, 1, 'c', '', 1, '2014-08-18 10:40:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(185, '077777', 80, 200, '', '', 1, '2014-10-30 06:55:40', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(186, '077777', 80, 83, '', '', 1, '2014-10-30 06:55:40', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(187, '077777', 80, 7, '', '83,66', 1, '2014-10-30 06:55:40', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(188, '07777777', 81, 4, 'Mac Salad & BBQ Chicken Salad & testarea', '83,66', 1, '2014-10-31 00:47:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(189, '123123123', 82, 1, 'Rice & Mac Salad & add chilli', '82,83', 1, '2014-10-31 07:23:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(190, '123123123', 83, 7, 'Rice & Mac Salad & chilli', '82,83', 1, '2014-10-31 10:33:21', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(191, '123123123', 84, 120, 'test1', '', 1, '2014-10-31 10:45:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(192, '123123123', 84, 121, 'test2', '', 1, '2014-10-31 10:45:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(193, '123123123', 85, 9, 'Rice & Mac Salad & test1', '82,83', 1, '2014-10-31 10:50:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(194, '123123123', 85, 11, 'Rice &', '82', 1, '2014-10-31 10:50:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(195, '123123123', 85, 12, 'Rice & Mac Salad & test3', '82,83', 1, '2014-10-31 10:50:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(196, '099999', 86, 1, 'Potato Salad (2 scoops) & Coleslaw & NOTE TO COOK', '68,69', 1, '2014-10-31 12:50:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(197, '9898', 87, 7, 'Rice & NOTE', '82', 1, '2014-10-31 13:23:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(212, '123123123', 91, 10, 'Rice & Coleslaw & Spicy', '82,69', 1, '2014-11-04 11:51:53', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(213, '123123123', 91, 100, 'Coke &', '84', 1, '2014-11-04 11:51:53', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(214, '6025500383', 92, 7, 'Rice & Coleslaw &', '82,69', 1, '2014-11-04 12:27:26', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(215, '18085541582', 93, 1, 'c', '', 1, '2014-11-07 11:13:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(216, '18085541582', 94, 1, 'c', '', 1, '2014-11-10 18:28:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(217, '858-688-3204', 95, 11, '', '', 1, '2014-11-14 10:45:23', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(218, '123123123', 96, 11, '', '', 1, '2014-11-16 08:09:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(219, '6023502331', 97, 14, 'Rice & Mac Salad & curry sauce on side', '82,83', 1, '2014-11-17 17:14:23', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(220, '6023502331', 97, 83, '', '', 1, '2014-11-17 17:14:23', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(221, '077777777', 98, 11, '', '', 1, '2014-11-18 10:51:16', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(222, '123123123', 99, 11, '', '', 2, '2014-11-19 07:33:11', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(223, '5417606367', 100, 7, 'Rice & Potato Salad & Thank you!', '82,68', 1, '2014-11-19 11:50:14', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(211, '0711111111', 90, 3, 'Coleslaw & noetete', '69', 1, '2014-11-03 01:24:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(224, '7605009741', 101, 1, 'Rice & Potato Salad &', '82,68', 1, '2014-11-21 10:45:54', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(225, '7605009741', 101, 19, '', '', 2, '2014-11-21 10:45:54', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(226, '3154863801', 102, 18, '', '', 1, '2014-11-21 10:47:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(227, '858-688-3204', 103, 3, 'Rice & Mac Salad &', '82,83', 2, '2014-11-28 10:51:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(228, '6028459798', 104, 17, 'Rice & Potato Salad &', '82,68', 1, '2014-12-01 12:22:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(229, '6028459798', 104, 8, 'Rice & Potato Salad &', '82,68', 1, '2014-12-01 12:22:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(325, '123test', 171, 2, 'Rice & Mac Salad &', '82,83', 1, '2014-12-16 10:09:11', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(230, '18085541582', 105, 2, 'p', '', 0, '2014-12-07 08:29:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(231, '18085541582', 105, 1, 'c', '', 0, '2014-12-07 08:29:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(232, '18085541582', 106, 8, 'rice', '', 0, '2014-12-09 09:37:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(233, '18085541582', 107, 9, 'patoto', '', 0, '2014-12-09 09:40:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(234, '18085541582', 107, 10, 'rice', '', 0, '2014-12-09 09:40:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(235, '88888888', 108, 2, 'Rice & Mac Salad & xcvvcx Rice & Mac Salad & xcvvcx', '82,83', 2, '2014-12-10 07:28:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(236, '88888888', 109, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:28:46', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(237, '88888888', 110, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:28:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(238, '88888888', 111, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:28:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(239, '88888888', 112, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:28:55', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(240, '88888888', 113, 2, 'Rice & Mac Salad & xcvvcx Rice & Mac Salad & xcvvcx', '82,83', 2, '2014-12-10 07:28:58', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(241, '88888888', 114, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:28:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(242, '88888888', 115, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:29:24', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(243, '88888888', 116, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:29:32', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(244, '88888888', 117, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:31:46', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(245, '88888888', 118, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:33:06', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(246, '88888888', 119, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:33:13', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(247, '88888888', 120, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:35:40', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(248, '88888888', 121, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:37:31', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(249, '88888888', 122, 2, 'Rice & Mac Salad & xcvvcx Rice & Mac Salad & xcvvcx', '82,83', 2, '2014-12-10 07:38:08', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(250, '88888888', 123, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:38:30', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(251, '88888888', 124, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:39:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(252, '88888888', 125, 2, 'Rice & Mac Salad & xcvvcx', '82,83', 1, '2014-12-10 07:41:24', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(253, '88888888', 126, 1, 'Rice & Mac Salad & test', '82,83', 1, '2014-12-10 07:42:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(254, '88888888', 127, 1, 'Rice & Coleslaw & test', '82,69', 1, '2014-12-10 07:44:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(255, '88888888', 128, 2, 'Rice & Mac Salad & test', '82,83', 1, '2014-12-10 07:46:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(256, '88888888', 129, 1, 'Mac Salad & Coleslaw & test', '83,69', 1, '2014-12-10 07:53:17', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(257, '88888888', 130, 5, 'test', '', 1, '2014-12-10 07:58:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(258, '88888888', 131, 5, 'test', '', 1, '2014-12-10 08:07:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(259, '88888888', 132, 3, 'Mac Salad & Potato Salad & test', '83,68', 1, '2014-12-10 08:08:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(260, '123123123', 133, 1, 'Rice & Mac Salad &', '82,83', 1, '2014-12-10 08:23:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(261, '123123123', 134, 4, 'Rice & Mac Salad &', '82,83', 1, '2014-12-10 08:25:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(262, '123123123', 134, 2, 'Rice & Mac Salad & test2', '82,83', 1, '2014-12-10 08:25:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(263, '5897', 135, 2, 'Rice & hi', '82', 1, '2014-12-10 08:49:57', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(264, '123123123', 136, 7, 'Mac Salad & test2 Mac Salad & test2', '83', 2, '2014-12-10 09:12:21', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(265, '123123123', 136, 1, 'Rice & Potato Salad & Rice & Potato Salad &', '82,68', 2, '2014-12-10 09:12:21', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(266, '123123123', 136, 11, ' ', '', 2, '2014-12-10 09:12:21', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(267, '123123123', 136, 6, 'Coleslaw & test3', '69', 1, '2014-12-10 09:12:21', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(268, '123123123', 137, 1, 'Potato Salad & Coleslaw & test2', '68,69', 1, '2014-12-10 09:17:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(269, '123123123', 137, 1, 'Rice & Mac Salad &', '82,83', 1, '2014-12-10 09:17:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(270, '18085541582', 138, 1, 'c', '', 0, '2014-12-10 10:48:57', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(271, '4477', 139, 2, 'Rice & c', '82', 1, '2014-12-10 10:53:50', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(272, '4477', 140, 3, 'Potato Salad & c', '68', 1, '2014-12-10 10:57:49', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(273, '4477', 141, 4, 'Mac Salad & c', '83', 1, '2014-12-10 11:07:02', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(274, '4477', 142, 5, '', '', 1, '2014-12-10 11:10:19', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(275, '123123123', 143, 6, 'Mac Salad & Potato Salad & test2', '83,68', 1, '2014-12-10 12:32:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(276, '123123123', 143, 5, '', '', 1, '2014-12-10 12:32:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(277, '123123', 144, 1, 'Rice & Mac Salad &', '82,83', 1, '2014-12-11 14:08:34', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(278, '123', 145, 10, 'Rice & Coleslaw &', '82,69', 1, '2014-12-11 14:10:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(279, '123', 145, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-11 14:10:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(280, '123', 146, 7, 'Rice &', '82', 1, '2014-12-11 14:11:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(281, '123', 146, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-11 14:11:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(282, '123', 147, 10, 'Rice & Coleslaw &', '82,69', 1, '2014-12-11 14:12:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(283, '123', 148, 120, '', '', 1, '2014-12-11 14:13:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(284, '123', 148, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-11 14:13:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(285, '123', 149, 121, '', '', 1, '2014-12-11 14:15:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(286, '123', 149, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-11 14:15:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(287, '123', 150, 104, '', '', 1, '2014-12-11 14:17:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(288, '123', 150, 5, '', '', 1, '2014-12-11 14:17:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(289, '123', 150, 8, 'Rice & Coleslaw &', '82,69', 1, '2014-12-11 14:17:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(290, 'mike', 151, 3, 'Mac Salad & WooHooo', '83', 1, '2014-12-11 14:23:29', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(291, '123123123', 152, 1, 'Rice & Potato Salad &', '82,68', 1, '2014-12-12 08:25:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(292, '123123123', 152, 8, 'Potato Salad &', '68', 1, '2014-12-12 08:25:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(293, '18085541582', 153, 1, 'c', '', 0, '2014-12-12 08:58:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(294, 'Lisa', 154, 1, 'Rice & Coleslaw & In', '82,69', 1, '2014-12-12 09:15:11', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(295, 'Lisa', 155, 11, '', '', 1, '2014-12-12 09:15:53', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(296, 'Lisa', 156, 6, 'Rice & Coleslaw &', '82,69', 1, '2014-12-12 09:17:19', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(297, 'Lisa', 157, 1, 'Mac Salad & Potato Salad &', '83,68', 1, '2014-12-12 09:19:11', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(298, 'Lisa', 158, 8, 'Mac Salad & Coleslaw &', '83,69', 1, '2014-12-12 09:20:16', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(299, 'Lisa', 159, 6, 'Rice & Coleslaw &', '82,69', 1, '2014-12-12 09:21:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(300, '858-688-3204', 160, 11, 'Mac salad', '', 3, '2014-12-12 10:43:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(301, '223', 161, 10, 'Rice & Potato Salad & Test Test', '82,68', 1, '2014-12-12 20:47:47', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(302, '223', 161, 1, 'Rice & Coleslaw & Rice & Coleslaw &', '82,69', 2, '2014-12-12 20:47:47', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(303, '223', 161, 8, 'Rice & Coleslaw &', '82,69', 1, '2014-12-12 20:47:47', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(304, '223', 162, 120, ' ', '', 2, '2014-12-12 20:49:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(305, '223', 162, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-12 20:49:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(306, '223', 162, 8, 'Rice & Coleslaw & Rice & Coleslaw &', '82,69', 2, '2014-12-12 20:49:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(307, '223', 162, 6, 'Rice & Coleslaw & Rice & Coleslaw &', '82,69', 2, '2014-12-12 20:49:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(308, '789789789', 163, 9, 'Mac Salad & Potato Salad & test Mac Salad & Potato Salad & test', '83,68', 2, '2014-12-12 23:29:39', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(309, '889955', 164, 4, 'Rice & ijaz', '82', 1, '2014-12-12 23:31:17', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(310, '889955', 164, 6, 'Mac Salad & ijaz test', '83', 1, '2014-12-12 23:31:17', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(311, '789789789', 165, 7, 'Rice & Coleslaw & test2', '82,69', 1, '2014-12-12 23:31:17', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(312, '789789789', 165, 1, 'Mac Salad & Potato Salad & test1', '83,68', 1, '2014-12-12 23:31:17', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(313, '369369369', 166, 1, 'Rice & Mac Salad & test123', '82,83', 1, '2014-12-13 03:40:28', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(314, '123', 167, 3, 'Rice & Potato Salad &', '82,68', 1, '2014-12-13 07:51:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(315, '123', 167, 2, 'Rice & Rice &', '82', 2, '2014-12-13 07:51:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(316, '123', 167, 300, '   ', '', 4, '2014-12-13 07:51:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(317, '123', 167, 1, 'Rice & Potato Salad & Rice & Potato Salad &', '82,68', 2, '2014-12-13 07:51:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(318, '123', 167, 2, 'Rice & Rice &', '82', 2, '2014-12-13 07:51:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(319, '123', 167, 1, 'Rice & Potato Salad & Rice & Potato Salad &', '82,68', 2, '2014-12-13 07:51:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(320, '123', 168, 6, 'Rice & Coleslaw &', '82,69', 1, '2014-12-13 10:08:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(321, '123', 168, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-13 10:08:06', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(322, '123', 169, 7, 'Rice & Coleslaw &', '82,69', 1, '2014-12-13 10:09:39', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(323, '123', 169, 4, 'Rice & Coleslaw &', '82,69', 1, '2014-12-13 10:09:39', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(329, '18085541582', 173, 3, 'rice spicy', '', 0, '2014-12-16 10:55:31', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(324, 'lisa', 170, 23, 'Rice & Potato Salad & KP  Mahi  Teri', '82,68', 1, '2014-12-13 12:09:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(326, '123test', 171, 23, 'Rice & Mac Salad &', '82,83', 1, '2014-12-16 10:09:11', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(327, '123test', 171, 1, 'Rice & Potato Salad & i', '82,68', 1, '2014-12-16 10:09:11', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(328, '18085541582', 172, 1, 'c spicy', '', 0, '2014-12-16 10:11:50', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(330, '18085541582', 174, 1, 'c c', '', 1, '2014-12-16 10:58:37', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(331, 'Lisa', 175, 1, 'Rice & Potato Salad & Test1', '82,68', 1, '2014-12-17 07:59:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(332, 'Lisa', 175, 10, 'Coleslaw & Test2', '69', 1, '2014-12-17 07:59:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(333, 'Lisa', 176, 18, '', '', 1, '2014-12-18 07:28:53', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(334, 'Lisa', 176, 6, 'Rice & Coleslaw &', '82,69', 1, '2014-12-18 07:28:53', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(335, 'Lisa', 176, 10, 'Mac Salad &', '83', 1, '2014-12-18 07:28:53', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(336, 'Lisa', 177, 10, 'Potato Salad & Coleslaw &', '68,69', 1, '2014-12-18 07:29:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(337, 'Lisa', 177, 1, 'Rice &', '82', 1, '2014-12-18 07:29:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(338, 'Lisa', 177, 102, '', '', 1, '2014-12-18 07:29:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(339, 'Lisa', 178, 7, 'Rice & Coleslaw &', '82,69', 1, '2014-12-18 07:31:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(340, 'Lisa', 178, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-18 07:31:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(341, 'Lisa', 179, 12, 'Rice & Potato Salad &', '82,68', 1, '2014-12-18 07:32:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(342, 'Lisa', 179, 10, 'Rice &', '82', 1, '2014-12-18 07:32:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(343, 'Lisa', 179, 13, 'Rice & Coleslaw &', '82,69', 1, '2014-12-18 07:32:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(344, 'Lisa', 180, 1, 'Rice & Potato Salad &', '82,68', 1, '2014-12-18 07:33:17', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(345, 'Lisa', 181, 41, 'Red &', '88', 1, '2014-12-18 07:34:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(346, 'Lisa', 182, 6, 'Mac Salad & Coleslaw & I', '83,69', 1, '2014-12-18 07:54:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(347, 'Lisa', 182, 11, '', '', 1, '2014-12-18 07:54:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(348, 'Lisa', 183, 18, 'All spicy', '', 1, '2014-12-18 10:49:35', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(349, 'Lisa', 183, 18, '', '', 2, '2014-12-18 10:49:35', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(350, 'Lisa', 184, 18, ' ', '', 4, '2014-12-18 10:51:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(351, 'Lisa', 185, 18, '', '', 3, '2014-12-18 10:53:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(352, 'Lisa', 186, 40, 'Yellow &', '90', 1, '2014-12-18 10:55:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(353, 'Lisa', 187, 18, '', '', 1, '2014-12-18 10:55:24', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(354, 'Lisa', 188, 10, 'Rice & Mac Salad &', '82,83', 1, '2014-12-18 11:11:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(355, 'Lisa', 189, 19, '', '', 1, '2014-12-18 11:12:46', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(356, 'Lisa', 190, 11, '', '', 1, '2014-12-18 11:14:11', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(357, '7605009741', 191, 11, '', '', 1, '2014-12-19 10:51:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(358, '7605009741', 191, 19, '', '', 2, '2014-12-19 10:51:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(359, 'test', 192, 2, 'Mac Salad & test2', '83', 1, '2014-12-19 13:04:53', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(360, 'test', 192, 1, 'Rice & test1', '82', 1, '2014-12-19 13:04:53', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(361, 'test', 193, 1, 'Rice &', '82', 1, '2014-12-19 13:06:39', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(362, 'test', 193, 4, 'Potato Salad & test4', '68', 1, '2014-12-19 13:06:39', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(367, '123123', 197, 2, 'Rice & cc', '82', 1, '2014-12-20 05:31:54', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(363, 'test', 194, 1, 'Rice & c', '82', 1, '2014-12-19 13:12:27', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(364, 'mj', 195, 5, 'nn', '', 1, '2014-12-19 13:38:51', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(365, 'mj', 195, 4, 'Mac Salad & cc', '83', 1, '2014-12-19 13:38:51', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(366, 'mj', 196, 7, 'Mac Salad &', '83', 1, '2014-12-19 13:42:40', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(368, 'lisa', 198, 9, 'Rice & test2', '82', 1, '2014-12-22 07:24:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(369, 'lisa', 198, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-22 07:24:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(370, 'lisa', 198, 6, 'Rice & Potato Salad &', '82,68', 1, '2014-12-22 07:24:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(371, 'lisa', 198, 10, 'Rice & Mac Salad & test1', '82,83', 1, '2014-12-22 07:24:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(372, 'lisa', 198, 44, 'Red &', '88', 1, '2014-12-22 07:24:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(373, 'lisa', 199, 8, 'Rice & Coleslaw & test3', '82,69', 1, '2014-12-22 07:25:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(374, 'lisa', 199, 7, 'Mac Salad & Potato Salad & test4', '83,68', 1, '2014-12-22 07:25:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(375, 'lisa', 200, 20, 'test5', '', 1, '2014-12-22 07:29:42', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(376, 'lisa', 200, 19, 'test6', '', 1, '2014-12-22 07:29:42', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(377, 'lisa', 201, 11, 'test7', '', 1, '2014-12-22 07:30:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(378, 'lisa', 201, 12, 'Rice & Mac Salad & test8', '82,83', 1, '2014-12-22 07:30:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(379, '147741', 202, 2, 'Rice & hi', '82', 1, '2014-12-23 05:58:10', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(383, '65895', 203, 1, 'Rice & Potato Salad & test1', '82,68', 1, '2014-12-23 07:06:33', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(384, '65895', 203, 2, 'Potato Salad & Coleslaw & m', '68,69', 1, '2014-12-23 07:06:33', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(385, '987789', 204, 1, 'Rice & Potato Salad & test1', '82,68', 1, '2014-12-23 07:12:13', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(386, '987789', 204, 2, 'Rice & Coleslaw & test2', '82,69', 1, '2014-12-23 07:12:13', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(387, 'Lisa', 205, 1, 'Rice & Coleslaw & Test1', '82,69', 1, '2014-12-24 06:19:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(388, 'Lisa', 205, 6, 'Rice & Test2', '82', 1, '2014-12-24 06:19:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(389, 'Lisa', 206, 2, 'Rice & Potato Salad & Test12', '82,68', 1, '2014-12-24 07:01:25', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(390, 'Lisa', 206, 1, 'Rice & Mac Salad & Test11', '82,83', 1, '2014-12-24 07:01:25', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(391, 'Lisa', 207, 3, 'Rice & Coleslaw & Test13', '82,69', 1, '2014-12-24 07:03:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(392, 'Lisa', 207, 4, 'Mac Salad & Potato Salad & Test114', '83,68', 1, '2014-12-24 07:03:01', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(393, 'Lisa', 208, 2, 'Rice & Potato Salad & S2', '82,68', 1, '2014-12-24 07:10:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(394, 'Lisa', 208, 1, 'Rice & Mac Salad & S1', '82,83', 1, '2014-12-24 07:10:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(395, 'Lisa', 209, 3, 'Rice & Coleslaw & S3', '82,69', 1, '2014-12-24 07:15:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(396, 'Lisa', 209, 4, 'Mac Salad & Potato Salad & S4', '83,68', 1, '2014-12-24 07:15:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(399, 'Corey', 211, 10, 'Rice & Mac Salad &', '82,83', 1, '2014-12-24 11:39:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(397, '5441999lisa', 210, 1, 'Rice & Mac Salad & spicy1', '82,83', 1, '2014-12-24 08:24:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(398, '5441999lisa', 210, 2, 'Rice & Potato Salad & spicy2', '82,68', 1, '2014-12-24 08:24:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(400, 'Corey', 211, 1, 'Rice & Potato Salad & Spicy', '82,68', 1, '2014-12-24 11:39:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(401, 'Corey', 212, 2, 'Rice & Potato Salad &', '82,68', 1, '2014-12-24 11:40:16', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(402, 'Eric', 213, 2, 'Mac Salad & S2', '83', 1, '2014-12-27 10:01:36', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(403, 'eric', 213, 1, 'Rice & Coleslaw & Rice & Coleslaw &', '82,69', 2, '2014-12-27 10:01:36', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(404, 'eric', 213, 2, 'Rice & Coleslaw & Rice & Coleslaw &', '82,69', 2, '2014-12-27 10:01:36', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(405, 'eric', 213, 6, '& &', '', 2, '2014-12-27 10:01:36', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(406, 'eric', 213, 1, 'Rice & Coleslaw &', '82,69', 1, '2014-12-27 10:01:36', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(407, 'eric', 213, 2, 'Rice & Coleslaw &', '82,69', 1, '2014-12-27 10:01:36', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(408, 'eric', 213, 6, '&', '', 1, '2014-12-27 10:01:36', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(409, 'Eric', 213, 1, 'Rice & S1', '82', 1, '2014-12-27 10:01:36', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(410, 'Eric', 214, 1, 'Rice & 1', '82', 1, '2014-12-27 10:05:38', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(411, 'Eric', 215, 8, 'Mac Salad & 3', '83', 1, '2014-12-27 10:06:56', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(412, 'Eric', 215, 10, 'Coleslaw & 2', '69', 1, '2014-12-27 10:06:56', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(413, 'eric2', 216, 6, 'Rice & Mac Salad & s', '82,83', 1, '2014-12-27 10:24:49', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(414, 'eric', 217, 109, 'test', '', 1, '2014-12-30 11:32:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(415, 'eric', 218, 109, 'testing', '', 1, '2014-12-30 11:37:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(416, 'eric', 219, 109, 'test2', '', 1, '2014-12-30 12:02:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(417, 'eric', 219, 109, 'testing', '', 1, '2014-12-30 12:02:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(418, 'erictest', 220, 109, 'test1', '', 1, '2014-12-31 08:12:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(419, 'erictest', 220, 109, 'test2', '', 1, '2014-12-31 08:12:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(420, 'erictest', 221, 109, 'test3', '', 1, '2014-12-31 08:13:40', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(421, 'test', 222, 1, 'Rice & Coleslaw & test', '82,69', 1, '2015-01-07 22:10:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(422, '18085541582', 223, 1, 'rice', '', 0, '2015-01-07 22:13:35', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(423, '602-564-7770', 224, 23, 'Mac Salad & Coleslaw & Kalua Pork, Chicken Katsu, spam musubi', '83,69', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(424, '602-564-7770', 224, 3, 'Rice & Potato Salad &', '82,68', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(425, '602-564-7770', 224, 9, 'Rice & Potato Salad &', '82,68', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(426, '602-564-7770', 224, 8, 'Rice & Potato Salad &', '82,68', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(427, '602-564-7770', 224, 17, 'Rice & Coleslaw &', '82,69', 3, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(428, '602-564-7770', 224, 2, 'Rice & Mac Salad &', '82,83', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(429, '602-564-7770', 224, 8, 'Rice & please do double rice', '82', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(430, '602-564-7770', 224, 14, 'Rice & Mac Salad &', '82,83', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(431, '602-564-7770', 224, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(432, '602-564-7770', 224, 13, 'Rice & Potato Salad &', '82,68', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(433, '602-564-7770', 224, 7, 'Rice & Coleslaw &', '82,69', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(434, '602-564-7770', 224, 17, 'Rice & please do double rice', '82', 1, '2015-01-14 11:07:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(435, '602-564-7770', 225, 17, 'Rice & Coleslaw &', '82,69', 1, '2015-01-14 11:08:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(436, '6236951409', 226, 13, 'Rice & Potato Salad &', '82,68', 1, '2015-01-22 11:39:12', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(437, 'lisa', 227, 1, 'Rice & Coleslaw & Test', '82,69', 1, '2015-02-10 12:43:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(438, 'lisa', 228, 41, 'Red &', '88', 1, '2015-02-11 15:28:10', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(439, 'lisa', 228, 3, 'Rice & Coleslaw &', '82,69', 1, '2015-02-11 15:28:10', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(440, 'lisa', 228, 103, '', '', 1, '2015-02-11 15:28:10', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(441, 'lisa', 228, 13, 'Rice & Coleslaw &', '82,69', 1, '2015-02-11 15:28:10', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(442, 'lisa', 228, 9, 'Rice & Coleslaw &', '82,69', 1, '2015-02-11 15:28:10', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(443, 'lisa', 229, 19, 'In', '', 1, '2015-02-11 15:32:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(444, 'lisa', 230, 18, 'In', '', 1, '2015-02-11 15:34:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(445, 'lisa', 231, 1, 'Rice & Potato Salad & test', '82,68', 1, '2015-02-12 07:26:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(446, 'lisa', 232, 1, 'Mac Salad &', '83', 1, '2015-02-12 09:29:23', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(447, 'lisa', 233, 5, 'test1', '', 1, '2015-02-12 11:02:40', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(448, 'lisa', 233, 5, 'test2', '', 1, '2015-02-12 11:02:40', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(449, 'lisa', 234, 23, 'Rice & Potato Salad & Kp,ter,mahi/out', '82,68', 1, '2015-02-12 11:07:48', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(450, 'lisa', 234, 23, 'Rice & Potato Salad & Ter,mahi,kp /out', '82,68', 1, '2015-02-12 11:07:48', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(451, 'lisa', 234, 23, 'Rice & Coleslaw & Kp ma ter', '82,69', 1, '2015-02-12 11:07:48', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(452, 'lisa', 235, 40, 'Red & In', '88', 1, '2015-02-12 11:09:27', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(453, 'lisa', 236, 6, 'Rice & Coleslaw &', '82,69', 1, '2015-02-12 11:11:12', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(454, 'lisa', 237, 123, 'Ot', '', 1, '2015-02-12 11:34:48', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(455, 'lisa', 238, 13, 'Rice & Mac Salad & In', '82,83', 1, '2015-02-12 11:59:17', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(456, 'lisa', 239, 10, 'Rice & Potato Salad & In', '82,68', 1, '2015-02-12 15:07:43', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(457, '6235058106', 240, 7, 'Rice & Coleslaw &', '82,69', 1, '2015-02-13 11:31:48', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(458, 'corey', 241, 10, 'Rice & Potato Salad & Si', '82,68', 1, '2015-02-14 10:03:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(459, 'corey', 242, 10, 'Rice & Coleslaw & O', '82,69', 1, '2015-02-14 10:07:03', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(460, 'corey', 243, 10, 'Rice & Coleslaw & O', '82,69', 1, '2015-02-14 10:08:35', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(461, 'corey', 244, 9, 'Rice & Coleslaw & I', '82,69', 1, '2015-02-14 10:10:02', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(462, 'corey', 245, 9, 'Rice & Potato Salad & O', '82,68', 1, '2015-02-14 10:23:18', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(463, 'corey', 246, 10, 'Rice & Coleslaw &', '82,69', 1, '2015-02-14 10:29:51', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(464, 'test', 247, 9, 'Rice & Coleslaw &', '82,69', 1, '2015-02-14 10:59:42', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(465, 'testcustomer', 248, 3, 'Rice & Coleslaw & test2', '82,69', 1, '2015-02-17 10:42:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(466, 'testcustomer', 248, 2, 'Rice & Mac Salad & test', '82,83', 1, '2015-02-17 10:42:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(467, 'testcustomer', 249, 1, 'Rice & Coleslaw & test3', '82,69', 1, '2015-02-17 10:45:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(468, 'undefined', 250, 2, 'Potato Salad & Can I please get brocolli instead of rice please', '68', 1, '2015-02-18 11:22:46', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(469, '434434', 251, 4, 'Rice & Mac Salad &', '82,83', 1, '2015-02-20 07:20:13', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(470, '434434', 251, 1, 'Rice & Potato Salad & test', '82,68', 1, '2015-02-20 07:20:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(471, '434434', 252, 3, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 07:21:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(472, '434434', 253, 2, 'Rice & Mac Salad & test', '82,83', 1, '2015-02-20 07:23:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(473, '434434', 254, 3, 'Rice & Potato Salad & test', '82,68', 1, '2015-02-20 07:40:35', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(474, '434434', 255, 1, 'Rice & Coleslaw & test', '82,69', 1, '2015-02-20 07:47:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(475, '434434', 256, 6, 'Rice &', '82', 1, '2015-02-20 07:49:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(476, '434434', 257, 3, 'Rice & Coleslaw & add', '82,69', 1, '2015-02-20 07:59:31', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(477, '434434', 258, 1, 'Rice & Mac Salad &', '82,83', 1, '2015-02-20 08:11:45', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(478, '434434', 259, 4, 'Rice & Potato Salad & Rice & Potato Salad &', '82,68', 2, '2015-02-20 08:22:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(479, '434434', 259, 4, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 08:22:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(480, '434434', 260, 1, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 08:23:10', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(481, '434434', 261, 3, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 08:56:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(482, '434434', 262, 1, 'Rice & Potato Salad & test', '82,68', 1, '2015-02-20 09:20:14', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(483, '434434', 263, 3, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 09:23:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(484, '434434', 264, 3, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 09:27:20', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(485, '434434', 265, 2, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 09:38:16', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(486, '434434', 266, 2, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 09:45:03', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(487, '434434', 267, 2, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 09:47:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(488, '434434', 268, 1, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 09:50:26', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(489, '434434', 269, 3, 'Rice & Potato Salad &', '82,68', 2, '2015-02-20 09:52:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(490, '434434', 270, 4, 'Rice & Potato Salad &', '82,68', 1, '2015-02-20 09:59:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(491, 'test', 271, 1, 'Rice & Potato Salad & test', '82,68', 1, '2015-02-20 11:18:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(492, 'test', 271, 1, 'Rice & Mac Salad & test2', '82,83', 1, '2015-02-20 11:18:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(493, 'test', 272, 1, 'Rice & Potato Salad & test Rice & Potato Salad & test', '82,68', 2, '2015-02-20 11:53:17', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(494, 'test', 273, 8, 'Rice & test2', '82', 1, '2015-02-20 11:54:43', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(495, 'test', 273, 1, 'Rice & Potato Salad & test2', '82,68', 1, '2015-02-20 11:54:43', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(496, 'test', 274, 1, 'Rice & Coleslaw & test', '82,69', 1, '2015-02-20 13:01:08', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(497, 'test', 275, 2, 'Rice & test3', '82', 1, '2015-02-20 13:01:41', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(498, '258852', 276, 4, 'Potato Salad &', '68', 1, '2015-02-20 20:52:05', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(499, '6028039802', 277, 23, 'Potato Salad & Coleslaw &', '68,69', 1, '2015-02-24 11:28:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(500, '6028039802', 277, 31, '', '', 1, '2015-02-24 11:28:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(501, '6232029463', 278, 83, ' ', '', 2, '2015-02-27 10:03:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(502, '6232029463', 278, 18, ' ', '', 2, '2015-02-27 10:03:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(503, '6232029463', 278, 17, 'Rice & Mac Salad & extra mac salad', '82,83', 1, '2015-02-27 10:03:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(504, '6023186811', 279, 3, 'Rice & Mac Salad &', '82,83', 1, '2015-02-27 10:07:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(505, '6023186811', 279, 202, '', '', 1, '2015-02-27 10:07:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(506, 'test', 280, 1, 'Rice & Mac Salad & test', '82,83', 1, '2015-03-27 09:14:48', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(507, 'test', 280, 1, 'Rice & Mac Salad & test Rice & Mac Salad & test', '82,83', 2, '2015-03-27 09:14:48', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(508, '623-695-1409', 281, 1, 'Rice & Mac Salad &', '82,83', 1, '2015-04-16 11:46:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(509, '18085541582', 282, 1, 'c', '', 0, '2015-07-28 10:02:35', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(510, '18085541582', 283, 10, 'm', '', 0, '2015-07-30 18:10:50', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(511, '6238691019', 284, 18, '', '', 1, '2015-08-12 11:28:55', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(512, '6024466320', 285, 18, '', '', 2, '2015-08-17 18:09:03', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(513, '6024466320', 285, 91, '', '', 1, '2015-08-17 18:09:03', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(514, '623-878-3553', 286, 18, '', '', 1, '2015-08-28 11:30:10', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(515, '480-650-6325', 287, 7, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-09-02 16:57:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(516, '480-650-6325', 287, 8, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-09-02 16:57:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(517, '480-650-6325', 287, 30, '', '', 1, '2015-09-02 16:57:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(518, '480-650-6325', 287, 31, '', '', 1, '2015-09-02 16:57:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(519, '480-650-6325', 287, 90, '', '', 1, '2015-09-02 16:57:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(520, '480-650-6325', 287, 13, 'Rice & Mac Salad &', '82,83', 1, '2015-09-02 16:57:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(521, '7605009741', 288, 9, 'Mac Salad &', '83', 1, '2015-09-18 10:31:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(522, '7605009741', 288, 11, '', '', 1, '2015-09-18 10:31:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(523, '7605009741', 288, 13, 'Mac Salad & PLEASE AD AN EXTRA SIDE OF SAUCE', '83', 1, '2015-09-18 10:31:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(524, '7605009741', 288, 90, '', '', 1, '2015-09-18 10:31:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(525, '18085541582', 289, 1, 'c', '', 0, '2015-09-23 17:21:32', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(526, '623-878-3553', 290, 18, '', '', 1, '2015-09-28 11:22:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(527, '623-878-3553', 290, 8, 'Rice & Mac Salad &', '82,83', 1, '2015-09-28 11:22:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(528, '480-845-3319', 291, 1, 'Rice & Mac Salad &', '82,83', 1, '2015-10-08 11:34:17', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(529, 'test', 292, 121, 'test', '', 1, '2015-10-09 07:16:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(530, 'test', 292, 1, 'Rice & Potato Salad & test', '82,68', 1, '2015-10-09 07:16:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(531, 'test', 292, 1, 'Rice & Coleslaw & spicy', '82,69', 1, '2015-10-09 07:16:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(532, 'test', 292, 3, 'Rice & Mac Salad & no onions', '82,83', 1, '2015-10-09 07:16:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(533, 'test2', 293, 122, 'test2', '', 1, '2015-10-09 07:56:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(534, 'test4', 294, 123, 'test 4', '', 1, '2015-10-09 09:04:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(535, '18085541582', 295, 12, '', '', 0, '2015-10-12 10:53:44', 1, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(536, 'test', 296, 3, 'Rice & Mac Salad & Rice & Mac Salad &', '82,83', 2, '2015-10-16 03:27:22', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(537, 'testing', 297, 9, 'Rice & Mac Salad &', '82,83', 1, '2015-10-16 03:52:20', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(538, 'testing', 297, 10, 'Mac Salad & Coleslaw & testing', '83,69', 1, '2015-10-16 03:52:20', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(539, 'testing', 298, 6, 'Coleslaw & test', '69', 1, '2015-10-16 05:06:17', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(540, 'testing', 299, 2, '& &', '', 2, '2015-10-17 05:25:39', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(541, '8105136914', 300, 90, '', '', 1, '2015-10-20 11:48:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(542, '8105136914', 300, 102, '', '', 2, '2015-10-20 11:48:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(543, '8105136914', 300, 14, 'Rice & Mac Salad &', '82,83', 1, '2015-10-20 11:48:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(544, '6024601223', 301, 14, 'Rice & Mac Salad &', '82,83', 1, '2015-11-03 17:20:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(545, '6024601223', 301, 47, 'Rice &', '82', 1, '2015-11-03 17:20:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(580, 'Indoor', 500, 2, 'Rice & Mac Salad &', '', 1, '2015-11-10 23:12:34', 1, 1, 1, '', 7, 'LemonGrass Chicken', 'C');
INSERT INTO `ordersPaid` VALUES(581, 'Indoor', 500, 2, '', '', 1, '2015-11-11 00:15:46', 1, 1, 1, '', 7, 'LemonGrass Chicken', 'C');
INSERT INTO `ordersPaid` VALUES(582, 'Indoor', 500, 4, '&', '', 1, '2015-11-11 00:15:46', 1, 1, 1, '', 9, 'Mahi with special sauce', 'C');
INSERT INTO `ordersPaid` VALUES(583, 'Indoor', 501, 3, 'Rice & Mac Salad & none', '82,83', 1, '2015-12-17 18:11:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(584, 'Indoor', 501, 1, 'Rice & Rice &', '82', 2, '2015-12-17 18:11:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(585, 'Indoor', 501, 3, 'Rice & Mac Salad & none Rice & Mac Salad & none', '82,83', 2, '2015-12-17 18:11:59', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(586, 'Indoor', 502, 3, 'Rice & Mac Salad & none', '82,83', 1, '2015-12-17 18:19:19', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(587, 'Indoor', 502, 1, 'Rice & Rice &', '82', 2, '2015-12-17 18:19:19', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(588, 'Indoor', 502, 3, 'Rice & Mac Salad & none Rice & Mac Salad & none', '82,83', 2, '2015-12-17 18:19:19', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(589, 'Indoor', 503, 4, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-17 18:37:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(590, 'Indoor', 503, 2, 'Coleslaw &', '69', 1, '2015-12-17 18:37:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(591, 'Indoor', 504, 38, 'Rice &', '82', 1, '2015-12-17 19:15:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(592, 'Indoor', 505, 4, 'Rice &', '82', 1, '2015-12-17 19:19:48', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(593, 'Indoor', 506, 1, '&', '', 1, '2015-12-18 12:58:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(594, 'Indoor', 506, 2, 'Mac Salad & test', '83', 1, '2015-12-18 12:58:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(595, 'Indoor', 507, 2, 'Rice & test1', '82', 1, '2015-12-18 13:40:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(596, 'Indoor', 507, 4, 'Mac Salad & test2', '83', 1, '2015-12-18 13:40:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(597, 'Indoor', 507, 34, 'Coleslaw & test3', '69', 1, '2015-12-18 13:40:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(598, 'Indoor', 508, 36, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-18 16:04:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(599, 'Indoor', 508, 34, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-18 16:04:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(600, 'Indoor', 509, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 16:56:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(601, 'Indoor', 510, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 17:55:18', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(602, 'Indoor', 511, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 17:57:46', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(603, 'Indoor', 512, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:00:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(604, 'Indoor', 513, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:03:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(605, 'Indoor', 514, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:16:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(606, 'Indoor', 515, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:21:12', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(607, 'Indoor', 516, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:27:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(608, 'Indoor', 517, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:29:31', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(609, 'Indoor', 518, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:29:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(610, 'Indoor', 519, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:29:35', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(611, 'Indoor', 520, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:30:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(612, 'Indoor', 521, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:35:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(613, 'Indoor', 522, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:36:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(614, 'Indoor', 523, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:42:08', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(615, 'Indoor', 524, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:50:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(616, 'Indoor', 525, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 18:53:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(617, 'Indoor', 525, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 18:53:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(618, 'Indoor', 526, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:01:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(619, 'Indoor', 526, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:01:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(620, 'Indoor', 527, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:05:03', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(621, 'Indoor', 527, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:05:03', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(622, 'Indoor', 528, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:17:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(623, 'Indoor', 528, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:17:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(624, 'Indoor', 529, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:21:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(625, 'Indoor', 529, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:21:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(626, 'Indoor', 530, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:26:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(627, 'Indoor', 530, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:26:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(628, 'Indoor', 531, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:30:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(629, 'Indoor', 531, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:30:56', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(630, 'Indoor', 532, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:31:48', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(631, 'Indoor', 532, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:31:48', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(632, 'Indoor', 533, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:33:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(633, 'Indoor', 533, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:33:06', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(634, 'Indoor', 534, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:37:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(635, 'Indoor', 534, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:37:27', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(636, 'Indoor', 535, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:38:40', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(637, 'Indoor', 535, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:38:40', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(638, 'Indoor', 536, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:39:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(639, 'Indoor', 536, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:39:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(640, 'Indoor', 537, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:41:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(641, 'Indoor', 537, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:41:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(642, 'Indoor', 538, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:42:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(643, 'Indoor', 538, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:42:34', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(644, 'Indoor', 539, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:52:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(645, 'Indoor', 539, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:52:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(646, 'Indoor', 540, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:56:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(647, 'Indoor', 540, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:56:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(648, 'Indoor', 541, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 19:57:55', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(649, 'Indoor', 541, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 19:57:55', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(650, 'Indoor', 542, 36, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-18 20:01:35', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(651, 'Indoor', 542, 36, 'Rice & Coleslaw &', '82,69', 2, '2015-12-18 20:01:35', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(652, 'Indoor', 543, 33, '', '', 2, '2015-12-19 12:49:23', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(653, 'Indoor', 543, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 12:49:23', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(654, 'Indoor', 544, 33, '', '', 2, '2015-12-19 12:59:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(655, 'Indoor', 544, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 12:59:00', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(656, 'Indoor', 545, 33, '', '', 2, '2015-12-19 13:01:55', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(657, 'Indoor', 545, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:01:55', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(658, 'Indoor', 546, 33, '', '', 2, '2015-12-19 13:04:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(659, 'Indoor', 546, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:04:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(660, 'Indoor', 547, 33, '', '', 2, '2015-12-19 13:10:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(661, 'Indoor', 547, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:10:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(662, 'Indoor', 548, 33, '', '', 2, '2015-12-19 13:12:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(663, 'Indoor', 548, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:12:33', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(664, 'Indoor', 549, 33, '', '', 2, '2015-12-19 13:14:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(665, 'Indoor', 549, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:14:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(666, 'Indoor', 550, 33, '', '', 2, '2015-12-19 13:16:55', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(667, 'Indoor', 550, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:16:55', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(668, 'Indoor', 551, 33, '', '', 2, '2015-12-19 13:18:42', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(669, 'Indoor', 551, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:18:42', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(670, 'Indoor', 552, 33, '', '', 2, '2015-12-19 13:20:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(671, 'Indoor', 552, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:20:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(672, 'Indoor', 553, 33, '', '', 2, '2015-12-19 13:22:21', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(673, 'Indoor', 553, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:22:21', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(674, 'Indoor', 554, 33, '', '', 2, '2015-12-19 13:25:12', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(675, 'Indoor', 554, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:25:12', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(676, 'Indoor', 555, 33, '', '', 2, '2015-12-19 13:27:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(677, 'Indoor', 555, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:27:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(678, 'Indoor', 556, 33, '', '', 2, '2015-12-19 13:29:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(679, 'Indoor', 556, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:29:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(680, 'Indoor', 557, 33, '', '', 2, '2015-12-19 13:45:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(681, 'Indoor', 557, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 13:45:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(682, 'Indoor', 558, 33, '', '', 2, '2015-12-19 14:04:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(683, 'Indoor', 558, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:04:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(684, 'Indoor', 559, 33, '', '', 2, '2015-12-19 14:05:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(685, 'Indoor', 559, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:05:02', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(686, 'Indoor', 560, 33, '', '', 2, '2015-12-19 14:06:17', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(687, 'Indoor', 560, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:06:17', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(688, 'Indoor', 561, 33, '', '', 2, '2015-12-19 14:09:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(689, 'Indoor', 561, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:09:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(690, 'Indoor', 562, 33, '', '', 2, '2015-12-19 14:18:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(691, 'Indoor', 562, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:18:04', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(692, 'Indoor', 563, 33, '', '', 2, '2015-12-19 14:20:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(693, 'Indoor', 563, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:20:01', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(694, 'Indoor', 564, 33, '', '', 2, '2015-12-19 14:22:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(695, 'Indoor', 564, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:22:30', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(696, 'Indoor', 565, 33, '', '', 2, '2015-12-19 14:25:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(697, 'Indoor', 565, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:25:38', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(698, 'Indoor', 566, 33, '', '', 2, '2015-12-19 14:27:26', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(699, 'Indoor', 566, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:27:26', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(700, 'Indoor', 567, 33, '', '', 2, '2015-12-19 14:29:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(701, 'Indoor', 567, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:29:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(702, 'Indoor', 568, 33, '', '', 2, '2015-12-19 14:36:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(703, 'Indoor', 568, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:36:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(704, 'Indoor', 569, 33, '', '', 2, '2015-12-19 14:39:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(705, 'Indoor', 569, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:39:32', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(706, 'Indoor', 570, 33, '', '', 2, '2015-12-19 14:41:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(707, 'Indoor', 570, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:41:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(708, 'Indoor', 571, 33, '', '', 2, '2015-12-19 14:55:03', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(709, 'Indoor', 571, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 14:55:03', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(710, 'Indoor', 572, 33, '', '', 2, '2015-12-19 15:01:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(711, 'Indoor', 572, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 15:01:25', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(712, 'Indoor', 573, 33, '', '', 2, '2015-12-19 15:27:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(713, 'Indoor', 573, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 15:27:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(714, 'Indoor', 574, 33, '', '', 2, '2015-12-19 15:29:39', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(715, 'Indoor', 574, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 15:29:39', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(716, 'Indoor', 575, 33, '', '', 2, '2015-12-19 15:49:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(717, 'Indoor', 575, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 15:49:58', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(718, 'Indoor', 576, 33, '', '', 2, '2015-12-19 15:52:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(719, 'Indoor', 576, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 15:52:52', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(720, 'Indoor', 577, 33, '', '', 2, '2015-12-19 15:55:31', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(721, 'Indoor', 577, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 15:55:31', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(722, 'Indoor', 578, 33, '', '', 2, '2015-12-19 16:01:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(723, 'Indoor', 578, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:01:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(724, 'Indoor', 579, 33, '', '', 2, '2015-12-19 16:02:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(725, 'Indoor', 579, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:02:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(726, 'Indoor', 580, 33, '', '', 2, '2015-12-19 16:04:54', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(727, 'Indoor', 580, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:04:54', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(728, 'Indoor', 581, 33, '', '', 2, '2015-12-19 16:05:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(729, 'Indoor', 581, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:05:49', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(730, 'Indoor', 582, 33, '', '', 2, '2015-12-19 16:07:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(731, 'Indoor', 582, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:07:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(732, 'Indoor', 583, 33, '', '', 2, '2015-12-19 16:09:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(733, 'Indoor', 583, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:09:36', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(734, 'Indoor', 584, 33, '', '', 2, '2015-12-19 16:11:21', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(735, 'Indoor', 584, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:11:21', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(736, 'Indoor', 585, 33, '', '', 2, '2015-12-19 16:14:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(737, 'Indoor', 585, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:14:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(738, 'Indoor', 586, 33, '', '', 2, '2015-12-19 16:28:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(739, 'Indoor', 586, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:28:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(740, 'Indoor', 586, 4, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-19 16:28:44', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(741, 'Indoor', 587, 33, '', '', 2, '2015-12-19 16:35:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(742, 'Indoor', 587, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:35:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(743, 'Indoor', 587, 4, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-19 16:35:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(744, 'Indoor', 588, 33, '', '', 2, '2015-12-19 16:38:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(745, 'Indoor', 588, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:38:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(746, 'Indoor', 588, 4, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-19 16:38:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(747, 'Indoor', 589, 33, '', '', 2, '2015-12-19 16:42:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(748, 'Indoor', 589, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:42:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(749, 'Indoor', 589, 4, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-19 16:42:28', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(750, 'Indoor', 590, 33, '', '', 2, '2015-12-19 16:55:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(751, 'Indoor', 590, 35, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-19 16:55:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(752, 'Indoor', 590, 4, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-19 16:55:47', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(753, 'Indoor', 591, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-19 18:00:26', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(754, 'Indoor', 592, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-19 18:02:50', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(755, 'Indoor', 593, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-19 18:12:31', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(756, 'Indoor', 594, 1, 'Rice & test1', '82', 1, '2015-12-20 21:27:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(757, 'Indoor', 594, 3, 'Mac Salad & test2', '83', 1, '2015-12-20 21:27:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(758, 'Indoor', 594, 33, 'test3', '', 1, '2015-12-20 21:27:05', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(759, 'Indoor', 595, 4, 'Rice & Mac Salad &', '82,83', 2, '2015-12-21 12:45:14', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(760, 'Indoor', 596, 4, 'Rice & Mac Salad &', '82,83', 2, '2015-12-21 13:08:13', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(761, 'Indoor', 597, 4, 'Rice & Mac Salad &', '82,83', 2, '2015-12-21 13:17:51', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(762, 'Indoor', 598, 4, 'Rice & Mac Salad &', '82,83', 2, '2015-12-21 13:18:53', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(763, 'Indoor', 599, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 13:36:14', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(764, 'Indoor', 600, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 13:37:43', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(765, 'Indoor', 601, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 13:43:07', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(766, 'Indoor', 602, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 13:44:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(767, 'Indoor', 603, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 13:45:41', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(768, 'Indoor', 604, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 13:48:15', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(769, 'Indoor', 605, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 13:51:39', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(770, 'Indoor', 605, 37, 'Rice & Coleslaw & tesrt', '82,69', 1, '2015-12-21 13:51:39', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(771, 'Indoor', 606, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 14:00:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(772, 'Indoor', 606, 37, 'Rice & Coleslaw & tesrt', '82,69', 1, '2015-12-21 14:00:09', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(773, 'Indoor', 607, 4, 'Rice & Coleslaw &', '82,69', 1, '2015-12-21 14:03:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(774, 'Indoor', 607, 37, 'Rice & Coleslaw & tesrt', '82,69', 1, '2015-12-21 14:03:29', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(775, 'Indoor', 608, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 16:21:08', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(776, 'Indoor', 609, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 16:25:24', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(777, 'Indoor', 610, 4, 'Rice &', '82', 1, '2015-12-21 16:34:55', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(778, 'Indoor', 611, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 16:40:16', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(779, 'Indoor', 612, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 16:47:39', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(780, 'Indoor', 613, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 16:48:56', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(781, 'Indoor', 614, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 16:53:18', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(782, 'Indoor', 615, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 16:55:52', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(783, 'Indoor', 616, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 17:12:17', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(784, 'Indoor', 617, 34, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-21 17:13:47', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(785, 'Indoor', 618, 43, 'Mac Salad &', '82', 1, '2015-12-21 23:08:12', 0, 1, 1, '1', 0, '', 'D');
INSERT INTO `ordersPaid` VALUES(786, 'Indoor', 619, 1, 'Rice & test1', '82', 1, '2015-12-22 01:59:57', 0, 1, 1, '1', 0, '', 'D');
INSERT INTO `ordersPaid` VALUES(787, 'Indoor', 619, 43, 'Mac Salad &', '83', 1, '2015-12-22 01:59:57', 0, 1, 1, '1', 0, '', 'D');
INSERT INTO `ordersPaid` VALUES(788, 'Indoor', 620, 34, 'Rice &', '82', 1, '2015-12-22 18:51:15', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(789, 'Indoor', 621, 34, 'Rice &', '82', 1, '2015-12-22 19:01:17', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(790, 'Indoor', 621, 36, 'Rice &', '82', 1, '2015-12-22 19:01:17', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(791, 'Indoor', 622, 36, 'Rice & Mac Salad & fish fry', '82,83', 1, '2015-12-22 19:08:45', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(792, 'Indoor', 623, 4, 'Rice &', '82', 1, '2015-12-22 19:19:44', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(793, 'Indoor', 624, 1, 'Rice & Mac Salad & fish fry', '82,83', 1, '2015-12-22 19:21:42', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(794, 'Indoor', 624, 1, 'Rice &', '82', 1, '2015-12-22 19:21:42', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(795, 'Indoor', 624, 4, 'Rice & Mac Salad &', '82,83', 1, '2015-12-22 19:21:42', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(796, 'Indoor', 625, 36, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-23 11:21:31', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(797, 'Indoor', 626, 36, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-23 11:53:54', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(798, 'Indoor', 626, 1, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-23 11:53:54', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(799, 'Indoor', 627, 36, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-23 11:56:35', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(800, 'Indoor', 627, 1, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-23 11:56:35', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(801, 'Indoor', 627, 34, 'Rice & Mac Salad & 123', '82,83', 1, '2015-12-23 11:56:35', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(802, 'Indoor', 628, 3, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-23 12:15:18', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(803, 'Indoor', 629, 35, 'Rice & Coleslaw &', '82,69', 1, '2015-12-23 12:17:16', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(804, 'Indoor', 630, 37, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-23 12:23:34', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(805, 'Indoor', 631, 37, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-23 12:26:19', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(806, 'Indoor', 631, 38, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-23 12:26:19', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(807, 'Indoor', 632, 37, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-23 12:39:11', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(808, 'Indoor', 632, 38, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-23 12:39:11', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(809, 'Indoor', 632, 38, 'Rice & Mac Salad &', '82,83', 1, '2015-12-23 12:39:11', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(810, 'Indoor', 633, 37, 'Rice &', '82', 1, '2015-12-24 12:48:14', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(811, 'Indoor', 634, 3, 'Mac Salad &', '83', 1, '2015-12-24 12:54:54', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(812, 'Indoor', 635, 3, 'Mac Salad &', '83', 1, '2015-12-24 12:57:07', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(813, 'Indoor', 635, 2, 'Coleslaw &', '69', 1, '2015-12-24 12:57:07', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(814, 'Indoor', 636, 3, 'Mac Salad &', '83', 1, '2015-12-24 13:07:09', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(815, 'Indoor', 636, 2, 'Coleslaw &', '69', 1, '2015-12-24 13:07:09', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(816, 'Indoor', 637, 1, 'Coleslaw &', '69', 1, '2015-12-24 13:08:35', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(817, 'Indoor', 638, 39, '', '', 1, '2015-12-24 13:14:13', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(818, 'Indoor', 639, 3, 'Coleslaw &', '69', 1, '2015-12-24 13:15:08', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(819, 'Indoor', 640, 46, '', '', 1, '2015-12-24 13:16:46', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(820, 'Indoor', 641, 37, 'Rice & test', '82', 1, '2015-12-24 13:19:54', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(821, 'Indoor', 642, 39, '', '', 1, '2015-12-24 13:33:20', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(822, 'Indoor', 643, 1, 'Rice & Mac Salad &', '82,83', 1, '2015-12-24 13:34:35', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(823, 'Indoor', 644, 1, 'Coleslaw &', '69', 1, '2015-12-27 23:08:57', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(824, 'Indoor', 645, 65, 'rice', '', 1, '2015-12-27 23:15:21', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(825, 'Indoor', 646, 65, 'rice', '', 1, '2015-12-27 23:15:45', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(826, 'Indoor', 647, 65, 'rice', '', 1, '2015-12-27 23:16:36', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(827, 'Indoor', 648, 65, 'rice', '', 1, '2015-12-27 23:18:06', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(828, 'Indoor', 649, 3, 'Mac Salad &', '83', 1, '2015-12-27 23:20:15', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(829, 'Indoor', 650, 4, 'Mac Salad & Coleslaw & test', '83,69', 1, '2015-12-27 23:25:01', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(830, 'Indoor', 650, 38, 'Mac Salad & Coleslaw &', '83,69', 1, '2015-12-27 23:25:01', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(831, 'Indoor', 651, 1, 'Coleslaw &', '69', 1, '2015-12-27 23:25:46', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(832, 'Indoor', 652, 51, 'test', '', 1, '2015-12-31 15:22:24', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(833, 'Indoor', 653, 51, 'test', '', 1, '2015-12-31 15:22:58', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(834, 'Indoor', 654, 51, 'test', '', 1, '2015-12-31 15:27:44', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(835, 'Indoor', 655, 51, 'test', '', 1, '2015-12-31 15:30:20', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(836, 'Indoor', 656, 51, 'test', '', 1, '2015-12-31 15:30:58', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(837, 'Indoor', 657, 1, 'Rice &', '82', 1, '2016-01-02 05:38:12', 0, 1, 1, '1', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(838, 'test', 658, 100, 'Coke & test4', '84', 1, '2016-01-02 08:26:37', 0, 1, 1, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(839, 'test', 659, 7, 'Mac Salad & test4', '83', 1, '2016-01-06 05:22:38', 0, 1, 0, '', 0, '', 'C');
INSERT INTO `ordersPaid` VALUES(840, 'Indoor', 660, 35, 'Rice & Mac Salad &', '82,83', 1, '2016-01-06 05:34:43', 0, 1, 1, '1', 0, '', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(200) NOT NULL,
  `invoicenum` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=181 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` VALUES(1, '123', '20131126140435', '2013-11-26 01:35:01');
INSERT INTO `payments` VALUES(2, '123', '20131126141148', '2013-11-26 01:42:22');
INSERT INTO `payments` VALUES(3, '123', '20131126141421', '2013-11-26 01:44:32');
INSERT INTO `payments` VALUES(4, '123', '20131126143447', '2013-11-26 02:04:52');
INSERT INTO `payments` VALUES(5, '123', '20131126144455', '2013-11-26 02:15:05');
INSERT INTO `payments` VALUES(6, '18085541582', '20131126154627', '2013-11-26 03:18:32');
INSERT INTO `payments` VALUES(7, '18085541582', '20131203023808', '2013-12-02 14:12:16');
INSERT INTO `payments` VALUES(8, '18085541582', '20131203105310', '2013-12-02 22:25:02');
INSERT INTO `payments` VALUES(9, '123', '20131207063448', '2013-12-06 18:05:19');
INSERT INTO `payments` VALUES(10, '18085541582', '20131210072608', '2013-12-09 19:00:18');
INSERT INTO `payments` VALUES(11, '18085541582', '20131210073541', '2013-12-09 19:06:58');
INSERT INTO `payments` VALUES(12, '18085541582', '20140123043856', '2014-01-22 16:13:59');
INSERT INTO `payments` VALUES(13, '18085541582', '20140124203346', '2014-01-24 08:05:47');
INSERT INTO `payments` VALUES(14, '18085541582', '20140124204358', '2014-01-24 08:15:18');
INSERT INTO `payments` VALUES(15, '18085541582', '20140124211023', '2014-01-24 08:42:47');
INSERT INTO `payments` VALUES(16, '18085541582', '20140129075156', '2014-01-28 19:23:51');
INSERT INTO `payments` VALUES(17, '18085541582', '20140129080142', '2014-01-28 19:33:04');
INSERT INTO `payments` VALUES(18, '18085541582', '20140130044419', '2014-01-29 16:16:25');
INSERT INTO `payments` VALUES(19, '18085541582', '32', '2014-02-12 02:57:32');
INSERT INTO `payments` VALUES(20, '18085541582', '35', '2014-02-12 22:37:18');
INSERT INTO `payments` VALUES(21, '18085541582', '39', '2014-02-13 19:52:20');
INSERT INTO `payments` VALUES(22, '18085541582', '45', '2014-02-14 09:02:08');
INSERT INTO `payments` VALUES(23, '077777', '80', '2014-10-29 17:58:37');
INSERT INTO `payments` VALUES(24, '077777', '80', '2014-10-29 18:01:54');
INSERT INTO `payments` VALUES(25, '077777', '80', '2014-10-29 18:07:13');
INSERT INTO `payments` VALUES(26, '077777', '80', '2014-10-29 18:13:01');
INSERT INTO `payments` VALUES(27, '077777', '80', '2014-10-29 18:25:40');
INSERT INTO `payments` VALUES(28, '123456789', '81', '2014-10-29 19:16:51');
INSERT INTO `payments` VALUES(29, '1112223333', '81', '2014-10-29 22:27:22');
INSERT INTO `payments` VALUES(30, '07777777', '81', '2014-10-30 12:15:35');
INSERT INTO `payments` VALUES(31, '07777777', '81', '2014-10-30 12:17:15');
INSERT INTO `payments` VALUES(32, '123123123', '82', '2014-10-30 18:40:02');
INSERT INTO `payments` VALUES(33, '123123123', '82', '2014-10-30 18:53:04');
INSERT INTO `payments` VALUES(34, '123123123', '83', '2014-10-30 21:50:31');
INSERT INTO `payments` VALUES(35, '123123123', '83', '2014-10-30 22:03:21');
INSERT INTO `payments` VALUES(36, '123123123', '84', '2014-10-30 22:15:36');
INSERT INTO `payments` VALUES(37, '123123123', '85', '2014-10-30 22:20:33');
INSERT INTO `payments` VALUES(38, '099999', '86', '2014-10-31 00:16:50');
INSERT INTO `payments` VALUES(39, '099999', '86', '2014-10-31 00:20:01');
INSERT INTO `payments` VALUES(40, '123123123', '87', '2014-10-31 00:38:08');
INSERT INTO `payments` VALUES(41, '9898', '87', '2014-10-31 00:46:49');
INSERT INTO `payments` VALUES(42, '9898', '87', '2014-10-31 00:53:58');
INSERT INTO `payments` VALUES(43, '123123123', '88', '2014-11-01 05:34:55');
INSERT INTO `payments` VALUES(44, '', '88', '2014-11-01 05:51:44');
INSERT INTO `payments` VALUES(45, '', '89', '2014-11-01 06:18:34');
INSERT INTO `payments` VALUES(46, '0771111111', '90', '2014-11-02 12:27:59');
INSERT INTO `payments` VALUES(47, '0711111111', '90', '2014-11-02 12:54:38');
INSERT INTO `payments` VALUES(48, '123123123', '91', '2014-11-03 23:21:53');
INSERT INTO `payments` VALUES(49, '6025500383', '92', '2014-11-03 23:57:26');
INSERT INTO `payments` VALUES(50, '', '94', '2014-11-10 05:01:18');
INSERT INTO `payments` VALUES(51, '', '94', '2014-11-10 05:47:09');
INSERT INTO `payments` VALUES(52, '858-688-3204', '95', '2014-11-13 22:15:23');
INSERT INTO `payments` VALUES(53, '123123123', '96', '2014-11-15 19:39:01');
INSERT INTO `payments` VALUES(54, '6023502331', '97', '2014-11-17 04:44:23');
INSERT INTO `payments` VALUES(55, '077777777', '98', '2014-11-17 22:21:16');
INSERT INTO `payments` VALUES(56, '123123123', '99', '2014-11-18 19:03:11');
INSERT INTO `payments` VALUES(57, '5417606367', '100', '2014-11-18 23:20:14');
INSERT INTO `payments` VALUES(58, '7605009741', '101', '2014-11-20 22:15:54');
INSERT INTO `payments` VALUES(59, '3154863801', '101', '2014-11-20 22:17:25');
INSERT INTO `payments` VALUES(60, '858-688-3204', '103', '2014-11-27 22:21:33');
INSERT INTO `payments` VALUES(61, '6028459798', '104', '2014-11-30 23:52:47');
INSERT INTO `payments` VALUES(62, '88888888', '88888888', '2014-12-09 18:58:38');
INSERT INTO `payments` VALUES(63, '88888888', '88888888', '2014-12-09 18:58:46');
INSERT INTO `payments` VALUES(64, '88888888', '88888888', '2014-12-09 18:58:51');
INSERT INTO `payments` VALUES(65, '88888888', '88888888', '2014-12-09 18:58:52');
INSERT INTO `payments` VALUES(66, '88888888', '88888888', '2014-12-09 18:58:55');
INSERT INTO `payments` VALUES(67, '88888888', '88888888', '2014-12-09 18:58:58');
INSERT INTO `payments` VALUES(68, '88888888', '88888888', '2014-12-09 18:58:58');
INSERT INTO `payments` VALUES(69, '88888888', '88888888', '2014-12-09 18:58:58');
INSERT INTO `payments` VALUES(70, '88888888', '88888888', '2014-12-09 18:59:24');
INSERT INTO `payments` VALUES(71, '88888888', '88888888', '2014-12-09 18:59:32');
INSERT INTO `payments` VALUES(72, '88888888', '88888888', '2014-12-09 19:01:46');
INSERT INTO `payments` VALUES(73, '88888888', '88888888', '2014-12-09 19:03:06');
INSERT INTO `payments` VALUES(74, '88888888', '88888888', '2014-12-09 19:03:13');
INSERT INTO `payments` VALUES(75, '88888888', '88888888', '2014-12-09 19:05:40');
INSERT INTO `payments` VALUES(76, '88888888', '88888888', '2014-12-09 19:07:31');
INSERT INTO `payments` VALUES(77, '88888888', '88888888', '2014-12-09 19:08:08');
INSERT INTO `payments` VALUES(78, '88888888', '88888888', '2014-12-09 19:08:30');
INSERT INTO `payments` VALUES(79, '88888888', '88888888', '2014-12-09 19:09:13');
INSERT INTO `payments` VALUES(80, '88888888', '88888888', '2014-12-09 19:11:24');
INSERT INTO `payments` VALUES(81, '88888888', '88888888', '2014-12-09 19:12:38');
INSERT INTO `payments` VALUES(82, '88888888', '88888888', '2014-12-09 19:14:01');
INSERT INTO `payments` VALUES(83, '88888888', '88888888', '2014-12-09 19:16:44');
INSERT INTO `payments` VALUES(84, '88888888', '88888888', '2014-12-09 19:23:17');
INSERT INTO `payments` VALUES(85, '88888888', '88888888', '2014-12-09 19:28:49');
INSERT INTO `payments` VALUES(86, '88888888', '88888888', '2014-12-09 19:37:29');
INSERT INTO `payments` VALUES(87, '88888888', '88888888', '2014-12-09 19:38:33');
INSERT INTO `payments` VALUES(88, '123123123', '123123123', '2014-12-09 19:53:28');
INSERT INTO `payments` VALUES(89, '123123123', '123123123', '2014-12-09 19:55:09');
INSERT INTO `payments` VALUES(90, '858-688-3204', '160', '2014-12-11 22:13:47');
INSERT INTO `payments` VALUES(91, '369369369', '369369369', '2014-12-12 15:10:28');
INSERT INTO `payments` VALUES(92, '123', '123', '2014-12-12 19:21:27');
INSERT INTO `payments` VALUES(93, '123', '123', '2014-12-12 21:38:06');
INSERT INTO `payments` VALUES(94, '123', '123', '2014-12-12 21:39:39');
INSERT INTO `payments` VALUES(95, 'lisa', 'lisa', '2014-12-12 23:39:25');
INSERT INTO `payments` VALUES(96, '18085541582', '905409', '2014-12-14 16:58:47');
INSERT INTO `payments` VALUES(97, '18085541582', '994342', '2014-12-14 17:06:43');
INSERT INTO `payments` VALUES(98, '123', '872819', '2014-12-15 21:53:38');
INSERT INTO `payments` VALUES(99, '123', '459594', '2014-12-15 21:55:30');
INSERT INTO `payments` VALUES(100, '7605009741', '191', '2014-12-18 22:21:29');
INSERT INTO `payments` VALUES(101, '', '853883', '2014-12-22 18:09:46');
INSERT INTO `payments` VALUES(102, '147741', '684454', '2014-12-22 18:13:24');
INSERT INTO `payments` VALUES(103, 'Lisa', '707046', '2014-12-23 18:35:41');
INSERT INTO `payments` VALUES(104, '223', '220497', '2014-12-23 18:38:39');
INSERT INTO `payments` VALUES(105, '123123123', '980445', '2014-12-23 18:39:40');
INSERT INTO `payments` VALUES(106, '5441999lisa', '237019', '2014-12-23 19:57:25');
INSERT INTO `payments` VALUES(107, 'Lisa', '229196', '2014-12-23 20:05:16');
INSERT INTO `payments` VALUES(108, '602350 2331', '217', '2014-12-29 00:11:13');
INSERT INTO `payments` VALUES(109, 'eric', '217', '2014-12-29 23:02:49');
INSERT INTO `payments` VALUES(110, 'eric', '218', '2014-12-29 23:07:18');
INSERT INTO `payments` VALUES(111, 'eric', '219', '2014-12-29 23:32:38');
INSERT INTO `payments` VALUES(112, 'erictest', '220', '2014-12-30 19:42:01');
INSERT INTO `payments` VALUES(113, 'erictest', '221', '2014-12-30 19:43:40');
INSERT INTO `payments` VALUES(114, '6154781191', '222', '2015-01-07 00:06:51');
INSERT INTO `payments` VALUES(115, 'test', '222', '2015-01-07 09:40:33');
INSERT INTO `payments` VALUES(116, '602-564-7770', '224', '2015-01-13 22:37:09');
INSERT INTO `payments` VALUES(117, '602-564-7770', '225', '2015-01-13 22:38:09');
INSERT INTO `payments` VALUES(118, '6236951409', '226', '2015-01-21 23:09:12');
INSERT INTO `payments` VALUES(119, 'lisa', '369038', '2015-02-11 18:56:36');
INSERT INTO `payments` VALUES(120, '6235058106', '240', '2015-02-12 23:01:48');
INSERT INTO `payments` VALUES(121, 'corey', '103381', '2015-02-13 21:37:45');
INSERT INTO `payments` VALUES(122, 'testcustomer', '213219', '2015-02-16 22:16:50');
INSERT INTO `payments` VALUES(123, 'undefined', '250', '2015-02-17 22:52:46');
INSERT INTO `payments` VALUES(124, '434434', '969370', '2015-02-19 18:52:12');
INSERT INTO `payments` VALUES(125, '434434', '488213', '2015-02-19 19:11:25');
INSERT INTO `payments` VALUES(126, '434434', '846781', '2015-02-19 19:22:00');
INSERT INTO `payments` VALUES(127, '434434', '335937', '2015-02-19 19:49:03');
INSERT INTO `payments` VALUES(128, '434434', '222517', '2015-02-19 19:49:26');
INSERT INTO `payments` VALUES(129, '434434', '259483', '2015-02-19 19:50:01');
INSERT INTO `payments` VALUES(130, '434434', '310274', '2015-02-19 19:53:53');
INSERT INTO `payments` VALUES(131, '434434', '168825', '2015-02-19 20:12:47');
INSERT INTO `payments` VALUES(132, '434434', '785144', '2015-02-19 20:27:11');
INSERT INTO `payments` VALUES(133, '434434', '928342', '2015-02-19 20:51:04');
INSERT INTO `payments` VALUES(134, '434434', '321318', '2015-02-19 20:54:21');
INSERT INTO `payments` VALUES(135, '434434', '902178', '2015-02-19 20:57:40');
INSERT INTO `payments` VALUES(136, '434434', '550358', '2015-02-19 21:08:46');
INSERT INTO `payments` VALUES(137, '434434', '282815', '2015-02-19 21:15:38');
INSERT INTO `payments` VALUES(138, '434434', '133709', '2015-02-19 21:18:20');
INSERT INTO `payments` VALUES(139, '434434', '404165', '2015-02-19 21:20:45');
INSERT INTO `payments` VALUES(140, '434434', '588552', '2015-02-19 21:23:10');
INSERT INTO `payments` VALUES(141, '434434', '369334', '2015-02-19 21:29:54');
INSERT INTO `payments` VALUES(142, 'test', '927298', '2015-02-19 22:48:34');
INSERT INTO `payments` VALUES(143, '1480 238 0233', '277', '2015-02-23 22:57:54');
INSERT INTO `payments` VALUES(144, '6028039802', '277', '2015-02-23 22:58:51');
INSERT INTO `payments` VALUES(145, '6232029463', '278', '2015-02-26 21:33:13');
INSERT INTO `payments` VALUES(146, '6023186811', '279', '2015-02-26 21:37:01');
INSERT INTO `payments` VALUES(147, '623-695-1409', '281', '2015-04-15 23:16:44');
INSERT INTO `payments` VALUES(148, '1623 565 4876', '282', '2015-07-13 22:53:00');
INSERT INTO `payments` VALUES(149, '6238691019', '284', '2015-08-11 22:58:55');
INSERT INTO `payments` VALUES(150, '6024466320', '285', '2015-08-17 05:39:03');
INSERT INTO `payments` VALUES(151, '623-878-3553', '286', '2015-08-27 23:00:10');
INSERT INTO `payments` VALUES(152, '480-650-6325', '287', '2015-09-02 04:27:22');
INSERT INTO `payments` VALUES(153, '7605009741', '288', '2015-09-17 22:01:15');
INSERT INTO `payments` VALUES(154, '623-878-3553', '290', '2015-09-27 22:52:18');
INSERT INTO `payments` VALUES(155, '480-845-3319', '291', '2015-10-07 23:04:17');
INSERT INTO `payments` VALUES(156, 'test', '292', '2015-10-08 18:46:22');
INSERT INTO `payments` VALUES(157, 'test2', '293', '2015-10-08 19:26:32');
INSERT INTO `payments` VALUES(158, 'test4', '294', '2015-10-08 20:34:49');
INSERT INTO `payments` VALUES(159, 'test', '296', '2015-10-15 14:57:22');
INSERT INTO `payments` VALUES(160, 'testing', '297', '2015-10-15 15:22:20');
INSERT INTO `payments` VALUES(161, 'testing', '298', '2015-10-15 16:36:17');
INSERT INTO `payments` VALUES(162, 'testing', '299', '2015-10-16 16:55:39');
INSERT INTO `payments` VALUES(163, '8105136914', '300', '2015-10-19 23:18:56');
INSERT INTO `payments` VALUES(164, '6024601223', '301', '2015-11-03 04:50:34');
INSERT INTO `payments` VALUES(165, 'test', '1111', '2015-11-06 11:08:49');
INSERT INTO `payments` VALUES(166, 'test', '1111', '2015-11-06 11:36:39');
INSERT INTO `payments` VALUES(167, 'test', '302', '2015-11-06 11:46:32');
INSERT INTO `payments` VALUES(168, 'test', '302', '2015-11-09 13:05:48');
INSERT INTO `payments` VALUES(169, '6026863680', '501', '2015-11-17 00:11:13');
INSERT INTO `payments` VALUES(170, '17024438201', '501', '2015-12-09 23:01:59');
INSERT INTO `payments` VALUES(171, '', '658', '2016-01-02 08:21:52');
INSERT INTO `payments` VALUES(172, '', '658', '2016-01-02 08:23:39');
INSERT INTO `payments` VALUES(173, 'test', '658', '2016-01-02 08:26:37');
INSERT INTO `payments` VALUES(174, 'test', '659', '2016-01-02 08:30:04');
INSERT INTO `payments` VALUES(175, 'test\\', '659', '2016-01-05 12:36:31');
INSERT INTO `payments` VALUES(176, 'test\\', '659', '2016-01-05 12:37:28');
INSERT INTO `payments` VALUES(177, 'test\\''', '659', '2016-01-05 12:39:06');
INSERT INTO `payments` VALUES(178, '', '659', '2016-01-06 05:10:08');
INSERT INTO `payments` VALUES(179, '', '659', '2016-01-06 05:16:31');
INSERT INTO `payments` VALUES(180, 'test', '659', '2016-01-06 05:22:38');
