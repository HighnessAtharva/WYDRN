-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2022 at 07:29 AM
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
  `date` date NOT NULL DEFAULT current_timestamp(),
  `followers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`followers`)),
  `following` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`following`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`, `datetime`, `date`, `followers`, `following`) VALUES
('ppp', '', '', 'CAVALCADE', 'POST MALONE', '', '', 'JUSTICE LEAGUE SNYDERCUT', '1978', '', '', '2022-03-16 21:52:44', '2022-03-16', NULL, NULL),
('peterj', 'DOOM ETERNAL ', 'XBOX ONE', 'CAVALCADE', 'AURORA', 'ATOMIC HABITS', 'SUCKERDAD', '', '', '', '', '2022-03-17 13:14:48', '2022-03-17', NULL, NULL),
('anay', '', '', '', '', '', '', 'ROBIN HOOD', '1996', '', '', '2022-03-17 13:30:41', '2022-03-17', NULL, NULL),
('anay', '', '', '', '', '', '', 'ROBIN HOOD', '1996', '', '', '2022-03-17 13:31:05', '2022-03-17', NULL, NULL);

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
(47, 963757156647576, 'daisy', 'peachykeen@xmail.com', '$2y$10$TArrGdZ.PiJAZzjIEIS8Oew9N0jCZLPzxemic1RjopSLkMMMVfueK', '2022-03-19 13:14:56', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(48, 824601031735498, 'peachy', 'unknowingforsakendamned@gmail.com', '$2y$10$SjI3sLet3F5t4UmoXo9hUuGNATrS1lZttsWlzL1HXX7WKiFXWdxey', '2022-03-19 13:16:55', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(49, 451812121769, 'darned', 'westerospatriot@gmail.com', '$2y$10$QZYVQJFiPKqOJs64refL1OQ8yRDy/zUt7Km4Dbpyskf1ylJd50iyG', '2022-03-19 13:17:23', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(51, 6425251511357111395, 'peter', 'drinknnnnnnnnsoda@gmail.com', '$2y$10$og7ixOVsHFi.a36XtfWOwuVTOszQ4/zEupkmnhBr35YCYuHW8kAEa', '2022-03-19 13:24:17', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(52, 5325550982297021, 'j', 'lmnopqrstuvwxyz@gmail.com', '$2y$10$Q5h.11jvR.AlUANU7PjKqu88jLEI6yKIgNZ7CRjeRBzfdKNnsNaia', '2022-03-19 13:25:44', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(58, 265546918462, 'sd', 'dffirestarters@gmail.com', '$2y$10$GWs.UYHK464a0RlDKWQnT.NJAn8VIAX98JuhYUt33Hz.HN5tuqXsq', '2022-03-19 14:06:55', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(59, 876083870, 'e', 'esadasdasdeee@gmail.com', '$2y$10$c.3ezXYAT2Y5hriSpRxLnO1f6MSZamonV7hJFx4LXFgLsU9pq5Oh6', '2022-03-19 14:07:34', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(61, 9223372036854775807, 'rt', 'rt@james.com', '$2y$10$IA5Z9y0A0lnJ6QnhrqBT1.TCNGHQkwPOmtXywHpf/Ecsl5ncesSLC', '2022-03-19 14:09:00', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(62, 100333, 'pppppppppppp', 'pppppppp@gmail.com', '$2y$10$rYdZUmCkuoAX3399dqiFAesbg.ycr2CjCqenKCmZcoQ5SOkNe5Y92', '2022-03-19 14:49:34', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(66, 86554043705, 'jamesjoyce', 'wydrnwebapp@gmail.com', '$2y$10$e9jU7bIvrgVLFWBOdNXLrubWwSKwbNz/fmI9inelUN5ChWW47Ujuq', '2022-03-19 14:59:20', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(67, 192511, 'wydrnbae', 'wydrnapp@gmail.com', '$2y$10$sZow5C2lbfA5fgovkj21LueQUhc379J76g4NQGSPcBfdbxGzfgLvC', '2022-03-19 15:00:28', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(68, 8609, 'HighnessAtharva', 'HighnessAtharva@gmail.com', '$2y$10$zWiYcatFNhsOBfcy/H3XOeRdsadJSd7Unmsh.pMDrOvbV7Sfq32hW', '2022-03-19 15:17:40', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(71, 862114561492, 'susujpeg', 'darlingjamiesooo@gmail.com', '$2y$10$v/ZcsYOjV7xaJKJNViD4wOyyY4ntPCPcBPRswBOAUh5y7aZbBZPYS', '2022-03-19 15:29:00', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(79, 781612283921868, 'doometernal', 'slayerdoomer@gmail.com', '$2y$10$cw2tfGeFx1JlusQ6IKhsXOIOswJ3A10WIpv/QIYonQIhAXVz4ioSu', '2022-03-20 06:14:40', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
