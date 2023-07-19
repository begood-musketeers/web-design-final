-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 19, 2023 at 04:06 PM
-- Server version: 8.0.33
-- PHP Version: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xsn`
--

-- --------------------------------------------------------

--
-- Table structure for table `bucket_list`
--

CREATE TABLE `bucket_list` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(256) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bucket_list`
--

INSERT INTO `bucket_list` (`id`, `user_id`, `title`, `created_datetime`) VALUES
(1, 1, 'pizza', '2023-07-19 14:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `bucket_list_item`
--

CREATE TABLE `bucket_list_item` (
  `id` int NOT NULL,
  `bucket_list_id` int NOT NULL,
  `content` varchar(256) NOT NULL,
  `completed` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `object_id` int NOT NULL,
  `object_type` enum('post','recommendation','bucket_list','event') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` varchar(256) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `object_id`, `object_type`, `content`, `created_datetime`) VALUES
(15, 6, 51, 'post', 'hello', '2023-07-19 15:17:51'),
(16, 1, 51, 'post', 'pls like my post', '2023-07-19 15:18:31'),
(17, 6, 51, 'post', 'amazing', '2023-07-19 15:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `type` enum('sports','cinema','hangout','games','amusement park') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `location` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visible` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `user_id`, `title`, `description`, `type`, `location`, `start_datetime`, `end_datetime`, `created_datetime`, `visible`) VALUES
(1, 1, 'test event', 'this is event', 'sports', 'event place', '2023-07-06 09:07:27', '2023-07-13 01:49:22', '2023-07-06 09:07:47', 1),
(2, 1, 'Visit Hello Kitty land :D', 'This Sunday (09-07-23) we will be going to Hello Kitty land with our share house.\r\n\r\nWe will leave at 12:00 from Toyocho station. Be sure to bring your own food and buy your own ticket before hand at: https://hellokitty.com/tickets', 'amusement park', 'https://www.google.com/maps/place/Yomiuri+Land/@35.6191805,139.51482,15.11z/data=!4m10!1m2!2m1!1syomiuri+land!3m6!1s0x6018fa887471f1f7:0xe782eba55f33f953!8m2!3d35.6249403!4d139.5175677!15sCgx5b21pdXJpIGxhbmRaDiIMeW9taXVyaSBsYW5kkgEOYW11c2VtZW50X3BhcmvgAQA!16s%2Fm%2F04ydpcz?entry=ttu', '2023-07-07 07:42:13', '2023-07-13 01:49:22', '2023-07-07 07:45:43', 1),
(7, 1, 'kjskdngdjsng', 'lgjndslgnsfd', 'cinema', '', '2023-07-11 00:00:00', '2023-07-11 00:00:00', '2023-07-19 14:25:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `user_id` int NOT NULL,
  `follower_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `object_id` int NOT NULL,
  `object_type` enum('post','place','event') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `object_id`, `object_type`, `file_name`) VALUES
(1, 1, 'post', 'cat.jpg'),
(2, 1, 'post', 'dog.jpg'),
(3, 1, 'event', 'schiphol.jpg'),
(4, 2, 'event', 'hello_kitty.jpg'),
(5, 2, 'event', 'hello_kitty_2.jpg'),
(6, 2, 'event', 'hello_kitty_3.jpg'),
(60, 7, 'event', '64b7f25aac5d66.68811700.png'),
(61, 51, 'post', '64b7fce5bfe9f9.06017192.png');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `acting_user_id` int NOT NULL,
  `object_id` int NOT NULL,
  `object_type` enum('post','recommendation','bucket_list','event') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` enum('like','comment') NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` enum('post','recommendation') NOT NULL,
  `location` varchar(256) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visible` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `description`, `type`, `location`, `created_datetime`, `visible`) VALUES
(51, 1, 'this is post', 'post', 'post', '', '2023-07-19 15:10:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(512) NOT NULL,
  `security_question_id` int NOT NULL,
  `security_question_answer` varchar(256) NOT NULL,
  `password` varchar(512) NOT NULL,
  `role` enum('student','buddy','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `picture` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `security_question_id`, `security_question_answer`, `password`, `role`, `picture`) VALUES
(1, '1Dalon', 'dalonmusic@gmail.com', 2, 'black', '$2y$10$D7MddhXPcRAkJBZVLKCA1eWjxe.l4NSnDUuFLBWopkTsfV9OMRnja', 'student', 'pp_1.png'),
(2, 'SmallAnt', 'smallant@gmail.com', 1, 'mom', '$2y$10$s60.dm7XfY30wWRNiVMFcuGy2oI9PMByE96TszknYJM6AO0piYC4q', 'student', NULL),
(3, 'aojdngdoajbg', 'sljkgnd@oignsgn.com', 5, 'bible', '$2y$10$DDLR1dch7JYbxaPCVz.g5Ok6UV1WuxTmavcyyjMwD7ALdv1qP3wAy', 'student', NULL),
(4, 'peterpan', 'peterpan@iets.com', 2, 'black', '$2y$10$CA5Xve5DqaYAETb0BNaoWOhJ9jnIzGb4NG/2k2k.IiahsLArw.ofu', 'student', NULL),
(5, 'peter', 'asodgnsdjgn@lgjknaljgn.com', 3, 'pizza', '$2y$10$Y39uVhSYus/E/4xoLlb6jOwKNZsVBctusDALm3tx4srQj/3cRnu4C', 'student', NULL),
(6, 'bruno', 'bruno@bruno.com', 3, 'sushi', '$2y$10$22LS4NfrsFyEHOsfGMtzEeft/GzcGBQpeMFu2asojrGk3iXIM3d3m', 'student', 'pp_6.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_like`
--

CREATE TABLE `user_like` (
  `user_id` int NOT NULL,
  `object_id` int NOT NULL,
  `object_type` enum('post','event','bucket_list') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_like`
--

INSERT INTO `user_like` (`user_id`, `object_id`, `object_type`) VALUES
(1, 1, 'event'),
(1, 2, 'event'),
(1, 51, 'post'),
(6, 51, 'post');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bucket_list`
--
ALTER TABLE `bucket_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bucket_list_item`
--
ALTER TABLE `bucket_list_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`user_id`,`follower_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_like`
--
ALTER TABLE `user_like`
  ADD PRIMARY KEY (`user_id`,`object_id`,`object_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bucket_list`
--
ALTER TABLE `bucket_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bucket_list_item`
--
ALTER TABLE `bucket_list_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
