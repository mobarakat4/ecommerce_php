-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 12:47 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

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

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) NOT NULL DEFAULT '0',
  `allow_adds` tinyint(4) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `name`, `description`, `ordering`, `visible`, `allow_comment`, `allow_adds`, `date`) VALUES
(1, 'wash', 'this', 5, 1, 0, 1, '2023-08-24'),
(2, 'games', 'this is for games', 4, 1, 1, 0, '2023-08-26'),
(4, 'game', 'is', 2, 1, 0, 0, '2023-08-27'),
(5, 'gamesl', 'dh dh hd', 3, 1, 0, 1, '2023-08-27'),
(6, 'furniture', 'for homes', 14, 1, 1, 1, '2023-09-01'),
(7, 'PC Games', 'for pc games', 20, 1, 1, 1, '2023-09-02'),
(8, 'my shop', 'this is mine', 21, 0, 0, 0, '2023-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `status`, `date`, `user_id`, `item_id`) VALUES
(1, 'this is first comment', 0, '2023-09-06', 15, 11),
(2, 'ljlkjklk', 0, '2023-09-07', 18, 5),
(4, 'lllll', 0, '2023-09-06', 15, 11),
(5, 'test', 0, '2023-09-07', 13, 10);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `country_made` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `rating` smallint(6) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `date`, `country_made`, `image`, `status`, `rating`, `cat_id`, `member_id`, `approve`) VALUES
(5, 'playstation', 'for games', '8000', '2023-09-02', 'China', NULL, '1', NULL, 2, 1, 0),
(6, 'girl toy', ' toy for girls', '150', '2023-09-02', 'USA', NULL, '3', NULL, 4, 17, 0),
(8, 'sofa', 'sofa for sitting room', '5000', '2023-09-02', 'Turkey', NULL, '1', NULL, 6, 13, 0),
(9, 'nece bed', 'nice and comfortable bed', '5005', '2023-09-02', 'Egypt', NULL, '3', NULL, 6, 17, 0),
(10, 'clock ', ' nice clock ', '400', '2023-09-02', 'Jaban', NULL, '1', NULL, 6, 13, 0),
(11, 'GTA 5', 'GTA 5 ', '1000', '2023-09-02', 'USA', NULL, '1', NULL, 7, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'for user identify',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf32 NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT 'user permition',
  `trust_status` int(11) NOT NULL DEFAULT '0' COMMENT 'seller rank',
  `reg_status` int(11) NOT NULL DEFAULT '0' COMMENT 'user approve',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `group_id`, `trust_status`, `reg_status`, `date`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'kota10@gmail.com', 'Mohamed Barakat', 1, 0, 1, '0000-00-00'),
(13, 'ahmed', '1698c2bea6c8000723d5bb70363a8352d846917e', 'ahmed@ex.com', 'ahmed', 0, 0, 1, '2023-08-19'),
(15, 'hossam', '388ad1c312a488ee9e12998fe097f2258fa8d5ee', 'hoss@ex.com', 'hossam', 0, 0, 0, '2023-08-19'),
(16, 'mahmoud', 'b94906ed9ea0e26f71304dcf715974cbf20d9242', 'ex@ex.com', 'mahmoud ahmed', 0, 0, 1, '2023-08-20'),
(17, 'barakat', 'a7ead894957420aac12ad9f8253447fda897a7c1', 'kota10441@gmail.com', 'Mohamed Barakat', 0, 0, 1, '2023-08-20'),
(18, 'mahmoudbarakat', 'e3683ff1c668a792eb012eee1ce32a08b6eb6861', 'mahamed@gamil.com', 'Mahamed Barakat', 0, 0, 0, '2023-08-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c1` (`item_id`),
  ADD KEY `c2` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member` (`member_id`),
  ADD KEY `cat` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'for user identify', AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `c1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
