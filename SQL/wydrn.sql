-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 04:50 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wydrn`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `username` varchar(50) NOT NULL,
  `videogame` varchar(120) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `album` varchar(150) DEFAULT NULL,
  `artist` varchar(100) DEFAULT NULL,
  `book` varchar(200) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `movie` varchar(150) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `tv` varchar(150) DEFAULT NULL,
  `streaming` varchar(100) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `follower_username` varchar(255) NOT NULL,
  `followed_username` varchar(255) NOT NULL,
  `followed_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_pic` varchar(255) DEFAULT 'images/website/defaultPFP.png',
  `background_pic` varchar(255) DEFAULT 'images/website/defaultBackground.jpg',
  `active` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `email`, `password`, `date`, `profile_pic`, `background_pic`, `active`, `verified`) VALUES
(61, 9223372036854775807, 'rt', 'rt@james.com', '$2y$10$IA5Z9y0A0lnJ6QnhrqBT1.TCNGHQkwPOmtXywHpf/Ecsl5ncesSLC', '2022-03-19 14:09:00', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(62, 100333, 'pppppppppppp', 'pppppppp@gmail.com', '$2y$10$rYdZUmCkuoAX3399dqiFAesbg.ycr2CjCqenKCmZcoQ5SOkNe5Y92', '2022-03-19 14:49:34', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(66, 86554043705, 'jamesjoyce', 'wydrnwebapp@gmail.com', '$2y$10$e9jU7bIvrgVLFWBOdNXLrubWwSKwbNz/fmI9inelUN5ChWW47Ujuq', '2022-03-19 14:59:20', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(67, 192511, 'wydrnbae', 'wydrnapp@gmail.com', '$2y$10$sZow5C2lbfA5fgovkj21LueQUhc379J76g4NQGSPcBfdbxGzfgLvC', '2022-03-19 15:00:28', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(71, 862114561492, 'susujpeg', 'darlingjamiesooo@gmail.com', '$2y$10$v/ZcsYOjV7xaJKJNViD4wOyyY4ntPCPcBPRswBOAUh5y7aZbBZPYS', '2022-03-19 15:29:00', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(101, 6736313620926600, 'jamesons', 'doometesdasdasdasdrnal@gmail.com', '$2y$10$ASb66zM7NMlXzXmTxQLucuE2mnsU4/m5exCOZJs2prfaGLh4ihVBm', '2022-03-21 14:59:15', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(102, 2922328499458072, 'idkbro', 'ihonestlydontknow@yahoo.com', '$2y$10$uQdQeVQvQlwozb8d9ywot.2LO7dcjhrzTvCvTlQnOYQg8kl6pOkb.', '2022-03-22 15:49:58', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD UNIQUE KEY `datetime` (`datetime`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name_2` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
