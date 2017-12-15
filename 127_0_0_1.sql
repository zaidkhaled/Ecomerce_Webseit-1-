-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2017 at 04:48 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Table structure for table `buy_operations`
--

CREATE TABLE `buy_operations` (
  `ID` int(11) NOT NULL,
  `Seller_ID` int(11) NOT NULL,
  `Buyer_ID` int(11) NOT NULL,
  `nums_item` int(20) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Time_Of_Purchase` date NOT NULL,
  `Total_Amount` varchar(255) NOT NULL,
  `Total_Price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_operations`
--

INSERT INTO `buy_operations` (`ID`, `Seller_ID`, `Buyer_ID`, `nums_item`, `Item_ID`, `Time_Of_Purchase`, `Total_Amount`, `Total_Price`) VALUES
(2, 224, 223, 2, 9, '2017-12-04', '200', '400'),
(3, 227, 90, 2, 11, '2017-12-05', '44', '88'),
(4, 224, 223, 1, 8, '2017-12-12', '540', '540'),
(5, 224, 223, 1, 9, '2017-12-12', '200', '200');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Parent` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Description` text CHARACTER SET utf8 NOT NULL,
  `Ordering` int(11) NOT NULL,
  `Visbility` tinyint(4) DEFAULT NULL,
  `Allow_Comment` tinyint(4) DEFAULT NULL,
  `Allow_Ads` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Parent`, `Name`, `Description`, `Ordering`, `Visbility`, `Allow_Comment`, `Allow_Ads`) VALUES
(31, 0, 'Computer', 'Hardware & software', 456456, 1, 0, 1),
(32, 0, 'Handys', 'Android uad Apple ', 123, 1, 1, 0),
(33, 0, 'Bekleidung', 'for all people', 33, 1, 0, 1),
(34, 0, 'Autos', 'any type', 0, 1, 0, 0),
(35, 0, 'Bücher', 'Bücher zum lesen', 65, 1, 0, 1),
(36, 0, 'Hausgemacht', 'just for hand made ', 11, 0, 1, 1),
(37, 35, 'Kriminalroman', 'für erwachsener', 22, 1, 1, 1),
(38, 35, 'Liebesroman ', 'für liebe', 33, 1, 1, 1),
(40, 35, 'Kinderbücher ', 'bücher ', 44, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `C_ID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Status` tinyint(4) DEFAULT NULL,
  `Comment_Data` datetime NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`C_ID`, `Comment`, `Status`, `Comment_Data`, `Item_ID`, `Member_ID`) VALUES
(7, 'wie lange dauert die lieferung? ... ', 1, '2017-12-04 02:59:38', 11, 224),
(8, 'das ist aber ein gute website ', 1, '2017-12-05 02:43:56', 12, 227),
(9, 'man sollte das schnell kaufen ', 1, '2017-12-05 02:45:09', 12, 227),
(10, 'ist es immer noch verfügbar ?', 1, '2017-12-08 04:58:07', 13, 227);

-- --------------------------------------------------------

--
-- Table structure for table `debit_deposit_operations`
--

CREATE TABLE `debit_deposit_operations` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `Amount_Deposited` int(20) NOT NULL,
  `Withdrawal` int(20) DEFAULT NULL,
  `Currency_Type` char(9) DEFAULT NULL,
  `Data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `debit_deposit_operations`
--

INSERT INTO `debit_deposit_operations` (`ID`, `userID`, `Amount_Deposited`, `Withdrawal`, `Currency_Type`, `Data`) VALUES
(13, 223, 100, NULL, NULL, '2017-12-04'),
(15, 223, 100, NULL, NULL, '2017-12-04'),
(21, 227, 100, NULL, NULL, '2017-12-04'),
(25, 227, 100, NULL, NULL, '2017-12-04'),
(27, 90, 70, NULL, NULL, '2017-12-12'),
(28, 227, 40, NULL, NULL, '2017-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Main_Foto` text NOT NULL,
  `Fotos` text NOT NULL,
  `nums_item` int(20) DEFAULT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Data` date NOT NULL,
  `Made_In` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `approve` tinyint(4) DEFAULT NULL,
  `Cate_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `tags` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Name`, `Main_Foto`, `Fotos`, `nums_item`, `Description`, `Price`, `Add_Data`, `Made_In`, `Status`, `Rating`, `approve`, `Cate_ID`, `Member_ID`, `tags`) VALUES
(1, 'Bmv x6', '9588_0334043690001.jpg', 'a:2:{i:0;s:23:\"40556_0334043690001.jpg\";i:1;s:55:\"93307_cae87540-05c8-4be7-98a8-fa8ae54a926a-Original.jpg\";}', 1, 'schwarz\r\nGeschwindigkeit von 340 km\r\nBequeme Sitzplätze\r\nHergestellt in Deutschland im Jahr 2008', '4000', '2017-12-03', 'Deuschland', 'like-new', 0, 1, 34, 227, 'schnell,deutschland'),
(2, 'Mütze', '28648_0897b6b66d8529aaf55354db1c210ffa.jpg', 'a:4:{i:0;s:42:\"82738_0897b6b66d8529aaf55354db1c210ffa.jpg\";i:1;s:42:\"87141_ab196793260dbbca208057a5d4a540c3.jpg\";i:2;s:16:\"44779_images.jpg\";i:3;s:85:\"62866_product-mediumsquare-47317-8626-1347321645-ceb4cdf484afbcf74c87776b082b507a.jpg\";}', 40, 'shcöne Mütze und die es gut für niedrige Temperaturen', '3', '2017-12-03', 'chine ', 'new', 0, 1, 36, 227, 'billig'),
(3, 'Kaffeetasse ', '76494_chocolate-cup-2.jpg', 'a:3:{i:0;s:25:\"76917_chocolate-cup-2.jpg\";i:1;s:26:\"84170_original_handmad.jpg\";i:2;s:46:\"65361_original_handmade-tea-cup-and-saucer.jpg\";}', -1, 'schöne Tasse', '3', '2017-12-03', 'poland', 'like-new', 0, 1, 36, 227, 'schön'),
(4, 'Fernsehen', '24889_de_UE40B6000VPXZG_001_Front.jpg', 'a:3:{i:0;s:26:\"38257_813ca35255112a72.jpg\";i:1;s:37:\"66253_de_UE40B6000VPXZG_001_Front.jpg\";i:2;s:36:\"9858_de_UE46B7090WPXZG_001_Front.jpg\";}', 5, 'full hd samsung Bildschirm', '400', '2017-12-03', 'usa', 'new', 0, 1, 31, 227, 'schön,gut,garantie'),
(8, 'Iphone s7', '1087_iPhone-6-Gold-16-Gb-661675e4.jpg', 'a:3:{i:0;s:18:\"40065_imaggges.jpg\";i:1;s:37:\"4377_iPhone-6-Gold-16-Gb-661675e4.jpg\";i:2;s:42:\"69836_iPhone-6S-Rosegold-16GB-3dc3275c.jpg\";}', -539, '', '540', '2017-12-03', 'chine', 'used', 0, 1, 32, 224, 'schön,gut,garantie'),
(9, 'lenovo T540', '87537_notebook-lenovo-thinkpad-w510-laptop-gebraucht-03.jpg', 'a:5:{i:0;s:18:\"23482_img_1399.jpg\";i:1;s:34:\"59037_Lenovo-X230-gebraucht_b2.jpg\";i:2;s:63:\"16140_notebook-lenovo-thinkpad-t520ohne-laptop-gebraucht-01.jpg\";i:3;s:59:\"58989_notebook-lenovo-thinkpad-w510-laptop-gebraucht-03.jpg\";i:4;s:59:\"62341_notebook-lenovo-thinkpad-w520-laptop-gebraucht-03.jpg\";}', -196, 'gut und halt lange ', '200', '2017-12-03', 'Deuschland', 'like-new', 0, 1, 31, 224, 'gut,haltlange'),
(10, 'kühlschrank', '31148_st,small,215x235-pad,210x230,f8f8f8.lite-1u2.jpg', 'a:5:{i:0;s:28:\"42952_refrigerator-25739.jpg\";i:1;s:38:\"36818_Refrigerator-Drawing-239x300.jpg\";i:2;s:54:\"93754_st,small,215x235-pad,210x230,f8f8f8.lite-1u2.jpg\";i:3;s:15:\"94547_thumb.jpg\";i:4;s:45:\"8926_Whirlpool-WRN28RWG6-Air-Flow-Diagram.jpg\";}', 1, 'weisse kühlschrank und halt lange', '500', '2017-12-03', 'Deuschland', 'like-new', 0, 1, 31, 224, 'weiße,gu,haltlänge'),
(11, 'ein Bett', '1396_schrankbett-140cm-horizontal-wenge-smartbett_2.jpg', 'a:3:{i:0;s:16:\"94579_images.jpg\";i:1;s:55:\"7889_schrankbett-140cm-horizontal-wenge-smartbett_2.jpg\";i:2;s:67:\"23643_Toll-Schrankbetten-160X200-Bett-160x200-Galerien-1024x377.jpg\";}', -86, 'Flexibles Bett', '44', '2017-12-04', 'usa', 'new', 0, 1, 36, 224, ''),
(12, 'Herd', '27575_images.jpg', 'a:2:{i:0;s:27:\"54302_Cucina-A-GRILJERA.jpg\";i:1;s:51:\"33673_ikea_seo_vitvaror_spisar_PH128649_520x250.jpg\";}', 1, 'gute herd', '400', '2017-12-04', 'Deuschland', 'used', 0, 1, 36, 223, 'gut,haltlänge'),
(13, 'Iphone s6', '53527_imaggges.jpg', 'a:3:{i:0;s:18:\"79627_imaggges.jpg\";i:1;s:38:\"52978_iPhone-6-Gold-16-Gb-661675e4.jpg\";i:2;s:42:\"36208_iPhone-6S-Rosegold-16GB-3dc3275c.jpg\";}', 444, 'gute handy', '444', '2017-12-08', 'chine', 'used', 0, 1, 32, 223, 'gut,haltlange'),
(15, 'bmw x5', '1044_cae87540-05c8-4be7-98a8-fa8ae54a926a-Original.jpg', 'a:2:{i:0;s:23:\"36556_0334043690001.jpg\";i:1;s:55:\"93593_cae87540-05c8-4be7-98a8-fa8ae54a926a-Original.jpg\";}', 5000, 'gutes Auto', '5000', '2017-12-08', 'Deuschland', 'used', 0, 1, 32, 223, ''),
(16, 'Bett 2018', '25747_images.jpg', 'a:3:{i:0;s:15:\"8601_images.jpg\";i:1;s:56:\"44370_schrankbett-140cm-horizontal-wenge-smartbett_2.jpg\";i:2;s:67:\"34964_Toll-Schrankbetten-160X200-Bett-160x200-Galerien-1024x377.jpg\";}', 8000, 'gute Bett', '8000', '2017-12-08', 'Deuschland', 'old', 0, 1, 34, 224, 'schön,gut,garantie');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `last_activity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`ID`, `user_ID`, `last_activity`) VALUES
(1, 223, '2017-12-12 01:30:50'),
(2, 224, '2017-12-08 01:42:14'),
(3, 225, '2017-11-29 13:50:12'),
(4, 226, '2017-12-01 11:37:25'),
(5, 90, '2017-12-13 11:30:26'),
(6, 227, '2017-12-12 01:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `nontifications`
--

CREATE TABLE `nontifications` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `Actor_ID` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `activity_type` varchar(20) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `is_seen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nontifications`
--

INSERT INTO `nontifications` (`ID`, `user_ID`, `Actor_ID`, `source_id`, `activity_type`, `date`, `is_seen`) VALUES
(1, 227, 224, 4, 'comment', '2017-12-03', 1),
(2, 227, 224, 4, 'comment', '2017-12-03', 1),
(3, 227, 224, 4, 'comment', '2017-12-03', 1),
(4, 227, 224, 4, 'comment', '2017-12-03', 1),
(5, 227, 224, 4, 'comment', '2017-12-03', 1),
(6, 227, 224, 3, 'Sold', '2017-12-03', 1),
(7, 224, 223, 9, 'comment', '2017-12-04', 1),
(8, 224, 223, 9, 'Sold', '2017-12-04', 1),
(9, 227, 224, 11, 'comment', '2017-12-04', 1),
(10, 227, 90, 11, 'Sold', '2017-12-05', 1),
(11, 223, 227, 12, 'comment', '2017-12-05', 1),
(12, 223, 227, 12, 'comment', '2017-12-05', 1),
(13, 223, 227, 13, 'comment', '2017-12-08', 0),
(14, 223, 227, 13, 'comment', '2017-12-08', 0),
(15, 223, 227, 13, 'comment', '2017-12-08', 0),
(16, 224, 90, 16, 'comment', '2017-12-08', 0),
(17, 224, 223, 8, 'Sold', '2017-12-12', 0),
(18, 224, 223, 9, 'Sold', '2017-12-12', 0),
(19, 227, 223, 3, 'Sold', '2017-12-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL COMMENT 'To identify user',
  `username` varchar(255) NOT NULL COMMENT 'user to login',
  `Foto` varchar(255) NOT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL COMMENT 'password to login',
  `Depositor` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0' COMMENT 'identify user gruop',
  `Truststatus` int(11) NOT NULL DEFAULT '0' COMMENT 'Seller Rank',
  `regStatus` int(11) NOT NULL DEFAULT '0' COMMENT 'User Approval',
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `Foto`, `Amount`, `password`, `Depositor`, `Email`, `fullName`, `GroupID`, `Truststatus`, `regStatus`, `data`) VALUES
(90, 'zaid', '33625_Faceless-Man-Avatar.png', '816', '17ba0791499db908433b80f37c5fbc89b870084b', '', 'zaidkaled44@gmail.com', 'zaid kaled', 1, 0, 1, '2017-12-12 01:36:51'),
(223, 'Theresa', '8847_images.jpg', '157', 'fa376e383626491fb6f3b6b5c06b1c208bba702b', '', 'theresa@gmail.com', 'Theresa Wurm', 0, 0, 1, '2017-12-12 01:30:46'),
(224, 'Lukas', '7478_index.png', '1237', 'fa376e383626491fb6f3b6b5c06b1c208bba702b', '', 'Lukas44@mail.com', 'Lukas Müller', 0, 0, 1, '2017-12-12 01:30:27'),
(225, 'Laura', '80492_images.png', '0', 'fa376e383626491fb6f3b6b5c06b1c208bba702b', '', 'laure@mail.com', 'laura Wurm', 0, 0, 1, '2017-12-04 00:33:35'),
(226, 'Maria', '32688_GrammarGirlAvatar.jpg', '0', 'fa376e383626491fb6f3b6b5c06b1c208bba702b', '', 'Maria@mail.com', 'Maria Schnider', 0, 0, 1, '2017-12-04 00:33:34'),
(227, 'ramy', '65014_c5bb5002-6506-42fd-aa5f-08f517f6cbdb.png', '834', 'fa376e383626491fb6f3b6b5c06b1c208bba702b', '', 'ramy@gmail.com', 'rami aiad', 0, 0, 1, '2017-12-12 01:37:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy_operations`
--
ALTER TABLE `buy_operations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Item_ID` (`Item_ID`),
  ADD KEY `Price` (`Total_Amount`),
  ADD KEY `userID_Buyer` (`Buyer_ID`),
  ADD KEY `userID_serller` (`Seller_ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`C_ID`),
  ADD KEY `commen_id` (`Item_ID`),
  ADD KEY `user_id` (`Member_ID`);

--
-- Indexes for table `debit_deposit_operations`
--
ALTER TABLE `debit_deposit_operations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MEMBER_ID` (`userID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `mem_id` (`Member_ID`),
  ADD KEY `Cat_Id` (`Cate_ID`),
  ADD KEY `Price` (`Price`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `online_userID` (`user_ID`);

--
-- Indexes for table `nontifications`
--
ALTER TABLE `nontifications`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_user` (`user_ID`),
  ADD KEY `did_it` (`Actor_ID`),
  ADD KEY `item_id` (`source_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy_operations`
--
ALTER TABLE `buy_operations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `debit_deposit_operations`
--
ALTER TABLE `debit_deposit_operations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nontifications`
--
ALTER TABLE `nontifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To identify user', AUTO_INCREMENT=228;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy_operations`
--
ALTER TABLE `buy_operations`
  ADD CONSTRAINT `Price` FOREIGN KEY (`Total_Amount`) REFERENCES `items` (`Price`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bought_item` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userID_Buyer` FOREIGN KEY (`Buyer_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userID_serller` FOREIGN KEY (`Seller_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `commen_id` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `debit_deposit_operations`
--
ALTER TABLE `debit_deposit_operations`
  ADD CONSTRAINT `MEMBER_ID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `Cat_Id` FOREIGN KEY (`Cate_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mem_id` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_details`
--
ALTER TABLE `login_details`
  ADD CONSTRAINT `online_userID` FOREIGN KEY (`user_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nontifications`
--
ALTER TABLE `nontifications`
  ADD CONSTRAINT `did_it` FOREIGN KEY (`Actor_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`user_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_id` FOREIGN KEY (`source_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
