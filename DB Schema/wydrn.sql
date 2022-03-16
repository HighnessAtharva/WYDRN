-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 07:47 PM
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
('admin', '', '', '', '', '', '', 'REVENGE OF THE NERDS', '1988', 'WATCHMEN', 'HBO ', '2022-03-09 16:48:11', '2022-03-09', NULL, NULL),
('HighnessAtharva', '', '', '', '', '', '', 'THE BATMAN ', '2069', 'MERLIN\'S SQUAD', 'ARTHUR', '2022-03-09 16:52:46', '2022-03-09', NULL, NULL),
('HighnessAtharva', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', 'THE BATMAN ', '2022', 'WESTWORLD', 'NETLFIXA + AJSJD', '2022-03-09 16:52:59', '2022-03-09', NULL, NULL),
('HighnessAtharva', 'SERIOUS SAM 4', 'PC', '', '', '', '', '', '', '', '', '2022-03-09 17:39:06', '2022-03-09', NULL, NULL),
('HighnessAtharva', 'ELDEN RING', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-03-12 10:49:17', '2022-03-12', NULL, NULL),
('HighnessAtharva', '', '', '', '', 'ROYAL ASSASSIN', 'ROBIN HOBB', '', '', 'GAME OF THRONES', 'HBO', '2022-03-12 10:49:33', '2022-03-12', NULL, NULL),
('HighnessAtharva', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-03-16 21:30:48', '2022-03-16', NULL, NULL),
('ppp', '', '', 'CAVALCADE', 'POST MALONE', '', '', 'JUSTICE LEAGUE SNYDERCUT', '1978', '', '', '2022-03-16 21:52:44', '2022-03-16', NULL, NULL),
('HighnessAtharva', '', '', '', '', '', '', '', '', 'PEAKY BLINDERS', 'NETLFIXA + AJSJD', '2022-03-16 22:05:19', '2022-03-16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_pic` varchar(255) DEFAULT 'images/website/defaultPFP.png',
  `background_pic` varchar(255) DEFAULT 'images/website/defaultBackground.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `password`, `date`, `profile_pic`, `background_pic`) VALUES
(1, 2810727, 'HighnessAtharva', '75455564', '2022-03-16 16:17:37', 'images/users/051737 - new logo.jpeg', 'images/users/check.JPG'),
(27, 46034167346586, 'testacc', 'testytaster', '2022-03-11 08:40:25', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg'),
(31, 9223372036854775807, 'iii', 'jjj', '2022-03-11 09:34:34', 'images/users/EmbeddedCover.jpg', 'images/users/doom-eternal-soundtrack-ost.jpg'),
(32, 2930418, 'ppp', 'oily', '2022-03-16 16:18:01', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
