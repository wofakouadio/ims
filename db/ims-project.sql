-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 25, 2023 at 03:33 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

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
,`user_loginBefore` tinyint(1)
,`user_timestamp` timestamp
);

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
('IMS00001-0123', 'wofakouadio', 'Francis Bennett', '04-11-1996', 'Male', 'KUMASI', '0547560720', '0592737301', 'superadmin@ims.com', 'ABLEKUMA', NULL, 'SUPER-ADMIN', 1, 1, '$2y$10$WWCHxX68jYH.scrFuuap3OKHbwXO3Cwn7yCG0irtUCuMwi6.TcQ1G', NULL, NULL, '2023-01-06 19:12:40'),
('IMS00002-0123', 'bfkouadio629', 'bennett francis kouadio', '12-02-1946', 'Female', 'ablekuma', '1234567890', '1234567890', 'marytucson@mail.com', 'lorem ipsum', '', 'ADMIN', 1, 0, NULL, 'profile1673820566IMS00002-0123', 'id1673820566IMS00002-0123', '2023-01-15 22:09:26'),
('IMS00003-0223', 'aboyd593', 'ANNE BOYD', '1974-07-10', 'FEMALE', 'VOLUPTATE UT NIHIL O', '9403330581', '9403330581', 'CYSY@MAILINATOR.COM', '27 WHITE COWLEY BOULEVARD', 'ALIQUID CUPIDITATE V', 'CUSTOMER', 1, 0, NULL, 'user-default-profile.png', 'user-default-id.png', '2023-02-12 17:58:14'),
('IMS00004-0223', 'kporter824', 'KIRSTEN PORTER', '1978-10-13', 'FEMALE', 'CUPIDITATE AUT LAUDA', '8990262708', '8990262708', 'GIXU@MAILINATOR.COM', '76 OAK BOULEVARD', 'MAIORES ET NIHIL ET', 'ADMINISTRATOR', 1, 0, NULL, 'user-default-profile.png', 'user-default-id.png', '2023-02-12 18:01:37');

-- --------------------------------------------------------

--
-- Structure for view `logins_view`
--
DROP TABLE IF EXISTS `logins_view`;

CREATE OR REPLACE VIEW `logins_view`  AS SELECT `users`.`user_id` AS `user_id`, `users`.`user_name` AS `user_name`, `users`.`user_fullname` AS `user_fullname`, `users`.`user_password` AS `user_password`, `users`.`user_type` AS `user_type`, `users`.`user_status` AS `user_status`, `users`.`user_loginBefore` AS `user_loginBefore`, `users`.`user_timestamp` AS `user_timestamp` FROM `users``users`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
