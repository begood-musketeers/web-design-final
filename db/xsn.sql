-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 19, 2023 at 07:00 PM
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
(6, 1, 'Japan', '2023-07-19 18:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `bucket_list_item`
--

CREATE TABLE `bucket_list_item` (
  `id` int NOT NULL,
  `bucket_list_id` int NOT NULL,
  `content` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bucket_list_item`
--

INSERT INTO `bucket_list_item` (`id`, `bucket_list_id`, `content`) VALUES
(2, 1, 'hallo'),
(3, 1, 'cheese'),
(4, 1, ''),
(5, 1, ''),
(6, 1, ''),
(7, 1, ''),
(8, 1, ''),
(9, 1, ''),
(10, 1, ''),
(12, 2, 'kerst en nieuw'),
(14, 2, 'doping'),
(15, 4, 'Meji Jingu'),
(16, 4, 'Osaka'),
(17, 6, 'Osaka'),
(18, 6, 'Onzen');

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
(18, 6, 52, 'post', 'wow, maybe I should go sometime it looks amazing!', '2023-07-19 18:44:47'),
(20, 9, 52, 'post', '👍', '2023-07-19 18:46:05'),
(21, 9, 8, 'event', 'hahaha let\'s do it!', '2023-07-19 18:51:50'),
(22, 10, 8, 'event', 'omggg ♥♥♥♥', '2023-07-19 18:53:27'),
(23, 8, 56, 'post', 'I don\'t have a licence mannnn', '2023-07-19 18:57:02'),
(24, 8, 8, 'event', 'ok', '2023-07-19 18:57:45');

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
(8, 8, 'Sanrio Puroland', 'My sharehouse is planning to visit Sanrio Puroland in Nagayama. We will be there at 12:00, make sure to bring some snacks because we heard that the food is expensive 😭😂😂.\r\n\r\nGet a ticket at https://www.puroland.jp/lang/en/', 'amusement park', 'https://www.google.com/maps?client=firefox-b-d&amp;output=search&amp;q=sanrio+puroland+location&amp;entry=mc&amp;sa=X&amp;ved=2ahUKEwj0-ejWt5uAAxWUpVYBHdN8DZIQ0pQJegQIDRAB', '2023-07-24 00:00:00', '2023-07-24 00:00:00', '2023-07-19 18:50:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_participant`
--

CREATE TABLE `event_participant` (
  `user_id` int NOT NULL,
  `event_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_participant`
--

INSERT INTO `event_participant` (`user_id`, `event_id`) VALUES
(6, 8),
(9, 8),
(10, 8),
(11, 8);

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
(62, 52, 'post', '64b82edeb7c136.47111939.jpg'),
(63, 52, 'post', '64b82edee748a4.93780328.jpg'),
(65, 52, 'post', '64b82edf37d781.99507030.jpg'),
(68, 8, 'event', '64b8308fd7f064.26621060.jpg'),
(69, 56, 'post', '64b831df7e7200.08355909.jpg'),
(70, 56, 'post', '64b831dfb35238.73913369.jpg'),
(72, 57, 'post', '64b832852da8d4.86570609.jpg');

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
  `type` enum('like','comment','event_join') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `acting_user_id`, `object_id`, `object_type`, `type`, `created_datetime`) VALUES
(17, 8, 6, 52, 'post', 'like', '2023-07-19 18:44:34'),
(19, 8, 6, 52, 'post', 'comment', '2023-07-19 18:44:47'),
(21, 8, 9, 52, 'post', 'comment', '2023-07-19 18:46:05'),
(22, 8, 9, 52, 'post', 'like', '2023-07-19 18:46:45'),
(23, 8, 8, 52, 'post', 'like', '2023-07-19 18:46:59'),
(24, 8, 1, 52, 'post', 'like', '2023-07-19 18:47:07'),
(25, 8, 6, 8, 'event', 'like', '2023-07-19 18:51:23'),
(26, 8, 6, 8, 'event', 'event_join', '2023-07-19 18:51:25'),
(27, 8, 9, 8, 'event', 'event_join', '2023-07-19 18:51:43'),
(28, 8, 9, 8, 'event', 'like', '2023-07-19 18:51:45'),
(29, 8, 9, 8, 'event', 'comment', '2023-07-19 18:51:50'),
(30, 8, 7, 8, 'event', 'event_join', '2023-07-19 18:51:58'),
(31, 8, 10, 8, 'event', 'like', '2023-07-19 18:53:08'),
(32, 8, 10, 8, 'event', 'event_join', '2023-07-19 18:53:11'),
(33, 8, 10, 8, 'event', 'comment', '2023-07-19 18:53:27'),
(34, 8, 1, 8, 'event', 'like', '2023-07-19 18:53:49'),
(35, 8, 11, 8, 'event', 'like', '2023-07-19 18:54:53'),
(36, 8, 11, 8, 'event', 'event_join', '2023-07-19 18:54:55'),
(37, 11, 8, 56, 'post', 'like', '2023-07-19 18:56:42'),
(38, 11, 8, 56, 'post', 'comment', '2023-07-19 18:57:02'),
(39, 8, 8, 8, 'event', 'like', '2023-07-19 18:57:32'),
(40, 8, 8, 8, 'event', 'comment', '2023-07-19 18:57:45'),
(41, 11, 10, 56, 'post', 'like', '2023-07-19 18:59:30');

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
(52, 8, 'I went to Meji Jingu!!!', 'It was pretty cool', 'post', '', '2023-07-19 18:43:42', 1),
(56, 11, 'Someone want to do a car meetup sometime??', 'If you want to do a meeting at SIT let me know in the comments', 'post', '', '2023-07-19 18:56:31', 1),
(57, 10, 'I want to go to Disney Sea 😭', 'Anyone want to organise an event with me pls??', 'post', '', '2023-07-19 18:59:17', 1);

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
(6, 'bruno', 'bruno@bruno.com', 3, 'sushi', '$2y$10$22LS4NfrsFyEHOsfGMtzEeft/GzcGBQpeMFu2asojrGk3iXIM3d3m', 'student', 'pp_6.png'),
(7, 'Richard', 'richard@richard.com', 5, 'kaas', '$2y$10$KsYAaRWK5nmzwi6nu6Gmy.JEummZzviBZxMcTP58U2VvHNAHpQrta', 'student', NULL),
(8, 'storm', 'storm@storm.com', 2, 'black', '$2y$10$v998fVPI0zEOh8X8uKajCuJxGO6JRSGDezns/A/QtL97dPAOT3/zy', 'student', 'pp_8.png'),
(9, 'dillan', 'sujgb@ksjgjsfng.com', 1, 'mom', '$2y$10$/Kcnaxf103xCQd55sVcQCOPoFeoKfOhbuzMDW82AMm3q1rMqYl4pK', 'student', 'pp_9.png'),
(10, 'sarah', 'kdjbgfdkjb@conm.com', 3, 'osdngdjng', '$2y$10$7K7MrNF2Oj8bglk5TuRP.eTbAw4VI7aiyndSHvWe0XzNVJ.SsfILq', 'student', 'pp_10.png'),
(11, 'Daiki', 'jsgjn@agein.com', 4, 'ljjnsfgjlnsfgjlnfsg', '$2y$10$mxV.YiypvnIAkB.8qIL6TedC6BtX/BLXAuBmzj0rN1lnjpkqe7e7K', 'student', 'pp_11.png');

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
(1, 8, 'event'),
(1, 52, 'post'),
(6, 8, 'event'),
(6, 52, 'post'),
(8, 8, 'event'),
(8, 52, 'post'),
(8, 56, 'post'),
(9, 8, 'event'),
(9, 52, 'post'),
(10, 8, 'event'),
(10, 56, 'post'),
(11, 8, 'event');

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
-- Indexes for table `event_participant`
--
ALTER TABLE `event_participant`
  ADD PRIMARY KEY (`user_id`,`event_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bucket_list_item`
--
ALTER TABLE `bucket_list_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
