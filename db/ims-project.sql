-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2023 at 10:02 PM
-- Server version: 5.7.33
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(10) NOT NULL,
  `item_number` bigint(50) NOT NULL,
  `item_name` varchar(300) NOT NULL,
  `item_description` text NOT NULL,
  `item_file` varchar(300) NOT NULL,
  `item_product_category` varchar(300) NOT NULL,
  `item_quantity` int(10) NOT NULL,
  `item_unit_price` double NOT NULL,
  `item_discount` double NOT NULL,
  `item_stock` bigint(50) NOT NULL,
  `item_status` tinyint(1) NOT NULL,
  `item_timestamp` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `logins_view`
-- (See below for the actual view)
--
CREATE TABLE `logins_view` (
`user_id` varchar(50)
,`user_name` varchar(150)
,`user_fullname` varchar(300)
,`user_password` text
,`user_type` varchar(255)
,`user_status` tinyint(1)
,`user_profile` varchar(100)
,`user_loginBefore` tinyint(1)
,`user_timestamp` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `product-categories`
--

CREATE TABLE `product-categories` (
  `pc_id` int(10) NOT NULL,
  `pc_name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product-categories`
--

INSERT INTO `product-categories` (`pc_id`, `pc_name`) VALUES
(1, 'Television & Audio'),
(2, 'Refrigerators & Freezers'),
(3, 'Washing Machines'),
(4, 'Air Conditioners'),
(5, 'Heating & Cooling Appliances'),
(6, 'Home & Kitchen Appliances'),
(7, 'Musical Instruments'),
(8, 'Living Room'),
(9, 'Bedroom'),
(10, 'Kitchen'),
(11, 'Dining Room'),
(12, 'Office'),
(13, 'Outdoor'),
(14, 'Tables & Chairs'),
(15, 'TV & Entertainment Units'),
(16, 'Wardrobes & Cabinets'),
(17, 'Storage Solutions'),
(18, 'Food'),
(19, 'Beverages'),
(20, 'Household & Cleaning Products'),
(21, 'Beauty & Personal Care'),
(22, 'Lighting'),
(23, 'Generators & Power Solutions'),
(24, 'Safety Equipments'),
(25, 'Cables & Wiring'),
(26, 'Water Pumps'),
(27, 'Other Appliances'),
(28, 'Mobiles, Tablets & More'),
(29, 'Computers & Accessories'),
(30, 'Kitchen Essentials'),
(31, 'Home Decor & Furnishing'),
(32, 'Home Frangances'),
(33, 'Household Hardware'),
(34, 'Household Accessories'),
(35, 'Century Plasticware'),
(36, 'Baby Care & Diapers'),
(37, 'Toys & Games'),
(38, 'Kid Products'),
(39, 'Gym & Cardio Equipments'),
(40, 'Sports Wear & Gym Accessories'),
(41, 'Indoor Sports'),
(42, 'Outdoor Sports'),
(43, 'Office'),
(44, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_fullname` varchar(300) NOT NULL,
  `user_dob` varchar(50) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_placeofBirth` varchar(300) NOT NULL,
  `user_mobile` varchar(10) NOT NULL,
  `user_contact` varchar(10) DEFAULT NULL,
  `user_mail` text,
  `user_address_one` text NOT NULL,
  `user_address_two` text,
  `user_type` varchar(255) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '1',
  `user_loginBefore` tinyint(1) NOT NULL DEFAULT '0',
  `user_password` text,
  `user_profile` varchar(100) DEFAULT NULL,
  `user_id_profile` varchar(100) DEFAULT NULL,
  `user_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_fullname`, `user_dob`, `user_gender`, `user_placeofBirth`, `user_mobile`, `user_contact`, `user_mail`, `user_address_one`, `user_address_two`, `user_type`, `user_status`, `user_loginBefore`, `user_password`, `user_profile`, `user_id_profile`, `user_timestamp`) VALUES
('IMS00001-0123', 'wofakouadio', 'BENNETT FRANCIS KOUADIO', '1986-12-02', 'Female', 'ABLEKUMA', '1234567890', '1234567890', 'marytucson@mail.com', 'LOREM IPSUM', 'LOREM IPSUM', 'SUPER-ADMIN', 1, 1, '$2y$10$WWCHxX68jYH.scrFuuap3OKHbwXO3Cwn7yCG0irtUCuMwi6.TcQ1G', NULL, NULL, '2023-01-06 19:12:40'),
('IMS00002-0123', 'bfkouadio629', 'BENNETT FRANCIS', '1986-12-02', 'Female', 'ABLEKUMA', '1234567890', '1234567890', 'marytucson@mail.com', 'LOREM IPSUM', '', 'ADMINISTRATOR', 1, 0, '$2y$10$tyUVkafcHATZyI6Cc.yKPeRs.scPnYe8UrpNPtF.JhRZrD3a5jgHi', 'IMS00002-01231679232079.jpg', 'IMS00002-01231679232932.png', '2023-01-15 22:09:26');

-- --------------------------------------------------------

--
-- Structure for view `logins_view`
--
DROP TABLE IF EXISTS `logins_view`;

CREATE OR REPLACE VIEW `logins_view`  AS SELECT `users`.`user_id` AS `user_id`, `users`.`user_name` AS `user_name`, `users`.`user_fullname` AS `user_fullname`, `users`.`user_password` AS `user_password`, `users`.`user_type` AS `user_type`, `users`.`user_status` AS `user_status`, `users`.`user_profile` AS `user_profile`, `users`.`user_loginBefore` AS `user_loginBefore`, `users`.`user_timestamp` AS `user_timestamp` FROM `users``users`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `product-categories`
--
ALTER TABLE `product-categories`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product-categories`
--
ALTER TABLE `product-categories`
  MODIFY `pc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
